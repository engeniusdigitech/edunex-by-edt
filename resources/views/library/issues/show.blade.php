@extends('layouts.admin')

@section('title', 'Issue Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <a href="{{ route('library.issues.index') }}" class="btn btn-outline-secondary btn-sm btn-modern me-2">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
        <h4 class="fw-medium text-dark mb-1 d-inline-block align-middle">Issue Details</h4>
    </div>
    <div class="d-flex gap-2">
        @if($issue->status === 'issued')
            <a href="{{ route('library.returns.show', $issue) }}" class="btn btn-success btn-modern shadow-sm">
                <i class="fas fa-undo me-2"></i> Return Book
            </a>
        @endif
        <button type="button" class="btn btn-outline-primary btn-modern shadow-sm" onclick="window.print()">
            <i class="fas fa-print me-2"></i> Print Receipt
        </button>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
    <i class="fas fa-check-circle text-success fs-4"></i>
    <div><strong>Success!</strong> {{ session('success') }}</div>
</div>
@endif

{{-- Overdue Alert --}}
@if($issue->is_overdue)
<div class="alert bg-white border border-danger border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
    <div style="width:48px;height:48px;border-radius:12px;background:rgba(239,68,68,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
        <i class="fas fa-exclamation-triangle text-danger fs-5"></i>
    </div>
    <div>
        <strong class="text-danger">Overdue by {{ $issue->days_overdue }} {{ Str::plural('day', $issue->days_overdue) }}</strong>
        <div class="text-muted small">Estimated fine: <strong class="text-danger">{{ currencySymbol() }}{{ number_format($issue->calculated_fine, 2) }}</strong></div>
    </div>
</div>
@endif

{{-- Issue Information Card --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
    <div class="card-body p-4">
        <div class="row">
            {{-- Book Info (Left) --}}
            <div class="col-md-6">
                <h6 class="text-uppercase text-muted fw-semibold small mb-3" style="letter-spacing:1px;">Book Information</h6>
                <div class="d-flex align-items-start">
                    <img src="{{ $issue->book->cover_image_url }}" alt="{{ $issue->book->title }}"
                         style="width:80px;height:110px;object-fit:cover;border-radius:10px;" class="me-4 shadow-sm">
                    <div>
                        <h5 class="fw-semibold text-dark mb-1">{{ $issue->book->title }}</h5>
                        <p class="text-muted mb-1">
                            <i class="fas fa-user-edit me-1"></i>
                            {{ $issue->book->author->name ?? 'Unknown Author' }}
                        </p>
                        <p class="text-muted mb-1">
                            <i class="fas fa-barcode me-1"></i>
                            ISBN: {{ $issue->book->isbn ?? 'N/A' }}
                        </p>
                        @if($issue->book->edition)
                            <p class="text-muted mb-0">
                                <i class="fas fa-layer-group me-1"></i>
                                Edition: {{ $issue->book->edition }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Issue Info (Right) --}}
            <div class="col-md-6">
                <h6 class="text-uppercase text-muted fw-semibold small mb-3" style="letter-spacing:1px;">Issue Information</h6>
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted py-1 ps-0" style="width:130px;">Member</td>
                        <td class="fw-medium py-1">
                            {{ $issue->member->name ?? 'N/A' }}
                            @if($issue->member_type === 'App\\Models\\User')
                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-2 py-1 ms-1" style="font-size:0.65rem;">Staff</span>
                            @else
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1 ms-1" style="font-size:0.65rem;">Student</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted py-1 ps-0">Issue Date</td>
                        <td class="fw-medium py-1">{{ $issue->issue_date->format('d M, Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted py-1 ps-0">Due Date</td>
                        <td class="fw-medium py-1">
                            {{ $issue->due_date->format('d M, Y') }}
                            @if($issue->is_overdue)
                                <span class="badge bg-danger rounded-pill px-2 py-1 ms-1" style="font-size:0.65rem;">Overdue</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted py-1 ps-0">Return Date</td>
                        <td class="fw-medium py-1">{{ $issue->return_date ? $issue->return_date->format('d M, Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted py-1 ps-0">Status</td>
                        <td class="py-1">
                            @if($issue->status === 'issued')
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-medium">Issued</span>
                            @elseif($issue->status === 'returned')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Returned</span>
                            @elseif($issue->status === 'lost')
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-medium">Lost</span>
                            @endif
                        </td>
                    </tr>
                    @if($issue->remarks)
                    <tr>
                        <td class="text-muted py-1 ps-0">Remarks</td>
                        <td class="fw-medium py-1">{{ $issue->remarks }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="text-muted py-1 ps-0">Issued By</td>
                        <td class="fw-medium py-1">{{ $issue->issuedByUser->name ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Fines Section --}}
<div class="card border-0 shadow-sm" style="border-radius:16px;">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-semibold text-dark mb-0">
                <i class="fas fa-coins text-warning me-2"></i> Fines
            </h6>
            @if($issue->fines->isEmpty() && $issue->is_overdue)
                <form method="POST" action="{{ route('library.fines.store') }}">
                    @csrf
                    <input type="hidden" name="book_issue_id" value="{{ $issue->id }}">
                    <input type="hidden" name="fine_amount" value="{{ $issue->calculated_fine }}">
                    <input type="hidden" name="fine_reason" value="Overdue ({{ $issue->days_overdue }} days)">
                    <button type="submit" class="btn btn-warning btn-sm btn-modern" onclick="return confirm('Generate fine of {{ currencySymbol() }}{{ number_format($issue->calculated_fine, 2) }}?')">
                        <i class="fas fa-plus me-1"></i> Generate Fine
                    </button>
                </form>
            @endif
        </div>

        @if($issue->fines->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color:#F8FAFC;">
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:12px 16px;">Amount</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:12px 16px;">Reason</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:12px 16px;">Status</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:12px 16px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($issue->fines as $fine)
                    <tr>
                        <td style="padding:12px 16px;" class="fw-semibold">{{ currencySymbol() }}{{ number_format($fine->fine_amount, 2) }}</td>
                        <td style="padding:12px 16px;">{{ $fine->fine_reason }}</td>
                        <td style="padding:12px 16px;">
                            @if($fine->payment_status === 'paid')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Paid</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-medium">Unpaid</span>
                            @endif
                        </td>
                        <td style="padding:12px 16px;" class="text-muted">{{ $fine->payment_date ? $fine->payment_date->format('d M, Y') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-4">
            <div class="text-muted">
                <i class="fas fa-check-circle text-success me-2"></i>
                @if($issue->is_overdue)
                    No fines generated yet. Click "Generate Fine" to create one.
                @else
                    No fines for this issue.
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
