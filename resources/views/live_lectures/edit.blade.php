@extends('layouts.admin')

@section('title', 'Edit Live Lecture')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Edit Live Lecture</h4>
    <a href="{{ route('live-lectures.index') }}" class="btn btn-light rounded-pill px-3 shadow-sm border">
        <i class="fas fa-arrow-left me-2"></i> Back to Lectures
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('live-lectures.update', $liveLecture) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">Batch</label>
                            <select name="batch_id" class="form-select border-0 bg-light py-2 @error('batch_id') is-invalid @enderror" required>
                                <option value="">Select Batch</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ (old('batch_id') ?? $liveLecture->batch_id) == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('batch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">Subject</label>
                            <input type="text" name="subject" class="form-control border-0 bg-light py-2 @error('subject') is-invalid @enderror" value="{{ old('subject') ?? $liveLecture->subject }}" required>
                            @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold text-secondary">Lecture Title</label>
                            <input type="text" name="title" class="form-control border-0 bg-light py-2 @error('title') is-invalid @enderror" value="{{ old('title') ?? $liveLecture->title }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">Recorded Date</label>
                            <input type="date" name="recorded_at" class="form-control border-0 bg-light py-2 @error('recorded_at') is-invalid @enderror" value="{{ old('recorded_at') ?? $liveLecture->recorded_at->format('Y-m-d') }}" required>
                            @error('recorded_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary">Replace Video (Optional)</label>
                            <input type="file" name="video_file" accept="video/mp4,video/quicktime,video/x-msvideo" class="form-control border-0 bg-light py-2 @error('video_file') is-invalid @enderror">
                            <small class="text-muted d-block mt-1">Leave blank to keep the current video.</small>
                            @error('video_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-secondary">Description (Optional)</label>
                            <textarea name="description" rows="3" class="form-control border-0 bg-light py-2 @error('description') is-invalid @enderror">{{ old('description') ?? $liveLecture->description }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary-glow btn-modern w-100 py-3 fs-5">
                                <i class="fas fa-save me-2"></i> Update Lecture
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
