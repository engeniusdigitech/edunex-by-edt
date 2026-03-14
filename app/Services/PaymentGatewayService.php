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
    public function createStripeSession(StudentFee $fee, PaymentGateway $config, $amount, $successUrl, $cancelUrl)
    {
        if (empty($config->stripe_secret_key)) {
            throw new \Exception('Stripe is not configured for this institute.');
        }

        Stripe::setApiKey($config->stripe_secret_key);

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'inr',
                        'product_data' => [
                            'name' => 'Fee Payment: ' . $fee->feeStructure->name,
                        ],
                        'unit_amount' => (int) ($amount * 100),
                    ],
                    'quantity' => 1,
                ]
            ],
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
    public function createRazorpayOrder(StudentFee $fee, PaymentGateway $config, $amount)
    {
        if (empty($config->razorpay_key) || empty($config->razorpay_secret)) {
            throw new \Exception('Razorpay is not configured for this institute.');
        }

        $api = new Api($config->razorpay_key, $config->razorpay_secret);

        $orderData = [
            'receipt' => 'rcpt_' . $fee->id . '_' . time(),
            'amount' => (int) ($amount * 100),
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
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Internal method to securely record the payment and update fee balance.
     */
    public function processSuccessfulPayment($studentFeeId, $amountPaid, $gateway, $transactionId, $currency = 'INR')
    {
        \Illuminate\Support\Facades\Log::info("Processing successful payment in service", ['fee_id' => $studentFeeId, 'amount' => $amountPaid, 'txn' => $transactionId]);
        $fee = \App\Models\StudentFee::with('student.institute')->find($studentFeeId);

        if (!$fee) {
            \Illuminate\Support\Facades\Log::error("Payment process failed: StudentFee {$studentFeeId} not found.");
            return;
        }

        // Prevent duplicate processing
        $existingPayment = \App\Models\Payment::where('transaction_id', $transactionId)->first();
        if ($existingPayment) {
            \Illuminate\Support\Facades\Log::info("Payment ignored: Transaction {$transactionId} already processed.");
            return $fee; // Return fee to allow redirect logic
        }

        // Generate receipt number
        $receiptNumber = strtoupper($gateway[0]) . date('Ymd') . '-' . \Illuminate\Support\Str::random(6);

        // Record Payment
        \App\Models\Payment::create([
            'institute_id' => $fee->student->institute_id,
            'student_id' => $fee->student_id,
            'fee_structure_id' => $fee->fee_structure_id,
            'student_fee_id' => $fee->id,
            'amount_paid' => $amountPaid,
            'payment_date' => now(),
            'payment_method' => 'online',
            'status' => 'success',
            'gateway' => $gateway,
            'transaction_id' => $transactionId,
            'currency' => $currency,
            'payment_status' => 'paid',
            'receipt_number' => $receiptNumber,
        ]);

        // Update StudentFee
        $fee->paid_amount += $amountPaid;
        $fee->due_amount = max(0, $fee->amount - $fee->paid_amount);

        if ($fee->due_amount <= 0) {
            $fee->status = 'paid';
        } elseif ($fee->paid_amount > 0) {
            $fee->status = 'partial';
        }

        $fee->save();

        \Illuminate\Support\Facades\Log::info("Successfully processed {$gateway} payment for StudentFee {$studentFeeId}");

        return $fee;
    }
}
