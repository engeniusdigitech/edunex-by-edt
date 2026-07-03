@extends('layouts.admin')
@section('title', 'Inventory Overview')
@section('content')
<style>
.inv-hdr{background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.inv-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.kpi-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:20px;box-shadow:0 4px 20px rgba(0,0,0,.02);position:relative;overflow:hidden;}
.kpi-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:4px;}
.kpi-total::after{background:linear-gradient(90deg,#4F46E5,#6366F1);}
.kpi-warning::after{background:linear-gradient(90deg,#F59E0B,#FBBF24);}
.kpi-value::after{background:linear-gradient(90deg,#10B981,#34D399);}
.kpi-po::after{background:linear-gradient(90deg,#EC4899,#F472B6);}
.kpi-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;}
.bg-indigo-soft{background:#EEF2FF;color:#4F46E5;}
.bg-amber-soft{background:#FFFBEB;color:#D97706;}
.bg-emerald-soft{background:#ECFDF5;color:#059669;}
.bg-pink-soft{background:#FDF2F8;color:#DB2777;}
.movement-bars{display:flex;align-items:flex-end;gap:10px;height:140px;}
.movement-col{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:flex-end;height:100%;}
.movement-track{width:100%;display:flex;gap:3px;align-items:flex-end;height:100%;justify-content:center;}
.movement-bar{width:10px;border-radius:4px 4px 0 0;}
.movement-bar.in{background:linear-gradient(180deg,#34D399,#10B981);}
.movement-bar.out{background:linear-gradient(180deg,#FB7185,#EF4444);}
.movement-lbl{font-size:.65rem;color:#94A3B8;margin-top:6px;text-transform:uppercase;}
</style>

<div class="inv-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-boxes me-1"></i> Store &amp; Logistics</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Inventory Overview</h2>
    </div>
</div>

<!-- Sub Navigation Tabs -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('inventory.dashboard') }}">
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
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('purchase-orders.index') }}">
                    <i class="fas fa-file-invoice-dollar me-2"></i>Purchase Orders
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- KPIs Grid -->
<div class="row g-4 mb-4">
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-total d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Total Unique Items</span>
                <h3 class="fw-medium text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">{{ $totalItems }}</h3>
            </div>
            <div class="kpi-icon bg-indigo-soft"><i class="fas fa-cubes"></i></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-warning d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Low Stock Alerts</span>
                <h3 class="fw-medium text-dark mt-1 mb-0 {{ $lowStockCount > 0 ? 'text-danger' : '' }}" style="font-size:1.8rem;letter-spacing:-1px;">{{ $lowStockCount }}</h3>
            </div>
            <div class="kpi-icon bg-amber-soft"><i class="fas fa-exclamation-triangle"></i></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-value d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Estimated Stock Value</span>
                <h3 class="fw-medium text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">{{ currencySymbol() }}{{ number_format($totalStockVal, 2) }}</h3>
            </div>
            <div class="kpi-icon bg-emerald-soft"><i class="fas fa-dollar-sign"></i></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-po d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Open PO Value</span>
                <h3 class="fw-medium text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">{{ currencySymbol() }}{{ number_format($openPoValue, 2) }}</h3>
                <span class="text-muted small">{{ $totalSuppliers }} active suppliers</span>
            </div>
            <div class="kpi-icon bg-pink-soft"><i class="fas fa-file-invoice"></i></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Stock Movement chart -->
    <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-medium text-dark mb-0">Stock Movement (Last 7 Days)</h6>
                    <p class="text-muted small mb-0">Units received vs. issued per day</p>
                </div>
                <div class="d-flex gap-3">
                    <span class="text-xs text-muted"><span class="d-inline-block rounded-circle me-1" style="width:8px;height:8px;background:#10B981;"></span>In</span>
                    <span class="text-xs text-muted"><span class="d-inline-block rounded-circle me-1" style="width:8px;height:8px;background:#EF4444;"></span>Out</span>
                </div>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="movement-bars">
                    @foreach($stockMovement as $day)
                        <div class="movement-col">
                            <div class="movement-track">
                                <div class="movement-bar in" style="height: {{ $day['stock_in'] > 0 ? max(4, ($day['stock_in'] / $maxMovement) * 130) : 2 }}px;" title="{{ $day['stock_in'] }} in"></div>
                                <div class="movement-bar out" style="height: {{ $day['stock_out'] > 0 ? max(4, ($day['stock_out'] / $maxMovement) * 130) : 2 }}px;" title="{{ $day['stock_out'] }} out"></div>
                            </div>
                            <div class="movement-lbl">{{ $day['label'] }}</div>
                        </div>
                    @endforeach
                </div>

                <hr class="my-3">
                <h6 class="fw-medium text-dark text-sm mb-2">Recent Stock Logs</h6>
                <div class="list-group list-group-flush">
                    @forelse($recentLogs as $log)
                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-dark small fw-medium">{{ $log->item->name ?? 'Deleted Item' }}</div>
                                <div class="text-muted text-xs">{{ $log->reference }} &bull; {{ $log->created_at->diffForHumans() }}</div>
                            </div>
                            <span class="badge rounded-pill px-2.5 py-1 {{ $log->type === 'stock_in' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                {{ $log->type === 'stock_in' ? '+' : '-' }}{{ $log->quantity }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-3 text-muted small">No stock movement logged yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Low stock + PO status -->
    <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-medium text-dark mb-0">Low Stock Watchlist</h6>
                <p class="text-muted small mb-0">Items closest to running out</p>
            </div>
            <div class="card-body px-4 pb-4">
                @forelse($lowStockItems as $item)
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                        <div>
                            <div class="text-dark small fw-medium">{{ $item->name }}</div>
                            <div class="text-muted text-xs">{{ $item->category->name ?? 'Uncategorized' }}</div>
                        </div>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">
                            {{ $item->available_qty }} / {{ $item->min_qty_warning }} {{ $item->unit }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-3 text-muted small">No items below minimum threshold. Stock levels are healthy.</div>
                @endforelse
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-medium text-dark mb-0">Purchase Order Pipeline</h6>
                <p class="text-muted small mb-0">Orders grouped by current status</p>
            </div>
            <div class="card-body px-4 pb-4">
                @php
                    $statusMeta = [
                        'draft' => ['label' => 'Draft', 'color' => 'secondary'],
                        'sent' => ['label' => 'Sent to Supplier', 'color' => 'primary'],
                        'received' => ['label' => 'Received', 'color' => 'success'],
                        'cancelled' => ['label' => 'Cancelled', 'color' => 'danger'],
                    ];
                @endphp
                @foreach($statusMeta as $key => $meta)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">{{ $meta['label'] }}</span>
                        <span class="badge bg-{{ $meta['color'] }}-subtle text-{{ $meta['color'] }} rounded-pill px-3 py-1">
                            {{ $poStatusCounts[$key] ?? 0 }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
