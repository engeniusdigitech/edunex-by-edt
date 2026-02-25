@extends('layouts.admin')

@section('title', 'Edit Homework')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('homework.index') }}" class="btn btn-light rounded-circle shadow-sm me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-arrow-left text-secondary"></i>
    </a>
    <h4 class="mb-0 fw-bold">Edit Homework</h4>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <form action="{{ route('homework.update', $homework) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Select Batch <span class="text-danger">*</span></label>
                    <select name="batch_id" class="form-select form-select-lg rounded-3 @error('batch_id') is-invalid @enderror" required>
                        <option value="">-- Choose a batch --</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}" {{ old('batch_id', $homework->batch_id) == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                        @endforeach
                    </select>
                    @error('batch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Homework Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" value="{{ old('title', $homework->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Description / Instructions</label>
                    <textarea name="description" class="form-control form-control-lg rounded-3 @error('description') is-invalid @enderror" rows="4">{{ old('description', $homework->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-5">
                    <label class="form-label fw-semibold text-secondary small text-uppercase">Due Date <span class="text-danger">*</span></label>
                    <input type="date" name="due_date" class="form-control form-control-lg rounded-3 @error('due_date') is-invalid @enderror" value="{{ old('due_date', $homework->due_date->format('Y-m-d')) }}" required>
                    @error('due_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('homework.index') }}" class="btn btn-light btn-lg rounded-pill px-4 me-2 fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary-glow btn-modern btn-lg px-5">Save Changes <i class="fas fa-save ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
