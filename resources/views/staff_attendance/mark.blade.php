@extends('layouts.admin')

@section('title', 'Mark Attendance')

@section('content')
<div class="mb-4">
    <h3 class="fw-medium mb-1"><i class="fas fa-fingerprint text-primary me-2"></i>Biometric Attendance</h3>
    <p class="text-muted mb-0">Mark IN / OUT with face verification within {{ $institute->attendance_radius_meters ?? 100 }}m of institute.</p>
</div>

@if(!$locationReady)
    <div class="alert alert-warning"><i class="fas fa-exclamation-triangle me-2"></i>Institute location is not configured. Ask your admin to set attendance location settings.</div>
@endif
@if(!$faceReady)
    <div class="alert alert-warning"><i class="fas fa-user-slash me-2"></i>Your face is not enrolled. Contact admin to update your staff profile.</div>
@endif

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 text-center">
                <div class="position-relative bg-dark rounded-4 overflow-hidden mx-auto mb-3" style="max-width:480px;aspect-ratio:4/3;">
                    <video id="markVideo" autoplay muted playsinline class="w-100 h-100" style="object-fit:cover;transform:scaleX(-1);"></video>
                </div>
                <div id="markStatus" class="alert alert-secondary small text-start">Initializing...</div>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <button type="button" id="markInBtn" class="btn btn-success btn-lg px-4" {{ (!$locationReady || !$faceReady || $today->mark_in_at) ? 'disabled' : '' }}>
                        <i class="fas fa-sign-in-alt me-2"></i>Mark IN
                    </button>
                    <button type="button" id="markOutBtn" class="btn btn-danger btn-lg px-4" {{ (!$today->mark_in_at || $today->mark_out_at) ? 'disabled' : '' }}>
                        <i class="fas fa-sign-out-alt me-2"></i>Mark OUT
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white fw-medium">Today — {{ today()->format('d M Y') }}</div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Mark IN</span>
                    <strong class="{{ $today->mark_in_at ? 'text-success' : '' }}">{{ $today->mark_in_at?->format('h:i A') ?? '—' }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Mark OUT</span>
                    <strong class="{{ $today->mark_out_at ? 'text-danger' : '' }}">{{ $today->mark_out_at?->format('h:i A') ?? '—' }}</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Status</span>
                    <span class="badge bg-{{ $today->status === 'present' ? 'success' : 'secondary' }}">{{ ucfirst($today->status) }}</span>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white fw-medium">Recent</div>
            <ul class="list-group list-group-flush">
                @forelse($recent as $row)
                    <li class="list-group-item d-flex justify-content-between small">
                        <span>{{ $row->date->format('d M') }}</span>
                        <span>{{ $row->mark_in_at?->format('H:i') ?? '—' }} → {{ $row->mark_out_at?->format('H:i') ?? '—' }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted small">No records yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', async function () {
    const video = document.getElementById('markVideo');
    const statusEl = document.getElementById('markStatus');
    const markInBtn = document.getElementById('markInBtn');
    const markOutBtn = document.getElementById('markOutBtn');
    const MODEL_URL = 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/';
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

    let modelsLoaded = false;
    let currentPosition = null;

    function setStatus(msg, type = 'secondary') {
        statusEl.className = 'alert alert-' + type + ' small text-start';
        statusEl.textContent = msg;
    }

    async function loadModels() {
        await Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
            faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
            faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL),
        ]);
        modelsLoaded = true;
    }

    function getLocation() {
        return new Promise((resolve, reject) => {
            if (!navigator.geolocation) return reject(new Error('Geolocation not supported'));
            navigator.geolocation.getCurrentPosition(resolve, reject, { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 });
        });
    }

    async function startCamera() {
        const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
        video.srcObject = stream;
    }

    async function submitMark(action) {
        if (!modelsLoaded) return;
        markInBtn.disabled = true;
        markOutBtn.disabled = true;
        setStatus('Verifying face and location...', 'warning');

        try {
            const position = await getLocation();
            currentPosition = position;

            const detection = await faceapi
                .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions({ inputSize: 416, scoreThreshold: 0.5 }))
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (!detection) {
                setStatus('No face detected. Face the camera in good lighting.', 'danger');
                return;
            }

            const res = await fetch('{{ route('staff-attendance.mark.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    action: action,
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude,
                    face_descriptor: JSON.stringify(Array.from(detection.descriptor)),
                }),
            });

            const data = await res.json();
            if (data.success) {
                setStatus(data.message, 'success');
                setTimeout(() => location.reload(), 1200);
            } else {
                setStatus(data.message || 'Failed to mark attendance.', 'danger');
            }
        } catch (e) {
            setStatus(e.message || 'Could not get GPS location. Enable location services.', 'danger');
        } finally {
            markInBtn.disabled = {{ $today->mark_in_at ? 'true' : 'false' }};
            markOutBtn.disabled = {{ (!$today->mark_in_at || $today->mark_out_at) ? 'true' : 'false' }};
        }
    }

    markInBtn?.addEventListener('click', () => submitMark('mark_in'));
    markOutBtn?.addEventListener('click', () => submitMark('mark_out'));

    try {
        await loadModels();
        await startCamera();
        setStatus('Ready. Allow location when prompted, then tap Mark IN or Mark OUT.', 'info');
    } catch (e) {
        setStatus('Setup failed: ' + e.message, 'danger');
    }
});
</script>
@endpush
