<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstituteController extends Controller
{
    public function dashboard()
    {
        $totalInstitutes = Institute::count();
        $activeSubscriptions = Subscription::where('status', 'active')->where('ends_at', '>', now())->count();

        return view('superadmin.dashboard', compact('totalInstitutes', 'activeSubscriptions'));
    }

    public function index()
    {
        $institutes = Institute::with('subscriptions')->latest()->paginate(10);
        return view('superadmin.institutes.index', compact('institutes'));
    }

    public function create()
    {
        return view('superadmin.institutes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_email' => 'required|email|unique:institutes',
            'phone' => 'nullable|string',
            'subdomain' => 'nullable|string|unique:institutes',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8|confirmed',
        ]);

        if (empty($validated['subdomain'])) {
            $validated['subdomain'] = Str::slug($validated['name']);
        }

        DB::beginTransaction();
        try {
            $institute = Institute::create([
                'name' => $validated['name'],
                'contact_email' => $validated['contact_email'],
                'phone' => $validated['phone'],
                'subdomain' => $validated['subdomain'],
            ]);

            $instituteAdminRole = Role::where('name', 'Institute Admin')->firstOrFail();

            User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['admin_password']),
                'role_id' => $instituteAdminRole->id,
                'institute_id' => $institute->id,
            ]);

            DB::commit();

            return redirect()->route('superadmin.institutes.index')->with('success', 'Institute and Admin account created successfully.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to create institute: ' . $e->getMessage());
        }
    }

// Edit, Update omitted for brevity, but easily added.
}
