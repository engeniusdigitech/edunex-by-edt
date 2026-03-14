@extends('layouts.admin')

@section('title', 'Allocate Fees')

@section('content')
    <div class="mb-5">
        <h4 class="fw-bold text-dark mb-1">Fee Allocation</h4>
        <p class="text-muted small mb-0">Assign a fee structure to all students in a specific batch</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger shadow-sm rounded-4 mb-4">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('fee-allocations.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark small text-uppercase"
                                style="letter-spacing: 1px;">Select Batch</label>
                            <select name="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
                                <option value="">-- Choose Batch --</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                @endforeach
                            </select>
                            @error('batch_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark small text-uppercase"
                                style="letter-spacing: 1px;">Select Fee Structure</label>
                            <select name="fee_structure_id"
                                class="form-select @error('fee_structure_id') is-invalid @enderror" required>
                                <option value="">-- Choose Fee Structure --</option>
                                @foreach($feeStructures as $structure)
                                    <option value="{{ $structure->id }}">
                                        {{ $structure->name }} - ₹{{ number_format($structure->total_amount, 2) }}
                                        ({{ $structure->category->name ?? 'No Category' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('fee_structure_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-modern py-2 shadow-sm">
                                <i class="fas fa-check-double me-2"></i> Allocate Fees Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 bg-light rounded-4 h-100">
                <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
                    <div class="mb-4 text-primary opacity-25">
                        <i class="fas fa-users fa-4x"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-3">Bulk Assignment</h5>
                    <p class="text-muted small px-3">
                        Allocating fees will create individual pending fee records for every student currently enrolled in
                        the selected batch.
                    </p>
                    <div class="alert alert-warning border-0 bg-white shadow-sm mt-3 text-start small">
                        <i class="fas fa-info-circle me-2 text-warning"></i>
                        <strong>Important:</strong> Students who already have this specific fee structure assigned will be
                        automatically skipped to prevent double billing.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection