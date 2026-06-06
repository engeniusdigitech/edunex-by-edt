@extends('layouts.admin')

@section('title', 'Accounting Dashboard')

@section('content')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05);
    }
    .metric-card {
        border-left: 4px solid transparent;
        transition: all 0.2s;
    }
    .metric-card:hover {
        transform: translateY(-2px);
    }
</style>

<!-- Sub Navigation Tabs -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('accounting.dashboard') }}">
                    <i class="fas fa-chart-line me-2"></i>Financial Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('accounting.ledgers.index') }}">
                    <i class="fas fa-list-ul me-2"></i>Chart of Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('expenses.index') }}">
                    <i class="fas fa-receipt me-2"></i>Expense Ledger
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('accounting.gst.reports') }}">
                    <i class="fas fa-file-invoice me-2"></i>GST Statements
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Financial Summary Grid -->
<div class="row g-3 mb-4">
    <!-- Cash-in-Hand -->
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 metric-card" style="border-radius: 16px; border-left: 4px solid #10B981 !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.7rem; letter-spacing: 0.5px;">Cash-in-Hand</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-success-subtle text-success" style="width: 36px; height: 36px;">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ currencySymbol() }}{{ number_format($cashBalance, 2) }}</h3>
                <span class="text-muted small">Current cash liquidity</span>
            </div>
        </div>
    </div>
    
    <!-- Bank Account Balance -->
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 metric-card" style="border-radius: 16px; border-left: 4px solid #2563EB !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.7rem; letter-spacing: 0.5px;">Bank Accounts</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary-subtle text-primary" style="width: 36px; height: 36px;">
                        <i class="fas fa-university"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ currencySymbol() }}{{ number_format($bankBalance, 2) }}</h3>
                <span class="text-muted small">Institutional reserves</span>
            </div>
        </div>
    </div>

    <!-- Tuition Receivables -->
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100 metric-card" style="border-radius: 16px; border-left: 4px solid #F59E0B !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.7rem; letter-spacing: 0.5px;">Fee Receivables</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-warning-subtle text-warning" style="width: 36px; height: 36px;">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ currencySymbol() }}{{ number_format($totalReceivable, 2) }}</h3>
                <span class="text-muted small">Outstanding student dues</span>
            </div>
        </div>
    </div>

    <!-- GST Net Payable -->
    <div class="col-6 col-md-3">
        @php $netGst = $gstCollected - $gstPaid; @endphp
        <div class="card border-0 shadow-sm h-100 metric-card" style="border-radius: 16px; border-left: 4px solid #EF4444 !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.7rem; letter-spacing: 0.5px;">Net GST Liability</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-danger-subtle text-danger" style="width: 36px; height: 36px;">
                        <i class="fas fa-percent"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ currencySymbol() }}{{ number_format($netGst, 2) }}</h3>
                <span class="text-muted small">Collected vs Input Credit</span>
            </div>
        </div>
    </div>
</div>

<!-- Revenue & Expenses Performance -->
<div class="row g-4 mb-4">
    <!-- Profit Loss Performance Indicator -->
    <div class="col-md-6 col-12">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-bold text-dark mb-0">Financial Performance Overview</h6>
                <p class="text-muted small mb-0">Revenues vs Expenditures breakdown</p>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="d-flex flex-column gap-3">
                    <div>
                        <div class="d-flex justify-content-between text-sm mb-1">
                            <span class="text-muted">Total Realized Revenue</span>
                            <span class="fw-bold text-success">{{ currencySymbol() }}{{ number_format($totalRevenue, 2) }}</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius:50px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between text-sm mb-1">
                            <span class="text-muted">Total Logged Expenses</span>
                            <span class="fw-bold text-danger">{{ currencySymbol() }}{{ number_format($totalExpenses, 2) }}</span>
                        </div>
                        @php
                            $expensePercentage = $totalRevenue > 0 ? min(100, ($totalExpenses / $totalRevenue) * 100) : 0;
                        @endphp
                        <div class="progress" style="height: 10px; border-radius:50px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $expensePercentage }}%"></div>
                        </div>
                    </div>

                    <div class="bg-light p-3 rounded-4 mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted text-xs">Operating Surplus / (Deficit)</div>
                                <h4 class="fw-bold mb-0 {{ ($totalRevenue - $totalExpenses) >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ currencySymbol() }}{{ number_format($totalRevenue - $totalExpenses, 2) }}
                                </h4>
                            </div>
                            <span class="badge rounded-pill {{ ($totalRevenue - $totalExpenses) >= 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3 py-2">
                                {{ ($totalRevenue - $totalExpenses) >= 0 ? 'Surplus' : 'Deficit' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tally XML Voucher Exporter -->
    <div class="col-md-6 col-12">
        <div class="card border-0 glass-card h-100" style="border-radius: 16px;">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h6 class="fw-bold text-dark mb-0"><i class="fas fa-exchange-alt me-2 text-primary"></i>Tally TDL Sync Console</h6>
                <p class="text-muted small mb-0">Generate double-entry voucher XML files to import directly into Tally Prime / ERP 9</p>
            </div>
            <div class="card-body px-4 pb-4">
                <form action="{{ route('accounting.tally.export') }}" method="GET">
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted small fw-semibold">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ \Carbon\Carbon::today()->startOfMonth()->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted small fw-semibold">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="alert alert-info text-xs mb-3">
                        <i class="fas fa-info-circle me-1"></i> Maps standard Tally tag variables. Debit ledger splits are generated with negative values, and credits are positive in accordance with standard Tally ERP interfaces.
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2.5 shadow-sm">
                        <i class="fas fa-download me-2"></i>Download Tally XML Voucher Batch
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Recent Double-Entry Vouchers -->
<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold text-dark mb-0">Recent Voucher Ledger Postings</h6>
            <p class="text-muted small mb-0">Real-time ledger audit trail of double-entry voucher inputs</p>
        </div>
        <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">Audit Active</span>
    </div>
    <div class="card-body px-4 pb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0">Voucher No</th>
                        <th class="border-0">Date</th>
                        <th class="border-0">Type</th>
                        <th class="border-0">Ledger Splits (Debit / Credit)</th>
                        <th class="border-0">Narration</th>
                        <th class="border-0 text-end">Voucher Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentVouchers as $vch)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $vch->voucher_number }}</div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($vch->date)->format('d M, Y') }}</td>
                            <td>
                                <span class="badge rounded-pill px-2.5 py-1 
                                    @if($vch->type === 'receipt') bg-success-subtle text-success border border-success-subtle
                                    @elseif($vch->type === 'payment') bg-danger-subtle text-danger border border-danger-subtle
                                    @else bg-secondary-subtle text-secondary border border-secondary-subtle @endif" style="font-size:0.75rem;">
                                    {{ strtoupper($vch->type) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1" style="font-size: 0.85rem;">
                                    @foreach($vch->journalEntries as $entry)
                                        <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-1">
                                            <span class="{{ $entry->entry_type === 'debit' ? 'fw-semibold text-primary' : 'text-muted ps-2' }}">
                                                {{ $entry->ledger->name }} 
                                                <span class="text-xs text-uppercase opacity-75">({{ $entry->entry_type }})</span>
                                            </span>
                                            <span class="fw-medium text-dark">{{ currencySymbol() }}{{ number_format($entry->amount, 2) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-muted small" style="max-width: 150px; white-space: normal;">{{ $vch->narration }}</td>
                            <td class="fw-bold text-dark text-end" style="font-size: 0.95rem;">{{ currencySymbol() }}{{ number_format($vch->amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted small">No recent accounting vouchers recorded.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
