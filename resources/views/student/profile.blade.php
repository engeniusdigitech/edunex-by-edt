@extends('student.layouts.app')

@section('title', 'My Profile')

@push('styles')
<style>
    .profile-header {
        background: var(--gradient-blue-green, linear-gradient(135deg, #2563EB 0%, #10B981 100%));
        border-radius: var(--radius, 16px);
        padding: 48px;
        color: #fff;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px -12px rgba(37, 99, 235, 0.25);
    }

    .profile-header::after {
        content: "\f19d";
        font-family: "Font Awesome 6 Free";
        font-weight: 500;
        position: absolute;
        right: -30px;
        bottom: -30px;
        font-size: 12rem;
        opacity: 0.08;
        transform: rotate(-15deg);
    }

    .profile-img-container {
        width: 120px;
        height: 120px;
        position: relative;
        margin-bottom: 20px;
    }

    .profile-img {
        width: 100%;
        height: 100%;
        border-radius: 32px;
        object-fit: cover;
        border: 5px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .card-custom {
        background: var(--card, #ffffff);
        border: 1px solid var(--border, #E2E8F0);
        border-radius: var(--radius, 16px);
        padding: 36px;
        box-shadow: 0 8px 20px -6px rgba(37, 99, 235, 0.08);
    }

    .form-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--muted, #64748B);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1px solid var(--border, #E2E8F0);
        font-size: 0.95rem;
        font-weight: 500;
        transition: all 0.2s;
        background: #fcfdfe;
    }

    .form-control:focus {
        border-color: #2563EB;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        background: #fff;
    }

    .batch-info-tag {
        background: rgba(255, 255, 255, 0.25);
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 0.78rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        backdrop-filter: blur(10px);
    }
</style>
@endpush

@section('content')
<div class="mb-4">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="profile-header">
        <div class="d-flex align-items-center gap-4 flex-wrap flex-sm-nowrap">
            <div class="profile-img-container">
                <img src="{{ $student->profile_image_url }}" alt="Profile" class="profile-img" id="display-img">
            </div>
            <div>
                <h2 class="mb-2 fw-medium">{{ $student->name }}</h2>
                <div class="d-flex flex-wrap gap-2">
                    <div class="batch-info-tag">
                        <i class="fas fa-users"></i> {{ $student->batch->name ?? 'No Batch' }}
                    </div>
                    <div class="batch-info-tag">
                        <i class="fas fa-id-card"></i> ID: #{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-custom mb-4">
        <h5 class="fw-medium mb-4" style="color: #0F172A;">Personal Information</h5>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->name }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control bg-light" value="{{ $student->email }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->phone }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Blood Group</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->blood_group ?? 'Not specified' }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Alternate Phone 1</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->alternate_phone_1 ?? 'Not specified' }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Alternate Phone 2</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->alternate_phone_2 ?? 'Not specified' }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Enrolled Since</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->enrollment_date->format('d M Y') }}" disabled>
                </div>
            </div>
        </div>

        <hr class="my-4" style="opacity: 0.1;">

        <h5 class="fw-medium mb-4 mt-2" style="color: #0F172A;">Parent/Guardian Information</h5>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Father's Name</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->father_name ?? 'Not specified' }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Mother's Name</label>
                    <input type="text" class="form-control bg-light" value="{{ $student->mother_name ?? 'Not specified' }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Parent Email</label>
                    <input type="email" class="form-control bg-light" value="{{ $student->parent_email ?? 'Not specified' }}" disabled>
                </div>
            </div>
        </div>
        
        <div class="mt-4 p-3 bg-light rounded-4 border d-flex align-items-center gap-2 text-muted small fw-medium">
            <i class="fas fa-info-circle text-primary"></i> Profile editing is managed by the administration. Please contact your coordinator to update these details.
        </div>
    </div>

    <!-- Password Change Section -->
    <div class="card-custom">
        <h5 class="fw-medium mb-4" style="color: #0F172A;">Change Password</h5>
        <form action="{{ route('student.profile.update') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label text-dark">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required placeholder="Enter your current password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label text-dark">New Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Min. 8 characters">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label text-dark">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Re-enter new password">
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-medium shadow-sm">
                        <i class="fas fa-key me-2"></i> Update Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
