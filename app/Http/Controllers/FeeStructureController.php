<?php

namespace App\Http\Controllers;

use App\Models\FeeStructure;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index()
    {
        $structures = FeeStructure::with('category')->latest()->paginate(10);
        $categories = FeeCategory::all();
        return view('payments.structures.index', compact('structures', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fee_category_id' => 'required|exists:fee_categories,id',
            'name' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        FeeStructure::create($validated);

        return redirect()->back()->with('success', 'Fee Structure created successfully.');
    }

    public function update(Request $request, FeeStructure $feeStructure)
    {
        $validated = $request->validate([
            'fee_category_id' => 'required|exists:fee_categories,id',
            'name' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $feeStructure->update($validated);

        return redirect()->back()->with('success', 'Fee Structure updated successfully.');
    }

    public function destroy(FeeStructure $feeStructure)
    {
        $feeStructure->delete();
        return redirect()->back()->with('success', 'Fee Structure deleted successfully.');
    }
}
