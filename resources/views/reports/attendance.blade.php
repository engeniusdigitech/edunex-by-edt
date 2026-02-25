@extends('layouts.admin')

@section('title', 'Monthly Attendance Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="fas fa-chart-line text-primary me-2"></i> Attendance Report</h4>
        <p class="text-muted small mb-0">Generate and view monthly student attendance records</p>
    </div>
    @if($batchId && count($reportData) > 0)
    <a href="{{ route('reports.attendance.pdf', ['batch_id' => $batchId, 'month' => $month]) }}" class="btn btn-danger btn-modern shadow-sm">
        <i class="fas fa-file-pdf me-2"></i> Download PDF
    </a>
    @endif
</div>

<div class="card border-0 bg-white mb-5">
    <div class="card-body p-4">
        <form action="{{ route('reports.attendance') }}" method="GET" class="row gx-4 align-items-end">
            <div class="col-md-4">
                <label class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Select Month</label>
                <input type="month" name="month" class="form-control form-control-lg bg-light border-0" value="{{ $month }}" required>
            </div>
            <div class="col-md-5">
                <label class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Select Batch</label>
                <select name="batch_id" class="form-select form-select-lg bg-light border-0" required>
                    <option value="">Choose Batch...</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ $batchId == $batch->id ? 'selected' : '' }}>
                            {{ $batch->name }} ({{ $batch->schedule_time }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-modern w-100 py-3"><i class="fas fa-search me-2"></i> Generate</button>
            </div>
        </form>
    </div>
</div>

@if($batchId)
    <div class="card border-0 bg-white shadow-sm">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2 px-4">
            <h5 class="fw-bold text-dark mb-0">Results for {{ date('F Y', strtotime($month . '-01')) }}</h5>
        </div>
        <div class="card-body p-0">
            @if(count($reportData) > 0)
            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #F8FAFC;">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Student Name</th>
                            <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Total Classes</th>
                            <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Classes Attended</th>
                            <th class="py-3 pe-4 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reportData as $row)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary border rounded-circle d-flex justify-content-center align-items-center me-3 fw-bold" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                        {{ substr($row['student']->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $row['student']->name }}</div>
                                        <small class="text-muted"><i class="far fa-envelope me-1 text-opacity-50"></i> {{ $row['student']->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 fw-medium text-dark">{{ $row['total'] }} <span class="text-muted small">sessions</span></td>
                            <td class="py-3 fw-medium text-dark">{{ $row['present'] }} <span class="text-muted small">sessions</span></td>
                            <td class="py-3 pe-4">
                                <div class="d-flex align-items-center">
                                    <span class="me-3 fw-black {{ $row['percentage'] >= 75 ? 'text-success' : 'text-danger' }}" style="min-width: 45px; font-size: 1.1rem;">{{ $row['percentage'] }}%</span>
                                    <div class="progress flex-grow-1 bg-light border" style="height: 8px; border-radius: 4px;">
                                        <div class="progress-bar rounded-pill {{ $row['percentage'] >= 75 ? 'bg-success' : 'bg-danger' }}" role="progressbar" style="width: {{ $row['percentage'] }}%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-5 text-center text-muted">
                <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                    <i class="fas fa-folder-open fa-2x opacity-50"></i>
                </div>
                <h5 class="fw-bold text-dark">No Data Available</h5>
                <p class="text-muted small mb-0">No attendance records found for this batch in the selected month.</p>
            </div>
            @endif
        </div>
    </div>
@endif
@endsection
