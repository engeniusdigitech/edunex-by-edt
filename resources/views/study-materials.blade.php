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
                        <h4 class="fw-bold mb-0">48</h4>
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
                        <h4 class="fw-bold mb-0">1.8 GB</h4>
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
                        <h4 class="fw-bold mb-0">342</h4>
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
                        <h4 class="fw-bold mb-0">12</h4>
                        <span class="text-muted small">Active Batches</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
        <div class="card-header bg-transparent border-0 p-4 pb-0">
            <div class="row g-3 align-items-center justify-content-between">
                <div class="col-md-4">
                    <h5 class="fw-bold mb-0">Active Materials</h5>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text border-0 bg-light"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-0 bg-light" placeholder="Search files, batches, or subjects...">
                    </div>
                </div>
            </div>
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
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="text-danger fs-3"><i class="far fa-file-pdf"></i></div>
                                    <div>
                                        <div class="fw-bold text-dark">JEE Physics Formula Sheets.pdf</div>
                                        <div class="text-muted small">Revision notes for Mechanics &amp; Electromagnetism</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5">Physics</span></td>
                            <td><span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5">JEE 2026 Batch A</span></td>
                            <td>Dr. Ramesh Verma</td>
                            <td>June 04, 2026</td>
                            <td>4.2 MB</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light border" title="Download"><i class="fas fa-download"></i></button>
                                    <button class="btn btn-sm btn-light border text-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="text-primary fs-3"><i class="far fa-file-word"></i></div>
                                    <div>
                                        <div class="fw-bold text-dark">Organic Chemistry Lab Manual v2.docx</div>
                                        <div class="text-muted small">Guidelines and protocols for laboratory experiments</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5">Chemistry</span></td>
                            <td><span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5">Grade 12-B</span></td>
                            <td>Prof. Nisha Sharma</td>
                            <td>June 02, 2026</td>
                            <td>12.8 MB</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light border" title="Download"><i class="fas fa-download"></i></button>
                                    <button class="btn btn-sm btn-light border text-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="text-warning fs-3"><i class="far fa-file-powerpoint"></i></div>
                                    <div>
                                        <div class="fw-bold text-dark">Calculus Introduction Slides.pptx</div>
                                        <div class="text-muted small">Course slides introducing Integration and Limits</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5">Mathematics</span></td>
                            <td><span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5">JEE 2026 Batch A</span></td>
                            <td>Dean Ramesh</td>
                            <td>May 28, 2026</td>
                            <td>18.4 MB</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light border" title="Download"><i class="fas fa-download"></i></button>
                                    <button class="btn btn-sm btn-light border text-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="text-info fs-3"><i class="far fa-file-video"></i></div>
                                    <div>
                                        <div class="fw-bold text-dark">English Grammar Lecture Reference.mp4</div>
                                        <div class="text-muted small">Video reference detailing active and passive voice constructions</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5">English</span></td>
                            <td><span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5">Grade 11-A</span></td>
                            <td>Mrs. Pooja Sen</td>
                            <td>May 22, 2026</td>
                            <td>45.2 MB</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light border" title="Download"><i class="fas fa-download"></i></button>
                                    <button class="btn btn-sm btn-light border text-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadMaterialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Upload Study Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="event.preventDefault(); alert('Simulated Upload: Study Material uploaded successfully!'); bootstrap.Modal.getInstance(document.getElementById('uploadMaterialModal')).hide();">
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Material Title</label>
                        <input type="text" class="form-control rounded-3" placeholder="e.g. Integral Calculus Notes" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Description</label>
                        <textarea class="form-control rounded-3" rows="3" placeholder="Brief summary of the document contents"></textarea>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">Subject</label>
                            <select class="form-select rounded-3" required>
                                <option value="">Select Subject</option>
                                <option>Physics</option>
                                <option>Chemistry</option>
                                <option>Mathematics</option>
                                <option>English</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-secondary">Target Batch</label>
                            <select class="form-select rounded-3" required>
                                <option value="">Select Batch</option>
                                <option>JEE 2026 Batch A</option>
                                <option>Grade 12-B</option>
                                <option>Grade 11-A</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-secondary">Select Coursework File</label>
                        <input type="file" class="form-control rounded-3" required>
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
