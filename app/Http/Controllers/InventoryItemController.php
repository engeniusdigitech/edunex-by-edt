<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\InventoryCategory;
use App\Models\InventoryStockLog;
use App\Models\InventorySupplier;
use App\Models\PurchaseOrder;
use App\Imports\InventoryItemsImport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class InventoryItemController extends Controller
{
    public function dashboard()
    {
        $totalItems = InventoryItem::count();
        $lowStockCount = InventoryItem::whereRaw('available_qty <= min_qty_warning')->count();
        $totalStockVal = InventoryItem::selectRaw('SUM(available_qty * unit_price) as val')->value('val') ?? 0;
        $totalSuppliers = InventorySupplier::count();

        $poStatusCounts = PurchaseOrder::selectRaw('status, count(*) as cnt')
            ->groupBy('status')
            ->pluck('cnt', 'status');

        $openPoValue = PurchaseOrder::whereIn('status', ['draft', 'sent'])->sum('total_amount');

        $lowStockItems = InventoryItem::with('category')
            ->whereRaw('available_qty <= min_qty_warning')
            ->orderByRaw('available_qty - min_qty_warning ASC')
            ->limit(6)
            ->get();

        $stockMovement = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);
            $stockIn = InventoryStockLog::where('type', 'stock_in')
                ->whereDate('created_at', $date)
                ->sum('quantity');
            $stockOut = InventoryStockLog::where('type', 'stock_out')
                ->whereDate('created_at', $date)
                ->sum('quantity');
            return [
                'label' => $date->format('D'),
                'stock_in' => (int) $stockIn,
                'stock_out' => (int) $stockOut,
            ];
        });
        $maxMovement = max(1, $stockMovement->flatMap(fn ($d) => [$d['stock_in'], $d['stock_out']])->max());

        $recentLogs = InventoryStockLog::with(['item', 'user'])->latest()->limit(8)->get();

        return view('inventory.dashboard', compact(
            'totalItems',
            'lowStockCount',
            'totalStockVal',
            'totalSuppliers',
            'poStatusCounts',
            'openPoValue',
            'lowStockItems',
            'stockMovement',
            'maxMovement',
            'recentLogs'
        ));
    }

    public function index(Request $request)
    {
        $query = InventoryItem::with('category');

        if ($request->filled('category_id')) {
            $query->where('inventory_category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
        }

        if ($request->boolean('low_stock')) {
            $query->whereRaw('available_qty <= min_qty_warning');
        }

        $items = $query->latest()->paginate(15);
        $categories = InventoryCategory::all();

        // Also fetch totals for KPIs
        $totalItems = InventoryItem::count();
        $lowStockCount = InventoryItem::whereRaw('available_qty <= min_qty_warning')->count();
        $totalStockVal = InventoryItem::selectRaw('SUM(available_qty * unit_price) as val')->value('val') ?? 0;

        return view('inventory-items.index', compact('items', 'categories', 'totalItems', 'lowStockCount', 'totalStockVal'));
    }

    public function create()
    {
        $categories = InventoryCategory::all();
        return view('inventory-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventory_category_id' => 'required|exists:inventory_categories,id',
            'name'                  => 'required|string|max:255',
            'sku'                   => 'nullable|string|max:100',
            'unit'                  => 'required|string|max:50',
            'available_qty'         => 'required|integer|min:0',
            'min_qty_warning'       => 'required|integer|min:0',
            'unit_price'            => 'required|numeric|min:0',
        ]);

        $item = InventoryItem::create($validated);

        // Log initial stock
        if ($item->available_qty > 0) {
            InventoryStockLog::create([
                'inventory_item_id' => $item->id,
                'type'              => 'stock_in',
                'quantity'          => $item->available_qty,
                'reference'         => 'Initial Stock Input',
                'logged_by'         => auth()->id(),
            ]);
        }

        return redirect()->route('inventory-items.index')->with('success', 'Stock item added successfully.');
    }

    public function show(InventoryItem $inventoryItem)
    {
        $inventoryItem->load(['category', 'stockLogs.user']);
        return view('inventory-items.show', compact('inventoryItem'));
    }

    public function edit(InventoryItem $inventoryItem)
    {
        $categories = InventoryCategory::all();
        return view('inventory-items.edit', compact('inventoryItem', 'categories'));
    }

    public function update(Request $request, InventoryItem $inventoryItem)
    {
        $validated = $request->validate([
            'inventory_category_id' => 'required|exists:inventory_categories,id',
            'name'                  => 'required|string|max:255',
            'sku'                   => 'nullable|string|max:100',
            'unit'                  => 'required|string|max:50',
            'min_qty_warning'       => 'required|integer|min:0',
            'unit_price'            => 'required|numeric|min:0',
            'adjust_qty'            => 'nullable|integer',
            'adjust_type'           => 'nullable|required_with:adjust_qty|in:add,subtract',
            'adjust_reason'         => 'nullable|required_with:adjust_qty|string',
        ]);

        // Quantities are adjusted separately via stock logs
        $inventoryItem->update([
            'inventory_category_id' => $validated['inventory_category_id'],
            'name'                  => $validated['name'],
            'sku'                   => $validated['sku'],
            'unit'                  => $validated['unit'],
            'min_qty_warning'       => $validated['min_qty_warning'],
            'unit_price'            => $validated['unit_price'],
        ]);

        if (!empty($validated['adjust_qty']) && $validated['adjust_qty'] > 0) {
            $qty = $validated['adjust_qty'];
            $type = $validated['adjust_type']; // add/subtract
            $reason = $validated['adjust_reason'] ?? 'Manual stock adjustment';

            if ($type === 'add') {
                $inventoryItem->increment('available_qty', $qty);
                InventoryStockLog::create([
                    'inventory_item_id' => $inventoryItem->id,
                    'type'              => 'stock_in',
                    'quantity'          => $qty,
                    'reference'         => $reason,
                    'logged_by'         => auth()->id(),
                ]);
            } else {
                if ($inventoryItem->available_qty < $qty) {
                    return back()->withErrors(['adjust_qty' => 'Cannot subtract more than available inventory.']);
                }
                $inventoryItem->decrement('available_qty', $qty);
                InventoryStockLog::create([
                    'inventory_item_id' => $inventoryItem->id,
                    'type'              => 'stock_out',
                    'quantity'          => $qty,
                    'reference'         => $reason,
                    'logged_by'         => auth()->id(),
                ]);
            }
        }

        return redirect()->route('inventory-items.index')->with('success', 'Stock item updated successfully.');
    }

    public function destroy(InventoryItem $inventoryItem)
    {
        $inventoryItem->delete();
        return redirect()->route('inventory-items.index')->with('success', 'Stock item deleted successfully.');
    }

    /**
     * Bulk-import inventory items from an Excel or CSV file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        $instituteId = auth()->user()->institute_id;
        $userId      = auth()->id();

        try {
            Excel::import(new InventoryItemsImport($instituteId, $userId), $request->file('import_file'));

            return redirect()->route('inventory-items.index')
                ->with('success', 'Inventory items imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('inventory-items.index')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
