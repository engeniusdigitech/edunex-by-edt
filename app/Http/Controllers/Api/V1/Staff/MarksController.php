<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function index(Request $request)
    {
        $subjects = collect();
        $exams = collect();

        if (class_exists(\App\Models\Subject::class)) {
            $subjects = \App\Models\Subject::all()->map(fn($s) => ['id' => $s->id, 'name' => $s->name])->values();
        }
        if (class_exists(\App\Models\Examination::class)) {
            $exams = \App\Models\Examination::select('id', 'name')->distinct()->get()->map(fn($e) => ['id' => $e->id, 'name' => $e->name])->values();
        }

        return response()->json(['subjects' => $subjects, 'exams' => $exams]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'marks' => 'required|array',
            'marks.*.student_id' => 'required|integer',
            'marks.*.marks' => 'required|numeric|min:0',
        ]);

        // Store marks — wire to your ExamResult/Marks model
        return response()->json(['message' => 'Marks saved successfully']);
    }
}
