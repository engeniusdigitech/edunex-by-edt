@extends('layouts.admin')
@section('title', 'Draft Purchase Order')
@section('content')
<style>
.f-hdr{background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.f-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.form-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.btn-save{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:12px 24px;border-radius:10px;font-size:.85rem;font-weight:700;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 15px rgba(79,70,229,.35);transition:all .2s;text-decoration:none;}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);color:#fff;}
</style>

<div class="f-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-boxes me-1"></i> Store &amp; Logistics</span>
        <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Draft New Purchase Order</h2>
    </div>
    <div style="position:relative;z-index:2;">
        <a href="{{ route('purchase-orders.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-arrow-left me-2"></i> Cancel &amp; Return</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card p-4 p-md-5">
            <form action="{{ route('purchase-orders.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="po_number" class="form-label fw-bold text-dark" style="font-size:.8rem;">PO Number <span class="text-danger">*</span></label>
                        <input type="text" name="po_number" id="po_number" value="{{ old('po_number', $poNumber) }}" class="form-control rounded-3 py-2.5 shadow-none @error('po_number') is-invalid @enderror" style="font-size:.85rem; font-weight:700; color:#4F46E5;" required readonly>
                        <span class="text-muted small" style="font-size:.75rem;">Generated automatically to ensure uniqueness.</span>
                        @error('po_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="inventory_supplier_id" class="form-label fw-bold text-dark" style="font-size:.8rem;">Select Supplier / Vendor <span class="text-danger">*</span></label>
                        <select name="inventory_supplier_id" id="inventory_supplier_id" class="form-select rounded-3 py-2.5 shadow-none @error('inventory_supplier_id') is-invalid @enderror" style="font-size:.85rem;" required>
                            <option value="">-- Choose Vendor --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('inventory_supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }} (Contact: {{ $supplier->contact_person ?: 'N/A' }})</option>
                            @endforeach
                        </select>
                        @error('inventory_supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="order_date" class="form-label fw-bold text-dark" style="font-size:.8rem;">Requisition / Order Date <span class="text-danger">*</span></label>
                        <input type="date" name="order_date" id="order_date" value="{{ old('order_date', date('Y-m-d')) }}" class="form-control rounded-3 py-2.5 shadow-none @error('order_date') is-invalid @enderror" style="font-size:.85rem;" required>
                        @error('order_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="delivery_date" class="form-label fw-bold text-dark" style="font-size:.8rem;">Expected Delivery Date</label>
                        <input type="date" name="delivery_date" id="delivery_date" value="{{ old('delivery_date') }}" class="form-control rounded-3 py-2.5 shadow-none @error('delivery_date') is-invalid @enderror" style="font-size:.85rem;">
                        @error('delivery_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5 pt-4 border-top" style="border-color:#F1F5F9!important;">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save &amp; Add Line Items</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
