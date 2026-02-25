<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index()
    {
        // Only get users who are in the Teacher or Receptionist roles
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->pluck('id');
        $staffMembers = User::whereIn('role_id', $roles)->latest()->paginate(10);
        return view('staff.index', compact('staffMembers'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->get();
        return view('staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->pluck('id')->toArray();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => ['required', Rule::in($roles)],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // TenantScope automatically injects institute_id via BelongsToInstitute trait!
        User::create($validated);

        return redirect()->route('staff.index')->with('success', 'Staff member created successfully.');
    }

    public function edit(User $staff)
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->get();
        return view('staff.edit', compact('staff', 'roles'));
    }

    public function update(Request $request, User $staff)
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->pluck('id')->toArray();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($staff->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => ['required', Rule::in($roles)],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        else {
            unset($validated['password']);
        }

        $staff->update($validated);

        return redirect()->route('staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff member removed successfully.');
    }
}
