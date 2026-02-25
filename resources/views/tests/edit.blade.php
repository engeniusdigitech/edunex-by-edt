@extends('layouts.admin')

@section('title', 'Edit Test')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('tests.index') }}" class="btn btn-light rounded-circle shadow-sm me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-arrow-left text-secondary"></i>
    </a>
    <h4 class="mb-0 fw-bold">Edit Test</h4>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <form action="{{ route('tests.update', $test) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Select Batch <span class="text-danger">*</span></label>
                    <select name="batch_id" class="form-select form-select-lg rounded-3 @error('batch_id') is-invalid @enderror" required>
                        <option value="">-- Choose a batch --</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}" {{ old('batch_id', $test->batch_id) == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                        @endforeach
                    </select>
                    @error('batch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Test Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" value="{{ old('title', $test->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small text-uppercase">Test Date <span class="text-danger">*</span></label>
                        <input type="date" name="test_date" class="form-control form-control-lg rounded-3 @error('test_date') is-invalid @enderror" value="{{ old('test_date', $test->test_date->format('Y-m-d')) }}" required>
                        @error('test_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-secondary small text-uppercase">Total Marks <span class="text-danger">*</span></label>
                        <input type="number" name="total_marks" class="form-control form-control-lg rounded-3 @error('total_marks') is-invalid @enderror" value="{{ old('total_marks', $test->total_marks) }}" min="1" required>
                        @error('total_marks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Syllabus / Description</label>
                    <textarea name="description" class="form-control form-control-lg rounded-3 @error('description') is-invalid @enderror" rows="3">{{ old('description', $test->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('tests.index') }}" class="btn btn-light btn-lg rounded-pill px-4 me-2 fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary-glow btn-modern btn-lg px-5">Save Changes <i class="fas fa-save ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
