@extends('student.layouts.app')
@section('title', 'Online Exams')
@section('content')
<style>
    .oe-hero {
        background: linear-gradient(135deg, #0EA5E9, #2563EB);
        border-radius: 20px;
        padding: 36px;
        color: #fff;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3);
    }
    .oe-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.15) 1px, transparent 1px);
        background-size: 24px 24px;
        opacity: 0.8;
    }
    .sec-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E293B;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .exam-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }
    .exam-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.06);
        border-color: rgba(14, 165, 233, 0.25);
    }
    .exam-badge {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 30px;
        text-transform: uppercase;
        display: inline-block;
        letter-spacing: 0.5px;
    }
    .badge-live {
        background: #FEF2F2;
        color: #EF4444;
        border: 1.5px solid #FEE2E2;
        animation: pulseLive 2s infinite;
    }
    .badge-upcoming {
        background: #FFFBEB;
        color: #D97706;
        border: 1.5px solid #FEF3C7;
    }
    .badge-completed {
        background: #ECFDF5;
        color: #10B981;
        border: 1.5px solid #D1FAE5;
    }
    .exam-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.88rem;
        color: var(--muted);
        margin-bottom: 8px;
    }
    .exam-meta-item i {
        color: #0EA5E9;
        width: 16px;
    }
    .btn-action {
        font-weight: 700;
        font-size: 0.88rem;
        padding: 10px 20px;
        border-radius: 12px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-start {
        background: linear-gradient(135deg, #0EA5E9, #2563EB);
        color: #fff;
        border: none;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.2);
    }
    .btn-start:hover {
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        transform: translateY(-1px);
        color: #fff;
    }
    .btn-view {
        background: #F1F5F9;
        color: #334155;
        border: 1px solid var(--border);
    }
    .btn-view:hover {
        background: #E2E8F0;
        color: #1E293B;
    }
    @keyframes pulseLive {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }
</style>

<div class="oe-hero">
    <div style="position: relative; z-index: 2;">
        <span style="font-size: 0.8rem; font-weight: 800; text-transform: uppercase; color: #67E8F9; letter-spacing: 1.5px;"><i class="fas fa-laptop-code me-1"></i> Assessment Ecosystem</span>
        <h1 style="font-size: 2.2rem; font-weight: 850; margin: 8px 0 12px; letter-spacing: -1px;">Digital Assessment Platform</h1>
        <p style="font-size: 1.05rem; opacity: 0.9; margin: 0; max-width: 600px; font-weight: 400; line-height: 1.5;">Access examinations, complete timed tests with built-in remote proctoring, and review results instantly.</p>
    </div>
</div>

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show rounded-4 mb-4 border-info-subtle shadow-sm" role="alert">
        <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-success-subtle shadow-sm" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Available Exams -->
<div class="mb-5">
    <h3 class="sec-title"><i class="fas fa-file-signature text-primary"></i> Active & Upcoming Exams</h3>
    
    @if($exams->isEmpty())
        <div style="background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 48px; text-align: center; color: var(--muted);">
            <i class="fas fa-calendar-times fs-1 mb-3" style="color: #CBD5E1;"></i>
            <h5 class="text-dark fw-bold">No Exams Scheduled</h5>
            <p class="mb-0" style="font-size: 0.9rem;">There are no active or scheduled online exams for your batch at this moment.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($exams as $exam)
                @php
                    $session = $exam->sessions->first();
                    $now = \Carbon\Carbon::now();
                    $isUpcoming = $now->lt($exam->start_datetime);
                    $isLive = $now->between($exam->start_datetime, $exam->end_datetime);
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="exam-card">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="exam-badge {{ $isLive ? 'badge-live' : 'badge-upcoming' }}">
                                    {{ $isLive ? '• Live Now' : 'Upcoming' }}
                                </span>
                                <span style="font-size: 0.8rem; font-weight: 700; color: #64748B;">{{ $exam->subject->name }}</span>
                            </div>
                            
                            <h4 class="text-dark fw-extrabold mb-3" style="font-size: 1.15rem; letter-spacing: -0.3px; line-height: 1.3;">{{ $exam->title }}</h4>
                            
                            <div class="exam-meta mb-4">
                                <div class="exam-meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span><strong>Starts:</strong> {{ \Carbon\Carbon::parse($exam->start_datetime)->format('M d, h:i A') }}</span>
                                </div>
                                <div class="exam-meta-item">
                                    <i class="far fa-clock"></i>
                                    <span><strong>Duration:</strong> {{ $exam->duration_minutes }} mins</span>
                                </div>
                                <div class="exam-meta-item">
                                    <i class="fas fa-tasks"></i>
                                    <span><strong>Total Marks:</strong> {{ $exam->total_marks }} pts</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            @if($session && $session->status === 'submitted')
                                <div class="d-flex align-items-center justify-content-between bg-light rounded-3 p-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-check-circle text-emerald"></i>
                                        <span class="small fw-semibold text-secondary">Attempt Completed</span>
                                    </div>
                                    <a href="{{ route('student.online-exams.result', $exam) }}" class="btn btn-view btn-action">View Result</a>
                                </div>
                            @elseif($isUpcoming)
                                <button class="btn btn-secondary w-100 btn-action" disabled>
                                    <i class="fas fa-hourglass-start"></i> Commencing Soon
                                </button>
                            @else
                                <form action="{{ route('student.online-exams.start', $exam) }}" method="POST" onsubmit="return confirm('Do you want to start this exam now? The timer will start immediately.');">
                                    @csrf
                                    <button type="submit" class="btn btn-start w-100 btn-action">
                                        <i class="fas fa-play"></i> Start Examination
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Past Exams -->
<div>
    <h3 class="sec-title"><i class="fas fa-history text-secondary"></i> Assessment History</h3>
    
    @if($pastExams->isEmpty())
        <div style="background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 48px; text-align: center; color: var(--muted);">
            <i class="fas fa-folder-open fs-1 mb-3" style="color: #CBD5E1;"></i>
            <h5 class="text-dark fw-bold">No Past Records</h5>
            <p class="mb-0" style="font-size: 0.9rem;">You haven't completed any digital examinations yet.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($pastExams as $exam)
                @php
                    $session = $exam->sessions->first();
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="exam-card" style="background: #FAFAFA; border-color: #E2E8F0;">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="exam-badge badge-completed">Completed</span>
                                <span style="font-size: 0.8rem; font-weight: 700; color: #64748B;">{{ $exam->subject->name }}</span>
                            </div>
                            
                            <h4 class="text-dark fw-extrabold mb-3" style="font-size: 1.15rem; letter-spacing: -0.3px; line-height: 1.3;">{{ $exam->title }}</h4>
                            
                            <div class="exam-meta mb-4">
                                <div class="exam-meta-item">
                                    <i class="fas fa-calendar-check"></i>
                                    <span><strong>Submitted:</strong> {{ \Carbon\Carbon::parse($session->submitted_at)->format('M d, Y') }}</span>
                                </div>
                                <div class="exam-meta-item">
                                    <i class="fas fa-award"></i>
                                    <span><strong>Score obtained:</strong> {{ $session->score }} / {{ $exam->total_marks }}</span>
                                </div>
                                <div class="exam-meta-item">
                                    <i class="fas fa-percentage"></i>
                                    <span><strong>Result:</strong> 
                                        @if($session->is_passed)
                                            <span class="text-emerald fw-bold">Passed ({{ $session->percentage }}%)</span>
                                        @else
                                            <span class="text-danger fw-bold">Failed ({{ $session->percentage }}%)</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('student.online-exams.result', $exam) }}" class="btn btn-view w-100 btn-action">
                                <i class="fas fa-chart-bar"></i> Analytics & Explanation
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
