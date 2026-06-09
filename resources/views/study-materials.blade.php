@extends('layouts.admin')

@section('title', 'Study Materials')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Card -->
    <div class="card border-0 mb-4 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-8">
                    <h4 class="fw-bold mb-1"><i class="fas fa-folder-open text-success me-2"></i> Study Materials Library</h4>
                    <p class="text-muted mb-0 small">Upload, categorize, and distribute digital coursework, notes, slides, and reference resources to academic batches.</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadMaterialModal">
                        <i class="fas fa-plus me-1"></i> Upload Material
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-3.5 d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(37,99,235,0.08); color: #2563EB; font-size: 1.25rem;">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">{{ $totalFiles }}</h4>
                        <span class="text-muted small">Total Files</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-3.5 d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(16,185,129,0.08); color: #10B981; font-size: 1.25rem;">
                        <i class="fas fa-hdd"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">{{ $formattedStorage }}</h4>
                        <span class="text-muted small">Storage Used</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-3.5 d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(245,158,11,0.08); color: #F59E0B; font-size: 1.25rem;">
                        <i class="fas fa-cloud-download-alt"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">{{ $totalDownloads }}</h4>
                        <span class="text-muted small">Total Downloads</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-body p-3.5 d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(139,92,246,0.08); color: #8B5CF6; font-size: 1.25rem;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">{{ $totalBatches }}</h4>
                        <span class="text-muted small">Active Batches</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
        <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger bg-white border border-danger border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li><i class="fas fa-exclamation-circle text-danger me-2"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-header bg-transparent border-0 p-4 pb-0">
            <form action="{{ route('study-materials.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-3">
                    <h5 class="fw-bold mb-0">Active Materials</h5>
                </div>
                <div class="col-md-9 d-flex flex-wrap gap-2 justify-content-md-end">
                    <div style="min-width: 150px;">
                        <select name="batch_id" class="form-select border-0 bg-light rounded-pill" onchange="this.form.submit()">
                            <option value="">All Batches</option>
                            @foreach($batches as $b)
                                <option value="{{ $b->id }}" {{ request('batch_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="min-width: 150px;">
                        <select name="subject_id" class="form-select border-0 bg-light rounded-pill" onchange="this.form.submit()">
                            <option value="">All Subjects</option>
                            @foreach($subjects as $s)
                                <option value="{{ $s->id }}" {{ request('subject_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group" style="max-width: 250px;">
                        <span class="input-group-text border-0 bg-light rounded-start-pill"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-0 bg-light rounded-end-pill" placeholder="Search title..." value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill px-3 shadow-sm">Filter</button>
                    @if(request()->anyFilled(['batch_id', 'subject_id', 'search']))
                        <a href="{{ route('study-materials.index') }}" class="btn btn-outline-secondary rounded-pill px-3">Clear</a>
                    @endif
                </div>
            </form>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Resource Name</th>
                            <th>Subject</th>
                            <th>Batch</th>
                            <th>Uploaded By</th>
                            <th>Upload Date</th>
                            <th>Size</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $iconMap = [
                                'pdf' => 'fa-file-pdf text-danger',
                                'doc' => 'fa-file-word text-primary',
                                'docx' => 'fa-file-word text-primary',
                                'xls' => 'fa-file-excel text-success',
                                'xlsx' => 'fa-file-excel text-success',
                                'ppt' => 'fa-file-powerpoint text-warning',
                                'pptx' => 'fa-file-powerpoint text-warning',
                                'jpg' => 'fa-file-image text-info',
                                'jpeg' => 'fa-file-image text-info',
                                'png' => 'fa-file-image text-info',
                                'mp4' => 'fa-file-video text-info',
                                'zip' => 'fa-file-archive text-secondary',
                            ];
                        @endphp
                        @forelse($studyMaterials as $material)
                            @php
                                $ext = strtolower($material->file_type);
                                $iconClass = $iconMap[$ext] ?? 'fa-file text-secondary';
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="fs-3"><i class="far {{ $iconClass }}"></i></div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $material->title }}</div>
                                            @if($material->description)
                                                <div class="text-muted small">{{ $material->description }}</div>
                                            @endif
                                            <div class="text-muted" style="font-size: 0.7rem;">File: {{ $material->file_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5">{{ $material->subject->name ?? 'N/A' }}</span></td>
                                <td><span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5">{{ $material->batch->name ?? 'N/A' }}</span></td>
                                <td>{{ $material->uploader->name ?? 'Unknown' }}</td>
                                <td>{{ $material->created_at->format('M d, Y') }}</td>
                                <td>{{ $material->formatted_file_size }}</td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('study-materials.download', $material) }}" class="btn btn-sm btn-light border" title="Download"><i class="fas fa-download"></i></a>
                                        <form action="{{ route('study-materials.destroy', $material) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this study material?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                        <i class="fas fa-folder-open fa-2x"></i>
                                    </div>
                                    <h6 class="fw-medium text-dark">No study materials found</h6>
                                    <p class="text-muted small mb-0">Upload study materials to distribute to students.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($studyMaterials instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                <div class="mt-4">
                    {{ $studyMaterials->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Upload Modal -->
<div class="modal fade" id="uploadMaterialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Upload Study Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('study-materials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Material Title</label>
                        <input type="text" name="title" class="form-control rounded-3" placeholder="e.g. Integral Calculus Notes" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Brief summary of the document contents"></textarea>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">Target Batch</label>
                            <select name="batch_id" class="form-select rounded-3" required>
                                <option value="">Select Batch</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">Subject</label>
                            <select name="subject_id" class="form-select rounded-3" required>
                                <option value="">Select Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" data-batch-id="{{ $subject->batch_id ?? '' }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-secondary">Select Coursework File</label>
                        <input type="file" name="file" class="form-control rounded-3" required>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 gap-2">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Upload File</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('uploadMaterialModal');
    if (!modal) return;

    const batchSelect = modal.querySelector('select[name="batch_id"]');
    const subjectSelect = modal.querySelector('select[name="subject_id"]');

    if (batchSelect && subjectSelect) {
        // Keep a reference to the original options list (excluding placeholder)
        const originalSubjects = Array.from(subjectSelect.options).map(opt => ({
            value: opt.value,
            text: opt.text,
            batchId: opt.getAttribute('data-batch-id') || ''
        }));

        function updateSubjects() {
            const selectedBatchId = batchSelect.value;
            
            // Clear current options
            subjectSelect.innerHTML = '';

            originalSubjects.forEach(opt => {
                // Always add the placeholder
                if (opt.value === '') {
                    const newOpt = document.createElement('option');
                    newOpt.value = '';
                    newOpt.text = opt.text;
                    subjectSelect.appendChild(newOpt);
                    return;
                }

                // Show option if:
                // - No batch is selected (show all)
                // - The option matches the selected batch
                // - The option is not associated with any batch (global/general subject)
                if (!selectedBatchId || opt.batchId === selectedBatchId || opt.batchId === '') {
                    const newOpt = document.createElement('option');
                    newOpt.value = opt.value;
                    newOpt.text = opt.text;
                    newOpt.setAttribute('data-batch-id', opt.batchId);
                    subjectSelect.appendChild(newOpt);
                }
            });
        }

        // Initialize filtering
        updateSubjects();

        // Listen for changes
        batchSelect.addEventListener('change', function () {
            updateSubjects();
            // Reset selection to placeholder
            subjectSelect.value = '';
        });
    }
});
</script>
@endpush
