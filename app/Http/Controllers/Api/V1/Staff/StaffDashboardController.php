<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function index(Request $request)
    {
        $stats = [];
        if (class_exists(\App\Models\Student::class)) {
            $stats['total_students'] = \App\Models\Student::count();
        }
        if (class_exists(\App\Models\Attendance::class)) {
            $stats['present_today'] = \App\Models\Attendance::whereDate('date', today())->where('status', 'present')->count();
        }
        if (class_exists(\App\Models\LeaveRequest::class)) {
            $stats['pending_leaves'] = \App\Models\LeaveRequest::where('status', 'pending')->count();
        }
        return response()->json(['stats' => $stats]);
    }
}
