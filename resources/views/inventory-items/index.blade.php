@extends('layouts.admin')
@section('title', 'Store & Stock Inventory')
@section('content')
<style>
.inv-hdr{background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.inv-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.kpi-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:20px;box-shadow:0 4px 20px rgba(0,0,0,.02);position:relative;overflow:hidden;}
.kpi-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:4px;}
.kpi-total::after{background:linear-gradient(90deg,#4F46E5,#6366F1);}
.kpi-warning::after{background:linear-gradient(90deg,#F59E0B,#FBBF24);}
.kpi-value::after{background:linear-gradient(90deg,#10B981,#34D399);}
.kpi-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;}
.bg-indigo-soft{background:#EEF2FF;color:#4F46E5;}
.bg-amber-soft{background:#FFFBEB;color:#D97706;}
.bg-emerald-soft{background:#ECFDF5;color:#059669;}
.btn-add{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-size:.85rem;font-weight:700;display:inline-flex;align-items:center;gap:8px;text-decoration:none;box-shadow:0 4px 15px rgba(79,70,229,#.35);}
.btn-add:hover{color:#fff;transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);}
.table-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.btn-action{width:34px;height:34px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;color:#64748B;border:1px solid #E2E8F0;background:#fff;text-decoration:none;transition:all .2s;}
.btn-action:hover{color:#4F46E5;border-color:#4F46E5;background:#EEF2FF;}
</style>

<div class="inv-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-boxes me-1"></i> Store &amp; Logistics</span>
        <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Store Inventory</h2>
    </div>
    <div style="position:relative;z-index:2;display:flex;gap:12px;">
        <a href="{{ route('inventory-suppliers.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-truck-loading me-2"></i> Manage Suppliers</a>
        <a href="{{ route('purchase-orders.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-file-invoice-dollar me-2"></i> Purchase Orders</a>
        <a href="{{ route('inventory-items.create') }}" class="btn-add"><i class="fas fa-plus"></i> Add Stock Item</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-4 border-success-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<!-- KPIs Grid -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="kpi-card kpi-total d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-bold uppercase">Total Unique Items</span>
                <h3 class="fw-extrabold text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">{{ $totalItems }}</h3>
            </div>
            <div class="kpi-icon bg-indigo-soft">
                <i class="fas fa-cubes"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi-card kpi-warning d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-bold uppercase">Low Stock Alerts</span>
                <h3 class="fw-extrabold text-dark mt-1 mb-0 {{ $lowStockCount > 0 ? 'text-danger' : '' }}" style="font-size:1.8rem;letter-spacing:-1px;">{{ $lowStockCount }}</h3>
            </div>
            <div class="kpi-icon bg-amber-soft">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi-card kpi-value d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-bold uppercase">Estimated Stock Value</span>
                <h3 class="fw-extrabold text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">${{ number_format($totalStockVal, 2) }}</h3>
            </div>
            <div class="kpi-icon bg-emerald-soft">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filters Panel -->
<div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
    <form action="{{ route('inventory-items.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label for="search" class="form-label small text-muted fw-bold">Search Name or SKU</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control bg-light border-start-0 shadow-none" placeholder="e.g. Uniform shirt, SKU-1002...">
            </div>
        </div>
        
        <div class="col-md-3">
            <label for="category_id" class="form-label small text-muted fw-bold">Filter Category</label>
            <select name="category_id" id="category_id" class="form-select bg-light shadow-none">
                <option value="">-- All Categories --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-3">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" name="low_stock" id="low_stock" value="1" {{ request('low_stock') ? 'checked' : '' }}>
                <label class="form-check-label small text-muted fw-bold" for="low_stock">Show Low Stock Only</label>
            </div>
        </div>
        
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 rounded-3 py-2"><i class="fas fa-filter me-1"></i> Filter</button>
            <a href="{{ route('inventory-items.index') }}" class="btn btn-outline-secondary w-100 rounded-3 py-2" title="Reset"><i class="fas fa-undo"></i></a>
        </div>
    </form>
</div>

<!-- Items Table -->
<div class="table-card">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr style="font-size:.78rem;color:#475569;">
                    <th class="ps-4">SKU / Code</th>
                    <th>Item Description</th>
                    <th>Category</th>
                    <th class="text-end">Unit Cost</th>
                    <th class="text-center">Stock Level</th>
                    <th class="text-center">Min Threshold</th>
                    <th class="pe-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    @php
                        $isLow = $item->available_qty <= $item->min_qty_warning;
                    @endphp
                    <tr>
                        <td class="ps-4">
                            <span class="badge bg-light text-dark font-monospace border py-1.5 px-2.5" style="font-size:.75rem;">{{ $item->sku ?: 'NO SKU' }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark" style="font-size:.85rem;">{{ $item->name }}</div>
                            <span class="text-muted small" style="font-size:.78rem;">Unit type: {{ $item->unit }}</span>
                        </td>
                        <td style="font-size:.82rem;color:#334155;">
                            {{ $item->category->name }}
                        </td>
                        <td class="text-end fw-bold text-dark" style="font-size:.85rem;">
                            ${{ number_format($item->unit_price, 2) }}
                        </td>
                        <td class="text-center">
                            @if($isLow)
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1" style="font-size:.72rem;">{{ $item->available_qty }} (Low)</span>
                            @else
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1" style="font-size:.72rem;">{{ $item->available_qty }} Available</span>
                            @endif
                        </td>
                        <td class="text-center text-muted small" style="font-size:.82rem;">
                            {{ $item->min_qty_warning }} {{ $item->unit }}
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('inventory-items.show', $item) }}" class="btn-action" title="View Logs"><i class="fas fa-history"></i></a>
                                <a href="{{ route('inventory-items.edit', $item) }}" class="btn-action" title="Adjust Stock / Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('inventory-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inventory item? All stock logs will be removed.');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action" style="color:#EF4444;" title="Delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-boxes fs-3 mb-2" style="color:#CBD5E1;"></i>
                            <div class="fw-bold">No Inventory Items Found</div>
                            <div class="small">Add stock items to start tracking your institution resources.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $items->links() }}
</div>
@endsection
