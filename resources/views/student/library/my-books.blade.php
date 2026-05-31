@extends('student.layouts.app')

@section('title', 'My Books')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">My Borrowed Books</h4>
        <a href="{{ route('student.library.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Back to Library
        </a>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-muted fw-semibold text-uppercase small px-4 py-3">Book</th>
                                <th class="text-muted fw-semibold text-uppercase small py-3">Issue Date</th>
                                <th class="text-muted fw-semibold text-uppercase small py-3">Due Date</th>
                                <th class="text-muted fw-semibold text-uppercase small py-3">Status</th>
                                <th class="text-muted fw-semibold text-uppercase small px-4 py-3">Fine (if overdue)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($issues as $issue)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ $issue->book->cover_image_url }}" alt="Cover" class="rounded object-fit-cover" style="width: 48px; height: 64px;">
                                            <div>
                                                <h6 class="mb-1 fw-bold text-dark">{{ $issue->book->title }}</h6>
                                                <span class="text-muted small">ISBN: {{ $issue->book->isbn ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">{{ $issue->issue_date->format('M d, Y') }}</td>
                                    <td class="py-3">
                                        <span class="{{ $issue->is_overdue ? 'text-danger fw-bold' : 'text-dark' }}">
                                            {{ $issue->due_date->format('M d, Y') }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        @if($issue->is_overdue)
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                                                Overdue ({{ $issue->days_overdue }} days)
                                            </span>
                                        @else
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                                Issued
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($issue->is_overdue)
                                            <span class="text-danger fw-bold">{{ currencySymbol() }}{{ $issue->calculated_fine }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-book-reader fs-2 mb-3 opacity-50"></i>
                                            <h5>No Active Books</h5>
                                            <p class="mb-0">You don't have any books currently issued.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
