@extends('student.layouts.app')
@section('title', 'Exam: ' . $onlineExam->title)
@section('content')

<!-- Hide layout elements to focus 100% on the exam -->
<style>
    .subpage-navbar {
        display: none !important;
    }
    .page {
        padding: 0 !important;
        max-width: 100% !important;
        margin: 0 !important;
    }
    body {
        background-color: #0F172A !important; /* Deep Slate dark background */
        color: #F8FAFC !important;
        overflow: hidden;
    }
</style>

<style>
    :root {
        --oe-navy-dark: #090D1A;
        --oe-navy-light: #1E293B;
        --oe-border: #334155;
        --oe-indigo: #6366F1;
        --oe-emerald: #10B981;
        --oe-red: #EF4444;
        --oe-text-muted: #94A3B8;
    }

    .exam-wrapper {
        display: flex;
        height: 100vh;
        width: 100vw;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999;
        font-family: 'Inter', sans-serif;
    }

    /* Fullscreen Block Overlay */
    #fullscreen-overlay {
        position: fixed;
        inset: 0;
        background: rgba(9, 13, 26, 0.95);
        backdrop-filter: blur(12px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        padding: 20px;
    }

    .fs-card {
        background: #1E293B;
        border: 1px solid #334155;
        border-radius: 24px;
        padding: 40px;
        max-width: 550px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }

    .fs-icon {
        width: 80px;
        height: 80px;
        background: rgba(99, 102, 241, 0.1);
        border: 2px dashed var(--oe-indigo);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--oe-indigo);
        margin: 0 auto 24px;
        animation: spin-pulse 3s infinite linear;
    }

    /* Left Sidebar: Progress & Control */
    .exam-sidebar {
        width: 320px;
        background: var(--oe-navy-dark);
        border-right: 1px solid var(--oe-border);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 30px 24px;
        flex-shrink: 0;
    }

    /* Main Examination Arena */
    .exam-arena {
        flex-grow: 1;
        background: #0F172A;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }

    .arena-header {
        background: #1E293B;
        border-bottom: 1px solid var(--oe-border);
        padding: 20px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .arena-body {
        flex-grow: 1;
        padding: 60px 80px;
        max-width: 900px;
        margin: 0 auto;
        width: 100%;
    }

    /* Circular Timer Widget */
    .timer-widget {
        background: rgba(30, 41, 59, 0.5);
        border: 1px solid var(--oe-border);
        border-radius: 16px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
    }

    .timer-digits {
        font-size: 1.6rem;
        font-weight: 800;
        font-family: monospace;
        color: #fff;
        letter-spacing: 0.5px;
    }

    /* Grid of Question Numbers */
    .nav-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
        margin-top: 15px;
        max-height: 250px;
        overflow-y: auto;
        padding-right: 4px;
    }

    .nav-btn {
        background: #1E293B;
        border: 1px solid var(--oe-border);
        border-radius: 10px;
        height: 42px;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--oe-text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .nav-btn:hover {
        border-color: var(--oe-indigo);
        color: #fff;
    }

    .nav-btn.active {
        border-color: var(--oe-indigo);
        background: rgba(99, 102, 241, 0.2);
        color: #fff;
        box-shadow: 0 0 10px rgba(99, 102, 241, 0.25);
    }

    .nav-btn.answered {
        background: var(--oe-emerald);
        border-color: var(--oe-emerald);
        color: #fff;
    }

    .nav-btn.answered.active {
        box-shadow: 0 0 12px rgba(16, 185, 129, 0.4);
    }

    /* Option Card Styling */
    .option-card {
        background: #1E293B;
        border: 1px solid var(--oe-border);
        border-radius: 16px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-bottom: 16px;
        position: relative;
    }

    .option-card:hover {
        border-color: var(--oe-indigo);
        background: rgba(99, 102, 241, 0.05);
        transform: translateX(4px);
    }

    .option-card.selected {
        background: rgba(99, 102, 241, 0.15);
        border-color: var(--oe-indigo);
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.1);
    }

    .option-marker {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        border: 1.5px solid var(--oe-border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: var(--oe-text-muted);
        transition: all 0.2s;
    }

    .option-card.selected .option-marker {
        background: var(--oe-indigo);
        border-color: var(--oe-indigo);
        color: #fff;
    }

    .option-text {
        font-size: 1rem;
        color: #E2E8F0;
    }

    /* Stepper Buttons */
    .step-btn {
        background: #1E293B;
        border: 1px solid var(--oe-border);
        color: #fff;
        font-weight: 700;
        padding: 12px 24px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .step-btn:hover:not(:disabled) {
        background: var(--oe-indigo);
        border-color: var(--oe-indigo);
    }

    .step-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    /* Save Indicator */
    .save-indicator {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--oe-text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.02);
        border: 1px solid var(--oe-border);
        padding: 6px 14px;
        border-radius: 50px;
    }

    .save-spinner {
        display: none;
        width: 12px;
        height: 12px;
        border: 2px solid rgba(255,255,255,0.2);
        border-top-color: var(--oe-emerald);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    @keyframes spin-pulse {
        0% { transform: scale(1) rotate(0deg); }
        50% { transform: scale(1.08) rotate(180deg); }
        100% { transform: scale(1) rotate(360deg); }
    }

    /* Submit Confirmation Modal custom colors */
    .modal-content-custom {
        background: #1E293B !important;
        border: 1px solid var(--oe-border) !important;
        border-radius: 24px !important;
        color: #F8FAFC !important;
    }
</style>

<div class="exam-wrapper">
    <!-- Fullscreen Lock Screen Overlay -->
    <div id="fullscreen-overlay">
        <div class="fs-card">
            <div class="fs-icon">
                <i class="fas fa-expand"></i>
            </div>
            <h3 class="fw-black mb-3">Fullscreen Enforced</h3>
            <p class="text-secondary small mb-4" style="color: var(--oe-text-muted) !important; line-height: 1.6;">
                To prevent academic dishonesty, this examination must be completed in Fullscreen Mode. Switching windows, exiting fullscreen, or minimizing will log warnings and may result in automatic submission.
            </p>
            <button onclick="enterFullscreen()" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold" style="background: var(--oe-indigo); border:none; box-shadow: 0 4px 15px rgba(99,102,241,0.4);">
                Enter Fullscreen & Resume
            </button>
        </div>
    </div>

    <!-- Left sidebar control console -->
    <div class="exam-sidebar">
        <div>
            <!-- Exam Info -->
            <span style="font-size: 0.72rem; font-weight: 800; color: #67E8F9; text-transform: uppercase; letter-spacing: 1px;"><i class="fas fa-university me-1"></i> {{ auth()->guard('student')->user()->institute->name }}</span>
            <h4 class="fw-extrabold mt-2 text-white" style="font-size: 1.25rem; letter-spacing: -0.3px; line-height: 1.3;">{{ $onlineExam->title }}</h4>
            <p class="text-secondary small mb-4" style="color: var(--oe-text-muted) !important;">Subject: {{ $onlineExam->subject->name }}</p>

            <hr style="border-color: var(--oe-border); margin: 24px 0;">

            <!-- Timer Widget -->
            <div class="timer-widget">
                <div style="width: 42px; height: 42px; background: rgba(99, 102, 241, 0.1); border-radius: 50%; display:flex; align-items:center; justify-content:center; color: var(--oe-indigo);">
                    <i class="fas fa-clock fs-5"></i>
                </div>
                <div>
                    <div style="font-size: 0.65rem; font-weight: 700; color: var(--oe-text-muted); text-transform: uppercase; letter-spacing: 0.8px;">Remaining Time</div>
                    <div class="timer-digits" id="timerDisplay">00:00:00</div>
                </div>
            </div>

            <!-- Proctoring Monitor status -->
            <div class="d-flex align-items-center justify-content-between bg-dark-subtle p-3 rounded-4 border mb-4" style="border-color: var(--oe-border) !important; background: rgba(9, 13, 26, 0.4);">
                <div class="d-flex align-items-center gap-2">
                    <span class="d-inline-block" style="width:8px; height:8px; border-radius:50%; background: var(--oe-emerald); box-shadow: 0 0 8px var(--oe-emerald);"></span>
                    <span class="small fw-semibold text-secondary" style="color: var(--oe-text-muted) !important;">Proctor Monitor Active</span>
                </div>
                <div class="small fw-bold text-warning" id="tabSwitchIndicator">0 Warnings</div>
            </div>

            <!-- Question Navigation Grid -->
            <div>
                <div style="font-size: 0.68rem; font-weight: 800; color: var(--oe-text-muted); text-transform: uppercase; letter-spacing: 1px;">Question Navigator</div>
                <div class="nav-grid" id="navigatorGrid">
                    @foreach($questions as $index => $q)
                        @php $hasAnswered = isset($answers[$q->id]) && !is_null($answers[$q->id]->selected_option); @endphp
                        <div class="nav-btn {{ $hasAnswered ? 'answered' : '' }}" 
                             id="nav-btn-{{ $q->id }}" 
                             onclick="jumpToQuestion({{ $index }})">
                            {{ $index + 1 }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <button class="btn w-100 btn-danger rounded-4 py-3 fw-bold" onclick="showSubmitConfirmation()" style="background: var(--oe-red); border:none; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);">
                <i class="fas fa-paper-plane me-2"></i> Submit Examination
            </button>
        </div>
    </div>

    <!-- Main Examination Arena -->
    <div class="exam-arena">
        <!-- Header status bar -->
        <div class="arena-header">
            <div class="d-flex align-items-center gap-3">
                <span class="badge" style="background: var(--oe-navy-light); border: 1px solid var(--oe-border); font-size: 0.8rem; padding: 6px 12px; border-radius: 30px;">
                    Question <span id="currentQuestionNum">1</span> of {{ $questions->count() }}
                </span>
                <span class="badge" style="background: var(--oe-navy-light); border: 1px solid var(--oe-border); font-size: 0.8rem; padding: 6px 12px; border-radius: 30px;">
                    Marks: <span id="currentQuestionMarks">1</span>
                </span>
            </div>

            <!-- AJAX Save notification status -->
            <div class="save-indicator">
                <div class="save-spinner" id="saveSpinner"></div>
                <i class="fas fa-check-circle text-emerald" id="saveCheck"></i>
                <span id="saveStatus">Synced with Cloud</span>
            </div>
        </div>

        <!-- Body showing current question -->
        <div class="arena-body">
            @foreach($questions as $index => $q)
                @php 
                    $savedAns = $answers[$q->id]->selected_option ?? null; 
                @endphp
                <div class="question-container" id="q-container-{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                    <div style="font-size: 1.25rem; font-weight: 700; line-height: 1.5; color: #fff; margin-bottom: 40px;">
                        {{ $q->question }}
                    </div>

                    <!-- Option Cards -->
                    <div class="options-group">
                        @foreach(['a', 'b', 'c', 'd'] as $optKey)
                            @php 
                                $optVal = $q->{'option_' . $optKey}; 
                            @endphp
                            @if(!empty($optVal))
                                <div class="option-card {{ $savedAns === $optKey ? 'selected' : '' }}" 
                                     id="opt-card-{{ $q->id }}-{{ $optKey }}"
                                     onclick="selectOption('{{ $q->id }}', '{{ $optKey }}')">
                                    <div class="option-marker">{{ strtoupper($optKey) }}</div>
                                    <div class="option-text">{{ $optVal }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Clear Selection Link -->
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-link text-secondary text-decoration-none small" 
                                onclick="clearSelection('{{ $q->id }}')" 
                                style="color: var(--oe-text-muted) !important; font-size: 0.85rem;">
                            <i class="fas fa-undo me-1"></i> Clear selection
                        </button>
                    </div>
                </div>
            @endforeach

            <!-- Action buttons panel -->
            <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top" style="border-color: var(--oe-border) !important;">
                <button type="button" class="step-btn" id="prevBtn" onclick="navigateQuestion(-1)">
                    <i class="fas fa-chevron-left"></i> Previous Question
                </button>
                <button type="button" class="step-btn" id="nextBtn" onclick="navigateQuestion(1)">
                    Next Question <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Submit Confirmation Modal -->
<div class="modal fade" id="submitModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-body p-4 text-center">
                <div style="width: 70px; height: 70px; background: rgba(16, 185, 129, 0.1); border-radius: 50%; display:flex; align-items:center; justify-content:center; color: var(--oe-emerald); margin: 0 auto 20px;">
                    <i class="fas fa-check-double fs-3"></i>
                </div>
                <h4 class="fw-extrabold mb-3">Ready to Submit?</h4>
                <p class="text-secondary small mb-4" style="color: var(--oe-text-muted) !important;">
                    You are about to finish the exam. Please review your attempt statistics below before finalizing.
                </p>

                <!-- Statistics panel -->
                <div class="row g-2 mb-4 bg-dark-subtle p-3 rounded-4 border" style="border-color: var(--oe-border) !important; background: rgba(9, 13, 26, 0.35);">
                    <div class="col-6 text-center border-end" style="border-color: var(--oe-border) !important;">
                        <h3 class="fw-bold mb-0 text-success" id="answeredCount">0</h3>
                        <span class="small text-secondary" style="color: var(--oe-text-muted) !important;">Answered</span>
                    </div>
                    <div class="col-6 text-center">
                        <h3 class="fw-bold mb-0 text-warning" id="unansweredCount">0</h3>
                        <span class="small text-secondary" style="color: var(--oe-text-muted) !important;">Unanswered</span>
                    </div>
                </div>

                <form id="submitForm" action="{{ route('student.online-exams.submit', $onlineExam) }}" method="POST">
                    @csrf
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-secondary w-100 rounded-4 py-3 fw-bold border" data-bs-dismiss="modal" style="background:#1E293B; border-color: var(--oe-border); color: #fff;">
                            Cancel & Resume
                        </button>
                        <button type="submit" class="btn btn-success w-100 rounded-4 py-3 fw-bold" style="background: var(--oe-emerald); border:none; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);">
                            Yes, Submit Exam
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // State variables
    let currentQuestionIndex = 0;
    const totalQuestions = {{ $questions->count() }};
    const questionMetadata = [
        @foreach($questions as $q)
        { id: "{{ $q->id }}", marks: {{ $q->marks }} },
        @endforeach
    ];
    let remainingSeconds = {{ $session->remaining_seconds }};
    let warningCount = {{ $session->tab_switch_count ?? 0 }};
    let isSaving = false;

    // Fullscreen state check
    function enterFullscreen() {
        const docEl = document.documentElement;
        if (docEl.requestFullscreen) {
            docEl.requestFullscreen();
        } else if (docEl.webkitRequestFullscreen) {
            docEl.webkitRequestFullscreen();
        } else if (docEl.msRequestFullscreen) {
            docEl.msRequestFullscreen();
        }
    }

    function checkFullscreen() {
        const isFullscreen = document.fullscreenElement || 
                            document.webkitFullscreenElement || 
                            document.mozFullScreenElement || 
                            document.msFullscreenElement;
        
        const overlay = document.getElementById('fullscreen-overlay');
        if (isFullscreen) {
            overlay.style.display = 'none';
        } else {
            overlay.style.display = 'flex';
        }
    }

    // Bind Fullscreen events
    document.addEventListener('fullscreenchange', checkFullscreen);
    document.addEventListener('webkitfullscreenchange', checkFullscreen);
    document.addEventListener('mozfullscreenchange', checkFullscreen);
    document.addEventListener('MSFullscreenChange', checkFullscreen);

    // Initial fullscreen check
    window.onload = function() {
        checkFullscreen();
        startTimer();
    };

    // Countdown Timer logic
    function startTimer() {
        const display = document.getElementById('timerDisplay');
        const interval = setInterval(function() {
            if (remainingSeconds <= 0) {
                clearInterval(interval);
                display.innerText = "00:00:00";
                autoSubmitExam();
                return;
            }
            remainingSeconds--;

            let hrs = Math.floor(remainingSeconds / 3600);
            let mins = Math.floor((remainingSeconds % 3600) / 60);
            let secs = remainingSeconds % 60;

            display.innerText = 
                (hrs < 10 ? '0' + hrs : hrs) + ':' +
                (mins < 10 ? '0' + mins : mins) + ':' +
                (secs < 10 ? '0' + secs : secs);

            // Change timer color to red on remaining < 5 mins
            if (remainingSeconds < 300) {
                display.style.color = 'var(--oe-red)';
            }
        }, 1000);
    }

    // Auto submit on timer expired
    function autoSubmitExam() {
        alert('Your examination time has expired. Submitting your answers automatically now.');
        document.getElementById('submitForm').submit();
    }

    // Tab switch proctoring tracking
    let tabSwitchTimer = null;
    window.addEventListener('blur', function() {
        // Debounce double blur fires
        if (tabSwitchTimer) return;
        tabSwitchTimer = setTimeout(logTabSwitch, 300);
    });

    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            logTabSwitch();
        }
    });

    function logTabSwitch() {
        if (tabSwitchTimer) {
            clearTimeout(tabSwitchTimer);
            tabSwitchTimer = null;
        }

        fetch("{{ route('student.online-exams.track-tab', $onlineExam) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            warningCount = data.count;
            document.getElementById('tabSwitchIndicator').innerText = warningCount + ' Warnings';
            // Show subtle modal warning inside fullscreen
            console.log('Tab switch detected and proctored. Warning count:', warningCount);
        })
        .catch(err => console.error('Error logging proctor warning:', err));
    }

    // Navigation logic
    function showQuestion(index) {
        // Toggle question visibility
        for (let i = 0; i < totalQuestions; i++) {
            document.getElementById('q-container-' + i).style.display = (i === index) ? 'block' : 'none';
        }

        // Update headers
        document.getElementById('currentQuestionNum').innerText = index + 1;
        document.getElementById('currentQuestionMarks').innerText = questionMetadata[index].marks;

        // Update navigator active highlight
        document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));
        const activeNavBtn = document.getElementById('nav-btn-' + questionMetadata[index].id);
        if (activeNavBtn) activeNavBtn.classList.add('active');

        // Disable previous / next buttons
        document.getElementById('prevBtn').disabled = (index === 0);
        document.getElementById('nextBtn').disabled = (index === totalQuestions - 1);

        currentQuestionIndex = index;
    }

    function navigateQuestion(direction) {
        let newIndex = currentQuestionIndex + direction;
        if (newIndex >= 0 && newIndex < totalQuestions) {
            showQuestion(newIndex);
        }
    }

    function jumpToQuestion(index) {
        showQuestion(index);
    }

    // Ajax Save answers on selection
    function selectOption(questionId, optionKey) {
        // Highlight correct card UI
        const optionsGroup = document.getElementById('q-container-' + currentQuestionIndex).querySelectorAll('.option-card');
        optionsGroup.forEach(card => card.classList.remove('selected'));

        const selectedCard = document.getElementById('opt-card-' + questionId + '-' + optionKey);
        if (selectedCard) selectedCard.classList.add('selected');

        // Trigger AJAX save
        sendSaveRequest(questionId, optionKey);
    }

    function clearSelection(questionId) {
        // Clear card selected UI
        const optionsGroup = document.getElementById('q-container-' + currentQuestionIndex).querySelectorAll('.option-card');
        optionsGroup.forEach(card => card.classList.remove('selected'));

        // Trigger AJAX save with null value
        sendSaveRequest(questionId, null);
    }

    function sendSaveRequest(questionId, optionKey) {
        // Update UI saved indicator
        const spinner = document.getElementById('saveSpinner');
        const check = document.getElementById('saveCheck');
        const text = document.getElementById('saveStatus');

        spinner.style.display = 'block';
        check.style.display = 'none';
        text.innerText = "Saving changes...";

        fetch("{{ route('student.online-exams.save-answer', $onlineExam) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                question_id: questionId,
                selected_option: optionKey
            })
        })
        .then(res => res.json())
        .then(data => {
            spinner.style.display = 'none';
            check.style.display = 'block';
            text.innerText = "Synced with Cloud";

            // Mark question navigator button as answered/unanswered
            const navBtn = document.getElementById('nav-btn-' + questionId);
            if (navBtn) {
                if (optionKey) {
                    navBtn.classList.add('answered');
                } else {
                    navBtn.classList.remove('answered');
                }
            }
        })
        .catch(err => {
            console.error('Error saving answer:', err);
            spinner.style.display = 'none';
            text.innerText = "Sync Failed — Offline Mode";
            text.style.color = 'var(--oe-red)';
        });
    }

    // Submit confirmation modal statistics calculation
    function showSubmitConfirmation() {
        let answered = 0;
        document.querySelectorAll('.nav-grid .nav-btn').forEach(btn => {
            if (btn.classList.contains('answered')) {
                answered++;
            }
        });

        let unanswered = totalQuestions - answered;

        document.getElementById('answeredCount').innerText = answered;
        document.getElementById('unansweredCount').innerText = unanswered;

        // Show bootstrap modal
        const myModal = new bootstrap.Modal(document.getElementById('submitModal'));
        myModal.show();
    }
</script>
@endpush
@endsection
