<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\Student $student */
        $student = auth('student')->user()->load('batch', 'institute');

        $totalClasses = $student->attendances()->count();
        $presentClasses = $student->attendances()->where('status', 'present')->count();
        $lateClasses = $student->attendances()->where('status', 'late')->count();
        $absentClasses = $student->attendances()->where('status', 'absent')->count();
        $attendancePercentage = $totalClasses > 0 ? round((($presentClasses + $lateClasses) / $totalClasses) * 100) : 0;

        $recentPayments = $student->payments()->latest()->take(5)->get();

        // Recent leaves
        $recentLeaves = LeaveRequest::where('student_id', $student->id)->latest()->take(5)->get();

        // Monthly attendance breakdown (last 6 months)
        $monthlyAttendance = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyAttendance[] = [
                'label'   => $month->format('M'),
                'present' => $student->attendances()->whereYear('date', $month->year)->whereMonth('date', $month->month)->whereIn('status', ['present', 'late'])->count(),
                'absent'  => $student->attendances()->whereYear('date', $month->year)->whereMonth('date', $month->month)->where('status', 'absent')->count(),
            ];
        }

        // Academics Data
        $activeHomeworks = \App\Models\Homework::with('attachments')
            ->where('batch_id', $student->batch_id)
            ->where('due_date', '>=', now()->startOfDay())
            ->orderBy('due_date', 'asc')
            ->get();

        $upcomingTests = \App\Models\Test::where('batch_id', $student->batch_id)
            ->where('test_date', '>=', now()->startOfDay())
            ->orderBy('test_date', 'asc')
            ->get();

        $pastTests = \App\Models\Test::where('batch_id', $student->batch_id)
            ->where('test_date', '<', now()->startOfDay())
            ->with(['scores' => function ($query) use ($student) {
            $query->where('student_id', $student->id);
        }])
            ->orderBy('test_date', 'desc')
            ->take(3)
            ->get();

        // Calculate fees
        $studentFees = \App\Models\StudentFee::where('student_id', $student->id)->get();
        $totalFees = $studentFees->sum('amount');
        $paidFees = $studentFees->sum('paid_amount');
        $balanceFees = $studentFees->sum('due_amount');

        return view('student.dashboard', compact(
            'student', 'attendancePercentage', 'presentClasses', 'totalClasses',
            'absentClasses', 'lateClasses', 'recentLeaves', 'monthlyAttendance',
            'recentPayments', 'activeHomeworks', 'upcomingTests', 'pastTests',
            'totalFees', 'paidFees', 'balanceFees'
        ));
    }

    public function notifications()
    {
        $student = auth()->guard('student')->user();
        return view('student.notifications', compact('student'));
    }

    public function markAsRead($id)
    {
        /** @var \App\Models\Student $student */
        $student = auth('student')->user();

        $notification = $student->notifications()->findOrFail($id);
        $notification->markAsRead();

        return back();
    }
}
