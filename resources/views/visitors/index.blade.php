@extends('layouts.admin')

@section('title', 'Visitor Gate Register')

@section('content')
<style>
    .metric-card {
        border-left: 4px solid transparent;
        transition: all 0.25s ease;
    }
    .metric-card:hover {
        transform: translateY(-2px);
    }
    .pulse-dot {
        width: 10px;
        height: 10px;
        background-color: #EF4444;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        animation: pulse-red 1.6s infinite;
    }
    @keyframes pulse-red {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(239, 68, 68, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }
    .nav-tabs-premium {
        border-bottom: 2px solid #E2E8F0;
    }
    .nav-tabs-premium .nav-link {
        border: none;
        color: #64748B;
        font-weight: 600;
        padding: 12px 20px;
        position: relative;
        transition: all 0.2s ease;
    }
    .nav-tabs-premium .nav-link:hover {
        color: #2563EB;
        background-color: rgba(37, 99, 235, 0.02);
    }
    .nav-tabs-premium .nav-link.active {
        color: #2563EB;
        background: transparent;
    }
    .nav-tabs-premium .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background-color: #2563EB;
        border-radius: 3px 3px 0 0;
    }
    
    /* Print styles specifically for the QR poster */
    @media print {
        body * {
            visibility: hidden;
        }
        #printablePoster, #printablePoster * {
            visibility: visible;
        }
        #printablePoster {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff !important;
            padding: 40px !important;
            box-shadow: none !important;
            border: none !important;
        }
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="fas fa-id-badge text-primary me-2"></i>Visitor Gate Register</h4>
        <p class="text-muted small mb-0">Record gate entries, check visitor logs, approve entry requests, and print ID badges</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-primary rounded-pill px-3.5 shadow-sm" data-bs-toggle="modal" data-bs-target="#qrPosterModal">
            <i class="fas fa-qrcode me-2"></i>Gate Desk QR Code
        </button>
        <a href="{{ route('visitors.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-1"></i>New Gate Entry
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius:12px;">{{ session('success') }}</div>
@endif

<!-- Visitor Metrics Summary -->
<div class="row g-3 mb-4">
    <!-- Pending Approvals -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100 metric-card" style="border-radius: 16px; border-left: 4px solid #EF4444 !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted text-xs" style="letter-spacing: 0.5px;">Pending Requests</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-danger-subtle text-danger" style="width: 36px; height: 36px;">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                    {{ $pendingCount }}
                    @if($pendingCount > 0)
                        <span class="pulse-dot"></span>
                    @endif
                </h3>
                <span class="text-muted small" style="font-size: 0.75rem;">Awaiting action</span>
            </div>
        </div>
    </div>

    <!-- Active Visitors Inside -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100 metric-card" style="border-radius: 16px; border-left: 4px solid #2563EB !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted text-xs" style="letter-spacing: 0.5px;">Inside Campus</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-primary-subtle text-primary" style="width: 36px; height: 36px;">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ $activeCount }}</h3>
                <span class="text-muted small" style="font-size: 0.75rem;">Currently inside</span>
            </div>
        </div>
    </div>

    <!-- Checked Out -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100 metric-card" style="border-radius: 16px; border-left: 4px solid #10B981 !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted text-xs" style="letter-spacing: 0.5px;">Checked Out</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-success-subtle text-success" style="width: 36px; height: 36px;">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ $checkedOutCount }}</h3>
                <span class="text-muted small" style="font-size: 0.75rem;">Exited premises</span>
            </div>
        </div>
    </div>

    <!-- Rejected -->
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100 metric-card" style="border-radius: 16px; border-left: 4px solid #64748B !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-uppercase fw-semibold text-muted text-xs" style="letter-spacing: 0.5px;">Rejected Requests</span>
                    <div class="rounded-3 d-flex align-items-center justify-content-center bg-secondary-subtle text-secondary" style="width: 36px; height: 36px;">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-dark">{{ $rejectedCount }}</h3>
                <span class="text-muted small" style="font-size: 0.75rem;">Entry denied</span>
            </div>
        </div>
    </div>
</div>

