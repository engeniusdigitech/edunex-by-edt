@extends('layouts.admin')

@section('title', 'Attendance Location Settings')

@section('content')
<div class="mb-4">
    <h3 class="fw-medium mb-1">Attendance Location Settings</h3>
    <p class="text-muted mb-0">Set your institute address and allowed radius for staff biometric mark-in / mark-out.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm rounded-4 col-lg-8">
    <div class="card-body p-4">
        <form action="{{ route('institute.attendance-settings.update') }}" method="POST" id="attendanceSettingsForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="use_current_location" id="useCurrentLocation" value="0">

            <div class="mb-3">
                <label class="form-label fw-semibold">Institute Address</label>
                <textarea name="address" id="addressInput" class="form-control" rows="3" required placeholder="Full address including city and pin code">{{ old('address', $institute->address) }}</textarea>
                @error('address')<div class="text-danger small">{{ $message }}</div>@enderror
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="auto_geocode" value="1" id="autoGeocode" checked>
                    <label class="form-check-label small" for="autoGeocode">Auto-detect coordinates from address (when saving)</label>
                </div>
            </div>

            <div class="border rounded-4 p-3 mb-3 bg-light">
                <label class="form-label fw-semibold mb-2"><i class="fas fa-crosshairs text-primary me-1"></i> Set coordinates</label>
                <p class="small text-muted mb-3">Stand at your institute entrance and use your device GPS for the most accurate attendance zone.</p>
                <button type="button" id="detectCurrentLocationBtn" class="btn btn-outline-primary">
                    <i class="fas fa-location-arrow me-2"></i>Detect Current Location
                </button>
                <div id="locationDetectStatus" class="mt-3 small d-none"></div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Latitude</label>
                    <input type="number" step="any" name="latitude" id="latitudeInput" class="form-control" value="{{ old('latitude', $institute->latitude) }}" placeholder="e.g. 28.6139">
                    @error('latitude')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Longitude</label>
                    <input type="number" step="any" name="longitude" id="longitudeInput" class="form-control" value="{{ old('longitude', $institute->longitude) }}" placeholder="e.g. 77.2090">
                    @error('longitude')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Allowed Attendance Radius (meters)</label>
                <input type="number" name="attendance_radius_meters" class="form-control" min="50" max="5000"
                    value="{{ old('attendance_radius_meters', $institute->attendance_radius_meters ?? 100) }}" required>
                <small class="text-muted">Staff must be within this distance to mark in/out. Default: 100 meters.</small>
                @error('attendance_radius_meters')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>

            @if($institute->latitude && $institute->longitude)
                <div class="alert alert-info small" id="savedLocationInfo">
                    <i class="fas fa-map-marker-alt me-1"></i>
                    Saved location: {{ $institute->latitude }}, {{ $institute->longitude }}
                    — Radius: {{ $institute->attendance_radius_meters ?? 100 }}m
                </div>
            @endif

            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Settings</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const detectBtn = document.getElementById('detectCurrentLocationBtn');
    const statusEl = document.getElementById('locationDetectStatus');
    const latInput = document.getElementById('latitudeInput');
    const lngInput = document.getElementById('longitudeInput');
    const autoGeocode = document.getElementById('autoGeocode');
    const useCurrentLocation = document.getElementById('useCurrentLocation');
    const savedInfo = document.getElementById('savedLocationInfo');

    function showStatus(message, type) {
        statusEl.className = 'mt-3 small alert alert-' + type;
        statusEl.textContent = message;
        statusEl.classList.remove('d-none');
    }

    detectBtn?.addEventListener('click', function () {
        if (!navigator.geolocation) {
            showStatus('Geolocation is not supported by your browser.', 'danger');
            return;
        }

        detectBtn.disabled = true;
        detectBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Detecting...';
        showStatus('Requesting your current location. Please allow location access when prompted.', 'warning');

        navigator.geolocation.getCurrentPosition(
            function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const accuracy = Math.round(position.coords.accuracy);

                latInput.value = lat.toFixed(7);
                lngInput.value = lng.toFixed(7);
                autoGeocode.checked = false;
                useCurrentLocation.value = '1';

                showStatus(
                    'Location detected (' + lat.toFixed(6) + ', ' + lng.toFixed(6) + '). Accuracy: ~' + accuracy + 'm. Save settings to apply.',
                    'success'
                );

                if (savedInfo) {
                    savedInfo.classList.add('d-none');
                }

                detectBtn.disabled = false;
                detectBtn.innerHTML = '<i class="fas fa-location-arrow me-2"></i>Detect Current Location';
            },
            function (error) {
                let message = 'Could not detect location.';
                if (error.code === error.PERMISSION_DENIED) {
                    message = 'Location permission denied. Enable location access for this site in your browser settings.';
                } else if (error.code === error.POSITION_UNAVAILABLE) {
                    message = 'Location unavailable. Try again outdoors or check your device GPS.';
                } else if (error.code === error.TIMEOUT) {
                    message = 'Location request timed out. Please try again.';
                }
                showStatus(message, 'danger');
                detectBtn.disabled = false;
                detectBtn.innerHTML = '<i class="fas fa-location-arrow me-2"></i>Detect Current Location';
            },
            { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
        );
    });

    latInput?.addEventListener('input', function () {
        if (useCurrentLocation.value === '1') {
            useCurrentLocation.value = '0';
        }
    });
    lngInput?.addEventListener('input', function () {
        if (useCurrentLocation.value === '1') {
            useCurrentLocation.value = '0';
        }
    });
    autoGeocode?.addEventListener('change', function () {
        if (this.checked) {
            useCurrentLocation.value = '0';
        }
    });
});
</script>
@endpush
