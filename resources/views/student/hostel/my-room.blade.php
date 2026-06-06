@extends('student.layouts.app')
@section('title', 'My Room Allocation')
@section('content')
<style>
.sh-hdr{background:linear-gradient(135deg,#1E3A8A,#3B82F6);border-radius:18px;padding:24px 28px;margin-bottom:28px;color:#fff;box-shadow:0 4px 15px rgba(30,58,138,0.15);}
.sh-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.sh-card-header{padding:20px 24px;border-bottom:1px solid #F1F5F9;background:#fff;}
.sh-detail-row{display:flex;justify-content:between;padding:12px 0;border-bottom:1px solid #F8FAFC;}
.sh-detail-row:last-child{border-bottom:none;}
.sh-label{font-size:.8rem;color:#64748B;font-weight:600;}
.sh-value{font-size:.85rem;color:#1E293B;font-weight:700;text-align:right;}
.sh-avatar{width:40px;height:40px;border-radius:50px;background:#EFF6FF;color:#2563EB;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9rem;}
</style>

<div class="sh-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <span style="font-size:.7rem;font-weight:700;color:#93C5FD;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-hotel me-1"></i> Residence &amp; Dorms</span>
        <h2 style="font-size:1.35rem;font-weight:800;margin:4px 0 0;letter-spacing:-.5px;">My Hostel Room</h2>
    </div>
    <div>
        <a href="{{ route('student.dashboard') }}" class="btn btn-outline-light rounded-pill px-4" style="font-size:.85rem;font-weight:600;"><i class="fas fa-home me-1"></i> Dashboard</a>
    </div>
</div>

@if(!$allocation)
    <div class="sh-card p-5 text-center text-muted">
        <i class="fas fa-door-closed fs-1 mb-3 text-secondary" style="opacity:.4;"></i>
        <h4 class="text-dark fw-bold">No Room Allocated Yet</h4>
        <p class="mb-4">You currently do not have an active hostel bed allocation. Please contact the warden office to request room allocation.</p>
        <div class="d-inline-flex gap-3 bg-light p-3 rounded-4 border">
            <i class="fas fa-info-circle text-primary mt-1"></i>
            <div class="text-start">
                <div class="fw-bold text-dark" style="font-size:.85rem;">Administration Office</div>
                <div class="small">Office hours: 9:00 AM - 5:00 PM (Monday to Friday)</div>
            </div>
        </div>
    </div>
@else
    <div class="row g-4">
        <!-- Room Specifications -->
        <div class="col-lg-5">
            <div class="sh-card">
                <div class="sh-card-header">
                    <h5 class="fw-bold text-dark mb-0" style="font-size:1.05rem;"><i class="fas fa-key text-primary me-2"></i> Room Specifications</h5>
                </div>
                <div class="p-4">
                    <div class="sh-detail-row d-flex justify-content-between">
                        <span class="sh-label">Hostel Block</span>
                        <span class="sh-value">{{ $allocation->room->hostel->name }}</span>
                    </div>
                    <div class="sh-detail-row d-flex justify-content-between">
                        <span class="sh-label">Hostel Gender Rule</span>
                        <span class="sh-value" style="text-transform:capitalize;">{{ $allocation->room->hostel->type }} Block</span>
                    </div>
                    <div class="sh-detail-row d-flex justify-content-between">
                        <span class="sh-label">Room Number</span>
                        <span class="sh-value font-monospace" style="color:#2563EB;">{{ $allocation->room->room_number }}</span>
                    </div>
                    <div class="sh-detail-row d-flex justify-content-between">
                        <span class="sh-label">Room Type</span>
                        <span class="sh-value">{{ $allocation->room->room_type }}</span>
                    </div>
                    <div class="sh-detail-row d-flex justify-content-between">
                        <span class="sh-label">Bed Capacity</span>
                        <span class="sh-value">{{ $allocation->room->capacity }} Beds</span>
                    </div>
                    <div class="sh-detail-row d-flex justify-content-between">
                        <span class="sh-label">Monthly Billing Rate</span>
                        <span class="sh-value text-success">${{ number_format($allocation->room->cost_per_month, 2) }}</span>
                    </div>
                    <div class="sh-detail-row d-flex justify-content-between">
                        <span class="sh-label">Allocated From</span>
                        <span class="sh-value">{{ \Carbon\Carbon::parse($allocation->allocated_from)->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Roommates -->
        <div class="col-lg-7">
            <div class="sh-card">
                <div class="sh-card-header">
                    <h5 class="fw-bold text-dark mb-0" style="font-size:1.05rem;"><i class="fas fa-users text-primary me-2"></i> Roommates Directory</h5>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr style="font-size:.78rem;color:#475569;">
                                <th class="ps-4">Roommate Name</th>
                                <th>Batch / Class</th>
                                <th class="pe-4 text-end">Contact Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roommates as $mate)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="sh-avatar">
                                                {{ strtoupper(substr($mate->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size:.85rem;">{{ $mate->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="font-size:.82rem;color:#334155;">
                                        {{ $mate->batch->name ?? 'No Batch' }}
                                    </td>
                                    <td class="pe-4 text-end" style="font-size:.82rem;color:#64748B;">
                                        <a href="mailto:{{ $mate->email }}" class="text-decoration-none text-secondary"><i class="far fa-envelope me-1"></i> {{ $mate->email }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-friends fs-3 mb-2" style="color:#CBD5E1;"></i>
                                        <div class="fw-bold">No Roommates Assigned</div>
                                        <div class="small">You are currently the only student registered in this room block.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
