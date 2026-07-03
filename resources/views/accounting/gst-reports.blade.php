@extends('layouts.admin')

@section('title', 'GST Statements')

@section('content')
<!-- Sub Navigation Tabs -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('accounting.dashboard') }}">
                    <i class="fas fa-chart-line me-2"></i>Financial Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('accounting.ledgers.index') }}">
                    <i class="fas fa-list-ul me-2"></i>Chart of Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('accounting.vouchers.index') }}">
                    <i class="fas fa-book me-2"></i>Voucher Book
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('expenses.index') }}">
                    <i class="fas fa-receipt me-2"></i>Expense Ledger
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('accounting.gst.reports') }}">
                    <i class="fas fa-file-invoice me-2"></i>GST Statements
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Date filter panel -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-4">
        <form action="{{ route('accounting.gst.reports') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-12 col-sm-4">
                <label class="form-label text-muted small fw-semibold">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-12 col-sm-4">
                <label class="form-label text-muted small fw-semibold">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-12 col-sm-4">
                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
                    <i class="fas fa-search me-1"></i>Generate Statement
                </button>
            </div>
        </form>
    </div>
</div>

<!-- GST Metrics summary -->
<div class="row g-3 mb-4">
    <!-- Output Tax -->
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #F59E0B !important;">
            <div class="card-body p-3.5">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.75rem; letter-spacing: 0.5px;">Output GST (Collected)</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-warning-subtle text-warning" style="width: 38px; height: 38px;">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                </div>
                <h3 class="fw-medium mb-0 text-dark">{{ currencySymbol() }}{{ number_format($totalCollected, 2) }}</h3>
                <span class="text-muted small">GST liability from student invoice payments</span>
            </div>
        </div>
    </div>

    <!-- Input Tax Credit -->
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #10B981 !important;">
            <div class="card-body p-3.5">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.75rem; letter-spacing: 0.5px;">Input Tax Credit (ITC)</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-success-subtle text-success" style="width: 38px; height: 38px;">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                </div>
                <h3 class="fw-medium mb-0 text-dark">{{ currencySymbol() }}{{ number_format($totalPaid, 2) }}</h3>
                <span class="text-muted small">GST paid on supplier &amp; office expenses</span>
            </div>
        </div>
    </div>

    <!-- Net Tax Payable -->
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #2563EB !important;">
            <div class="card-body p-3.5">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.75rem; letter-spacing: 0.5px;">Net Tax Payable</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary-subtle text-primary" style="width: 38px; height: 38px;">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
                <h3 class="fw-medium mb-0 text-dark">{{ currencySymbol() }}{{ number_format($netPayable, 2) }}</h3>
                <span class="text-muted small">Balance owed to tax department</span>
            </div>
        </div>
    </div>
</div>

<!-- Ledger Details splits (Auditing Tables) -->
<div class="row g-4">
    <!-- Output Tax Collected -->
    <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-medium text-dark mb-0">Output GST Ledger Splits (Credit entries)</h6>
                <p class="text-muted small mb-0">List of fee invoice receipts containing GST portions</p>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">Date</th>
                                <th class="border-0">Reference No</th>
                                <th class="border-0 text-end">GST Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($collectedEntries as $entry)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($entry->voucher->date)->format('d M, Y') }}</td>
                                    <td>
                                        <code class="text-secondary small">{{ $entry->voucher->voucher_number }}</code>
                                    </td>
                                    <td class="fw-medium text-dark text-end">{{ currencySymbol() }}{{ number_format($entry->amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-3 text-muted small">No collected GST records in this range.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Input Tax Paid -->
    <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-medium text-dark mb-0">Input GST (ITC) Ledger Splits (Debit entries)</h6>
                <p class="text-muted small mb-0">List of expenditures containing GST inputs</p>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">Date</th>
                                <th class="border-0">Reference No</th>
                                <th class="border-0 text-end">GST Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paidEntries as $entry)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($entry->voucher->date)->format('d M, Y') }}</td>
                                    <td>
                                        <code class="text-secondary small">{{ $entry->voucher->voucher_number }}</code>
                                    </td>
                                    <td class="fw-medium text-dark text-end">{{ currencySymbol() }}{{ number_format($entry->amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-3 text-muted small">No paid GST records in this range.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
