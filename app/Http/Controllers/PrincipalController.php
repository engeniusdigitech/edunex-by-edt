<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PrincipalController extends Controller
{
    public function index()
    {
        $role = Role::where('name', 'Principal')->firstOrFail();
        $principals = User::where('role_id', $role->id)->latest()->paginate(10);
        return view('principals.index', compact('principals'));
    }

    public function create()
    {
        // Principals usually manage all subjects and batches, but we can still show them
        $batches = Batch::with(['subjects' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->get();
        return view('principals.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $role = Role::where('name', 'Principal')->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
            'batches' => 'nullable|array',
            'batches.*' => 'exists:batches,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role_id'] = $role->id;

        $principal = User::create($validated);

        if ($request->has('subjects')) {
            $principal->subjects()->sync($request->subjects);
        }

        if ($request->has('batches')) {
            $principal->batches()->sync($request->batches);
        }

        return redirect()->route('principals.index')->with('success', 'Principal created successfully.');
    }

    public function edit(User $principal)
    {
        $batches = Batch::with(['subjects' => function ($query) {
            $query->where('is_active', 1);
        }])->where('is_active', 1)->get();
        return view('principals.edit', compact('principal', 'batches'));
    }

    public function update(Request $request, User $principal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($principal->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'subjects' => 'nullable|array',
            'subjects.*' => 'exists:subjects,id',
            'batches' => 'nullable|array',
            'batches.*' => 'exists:batches,id',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $principal->update($validated);

        $principal->subjects()->sync($request->input('subjects', []));
        $principal->batches()->sync($request->input('batches', []));

        return redirect()->route('principals.index')->with('success', 'Principal updated successfully.');
    }

    public function destroy(User $principal)
    {
        $principal->delete();
        return redirect()->route('principals.index')->with('success', 'Principal removed successfully.');
    }
}
