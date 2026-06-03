@extends('layouts.admin')

@section('title', 'Transport Allocation')

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
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('transport.allocations') }}">
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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold text-dark mb-0">Student Transport Allocations</h5>
    <button class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addAllocationModal">
        <i class="fas fa-plus me-1"></i> Allocate Transport
    </button>
</div>

<!-- Success Alert -->
@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-3" style="border-radius:12px;">
        {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0 px-4">Student</th>
                        <th class="border-0">Assigned Route</th>
                        <th class="border-0">Stop</th>
                        <th class="border-0">Assigned Vehicle</th>
                        <th class="border-0">Fee Status</th>
                        <th class="border-0 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allocations as $alloc)
                        <tr>
                            <td class="px-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-3" style="width: 38px; height: 38px; font-weight:600; font-size:0.8rem;">
                                        {{ strtoupper(substr($alloc->student->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size:0.9rem;">{{ $alloc->student->name }}</div>
                                        <div class="text-muted small">Roll: {{ $alloc->student->roll_number ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $alloc->route->route_name }}</td>
                            <td>{{ $alloc->stop->stop_name }}</td>
                            <td>
                                <span class="fw-medium text-dark">{{ $alloc->vehicle->vehicle_name }}</span>
                                <div class="text-muted small">{{ $alloc->vehicle->vehicle_number }}</div>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-2.5 py-1 {{ $alloc->fee_status === 'Paid' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning border border-warning-subtle' }}" style="font-size:0.75rem;">
                                    {{ $alloc->fee_status }}
                                </span>
                            </td>
                            <td class="text-end px-4">
                                <button class="btn btn-outline-secondary btn-sm rounded-circle me-1" style="width:32px; height:32px; padding:0;" data-bs-toggle="modal" data-bs-target="#editAllocationModal{{ $alloc->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('transport.allocations.delete', $alloc->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this student allocation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-circle" style="width:32px; height:32px; padding:0;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Allocation Modal -->
                        <div class="modal fade" id="editAllocationModal{{ $alloc->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0" style="border-radius: 20px;">
                                    <div class="modal-header border-bottom-0 pt-4 px-4">
                                        <h5 class="modal-title fw-bold text-dark">Edit Allocation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('transport.allocations.update', $alloc->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body px-4">
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Student</label>
                                                <input type="text" class="form-control" readonly value="{{ $alloc->student->name }} (Roll: {{ $alloc->student->roll_number ?? 'N/A' }})">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Route Assignment</label>
                                                <select name="transport_route_id" class="form-select route-select-edit" required data-target-stops-id="edit_stops_{{ $alloc->id }}">
                                                    @foreach($routes as $route)
                                                        <option value="{{ $route->id }}" {{ $alloc->transport_route_id === $route->id ? 'selected' : '' }}>
                                                            {{ $route->route_name }} (Fee: {{ currencySymbol() }}{{ number_format($route->fee, 2) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Stop Assignment</label>
                                                <select name="transport_stop_id" id="edit_stops_{{ $alloc->id }}" class="form-select" required>
                                                    @foreach($stops as $stop)
                                                        <option value="{{ $stop->id }}" data-route-id="{{ $stop->transport_route_id }}" {{ $alloc->transport_stop_id === $stop->id ? 'selected' : '' }}>
                                                            {{ $stop->stop_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Vehicle Assignment</label>
                                                <select name="vehicle_id" class="form-select" required>
                                                    @foreach($vehicles as $vehicle)
                                                        <option value="{{ $vehicle->id }}" {{ $alloc->vehicle_id === $vehicle->id ? 'selected' : '' }}>
                                                            {{ $vehicle->vehicle_name }} ({{ $vehicle->vehicle_number }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Fee Status</label>
                                                <select name="fee_status" class="form-select" required>
                                                    <option value="Pending" {{ $alloc->fee_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Paid" {{ $alloc->fee_status === 'Paid' ? 'selected' : '' }}>Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 pb-4 px-4">
                                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted small">No students allocated to transport.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Allocation Modal -->
<div class="modal fade" id="addAllocationModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark">Allocate Student Transport</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transport.allocations.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Select Student</label>
                        <select name="student_id" class="form-select shadow-none" required>
                            <option value="" disabled selected>Select a Student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} (Roll: {{ $student->roll_number ?? 'N/A' }} / Class: {{ $student->batch->name ?? 'None' }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Select Route</label>
                        <select name="transport_route_id" id="add_route_id" class="form-select shadow-none" required>
                            <option value="" disabled selected>Select a Route</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->route_name }} (Fee: {{ currencySymbol() }}{{ number_format($route->fee, 2) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Select Stop</label>
                        <select name="transport_stop_id" id="add_stop_id" class="form-select shadow-none" required disabled>
                            <option value="" disabled selected>Please select route first</option>
                            @foreach($stops as $stop)
                                <option value="{{ $stop->id }}" data-route-id="{{ $stop->transport_route_id }}">{{ $stop->stop_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Select Vehicle</label>
                        <select name="vehicle_id" class="form-select shadow-none" required>
                            <option value="" disabled selected>Select a Vehicle</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }} ({{ $vehicle->vehicle_number }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Fee Status</label>
                        <select name="fee_status" class="form-select shadow-none" required>
                            <option value="Pending" selected>Pending</option>
                            <option value="Paid">Paid</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pb-4 px-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Allocate</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dynamic Stop Filter for adding allocation
        const routeSelect = document.getElementById('add_route_id');
        const stopSelect = document.getElementById('add_stop_id');
        const stopOptions = Array.from(stopSelect.querySelectorAll('option'));

        routeSelect.addEventListener('change', function() {
            const routeId = this.value;
            stopSelect.disabled = false;
            stopSelect.innerHTML = '<option value="" disabled selected>Select a Stop</option>';
            
            const filteredOptions = stopOptions.filter(opt => opt.getAttribute('data-route-id') === routeId);
            if(filteredOptions.length === 0) {
                stopSelect.innerHTML = '<option value="" disabled selected>No stops found for this route</option>';
            } else {
                filteredOptions.forEach(opt => stopSelect.appendChild(opt));
            }
        });

        // Dynamic Stop Filter for editing allocations
        const editRouteSelects = document.querySelectorAll('.route-select-edit');
        editRouteSelects.forEach(select => {
            const targetStopsId = select.getAttribute('data-target-stops-id');
            const targetStopSelect = document.getElementById(targetStopsId);
            const targetOptions = Array.from(targetStopSelect.querySelectorAll('option'));

            function filterStops() {
                const routeId = select.value;
                const activeVal = targetStopSelect.value;
                targetStopSelect.innerHTML = '';
                
                const filtered = targetOptions.filter(opt => opt.getAttribute('data-route-id') === routeId);
                filtered.forEach(opt => targetStopSelect.appendChild(opt));
                
                if (Array.from(targetStopSelect.options).some(opt => opt.value === activeVal)) {
                    targetStopSelect.value = activeVal;
                }
            }

            select.addEventListener('change', filterStops);
            // Run on init in case it was opened
            filterStops();
        });
    });
</script>
@endpush
