@extends('layouts.admin')

@section('title', 'Manage Payments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">Payments & Invoices</h4>
        <p class="text-muted small mb-0">Track student fee collections and revenue</p>
    </div>
    <a href="{{ route('payments.create') }}" class="btn btn-primary btn-modern shadow-sm">
        <i class="fas fa-wallet me-2"></i> Record Payment
    </a>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
</div>
@endif

<div class="card border-0 bg-white">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F8FAFC;">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Transaction Ref</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Student & Category</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Amount</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Date & Method</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td class="ps-4 py-4">
                            <span class="badge bg-light text-secondary border px-2 py-1" style="font-family: monospace; letter-spacing: 0.5px;">{{ $payment->razorpay_payment_id ?? 'CASH-'.str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="py-4">
                            <div class="fw-bold text-dark mb-1">{{ $payment->student->name ?? 'Deleted Student' }}</div>
                            <div class="small text-muted">
                                <i class="fas fa-tag text-opacity-50 me-1"></i> 
                                {{ $payment->feeStructure->name ?? 'General Fee' }}
                                @if(isset($payment->feeStructure->category))
                                    <span class="ms-1 text-primary-light">• {{ $payment->feeStructure->category->name }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 fw-black text-dark fs-5" style="font-family: monospace;">₹{{ number_format($payment->amount_paid, 2) }}</td>
                        <td class="py-4">
                            <div class="fw-medium text-dark mb-1">{{ $payment->payment_date->format('M d, Y') }}</div>
                            <div class="small">
                                @if($payment->payment_method == 'online')
                                    <span class="text-primary fw-medium"><i class="fas fa-globe me-1"></i> Online Transfer</span>
                                @elseif($payment->payment_method == 'cash')
                                    <span class="text-secondary fw-medium"><i class="fas fa-money-bill me-1"></i> Cash Payment</span>
                                @else
                                    <span class="text-warning fw-medium"><i class="fas fa-university me-1"></i> Bank Processing</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-4">
                            @if($payment->status == 'success')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2 fw-bold">Success</span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle rounded-pill px-3 py-2 fw-bold">{{ ucfirst($payment->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @if($payments->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                <i class="fas fa-receipt fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark">No payments recorded</h6>
                            <p class="text-muted small mb-0">Record your first fee collection.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-4">
    {{ $payments->links() }}
</div>
@endsection
