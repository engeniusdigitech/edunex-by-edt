@extends('layouts.admin')

@section('title', 'Route Management')

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
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('transport.routes') }}">
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
    <h5 class="fw-bold text-dark mb-0">Routes List</h5>
    <button class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addRouteModal">
        <i class="fas fa-plus me-1"></i> Add Route
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
                        <th class="border-0 px-4">Route Name</th>
                        <th class="border-0">Description</th>
                        <th class="border-0">Stops</th>
                        <th class="border-0">Monthly Fee</th>
                        <th class="border-0 text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($routes as $route)
                        <tr>
                            <td class="px-4 fw-bold text-dark">{{ $route->route_name }}</td>
                            <td>{{ $route->route_description ?? 'No Description' }}</td>
                            <td>
                                <span class="badge bg-secondary rounded-pill px-2.5 py-1">
                                    {{ $route->stops_count }} Stops
                                </span>
                            </td>
                            <td class="fw-semibold text-primary">{{ currencySymbol() }}{{ number_format($route->fee, 2) }}</td>
                            <td class="text-end px-4">
                                <button class="btn btn-outline-secondary btn-sm rounded-circle me-1" style="width:32px; height:32px; padding:0;" data-bs-toggle="modal" data-bs-target="#editRouteModal{{ $route->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('transport.routes.delete', $route->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Deleting this route will delete all stops and allocations associated with it. Are you sure?');">
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
                            <td colspan="5" class="text-center py-5 text-muted small">No routes created in the database.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Add Route Modal -->
<div class="modal fade" id="addRouteModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark">Create Transport Route</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transport.routes.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Route Name</label>
                        <input type="text" name="route_name" class="form-control shadow-none" required placeholder="e.g. Route A - North Area">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Description</label>
                        <textarea name="route_description" class="form-control shadow-none" rows="3" placeholder="Brief description of route path/areas covered"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Monthly Transport Fee (Route-wise)</label>
                        <input type="number" name="fee" class="form-control shadow-none" required step="0.01" min="0" placeholder="e.g. 1500.00">
                    </div>
                </div>
                <div class="modal-footer border-top-0 pb-4 px-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save Route</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Route Modals -->
@foreach($routes as $route)
<div class="modal fade" id="editRouteModal{{ $route->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark">Edit Route</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transport.routes.update', $route->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Route Name</label>
                        <input type="text" name="route_name" class="form-control" required value="{{ $route->route_name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Description</label>
                        <textarea name="route_description" class="form-control" rows="3">{{ $route->route_description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Monthly Transport Fee (Route-wise)</label>
                        <input type="number" name="fee" class="form-control" required step="0.01" min="0" value="{{ $route->fee }}">
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
