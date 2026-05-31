@extends('student.layouts.app')

@section('title', 'Discipline Record')

@push('styles')
<style>
    .progress-bar-container {
        background: #F1F5F9;
        height: 32px;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        margin-bottom: 8px;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 16px;
        transition: width 1s ease-in-out, background-color 0.5s ease;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 16px;
        color: white;
        font-weight: 700;
        font-size: 0.9rem;
    }
    
    .score-excellent { background: linear-gradient(90deg, #10B981, #059669); }
    .score-good { background: linear-gradient(90deg, #3B82F6, #2563EB); }
    .score-warning { background: linear-gradient(90deg, #F59E0B, #D97706); }
    .score-danger { background: linear-gradient(90deg, #EF4444, #DC2626); }

    .infraction-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        gap: 16px;
        margin-bottom: 16px;
    }

    .infraction-points {
        background: #FEF2F2;
        color: #EF4444;
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .infraction-points.small { background: #FFFBEB; color: #F59E0B; }
    .infraction-points.mid { background: #FFF5F0; color: #fd7e14; }

    .infraction-details {
        flex-grow: 1;
    }

    .infraction-meta {
        font-size: 0.8rem;
        color: #64748B;
        margin-bottom: 8px;
    }
</style>
@endpush

@section('content')
<div class="mb-5">
    <div>
        <h4 class="fw-medium mb-1">My Discipline Record</h4>
        <p class="text-muted small mb-0">Track your behavior score and recorded infractions.</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-5">
    <div class="card-body p-4 p-md-5">
        <h5 class="fw-bold text-center mb-4 text-dark">Current Score: <span style="font-size: 2rem;">{{ $score }}%</span></h5>
        
        @php
            $barClass = 'score-excellent';
            if($score < 50) $barClass = 'score-danger';
            elseif($score < 80) $barClass = 'score-warning';
            elseif($score < 95) $barClass = 'score-good';
        @endphp

        <div class="progress-bar-container shadow-sm">
            <div class="progress-bar-fill {{ $barClass }}" style="width: {{ $score }}%;">
                @if($score > 10) {{ $score }}% @endif
            </div>
        </div>
        
        <div class="d-flex justify-content-between text-muted small mt-2 fw-medium">
            <span>Critical (0%)</span>
            <span>Perfect (100%)</span>
        </div>
        
        @if($totalDeductions == 0)
            <div class="mt-4 text-center text-success">
                <i class="fas fa-medal fa-2x mb-2"></i>
                <h6 class="fw-bold mb-0">Excellent Behavior!</h6>
                <p class="small text-muted">Keep up the good work. You have zero deductions.</p>
            </div>
        @endif
    </div>
</div>

<h5 class="fw-medium mb-4 text-dark"><i class="fas fa-clipboard-list me-2 text-muted"></i>Infraction History</h5>

@forelse($records as $record)
    <div class="infraction-card shadow-sm">
        <div class="infraction-points {{ $record->issue_level }}">
            -{{ $record->points_deducted }}
        </div>
        <div class="infraction-details">
            <div class="infraction-meta">
                <i class="far fa-calendar-alt me-1"></i> {{ $record->created_at->format('d M Y, h:i A') }}
                <span class="ms-3"><i class="fas fa-user-shield me-1"></i> Reported by {{ $record->reporter->name ?? 'System' }}</span>
            </div>
            <p class="mb-0 fw-medium text-dark">{{ $record->reason }}</p>
        </div>
    </div>
@empty
    <div class="p-5 text-center bg-white border rounded-4 border-dashed" style="border-style: dashed !important;">
        <i class="fas fa-leaf fa-3x text-success opacity-50 mb-3"></i>
        <h6 class="fw-medium text-success">Clean Record</h6>
        <p class="small text-muted mb-0">You have no recorded infractions.</p>
    </div>
@endforelse

@if($records->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $records->links() }}
    </div>
@endif
@endsection
