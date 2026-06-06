@extends('student.layouts.app')
@section('title', 'Hostel Invoices & Bills')
@section('content')
<style>
.sh-hdr{background:linear-gradient(135deg,#1E3A8A,#3B82F6);border-radius:18px;padding:24px 28px;margin-bottom:28px;color:#fff;box-shadow:0 4px 15px rgba(30,58,138,0.15);}
.sh-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.kpi-card-sh{background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:20px;box-shadow:0 4px 15px rgba(0,0,0,.01);position:relative;}
.kpi-card-sh::after{content:'';position:absolute;bottom:0;left:0;right:0;height:4px;border-radius:0 0 16px 16px;}
.kpi-due::after{background:#EF4444;}
.kpi-total::after{background:#3B82F6;}
.kpi-paid::after{background:#10B981;}
.status-paid{background:#ECFDF5;color:#059669;border:1px solid #A7F3D0;}
.status-unpaid{background:#FEF2F2;color:#DC2626;border:1px solid #FCA5A5;}
.status-partial{background:#FFFBEB;color:#D97706;border:1px solid #FDE68A;}
</style>

<div class="sh-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <span style="font-size:.7rem;font-weight:700;color:#93C5FD;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-file-invoice-dollar me-1"></i> Billing &amp; Finance</span>
        <h2 style="font-size:1.35rem;font-weight:800;margin:4px 0 0;letter-spacing:-.5px;">Hostel Invoices</h2>
    </div>
    <div>
        <a href="{{ route('student.dashboard') }}" class="btn btn-outline-light rounded-pill px-4" style="font-size:.85rem;font-weight:600;"><i class="fas fa-home me-1"></i> Dashboard</a>
    </div>
</div>

@php
    $totalInvoiced = $bills->sum('amount');
    $totalPaid = $bills->sum('paid_amount');
    $totalDue = $bills->sum('due_amount');
@endphp

<!-- KPI Overview Grid -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="kpi-card-sh kpi-due d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-bold uppercase">Outstanding Balance</span>
                <h3 class="fw-extrabold text-dark mt-1 mb-0 {{ $totalDue > 0 ? 'text-danger' : '' }}" style="font-size:1.6rem;letter-spacing:-.5px;">${{ number_format($totalDue, 2) }}</h3>
            </div>
            <div style="width:40px;height:40px;border-radius:10px;background:#FEF2F2;color:#EF4444;display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                <i class="fas fa-exclamation-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi-card-sh kpi-paid d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-bold uppercase">Total Paid to Date</span>
                <h3 class="fw-extrabold text-dark mt-1 mb-0" style="font-size:1.6rem;letter-spacing:-.5px;">${{ number_format($totalPaid, 2) }}</h3>
            </div>
            <div style="width:40px;height:40px;border-radius:10px;background:#ECFDF5;color:#10B981;display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi-card-sh kpi-total d-flex align-items-center justify-content-between">
            <div>
                <span class="text-muted small fw-bold uppercase">Total Invoiced Value</span>
                <h3 class="fw-extrabold text-dark mt-1 mb-0" style="font-size:1.6rem;letter-spacing:-.5px;">${{ number_format($totalInvoiced, 2) }}</h3>
            </div>
            <div style="width:40px;height:40px;border-radius:10px;background:#EFF6FF;color:#3B82F6;display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
    </div>
</div>

<!-- Bills Table Card -->
<div class="sh-card">
    <div class="sh-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h5 class="fw-bold text-dark mb-0" style="font-size:1.05rem;"><i class="fas fa-list text-primary me-2"></i> Statement of Accounts</h5>
            <p class="text-muted small mb-0 mt-1">Rent and catering invoices generated monthly.</p>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr style="font-size:.78rem;color:#475569;">
                    <th class="ps-4">Billing Month</th>
                    <th>Invoice Description</th>
                    <th class="text-end">Invoice Amount</th>
                    <th class="text-end">Amount Paid</th>
                    <th class="text-end">Balance Due</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bills as $bill)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-dark" style="font-size:.85rem;">
                                {{ \Carbon\Carbon::parse($bill->billing_month)->format('F Y') }}
                            </span>
                        </td>
                        <td style="font-size:.82rem;color:#475569;">
                            {{ $bill->description ?: 'Room Rent & Catering Service' }}
                        </td>
                        <td class="text-end fw-bold text-dark" style="font-size:.85rem;">
                            ${{ number_format($bill->amount, 2) }}
                        </td>
                        <td class="text-end text-success fw-bold" style="font-size:.85rem;">
                            ${{ number_format($bill->paid_amount, 2) }}
                        </td>
                        <td class="text-end fw-bold {{ $bill->due_amount > 0 ? 'text-danger' : 'text-secondary' }}" style="font-size:.85rem;">
                            ${{ number_format($bill->due_amount, 2) }}
                        </td>
                        <td class="text-center">
                            @if($bill->status === 'paid')
                                <span class="badge status-paid rounded-pill px-3 py-1" style="font-size:.68rem;">Paid</span>
                            @elseif($bill->status === 'partially_paid')
                                <span class="badge status-partial rounded-pill px-3 py-1" style="font-size:.68rem;">Partially Paid</span>
                            @else
                                <span class="badge status-unpaid rounded-pill px-3 py-1" style="font-size:.68rem;">Unpaid</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-file-invoice-dollar fs-3 mb-2" style="color:#CBD5E1;"></i>
                            <div class="fw-bold">No Hostel Invoices Found</div>
                            <div class="small">Invoices generated for your room rent and mess plan will appear here.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
