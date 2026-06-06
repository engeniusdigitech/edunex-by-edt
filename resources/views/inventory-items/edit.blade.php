@extends('layouts.admin')
@section('title', 'Edit Stock Item')
@section('content')
<style>
.f-hdr{background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.f-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.form-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.btn-save{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:12px 24px;border-radius:10px;font-size:.85rem;font-weight:700;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 15px rgba(79,70,229,.35);transition:all .2s;text-decoration:none;cursor:pointer;}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);color:#fff;}
</style>

<div class="f-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-boxes me-1"></i> Store &amp; Logistics</span>
        <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Edit Stock Item: {{ $inventoryItem->name }}</h2>
    </div>
    <div style="position:relative;z-index:2;">
        <a href="{{ route('inventory-items.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-arrow-left me-2"></i> Cancel &amp; Return</a>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger rounded-4 border-danger-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="form-card p-4 p-md-5">
            <form action="{{ route('inventory-items.update', $inventoryItem) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h5 class="fw-bold mb-4 text-dark" style="letter-spacing:-.3px;"><i class="fas fa-edit me-2 text-indigo" style="color:#4F46E5;"></i> Basic Information</h5>
                
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <label for="inventory_category_id" class="form-label fw-bold text-dark" style="font-size:.8rem;">Category <span class="text-danger">*</span></label>
                        <select name="inventory_category_id" id="inventory_category_id" class="form-select rounded-3 py-2.5 shadow-none" style="font-size:.85rem;" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('inventory_category_id', $inventoryItem->inventory_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="sku" class="form-label fw-bold text-dark" style="font-size:.8rem;">SKU / Item Code</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku', $inventoryItem->sku) }}" class="form-control rounded-3 py-2.5 shadow-none" style="font-size:.85rem;" placeholder="e.g. SKU-1002">
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label fw-bold text-dark" style="font-size:.8rem;">Item Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $inventoryItem->name) }}" class="form-control rounded-3 py-2.5 shadow-none" style="font-size:.85rem;" required>
                    </div>

                    <div class="col-md-4">
                        <label for="unit" class="form-label fw-bold text-dark" style="font-size:.8rem;">Unit of Measure <span class="text-danger">*</span></label>
                        <input type="text" name="unit" id="unit" value="{{ old('unit', $inventoryItem->unit) }}" class="form-control rounded-3 py-2.5 shadow-none" required>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="unit_price" class="form-label fw-bold text-dark" style="font-size:.8rem;">Unit Price / Cost ($) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">$</span>
                            <input type="number" step="0.01" name="unit_price" id="unit_price" value="{{ old('unit_price', $inventoryItem->unit_price) }}" class="form-control rounded-3 py-2.5 shadow-none border-start-0" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="min_qty_warning" class="form-label fw-bold text-dark" style="font-size:.8rem;">Low Stock Warning Level <span class="text-danger">*</span></label>
                        <input type="number" name="min_qty_warning" id="min_qty_warning" value="{{ old('min_qty_warning', $inventoryItem->min_qty_warning) }}" class="form-control rounded-3 py-2.5 shadow-none" required>
                    </div>
                </div>

                <hr class="my-5" style="border-color:#E2E8F0!important;">

                <div class="p-4 bg-light rounded-4 border border-light-subtle">
                    <div class="d-flex gap-3 align-items-start mb-4">
                        <div style="width:40px;height:40px;border-radius:10px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1 text-dark" style="font-size:1rem;">Manual Stock Level Adjustment</h5>
                            <p class="text-muted small mb-0">Directly adjust inventory levels if items were damaged, lost, or manually added/removed. Current stock level: <strong>{{ $inventoryItem->available_qty }} {{ $inventoryItem->unit }}</strong>.</p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <label for="adjust_qty" class="form-label fw-bold text-dark" style="font-size:.8rem;">Adjustment Quantity</label>
                            <input type="number" name="adjust_qty" id="adjust_qty" value="{{ old('adjust_qty') }}" class="form-control rounded-3 py-2.5 shadow-none" placeholder="Leave empty for no change" min="0">
                        </div>

                        <div class="col-md-4">
                            <label for="adjust_type" class="form-label fw-bold text-dark" style="font-size:.8rem;">Adjustment Action</label>
                            <select name="adjust_type" id="adjust_type" class="form-select rounded-3 py-2.5 shadow-none">
                                <option value="add" {{ old('adjust_type') == 'add' ? 'selected' : '' }}>Add to Stock (+)</option>
                                <option value="subtract" {{ old('adjust_type') == 'subtract' ? 'selected' : '' }}>Subtract from Stock (-)</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="adjust_reason" class="form-label fw-bold text-dark" style="font-size:.8rem;">Reason / Reference</label>
                            <input type="text" name="adjust_reason" id="adjust_reason" value="{{ old('adjust_reason') }}" class="form-control rounded-3 py-2.5 shadow-none" placeholder="e.g. Damaged during transfer">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5 pt-4 border-top" style="border-color:#F1F5F9!important;">
                    <button type="submit" class="btn-save"><i class="fas fa-save"></i> Update Stock Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
