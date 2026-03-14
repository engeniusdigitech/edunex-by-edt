<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentFee;
use App\Models\Payment;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FeePaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentGatewayService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the student's fees.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        if (!$student) {
            return redirect()->route('student.login');
        }

        $fees = StudentFee::with(['feeStructure.category', 'payments'])
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        $institute = $student->institute;
        $gatewayConfig = $institute->paymentGateway;

        return view('student.fees.index', compact('fees', 'gatewayConfig'));
    }

    /**
     * Initiate a payment for a specific fee using the selected gateway.
     */
    public function pay(Request $request, StudentFee $fee)
    {
        $request->validate([
            'gateway' => 'required|in:stripe,razorpay',
            'amount' => 'required|numeric|min:1|max:' . $fee->due_amount
        ]);

        $amount = $request->amount;
        $student = Auth::guard('student')->user();

        if ($fee->student_id !== $student->id) {
            abort(403, 'Unauthorized access to this fee.');
        }

        if ($fee->due_amount <= 0 || $fee->status === 'paid') {
            return back()->with('error', 'This fee is already fully paid.');
        }

        $gatewayConfig = $student->institute->paymentGateway;

        if (!$gatewayConfig) {
            return back()->with('error', 'Payment gateway is not configured for this institute.');
        }

        try {
            if ($request->gateway === 'stripe') {
                $session = $this->paymentService->createStripeSession(
                    $fee,
                    $gatewayConfig,
                    $amount,
                    route('student.fees.stripe.success'),
                    route('student.fees.cancel')
                );

                return redirect($session->url);
            } elseif ($request->gateway === 'razorpay') {
                $order = $this->paymentService->createRazorpayOrder($fee, $gatewayConfig, $amount);

                // Return view that handles Razorpay checkout via JavaScript
                return view('student.fees.razorpay_checkout', [
                    'order' => $order,
                    'fee' => $fee,
                    'amount' => $amount,
                    'gatewayConfig' => $gatewayConfig,
                    'student' => $student
                ]);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to initiate payment: ' . $e->getMessage());
        }
    }

    /**
     * Handle cancelled payment
     */
    public function cancel()
    {
        return redirect()->route('student.fees.index')->with('error', 'Payment was cancelled.');
    }

    /**
     * Handle synchronous success return from Stripe (Verifies and updates balance immediately)
     */
    public function stripeSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');
        $student = Auth::guard('student')->user();
        $gatewayConfig = $student->institute->paymentGateway;

        if ($sessionId && $gatewayConfig) {
            try {
                \Stripe\Stripe::setApiKey($gatewayConfig->stripe_secret_key);
                $session = \Stripe\Checkout\Session::retrieve($sessionId);

                if ($session->payment_status === 'paid') {
                    $this->paymentService->processSuccessfulPayment(
                        $session->metadata->student_fee_id,
                        $session->amount_total / 100,
                        'stripe',
                        $session->payment_intent ?? $session->id,
                        strtolower($session->currency ?? 'INR')
                    );
                    return redirect()->route('student.fees.index')->with('success', 'Payment successful and balance updated.');
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Stripe sync verification failed: " . $e->getMessage());
            }
        }

        return redirect()->route('student.fees.index')->with('success', 'Payment processing. It will reflect here shortly.');
    }

    /**
     * Verify Razorpay Payment Synchronously
     */
    public function razorpayVerify(Request $request)
    {
        $student = Auth::guard('student')->user();
        \Illuminate\Support\Facades\Log::info("Razorpay Verification request received", ['student_id' => $student->id ?? 'unknown', 'request' => $request->all()]);

        $gatewayConfig = $student->institute->paymentGateway;

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        if ($this->paymentService->verifyRazorpaySignature($attributes, $gatewayConfig)) {
            \Illuminate\Support\Facades\Log::info("Razorpay Signature Verified Successfully");
            $studentFeeId = $request->student_fee_id;
            $amount = $request->amount; // This should be the recorded amount from the frontend or order

            $this->paymentService->processSuccessfulPayment(
                $studentFeeId,
                $amount,
                'razorpay',
                $request->razorpay_payment_id
            );

            return response()->json(['status' => 'success', 'redirect' => route('student.fees.index')]);
        }

        \Illuminate\Support\Facades\Log::error("Razorpay Signature Verification Failed", ['attributes' => $attributes]);
        return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
    }

    /**
     * Download receipt for a completed payment.
     */
    public function receipt(Payment $payment)
    {
        $student = Auth::guard('student')->user();
        if ($payment->student_id !== $student->id) {
            abort(403);
        }

        if ($payment->status !== 'success') {
            return back()->with('error', 'Receipt is only available for successful payments.');
        }

        // We will implement generating a PDF in a separate task.
        // For now, return a view.
        return view('student.fees.receipt', compact('payment', 'student'));
    }
}
