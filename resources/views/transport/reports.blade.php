@extends('layouts.admin')

@section('title', 'Transport Reports')

@section('content')
<!-- Sub Navigation Tabs -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('transport.dashboard') }}">
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
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('transport.reports') }}">
                    <i class="fas fa-chart-bar me-2"></i>Reports
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="row g-4">
    <!-- Route-wise Student List -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-bold text-dark mb-0">Route-wise Passenger List</h6>
                <p class="text-muted small mb-0">List students assigned to a specific route</p>
            </div>
            <div class="card-body px-4 pb-4">
                <form action="{{ route('transport.reports') }}" method="GET" class="row g-2 mb-3">
                    <input type="hidden" name="vehicle_id" value="{{ $selectedVehicleId }}">
                    <div class="col-8 col-sm-9">
                        <select name="route_id" class="form-select shadow-none" required>
                            <option value="" disabled selected>Select a Route</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}" {{ $selectedRouteId == $route->id ? 'selected' : '' }}>
                                    {{ $route->route_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary rounded-pill px-3">Filter</button>
                    </div>
                </form>

                @if($selectedRouteId)
                    <div class="table-responsive" style="max-height: 250px; overflow-y:auto;">
                        <table class="table table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Student</th>
                                    <th>Stop</th>
                                    <th>Vehicle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($routeStudents as $alloc)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $alloc->student->name }}</div>
                                            <div class="text-muted small">Roll: {{ $alloc->student->roll_number ?? 'N/A' }}</div>
                                        </td>
                                        <td>{{ $alloc->stop->stop_name }}</td>
                                        <td>{{ $alloc->vehicle->vehicle_name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted small">No students assigned to this route.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5 text-muted small">
                        <i class="fas fa-route fa-2x mb-2 opacity-35"></i>
                        <div>Please select a route to view its passenger list.</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Vehicle-wise Student List -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-bold text-dark mb-0">Vehicle-wise Passenger List</h6>
                <p class="text-muted small mb-0">List students assigned to a specific vehicle</p>
            </div>
            <div class="card-body px-4 pb-4">
                <form action="{{ route('transport.reports') }}" method="GET" class="row g-2 mb-3">
                    <input type="hidden" name="route_id" value="{{ $selectedRouteId }}">
                    <div class="col-8 col-sm-9">
                        <select name="vehicle_id" class="form-select shadow-none" required>
                            <option value="" disabled selected>Select a Vehicle</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $selectedVehicleId == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->vehicle_name }} ({{ $vehicle->vehicle_number }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary rounded-pill px-3">Filter</button>
                    </div>
                </form>

                @if($selectedVehicleId)
                    <div class="table-responsive" style="max-height: 250px; overflow-y:auto;">
                        <table class="table table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Student</th>
                                    <th>Route</th>
                                    <th>Stop</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vehicleStudents as $alloc)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $alloc->student->name }}</div>
                                            <div class="text-muted small">Roll: {{ $alloc->student->roll_number ?? 'N/A' }}</div>
                                        </td>
                                        <td>{{ $alloc->route->route_name }}</td>
                                        <td>{{ $alloc->stop->stop_name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted small">No students assigned to this vehicle.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5 text-muted small">
                        <i class="fas fa-bus fa-2x mb-2 opacity-35"></i>
                        <div>Please select a vehicle to view its passenger list.</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Pending Transport Fees Report -->
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                <h6 class="fw-bold text-dark mb-0"><i class="fas fa-exclamation-circle text-warning me-2"></i>Pending Transport Fees</h6>
                <p class="text-muted small mb-0">List of active allocations with pending payment status</p>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Assigned Route</th>
                                <th>Monthly Fee</th>
                                <th>Vehicle & Driver</th>
                                <th>Fee Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingFeesList as $alloc)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $alloc->student->name }}</div>
                                        <div class="text-muted small">Roll: {{ $alloc->student->roll_number ?? 'N/A' }} / Class: {{ $alloc->student->batch->name ?? 'None' }}</div>
                                    </td>
                                    <td>{{ $alloc->route->route_name }}</td>
                                    <td class="fw-semibold text-danger">{{ currencySymbol() }}{{ number_format($alloc->route->fee, 2) }}</td>
                                    <td>
                                        <div class="fw-medium text-dark">{{ $alloc->vehicle->vehicle_name }}</div>
                                        <div class="text-muted small">{{ $alloc->vehicle->vehicle_number }}</div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1" style="font-size:0.75rem;">
                                            Pending
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted small">No pending transport fees found. All allocations are fully paid!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
