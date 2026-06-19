@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <x-biometric-attendance-card />

    {{-- ── PAGE HEADER ── --}}
    <div class="d-flex align-items-center justify-content-between mb-4 mt-2">
        <div>
            <h4 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">Dashboard Overview</h4>
            <p class="text-muted small mb-0">{{ now()->format('l, d F Y') }}</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light text-secondary border px-3 py-2" style="font-size:0.72rem; border-color:#E2E8F0 !important;">
                <i class="fas fa-circle text-success me-2" style="font-size: 0.45rem; vertical-align: middle;"></i>System Active
            </span>
        </div>
    </div>

    {{-- ── ROW 1: 6 STAT CARDS ── --}}
    <div class="row g-3 mb-4">
        {{-- Total Students --}}
        @if(!auth()->user()->isReceptionist())
        <div class="col-6 col-md-4 {{ auth()->user()->isPrincipal() ? 'col-xl-2' : 'col-xl-2' }}">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Students</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#EFF6FF; color:#2563EB; font-size:0.75rem;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0" style="color:#0F172A; font-size:1.4rem;">{{ $totalStudents }}</h3>
                    <div class="text-muted mt-1" style="font-size:0.68rem;">active students</div>
                </div>
            </div>
        </div>
        @endif

        {{-- Active Batches --}}
        @if(!auth()->user()->isReceptionist())
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Batches</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#ECFDF5; color:#10B981; font-size:0.75rem;">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0" style="color:#0F172A; font-size:1.4rem;">{{ $activeBatches }}</h3>
                    <div class="text-muted mt-1" style="font-size:0.68rem;">active batches</div>
                </div>
            </div>
        </div>
        @endif

        {{-- Monthly Revenue --}}
        @if(!auth()->user()->isPrincipal() && auth()->user()->institute && auth()->user()->institute->feature_fees)
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Revenue</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#F5F3FF; color:#7C3AED; font-size:0.75rem;">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0 text-truncate" style="color:#0F172A; font-size:1.25rem;">₹{{ number_format($monthlyRevenue, 0) }}</h3>
                    <div class="text-muted mt-1" style="font-size:0.68rem;">this month</div>
                </div>
            </div>
        </div>
        @endif

        {{-- Staff --}}
        @if(!auth()->user()->isReceptionist())
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Staff</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#F0F9FF; color:#0EA5E9; font-size:0.75rem;">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0" style="color:#0F172A; font-size:1.4rem;">{{ $totalStaff }}</h3>
                    <div class="text-muted mt-1" style="font-size:0.68rem;">total staff</div>
                </div>
            </div>
        </div>
        @endif

        {{-- Homework --}}
        @if(!auth()->user()->isReceptionist())
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Homework</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#FFFBEB; color:#D97706; font-size:0.75rem;">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0" style="color:#0F172A; font-size:1.4rem;">{{ $activeHomework }}</h3>
                    <div class="text-muted mt-1" style="font-size:0.68rem;">active tasks</div>
                </div>
            </div>
        </div>
        @endif

        {{-- Upcoming Tests --}}
        @if(!auth()->user()->isReceptionist())
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Tests</span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#FFF1F2; color:#E11D48; font-size:0.75rem;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-0" style="color:#0F172A; font-size:1.4rem;">{{ $upcomingTests }}</h3>
                    <div class="text-muted mt-1" style="font-size:0.68rem;">upcoming tests</div>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- ── CAMPUS OPERATIONS CONSOLE ── --}}
    @if(auth()->user()->institute && (auth()->user()->institute->feature_hr || auth()->user()->institute->feature_visitor))
    <h6 class="text-uppercase fw-bold text-muted mb-3 d-flex align-items-center gap-2" style="font-size:0.65rem; letter-spacing:1px; margin-top:28px;">
        <i class="fas fa-shield-alt text-secondary" style="font-size: 0.8rem;"></i>
        <span>Campus Operations Console</span>
    </h6>
    <div class="row g-3 mb-4">
        {{-- Visitor Gate: Awaiting Approval --}}
        @if(auth()->user()->institute->feature_visitor)
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Gate Approvals</span>
                            <div class="rounded-2 d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#F1F5F9; color:#475569; font-size:0.75rem;">
                                <i class="fas fa-qrcode"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1 d-flex align-items-center gap-2" style="color:#0F172A; font-size:1.4rem;">
                            {{ $visitorsPendingCount }}
                            @if($visitorsPendingCount > 0)
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0.5 rounded-pill" style="font-size:0.6rem; font-weight:700;">Awaiting</span>
                            @endif
                        </h3>
                        <div class="text-muted" style="font-size:0.68rem;">awaiting entry approval</div>
                    </div>
                    @can('manage-visitors')
                        <div class="mt-2 pt-2 border-top" style="border-color:#F1F5F9 !important;">
                            <a href="{{ route('visitors.index', ['status' => 'pending']) }}" class="text-primary fw-semibold text-decoration-none d-inline-block" style="font-size:0.72rem;">Review →</a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        @endif

        {{-- Visitors Inside Campus --}}
        @if(auth()->user()->institute->feature_visitor)
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Guests On-Campus</span>
                            <div class="rounded-2 d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#F1F5F9; color:#475569; font-size:0.75rem;">
                                <i class="fas fa-door-open"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#0F172A; font-size:1.4rem;">{{ $visitorsActiveCount }}</h3>
                        <div class="text-muted" style="font-size:0.68rem;">currently inside campus</div>
                    </div>
                    @can('manage-visitors')
                        <div class="mt-2 pt-2 border-top" style="border-color:#F1F5F9 !important;">
                            <a href="{{ route('visitors.index', ['status' => 'checked_in']) }}" class="text-primary fw-semibold text-decoration-none d-inline-block" style="font-size:0.72rem;">View Console →</a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        @endif

        {{-- Staff Leave Requests --}}
        @if(auth()->user()->institute->feature_hr)
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Staff Leaves</span>
                            <div class="rounded-2 d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#F1F5F9; color:#475569; font-size:0.75rem;">
                                <i class="fas fa-calendar-minus"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-1" style="color:#0F172A; font-size:1.4rem;">{{ $pendingStaffLeavesCount }}</h3>
                        <div class="text-muted" style="font-size:0.68rem;">pending admin review</div>
                    </div>
                    @can('manage-staff')
                        <div class="mt-2 pt-2 border-top" style="border-color:#F1F5F9 !important;">
                            <a href="{{ route('leaves.index') }}" class="text-primary fw-semibold text-decoration-none d-inline-block" style="font-size:0.72rem;">Approve →</a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        @endif

        {{-- Staff Payroll Monthly Disbursal / Today's Visits --}}
        @if(!auth()->user()->isPrincipal() && !auth()->user()->isReceptionist())
            @if(auth()->user()->institute->feature_hr)
            <div class="col-6 col-md-3">
                <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Monthly Payroll</span>
                                <div class="rounded-2 d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#F1F5F9; color:#475569; font-size:0.75rem;">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-1 text-truncate" style="color:#0F172A; font-size:1.2rem;">₹{{ number_format($totalPayrollThisMonth, 0) }}</h3>
                            <div class="text-muted" style="font-size:0.68rem;">disbursed this month</div>
                        </div>
                        <div class="mt-2 pt-2 border-top" style="border-color:#F1F5F9 !important;">
                            <a href="{{ route('staff-payrolls.index') }}" class="text-primary fw-semibold text-decoration-none d-inline-block" style="font-size:0.72rem;">Details →</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @else
            {{-- Total Visits Today --}}
            @if(auth()->user()->institute->feature_visitor)
            <div class="col-6 col-md-3">
                <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-uppercase fw-bold text-muted" style="font-size:0.6rem; letter-spacing:0.5px;">Today's Visits</span>
                                <div class="rounded-2 d-flex align-items-center justify-content-center" style="width:28px; height:28px; background:#F1F5F9; color:#475569; font-size:0.75rem;">
                                    <i class="fas fa-history"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-1" style="color:#0F172A; font-size:1.4rem;">{{ $visitorsTodayCount }}</h3>
                            <div class="text-muted" style="font-size:0.68rem;">registered visitors today</div>
                        </div>
                        <div class="mt-2 pt-2 border-top" style="border-color:#F1F5F9 !important;">
                            <span class="text-muted" style="font-size:0.68rem;">gate log active</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif
    </div>
    @endif

    {{-- ── ROW 2: REVENUE CHART + TODAY'S ATTENDANCE ── --}}
    <div class="row g-4 mb-4">
        @if(!auth()->user()->isPrincipal() && auth()->user()->institute && auth()->user()->institute->feature_fees)
        {{-- 6-Month Revenue Chart --}}
        <div class="col-lg-8">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="font-size:0.92rem;">Revenue Overview</h6>
                        <p class="text-muted small mb-0" style="font-size:0.72rem;">Last 6 months collection</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2 fw-semibold" style="font-size:0.72rem; border-color:#E2E8F0 !important;">
                        ₹{{ number_format($monthlyRevenue, 0) }} this month
                    </span>
                </div>
                <div class="card-body p-4">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>
        @endif

        @if(!auth()->user()->isReceptionist())
        {{-- Today's Attendance Snapshot --}}
        <div class="{{ auth()->user()->isPrincipal() ? 'col-lg-12' : 'col-lg-4' }}">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-bold text-dark mb-0" style="font-size:0.92rem;">Today's Attendance</h6>
                    <p class="text-muted small mb-0" style="font-size:0.72rem;">{{ now()->format('D, d M Y') }}</p>
                </div>
                <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center">
                    @if($todayAttendancePct !== null)
                        <div style="position:relative; width:120px; height:120px; margin-bottom:16px;">
                            <canvas id="attendanceRing"></canvas>
                            <div style="position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                                <span class="fw-bold" style="font-size:1.5rem; color:#0F172A;">{{ $todayAttendancePct }}%</span>
                                <span class="text-muted" style="font-size:0.62rem; text-transform:uppercase; font-weight:600; letter-spacing:0.5px;">present</span>
                            </div>
                        </div>
                        <div class="d-flex gap-4 text-center mt-1 w-100 justify-content-center">
                            <div>
                                <div class="fw-bold text-success" style="font-size:1rem;">{{ $todayPresent }}</div>
                                <div class="text-muted" style="font-size:0.68rem;">Present</div>
                            </div>
                            <div class="border-start" style="border-color:#E2E8F0 !important;"></div>
                            <div>
                                <div class="fw-bold text-danger" style="font-size:1rem;">{{ $todayTotal - $todayPresent }}</div>
                                <div class="text-muted" style="font-size:0.68rem;">Absent</div>
                            </div>
                            <div class="border-start" style="border-color:#E2E8F0 !important;"></div>
                            <div>
                                <div class="fw-bold text-dark" style="font-size:1rem;">{{ $todayTotal }}</div>
                                <div class="text-muted" style="font-size:0.68rem;">Total</div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-calendar-times fa-2x text-muted opacity-25 mb-3 d-block"></i>
                            <div class="fw-semibold text-muted small">No attendance marked today</div>
                            @if($noAttendanceToday > 0)
                                <a href="{{ route('attendance.index') }}" class="btn btn-sm btn-primary mt-3 px-3 py-1.5" style="border-radius:6px; font-size:0.75rem;">Mark Now</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- ── ROW 3: ATTENDANCE TREND + REALTIME GATE TICKER ── --}}
    @php
        $showAttendanceTrend = !auth()->user()->isReceptionist();
        $showLiveGateTicker = auth()->user()->institute && auth()->user()->institute->feature_visitor;
        $showRecentPayments = !auth()->user()->isPrincipal() && auth()->user()->institute && auth()->user()->institute->feature_fees;
        
        // Determine column widths for Row 3
        if ($showAttendanceTrend && $showLiveGateTicker) {
            $attendanceCol = 'col-lg-5';
            $gateCol = 'col-lg-7';
        } elseif ($showAttendanceTrend) {
            $attendanceCol = 'col-lg-12';
        } elseif ($showLiveGateTicker) {
            $gateCol = 'col-lg-12';
        }

        $showVisitorTrend = auth()->user()->institute && auth()->user()->institute->feature_visitor;
        $showStudentsByBatch = !auth()->user()->isReceptionist();

        // Determine column widths for Row 4
        if ($showVisitorTrend && $showStudentsByBatch && $showRecentPayments) {
            $visitorTrendCol = 'col-lg-5';
            $batchCol = 'col-lg-3';
            $paymentsCol = 'col-lg-4';
        } elseif ($showVisitorTrend && $showStudentsByBatch) {
            $visitorTrendCol = 'col-lg-8';
            $batchCol = 'col-lg-4';
        } elseif ($showVisitorTrend && $showRecentPayments) {
            $visitorTrendCol = 'col-lg-8';
            $paymentsCol = 'col-lg-4';
        } elseif ($showStudentsByBatch && $showRecentPayments) {
            $batchCol = 'col-lg-4';
            $paymentsCol = 'col-lg-8';
        } elseif ($showVisitorTrend) {
            $visitorTrendCol = 'col-lg-12';
        } elseif ($showStudentsByBatch) {
            $batchCol = 'col-lg-12';
        } elseif ($showRecentPayments) {
            $paymentsCol = 'col-lg-12';
        }
    @endphp

    <div class="row g-4 mb-4">
        @if($showAttendanceTrend)
        {{-- 7-day Attendance % Bar Chart ── --}}
        <div class="{{ $attendanceCol }}">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-bold text-dark mb-0" style="font-size:0.92rem;">Attendance Trend</h6>
                    <p class="text-muted small mb-0" style="font-size:0.72rem;">Last 7 days presence rate</p>
                </div>
                <div class="card-body p-4">
                    <canvas id="attendanceTrendChart" height="160"></canvas>
                </div>
            </div>
        </div>
        @endif

        @if($showLiveGateTicker)
        {{-- Live Gate Logs --}}
        <div class="{{ $gateCol }}">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="font-size:0.92rem;">Live Gate Ticker</h6>
                        <p class="text-muted small mb-0" style="font-size:0.72rem;">Recent visitor check-ins</p>
                    </div>
                    @can('manage-visitors')
                        <a href="{{ route('visitors.index') }}" class="text-primary fw-semibold text-decoration-none" style="font-size:0.72rem;">Full Console</a>
                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.8rem;">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.62rem; letter-spacing: 0.5px; position: sticky; top:0; z-index:1;">
                                <tr>
                                    <th class="border-0 px-4">Visitor</th>
                                    <th class="border-0">Whom to Meet</th>
                                    <th class="border-0">Time</th>
                                    <th class="border-0 px-4 text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentVisitors as $visitor)
                                    <tr style="border-color:#F1F5F9 !important;">
                                        <td class="px-4">
                                            <div class="fw-semibold text-dark">{{ $visitor->visitor_name }}</div>
                                            <div class="text-muted" style="font-size:0.7rem;">{{ $visitor->purpose }}</div>
                                        </td>
                                        <td>
                                            @if($visitor->whomToMeet)
                                                <div class="text-dark">{{ $visitor->whomToMeet->name }}</div>
                                            @else
                                                <div class="text-dark">{{ $visitor->whom_to_meet_name ?? '—' }}</div>
                                            @endif
                                            <div class="text-muted" style="font-size:0.7rem;">{{ $visitor->vehicle_number ?? 'No Vehicle' }}</div>
                                        </td>
                                        <td>
                                            @if($visitor->check_in_time)
                                                <div class="text-dark">{{ $visitor->check_in_time->format('h:i A') }}</div>
                                                <div class="text-muted" style="font-size:0.7rem;">{{ $visitor->check_in_time->format('d M') }}</div>
                                            @else
                                                <div class="text-muted italic">Pending</div>
                                            @endif
                                        </td>
                                        <td class="px-4 text-end">
                                            @if($visitor->status === 'pending')
                                                <span class="badge bg-warning-subtle text-warning border-0 px-2 py-1 rounded" style="font-size:0.65rem; font-weight:600;">Awaiting</span>
                                            @elseif($visitor->status === 'checked_in')
                                                <span class="badge bg-success-subtle text-success border-0 px-2 py-1 rounded" style="font-size:0.65rem; font-weight:600;">Inside</span>
                                            @elseif($visitor->status === 'checked_out')
                                                <span class="badge bg-light text-secondary border-0 px-2 py-1 rounded" style="font-size:0.65rem; font-weight:600;">Out</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger border-0 px-2 py-1 rounded" style="font-size:0.65rem; font-weight:600;">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted small">No visitor records logged.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- ── ROW 4: VISITOR TREND, BATCH DONUT CHART & RECENT PAYMENTS ── --}}
    @if($showVisitorTrend || $showStudentsByBatch || $showRecentPayments)
    <div class="row g-4 mb-4">
        @if($showVisitorTrend)
        {{-- Visitor Entries Trend --}}
        <div class="{{ $visitorTrendCol }}">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-bold text-dark mb-0" style="font-size:0.92rem;">Visitor Traffic Trend</h6>
                    <p class="text-muted small mb-0" style="font-size:0.72rem;">Daily visitor entries (last 7 days)</p>
                </div>
                <div class="card-body p-4">
                    <div style="height: 220px; position: relative;">
                        <canvas id="visitorTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($showStudentsByBatch)
        {{-- Students per Batch --}}
        <div class="{{ $batchCol }}">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-bold text-dark mb-0" style="font-size:0.92rem;">Students by Batch</h6>
                    <p class="text-muted small mb-0" style="font-size:0.72rem;">Distribution size</p>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center" style="min-height:220px;">
                    <canvas id="batchChart"></canvas>
                </div>
            </div>
        </div>
        @endif

        @if($showRecentPayments)
        {{-- Recent Payments --}}
        <div class="{{ $paymentsCol }}">
            <div class="card border-0 h-100" style="border-radius:12px; border:1px solid #E2E8F0 !important; box-shadow:0 1px 3px rgba(0,0,0,0.02);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark mb-0" style="font-size:0.92rem;">Recent Payments</h6>
                    <a href="{{ route('payments.index') }}" class="text-primary fw-semibold text-decoration-none" style="font-size:0.72rem;">View all</a>
                </div>
                <div class="card-body p-0" style="max-height: 240px; overflow-y: auto;">
                    @forelse($recentPayments as $payment)
                        <div class="d-flex align-items-center px-4 py-2 border-bottom" style="border-color:#F1F5F9 !important;">
                            <div class="me-3 rounded-circle d-flex align-items-center justify-content-center fw-semibold text-secondary flex-shrink-0"
                                style="width:32px; height:32px; background:#F1F5F9; font-size:0.72rem;">
                                {{ strtoupper(substr($payment->student->name ?? 'N', 0, 2)) }}
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <div class="fw-semibold text-dark text-truncate" style="font-size:0.8rem;">
                                    {{ $payment->student->name ?? '—' }}</div>
                                <div class="text-muted" style="font-size:0.68rem;">{{ $payment->payment_date->format('d M Y') }}
                                </div>
                            </div>
                            <div class="fw-bold text-dark ms-2" style="font-size:0.82rem; white-space:nowrap;">
                                ₹{{ number_format($payment->amount_paid, 0) }}</div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-muted small">No payments this month.</div>
                    @endforelse
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif

    {{-- ── NEEDS ATTENTION BANNER ── --}}
    @if($noAttendanceToday > 0 && !auth()->user()->isReceptionist())
        <div class="alert border-0 border-start border-4 d-flex align-items-center gap-3 mb-2"
            style="background:#FFF9E6; border-color:#F59E0B !important; border-radius:8px; padding:14px 20px;">
            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 1.05rem;"></i>
            <div class="d-flex flex-wrap align-items-center gap-1">
                <span class="fw-medium text-dark" style="font-size:0.85rem;">Attendance not marked for {{ $noAttendanceToday }} student{{ $noAttendanceToday > 1 ? 's' : '' }} today.</span>
                <a href="{{ route('attendance.index') }}" class="text-warning-emphasis fw-bold text-decoration-underline ms-1" style="font-size:0.85rem;">Mark attendance →</a>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        // Set standard Outfit font family for all Chart.js graphics
        if (typeof Chart !== 'undefined') {
            Chart.defaults.font.family = "'Outfit', sans-serif";
            Chart.defaults.color = '#64748B';
        }

        @if(!auth()->user()->isPrincipal())
        // ── 6-Month Revenue Line Chart ──
        const revCanvas = document.getElementById('revenueChart');
        if (revCanvas) {
            const revCtx = revCanvas.getContext('2d');
            const revData = @json($revenueData);
            const revGrad = revCtx.createLinearGradient(0, 0, 0, 300);
            revGrad.addColorStop(0, 'rgba(37,99,235,0.06)');
            revGrad.addColorStop(1, 'rgba(37,99,235,0.0)');
            new Chart(revCtx, {
                type: 'line',
                data: {
                    labels: Object.keys(revData),
                    datasets: [{
                        label: 'Revenue (₹)',
                        data: Object.values(revData),
                        borderColor: '#2563EB',
                        backgroundColor: revGrad,
                        borderWidth: 2,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#2563EB',
                        pointBorderWidth: 1.5,
                        pointRadius: 3.5,
                        fill: true,
                        tension: 0.35
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0F172A',
                            titleColor: '#fff',
                            bodyColor: '#e2e8f0',
                            padding: 10,
                            borderRadius: 6,
                            displayColors: false,
                            callbacks: {
                                label: ctx => '₹' + ctx.raw.toLocaleString()
                            }
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(0,0,0,0.02)' }, 
                            ticks: { 
                                callback: v => '₹' + v.toLocaleString(),
                                font: { size: 9.5 }
                            } 
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { size: 9.5 } }
                        }
                    }
                }
            });
        }
        @endif

        // ── Today's Attendance Ring ──
        @if($todayAttendancePct !== null)
            const ringCanvas = document.getElementById('attendanceRing');
            if (ringCanvas) {
                const ringCtx = ringCanvas.getContext('2d');
                const pct = {{ $todayAttendancePct }};
                new Chart(ringCtx, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [pct, 100 - pct],
                            backgroundColor: [pct >= 75 ? '#10B981' : '#EF4444', '#F1F5F9'],
                            borderWidth: 0
                        }]
                    },
                    options: { 
                        cutout: '78%', 
                        plugins: { 
                            legend: { display: false }, 
                            tooltip: { enabled: false } 
                        }, 
                        animation: { animateRotate: true } 
                    }
                });
            }
        @endif

        // ── 7-Day Attendance Trend Bar ──
        const trendCanvas = document.getElementById('attendanceTrendChart');
        if (trendCanvas) {
            const trendCtx = trendCanvas.getContext('2d');
            const trendData = @json($attendanceTrend);
            new Chart(trendCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(trendData),
                    datasets: [{
                        label: 'Attendance %',
                        data: Object.values(trendData),
                        backgroundColor: 'rgba(59, 130, 246, 0.85)', // Unified modern blue
                        borderRadius: 4,
                        borderSkipped: false,
                        barThickness: 12
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false }, 
                        tooltip: { 
                            backgroundColor: '#0F172A',
                            padding: 8,
                            borderRadius: 6,
                            callbacks: { label: ctx => ctx.raw + '%' } 
                        } 
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            max: 100, 
                            grid: { color: 'rgba(0,0,0,0.02)' }, 
                            ticks: { 
                                callback: v => v + '%',
                                font: { size: 9.5 }
                            } 
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { size: 9.5 } }
                        }
                    }
                }
            });
        }

        // ── Students per Batch Donut ──
        const batchCanvas = document.getElementById('batchChart');
        if (batchCanvas) {
            const batchCtx = batchCanvas.getContext('2d');
            const batchData = @json($studentsPerBatch);
            new Chart(batchCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(batchData),
                    datasets: [{
                        data: Object.values(batchData),
                        backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#8B5CF6', '#0EA5E9', '#EC4899'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: { 
                        legend: { 
                            position: 'bottom', 
                            labels: { 
                                usePointStyle: true, 
                                padding: 10, 
                                font: { size: 9 } 
                            } 
                        },
                        tooltip: {
                            backgroundColor: '#0F172A',
                            padding: 8,
                            borderRadius: 6
                        }
                    }
                }
            });
        }

        // ── Visitor Traffic Trend Line Chart ──
        const visCanvas = document.getElementById('visitorTrendChart');
        if (visCanvas) {
            const visCtx = visCanvas.getContext('2d');
            const visData = @json($visitorTrend);
            const visGrad = visCtx.createLinearGradient(0, 0, 0, 180);
            visGrad.addColorStop(0, 'rgba(16, 185, 129, 0.05)');
            visGrad.addColorStop(1, 'rgba(16, 185, 129, 0.0)');
            new Chart(visCtx, {
                type: 'line',
                data: {
                    labels: Object.keys(visData),
                    datasets: [{
                        label: 'Visitors',
                        data: Object.values(visData),
                        borderColor: '#10B981',
                        backgroundColor: visGrad,
                        borderWidth: 2,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10B981',
                        pointBorderWidth: 1.5,
                        pointRadius: 3,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0F172A',
                            padding: 8,
                            borderRadius: 6
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(0,0,0,0.02)' }, 
                            ticks: { stepSize: 1, font: { size: 9 } } 
                        },
                        x: { 
                            grid: { display: false }, 
                            ticks: { font: { size: 9 } } 
                        }
                    }
                }
            });
        }
    </script>
@endpush
