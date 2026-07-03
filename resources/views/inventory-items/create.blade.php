@extends('layouts.admin')
@section('title', 'Add Stock Item')
@section('content')
<style>
.f-hdr{background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.f-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.form-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.btn-save{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:12px 24px;border-radius:10px;font-size:.85rem;font-weight:500;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 15px rgba(79,70,229,.35);transition:all .2s;text-decoration:none;}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);color:#fff;}
</style>

<div class="f-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-boxes me-1"></i> Store &amp; Logistics</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Add New Stock Item</h2>
    </div>
    <div style="position:relative;z-index:2;">
        <a href="{{ route('inventory-items.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-arrow-left me-2"></i> Cancel &amp; Return</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="form-card p-4 p-md-5">
            <form action="{{ route('inventory-items.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="inventory_category_id" class="form-label fw-medium text-dark" style="font-size:.8rem;">Category <span class="text-danger">*</span></label>
                        <select name="inventory_category_id" id="inventory_category_id" class="form-select rounded-3 py-2.5 shadow-none @error('inventory_category_id') is-invalid @enderror" style="font-size:.85rem;" required>
                            <option value="">-- Choose Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('inventory_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('inventory_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="sku" class="form-label fw-medium text-dark" style="font-size:.8rem;">SKU / Item Code</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku') }}" class="form-control rounded-3 py-2.5 shadow-none @error('sku') is-invalid @enderror" style="font-size:.85rem;" placeholder="e.g. UNIFORM-SHIRT-M">
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label fw-medium text-dark" style="font-size:.8rem;">Item Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control rounded-3 py-2.5 shadow-none @error('name') is-invalid @enderror" style="font-size:.85rem;" placeholder="e.g. Secondary Boys Uniform Shirt (Size M)" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="unit" class="form-label fw-medium text-dark" style="font-size:.8rem;">Unit of Measure <span class="text-danger">*</span></label>
                        <input type="text" name="unit" id="unit" value="{{ old('unit', 'pieces') }}" class="form-control rounded-3 py-2.5 shadow-none @error('unit') is-invalid @enderror" style="font-size:.85rem;" placeholder="e.g. pieces, boxes, packets" required>
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4">
                        <label for="unit_price" class="form-label fw-medium text-dark" style="font-size:.8rem;">Unit Price / Cost ($) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">$</span>
                            <input type="number" step="0.01" name="unit_price" id="unit_price" value="{{ old('unit_price') }}" class="form-control rounded-3 py-2.5 shadow-none border-start-0 @error('unit_price') is-invalid @enderror" style="font-size:.85rem;" placeholder="0.00" required>
                        </div>
                        @error('unit_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="min_qty_warning" class="form-label fw-medium text-dark" style="font-size:.8rem;">Low Stock Warning Level <span class="text-danger">*</span></label>
                        <input type="number" name="min_qty_warning" id="min_qty_warning" value="{{ old('min_qty_warning', 5) }}" class="form-control rounded-3 py-2.5 shadow-none @error('min_qty_warning') is-invalid @enderror" style="font-size:.85rem;" placeholder="5" required>
                        @error('min_qty_warning')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="p-3 bg-light rounded-4 border border-light-subtle">
                            <div class="d-flex gap-3 align-items-start">
                                <i class="fas fa-warehouse text-indigo mt-1" style="font-size:1.15rem;color:#4F46E5;"></i>
                                <div class="flex-grow-1">
                                    <label for="available_qty" class="form-label fw-medium text-dark mb-1" style="font-size:.85rem;">Initial Stock Quantity <span class="text-danger">*</span></label>
                                    <p class="text-muted small mb-2">Input the current quantity of this item physically present in the store room. This will write an initial stock-in record.</p>
                                    <input type="number" name="available_qty" id="available_qty" value="{{ old('available_qty', 0) }}" class="form-control rounded-3 py-2 shadow-none @error('available_qty') is-invalid @enderror" style="font-size:.85rem;max-width:200px;" required>
                                    @error('available_qty')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5 pt-4 border-top" style="border-color:#F1F5F9!important;">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Stock Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
