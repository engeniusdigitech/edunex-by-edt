@extends('layouts.admin')

@section('title', 'Schedule Live Lecture')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('live-lectures.index') }}" class="btn btn-light rounded-circle shadow-sm me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-arrow-left text-secondary"></i>
    </a>
    <h4 class="mb-0 fw-bold">Schedule New Live Lecture</h4>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <form action="{{ route('live-lectures.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold text-secondary small text-uppercase">Select Batch <span class="text-danger">*</span></label>
                        <select name="batch_id" class="form-select form-select-lg rounded-3 @error('batch_id') is-invalid @enderror" required>
                            <option value="">-- Choose a batch --</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                            @endforeach
                        </select>
                        @error('batch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold text-secondary small text-uppercase">Subject <span class="text-danger">*</span></label>
                        <select name="subject" class="form-select form-select-lg rounded-3 @error('subject') is-invalid @enderror" required>
                            <option value="">-- Choose a subject --</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->name }}" {{ old('subject') == $subject->name ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Lecture Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Introduction to Algebra" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-5">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Description / Agenda</label>
                    <textarea name="description" class="form-control form-control-lg rounded-3 @error('description') is-invalid @enderror" rows="3" placeholder="What will be covered in this lecture?">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="alert alert-info rounded-4 border-0 bg-primary bg-opacity-10">
                    <i class="fas fa-info-circle me-2 text-primary"></i>
                    <strong>How it works:</strong> Scheduling creates the lecture room. When you're ready to teach, click <strong>"Go Live"</strong> on the index page to open the interactive video classroom — your students will see a join button instantly!
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('live-lectures.index') }}" class="btn btn-light btn-lg rounded-pill px-4 me-2 fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary-glow btn-modern btn-lg px-5">Schedule Lecture <i class="fas fa-calendar-check ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #4F46E5, #818CF8); color: white;">
            <i class="fas fa-broadcast-tower fa-2x mb-3 text-white-50"></i>
            <h5 class="fw-bold text-white">Powered by Jitsi Meet</h5>
            <p class="text-white-50 small mb-0">Completely browser-based. No download required. Students join with a single click — no account needed.</p>
        </div>
    </div>
</div>
@endsection
