@extends('layouts.admin')

@section('title', 'Student Leave Management')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h3 class="fw-bold"><i class="fas fa-users-rectangle text-primary me-2"></i> Student Leave Requests</h3>
            <p class="text-muted">Review and manage leave applications from students @if(auth()->user()->isTeacher()) in your assigned batches @endif.</p>
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
                        <th class="ps-4 py-3">Student</th>
                        <th class="py-3">Batch</th>
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
                                    <div class="avatar-sm bg-indigo-subtle text-indigo rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px; background: rgba(99, 102, 241, 0.1);">
                                        {{ substr($leave->student->name ?? '?', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $leave->student->name ?? 'N/A' }}</div>
                                        <small class="text-muted">Student ID: #{{ $leave->student->id ?? '---' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1">{{ $leave->student->batch->name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <div class="fw-medium text-dark">{{ $leave->start_date->format('M d') }} - {{ $leave->end_date->format('M d') }}</div>
                                <small class="text-muted">{{ $leave->start_date->diffInDays($leave->end_date) + 1 }} Days ({{ $leave->type }})</small>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;" title="{{ $leave->reason }}">
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
                                        <form action="{{ route('leaves.update', $leave->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-sm btn-success rounded-3 px-3 border-0 shadow-none" title="Approve" onclick="return confirm('Approve this student leave?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-danger rounded-3 px-3 border-0 shadow-none" 
                                                title="Reject" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $leave->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @elseif($leave->canBeRevertedByReviewer())
                                        @php
                                            $user = auth()->user();
                                            $canRevert = $user->isInstituteAdmin() || $user->isPrincipal();
                                            if (!$canRevert && $user->isTeacher()) {
                                                $canRevert = ($leave->student->batch->class_teacher_id ?? null) == $user->id;
                                            }
                                        @endphp

                                        @if($canRevert)
                                            <form action="{{ route('leaves.revert', $leave->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-light text-primary rounded-3 px-3 border shadow-none" title="Undo Decision" onclick="return confirm('Revert this decision back to pending?')">
                                                    <i class="fas fa-history me-1"></i> <small>Revert</small>
                                                </button>
                                            </form>
                                        @endif
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
                                    <i class="fas fa-user-clock text-light display-1 mb-3"></i>
                                    <h5 class="text-muted">No student leave requests</h5>
                                    <p class="text-muted small">When students apply for leave, they will appear here for your review.</p>
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
        @if($leave->status === 'pending')
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
                                <p class="text-muted small mb-3">Optional: Provide a reason for rejecting the leave request from <strong>{{ $leave->student->name ?? $leave->user->name }}</strong>.</p>
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
