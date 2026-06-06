@extends('layouts.admin')
@section('title', 'Allocate Room')
@section('content')
<style>
.a-form-header{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.a-form-header::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.a-card{background:#fff;border:1px solid #F1F5F9;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.03);overflow:hidden;}
.a-sec-hdr{padding:16px 28px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;font-size:.78rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;}
.a-body{padding:28px;}
.form-label-custom{display:block;font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px;}
.form-control-custom,.form-select-custom{border:1.5px solid #E2E8F0;border-radius:12px;padding:11px 16px;font-size:.88rem;color:#1E293B;transition:all .2s;background:#fff;}
.form-control-custom:focus,.form-select-custom:focus{border-color:#4F46E5;box-shadow:0 0 0 3px rgba(79,70,229,.08);outline:none;}
.btn-save{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:12px 28px;border-radius:12px;font-size:.88rem;font-weight:700;display:inline-flex;align-items:center;gap:9px;cursor:pointer;transition:all .2s;box-shadow:0 4px 20px rgba(79,70,229,.3);}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 8px 28px rgba(79,70,229,.4);}
</style>

<div class="a-form-header">
    <div style="position:relative;z-index:2;display:flex;align-items:center;gap:14px;">
        <a href="{{ route('hostel-allocations.index') }}" style="width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,.08);border:1.5px solid rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;flex-shrink:0;"><i class="fas fa-arrow-left"></i></a>
        <div>
            <div style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><i class="fas fa-user-tag me-1"></i> Room Allocations</div>
            <h2 style="font-size:1.4rem;font-weight:800;color:#fff;margin:0;letter-spacing:-.5px;">Allocate Room</h2>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="a-card">
            <div class="a-sec-hdr"><i class="fas fa-bed text-primary me-2"></i> Allocation Details</div>
            <div class="a-body">
                <form action="{{ route('hostel-allocations.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label-custom">Select Student <span class="text-danger">*</span></label>
                        <select name="student_id" class="form-select form-select-custom @error('student_id') is-invalid @enderror" required>
                            <option value="">— Select Student —</option>
                            @foreach($students as $s)
                                <option value="{{ $s->id }}" {{ old('student_id')==$s->id?'selected':'' }}>{{ $s->name }} (Batch: {{ $s->batch->name ?? 'None' }})</option>
                            @endforeach
                        </select>
                        @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Select Hostel Room <span class="text-danger">*</span></label>
                        <select name="hostel_room_id" class="form-select form-select-custom @error('hostel_room_id') is-invalid @enderror" required>
                            <option value="">— Select Room —</option>
                            @foreach($rooms as $r)
                                <option value="{{ $r->id }}" {{ old('hostel_room_id')==$r->id?'selected':'' }}>{{ $r->hostel->name }} — Room {{ $r->room_number }} ({{ $r->room_type }} · {{ $r->available_beds }} beds free · {{ currencySymbol() }}{{ number_format($r->cost_per_month, 2) }}/mo)</option>
                            @endforeach
                        </select>
                        @error('hostel_room_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Allocation Start Date <span class="text-danger">*</span></label>
                        <input type="date" name="allocated_from" class="form-control form-control-custom @error('allocated_from') is-invalid @enderror" value="{{ old('allocated_from', date('Y-m-d')) }}" required>
                        @error('allocated_from')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn-save"><i class="fas fa-check"></i> Assign Room</button>
                        <a href="{{ route('hostel-allocations.index') }}" style="font-size:.85rem;color:#64748B;text-decoration:none;font-weight:600;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
