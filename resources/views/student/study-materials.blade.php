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
        <a href="{{ route('student.study-materials.index') }}" class="btn {{ !request('subject_id') ? 'btn-primary shadow-sm' : 'btn-outline-primary' }} rounded-pill px-3.5 btn-sm">All Subjects</a>
        @foreach($subjects as $subject)
            <a href="{{ route('student.study-materials.index', ['subject_id' => $subject->id]) }}" class="btn {{ request('subject_id') == $subject->id ? 'btn-primary shadow-sm' : 'btn-outline-primary' }} rounded-pill px-3.5 btn-sm">{{ $subject->name }}</a>
        @endforeach
    </div>

    <!-- Materials Grid -->
    <div class="row g-3">
        @forelse($studyMaterials as $material)
            @php
                $ext = strtoupper($material->file_type);
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; background: #ffffff;">
                    <div class="card-body p-3.5 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5" style="font-size:0.65rem;">{{ $material->subject->name ?? 'N/A' }}</span>
                                <small class="text-muted">{{ $material->formatted_file_size }} · {{ $ext }}</small>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">{{ $material->title }}</h6>
                            @if($material->description)
                                <p class="text-muted small mb-3">{{ $material->description }}</p>
                            @else
                                <p class="text-muted small mb-3">No description provided.</p>
                            @endif
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-3 border-top" style="border-color: #E2E8F0 !important;">
                            <div class="small">
                                <span class="text-secondary fw-semibold">{{ $material->uploader->name ?? 'Unknown' }}</span>
                                <div class="text-muted" style="font-size: 0.65rem;">Uploaded {{ $material->created_at->format('M d, Y') }}</div>
                            </div>
                            <a href="{{ route('student.study-materials.download', $material) }}" class="btn btn-sm btn-outline-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:32px; height:32px;" title="Download File">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                    <i class="fas fa-folder-open fa-2x"></i>
                </div>
                <h6 class="fw-medium text-dark">No study materials found</h6>
                <p class="text-muted small mb-0">Check back later for documents uploaded by your teachers.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
