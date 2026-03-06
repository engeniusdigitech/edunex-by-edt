@extends('layouts.admin')

@section('title', 'Edit Student')

@section('content')
<div class="mb-4">
    <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to Directory</a>
</div>

<div class="card border-0 shadow-sm col-md-8">
    <div class="card-header bg-white">
        <h5>Edit Student — {{ $student->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name', $student->name) }}" placeholder="John Doe">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}" placeholder="john@example.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" required value="{{ old('phone', $student->phone) }}" placeholder="+91 9876543210">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Enrollment Date</label>
                    <input type="date" name="enrollment_date" class="form-control" required value="{{ old('enrollment_date', $student->enrollment_date->format('Y-m-d')) }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">New Password <span class="text-muted small">(leave blank to keep current)</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 characters">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter new password">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Batch</label>
                <select name="batch_id" class="form-select" required>
                    <option value="">Select a Batch</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ old('batch_id', $student->batch_id) == $batch->id ? 'selected' : '' }}>
                            {{ $batch->name }} ({{ $batch->schedule_time }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-light ms-2">Cancel</a>
        </form>
    </div>
</div>
@endsection
