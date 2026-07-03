@extends('layouts.admin')

@section('title', 'Voucher Book')

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
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('accounting.vouchers.index') }}">
                    <i class="fas fa-book me-2"></i>Voucher Book
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

@if(session('success'))
    <div class="alert alert-success rounded-4 border-success-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h6 class="fw-medium text-dark mb-0">Posted Vouchers</h6>
            <p class="text-muted small mb-0">Full double-entry voucher history</p>
        </div>
        <a href="{{ route('accounting.vouchers.create') }}" class="btn btn-primary rounded-pill px-3 py-2">
            <i class="fas fa-plus me-2"></i>New Voucher
        </a>
    </div>
    <div class="card-body px-4 pb-4">
        <form action="{{ route('accounting.vouchers.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-12 col-sm-3">
                <select name="type" class="form-select">
                    <option value="">-- All Types --</option>
                    <option value="receipt" {{ request('type') === 'receipt' ? 'selected' : '' }}>Receipt</option>
                    <option value="payment" {{ request('type') === 'payment' ? 'selected' : '' }}>Payment</option>
                    <option value="journal" {{ request('type') === 'journal' ? 'selected' : '' }}>Journal</option>
                </select>
            </div>
            <div class="col-6 col-sm-3">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="Start Date">
            </div>
            <div class="col-6 col-sm-3">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="End Date">
            </div>
            <div class="col-12 col-sm-3 d-flex gap-1">
                <button type="submit" class="btn btn-primary w-100 rounded-pill">Filter</button>
                @if(request()->filled('type') || request()->filled('start_date') || request()->filled('end_date'))
                    <a href="{{ route('accounting.vouchers.index') }}" class="btn btn-outline-secondary rounded-circle" title="Clear Filters">
                        <i class="fas fa-undo"></i>
                    </a>
                @endif
            </div>
        </form>

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
                    @forelse($vouchers as $vch)
                        <tr>
                            <td>
                                <div class="fw-medium text-dark">{{ $vch->voucher_number }}</div>
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
                                            <span class="{{ $entry->entry_type === 'debit' ? 'fw-medium text-primary' : 'text-muted ps-2' }}">
                                                {{ $entry->ledger->name }}
                                                <span class="text-xs text-uppercase opacity-75">({{ $entry->entry_type }})</span>
                                            </span>
                                            <span class="fw-medium text-dark">{{ currencySymbol() }}{{ number_format($entry->amount, 2) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-muted small" style="max-width: 150px; white-space: normal;">{{ $vch->narration }}</td>
                            <td class="fw-medium text-dark text-end" style="font-size: 0.95rem;">{{ currencySymbol() }}{{ number_format($vch->amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted small">No vouchers match the selected filters.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $vouchers->links() }}
        </div>
    </div>
</div>
@endsection
