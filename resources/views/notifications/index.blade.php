@extends('layouts.admin')

@section('title', 'Notifications')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="fas fa-bell text-primary me-2"></i>Notifications</h4>
        <p class="text-muted small mb-0">Send targeted or general alerts to student portals</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
</div>
@endif

<div class="row g-4">

    {{-- ── LEFT: SEND FORM ── --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm" style="border-radius:18px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                <h6 class="fw-bold text-dark mb-0" style="font-size:0.82rem;text-transform:uppercase;letter-spacing:1px;">
                    <i class="fas fa-paper-plane text-primary me-2"></i>Send New Notification
                </h6>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('notifications.send') }}" method="POST" id="notifForm">
                    @csrf

                    {{-- Type Toggle --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.5px;">Notification Type</label>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary flex-fill type-btn active" data-type="student" onclick="setType('student', this)">
                                <i class="fas fa-user me-1"></i> Specific Student
                            </button>
                            <button type="button" class="btn btn-outline-secondary flex-fill type-btn" data-type="general" onclick="setType('general', this)">
                                <i class="fas fa-users me-1"></i> General
                            </button>
                        </div>
                        <input type="hidden" name="type" id="typeInput" value="student">
                    </div>

                    {{-- Step 1: Batch filter (shown when type = student) --}}
                    <div class="mb-3" id="studentBatchField">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.5px;">Step 1 — Select Batch</label>
                        <select id="filterBatchSelect" class="form-select" onchange="filterStudents(this.value)">
                            <option value="">Choose a batch...</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Step 2: Student selector (populated after batch is chosen) --}}
                    <div class="mb-3 d-none" id="studentField">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.5px;">Step 2 — Select Student</label>
                        <select name="student_id" id="studentSelect" class="form-select">
                            <option value="">Choose a student...</option>
                        </select>
                    </div>

                    {{-- Batch selector (shown when type = general) --}}
                    <div class="mb-3 d-none" id="batchField">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.5px;">Send To</label>
                        <select name="batch_id" class="form-select">
                            <option value="">All Students (entire institute)</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">Batch: {{ $batch->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text text-muted mt-1">Leave blank to send to every active student.</div>
                    </div>

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.5px;">Title</label>
                        <input type="text" name="title" class="form-control" required maxlength="100" placeholder="e.g. Fee Reminder, Holiday Notice...">
                    </div>

                    {{-- Message --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.5px;">Message</label>
                        <textarea name="message" class="form-control" rows="3" required maxlength="500" placeholder="Write your notification message here..."></textarea>
                    </div>

                    {{-- Icon + Color row --}}
                    <div class="row g-3 mb-4">
                        <div class="col-7">
                            <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.5px;">Icon</label>
                            <select name="icon" class="form-select form-select-sm">
                                <option value="fas fa-bell">🔔 Bell</option>
                                <option value="fas fa-info-circle">ℹ️ Info</option>
                                <option value="fas fa-exclamation-triangle">⚠️ Warning</option>
                                <option value="fas fa-check-circle">✅ Success</option>
                                <option value="fas fa-calendar-alt">📅 Calendar</option>
                                <option value="fas fa-book-open">📖 Homework</option>
                                <option value="fas fa-file-alt">📄 Test</option>
                                <option value="fas fa-wallet">💰 Payment</option>
                                <option value="fas fa-video">📹 Lecture</option>
                            </select>
                        </div>
                        <div class="col-5">
                            <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.5px;">Color</label>
                            <select name="color" class="form-select form-select-sm">
                                <option value="primary">🔵 Blue</option>
                                <option value="success">🟢 Green</option>
                                <option value="warning">🟡 Yellow</option>
                                <option value="danger">🔴 Red</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold py-2" style="border-radius:10px;">
                        <i class="fas fa-paper-plane me-2"></i>Send Notification
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ── RIGHT: HISTORY ── --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:18px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0" style="font-size:0.82rem;text-transform:uppercase;letter-spacing:1px;">
                    <i class="fas fa-history text-primary me-2"></i>Recently Sent
                </h6>
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill" style="font-size:0.7rem;">Last 30</span>
            </div>
            <div class="card-body p-0" style="max-height:620px;overflow-y:auto;">
                @forelse($history as $notif)
                @php
                    $colorMap = [
                        'primary' => ['bg' => 'rgba(99,102,241,0.1)', 'color' => '#6366F1'],
                        'success' => ['bg' => 'rgba(16,185,129,0.1)', 'color' => '#10B981'],
                        'warning' => ['bg' => 'rgba(245,158,11,0.1)', 'color' => '#F59E0B'],
                        'danger'  => ['bg' => 'rgba(239,68,68,0.1)',  'color' => '#EF4444'],
                    ];
                    $c = $colorMap[$notif->data['color'] ?? 'primary'] ?? $colorMap['primary'];
                @endphp
                <div class="d-flex align-items-start gap-3 px-4 py-3 border-bottom" style="border-color:#F1F5F9!important;">
                    {{-- Icon --}}
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3"
                         style="width:36px;height:36px;background:{{ $c['bg'] }};color:{{ $c['color'] }};">
                        <i class="{{ $notif->data['icon'] ?? 'fas fa-bell' }}" style="font-size:0.8rem;"></i>
                    </div>
                    {{-- Content --}}
                    <div class="flex-grow-1 min-w-0">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div>
                                <div class="fw-semibold text-dark" style="font-size:0.84rem;">{{ $notif->data['title'] }}</div>
                                <div class="text-muted small mt-1" style="font-size:0.75rem;line-height:1.4;">{{ Str::limit($notif->data['message'], 80) }}</div>
                            </div>
                            @if($notif->read_at)
                                <span class="badge rounded-pill flex-shrink-0" style="background:#F0FDF4;color:#166534;font-size:0.62rem;">Read</span>
                            @else
                                <span class="badge rounded-pill flex-shrink-0" style="background:#EEF2FF;color:#4338CA;font-size:0.62rem;">Unread</span>
                            @endif
                        </div>
                        <div class="mt-1 d-flex gap-3" style="font-size:0.7rem;color:#94A3B8;">
                            <span><i class="fas fa-user me-1"></i>{{ $notif->student_name }}</span>
                            <span><i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-bell-slash fa-2x opacity-25 mb-3 d-block"></i>
                    <h6 class="fw-bold text-dark">No notifications sent yet</h6>
                    <p class="small mb-0">Use the form to send your first notification.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
// All students keyed by batch_id, embedded as JSON
const studentsByBatch = @json($students->groupBy('batch_id')->map(fn($g) => $g->map(fn($s) => ['id' => $s->id, 'name' => $s->name])));

function filterStudents(batchId) {
    const studentField = document.getElementById('studentField');
    const select = document.getElementById('studentSelect');

    select.innerHTML = '<option value="">Choose a student...</option>';

    if (!batchId) {
        studentField.classList.add('d-none');
        return;
    }

    const students = studentsByBatch[batchId] || [];
    students.forEach(s => {
        const opt = document.createElement('option');
        opt.value = s.id;
        opt.textContent = s.name;
        select.appendChild(opt);
    });

    studentField.classList.remove('d-none');
}

function setType(type, btn) {
    document.getElementById('typeInput').value = type;

    // Toggle buttons
    document.querySelectorAll('.type-btn').forEach(b => {
        b.classList.remove('btn-primary');
        b.classList.add('btn-outline-secondary');
    });
    btn.classList.remove('btn-outline-secondary');
    btn.classList.add('btn-primary');

    const isStudent = type === 'student';

    // Show/hide student flow fields
    document.getElementById('studentBatchField').classList.toggle('d-none', !isStudent);
    document.getElementById('studentField').classList.add('d-none'); // always reset step 2
    document.getElementById('filterBatchSelect').value = '';
    document.getElementById('studentSelect').innerHTML = '<option value="">Choose a student...</option>';

    // Show/hide general batch field
    document.getElementById('batchField').classList.toggle('d-none', isStudent);
}
</script>
@endpush
