<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\StaffSalary;
use App\Models\User;
use Illuminate\Http\Request;

class StaffSalaryController extends Controller
{
    public function index()
    {
        $staffRoleIds = Role::whereIn('name', ['Teacher', 'Receptionist', 'Principal'])->pluck('id');

        $salaries = StaffSalary::with('user')
            ->where('is_active', true)
            ->whereHas('user', fn ($q) => $q->whereIn('role_id', $staffRoleIds))
            ->latest('effective_from')
            ->get();

        $staffWithoutSalary = User::whereIn('role_id', $staffRoleIds)
            ->whereDoesntHave('activeStaffSalary')
            ->orderBy('name')
            ->get();

        return view('staff_payroll.salaries.index', compact('salaries', 'staffWithoutSalary'));
    }

    public function create()
    {
        $staffRoleIds = Role::whereIn('name', ['Teacher', 'Receptionist', 'Principal'])->pluck('id');
        $staffMembers = User::whereIn('role_id', $staffRoleIds)->orderBy('name')->get();

        return view('staff_payroll.salaries.create', compact('staffMembers'));
    }

    public function store(Request $request)
    {
        $staffRoleIds = Role::whereIn('name', ['Teacher', 'Receptionist', 'Principal'])->pluck('id');

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'basic_salary' => 'required|numeric|min:0',
            'hra' => 'nullable|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'pf_rate' => 'nullable|numeric|min:0|max:100',
            'esic_rate' => 'nullable|numeric|min:0|max:100',
            'cl_allowance' => 'nullable|integer|min:0',
            'el_allowance' => 'nullable|integer|min:0',
            'effective_from' => 'required|date',
        ]);

        $user = User::findOrFail($validated['user_id']);
        if (!in_array($user->role_id, $staffRoleIds->toArray())) {
            return back()->withErrors(['user_id' => 'Selected user is not eligible staff.']);
        }

        StaffSalary::where('user_id', $user->id)->where('is_active', true)->update(['is_active' => false]);

        StaffSalary::create([
            'user_id' => $user->id,
            'basic_salary' => $validated['basic_salary'],
            'hra' => $validated['hra'] ?? 0,
            'allowances' => $validated['allowances'] ?? 0,
            'deductions' => $validated['deductions'] ?? 0,
            'pf_rate' => $validated['pf_rate'] ?? 0,
            'esic_rate' => $validated['esic_rate'] ?? 0,
            'cl_allowance' => $validated['cl_allowance'] ?? 0,
            'el_allowance' => $validated['el_allowance'] ?? 0,
            'effective_from' => $validated['effective_from'],
            'is_active' => true,
        ]);

        return redirect()->route('staff-salaries.index')->with('success', 'Salary structure saved for ' . $user->name);
    }

    public function edit(StaffSalary $staffSalary)
    {
        return view('staff_payroll.salaries.edit', compact('staffSalary'));
    }

    public function update(Request $request, StaffSalary $staffSalary)
    {
        $validated = $request->validate([
            'basic_salary' => 'required|numeric|min:0',
            'hra' => 'nullable|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'pf_rate' => 'nullable|numeric|min:0|max:100',
            'esic_rate' => 'nullable|numeric|min:0|max:100',
            'cl_allowance' => 'nullable|integer|min:0',
            'el_allowance' => 'nullable|integer|min:0',
            'effective_from' => 'required|date',
        ]);

        $staffSalary->update([
            'basic_salary' => $validated['basic_salary'],
            'hra' => $validated['hra'] ?? 0,
            'allowances' => $validated['allowances'] ?? 0,
            'deductions' => $validated['deductions'] ?? 0,
            'pf_rate' => $validated['pf_rate'] ?? 0,
            'esic_rate' => $validated['esic_rate'] ?? 0,
            'cl_allowance' => $validated['cl_allowance'] ?? 0,
            'el_allowance' => $validated['el_allowance'] ?? 0,
            'effective_from' => $validated['effective_from'],
        ]);

        return redirect()->route('staff-salaries.index')->with('success', 'Salary updated successfully.');
    }
}
