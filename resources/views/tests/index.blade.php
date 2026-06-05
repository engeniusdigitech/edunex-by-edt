@extends('layouts.admin')

@section('title', 'Digital Assessment Platform')

@section('content')

<style>
/* ═══ DAP In-App Variables ═══ */
:root {
    --dap-navy:   #0F172A;
    --dap-indigo: #4F46E5;
    --dap-cyan:   #06B6D4;
    --dap-violet: #7C3AED;
    --dap-teal:   #0D9488;
    --dap-amber:  #D97706;
    --dap-green:  #059669;
    --dap-red:    #DC2626;
}

/* ─ Page Header ─ */
.dap-page-header {
    background: linear-gradient(135deg, #0F172A 0%, #1E1B4B 60%, #1e3a5f 100%);
    border-radius: 20px; padding: 32px 36px; margin-bottom: 28px;
    position: relative; overflow: hidden;
    border: 1px solid rgba(99,102,241,0.2);
}
.dap-page-header::before {
    content: ''; position: absolute; inset: 0; border-radius: 20px;
    background-image:
        linear-gradient(rgba(99,102,241,0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(99,102,241,0.06) 1px, transparent 1px);
    background-size: 32px 32px;
}
.dap-page-header::after {
    content: ''; position: absolute; top: -80px; right: -80px;
    width: 280px; height: 280px; border-radius: 50%;
    background: radial-gradient(circle, rgba(79,70,229,0.2) 0%, transparent 65%);
}
.dap-header-inner { position: relative; z-index: 2; }
.dap-header-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(6,182,212,0.12); border: 1px solid rgba(6,182,212,0.3);
    border-radius: 9999px; padding: 5px 14px;
    font-size: 0.7rem; font-weight: 700; color: #67E8F9;
    text-transform: uppercase; letter-spacing: 1px; margin-bottom: 14px;
}
.dap-live-dot { width: 6px; height: 6px; border-radius: 50%; background: #22D3EE; animation: dap-pulse 2s infinite; }
@keyframes dap-pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }
.dap-header-title { font-size: 1.9rem; font-weight: 800; color: #fff; letter-spacing: -1px; margin-bottom: 6px; line-height: 1.1; }
.dap-header-sub { font-size: 0.88rem; color: rgba(255,255,255,0.5); margin-bottom: 0; }
.dap-header-btn {
    background: linear-gradient(135deg, #4F46E5, #06B6D4);
    color: #fff; border: none; padding: 11px 24px; border-radius: 12px;
    font-size: 0.85rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; transition: all 0.2s; box-shadow: 0 4px 20px rgba(79,70,229,0.35);
}
.dap-header-btn:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(79,70,229,0.45); }

/* ─ KPI Cards ─ */
.dap-kpi {
    background: #fff; border: 1px solid #F1F5F9;
    border-radius: 18px; padding: 22px 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    transition: all 0.25s ease; position: relative; overflow: hidden;
}
.dap-kpi:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.08); transform: translateY(-2px); }
.dap-kpi-icon {
    width: 50px; height: 50px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; margin-bottom: 14px;
}
.dap-kpi-val { font-size: 2rem; font-weight: 800; letter-spacing: -1px; line-height: 1; margin-bottom: 4px; }
.dap-kpi-lbl { font-size: 0.75rem; font-weight: 600; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; }
.dap-kpi-trend { font-size: 0.72rem; font-weight: 600; margin-top: 8px; display: flex; align-items: center; gap: 5px; }
.trend-up   { color: #059669; }
.trend-down { color: #DC2626; }
.dap-kpi::after {
    content: ''; position: absolute; top: -20px; right: -20px;
    width: 80px; height: 80px; border-radius: 50%;
    opacity: 0.06;
}
.kpi-indigo::after { background: #4F46E5; }
.kpi-cyan::after   { background: #06B6D4; }
.kpi-green::after  { background: #059669; }
.kpi-amber::after  { background: #D97706; }

/* ─ Section Card ─ */
.dap-card {
    background: #fff; border: 1px solid #F1F5F9;
    border-radius: 18px; overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
.dap-card-header {
    padding: 18px 24px; border-bottom: 1px solid #F8FAFC;
    display: flex; align-items: center; justify-content: space-between;
    background: #FAFAFA;
}
.dap-card-title {
    font-size: 0.92rem; font-weight: 700; color: #1E293B;
    display: flex; align-items: center; gap: 10px;
}
.dap-card-icon {
    width: 32px; height: 32px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center; font-size: 0.8rem;
}

/* ─ Test Rows ─ */
.dap-test-row {
    display: flex; align-items: center; gap: 16px;
    padding: 16px 24px; border-bottom: 1px solid #F8FAFC;
    transition: background 0.15s;
}
.dap-test-row:last-child { border-bottom: none; }
.dap-test-row:hover { background: #FAFBFF; }

.dap-test-icon {
    width: 44px; height: 44px; border-radius: 12px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: 1rem;
}
.dap-test-title { font-size: 0.88rem; font-weight: 700; color: #1E293B; margin-bottom: 2px; }
.dap-test-meta  { font-size: 0.72rem; color: #94A3B8; display: flex; align-items: center; gap: 10px; }
.dap-test-meta span { display: flex; align-items: center; gap: 4px; }

.dap-status-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 10px; border-radius: 9999px; font-size: 0.67rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.5px;
}
.status-upcoming  { background: #EFF6FF; color: #2563EB; border: 1px solid #BFDBFE; }
.status-pending   { background: #FFFBEB; color: #D97706; border: 1px solid #FDE68A; }
.status-completed { background: #F0FDF4; color: #059669; border: 1px solid #A7F3D0; }

/* ─ Module Pills (features showcase in header) ─ */
.dap-module-pills { display: flex; flex-wrap: wrap; gap: 8px; }
.dap-pill {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12);
    border-radius: 9px; padding: 6px 13px; font-size: 0.72rem; font-weight: 600;
    color: rgba(255,255,255,0.7); transition: all 0.2s;
}
.dap-pill:hover { background: rgba(255,255,255,0.12); color: #fff; }
.dap-pill i { font-size: 0.65rem; color: #67E8F9; }

/* ─ Chart bars (CSS only) ─ */
.mini-chart { display: flex; align-items: flex-end; gap: 5px; height: 60px; }
.mc-bar { flex: 1; border-radius: 5px 5px 0 0; min-width: 12px; transition: opacity 0.2s; }
.mc-bar:hover { opacity: 0.8; }

/* ─ Action buttons ─ */
.dap-btn-sm {
    padding: 6px 14px; border-radius: 8px; font-size: 0.75rem; font-weight: 700;
    display: inline-flex; align-items: center; gap: 6px; text-decoration: none; border: none; cursor: pointer; transition: all 0.2s;
}
.dap-btn-primary { background: linear-gradient(135deg, #4F46E5, #7C3AED); color: #fff; box-shadow: 0 2px 8px rgba(79,70,229,0.3); }
.dap-btn-primary:hover { color: #fff; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(79,70,229,0.4); }
.dap-btn-teal { background: linear-gradient(135deg, #0D9488, #06B6D4); color: #fff; box-shadow: 0 2px 8px rgba(6,182,212,0.3); }
.dap-btn-teal:hover { color: #fff; transform: translateY(-1px); }
.dap-btn-outline { background: #fff; border: 1px solid #E2E8F0; color: #475569; }
.dap-btn-outline:hover { border-color: #4F46E5; color: #4F46E5; background: #F5F3FF; }
.dap-btn-danger { background: #FEF2F2; border: 1px solid #FECACA; color: #DC2626; }
.dap-btn-danger:hover { background: #DC2626; color: #fff; }

/* ─ Progress bar ─ */
.dap-progress { height: 6px; border-radius: 9999px; background: #F1F5F9; overflow: hidden; }
.dap-progress-fill { height: 100%; border-radius: 9999px; }

/* ─ Rank badge ─ */
.rank-badge { width: 24px; height: 24px; border-radius: 7px; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 800; flex-shrink: 0; }

/* ─ Empty state ─ */
.dap-empty { text-align: center; padding: 60px 24px; }
.dap-empty-icon { font-size: 3rem; opacity: 0.15; margin-bottom: 16px; }
.dap-empty-title { font-size: 1rem; font-weight: 700; color: #1E293B; margin-bottom: 6px; }
.dap-empty-desc  { font-size: 0.83rem; color: #94A3B8; margin-bottom: 20px; }

/* ─ Filters bar ─ */
.dap-filters {
    display: flex; gap: 10px; flex-wrap: wrap; align-items: center;
    background: #FAFAFA; padding: 14px 24px; border-bottom: 1px solid #F1F5F9;
}
.dap-filter-input {
    background: #fff; border: 1px solid #E2E8F0; border-radius: 10px;
    padding: 8px 14px; font-size: 0.8rem; color: #1E293B; outline: none;
    transition: border-color 0.2s; font-family: 'Outfit', sans-serif;
}
.dap-filter-input:focus { border-color: #4F46E5; box-shadow: 0 0 0 3px rgba(79,70,229,0.08); }
.dap-filter-btn { background: #4F46E5; color: #fff; border: none; border-radius: 10px; padding: 8px 18px; font-size: 0.8rem; font-weight: 700; cursor: pointer; transition: all 0.2s; font-family: 'Outfit', sans-serif; }
.dap-filter-btn:hover { background: #4338CA; }
.dap-filter-clear { background: #fff; color: #64748B; border: 1px solid #E2E8F0; border-radius: 10px; padding: 8px 14px; font-size: 0.8rem; font-weight: 600; cursor: pointer; text-decoration: none; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
.dap-filter-clear:hover { border-color: #94A3B8; color: #1E293B; }

/* ─ Responsive ─ */
@media(max-width:767px) {
    .dap-page-header { padding: 22px 20px; }
    .dap-header-title { font-size: 1.4rem; }
    .dap-kpi-val { font-size: 1.6rem; }
    .dap-test-row { flex-wrap: wrap; gap: 10px; }
}
</style>

{{-- ══ PAGE HEADER ══ --}}
<div class="dap-page-header mb-4">
    <div class="dap-header-inner row align-items-center g-3">
        <div class="col-lg-8">
            <div class="dap-header-badge">
                <span class="dap-live-dot"></span>
                Digital Assessment Platform
            </div>
            <h1 class="dap-header-title">Tests & Examinations</h1>
            <p class="dap-header-sub">Schedule exams, enter marks, track performance, and publish results — all from one place.</p>
            <div class="dap-module-pills mt-3">
                <span class="dap-pill"><i class="fas fa-clipboard-list"></i> Schedule Tests</span>
                <span class="dap-pill"><i class="fas fa-tasks"></i> Enter Marks</span>
                <span class="dap-pill"><i class="fas fa-chart-bar"></i> Performance View</span>
                <span class="dap-pill"><i class="fas fa-file-invoice"></i> Result Reports</span>
                <span class="dap-pill"><i class="fas fa-layer-group"></i> Batch-wise</span>
            </div>
        </div>
        <div class="col-lg-4 text-lg-end">
            @can('manage-academics')
            <a href="{{ route('tests.create') }}" class="dap-header-btn">
                <i class="fas fa-plus"></i> Schedule New Test
            </a>
            @endcan
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert border-0 rounded-3 mb-4 d-flex align-items-center gap-3"
     style="background:#F0FDF4;border-left:4px solid #059669 !important;border-radius:12px!important;" role="alert">
    <div style="width:36px;height:36px;background:#059669;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
        <i class="fas fa-check text-white"></i>
    </div>
    <div>
        <div style="font-size:0.85rem;font-weight:700;color:#065F46;">Success</div>
        <div style="font-size:0.8rem;color:#047857;">{{ session('success') }}</div>
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- ══ KPI ROW ══ --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="dap-kpi kpi-indigo">
            <div class="dap-kpi-icon" style="background:#EEF2FF;color:#4F46E5;"><i class="fas fa-clipboard-list"></i></div>
            <div class="dap-kpi-val" style="color:#4F46E5;">{{ $tests->total() }}</div>
            <div class="dap-kpi-lbl">Total Tests</div>
            <div class="dap-kpi-trend trend-up"><i class="fas fa-arrow-up"></i> This session</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="dap-kpi kpi-amber">
            <div class="dap-kpi-icon" style="background:#FFFBEB;color:#D97706;"><i class="fas fa-clock"></i></div>
            <div class="dap-kpi-val" style="color:#D97706;">
                {{ $tests->getCollection()->filter(fn($t) => $t->test_date->isFuture())->count() }}
            </div>
            <div class="dap-kpi-lbl">Upcoming</div>
            <div class="dap-kpi-trend" style="color:#D97706;"><i class="fas fa-calendar-day"></i> Scheduled ahead</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="dap-kpi kpi-green">
            <div class="dap-kpi-icon" style="background:#F0FDF4;color:#059669;"><i class="fas fa-check-double"></i></div>
            <div class="dap-kpi-val" style="color:#059669;">
                {{ $tests->getCollection()->filter(fn($t) => $t->test_date->isPast())->count() }}
            </div>
            <div class="dap-kpi-lbl">Completed</div>
            <div class="dap-kpi-trend trend-up"><i class="fas fa-check"></i> Results ready</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="dap-kpi kpi-cyan">
            <div class="dap-kpi-icon" style="background:#ECFEFF;color:#06B6D4;"><i class="fas fa-users"></i></div>
            <div class="dap-kpi-val" style="color:#06B6D4;">{{ $batches->count() }}</div>
            <div class="dap-kpi-lbl">Active Batches</div>
            <div class="dap-kpi-trend" style="color:#06B6D4;"><i class="fas fa-layer-group"></i> All classes</div>
        </div>
    </div>
</div>

{{-- ══ MAIN CONTENT ══ --}}
<div class="dap-card">

    {{-- Filters --}}
    <form action="{{ route('tests.index') }}" method="GET">
        <div class="dap-filters">
            <div style="position:relative;flex:1;min-width:180px;">
                <i class="fas fa-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94A3B8;font-size:0.75rem;"></i>
                <input type="text" name="search" placeholder="Search exam title..." value="{{ request('search') }}"
                       class="dap-filter-input w-100" style="padding-left:34px;">
            </div>
            <select name="batch_id" class="dap-filter-input" style="min-width:160px;">
                <option value="">All Batches</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                @endforeach
            </select>
            <select name="subject_id" class="dap-filter-input" style="min-width:160px;">
                <option value="">All Subjects</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="dap-filter-btn"><i class="fas fa-filter me-1"></i>Filter</button>
            @if(request()->anyFilled(['search','batch_id','subject_id']))
                <a href="{{ route('tests.index') }}" class="dap-filter-clear"><i class="fas fa-times"></i> Clear</a>
            @endif
        </div>
    </form>

    {{-- Table Header --}}
    <div class="dap-card-header">
        <div class="dap-card-title">
            <div class="dap-card-icon" style="background:#EEF2FF;color:#4F46E5;"><i class="fas fa-list-alt"></i></div>
            All Exams
            <span class="badge rounded-pill ms-1" style="background:#EEF2FF;color:#4F46E5;font-size:0.7rem;padding:4px 10px;">
                {{ $tests->total() }} total
            </span>
        </div>
        @can('manage-academics')
        <a href="{{ route('tests.create') }}" class="dap-btn-sm dap-btn-primary">
            <i class="fas fa-plus"></i> New Test
        </a>
        @endcan
    </div>

    {{-- Test Rows --}}
    @forelse($tests as $test)
    @php
        $isUpcoming   = $test->test_date->isFuture();
        $isPast       = $test->test_date->isPast();
        $scores       = ($test->relationLoaded('scores') && $test->scores) ? $test->scores : collect();
        $hasMarks     = $scores->count() > 0;
        $avgScore     = $hasMarks ? round($scores->avg('score'), 1) : null;
        $pct          = ($avgScore && $test->total_marks > 0) ? round(($avgScore / $test->total_marks) * 100) : null;
        $colors       = [
            ['bg'=>'#EEF2FF','ic'=>'#4F46E5'],
            ['bg'=>'#ECFEFF','ic'=>'#06B6D4'],
            ['bg'=>'#F0FDF4','ic'=>'#059669'],
            ['bg'=>'#FFF7ED','ic'=>'#D97706'],
            ['bg'=>'#FDF4FF','ic'=>'#7C3AED'],
        ];
        $c = $colors[$loop->index % 5];
    @endphp
    <div class="dap-test-row">

        {{-- Icon --}}
        <div class="dap-test-icon" style="background:{{ $c['bg'] }};color:{{ $c['ic'] }};">
            <i class="fas fa-file-alt"></i>
        </div>

        {{-- Title + meta --}}
        <div style="flex:1;min-width:0;">
            <div class="dap-test-title text-truncate">{{ $test->title }}</div>
            <div class="dap-test-meta mt-1">
                @if($test->subject)
                    <span><i class="fas fa-book"></i> {{ $test->subject->name }}</span>
                @endif
                <span><i class="fas fa-layer-group"></i> {{ $test->batch->name }}</span>
                <span><i class="fas fa-calendar-alt"></i> {{ $test->test_date->format('d M, Y') }}</span>
                <span><i class="fas fa-bullseye"></i> {{ $test->total_marks }} marks</span>
            </div>
        </div>

        {{-- Status --}}
        <div class="d-none d-md-block" style="flex-shrink:0;">
            @if($isUpcoming)
                <span class="dap-status-badge status-upcoming"><i class="fas fa-clock"></i> Upcoming</span>
            @elseif($hasMarks)
                <span class="dap-status-badge status-completed"><i class="fas fa-check"></i> Evaluated</span>
            @else
                <span class="dap-status-badge status-pending"><i class="fas fa-pen"></i> Pending Marks</span>
            @endif
        </div>

        {{-- Avg score mini --}}
        @if($avgScore)
        <div class="d-none d-lg-block text-center" style="min-width:90px;">
            <div style="font-size:1.1rem;font-weight:800;color:{{ $pct>=60 ? '#059669' : '#DC2626' }};">{{ $pct }}%</div>
            <div style="font-size:0.62rem;color:#94A3B8;font-weight:600;text-transform:uppercase;">Avg Score</div>
        </div>
        @else
        <div class="d-none d-lg-block" style="min-width:90px;"></div>
        @endif

        {{-- Actions --}}
        <div class="d-flex gap-2 flex-shrink-0">
            @can('manage-academics')
            <a href="{{ route('tests.marks', $test) }}" class="dap-btn-sm dap-btn-teal" title="Enter Marks">
                <i class="fas fa-tasks"></i>
                <span class="d-none d-sm-inline">Marks</span>
            </a>
            <a href="{{ route('tests.edit', $test) }}" class="dap-btn-sm dap-btn-outline" title="Edit">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('tests.destroy', $test) }}" method="POST" class="m-0"
                  onsubmit="return confirm('Delete this test? All student scores will also be removed.')">
                @csrf @method('DELETE')
                <button type="submit" class="dap-btn-sm dap-btn-danger" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
            @endcan
        </div>
    </div>
    @empty
    <div class="dap-empty">
        <div class="dap-empty-icon"><i class="fas fa-clipboard-list"></i></div>
        <div class="dap-empty-title">No Tests Found</div>
        <div class="dap-empty-desc">
            @if(request()->anyFilled(['search','batch_id','subject_id']))
                No tests match your filters. <a href="{{ route('tests.index') }}">Clear filters</a>
            @else
                Schedule your first examination to get started.
            @endif
        </div>
        @can('manage-academics')
        <a href="{{ route('tests.create') }}" class="dap-btn-sm dap-btn-primary">
            <i class="fas fa-plus"></i> Schedule First Test
        </a>
        @endcan
    </div>
    @endforelse

    {{-- Pagination --}}
    @if($tests->hasPages())
    <div class="px-4 py-3 border-top" style="background:#FAFAFA;">
        {{ $tests->withQueryString()->links() }}
    </div>
    @endif
</div>

@endsection
