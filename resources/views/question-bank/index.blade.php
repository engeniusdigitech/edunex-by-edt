@extends('layouts.admin')
@section('title', 'Question Bank')
@section('content')
<style>
.qb-header{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.qb-header::before{content:'';position:absolute;inset:0;border-radius:18px;background-image:linear-gradient(rgba(99,102,241,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.06) 1px,transparent 1px);background-size:28px 28px;}
.qb-header-inner{position:relative;z-index:2;}
.qb-kpi{background:#fff;border:1px solid #F1F5F9;border-radius:14px;padding:18px 20px;box-shadow:0 2px 12px rgba(0,0,0,.04);}
.qb-card{background:#fff;border:1px solid #F1F5F9;border-radius:18px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.04);}
.qb-row{padding:16px 24px;border-bottom:1px solid #F8FAFC;display:flex;align-items:flex-start;gap:14px;transition:background .15s;}
.qb-row:last-child{border-bottom:none;}
.qb-row:hover{background:#FAFBFF;}
.qb-num{width:32px;height:32px;border-radius:9px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:800;flex-shrink:0;}
.qb-q{font-size:.85rem;font-weight:600;color:#1E293B;margin-bottom:6px;line-height:1.5;}
.qb-opts{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:6px;}
.qb-opt{font-size:.7rem;color:#475569;padding:3px 9px;border-radius:6px;border:1px solid #F1F5F9;background:#FAFAFA;display:flex;align-items:center;gap:5px;}
.qb-opt.correct{background:#F0FDF4;border-color:#A7F3D0;color:#059669;font-weight:700;}
.diff-badge{display:inline-flex;padding:3px 9px;border-radius:6px;font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;}
.qb-btn{padding:6px 13px;border-radius:8px;font-size:.72rem;font-weight:700;display:inline-flex;align-items:center;gap:5px;text-decoration:none;border:none;cursor:pointer;transition:all .2s;font-family:'Outfit',sans-serif;}
.qb-btn-outline{background:#fff;border:1px solid #E2E8F0;color:#475569;}
.qb-btn-outline:hover{border-color:#4F46E5;color:#4F46E5;}
.qb-btn-indigo{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;box-shadow:0 2px 8px rgba(79,70,229,.2);}
.qb-btn-indigo:hover{color:#fff;transform:translateY(-1px);}
.qb-btn-red{background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;}
.qb-btn-red:hover{background:#DC2626;color:#fff;}
.qb-input{background:#fff;border:1.5px solid #E2E8F0;border-radius:10px;padding:8px 14px;font-size:.8rem;color:#1E293B;outline:none;transition:border-color .2s;font-family:'Outfit',sans-serif;}
.qb-input:focus{border-color:#4F46E5;box-shadow:0 0 0 3px rgba(79,70,229,.08);}
</style>

<div class="qb-header">
    <div class="qb-header-inner row align-items-center g-3">
        <div class="col-lg-8">
            <div style="display:inline-flex;align-items:center;gap:7px;background:rgba(6,182,212,.12);border:1px solid rgba(6,182,212,.3);border-radius:9999px;padding:5px 14px;font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:12px;"><i class="fas fa-database"></i> Question Bank</div>
            <h1 style="font-size:1.7rem;font-weight:800;color:#fff;letter-spacing:-1px;margin-bottom:6px;">Centralized Question Repository</h1>
            <p style="font-size:.85rem;color:rgba(255,255,255,.5);margin:0;">Store, organize, and reuse questions across multiple online exams.</p>
        </div>
        <div class="col-lg-4 text-lg-end d-flex gap-2 justify-content-lg-end">
            <a href="{{ route('online-exams.index') }}" style="padding:10px 18px;border-radius:10px;background:rgba(255,255,255,.08);border:1.5px solid rgba(255,255,255,.15);color:#fff;text-decoration:none;font-size:.82rem;font-weight:600;display:inline-flex;align-items:center;gap:7px;transition:all .2s;"><i class="fas fa-arrow-left"></i> Exams</a>
            <a href="{{ route('question-bank.create') }}" style="padding:10px 20px;border-radius:10px;background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;text-decoration:none;font-size:.82rem;font-weight:700;display:inline-flex;align-items:center;gap:7px;box-shadow:0 4px 14px rgba(79,70,229,.35);transition:all .2s;"><i class="fas fa-plus"></i> Add Question</a>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert border-0 mb-4 d-flex align-items-center gap-3" style="background:#F0FDF4;border-left:4px solid #059669 !important;border-radius:12px;" role="alert">
    <i class="fas fa-check-circle" style="color:#059669;"></i>
    <span style="font-size:.85rem;font-weight:600;color:#047857;">{{ session('success') }}</span>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- KPIs --}}
<div class="row g-3 mb-4">
    @foreach([
        ['Total Questions', $questions->total(), '#4F46E5', '#EEF2FF', 'fa-database'],
        ['Easy', \App\Models\QuestionBank::where('difficulty','easy')->count(), '#059669', '#F0FDF4', 'fa-smile'],
        ['Medium', \App\Models\QuestionBank::where('difficulty','medium')->count(), '#D97706', '#FFFBEB', 'fa-meh'],
        ['Hard', \App\Models\QuestionBank::where('difficulty','hard')->count(), '#DC2626', '#FEF2F2', 'fa-frown'],
    ] as [$lbl,$val,$color,$bg,$icon])
    <div class="col-6 col-xl-3">
        <div class="qb-kpi">
            <div style="width:40px;height:40px;border-radius:11px;background:{{ $bg }};color:{{ $color }};display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:10px;"><i class="fas {{ $icon }}"></i></div>
            <div style="font-size:1.7rem;font-weight:800;color:{{ $color }};letter-spacing:-1px;line-height:1;margin-bottom:3px;">{{ $val }}</div>
            <div style="font-size:.68rem;font-weight:600;color:#64748B;text-transform:uppercase;letter-spacing:.5px;">{{ $lbl }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Filters + List --}}
<div class="qb-card">
    <form action="{{ route('question-bank.index') }}" method="GET">
        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;background:#FAFAFA;padding:14px 24px;border-bottom:1px solid #F1F5F9;">
            <div style="position:relative;flex:1;min-width:180px;">
                <i class="fas fa-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94A3B8;font-size:.72rem;"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search questions..." class="qb-input w-100" style="padding-left:34px;">
            </div>
            <select name="subject_id" class="qb-input" style="min-width:150px;">
                <option value="">All Subjects</option>
                @foreach($subjects as $s)
                    <option value="{{ $s->id }}" {{ request('subject_id')==$s->id?'selected':'' }}>{{ $s->name }}</option>
                @endforeach
            </select>
            <select name="difficulty" class="qb-input" style="min-width:120px;">
                <option value="">All Difficulties</option>
                <option value="easy" {{ request('difficulty')=='easy'?'selected':'' }}>Easy</option>
                <option value="medium" {{ request('difficulty')=='medium'?'selected':'' }}>Medium</option>
                <option value="hard" {{ request('difficulty')=='hard'?'selected':'' }}>Hard</option>
            </select>
            <button type="submit" style="background:#4F46E5;color:#fff;border:none;border-radius:10px;padding:8px 18px;font-size:.8rem;font-weight:700;cursor:pointer;font-family:'Outfit',sans-serif;"><i class="fas fa-filter me-1"></i>Filter</button>
            @if(request()->anyFilled(['search','subject_id','difficulty']))
                <a href="{{ route('question-bank.index') }}" class="qb-btn qb-btn-outline">Clear</a>
            @endif
            <a href="{{ route('question-bank.create') }}" class="qb-btn qb-btn-indigo ms-auto"><i class="fas fa-plus"></i> Add Question</a>
        </div>
    </form>

    @forelse($questions as $q)
    @php
        $diffColor = $q->difficulty==='easy' ? '#059669' : ($q->difficulty==='hard' ? '#DC2626' : '#D97706');
        $diffBg    = $q->difficulty==='easy' ? '#F0FDF4' : ($q->difficulty==='hard' ? '#FEF2F2' : '#FFFBEB');
    @endphp
    <div class="qb-row">
        <div class="qb-num">{{ ($questions->currentPage()-1)*$questions->perPage()+$loop->iteration }}</div>
        <div style="flex:1;min-width:0;">
            <div class="qb-q">{{ $q->question }}</div>
            <div class="qb-opts">
                @foreach(['a'=>$q->option_a,'b'=>$q->option_b,'c'=>$q->option_c,'d'=>$q->option_d] as $k=>$v)
                    @if($v)<div class="qb-opt {{ $q->correct_option===$k?'correct':'' }}"><span style="font-weight:800;">{{ strtoupper($k) }}.</span> {{ $v }}</div>@endif
                @endforeach
            </div>
            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                <span class="diff-badge" style="background:{{ $diffBg }};color:{{ $diffColor }};">{{ $q->difficulty }}</span>
                @if($q->subject)<span style="font-size:.68rem;color:#64748B;font-weight:600;"><i class="fas fa-book me-1"></i>{{ $q->subject->name }}</span>@endif
                <span style="font-size:.68rem;color:#64748B;font-weight:600;"><i class="fas fa-bullseye me-1"></i>{{ $q->marks }} mark(s)</span>
                <span style="font-size:.68rem;color:#64748B;font-weight:600;"><i class="fas fa-layer-group me-1"></i>Used in {{ $q->examQuestions()->count() }} exam(s)</span>
            </div>
        </div>
        <div class="d-flex gap-2 flex-shrink-0">
            <a href="{{ route('question-bank.edit', $q) }}" class="qb-btn qb-btn-outline"><i class="fas fa-edit"></i></a>
            <form action="{{ route('question-bank.destroy', $q) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this question?')">
                @csrf @method('DELETE')
                <button class="qb-btn qb-btn-red"><i class="fas fa-trash"></i></button>
            </form>
        </div>
    </div>
    @empty
    <div style="text-align:center;padding:60px 24px;">
        <div style="font-size:3rem;opacity:.12;margin-bottom:16px;"><i class="fas fa-database"></i></div>
        <div style="font-size:1rem;font-weight:700;color:#1E293B;margin-bottom:6px;">Question Bank is Empty</div>
        <div style="font-size:.83rem;color:#94A3B8;margin-bottom:20px;">Start building your repository — questions can be reused across multiple exams.</div>
        <a href="{{ route('question-bank.create') }}" class="qb-btn qb-btn-indigo"><i class="fas fa-plus"></i> Add First Question</a>
    </div>
    @endforelse

    @if($questions->hasPages())
    <div class="px-4 py-3 border-top" style="background:#FAFAFA;">{{ $questions->withQueryString()->links() }}</div>
    @endif
</div>
@endsection
