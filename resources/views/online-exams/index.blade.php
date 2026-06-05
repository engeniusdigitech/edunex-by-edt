@extends('layouts.admin')
@section('title', 'Online Exams')
@section('content')
<style>
:root{--oe-navy:#0F172A;--oe-indigo:#4F46E5;--oe-cyan:#06B6D4;--oe-green:#059669;--oe-amber:#D97706;--oe-red:#DC2626;--oe-violet:#7C3AED;}
.oe-header{background:linear-gradient(135deg,#0F172A,#1E1B4B,#1e3a5f);border-radius:20px;padding:32px 36px;margin-bottom:28px;position:relative;overflow:hidden;border:1px solid rgba(99,102,241,.2);}
.oe-header::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.06) 1px,transparent 1px);background-size:32px 32px;border-radius:20px;}
.oe-header::after{content:'';position:absolute;top:-80px;right:-80px;width:280px;height:280px;border-radius:50%;background:radial-gradient(circle,rgba(79,70,229,.18) 0%,transparent 65%);}
.oe-header-inner{position:relative;z-index:2;}
.oe-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(6,182,212,.12);border:1px solid rgba(6,182,212,.3);border-radius:9999px;padding:5px 14px;font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:14px;}
.oe-live-dot{width:6px;height:6px;border-radius:50%;background:#22D3EE;animation:oe-pulse 2s infinite;}
@keyframes oe-pulse{0%,100%{opacity:1}50%{opacity:.4}}
.oe-kpi{background:#fff;border:1px solid #F1F5F9;border-radius:18px;padding:22px 24px;box-shadow:0 4px 20px rgba(0,0,0,.04);transition:all .25s;position:relative;overflow:hidden;}
.oe-kpi:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(0,0,0,.08);}
.oe-kpi-icon{width:50px;height:50px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;margin-bottom:14px;}
.oe-kpi-val{font-size:2rem;font-weight:800;letter-spacing:-1px;line-height:1;margin-bottom:4px;}
.oe-kpi-lbl{font-size:.72rem;font-weight:600;color:#64748B;text-transform:uppercase;letter-spacing:.5px;}
.oe-card{background:#fff;border:1px solid #F1F5F9;border-radius:18px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.04);}
.oe-row{display:flex;align-items:center;gap:16px;padding:16px 24px;border-bottom:1px solid #F8FAFC;transition:background .15s;}
.oe-row:last-child{border-bottom:none;}
.oe-row:hover{background:#FAFBFF;}
.oe-exam-icon{width:46px;height:46px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;}
.oe-title{font-size:.88rem;font-weight:700;color:#1E293B;margin-bottom:2px;}
.oe-meta{font-size:.7rem;color:#94A3B8;display:flex;flex-wrap:wrap;gap:10px;}
.oe-meta span{display:flex;align-items:center;gap:4px;}
.oe-status{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:9999px;font-size:.67rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;white-space:nowrap;}
.oe-btn{padding:7px 14px;border-radius:9px;font-size:.75rem;font-weight:700;display:inline-flex;align-items:center;gap:6px;text-decoration:none;border:none;cursor:pointer;transition:all .2s;font-family:'Outfit',sans-serif;}
.oe-btn-indigo{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;box-shadow:0 2px 8px rgba(79,70,229,.3);}
.oe-btn-indigo:hover{color:#fff;transform:translateY(-1px);box-shadow:0 4px 14px rgba(79,70,229,.4);}
.oe-btn-green{background:linear-gradient(135deg,#059669,#0D9488);color:#fff;}
.oe-btn-green:hover{color:#fff;transform:translateY(-1px);}
.oe-btn-cyan{background:linear-gradient(135deg,#06B6D4,#0EA5E9);color:#fff;}
.oe-btn-cyan:hover{color:#fff;transform:translateY(-1px);}
.oe-btn-outline{background:#fff;border:1px solid #E2E8F0;color:#475569;}
.oe-btn-outline:hover{border-color:#4F46E5;color:#4F46E5;background:#F5F3FF;}
.oe-btn-red{background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;}
.oe-btn-red:hover{background:#DC2626;color:#fff;}
.oe-filters{display:flex;gap:10px;flex-wrap:wrap;align-items:center;background:#FAFAFA;padding:14px 24px;border-bottom:1px solid #F1F5F9;}
.oe-input{background:#fff;border:1.5px solid #E2E8F0;border-radius:10px;padding:8px 14px;font-size:.8rem;color:#1E293B;outline:none;transition:border-color .2s;font-family:'Outfit',sans-serif;}
.oe-input:focus{border-color:#4F46E5;box-shadow:0 0 0 3px rgba(79,70,229,.08);}
.oe-header-title{font-size:1.9rem;font-weight:800;color:#fff;letter-spacing:-1px;margin-bottom:6px;}
.oe-header-sub{font-size:.88rem;color:rgba(255,255,255,.5);}
</style>

{{-- Header --}}
<div class="oe-header">
    <div class="oe-header-inner row align-items-center g-3">
        <div class="col-lg-8">
            <div class="oe-badge"><span class="oe-live-dot"></span> Online Examinations</div>
            <h1 class="oe-header-title">MCQ Online Exams</h1>
            <p class="oe-header-sub">Create timed MCQ exams, auto-evaluate, proctor, and publish results instantly.</p>
        </div>
        <div class="col-lg-4 text-lg-end d-flex gap-2 justify-content-lg-end flex-wrap">
            <a href="{{ route('question-bank.index') }}" class="oe-btn oe-btn-outline" style="background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.15);color:#fff;">
                <i class="fas fa-database"></i> Question Bank
            </a>
            @can('manage-academics')
            <a href="{{ route('online-exams.create') }}" class="oe-btn oe-btn-indigo">
                <i class="fas fa-plus"></i> New Exam
            </a>
            @endcan
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert border-0 rounded-3 mb-4 d-flex align-items-center gap-3" style="background:#F0FDF4;border-left:4px solid #059669 !important;" role="alert">
    <div style="width:36px;height:36px;background:#059669;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas fa-check text-white"></i></div>
    <div style="font-size:.85rem;font-weight:600;color:#047857;">{{ session('success') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- KPIs --}}
@php
    $allExams      = \App\Models\OnlineExam::get();
    $liveCount     = $allExams->filter(fn($e) => $e->isLive())->count();
    $totalAttempts = \App\Models\OnlineExamSession::where('status','submitted')->count();
    $qbCount       = \App\Models\QuestionBank::count();
@endphp
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="oe-kpi">
            <div class="oe-kpi-icon" style="background:#EEF2FF;color:#4F46E5;"><i class="fas fa-file-alt"></i></div>
            <div class="oe-kpi-val" style="color:#4F46E5;">{{ $exams->total() }}</div>
            <div class="oe-kpi-lbl">Total Exams</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="oe-kpi">
            <div class="oe-kpi-icon" style="background:#F0FDF4;color:#059669;"><i class="fas fa-broadcast-tower"></i></div>
            <div class="oe-kpi-val" style="color:#059669;">{{ $liveCount }}</div>
            <div class="oe-kpi-lbl">Live Now</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="oe-kpi">
            <div class="oe-kpi-icon" style="background:#ECFEFF;color:#06B6D4;"><i class="fas fa-user-check"></i></div>
            <div class="oe-kpi-val" style="color:#06B6D4;">{{ $totalAttempts }}</div>
            <div class="oe-kpi-lbl">Total Attempts</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="oe-kpi">
            <div class="oe-kpi-icon" style="background:#FDF4FF;color:#7C3AED;"><i class="fas fa-database"></i></div>
            <div class="oe-kpi-val" style="color:#7C3AED;">{{ $qbCount }}</div>
            <div class="oe-kpi-lbl">Questions in Bank</div>
        </div>
    </div>
</div>

{{-- Exam List --}}
<div class="oe-card">
    {{-- Filters --}}
    <form action="{{ route('online-exams.index') }}" method="GET">
        <div class="oe-filters">
            <div style="position:relative;flex:1;min-width:180px;">
                <i class="fas fa-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94A3B8;font-size:.75rem;"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search exams..." class="oe-input w-100" style="padding-left:34px;">
            </div>
            <select name="batch_id" class="oe-input" style="min-width:150px;">
                <option value="">All Batches</option>
                @foreach($batches as $b)
                    <option value="{{ $b->id }}" {{ request('batch_id')==$b->id?'selected':'' }}>{{ $b->name }}</option>
                @endforeach
            </select>
            <select name="status" class="oe-input" style="min-width:130px;">
                <option value="">All Status</option>
                @foreach(['draft'=>'Draft','published'=>'Published','closed'=>'Closed'] as $v=>$l)
                    <option value="{{ $v }}" {{ request('status')==$v?'selected':'' }}>{{ $l }}</option>
                @endforeach
            </select>
            <button type="submit" style="background:#4F46E5;color:#fff;border:none;border-radius:10px;padding:8px 18px;font-size:.8rem;font-weight:700;cursor:pointer;font-family:'Outfit',sans-serif;">
                <i class="fas fa-filter me-1"></i>Filter
            </button>
            @if(request()->anyFilled(['search','batch_id','status']))
                <a href="{{ route('online-exams.index') }}" class="oe-btn oe-btn-outline" style="padding:8px 14px;">Clear</a>
            @endif
        </div>
    </form>

    {{-- Header row --}}
    <div style="padding:16px 24px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;display:flex;align-items:center;justify-content:space-between;">
        <div style="font-size:.88rem;font-weight:700;color:#1E293B;display:flex;align-items:center;gap:10px;">
            <div style="width:32px;height:32px;border-radius:9px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:.75rem;"><i class="fas fa-list-alt"></i></div>
            All Exams
            <span style="background:#EEF2FF;color:#4F46E5;font-size:.68rem;font-weight:700;padding:3px 10px;border-radius:9999px;">{{ $exams->total() }}</span>
        </div>
        @can('manage-academics')
        <a href="{{ route('online-exams.create') }}" class="oe-btn oe-btn-indigo"><i class="fas fa-plus"></i> New Exam</a>
        @endcan
    </div>

    @forelse($exams as $exam)
    @php
        $label = $exam->status_label;
        $color = $exam->status_color;
        $colors = [['#EEF2FF','#4F46E5'],['#ECFEFF','#06B6D4'],['#F0FDF4','#059669'],['#FFF7ED','#D97706'],['#FDF4FF','#7C3AED']];
        $c = $colors[$loop->index % 5];
        $attempted = $exam->sessions->count();
    @endphp
    <div class="oe-row">
        <div class="oe-exam-icon" style="background:{{ $c[0] }};color:{{ $c[1] }};"><i class="fas fa-laptop-code"></i></div>
        <div style="flex:1;min-width:0;">
            <div class="oe-title text-truncate">{{ $exam->title }}</div>
            <div class="oe-meta">
                @if($exam->subject)<span><i class="fas fa-book"></i> {{ $exam->subject->name }}</span>@endif
                <span><i class="fas fa-layer-group"></i> {{ $exam->batch->name }}</span>
                <span><i class="fas fa-clock"></i> {{ $exam->duration_minutes }} min</span>
                <span><i class="fas fa-calendar"></i> {{ $exam->start_datetime->format('d M, Y h:i A') }}</span>
                <span><i class="fas fa-question-circle"></i> {{ $exam->questions->count() }} Qs</span>
                <span><i class="fas fa-users"></i> {{ $attempted }} attempted</span>
            </div>
        </div>
        <div class="d-none d-md-block">
            <span class="oe-status" style="background:{{ $color }}1A;color:{{ $color }};border:1px solid {{ $color }}40;">
                @if($label==='Live')<i class="fas fa-circle" style="font-size:.5rem;"></i>@endif
                {{ $label }}
            </span>
        </div>
        <div class="d-none d-lg-flex gap-1 flex-wrap" style="flex-shrink:0;max-width:340px;">
            @can('manage-academics')
            @if($exam->status==='draft')
                <a href="{{ route('online-exams.questions', $exam) }}" class="oe-btn oe-btn-outline"><i class="fas fa-list-ol"></i> Questions</a>
                <form action="{{ route('online-exams.publish', $exam) }}" method="POST" class="m-0">@csrf
                    <button type="submit" class="oe-btn oe-btn-green"><i class="fas fa-broadcast-tower"></i> Publish</button>
                </form>
            @endif
            @if($exam->status==='published')
                <a href="{{ route('online-exams.questions', $exam) }}" class="oe-btn oe-btn-outline"><i class="fas fa-list-ol"></i> Qs</a>
                <a href="{{ route('online-exams.results', $exam) }}" class="oe-btn oe-btn-cyan"><i class="fas fa-chart-bar"></i> Results</a>
                <form action="{{ route('online-exams.close', $exam) }}" method="POST" class="m-0">@csrf
                    <button type="submit" class="oe-btn oe-btn-outline" onclick="return confirm('Close this exam?')"><i class="fas fa-lock"></i></button>
                </form>
            @endif
            @if($exam->status==='closed')
                <a href="{{ route('online-exams.results', $exam) }}" class="oe-btn oe-btn-cyan"><i class="fas fa-chart-bar"></i> Results</a>
            @endif
            <a href="{{ route('online-exams.edit', $exam) }}" class="oe-btn oe-btn-outline"><i class="fas fa-edit"></i></a>
            <form action="{{ route('online-exams.destroy', $exam) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this exam and all student data?')">
                @csrf @method('DELETE')
                <button class="oe-btn oe-btn-red"><i class="fas fa-trash"></i></button>
            </form>
            @endcan
        </div>
    </div>
    @empty
    <div style="text-align:center;padding:60px 24px;">
        <div style="font-size:3rem;opacity:.12;margin-bottom:16px;"><i class="fas fa-laptop-code"></i></div>
        <div style="font-size:1rem;font-weight:700;color:#1E293B;margin-bottom:6px;">No Online Exams Yet</div>
        <div style="font-size:.83rem;color:#94A3B8;margin-bottom:20px;">Create your first MCQ exam and let students take it online.</div>
        @can('manage-academics')
        <a href="{{ route('online-exams.create') }}" class="oe-btn oe-btn-indigo"><i class="fas fa-plus"></i> Create First Exam</a>
        @endcan
    </div>
    @endforelse

    @if($exams->hasPages())
    <div class="px-4 py-3 border-top" style="background:#FAFAFA;">{{ $exams->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
