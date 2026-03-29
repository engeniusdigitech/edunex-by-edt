<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Batch;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user && $user->isTeacher()) {
            return $this->teacherDashboard($user);
        }

        if ($user && $user->isPrincipal()) {
            return $this->principalDashboard($user);
        }

        if ($user && $user->isReceptionist()) {
            return $this->receptionistDashboard($user);
        }

        // ── STAT CARDS ──
        $totalStudents = Student::count();
        $activeBatches = Batch::where('is_active', true)->count();
        $monthlyRevenue = Payment::where('status', 'success')
            ->whereMonth('payment_date', now()->month)
            ->sum('amount_paid');

        $staffRoleIds = \App\Models\Role::whereIn('name', ['Teacher', 'Receptionist'])->pluck('id');
        $totalStaff = \App\Models\User::whereIn('role_id', $staffRoleIds)->count();

        // Active homework due today or later
        $activeHomework = \App\Models\Homework::where('due_date', '>=', now()->startOfDay())->count();

        // Upcoming tests (today or later)
        $upcomingTests = \App\Models\Test::where('test_date', '>=', now()->startOfDay())->count();

        // Today's attendance
        $todayTotal = Attendance::whereDate('date', today())->count();
        $todayPresent = Attendance::whereDate('date', today())->whereIn('status', ['present', 'late'])->count();
        $todayAttendancePct = $todayTotal > 0 ? round(($todayPresent / $todayTotal) * 100) : null;

        // ── REVENUE CHART: last 6 months ──
        $revenueData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $total = Payment::where('status', 'success')
                ->whereYear('payment_date', $month->year)
                ->whereMonth('payment_date', $month->month)
                ->sum('amount_paid');
            $revenueData[$month->format('M Y')] = $total;
        }

        // ── STUDENTS PER BATCH (donut) ──
        $studentsPerBatch = Batch::withCount('students')
            ->where('is_active', true)
            ->get()
            ->pluck('students_count', 'name');

        // ── ATTENDANCE TREND: last 7 days ──
        $attendanceTrend = collect();
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i);
            $total = Attendance::whereDate('date', $day->toDateString())->count();
            $present = Attendance::whereDate('date', $day->toDateString())->whereIn('status', ['present', 'late'])->count();
            $attendanceTrend[$day->format('D d')] = $total > 0 ? round($present / $total * 100) : 0;
        }

        // ── RECENT PAYMENTS ──
        $recentPayments = Payment::with('student')
            ->where('status', 'success')
            ->latest('payment_date')
            ->take(6)
            ->get();

        // ── NEEDS ATTENTION ──
        $noAttendanceToday = Student::where('is_active', true)
            ->whereDoesntHave('attendances', fn($q) => $q->whereDate('date', today()))
            ->count();

        return view('dashboard', compact(
            'totalStudents',
            'activeBatches',
            'monthlyRevenue',
            'totalStaff',
            'activeHomework',
            'upcomingTests',
            'todayAttendancePct',
            'todayTotal',
            'todayPresent',
            'revenueData',
            'studentsPerBatch',
            'attendanceTrend',
            'recentPayments',
            'noAttendanceToday'
        ));
    }
    private function teacherDashboard($user)
    {
        $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id');
        $activeBatches = $batchIds->count();
        $totalStudents = Student::whereIn('batch_id', $batchIds)->count();

        $activeHomework = \App\Models\Homework::whereIn('batch_id', $batchIds)
            ->where('due_date', '>=', now()->startOfDay())
            ->count();

        $upcomingTests = \App\Models\Test::whereIn('batch_id', $batchIds)
            ->where('test_date', '>=', now()->startOfDay())
            ->count();

        $todayTotal = Attendance::whereIn('student_id', function ($q) use ($batchIds) {
            $q->select('id')->from('students')->whereIn('batch_id', $batchIds);
        })->whereDate('date', today())->count();

        $todayPresent = Attendance::whereIn('student_id', function ($q) use ($batchIds) {
            $q->select('id')->from('students')->whereIn('batch_id', $batchIds);
        })->whereDate('date', today())->whereIn('status', ['present', 'late'])->count();

        $todayAttendancePct = $todayTotal > 0 ? round(($todayPresent / $todayTotal) * 100) : null;

        $studentsPerBatch = \App\Models\Batch::whereIn('id', $batchIds)
            ->withCount('students')
            ->get()
            ->pluck('students_count', 'name');

        $attendanceTrend = collect();
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i);
            $total = Attendance::whereIn('student_id', function ($q) use ($batchIds) {
                $q->select('id')->from('students')->whereIn('batch_id', $batchIds);
            })->whereDate('date', $day->toDateString())->count();

            $present = Attendance::whereIn('student_id', function ($q) use ($batchIds) {
                $q->select('id')->from('students')->whereIn('batch_id', $batchIds);
            })->whereDate('date', $day->toDateString())->whereIn('status', ['present', 'late'])->count();

            $attendanceTrend[$day->format('D d')] = $total > 0 ? round($present / $total * 100) : 0;
        }

        $noAttendanceToday = Student::whereIn('batch_id', $batchIds)
            ->where('is_active', true)
            ->whereDoesntHave('attendances', fn($q) => $q->whereDate('date', today()))
            ->count();

        return view('teacher.dashboard', compact(
            'totalStudents',
            'activeBatches',
            'activeHomework',
            'upcomingTests',
            'todayAttendancePct',
            'todayTotal',
            'todayPresent',
            'studentsPerBatch',
            'attendanceTrend',
            'noAttendanceToday'
        ));
    }

    private function principalDashboard($user)
    {
        // Principals see everything EXCEPT financial data
        $totalStudents = Student::count();
        $activeBatches = Batch::where('is_active', true)->count();
        
        $staffRoleIds = \App\Models\Role::whereIn('name', ['Teacher', 'Receptionist'])->pluck('id');
        $totalStaff = \App\Models\User::whereIn('role_id', $staffRoleIds)->count();

        $activeHomework = \App\Models\Homework::where('due_date', '>=', now()->startOfDay())->count();
        $upcomingTests = \App\Models\Test::where('test_date', '>=', now()->startOfDay())->count();

        $todayTotal = Attendance::whereDate('date', today())->count();
        $todayPresent = Attendance::whereDate('date', today())->whereIn('status', ['present', 'late'])->count();
        $todayAttendancePct = $todayTotal > 0 ? round(($todayPresent / $todayTotal) * 100) : null;

        $studentsPerBatch = Batch::withCount('students')
            ->where('is_active', true)
            ->get()
            ->pluck('students_count', 'name');

        $attendanceTrend = collect();
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i);
            $total = Attendance::whereDate('date', $day->toDateString())->count();
            $present = Attendance::whereDate('date', $day->toDateString())->whereIn('status', ['present', 'late'])->count();
            $attendanceTrend[$day->format('D d')] = $total > 0 ? round($present / $total * 100) : 0;
        }

        $noAttendanceToday = Student::where('is_active', true)
            ->whereDoesntHave('attendances', fn($q) => $q->whereDate('date', today()))
            ->count();

        return view('dashboard', compact(
            'totalStudents',
            'activeBatches',
            'totalStaff',
            'activeHomework',
            'upcomingTests',
            'todayAttendancePct',
            'todayTotal',
            'todayPresent',
            'studentsPerBatch',
            'attendanceTrend',
            'noAttendanceToday'
        ));
    }

    private function receptionistDashboard($user)
    {
        // Receptionists see ONLY financial data and notifications
        $monthlyRevenue = Payment::where('status', 'success')
            ->whereMonth('payment_date', now()->month)
            ->sum('amount_paid');

        $revenueData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $total = Payment::where('status', 'success')
                ->whereYear('payment_date', $month->year)
                ->whereMonth('payment_date', $month->month)
                ->sum('amount_paid');
            $revenueData[$month->format('M Y')] = $total;
        }

        $recentPayments = Payment::with('student')
            ->where('status', 'success')
            ->latest('payment_date')
            ->take(6)
            ->get();

        // Dummy/Null values for non-finance stats to avoid view errors
        $totalStudents = 0;
        $activeBatches = 0;
        $totalStaff = 0;
        $activeHomework = 0;
        $upcomingTests = 0;
        $todayAttendancePct = null;
        $studentsPerBatch = collect();
        $attendanceTrend = collect();
        $noAttendanceToday = 0;

        return view('dashboard', compact(
            'monthlyRevenue',
            'revenueData',
            'recentPayments',
            'totalStudents',
            'activeBatches',
            'totalStaff',
            'activeHomework',
            'upcomingTests',
            'todayAttendancePct',
            'studentsPerBatch',
            'attendanceTrend',
            'noAttendanceToday'
        ));
    }
}
