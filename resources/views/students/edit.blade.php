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
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name', $student->name) }}" placeholder="Billy mark">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}" placeholder="Billy@example.com">
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
                    <label class="form-label">Blood Group</label>
                    <select name="blood_group" class="form-select">
                        <option value="">Select</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                            <option value="{{ $bg }}" {{ old('blood_group', $student->blood_group) == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Roll Number</label>
                    <input type="text" name="roll_number" class="form-control" value="{{ old('roll_number', $student->roll_number) }}" placeholder="e.g. 001922">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Alternate Phone 1</label>
                    <input type="text" name="alternate_phone_1" class="form-control" value="{{ old('alternate_phone_1', $student->alternate_phone_1) }}" placeholder="+91 9876543210">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Alternate Phone 2</label>
                    <input type="text" name="alternate_phone_2" class="form-control" value="{{ old('alternate_phone_2', $student->alternate_phone_2) }}" placeholder="+91 9876543210">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Father's Name</label>
                    <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $student->father_name) }}" placeholder="Father's full name">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mother's Name</label>
                    <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name', $student->mother_name) }}" placeholder="Mother's full name">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Parent Email</label>
                    <input type="email" name="parent_email" class="form-control" value="{{ old('parent_email', $student->parent_email) }}" placeholder="parent@example.com">
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
                <label class="form-label">Student Photo <span class="text-muted small">(optional, max 2MB)</span></label>
                @if($student->profile_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$student->profile_image) }}" class="rounded-circle border object-fit-cover" width="64" height="64">
                        <span class="text-muted small ms-2">Current photo</span>
                    </div>
                @endif
                <input type="file" name="profile_image" class="form-control" accept="image/*">
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
