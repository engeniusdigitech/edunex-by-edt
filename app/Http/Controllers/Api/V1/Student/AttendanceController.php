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

        // Calculate overall cumulative summary (all-time)
        $allAttendances = Attendance::where('student_id', $student->id)->get();
        $allPresent = $allAttendances->where('status', 'present')->count();
        $allAbsent = $allAttendances->where('status', 'absent')->count();
        $allLate = $allAttendances->where('status', 'late')->count();
        $allHalfDay = $allAttendances->where('status', 'half_day')->count();
        $allTotal = $allAttendances->count();

        // Calculate monthly summary
        $present = $attendances->where('status', 'present')->count();
        $absent = $attendances->where('status', 'absent')->count();
        $late = $attendances->where('status', 'late')->count();
        $half_day = $attendances->where('status', 'half_day')->count();
        $total = $attendances->count();

        return response()->json([
            'summary' => [
                'total' => $allTotal,
                'present' => $allPresent,
                'presents' => $allPresent,
                'absent' => $allAbsent,
                'absents' => $allAbsent,
                'late' => $allLate,
                'half_day' => $allHalfDay,
                'leaves' => $allLate + $allHalfDay,
                'percentage' => $allTotal > 0 ? round((($allPresent + ($allHalfDay * 0.5)) / $allTotal) * 100, 2) : 0,
            ],
            'monthly_summary' => [
                'total' => $total,
                'present' => $present,
                'presents' => $present,
                'absent' => $absent,
                'absents' => $absent,
                'late' => $late,
                'half_day' => $half_day,
                'leaves' => $late + $half_day,
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
