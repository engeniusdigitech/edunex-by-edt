@extends('layouts.admin')

@section('title', 'Staff Payroll')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-medium mb-1">Staff Payroll</h3>
        <p class="text-muted mb-0">Generate and manage monthly payroll (Admin only)</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <form action="{{ route('staff-payrolls.generate') }}" method="POST" class="row g-3 align-items-end">
            @csrf
            <div class="col-md-3">
                <label class="form-label">Month</label>
                <select name="month" class="form-select">
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create(null, $m, 1)->format('F') }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Year</label>
                <input type="number" name="year" class="form-control" value="{{ $year }}" min="2020" max="2100">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success w-100" onclick="return confirm('Generate payroll for selected month? This uses biometric attendance for pro-rating.')">
                    <i class="fas fa-calculator me-2"></i>Generate Payroll
                </button>
            </div>
        </form>
        <p class="small text-muted mt-2 mb-0">Payroll is pro-rated by present days from biometric attendance vs working days in the month.</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-medium">{{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</span>
        <form method="GET" class="d-flex gap-2">
            <select name="month" class="form-select form-select-sm" onchange="this.form.submit()">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create(null, $m, 1)->format('M') }}</option>
                @endfor
            </select>
            <input type="number" name="year" class="form-control form-control-sm" value="{{ $year }}" style="width:90px" onchange="this.form.submit()">
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Staff</th>
                    <th>Present Days</th>
                    <th>Gross</th>
                    <th>Net Pay</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payrolls as $payroll)
                    <tr>
                        <td class="fw-semibold">{{ $payroll->user->name }}</td>
                        <td>{{ $payroll->present_days }} / {{ $payroll->working_days }}</td>
                        <td>₹{{ number_format($payroll->gross_salary, 2) }}</td>
                        <td class="fw-medium text-success">₹{{ number_format($payroll->net_salary, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $payroll->status === 'paid' ? 'success' : ($payroll->status === 'processed' ? 'primary' : 'secondary') }}">
                                {{ ucfirst($payroll->status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('staff-payrolls.update', $payroll) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $payroll->status === 'paid' ? 'processed' : 'paid' }}">
                                <button type="submit" class="btn btn-sm btn-outline-{{ $payroll->status === 'paid' ? 'secondary' : 'success' }}">
                                    {{ $payroll->status === 'paid' ? 'Mark Unpaid' : 'Mark Paid' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No payroll for this period. Click Generate Payroll above.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
