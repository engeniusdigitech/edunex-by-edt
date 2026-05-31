<?php

namespace App\Http\Controllers;

use App\Models\DisciplineRecord;
use App\Models\Student;
use Illuminate\Http\Request;

class DisciplineRecordController extends Controller
{
    public function index()
    {
        $instituteId = auth()->user()->institute_id;
        $records = DisciplineRecord::where('institute_id', $instituteId)
            ->with(['student', 'reporter'])
            ->latest()
            ->paginate(20);
            
        $students = Student::where('institute_id', $instituteId)
            ->where('is_active', true)
            ->get();

        return view('discipline.index', compact('records', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'issue_level' => 'required|in:small,mid,big',
            'reason' => 'required|string|max:1000',
        ]);

        $points = 0;
        switch ($request->issue_level) {
            case 'small': $points = 1; break;
            case 'mid': $points = 3; break;
            case 'big': $points = 5; break;
        }

        DisciplineRecord::create([
            'institute_id' => auth()->user()->institute_id,
            'student_id' => $request->student_id,
            'issue_level' => $request->issue_level,
            'points_deducted' => $points,
            'reason' => $request->reason,
            'reported_by' => auth()->id(),
        ]);

        return back()->with('success', "Discipline record logged successfully (-{$points} points).");
    }
}
