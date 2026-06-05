@extends('layouts.admin')

@section('title', 'Edit Test — ' . $test->title)

@section('content')
<style>
.dap-form-header {
    background: linear-gradient(135deg, #0F172A, #1E1B4B);
    border-radius: 18px; padding: 28px 32px; margin-bottom: 28px;
    border: 1px solid rgba(99,102,241,0.2); position: relative; overflow: hidden;
}
.dap-form-header::before {
    content:''; position:absolute; inset:0; border-radius:18px;
    background-image:linear-gradient(rgba(99,102,241,0.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,0.06) 1px,transparent 1px);
    background-size:28px 28px;
}
.dap-form-header-inner { position:relative;z-index:2; }
.dap-form-card { background:#fff; border:1px solid #F1F5F9; border-radius:18px; box-shadow:0 4px 20px rgba(0,0,0,0.05); overflow:hidden; }
.dap-form-section-header { padding:16px 28px; border-bottom:1px solid #F1F5F9; background:#FAFAFA; font-size:0.8rem; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:0.8px; display:flex; align-items:center; gap:10px; }
.dap-form-body { padding:28px; }
.dap-field label { display:block; font-size:0.72rem; font-weight:700; color:#475569; text-transform:uppercase; letter-spacing:0.7px; margin-bottom:7px; }
.dap-field .form-control, .dap-field .form-select { border:1.5px solid #E2E8F0; border-radius:12px; padding:12px 16px; font-size:0.88rem; color:#1E293B; font-family:'Outfit',sans-serif; transition:all 0.2s; background:#fff; }
.dap-field .form-control:focus, .dap-field .form-select:focus { border-color:#4F46E5; box-shadow:0 0 0 4px rgba(79,70,229,0.08); outline:none; }
.dap-field .form-control.is-invalid { border-color:#DC2626; }
.dap-submit-btn { background:linear-gradient(135deg,#4F46E5,#7C3AED); color:#fff; border:none; padding:13px 32px; border-radius:12px; font-size:0.9rem; font-weight:700; display:inline-flex; align-items:center; gap:10px; cursor:pointer; transition:all 0.2s; box-shadow:0 4px 20px rgba(79,70,229,0.3); font-family:'Outfit',sans-serif; }
.dap-submit-btn:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(79,70,229,0.4); }
</style>

{{-- Header --}}
<div class="dap-form-header mb-4">
    <div class="dap-form-header-inner d-flex align-items-center gap-3">
        <a href="{{ route('tests.index') }}"
           style="width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,0.08);border:1.5px solid rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;flex-shrink:0;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <div style="font-size:0.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">
                <i class="fas fa-edit me-1"></i> Digital Assessment Platform
            </div>
            <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:0;letter-spacing:-0.5px;">Edit Test</h2>
            <div style="font-size:0.78rem;color:rgba(255,255,255,0.5);margin-top:4px;">{{ $test->title }}</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="dap-form-card">
            <div class="dap-form-section-header">
                <i class="fas fa-edit" style="color:#4F46E5;"></i> Exam Details
            </div>
            <div class="dap-form-body">
                <form action="{{ route('tests.update', $test) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 dap-field">
                            <label>Select Batch <span class="text-danger">*</span></label>
                            <select name="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
                                <option value="">— Choose a batch —</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ old('batch_id', $test->batch_id) == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                                @endforeach
                            </select>
                            @error('batch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 dap-field">
                            <label>Select Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                                <option value="">— Choose a subject —</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" data-batch="{{ $subject->batch_id }}" {{ old('subject_id', $test->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 dap-field">
                        <label>Exam Title <span class="text-danger">*</span></label>
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $test->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 dap-field">
                            <label>Test Date <span class="text-danger">*</span></label>
                            <input type="date" name="test_date"
                                class="form-control @error('test_date') is-invalid @enderror"
                                value="{{ old('test_date', $test->test_date->format('Y-m-d')) }}" required>
                            @error('test_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 dap-field">
                            <label>Total Marks <span class="text-danger">*</span></label>
                            <input type="number" name="total_marks"
                                class="form-control @error('total_marks') is-invalid @enderror"
                                value="{{ old('total_marks', $test->total_marks) }}" min="1" required>
                            @error('total_marks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Existing attachments --}}
                    @if($test->attachments->count() > 0)
                    <div class="mb-3">
                        <label class="dap-field" style="display:block;">
                            <span style="font-size:0.72rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.7px;display:block;margin-bottom:8px;">Current Attachments</span>
                        </label>
                        <div style="border:1.5px solid #E2E8F0;border-radius:12px;overflow:hidden;">
                            @foreach($test->attachments as $attachment)
                            <div style="display:flex;align-items:center;justify-content:space-between;padding:11px 16px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;">
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div style="width:30px;height:30px;border-radius:8px;background:#EEF2FF;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-paperclip" style="color:#4F46E5;font-size:0.75rem;"></i>
                                    </div>
                                    <a href="{{ asset('storage/'.$attachment->file_path) }}" target="_blank"
                                       style="font-size:0.8rem;font-weight:600;color:#1E293B;text-decoration:none;max-width:240px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;">
                                        {{ $attachment->original_name }}
                                    </a>
                                    <span style="font-size:0.68rem;color:#94A3B8;">({{ number_format($attachment->file_size / 1024, 1) }} KB)</span>
                                </div>
                                <a href="{{ asset('storage/'.$attachment->file_path) }}" target="_blank"
                                   style="width:28px;height:28px;border-radius:7px;background:#EEF2FF;display:flex;align-items:center;justify-content:center;color:#4F46E5;text-decoration:none;">
                                    <i class="fas fa-download" style="font-size:0.7rem;"></i>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mb-3 dap-field">
                        <label>Add Attachments</label>
                        <input type="file" name="attachments[]"
                            class="form-control @error('attachments.*') is-invalid @enderror"
                            multiple accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                        <div style="font-size:0.72rem;color:#64748B;margin-top:5px;">
                            <i class="fas fa-info-circle me-1" style="color:#4F46E5;"></i>Upload documents, PDFs, or images (max 10MB each)
                        </div>
                        @error('attachments.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4 dap-field">
                        <label>Syllabus / Description</label>
                        <textarea name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="3">{{ old('description', $test->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="dap-submit-btn">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="{{ route('tests.index') }}" style="font-size:0.85rem;color:#64748B;text-decoration:none;font-weight:600;">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Sidebar info --}}
    <div class="col-lg-4">
        <div style="background:#fff;border:1px solid #F1F5F9;border-radius:14px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,0.04);margin-bottom:16px;">
            <div style="font-size:0.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:14px;">
                <i class="fas fa-info-circle me-1" style="color:#4F46E5;"></i> Test Info
            </div>
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach([
                    ['label'=>'Batch','value'=>$test->batch->name,'color'=>'#4F46E5'],
                    ['label'=>'Date','value'=>$test->test_date->format('d M, Y'),'color'=>'#D97706'],
                    ['label'=>'Total Marks','value'=>$test->total_marks,'color'=>'#059669'],
                    ['label'=>'Students','value'=>$test->batch->students->count().' students','color'=>'#06B6D4'],
                ] as $info)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:9px 0;border-bottom:1px solid #F8FAFC;">
                    <span style="font-size:0.75rem;font-weight:600;color:#94A3B8;">{{ $info['label'] }}</span>
                    <span style="font-size:0.8rem;font-weight:700;color:{{ $info['color'] }};">{{ $info['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div style="background:#FFFBEB;border:1px solid #FDE68A;border-radius:14px;padding:16px;">
            <div style="font-size:0.72rem;font-weight:700;color:#92400E;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:8px;">
                <i class="fas fa-exclamation-triangle me-1" style="color:#D97706;"></i> Note
            </div>
            <div style="font-size:0.78rem;color:#78350F;line-height:1.6;">
                Editing total marks after marks have been entered may affect existing score percentages. Review student scores after saving.
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @include('components.batch-subject-filter')
@endpush

@endsection