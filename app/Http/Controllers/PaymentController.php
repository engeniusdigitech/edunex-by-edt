<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['student', 'feeStructure.category'])->latest()->paginate(15);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $students = Student::where('is_active', true)->get();
        $feeStructures = FeeStructure::all();
        return view('payments.create', compact('students', 'feeStructures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_structure_id' => 'required|exists:fee_structures,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,online,bank_transfer',
            'payment_date' => 'required|date',
        ]);

        $validated['status'] = 'success';

        // Mock Razorpay ID for simulation
        if ($validated['payment_method'] === 'online') {
            $validated['razorpay_payment_id'] = 'pay_' . Str::random(14);
        }

        Payment::create($validated);

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully.');
    }
    public function receipt(Payment $payment)
    {
        // Ensure the admin can only view receipts for their institute
        if (auth()->user()->institute_id !== $payment->institute_id && !auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $student = $payment->student;
        $institute = $payment->institute ?? auth()->user()->institute;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('payments.pdf_receipt', compact('payment', 'student', 'institute'));

        return $pdf->stream('receipt-' . ($payment->receipt_number ?? $payment->id) . '.pdf');
    }
}
