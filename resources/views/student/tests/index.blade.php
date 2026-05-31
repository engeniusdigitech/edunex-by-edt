@extends('student.layouts.app')

@section('title', 'My Tests & Exams')

@push('styles')
<style>
    .test-card {
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

    .test-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -6px rgba(37, 99, 235, 0.1);
        border-color: #2563EB;
    }

    .test-date-badge {
        background: #F0F9FF;
        color: #0284C7;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
        margin-bottom: 16px;
    }

    .test-title {
        font-weight: 600;
        color: #0F172A;
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .test-subject {
        font-size: 0.9rem;
        color: #64748B;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .test-marks {
        background: #F8FAFC;
        border: 1px dashed #CBD5E1;
        border-radius: 12px;
        padding: 12px;
        text-align: center;
        margin-top: auto;
    }

    .test-marks-val {
        font-size: 1.2rem;
        font-weight: 700;
        color: #0F172A;
    }

    .test-marks-label {
        font-size: 0.75rem;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .score-badge {
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        padding: 12px;
        border-radius: 12px;
        text-align: center;
        margin-top: auto;
    }
</style>
@endpush

@section('content')
<div class="mb-5">
    <div>
        <h4 class="fw-medium mb-1">My Tests & Exams</h4>
        <p class="text-muted small mb-0">View your upcoming tests and past scores.</p>
    </div>
</div>

<h5 class="fw-medium mb-4 text-primary"><i class="fas fa-calendar-alt me-2"></i>Upcoming Tests</h5>
<div class="row g-4 mb-5">
    @forelse($upcomingTests as $test)
        <div class="col-md-6 col-lg-4">
            <div class="test-card">
                <div>
                    <div class="test-date-badge">
                        <i class="far fa-calendar me-1"></i> {{ $test->test_date->format('d M Y') }}
                    </div>
                    <h5 class="test-title">{{ $test->title }}</h5>
                    <div class="test-subject">
                        <i class="fas fa-book"></i> {{ $test->subject->name ?? 'General' }}
                    </div>
                    @if($test->description)
                        <p class="text-muted small mb-4">{{ Str::limit($test->description, 80) }}</p>
                    @endif
                </div>
                <div class="test-marks">
                    <div class="test-marks-val">{{ $test->total_marks }}</div>
                    <div class="test-marks-label">Total Marks</div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="p-5 text-center bg-white border rounded-4">
                <i class="fas fa-clipboard-check fa-3x text-muted opacity-25 mb-3"></i>
                <h6 class="fw-medium text-muted">No Upcoming Tests</h6>
                <p class="small text-muted mb-0">You have no scheduled tests at the moment.</p>
            </div>
        </div>
    @endforelse
</div>

<h5 class="fw-medium mb-4 text-dark"><i class="fas fa-history me-2 text-muted"></i>Past Tests & Scores</h5>
<div class="row g-4">
    @forelse($pastTests as $test)
        <div class="col-md-6 col-lg-4">
            <div class="test-card" style="background: #F8FAFC; border-color: #F1F5F9;">
                <div>
                    <div class="test-date-badge bg-white text-muted border">
                        <i class="far fa-calendar-check me-1"></i> {{ $test->test_date->format('d M Y') }}
                    </div>
                    <h5 class="test-title">{{ $test->title }}</h5>
                    <div class="test-subject">
                        <i class="fas fa-book"></i> {{ $test->subject->name ?? 'General' }}
                    </div>
                </div>
                
                @php
                    $score = $test->scores->first();
                @endphp

                @if($score)
                    <div class="score-badge">
                        <div style="font-size: 1.5rem; font-weight: 700; line-height: 1;">{{ $score->marks_obtained }} <span style="font-size: 0.9rem; opacity: 0.8;">/ {{ $test->total_marks }}</span></div>
                        <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px; opacity: 0.9;">Score Obtained</div>
                    </div>
                @else
                    <div class="test-marks" style="background: white;">
                        <div class="test-marks-val text-muted">- / {{ $test->total_marks }}</div>
                        <div class="test-marks-label">Pending Evaluation</div>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="p-5 text-center border rounded-4 border-dashed" style="border-style: dashed !important;">
                <p class="small text-muted mb-0">No past tests found.</p>
            </div>
        </div>
    @endforelse
</div>

@if($pastTests->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $pastTests->links() }}
    </div>
@endif
@endsection
