@extends('student.layouts.app')

@section('title', 'My Fines')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">My Fines</h4>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="fas fa-coins text-primary fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small text-uppercase fw-semibold mb-1">Total Fines</p>
                        <h4 class="fw-bold mb-0 text-dark">{{ currencySymbol() }}{{ number_format($totalFines ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="fas fa-check-circle text-success fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small text-uppercase fw-semibold mb-1">Paid Fines</p>
                        <h4 class="fw-bold mb-0 text-dark">{{ currencySymbol() }}{{ number_format($paidFines ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="fas fa-exclamation-circle text-danger fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small text-uppercase fw-semibold mb-1">Pending Fines</p>
                        <h4 class="fw-bold mb-0 text-danger">{{ currencySymbol() }}{{ number_format($pendingFines ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fines Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-muted fw-semibold text-uppercase small px-4 py-3">Book</th>
                        <th class="text-muted fw-semibold text-uppercase small py-3">Amount</th>
                        <th class="text-muted fw-semibold text-uppercase small py-3">Reason</th>
                        <th class="text-muted fw-semibold text-uppercase small py-3">Status</th>
                        <th class="text-muted fw-semibold text-uppercase small px-4 py-3">Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fines as $fine)
                        <tr>
                            <td class="px-4 py-3">
                                <h6 class="mb-0 text-dark fw-semibold">{{ $fine->bookIssue->book->title ?? 'N/A' }}</h6>
                            </td>
                            <td class="py-3 fw-bold">{{ currencySymbol() }}{{ $fine->fine_amount }}</td>
                            <td class="py-3 text-muted">{{ $fine->fine_reason }}</td>
                            <td class="py-3">
                                @if($fine->payment_status === 'paid')
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Paid</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">Unpaid</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                {{ $fine->payment_date ? $fine->payment_date->format('M d, Y') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-check-circle fs-2 mb-3 opacity-50"></i>
                                    <h5>No Fines</h5>
                                    <p class="mb-0">You have no fine records.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($fines->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $fines->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
