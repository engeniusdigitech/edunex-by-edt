<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\LeaveRequest;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = LeaveRequest::where('student_id', auth('student')->id())
            ->latest()
            ->paginate(15);
            
        return view('student.leaves.index', compact('leaves'));
    }

    public function create()
    {
        return view('student.leaves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        LeaveRequest::create([
            'institute_id' => auth('student')->user()->institute_id,
            'student_id' => auth('student')->id(),
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('student.leaves.index')->with('success', 'Leave request submitted successfully.');
    }
}
