<?php

namespace App\Http\Controllers;

use App\Models\InventorySupplier;
use Illuminate\Http\Request;

class InventorySupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = InventorySupplier::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('contact_person', 'like', '%' . $request->search . '%');
        }

        $suppliers = $query->latest()->paginate(15);
        return view('inventory-suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone'          => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:150',
            'address'        => 'nullable|string',
        ]);

        InventorySupplier::create($validated);

        return redirect()->route('inventory-suppliers.index')->with('success', 'Supplier registered successfully.');
    }

    public function update(Request $request, InventorySupplier $inventorySupplier)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone'          => 'nullable|string|max:100',
            'email'          => 'nullable|email|max:150',
            'address'        => 'nullable|string',
        ]);

        $inventorySupplier->update($validated);

        return redirect()->route('inventory-suppliers.index')->with('success', 'Supplier details updated successfully.');
    }

    public function destroy(InventorySupplier $inventorySupplier)
    {
        $inventorySupplier->delete();
        return redirect()->route('inventory-suppliers.index')->with('success', 'Supplier removed successfully.');
    }
}
