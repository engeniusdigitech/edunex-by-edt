@extends('layouts.admin')
@section('title', 'Questions — ' . $onlineExam->title)
@section('content')
<style>
.oe-qhdr{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.oe-qhdr::before{content:'';position:absolute;inset:0;border-radius:18px;background-image:linear-gradient(rgba(99,102,241,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.06) 1px,transparent 1px);background-size:28px 28px;}
.oe-qhdr-inner{position:relative;z-index:2;}
.oe-card{background:#fff;border:1px solid #F1F5F9;border-radius:18px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.04);}
.oe-card-hdr{padding:16px 24px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;display:flex;align-items:center;justify-content:space-between;}
.oe-card-title{font-size:.88rem;font-weight:700;color:#1E293B;display:flex;align-items:center;gap:10px;}
.q-item{padding:16px 24px;border-bottom:1px solid #F8FAFC;display:flex;gap:14px;align-items:flex-start;transition:background .15s;}
.q-item:last-child{border-bottom:none;}
.q-item:hover{background:#FAFBFF;}
.q-num{width:30px;height:30px;border-radius:9px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:800;flex-shrink:0;margin-top:2px;}
.q-text{font-size:.85rem;font-weight:600;color:#1E293B;margin-bottom:8px;line-height:1.5;}
.q-options{display:grid;grid-template-columns:1fr 1fr;gap:5px;}
.q-opt{font-size:.75rem;color:#475569;padding:5px 10px;border-radius:7px;border:1px solid #F1F5F9;background:#FAFAFA;display:flex;align-items:center;gap:6px;}
.q-opt.correct{background:#F0FDF4;border-color:#A7F3D0;color:#059669;font-weight:700;}
.q-opt-lbl{width:18px;height:18px;border-radius:5px;background:#E2E8F0;display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;flex-shrink:0;}
.q-opt.correct .q-opt-lbl{background:#059669;color:#fff;}
.diff-badge{display:inline-flex;padding:3px 8px;border-radius:6px;font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;}
.oe-btn{padding:7px 14px;border-radius:9px;font-size:.75rem;font-weight:700;display:inline-flex;align-items:center;gap:6px;text-decoration:none;border:none;cursor:pointer;transition:all .2s;font-family:'Outfit',sans-serif;}
.oe-btn-indigo{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;}
.oe-btn-indigo:hover{color:#fff;transform:translateY(-1px);}
.oe-btn-green{background:linear-gradient(135deg,#059669,#0D9488);color:#fff;}
.oe-btn-green:hover{color:#fff;}
.oe-btn-red{background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;}
.oe-btn-red:hover{background:#DC2626;color:#fff;}
.oe-btn-outline{background:#fff;border:1px solid #E2E8F0;color:#475569;}
.oe-btn-outline:hover{border-color:#4F46E5;color:#4F46E5;}
.bank-item{padding:14px 20px;border-bottom:1px solid #F8FAFC;display:flex;align-items:flex-start;gap:12px;transition:background .15s;}
.bank-item:hover{background:#FAFBFF;}
.bank-item:last-child{border-bottom:none;}
.oe-field label{display:block;font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:6px;}
.oe-field .form-control,.oe-field .form-select{border:1.5px solid #E2E8F0;border-radius:10px;padding:9px 14px;font-size:.85rem;color:#1E293B;font-family:'Outfit',sans-serif;transition:all .2s;}
.oe-field .form-control:focus,.oe-field .form-select:focus{border-color:#4F46E5;box-shadow:0 0 0 3px rgba(79,70,229,.08);outline:none;}
</style>

<div class="oe-qhdr">
    <div class="oe-qhdr-inner d-flex align-items-start gap-3 flex-wrap">
        <a href="{{ route('online-exams.index') }}" style="width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,.08);border:1.5px solid rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;flex-shrink:0;"><i class="fas fa-arrow-left"></i></a>
        <div style="flex:1;">
            <div style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;"><i class="fas fa-list-ol me-1"></i> Question Manager</div>
            <h2 style="font-size:1.4rem;font-weight:800;color:#fff;margin:0 0 8px;letter-spacing:-.5px;">{{ $onlineExam->title }}</h2>
            <div style="display:flex;flex-wrap:wrap;gap:8px;">
                <span style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:4px 12px;font-size:.72rem;font-weight:600;color:rgba(255,255,255,.7);"><i class="fas fa-layer-group me-1" style="color:#67E8F9;"></i>{{ $onlineExam->batch->name }}</span>
                <span style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:4px 12px;font-size:.72rem;font-weight:600;color:rgba(255,255,255,.7);"><i class="fas fa-question-circle me-1" style="color:#67E8F9;"></i>{{ $onlineExam->questions->count() }} Questions</span>
                <span style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:4px 12px;font-size:.72rem;font-weight:600;color:rgba(255,255,255,.7);"><i class="fas fa-bullseye me-1" style="color:#67E8F9;"></i>{{ $onlineExam->total_marks }} Total Marks</span>
            </div>
        </div>
        @if($onlineExam->status==='draft')
        <form action="{{ route('online-exams.publish', $onlineExam) }}" method="POST" class="m-0">@csrf
            <button type="submit" class="oe-btn oe-btn-green" style="padding:11px 20px;font-size:.85rem;">
                <i class="fas fa-broadcast-tower"></i> Publish Exam
            </button>
        </form>
        @endif
    </div>
</div>

@if(session('success'))
<div class="alert border-0 mb-4 d-flex align-items-center gap-3" style="background:#F0FDF4;border-left:4px solid #059669 !important;border-radius:12px;" role="alert">
    <i class="fas fa-check-circle" style="color:#059669;"></i>
    <span style="font-size:.85rem;font-weight:600;color:#047857;">{{ session('success') }}</span>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">
    {{-- LEFT: Current questions in exam --}}
    <div class="col-lg-6">
        <div class="oe-card">
            <div class="oe-card-hdr">
                <div class="oe-card-title">
                    <div style="width:30px;height:30px;border-radius:8px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:.72rem;"><i class="fas fa-list-ol"></i></div>
                    Exam Questions
                    <span style="background:#EEF2FF;color:#4F46E5;font-size:.68rem;font-weight:700;padding:3px 9px;border-radius:9999px;">{{ $onlineExam->questions->count() }}</span>
                </div>
            </div>

            @forelse($onlineExam->questions as $q)
            <div class="q-item">
                <div class="q-num">{{ $loop->iteration }}</div>
                <div style="flex:1;min-width:0;">
                    <div class="q-text">{{ $q->question }}</div>
                    <div class="q-options">
                        @foreach(['a'=>$q->option_a,'b'=>$q->option_b,'c'=>$q->option_c,'d'=>$q->option_d] as $key=>$val)
                            @if($val)
                            <div class="q-opt {{ $q->correct_option===$key?'correct':'' }}">
                                <div class="q-opt-lbl">{{ strtoupper($key) }}</div>
                                <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $val }}</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;margin-top:8px;">
                        <span style="font-size:.68rem;font-weight:600;color:#64748B;"><i class="fas fa-bullseye me-1"></i>{{ $q->marks }} mark(s)</span>
                    </div>
                </div>
                <form action="{{ route('online-exams.questions.destroy', [$onlineExam, $q]) }}" method="POST" class="m-0" onsubmit="return confirm('Remove this question?')">
                    @csrf @method('DELETE')
                    <button class="oe-btn oe-btn-red" style="padding:6px 10px;"><i class="fas fa-times"></i></button>
                </form>
            </div>
            @empty
            <div style="text-align:center;padding:48px 24px;">
                <div style="font-size:2.5rem;opacity:.12;margin-bottom:12px;"><i class="fas fa-question"></i></div>
                <div style="font-size:.9rem;font-weight:700;color:#1E293B;margin-bottom:6px;">No questions yet</div>
                <div style="font-size:.8rem;color:#94A3B8;">Add from the question bank or create directly below.</div>
            </div>
            @endforelse
        </div>
    </div>

    {{-- RIGHT: Add questions --}}
    <div class="col-lg-6">

        {{-- From Question Bank --}}
        <div class="oe-card mb-4">
            <div class="oe-card-hdr">
                <div class="oe-card-title">
                    <div style="width:30px;height:30px;border-radius:8px;background:#FDF4FF;color:#7C3AED;display:flex;align-items:center;justify-content:center;font-size:.72rem;"><i class="fas fa-database"></i></div>
                    Add from Question Bank
                </div>
            </div>

            {{-- Bank filters --}}
            <form action="{{ route('online-exams.questions', $onlineExam) }}" method="GET" style="display:flex;gap:8px;flex-wrap:wrap;padding:12px 20px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;">
                <input type="text" name="bank_search" placeholder="Search questions..." value="{{ request('bank_search') }}" class="oe-field" style="flex:1;min-width:140px;background:#fff;border:1.5px solid #E2E8F0;border-radius:9px;padding:7px 12px;font-size:.78rem;font-family:'Outfit',sans-serif;outline:none;">
                <select name="difficulty" style="background:#fff;border:1.5px solid #E2E8F0;border-radius:9px;padding:7px 12px;font-size:.78rem;font-family:'Outfit',sans-serif;outline:none;">
                    <option value="">All Difficulties</option>
                    <option value="easy" {{ request('difficulty')=='easy'?'selected':'' }}>Easy</option>
                    <option value="medium" {{ request('difficulty')=='medium'?'selected':'' }}>Medium</option>
                    <option value="hard" {{ request('difficulty')=='hard'?'selected':'' }}>Hard</option>
                </select>
                <button type="submit" style="background:#7C3AED;color:#fff;border:none;border-radius:9px;padding:7px 14px;font-size:.78rem;font-weight:700;cursor:pointer;font-family:'Outfit',sans-serif;">Filter</button>
            </form>

            <div style="max-height:360px;overflow-y:auto;">
                @forelse($bankQuestions as $bq)
                <div class="bank-item">
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:.82rem;font-weight:600;color:#1E293B;margin-bottom:4px;line-height:1.4;">{{ Str::limit($bq->question, 90) }}</div>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                            <span class="diff-badge" style="background:{{ $bq->difficulty==='easy'?'#F0FDF4':($bq->difficulty==='hard'?'#FEF2F2':'#FFFBEB') }};color:{{ $bq->difficulty_color }};">{{ $bq->difficulty }}</span>
                            <span style="font-size:.68rem;color:#94A3B8;font-weight:600;"><i class="fas fa-bullseye me-1"></i>{{ $bq->marks }} mark(s)</span>
                            <span style="font-size:.68rem;color:#94A3B8;font-weight:600;"><i class="fas fa-check me-1" style="color:#059669;"></i>Ans: {{ strtoupper($bq->correct_option) }}</span>
                        </div>
                    </div>
                    <form action="{{ route('online-exams.questions.store', $onlineExam) }}" method="POST" class="m-0">
                        @csrf
                        <input type="hidden" name="question_bank_id" value="{{ $bq->id }}">
                        <button type="submit" class="oe-btn oe-btn-indigo" style="padding:6px 12px;white-space:nowrap;"><i class="fas fa-plus"></i> Add</button>
                    </form>
                </div>
                @empty
                <div style="text-align:center;padding:32px;font-size:.82rem;color:#94A3B8;">
                    No questions found for this subject.
                    <a href="{{ route('question-bank.create') }}" style="color:#4F46E5;font-weight:700;">Add to bank</a>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Add directly --}}
        <div class="oe-card">
            <div class="oe-card-hdr">
                <div class="oe-card-title">
                    <div style="width:30px;height:30px;border-radius:8px;background:#ECFEFF;color:#06B6D4;display:flex;align-items:center;justify-content:center;font-size:.72rem;"><i class="fas fa-pen"></i></div>
                    Add Question Directly
                </div>
            </div>
            <div style="padding:20px;">
                <form action="{{ route('online-exams.questions.store', $onlineExam) }}" method="POST">
                    @csrf
                    <div class="oe-field mb-3">
                        <label>Question <span class="text-danger">*</span></label>
                        <textarea name="question" class="form-control" rows="2" placeholder="Type your question here..." required></textarea>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6 oe-field"><label>Option A <span class="text-danger">*</span></label><input type="text" name="option_a" class="form-control" placeholder="Option A" required></div>
                        <div class="col-6 oe-field"><label>Option B <span class="text-danger">*</span></label><input type="text" name="option_b" class="form-control" placeholder="Option B" required></div>
                        <div class="col-6 oe-field"><label>Option C</label><input type="text" name="option_c" class="form-control" placeholder="Option C"></div>
                        <div class="col-6 oe-field"><label>Option D</label><input type="text" name="option_d" class="form-control" placeholder="Option D"></div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6 oe-field">
                            <label>Correct Answer <span class="text-danger">*</span></label>
                            <select name="correct_option" class="form-select" required>
                                <option value="a">A</option><option value="b">B</option><option value="c">C</option><option value="d">D</option>
                            </select>
                        </div>
                        <div class="col-6 oe-field">
                            <label>Marks <span class="text-danger">*</span></label>
                            <input type="number" name="marks" class="form-control" value="1" min="1" required>
                        </div>
                    </div>
                    <button type="submit" class="oe-btn oe-btn-indigo w-100" style="justify-content:center;padding:11px;font-size:.85rem;"><i class="fas fa-plus"></i> Add Question</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
