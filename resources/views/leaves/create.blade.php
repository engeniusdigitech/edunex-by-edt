@extends('layouts.admin')

@section('title', 'Apply for Leave')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('leaves.index') }}">Leaves</a></li>
                <li class="breadcrumb-item active">Apply</li>
            </ol>
        </nav>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-primary text-white py-4 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box bg-white text-primary rounded-circle" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.2) !important;">
                        <i class="fas fa-edit fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Apply for Leave</h5>
                        <p class="mb-0 opacity-75 small">Fill out the details below to submit your request.</p>
                    </div>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('leaves.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted text-uppercase small letter-spacing-1">Leave Type</label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror rounded-3 border-light-subtle py-3 px-4 shadow-none" required>
                            <option value="">Select Type</option>
                            <option value="Sick Leave" {{ old('type') == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                            <option value="Casual Leave" {{ old('type') == 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                            <option value="Emergency Leave" {{ old('type') == 'Emergency Leave' ? 'selected' : '' }}>Emergency Leave</option>
                            <option value="Personal Leave" {{ old('type') == 'Personal Leave' ? 'selected' : '' }}>Personal Leave</option>
                            <option value="Vacation" {{ old('type') == 'Vacation' ? 'selected' : '' }}>Vacation</option>
                            <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-semibold text-muted text-uppercase small letter-spacing-1">Start Date</label>
                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror rounded-3 border-light-subtle py-3 px-4 shadow-none" 
                                   value="{{ old('start_date', date('Y-m-d')) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted text-uppercase small letter-spacing-1">End Date</label>
                            <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror rounded-3 border-light-subtle py-3 px-4 shadow-none" 
                                   value="{{ old('end_date', date('Y-m-d')) }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-semibold text-muted text-uppercase small letter-spacing-1">Reason for Leave</label>
                        <textarea name="reason" class="form-control @error('reason') is-invalid @enderror rounded-3 border-light-subtle py-3 px-4 shadow-none" 
                                  placeholder="Please provide a brief explanation..." style="height: 120px" required>{{ old('reason') }}</textarea>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-modern py-3 shadow-sm fw-bold">
                            Submit Application <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
