@extends('layouts.admin')

@section('title', 'My Borrowed Books')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">My Borrowed Books</h4>
    <a href="{{ route('teacher.library.index') }}" class="btn btn-outline-secondary btn-sm btn-modern">
        <i class="fas fa-arrow-left me-1"></i> Back to Library
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:16px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr style="background-color:#F8FAFC;">
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Book</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Issue Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Due Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issues as $issue)
                    <tr>
                        <td style="padding:14px 20px;">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $issue->book->cover_image_url }}" alt="Cover" class="rounded object-fit-cover" style="width: 40px; height: 50px;">
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $issue->book->title }}</h6>
                                </div>
                            </div>
                        </td>
                        <td style="padding:14px 20px;">{{ $issue->issue_date->format('M d, Y') }}</td>
                        <td style="padding:14px 20px;">
                            <span class="{{ $issue->is_overdue ? 'text-danger fw-bold' : '' }}">
                                {{ $issue->due_date->format('M d, Y') }}
                            </span>
                        </td>
                        <td style="padding:14px 20px;">
                            @if($issue->status === 'returned')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Returned</span>
                            @elseif($issue->is_overdue)
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">Overdue ({{ $issue->days_overdue }} days)</span>
                            @else
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">Issued</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-book-reader fs-2 mb-3 opacity-25"></i>
                                <h5>No active books</h5>
                                <p class="mb-0">You don't have any books currently issued.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
