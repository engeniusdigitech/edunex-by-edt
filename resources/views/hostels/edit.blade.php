@extends('layouts.admin')
@section('title', 'Edit Hostel Block')
@section('content')
<style>
.h-form-header{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.h-form-header::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.h-card{background:#fff;border:1px solid #F1F5F9;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.03);overflow:hidden;}
.h-sec-hdr{padding:16px 28px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;font-size:.78rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;}
.h-body{padding:28px;}
.form-label-custom{display:block;font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px;}
.form-control-custom,.form-select-custom{border:1.5px solid #E2E8F0;border-radius:12px;padding:11px 16px;font-size:.88rem;color:#1E293B;transition:all .2s;background:#fff;}
.form-control-custom:focus,.form-select-custom:focus{border-color:#4F46E5;box-shadow:0 0 0 3px rgba(79,70,229,.08);outline:none;}
.btn-save{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:12px 28px;border-radius:12px;font-size:.88rem;font-weight:700;display:inline-flex;align-items:center;gap:9px;cursor:pointer;transition:all .2s;box-shadow:0 4px 20px rgba(79,70,229,.3);}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 8px 28px rgba(79,70,229,.4);}
</style>

<div class="h-form-header">
    <div style="position:relative;z-index:2;display:flex;align-items:center;gap:14px;">
        <a href="{{ route('hostels.index') }}" style="width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,.08);border:1.5px solid rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;flex-shrink:0;"><i class="fas fa-arrow-left"></i></a>
        <div>
            <div style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><i class="fas fa-hotel me-1"></i> Hostels</div>
            <h2 style="font-size:1.4rem;font-weight:800;color:#fff;margin:0;letter-spacing:-.5px;">Edit Hostel Block</h2>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="h-card">
            <div class="h-sec-hdr"><i class="fas fa-pen text-primary me-2"></i> Edit Building Details</div>
            <div class="h-body">
                <form action="{{ route('hostels.update', $hostel) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Hostel Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control form-control-custom @error('name') is-invalid @enderror" value="{{ old('name', $hostel->name) }}" placeholder="e.g. Boys Hostel A" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Hostel Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-select form-select-custom" required>
                                <option value="mixed" {{ $hostel->type == 'mixed' ? 'selected' : '' }}>Mixed Block</option>
                                <option value="boys" {{ $hostel->type == 'boys' ? 'selected' : '' }}>Boys Block Only</option>
                                <option value="girls" {{ $hostel->type == 'girls' ? 'selected' : '' }}>Girls Block Only</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Address / Location</label>
                        <input type="text" name="address" class="form-control form-control-custom" value="{{ old('address', $hostel->address) }}" placeholder="e.g. Campus North Wing, Near Sports Complex">
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Description</label>
                        <textarea name="description" class="form-control form-control-custom" rows="3" placeholder="Provide extra block details (optional)...">{{ old('description', $hostel->description) }}</textarea>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn-save"><i class="fas fa-save"></i> Update Hostel Block</button>
                        <a href="{{ route('hostels.index') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;font-weight:600;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