<!-- Logs register card -->
<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs-premium mb-3" id="statusTabs" role="tablist">
            <li class="nav-item">
                <a href="{{ route('visitors.index', ['status' => 'pending']) }}" class="nav-link {{ $status === 'pending' ? 'active' : '' }}">
                    Awaiting Approval 
                    <span class="badge rounded-pill bg-danger-subtle text-danger ms-1" style="font-size:0.75rem;">{{ $pendingCount }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('visitors.index', ['status' => 'checked_in']) }}" class="nav-link {{ $status === 'checked_in' ? 'active' : '' }}">
                    Inside Campus 
                    <span class="badge rounded-pill bg-primary-subtle text-primary ms-1" style="font-size:0.75rem;">{{ $activeCount }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('visitors.index', ['status' => 'checked_out']) }}" class="nav-link {{ $status === 'checked_out' ? 'active' : '' }}">
                    Checked Out 
                    <span class="badge rounded-pill bg-secondary-subtle text-secondary ms-1" style="font-size:0.75rem;">{{ $checkedOutCount }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('visitors.index', ['status' => 'rejected']) }}" class="nav-link {{ $status === 'rejected' ? 'active' : '' }}">
                    Rejected 
                    <span class="badge rounded-pill bg-dark-subtle text-dark ms-1" style="font-size:0.75rem;">{{ $rejectedCount }}</span>
                </a>
            </li>
        </ul>
        
        <!-- Search filter -->
        <form action="{{ route('visitors.index') }}" method="GET" class="row g-2 mt-2 mb-3">
            <input type="hidden" name="status" value="{{ $status }}">
            <div class="col-12 col-sm-8">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Search name, phone, pass code..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-12 col-sm-4 d-flex gap-1">
                <button type="submit" class="btn btn-primary w-100 rounded-pill">Filter</button>
                @if(request()->filled('search'))
                    <a href="{{ route('visitors.index', ['status' => $status]) }}" class="btn btn-outline-secondary rounded-circle" title="Clear Filters">
                        <i class="fas fa-undo"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
    
    <div class="card-body px-4 pb-4">
        <!-- Log Register Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0">Pass Number</th>
                        <th class="border-0">Visitor Details</th>
                        <th class="border-0">Purpose</th>
                        <th class="border-0">Whom to Meet</th>
                        <th class="border-0">Gate &amp; Vehicle</th>
                        <th class="border-0">Timestamps</th>
                        <th class="border-0 text-end" style="width: 200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visitors as $visitor)
                        <tr>
                            <td>
                                <code class="fw-bold text-primary">{{ $visitor->pass_number }}</code>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $visitor->visitor_name }}</div>
                                <div class="text-muted text-xs"><i class="fas fa-phone me-1"></i>{{ $visitor->phone_number }}</div>
                            </td>
                            <td>{{ $visitor->purpose }}</td>
                            <td>
                                @if($visitor->whomToMeet)
                                    <div>{{ $visitor->whomToMeet->name }}</div>
                                    <div class="text-muted text-xs">({{ $visitor->whomToMeet->role->name }})</div>
                                @else
                                    <span class="text-dark">{{ $visitor->whom_to_meet_name ?: 'Generic Visit' }}</span>
                                @endif
                            </td>
                            <td>
                                <div>{{ $visitor->gate_number }}</div>
                                @if($visitor->vehicle_number)
                                    <span class="badge bg-light text-secondary border text-xs"><i class="fas fa-car me-1"></i>{{ $visitor->vehicle_number }}</span>
                                @else
                                    <span class="text-muted text-xs">Walk-in</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-xs">
                                    @if($visitor->check_in_time)
                                        <div>In: <strong class="text-dark">{{ $visitor->check_in_time->format('h:i A, d M') }}</strong></div>
                                    @else
                                        <div class="text-warning"><i class="fas fa-hourglass-half me-1"></i>Awaiting Entry</div>
                                    @endif
                                    @if($visitor->check_out_time)
                                        <div>Out: <strong class="text-secondary">{{ $visitor->check_out_time->format('h:i A, d M') }}</strong></div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-1 justify-content-end">
                                    @if($status === 'pending')
                                        <!-- Guard Approvals -->
                                        <form action="{{ route('visitors.approve', $visitor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-2.5" title="Approve Request">
                                                <i class="fas fa-check me-1"></i>Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('visitors.reject', $visitor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-2.5" title="Reject Request">
                                                <i class="fas fa-times me-1"></i>Reject
                                            </button>
                                        </form>
                                    @endif

                                    @if($status === 'checked_in')
                                        <a href="{{ route('visitors.pass', $visitor->id) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-2.5" title="Print Gate Badge">
                                            <i class="fas fa-print"></i> Pass
                                        </a>
                                        <form action="{{ route('visitors.checkout', $visitor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-2.5" title="Mark Exit Check-Out">
                                                <i class="fas fa-sign-out-alt me-1"></i>Exit
                                            </button>
                                        </form>
                                    @endif

                                    @if($status === 'checked_out' || $status === 'rejected')
                                        <a href="{{ route('visitors.pass', $visitor->id) }}" target="_blank" class="btn btn-sm btn-light border rounded-pill px-2.5">
                                            <i class="fas fa-id-card text-muted"></i> Details
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted small">No visitor records matching filters in this tab.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $visitors->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Modal: Printable Gate QR Poster -->
<div class="modal fade" id="qrPosterModal" tabindex="-1" aria-labelledby="qrPosterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 520px;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-0 bg-light py-3 px-4">
                <h5 class="modal-title fw-bold text-dark" id="qrPosterModalLabel">Print Gate Registration Poster</h5>
                <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 text-center">
                <!-- Printable Poster Container -->
                <div id="printablePoster" class="card border border-2 p-4 rounded-4 bg-white shadow-sm mx-auto" style="max-width: 440px; border-color: #E2E8F0 !important;">
                    <div class="mb-3 text-center">
                        <i class="fas fa-building text-primary fs-3 mb-1"></i>
                        <h4 class="fw-bold text-dark mb-0">{{ auth()->user()->institute->name ?? 'Apex Institute' }}</h4>
                        <div class="text-muted text-xs text-uppercase letter-spacing-1 fw-bold">Visitor Check-in Point</div>
                    </div>
                    
                    <hr class="my-3 opacity-10">
                    
                    <div class="my-4 text-center">
                        <!-- Dynamic QR code generated with API -->
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode(route('visitors.public-register', auth()->user()->institute_id ?? 1)) }}" 
                             alt="Check-in QR Code" 
                             class="img-fluid border p-3 rounded-4 bg-light shadow-sm"
                             style="max-width: 250px;">
                    </div>
                    
                    <h5 class="fw-bold text-primary mb-2"><i class="fas fa-camera me-2"></i>Scan to Register</h5>
                    <p class="text-secondary small mb-0 px-3">
                        Please scan this QR code with your mobile camera to fill in your visit details and request entry approval from the security gate desk.
                    </p>
                </div>
            </div>
            
            <div class="modal-footer border-0 bg-light py-3 px-4 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 no-print" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary rounded-pill px-4 no-print" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Print Poster
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
