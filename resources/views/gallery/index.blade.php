@extends('layouts.admin')

@section('title', 'Image Gallery')

@push('styles')
<style>
    .gallery-card {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        background: #fff;
    }
    .gallery-card:hover {
        transform: translateY(-4px);
    }
    .gallery-media {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .gallery-caption {
        padding: 12px;
        font-size: 0.9rem;
        color: #334155;
    }
    .gallery-actions {
        position: absolute;
        top: 8px;
        right: 8px;
        opacity: 0;
        transition: opacity 0.2s;
    }
    .gallery-card:hover .gallery-actions {
        opacity: 1;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Image Gallery</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
        <i class="fas fa-upload me-2"></i> Upload Media
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="row g-4">
    @forelse($media as $item)
        <div class="col-md-4 col-lg-3">
            <div class="gallery-card">
                @if($item->file_type === 'video')
                    <video class="gallery-media" controls>
                        <source src="{{ Storage::url($item->file_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <img src="{{ Storage::url($item->file_path) }}" class="gallery-media" alt="{{ $item->caption }}">
                @endif
                
                <div class="gallery-caption">
                    <p class="mb-1 text-truncate">{{ $item->caption ?? 'No caption' }}</p>
                    <small class="text-muted"><i class="fas fa-user-circle me-1"></i> {{ $item->uploader->name ?? 'System' }}</small>
                </div>

                <div class="gallery-actions">
                    <form action="{{ route('gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this media?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger rounded-circle shadow-sm" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 bg-white rounded-3 border">
            <i class="fas fa-images fa-3x text-muted opacity-25 mb-3"></i>
            <h5 class="text-muted">Gallery is empty</h5>
            <p class="mb-0 text-muted small">Upload images or videos to share them with students.</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $media->links() }}
</div>

<!-- Upload Modal -->
@push('modals')
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold">Upload Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select File (Image or Video)</label>
                        <input type="file" name="file" class="form-control" required accept="image/*,video/*">
                        <small class="text-muted">Max file size: 20MB</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Caption (Optional)</label>
                        <input type="text" name="caption" class="form-control" placeholder="Brief description...">
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt me-2"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush
@endsection
