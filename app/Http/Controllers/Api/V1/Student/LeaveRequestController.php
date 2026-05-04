<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveRequestController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        $leaves = LeaveRequest::where('student_id', $student->id)
            ->latest()
            ->get();

        return response()->json([
            'leaves' => $leaves->map(function ($leave) {
                return [
                    'id' => $leave->id,
                    'type' => $leave->type,
                    'start_date' => $leave->start_date ? $leave->start_date->format('Y-m-d') : null,
                    'end_date' => $leave->end_date ? $leave->end_date->format('Y-m-d') : null,
                    'reason' => $leave->reason,
                    'status' => $leave->status,
                    'rejection_reason' => $leave->rejection_reason,
                    'created_at' => $leave->created_at->format('Y-m-d H:i:s'),
                ];
            })
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student = $request->user();

        $leave = LeaveRequest::create([
            'institute_id' => $student->institute_id,
            'student_id' => $student->id,
            // 'user_id' is nullable, typically used when a staff applies
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Leave request submitted successfully.',
            'leave' => [
                'id' => $leave->id,
                'type' => $leave->type,
                'start_date' => $leave->start_date->format('Y-m-d'),
                'end_date' => $leave->end_date->format('Y-m-d'),
                'status' => $leave->status,
            ]
        ], 201);
    }
}
