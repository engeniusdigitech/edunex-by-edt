@extends('layouts.admin')

@section('title', 'Reservations')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">Reservations</h4>
            <p class="text-muted mb-0">Manage library book reservations</p>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
        <i class="fas fa-check-circle text-success fs-4"></i>
        <div><strong>Success!</strong> {{ session('success') }}</div>
    </div>
    @endif

    <!-- Filter Bar -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
        <div class="card-body p-3">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label" style="font-size:0.75rem;font-weight:600;color:#64748B;">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Search by member or book title..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label" style="font-size:0.75rem;font-weight:600;color:#64748B;">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="fulfilled" {{ request('status') == 'fulfilled' ? 'selected' : '' }}>Fulfilled</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('library.reservations.index') }}" class="btn btn-outline-secondary">Clear</a>
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
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Reservation Date</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Expiry Date</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Status</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                    <tr>
                        <td style="padding:14px 20px;">
                            <div class="fw-semibold text-dark">{{ $reservation->member->user->name ?? $reservation->member_name ?? 'N/A' }}</div>
                            <div style="font-size: 0.8rem;" class="text-muted">{{ $reservation->member->member_id ?? '' }}</div>
                        </td>
                        <td style="padding:14px 20px;">
                            <div class="fw-medium text-dark text-truncate" style="max-width:250px;">{{ $reservation->book->title ?? $reservation->book_title ?? 'N/A' }}</div>
                            <div style="font-size: 0.8rem;" class="text-muted">ISBN: {{ $reservation->book->isbn ?? '' }}</div>
                        </td>
                        <td style="padding:14px 20px;">
                            {{ $reservation->reservation_date ? \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') : '-' }}
                        </td>
                        <td style="padding:14px 20px;">
                            {{ $reservation->expiry_date ? \Carbon\Carbon::parse($reservation->expiry_date)->format('M d, Y') : '-' }}
                            @if(strtolower($reservation->status) === 'pending' && $reservation->expiry_date && \Carbon\Carbon::parse($reservation->expiry_date)->isPast())
                                <span class="text-danger ms-1" style="font-size: 0.75rem;" title="Expired"><i class="fas fa-exclamation-circle"></i></span>
                            @endif
                        </td>
                        <td style="padding:14px 20px;">
                            @if(strtolower($reservation->status) === 'pending')
                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2 fw-medium">Pending</span>
                            @elseif(strtolower($reservation->status) === 'fulfilled')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Fulfilled</span>
                            @elseif(strtolower($reservation->status) === 'expired')
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-medium">Expired</span>
                            @elseif(strtolower($reservation->status) === 'cancelled')
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 fw-medium">Cancelled</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 fw-medium">{{ ucfirst($reservation->status) }}</span>
                            @endif
                        </td>
                        <td style="padding:14px 20px;" class="text-end">
                            @if(strtolower($reservation->status) === 'pending')
                                <div class="d-flex justify-content-end gap-1">
                                    <form action="{{ route('library.reservations.fulfill', $reservation->id) }}" method="POST" onsubmit="return confirm('Fulfill this reservation? (This will redirect to book issuance)');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Fulfill">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('library.reservations.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Cancel">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-muted" style="font-size:0.85rem;">No actions</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-calendar-alt fs-4 text-muted"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">No Reservations Found</h6>
                                <p class="text-muted mb-0">No library reservations match your criteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($reservations) && $reservations->hasPages())
        <div class="card-footer bg-white border-top border-light p-3">
            {{ $reservations->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
