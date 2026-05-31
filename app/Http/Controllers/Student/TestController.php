<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();

        $upcomingTests = \App\Models\Test::with('subject')
            ->where('batch_id', $student->batch_id)
            ->where('test_date', '>=', now()->startOfDay())
            ->orderBy('test_date', 'asc')
            ->get();

        $pastTests = \App\Models\Test::with('subject')
            ->where('batch_id', $student->batch_id)
            ->where('test_date', '<', now()->startOfDay())
            ->with(['scores' => function ($query) use ($student) {
                $query->where('student_id', $student->id);
            }])
            ->orderBy('test_date', 'desc')
            ->paginate(10);

        return view('student.tests.index', compact('upcomingTests', 'pastTests'));
    }
}
