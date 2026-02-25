<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Student;
use App\Models\FeeStructure;

class PaymentService
{
    /**
     * Process a Razorpay online payment
     */
    public function processOnlinePayment(Student $student, FeeStructure $fee, float $amount, string $razorpayPaymentId): Payment
    {
        // Here you would typically verify the signature using Razorpay API

        $payment = Payment::create([
            'institute_id' => $student->institute_id,
            'student_id' => $student->id,
            'fee_structure_id' => $fee->id,
            'amount_paid' => $amount,
            'payment_date' => now(),
            'payment_method' => 'online',
            'razorpay_payment_id' => $razorpayPaymentId,
            'status' => 'success',
        ]);

        // Trigger PDF generation or Email receipt here

        return $payment;
    }
}
