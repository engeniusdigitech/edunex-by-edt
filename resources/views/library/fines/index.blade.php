@extends('layouts.admin')

@section('title', 'Fine Management')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">Fine Management</h4>
            <p class="text-muted mb-0">Track and manage library fines</p>
        </div>
        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addFineModal">
            <i class="fas fa-plus me-2"></i>Add Manual Fine
        </button>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
        <i class="fas fa-check-circle text-success fs-4"></i>
        <div><strong>Success!</strong> {{ session('success') }}</div>
    </div>
    @endif

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0" style="border-radius:16px;box-shadow:0 2px 12px rgba(37,99,235,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span style="font-size:0.62rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;">Total Fines</span>
                        <div style="width:30px;height:30px;border-radius:8px;background:rgba(37,99,235,0.1);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-money-bill-wave" style="font-size:0.75rem;color:#2563EB;"></i>
                        </div>
                    </div>
                    <div style="font-size:1.5rem;font-weight:900;color:#1E293B;">{{ currencySymbol() }}{{ number_format($totalFines ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0" style="border-radius:16px;box-shadow:0 2px 12px rgba(16,185,129,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span style="font-size:0.62rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;">Collected</span>
                        <div style="width:30px;height:30px;border-radius:8px;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-check-circle" style="font-size:0.75rem;color:#10B981;"></i>
                        </div>
                    </div>
                    <div style="font-size:1.5rem;font-weight:900;color:#1E293B;">{{ currencySymbol() }}{{ number_format($collectedFines ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0" style="border-radius:16px;box-shadow:0 2px 12px rgba(239,68,68,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span style="font-size:0.62rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;">Pending</span>
                        <div style="width:30px;height:30px;border-radius:8px;background:rgba(239,68,68,0.1);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-exclamation-circle" style="font-size:0.75rem;color:#EF4444;"></i>
                        </div>
                    </div>
                    <div style="font-size:1.5rem;font-weight:900;color:#1E293B;">{{ currencySymbol() }}{{ number_format($pendingFines ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
        <div class="card-body p-3">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label" style="font-size:0.75rem;font-weight:600;color:#64748B;">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Search member or book..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size:0.75rem;font-weight:600;color:#64748B;">Payment Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size:0.75rem;font-weight:600;color:#64748B;">Date From</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size:0.75rem;font-weight:600;color:#64748B;">Date To</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('library.fines.index') }}" class="btn btn-outline-secondary">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color:#F8FAFC;">
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Member</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Book</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Amount</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Reason</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Status</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Payment Date</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fines as $fine)
                    <tr>
                        <td style="padding:14px 20px;">
                            <div class="fw-semibold text-dark">{{ $fine->member->user->name ?? $fine->member_name ?? 'N/A' }}</div>
                            <div style="font-size: 0.8rem;" class="text-muted">{{ $fine->member->member_id ?? '' }}</div>
                        </td>
                        <td style="padding:14px 20px;">
                            <div class="fw-medium text-dark text-truncate" style="max-width:200px;">{{ $fine->issue->book->title ?? $fine->book_title ?? 'N/A' }}</div>
                        </td>
                        <td style="padding:14px 20px;">
                            <span class="fw-bold text-dark">{{ currencySymbol() }}{{ number_format($fine->amount, 2) }}</span>
                        </td>
                        <td style="padding:14px 20px;">
                            {{ $fine->reason ?? 'Late Return' }}
                        </td>
                        <td style="padding:14px 20px;">
                            @if(strtolower($fine->status ?? $fine->payment_status) === 'paid')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Paid</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-medium">Unpaid</span>
                            @endif
                        </td>
                        <td style="padding:14px 20px;">
                            {{ $fine->payment_date ? \Carbon\Carbon::parse($fine->payment_date)->format('M d, Y') : '-' }}
                        </td>
                        <td style="padding:14px 20px;" class="text-end">
                            @if(strtolower($fine->status ?? $fine->payment_status) !== 'paid')
                                <form action="{{ route('library.fines.collect', $fine->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Mark this fine as paid?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success shadow-sm rounded-pill px-3">
                                        <i class="fas fa-check-circle me-1"></i> Collect
                                    </button>
                                </form>
                            @else
                                <span class="text-muted"><i class="fas fa-check text-success"></i> Collected</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-receipt fs-4 text-muted"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">No Fines Found</h6>
                                <p class="text-muted mb-0">No library fines match your criteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($fines) && $fines->hasPages())
        <div class="card-footer bg-white border-top border-light p-3">
            {{ $fines->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('modals')
<!-- Add Manual Fine Modal -->
<div class="modal fade" id="addFineModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">Add Manual Fine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('library.fines.store') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Book Issue ID <span class="text-danger">*</span></label>
                        <input type="text" name="issue_id" class="form-control @error('issue_id') is-invalid @enderror" value="{{ old('issue_id') }}" required placeholder="e.g., ISS-10023">
                        <div class="form-text">Enter the issue ID to associate this fine with a specific book issuance.</div>
                        @error('issue_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Amount ({{ currencySymbol() }}) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                        @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Reason <span class="text-danger">*</span></label>
                        <textarea name="reason" rows="3" class="form-control @error('reason') is-invalid @enderror" required placeholder="e.g., Damaged book cover">{{ old('reason') }}</textarea>
                        @error('reason') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-sm">Save Fine</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
