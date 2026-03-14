@extends('student.layouts.app')

@section('title', 'My Fees & Payments')

@section('content')
    <div class="container-fluid animate__animated animate__fadeIn">
        <!-- Header -->
        <div class="row align-items-center mb-5">
            <div class="col-md-8">
                <h2 class="fw-black text-dark mb-1" style="letter-spacing: -1px;">Fee Statement</h2>
                <p class="text-muted mb-0">Manage your financial records and upcoming dues</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="glass-card p-3 rounded-4 d-inline-flex align-items-center gap-3 border shadow-sm bg-white">
                    <div class="icon-circle bg-primary-subtle text-primary">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="text-start">
                        <div class="small fw-bold text-muted text-uppercase"
                            style="font-size: 0.65rem; letter-spacing: 1px;">Current Session</div>
                        <div class="fw-bold text-dark">{{ date('Y') }} - {{ date('y') + 1 }}</div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success') || session('error'))
            <div
                class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} border-0 shadow-sm rounded-4 mb-5 p-3 animate__animated animate__shakeX">
                <div class="d-flex align-items-center">
                    <i class="fas {{ session('success') ? 'fa-check-circle' : 'fa-exclamation-triangle' }} fs-4 me-3"></i>
                    <div>{{ session('success') ?? session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        <!-- Summary Stats -->
        <div class="row g-4 mb-5">
            @php
                $totalAssigned = $fees->sum('amount');
                $totalPaid = $fees->sum('paid_amount');
                $totalDue = $fees->sum('due_amount');
            @endphp
            <div class="col-md-4">
                <div
                    class="card border-0 shadow-sm rounded-4 bg-primary text-white h-100 overflow-hidden position-relative">
                    <div class="card-body p-4 position-relative z-1">
                        <span class="small opacity-75 fw-bold text-uppercase" style="letter-spacing: 1px;">Total
                            Assigned</span>
                        <h2 class="fw-black mb-0 mt-2">₹{{ number_format($totalAssigned, 2) }}</h2>
                    </div>
                    <i class="fas fa-file-invoice position-absolute text-white opacity-10"
                        style="bottom: -15px; right: 10px; font-size: 8rem;"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div
                    class="card border-0 shadow-sm rounded-4 bg-success text-white h-100 overflow-hidden position-relative">
                    <div class="card-body p-4 position-relative z-1">
                        <span class="small opacity-75 fw-bold text-uppercase" style="letter-spacing: 1px;">Total Paid</span>
                        <h2 class="fw-black mb-0 mt-2">₹{{ number_format($totalPaid, 2) }}</h2>
                    </div>
                    <i class="fas fa-check-double position-absolute text-white opacity-10"
                        style="bottom: -15px; right: 10px; font-size: 8rem;"></i>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 bg-white h-100 overflow-hidden position-relative border">
                    <div class="card-body p-4 position-relative z-1">
                        <span class="small text-muted fw-bold text-uppercase" style="letter-spacing: 1px;">Outstanding
                            Balance</span>
                        <h2 class="fw-black text-danger mb-0 mt-2">₹{{ number_format($totalDue, 2) }}</h2>
                    </div>
                    <i class="fas fa-clock position-absolute text-dark opacity-5"
                        style="bottom: -15px; right: 10px; font-size: 8rem;"></i>
                </div>
            </div>
        </div>

        <!-- Fee Cards -->
        <h5 class="fw-bold text-dark mb-4 ms-1">Assigned Fee Components</h5>
        <div class="row g-4 mb-5">
            @forelse($fees as $fee)
                <div class="col-xl-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-1 fee-card bg-white border">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <span
                                        class="badge {{ $fee->status == 'paid' ? 'bg-success-subtle text-success' : ($fee->status == 'partial' ? 'bg-warning-subtle text-warning' : 'bg-danger-subtle text-danger') }} rounded-pill px-3 py-2 fw-bold mb-2">
                                        <i class="fas {{ $fee->status == 'paid' ? 'fa-check' : 'fa-info-circle' }} me-1"></i>
                                        {{ ucfirst($fee->status == 'unpaid' ? 'Pending' : $fee->status) }}
                                    </span>
                                    <h4 class="fw-bold text-dark mb-1">{{ $fee->feeStructure->name }}</h4>
                                    <p class="text-muted small mb-0">{{ $fee->feeStructure->category->name }}</p>
                                </div>
                                <div class="text-end">
                                    <span class="text-muted small d-block mb-1 fw-bold text-uppercase"
                                        style="font-size: 0.6rem; letter-spacing: 1px;">Due Amount</span>
                                    <h3 class="fw-black {{ $fee->due_amount > 0 ? 'text-danger' : 'text-success' }} mb-0">
                                        ₹{{ number_format($fee->due_amount, 2) }}</h3>
                                </div>
                            </div>

                            <div class="row g-3 px-3 py-3 bg-light rounded-4 border border-light-subtle mb-4">
                                <div class="col-4 border-end">
                                    <small class="text-muted d-block text-uppercase fw-bold"
                                        style="font-size: 0.6rem; letter-spacing: 0.5px;">Total</small>
                                    <span class="fw-bold text-dark">₹{{ number_format($fee->amount, 2) }}</span>
                                </div>
                                <div class="col-4 border-end">
                                    <small class="text-muted d-block text-uppercase fw-bold"
                                        style="font-size: 0.6rem; letter-spacing: 0.5px;">Paid</small>
                                    <span class="fw-bold text-success">₹{{ number_format($fee->paid_amount, 2) }}</span>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted d-block text-uppercase fw-bold"
                                        style="font-size: 0.6rem; letter-spacing: 0.5px;">Transactions</small>
                                    <span class="fw-bold text-muted small">{{ $fee->payments->count() }} Payments</span>
                                </div>
                            </div>

                            <div class="d-flex gap-2 pt-2">
                                @if($fee->due_amount > 0)
                                    <button class="btn btn-primary btn-lg rounded-4 shadow-sm flex-grow-1 fw-bold py-3"
                                        type="button" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $fee->id }}">
                                        <i class="fas fa-rocket me-2"></i> Pay Now
                                    </button>
                                @else
                                    <button
                                        class="btn btn-outline-success btn-lg rounded-4 flex-grow-1 fw-bold py-3 disabled border-2">
                                        <i class="fas fa-certificate me-2"></i> Payment Completed
                                    </button>
                                @endif
                                <button class="btn btn-light btn-lg rounded-4 border px-4 shadow-none" type="button"
                                    data-bs-toggle="modal" data-bs-target="#historyModal{{ $fee->id }}" title="View History">
                                    <i class="fas fa-history"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 mt-4">
                    <div class="d-inline-flex bg-white rounded-circle p-5 shadow-sm mb-4 border">
                        <i class="fas fa-receipt text-primary opacity-25" style="font-size: 5rem;"></i>
                    </div>
                    <h4 class="fw-bold text-dark">All clear!</h4>
                    <p class="text-muted">You have no pending or assigned fees at this moment.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modals Section -->
    @foreach($fees as $fee)
        <!-- Payment Selection Modal -->
        @if($fee->due_amount > 0)
            <div class="modal fade" id="paymentModal{{ $fee->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
                        <div class="modal-header border-0 p-4 pb-0">
                            <h5 class="fw-black text-dark mb-0">Secure Checkout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <p class="text-muted small mb-4">Complete your payment for <span
                                    class="fw-bold text-dark">{{ $fee->feeStructure->name }}</span></p>

                            <form action="{{ route('student.fees.pay', $fee->id) }}" method="POST" id="payForm{{ $fee->id }}">
                                @csrf
                                <div class="mb-4 bg-light p-3 rounded-4 border">
                                    <label class="small text-muted fw-bold text-uppercase mb-2 d-block"
                                        style="letter-spacing: 0.5px;">Amount to Pay (Partial allowed)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent border-0 fw-black text-dark fs-4">₹</span>
                                        <input type="number" name="amount" step="0.01" min="1" max="{{ $fee->due_amount }}"
                                            class="form-control bg-transparent border-0 fw-black text-dark fs-4 p-0 shadow-none"
                                            value="{{ $fee->due_amount }}" required>
                                    </div>
                                    <div class="d-flex justify-content-between mt-1">
                                        <small class="text-muted">Min: ₹1</small>
                                        <small class="text-muted">Max: ₹{{ number_format($fee->due_amount, 2) }}</small>
                                    </div>
                                </div>

                                <div class="small fw-bold text-muted text-uppercase mb-3" style="letter-spacing: 1px;">Select
                                    Gateway</div>
                                <div class="d-grid gap-3">
                                    @php $hasGateway = false; @endphp

                                    @if(auth('student')->user()->institute->country === 'IN')
                                        @if($gatewayConfig && !empty($gatewayConfig->razorpay_key))
                                            @php $hasGateway = true; @endphp
                                            <button type="submit" name="gateway" value="razorpay"
                                                class="gateway-option p-3 rounded-4 border w-100 text-start position-relative transition-all">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="gateway-icon bg-blue-subtle text-blue">
                                                        <i class="fas fa-credit-card fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark">Razorpay</div>
                                                        <div class="small text-muted" style="font-size: 0.7rem;">UPI, Cards, Wallets (India)
                                                        </div>
                                                    </div>
                                                    <i class="fas fa-chevron-right ms-auto text-muted small"></i>
                                                </div>
                                            </button>
                                        @endif
                                    @else
                                        @if($gatewayConfig && !empty($gatewayConfig->stripe_public_key))
                                            @php $hasGateway = true; @endphp
                                            <button type="submit" name="gateway" value="stripe"
                                                class="gateway-option p-3 rounded-4 border w-100 text-start position-relative transition-all">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="gateway-icon bg-indigo-subtle text-indigo">
                                                        <i class="fab fa-stripe fs-3"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark">Stripe</div>
                                                        <div class="small text-muted" style="font-size: 0.7rem;">Visa, MC, International
                                                        </div>
                                                    </div>
                                                    <i class="fas fa-chevron-right ms-auto text-muted small"></i>
                                                </div>
                                            </button>
                                        @endif
                                    @endif

                                    @if(!$hasGateway)
                                        <div class="alert alert-warning border-0 rounded-4 py-2">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <small>Gateways not configured. Contact Admin.</small>
                                        </div>
                                    @endif
                                </div>
                            </form>

                            <div class="text-center mt-4">
                                <div class="d-flex align-items-center justify-content-center gap-2 text-muted"
                                    style="opacity: 0.6;">
                                    <i class="fas fa-shield-alt text-success" style="font-size: 0.7rem;"></i>
                                    <span
                                        style="font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">AES-256
                                        Encrypted Security</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- History Modal -->
        <div class="modal fade" id="historyModal{{ $fee->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-black text-dark mb-0">Payment History</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <p class="text-muted small mb-4">Tracking all transactions for <span
                                class="fw-bold text-dark">{{ $fee->feeStructure->name }}</span></p>

                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <thead class="bg-light rounded-4">
                                    <tr>
                                        <th class="small fw-bold text-muted text-uppercase ps-3 py-3"
                                            style="font-size: 0.65rem;">Date</th>
                                        <th class="small fw-bold text-muted text-uppercase py-3" style="font-size: 0.65rem;">
                                            Amount</th>
                                        <th class="small fw-bold text-muted text-uppercase py-3" style="font-size: 0.65rem;">
                                            Method</th>
                                        <th class="small fw-bold text-muted text-uppercase py-3" style="font-size: 0.65rem;">
                                            Status</th>
                                        <th class="small fw-bold text-muted text-uppercase text-end pe-3 py-3"
                                            style="font-size: 0.65rem;">Receipt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($fee->payments as $payment)
                                        <tr class="border-bottom border-light">
                                            <td class="ps-3 py-3">
                                                <div class="fw-bold text-dark">{{ $payment->payment_date->format('d M, Y') }}</div>
                                                <div class="small text-muted">{{ $payment->payment_date->format('h:i A') }}</div>
                                            </td>
                                            <td class="py-3 fw-bold text-dark">₹{{ number_format($payment->amount_paid, 2) }}</td>
                                            <td class="py-3">
                                                <span
                                                    class="badge bg-light text-dark text-capitalize border">{{ $payment->payment_method }}</span>
                                            </td>
                                            <td class="py-3">
                                                <span class="badge bg-success-subtle text-success">Successful</span>
                                            </td>
                                            <td class="text-end pe-3 py-3">
                                                <a href="{{ route('student.fees.receipt', $payment->id) }}"
                                                    class="btn btn-sm btn-outline-primary rounded-3">
                                                    <i class="fas fa-download me-1"></i> Receipt
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-history mb-2 fs-2 opacity-25"></i>
                                                    <p class="mb-0">No payment records found yet.</p>
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
    @endforeach

    <style>
        .fw-black {
            font-weight: 900 !important;
        }

        .icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .fee-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        .fee-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.1) !important;
            border-color: var(--indigo) !important;
        }

        .gateway-option {
            background: #fff;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid #f0f0f0 !important;
        }

        .gateway-option:hover {
            background: #fcfdfe;
            border-color: var(--indigo) !important;
            transform: scale(1.02);
        }

        .gateway-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-blue-subtle {
            background-color: #ecf3ff;
        }

        .text-blue {
            color: #2176ff;
        }

        .bg-indigo-subtle {
            background-color: #f1f0ff;
        }

        .text-indigo {
            color: #6366f1;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection