<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveApprovalController extends Controller
{
    public function index(Request $request)
    {
        $leaves = collect();
        if (class_exists(\App\Models\LeaveRequest::class)) {
            $leaves = \App\Models\LeaveRequest::with('student')
                ->where('status', $request->query('status', 'pending'))
                ->latest()
                ->get()
                ->map(fn($l) => [
                    'id' => $l->id,
                    'student_name' => $l->student?->name ?? '',
                    'from_date' => optional($l->from_date)->format('Y-m-d'),
                    'to_date' => optional($l->to_date)->format('Y-m-d'),
                    'reason' => $l->reason,
                    'status' => $l->status,
                    'type' => $l->type ?? null,
                ])->values();
        }
        return response()->json(['leaves' => $leaves]);
    }

    public function approve(Request $request, $leave)
    {
        if (class_exists(\App\Models\LeaveRequest::class)) {
            \App\Models\LeaveRequest::findOrFail($leave)->update([
                'status' => 'approved',
                'remark' => $request->remark ?? null,
                'approved_by' => $request->user()->id,
            ]);
        }
        return response()->json(['message' => 'Leave approved']);
    }

    public function reject(Request $request, $leave)
    {
        if (class_exists(\App\Models\LeaveRequest::class)) {
            \App\Models\LeaveRequest::findOrFail($leave)->update([
                'status' => 'rejected',
                'remark' => $request->remark ?? null,
                'approved_by' => $request->user()->id,
            ]);
        }
        return response()->json(['message' => 'Leave rejected']);
    }
}
