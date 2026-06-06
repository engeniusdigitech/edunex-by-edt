@extends('layouts.admin')

@section('title', 'Log Operating Expense')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold text-dark mb-0"><i class="fas fa-receipt text-primary me-2"></i>Log Operating Expense</h5>
                        <p class="text-muted small mb-0">Record outflow vouchers and execute double-entry ledger posting</p>
                    </div>
                    <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary rounded-pill btn-sm px-3">
                        <i class="fas fa-arrow-left me-1"></i>Back
                    </a>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('expenses.store') }}" method="POST" id="expense-form">
                    @csrf
                    
                    <div class="row g-3 mb-3">
                        <!-- Expense Category Ledger -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Expense Category Account Ledger</label>
                            <select name="accounting_ledger_id" class="form-select @error('accounting_ledger_id') is-invalid @enderror" required>
                                <option value="">-- Select Category Ledger --</option>
                                @foreach($expenseLedgers as $ledger)
                                    <option value="{{ $ledger->id }}" {{ old('accounting_ledger_id') == $ledger->id ? 'selected' : '' }}>
                                        {{ $ledger->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('accounting_ledger_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vendor / Supplier -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Supplier / Vendor (Optional)</label>
                            <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror">
                                <option value="">-- Generic Outflow (No Supplier) --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->supplier_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Date -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Expense Date</label>
                            <input type="date" name="expense_date" class="form-control @error('expense_date') is-invalid @enderror" value="{{ old('expense_date', \Carbon\Carbon::today()->format('Y-m-d')) }}" required>
                            @error('expense_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Method -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Payment Outflow Account</label>
                            <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                                <option value="Cash" {{ old('payment_method') === 'Cash' ? 'selected' : '' }}>Cash-in-Hand</option>
                                <option value="Bank" {{ old('payment_method') === 'Bank' ? 'selected' : '' }}>Bank Account (Transfer / Check)</option>
                                <option value="Card" {{ old('payment_method') === 'Card' ? 'selected' : '' }}>Corporate Card</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3 bg-light p-3 rounded-4 border border-light-subtle">
                        <!-- Net Amount -->
                        <div class="col-12 col-sm-4">
                            <label class="form-label text-muted small fw-semibold">Net Base Amount</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 fw-semibold">{{ currencySymbol() }}</span>
                                <input type="number" step="0.01" min="0" name="net_amount" id="net_amount" class="form-control border-start-0 @error('net_amount') is-invalid @enderror" value="{{ old('net_amount') }}" placeholder="0.00" required>
                            </div>
                            @error('net_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- GST Slab -->
                        <div class="col-12 col-sm-4">
                            <label class="form-label text-muted small fw-semibold">GST Rate Slab</label>
                            <select name="gst_rate" id="gst_rate" class="form-select @error('gst_rate') is-invalid @enderror" required>
                                <option value="0" {{ old('gst_rate') == 0 ? 'selected' : '' }}>Exempt / 0%</option>
                                <option value="5" {{ old('gst_rate') == 5 ? 'selected' : '' }}>5% GST</option>
                                <option value="12" {{ old('gst_rate') == 12 ? 'selected' : '' }}>12% GST</option>
                                <option value="18" {{ old('gst_rate') == 18 ? 'selected' : '' }}>18% GST (Standard Services)</option>
                                <option value="28" {{ old('gst_rate') == 28 ? 'selected' : '' }}>28% GST (Luxury goods)</option>
                            </select>
                            @error('gst_rate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- GST Type -->
                        <div class="col-12 col-sm-4">
                            <label class="form-label text-muted small fw-semibold">GST Tax Classification</label>
                            <select name="gst_type" id="gst_type" class="form-select @error('gst_type') is-invalid @enderror" required>
                                <option value="none" {{ old('gst_type') === 'none' ? 'selected' : '' }}>None (No GST)</option>
                                <option value="cgst_sgst" {{ old('gst_type') === 'cgst_sgst' ? 'selected' : '' }}>CGST + SGST (Intrastate)</option>
                                <option value="igst" {{ old('gst_type') === 'igst' ? 'selected' : '' }}>IGST (Interstate)</option>
                            </select>
                            @error('gst_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Dynamic Math Preview card -->
                    <div class="card border border-primary-subtle bg-primary-subtle p-3 mb-3 rounded-4 d-none" id="calc-preview-card">
                        <div class="d-flex justify-content-between text-xs text-primary-emphasis mb-1">
                            <span>Base Net Outflow:</span>
                            <span class="fw-semibold" id="preview-net">0.00</span>
                        </div>
                        <div class="d-flex justify-content-between text-xs text-primary-emphasis mb-2">
                            <span>Input Tax portion (GST):</span>
                            <span class="fw-semibold" id="preview-gst">0.00</span>
                        </div>
                        <div class="d-flex justify-content-between text-sm text-primary-emphasis border-top pt-2">
                            <span class="fw-bold">Total Cash Outflow:</span>
                            <span class="fw-bold fs-6" id="preview-total">0.00</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Invoice / Reference Number</label>
                        <input type="text" name="reference_no" class="form-control @error('reference_no') is-invalid @enderror" value="{{ old('reference_no') }}" placeholder="e.g. INV-10029">
                        @error('reference_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-semibold">Transaction Narration / Description</label>
                        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Provide transaction narration splits details...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2.5 shadow-sm">
                        <i class="fas fa-check-circle me-1"></i>Post Expense Voucher
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const netInput = document.getElementById('net_amount');
    const rateSelect = document.getElementById('gst_rate');
    const typeSelect = document.getElementById('gst_type');
    const previewCard = document.getElementById('calc-preview-card');
    
    const previewNet = document.getElementById('preview-net');
    const previewGst = document.getElementById('preview-gst');
    const previewTotal = document.getElementById('preview-total');

    function calculate() {
        const net = parseFloat(netInput.value) || 0;
        const rate = parseFloat(rateSelect.value) || 0;
        const gstType = typeSelect.value;
        
        let gst = 0;
        if (rate > 0 && gstType !== 'none') {
            gst = (net * rate) / 100;
        }

        const total = net + gst;

        if (net > 0) {
            previewCard.classList.remove('d-none');
            previewNet.textContent = '{{ currencySymbol() }}' + net.toFixed(2);
            previewGst.textContent = '{{ currencySymbol() }}' + gst.toFixed(2);
            previewTotal.textContent = '{{ currencySymbol() }}' + total.toFixed(2);
        } else {
            previewCard.classList.add('d-none');
        }
    }

    // Bind listeners
    netInput.addEventListener('input', calculate);
    rateSelect.addEventListener('change', calculate);
    typeSelect.addEventListener('change', function() {
        if (this.value === 'none') {
            rateSelect.value = "0";
        } else if (rateSelect.value === "0") {
            rateSelect.value = "18"; // default standard
        }
        calculate();
    });

    rateSelect.addEventListener('change', function() {
        if (this.value === '0') {
            typeSelect.value = "none";
        } else if (typeSelect.value === 'none') {
            typeSelect.value = "cgst_sgst"; // default
        }
        calculate();
    });
});
</script>
@endsection
