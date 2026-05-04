<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        $tests = Test::where('batch_id', $student->batch_id)
            ->with(['subject', 'attachments', 'scores' => function($q) use ($student) {
                $q->where('student_id', $student->id);
            }])
            ->latest('test_date')
            ->get();

        return response()->json([
            'tests' => $tests->map(function ($test) {
                $score = $test->scores->first();
                return [
                    'id' => $test->id,
                    'title' => $test->title,
                    'description' => $test->description,
                    'subject' => $test->subject ? $test->subject->name : null,
                    'date' => $test->test_date ? $test->test_date->format('Y-m-d') : null,
                    'total_marks' => $test->total_marks,
                    'status' => $test->test_date->isPast() ? 'completed' : 'upcoming',
                    'obtained_marks' => $score ? $score->score : null,
                    'remarks' => $score ? $score->remarks : null,
                    'attachments' => $test->attachments->map(function ($att) {
                        return [
                            'id' => $att->id,
                            'name' => $att->original_name,
                            'url' => asset('storage/' . $att->file_path),
                        ];
                    }),
                ];
            })
        ]);
    }
}
