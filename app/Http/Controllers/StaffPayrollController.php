<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\StaffAttendance;
use App\Models\StaffPayroll;
use App\Models\StaffSalary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffPayrollController extends Controller
{
    public function index(Request $request)
    {
        $month = (int) ($request->input('month', now()->month));
        $year = (int) ($request->input('year', now()->year));

        $payrolls = StaffPayroll::with('user')
            ->where('month', $month)
            ->where('year', $year)
            ->orderByDesc('created_at')
            ->get();

        return view('staff_payroll.payrolls.index', compact('payrolls', 'month', 'year'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020|max:2100',
        ]);

        $month = (int) $validated['month'];
        $year = (int) $validated['year'];
        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();
        $workingDays = $start->daysInMonth;

        $staffRoleIds = Role::whereIn('name', ['Teacher', 'Receptionist', 'Principal'])->pluck('id');
        $staffMembers = User::whereIn('role_id', $staffRoleIds)->get();
        $generated = 0;

        foreach ($staffMembers as $staff) {
            $salary = StaffSalary::where('user_id', $staff->id)->where('is_active', true)->first();
            if (!$salary) {
                continue;
            }

            $presentDays = StaffAttendance::where('user_id', $staff->id)
                ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
                ->whereIn('status', ['present', 'half_day'])
                ->whereNotNull('mark_in_at')
                ->count();

            $gross = (float) $salary->gross_monthly;
            $deductions = (float) $salary->deductions;
            $proRatedGross = $workingDays > 0 ? ($gross / $workingDays) * $presentDays : 0;
            $proRatedDeductions = $workingDays > 0 ? ($deductions / $workingDays) * $presentDays : 0;
            $net = max(0, $proRatedGross - $proRatedDeductions);

            StaffPayroll::updateOrCreate(
                ['user_id' => $staff->id, 'month' => $month, 'year' => $year],
                [
                    'basic_salary' => $salary->basic_salary,
                    'hra' => $salary->hra,
                    'allowances' => $salary->allowances,
                    'deductions' => $proRatedDeductions,
                    'gross_salary' => round($proRatedGross, 2),
                    'net_salary' => round($net, 2),
                    'present_days' => $presentDays,
                    'working_days' => $workingDays,
                    'status' => 'processed',
                    'generated_by' => Auth::id(),
                ]
            );
            $generated++;
        }

        return redirect()->route('staff-payrolls.index', ['month' => $month, 'year' => $year])
            ->with('success', "Payroll generated for {$generated} staff member(s).");
    }

    public function updateStatus(Request $request, StaffPayroll $staffPayroll)
    {
        $validated = $request->validate([
            'status' => 'required|in:draft,processed,paid',
            'paid_at' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $staffPayroll->update([
            'status' => $validated['status'],
            'paid_at' => $validated['status'] === 'paid' ? ($validated['paid_at'] ?? now()->toDateString()) : null,
            'notes' => $validated['notes'] ?? $staffPayroll->notes,
        ]);

        return back()->with('success', 'Payroll status updated.');
    }
}
