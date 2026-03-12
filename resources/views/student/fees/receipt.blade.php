@extends('student.layouts.app')

@section('title', 'Payment Receipt')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="60" class="mb-3">
                        <h4 class="fw-bold mb-0">Payment Receipt</h4>
                        <p class="text-muted">Transaction ID: {{ $payment->transaction_id ?? 'N/A' }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="fw-bold text-muted small text-uppercase">Billed To</h6>
                            <h5 class="fw-bold mb-1">{{ $student->name }}</h5>
                            <p class="text-muted mb-0">{{ $student->email }}</p>
                            <p class="text-muted">{{ $student->phone }}</p>
                        </div>
                        <div class="col-sm-6 text-sm-end mt-4 mt-sm-0">
                            <h6 class="fw-bold text-muted small text-uppercase">Payment Details</h6>
                            <p class="mb-1"><strong>Date:</strong> {{ $payment->payment_date->format('M d, Y') }}</p>
                            <p class="mb-1"><strong>Method:</strong> <span class="text-capitalize">{{ $payment->gateway ?? $payment->payment_method }}</span></p>
                            <p class="mb-0"><strong>Status:</strong> <span class="badge bg-success-subtle text-success border border-success border-opacity-25 px-2 py-1">Success</span></p>
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table border rounded text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 text-start ps-4">Description</th>
                                    <th class="py-3">Amount Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-4 text-start ps-4 fw-medium">
                                        {{ $payment->feeStructure->name ?? 'Fee Payment' }}<br>
                                        <small class="text-muted">Fee Category: {{ $payment->feeStructure->category->name ?? 'N/A' }}</small>
                                    </td>
                                    <td class="py-4 fw-bold text-primary align-middle fs-5">
                                        {{ strtoupper($payment->currency) }} {{ number_format($payment->amount_paid, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-5 d-print-none">
                        <button onclick="window.print()" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 10px;">
                            <i class="fas fa-print me-2"></i> Print Receipt
                        </button>
                        <a href="{{ route('student.fees.index') }}" class="btn btn-light border px-4 py-2 fw-bold ms-2" style="border-radius: 10px;">
                            Back to Fees
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * { visibility: hidden; }
        .card, .card * { visibility: visible; }
        .card { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none !important; }
        .d-print-none { display: none !important; }
    }
</style>
@endsection
