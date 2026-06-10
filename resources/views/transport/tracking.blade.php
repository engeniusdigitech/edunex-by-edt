@extends('layouts.admin')

@section('title', 'Live Transport Tracking Console')

@section('content')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<!-- Custom Styles for Premium Glassmorphism & Dashboard Layout -->
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.08);
    }
    #map {
        height: 550px;
        border-radius: 16px;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
        z-index: 1;
    }
    .pulse-dot {
        width: 10px;
        height: 10px;
        background-color: #10B981;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulse 1.6s infinite;
    }
    @keyframes pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        70% {
            transform: scale(1);
            box-shadow: 0 0 0 8px rgba(16, 185, 129, 0);
        }
        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }
    .stop-item {
        cursor: pointer;
        transition: all 0.2s;
        border-left: 3px solid transparent;
    }
    .stop-item:hover {
        background-color: rgba(37, 99, 235, 0.05);
    }
    .stop-item.active-stop {
        border-left: 3px solid #2563EB;
        background-color: rgba(37, 99, 235, 0.08);
    }
    .timeline-badge {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
    }
</style>

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
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('transport.tracking.index') }}">
                    <i class="fas fa-map-marker-alt me-2"></i>Live Tracking
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
                    <i class="fas fa-map-pin me-2"></i>Stops
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
        </ul>
    </div>
</div>

<div class="row g-4">
    <!-- Map & Console Section (Left) -->
    <div class="col-12 col-lg-8">
        <div class="card border-0 glass-card h-100 mb-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold text-dark mb-0">Live Map Console</h5>
                    <p class="text-muted small mb-0">Monitor live trips, coordinate stops, and manage routing</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="click-picker-status" class="badge bg-warning text-dark d-none">
                        <i class="fas fa-crosshairs me-1"></i> Click on map to set coordinates
                    </span>
                    <button id="cancel-picker-btn" class="btn btn-xs btn-outline-danger d-none rounded-pill px-2.5">Cancel</button>
                </div>
            </div>
            <div class="card-body p-3">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <!-- Active Trip controls / Trip Config (Right) -->
    <div class="col-12 col-lg-4">
        @if($selectedTrip)
            <!-- Active Trip Information -->
            <div class="card border-0 glass-card mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill mb-1">
                            <span class="pulse-dot me-1"></span> EN ROUTE
                        </span>
                        <h6 class="fw-bold text-dark mb-0">Trip #{{ $selectedTrip->id }}</h6>
                    </div>
                    <form action="{{ route('transport.trips.complete', $selectedTrip->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                            <i class="fas fa-check-circle me-1"></i>End Trip
                        </button>
                    </form>
                </div>
                <div class="card-body px-4 pb-4">
                    <hr class="text-muted my-3">
                    <div class="row g-2 text-center mb-3">
                        <div class="col-6 bg-light rounded p-2">
                            <span class="text-muted small block">Vehicle</span>
                            <div class="fw-bold text-dark small">{{ $selectedTrip->vehicle->vehicle_name }}</div>
                            <span class="text-muted text-xs">{{ $selectedTrip->vehicle->vehicle_number }}</span>
                        </div>
                        <div class="col-6 bg-light rounded p-2">
                            <span class="text-muted small block">Route</span>
                            <div class="fw-bold text-dark small text-truncate" title="{{ $selectedTrip->route->route_name }}">
                                {{ $selectedTrip->route->route_name }}
                            </div>
                            <span class="text-muted text-xs">{{ $selectedTrip->route->stops->count() }} Stops</span>
                        </div>
                    </div>

                    <!-- Simulator Controls -->
                    <div class="card bg-primary-subtle border-0 p-3 mb-4 rounded-3 text-primary-emphasis">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="fw-bold text-sm"><i class="fas fa-laptop-code me-2"></i>Trip GPS Simulator</span>
                            <span class="badge bg-primary rounded-pill" id="sim-status-badge">Idle</span>
                        </div>
                        <p class="text-xs mb-3 text-primary-emphasis opacity-75">Simulate vehicle movement along the route stops. This triggers location reporting to database and boarding notifications.</p>
                        
                        <div class="d-flex gap-2">
                            <button id="btn-start-sim" class="btn btn-sm btn-primary rounded-pill flex-grow-1">
                                <i class="fas fa-play me-1"></i>Start Sim
                            </button>
                            <button id="btn-pause-sim" class="btn btn-sm btn-outline-primary rounded-pill flex-grow-1" disabled>
                                <i class="fas fa-pause me-1"></i>Pause
                            </button>
                        </div>
                    </div>

                    <!-- Route Stops Progress Timeline -->
                    <h6 class="fw-bold text-dark mb-3"><i class="fas fa-route me-2 text-primary"></i>Stops &amp; Checklists</h6>
                    <div class="list-group list-group-flush rounded-3 border">
                        @forelse($selectedTrip->route->stops as $stop)
                            <div class="list-group-item stop-item p-3 d-flex justify-content-between align-items-center" 
                                 id="stop-row-{{ $stop->id }}" 
                                 data-id="{{ $stop->id }}"
                                 data-name="{{ $stop->stop_name }}"
                                 data-lat="{{ $stop->latitude }}"
                                 data-lng="{{ $stop->longitude }}">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="timeline-badge bg-primary-subtle text-primary">
                                        {{ $stop->sort_order ?: ($loop->index + 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark text-sm">{{ $stop->stop_name }}</div>
                                        <div class="text-muted text-xs">
                                            @if($stop->latitude && $stop->longitude)
                                                {{ round($stop->latitude, 4) }}, {{ round($stop->longitude, 4) }}
                                            @else
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> Coordinates required</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-1">
                                    @if(!$stop->latitude || !$stop->longitude)
                                        <button class="btn btn-xs btn-outline-warning rounded-pill px-2 pin-coord-btn" data-stop-id="{{ $stop->id }}" title="Pin location on map">
                                            <i class="fas fa-map-marker-alt"></i> Pin
                                        </button>
                                    @else
                                        <button class="btn btn-xs btn-primary rounded-pill px-2.5 board-btn" 
                                                data-stop-id="{{ $stop->id }}"
                                                data-stop-name="{{ $stop->stop_name }}"
                                                title="Mark Boarding / Deboarding for students">
                                            <i class="fas fa-user-check me-1"></i>Checklist
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="p-3 text-center text-muted small">No stops added to this route yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        @else
            <!-- Start a New Trip Panel -->
            <div class="card border-0 glass-card mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                    <h6 class="fw-bold text-dark mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Start a New Trip</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('transport.trips.start') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-semibold">Select Vehicle</label>
                            <select name="vehicle_id" class="form-select" required>
                                <option value="">-- Select Vehicle --</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }} ({{ $vehicle->vehicle_number }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-semibold">Select Route</label>
                            <select name="transport_route_id" class="form-select" required>
                                <option value="">-- Select Route --</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}">{{ $route->route_name }} ({{ $route->stops->count() }} Stops)</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2.5">
                            <i class="fas fa-play me-2"></i>Initiate Live Transit Run
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Route Optimization Panel -->
        <div class="card border-0 glass-card">
            <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                <h6 class="fw-bold text-dark mb-0"><i class="fas fa-magic me-2 text-warning"></i>Route Optimizer (TSP)</h6>
            </div>
            <div class="card-body p-4">
                <p class="text-xs text-muted">Geographically sort route stops to compute the shortest path. Starts from Delhi Institute Hub and runs nearest-neighbor TSP algorithm.</p>
                <form action="" id="optimize-form" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Select Route to Optimize</label>
                        <select id="optimize_route_id" class="form-select" required>
                            <option value="">-- Select Route --</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}">{{ $route->route_name }} ({{ $route->stops->count() }} Stops)</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" id="btn-optimize" class="btn btn-outline-warning w-100 rounded-pill py-2">
                        <i class="fas fa-route me-2"></i>Optimize Stop Sequences
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Leaflet.js script -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ----------------------------------------------------
    // Leaflet Map Initialization
    // ----------------------------------------------------
    const defaultLat = 28.6139; // Delhi Hub
    const defaultLng = 77.2090;
    
    // Initialize map
    const map = L.map('map').setView([defaultLat, defaultLng], 12);
    
    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Default icon styles
    const instituteIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/8074/8074788.png', // school/hub pin
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -35]
    });

    const stopIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/8058/8058925.png', // stop/station pin
        iconSize: [30, 30],
        iconAnchor: [15, 30],
        popupAnchor: [0, -25]
    });

    const busIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/3062/3062140.png', // bus marker
        iconSize: [36, 36],
        iconAnchor: [18, 18]
    });

    // Add Institute Hub Pin
    L.marker([defaultLat, defaultLng], {icon: instituteIcon})
        .addTo(map)
        .bindPopup("<b>EduNex ERP Central Institute</b><br>Delhi Campus Transit Hub")
        .openPopup();

    // Map state variables
    let stopMarkers = [];
    let busMarker = null;
    let pathLine = null;
    let selectedTrip = @json($selectedTrip);
    let allocatedStudents = @json($allocatedStudents);
    let isClickPicking = false;
    let targetStopIdForCoordinates = null;

    // ----------------------------------------------------
    // Load and Plot Stops on Map
    // ----------------------------------------------------
    function drawRouteStops() {
        // Clear previous markers & paths
        stopMarkers.forEach(m => map.removeLayer(m));
        stopMarkers = [];
        if (pathLine) map.removeLayer(pathLine);
        pathLine = null;

        if (!selectedTrip || !selectedTrip.route || !selectedTrip.route.stops) return;

        const pathCoords = [];
        // Add hub as starting point of path coordinates
        pathCoords.push([defaultLat, defaultLng]);

        selectedTrip.route.stops.forEach((stop, index) => {
            if (stop.latitude && stop.longitude) {
                const lat = parseFloat(stop.latitude);
                const lng = parseFloat(stop.longitude);
                pathCoords.push([lat, lng]);

                // Create marker for Stop
                const marker = L.marker([lat, lng], {icon: stopIcon})
                    .addTo(map)
                    .bindPopup(`<b>Stop #${index + 1}: ${stop.stop_name}</b><br>Lat: ${lat}, Lng: ${lng}`);
                
                // Keep marker reference
                marker.stopId = stop.id;
                stopMarkers.push(marker);
            }
        });

        // Draw path connecting stops
        if (pathCoords.length > 1) {
            pathLine = L.polyline(pathCoords, {color: '#2563EB', weight: 4, opacity: 0.7, dashArray: '8, 8'}).addTo(map);
            
            // Adjust bounds to fit route
            const group = new L.featureGroup([...stopMarkers, L.marker([defaultLat, defaultLng])]);
            map.fitBounds(group.getBounds().pad(0.1));
        }
    }

    // Initial draw
    drawRouteStops();

    // ----------------------------------------------------
    // Click Picker logic: Map clicks to set Coordinates
    // ----------------------------------------------------
    const clickPickerStatus = document.getElementById('click-picker-status');
    const cancelPickerBtn = document.getElementById('cancel-picker-btn');

    document.querySelectorAll('.pin-coord-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            targetStopIdForCoordinates = this.dataset.stopId;
            isClickPicking = true;
            clickPickerStatus.classList.remove('d-none');
            cancelPickerBtn.classList.remove('d-none');
            alert("Please click anywhere on the map to set the location for this stop.");
        });
    });

    cancelPickerBtn.addEventListener('click', function() {
        isClickPicking = false;
        targetStopIdForCoordinates = null;
        clickPickerStatus.classList.add('d-none');
        cancelPickerBtn.classList.add('d-none');
    });

    map.on('click', function(e) {
        if (!isClickPicking || !targetStopIdForCoordinates) return;

        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        // Perform AJAX request to save coordinates. Wait, routes/web.php doesn't have stop update endpoint?
        // Actually, we do! Route::put('/stops/{stop}', [\App\Http\Controllers\TransportController::class, 'updateStop'])->name('stops.update');
        // Let's call that endpoint via fetch!
        const url = `/transport/stops/${targetStopIdForCoordinates}`;
        
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');
        formData.append('latitude', lat);
        formData.append('longitude', lng);
        // also keep previous stop_name so it doesn't fail validation. Let's find stop_name from row
        const stopRow = document.getElementById(`stop-row-${targetStopIdForCoordinates}`);
        const stopName = stopRow ? stopRow.dataset.name : "Stop";
        formData.append('stop_name', stopName);

        fetch(url, {
            method: 'POST', // POST with _method=PUT for Laravel
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.ok) {
                alert("Coordinates updated successfully! Reloading page...");
                window.location.reload();
            } else {
                alert("Error updating stop coordinates. Please verify coordinates and try again.");
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error sending coordinates request.");
        })
        .finally(() => {
            isClickPicking = false;
            targetStopIdForCoordinates = null;
            clickPickerStatus.classList.add('d-none');
            cancelPickerBtn.classList.add('d-none');
        });
    });

    // ----------------------------------------------------
    // Geographical TSP Router form submit hook
    // ----------------------------------------------------
    const optimizeSelect = document.getElementById('optimize_route_id');
    const optimizeForm = document.getElementById('optimize-form');
    const optimizeBtn = document.getElementById('btn-optimize');

    if (optimizeBtn) {
        optimizeBtn.addEventListener('click', function() {
            const routeId = optimizeSelect.value;
            if (!routeId) {
                alert("Please select a route to optimize.");
                return;
            }
            optimizeForm.action = `/transport/routes/${routeId}/optimize`;
            optimizeForm.submit();
        });
    }

    // ----------------------------------------------------
    // GPS Simulation Engine
    // ----------------------------------------------------
    let simInterval = null;
    let simIndex = 0;
    let simSteps = [];
    let currentLat = defaultLat;
    let currentLng = defaultLng;

    const btnStartSim = document.getElementById('btn-start-sim');
    const btnPauseSim = document.getElementById('btn-pause-sim');
    const simStatusBadge = document.getElementById('sim-status-badge');

    if (selectedTrip && selectedTrip.status === 'en_route') {
        // Setup coordinates for simulation path
        const stopsWithCoords = selectedTrip.route.stops.filter(s => s.latitude && s.longitude);
        
        // Build array of coordinate nodes: Start Hub -> Stops in sequence
        simSteps.push({lat: defaultLat, lng: defaultLng, label: "Institute Hub", isHub: true});
        stopsWithCoords.forEach((s, idx) => {
            simSteps.push({
                lat: parseFloat(s.latitude),
                lng: parseFloat(s.longitude),
                label: s.stop_name,
                stopId: s.id,
                isHub: false
            });
        });

        // Initial bus marker plot
        busMarker = L.marker([selectedTrip.current_lat || defaultLat, selectedTrip.current_lng || defaultLng], {icon: busIcon}).addTo(map);
        busMarker.bindPopup("<b>Live Bus Simulator</b>").openPopup();
        map.setView(busMarker.getLatLng(), 14);

        // Simulator ticking function
        function tickSimulation() {
            if (simIndex >= simSteps.length) {
                clearInterval(simInterval);
                simInterval = null;
                btnStartSim.disabled = false;
                btnPauseSim.disabled = true;
                simStatusBadge.textContent = "Completed";
                simStatusBadge.className = "badge bg-success rounded-pill";
                alert("Simulation has completed the transit path! Click End Trip to complete the run.");
                return;
            }

            const target = simSteps[simIndex];
            
            // Linear interpolation steps to look smooth (let's do step teleportation for database simplicity)
            currentLat = target.lat;
            currentLng = target.lng;
            
            // Update marker
            busMarker.setLatLng([currentLat, currentLng]);
            busMarker.bindPopup(`<b>Simulator Status:</b><br>${target.label}`).openPopup();
            map.setView([currentLat, currentLng]);

            // Highlight current active stop row in DOM list
            document.querySelectorAll('.stop-item').forEach(el => el.classList.remove('active-stop'));
            if (!target.isHub) {
                const row = document.getElementById(`stop-row-${target.stopId}`);
                if (row) row.classList.add('active-stop');
            }

            // Sync to server via AJAX
            sendGPSUpdateToServer(currentLat, currentLng);

            // If arrived at a stop, pause simulation automatically to prompt boarding check-in!
            if (!target.isHub) {
                pauseSimulation();
                
                // Trigger modal for boarding automatically
                openBoardingChecklist(target.stopId, target.label);
            }

            // Next node index
            simIndex++;
        }

        function startSimulation() {
            if (simInterval) return;
            
            simStatusBadge.textContent = "Simulating";
            simStatusBadge.className = "badge bg-warning rounded-pill";
            btnStartSim.disabled = true;
            btnPauseSim.disabled = false;

            // Tick immediately once, then set interval
            tickSimulation();
            simInterval = setInterval(tickSimulation, 6000); // Ticks every 6 seconds
        }

        function pauseSimulation() {
            if (!simInterval) return;
            clearInterval(simInterval);
            simInterval = null;
            btnStartSim.disabled = false;
            btnPauseSim.disabled = true;
            simStatusBadge.textContent = "Paused";
            simStatusBadge.className = "badge bg-secondary rounded-pill";
        }

        btnStartSim.addEventListener('click', startSimulation);
        btnPauseSim.addEventListener('click', pauseSimulation);
    }

    function sendGPSUpdateToServer(lat, lng) {
        if (!selectedTrip) return;
        
        const url = `/transport/trips/${selectedTrip.id}/location`;
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('latitude', lat);
        formData.append('longitude', lng);

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log("GPS Location reported: ", lat, lng);
        })
        .catch(err => {
            console.error("GPS Sync failed", err);
        });
    }

    // ----------------------------------------------------
    // Boarding Checklist Handlers
    // ----------------------------------------------------
    const boardingModal = new bootstrap.Modal(document.getElementById('boardingModal'));
    const modalStopName = document.getElementById('modal-stop-name');
    const modalStudentsContainer = document.getElementById('modal-students-container');
    let currentActiveStopId = null;

    // Attach click listeners to all checklist buttons in the stops list
    document.querySelectorAll('.board-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const stopId = this.dataset.stopId;
            const stopName = this.dataset.stopName;
            openBoardingChecklist(stopId, stopName);
        });
    });

    // Make stop row clickable to center map
    document.querySelectorAll('.stop-item').forEach(row => {
        row.addEventListener('click', function() {
            const lat = parseFloat(this.dataset.lat);
            const lng = parseFloat(this.dataset.lng);
            if (lat && lng) {
                map.setView([lat, lng], 14);
                
                // Open popup on marker
                const marker = stopMarkers.find(m => m.stopId == this.dataset.id);
                if (marker) marker.openPopup();
            }
        });
    });

    function openBoardingChecklist(stopId, stopName) {
        currentActiveStopId = stopId;
        modalStopName.textContent = stopName;
        
        // Filter students allocated to this stop
        const studentsAtStop = allocatedStudents.filter(s => s.transport_stop_id == stopId);
        
        modalStudentsContainer.innerHTML = "";
        
        if (studentsAtStop.length === 0) {
            modalStudentsContainer.innerHTML = `<div class="p-3 text-center text-muted small">No students allocated to this stop.</div>`;
        } else {
            studentsAtStop.forEach(student => {
                // Determine current boarding status in this active trip if any exists
                let currentStatus = "none";
                if (selectedTrip && selectedTrip.boarding_logs) {
                    const log = selectedTrip.boarding_logs.find(l => l.student_id == student.id && l.transport_stop_id == stopId);
                    if (log) {
                        currentStatus = log.status; // boarded, deboarded, absent
                    }
                }

                const studentCard = document.createElement('div');
                studentCard.className = "list-group-item d-flex justify-content-between align-items-center p-3";
                studentCard.innerHTML = `
                    <div>
                        <div class="fw-bold text-dark text-sm">${student.name}</div>
                        <div class="text-muted text-xs">Roll Number: ${student.roll_number || 'N/A'}</div>
                        <span class="badge rounded-pill text-xs mt-1" id="status-badge-${student.id}">
                            ${currentStatus === 'none' ? 'No Log' : currentStatus.toUpperCase()}
                        </span>
                    </div>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-success status-btn ${currentStatus === 'boarded' ? 'active' : ''}" data-status="boarded" data-student-id="${student.id}">Board</button>
                        <button type="button" class="btn btn-outline-primary status-btn ${currentStatus === 'deboarded' ? 'active' : ''}" data-status="deboarded" data-student-id="${student.id}">Deboard</button>
                        <button type="button" class="btn btn-outline-danger status-btn ${currentStatus === 'absent' ? 'active' : ''}" data-status="absent" data-student-id="${student.id}">Absent</button>
                    </div>
                `;
                modalStudentsContainer.appendChild(studentCard);
            });

            // Bind click events on boarding state changes
            modalStudentsContainer.querySelectorAll('.status-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const status = this.dataset.status;
                    const studentId = this.dataset.studentId;
                    const direction = document.querySelector('input[name="direction"]:checked').value;
                    
                    submitBoardingStatus(studentId, status, direction, this);
                });
            });
        }
        
        boardingModal.show();
    }

    function submitBoardingStatus(studentId, status, direction, btnElement) {
        if (!selectedTrip) return;

        const url = `/transport/trips/${selectedTrip.id}/board`;
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('student_id', studentId);
        formData.append('transport_stop_id', currentActiveStopId);
        formData.append('direction', direction);
        formData.append('status', status);

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update button active states
                const parentGroup = btnElement.parentElement;
                parentGroup.querySelectorAll('.status-btn').forEach(b => b.classList.remove('active'));
                btnElement.classList.add('active');

                // Update text status badge
                const badge = document.getElementById(`status-badge-${studentId}`);
                badge.textContent = status.toUpperCase();
                
                // Colorize badge
                badge.className = "badge rounded-pill text-xs mt-1 " + 
                    (status === 'boarded' ? 'bg-success' : (status === 'deboarded' ? 'bg-primary' : 'bg-danger'));

                // Also update the local JS data cache to keep state if reopened
                if (!selectedTrip.boarding_logs) {
                    selectedTrip.boarding_logs = [];
                }
                const existingLogIdx = selectedTrip.boarding_logs.findIndex(l => l.student_id == studentId && l.transport_stop_id == currentActiveStopId);
                if (existingLogIdx > -1) {
                    selectedTrip.boarding_logs[existingLogIdx].status = status;
                } else {
                    selectedTrip.boarding_logs.push({
                        student_id: studentId,
                        transport_stop_id: currentActiveStopId,
                        status: status
                    });
                }
            } else {
                alert("Failed to save boarding check-in. Try again.");
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error sending boarding status.");
        });
    }
});
</script>
@endsection

