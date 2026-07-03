<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        // Fetch assignments from the homework/assignment table
        // Adjust model/table name to match your existing schema
        $assignments = [];
        if (class_exists(\App\Models\Assignment::class)) {
            $assignments = \App\Models\Assignment::with('subject')
                ->where(function ($q) use ($student) {
                    $q->where('student_id', $student->id)
                      ->orWhere('batch_id', $student->batch_id);
                })
                ->latest()
                ->get()
                ->map(function ($a) {
                    return [
                        'id' => $a->id,
                        'title' => $a->title,
                        'description' => $a->description ?? null,
                        'subject' => $a->subject?->name ?? $a->subject_name ?? '',
                        'due_date' => optional($a->due_date)->format('Y-m-d'),
                        'status' => $a->pivot?->status ?? $a->status ?? 'pending',
                        'obtained_marks' => $a->pivot?->obtained_marks ?? $a->obtained_marks ?? null,
                        'total_marks' => $a->total_marks ?? null,
                        'attachment_url' => $a->attachment_url ?? null,
                    ];
                });
        }

        return response()->json(['assignments' => $assignments]);
    }

    public function submit(Request $request, $assignment)
    {
        $request->validate(['file' => 'required|file|max:10240']);

        $path = $request->file('file')->store('assignments', 'public');

        // Record submission — adjust to your model
        if (class_exists(\App\Models\Assignment::class)) {
            $record = \App\Models\Assignment::findOrFail($assignment);
            // Create submission record if you have one, otherwise just return success
        }

        return response()->json([
            'message' => 'Assignment submitted successfully',
            'url' => Storage::url($path),
        ]);
    }
}
