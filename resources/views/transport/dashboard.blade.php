@extends('layouts.admin')

@section('title', 'Transport Management')

@section('content')
<!-- Sub Navigation Tabs -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('transport.dashboard') }}">
                    <i class="fas fa-chart-pie me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('transport.vehicles') }}">
                    <i class="fas fa-bus me-2"></i>Vehicles
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('transport.routes') }}">
                    <i class="fas fa-route me-2"></i>Routes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('transport.stops') }}">
                    <i class="fas fa-map-marker-alt me-2"></i>Stops
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('transport.drivers') }}">
                    <i class="fas fa-id-card me-2"></i>Drivers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('transport.allocations') }}">
                    <i class="fas fa-user-check me-2"></i>Allocations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('transport.reports') }}">
                    <i class="fas fa-chart-bar me-2"></i>Reports
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Stats Grid -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #2563EB !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.7rem; letter-spacing: 0.5px;">Vehicles</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary-subtle text-primary" style="width: 36px; height: 36px;">
                        <i class="fas fa-bus"></i>
                    </div>
                </div>
                <h3 class="fw-medium mb-0 text-dark">{{ $totalVehicles }}</h3>
                <span class="text-muted small">Registered fleet</span>
            </div>
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #10B981 !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.7rem; letter-spacing: 0.5px;">Routes</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-success-subtle text-success" style="width: 36px; height: 36px;">
                        <i class="fas fa-route"></i>
                    </div>
                </div>
                <h3 class="fw-medium mb-0 text-dark">{{ $totalRoutes }}</h3>
                <span class="text-muted small">Active routes</span>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #F59E0B !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.7rem; letter-spacing: 0.5px;">Drivers</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-warning-subtle text-warning" style="width: 36px; height: 36px;">
                        <i class="fas fa-id-card"></i>
                    </div>
                </div>
                <h3 class="fw-medium mb-0 text-dark">{{ $totalDrivers }}</h3>
                <span class="text-muted small">Registered drivers</span>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #EF4444 !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted" style="font-size:0.7rem; letter-spacing: 0.5px;">Passengers</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-danger-subtle text-danger" style="width: 36px; height: 36px;">
                        <i class="fas fa-user-friends"></i>
                    </div>
                </div>
                <h3 class="fw-medium mb-0 text-dark">{{ $totalStudents }}</h3>
                <span class="text-muted small">Allocated students</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Allocations Table -->
<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-medium text-dark mb-0">Recent Allocations</h6>
            <p class="text-muted small mb-0">Latest student allocations added to the system</p>
        </div>
        <a href="{{ route('transport.allocations') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All</a>
    </div>
    <div class="card-body px-4 pb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0">Student</th>
                        <th class="border-0">Route</th>
                        <th class="border-0">Stop</th>
                        <th class="border-0">Vehicle</th>
                        <th class="border-0">Fee Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentAllocations as $alloc)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px; font-weight:600; font-size:0.8rem;">
                                        {{ strtoupper(substr($alloc->student->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium text-dark" style="font-size:0.9rem;">{{ $alloc->student->name }}</div>
                                        <div class="text-muted small">Roll: {{ $alloc->student->roll_number ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $alloc->route->route_name }}</td>
                            <td>{{ $alloc->stop->stop_name }}</td>
                            <td>
                                <div class="fw-medium text-dark">{{ $alloc->vehicle->vehicle_name }}</div>
                                <div class="text-muted small">{{ $alloc->vehicle->vehicle_number }}</div>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-2.5 py-1 {{ $alloc->fee_status === 'Paid' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning border border-warning-subtle' }}" style="font-size:0.75rem;">
                                    {{ $alloc->fee_status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted small">No recent transport allocations.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
