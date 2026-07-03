@extends('layouts.admin')
@section('title', 'Manage Mess Menu & Subscriptions')
@section('content')
<style>
.m-hdr{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.m-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.nav-tabs-custom{border-bottom:2px solid #F1F5F9;margin-bottom:24px;display:flex;gap:24px;}
.nav-link-custom{color:#64748B;font-weight:600;padding:12px 4px;border:none;background:none;border-bottom:2px solid transparent;margin-bottom:-2px;transition:all .2s;display:flex;align-items:center;gap:8px;text-decoration:none;}
.nav-link-custom:hover{color:#4F46E5;}
.nav-link-custom.active{color:#4F46E5;border-color:#4F46E5;}
.grid-table{background:#fff;border-radius:16px;border:1px solid #E2E8F0;overflow:hidden;}
.grid-header{background:#F8FAFC;border-bottom:1px solid #E2E8F0;font-weight:500;color:#334155;text-transform:uppercase;font-size:.75rem;letter-spacing:.5px;}
.grid-row{border-bottom:1px solid #F1F5F9;transition:background .2s;}
.grid-row:hover{background:#F8FAFC;}
.grid-day{font-weight:500;color:#1E293B;background:#F8FAFC;border-right:1px solid #E2E8F0;display:flex;align-items:center;padding:16px;font-size:.85rem;text-transform:capitalize;}
.grid-cell{padding:12px;border-right:1px solid #F1F5F9;}
.grid-cell:last-child{border-right:none;}
.menu-input{width:100%;min-height:75px;border:1px solid #E2E8F0;border-radius:10px;padding:8px 12px;font-size:.8rem;color:#334155;resize:vertical;transition:all .2s;background:#fff;}
.menu-input:focus{outline:none;border-color:#6366F1;box-shadow:0 0 0 3px rgba(99,102,241,.15);background:#FFF;}
.btn-save{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:12px 24px;border-radius:10px;font-size:.85rem;font-weight:500;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 15px rgba(79,70,229,.35);transition:all .2s;cursor:pointer;}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);color:#fff;}
.card-sec{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.card-header-sec{padding:20px 24px;border-bottom:1px solid #F1F5F9;background:#fff;}
</style>

<div class="m-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-utensils me-1"></i> Mess &amp; Catering</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">{{ $hostelMess->name }}</h2>
    </div>
    <div style="position:relative;z-index:2;">
        <a href="{{ route('hostel-messes.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-arrow-left me-2"></i> Back to Mess List</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-4 border-success-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger rounded-4 border-danger-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
    </div>
@endif

<div class="nav-tabs-custom">
    <a href="#menu" class="nav-link-custom active" id="tab-menu-link" onclick="switchTab('menu')"><i class="fas fa-calendar-alt"></i> Weekly Menu Planner</a>
    <a href="#subs" class="nav-link-custom" id="tab-subs-link" onclick="switchTab('subs')"><i class="fas fa-users"></i> Subscribed Students ({{ $hostelMess->subscriptions->count() }})</a>
</div>

<!-- Tab Content: Menu Planner -->
<div id="tab-menu" class="tab-pane-custom">
    <form action="{{ route('hostel-messes.menu.update', $hostelMess) }}" method="POST">
        @csrf
        <div class="grid-table mb-4">
            <div class="row g-0 grid-header d-none d-md-flex">
                <div class="col-md-2 p-3 text-center border-right" style="border-right: 1px solid #E2E8F0;">Day</div>
                <div class="col-md-2 p-3 text-center border-right" style="border-right: 1px solid #E2E8F0;">Breakfast</div>
                <div class="col-md-3 p-3 text-center border-right" style="border-right: 1px solid #E2E8F0;">Lunch</div>
                <div class="col-md-2 p-3 text-center border-right" style="border-right: 1px solid #E2E8F0;">Snacks</div>
                <div class="col-md-3 p-3 text-center">Dinner</div>
            </div>
            
            @php
                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                $meals = ['breakfast', 'lunch', 'snacks', 'dinner'];
            @endphp
            
            @foreach($days as $day)
                <div class="row g-0 grid-row">
                    <!-- Day Column -->
                    <div class="col-md-2 grid-day justify-content-center">
                        {{ $day }}
                    </div>
                    
                    <!-- Breakfast -->
                    <div class="col-md-2 grid-cell">
                        <label class="d-md-none text-muted small fw-medium mb-1">Breakfast</label>
                        <textarea name="menu[{{ $day }}][breakfast]" class="menu-input" placeholder="e.g. Eggs, Toast, Coffee">{{ $menus[$day]['breakfast'] ?? '' }}</textarea>
                    </div>
                    
                    <!-- Lunch -->
                    <div class="col-md-3 grid-cell">
                        <label class="d-md-none text-muted small fw-medium mb-1">Lunch</label>
                        <textarea name="menu[{{ $day }}][lunch]" class="menu-input" placeholder="e.g. Rice, Grilled Chicken, Salad">{{ $menus[$day]['lunch'] ?? '' }}</textarea>
                    </div>
                    
                    <!-- Snacks -->
                    <div class="col-md-2 grid-cell">
                        <label class="d-md-none text-muted small fw-medium mb-1">Snacks</label>
                        <textarea name="menu[{{ $day }}][snacks]" class="menu-input" placeholder="e.g. Tea, Cookies, Fruit">{{ $menus[$day]['snacks'] ?? '' }}</textarea>
                    </div>
                    
                    <!-- Dinner -->
                    <div class="col-md-3 grid-cell">
                        <label class="d-md-none text-muted small fw-medium mb-1">Dinner</label>
                        <textarea name="menu[{{ $day }}][dinner]" class="menu-input" placeholder="e.g. Soup, Steak, Baked Veggies">{{ $menus[$day]['dinner'] ?? '' }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-between align-items-center">
            <span style="font-size:.8rem;color:#64748B;"><i class="fas fa-info-circle me-1"></i> Empty cells will automatically delete the menu item for that slot.</span>
            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Weekly Menu</button>
        </div>
    </form>
</div>

<!-- Tab Content: Subscriptions -->
<div id="tab-subs" class="tab-pane-custom" style="display:none;">
    <div class="row g-4">
        <!-- Subscribe Student Card -->
        <div class="col-lg-4">
            <div class="card-sec">
                <div class="card-header-sec">
                    <h5 class="fw-medium mb-0 text-dark" style="font-size:1.05rem;">Subscribe Student</h5>
                    <p class="text-muted small mb-0 mt-1">Enroll a student in the {{ $hostelMess->name }} monthly subscription.</p>
                </div>
                <div class="p-4">
                    <form action="{{ route('hostel-messes.subscribe', $hostelMess) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="student_id" class="form-label fw-medium text-dark" style="font-size:.8rem;">Select Student</label>
                            <select name="student_id" id="student_id" class="form-select rounded-3 py-2.5 shadow-none" style="font-size:.85rem;" required>
                                <option value="">-- Choose Student --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }} (ID: {{ $student->id }} - {{ $student->batch->name ?? 'No Batch' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn-save w-100 justify-content-center"><i class="fas fa-plus-circle"></i> Subscribe Student</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Current Subscribers List -->
        <div class="col-lg-8">
            <div class="card-sec">
                <div class="card-header-sec d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-medium mb-0 text-dark" style="font-size:1.05rem;">Active Subscriptions</h5>
                        <p class="text-muted small mb-0 mt-1">Students receiving meals from this mess hall.</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr style="font-size:.78rem;color:#475569;">
                                <th class="ps-4">Student</th>
                                <th>Email / Contact</th>
                                <th>Start Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hostelMess->subscriptions as $sub)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width:36px;height:36px;border-radius:10px;background:#EEF2FF;display:flex;align-items:center;justify-content:center;font-weight:500;color:#4F46E5;font-size:.85rem;">
                                                {{ strtoupper(substr($sub->student->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-medium text-dark" style="font-size:.85rem;">{{ $sub->student->name }}</div>
                                                <div class="text-muted small">Batch: {{ $sub->student->batch->name ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-size:.82rem;color:#334155;">{{ $sub->student->email }}</div>
                                        <div class="text-muted small" style="font-size:.78rem;">{{ $sub->student->phone ?: 'No Phone' }}</div>
                                    </td>
                                    <td style="font-size:.82rem;color:#475569;">
                                        {{ \Carbon\Carbon::parse($sub->start_date)->format('M d, Y') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1" style="font-size:.7rem;">Active</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-users fs-3 mb-2" style="color:#CBD5E1;"></i>
                                        <div class="fw-medium">No Active Subscriptions</div>
                                        <div class="small">Enroll students on the left to start their catering schedule.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tab) {
    // Hide all tab panes
    document.getElementById('tab-menu').style.display = 'none';
    document.getElementById('tab-subs').style.display = 'none';
    
    // Deactivate all links
    document.getElementById('tab-menu-link').classList.remove('active');
    document.getElementById('tab-subs-link').classList.remove('active');
    
    // Show current tab
    document.getElementById('tab-' + tab).style.display = 'block';
    document.getElementById('tab-' + tab + '-link').classList.add('active');
}

// Auto-switch tab if hash present in URL
document.addEventListener("DOMContentLoaded", function() {
    const hash = window.location.hash.substring(1);
    if(hash === 'subs' || hash === 'menu') {
        switchTab(hash);
    }
});
</script>
@endsection
