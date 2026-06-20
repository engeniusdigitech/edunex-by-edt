@extends('layouts.admin')

@section('title', 'LMS Report')

@push('styles')
<style>
    /* ── KPI Cards ── */
    .kpi-grid { display: grid; grid-template-columns: repeat(auto-fit,minmax(170px,1fr)); gap:16px; margin-bottom:28px; }
    .kpi-card {
        background:#fff; border:1px solid #E2E8F0; border-radius:16px;
        padding:20px 22px; display:flex; align-items:center; gap:14px;
        box-shadow:0 4px 14px -4px rgba(0,0,0,0.06);
        transition:transform .2s,box-shadow .2s;
    }
    .kpi-card:hover { transform:translateY(-2px); box-shadow:0 8px 24px -4px rgba(0,0,0,0.09); }
    .kpi-icon { width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.15rem;flex-shrink:0; }
    .kpi-val { font-size:1.65rem;font-weight:800;color:#0F172A;line-height:1.1;letter-spacing:-0.5px; }
    .kpi-lbl { font-size:0.68rem;font-weight:600;color:#64748B;text-transform:uppercase;letter-spacing:0.6px;margin-top:3px; }

    /* ── Section ── */
    .section-card { background:#fff;border:1px solid #E2E8F0;border-radius:16px;overflow:hidden;box-shadow:0 4px 14px -4px rgba(0,0,0,0.05);margin-bottom:24px; }
    .section-header { padding:18px 22px 0;display:flex;align-items:center;justify-content:space-between; border-bottom:1px solid #F1F5F9; padding-bottom:14px; }
    .section-title { font-size:0.95rem;font-weight:700;color:#0F172A;display:flex;align-items:center;gap:9px; }
    .sec-icon { width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:0.8rem; }

    /* ── Table ── */
    .report-table { width:100%;border-collapse:collapse; }
    .report-table thead th { background:#F8FAFC;padding:12px 16px;font-size:0.68rem;font-weight:700;text-transform:uppercase;letter-spacing:0.6px;color:#64748B;border-bottom:1px solid #E2E8F0; white-space:nowrap; }
    .report-table tbody td { padding:13px 16px;border-bottom:1px solid #F8FAFC;font-size:0.875rem;color:#0F172A;vertical-align:middle; }
    .report-table tbody tr:last-child td { border-bottom:none; }
    .report-table tbody tr:hover { background:#F8FAFC; }

    /* ── Badges ── */
    .pill { display:inline-flex;align-items:center;padding:4px 10px;border-radius:50px;font-size:0.7rem;font-weight:600;white-space:nowrap; }
    .pill-blue   { background:#EFF6FF;color:#2563EB; }
    .pill-green  { background:#ECFDF5;color:#059669; }
    .pill-amber  { background:#FFFBEB;color:#D97706; }
    .pill-red    { background:#FEF2F2;color:#DC2626; }
    .pill-slate  { background:#F1F5F9;color:#64748B; }
    .pill-purple { background:#F5F3FF;color:#7C3AED; }

    /* ── Progress bar ── */
    .mini-bar { height:6px;border-radius:3px;background:#E2E8F0;overflow:hidden; }
    .mini-fill { height:100%;border-radius:3px;background:linear-gradient(90deg,#2563EB,#0D9488); }

    /* ── Subject Breakdown ── */
    .subject-bar-row { display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid #F1F5F9; }
    .subject-bar-row:last-child { border-bottom:none; }
    .subject-name { font-size:0.82rem;font-weight:600;color:#0F172A;min-width:120px; }
    .subject-bar-track { flex:1;height:10px;background:#F1F5F9;border-radius:5px;overflow:hidden; }
    .subject-bar-fill { height:100%;border-radius:5px;background:linear-gradient(90deg,#2563EB,#0D9488); }
    .subject-count { font-size:0.78rem;font-weight:700;color:#0F172A;min-width:40px;text-align:right; }

    /* ── Filter Card ── */
    .filter-card { background:#fff;border:1px solid #E2E8F0;border-radius:14px;padding:20px 22px;margin-bottom:24px;box-shadow:0 2px 8px -2px rgba(0,0,0,0.04); }
    .filter-label { font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#64748B;margin-bottom:6px; }
    .filter-select, .filter-input {
        border:1.5px solid #E2E8F0;border-radius:10px;padding:9px 14px;font-size:0.85rem;
        color:#0F172A;background:#F8FAFC;width:100%;outline:none;transition:border .2s;
    }
    .filter-select:focus, .filter-input:focus { border-color:#2563EB;background:#fff; }
    .btn-filter { background:linear-gradient(135deg,#2563EB,#0D9488);color:#fff;border:none;border-radius:10px;padding:10px 22px;font-size:0.85rem;font-weight:600;cursor:pointer;transition:opacity .2s; }
    .btn-filter:hover { opacity:.9; }
    .btn-reset { background:#F1F5F9;color:#64748B;border:none;border-radius:10px;padding:10px 16px;font-size:0.82rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center; }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1" style="font-size:1.25rem;">
            <i class="fas fa-graduation-cap me-2" style="color:#2563EB;"></i> LMS Report
        </h4>
        <p class="text-muted small mb-0">Study materials, assignments, and live lecture analytics</p>
    </div>
    <span class="pill pill-blue">
        <i class="fas fa-calendar-alt me-1"></i> {{ now()->format('d M Y') }}
    </span>
</div>

{{-- Filter --}}
<div class="filter-card">
    <form method="GET" action="{{ route('reports.lms') }}" class="row g-3 align-items-end">
        <div class="col-md-4">
            <div class="filter-label">Batch</div>
            <select name="batch_id" class="filter-select" id="batchSelect" onchange="this.form.submit()">
                <option value="">All Batches</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ $batchId == $batch->id ? 'selected' : '' }}>
                        {{ $batch->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @if($batchId && $subjects->count())
        <div class="col-md-4">
            <div class="filter-label">Subject</div>
            <select name="subject_id" class="filter-select">
                <option value="">All Subjects</option>
                @foreach($subjects as $sub)
                    <option value="{{ $sub->id }}" {{ $subjectId == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="col-md-auto">
            <button type="submit" class="btn-filter"><i class="fas fa-filter me-1"></i> Filter</button>
        </div>
        @if($batchId || $subjectId)
        <div class="col-md-auto">
            <a href="{{ route('reports.lms') }}" class="btn-reset"><i class="fas fa-times me-1"></i> Reset</a>
        </div>
        @endif
    </form>
</div>

{{-- KPI Row --}}
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#EFF6FF;color:#2563EB;"><i class="fas fa-folder-open"></i></div>
        <div>
            <div class="kpi-val">{{ $totalMaterials }}</div>
            <div class="kpi-lbl">Study Materials</div>
        </div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#ECFDF5;color:#059669;"><i class="fas fa-download"></i></div>
        <div>
            <div class="kpi-val">{{ number_format($totalDownloads) }}</div>
            <div class="kpi-lbl">Total Downloads</div>
        </div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#FFFBEB;color:#D97706;"><i class="fas fa-tasks"></i></div>
        <div>
            <div class="kpi-val">{{ $totalHomework }}</div>
            <div class="kpi-lbl">Assignments</div>
        </div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#FEF2F2;color:#DC2626;"><i class="fas fa-exclamation-circle"></i></div>
        <div>
            <div class="kpi-val">{{ $overdueHomework }}</div>
            <div class="kpi-lbl">Overdue</div>
        </div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="background:#F5F3FF;color:#7C3AED;"><i class="fas fa-video"></i></div>
        <div>
            <div class="kpi-val">{{ $totalLectures }}</div>
            <div class="kpi-lbl">Lectures</div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Subject Breakdown --}}
    <div class="col-md-4">
        <div class="section-card h-100">
            <div class="section-header">
                <div class="section-title">
                    <div class="sec-icon" style="background:#EFF6FF;color:#2563EB;"><i class="fas fa-chart-bar"></i></div>
                    Materials by Subject
                </div>
            </div>
            <div style="padding:16px 20px;">
                @php $maxMat = $materialsBySubject->max(fn($g) => $g->count()); $maxMat = max($maxMat,1); @endphp
                @forelse($materialsBySubject as $subjectName => $mats)
                <div class="subject-bar-row">
                    <div class="subject-name" title="{{ $subjectName }}">{{ Str::limit($subjectName, 18) }}</div>
                    <div class="subject-bar-track">
                        <div class="subject-bar-fill" style="width:{{ round(($mats->count()/$maxMat)*100) }}%;"></div>
                    </div>
                    <div class="subject-count">{{ $mats->count() }}</div>
                </div>
                @empty
                <div class="text-center py-4 text-muted" style="font-size:0.85rem;">
                    <i class="fas fa-folder-open fa-2x mb-2 d-block" style="opacity:0.2;"></i>
                    No materials found
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Study Materials Table --}}
    <div class="col-md-8">
        <div class="section-card">
            <div class="section-header">
                <div class="section-title">
                    <div class="sec-icon" style="background:#EFF6FF;color:#2563EB;"><i class="fas fa-folder-open"></i></div>
                    Study Materials
                </div>
                <span class="pill pill-blue">{{ $totalMaterials }} files</span>
            </div>
            <div class="table-responsive">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Batch</th>
                            <th>Subject</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Downloads</th>
                            <th>Uploaded</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materials as $mat)
                        <tr>
                            <td>
                                <div class="fw-semibold" style="font-size:0.85rem;">{{ Str::limit($mat->title, 35) }}</div>
                                @if($mat->uploader)
                                <div style="font-size:0.72rem;color:#94A3B8;">by {{ $mat->uploader->name }}</div>
                                @endif
                            </td>
                            <td><span class="pill pill-slate">{{ optional($mat->batch)->name ?? '—' }}</span></td>
                            <td><span class="pill pill-blue">{{ optional($mat->subject)->name ?? '—' }}</span></td>
                            <td>
                                @php $ext = strtoupper($mat->file_type ?? pathinfo($mat->file_name ?? '', PATHINFO_EXTENSION)); @endphp
                                <span class="pill {{ in_array($ext, ['PDF']) ? 'pill-red' : (in_array($ext, ['DOC','DOCX']) ? 'pill-blue' : (in_array($ext, ['PPT','PPTX']) ? 'pill-amber' : 'pill-slate')) }}">
                                    {{ $ext ?: 'FILE' }}
                                </span>
                            </td>
                            <td style="color:#64748B;font-size:0.8rem;">{{ $mat->formatted_file_size }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-bold" style="color:#059669;">{{ $mat->download_count }}</span>
                                    <div class="mini-bar" style="width:50px;">
                                        <div class="mini-fill" style="width:{{ $totalDownloads > 0 ? min(100,round(($mat->download_count/$totalDownloads)*100)) : 0 }}%;background:#059669;"></div>
                                    </div>
                                </div>
                            </td>
                            <td style="color:#64748B;font-size:0.78rem;">{{ $mat->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-2x mb-2 d-block" style="opacity:0.2;"></i>
                                No study materials found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Assignments Section --}}
<div class="section-card mt-4">
    <div class="section-header">
        <div class="section-title">
            <div class="sec-icon" style="background:#FFFBEB;color:#D97706;"><i class="fas fa-tasks"></i></div>
            Assignments / Homework
        </div>
        <div class="d-flex gap-2">
            <span class="pill pill-amber">{{ $overdueHomework }} overdue</span>
            <span class="pill pill-slate">{{ $totalHomework }} total</span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="report-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Batch</th>
                    <th>Subject</th>
                    <th>Attachments</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($homeworks as $hw)
                @php
                    $isOverdue = $hw->due_date->lt(now());
                    $isDueSoon = !$isOverdue && $hw->due_date->diffInDays(now()) <= 3;
                @endphp
                <tr>
                    <td>
                        <div class="fw-semibold" style="font-size:0.85rem;">{{ Str::limit($hw->title, 40) }}</div>
                        @if($hw->description)
                        <div style="font-size:0.72rem;color:#94A3B8;">{{ Str::limit(strip_tags($hw->description), 60) }}</div>
                        @endif
                    </td>
                    <td><span class="pill pill-slate">{{ optional($hw->batch)->name ?? '—' }}</span></td>
                    <td><span class="pill pill-blue">{{ optional($hw->subject)->name ?? '—' }}</span></td>
                    <td>
                        @if($hw->attachments->count() > 0)
                            <span class="pill pill-purple"><i class="fas fa-paperclip me-1"></i>{{ $hw->attachments->count() }}</span>
                        @else
                            <span class="text-muted" style="font-size:0.78rem;">—</span>
                        @endif
                    </td>
                    <td style="font-size:0.82rem;{{ $isOverdue ? 'color:#DC2626;' : '' }}">
                        <i class="far fa-calendar me-1"></i>{{ $hw->due_date->format('d M Y') }}
                    </td>
                    <td>
                        @if($isOverdue)
                            <span class="pill pill-red"><i class="fas fa-exclamation-circle me-1"></i>Overdue</span>
                        @elseif($isDueSoon)
                            <span class="pill pill-amber"><i class="fas fa-clock me-1"></i>Due Soon</span>
                        @else
                            <span class="pill pill-green"><i class="fas fa-check me-1"></i>Active</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-tasks fa-2x mb-2 d-block" style="opacity:0.2;"></i>
                        No assignments found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Live Lectures --}}
<div class="section-card mt-4">
    <div class="section-header">
        <div class="section-title">
            <div class="sec-icon" style="background:#F5F3FF;color:#7C3AED;"><i class="fas fa-video"></i></div>
            Live / Recorded Lectures
        </div>
        <span class="pill pill-purple">{{ $totalLectures }} total</span>
    </div>
    <div class="table-responsive">
        <table class="report-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Batch</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lectures as $lec)
                <tr>
                    <td class="fw-semibold" style="font-size:0.85rem;">{{ Str::limit($lec->title, 40) }}</td>
                    <td><span class="pill pill-slate">{{ optional($lec->batch)->name ?? '—' }}</span></td>
                    <td><span class="pill pill-blue">{{ $lec->subject ?? '—' }}</span></td>
                    <td style="font-size:0.82rem;color:#64748B;">
                        {{ $lec->recorded_at ? $lec->recorded_at->format('d M Y') : '—' }}
                    </td>
                    <td>
                        @if($lec->status === 'live')
                            <span class="pill pill-green"><i class="fas fa-circle me-1" style="font-size:0.5rem;"></i>Live</span>
                        @elseif($lec->status === 'ended')
                            <span class="pill pill-slate">Ended</span>
                        @elseif($lec->status === 'scheduled')
                            <span class="pill pill-blue">Scheduled</span>
                        @else
                            <span class="pill pill-amber">{{ ucfirst($lec->status) }}</span>
                        @endif
                    </td>
                    <td>
                        @if($lec->video_path)
                            <span class="pill pill-purple"><i class="fas fa-film me-1"></i>Recorded</span>
                        @else
                            <span class="pill pill-green"><i class="fas fa-broadcast-tower me-1"></i>Jitsi</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-video fa-2x mb-2 d-block" style="opacity:0.2;"></i>
                        No lectures found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
