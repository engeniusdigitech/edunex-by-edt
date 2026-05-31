@extends('student.layouts.app')

@section('title', 'My Attendance')

@push('styles')
<style>
    .stat-card {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 12px -4px rgba(37, 99, 235, 0.05);
    }

    .stat-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        flex-shrink: 0;
    }

    .stat-icon.primary { background: #EFF6FF; color: #2563EB; }
    .stat-icon.success { background: #ECFDF5; color: #10B981; }
    .stat-icon.danger { background: #FEF2F2; color: #EF4444; }
    .stat-icon.warning { background: #FFFBEB; color: #F59E0B; }

    .stat-val {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0F172A;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #64748B;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .attendance-table-container {
        background: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px -4px rgba(37, 99, 235, 0.05);
    }

    .table th {
        background: #F8FAFC;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 24px;
        border-bottom: 1px solid #E2E8F0;
    }

    .table td {
        padding: 16px 24px;
        vertical-align: middle;
        color: #0F172A;
        font-weight: 500;
        border-bottom: 1px solid #F1F5F9;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    .status-present { background: #ECFDF5; color: #10B981; }
    .status-absent { background: #FEF2F2; color: #EF4444; }
    .status-late { background: #FFFBEB; color: #F59E0B; }
</style>
@endpush

@section('content')
<div class="mb-5">
    <div>
        <h4 class="fw-medium mb-1">My Attendance</h4>
        <p class="text-muted small mb-0">Overview of your daily presence and records.</p>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div>
                <div class="stat-val">{{ $attendancePercentage }}%</div>
                <div class="stat-label">Overall Rate</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-user-check"></i>
            </div>
            <div>
                <div class="stat-val">{{ $presentClasses }}</div>
                <div class="stat-label">Present</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="fas fa-user-times"></i>
            </div>
            <div>
                <div class="stat-val">{{ $absentClasses }}</div>
                <div class="stat-label">Absent</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-user-clock"></i>
            </div>
            <div>
                <div class="stat-val">{{ $lateClasses }}</div>
                <div class="stat-label">Late</div>
            </div>
        </div>
    </div>
</div>

<h5 class="fw-medium mb-4 text-dark"><i class="fas fa-list me-2 text-muted"></i>Recent Records</h5>

<div class="attendance-table-container">
    <div class="table-responsive">
        <table class="table table-borderless mb-0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $record)
                    <tr>
                        <td>
                            <i class="far fa-calendar text-muted me-2"></i> 
                            {{ $record->date->format('d M, Y') }}
                        </td>
                        <td>{{ $record->date->format('l') }}</td>
                        <td>
                            <span class="status-badge status-{{ strtolower($record->status) }}">
                                {{ ucfirst($record->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted">
                            <i class="fas fa-calendar-times fa-3x opacity-25 mb-3"></i>
                            <p class="mb-0">No attendance records found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($attendances->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $attendances->links() }}
    </div>
@endif
@endsection
