@extends('student.layouts.app')

@section('title', 'Live Bus Tracking')

@section('content')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<style>
    .glass-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    #map {
        height: 500px;
        border-radius: 20px;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
        z-index: 1;
    }
    .status-pulse {
        width: 12px;
        height: 12px;
        background-color: #10B981;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulse 1.6s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    .timeline-item {
        border-left: 2px dashed #CBD5E1;
        position: relative;
        padding-left: 24px;
        padding-bottom: 24px;
    }
    .timeline-item:last-child {
        border-left: 0;
        padding-bottom: 0;
    }
    .timeline-dot {
        position: absolute;
        left: -6px;
        top: 2px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #94A3B8;
    }
    .timeline-dot.active-dot {
        background-color: #2563EB;
        box-shadow: 0 0 8px rgba(37, 99, 235, 0.5);
    }
    .timeline-dot.success-dot {
        background-color: #10B981;
        box-shadow: 0 0 8px rgba(16, 185, 129, 0.5);
    }
</style>

<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-0"><i class="fas fa-map-marked-alt text-primary me-2"></i>Live Bus Tracking</h4>
            <p class="text-muted small mb-0">Track your bus location in real-time</p>
        </div>
        <a href="{{ route('student.transport.index') }}" class="btn btn-outline-secondary rounded-pill px-3.5 btn-sm shadow-sm">
            <i class="fas fa-arrow-left me-1"></i>Transport Details
        </a>
    </div>

    @if(!$allocation)
        <div class="card border-0 glass-card p-5 text-center">
            <div class="text-muted mb-3"><i class="fas fa-bus fa-3x"></i></div>
            <h5 class="fw-bold text-dark">No Transport Allocated</h5>
            <p class="text-muted">You must have an allocated route to track transit vehicles.</p>
        </div>
    @else
        <div class="row g-4">
            <!-- Map Card (Left) -->
            <div class="col-12 col-lg-8">
                <div class="card border-0 glass-card p-3 mb-4">
                    <div id="map"></div>
                </div>
            </div>

            <!-- Transit Status & Log Timeline (Right) -->
            <div class="col-12 col-lg-4">
                <!-- Transit Live Status -->
                <div class="card border-0 glass-card p-4 mb-4">
                    <h6 class="fw-bold text-dark mb-3">Bus Transit Status</h6>
                    
                    @if($activeTrip)
                        <div class="d-flex align-items-center gap-3 bg-success-subtle p-3 rounded-4 border border-success-subtle mb-3 text-success-emphasis">
                            <span class="status-pulse"></span>
                            <div>
                                <div class="fw-bold">Bus is En Route</div>
                                <div class="text-xs">Live tracking and updates active</div>
                            </div>
                        </div>
                        <div class="text-sm">
                            <div class="mb-1 text-muted">Vehicle Assigned: <strong class="text-dark">{{ $allocation->vehicle->vehicle_name }} ({{ $allocation->vehicle->vehicle_number }})</strong></div>
                            @if($allocation->vehicle->drivers->isNotEmpty())
                                @php $driver = $allocation->vehicle->drivers->first(); @endphp
                                <div class="text-muted">Driver: <strong class="text-dark">{{ $driver->driver_name }} ({{ $driver->mobile_number }})</strong></div>
                            @endif
                        </div>
                    @else
                        <div class="d-flex align-items-center gap-3 bg-light p-3 rounded-4 border mb-3 text-muted">
                            <i class="fas fa-power-off fs-5 text-secondary"></i>
                            <div>
                                <div class="fw-bold text-dark">Bus is Offline</div>
                                <div class="text-xs">Driver has not initiated transit run yet</div>
                            </div>
                        </div>
                        <div class="text-sm text-muted">
                            <p class="mb-0">When the bus starts, its live position will appear on the map automatically.</p>
                        </div>
                    @endif
                </div>

                <!-- Personal Boarding History Checklist -->
                <div class="card border-0 glass-card p-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="fas fa-history me-2 text-primary"></i>Check-in Timeline</h6>
                    
                    @if($boardingLogs->isEmpty())
                        <p class="text-muted text-xs text-center py-3">No boarding actions logged for you today.</p>
                    @else
                        <div class="timeline-container px-2 py-1">
                            @foreach($boardingLogs->take(5) as $log)
                                <div class="timeline-item">
                                    <span class="timeline-dot {{ $log->status === 'boarded' ? 'success-dot' : 'active-dot' }}"></span>
                                    <div class="fw-bold text-dark text-sm" style="margin-top:-3px;">
                                        Marked as {{ strtoupper($log->status) }}
                                    </div>
                                    <div class="text-muted text-xs mb-1">
                                        Direction: <span class="fw-semibold">{{ ucfirst($log->direction) }}</span> at {{ $log->stop->stop_name }}
                                    </div>
                                    <span class="text-muted text-xs">{{ $log->logged_at->format('h:i A, d M') }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Leaflet.js script -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

@if($allocation)
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Coordinates
    const defaultLat = 28.6139; // Delhi Hub
    const defaultLng = 77.2090;

    // Initialize Map
    const map = L.map('map').setView([defaultLat, defaultLng], 13);

    // Tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Custom Icons
    const hubIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/8074/8074788.png',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -35]
    });

    const stopIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/8058/8058925.png',
        iconSize: [28, 28],
        iconAnchor: [14, 28],
        popupAnchor: [0, -25]
    });

    const myStopIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/8058/8058970.png', // custom stop pin for student
        iconSize: [34, 34],
        iconAnchor: [17, 34],
        popupAnchor: [0, -30]
    });

    const busIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/3062/3062140.png',
        iconSize: [36, 36],
        iconAnchor: [18, 18]
    });

    // Plot Hub
    L.marker([defaultLat, defaultLng], {icon: hubIcon}).addTo(map).bindPopup("<b>EduNex ERP central Hub</b>");

    // Route stops from allocation
    const allocation = @json($allocation);
    let myStopId = allocation.transport_stop_id;
    let stopMarkers = [];
    let pathCoords = [[defaultLat, defaultLng]];

    if (allocation.route && allocation.route.stops) {
        allocation.route.stops.forEach((stop, index) => {
            if (stop.latitude && stop.longitude) {
                const lat = parseFloat(stop.latitude);
                const lng = parseFloat(stop.longitude);
                pathCoords.push([lat, lng]);

                const isMyStop = stop.id == myStopId;
                const marker = L.marker([lat, lng], {icon: isMyStop ? myStopIcon : stopIcon})
                    .addTo(map)
                    .bindPopup(`<b>${isMyStop ? '👉 ' : ''}Stop #${index + 1}: ${stop.stop_name}</b><br>${isMyStop ? '<b>YOUR ASSIGNED STOP</b>' : ''}`);
                
                stopMarkers.push(marker);
            }
        });

        // Draw dotted lines between stops
        if (pathCoords.length > 1) {
            L.polyline(pathCoords, {color: '#2563EB', weight: 3, opacity: 0.6, dashArray: '6, 6'}).addTo(map);
            
            // Auto fit bounds
            const group = new L.featureGroup([...stopMarkers, L.marker([defaultLat, defaultLng])]);
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }

    // Live bus tracking marker
    let busMarker = null;
    let activeTrip = @json($activeTrip);

    function initBusMarker() {
        if (activeTrip && activeTrip.current_lat && activeTrip.current_lng) {
            const lat = parseFloat(activeTrip.current_lat);
            const lng = parseFloat(activeTrip.current_lng);
            
            if (!busMarker) {
                busMarker = L.marker([lat, lng], {icon: busIcon}).addTo(map);
                busMarker.bindPopup("<b>Assigned Bus</b><br>Live transit location").openPopup();
            } else {
                busMarker.setLatLng([lat, lng]);
            }
            
            // Periodically adjust view if student is focusing on live tracking
            map.setView([lat, lng]);
        } else {
            if (busMarker) {
                map.removeLayer(busMarker);
                busMarker = null;
            }
        }
    }

    // Initial bus plot
    initBusMarker();

    // ----------------------------------------------------
    // Auto-Polling AJAX GPS coordinate retrieval
    // ----------------------------------------------------
    if (activeTrip) {
        setInterval(function() {
            fetch(window.location.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.activeTrip) {
                    activeTrip = data.activeTrip;
                    initBusMarker();
                } else {
                    // Trip completed or offline
                    if (busMarker) {
                        map.removeLayer(busMarker);
                        busMarker = null;
                    }
                    // Optional reload to show offline state box
                    window.location.reload();
                }
            })
            .catch(err => console.error("Error polling bus coordinates", err));
        }, 5000); // polls every 5 seconds
    }
});
</script>
@endif
@endsection
