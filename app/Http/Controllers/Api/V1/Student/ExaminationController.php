<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();
        $upcoming = [];
        $results = [];
        $hallTicket = null;

        // Adjust model names to match your schema
        if (class_exists(\App\Models\Examination::class)) {
            $exams = \App\Models\Examination::with('subject')
                ->where('batch_id', $student->batch_id)
                ->where('date', '>=', now()->toDateString())
                ->orderBy('date')
                ->get();

            $upcoming = $exams->map(fn($e) => [
                'id' => $e->id,
                'subject' => $e->subject?->name ?? $e->subject_name ?? '',
                'date' => optional($e->date)->format('Y-m-d'),
                'time' => $e->start_time ?? null,
                'room' => $e->room ?? null,
                'max_marks' => $e->max_marks ?? null,
            ])->values();
        }

        if (class_exists(\App\Models\ExamResult::class)) {
            $resultGroups = \App\Models\ExamResult::with(['subject', 'examination'])
                ->where('student_id', $student->id)
                ->get()
                ->groupBy('exam_term');

            $results = $resultGroups->map(function ($group, $term) {
                $total = $group->sum('obtained_marks');
                $max = $group->sum('max_marks');
                return [
                    'exam_name' => $group->first()->examination?->name ?? $term ?? 'Exam',
                    'term' => $term,
                    'percentage' => $max > 0 ? round(($total / $max) * 100, 1) : 0,
                    'subjects' => $group->map(fn($r) => [
                        'subject' => $r->subject?->name ?? '',
                        'obtained' => $r->obtained_marks,
                        'max' => $r->max_marks,
                        'grade' => $r->grade ?? null,
                    ])->values(),
                ];
            })->values();
        }

        return response()->json([
            'upcoming' => $upcoming,
            'results' => $results,
            'hall_ticket' => $hallTicket,
        ]);
    }
}
