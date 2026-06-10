@extends('layouts.admin')

@section('title', 'Fees & Payments')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h4 class="fw-medium text-dark mb-1">Fees & Payments</h4>
            <p class="text-muted small mb-0">Monitor student dues, payment history and download receipts</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('fee-allocations.create') }}" class="btn btn-outline-primary btn-modern shadow-sm">
                <i class="fas fa-user-plus me-2"></i> Allocate Fees
            </a>
            <a href="{{ route('payments.create') }}" class="btn btn-primary btn-modern shadow-sm">
                <i class="fas fa-wallet me-2"></i> Record Payment
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
            <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Tab Navigation --}}
    <ul class="nav nav-pills mb-4 gap-2" id="paymentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active px-4 py-2 rounded-pill fw-medium" id="ledger-tab"
                data-bs-toggle="pill" data-bs-target="#ledger" type="button" role="tab">
                <i class="fas fa-table me-2"></i> Fee Ledger
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4 py-2 rounded-pill fw-medium" id="receipts-tab"
                data-bs-toggle="pill" data-bs-target="#receipts" type="button" role="tab">
                <i class="fas fa-receipt me-2"></i> Payment Receipts
                @if($payments->total() > 0)
                    <span class="badge bg-primary ms-1">{{ $payments->total() }}</span>
                @endif
            </button>
        </li>
    </ul>

    <div class="tab-content" id="paymentTabsContent">

        {{-- ===================== TAB 1: FEE LEDGER ===================== --}}
        <div class="tab-pane fade show active" id="ledger" role="tabpanel">

            {{-- Filters --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <form action="{{ route('payments.index') }}" method="GET">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" name="search" class="form-control bg-light border-0"
                                        placeholder="Search student name..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="batch_id" class="form-select bg-light border-0">
                                    <option value="">All Batches</option>
                                    @foreach($batches as $batch)
                                        <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                            {{ $batch->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex align-items-center gap-2">
                                    <input type="hidden" name="status" id="filterStatus" value="{{ request('status') }}">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" onclick="setStatus('')"
                                            class="btn btn-modern {{ !request()->filled('status') ? 'btn-primary' : 'btn-light border' }}">All</button>
                                        <button type="button" onclick="setStatus('paid')"
                                            class="btn btn-modern {{ request('status') == 'paid' ? 'btn-success' : 'btn-light border' }}">Paid</button>
                                        <button type="button" onclick="setStatus('partial')"
                                            class="btn btn-modern {{ request('status') == 'partial' ? 'btn-warning' : 'btn-light border' }}">Partial</button>
                                        <button type="button" onclick="setStatus('pending')"
                                            class="btn btn-modern {{ request('status') == 'pending' ? 'btn-danger' : 'btn-light border' }}">Pending</button>
                                    </div>
                                    <button type="submit" class="btn btn-dark btn-sm px-3 btn-modern">Apply</button>
                                    @if(request()->anyFilled(['search', 'batch_id', 'status']))
                                        <a href="{{ route('payments.index') }}" class="btn btn-light btn-sm border px-3 btn-modern">Clear</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 bg-white shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead style="background-color: #F8FAFC;">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Student & Batch</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Fee Structure</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0 text-center" style="font-size: 0.75rem; letter-spacing: 1px;">Total Amount</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold text-center border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Paid</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold text-center border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Due</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0 text-end pe-4" style="font-size: 0.75rem; letter-spacing: 1px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fees as $fee)
                                    <tr>
                                        <td class="ps-4 py-4">
                                            <div class="fw-medium text-dark mb-1">{{ $fee->student->name ?? 'Deleted Student' }}</div>
                                            <div class="small text-muted">
                                                <i class="fas fa-layer-group text-opacity-50 me-1"></i>
                                                {{ $fee->student->batch->name ?? 'No Batch' }}
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <div class="fw-medium text-dark">{{ $fee->feeStructure->name ?? 'General Fee' }}</div>
                                            <div class="small text-muted">{{ $fee->feeStructure->category->name ?? '' }}</div>
                                        </td>
                                        <td class="py-4 text-center fw-medium text-dark">₹{{ number_format($fee->amount, 2) }}</td>
                                        <td class="py-4 text-center">
                                            <span class="text-success fw-medium">₹{{ number_format($fee->paid_amount, 2) }}</span>
                                        </td>
                                        <td class="py-4 text-center">
                                            <span class="{{ $fee->due_amount > 0 ? 'text-danger' : 'text-muted' }} fw-medium">
                                                ₹{{ number_format($fee->due_amount, 2) }}
                                            </span>
                                        </td>
                                        <td class="py-4">
                                            @if($fee->status == 'paid')
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2 fw-medium">Paid</span>
                                            @elseif($fee->status == 'partial')
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle rounded-pill px-3 py-2 fw-medium">Partial</span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill px-3 py-2 fw-medium">Pending</span>
                                            @endif
                                        </td>
                                        <td class="py-4 text-end pe-4">
                                            <div class="dropdown">
                                                <button class="btn btn-light btn-sm rounded-3 shadow-none" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                                    <li>
                                                        <a class="dropdown-item rounded-3 py-2"
                                                            href="{{ route('payments.create', ['student_id' => $fee->student_id, 'fee_structure_id' => $fee->fee_structure_id]) }}">
                                                            <i class="fas fa-plus-circle text-primary me-2"></i> Record Payment
                                                        </a>
                                                    </li>
                                                    @foreach($fee->payments as $txn)
                                                        <li>
                                                            <a class="dropdown-item rounded-3 py-2" href="{{ route('payments.receipt', $txn->id) }}" target="_blank">
                                                                <i class="fas fa-receipt text-success me-2"></i>
                                                                Receipt #{{ $txn->receipt_number ?? $txn->id }}
                                                                <small class="text-muted ms-1">(₹{{ number_format($txn->amount_paid,2) }})</small>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($fees->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                                <i class="fas fa-search fa-2x"></i>
                                            </div>
                                            <h6 class="fw-medium text-dark">No records found</h6>
                                            <p class="text-muted small mb-0">Try adjusting your filters or allocate some fees.</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-4 px-2">
                {{ $fees->appends(request()->query())->links() }}
            </div>
        </div>

        {{-- ===================== TAB 2: PAYMENT RECEIPTS ===================== --}}
        <div class="tab-pane fade" id="receipts" role="tabpanel">

            {{-- Search / Filter Bar --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-3">
                    <form action="{{ route('payments.index') }}" method="GET" id="receiptsSearchForm">
                        <input type="hidden" name="_tab" value="receipts">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" name="receipt_search" id="receiptSearch"
                                        class="form-control bg-light border-0"
                                        placeholder="Search by student name or receipt number…"
                                        value="{{ request('receipt_search') }}"
                                        autocomplete="off">
                                    @if(request('receipt_search'))
                                        <button type="button" class="btn btn-light border-0 bg-light px-2"
                                            onclick="document.getElementById('receiptSearch').value=''; this.closest('form').submit();">
                                            <i class="fas fa-times text-muted"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="receipt_method" id="receiptMethod" class="form-select bg-light border-0">
                                    <option value="">All Methods</option>
                                    <option value="cash"          {{ request('receipt_method') == 'cash'          ? 'selected' : '' }}>Cash</option>
                                    <option value="bank_transfer" {{ request('receipt_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="online"        {{ request('receipt_method') == 'online'        ? 'selected' : '' }}>Online</option>
                                    <option value="razorpay"      {{ request('receipt_method') == 'razorpay'      ? 'selected' : '' }}>Razorpay</option>
                                    <option value="stripe"        {{ request('receipt_method') == 'stripe'        ? 'selected' : '' }}>Stripe</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="receipt_date" id="receiptDate"
                                    class="form-control bg-light border-0"
                                    value="{{ request('receipt_date') }}"
                                    title="Filter by payment date">
                            </div>
                            <div class="col-md-2 d-flex gap-2">
                                <button type="submit" class="btn btn-dark btn-sm px-3 btn-modern flex-grow-1">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                                @if(request()->anyFilled(['receipt_search','receipt_method','receipt_date']))
                                    <a href="{{ route('payments.index') }}#receipts"
                                       class="btn btn-light btn-sm border px-3 btn-modern">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 bg-white shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead style="background-color: #F8FAFC;">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Receipt No.</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Student</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Fee</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0 text-center" style="font-size: 0.75rem; letter-spacing: 1px;">Amount Paid</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Method</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Date</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0 text-end pe-4" style="font-size: 0.75rem; letter-spacing: 1px;">Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $txn)
                                    <tr data-searchable="{{ strtolower(($txn->student->name ?? '') . ' ' . ($txn->receipt_number ?? '')) }}">
                                        <td class="ps-4 py-3">
                                            <span class="badge bg-light text-dark border font-monospace fw-medium px-3 py-2">
                                                {{ $txn->receipt_number ?? ('REC-' . str_pad($txn->id, 5, '0', STR_PAD_LEFT)) }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <div class="fw-medium text-dark">{{ $txn->student->name ?? '—' }}</div>
                                            <div class="small text-muted">{{ $txn->student->batch->name ?? '' }}</div>
                                        </td>
                                        <td class="py-3">
                                            <div class="fw-medium text-dark">{{ $txn->feeStructure->name ?? 'General Fee' }}</div>
                                            <div class="small text-muted">{{ $txn->feeStructure->category->name ?? '' }}</div>
                                        </td>
                                        <td class="py-3 text-center">
                                            <span class="fw-medium text-success fs-6">₹{{ number_format($txn->amount_paid, 2) }}</span>
                                        </td>
                                        <td class="py-3">
                                            @php
                                                $methodLabel = match($txn->payment_method ?? $txn->gateway) {
                                                    'cash'          => ['Cash',          'bg-success-subtle text-success',  'fa-money-bill'],
                                                    'bank_transfer' => ['Bank Transfer',  'bg-info-subtle text-info',        'fa-university'],
                                                    'razorpay'      => ['Razorpay',       'bg-primary-subtle text-primary',  'fa-credit-card'],
                                                    'stripe'        => ['Stripe',         'bg-indigo-subtle text-indigo',    'fa-stripe'],
                                                    default         => ['Online',         'bg-warning-subtle text-warning',  'fa-globe'],
                                                };
                                            @endphp
                                            <span class="badge {{ $methodLabel[1] }} rounded-pill px-3 py-2">
                                                <i class="fas {{ $methodLabel[2] }} me-1"></i> {{ $methodLabel[0] }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <div class="fw-medium text-dark">{{ $txn->payment_date?->format('d M Y') ?? '—' }}</div>
                                            <div class="small text-muted">{{ $txn->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td class="py-3">
                                            @if(in_array($txn->status, ['success', 'paid']) || $txn->payment_status === 'paid')
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i> Paid
                                                </span>
                                            @else
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle rounded-pill px-3 py-2">
                                                    {{ ucfirst($txn->status ?? 'Pending') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-end pe-4">
                                            <a href="{{ route('payments.receipt', $txn->id) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-outline-primary rounded-3 fw-medium px-3">
                                                <i class="fas fa-file-pdf me-1"></i> Receipt
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                                <i class="fas fa-receipt fa-2x"></i>
                                            </div>
                                            <h6 class="fw-medium text-dark">No payments recorded yet</h6>
                                            <p class="text-muted small mb-0">Receipts will appear here once payments are recorded.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-4 px-2">
                {{ $payments->appends(request()->query())->links() }}
            </div>
        </div>

    </div>{{-- end tab-content --}}

    <script>
        function setStatus(status) {
            document.getElementById('filterStatus').value = status;
        }

        // Auto-open the correct tab (server-driven after filter submit)
        document.addEventListener('DOMContentLoaded', function () {
            const activeTab = '{{ $activeTab }}';
            const hash      = window.location.hash;

            // Priority: server says receipts (after filter) OR hash is receipts
            if (activeTab === 'receipts' || hash === '#receipts') {
                const tab = document.getElementById('receipts-tab');
                if (tab) new bootstrap.Tab(tab).show();
            }

            // Keep hash in sync when user clicks tabs manually
            document.querySelectorAll('#paymentTabs button').forEach(function (btn) {
                btn.addEventListener('shown.bs.tab', function (e) {
                    const target = e.target.getAttribute('data-bs-target');
                    history.replaceState(null, null, target === '#receipts' ? '#receipts' : '#ledger');
                });
            });

            // Live client-side filter: hide rows that don't match the search term
            const searchInput = document.getElementById('receiptSearch');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const q = this.value.toLowerCase().trim();
                    document.querySelectorAll('#receipts tbody tr[data-searchable]').forEach(function (row) {
                        row.style.display = (!q || row.dataset.searchable.includes(q)) ? '' : 'none';
                    });
                });
            }
        });
    </script>
@endsection