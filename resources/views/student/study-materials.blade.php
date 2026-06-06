@extends('student.layouts.app')

@section('title', 'Study Materials')

@section('content')
<div class="container-fluid px-0 py-2">
    <!-- Header Block -->
    <div class="card border-0 mb-4 shadow-sm" style="border-radius: 16px;">
        <div class="card-body p-4" style="background: #ffffff; border-radius: 16px;">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-9">
                    <h4 class="fw-bold mb-1 text-dark"><i class="fas fa-folder-open text-success me-2"></i> Study Materials</h4>
                    <p class="text-muted mb-0 small">Access slide decks, revision notes, experiment guidelines, and reference files uploaded by your class teachers.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button class="btn btn-primary rounded-pill px-3.5 btn-sm shadow-sm">All Subjects</button>
        <button class="btn btn-outline-primary rounded-pill px-3.5 btn-sm">Physics</button>
        <button class="btn btn-outline-primary rounded-pill px-3.5 btn-sm">Chemistry</button>
        <button class="btn btn-outline-primary rounded-pill px-3.5 btn-sm">Mathematics</button>
        <button class="btn btn-outline-primary rounded-pill px-3.5 btn-sm">English</button>
    </div>

    <!-- Materials Grid -->
    <div class="row g-3">
        <!-- Card 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: #ffffff;">
                <div class="card-body p-3.5 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5" style="font-size:0.65rem;">Physics</span>
                            <small class="text-muted">4.2 MB · PDF</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">JEE Physics Formula Sheets.pdf</h6>
                        <p class="text-muted small mb-3">Formula recap and revision notes for Mechanics and Electromagnetism blocks.</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-3 border-top" style="border-color: #E2E8F0 !important;">
                        <div class="small">
                            <span class="text-secondary fw-semibold">Dr. Ramesh Verma</span>
                            <div class="text-muted" style="font-size: 0.65rem;">Uploaded June 04, 2026</div>
                        </div>
                        <button onclick="alert('Simulated download initiated!');" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:32px; height:32px;" title="Download File">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: #ffffff;">
                <div class="card-body p-3.5 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5" style="font-size:0.65rem;">Chemistry</span>
                            <small class="text-muted">12.8 MB · DOCX</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Organic Chemistry Lab Manual v2.docx</h6>
                        <p class="text-muted small mb-3">Detailed laboratory guidelines, protocols, and experiments schedules for term examinations.</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-3 border-top" style="border-color: #E2E8F0 !important;">
                        <div class="small">
                            <span class="text-secondary fw-semibold">Prof. Nisha Sharma</span>
                            <div class="text-muted" style="font-size: 0.65rem;">Uploaded June 02, 2026</div>
                        </div>
                        <button onclick="alert('Simulated download initiated!');" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:32px; height:32px;" title="Download File">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: #ffffff;">
                <div class="card-body p-3.5 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5" style="font-size:0.65rem;">Mathematics</span>
                            <small class="text-muted">18.4 MB · PPTX</small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Calculus Introduction Slides.pptx</h6>
                        <p class="text-muted small mb-3">Course presentation slides covering Calculus Limits and Integration rules.</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-3 border-top" style="border-color: #E2E8F0 !important;">
                        <div class="small">
                            <span class="text-secondary fw-semibold">Dean Ramesh</span>
                            <div class="text-muted" style="font-size: 0.65rem;">Uploaded May 28, 2026</div>
                        </div>
                        <button onclick="alert('Simulated download initiated!');" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:32px; height:32px;" title="Download File">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
