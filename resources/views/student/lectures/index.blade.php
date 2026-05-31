@extends('student.layouts.app')

@section('title', 'Live Lectures')

@push('styles')
<style>
    .subject-header { color: #2563EB; border-bottom: 2px solid rgba(37, 99, 235, 0.15); padding-bottom: 10px; margin-bottom: 20px; font-weight: 500; }
    
    /* Live Card Styling */
    .live-session-card {
        background: linear-gradient(135deg, #2563EB, #10B981);
        color: white;
        border-radius: 20px;
        padding: 28px;
        position: relative;
        overflow: hidden;
        animation: pulse-shadow 2s infinite;
        box-shadow: 0 20px 40px -12px rgba(37, 99, 235, 0.3);
    }
    .live-session-card::before {
        content: '';
        position: absolute;
        top: -40%; right: -20%;
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(255,255,255,0.15), transparent 70%);
        pointer-events: none;
    }
    @keyframes pulse-shadow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4); }
        50% { box-shadow: 0 0 0 16px rgba(37, 99, 235, 0); }
    }
    .live-badge-student {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,0.25); color: white;
        font-size: 0.75rem; font-weight: 500;
        padding: 4px 12px; border-radius: 20px; letter-spacing: 1px;
    }
    .live-badge-student .dot { width: 8px; height: 8px; background: white; border-radius: 50%; animation: blink 1s infinite; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.2} }
    .btn-join-live {
        background: white; color: #2563EB;
        border: none; border-radius: 50px;
        padding: 12px 32px; font-weight: 500;
        font-size: 1rem; cursor: pointer;
        transition: all 0.2s;
        display: inline-flex; align-items: center; gap: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-decoration: none;
    }
    .btn-join-live:hover { transform: scale(1.04); box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3); color: #1D4ED8; text-decoration: none;}
    
    /* Regular lecture card */
    .lecture-card { border: 1px solid rgba(37, 99, 235, 0.08); border-radius: 20px; box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.08); background: #ffffff; transition: all 0.3s ease; height: 100%; }
    .lecture-card:hover { box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.12); transform: translateY(-4px); border-color: #2563EB !important; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="fw-medium mb-1" style="letter-spacing: -1px;">Live Lectures</h1>
        <p class="text-muted fs-5 mb-0">Lectures for {{ auth('student')->user()->batch->name }}</p>
    </div>
    <i class="fas fa-broadcast-tower fa-3x" style="color: #2563EB; opacity: 0.1;"></i>
</div>

{{-- ===== LIVE NOW SECTION ===== --}}
@if($liveLectures->isNotEmpty())
<div class="mb-5">
    <h4 class="fw-medium mb-3 text-danger"><i class="fas fa-circle me-2" style="animation: blink 1s infinite; font-size: 0.8rem;"></i> Happening Now</h4>
    <div class="row g-4">
        @foreach($liveLectures as $lecture)
        <div class="col-md-6 col-lg-4">
            <div class="live-session-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="live-badge-student"><div class="dot"></div> LIVE</div>
                    <span class="text-white-50 small">{{ $lecture->subject }}</span>
                </div>
                <h4 class="fw-medium text-white mb-1">{{ $lecture->title }}</h4>
                @if($lecture->description)
                    <p class="text-white-50 small mb-4">{{ Str::limit($lecture->description, 80) }}</p>
                @else
                    <div class="mb-4"></div>
                @endif
                <a href="{{ route('student.lectures.join', $lecture) }}" class="btn-join-live">
                    <i class="fas fa-video"></i> Join Live Session
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- ===== PAST LECTURES SECTION ===== --}}
@if($groupedLectures->isNotEmpty())
<div>
    <h4 class="fw-medium mb-4">Recording Library</h4>
    @foreach($groupedLectures as $subject => $lectures)
    <div class="mb-5">
        <h5 class="subject-header"><i class="fas fa-book me-2"></i>{{ $subject }}</h5>
        <div class="row g-4">
            @foreach($lectures as $lecture)
            <div class="col-md-6 col-lg-4">
                <div class="card lecture-card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="fw-medium mb-0 text-dark">{{ $lecture->title }}</h5>
                        <span class="badge bg-light text-secondary border rounded-pill px-2 py-1">
                            <i class="far fa-calendar-alt me-1"></i>{{ $lecture->recorded_at->format('M d') }}
                        </span>
                    </div>
                    @if($lecture->description)
                        <p class="text-muted small mb-4">{{ Str::limit($lecture->description, 100) }}</p>
                    @else
                        <p class="text-muted small mb-4 opacity-50"><i>No description provided.</i></p>
                    @endif
                    <div class="mt-auto">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary border rounded-pill px-3 py-2 fw-semibold">
                            <i class="fas fa-check-circle me-1"></i> Session Ended
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endif

@if($liveLectures->isEmpty() && $groupedLectures->isEmpty())
<div class="text-center py-5 bg-white border rounded-4 shadow-sm my-5">
    <i class="fas fa-broadcast-tower fa-4x text-muted mb-3 opacity-25"></i>
    <h4 class="fw-medium text-dark">No Lectures Yet</h4>
    <p class="text-muted mb-0">Check back when your teacher starts a live session!</p>
</div>
@endif
@endsection
