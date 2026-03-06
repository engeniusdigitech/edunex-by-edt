@extends('layouts.admin')

@section('title', 'Live Lectures')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Live Lectures</h4>
    <a href="{{ route('live-lectures.create') }}" class="btn btn-primary-glow btn-modern">
        <i class="fas fa-plus me-2"></i> Schedule Lecture
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
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Status</th>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Date</th>
                    <th class="border-0 px-4 py-3 text-end text-muted fw-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lectures as $lecture)
                <tr>
                    <td class="px-4 py-3">
                        <div class="fw-bold text-dark">{{ $lecture->title }}</div>
                        <div class="small text-muted">{{ $lecture->subject }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 rounded-pill border border-primary border-opacity-25">
                            {{ $lecture->batch->name }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if($lecture->status === 'live')
                            <span class="badge bg-danger rounded-pill px-3 py-2 fw-semibold">
                                <span class="me-1" style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#fff;animation:blink 1s infinite;"></span>
                                LIVE
                            </span>
                        @elseif($lecture->status === 'scheduled')
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-semibold">Scheduled</span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 fw-semibold">Ended</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-muted small fw-medium">
                        {{ $lecture->recorded_at ? $lecture->recorded_at->format('d M, Y') : '—' }}
                    </td>
                    <td class="px-4 py-3 text-end">
                        <div class="d-flex gap-2 justify-content-end flex-wrap">
                            @if($lecture->status === 'scheduled')
                                <form action="{{ route('live-lectures.start', $lecture) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-semibold shadow-sm">
                                        <i class="fas fa-broadcast-tower me-1"></i> Go Live
                                    </button>
                                </form>
                            @elseif($lecture->status === 'live')
                                <a href="{{ route('live-lectures.start', $lecture) }}" onclick="event.preventDefault(); document.getElementById('rejoin-{{ $lecture->id }}').submit();" class="btn btn-sm btn-warning text-dark rounded-pill px-3 fw-semibold shadow-sm">
                                    <i class="fas fa-sign-in-alt me-1"></i> Rejoin Room
                                </a>
                                <form id="rejoin-{{ $lecture->id }}" action="{{ route('live-lectures.start', $lecture) }}" method="POST" class="d-none">@csrf</form>
                                <form action="{{ route('live-lectures.end', $lecture) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 fw-semibold shadow-sm" onclick="return confirm('End this live session? Students will no longer be able to join.')">
                                        <i class="fas fa-stop-circle me-1"></i> End Lecture
                                    </button>
                                </form>
                            @endif

                            @if($lecture->status !== 'live')
                            <div class="btn-group border rounded-pill overflow-hidden shadow-sm">
                                <a href="{{ route('live-lectures.edit', $lecture) }}" class="btn btn-sm btn-light py-2 px-3 text-secondary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('live-lectures.destroy', $lecture) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Delete this lecture?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light py-2 px-3 text-danger border-start" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted mb-3">
                            <i class="fas fa-broadcast-tower fs-1 opacity-25"></i>
                        </div>
                        <h5 class="fw-semibold text-dark mb-1">No Lectures Scheduled</h5>
                        <p class="text-secondary small mb-3">Schedule your first live lecture to get started.</p>
                        <a href="{{ route('live-lectures.create') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">Schedule Now</a>
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

@push('styles')
<style>
@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.2; }
}
</style>
@endpush
