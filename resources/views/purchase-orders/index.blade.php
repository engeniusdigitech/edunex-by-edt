@extends('layouts.admin')
@section('title', 'Purchase Orders')
@section('content')
<style>
.po-hdr{background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.po-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.card-sec{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.btn-add{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-size:.85rem;font-weight:500;display:inline-flex;align-items:center;gap:8px;text-decoration:none;box-shadow:0 4px 15px rgba(79,70,229,.35);}
.btn-add:hover{color:#fff;transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);}
.btn-action{width:34px;height:34px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;color:#64748B;border:1px solid #E2E8F0;background:#fff;text-decoration:none;transition:all .2s;}
.btn-action:hover{color:#4F46E5;border-color:#4F46E5;background:#EEF2FF;}
.status-draft{background:#F1F5F9;color:#475569;border:1px solid #CBD5E1;}
.status-sent{background:#EFF6FF;color:#2563EB;border:1px solid #BFDBFE;}
.status-received{background:#ECFDF5;color:#059669;border:1px solid #A7F3D0;}
.status-cancelled{background:#FEF2F2;color:#DC2626;border:1px solid #FCA5A5;}
</style>

<div class="po-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-boxes me-1"></i> Store &amp; Logistics</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Purchase Requisitions</h2>
    </div>
    <div style="position:relative;z-index:2;display:flex;gap:12px;">
        <a href="{{ route('inventory-items.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-boxes me-2"></i> Inventory Items</a>
        <a href="{{ route('purchase-orders.create') }}" class="btn-add"><i class="fas fa-plus"></i> Draft Purchase Order</a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('inventory.dashboard') }}">
                    <i class="fas fa-chart-pie me-2"></i>Overview
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('inventory-items.index') }}">
                    <i class="fas fa-cubes me-2"></i>Stock Items
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('inventory-suppliers.index') }}">
                    <i class="fas fa-truck-loading me-2"></i>Suppliers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('purchase-orders.index') }}">
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

<!-- Filters Panel -->
<div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
    <form action="{{ route('purchase-orders.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-5">
            <label for="search" class="form-label small text-muted fw-medium">Search PO Number</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-control bg-light border-start-0 shadow-none" placeholder="e.g. PO-2026...">
            </div>
        </div>
        
        <div class="col-md-4">
            <label for="status" class="form-label small text-muted fw-medium">Filter Status</label>
            <select name="status" id="status" class="form-select bg-light shadow-none">
                <option value="">-- All Statuses --</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Sent to Supplier</option>
                <option value="received" {{ request('status') === 'received' ? 'selected' : '' }}>Received &amp; Stocked</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100 rounded-3 py-2"><i class="fas fa-filter me-1"></i> Filter</button>
            <a href="{{ route('purchase-orders.index') }}" class="btn btn-outline-secondary w-100 rounded-3 py-2" title="Reset"><i class="fas fa-undo"></i></a>
        </div>
    </form>
</div>

<!-- Purchase Orders List Table -->
<div class="card-sec">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr style="font-size:.78rem;color:#475569;">
                    <th class="ps-4">PO Number</th>
                    <th>Supplier / Vendor</th>
                    <th>Requisition Date</th>
                    <th>Delivery Date</th>
                    <th class="text-end">Total Value</th>
                    <th class="text-center">Status</th>
                    <th>Created By</th>
                    <th class="pe-4 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $po)
                    <tr>
                        <td class="ps-4">
                            <a href="{{ route('purchase-orders.show', $po) }}" class="fw-medium text-indigo text-decoration-none" style="font-size:.85rem;">{{ $po->po_number }}</a>
                        </td>
                        <td>
                            <div class="fw-medium text-dark" style="font-size:.85rem;">{{ $po->supplier->name }}</div>
                            <span class="text-muted small" style="font-size:.78rem;">Contact: {{ $po->supplier->contact_person ?: 'N/A' }}</span>
                        </td>
                        <td style="font-size:.82rem;color:#334155;">
                            {{ \Carbon\Carbon::parse($po->order_date)->format('M d, Y') }}
                        </td>
                        <td style="font-size:.82rem;color:#334155;">
                            {{ $po->delivery_date ? \Carbon\Carbon::parse($po->delivery_date)->format('M d, Y') : 'Pending' }}
                        </td>
                        <td class="text-end fw-medium text-dark" style="font-size:.85rem;">
                            {{ currencySymbol() }}{{ number_format($po->total_amount, 2) }}
                        </td>
                        <td class="text-center">
                            <span class="badge status-{{ $po->status }} rounded-pill px-3 py-1" style="font-size:.7rem;text-transform:capitalize;">{{ $po->status }}</span>
                        </td>
                        <td style="font-size:.82rem;color:#64748B;">
                            {{ $po->creator->name ?? 'System' }}
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('purchase-orders.show', $po) }}" class="btn-action" title="View &amp; Add Items"><i class="fas fa-eye"></i></a>
                                @if($po->status === 'draft')
                                    <form action="{{ route('purchase-orders.destroy', $po) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this draft purchase order?');" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action" style="color:#EF4444;" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-file-invoice-dollar fs-3 mb-2" style="color:#CBD5E1;"></i>
                            <div class="fw-medium">No Purchase Orders Found</div>
                            <div class="small">Draft purchase orders to request items from vendors.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $orders->links() }}
</div>
@endsection
