<?php

namespace App\Http\Controllers;

use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function index()
    {
        $categories = FeeCategory::latest()->paginate(10);
        return view('payments.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        FeeCategory::create($validated);

        return redirect()->back()->with('success', 'Fee Category created successfully.');
    }

    public function update(Request $request, FeeCategory $feeCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $feeCategory->update($validated);

        return redirect()->back()->with('success', 'Fee Category updated successfully.');
    }

    public function destroy(FeeCategory $feeCategory)
    {
        $feeCategory->delete();
        return redirect()->back()->with('success', 'Fee Category deleted successfully.');
    }
}
