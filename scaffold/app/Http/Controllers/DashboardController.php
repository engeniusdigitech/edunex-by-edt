<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Batch;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data scoped automatically to the current institute by TenantScope
        $totalStudents = Student::count();
        $activeBatches = Batch::where('is_active', true)->count();
        $monthlyRevenue = Payment::where('status', 'success')
            ->whereMonth('payment_date', now()->month)
            ->sum('amount_paid');

        // Chart Data Example
        $revenueData = Payment::selectRaw('DATE(payment_date) as date, SUM(amount_paid) as total')
            ->where('status', 'success')
            ->whereMonth('payment_date', now()->month)
            ->groupBy('date')
            ->pluck('total', 'date');

        return view('dashboard', compact('totalStudents', 'activeBatches', 'monthlyRevenue', 'revenueData'));
    }
}
