{{-- Biometric Attendance Modal --}}
{{-- Requires: $todayStaffAttendance passed from controller --}}

@php
    $isBioUser = isset($todayStaffAttendance) && $todayStaffAttendance !== null;
@endphp

@if($isBioUser)
@php
    $att    = $todayStaffAttendance ?? null;
    $faceOk = auth()->user()->hasFaceEnrolled();
    $canIn  = $att && !$att->mark_in_at  && $faceOk;
    $canOut = $att && $att->mark_in_at   && !$att->mark_out_at && $faceOk;
@endphp

{{-- Dashboard Card --}}
<div class="card border-0 mb-4" style="border-radius:16px;background:linear-gradient(135deg,#1e3a8a,#2563EB);box-shadow:0 8px 30px rgba(37,99,235,0.25);">
    <div class="card-body p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="text-white">
                <div class="fw-medium mb-1" style="font-size:1rem;"><i class="fas fa-fingerprint me-2 opacity-75"></i>My Attendance Today</div>
                <div class="d-flex gap-4 mt-2">
                    <div>
                        <div class="opacity-60" style="font-size:0.68rem;text-transform:uppercase;letter-spacing:1px;">Mark IN</div>
                        <div class="fw-medium" style="font-size:1rem;">{{ $att?->mark_in_at?->format('h:i A') ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="opacity-60" style="font-size:0.68rem;text-transform:uppercase;letter-spacing:1px;">Mark OUT</div>
                        <div class="fw-medium" style="font-size:1rem;">{{ $att?->mark_out_at?->format('h:i A') ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="opacity-60" style="font-size:0.68rem;text-transform:uppercase;letter-spacing:1px;">Status</div>
                        <div class="fw-medium" style="font-size:1rem;">{{ ucfirst($att?->status ?? 'absent') }}</div>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-light fw-medium px-4" style="border-radius:12px;"
                    onclick="openBioModal('mark_in')"
                    {{ ($att && $att->mark_in_at) ? 'disabled' : '' }}>
                    <i class="fas fa-sign-in-alt me-1 text-success"></i> Mark IN
                </button>
                <button class="btn btn-light fw-medium px-4" style="border-radius:12px;"
                    onclick="openBioModal('mark_out')"
                    {{ (!$att || !$att->mark_in_at || $att->mark_out_at) ? 'disabled' : '' }}>
                    <i class="fas fa-sign-out-alt me-1 text-danger"></i> Mark OUT
                </button>
            </div>
        </div>
        @if(!$faceOk)
            <div class="mt-3 text-white opacity-75 small"><i class="fas fa-exclamation-circle me-1"></i>Face not enrolled. Contact admin to register your face before using biometric attendance.</div>
        @endif
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="bioAttModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width:480px;">
        <div class="modal-content border-0 rounded-4 overflow-hidden">
            <div class="modal-header border-0 px-4 pt-4 pb-0">
                <h6 class="modal-title fw-medium" id="bioModalTitle">Face Verification</h6>
                <button type="button" class="btn-close" onclick="closeBioModal()"></button>
            </div>
            <div class="modal-body p-4">
                <div class="position-relative bg-dark rounded-3 overflow-hidden mb-3" style="aspect-ratio:4/3;">
                    <video id="bioVideo" autoplay muted playsinline class="w-100 h-100" style="object-fit:cover;transform:scaleX(-1);"></video>
                    <div id="bioOverlay" class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background:rgba(0,0,0,0.55);display:none!important;">
                        <div class="spinner-border text-white" role="status"></div>
                    </div>
                </div>
                <div id="bioStatus" class="alert alert-secondary small mb-3">Initializing camera and face models...</div>
                <div class="d-grid">
                    <button id="bioConfirmBtn" class="btn btn-primary btn-lg fw-medium rounded-3" disabled>
                        <i class="fas fa-camera me-2"></i><span id="bioConfirmLabel">Verify & Mark</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
<script>
(function () {
    const MODEL_URL = 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/';
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
    let modelsLoaded = false, videoStream = null, pendingAction = null;

    function setStatus(msg, type = 'secondary') {
        const el = document.getElementById('bioStatus');
        el.className = 'alert alert-' + type + ' small mb-3';
        el.textContent = msg;
    }

    async function ensureModels() {
        if (modelsLoaded) return;
        setStatus('Loading face models...', 'warning');
        await Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
            faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
            faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL),
        ]);
        modelsLoaded = true;
    }

    async function startCamera() {
        const video = document.getElementById('bioVideo');
        videoStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
        video.srcObject = videoStream;
        await new Promise(r => video.onloadedmetadata = r);
    }

    function stopCamera() {
        videoStream?.getTracks().forEach(t => t.stop());
        videoStream = null;
        document.getElementById('bioVideo').srcObject = null;
    }

    window.openBioModal = async function (action) {
        pendingAction = action;
        document.getElementById('bioModalTitle').textContent = action === 'mark_in' ? 'Mark IN — Face Verify' : 'Mark OUT — Face Verify';
        document.getElementById('bioConfirmLabel').textContent = action === 'mark_in' ? 'Verify & Mark IN' : 'Verify & Mark OUT';
        document.getElementById('bioConfirmBtn').disabled = true;
        setStatus('Initializing...', 'secondary');

        const modal = new bootstrap.Modal(document.getElementById('bioAttModal'));
        modal.show();

        try {
            await ensureModels();
            await startCamera();
            setStatus('Camera ready. Click the button to verify your face.', 'info');
            document.getElementById('bioConfirmBtn').disabled = false;
        } catch (e) {
            setStatus('Setup failed: ' + e.message, 'danger');
        }
    };

    window.closeBioModal = function () {
        stopCamera();
        bootstrap.Modal.getInstance(document.getElementById('bioAttModal'))?.hide();
    };

    document.getElementById('bioConfirmBtn')?.addEventListener('click', async function () {
        this.disabled = true;
        document.getElementById('bioOverlay').style.display = 'flex !important';
        setStatus('Detecting face and getting location...', 'warning');

        try {
            const position = await new Promise((res, rej) =>
                navigator.geolocation.getCurrentPosition(res, rej, { enableHighAccuracy: true, timeout: 15000 })
            );

            const video = document.getElementById('bioVideo');
            const detection = await faceapi
                .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions({ inputSize: 416, scoreThreshold: 0.5 }))
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (!detection) {
                setStatus('No face detected. Face the camera clearly in good lighting.', 'danger');
                this.disabled = false;
                return;
            }

            const res = await fetch('{{ route('staff-attendance.mark.store') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                body: JSON.stringify({
                    action: pendingAction,
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude,
                    face_descriptor: JSON.stringify(Array.from(detection.descriptor)),
                }),
            });

            const data = await res.json();
            if (data.success) {
                setStatus('✅ ' + data.message, 'success');
                stopCamera();
                setTimeout(() => { window.location.reload(); }, 1200);
            } else {
                setStatus('❌ ' + (data.message || 'Failed.'), 'danger');
                this.disabled = false;
            }
        } catch (e) {
            setStatus('Error: ' + (e.message || 'Could not get location. Enable GPS.'), 'danger');
            this.disabled = false;
        }
    });
})();
</script>
@endpush
@endif
