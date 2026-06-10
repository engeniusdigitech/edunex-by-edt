<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        // Fee ledger (StudentFee records)
        $query = \App\Models\StudentFee::with(['student.batch', 'feeStructure.category', 'payments'])
            ->whereHas('student', function ($q) {
                $q->where('institute_id', auth()->user()->institute_id);
            });

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('batch_id')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('batch_id', $request->batch_id);
            });
        }

        $fees = $query->latest()->paginate(15);
        $batches = \App\Models\Batch::all();

        // Individual payment transactions for the Receipts tab
        $paymentsQuery = Payment::with(['student.batch', 'feeStructure.category', 'studentFee'])
            ->where('institute_id', auth()->user()->institute_id);

        // Text search: student name or receipt number
        if ($request->filled('receipt_search')) {
            $rs = $request->receipt_search;
            $paymentsQuery->where(function ($q) use ($rs) {
                $q->where('receipt_number', 'like', "%{$rs}%")
                  ->orWhereHas('student', fn ($sq) => $sq->where('name', 'like', "%{$rs}%"));
            });
        }

        // Payment method / gateway filter
        if ($request->filled('receipt_method')) {
            $method = $request->receipt_method;
            $paymentsQuery->where(function ($q) use ($method) {
                $q->where('payment_method', $method)
                  ->orWhere('gateway', $method);
            });
        }

        // Date filter
        if ($request->filled('receipt_date')) {
            $paymentsQuery->whereDate('payment_date', $request->receipt_date);
        }

        $payments = $paymentsQuery->latest()->paginate(15, ['*'], 'payments_page');

        // Determine which tab to auto-open
        $activeTab = $request->anyFilled(['receipt_search', 'receipt_method', 'receipt_date', '_tab'])
            ? 'receipts' : 'ledger';

        return view('payments.index', compact('fees', 'batches', 'payments', 'activeTab'));
    }

    public function create()
    {
        $students = Student::where('is_active', true)
            ->where('institute_id', auth()->user()->institute_id)
            ->get();
        $feeStructures = FeeStructure::where('institute_id', auth()->user()->institute_id)->get();
        return view('payments.create', compact('students', 'feeStructures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'       => 'required|exists:students,id',
            'fee_structure_id' => 'required|exists:fee_structures,id',
            'amount_paid'      => 'required|numeric|min:0',
            'payment_method'   => 'required|in:cash,online,bank_transfer',
            'payment_date'     => 'required|date',
        ]);

        $validated['status']          = 'success';
        $validated['payment_status']  = 'paid';
        $validated['institute_id']    = auth()->user()->institute_id;
        $validated['currency']        = 'INR';

        // Generate receipt number: prefix by method + date + random
        $prefix = match ($validated['payment_method']) {
            'cash'          => 'C',
            'bank_transfer' => 'B',
            default         => 'O',
        };
        $validated['receipt_number'] = $prefix . date('Ymd') . '-' . strtoupper(Str::random(6));

        // Simulated transaction ID for online payments
        if ($validated['payment_method'] === 'online') {
            $validated['transaction_id']      = 'pay_' . Str::random(14);
            $validated['razorpay_payment_id'] = $validated['transaction_id'];
        }

        // Link to the StudentFee record (if one exists)
        $studentFee = \App\Models\StudentFee::where('student_id', $validated['student_id'])
            ->where('fee_structure_id', $validated['fee_structure_id'])
            ->first();

        if ($studentFee) {
            $validated['student_fee_id'] = $studentFee->id;
        }

        $payment = Payment::create($validated);

        // Update the StudentFee balance
        if ($studentFee) {
            $studentFee->paid_amount += $validated['amount_paid'];
            $studentFee->due_amount   = max(0, $studentFee->amount - $studentFee->paid_amount);

            if ($studentFee->due_amount <= 0) {
                $studentFee->status = 'paid';
            } elseif ($studentFee->paid_amount > 0) {
                $studentFee->status = 'partial';
            }

            $studentFee->save();
        }

        // Redirect straight to the PDF receipt so admin can download / print it
        return redirect()
            ->route('payments.receipt', $payment->id)
            ->with('success', 'Payment of ₹' . number_format($validated['amount_paid'], 2) . ' recorded. Receipt generated below.');
    }

    public function receipt(Payment $payment)
    {
        // Scope to institute
        if (auth()->user()->institute_id !== $payment->institute_id && !auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $payment->load(['student.batch', 'feeStructure.category', 'studentFee']);

        $student    = $payment->student;
        $institute  = auth()->user()->institute;
        $studentFee = $payment->studentFee;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'payments.pdf_receipt',
            compact('payment', 'student', 'institute', 'studentFee')
        );

        return $pdf->stream('receipt-' . ($payment->receipt_number ?? $payment->id) . '.pdf');
    }
}
