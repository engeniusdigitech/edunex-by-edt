@extends('layouts.admin')

@section('title', 'Edit Staff Salary')

@section('content')
<div class="mb-4">
    <a href="{{ route('staff-salaries.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="card border-0 shadow-sm rounded-4 col-lg-7">
    <div class="card-body p-4">
        <p class="text-muted mb-3">Editing salary for <strong>{{ $staffSalary->user->name }}</strong></p>
        <form action="{{ route('staff-salaries.update', $staffSalary) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Basic Salary (₹)</label>
                    <input type="number" step="0.01" name="basic_salary" class="form-control" value="{{ old('basic_salary', $staffSalary->basic_salary) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">HRA (₹)</label>
                    <input type="number" step="0.01" name="hra" class="form-control" value="{{ old('hra', $staffSalary->hra) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Allowances (₹)</label>
                    <input type="number" step="0.01" name="allowances" class="form-control" value="{{ old('allowances', $staffSalary->allowances) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Monthly Deductions (₹)</label>
                    <input type="number" step="0.01" name="deductions" class="form-control" value="{{ old('deductions', $staffSalary->deductions) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">PF Deduction Rate (%)</label>
                    <input type="number" step="0.01" name="pf_rate" class="form-control" value="{{ old('pf_rate', $staffSalary->pf_rate) }}" min="0" max="100">
                </div>
                <div class="col-md-6">
                    <label class="form-label">ESIC Deduction Rate (%)</label>
                    <input type="number" step="0.01" name="esic_rate" class="form-control" value="{{ old('esic_rate', $staffSalary->esic_rate) }}" min="0" max="100">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Casual Leave (CL) Allowance (Annual)</label>
                    <input type="number" name="cl_allowance" class="form-control" value="{{ old('cl_allowance', $staffSalary->cl_allowance) }}" min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Earned Leave (EL) Allowance (Annual)</label>
                    <input type="number" name="el_allowance" class="form-control" value="{{ old('el_allowance', $staffSalary->el_allowance) }}" min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Effective From</label>
                    <input type="date" name="effective_from" class="form-control" value="{{ old('effective_from', $staffSalary->effective_from->format('Y-m-d')) }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-save me-2"></i>Update Salary</button>
        </form>
    </div>
</div>
@endsection
