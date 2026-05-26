@extends('layouts.admin')

@section('title', 'Staff Salaries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Staff Salaries</h3>
        <p class="text-muted mb-0">Manage monthly salary structures (Admin only)</p>
    </div>
    <a href="{{ route('staff-salaries.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Salary</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($staffWithoutSalary->isNotEmpty())
    <div class="alert alert-warning small">
        <strong>{{ $staffWithoutSalary->count() }}</strong> staff without salary:
        {{ $staffWithoutSalary->pluck('name')->join(', ') }}
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Staff</th>
                    <th>Basic</th>
                    <th>HRA</th>
                    <th>Allowances</th>
                    <th>Deductions</th>
                    <th>Net / Month</th>
                    <th>Effective From</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($salaries as $salary)
                    <tr>
                        <td class="fw-semibold">{{ $salary->user->name }}</td>
                        <td>₹{{ number_format($salary->basic_salary, 2) }}</td>
                        <td>₹{{ number_format($salary->hra, 2) }}</td>
                        <td>₹{{ number_format($salary->allowances, 2) }}</td>
                        <td>₹{{ number_format($salary->deductions, 2) }}</td>
                        <td class="fw-bold text-success">₹{{ number_format($salary->net_monthly, 2) }}</td>
                        <td>{{ $salary->effective_from->format('d M Y') }}</td>
                        <td><a href="{{ route('staff-salaries.edit', $salary) }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No salary records. Add one to get started.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
