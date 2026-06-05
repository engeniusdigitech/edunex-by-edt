@extends('student.layouts.app')
@section('title', 'Exam Result: ' . $onlineExam->title)
@section('content')
<style>
    .res-header {
        border-radius: 20px;
        padding: 40px;
        color: #fff;
        margin-bottom: 30px;
        text-align: center;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }
    .res-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px);
        background-size: 20px 20px;
    }
    .res-pass {
        background: linear-gradient(135deg, #059669, #10B981);
    }
    .res-fail {
        background: linear-gradient(135deg, #DC2626, #EF4444);
    }
    .kpi-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.01);
        height: 100%;
    }
    .kpi-val {
        font-size: 1.8rem;
        font-weight: 850;
        color: var(--text);
        letter-spacing: -0.5px;
        margin-bottom: 4px;
    }
    .kpi-lbl {
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .review-q-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    .review-opt {
        border: 1.5px solid var(--border);
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.95rem;
    }
    .review-opt-correct {
        background: #F0FDF4;
        border-color: #10B981;
        color: #065F46;
    }
    .review-opt-incorrect {
        background: #FEF2F2;
        border-color: #EF4444;
        color: #991B1B;
    }
    .review-opt-selected {
        border-color: #3B82F6;
        background: #EFF6FF;
    }
    .opt-badge {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        background: #F1F5F9;
        color: #475569;
    }
    .review-opt-correct .opt-badge {
        background: #10B981;
        color: #fff;
    }
    .review-opt-incorrect .opt-badge {
        background: #EF4444;
        color: #fff;
    }
    .explain-box {
        background: #F8FAFC;
        border-left: 4px solid #6366F1;
        border-radius: 0 12px 12px 0;
        padding: 16px 20px;
        margin-top: 16px;
        font-size: 0.9rem;
        color: #334155;
    }
</style>

<div class="container py-2" style="max-width: 900px;">
    <!-- Result Header -->
    <div class="res-header {{ $session->is_passed ? 'res-pass' : 'res-fail' }}">
        <div style="position: relative; z-index: 2;">
            <div style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 2rem;">
                @if($session->is_passed)
                    <i class="fas fa-award"></i>
                @else
                    <i class="fas fa-times-circle"></i>
                @endif
            </div>
            <span style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase; color: rgba(255,255,255,0.85); letter-spacing: 1.5px;">Examination Finished</span>
            <h1 class="fw-black mt-2 mb-2" style="font-size: 2.2rem; letter-spacing: -1px;">{{ $session->is_passed ? 'Congratulations, You Passed!' : 'Exam Not Cleared' }}</h1>
            <p class="mb-0 small" style="opacity: 0.9;">{{ $onlineExam->title }} — Completed on {{ $session->submitted_at->format('M d, Y \a\t h:i A') }}</p>
        </div>
    </div>

    <!-- KPIs Row -->
    <div class="row g-3 mb-5">
        <div class="col-6 col-md-3">
            <div class="kpi-card">
                <div class="kpi-val">{{ $session->score }} / {{ $session->total_marks }}</div>
                <div class="kpi-lbl">Score Obtained</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="kpi-card">
                <div class="kpi-val">{{ $session->percentage }}%</div>
                <div class="kpi-lbl">Percentage</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="kpi-card">
                @if($rank)
                    <div class="kpi-val">#{{ $rank }}</div>
                @else
                    <div class="kpi-val">—</div>
                @endif
                <div class="kpi-lbl">Rank in Batch</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="kpi-card">
                <div class="kpi-val text-{{ $session->tab_switch_count > 3 ? 'danger' : 'muted' }}">{{ $session->tab_switch_count }}</div>
                <div class="kpi-lbl">Proctor Warnings</div>
            </div>
        </div>
    </div>

    @if(!$onlineExam->allow_review)
        <div class="alert alert-warning text-center rounded-4 border-warning-subtle py-4 px-3 mb-4">
            <i class="fas fa-lock fs-4 mb-2 d-block text-warning"></i>
            <h6 class="fw-bold">Answer Review is Locked</h6>
            <p class="small text-secondary mb-0">The administrator has disabled detailed option review and answer keys for this examination.</p>
        </div>
    @elseif($answers)
        <h4 class="mb-4 fw-black text-dark" style="letter-spacing: -0.3px;"><i class="fas fa-tasks text-primary me-2"></i> Question Key & Explanations</h4>

        @php $qNum = 1; @endphp
        @foreach($answers as $ans)
            @php 
                $q = $ans->question; 
                $isCorrect = $ans->is_correct;
                $unanswered = is_null($ans->selected_option);
            @endphp
            <div class="review-q-card">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start gap-3 mb-3 pb-3 border-bottom">
                    <div>
                        <span class="badge bg-secondary mb-2" style="font-size: 0.7rem; font-weight:700;">Question {{ $qNum++ }}</span>
                        <div class="fw-bold text-dark" style="font-size: 1.05rem; line-height: 1.4;">{{ $q->question }}</div>
                    </div>
                    <div>
                        @if($unanswered)
                            <span class="badge bg-warning text-dark py-2 px-3 rounded-pill fw-bold small"><i class="fas fa-exclamation-triangle"></i> Unanswered</span>
                        @elseif($isCorrect)
                            <span class="badge bg-success py-2 px-3 rounded-pill fw-bold small"><i class="fas fa-check"></i> Correct (+{{ $q->marks }} pts)</span>
                        @else
                            <span class="badge bg-danger py-2 px-3 rounded-pill fw-bold small"><i class="fas fa-times"></i> Incorrect</span>
                        @endif
                    </div>
                </div>

                <!-- Options -->
                <div>
                    @foreach(['a', 'b', 'c', 'd'] as $key)
                        @php 
                            $optText = $q->{'option_' . $key}; 
                            $isSelected = ($ans->selected_option === $key);
                            $isRight = ($q->correct_option === $key);

                            $class = '';
                            if ($isRight) {
                                $class = 'review-opt-correct';
                            } elseif ($isSelected && !$isRight) {
                                $class = 'review-opt-incorrect';
                            } elseif ($isSelected) {
                                $class = 'review-opt-selected';
                            }
                        @endphp
                        @if(!empty($optText))
                            <div class="review-opt {{ $class }}">
                                <div class="opt-badge">
                                    @if($isRight)
                                        <i class="fas fa-check"></i>
                                    @elseif($isSelected && !$isRight)
                                        <i class="fas fa-times"></i>
                                    @else
                                        {{ strtoupper($key) }}
                                    @endif
                                </div>
                                <div class="fw-semibold">{{ $optText }}</div>
                                @if($isSelected)
                                    <span class="ms-auto badge bg-primary small" style="font-size: 0.65rem;">Your Choice</span>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Explanation -->
                @if($q->bankQuestion && !empty($q->bankQuestion->explanation))
                    <div class="explain-box">
                        <div style="font-size: 0.72rem; font-weight:800; color: #4F46E5; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 4px;">
                            <i class="fas fa-lightbulb"></i> Explanation
                        </div>
                        <div>{{ $q->bankQuestion->explanation }}</div>
                    </div>
                @endif
            </div>
        @endforeach
    @endif

    <!-- Back Actions -->
    <div class="text-center mt-5">
        <a href="{{ route('student.online-exams.index') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #0EA5E9, #2563EB); border:none; box-shadow: 0 4px 15px rgba(37,99,241,0.35);">
            <i class="fas fa-arrow-left me-2"></i> Back to Online Exams
        </a>
    </div>
</div>
@endsection
