<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\InventorySupplier;
use App\Models\InventoryItem;
use App\Models\InventoryStockLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = PurchaseOrder::with(['supplier', 'creator']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('po_number', 'like', '%' . $request->search . '%');
        }

        $orders = $query->latest()->paginate(15);
        return view('purchase-orders.index', compact('orders'));
    }

    public function create()
    {
        $suppliers = InventorySupplier::all();
        // Auto-generate PO Number: PO-YYYYMMDD-XXXX
        $poNumber = 'PO-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));
        return view('purchase-orders.create', compact('suppliers', 'poNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'po_number'             => 'required|string|unique:purchase_orders,po_number',
            'inventory_supplier_id' => 'required|exists:inventory_suppliers,id',
            'order_date'            => 'required|date',
            'delivery_date'         => 'nullable|date|after_or_equal:order_date',
        ]);

        $validated['created_by']   = auth()->id();
        $validated['total_amount'] = 0.00;
        $validated['status']       = 'draft';

        $order = PurchaseOrder::create($validated);

        return redirect()->route('purchase-orders.show', $order)->with('success', 'Purchase order drafted. Now add items.');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load(['supplier', 'creator', 'items.item']);
        $inventoryItems = InventoryItem::all();
        return view('purchase-orders.show', compact('purchaseOrder', 'inventoryItems'));
    }

    public function storeItem(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validated = $request->validate([
            'inventory_item_id' => 'required|exists:inventory_items,id',
            'quantity'          => 'required|integer|min:1',
            'unit_cost'         => 'required|numeric|min:0',
        ]);

        $totalCost = $validated['quantity'] * $validated['unit_cost'];

        // Add item
        $purchaseOrder->items()->create([
            'inventory_item_id' => $validated['inventory_item_id'],
            'quantity'          => $validated['quantity'],
            'unit_cost'         => $validated['unit_cost'],
            'total_cost'        => $totalCost,
        ]);

        // Recalculate PO total amount
        $totalAmount = $purchaseOrder->items()->sum('total_cost');
        $purchaseOrder->update(['total_amount' => $totalAmount]);

        return redirect()->route('purchase-orders.show', $purchaseOrder)->with('success', 'Line item added to purchase order.');
    }

    public function destroyItem(PurchaseOrder $purchaseOrder, PurchaseOrderItem $item)
    {
        $item->delete();

        // Recalculate PO total amount
        $totalAmount = $purchaseOrder->items()->sum('total_cost');
        $purchaseOrder->update(['total_amount' => $totalAmount]);

        return redirect()->route('purchase-orders.show', $purchaseOrder)->with('success', 'Line item removed.');
    }

    public function updateStatus(Request $request, PurchaseOrder $purchaseOrder)
    {
        $request->validate([
            'status' => 'required|in:draft,sent,received,cancelled',
        ]);

        $status = $request->status;

        if ($status === 'received' && $purchaseOrder->status !== 'received') {
            // Receipt of shipment: increment available stocks
            foreach ($purchaseOrder->items as $orderItem) {
                $item = $orderItem->item;
                $item->increment('available_qty', $orderItem->quantity);

                // Log stock change
                InventoryStockLog::create([
                    'inventory_item_id' => $item->id,
                    'type'              => 'stock_in',
                    'quantity'          => $orderItem->quantity,
                    'reference'         => 'Received via ' . $purchaseOrder->po_number,
                    'logged_by'         => auth()->id(),
                ]);
            }
            $purchaseOrder->update([
                'status'        => 'received',
                'delivery_date' => Carbon::today(),
            ]);
        } else {
            $purchaseOrder->update(['status' => $status]);
        }

        return redirect()->route('purchase-orders.show', $purchaseOrder)->with('success', 'Purchase order status updated successfully.');
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order deleted.');
    }
}
