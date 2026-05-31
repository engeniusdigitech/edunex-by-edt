@extends('student.layouts.app')

@section('title', 'Institute Gallery')

@push('styles')
<style>
    .gallery-masonry {
        column-count: 1;
        column-gap: 1.5rem;
    }
    
    @media (min-width: 576px) { .gallery-masonry { column-count: 2; } }
    @media (min-width: 992px) { .gallery-masonry { column-count: 3; } }
    
    .gallery-item {
        break-inside: avoid;
        margin-bottom: 1.5rem;
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px -4px rgba(37, 99, 235, 0.08);
        border: 1px solid #E2E8F0;
        transition: transform 0.3s;
    }

    .gallery-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -8px rgba(37, 99, 235, 0.15);
    }

    .gallery-media {
        width: 100%;
        display: block;
    }

    .gallery-caption {
        padding: 16px;
    }

    .gallery-caption-text {
        font-weight: 500;
        color: #0F172A;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .gallery-meta {
        font-size: 0.75rem;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 12px;
    }
</style>
@endpush

@section('content')
<div class="mb-5 text-center">
    <h3 class="fw-bold mb-2">Image Gallery</h3>
    <p class="text-muted">Explore moments and events from the institute.</p>
</div>

@if($media->isEmpty())
    <div class="text-center py-5 bg-white rounded-4 border">
        <i class="fas fa-camera-retro fa-4x text-muted opacity-25 mb-4"></i>
        <h5 class="fw-medium text-muted">No Media Yet</h5>
        <p class="text-muted mb-0">The administration hasn't uploaded any photos or videos.</p>
    </div>
@else
    <div class="gallery-masonry">
        @foreach($media as $item)
            <div class="gallery-item">
                @if($item->file_type === 'video')
                    <video class="gallery-media" controls>
                        <source src="{{ Storage::url($item->file_path) }}" type="video/mp4">
                    </video>
                @else
                    <img src="{{ Storage::url($item->file_path) }}" class="gallery-media" alt="Gallery Image">
                @endif
                
                <div class="gallery-caption">
                    @if($item->caption)
                        <div class="gallery-caption-text">{{ $item->caption }}</div>
                    @endif
                    <div class="gallery-meta">
                        <span><i class="far fa-calendar-alt"></i> {{ $item->created_at->format('d M Y') }}</span>
                        @if($item->uploader)
                            <span><i class="fas fa-user-circle"></i> {{ $item->uploader->name }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($media->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $media->links() }}
        </div>
    @endif
@endif
@endsection
