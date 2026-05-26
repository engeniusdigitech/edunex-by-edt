@props(['required' => true, 'existingFaceUrl' => null])

<div class="face-capture-widget border rounded-4 p-4 bg-light" id="faceCaptureWidget">
    <h6 class="fw-bold mb-2"><i class="fas fa-user-check text-primary me-2"></i>Face Enrollment (Biometric)</h6>
    <p class="small text-muted mb-3">Position your face in the camera. This profile is used for secure mark-in / mark-out attendance.</p>

    @if($existingFaceUrl)
        <div class="mb-3 d-flex align-items-center gap-3">
            <img src="{{ $existingFaceUrl }}" alt="Enrolled face" class="rounded-circle border" width="64" height="64" style="object-fit:cover;">
            <span class="badge bg-success"><i class="fas fa-check me-1"></i> Face enrolled — capture again to update</span>
        </div>
    @endif

    <div class="row g-3 align-items-start">
        <div class="col-md-6">
            <div class="position-relative bg-dark rounded-4 overflow-hidden" style="aspect-ratio:4/3;">
                <video id="faceVideo" autoplay muted playsinline class="w-100 h-100" style="object-fit:cover;transform:scaleX(-1);"></video>
                <canvas id="faceOverlay" class="position-absolute top-0 start-0 w-100 h-100" style="transform:scaleX(-1);"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div id="faceStatus" class="alert alert-secondary small mb-3 py-2">Loading face recognition models...</div>
            <button type="button" id="captureFaceBtn" class="btn btn-primary w-100" disabled>
                <i class="fas fa-camera me-2"></i> Capture & Verify Face
            </button>
            <input type="hidden" name="face_descriptor" id="faceDescriptorInput" value="{{ old('face_descriptor') }}">
            <input type="hidden" name="face_snapshot" id="faceSnapshotInput">
            @if($required)
                <small class="text-danger d-block mt-2">* Face capture is required for staff registration.</small>
            @endif
        </div>
    </div>
</div>

@once
@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', async function () {
    const video = document.getElementById('faceVideo');
    const overlay = document.getElementById('faceOverlay');
    const statusEl = document.getElementById('faceStatus');
    const captureBtn = document.getElementById('captureFaceBtn');
    const descriptorInput = document.getElementById('faceDescriptorInput');
    const snapshotInput = document.getElementById('faceSnapshotInput');
    const form = document.querySelector('form');

    if (!video || typeof faceapi === 'undefined') return;

    const MODEL_URL = 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/';
    let modelsLoaded = false;
    let stream = null;

    async function loadModels() {
        try {
            await Promise.all([
                faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
                faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL),
            ]);
            modelsLoaded = true;
            statusEl.className = 'alert alert-info small mb-3 py-2';
            statusEl.textContent = 'Models loaded. Allow camera access to continue.';
            captureBtn.disabled = false;
        } catch (e) {
            statusEl.className = 'alert alert-danger small mb-3 py-2';
            statusEl.textContent = 'Failed to load face models. Check your internet connection.';
        }
    }

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user', width: 640, height: 480 } });
            video.srcObject = stream;
            statusEl.className = 'alert alert-success small mb-3 py-2';
            statusEl.textContent = 'Camera ready. Look at the camera and click Capture.';
        } catch (e) {
            statusEl.className = 'alert alert-danger small mb-3 py-2';
            statusEl.textContent = 'Camera access denied. Please allow camera permission.';
            captureBtn.disabled = true;
        }
    }

    captureBtn?.addEventListener('click', async function () {
        if (!modelsLoaded) return;
        captureBtn.disabled = true;
        statusEl.className = 'alert alert-warning small mb-3 py-2';
        statusEl.textContent = 'Detecting face...';

        const detection = await faceapi
            .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions({ inputSize: 416, scoreThreshold: 0.5 }))
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (!detection) {
            statusEl.className = 'alert alert-danger small mb-3 py-2';
            statusEl.textContent = 'No face detected. Ensure good lighting and face the camera directly.';
            captureBtn.disabled = false;
            return;
        }

        const descriptor = Array.from(detection.descriptor);
        descriptorInput.value = JSON.stringify(descriptor);

        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.translate(canvas.width, 0);
        ctx.scale(-1, 1);
        ctx.drawImage(video, 0, 0);
        snapshotInput.value = canvas.toDataURL('image/jpeg', 0.85);

        statusEl.className = 'alert alert-success small mb-3 py-2';
        statusEl.innerHTML = '<i class="fas fa-check-circle me-1"></i> Face captured successfully. You can submit the form.';
        captureBtn.disabled = false;
        captureBtn.innerHTML = '<i class="fas fa-redo me-2"></i> Re-capture Face';
    });

    form?.addEventListener('submit', function (e) {
        const required = {{ $required ? 'true' : 'false' }};
        if (required && !descriptorInput.value) {
            e.preventDefault();
            statusEl.className = 'alert alert-danger small mb-3 py-2';
            statusEl.textContent = 'Please capture your face before submitting.';
        }
    });

    await loadModels();
    await startCamera();

    window.addEventListener('beforeunload', () => {
        if (stream) stream.getTracks().forEach(t => t.stop());
    });
});
</script>
@endpush
@endonce
