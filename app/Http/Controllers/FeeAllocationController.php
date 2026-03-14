<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\FeeStructure;
use App\Models\StudentFee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeAllocationController extends Controller
{
    /**
     * Show the form for creating a new fee allocation.
     */
    public function create()
    {
        $batches = Batch::where('is_active', true)->get();
        $feeStructures = FeeStructure::with('category')->latest()->get();

        return view('payments.allocations.create', compact('batches', 'feeStructures'));
    }

    /**
     * Store a newly created fee allocation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'fee_structure_id' => 'required|exists:fee_structures,id',
        ]);

        $batch = Batch::findOrFail($request->batch_id);
        $feeStructure = FeeStructure::findOrFail($request->fee_structure_id);

        $students = Student::where('batch_id', $batch->id)->get();

        if ($students->isEmpty()) {
            return back()->with('error', 'No students found in the selected batch.');
        }

        $allocatedCount = 0;
        $skippedCount = 0;

        DB::transaction(function () use ($students, $feeStructure, &$allocatedCount, &$skippedCount) {
            foreach ($students as $student) {
                // Check if fee is already allocated
                $exists = StudentFee::where('student_id', $student->id)
                    ->where('fee_structure_id', $feeStructure->id)
                    ->exists();

                if (!$exists) {
                    StudentFee::create([
                        'student_id' => $student->id,
                        'fee_structure_id' => $feeStructure->id,
                        'amount' => $feeStructure->total_amount,
                        'paid_amount' => 0,
                        'due_amount' => $feeStructure->total_amount,
                        'status' => 'unpaid',
                    ]);
                    $allocatedCount++;
                } else {
                    $skippedCount++;
                }
            }
        });

        $message = "Fee allocation completed. {$allocatedCount} students assigned.";
        if ($skippedCount > 0) {
            $message .= " {$skippedCount} students already had this fee assigned and were skipped.";
        }

        return redirect()->route('payments.index')->with('success', $message);
    }
}
