@extends('layouts.admin')
@section('title', 'Hostel Blocks')
@section('content')
<style>
.h-hdr{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.h-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.h-card{background:#fff;border:1px solid #F1F5F9;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.03);overflow:hidden;transition:all .2s;}
.h-card:hover{transform:translateY(-2px);box-shadow:0 10px 25px rgba(0,0,0,.05);border-color:rgba(79,70,229,.25);}
.h-tag{font-size:.7rem;font-weight:500;padding:4px 10px;border-radius:50px;text-transform:uppercase;letter-spacing:.5px;}
.tag-boys{background:#EFF6FF;color:#2563EB;}
.tag-girls{background:#FDF2F8;color:#DB2777;}
.tag-mixed{background:#F0FDF4;color:#16A34A;}
.btn-action{width:36px;height:36px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;color:#64748B;border:1px solid #E2E8F0;background:#fff;text-decoration:none;transition:all .2s;}
.btn-action:hover{color:#4F46E5;border-color:#4F46E5;background:#EEF2FF;}
.btn-add{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-size:.85rem;font-weight:500;display:inline-flex;align-items:center;gap:8px;text-decoration:none;box-shadow:0 4px 15px rgba(79,70,229,.35);}
.btn-add:hover{color:#fff;transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);}
</style>

<div class="h-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-hotel me-1"></i> Boarding &amp; Residence</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Hostel Blocks</h2>
    </div>
    <div style="position:relative;z-index:2;">
        <a href="{{ route('hostels.create') }}" class="btn-add"><i class="fas fa-plus"></i> Add Hostel Block</a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('hostels.dashboard') }}">
                    <i class="fas fa-chart-pie me-2"></i>Overview
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('hostels.index') }}">
                    <i class="fas fa-building me-2"></i>Hostel Blocks
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('hostel-allocations.index') }}">
                    <i class="fas fa-user-tag me-2"></i>Allocations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('hostel-bills.index') }}">
                    <i class="fas fa-file-invoice-dollar me-2"></i>Invoices
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('hostel-messes.index') }}">
                    <i class="fas fa-utensils me-2"></i>Messes
                </a>
            </li>
        </ul>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-4 border-success-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="row g-4">
    @forelse($hostels as $hostel)
        <div class="col-md-6 col-lg-4">
            <div class="h-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="h-tag tag-{{ $hostel->type }}">{{ $hostel->type }} Block</span>
                    <span style="font-size:.75rem;color:#64748B;font-weight:600;"><i class="fas fa-door-open me-1"></i> {{ $hostel->rooms_count }} Rooms</span>
                </div>
                <h4 style="font-size:1.15rem;font-weight:500;color:#1E293B;margin-bottom:8px;letter-spacing:-.3px;">{{ $hostel->name }}</h4>
                <p style="font-size:.85rem;color:#64748B;line-height:1.5;min-height:42px;margin-bottom:20px;">{{ $hostel->description ?: 'No description provided for this hostel block.' }}</p>
                @if($hostel->address)
                    <div style="font-size:.78rem;color:#64748B;margin-bottom:20px;display:flex;gap:6px;align-items:flex-start;">
                        <i class="fas fa-location-dot" style="color:#4F46E5;margin-top:3px;flex-shrink:0;"></i>
                        <span>{{ $hostel->address }}</span>
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center pt-3 border-top" style="border-color:#F1F5F9!important;">
                    <a href="{{ route('hostels.show', $hostel) }}" style="font-size:.82rem;color:#4F46E5;text-decoration:none;font-weight:500;display:inline-flex;align-items:center;gap:6px;">View Rooms <i class="fas fa-arrow-right"></i></a>
                    <div class="d-flex gap-2">
                        <a href="{{ route('hostels.edit', $hostel) }}" class="btn-action" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('hostels.destroy', $hostel) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this hostel? All associated rooms and allocations will be deleted.');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action" style="color:#EF4444;" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:18px;padding:60px 20px;text-align:center;color:#64748B;">
                <i class="fas fa-hotel fs-1 mb-3" style="color:#CBD5E1;"></i>
                <h5 class="text-dark fw-medium">No Hostel Blocks Created</h5>
                <p class="mb-4">Create your first hostel building block to start allocating student beds.</p>
                <a href="{{ route('hostels.create') }}" class="btn-add"><i class="fas fa-plus"></i> Create Hostel Block</a>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $hostels->links() }}
</div>
@endsection
