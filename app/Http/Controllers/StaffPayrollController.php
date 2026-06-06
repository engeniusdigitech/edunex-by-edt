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

            // 1. Present days
            $presentDays = StaffAttendance::where('user_id', $staff->id)
                ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
                ->whereIn('status', ['present', 'half_day'])
                ->whereNotNull('mark_in_at')
                ->count();

            $yearStart = $start->copy()->startOfYear();
            $yearEnd = $start->copy()->endOfYear();
            $beforeMonthEnd = $start->copy()->subDay();

            $annualApprovedLeaves = \App\Models\LeaveRequest::where('user_id', $staff->id)
                ->where('status', 'approved')
                ->whereIn('type', ['Casual Leave', 'Earned Leave'])
                ->where(function($q) use ($yearStart, $yearEnd) {
                    $q->whereBetween('start_date', [$yearStart->toDateString(), $yearEnd->toDateString()])
                      ->orWhereBetween('end_date', [$yearStart->toDateString(), $yearEnd->toDateString()])
                      ->orWhere(function($qq) use ($yearStart, $yearEnd) {
                          $qq->where('start_date', '<=', $yearStart->toDateString())
                             ->where('end_date', '>=', $yearEnd->toDateString());
                      });
                })->get();

            $clAllowance = (int) $salary->cl_allowance;
            $elAllowance = (int) $salary->el_allowance;

            $totalCLBeforeMonth = 0;
            $totalCLInMonth = 0;
            $totalELBeforeMonth = 0;
            $totalELInMonth = 0;

            foreach ($annualApprovedLeaves as $lr) {
                $lStart = Carbon::parse($lr->start_date);
                $lEnd = Carbon::parse($lr->end_date);

                if ($lr->type === 'Casual Leave') {
                    $totalCLInMonth += $this->getOverlapDays($lStart, $lEnd, $start, $end);
                    $totalCLBeforeMonth += $this->getOverlapDays($lStart, $lEnd, $yearStart, $beforeMonthEnd);
                } elseif ($lr->type === 'Earned Leave') {
                    $totalELInMonth += $this->getOverlapDays($lStart, $lEnd, $start, $end);
                    $totalELBeforeMonth += $this->getOverlapDays($lStart, $lEnd, $yearStart, $beforeMonthEnd);
                }
            }

            $availableCL = max(0, $clAllowance - $totalCLBeforeMonth);
            $paidCLInMonth = min($totalCLInMonth, $availableCL);

            $availableEL = max(0, $elAllowance - $totalELBeforeMonth);
            $paidELInMonth = min($totalELInMonth, $availableEL);

            $paidLeavesCount = $paidCLInMonth + $paidELInMonth;

            $paidDays = $presentDays + $paidLeavesCount;
            if ($paidDays > $workingDays) {
                $paidDays = $workingDays;
            }

            // 3. Salaries calculation
            $basic = (float) $salary->basic_salary;
            $hra = (float) $salary->hra;
            $allowances = (float) $salary->allowances;
            $deductions = (float) $salary->deductions;

            $proRatedBasic = $workingDays > 0 ? ($basic / $workingDays) * $paidDays : 0;
            $proRatedHra = $workingDays > 0 ? ($hra / $workingDays) * $paidDays : 0;
            $proRatedAllowances = $workingDays > 0 ? ($allowances / $workingDays) * $paidDays : 0;
            $proRatedDeductions = $workingDays > 0 ? ($deductions / $workingDays) * $paidDays : 0;

            $proRatedGross = $proRatedBasic + $proRatedHra + $proRatedAllowances;

            // Statutory calculations
            $pfDeduction = $proRatedBasic * ((float) $salary->pf_rate / 100);
            $esicDeduction = $proRatedGross * ((float) $salary->esic_rate / 100);

            // TDS (Tax)
            $projectedAnnualGross = $proRatedGross * 12;
            $annualTax = $this->calculateTds($projectedAnnualGross);
            $tdsDeduction = $annualTax / 12;

            $totalDeductions = $proRatedDeductions + $pfDeduction + $esicDeduction + $tdsDeduction;
            $net = max(0, $proRatedGross - $totalDeductions);

            StaffPayroll::updateOrCreate(
                ['user_id' => $staff->id, 'month' => $month, 'year' => $year],
                [
                    'institute_id' => $staff->institute_id ?? Auth::user()->institute_id,
                    'basic_salary' => $proRatedBasic,
                    'hra' => $proRatedHra,
                    'allowances' => $proRatedAllowances,
                    'deductions' => $proRatedDeductions,
                    'pf_deduction' => $pfDeduction,
                    'esic_deduction' => $esicDeduction,
                    'tds_deduction' => $tdsDeduction,
                    'gross_salary' => round($proRatedGross, 2),
                    'net_salary' => round($net, 2),
                    'present_days' => $presentDays,
                    'working_days' => $workingDays,
                    'paid_leaves_used' => $paidLeavesCount,
                    'status' => 'processed',
                    'generated_by' => Auth::id(),
                ]
            );
            $generated++;
        }

        return redirect()->route('staff-payrolls.index', ['month' => $month, 'year' => $year])
            ->with('success', "Payroll generated for {$generated} staff member(s).");
    }

    private function getOverlapDays(Carbon $r1Start, Carbon $r1End, Carbon $r2Start, Carbon $r2End)
    {
        $s = $r1Start->gt($r2Start) ? $r1Start : $r2Start;
        $e = $r1End->lt($r2End) ? $r1End : $r2End;
        if ($s->gt($e)) {
            return 0;
        }
        return $s->diffInDays($e) + 1;
    }

    private function calculateTds($annualGross)
    {
        if ($annualGross <= 300000) {
            return 0;
        } elseif ($annualGross <= 600000) {
            return ($annualGross - 300000) * 0.05;
        } elseif ($annualGross <= 900000) {
            return 15000 + ($annualGross - 600000) * 0.10;
        } else {
            return 45000 + ($annualGross - 900000) * 0.15;
        }
    }

    public function payslip(StaffPayroll $staffPayroll)
    {
        $staffPayroll->load(['user', 'generatedBy']);
        return view('staff_payroll.payrolls.payslip', compact('staffPayroll'));
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
