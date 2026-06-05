@extends('layouts.admin')
@section('title', 'Edit Exam — ' . $onlineExam->title)
@section('content')
<style>
.oe-form-header{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.oe-form-header::before{content:'';position:absolute;inset:0;border-radius:18px;background-image:linear-gradient(rgba(99,102,241,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.06) 1px,transparent 1px);background-size:28px 28px;}
.oe-form-header-inner{position:relative;z-index:2;}
.oe-form-card{background:#fff;border:1px solid #F1F5F9;border-radius:18px;box-shadow:0 4px 20px rgba(0,0,0,.05);overflow:hidden;}
.oe-sec-header{padding:16px 28px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;font-size:.78rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;display:flex;align-items:center;gap:10px;}
.oe-body{padding:28px;}
.oe-field label{display:block;font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px;}
.oe-field .form-control,.oe-field .form-select{border:1.5px solid #E2E8F0;border-radius:12px;padding:11px 16px;font-size:.88rem;color:#1E293B;font-family:'Outfit',sans-serif;transition:all .2s;}
.oe-field .form-control:focus,.oe-field .form-select:focus{border-color:#4F46E5;box-shadow:0 0 0 3px rgba(79,70,229,.08);outline:none;}
.oe-toggle{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border:1.5px solid #E2E8F0;border-radius:12px;background:#FAFAFA;cursor:pointer;transition:all .2s;}
.oe-toggle:hover{border-color:#4F46E5;background:#F5F3FF;}
.oe-toggle input{display:none;}
.oe-toggle-track{width:40px;height:22px;background:#E2E8F0;border-radius:9999px;position:relative;transition:background .2s;flex-shrink:0;}
.oe-toggle input:checked~.oe-toggle-track{background:#4F46E5;}
.oe-toggle-thumb{position:absolute;top:3px;left:3px;width:16px;height:16px;background:#fff;border-radius:50%;transition:transform .2s;box-shadow:0 1px 4px rgba(0,0,0,.2);}
.oe-toggle input:checked~.oe-toggle-track .oe-toggle-thumb{transform:translateX(18px);}
.oe-submit-btn{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:13px 32px;border-radius:12px;font-size:.9rem;font-weight:700;display:inline-flex;align-items:center;gap:10px;cursor:pointer;transition:all .2s;box-shadow:0 4px 20px rgba(79,70,229,.3);font-family:'Outfit',sans-serif;}
.oe-submit-btn:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(79,70,229,.4);}
</style>

<div class="oe-form-header">
    <div class="oe-form-header-inner d-flex align-items-center gap-3">
        <a href="{{ route('online-exams.index') }}" style="width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,.08);border:1.5px solid rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;"><i class="fas fa-arrow-left"></i></a>
        <div>
            <div style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><i class="fas fa-edit me-1"></i> Edit Exam</div>
            <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:0;letter-spacing:-.5px;">{{ $onlineExam->title }}</h2>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="oe-form-card">
            <div class="oe-sec-header"><i class="fas fa-edit" style="color:#4F46E5;"></i> Exam Details</div>
            <div class="oe-body">
                <form action="{{ route('online-exams.update', $onlineExam) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 oe-field">
                            <label>Batch <span class="text-danger">*</span></label>
                            <select name="batch_id" class="form-select" required>
                                @foreach($batches as $b)
                                    <option value="{{ $b->id }}" {{ old('batch_id',$onlineExam->batch_id)==$b->id?'selected':'' }}>{{ $b->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 oe-field">
                            <label>Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-select" required>
                                @foreach($subjects as $s)
                                    <option value="{{ $s->id }}" data-batch="{{ $s->batch_id }}" {{ old('subject_id',$onlineExam->subject_id)==$s->id?'selected':'' }}>{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 oe-field">
                        <label>Exam Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title',$onlineExam->title) }}" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 oe-field">
                            <label>Start Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="start_datetime" class="form-control" value="{{ old('start_datetime',$onlineExam->start_datetime->format('Y-m-d\TH:i')) }}" required>
                        </div>
                        <div class="col-md-6 oe-field">
                            <label>End Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="end_datetime" class="form-control" value="{{ old('end_datetime',$onlineExam->end_datetime->format('Y-m-d\TH:i')) }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 oe-field">
                            <label>Duration (minutes)</label>
                            <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes',$onlineExam->duration_minutes) }}" min="1" max="480">
                        </div>
                        <div class="col-md-6 oe-field">
                            <label>Pass Percentage (%)</label>
                            <input type="number" name="pass_percentage" class="form-control" value="{{ old('pass_percentage',$onlineExam->pass_percentage) }}" min="1" max="100">
                        </div>
                    </div>

                    <div class="mb-4 oe-field">
                        <label>Instructions</label>
                        <textarea name="instructions" class="form-control" rows="3">{{ old('instructions',$onlineExam->instructions) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <div style="font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:12px;">Settings</div>
                        <div class="d-flex flex-column gap-2">
                            @foreach([
                                ['shuffle_questions','Shuffle questions','fas fa-random'],
                                ['show_result_immediately','Show result immediately','fas fa-eye'],
                                ['allow_review','Allow answer review','fas fa-check-double'],
                            ] as [$name,$label,$icon])
                            <label class="oe-toggle">
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div style="width:28px;height:28px;border-radius:8px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:.72rem;flex-shrink:0;"><i class="{{ $icon }}"></i></div>
                                    <span style="font-size:.82rem;font-weight:600;color:#1E293B;">{{ $label }}</span>
                                </div>
                                <div style="position:relative;">
                                    <input type="checkbox" name="{{ $name }}" value="1" {{ old($name,$onlineExam->$name)?'checked':'' }}>
                                    <div class="oe-toggle-track"><div class="oe-toggle-thumb"></div></div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-center">
                        <button type="submit" class="oe-submit-btn"><i class="fas fa-save"></i> Save Changes</button>
                        <a href="{{ route('online-exams.questions', $onlineExam) }}" style="font-size:.85rem;color:#4F46E5;text-decoration:none;font-weight:700;"><i class="fas fa-list-ol me-1"></i> Manage Questions</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div style="background:#fff;border:1px solid #F1F5F9;border-radius:14px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,.04);">
            <div style="font-size:.72rem;font-weight:700;color:#475569;text-transform:uppercase;margin-bottom:14px;"><i class="fas fa-info-circle me-1" style="color:#4F46E5;"></i> Exam Info</div>
            @foreach([
                ['Questions',$onlineExam->questions()->count().' added','#4F46E5'],
                ['Total Marks',$onlineExam->total_marks,'#059669'],
                ['Attempts',$onlineExam->sessions()->count(),'#D97706'],
                ['Status',$onlineExam->status_label,$onlineExam->status_color],
            ] as [$l,$v,$c])
            <div style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid #F8FAFC;">
                <span style="font-size:.75rem;font-weight:600;color:#94A3B8;">{{ $l }}</span>
                <span style="font-size:.82rem;font-weight:700;color:{{ $c }};">{{ $v }}</span>
            </div>
            @endforeach
        </div>
        @if($onlineExam->status==='draft')
        <div style="margin-top:12px;">
            <form action="{{ route('online-exams.publish', $onlineExam) }}" method="POST">@csrf
                <button type="submit" style="width:100%;background:linear-gradient(135deg,#059669,#0D9488);color:#fff;border:none;padding:12px;border-radius:12px;font-size:.85rem;font-weight:700;cursor:pointer;font-family:'Outfit',sans-serif;display:flex;align-items:center;justify-content:center;gap:8px;">
                    <i class="fas fa-broadcast-tower"></i> Publish This Exam
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

@push('scripts')@include('components.batch-subject-filter')@endpush
@endsection
