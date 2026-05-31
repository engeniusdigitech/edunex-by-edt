@extends('layouts.admin')

@section('title', 'Book Returns')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-medium text-dark mb-1">Book Returns</h4>
        <p class="text-muted small mb-0">Books currently issued and awaiting return</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
    <i class="fas fa-check-circle text-success fs-4"></i>
    <div><strong>Success!</strong> {{ session('success') }}</div>
</div>
@endif

{{-- Filter Bar --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('library.returns.index') }}" class="row g-2 align-items-end">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Search by book title or member name..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" name="overdue_only" id="overdueOnly" value="1" {{ request('overdue_only') ? 'checked' : '' }}>
                    <label class="form-check-label fw-medium" for="overdueOnly">
                        <i class="fas fa-exclamation-triangle text-danger me-1"></i> Overdue Only
                    </label>
                </div>
            </div>
            <div class="col-md-4 d-flex gap-2 justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm btn-modern">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <a href="{{ route('library.returns.index') }}" class="btn btn-outline-secondary btn-sm btn-modern">Clear</a>
            </div>
        </form>
    </div>
</div>

{{-- Returns Table --}}
<div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr style="background-color:#F8FAFC;">
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Book Title</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Member</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Issue Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Due Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Status</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issues as $issue)
                <tr style="{{ $issue->is_overdue ? 'border-left:4px solid #EF4444;' : '' }}">
                    <td style="padding:14px 20px;">
                        <div class="d-flex align-items-center">
                            <img src="{{ $issue->book->cover_image_url }}" alt="" style="width:36px;height:48px;object-fit:cover;border-radius:6px;" class="me-3 shadow-sm">
                            <div>
                                <div class="fw-medium text-dark">{{ Str::limit($issue->book->title, 30) }}</div>
                                <div class="text-muted small">{{ $issue->book->isbn ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="padding:14px 20px;">
                        <div class="fw-medium text-dark">{{ $issue->member->name ?? 'N/A' }}</div>
                        @if($issue->member_type === 'App\\Models\\User')
                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-2 py-1" style="font-size:0.65rem;">Staff</span>
                        @else
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1" style="font-size:0.65rem;">Student</span>
                        @endif
                    </td>
                    <td style="padding:14px 20px;" class="text-muted">{{ $issue->issue_date->format('d M, Y') }}</td>
                    <td style="padding:14px 20px;" class="text-muted">{{ $issue->due_date->format('d M, Y') }}</td>
                    <td style="padding:14px 20px;">
                        @if($issue->is_overdue)
                            @php
                                $daysOverdue = $issue->days_overdue;
                            @endphp
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-medium">
                                <i class="fas fa-exclamation-circle me-1"></i> {{ $daysOverdue }} {{ Str::plural('day', $daysOverdue) }} overdue
                            </span>
                        @else
                            @php
                                $daysRemaining = max(0, (int) now()->startOfDay()->diffInDays($issue->due_date, false));
                            @endphp
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">
                                <i class="fas fa-clock me-1"></i> {{ $daysRemaining }} {{ Str::plural('day', $daysRemaining) }} remaining
                            </span>
                        @endif
                    </td>
                    <td style="padding:14px 20px;">
                        <a href="{{ route('library.returns.show', $issue) }}" class="btn btn-success btn-sm btn-modern">
                            <i class="fas fa-undo me-1"></i> Return
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <h6 class="fw-medium text-dark">No pending returns</h6>
                        <p class="text-muted small mb-0">All issued books have been returned.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $issues->appends(request()->query())->links() }}
</div>
@endsection
