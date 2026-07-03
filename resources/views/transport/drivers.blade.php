@extends('layouts.admin')

@section('title', 'Driver Management')

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
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('transport.drivers') }}">
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
    <h5 class="fw-medium text-dark mb-0">Drivers Inventory</h5>
    <button class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addDriverModal">
        <i class="fas fa-plus me-1"></i> Add Driver
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
                        <th class="border-0 px-4">Driver Name</th>
                        <th class="border-0">Mobile Number</th>
                        <th class="border-0">Assigned Vehicle</th>
                        <th class="border-0 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drivers as $driver)
                        <tr>
                            <td class="px-4 fw-medium text-dark">{{ $driver->driver_name }}</td>
                            <td>{{ $driver->mobile_number }}</td>
                            <td>
                                @if($driver->vehicle)
                                    <span class="fw-semibold text-dark">{{ $driver->vehicle->vehicle_name }}</span>
                                    <div class="text-muted small">{{ $driver->vehicle->vehicle_number }}</div>
                                @else
                                    <span class="text-muted small italic">Not Assigned</span>
                                @endif
                            </td>
                            <td class="text-end px-4">
                                <button class="btn btn-outline-secondary btn-sm rounded-circle me-1" style="width:32px; height:32px; padding:0;" data-bs-toggle="modal" data-bs-target="#editDriverModal{{ $driver->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('transport.drivers.delete', $driver->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this driver?');">
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
                            <td colspan="4" class="text-center py-5 text-muted small">No drivers registered in the database.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Add Driver Modal -->
<div class="modal fade" id="addDriverModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-medium text-dark">Register Driver</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transport.drivers.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Driver Name</label>
                        <input type="text" name="driver_name" class="form-control shadow-none" required placeholder="e.g. John Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control shadow-none" required placeholder="e.g. +91 9876543210">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Assigned Vehicle</label>
                        <select name="vehicle_id" class="form-select shadow-none">
                            <option value="">No Vehicle Assigned</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }} ({{ $vehicle->vehicle_number }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pb-4 px-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Driver Modals -->
@foreach($drivers as $driver)
<div class="modal fade" id="editDriverModal{{ $driver->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-medium text-dark">Edit Driver</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transport.drivers.update', $driver->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Driver Name</label>
                        <input type="text" name="driver_name" class="form-control" required value="{{ $driver->driver_name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Mobile Number</label>
                        <input type="text" name="mobile_number" class="form-control" required value="{{ $driver->mobile_number }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Assigned Vehicle</label>
                        <select name="vehicle_id" class="form-select">
                            <option value="">No Vehicle Assigned</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $driver->vehicle_id === $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->vehicle_name }} ({{ $vehicle->vehicle_number }})
                                </option>
                            @endforeach
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
