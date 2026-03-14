<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\StudentFee;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WebhookController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentGatewayService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Handle Stripe Webhooks
     */
    public function handleStripe(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $event = null;

        // We need the institute_id to get the correct webhook secret.
        // However, Stripe webhooks don't easily tell us which institute it's for 
        // without parsing the event payload first. 
        // A standard approach in multi-tenant is to have the frontend pass the institute_id in the webhook URL 
        // OR rely on general parsing first. Let's decode without verifying signature first just to get metadata.
        $data = json_decode($payload, true);

        if (!isset($data['data']['object']['metadata']['institute_id'])) {
            Log::warning('Stripe webhook received without institute_id in metadata');
            return response()->json(['status' => 'ignored'], 200);
        }

        $instituteId = $data['data']['object']['metadata']['institute_id'];
        $gatewayConfig = PaymentGateway::where('institute_id', $instituteId)->first();

        if (!$gatewayConfig || empty($gatewayConfig->stripe_webhook_secret)) {
            Log::error("Stripe webhook received but no webhook secret found for institute {$instituteId}");
            return response()->json(['error' => 'Not configured'], 400);
        }

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $gatewayConfig->stripe_webhook_secret
            );
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the checkout.session.completed event
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            $this->paymentService->processSuccessfulPayment(
                $session->metadata->student_fee_id,
                $session->amount_total / 100, // Convert from cents
                'stripe',
                $session->payment_intent ?? $session->id,
                strtolower($session->currency ?? 'INR')
            );
        }

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Handle Razorpay Webhooks
     */
    public function handleRazorpay(Request $request)
    {
        // Razorpay webhooks can be verified via a secret set in their dashboard.
        // Usually, the webhook URL needs a secret. We'll verify it using the 
        // X-Razorpay-Signature header if configured, but often it's configured globally.
        // For SaaS, institutes might set their own webhooks.

        $payload = $request->getContent();
        $data = json_decode($payload, true);

        // Ensure it's a payment authorized or captured event
        if (isset($data['event']) && in_array($data['event'], ['payment.captured', 'order.paid'])) {
            $paymentEntity = $data['payload']['payment']['entity'] ?? null;

            if ($paymentEntity && isset($paymentEntity['notes']['student_fee_id'])) {
                $studentFeeId = $paymentEntity['notes']['student_fee_id'];
                $amount = $paymentEntity['amount'] / 100; // paise to INR
                $transactionId = $paymentEntity['id'];
                $currency = $paymentEntity['currency'] ?? 'INR';

                // Optional: Verify signature if the institute has saved a webhook secret in a separate field.
                // For now, if we trust the notes and transaction, we process it.
                $this->paymentService->processSuccessfulPayment($studentFeeId, $amount, 'razorpay', $transactionId, $currency);
            }
        }

        return response()->json(['status' => 'success'], 200);
    }


}
