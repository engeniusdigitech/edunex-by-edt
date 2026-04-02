@extends('layouts.admin')

@section('title', 'Leave Management')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold"><i class="fas fa-calendar-minus text-primary me-2"></i> Leave Management</h3>
            <p class="text-muted">Track and apply for your own leave requests.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('leaves.create') }}" class="btn btn-primary btn-modern shadow-sm">
                <i class="fas fa-plus me-2"></i> Apply for Leave
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3">Applicant</th>
                        <th class="py-3">Type</th>
                        <th class="py-3">Duration</th>
                        <th class="py-3">Reason</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaves as $leave)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px; background: rgba(79, 70, 229, 0.1);">
                                        {{ substr($leave->user->name ?? $leave->student->name ?? '?', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $leave->user->name ?? $leave->student->name ?? 'N/A' }}</div>
                                        <small class="text-muted">
                                            @if($leave->student_id)
                                                <span class="badge bg-secondary-subtle text-secondary border">Student</span>
                                            @else
                                                <span class="badge bg-info-subtle text-info border">{{ $leave->user->role->name ?? 'Staff' }}</span>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $leave->type }}</span>
                            </td>
                            <td>
                                <div class="fw-medium text-dark">{{ $leave->start_date->format('M d') }} - {{ $leave->end_date->format('M d') }}</div>
                                <small class="text-muted">{{ $leave->start_date->diffInDays($leave->end_date) + 1 }} Days</small>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 250px;" title="{{ $leave->reason }}">
                                    {{ $leave->reason }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if($leave->status === 'pending')
                                    <span class="badge bg-warning-subtle text-warning border px-3 py-2 rounded-pill">Pending</span>
                                @elseif($leave->status === 'approved')
                                    <span class="badge bg-success-subtle text-success border px-3 py-2 rounded-pill">Approved</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border px-3 py-2 rounded-pill">Rejected</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    @if($leave->status === 'pending')
                                        @php
                                            $user = auth()->user();
                                            $canReview = $user->isInstituteAdmin() || $user->isPrincipal() || ($user->isTeacher() && $leave->student_id);
                                        @endphp
                                        
                                        @if($canReview)
                                            <form action="{{ route('leaves.update', $leave->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-sm btn-success rounded-3 px-3 shadow-none border-0" title="Approve" onclick="return confirm('Approve this leave request?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger rounded-3 px-3 shadow-none border-0" 
                                                    title="Reject" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $leave->id }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @elseif($leave->canBeWithdrawnByApplicant())
                                            <form action="{{ route('leaves.revert', $leave->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-light text-danger rounded-3 px-3 shadow-none border" title="Withdraw" onclick="return confirm('Withdraw your leave request?')">
                                                    <i class="fas fa-undo me-1"></i> <small>Withdraw</small>
                                                </button>
                                            </form>
                                        @endif
                                    @elseif($leave->canBeRevertedByReviewer() && (auth()->user()->isInstituteAdmin() || auth()->user()->isPrincipal() || (auth()->user()->isTeacher() && $leave->student_id)))
                                        <form action="{{ route('leaves.revert', $leave->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-light text-primary rounded-3 px-3 shadow-none border" title="Undo Decision" onclick="return confirm('Revert this decision back to pending?')">
                                                <i class="fas fa-history me-1"></i> <small>Revert</small>
                                            </button>
                                        </form>
                                    @endif

                                    @if($leave->status === 'rejected' && $leave->rejection_reason)
                                        <button class="btn btn-sm btn-light border-0 rounded-circle text-danger shadow-none" title="Reason: {{ $leave->rejection_reason }}">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="fas fa-calendar-alt text-light display-1 mb-3"></i>
                                    <h5 class="text-muted">No leave requests found</h5>
                                    <p class="text-muted small">New applications will appear here once submitted.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($leaves->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $leaves->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@section('modals')
    @foreach($leaves as $leave)
        @if($leave->status === 'pending' && (auth()->user()->isInstituteAdmin() || auth()->user()->isPrincipal() || (auth()->user()->isTeacher() && $leave->student_id)))
            {{-- Reject Modal --}}
            <div class="modal fade" id="rejectModal{{ $leave->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4 text-start">
                        <form action="{{ route('leaves.update', $leave) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-bold">Reject Leave Request</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body py-4">
                                <p class="text-muted small mb-3">Please provide a reason for rejecting the leave request from <strong>{{ $leave->user->name ?? $leave->student->name }}</strong>.</p>
                                <div class="form-floating">
                                    <textarea class="form-control" name="rejection_reason" id="rejection_reason{{ $leave->id }}" 
                                            placeholder="Leave a comment here" style="height: 120px"></textarea>
                                    <label for="rejection_reason{{ $leave->id }}">Rejection Reason (Optional)</label>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-light btn-modern text-muted" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger btn-modern px-4">Confirm Rejection</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
