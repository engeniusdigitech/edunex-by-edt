@extends('layouts.admin')
@section('title', 'Hostel Invoices')
@section('content')
<style>
.b-hdr{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.b-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.b-card{background:#fff;border:1px solid #F1F5F9;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.03);overflow:hidden;}
.b-sec-hdr{padding:16px 28px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;font-size:.78rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;display:flex;align-items:center;gap:10px;}
.btn-pay{background:#10B981;border:none;color:#fff;padding:6px 14px;border-radius:8px;font-size:.78rem;font-weight:700;cursor:pointer;transition:all .2s;}
.btn-pay:hover{background:#059669;}
</style>

<div class="b-hdr">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-file-invoice-dollar me-1"></i> Hostel Billing</span>
        <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Hostel Invoices</h2>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-4 border-success-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="b-card">
    <div class="b-sec-hdr"><i class="fas fa-receipt text-primary"></i> Invoices Log</div>
    
    <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
        <form action="" method="GET" class="d-flex gap-2 flex-grow-1" style="max-width:450px;">
            <input type="text" name="search" class="form-control" placeholder="Search by student name..." value="{{ request('search') }}">
            <select name="status" class="form-select" style="max-width: 150px;">
                <option value="">— Status —</option>
                <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size:.88rem;">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Student</th>
                    <th>Billing Month</th>
                    <th>Invoice Amount</th>
                    <th>Paid Amount</th>
                    <th>Balance Due</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bills as $bill)
                    <tr>
                        <td class="ps-4 fw-bold text-dark">{{ $bill->student->name }}</td>
                        <td>{{ $bill->billing_month->format('F Y') }}</td>
                        <td class="fw-bold">{{ currencySymbol() }}{{ number_format($bill->amount, 2) }}</td>
                        <td>{{ currencySymbol() }}{{ number_format($bill->paid_amount, 2) }}</td>
                        <td class="text-{{ $bill->due_amount > 0 ? 'danger' : 'muted' }} fw-bold">{{ currencySymbol() }}{{ number_format($bill->due_amount, 2) }}</td>
                        <td style="font-size: .8rem;">{{ $bill->description }}</td>
                        <td>
                            @if($bill->status === 'paid')
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Paid</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Unpaid</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            @if($bill->status !== 'paid')
                                <form action="{{ route('hostel-bills.update', $bill) }}" method="POST" onsubmit="return confirm('Do you want to mark this bill as Paid?');" style="margin:0;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-pay"><i class="fas fa-check"></i> Mark Paid</button>
                                </form>
                            @else
                                <span class="text-muted small"><i class="fas fa-check-double text-success"></i> Settlement done</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No monthly billing records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $bills->links() }}
</div>
@endsection
