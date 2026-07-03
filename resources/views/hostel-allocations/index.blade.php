@extends('layouts.admin')
@section('title', 'Hostel Room Allocations')
@section('content')
<style>
.a-hdr{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.a-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.a-card{background:#fff;border:1px solid #F1F5F9;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.03);overflow:hidden;}
.a-sec-hdr{padding:16px 28px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;font-size:.78rem;font-weight:500;color:#475569;text-transform:uppercase;letter-spacing:.8px;display:flex;align-items:center;gap:10px;}
.a-body{padding:24px;}
.btn-action{background:#fff;border:1px solid #E2E8F0;padding:6px 12px;border-radius:8px;font-size:.8rem;font-weight:600;color:#475569;text-decoration:none;transition:all .2s;}
.btn-action:hover{background:#FEF2F2;border-color:#FCA5A5;color:#EF4444;}
.btn-add{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-size:.85rem;font-weight:500;display:inline-flex;align-items:center;gap:8px;text-decoration:none;box-shadow:0 4px 15px rgba(79,70,229,.35);}
.btn-add:hover{color:#fff;transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);}
</style>

<div class="a-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-user-tag me-1"></i> Room Allocations</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Student Room Allocations</h2>
    </div>
    <div style="position:relative;z-index:2;">
        <a href="{{ route('hostel-allocations.create') }}" class="btn-add"><i class="fas fa-plus"></i> Allocate Room</a>
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
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('hostels.index') }}">
                    <i class="fas fa-building me-2"></i>Hostel Blocks
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('hostel-allocations.index') }}">
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
    <!-- Utility billing block -->
    <div class="col-lg-4">
        <div class="a-card mb-4">
            <div class="a-sec-hdr"><i class="fas fa-file-invoice-dollar text-primary"></i> Monthly Billing Engine</div>
            <div class="a-body">
                <p style="font-size:.82rem;color:#64748B;line-height:1.6;margin-bottom:20px;">Generate monthly rental invoices automatically for all students holding active room allocations.</p>
                <form action="{{ route('hostel-allocations.bills.generate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" style="font-size:.7rem;font-weight:500;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:6px;">Select Billing Month</label>
                        <input type="month" name="billing_month" class="form-control" value="{{ date('Y-m') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-medium" style="background:#4F46E5;border:none;"><i class="fas fa-cogs"></i> Run Billing Engine</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Allocations list table -->
    <div class="col-lg-8">
        <div class="a-card">
            <div class="a-sec-hdr"><i class="fas fa-list text-primary"></i> Allocation History</div>
            
            <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                <form action="" method="GET" class="d-flex gap-2 flex-grow-1" style="max-width:400px;">
                    <input type="text" name="search" class="form-control" placeholder="Search by student name..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size:.88rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Student</th>
                            <th>Hostel Block</th>
                            <th>Room No.</th>
                            <th>Allocated From</th>
                            <th>Allocated To</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allocations as $alloc)
                            <tr>
                                <td class="ps-4 fw-medium text-dark">{{ $alloc->student->name }}</td>
                                <td>{{ $alloc->room->hostel->name }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $alloc->room->room_number }}</span></td>
                                <td>{{ $alloc->allocated_from->format('M d, Y') }}</td>
                                <td>{{ $alloc->allocated_to ? $alloc->allocated_to->format('M d, Y') : '—' }}</td>
                                <td>
                                    @if($alloc->status === 'active')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Active</span>
                                    @elseif($alloc->status === 'completed')
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill">Completed</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Cancelled</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    @if($alloc->status === 'active')
                                        <form action="{{ route('hostel-allocations.checkout', $alloc) }}" method="POST" onsubmit="return confirm('Do you want to check out this student from room {{ $alloc->room->room_number }}?');" style="margin:0;">
                                            @csrf
                                            <button type="submit" class="btn-action"><i class="fas fa-door-open me-1"></i> Checkout</button>
                                        </form>
                                    @else
                                        <span class="text-muted small">Checked out</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No room allocations registered yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $allocations->links() }}
        </div>
    </div>
</div>
@endsection
