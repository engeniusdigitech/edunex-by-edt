@extends('layouts.admin')

@section('title', 'Add Institute')

@section('content')
<div class="mb-4">
    <a href="{{ route('superadmin.institutes.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<div class="card col-md-8">
    <div class="card-header bg-white">
        <h5>Register New Institute</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('superadmin.institutes.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Institute Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Apex Institute" value="{{ old('name') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Institute Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" required>
                        <option value="">Select Type</option>
                        <option value="institute" {{ old('type') == 'institute' ? 'selected' : '' }}>Institute / Coaching</option>
                        <option value="school" {{ old('type') == 'school' ? 'selected' : '' }}>School</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Subdomain</label>
                <div class="input-group">
                    <input type="text" name="subdomain" class="form-control" placeholder="apex">
                    <span class="input-group-text">.edunex.test</span>
                </div>
                <small class="text-muted">Leave blank to auto-generate from name.</small>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="contact_email" class="form-control" required placeholder="admin@apex.com">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="9876543210">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Country <span class="text-danger">*</span></label>
                    <select name="country" class="form-select" required>
                        <option value="">Select Country</option>
                        <option value="IN">India</option>
                        <option value="US">United States</option>
                        <option value="UK">United Kingdom</option>
                        <option value="AU">Australia</option>
                        <option value="CA">Canada</option>
                        <option value="SG">Singapore</option>
                        <option value="AE">United Arab Emirates</option>
                        <option value="OTHER">Other</option>
                    </select>
                </div>
            </div>
            <hr class="my-4">
            <h6 class="mb-3">Admin Account Details</h6>
            <div class="mb-3">
                <label class="form-label">Admin Name <span class="text-danger">*</span></label>
                <input type="text" name="admin_name" class="form-control" required placeholder="John Doe" value="{{ old('admin_name') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Admin Email <span class="text-danger">*</span></label>
                <input type="email" name="admin_email" class="form-control" required placeholder="admin@institute.com" value="{{ old('admin_email') }}">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="admin_password" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="admin_password_confirmation" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Institute</button>
        </form>
    </div>
</div>
@endsection
