@extends('student.layouts.app')

@section('title', 'My Fees')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-0 fw-bold">My Fees</h3>
            <p class="text-muted">View your assigned fee structures and make online payments.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 rounded-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3">Fee Structure</th>
                                    <th class="py-3">Category</th>
                                    <th class="py-3">Amount</th>
                                    <th class="py-3">Paid</th>
                                    <th class="py-3">Due</th>
                                    <th class="py-3">Status</th>
                                    <th class="pe-4 py-3 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fees as $fee)
                                <tr>
                                    <td class="ps-4 py-3 fw-medium">
                                        {{ $fee->feeStructure->name ?? 'N/A' }}
                                    </td>
                                    <td class="py-3">
                                        {{ $fee->feeStructure->category->name ?? 'N/A' }}
                                    </td>
                                    <td class="py-3 fw-bold">₹{{ number_format($fee->amount, 2) }}</td>
                                    <td class="py-3 text-success fw-medium">₹{{ number_format($fee->paid_amount, 2) }}</td>
                                    <td class="py-3 text-danger fw-bold">₹{{ number_format($fee->due_amount, 2) }}</td>
                                    <td class="py-3">
                                        @if($fee->status === 'paid')
                                            <span class="badge bg-success-subtle text-success border border-success border-opacity-25 px-2 py-1">Paid</span>
                                        @elseif($fee->status === 'partial')
                                            <span class="badge bg-warning-subtle text-warning border border-warning border-opacity-25 px-2 py-1">Partial</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 px-2 py-1">Unpaid</span>
                                        @endif
                                    </td>
                                    <td class="pe-4 py-3 text-end">
                                        @if($fee->due_amount > 0)
                                            <!-- Payment Options Dropdown -->
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-sm btn-primary fw-bold" type="button" id="payDropdown{{ $fee->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 8px;">
                                                    <i class="fas fa-credit-card me-1"></i> Pay Now
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" aria-labelledby="payDropdown{{ $fee->id }}">
                                                    <li><h6 class="dropdown-header text-uppercase pb-1">Select Gateway</h6></li>
                                                    @if(auth('student')->user()->institute->country === 'IN')
                                                        @if($gatewayConfig && !empty($gatewayConfig->razorpay_key) && !empty($gatewayConfig->razorpay_secret))
                                                        <li>
                                                            <form action="{{ route('student.fees.pay', $fee->id) }}" method="POST" class="m-0">
                                                                @csrf
                                                                <input type="hidden" name="gateway" value="razorpay">
                                                                <button type="submit" class="dropdown-item py-2 fw-medium text-primary">
                                                                    <i class="fas fa-wallet w-20px text-center me-1"></i> Razorpay (India)
                                                                </button>
                                                            </form>
                                                        </li>
                                                        @else
                                                            <li><span class="dropdown-item text-muted small py-2">Payment gateway not configured</span></li>
                                                        @endif
                                                    @else
                                                        @if($gatewayConfig && !empty($gatewayConfig->stripe_public_key) && !empty($gatewayConfig->stripe_secret_key))
                                                        <li>
                                                            <form action="{{ route('student.fees.pay', $fee->id) }}" method="POST" class="m-0">
                                                                @csrf
                                                                <input type="hidden" name="gateway" value="stripe">
                                                                <button type="submit" class="dropdown-item py-2 fw-medium" style="color:#6366F1;">
                                                                    <i class="fab fa-stripe-s w-20px text-center me-1"></i> Stripe (International)
                                                                </button>
                                                            </form>
                                                        </li>
                                                        @else
                                                            <li><span class="dropdown-item text-muted small py-2">Payment gateway not configured</span></li>
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        @else
                                            <span class="text-muted small"><i class="fas fa-check-circle text-success me-1"></i>Cleared</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-receipt mb-2 fs-2 text-primary opacity-50"></i>
                                            <p class="mb-0">No fees assigned currently.</p>
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
</div>

<style>
    .w-20px { width: 20px; }
</style>
@endsection
