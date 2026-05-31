@extends('layouts.admin')
@section('title', 'Digital Library')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1" style="color: #1E293B; font-weight: 700;">Digital Resources</h4>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">Manage library e-books, documents, and media files</p>
        </div>
        <div>
            <a href="{{ route('library.digital-resources.create') }}" class="btn btn-primary btn-modern shadow-sm">
                <i class="fas fa-upload me-2"></i>Upload Resource
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
        <i class="fas fa-check-circle text-success fs-4"></i>
        <div><strong>Success!</strong> {{ session('success') }}</div>
    </div>
    @endif

    <!-- Filter Bar -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
        <div class="card-body p-3">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search resources..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select">
                        <option value="">All File Types</option>
                        <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDF Document</option>
                        <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="audio" {{ request('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                        <option value="archive" {{ request('type') == 'archive' ? 'selected' : '' }}>Archive (ZIP/RAR)</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-primary btn-sm px-3 shadow-sm">Filter</button>
                    <a href="{{ route('library.digital-resources.index') }}" class="btn btn-outline-secondary btn-sm px-3 shadow-sm">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Grid -->
    <div class="row g-4">
        @forelse($resources ?? [] as $resource)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(37,99,235,0.1);display:flex;align-items:center;justify-content:center;">
                            @if($resource->type == 'pdf')
                                <i class="fas fa-file-pdf fs-4" style="color:#DC2626;"></i>
                            @elseif($resource->type == 'video')
                                <i class="fas fa-file-video fs-4" style="color:#2563EB;"></i>
                            @elseif($resource->type == 'audio')
                                <i class="fas fa-file-audio fs-4" style="color:#10B981;"></i>
                            @else
                                <i class="fas fa-file fs-4" style="color:#64748B;"></i>
                            @endif
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm" style="border-radius: 12px;">
                                <li><a class="dropdown-item" href="{{ route('library.digital-resources.edit', $resource) }}"><i class="fas fa-edit me-2 text-primary"></i>Edit</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('library.digital-resources.destroy', $resource) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this resource?')">
                                        @csrf @method('DELETE')
                                        <button class="dropdown-item text-danger"><i class="fas fa-trash me-2"></i>Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <h5 class="mb-2 text-truncate" style="color:#1E293B;font-weight:600;" title="{{ $resource->title }}">{{ $resource->title }}</h5>
                    <p class="text-muted small mb-3 flex-grow-1" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $resource->description }}</p>
                    
                    <div class="d-flex flex-column gap-2 mb-3">
                        @if($resource->book)
                        <div class="d-flex align-items-center small text-muted">
                            <i class="fas fa-book me-2" style="width: 16px;"></i>
                            <span class="text-truncate">{{ $resource->book->title }}</span>
                        </div>
                        @endif
                        <div class="d-flex align-items-center small text-muted">
                            <i class="fas fa-hdd me-2" style="width: 16px;"></i>
                            <span>{{ number_format($resource->file_size / 1024 / 1024, 2) }} MB</span>
                        </div>
                        <div class="d-flex align-items-center small text-muted">
                            <i class="fas fa-download me-2" style="width: 16px;"></i>
                            <span>{{ $resource->download_count ?? 0 }} downloads</span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-auto">
                        @if($resource->is_downloadable)
                        <a href="{{ route('library.digital-resources.download', $resource) }}" class="btn btn-primary btn-sm flex-grow-1 shadow-sm" style="border-radius:8px;">
                            <i class="fas fa-download me-1"></i> Download
                        </a>
                        @endif
                        <a href="{{ route('library.digital-resources.preview', $resource) }}" class="btn btn-outline-primary btn-sm flex-grow-1 shadow-sm" style="border-radius:8px;" target="_blank">
                            <i class="fas fa-eye me-1"></i> Preview
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <div class="mb-3">
                    <div style="width:80px;height:80px;border-radius:20px;background:rgba(37,99,235,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto;">
                        <i class="fas fa-cloud-upload-alt" style="font-size:2rem;color:#2563EB;"></i>
                    </div>
                </div>
                <h5 style="color:#1E293B;font-weight:600;">No Digital Resources Found</h5>
                <p class="text-muted mb-4">Get started by uploading e-books or media files.</p>
                <a href="{{ route('library.digital-resources.create') }}" class="btn btn-primary btn-modern shadow-sm">
                    <i class="fas fa-plus me-2"></i>Upload Resource
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($resources) && $resources->hasPages())
    <div class="d-flex justify-content-end mt-4">
        {{ $resources->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
