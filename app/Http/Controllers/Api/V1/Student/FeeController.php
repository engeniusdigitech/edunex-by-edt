<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentFee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();
        $fees = $student->studentFees()->with('feeStructure.category')->latest()->get();

        return response()->json([
            'summary' => [
                'total_assigned' => $fees->sum('amount'),
                'total_paid' => $fees->sum('paid_amount'),
                'total_due' => $fees->sum('due_amount'),
            ],
            'fees' => $fees->map(function ($fee) {
                return [
                    'id' => $fee->id,
                    'name' => $fee->feeStructure->name,
                    'category' => $fee->feeStructure->category->name,
                    'total_amount' => $fee->amount,
                    'paid_amount' => $fee->paid_amount,
                    'due_amount' => $fee->due_amount,
                    'status' => $fee->status,
                    'assigned_date' => $fee->created_at->format('Y-m-d'),
                ];
            })
        ]);
    }

    public function show(Request $request, StudentFee $fee)
    {
        if ($fee->student_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'id' => $fee->id,
            'amount' => $fee->amount,
            'paid' => $fee->paid_amount,
            'due' => $fee->due_amount,
            'status' => $fee->status,
            'structure' => [
                'name' => $fee->feeStructure->name,
                'description' => $fee->feeStructure->description,
            ],
            'payments' => $fee->payments()->latest()->get()->map(function ($payment) {
                return [
                    'id' => $payment->id,
                    'amount' => $payment->amount_paid,
                    'date' => $payment->payment_date->format('Y-m-d H:i'),
                    'method' => $payment->payment_method,
                    'gateway' => $payment->gateway,
                    'status' => $payment->status,
                    'receipt' => $payment->receipt_number,
                ];
            })
        ]);
    }
}
