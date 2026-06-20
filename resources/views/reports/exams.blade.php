@extends('layouts.admin')

@section('title', 'Tests & Exams Report')

@push('styles')
<style>
    /* ── KPI ── */
    .kpi-grid { display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:28px; }
    .kpi-card { background:#fff;border:1px solid #E2E8F0;border-radius:16px;padding:20px 22px;display:flex;align-items:center;gap:14px;box-shadow:0 4px 14px -4px rgba(0,0,0,0.06);transition:transform .2s,box-shadow .2s; }
    .kpi-card:hover { transform:translateY(-2px);box-shadow:0 8px 24px -4px rgba(0,0,0,0.09); }
    .kpi-icon { width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.15rem;flex-shrink:0; }
    .kpi-val { font-size:1.65rem;font-weight:800;color:#0F172A;line-height:1.1;letter-spacing:-0.5px; }
    .kpi-lbl { font-size:0.68rem;font-weight:600;color:#64748B;text-transform:uppercase;letter-spacing:0.6px;margin-top:3px; }

    /* ── Tabs ── */
    .tab-strip { display:flex;gap:4px;background:#F1F5F9;border-radius:12px;padding:4px;margin-bottom:24px;width:fit-content; }
    .tab-btn { padding:8px 22px;border-radius:9px;font-size:0.85rem;font-weight:600;color:#64748B;text-decoration:none;transition:all .2s;border:none;background:none;cursor:pointer; }
    .tab-btn.active { background:#fff;color:#2563EB;box-shadow:0 2px 8px -2px rgba(0,0,0,0.1); }
    .tab-btn:hover:not(.active) { color:#0F172A; }

    /* ── Filter Card ── */
    .filter-card { background:#fff;border:1px solid #E2E8F0;border-radius:14px;padding:20px 22px;margin-bottom:24px;box-shadow:0 2px 8px -2px rgba(0,0,0,0.04); }
    .filter-label { font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;margin-bottom:6px; }
    .filter-select { border:1.5px solid #E2E8F0;border-radius:10px;padding:9px 14px;font-size:0.85rem;color:#0F172A;background:#F8FAFC;width:100%;outline:none;transition:border .2s; }
    .filter-select:focus { border-color:#2563EB;background:#fff; }
    .btn-filter { background:linear-gradient(135deg,#2563EB,#0D9488);color:#fff;border:none;border-radius:10px;padding:10px 22px;font-size:0.85rem;font-weight:600;cursor:pointer;transition:opacity .2s; }
    .btn-filter:hover { opacity:.9; }
    .btn-reset { background:#F1F5F9;color:#64748B;border:none;border-radius:10px;padding:10px 16px;font-size:0.82rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center; }

    /* ── Table ── */
    .section-card { background:#fff;border:1px solid #E2E8F0;border-radius:16px;overflow:hidden;box-shadow:0 4px 14px -4px rgba(0,0,0,0.05);margin-bottom:24px; }
    .section-header { padding:18px 22px 14px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #F1F5F9; }
    .section-title { font-size:0.95rem;font-weight:700;color:#0F172A;display:flex;align-items:center;gap:9px; }
    .sec-icon { width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:0.8rem; }
    .report-table { width:100%;border-collapse:collapse; }
    .report-table thead th { background:#F8FAFC;padding:12px 16px;font-size:0.68rem;font-weight:700;text-transform:uppercase;letter-spacing:0.6px;color:#64748B;border-bottom:1px solid #E2E8F0;white-space:nowrap; }
    .report-table tbody td { padding:13px 16px;border-bottom:1px solid #F8FAFC;font-size:0.875rem;color:#0F172A;vertical-align:middle; }
    .report-table tbody tr:last-child td { border-bottom:none; }
    .report-table tbody tr:hover { background:#F8FAFC; }

    /* ── Badges & Progress ── */
    .pill { display:inline-flex;align-items:center;padding:4px 10px;border-radius:50px;font-size:0.7rem;font-weight:600;white-space:nowrap; }
    .pill-blue   { background:#EFF6FF;color:#2563EB; }
    .pill-green  { background:#ECFDF5;color:#059669; }
    .pill-amber  { background:#FFFBEB;color:#D97706; }
    .pill-red    { background:#FEF2F2;color:#DC2626; }
    .pill-slate  { background:#F1F5F9;color:#64748B; }
    .pill-purple { background:#F5F3FF;color:#7C3AED; }

    .score-bar { height:8px;background:#E2E8F0;border-radius:4px;overflow:hidden;width:80px; }
    .score-fill { height:100%;border-radius:4px;background:linear-gradient(90deg,#2563EB,#0D9488); }

    /* ── Per-test Score Expand ── */
    .score-row { display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #F8FAFC; }
    .score-row:last-child { border-bottom:none; }
    .student-avatar { width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#2563EB,#0D9488);display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:700;color:#fff;flex-shrink:0; }

    .pass-ring { display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:50%;font-size:0.7rem;font-weight:700; }
    .pass-ring.passed { background:#ECFDF5;color:#059669;border:2px solid #A7F3D0; }
    .pass-ring.failed { background:#FEF2F2;color:#DC2626;border:2px solid #FECACA; }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1" style="font-size:1.25rem;">
            <i class="fas fa-file-signature me-2" style="color:#2563EB;"></i> Tests &amp; Exams Report
        </h4>
        <p class="text-muted small mb-0">Written test scores, online exam results, and performance analytics</p>
    </div>
    <span class="pill pill-blue">
        <i class="fas fa-calendar-alt me-1"></i> {{ now()->format('d M Y') }}
    </span>
</div>

{{-- Filter --}}
<div class="filter-card">
    <form method="GET" action="{{ route('reports.exams') }}" class="row g-3 align-items-end">
        <input type="hidden" name="tab" value="{{ $tab }}">
        <div class="col-md-4">
            <div class="filter-label">Batch</div>
            <select name="batch_id" class="filter-select" onchange="this.form.submit()">
                <option value="">All Batches</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ $batchId == $batch->id ? 'selected' : '' }}>
                        {{ $batch->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-auto">
            <button type="submit" class="btn-filter"><i class="fas fa-filter me-1"></i> Filter</button>
        </div>
        @if($batchId)
        <div class="col-md-auto">
            <a href="{{ route('reports.exams', ['tab' => $tab]) }}" class="btn-reset"><i class="fas fa-times me-1"></i> Reset</a>
        </div>
        @endif
    </form>
</div>

{{-- KPI Row --}}
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#EFF6FF;color:#2563EB;"><i class="fas fa-file-alt"></i></div>
        <div>
            <div class="kpi-val">{{ $totalTests }}</div>
            <div class="kpi-lbl">Written Tests</div>
        </div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#ECFDF5;color:#059669;"><i class="fas fa-percentage"></i></div>
        <div>
            <div class="kpi-val">{{ $avgTestScore !== null ? round($avgTestScore, 1) : '—' }}</div>
            <div class="kpi-lbl">Avg Score</div>
        </div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#F5F3FF;color:#7C3AED;"><i class="fas fa-laptop-code"></i></div>
        <div>
            <div class="kpi-val">{{ $totalOnlineExams }}</div>
            <div class="kpi-lbl">Online Exams</div>
        </div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#FFFBEB;color:#D97706;"><i class="fas fa-users"></i></div>
        <div>
            <div class="kpi-val">{{ $onlineExams->sum('attempts_count') }}</div>
            <div class="kpi-lbl">Exam Attempts</div>
        </div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#ECFDF5;color:#059669;"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="kpi-val">{{ $onlineExams->sum('pass_count') }}</div>
            <div class="kpi-lbl">Total Passed</div>
        </div>
    </div>
</div>

{{-- Tab Strip --}}
<div class="tab-strip">
    <a href="{{ route('reports.exams', array_merge(request()->query(), ['tab' => 'tests'])) }}"
       class="tab-btn {{ $tab === 'tests' ? 'active' : '' }}">
        <i class="fas fa-file-alt me-1"></i> Written Tests
    </a>
    <a href="{{ route('reports.exams', array_merge(request()->query(), ['tab' => 'online'])) }}"
       class="tab-btn {{ $tab === 'online' ? 'active' : '' }}">
        <i class="fas fa-laptop-code me-1"></i> Online Exams
    </a>
</div>

{{-- ══ WRITTEN TESTS TAB ══ --}}
@if($tab === 'tests')
<div class="section-card">
    <div class="section-header">
        <div class="section-title">
            <div class="sec-icon" style="background:#EFF6FF;color:#2563EB;"><i class="fas fa-file-alt"></i></div>
            Written Tests Overview
        </div>
        <span class="pill pill-blue">{{ $totalTests }} tests</span>
    </div>
    <div class="table-responsive">
        <table class="report-table">
            <thead>
                <tr>
                    <th>Test Title</th>
                    <th>Batch</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Total Marks</th>
                    <th>Students</th>
                    <th>Avg Score</th>
                    <th>Highest</th>
                    <th>Lowest</th>
                    <th>Passed</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($tests as $test)
                <tr>
                    <td>
                        <div class="fw-semibold" style="font-size:0.85rem;">{{ Str::limit($test->title, 35) }}</div>
                        @if($test->description)
                        <div style="font-size:0.72rem;color:#94A3B8;">{{ Str::limit(strip_tags($test->description), 50) }}</div>
                        @endif
                    </td>
                    <td><span class="pill pill-slate">{{ optional($test->batch)->name ?? '—' }}</span></td>
                    <td><span class="pill pill-blue">{{ optional($test->subject)->name ?? '—' }}</span></td>
                    <td style="font-size:0.82rem;color:#64748B;">{{ $test->test_date->format('d M Y') }}</td>
                    <td class="fw-bold" style="color:#2563EB;">{{ $test->total_marks }}</td>
                    <td>
                        @if($test->students_count > 0)
                            <span class="pill pill-slate"><i class="fas fa-user me-1"></i>{{ $test->students_count }}</span>
                        @else
                            <span class="text-muted" style="font-size:0.78rem;">No scores</span>
                        @endif
                    </td>
                    <td>
                        @if($test->avg_score !== null)
                            @php $avPct = $test->total_marks > 0 ? round(($test->avg_score/$test->total_marks)*100) : 0; @endphp
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold {{ $avPct >= 75 ? 'text-success' : ($avPct >= 40 ? 'text-warning' : 'text-danger') }}">
                                    {{ $test->avg_score }}/{{ $test->total_marks }}
                                </span>
                            </div>
                            <div class="score-bar mt-1">
                                <div class="score-fill" style="width:{{ $avPct }}%;background:{{ $avPct >= 75 ? '#059669' : ($avPct >= 40 ? '#D97706' : '#DC2626') }};"></div>
                            </div>
                        @else
                            <span class="text-muted" style="font-size:0.78rem;">—</span>
                        @endif
                    </td>
                    <td>
                        @if($test->highest !== null)
                            <span class="pill pill-green">{{ $test->highest }}</span>
                        @else <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($test->lowest !== null)
                            <span class="pill pill-red">{{ $test->lowest }}</span>
                        @else <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($test->students_count > 0)
                            @php $passRate = round(($test->pass_count / $test->students_count) * 100); @endphp
                            <span class="pill {{ $passRate >= 75 ? 'pill-green' : ($passRate >= 40 ? 'pill-amber' : 'pill-red') }}">
                                {{ $test->pass_count }}/{{ $test->students_count }}
                            </span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($test->scores->count() > 0)
                        <button class="btn btn-sm" style="background:#F1F5F9;color:#64748B;border-radius:8px;font-size:0.72rem;font-weight:600;border:none;"
                            type="button" data-bs-toggle="collapse" data-bs-target="#scores-{{ $test->id }}">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                {{-- Expandable score rows --}}
                @if($test->scores->count() > 0)
                <tr>
                    <td colspan="11" class="p-0">
                        <div class="collapse" id="scores-{{ $test->id }}">
                            <div style="padding:12px 24px 16px;background:#FAFBFE;border-top:1px dashed #E2E8F0;">
                                <div class="fw-semibold mb-3" style="font-size:0.78rem;color:#64748B;text-transform:uppercase;letter-spacing:0.5px;">
                                    Student Scores — {{ $test->title }}
                                </div>
                                <div class="row g-2">
                                    @foreach($test->scores->sortByDesc('score') as $score)
                                    @php
                                        $pct = $test->total_marks > 0 ? round(($score->score / $test->total_marks) * 100) : 0;
                                        $passed = $pct >= 40;
                                    @endphp
                                    <div class="col-md-4">
                                        <div class="score-row">
                                            <div class="student-avatar">{{ strtoupper(substr(optional($score->student)->name ?? 'S', 0, 2)) }}</div>
                                            <div class="flex-grow-1">
                                                <div style="font-size:0.82rem;font-weight:600;">{{ optional($score->student)->name ?? 'Student' }}</div>
                                                <div class="score-bar mt-1">
                                                    <div class="score-fill" style="width:{{ $pct }}%;background:{{ $passed ? '#059669' : '#DC2626' }};"></div>
                                                </div>
                                            </div>
                                            <span class="fw-bold" style="font-size:0.82rem;color:{{ $passed ? '#059669' : '#DC2626' }};">
                                                {{ $score->score }}/{{ $test->total_marks }}
                                            </span>
                                            <div class="pass-ring {{ $passed ? 'passed' : 'failed' }}">{{ $pct }}%</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="11" class="text-center py-5 text-muted">
                        <i class="fas fa-file-alt fa-2x mb-2 d-block" style="opacity:0.2;"></i>
                        No tests found{{ $batchId ? ' for this batch' : '' }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- ══ ONLINE EXAMS TAB ══ --}}
@if($tab === 'online')
<div class="section-card">
    <div class="section-header">
        <div class="section-title">
            <div class="sec-icon" style="background:#F5F3FF;color:#7C3AED;"><i class="fas fa-laptop-code"></i></div>
            Online Exams Overview
        </div>
        <span class="pill pill-purple">{{ $totalOnlineExams }} exams</span>
    </div>
    <div class="table-responsive">
        <table class="report-table">
            <thead>
                <tr>
                    <th>Exam Title</th>
                    <th>Batch</th>
                    <th>Subject</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Duration</th>
                    <th>Attempts</th>
                    <th>Avg %</th>
                    <th>Passed</th>
                    <th>Failed</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($onlineExams as $exam)
                <tr>
                    <td>
                        <div class="fw-semibold" style="font-size:0.85rem;">{{ Str::limit($exam->title, 35) }}</div>
                        <div style="font-size:0.72rem;color:#94A3B8;">{{ $exam->total_marks }} marks · Pass ≥ {{ $exam->pass_percentage }}%</div>
                    </td>
                    <td><span class="pill pill-slate">{{ optional($exam->batch)->name ?? '—' }}</span></td>
                    <td><span class="pill pill-blue">{{ optional($exam->subject)->name ?? '—' }}</span></td>
                    <td style="font-size:0.78rem;color:#64748B;">{{ $exam->start_datetime->format('d M Y, H:i') }}</td>
                    <td style="font-size:0.78rem;color:#64748B;">{{ $exam->end_datetime->format('d M Y, H:i') }}</td>
                    <td><span class="pill pill-slate">{{ $exam->duration_minutes }}m</span></td>
                    <td>
                        <span class="pill pill-purple"><i class="fas fa-user me-1"></i>{{ $exam->attempts_count }}</span>
                    </td>
                    <td>
                        @if($exam->avg_score !== null)
                            @php $avgPct = $exam->avg_score; @endphp
                            <span class="fw-bold {{ $avgPct >= 75 ? 'text-success' : ($avgPct >= 40 ? 'text-warning' : 'text-danger') }}">
                                {{ $avgPct }}%
                            </span>
                            <div class="score-bar mt-1">
                                <div class="score-fill" style="width:{{ $avgPct }}%;background:{{ $avgPct >= 75 ? '#059669' : ($avgPct >= 40 ? '#D97706' : '#DC2626') }};"></div>
                            </div>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td><span class="pill pill-green">{{ $exam->pass_count }}</span></td>
                    <td><span class="pill pill-red">{{ $exam->fail_count }}</span></td>
                    <td>
                        @php $sl = $exam->status_label; @endphp
                        <span class="pill" style="background:{{ $exam->status_color }}20;color:{{ $exam->status_color }};">
                            {{ $sl }}
                        </span>
                    </td>
                    <td>
                        @if($exam->sessions->where('status','submitted')->count() > 0)
                        <button class="btn btn-sm" style="background:#F1F5F9;color:#64748B;border-radius:8px;font-size:0.72rem;font-weight:600;border:none;"
                            type="button" data-bs-toggle="collapse" data-bs-target="#esess-{{ $exam->id }}">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                {{-- Expandable sessions --}}
                @if($exam->sessions->where('status','submitted')->count() > 0)
                <tr>
                    <td colspan="12" class="p-0">
                        <div class="collapse" id="esess-{{ $exam->id }}">
                            <div style="padding:12px 24px 16px;background:#FAFBFE;border-top:1px dashed #E2E8F0;">
                                <div class="fw-semibold mb-3" style="font-size:0.78rem;color:#64748B;text-transform:uppercase;letter-spacing:0.5px;">
                                    Student Results — {{ $exam->title }}
                                </div>
                                <div class="row g-2">
                                    @foreach($exam->sessions->where('status','submitted')->sortByDesc('percentage') as $sess)
                                    <div class="col-md-4">
                                        <div class="score-row">
                                            <div class="student-avatar">{{ strtoupper(substr(optional($sess->student)->name ?? 'S', 0, 2)) }}</div>
                                            <div class="flex-grow-1">
                                                <div style="font-size:0.82rem;font-weight:600;">{{ optional($sess->student)->name ?? 'Student' }}</div>
                                                <div style="font-size:0.7rem;color:#94A3B8;">{{ $sess->score }}/{{ $sess->total_marks }} marks</div>
                                                <div class="score-bar mt-1">
                                                    <div class="score-fill" style="width:{{ $sess->percentage }}%;background:{{ $sess->is_passed ? '#059669' : '#DC2626' }};"></div>
                                                </div>
                                            </div>
                                            <div class="pass-ring {{ $sess->is_passed ? 'passed' : 'failed' }}">{{ round($sess->percentage) }}%</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="12" class="text-center py-5 text-muted">
                        <i class="fas fa-laptop-code fa-2x mb-2 d-block" style="opacity:0.2;"></i>
                        No online exams found{{ $batchId ? ' for this batch' : '' }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
