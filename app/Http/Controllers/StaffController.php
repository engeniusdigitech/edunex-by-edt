<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Batch;
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
        $subjects = Subject::where('is_active', 1)->get();
        $batches = Batch::where('is_active', 1)->get();
        return view('staff.create', compact('roles', 'subjects', 'batches'));
    }

    public function store(Request $request)
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->pluck('id')->toArray();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => ['required', Rule::in($roles)],
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
            'batches' => 'nullable|array',
            'batches.*' => 'exists:batches,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // TenantScope automatically injects institute_id via BelongsToInstitute trait!
        $staff = User::create($validated);

        if ($request->has('subjects')) {
            $staff->subjects()->sync($request->subjects);
        }

        if ($request->has('batches')) {
            $staff->batches()->sync($request->batches);
        }

        return redirect()->route('staff.index')->with('success', 'Staff member created successfully.');
    }

    public function edit(User $staff)
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->get();
        $subjects = Subject::where('is_active', 1)->get();
        $batches = Batch::where('is_active', 1)->get();
        return view('staff.edit', compact('staff', 'roles', 'subjects', 'batches'));
    }

    public function update(Request $request, User $staff)
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->pluck('id')->toArray();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($staff->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => ['required', Rule::in($roles)],
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
            'batches' => 'nullable|array',
            'batches.*' => 'exists:batches,id',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        else {
            unset($validated['password']);
        }

        $staff->update($validated);

        // Sync subjects and batches (will detach all if none are selected)
        $staff->subjects()->sync($request->input('subjects', []));
        $staff->batches()->sync($request->input('batches', []));

        return redirect()->route('staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff member removed successfully.');
    }
}
