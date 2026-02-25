<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\Student $student */
        $student = auth('student')->user()->load('batch', 'institute');

        $totalClasses = $student->attendances()->count();
        $presentClasses = $student->attendances()->where('status', 'present')->count();
        $attendancePercentage = $totalClasses > 0 ? round(($presentClasses / $totalClasses) * 100) : 0;

        $recentPayments = $student->payments()->latest()->take(5)->get();

        // Academics Data
        $activeHomeworks = \App\Models\Homework::where('batch_id', $student->batch_id)
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

        return view('student.dashboard', compact('student', 'attendancePercentage', 'totalClasses', 'presentClasses', 'recentPayments', 'activeHomeworks', 'upcomingTests', 'pastTests'));
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
