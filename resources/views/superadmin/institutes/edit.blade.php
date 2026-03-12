@extends('layouts.admin')

@section('title', 'Edit Institute')

@section('content')
<div class="mb-4">
    <a href="{{ route('superadmin.institutes.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<div class="card col-md-8 border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h5 class="fw-bold"><i class="fas fa-building text-primary me-2"></i>Edit Institute Details</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('superadmin.institutes.update', $institute->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-muted small">Institute Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $institute->name) }}">
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-semibold text-muted small">Subdomain</label>
                <div class="input-group">
                    <input type="text" name="subdomain" class="form-control" value="{{ old('subdomain', $institute->subdomain) }}">
                    <span class="input-group-text bg-light text-muted">.edunex.test</span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold text-muted small">Contact Email <span class="text-danger">*</span></label>
                    <input type="email" name="contact_email" class="form-control" required value="{{ old('contact_email', $institute->contact_email) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold text-muted small">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $institute->phone) }}">
                </div>
                <div class="col-md-4 mb-4">
                    <label class="form-label fw-semibold text-muted small">Country <span class="text-danger">*</span></label>
                    <select name="country" class="form-select" required>
                        <option value="">Select Country</option>
                        <option value="IN" {{ old('country', $institute->country) == 'IN' ? 'selected' : '' }}>India</option>
                        <option value="US" {{ old('country', $institute->country) == 'US' ? 'selected' : '' }}>United States</option>
                        <option value="UK" {{ old('country', $institute->country) == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                        <option value="AU" {{ old('country', $institute->country) == 'AU' ? 'selected' : '' }}>Australia</option>
                        <option value="CA" {{ old('country', $institute->country) == 'CA' ? 'selected' : '' }}>Canada</option>
                        <option value="SG" {{ old('country', $institute->country) == 'SG' ? 'selected' : '' }}>Singapore</option>
                        <option value="AE" {{ old('country', $institute->country) == 'AE' ? 'selected' : '' }}>United Arab Emirates</option>
                        <option value="OTHER" {{ old('country', $institute->country) == 'OTHER' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-check form-switch p-0 d-flex align-items-center">
                    <label class="form-check-label fw-semibold text-muted small me-5" for="isActiveSwitch">Active Status</label>
                    <input class="form-check-input ms-0 mt-0" type="checkbox" id="isActiveSwitch" name="is_active" value="1" {{ old('is_active', $institute->is_active) ? 'checked' : '' }} style="width: 40px; height: 20px; cursor: pointer;">
                </div>
            </div>

            <hr class="my-4">

            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 8px;">
                    <i class="fas fa-save me-2"></i> Update Institute
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
