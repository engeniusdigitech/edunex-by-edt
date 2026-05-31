<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();

        // Stats
        $totalClasses = $student->attendances()->count();
        $presentClasses = $student->attendances()->whereIn('status', ['present', 'late'])->count();
        $attendancePercentage = $totalClasses > 0 ? round(($presentClasses / $totalClasses) * 100) : 0;
        
        $absentClasses = $student->attendances()->where('status', 'absent')->count();
        $lateClasses = $student->attendances()->where('status', 'late')->count();

        // History
        $attendances = $student->attendances()
            ->orderBy('date', 'desc')
            ->paginate(30);

        return view('student.attendance.index', compact(
            'totalClasses', 'presentClasses', 'attendancePercentage', 
            'absentClasses', 'lateClasses', 'attendances'
        ));
    }
}
