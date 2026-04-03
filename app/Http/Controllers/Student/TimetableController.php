<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TimetableSlot;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();
        if (!$student || !$student->batch_id) {
            return back()->with('error', 'Batch not assigned.');
        }

        $slots = TimetableSlot::where('batch_id', $student->batch_id)
            ->with(['subject', 'teacher'])
            ->get()
            ->groupBy('day');

        return view('student.timetable', compact('slots'));
    }
}
