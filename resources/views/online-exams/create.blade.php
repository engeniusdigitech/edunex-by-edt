@extends('layouts.admin')
@section('title', 'Create Online Exam')
@section('content')
<style>
.oe-form-header{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.oe-form-header::before{content:'';position:absolute;inset:0;border-radius:18px;background-image:linear-gradient(rgba(99,102,241,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.06) 1px,transparent 1px);background-size:28px 28px;}
.oe-form-header-inner{position:relative;z-index:2;}
.oe-form-card{background:#fff;border:1px solid #F1F5F9;border-radius:18px;box-shadow:0 4px 20px rgba(0,0,0,.05);overflow:hidden;}
.oe-sec-header{padding:16px 28px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;font-size:.78rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;display:flex;align-items:center;gap:10px;}
.oe-body{padding:28px;}
.oe-field label{display:block;font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px;}
.oe-field .form-control,.oe-field .form-select{border:1.5px solid #E2E8F0;border-radius:12px;padding:11px 16px;font-size:.88rem;color:#1E293B;font-family:'Outfit',sans-serif;transition:all .2s;background:#fff;}
.oe-field .form-control:focus,.oe-field .form-select:focus{border-color:#4F46E5;box-shadow:0 0 0 3px rgba(79,70,229,.08);outline:none;}
.oe-field .form-control.is-invalid{border-color:#DC2626;}
.oe-toggle{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border:1.5px solid #E2E8F0;border-radius:12px;background:#FAFAFA;cursor:pointer;transition:all .2s;}
.oe-toggle:hover{border-color:#4F46E5;background:#F5F3FF;}
.oe-toggle input{display:none;}
.oe-toggle-track{width:40px;height:22px;background:#E2E8F0;border-radius:9999px;position:relative;transition:background .2s;flex-shrink:0;}
.oe-toggle input:checked~.oe-toggle-track{background:#4F46E5;}
.oe-toggle-thumb{position:absolute;top:3px;left:3px;width:16px;height:16px;background:#fff;border-radius:50%;transition:transform .2s;box-shadow:0 1px 4px rgba(0,0,0,.2);}
.oe-toggle input:checked~.oe-toggle-track .oe-toggle-thumb{transform:translateX(18px);}
.oe-submit-btn{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:13px 32px;border-radius:12px;font-size:.9rem;font-weight:700;display:inline-flex;align-items:center;gap:10px;cursor:pointer;transition:all .2s;box-shadow:0 4px 20px rgba(79,70,229,.3);font-family:'Outfit',sans-serif;}
.oe-submit-btn:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(79,70,229,.4);}
.oe-back-btn{width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,.08);border:1.5px solid rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;transition:all .2s;flex-shrink:0;}
.oe-back-btn:hover{background:rgba(255,255,255,.15);color:#fff;}
</style>

<div class="oe-form-header">
    <div class="oe-form-header-inner d-flex align-items-center gap-3">
        <a href="{{ route('online-exams.index') }}" class="oe-back-btn"><i class="fas fa-arrow-left"></i></a>
        <div>
            <div style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><i class="fas fa-laptop-code me-1"></i> Online Exam System</div>
            <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:0;letter-spacing:-.5px;">Create New Online Exam</h2>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="oe-form-card">
            <div class="oe-sec-header"><i class="fas fa-edit" style="color:#4F46E5;"></i> Exam Details</div>
            <div class="oe-body">
                <form action="{{ route('online-exams.store') }}" method="POST">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 oe-field">
                            <label>Batch <span class="text-danger">*</span></label>
                            <select name="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
                                <option value="">— Select Batch —</option>
                                @foreach($batches as $b)
                                    <option value="{{ $b->id }}" {{ old('batch_id')==$b->id?'selected':'' }}>{{ $b->name }}</option>
                                @endforeach
                            </select>
                            @error('batch_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 oe-field">
                            <label>Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                                <option value="">— Select Subject —</option>
                                @foreach($subjects as $s)
                                    <option value="{{ $s->id }}" data-batch="{{ $s->batch_id }}" {{ old('subject_id')==$s->id?'selected':'' }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3 oe-field">
                        <label>Exam Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Chapter 5 — Photosynthesis MCQ Test" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 oe-field">
                            <label>Start Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="start_datetime" class="form-control @error('start_datetime') is-invalid @enderror" value="{{ old('start_datetime') }}" required>
                            @error('start_datetime')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 oe-field">
                            <label>End Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="end_datetime" class="form-control @error('end_datetime') is-invalid @enderror" value="{{ old('end_datetime') }}" required>
                            @error('end_datetime')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6 oe-field">
                            <label>Duration (minutes) <span class="text-danger">*</span></label>
                            <input type="number" name="duration_minutes" class="form-control @error('duration_minutes') is-invalid @enderror" value="{{ old('duration_minutes', 60) }}" min="1" max="480" required>
                            <div style="font-size:.7rem;color:#94A3B8;margin-top:5px;">Student has this long from the moment they start</div>
                            @error('duration_minutes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 oe-field">
                            <label>Pass Percentage (%) <span class="text-danger">*</span></label>
                            <input type="number" name="pass_percentage" class="form-control @error('pass_percentage') is-invalid @enderror" value="{{ old('pass_percentage', 40) }}" min="1" max="100" required>
                            @error('pass_percentage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3 oe-field">
                        <label>Instructions (shown to students before exam)</label>
                        <textarea name="instructions" class="form-control" rows="3" placeholder="Read all questions carefully. No calculator allowed...">{{ old('instructions') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <div style="font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:12px;">Exam Settings</div>
                        <div class="d-flex flex-column gap-2">
                            @foreach([
                                ['shuffle_questions','Shuffle question order for each student','fas fa-random'],
                                ['show_result_immediately','Show result immediately after submission','fas fa-eye'],
                                ['allow_review','Allow students to review answers after submission','fas fa-check-double'],
                            ] as [$name,$label,$icon])
                            <label class="oe-toggle">
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div style="width:30px;height:30px;border-radius:8px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:.75rem;flex-shrink:0;"><i class="{{ $icon }}"></i></div>
                                    <span style="font-size:.82rem;font-weight:600;color:#1E293B;">{{ $label }}</span>
                                </div>
                                <div style="position:relative;">
                                    <input type="checkbox" name="{{ $name }}" value="1" {{ old($name,'1')?'checked':'' }}>
                                    <div class="oe-toggle-track"><div class="oe-toggle-thumb"></div></div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="oe-submit-btn"><i class="fas fa-arrow-right"></i> Save & Add Questions</button>
                        <a href="{{ route('online-exams.index') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;font-weight:600;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div style="background:linear-gradient(135deg,#ECFEFF,#EFF6FF);border:1px solid #BFDBFE;border-radius:14px;padding:20px;">
            <div style="font-size:.72rem;font-weight:700;color:#1E40AF;text-transform:uppercase;letter-spacing:.8px;margin-bottom:12px;"><i class="fas fa-lightbulb me-1"></i> How It Works</div>
            @foreach([
                ['1','Create exam','Set batch, duration, and schedule'],
                ['2','Add questions','Pick from Question Bank or add directly'],
                ['3','Publish','Students can now take the exam in their portal'],
                ['4','Auto-evaluate','System grades MCQs instantly on submit'],
                ['5','View results','Analytics, rankings, and proctoring logs'],
            ] as [$n,$t,$d])
            <div style="display:flex;gap:12px;margin-bottom:14px;">
                <div style="width:26px;height:26px;border-radius:8px;background:#2563EB;color:#fff;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:800;flex-shrink:0;">{{ $n }}</div>
                <div>
                    <div style="font-size:.8rem;font-weight:700;color:#1E293B;">{{ $t }}</div>
                    <div style="font-size:.72rem;color:#475569;">{{ $d }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')@include('components.batch-subject-filter')@endpush
@endsection
