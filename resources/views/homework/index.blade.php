@extends('layouts.admin')

@section('title', 'Homework')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Homework Assignments</h4>
    <a href="{{ route('homework.create') }}" class="btn btn-primary-glow btn-modern">
        <i class="fas fa-plus me-2"></i> Assign Homework
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Filters -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
        <form action="{{ route('homework.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0" placeholder="Search by title..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <select name="batch_id" class="form-select bg-light border-0">
                    <option value="">All Batches</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="subject_id" class="form-select bg-light border-0">
                    <option value="">All Subjects</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 btn-modern">Filter</button>
                    @if(request()->anyFilled(['search', 'batch_id', 'subject_id']))
                        <a href="{{ route('homework.index') }}" class="btn btn-light border w-100 btn-modern">Clear</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light bg-opacity-50">
                <tr>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Subject / Title</th>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Batch</th>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Due Date</th>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Created On</th>
                    <th class="border-0 px-4 py-3 text-end text-muted fw-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($homeworks as $hw)
                <tr>
                    <td class="px-4 py-3">
                        <div class="mb-1">
                            @if($hw->subject)
                                <span class="badge bg-info bg-opacity-10 text-info border border-info-subtle">{{ $hw->subject->name }}</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle">General</span>
                            @endif
                        </div>
                        <div class="fw-bold text-dark">{{ $hw->title }}</div>
                        @if($hw->description)
                            <div class="small text-muted text-truncate" style="max-width: 250px;">{{ $hw->description }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 rounded-pill border border-primary border-opacity-25">
                            {{ $hw->batch->name }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if($hw->due_date < now()->startOfDay())
                            <span class="text-danger fw-semibold"><i class="fas fa-exclamation-circle me-1"></i> {{ $hw->due_date->format('d M, Y') }}</span>
                        @else
                            <span class="text-dark fw-medium">{{ $hw->due_date->format('d M, Y') }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-muted small">
                        {{ $hw->created_at->format('d M, Y') }}
                    </td>
                    <td class="px-4 py-3 text-end">
                        <div class="btn-group border rounded-pill overflow-hidden shadow-sm">
                            <a href="{{ route('homework.edit', $hw) }}" class="btn btn-sm btn-light py-2 px-3 text-secondary hover-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('homework.destroy', $hw) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Are you sure you want to delete this homework?');">
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
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted mb-3">
                            <i class="fas fa-book-open fs-1 opacity-25"></i>
                        </div>
                        <h5 class="fw-semibold text-dark mb-1">No Homework Assigned</h5>
                        <p class="text-secondary small mb-3">Create your first homework assignment to keep students engaged.</p>
                        <a href="{{ route('homework.create') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">Create Homework</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4 px-2">
    {{ $homeworks->links() }}
</div>
@endsection
