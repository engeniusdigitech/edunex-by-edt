@extends('layouts.admin')
@section('title', 'Edit Question')
@section('content')
<style>
.qb-form-header{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.qb-form-header::before{content:'';position:absolute;inset:0;border-radius:18px;background-image:linear-gradient(rgba(99,102,241,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.06) 1px,transparent 1px);background-size:28px 28px;}
.qb-form-card{background:#fff;border:1px solid #F1F5F9;border-radius:18px;box-shadow:0 4px 20px rgba(0,0,0,.05);overflow:hidden;}
.qb-sec-hdr{padding:16px 28px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;font-size:.78rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;display:flex;align-items:center;gap:10px;}
.qb-body{padding:28px;}
.qb-field label{display:block;font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px;}
.qb-field .form-control,.qb-field .form-select{border:1.5px solid #E2E8F0;border-radius:12px;padding:11px 16px;font-size:.88rem;color:#1E293B;font-family:'Outfit',sans-serif;transition:all .2s;background:#fff;}
.qb-field .form-control:focus,.qb-field .form-select:focus{border-color:#4F46E5;box-shadow:0 0 0 3px rgba(79,70,229,.08);outline:none;}
.qb-field .is-invalid{border-color:#DC2626;}
.opt-correct{border:1.5px solid #059669;background:#F0FDF4;}
.qb-submit-btn{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:12px 28px;border-radius:12px;font-size:.88rem;font-weight:700;display:inline-flex;align-items:center;gap:9px;cursor:pointer;transition:all .2s;box-shadow:0 4px 20px rgba(79,70,229,.3);font-family:'Outfit',sans-serif;}
.qb-submit-btn:hover{transform:translateY(-1px);box-shadow:0 8px 28px rgba(79,70,229,.4);}
.answer-preview{background:#F8FAFC;border:1.5px solid #E2E8F0;border-radius:12px;padding:16px;margin-top:16px;}
</style>

<div class="qb-form-header">
    <div style="position:relative;z-index:2;display:flex;align-items:center;gap:14px;">
        <a href="{{ route('question-bank.index') }}" style="width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,.08);border:1.5px solid rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;flex-shrink:0;"><i class="fas fa-arrow-left"></i></a>
        <div>
            <div style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><i class="fas fa-database me-1"></i> Question Bank</div>
            <h2 style="font-size:1.4rem;font-weight:800;color:#fff;margin:0;letter-spacing:-.5px;">Edit Question</h2>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="qb-form-card">
            <div class="qb-sec-hdr"><i class="fas fa-pen" style="color:#4F46E5;"></i> Question Details</div>
            <div class="qb-body">
                <form action="{{ route('question-bank.update', $questionBank->id) }}" method="POST" id="qbForm">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 qb-field">
                            <label>Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                                <option value="">— Select Subject —</option>
                                @foreach($subjects as $s)<option value="{{ $s->id }}" {{ old('subject_id', $questionBank->subject_id)==$s->id?'selected':'' }}>{{ $s->name }}</option>@endforeach
                            </select>
                            @error('subject_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 qb-field">
                            <label>Difficulty <span class="text-danger">*</span></label>
                            <select name="difficulty" class="form-select @error('difficulty') is-invalid @enderror" required>
                                <option value="easy" {{ old('difficulty', $questionBank->difficulty)=='easy'?'selected':'' }}>🟢 Easy</option>
                                <option value="medium" {{ old('difficulty', $questionBank->difficulty)=='medium'?'selected':'' }}>🟡 Medium</option>
                                <option value="hard" {{ old('difficulty', $questionBank->difficulty)=='hard'?'selected':'' }}>🔴 Hard</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 qb-field">
                        <label>Question <span class="text-danger">*</span></label>
                        <textarea name="question" class="form-control @error('question') is-invalid @enderror" rows="3" placeholder="Type the question here..." required>{{ old('question', $questionBank->question) }}</textarea>
                        @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div style="font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:10px;">Answer Options <span class="text-danger">*</span></div>
                    <div class="row g-2 mb-3">
                        @foreach(['a'=>'Option A *','b'=>'Option B *','c'=>'Option C','d'=>'Option D'] as $k=>$lbl)
                        <div class="col-md-6 qb-field">
                            <label>{{ $lbl }}</label>
                            <input type="text" name="option_{{ $k }}" id="opt_{{ $k }}"
                                   class="form-control opt-input @error('option_'.$k) is-invalid @enderror"
                                   value="{{ old('option_'.$k, $questionBank->{'option_'.$k}) }}"
                                   placeholder="{{ $lbl }}"
                                   {{ in_array($k,['a','b'])?'required':'' }}>
                            @error('option_'.$k)<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @endforeach
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6 qb-field">
                            <label>Correct Answer <span class="text-danger">*</span></label>
                            <select name="correct_option" id="correctSelect" class="form-select" required>
                                <option value="a" {{ old('correct_option', $questionBank->correct_option)=='a'?'selected':'' }}>A</option>
                                <option value="b" {{ old('correct_option', $questionBank->correct_option)=='b'?'selected':'' }}>B</option>
                                <option value="c" {{ old('correct_option', $questionBank->correct_option)=='c'?'selected':'' }}>C</option>
                                <option value="d" {{ old('correct_option', $questionBank->correct_option)=='d'?'selected':'' }}>D</option>
                            </select>
                        </div>
                        <div class="col-md-6 qb-field">
                            <label>Marks <span class="text-danger">*</span></label>
                            <input type="number" name="marks" class="form-control" value="{{ old('marks', $questionBank->marks) }}" min="1" max="100" required>
                        </div>
                    </div>

                    <div class="mb-4 qb-field">
                        <label>Explanation (shown to students after exam if review is enabled)</label>
                        <textarea name="explanation" class="form-control" rows="2" placeholder="Explain why this answer is correct...">{{ old('explanation', $questionBank->explanation) }}</textarea>
                    </div>

                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <button type="submit" class="qb-submit-btn"><i class="fas fa-save"></i> Update Question</button>
                        <a href="{{ route('question-bank.index') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;font-weight:600;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div style="background:linear-gradient(135deg,#ECFEFF,#EFF6FF);border:1px solid #BFDBFE;border-radius:14px;padding:20px;">
            <div style="font-size:.72rem;font-weight:700;color:#1E40AF;text-transform:uppercase;letter-spacing:.8px;margin-bottom:12px;"><i class="fas fa-lightbulb me-1"></i> Tips</div>
            @foreach([
                'Write clear, unambiguous question text',
                'Make all options plausible — avoid obviously wrong distractors',
                'One correct answer per MCQ question',
                'Add an explanation so students learn from mistakes',
                'Tag difficulty correctly for proper exam balance',
            ] as $tip)
            <div style="display:flex;gap:9px;margin-bottom:10px;font-size:.78rem;color:#1E40AF;"><i class="fas fa-check" style="color:#2563EB;margin-top:2px;flex-shrink:0;"></i>{{ $tip }}</div>
            @endforeach
        </div>
    </div>
</div>
@endsection
