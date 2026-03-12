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

        $fees = StudentFee::with('feeStructure.category')
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
            'gateway' => 'required|in:stripe,razorpay'
        ]);

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
                    route('student.fees.stripe.success'),
                    route('student.fees.cancel')
                );

                return redirect($session->url);
            }
            elseif ($request->gateway === 'razorpay') {
                $order = $this->paymentService->createRazorpayOrder($fee, $gatewayConfig);

                // Return view that handles Razorpay checkout via JavaScript
                return view('student.fees.razorpay_checkout', [
                    'order' => $order,
                    'fee' => $fee,
                    'gatewayConfig' => $gatewayConfig,
                    'student' => $student
                ]);
            }
        }
        catch (\Exception $e) {
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
     * Handle synchronous success return from Stripe (optional, webhooks confirm actual payment)
     */
    public function stripeSuccess(Request $request)
    {
        // The actual payment verification and recording happens via Webhooks.
        // This is just a UI redirect after Stripe Checkout.
        return redirect()->route('student.fees.index')->with('success', 'Payment processing. It will reflect here shortly.');
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
