@extends('layouts.admin')

@section('title', 'Book Issues')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-medium text-dark mb-1">Book Issues</h4>
        <p class="text-muted small mb-0">Manage all book issue records</p>
    </div>
    <a href="{{ route('library.issues.create') }}" class="btn btn-primary btn-modern shadow-sm">
        <i class="fas fa-plus me-2"></i> Issue Book
    </a>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
    <i class="fas fa-check-circle text-success fs-4"></i>
    <div><strong>Success!</strong> {{ session('success') }}</div>
</div>
@endif

@if(isset($overdueCount) && $overdueCount > 0)
<div class="alert bg-white border border-danger border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
    <div style="width:44px;height:44px;border-radius:12px;background:rgba(239,68,68,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
        <i class="fas fa-exclamation-triangle text-danger"></i>
    </div>
    <div>
        <strong class="text-danger">{{ $overdueCount }} Overdue {{ Str::plural('Book', $overdueCount) }}</strong>
        <span class="text-muted">— These books have passed their due date and may incur fines.</span>
    </div>
</div>
@endif

{{-- Filter Bar --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('library.issues.index') }}" class="row g-2 align-items-end">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search book or member..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="issued" {{ request('status') == 'issued' ? 'selected' : '' }}>Issued</option>
                    <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>Lost</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="member_type" class="form-select">
                    <option value="">All Members</option>
                    <option value="student" {{ request('member_type') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="staff" {{ request('member_type') == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date_from" class="form-control" placeholder="Date From" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="date_to" class="form-control" placeholder="Date To" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-1 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i></button>
                <a href="{{ route('library.issues.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-times"></i></a>
            </div>
        </form>
    </div>
</div>

{{-- Issues Table --}}
<div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr style="background-color:#F8FAFC;">
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Book Title</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Member</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Issue Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Due Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Return Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Status</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issues as $issue)
                <tr>
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
                    <td style="padding:14px 20px;" class="text-muted">
                        {{ $issue->return_date ? $issue->return_date->format('d M, Y') : '-' }}
                    </td>
                    <td style="padding:14px 20px;">
                        @if($issue->status === 'issued')
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-medium">Issued</span>
                        @elseif($issue->status === 'returned')
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Returned</span>
                        @elseif($issue->status === 'lost')
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-medium">Lost</span>
                        @endif

                        @if($issue->is_overdue)
                            <span class="badge bg-danger rounded-pill px-2 py-1 ms-1" style="font-size:0.65rem;">
                                <i class="fas fa-clock me-1"></i>{{ $issue->days_overdue }}d overdue
                            </span>
                        @endif
                    </td>
                    <td style="padding:14px 20px;">
                        <div class="d-flex gap-1">
                            <a href="{{ route('library.issues.show', $issue) }}" class="btn btn-outline-primary btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($issue->status === 'issued')
                                <a href="{{ route('library.returns.returnBook', $issue) }}" class="btn btn-outline-success btn-sm" title="Return">
                                    <i class="fas fa-undo"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                            <i class="fas fa-hand-holding fa-2x"></i>
                        </div>
                        <h6 class="fw-medium text-dark">No book issues found</h6>
                        <p class="text-muted small mb-0">Start by issuing a book to a student or staff member.</p>
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
