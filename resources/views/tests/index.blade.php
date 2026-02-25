@extends('layouts.admin')

@section('title', 'Tests & Exams')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Tests & Exams</h4>
    <a href="{{ route('tests.create') }}" class="btn btn-primary-glow btn-modern">
        <i class="fas fa-plus me-2"></i> Schedule Test
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
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Test Title</th>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Batch</th>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Test Date</th>
                    <th class="border-0 px-4 py-3 text-muted fw-semibold">Total Marks</th>
                    <th class="border-0 px-4 py-3 text-center text-muted fw-semibold">Manage Marks</th>
                    <th class="border-0 px-4 py-3 text-end text-muted fw-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tests as $test)
                <tr>
                    <td class="px-4 py-3">
                        <div class="fw-bold text-dark">{{ $test->title }}</div>
                        @if($test->description)
                            <div class="small text-muted text-truncate" style="max-width: 250px;">{{ $test->description }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary py-2 px-3 rounded-pill border border-secondary border-opacity-25">
                            {{ $test->batch->name }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if($test->test_date > now()->startOfDay())
                            <span class="text-primary fw-semibold"><i class="fas fa-calendar-day me-1"></i> {{ $test->test_date->format('d M, Y') }}</span>
                        @else
                            <span class="text-dark fw-medium">{{ $test->test_date->format('d M, Y') }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 fw-bold text-dark">
                        {{ $test->total_marks }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('tests.marks', $test) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
                            <i class="fas fa-tasks me-1"></i> Enter Marks
                        </a>
                    </td>
                    <td class="px-4 py-3 text-end">
                        <div class="btn-group border rounded-pill overflow-hidden shadow-sm">
                            <a href="{{ route('tests.edit', $test) }}" class="btn btn-sm btn-light py-2 px-3 text-secondary hover-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tests.destroy', $test) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Are you sure you want to delete this test? All associated student scores will also be deleted.');">
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
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted mb-3">
                            <i class="fas fa-file-signature fs-1 opacity-25"></i>
                        </div>
                        <h5 class="fw-semibold text-dark mb-1">No Tests Scheduled</h5>
                        <p class="text-secondary small mb-3">Create your first test to evaluate student performance.</p>
                        <a href="{{ route('tests.create') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">Schedule Test</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
