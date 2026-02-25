<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->get();
        return view('superadmin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('superadmin.plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Plan::create($validated);
        return redirect()->route('superadmin.plans.index')->with('success', 'Plan created successfully.');
    }
}
