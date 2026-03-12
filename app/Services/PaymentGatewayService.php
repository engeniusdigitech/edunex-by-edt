<?php

namespace App\Services;

use App\Models\PaymentGateway;
use App\Models\StudentFee;
use Razorpay\Api\Api;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentGatewayService
{
    /**
     * Get the active gateway configuration for a specific institute.
     */
    public function getGatewayConfig($instituteId)
    {
        return PaymentGateway::where('institute_id', $instituteId)->first();
    }

    /**
     * Create a Stripe Checkout Session for a specific fee.
     */
    public function createStripeSession(StudentFee $fee, PaymentGateway $config, $successUrl, $cancelUrl)
    {
        if (empty($config->stripe_secret_key)) {
            throw new \Exception('Stripe is not configured for this institute.');
        }

        Stripe::setApiKey($config->stripe_secret_key);

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                    'price_data' => [
                        'currency' => 'inr', // Or dynamic based on institute settings
                        'product_data' => [
                            'name' => 'Fee Payment: ' . $fee->feeStructure->name,
                        ],
                        // Stripe expects amount in cents/lowest denomination
                        'unit_amount' => (int)($fee->due_amount * 100),
                    ],
                    'quantity' => 1,
                ]],
            'mode' => 'payment',
            'success_url' => $successUrl . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $cancelUrl,
            // Attach our internal IDs so we can map them back on success
            'client_reference_id' => $fee->id,
            'metadata' => [
                'student_fee_id' => $fee->id,
                'student_id' => $fee->student_id,
                'institute_id' => $fee->student->institute_id,
            ]
        ]);

        return $session;
    }

    /**
     * Create a Razorpay Order for a specific fee.
     */
    public function createRazorpayOrder(StudentFee $fee, PaymentGateway $config)
    {
        if (empty($config->razorpay_key) || empty($config->razorpay_secret)) {
            throw new \Exception('Razorpay is not configured for this institute.');
        }

        $api = new Api($config->razorpay_key, $config->razorpay_secret);

        $orderData = [
            'receipt' => 'rcpt_' . $fee->id . '_' . time(),
            // Razorpay expects amount in paise
            'amount' => (int)($fee->due_amount * 100),
            'currency' => 'INR',
            'notes' => [
                'student_fee_id' => $fee->id,
                'student_id' => $fee->student_id,
                'institute_id' => $fee->student->institute_id,
                'fee_name' => $fee->feeStructure->name,
            ]
        ];

        $razorpayOrder = $api->order->create($orderData);

        return $razorpayOrder;
    }

    /**
     * Verify Razorpay Signature
     */
    public function verifyRazorpaySignature($attributes, PaymentGateway $config)
    {
        $api = new Api($config->razorpay_key, $config->razorpay_secret);

        try {
            $api->utility->verifyPaymentSignature($attributes);
            return true;
        }
        catch (\Exception $e) {
            return false;
        }
    }
}
