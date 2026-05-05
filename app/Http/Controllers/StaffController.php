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
    public function index(Request $request)
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->get();
        $roleIds = $roles->pluck('id');
        
        $query = User::whereIn('role_id', $roleIds)
                    ->where('id', '!=', auth()->id());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        $staffMembers = $query->latest()->paginate(15);

        return view('staff.index', compact('staffMembers', 'roles'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->get();
        // Get active batches with their active subjects
        $batches = Batch::with(['subjects' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->get();
        
        // Get batches that don't have a class teacher currently
        $unassignedBatches = Batch::whereNull('class_teacher_id')->where('is_active', 1)->get();
        
        return view('staff.create', compact('roles', 'batches', 'unassignedBatches'));
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
            'class_teacher_batches' => 'nullable|array',
            'class_teacher_batches.*' => 'exists:batches,id',
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

        // Handle Class Teacher Assignment
        if ($request->has('class_teacher_batches')) {
            Batch::whereIn('id', $request->class_teacher_batches)->update(['class_teacher_id' => $staff->id]);
        }

        return redirect()->route('staff.index')->with('success', 'Staff member created successfully.');
    }

    public function edit(User $staff)
    {
        $roles = Role::whereIn('name', ['Teacher', 'Receptionist'])->get();
        // Get active batches with their active subjects for the hierarchical UI
        $batches = Batch::with(['subjects' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->get();
        
        // Get batches that are either unassigned or assigned to this staff
        $unassignedBatches = Batch::where(function($q) use ($staff) {
            $q->whereNull('class_teacher_id')->orWhere('class_teacher_id', $staff->id);
        })->where('is_active', 1)->get();
        
        return view('staff.edit', compact('staff', 'roles', 'batches', 'unassignedBatches'));
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
            'class_teacher_batches' => 'nullable|array',
            'class_teacher_batches.*' => 'exists:batches,id',
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

        // Handle Class Teacher Assignment
        // First, clear old assignments for this teacher
        Batch::where('class_teacher_id', $staff->id)->update(['class_teacher_id' => null]);
        
        // Then assign new ones
        if ($request->has('class_teacher_batches')) {
            Batch::whereIn('id', $request->class_teacher_batches)->update(['class_teacher_id' => $staff->id]);
        }

        return redirect()->route('staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(User $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff member removed successfully.');
    }
}
