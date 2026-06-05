@extends('layouts.admin')

@section('title', 'Schedule New Test')

@section('content')
<style>
.dap-form-header {
    background: linear-gradient(135deg, #0F172A, #1E1B4B);
    border-radius: 18px; padding: 28px 32px; margin-bottom: 28px;
    border: 1px solid rgba(99,102,241,0.2); position: relative; overflow: hidden;
}
.dap-form-header::before {
    content:''; position:absolute; inset:0; border-radius:18px;
    background-image: linear-gradient(rgba(99,102,241,0.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,0.06) 1px,transparent 1px);
    background-size:28px 28px;
}
.dap-form-header-inner { position:relative;z-index:2; }
.dap-form-card { background:#fff; border:1px solid #F1F5F9; border-radius:18px; box-shadow:0 4px 20px rgba(0,0,0,0.05); overflow:hidden; }
.dap-form-section-header {
    padding:16px 28px; border-bottom:1px solid #F1F5F9; background:#FAFAFA;
    font-size:0.8rem; font-weight:700; color:#475569;
    text-transform:uppercase; letter-spacing:0.8px;
    display:flex; align-items:center; gap:10px;
}
.dap-form-body { padding:28px; }
.dap-field label {
    display:block; font-size:0.72rem; font-weight:700; color:#475569;
    text-transform:uppercase; letter-spacing:0.7px; margin-bottom:7px;
}
.dap-field .form-control, .dap-field .form-select {
    border:1.5px solid #E2E8F0; border-radius:12px; padding:12px 16px;
    font-size:0.88rem; color:#1E293B; font-family:'Outfit',sans-serif;
    transition:all 0.2s; background:#fff;
}
.dap-field .form-control:focus, .dap-field .form-select:focus {
    border-color:#4F46E5; box-shadow:0 0 0 4px rgba(79,70,229,0.08); outline:none;
}
.dap-field .form-control.is-invalid { border-color:#DC2626; }
.dap-submit-btn {
    background:linear-gradient(135deg,#4F46E5,#7C3AED); color:#fff; border:none;
    padding:13px 32px; border-radius:12px; font-size:0.9rem; font-weight:700;
    display:inline-flex; align-items:center; gap:10px; cursor:pointer;
    transition:all 0.2s; box-shadow:0 4px 20px rgba(79,70,229,0.3);
    font-family:'Outfit',sans-serif;
}
.dap-submit-btn:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(79,70,229,0.4); }
.dap-back-btn {
    width:42px; height:42px; border-radius:12px; background:#fff;
    border:1.5px solid #E2E8F0; display:flex; align-items:center; justify-content:center;
    color:#475569; text-decoration:none; transition:all 0.2s; flex-shrink:0;
}
.dap-back-btn:hover { border-color:#4F46E5; color:#4F46E5; background:#F5F3FF; }
.dap-tip-card {
    background:linear-gradient(135deg,#ECFEFF,#EFF6FF); border:1px solid #BFDBFE;
    border-radius:14px; padding:20px;
}
</style>

{{-- Header --}}
<div class="dap-form-header mb-4">
    <div class="dap-form-header-inner d-flex align-items-center gap-3">
        <a href="{{ route('tests.index') }}" class="dap-back-btn" style="background:rgba(255,255,255,0.08);border-color:rgba(255,255,255,0.15);color:#fff;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <div style="font-size:0.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;">
                <i class="fas fa-clipboard-list me-1"></i> Digital Assessment Platform
            </div>
            <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:0;letter-spacing:-0.5px;">Schedule New Test</h2>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Form --}}
    <div class="col-lg-8">
        <div class="dap-form-card">
            <div class="dap-form-section-header">
                <i class="fas fa-edit" style="color:#4F46E5;"></i> Exam Details
            </div>
            <div class="dap-form-body">
                <form action="{{ route('tests.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 dap-field">
                            <label>Select Batch <span class="text-danger">*</span></label>
                            <select name="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
                                <option value="">— Choose a batch —</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                                @endforeach
                            </select>
                            @error('batch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 dap-field">
                            <label>Select Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                                <option value="">— Choose a subject —</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" data-batch="{{ $subject->batch_id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 dap-field">
                        <label>Exam Title <span class="text-danger">*</span></label>
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" placeholder="e.g. Mathematics Mid-Term Examination 2025" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6 dap-field">
                            <label>Test Date <span class="text-danger">*</span></label>
                            <input type="date" name="test_date"
                                class="form-control @error('test_date') is-invalid @enderror"
                                value="{{ old('test_date') }}" required>
                            @error('test_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 dap-field">
                            <label>Total Marks <span class="text-danger">*</span></label>
                            <input type="number" name="total_marks"
                                class="form-control @error('total_marks') is-invalid @enderror"
                                value="{{ old('total_marks', 100) }}" min="1" required>
                            @error('total_marks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 dap-field">
                        <label>Syllabus / Description</label>
                        <textarea name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="3" placeholder="Chapters to be covered, rules, instructions for students...">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4 dap-field">
                        <label>Attachments</label>
                        <input type="file" name="attachments[]"
                            class="form-control @error('attachments.*') is-invalid @enderror"
                            multiple accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                        <div class="form-text text-muted" style="font-size:0.72rem;margin-top:5px;">
                            <i class="fas fa-info-circle me-1" style="color:#4F46E5;"></i>
                            Upload question papers, PDFs, or images (max 10MB each)
                        </div>
                        @error('attachments.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="dap-submit-btn">
                            <i class="fas fa-paper-plane"></i> Publish Test
                        </button>
                        <a href="{{ route('tests.index') }}" style="font-size:0.85rem;color:#64748B;text-decoration:none;font-weight:600;">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Sidebar Tips --}}
    <div class="col-lg-4">
        <div class="dap-tip-card mb-3">
            <div style="font-size:0.75rem;font-weight:700;color:#1E40AF;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:10px;">
                <i class="fas fa-lightbulb me-1" style="color:#2563EB;"></i> Quick Tips
            </div>
            @foreach([
                ['icon'=>'fa-check','text'=>'Select the batch first, then choose the related subject'],
                ['icon'=>'fa-check','text'=>'Set the total marks before entering student scores'],
                ['icon'=>'fa-check','text'=>'Add syllabus notes so students know what to prepare'],
                ['icon'=>'fa-check','text'=>'You can enter student marks after the test date passes'],
            ] as $tip)
            <div style="display:flex;gap:10px;margin-bottom:10px;font-size:0.8rem;color:#1E40AF;">
                <i class="fas {{ $tip['icon'] }}" style="color:#2563EB;margin-top:2px;flex-shrink:0;"></i>
                {{ $tip['text'] }}
            </div>
            @endforeach
        </div>

        <div style="background:#fff;border:1px solid #F1F5F9;border-radius:14px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,0.04);">
            <div style="font-size:0.75rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:14px;">
                <i class="fas fa-info-circle me-1" style="color:#4F46E5;"></i> After Publishing
            </div>
            @foreach([
                ['icon'=>'fa-tasks','color'=>'#4F46E5','text'=>'Enter marks via the "Marks" button on the list'],
                ['icon'=>'fa-chart-bar','color'=>'#059669','text'=>'View performance analytics in student profiles'],
                ['icon'=>'fa-file-invoice','color'=>'#D97706','text'=>'Students can view their scores in their portal'],
            ] as $step)
            <div style="display:flex;gap:12px;margin-bottom:14px;align-items:flex-start;">
                <div style="width:30px;height:30px;border-radius:8px;background:{{ $step['color'] }}1A;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas {{ $step['icon'] }}" style="color:{{ $step['color'] }};font-size:0.75rem;"></i>
                </div>
                <div style="font-size:0.78rem;color:#475569;line-height:1.5;padding-top:4px;">{{ $step['text'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
    @include('components.batch-subject-filter')
@endpush

@endsection