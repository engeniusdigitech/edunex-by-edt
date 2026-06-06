@extends('layouts.admin')

@section('title', 'Expense Ledger')

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
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('expenses.index') }}">
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

<!-- Main Expenses Listing -->
<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
        <div>
            <h6 class="fw-bold text-dark mb-0">Operating Expense Ledger</h6>
            <p class="text-muted small mb-0">Record and track institutional outflows with GST input splits</p>
        </div>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-1"></i>Log Office Expense
        </a>
    </div>
    
    <div class="card-body px-4 pb-4">
        <!-- Search & Filter Form -->
        <form action="{{ route('expenses.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-12 col-sm-4">
                <select name="ledger_id" class="form-select">
                    <option value="">-- Filter Expense Category --</option>
                    @foreach($expenseLedgers as $ledger)
                        <option value="{{ $ledger->id }}" {{ request('ledger_id') == $ledger->id ? 'selected' : '' }}>
                            {{ $ledger->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Search references or description..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-12 col-sm-3 d-flex gap-1">
                <button type="submit" class="btn btn-primary w-100 rounded-pill">Filter</button>
                @if(request()->filled('ledger_id') || request()->filled('search'))
                    <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary rounded-circle" title="Clear Filters">
                        <i class="fas fa-undo"></i>
                    </a>
                @endif
            </div>
        </form>

        <!-- Expenses Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0">Date</th>
                        <th class="border-0">Category Ledger</th>
                        <th class="border-0">Reference No</th>
                        <th class="border-0">Supplier / Vendor</th>
                        <th class="border-0 text-end">Net Amount</th>
                        <th class="border-0 text-center">GST Slab</th>
                        <th class="border-0 text-end">GST Amount</th>
                        <th class="border-0 text-end">Total Paid</th>
                        <th class="border-0 text-center">Method</th>
                        <th class="border-0 text-end" style="width: 110px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $exp)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($exp->expense_date)->format('d M, Y') }}</td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $exp->ledger->name }}</div>
                                <div class="text-muted text-xs text-truncate" style="max-width: 180px;" title="{{ $exp->description }}">
                                    {{ $exp->description ?: 'No narration' }}
                                </div>
                            </td>
                            <td>
                                <code class="text-secondary small">{{ $exp->reference_no ?: 'N/A' }}</code>
                            </td>
                            <td>
                                @if($exp->supplier)
                                    <span class="text-dark fw-medium">{{ $exp->supplier->supplier_name }}</span>
                                @else
                                    <span class="text-muted small">Generic Outflow</span>
                                @endif
                            </td>
                            <td class="text-end text-dark">{{ currencySymbol() }}{{ number_format($exp->net_amount, 2) }}</td>
                            <td class="text-center">
                                @if($exp->gst_rate > 0)
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-2.5">
                                        {{ round($exp->gst_rate) }}% {{ strtoupper(str_replace('_', ' ', $exp->gst_type)) }}
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted border rounded-pill px-2.5">Exempt (0%)</span>
                                @endif
                            </td>
                            <td class="text-end text-muted">{{ currencySymbol() }}{{ number_format($exp->gst_amount, 2) }}</td>
                            <td class="text-end fw-bold text-dark">{{ currencySymbol() }}{{ number_format($exp->total_amount, 2) }}</td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-2 py-1 rounded-pill small">
                                    {{ $exp->payment_method }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a href="{{ route('expenses.edit', $exp->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-2.5 py-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('expenses.destroy', $exp->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this expense record and reverse its double-entry journal postings?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2.5 py-1" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted small">No expenses logged yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $expenses->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
