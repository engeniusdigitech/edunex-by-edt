<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();

        $activeHomeworks = \App\Models\Homework::with(['subject', 'attachments'])
            ->where('batch_id', $student->batch_id)
            ->where('due_date', '>=', now()->startOfDay())
            ->orderBy('due_date', 'asc')
            ->get();

        $pastHomeworks = \App\Models\Homework::with(['subject', 'attachments'])
            ->where('batch_id', $student->batch_id)
            ->where('due_date', '<', now()->startOfDay())
            ->orderBy('due_date', 'desc')
            ->paginate(10);

        return view('student.homework.index', compact('activeHomeworks', 'pastHomeworks'));
    }
}
