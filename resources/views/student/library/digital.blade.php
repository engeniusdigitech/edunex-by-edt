@extends('student.layouts.app')

@section('title', 'Digital Library')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Digital Library</h4>
    </div>

    <!-- Search & Filter -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('student.library.digital') }}" method="GET" class="row g-2 align-items-end">
                <div class="col-md-7">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search digital resources..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDF Documents</option>
                        <option value="docx" {{ request('type') == 'docx' ? 'selected' : '' }}>Word Documents</option>
                        <option value="ppt" {{ request('type') == 'ppt' ? 'selected' : '' }}>Presentations</option>
                        <option value="epub" {{ request('type') == 'epub' ? 'selected' : '' }}>eBooks (ePub)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Grid -->
    <div class="row g-4">
        @forelse($resources as $resource)
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 digital-card">
                    <div class="card-body p-4 d-flex flex-column text-center">
                        <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 64px; height: 64px; background: #F8FAFC;">
                            @if($resource->file_type === 'pdf')
                                <i class="fas fa-file-pdf fs-2 text-danger"></i>
                            @elseif($resource->file_type === 'docx')
                                <i class="fas fa-file-word fs-2 text-primary"></i>
                            @elseif($resource->file_type === 'ppt')
                                <i class="fas fa-file-powerpoint fs-2 text-warning"></i>
                            @elseif($resource->file_type === 'epub')
                                <i class="fas fa-book fs-2 text-success"></i>
                            @else
                                <i class="fas fa-file-alt fs-2 text-secondary"></i>
                            @endif
                        </div>
                        <h6 class="fw-bold text-dark mb-1 line-clamp-2">{{ $resource->title }}</h6>
                        <p class="small text-muted mb-3">{{ $resource->formatted_file_size }} • {{ strtoupper($resource->file_type) }}</p>
                        
                        @if($resource->description)
                            <p class="small text-muted text-start mb-4 line-clamp-3">{{ $resource->description }}</p>
                        @endif

                        <div class="mt-auto d-flex gap-2">
                            @if($resource->file_type === 'pdf')
                                <a href="{{ route('student.library.digital.preview', $resource) }}" target="_blank" class="btn btn-outline-primary btn-sm flex-fill rounded-pill">
                                    <i class="fas fa-eye me-1"></i> Preview
                                </a>
                            @endif
                            @if($resource->is_downloadable)
                                <a href="{{ route('student.library.digital.download', $resource) }}" class="btn btn-primary btn-sm flex-fill rounded-pill">
                                    <i class="fas fa-download me-1"></i> Download
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-folder-open fs-1 mb-3 opacity-50"></i>
                    <h5>No Digital Resources</h5>
                    <p>No resources found matching your search.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $resources->withQueryString()->links() }}
    </div>
</div>

<style>
    .digital-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .digital-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
