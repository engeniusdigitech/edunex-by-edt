@extends('layouts.admin')

@section('title', 'Add Staff Salary')

@section('content')
<div class="mb-4">
    <a href="{{ route('staff-salaries.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="card border-0 shadow-sm rounded-4 col-lg-7">
    <div class="card-body p-4">
        <form action="{{ route('staff-salaries.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Staff Member</label>
                <select name="user_id" class="form-select" required>
                    <option value="">Select staff...</option>
                    @foreach($staffMembers as $member)
                        <option value="{{ $member->id }}" {{ old('user_id') == $member->id ? 'selected' : '' }}>{{ $member->name }} ({{ $member->role->name }})</option>
                    @endforeach
                </select>
                @error('user_id')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Basic Salary (₹)</label>
                    <input type="number" step="0.01" name="basic_salary" class="form-control" value="{{ old('basic_salary') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">HRA (₹)</label>
                    <input type="number" step="0.01" name="hra" class="form-control" value="{{ old('hra', 0) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Allowances (₹)</label>
                    <input type="number" step="0.01" name="allowances" class="form-control" value="{{ old('allowances', 0) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Monthly Deductions (₹)</label>
                    <input type="number" step="0.01" name="deductions" class="form-control" value="{{ old('deductions', 0) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">PF Deduction Rate (%)</label>
                    <input type="number" step="0.01" name="pf_rate" class="form-control" value="{{ old('pf_rate', 0.00) }}" min="0" max="100">
                </div>
                <div class="col-md-6">
                    <label class="form-label">ESIC Deduction Rate (%)</label>
                    <input type="number" step="0.01" name="esic_rate" class="form-control" value="{{ old('esic_rate', 0.00) }}" min="0" max="100">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Casual Leave (CL) Allowance (Annual)</label>
                    <input type="number" name="cl_allowance" class="form-control" value="{{ old('cl_allowance', 0) }}" min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Earned Leave (EL) Allowance (Annual)</label>
                    <input type="number" name="el_allowance" class="form-control" value="{{ old('el_allowance', 0) }}" min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Effective From</label>
                    <input type="date" name="effective_from" class="form-control" value="{{ old('effective_from', now()->format('Y-m-d')) }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-save me-2"></i>Save Salary</button>
        </form>
    </div>
</div>
@endsection
