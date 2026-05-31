@extends('layouts.admin')

@section('title', 'Return Book')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <a href="{{ route('library.returns.index') }}" class="btn btn-outline-secondary btn-sm btn-modern me-2">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
        <h4 class="fw-medium text-dark mb-1 d-inline-block align-middle">Return Book</h4>
    </div>
</div>

@if(session('error'))
<div class="alert alert-danger bg-white border border-danger border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
    <i class="fas fa-times-circle text-danger fs-4"></i>
    <div><strong>Error!</strong> {{ session('error') }}</div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4 p-lg-5">
                {{-- Book Info Summary --}}
                <div class="d-flex align-items-start mb-4 pb-4 border-bottom">
                    <img src="{{ $issue->book->cover_image_url }}" alt="{{ $issue->book->title }}"
                         style="width:70px;height:95px;object-fit:cover;border-radius:10px;" class="me-4 shadow-sm">
                    <div>
                        <h5 class="fw-semibold text-dark mb-1">{{ $issue->book->title }}</h5>
                        <p class="text-muted mb-1">
                            <i class="fas fa-barcode me-1"></i> ISBN: {{ $issue->book->isbn ?? 'N/A' }}
                        </p>
                        <p class="text-muted mb-1">
                            <i class="fas fa-user me-1"></i> {{ $issue->member->name ?? 'N/A' }}
                            @if($issue->member_type === 'App\\Models\\User')
                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-2 py-1 ms-1" style="font-size:0.65rem;">Staff</span>
                            @else
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1 ms-1" style="font-size:0.65rem;">Student</span>
                            @endif
                        </p>
                        <p class="text-muted mb-0">
                            <i class="fas fa-calendar me-1"></i> Issued: {{ $issue->issue_date->format('d M, Y') }} — Due: {{ $issue->due_date->format('d M, Y') }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('library.returns.store', $issue) }}">
                    @csrf

                    {{-- Return Date --}}
                    <div class="mb-4">
                        <label for="return_date" class="form-label fw-semibold">Return Date <span class="text-danger">*</span></label>
                        <input type="date" name="return_date" id="return_date" class="form-control @error('return_date') is-invalid @enderror"
                               value="{{ old('return_date', date('Y-m-d')) }}">
                        @error('return_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Fine Preview --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Fine Preview</label>
                        @if($issue->is_overdue)
                            @php
                                $daysOverdue = $issue->days_overdue;
                                $finePerDay = $settings->fine_per_day ?? 0;
                                $totalFine = $daysOverdue * $finePerDay;
                            @endphp
                            <div class="p-3 rounded-3" style="background:rgba(239,68,68,0.06);border:1px solid rgba(239,68,68,0.15);">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                                    <span class="fw-semibold text-danger">Fine Applicable</span>
                                </div>
                                <div class="text-dark">
                                    <span class="fw-medium">{{ $daysOverdue }} {{ Str::plural('day', $daysOverdue) }}</span>
                                    <span class="text-muted mx-1">×</span>
                                    <span class="fw-medium">{{ currencySymbol() }}{{ number_format($finePerDay, 2) }} per day</span>
                                    <span class="text-muted mx-1">=</span>
                                    <span class="fw-bold text-danger fs-5">{{ currencySymbol() }}{{ number_format($totalFine, 2) }}</span>
                                </div>
                            </div>
                        @else
                            <div class="p-3 rounded-3" style="background:rgba(16,185,129,0.06);border:1px solid rgba(16,185,129,0.15);">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span class="fw-medium text-success">No fine applicable — book is being returned on time.</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Remarks --}}
                    <div class="mb-4">
                        <label for="remarks" class="form-label fw-semibold">Remarks</label>
                        <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror" rows="3" placeholder="Optional notes about the return...">{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-modern shadow-sm px-4" onclick="return confirm('Are you sure you want to confirm this return?')">
                            <i class="fas fa-check me-2"></i> Confirm Return
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
