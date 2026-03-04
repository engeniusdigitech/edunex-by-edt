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
            <div class="mb-3">
                <label class="form-label">Institute Name</label>
                <input type="text" name="name" class="form-control" required placeholder="e.g. Apex Institute">
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
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="contact_email" class="form-control" required placeholder="admin@apex.com">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="9876543210">
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Institute</button>
        </form>
    </div>
</div>
@endsection
