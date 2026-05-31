@extends('student.layouts.app')

@section('title', 'Leave Management')

@push('styles')
<style>
    .card-block {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
        box-shadow: 0 4px 12px -4px rgba(37, 99, 235, 0.08);
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .btn-apply {
        background: linear-gradient(135deg, #2563EB 0%, #0D9488 50%, #10B981 100%);
        color: #fff;
        border: none;
        border-radius: 14px;
        padding: 12px 24px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-apply:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
    }

    .status-badge {
        font-size: 0.72rem;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending { background: #FEF3C7; color: #92400E; }
    .status-approved { background: #D1FAE5; color: #065F46; }
    .status-rejected { background: #FEE2E2; color: #991B1B; }

    .leave-item {
        padding: 20px;
        border-bottom: 1px solid #E2E8F0;
        transition: background 0.2s;
    }

    .leave-item:last-child { border-bottom: none; }
    .leave-item:hover { background: linear-gradient(135deg, rgba(37, 99, 235, 0.03) 0%, rgba(16, 185, 129, 0.03) 100%); }

    .leave-type { font-weight: 500; font-size: 1rem; color: #0F172A; }
    .leave-date { font-size: 0.85rem; color: #64748B; margin-top: 4px; }
    .leave-reason { font-size: 0.88rem; color: #0F172A; margin-top: 8px; opacity: 0.8; }
    
    .rejection-note {
        background: #FFF1F2;
        border: 1px solid #FECDD3;
        padding: 10px 15px;
        border-radius: 10px;
        margin-top: 12px;
        font-size: 0.8rem;
        color: #BE123C;
    }

    @media (max-width: 640px) {
        .header-section { flex-direction: column; align-items: stretch; gap: 16px; }
    }
</style>
@endpush

@section('content')
<div class="header-section">
    <div>
        <h4 class="fw-medium mb-1">Leave History</h4>
        <p class="text-muted small mb-0">Track and manage your leave applications.</p>
    </div>
    <a href="{{ route('student.leaves.create') }}" class="btn-apply text-center">
        <i class="fas fa-plus me-2"></i> Apply for Leave
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="card-block">
    @forelse($leaves as $leave)
        <div class="leave-item">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="leave-type">{{ $leave->type }}</div>
                    <div class="leave-date">
                        <i class="far fa-calendar-alt me-1"></i> 
                        {{ $leave->start_date->format('d M Y') }} - {{ $leave->end_date->format('d M Y') }}
                        <span class="mx-1 text-muted">•</span>
                        <span class="fw-medium" style="color: #2563EB;">{{ $leave->start_date->diffInDays($leave->end_date) + 1 }} Days</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    @if($leave->canBeWithdrawnByApplicant())
                        <form action="{{ route('student.leaves.revert', $leave->id) }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none p-0 fw-medium shadow-none" style="font-size: 0.75rem;" onclick="return confirm('Withdraw your leave request?')">
                                <i class="fas fa-undo me-1"></i> WITHDRAW
                            </button>
                        </form>
                    @endif
                    <span class="status-badge status-{{ $leave->status }}">
                        {{ $leave->status }}
                    </span>
                </div>
            </div>
            <div class="leave-reason">{{ $leave->reason }}</div>
            
            @if($leave->status === 'rejected' && $leave->rejection_reason)
                <div class="rejection-note">
                    <i class="fas fa-info-circle me-1"></i> <strong>Rejection Reason:</strong> {{ $leave->rejection_reason }}
                </div>
            @endif
        </div>
    @empty
        <div class="text-center py-5">
            <div class="mb-3 opacity-25">
                <i class="fas fa-calendar-minus fa-4x"></i>
            </div>
            <h6 class="fw-medium text-muted">No Leave Records Found</h6>
            <p class="small text-muted">When you apply for a leave, it will appear here.</p>
        </div>
    @endforelse
</div>

@if($leaves->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $leaves->links() }}
    </div>
@endif
@endsection
