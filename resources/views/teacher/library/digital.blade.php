@extends('layouts.admin')

@section('title', 'Digital Library')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Digital Library</h4>
</div>

<!-- Filter Bar -->
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('teacher.library.digital') }}" class="row g-2 align-items-end">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search resources..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select">
                    <option value="">All File Types</option>
                    <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                    <option value="docx" {{ request('type') == 'docx' ? 'selected' : '' }}>Word</option>
                    <option value="ppt" {{ request('type') == 'ppt' ? 'selected' : '' }}>PowerPoint</option>
                    <option value="epub" {{ request('type') == 'epub' ? 'selected' : '' }}>ePub</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary btn-sm flex-fill">Search</button>
                <a href="{{ route('teacher.library.digital') }}" class="btn btn-outline-secondary btn-sm flex-fill">Clear</a>
            </div>
        </form>
    </div>
</div>

<!-- Grid -->
<div class="row g-4">
    @forelse($resources as $resource)
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column text-center">
                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle" style="width: 64px; height: 64px; background: #F8FAFC;">
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
                    <h6 class="fw-bold text-dark mb-1" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $resource->title }}</h6>
                    <p class="small text-muted mb-3">{{ $resource->formatted_file_size }} • {{ strtoupper($resource->file_type) }}</p>
                    
                    @if($resource->description)
                        <p class="small text-muted text-start mb-4" style="display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">{{ $resource->description }}</p>
                    @endif

                    <div class="mt-auto pt-3 border-top d-flex gap-2">
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
        <div class="col-12 text-center py-5">
            <div class="text-muted">
                <i class="fas fa-folder-open fs-1 mb-3 opacity-25"></i>
                <h5>No Resources Found</h5>
                <p>Try adjusting your search filters.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $resources->withQueryString()->links() }}
</div>
@endsection
