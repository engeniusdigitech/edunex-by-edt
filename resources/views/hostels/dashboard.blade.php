@extends('layouts.admin')
@section('title', 'Hostel Overview')
@section('content')
<style>
.h-hdr{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.h-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.kpi-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:20px;box-shadow:0 4px 20px rgba(0,0,0,.02);position:relative;overflow:hidden;}
.kpi-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:4px;}
.kpi-indigo::after{background:linear-gradient(90deg,#4F46E5,#6366F1);}
.kpi-emerald::after{background:linear-gradient(90deg,#10B981,#34D399);}
.kpi-amber::after{background:linear-gradient(90deg,#F59E0B,#FBBF24);}
.kpi-rose::after{background:linear-gradient(90deg,#F43F5E,#FB7185);}
.kpi-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;}
.bg-indigo-soft{background:#EEF2FF;color:#4F46E5;}
.bg-emerald-soft{background:#ECFDF5;color:#059669;}
.bg-amber-soft{background:#FFFBEB;color:#D97706;}
.bg-rose-soft{background:#FFF1F2;color:#E11D48;}
.occ-bar-track{height:8px;border-radius:50px;background:#F1F5F9;overflow:hidden;}
.occ-bar-fill{height:100%;border-radius:50px;background:linear-gradient(90deg,#4F46E5,#7C3AED);}
</style>

<div class="h-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-hotel me-1"></i> Boarding &amp; Residence</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Hostel Overview</h2>
    </div>
</div>

<!-- Sub Navigation Tabs -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('hostels.dashboard') }}">
                    <i class="fas fa-chart-pie me-2"></i>Overview
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('hostels.index') }}">
                    <i class="fas fa-building me-2"></i>Hostel Blocks
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('hostel-allocations.index') }}">
                    <i class="fas fa-user-tag me-2"></i>Allocations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('hostel-bills.index') }}">
                    <i class="fas fa-file-invoice-dollar me-2"></i>Invoices
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('hostel-messes.index') }}">
                    <i class="fas fa-utensils me-2"></i>Messes
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- KPI Grid -->
<div class="row g-4 mb-4">
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-indigo d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Occupancy Rate</span>
                <h3 class="fw-medium text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">{{ $occupancyPct }}%</h3>
                <span class="text-muted small">{{ $occupiedBeds }} / {{ $totalCapacity }} beds filled</span>
            </div>
            <div class="kpi-icon bg-indigo-soft"><i class="fas fa-bed"></i></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-emerald d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Revenue Collected</span>
                <h3 class="fw-medium text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">{{ currencySymbol() }}{{ number_format($revenueCollected, 0) }}</h3>
                <span class="text-muted small">Lifetime hostel bill payments</span>
            </div>
            <div class="kpi-icon bg-emerald-soft"><i class="fas fa-hand-holding-usd"></i></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-amber d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Dues Pending</span>
                <h3 class="fw-medium text-dark mt-1 mb-0 {{ $revenuePending > 0 ? 'text-danger' : '' }}" style="font-size:1.8rem;letter-spacing:-1px;">{{ currencySymbol() }}{{ number_format($revenuePending, 0) }}</h3>
                <span class="text-muted small">Outstanding across all bills</span>
            </div>
            <div class="kpi-icon bg-amber-soft"><i class="fas fa-exclamation-triangle"></i></div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="kpi-card kpi-rose d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-medium uppercase">Vacant Beds</span>
                <h3 class="fw-medium text-dark mt-1 mb-0" style="font-size:1.8rem;letter-spacing:-1px;">{{ $vacantBeds }}</h3>
                <span class="text-muted small">{{ $totalHostels }} blocks &bull; {{ $totalRooms }} rooms &bull; {{ $totalMesses }} messes</span>
            </div>
            <div class="kpi-icon bg-rose-soft"><i class="fas fa-door-open"></i></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Occupancy by block -->
    <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-medium text-dark mb-0">Occupancy by Hostel Block</h6>
                <p class="text-muted small mb-0">Bed utilization across each block</p>
            </div>
            <div class="card-body px-4 pb-4">
                @forelse($hostelsBreakdown as $block)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between text-sm mb-1">
                            <span class="text-dark fw-medium">{{ $block['name'] }} <span class="text-muted text-xs text-uppercase">({{ $block['type'] }})</span></span>
                            <span class="text-muted">{{ $block['occupied'] }} / {{ $block['capacity'] }} beds &bull; {{ $block['occupancy_pct'] }}%</span>
                        </div>
                        <div class="occ-bar-track">
                            <div class="occ-bar-fill" style="width: {{ $block['occupancy_pct'] }}%;"></div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted small">No hostel blocks created yet.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- This month collection snapshot -->
    <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-medium text-dark mb-0">This Month's Billing</h6>
                <p class="text-muted small mb-0">{{ \Carbon\Carbon::now()->format('F Y') }} collection snapshot</p>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="bg-light p-3 rounded-4 mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted text-xs">Collected This Month</div>
                            <h4 class="fw-medium mb-0 text-success">{{ currencySymbol() }}{{ number_format($currentMonthCollected, 2) }}</h4>
                        </div>
                        <div>
                            <div class="text-muted text-xs">Pending This Month</div>
                            <h4 class="fw-medium mb-0 text-danger">{{ currencySymbol() }}{{ number_format($currentMonthPending, 2) }}</h4>
                        </div>
                    </div>
                </div>
                <h6 class="fw-medium text-dark text-sm mb-2">Recent Bills</h6>
                <div class="list-group list-group-flush">
                    @forelse($recentBills as $bill)
                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-dark small fw-medium">{{ $bill->student->name ?? 'Unknown Student' }}</div>
                                <div class="text-muted text-xs">{{ \Carbon\Carbon::parse($bill->billing_month)->format('M Y') }}</div>
                            </div>
                            <span class="badge rounded-pill px-2.5 py-1 {{ $bill->status === 'paid' ? 'bg-success-subtle text-success' : ($bill->status === 'partial' ? 'bg-warning-subtle text-warning' : 'bg-danger-subtle text-danger') }}">
                                {{ currencySymbol() }}{{ number_format($bill->due_amount, 0) }} due
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-3 text-muted small">No hostel bills generated yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
