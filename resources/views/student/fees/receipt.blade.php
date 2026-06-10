@extends('student.layouts.app')

@section('title', 'Payment Receipt')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">

    {{-- Back button --}}
    <div class="mb-4">
        <a href="{{ route('student.fees.index') }}" class="btn btn-light border btn-sm rounded-3 fw-medium">
            <i class="fas fa-arrow-left me-2"></i> Back to Fees
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Receipt Card --}}
            <div class="card border-0 shadow rounded-4 overflow-hidden">

                {{-- Gradient Header --}}
                <div class="card-header border-0 p-0" style="background: linear-gradient(135deg, #1e40af 0%, #0d9488 100%);">
                    <div class="p-4 d-flex justify-content-between align-items-start">
                        <div class="text-white">
                            <div style="font-size:0.65rem; letter-spacing:2px; opacity:.75; text-transform:uppercase; font-weight:700;">Payment Receipt</div>
                            <div class="fw-bold mt-1" style="font-size:1.5rem; letter-spacing:-0.5px;">
                                #{{ $payment->receipt_number ?? ('REC-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT)) }}
                            </div>
                            <div class="mt-2" style="font-size:0.8rem; opacity:.8;">
                                {{ $payment->payment_date?->format('d F Y') ?? now()->format('d F Y') }}
                            </div>
                        </div>
                        <div class="text-end text-white">
                            <div style="font-size:0.65rem; letter-spacing:2px; opacity:.75; text-transform:uppercase; font-weight:700;">Institute</div>
                            <div class="fw-semibold mt-1" style="font-size:0.95rem;">{{ $institute->name ?? 'EduNex ERP' }}</div>
                            @if(!empty($institute->contact_email))
                            <div style="font-size:0.75rem; opacity:.8;">{{ $institute->contact_email }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- Status Banner --}}
                    <div class="px-4 pb-4 d-flex gap-2 flex-wrap align-items-center">
                        @php $isFullyPaid = $studentFee && $studentFee->due_amount <= 0; @endphp
                        <span class="badge px-3 py-2 fw-semibold"
                            style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4); font-size:0.7rem; letter-spacing:1px; text-transform:uppercase; color:#fff; border-radius:99px;">
                            <i class="fas {{ $isFullyPaid ? 'fa-check-circle' : 'fa-adjust' }} me-1"></i>
                            {{ $isFullyPaid ? 'Fully Paid' : 'Partial Payment' }}
                        </span>
                        <span class="badge px-3 py-2 fw-semibold"
                            style="background: rgba(255,255,255,0.15); font-size:0.7rem; color:#fff; border-radius:99px;">
                            {{ ucwords(str_replace('_', ' ', $payment->gateway ?? $payment->payment_method ?? 'N/A')) }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-0">

                    {{-- Student + Payment Info --}}
                    <div class="row g-0 border-bottom">
                        <div class="col-sm-6 p-4 border-end">
                            <div class="small fw-bold text-muted text-uppercase mb-3" style="letter-spacing:1.2px; font-size:0.65rem;">Billed To</div>
                            <h6 class="fw-bold text-dark mb-1">{{ $student->name }}</h6>
                            @if($student->email)
                                <p class="text-muted mb-1 small">{{ $student->email }}</p>
                            @endif
                            @if($student->phone)
                                <p class="text-muted mb-1 small"><i class="fas fa-phone me-1"></i>{{ $student->phone }}</p>
                            @endif
                            @if($student->batch)
                                <p class="text-muted mb-0 small"><i class="fas fa-layer-group me-1"></i>{{ $student->batch->name }}</p>
                            @endif
                            @if($student->roll_number)
                                <p class="text-muted mb-0 small mt-1"><i class="fas fa-id-badge me-1"></i>Roll No: {{ $student->roll_number }}</p>
                            @endif
                        </div>
                        <div class="col-sm-6 p-4">
                            <div class="small fw-bold text-muted text-uppercase mb-3" style="letter-spacing:1.2px; font-size:0.65rem;">Transaction Info</div>
                            <table class="w-100" style="font-size:0.85rem;">
                                <tr>
                                    <td class="text-muted pb-2" style="width:45%">Receipt No.</td>
                                    <td class="fw-semibold text-dark pb-2">{{ $payment->receipt_number ?? str_pad($payment->id,5,'0',STR_PAD_LEFT) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted pb-2">Date</td>
                                    <td class="fw-semibold text-dark pb-2">{{ $payment->payment_date?->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted pb-2">Method</td>
                                    <td class="fw-semibold text-dark pb-2">{{ ucwords(str_replace('_',' ', $payment->gateway ?? $payment->payment_method)) }}</td>
                                </tr>
                                @if($payment->transaction_id)
                                <tr>
                                    <td class="text-muted pb-2">Txn ID</td>
                                    <td class="fw-semibold text-dark pb-2" style="font-size:0.75rem; word-break:break-all;">{{ $payment->transaction_id }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    {{-- Fee Breakdown --}}
                    <div class="p-4 border-bottom">
                        <div class="small fw-bold text-muted text-uppercase mb-3" style="letter-spacing:1.2px; font-size:0.65rem;">Fee Breakdown</div>
                        <table class="table table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3 py-3 fw-semibold text-muted small text-uppercase" style="font-size:0.7rem; letter-spacing:0.8px;">Description</th>
                                    <th class="py-3 fw-semibold text-muted small text-uppercase text-end pe-3" style="font-size:0.7rem; letter-spacing:0.8px;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Fee item --}}
                                <tr class="border-bottom">
                                    <td class="ps-3 py-3">
                                        <div class="fw-semibold text-dark">{{ $payment->feeStructure->name ?? 'Fee Payment' }}</div>
                                        <div class="small text-muted">Category: {{ $payment->feeStructure->category->name ?? 'General' }}</div>
                                    </td>
                                    <td class="py-3 text-end pe-3 fw-bold text-dark fs-5">
                                        ₹{{ number_format($payment->amount_paid, 2) }}
                                    </td>
                                </tr>

                                {{-- Sub-totals --}}
                                @if($studentFee)
                                    @php $prevPaid = max(0, $studentFee->paid_amount - $payment->amount_paid); @endphp
                                    @if($prevPaid > 0)
                                    <tr>
                                        <td class="ps-3 py-2 text-muted small">Previously Paid</td>
                                        <td class="py-2 text-end pe-3 text-muted small fw-medium">+ ₹{{ number_format($prevPaid, 2) }}</td>
                                    </tr>
                                    @endif
                                    <tr class="table-light">
                                        <td class="ps-3 py-3 fw-semibold text-dark">Total Paid to Date</td>
                                        <td class="py-3 text-end pe-3 fw-bold text-success fs-6">₹{{ number_format($studentFee->paid_amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3 py-2 text-muted small">Total Fee Amount</td>
                                        <td class="py-2 text-end pe-3 text-muted small fw-medium">₹{{ number_format($studentFee->amount, 2) }}</td>
                                    </tr>
                                    @if($studentFee->due_amount > 0)
                                    <tr class="table-warning">
                                        <td class="ps-3 py-3 fw-semibold text-warning-emphasis">Outstanding Balance</td>
                                        <td class="py-3 text-end pe-3 fw-bold text-danger">₹{{ number_format($studentFee->due_amount, 2) }}</td>
                                    </tr>
                                    @else
                                    <tr class="table-success">
                                        <td class="ps-3 py-3 fw-semibold text-success" colspan="2">
                                            <i class="fas fa-check-circle me-2"></i> Fee fully cleared — No balance outstanding!
                                        </td>
                                    </tr>
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Summary tiles --}}
                    @if($studentFee)
                    <div class="row g-0 text-center border-bottom">
                        <div class="col-4 p-3 border-end">
                            <div class="small text-muted text-uppercase fw-semibold mb-1" style="font-size:0.6rem; letter-spacing:1px;">Total Fee</div>
                            <div class="fw-bold text-dark">₹{{ number_format($studentFee->amount, 2) }}</div>
                        </div>
                        <div class="col-4 p-3 border-end">
                            <div class="small text-muted text-uppercase fw-semibold mb-1" style="font-size:0.6rem; letter-spacing:1px;">This Payment</div>
                            <div class="fw-bold text-success">₹{{ number_format($payment->amount_paid, 2) }}</div>
                        </div>
                        <div class="col-4 p-3">
                            <div class="small text-muted text-uppercase fw-semibold mb-1" style="font-size:0.6rem; letter-spacing:1px;">Balance</div>
                            <div class="fw-bold {{ $studentFee->due_amount > 0 ? 'text-danger' : 'text-success' }}">
                                ₹{{ number_format($studentFee->due_amount, 2) }}
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Footer note --}}
                    <div class="p-4 bg-light text-center">
                        <p class="text-muted small mb-0">
                            <i class="fas fa-shield-alt text-success me-1"></i>
                            This is a computer-generated receipt and is valid without a signature.<br>
                            @if(!empty($institute->contact_email))
                                For queries contact <strong>{{ $institute->contact_email }}</strong>
                            @endif
                        </p>
                    </div>

                </div>{{-- /card-body --}}
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex gap-3 mt-4 d-print-none">
                <button onclick="window.print()" class="btn btn-dark rounded-3 fw-medium px-4">
                    <i class="fas fa-print me-2"></i> Print Receipt
                </button>
                <a href="{{ route('student.fees.index') }}" class="btn btn-light border rounded-3 fw-medium px-4">
                    <i class="fas fa-arrow-left me-2"></i> Back to Fees
                </a>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
