@extends('layouts.admin')

@section('title', 'Add Student')

@section('content')
<div class="mb-4">
    <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to Directory</a>
</div>

<div class="card border-0 shadow-sm col-md-8">
    <div class="card-header bg-white">
        <h5>Register New Student</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="Billy mark">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Billy@example.com">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" required placeholder="+91 9876543210">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Blood Group</label>
                    <select name="blood_group" class="form-select">
                        <option value="">Select</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                            <option value="{{ $bg }}">{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Roll Number</label>
                    <input type="text" name="roll_number" class="form-control" placeholder="e.g. 001922">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Alternate Phone 1</label>
                    <input type="text" name="alternate_phone_1" class="form-control" placeholder="+91 9876543210">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Alternate Phone 2</label>
                    <input type="text" name="alternate_phone_2" class="form-control" placeholder="+91 9876543210">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Father's Name</label>
                    <input type="text" name="father_name" class="form-control" placeholder="Father's full name">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mother's Name</label>
                    <input type="text" name="mother_name" class="form-control" placeholder="Mother's full name">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Parent Email</label>
                    <input type="email" name="parent_email" class="form-control" placeholder="parent@example.com">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Enrollment Date</label>
                    <input type="date" name="enrollment_date" class="form-control" required value="{{ date('Y-m-d') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Min. 8 characters">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Re-enter password">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Student Photo <span class="text-muted small">(optional, max 2MB)</span></label>
                <input type="file" name="profile_image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Batch</label>
                <!-- Usually you'd fetch active batches from the controller -->
                <select name="batch_id" class="form-select" required>
                    <option value="">Select a Batch</option>
                    @foreach(\App\Models\Batch::all() as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->name }} ({{ $batch->schedule_time }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Student</button>
        </form>
    </div>
</div>
@endsection
