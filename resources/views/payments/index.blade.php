@extends('layouts.admin')

@section('title', 'Fees & Payments')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h4 class="fw-bold text-dark mb-1">Fee Tracking</h4>
            <p class="text-muted small mb-0">Monitor student dues and payment statuses</p>
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

    <!-- Filters -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="text-muted small fw-bold text-uppercase me-2" style="letter-spacing: 0.5px;">Filter by
                    Status:</span>
                <a href="{{ route('payments.index') }}"
                    class="btn btn-sm btn-modern px-3 {{ !request()->filled('status') ? 'btn-primary' : 'btn-light border text-muted' }}">
                    All
                </a>
                <a href="{{ route('payments.index', ['status' => 'paid']) }}"
                    class="btn btn-sm btn-modern px-3 {{ request('status') == 'paid' ? 'btn-success' : 'btn-light border text-muted' }}">
                    <i class="fas fa-check-circle me-1"></i> Paid
                </a>
                <a href="{{ route('payments.index', ['status' => 'partial']) }}"
                    class="btn btn-sm btn-modern px-3 {{ request('status') == 'partial' ? 'btn-warning' : 'btn-light border text-muted' }}">
                    <i class="fas fa-adjust me-1"></i> Partially Paid
                </a>
                <a href="{{ route('payments.index', ['status' => 'pending']) }}"
                    class="btn btn-sm btn-modern px-3 {{ request('status') == 'pending' ? 'btn-danger' : 'btn-light border text-muted' }}">
                    <i class="fas fa-clock me-1"></i> Pending
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div
            class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
            <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 bg-white shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #F8FAFC;">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Student & Batch</th>
                            <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Fee Structure</th>
                            <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0 text-center"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Total amount</th>
                            <th class="py-3 text-uppercase text-muted fw-semibold text-center border-bottom-0"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Paid</th>
                            <th class="py-3 text-uppercase text-muted fw-semibold text-center border-bottom-0"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Due</th>
                            <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                            <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0 text-end pe-4"
                                style="font-size: 0.75rem; letter-spacing: 1px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fees as $fee)
                            <tr>
                                <td class="ps-4 py-4">
                                    <div class="fw-bold text-dark mb-1">{{ $fee->student->name ?? 'Deleted Student' }}</div>
                                    <div class="small text-muted">
                                        <i class="fas fa-layer-group text-opacity-50 me-1"></i>
                                        {{ $fee->student->batch->name ?? 'No Batch' }}
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="fw-medium text-dark">{{ $fee->feeStructure->name ?? 'General Fee' }}</div>
                                    <div class="small text-muted">
                                        {{ $fee->feeStructure->category->name ?? '' }}
                                    </div>
                                </td>
                                <td class="py-4 text-center fw-bold text-dark">₹{{ number_format($fee->amount, 2) }}</td>
                                <td class="py-4 text-center">
                                    <span class="text-success fw-bold">₹{{ number_format($fee->paid_amount, 2) }}</span>
                                </td>
                                <td class="py-4 text-center">
                                    <span
                                        class="{{ $fee->due_amount > 0 ? 'text-danger' : 'text-muted' }} fw-bold">₹{{ number_format($fee->due_amount, 2) }}</span>
                                </td>
                                <td class="py-4">
                                    @if($fee->status == 'paid')
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2 fw-bold">Paid</span>
                                    @elseif($fee->status == 'partial')
                                        <span
                                            class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle rounded-pill px-3 py-2 fw-bold">Partial</span>
                                    @else
                                        <span
                                            class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill px-3 py-2 fw-bold">Pending</span>
                                    @endif
                                </td>
                                <td class="py-4 text-end pe-4">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-3 shadow-none" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                            <li>
                                                <a class="dropdown-item rounded-3 py-2"
                                                    href="{{ route('payments.create', ['student_id' => $fee->student_id, 'fee_structure_id' => $fee->fee_structure_id]) }}">
                                                    <i class="fas fa-plus-circle text-primary me-2"></i> Record Payment
                                                </a>
                                            </li>
                                            {{-- We can add View History, Send Reminder, etc here --}}
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
                                    <h6 class="fw-bold text-dark">No records found</h6>
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
@endsection