@extends('layouts.admin')

@section('title', 'Add Staff')

@section('content')
<div class="mb-4">
    <a href="{{ route('staff.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to Staff Directory</a>
</div>

<div class="card border-0 shadow-sm col-md-8">
    <div class="card-header bg-white">
        <h5>Register New Staff Member</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('staff.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required placeholder="Jane Doe">
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address (Used for Login)</label>
                <input type="email" name="email" class="form-control" required placeholder="jane@institute.com">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role_id" class="form-select" required>
                    <option value="">Select Role...</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Teachers can manage attendance. Receptionists can manage payments.</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Staff Member</button>
        </form>
    </div>
</div>
@endsection
