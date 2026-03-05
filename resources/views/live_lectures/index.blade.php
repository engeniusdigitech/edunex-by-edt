@extends('layouts.admin')

@section('title', 'Live Lectures')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Live Lectures</h4>
    <a href="{{ route('live-lectures.create') }}" class="btn btn-primary-glow btn-modern">
        <i class="fas fa-plus me-2"></i> Upload Lecture
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light bg-opacity-50">
                <tr>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Subject / Title</th>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Batch</th>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Recorded Date</th>
                    <th class="border-0 px-4 py-3 text-end text-muted fw-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lectures as $lecture)
                <tr>
                    <td class="px-4 py-3">
                        <div class="fw-bold text-dark">{{ $lecture->title }}</div>
                        <div class="small text-muted text-truncate" style="max-width: 250px;">{{ $lecture->subject }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 rounded-pill border border-primary border-opacity-25">
                            {{ $lecture->batch->name }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="text-dark fw-medium">{{ $lecture->recorded_at->format('d M, Y') }}</span>
                    </td>
                    <td class="px-4 py-3 text-end">
                        <div class="btn-group border rounded-pill overflow-hidden shadow-sm">
                            <a href="{{ Storage::disk('public')->url($lecture->video_path) }}" target="_blank" class="btn btn-sm btn-light py-2 px-3 text-primary hover-primary" title="Watch">
                                <i class="fas fa-play"></i>
                            </a>
                            <a href="{{ route('live-lectures.edit', $lecture) }}" class="btn btn-sm btn-light py-2 px-3 text-secondary hover-primary border-start" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('live-lectures.destroy', $lecture) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Are you sure you want to delete this lecture? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light py-2 px-3 text-danger hover-danger border-start" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <div class="text-muted mb-3">
                            <i class="fas fa-video fs-1 opacity-25"></i>
                        </div>
                        <h5 class="fw-semibold text-dark mb-1">No Lectures Uploaded</h5>
                        <p class="text-secondary small mb-3">Upload your first live lecture recording for your students.</p>
                        <a href="{{ route('live-lectures.create') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">Upload Lecture</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-top">
        {{ $lectures->links() }}
    </div>
</div>
@endsection
