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
.btn-add{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-size:.85rem;font-weight:500;display:inline-flex;align-items:center;gap:8px;text-decoration:none;box-shadow:0 4px 15px rgba(79,70,229,.35);}
.btn-add:hover{color:#fff;transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);}
.table-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.btn-action{width:34px;height:34px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;color:#64748B;border:1px solid #E2E8F0;background:#fff;text-decoration:none;transition:all .2s;}
.btn-action:hover{color:#4F46E5;border-color:#4F46E5;background:#EEF2FF;}
</style>

<div class="inv-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-boxes me-1"></i> Store &amp; Logistics</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Store Inventory</h2>
    </div>
    <div style="position:relative;z-index:2;display:flex;gap:12px;flex-wrap:wrap;align-items:center;">
        <a href="{{ route('inventory-suppliers.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-truck-loading me-2"></i> Manage Suppliers</a>
        <a href="{{ route('purchase-orders.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-file-invoice-dollar me-2"></i> Purchase Orders</a>
        <div class="dropdown">
            <button class="btn btn-outline-light rounded-4 px-4 py-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:.85rem;font-weight:600;">
                <i class="fas fa-file-import me-2"></i> Import
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><h6 class="dropdown-header text-muted"><i class="fas fa-upload me-1"></i> Upload Data</h6></li>
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importInventoryModal">
                        <i class="fas fa-table text-success me-2"></i> Import Excel / CSV
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><h6 class="dropdown-header text-muted"><i class="fas fa-download me-1"></i> Download Sample</h6></li>
                <li>
                    <a class="dropdown-item" href="{{ asset('samples/inventory-items-sample.csv') }}" download>
                        <i class="fas fa-file-csv text-primary me-2"></i> Sample CSV
                    </a>
                </li>
            </ul>
        </div>
        <a href="{{ route('inventory-items.create') }}" class="btn-add"><i class="fas fa-plus"></i> Add Stock Item</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
</div>
@endif
@if(session('warning'))
<div class="alert alert-warning bg-white border border-warning border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-exclamation-triangle text-warning me-2"></i> {{ session('warning') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger bg-white border border-danger border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-times-circle text-danger me-2"></i> {{ session('error') }}
</div>
@endif

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('inventory.dashboard') }}">
                    <i class="fas fa-chart-pie me-2"></i>Overview
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('inventory-items.index') }}">
                    <i class="fas fa-cubes me-2"></i>Stock Items
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('inventory-suppliers.index') }}">
                    <i class="fas fa-truck-loading me-2"></i>Suppliers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('purchase-orders.index') }}">
                    <i class="fas fa-file-invoice-dollar me-2"></i>Purchase Orders
                </a>
            </li>
        </ul>
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
                <span class="text-muted small fw-medium uppercase">Total Unique Items</span>
                <h3 class="fw-medium text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">{{ $totalItems }}</h3>
            </div>
            <div class="kpi-icon bg-indigo-soft">
                <i class="fas fa-cubes"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi-card kpi-warning d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Low Stock Alerts</span>
                <h3 class="fw-medium text-dark mt-1 mb-0 {{ $lowStockCount > 0 ? 'text-danger' : '' }}" style="font-size:1.8rem;letter-spacing:-1px;">{{ $lowStockCount }}</h3>
            </div>
            <div class="kpi-icon bg-amber-soft">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi-card kpi-value d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Estimated Stock Value</span>
                <h3 class="fw-medium text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">{{ currencySymbol() }}{{ number_format($totalStockVal, 2) }}</h3>
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
            <label for="search" class="form-label small text-muted fw-medium">Search Name or SKU</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control bg-light border-start-0 shadow-none" placeholder="e.g. Uniform shirt, SKU-1002...">
            </div>
        </div>
        
        <div class="col-md-3">
            <label for="category_id" class="form-label small text-muted fw-medium">Filter Category</label>
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
                <label class="form-check-label small text-muted fw-medium" for="low_stock">Show Low Stock Only</label>
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
                            <div class="fw-medium text-dark" style="font-size:.85rem;">{{ $item->name }}</div>
                            <span class="text-muted small" style="font-size:.78rem;">Unit type: {{ $item->unit }}</span>
                        </td>
                        <td style="font-size:.82rem;color:#334155;">
                            {{ $item->category->name }}
                        </td>
                        <td class="text-end fw-medium text-dark" style="font-size:.85rem;">
                            {{ currencySymbol() }}{{ number_format($item->unit_price, 2) }}
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
                            <div class="fw-medium">No Inventory Items Found</div>
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

{{-- Import Inventory Modal --}}
<div class="modal fade" id="importInventoryModal" tabindex="-1" aria-labelledby="importInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <div>
                    <h5 class="modal-title fw-semibold" id="importInventoryModalLabel">
                        <i class="fas fa-file-import text-primary me-2"></i> Import Inventory Items
                    </h5>
                    <p class="text-muted small mb-0 mt-1">Upload an Excel or CSV file to bulk-import stock items.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('inventory-items.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-3">
                    <div class="alert alert-info border-0 rounded-3 small" style="background:#EFF6FF;color:#1D4ED8;">
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Required columns:</strong> name<br>
                        <strong>Optional:</strong> category (name, auto-created), sku, unit, quantity, min_qty_warning, unit_price<br>
                        <strong>Note:</strong> Initial stock is logged automatically.
                    </div>
                    <div class="mb-3">
                        <label for="inventory_import_file" class="form-label fw-medium">Select File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="inventory_import_file" name="import_file" accept=".xlsx,.xls,.csv" required>
                        <div class="form-text">Accepted formats: .xlsx, .xls, .csv (max 5 MB)</div>
                    </div>
                    <a href="{{ asset('samples/inventory-items-sample.csv') }}" download class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-download me-1"></i> Download Sample CSV
                    </a>
                </div>
                <div class="modal-footer border-top-0 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-modern">
                        <i class="fas fa-upload me-2"></i> Import Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
