@extends('student.layouts.app')

@section('title', 'Borrowing History')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Borrowing History</h4>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-muted fw-semibold text-uppercase small px-4 py-3">Book</th>
                        <th class="text-muted fw-semibold text-uppercase small py-3">Issue Date</th>
                        <th class="text-muted fw-semibold text-uppercase small py-3">Due Date</th>
                        <th class="text-muted fw-semibold text-uppercase small py-3">Return Date</th>
                        <th class="text-muted fw-semibold text-uppercase small py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $issue)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $issue->book->cover_image_url }}" alt="Cover" class="rounded object-fit-cover" style="width: 40px; height: 50px;">
                                    <div>
                                        <h6 class="mb-1 fw-semibold text-dark">{{ $issue->book->title }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">{{ $issue->issue_date->format('M d, Y') }}</td>
                            <td class="py-3">{{ $issue->due_date->format('M d, Y') }}</td>
                            <td class="py-3">
                                {{ $issue->return_date ? $issue->return_date->format('M d, Y') : '-' }}
                            </td>
                            <td class="py-3">
                                @if($issue->status === 'returned')
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Returned</span>
                                @elseif($issue->status === 'lost')
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">Lost</span>
                                @elseif($issue->is_overdue)
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">Overdue</span>
                                @else
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">Active</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-history fs-2 mb-3 opacity-50"></i>
                                    <h5>No History Found</h5>
                                    <p class="mb-0">Your borrowing history will appear here.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($history->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $history->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
