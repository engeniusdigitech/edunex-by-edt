<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        // Get optional month and year, defaults to current month
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));

        $attendances = Attendance::where('student_id', $student->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'desc')
            ->get();

        // Calculate summary for the month
        $present = $attendances->where('status', 'present')->count();
        $absent = $attendances->where('status', 'absent')->count();
        $late = $attendances->where('status', 'late')->count();
        $half_day = $attendances->where('status', 'half_day')->count();
        $total = $attendances->count();

        return response()->json([
            'summary' => [
                'total' => $total,
                'present' => $present,
                'absent' => $absent,
                'late' => $late,
                'half_day' => $half_day,
                'percentage' => $total > 0 ? round((($present + ($half_day * 0.5)) / $total) * 100, 2) : 0,
            ],
            'records' => $attendances->map(function ($att) {
                return [
                    'id' => $att->id,
                    'date' => $att->date->format('Y-m-d'),
                    'status' => $att->status,
                ];
            })->values()
        ]);
    }
}
