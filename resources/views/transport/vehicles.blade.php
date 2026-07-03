@extends('layouts.admin')

@section('title', 'Fleet Management')

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
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('transport.vehicles') }}">
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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-medium text-dark mb-0">Vehicle Inventory</h5>
    <button class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
        <i class="fas fa-plus me-1"></i> Add Vehicle
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
                        <th class="border-0 px-4">Vehicle Number</th>
                        <th class="border-0">Vehicle Name</th>
                        <th class="border-0">Capacity</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                        <tr>
                            <td class="px-4 fw-medium text-dark">{{ $vehicle->vehicle_number }}</td>
                            <td>{{ $vehicle->vehicle_name }}</td>
                            <td>{{ $vehicle->capacity }} Seats</td>
                            <td>
                                <span class="badge rounded-pill px-2.5 py-1 {{ $vehicle->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                    {{ $vehicle->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-end px-4">
                                <button class="btn btn-outline-secondary btn-sm rounded-circle me-1" style="width:32px; height:32px; padding:0;" data-bs-toggle="modal" data-bs-target="#editVehicleModal{{ $vehicle->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('transport.vehicles.delete', $vehicle->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm rounded-circle" style="width:32px; height:32px; padding:0;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted small">No vehicles registered in the database.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Add Vehicle Modal -->
<div class="modal fade" id="addVehicleModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-medium text-dark">Register Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transport.vehicles.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Vehicle Number</label>
                        <input type="text" name="vehicle_number" class="form-control shadow-none" required placeholder="e.g. MH12AB1234">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Vehicle Name</label>
                        <input type="text" name="vehicle_name" class="form-control shadow-none" required placeholder="e.g. School Bus 1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Passenger Capacity</label>
                        <input type="number" name="capacity" class="form-control shadow-none" required min="1" placeholder="e.g. 40">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status</label>
                        <select name="is_active" class="form-select shadow-none" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pb-4 px-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save Vehicle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Vehicle Modals -->
@foreach($vehicles as $vehicle)
<div class="modal fade" id="editVehicleModal{{ $vehicle->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-medium text-dark">Edit Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transport.vehicles.update', $vehicle->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Vehicle Number</label>
                        <input type="text" name="vehicle_number" class="form-control" required value="{{ $vehicle->vehicle_number }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Vehicle Name</label>
                        <input type="text" name="vehicle_name" class="form-control" required value="{{ $vehicle->vehicle_name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Passenger Capacity</label>
                        <input type="number" name="capacity" class="form-control" required min="1" value="{{ $vehicle->capacity }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Status</label>
                        <select name="is_active" class="form-select" required>
                            <option value="1" {{ $vehicle->is_active ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$vehicle->is_active ? 'selected' : '' }}>Inactive</option>
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
@endforeach
@endsection
