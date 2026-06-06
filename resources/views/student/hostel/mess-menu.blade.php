@extends('student.layouts.app')
@section('title', 'Weekly Mess Menu')
@section('content')
<style>
.sh-hdr{background:linear-gradient(135deg,#1E3A8A,#3B82F6);border-radius:18px;padding:24px 28px;margin-bottom:28px;color:#fff;box-shadow:0 4px 15px rgba(30,58,138,0.15);}
.sh-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.sh-card-header{padding:20px 24px;border-bottom:1px solid #F1F5F9;background:#fff;}
.menu-table{width:100%;border-collapse:collapse;}
.menu-th{background:#F8FAFC;border-bottom:2px solid #E2E8F0;font-weight:700;color:#334155;text-transform:uppercase;font-size:.72rem;letter-spacing:.5px;padding:16px;text-align:center;}
.menu-td-day{background:#F8FAFC;font-weight:700;color:#1E293B;border-right:1px solid #E2E8F0;border-bottom:1px solid #F1F5F9;padding:16px;text-transform:capitalize;font-size:.82rem;}
.menu-td-cell{border-bottom:1px solid #F1F5F9;border-right:1px solid #F1F5F9;padding:16px;vertical-align:top;font-size:.8rem;color:#334155;}
.menu-td-cell:last-child{border-right:none;}
.meal-item{background:#F8FAFC;border:1px solid #F1F5F9;border-radius:8px;padding:10px;height:100%;min-height:80px;line-height:1.4;}
.meal-title{font-size:.7rem;font-weight:800;text-transform:uppercase;color:#4F46E5;margin-bottom:6px;display:flex;align-items:center;gap:4px;}
.meal-content{font-weight:500;color:#334155;}
</style>

<div class="sh-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <span style="font-size:.7rem;font-weight:700;color:#93C5FD;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-utensils me-1"></i> Mess &amp; Catering</span>
        <h2 style="font-size:1.35rem;font-weight:800;margin:4px 0 0;letter-spacing:-.5px;">Weekly Nutrition Plan</h2>
    </div>
    <div>
        <a href="{{ route('student.dashboard') }}" class="btn btn-outline-light rounded-pill px-4" style="font-size:.85rem;font-weight:600;"><i class="fas fa-home me-1"></i> Dashboard</a>
    </div>
</div>

@if(!$sub)
    <div class="sh-card p-5 text-center text-muted">
        <i class="fas fa-utensils fs-1 mb-3 text-secondary" style="opacity:.4;"></i>
        <h4 class="text-dark fw-bold">No Active Mess Subscription</h4>
        <p class="mb-4">You are currently not subscribed to any boarding school mess hall plan. Please contact the caterer or administration office to enroll.</p>
        <div class="d-inline-flex gap-3 bg-light p-3 rounded-4 border">
            <i class="fas fa-info-circle text-primary mt-1"></i>
            <div class="text-start">
                <div class="fw-bold text-dark" style="font-size:.85rem;">Boarding Mess Office</div>
                <div class="small">Contact the administration blocks to link room keys to cafeteria packages.</div>
            </div>
        </div>
    </div>
@else
    <div class="row g-4 mb-4">
        <!-- Subscription Summary Card -->
        <div class="col-12">
            <div class="sh-card p-4 d-flex justify-content-between align-items-center flex-wrap gap-3" style="background:#F8FAFC;border-left:5px solid #4F46E5;">
                <div>
                    <h5 class="fw-bold text-dark mb-1" style="font-size:1.05rem;">Active Catering: {{ $mess->name }}</h5>
                    <p class="text-muted small mb-0">Warden/Chef: <strong>{{ $mess->warden_name ?: 'Catering Team' }}</strong> | Subscribed since: {{ \Carbon\Carbon::parse($sub->start_date)->format('M d, Y') }}</p>
                </div>
                <span class="badge bg-success rounded-pill px-4 py-2" style="font-size:.78rem;font-weight:700;"><i class="fas fa-check-circle me-1"></i> Subscribed</span>
            </div>
        </div>

        <!-- Weekly Menu Schedule -->
        <div class="col-12">
            <div class="sh-card">
                <div class="sh-card-header">
                    <h5 class="fw-bold text-dark mb-0" style="font-size:1.05rem;"><i class="fas fa-calendar-alt text-primary me-2"></i> Weekly Catering Schedule</h5>
                </div>
                
                @php
                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                @endphp
                
                <div class="table-responsive">
                    <table class="menu-table">
                        <thead>
                            <tr>
                                <th class="menu-th" style="width:12%;">Weekday</th>
                                <th class="menu-th" style="width:22%;">Breakfast</th>
                                <th class="menu-th" style="width:22%;">Lunch</th>
                                <th class="menu-th" style="width:22%;">Snacks</th>
                                <th class="menu-th" style="width:22%;">Dinner</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($days as $day)
                                <tr>
                                    <td class="menu-td-day text-center">
                                        {{ $day }}
                                    </td>
                                    
                                    <!-- Breakfast -->
                                    <td class="menu-td-cell">
                                        <div class="meal-item">
                                            <div class="meal-title"><i class="fas fa-coffee"></i> Breakfast</div>
                                            <div class="meal-content">{{ $menus[$day]['breakfast'] ?? 'Not scheduled' }}</div>
                                        </div>
                                    </td>
                                    
                                    <!-- Lunch -->
                                    <td class="menu-td-cell">
                                        <div class="meal-item">
                                            <div class="meal-title"><i class="fas fa-hamburger"></i> Lunch</div>
                                            <div class="meal-content">{{ $menus[$day]['lunch'] ?? 'Not scheduled' }}</div>
                                        </div>
                                    </td>
                                    
                                    <!-- Snacks -->
                                    <td class="menu-td-cell">
                                        <div class="meal-item">
                                            <div class="meal-title"><i class="fas fa-cookie"></i> Snacks</div>
                                            <div class="meal-content">{{ $menus[$day]['snacks'] ?? 'Not scheduled' }}</div>
                                        </div>
                                    </td>
                                    
                                    <!-- Dinner -->
                                    <td class="menu-td-cell">
                                        <div class="meal-item">
                                            <div class="meal-title"><i class="fas fa-utensils"></i> Dinner</div>
                                            <div class="meal-content">{{ $menus[$day]['dinner'] ?? 'Not scheduled' }}</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
