<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Subscription;
use Illuminate\Http\Request;
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
        ]);

        if (empty($validated['subdomain'])) {
            $validated['subdomain'] = Str::slug($validated['name']);
        }

        Institute::create($validated);
        return redirect()->route('superadmin.institutes.index')->with('success', 'Institute created successfully.');
    }

// Edit, Update omitted for brevity, but easily added.
}
