@extends('student.layouts.app')

@section('title', 'My Homework')

@push('styles')
<style>
    .hw-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 24px;
        transition: all 0.3s;
        box-shadow: 0 4px 12px -4px rgba(37, 99, 235, 0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .hw-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -6px rgba(37, 99, 235, 0.1);
        border-color: #2563EB;
    }

    .hw-badge {
        background: #FEF3C7;
        color: #D97706;
        padding: 6px 14px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        margin-bottom: 16px;
    }

    .hw-badge.urgent {
        background: #FEE2E2;
        color: #DC2626;
    }

    .hw-title {
        font-weight: 600;
        color: #0F172A;
        font-size: 1.15rem;
        margin-bottom: 8px;
    }

    .hw-subject {
        font-size: 0.9rem;
        color: #64748B;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .hw-description {
        font-size: 0.9rem;
        color: #475569;
        margin-bottom: 24px;
        flex-grow: 1;
    }

    .attachment-btn {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        color: #0F172A;
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }

    .attachment-btn:hover {
        background: #F1F5F9;
        color: #2563EB;
        border-color: #CBD5E1;
    }
</style>
@endpush

@section('content')
<div class="mb-5">
    <div>
        <h4 class="fw-medium mb-1">My Homework</h4>
        <p class="text-muted small mb-0">Track and download your latest assignments.</p>
    </div>
</div>

<h5 class="fw-medium mb-4 text-primary"><i class="fas fa-tasks me-2"></i>Active Assignments</h5>
<div class="row g-4 mb-5">
    @forelse($activeHomeworks as $hw)
        @php
            $isUrgent = $hw->due_date->diffInDays(now()) <= 2;
        @endphp
        <div class="col-md-6 col-lg-4">
            <div class="hw-card">
                <div>
                    <div class="hw-badge {{ $isUrgent ? 'urgent' : '' }}">
                        <i class="far fa-clock me-1"></i> Due: {{ $hw->due_date->format('d M Y') }}
                    </div>
                    <h5 class="hw-title">{{ $hw->title }}</h5>
                    <div class="hw-subject">
                        <i class="fas fa-book"></i> {{ $hw->subject->name ?? 'General' }}
                    </div>
                    <div class="hw-description">
                        {!! nl2br(e($hw->description)) !!}
                    </div>
                </div>
                
                @if($hw->attachments->count() > 0)
                    <div class="mt-3">
                        <hr class="mt-0 mb-3" style="opacity: 0.1;">
                        <a href="{{ Storage::url($hw->attachments->first()->file_path) }}" target="_blank" class="attachment-btn">
                            <i class="fas fa-download"></i> Download Attachment
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="p-5 text-center bg-white border rounded-4">
                <i class="fas fa-check-double fa-3x text-muted opacity-25 mb-3"></i>
                <h6 class="fw-medium text-muted">All Caught Up!</h6>
                <p class="small text-muted mb-0">You have no pending homework assignments.</p>
            </div>
        </div>
    @endforelse
</div>

<h5 class="fw-medium mb-4 text-dark"><i class="fas fa-archive me-2 text-muted"></i>Past Assignments</h5>
<div class="row g-4">
    @forelse($pastHomeworks as $hw)
        <div class="col-md-6 col-lg-4">
            <div class="hw-card" style="background: #F8FAFC; border-color: #F1F5F9; opacity: 0.85;">
                <div>
                    <div class="hw-badge bg-white text-muted border">
                        <i class="fas fa-check me-1"></i> Was due: {{ $hw->due_date->format('d M Y') }}
                    </div>
                    <h5 class="hw-title">{{ $hw->title }}</h5>
                    <div class="hw-subject">
                        <i class="fas fa-book"></i> {{ $hw->subject->name ?? 'General' }}
                    </div>
                </div>
                @if($hw->attachments->count() > 0)
                    <div class="mt-3">
                        <a href="{{ Storage::url($hw->attachments->first()->file_path) }}" target="_blank" class="attachment-btn bg-white">
                            <i class="fas fa-file-download"></i> View File
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="p-5 text-center border rounded-4 border-dashed" style="border-style: dashed !important;">
                <p class="small text-muted mb-0">No past assignments found.</p>
            </div>
        </div>
    @endforelse
</div>

@if($pastHomeworks->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $pastHomeworks->links() }}
    </div>
@endif
@endsection
