@extends('student.layouts.app')

@section('title', 'Transport Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; background: #fff;">
            <div class="card-header bg-white border-bottom-0 py-4 px-4" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h4 class="fw-bold text-dark mb-0"><i class="fas fa-bus text-primary me-2"></i>My Transport Details</h4>
                <p class="text-muted small mb-0 mt-1">Information about your allocated route, stop, vehicle and driver</p>
            </div>
            
            <div class="card-body p-4 border-top">
                @if($allocation)
                    <!-- Transport Allocation Details Card -->
                    <div class="row g-4">
                        <!-- Route & Stop Info -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-4 h-100 border border-light-subtle">
                                <div class="text-muted small text-uppercase fw-bold mb-2" style="font-size:0.75rem; letter-spacing:0.5px;">Route & Stop Info</div>
                                <h5 class="fw-bold text-dark mb-1">{{ $allocation->route->route_name }}</h5>
                                <p class="text-muted small mb-3">{{ $allocation->route->route_description ?? 'No description available for this route.' }}</p>
                                
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small" style="font-size: 0.75rem;">Your Boarding Stop</div>
                                        <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $allocation->stop->stop_name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Vehicle & Driver Info -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-4 h-100 border border-light-subtle">
                                <div class="text-muted small text-uppercase fw-bold mb-2" style="font-size:0.75rem; letter-spacing:0.5px;">Vehicle & Driver Info</div>
                                <h5 class="fw-bold text-dark mb-1">{{ $allocation->vehicle->vehicle_name }}</h5>
                                <p class="text-muted small mb-3">Vehicle Number: <strong class="text-dark">{{ $allocation->vehicle->vehicle_number }}</strong></p>
                                
                                @if($allocation->vehicle->drivers->isNotEmpty())
                                    @php $driver = $allocation->vehicle->drivers->first(); @endphp
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                            <i class="fas fa-id-card"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small" style="font-size: 0.75rem;">Assigned Driver</div>
                                            <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $driver->driver_name }}</div>
                                            <div class="text-muted small" style="font-size:0.8rem;"><i class="fas fa-phone me-1"></i>{{ $driver->mobile_number }}</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center gap-2 text-muted small">
                                        <i class="fas fa-info-circle"></i>
                                        <span>No driver assigned to this vehicle yet.</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Fee Structure Info -->
                        <div class="col-12">
                            <div class="p-4 bg-primary-subtle text-primary-dark rounded-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3" style="background: rgba(37, 99, 235, 0.05); border: 1px solid rgba(37, 99, 235, 0.12);">
                                <div>
                                    <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size:0.75rem; letter-spacing:0.5px; color:#64748B;">Transport Fee (Route-wise)</div>
                                    <h3 class="fw-bold text-dark mb-0">{{ currencySymbol() }}{{ number_format($allocation->route->fee, 2) }} <span class="text-muted small fw-normal">/ month</span></h3>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="text-muted small me-1">Payment Status:</span>
                                    <span class="badge rounded-pill px-3 py-2 fw-semibold {{ $allocation->fee_status === 'Paid' ? 'bg-success text-white' : 'bg-warning text-white' }}" style="font-size:0.85rem;">
                                        <i class="fas {{ $allocation->fee_status === 'Paid' ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>{{ $allocation->fee_status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- No Allocation Warning -->
                    <div class="text-center py-5">
                        <div class="bg-light text-muted rounded-circle d-inline-flex align-items-center justify-content-center mb-4 border" style="width: 80px; height: 80px;">
                            <i class="fas fa-bus fa-2x"></i>
                        </div>
                        <h5 class="fw-bold text-dark">No Transport Allocated</h5>
                        <p class="text-muted mx-auto" style="max-width: 360px;">You are currently not registered on any transport route. Please contact the administrator to assign transport services.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
