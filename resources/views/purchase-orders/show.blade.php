@extends('layouts.admin')
@section('title', 'Purchase Order ' . $purchaseOrder->po_number)
@section('content')
<style>
.invoice-card{background:#fff;border:1px solid #E2E8F0;border-radius:18px;box-shadow:0 4px 25px rgba(0,0,0,.03);overflow:hidden;}
.invoice-hdr{background:linear-gradient(135deg,#0F172A,#1E293B);color:#fff;padding:40px;}
.status-badge{font-size:.8rem;font-weight:500;padding:6px 14px;border-radius:50px;text-transform:uppercase;letter-spacing:.5px;display:inline-flex;align-items:center;gap:6px;}
.status-draft{background:rgba(241,245,249,.15);color:#F1F5F9;border:1px solid rgba(241,245,249,.3);}
.status-sent{background:rgba(37,99,235,.15);color:#93C5FD;border:1px solid rgba(37,99,235,.3);}
.status-received{background:rgba(5,150,105,.15);color:#6EE7B7;border:1px solid rgba(5,150,105,.3);}
.status-cancelled{background:rgba(220,38,38,.15);color:#FCA5A5;border:1px solid rgba(220,38,38,.3);}
.btn-action{width:32px;height:32px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;color:#EF4444;border:1px solid #FCA5A5;background:#FEF2F2;transition:all .2s;}
.btn-action:hover{color:#fff;background:#EF4444;border-color:#EF4444;}
.btn-save{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-size:.82rem;font-weight:500;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 15px rgba(79,70,229,.35);transition:all .2s;text-decoration:none;cursor:pointer;}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);color:#fff;}
</style>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <a href="{{ route('purchase-orders.index') }}" class="text-decoration-none text-muted small fw-medium"><i class="fas fa-arrow-left me-1"></i> Back to Purchase Orders</a>
    </div>
    
    <!-- Status Workflow Form -->
    <div class="d-flex align-items-center gap-3">
        <span class="text-muted small fw-medium">Order Lifecycle State:</span>
        <form action="{{ route('purchase-orders.status.update', $purchaseOrder) }}" method="POST" class="d-flex gap-2">
            @csrf
            <select name="status" class="form-select form-select-sm shadow-none" style="font-size:.85rem;font-weight:600;min-width:180px;">
                <option value="draft" {{ $purchaseOrder->status === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="sent" {{ $purchaseOrder->status === 'sent' ? 'selected' : '' }}>Sent to Supplier</option>
                <option value="received" {{ $purchaseOrder->status === 'received' ? 'selected' : '' }} {{ $purchaseOrder->status === 'received' ? 'disabled' : '' }}>Received &amp; Stocked</option>
                <option value="cancelled" {{ $purchaseOrder->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="btn btn-sm btn-dark px-3 rounded-3"><i class="fas fa-sync-alt me-1"></i> Update Status</button>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-4 border-success-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger rounded-4 border-danger-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
    </div>
@endif

@if($purchaseOrder->status === 'received')
    <div class="alert alert-info rounded-4 border-info-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-info-circle me-2"></i> This purchase order is <strong>received</strong>. Predefined item stocks have been incremented and logged automatically. Further line item modifications are locked.
    </div>
@endif

<div class="invoice-card mb-4">
    <!-- Invoice header -->
    <div class="invoice-hdr">
        <div class="row g-4 align-items-center">
            <div class="col-md-6">
                <span class="status-badge status-{{ $purchaseOrder->status }}mb-3">
                    <i class="fas fa-circle" style="font-size:.5rem;"></i> {{ $purchaseOrder->status }}
                </span>
                <h2 class="fw-medium mb-1" style="font-size:2.2rem;letter-spacing:-1px;">{{ $purchaseOrder->po_number }}</h2>
                <p class="mb-0 text-white-50" style="font-size:.9rem;"><i class="far fa-calendar-alt me-1"></i> Order Date: {{ \Carbon\Carbon::parse($purchaseOrder->order_date)->format('M d, Y') }}</p>
            </div>
            <div class="col-md-6 text-md-end">
                <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1.5px;display:block;">EduNex ERP Store Department</span>
                <h4 class="fw-medium text-white mt-1 mb-0" style="font-size:1.5rem;">Purchase Requisition</h4>
                <p class="mb-0 text-white-50 small">Creator: {{ $purchaseOrder->creator->name ?? 'System' }}</p>
            </div>
        </div>
    </div>
    
    <!-- Invoice details address -->
    <div class="p-4 p-md-5 border-bottom" style="background:#F8FAFC;">
        <div class="row g-4">
            <div class="col-md-6">
                <span class="text-muted small d-block uppercase fw-medium mb-2" style="font-size:.7rem;">Vendor / Supplier</span>
                <h5 class="fw-medium text-dark mb-1">{{ $purchaseOrder->supplier->name }}</h5>
                <p class="text-muted small mb-0" style="font-size:.8rem;line-height:1.5;">
                    @if($purchaseOrder->supplier->contact_person)
                        <strong>Attn:</strong> {{ $purchaseOrder->supplier->contact_person }}<br>
                    @endif
                    @if($purchaseOrder->supplier->phone)
                        <strong>Phone:</strong> {{ $purchaseOrder->supplier->phone }}<br>
                    @endif
                    @if($purchaseOrder->supplier->email)
                        <strong>Email:</strong> {{ $purchaseOrder->supplier->email }}<br>
                    @endif
                    @if($purchaseOrder->supplier->address)
                        <strong>Address:</strong> {{ $purchaseOrder->supplier->address }}
                    @endif
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <span class="text-muted small d-block uppercase fw-medium mb-2" style="font-size:.7rem;">Shipping Destination</span>
                <h5 class="fw-medium text-dark mb-1">{{ auth()->user()->institute->name ?? 'Main Campus Store' }}</h5>
                <p class="text-muted small mb-0" style="font-size:.8rem;line-height:1.5;">
                    EduNex ERP School Administration Block<br>
                    Central Store Room, Ground Floor<br>
                    <strong>Expected Delivery:</strong> {{ $purchaseOrder->delivery_date ? \Carbon\Carbon::parse($purchaseOrder->delivery_date)->format('M d, Y') : 'Immediate / Flexible' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Line items table -->
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr style="font-size:.78rem;color:#475569;">
                    <th class="ps-5">SKU</th>
                    <th>Product / Item Description</th>
                    <th class="text-end">Unit Cost</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Subtotal Cost</th>
                    @if($purchaseOrder->status === 'draft')
                        <th class="pe-5 text-end">Remove</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($purchaseOrder->items as $item)
                    <tr>
                        <td class="ps-5">
                            <span class="badge bg-light text-dark font-monospace border py-1.5 px-2" style="font-size:.7rem;">{{ $item->item->sku ?: 'NO SKU' }}</span>
                        </td>
                        <td>
                            <div class="fw-medium text-dark" style="font-size:.85rem;">{{ $item->item->name }}</div>
                            <span class="text-muted small" style="font-size:.78rem;">Unit: {{ $item->item->unit }}</span>
                        </td>
                        <td class="text-end fw-medium text-dark" style="font-size:.85rem;">
                            {{ currencySymbol() }}{{ number_format($item->unit_cost, 2) }}
                        </td>
                        <td class="text-center" style="font-size:.85rem;color:#334155;">
                            {{ $item->quantity }}
                        </td>
                        <td class="text-end fw-medium text-dark" style="font-size:.85rem;">
                            {{ currencySymbol() }}{{ number_format($item->total_cost, 2) }}
                        </td>
                        @if($purchaseOrder->status === 'draft')
                            <td class="pe-5 text-end">
                                <form action="{{ route('purchase-orders.items.destroy', [$purchaseOrder, $item]) }}" method="POST" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action" title="Delete Line Item"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $purchaseOrder->status === 'draft' ? 6 : 5 }}" class="text-center py-5 text-muted">
                            <i class="fas fa-shopping-basket fs-3 mb-2" style="color:#CBD5E1;"></i>
                            <div class="fw-medium">This PO has no items yet.</div>
                            <div class="small">Add items using the panel below to populate the invoice.</div>
                        </td>
                    </tr>
                @endforelse
                
                <!-- Total calculations -->
                <tr class="table-light border-top-2" style="border-top:2px solid #E2E8F0!important;">
                    <td colspan="3" class="ps-5 fw-medium text-dark" style="font-size:.88rem;">Total PO Value</td>
                    <td class="text-center fw-medium text-dark" style="font-size:.88rem;">{{ $purchaseOrder->items->sum('quantity') }} Items</td>
                    <td class="text-end fw-medium text-indigo" style="font-size:1.05rem;color:#4F46E5;">
                        {{ currencySymbol() }}{{ number_format($purchaseOrder->total_amount, 2) }}
                    </td>
                    @if($purchaseOrder->status === 'draft')
                        <td></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Item Panel (Only if status is draft) -->
@if($purchaseOrder->status === 'draft')
    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5">
        <h5 class="fw-medium mb-4 text-dark"><i class="fas fa-plus-circle me-2 text-indigo" style="color:#4F46E5;"></i> Add Order Line Item</h5>
        <form action="{{ route('purchase-orders.items.store', $purchaseOrder) }}" method="POST" class="row g-3 align-items-end">
            @csrf
            
            <div class="col-md-5">
                <label for="inventory_item_id" class="form-label small text-muted fw-medium">Select Stock Item</label>
                <select name="inventory_item_id" id="inventory_item_id" class="form-select rounded-3 py-2.5 shadow-none" style="font-size:.85rem;" onchange="updateItemPrice(this)" required>
                    <option value="">-- Choose Item --</option>
                    @foreach($inventoryItems as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->unit_price }}">{{ $item->name }} (SKU: {{ $item->sku ?: '—' }} | Price: ${{ $item->unit_price }})</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-3">
                <label for="unit_cost" class="form-label small text-muted fw-medium">Unit Price ($)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted">$</span>
                    <input type="number" step="0.01" name="unit_cost" id="unit_cost" class="form-control rounded-3 py-2.5 shadow-none border-start-0" placeholder="0.00" required>
                </div>
            </div>

            <div class="col-md-2">
                <label for="quantity" class="form-label small text-muted fw-medium">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control rounded-3 py-2.5 shadow-none" min="1" value="1" required>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn-save w-100 py-2.5 justify-content-center"><i class="fas fa-cart-plus"></i> Add Item</button>
            </div>
        </form>
    </div>
@endif

<script>
function updateItemPrice(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const price = selectedOption.getAttribute('data-price');
    if (price) {
        document.getElementById('unit_cost').value = price;
    } else {
        document.getElementById('unit_cost').value = '';
    }
}
</script>
@endsection