@section('modals')
<!-- Boarding Checklist Modal -->
<div class="modal fade" id="boardingModal" tabindex="-1" aria-labelledby="boardingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 glass-card">
            <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="boardingModalLabel">Boarding Check-In</h5>
                    <p class="text-muted small mb-0" id="boarding-subtitle">Stop: <span class="fw-bold text-primary" id="modal-stop-name">Name</span></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Trip log state selection -->
                <div class="row g-2 text-center mb-3">
                    <div class="col-6">
                        <label class="d-block p-2 rounded border cursor-pointer bg-light">
                            <input type="radio" name="direction" value="pickup" checked class="form-check-input me-1">
                            <span class="small fw-semibold text-dark">Morning Pickup</span>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="d-block p-2 rounded border cursor-pointer bg-light">
                            <input type="radio" name="direction" value="dropoff" class="form-check-input me-1">
                            <span class="small fw-semibold text-dark">Evening Dropoff</span>
                        </label>
                    </div>
                </div>

                <!-- Students list -->
                <h6 class="fw-bold text-dark text-xs text-uppercase tracking-wider mb-2">Allocated Students</h6>
                <div id="modal-students-container" class="list-group list-group-flush border rounded overflow-auto" style="max-height: 280px;">
                    <!-- Javascript populates this -->
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0 pb-4 px-4">
                <button type="button" class="btn btn-outline-secondary w-100 rounded-pill" data-bs-dismiss="modal">Close &amp; Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
