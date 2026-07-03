@extends('layouts.admin')

@section('title', 'Chart of Accounts')

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
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('accounting.ledgers.index') }}">
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
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('accounting.gst.reports') }}">
                    <i class="fas fa-file-invoice me-2"></i>GST Statements
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="row g-4">
    <!-- Chart of Accounts list (Left) -->
    <div class="col-12 col-md-8">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <div>
                        <h6 class="fw-medium text-dark mb-0">General Ledgers Directory</h6>
                        <p class="text-muted small mb-0">Overview of chart of account definitions</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body px-4 pb-4">
                <!-- Filters -->
                <form action="{{ route('accounting.ledgers.index') }}" method="GET" class="row g-2 mb-4">
                    <div class="col-12 col-sm-4">
                        <select name="type" class="form-select">
                            <option value="">-- Filter Type --</option>
                            <option value="asset" {{ request('type') === 'asset' ? 'selected' : '' }}>Asset</option>
                            <option value="liability" {{ request('type') === 'liability' ? 'selected' : '' }}>Liability</option>
                            <option value="equity" {{ request('type') === 'equity' ? 'selected' : '' }}>Equity</option>
                            <option value="revenue" {{ request('type') === 'revenue' ? 'selected' : '' }}>Revenue</option>
                            <option value="expense" {{ request('type') === 'expense' ? 'selected' : '' }}>Expense</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-5">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Search accounts..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 d-flex gap-1">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">Filter</button>
                        @if(request()->filled('type') || request()->filled('search'))
                            <a href="{{ route('accounting.ledgers.index') }}" class="btn btn-outline-secondary rounded-circle" title="Clear Filters">
                                <i class="fas fa-undo"></i>
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Accounts Directory Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">Ledger Name</th>
                                <th class="border-0">Type</th>
                                <th class="border-0">Tally Account Code</th>
                                <th class="border-0 text-end">Classification</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ledgers as $ledger)
                                <tr>
                                    <td>
                                        <div class="fw-medium text-dark">{{ $ledger->name }}</div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-2.5 py-1 text-uppercase
                                            @if($ledger->type === 'asset') bg-success-subtle text-success
                                            @elseif($ledger->type === 'liability') bg-danger-subtle text-danger
                                            @elseif($ledger->type === 'equity') bg-warning-subtle text-warning
                                            @elseif($ledger->type === 'revenue') bg-primary-subtle text-primary
                                            @else bg-info-subtle text-info @endif" style="font-size:0.75rem;">
                                            {{ $ledger->type }}
                                        </span>
                                    </td>
                                    <td>
                                        <code class="text-secondary small">{{ $ledger->code ?: 'N/A' }}</code>
                                    </td>
                                    <td class="text-end">
                                        @if($ledger->is_system)
                                            <span class="badge bg-primary rounded-pill px-2.5 py-1 text-xs" title="System accounts cannot be edited or deleted.">
                                                <i class="fas fa-lock me-1"></i>System Default
                                            </span>
                                        @else
                                            <span class="badge bg-light text-secondary border rounded-pill px-2.5 py-1 text-xs">
                                                Custom Ledger
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small">No ledgers matching filters found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="mt-3">
                    {{ $ledgers->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Create Custom Ledger Form (Right) -->
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                <h6 class="fw-medium text-dark mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Add Ledger Account</h6>
            </div>
            <div class="card-body p-4">
                <p class="text-xs text-muted">Register custom accounts to map specific departments, fees, assets, or liability entities.</p>
                
                <form action="{{ route('accounting.ledgers.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Account Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Uniform Sales Revenue" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Account Type</label>
                        <select name="type" class="form-select" required>
                            <option value="">-- Select Type --</option>
                            <option value="asset">Asset (e.g. Inventory, Equipment)</option>
                            <option value="liability">Liability (e.g. Loans, Taxes)</option>
                            <option value="equity">Equity (e.g. Capital Account)</option>
                            <option value="revenue">Revenue (e.g. Extra curricular income)</option>
                            <option value="expense">Expense (e.g. Stationery, Catering)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Tally Account Code (Optional)</label>
                        <input type="text" name="code" class="form-control" placeholder="e.g. REV-3004">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2.5 shadow-sm">
                        <i class="fas fa-save me-2"></i>Create Account Ledger
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
