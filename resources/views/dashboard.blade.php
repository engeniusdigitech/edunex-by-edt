@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <x-biometric-attendance-card />

    {{-- ── ROW 1: 6 STAT CARDS ── --}}
    <div class="row g-3 mb-4">
        {{-- Total Students --}}
        @if(!auth()->user()->isReceptionist())
        <div class="col-6 col-md-4 {{ auth()->user()->isPrincipal() ? 'col-xl-2' : 'col-xl-2' }}">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(37,99,235,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted"
                            style="font-size:0.62rem;letter-spacing:1px;">Students</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(37,99,235,0.1);color:#2563EB;font-size:0.75rem;">
                            <i class="fas fa-users"></i></div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $totalStudents }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">active students</div>
                </div>
            </div>
        </div>
        @endif
        @if(!auth()->user()->isReceptionist())
        {{-- Active Batches --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(16,185,129,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted"
                            style="font-size:0.62rem;letter-spacing:1px;">Batches</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(16,185,129,0.1);color:#10B981;font-size:0.75rem;">
                            <i class="fas fa-layer-group"></i></div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $activeBatches }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">active batches</div>
                </div>
            </div>
        </div>
        @endif
        @if(!auth()->user()->isPrincipal() && auth()->user()->institute && auth()->user()->institute->feature_fees)
        {{-- Monthly Revenue --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(245,158,11,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted"
                            style="font-size:0.62rem;letter-spacing:1px;">Revenue</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(245,158,11,0.1);color:#F59E0B;font-size:0.75rem;">
                            <i class="fas fa-wallet"></i></div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;font-size:1.3rem;">
                        ₹{{ number_format($monthlyRevenue, 0) }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">this month</div>
                </div>
            </div>
        </div>
        @endif
        @if(!auth()->user()->isReceptionist())
        {{-- Staff --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(16,185,129,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted"
                            style="font-size:0.62rem;letter-spacing:1px;">Staff</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(16,185,129,0.1);color:#10B981;font-size:0.75rem;">
                            <i class="fas fa-user-tie"></i></div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $totalStaff }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">total staff</div>
                </div>
            </div>
        </div>
        @endif
        @if(!auth()->user()->isReceptionist())
        {{-- Homework --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(14,165,233,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted"
                            style="font-size:0.62rem;letter-spacing:1px;">Homework</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(14,165,233,0.1);color:#0EA5E9;font-size:0.75rem;">
                            <i class="fas fa-book-open"></i></div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $activeHomework }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">active tasks</div>
                </div>
            </div>
        </div>
        @endif
        @if(!auth()->user()->isReceptionist())
        {{-- Upcoming Tests --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(239,68,68,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted"
                            style="font-size:0.62rem;letter-spacing:1px;">Tests</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(239,68,68,0.1);color:#EF4444;font-size:0.75rem;">
                            <i class="fas fa-file-alt"></i></div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $upcomingTests }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">upcoming tests</div>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- ── PREMIUM SAAS OPERATIONS CONSOLE ── --}}
    @if(auth()->user()->institute && (auth()->user()->institute->feature_hr || auth()->user()->institute->feature_visitor))
    <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
        <i class="fas fa-shield-alt text-success" style="font-size: 1.1rem;"></i>
        <span>Campus Operations Console</span>
    </h5>
    <div class="row g-3 mb-4">
        {{-- Visitor Gate: Awaiting Approval --}}
        @if(auth()->user()->institute->feature_visitor)
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(16,185,129,0.06); background: #ffffff;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Gate Approvals</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:#eefaf3;color:#198754;font-size:0.75rem;">
                            <i class="fas fa-qrcode"></i></div>
                    </div>
                    <h3 class="fw-black mb-0 d-flex align-items-center gap-2" style="color:#0F172A;">
                        {{ $visitorsPendingCount }}
                        @if($visitorsPendingCount > 0)
                            <span class="spinner-grow spinner-grow-sm text-danger" role="status"></span>
                        @endif
                    </h3>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <span class="text-muted" style="font-size:0.7rem;">awaiting entry</span>
                        @can('manage-visitors')
                            <a href="{{ route('visitors.index', ['status' => 'pending']) }}" class="text-success fw-semibold" style="font-size:0.68rem;text-decoration:none;">Review →</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Visitors Inside Campus --}}
        @if(auth()->user()->institute->feature_visitor)
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(16,185,129,0.06); background: #ffffff;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Guests On-Campus</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:#eefaf3;color:#198754;font-size:0.75rem;">
                            <i class="fas fa-door-open"></i></div>
                    </div>
                    <h3 class="fw-black mb-0" style="color:#0F172A;">{{ $visitorsActiveCount }}</h3>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <span class="text-muted" style="font-size:0.7rem;">currently inside</span>
                        @can('manage-visitors')
                            <a href="{{ route('visitors.index', ['status' => 'checked_in']) }}" class="text-success fw-semibold" style="font-size:0.68rem;text-decoration:none;">Console →</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Staff Leave Requests --}}
        @if(auth()->user()->institute->feature_hr)
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(16,185,129,0.06); background: #ffffff;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Staff Leaves</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:#eefaf3;color:#198754;font-size:0.75rem;">
                            <i class="fas fa-calendar-minus"></i></div>
                    </div>
                    <h3 class="fw-black mb-0" style="color:#0F172A;">{{ $pendingStaffLeavesCount }}</h3>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <span class="text-muted" style="font-size:0.7rem;">pending review</span>
                        @can('manage-staff')
                            <a href="{{ route('leaves.index') }}" class="text-success fw-semibold" style="font-size:0.68rem;text-decoration:none;">Approve →</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Staff Payroll Monthly Disbursal --}}
        @if(!auth()->user()->isPrincipal() && !auth()->user()->isReceptionist())
            @if(auth()->user()->institute->feature_hr)
            <div class="col-6 col-md-3">
                <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(16,185,129,0.06); background: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Monthly Payroll</span>
                            <div class="rounded-2 d-flex align-items-center justify-content-center"
                                style="width:30px;height:30px;background:#eefaf3;color:#198754;font-size:0.75rem;">
                                <i class="fas fa-hand-holding-usd"></i></div>
                        </div>
                        <h3 class="fw-black mb-0" style="color:#0F172A; font-size:1.3rem;">₹{{ number_format($totalPayrollThisMonth, 0) }}</h3>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <span class="text-muted" style="font-size:0.7rem;">disbursed this month</span>
                            <a href="{{ route('staff-payrolls.index') }}" class="text-success fw-semibold" style="font-size:0.68rem;text-decoration:none;">Details →</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @else
            {{-- Total Visits Today --}}
            @if(auth()->user()->institute->feature_visitor)
            <div class="col-6 col-md-3">
                <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(16,185,129,0.06); background: #ffffff;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Today's Visits</span>
                            <div class="rounded-2 d-flex align-items-center justify-content-center"
                                style="width:30px;height:30px;background:#eefaf3;color:#198754;font-size:0.75rem;">
                                <i class="fas fa-history"></i></div>
                        </div>
                        <h3 class="fw-black mb-0" style="color:#0F172A;">{{ $visitorsTodayCount }}</h3>
                        <div class="text-muted mt-1" style="font-size:0.7rem;">registered today</div>
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
            <div class="card border-0" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div
                    class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-medium text-dark mb-0">Revenue Overview</h6>
                        <p class="text-muted small mb-0">Last 6 months</p>
                    </div>
                    <span class="badge rounded-pill px-3 py-2 fw-semibold"
                        style="background:#EFF6FF;color:#4338CA;font-size:0.7rem;">₹{{ number_format($monthlyRevenue, 0) }}
                        this month</span>
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
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-medium text-dark mb-0">Today's Attendance</h6>
                    <p class="text-muted small mb-0">{{ now()->format('D, d M Y') }}</p>
                </div>
                <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center">
                    @if($todayAttendancePct !== null)
                        <div style="position:relative;width:130px;height:130px;margin-bottom:16px;">
                            <canvas id="attendanceRing"></canvas>
                            <div
                                style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                                <span class="fw-black"
                                    style="font-size:1.7rem;color:#{{ $todayAttendancePct >= 75 ? '10B981' : 'EF4444' }};">{{ $todayAttendancePct }}%</span>
                                <span class="text-muted" style="font-size:0.68rem;">present</span>
                            </div>
                        </div>
                        <div class="d-flex gap-4 text-center mt-1">
                            <div>
                                <div class="fw-medium text-success" style="font-size:1.1rem;">{{ $todayPresent }}</div>
                                <div class="text-muted" style="font-size:0.7rem;">Present</div>
                            </div>
                            <div>
                                <div class="fw-medium text-danger" style="font-size:1.1rem;">{{ $todayTotal - $todayPresent }}
                                </div>
                                <div class="text-muted" style="font-size:0.7rem;">Absent</div>
                            </div>
                            <div>
                                <div class="fw-medium text-dark" style="font-size:1.1rem;">{{ $todayTotal }}</div>
                                <div class="text-muted" style="font-size:0.7rem;">Total</div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-calendar-times fa-2x text-muted opacity-25 mb-3 d-block"></i>
                            <div class="fw-semibold text-muted small">No attendance marked today</div>
                            @if($noAttendanceToday > 0)
                                <a href="{{ route('attendance.index') }}" class="btn btn-sm btn-primary mt-3 rounded-pill">Mark
                                    Now</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- ── ROW 3: ATTENDANCE TREND + BATCH DONUT + RECENT PAYMENTS ── --}}
    <div class="row g-4 mb-4">
        @if(!auth()->user()->isReceptionist())
        {{-- 7-day Attendance % Bar Chart --}}
        <div class="{{ auth()->user()->isPrincipal() ? 'col-lg-8' : 'col-lg-5' }}">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-medium text-dark mb-0">Attendance Trend</h6>
                    <p class="text-muted small mb-0">Last 7 days — percentage</p>
                </div>
                <div class="card-body p-4">
                    <canvas id="attendanceTrendChart" height="160"></canvas>
                </div>
            </div>
        </div>
        @endif

        @if(!auth()->user()->isReceptionist())
        {{-- Students per Batch --}}
        <div class="{{ auth()->user()->isPrincipal() ? 'col-lg-4' : 'col-lg-3' }}">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-medium text-dark mb-0">Students by Batch</h6>
                    <p class="text-muted small mb-0">Distribution</p>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center" style="min-height:220px;">
                    <canvas id="batchChart"></canvas>
                </div>
            </div>
        </div>
        @endif

        @if(!auth()->user()->isPrincipal() && auth()->user()->institute && auth()->user()->institute->feature_fees)
        {{-- Recent Payments --}}
        <div class="col-lg-4">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div
                    class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-medium text-dark mb-0">Recent Payments</h6>
                    <a href="{{ route('payments.index') }}" class="text-primary fw-semibold" style="font-size:0.72rem;">View
                        all</a>
                </div>
                <div class="card-body p-0">
                    @forelse($recentPayments as $payment)
                        <div class="d-flex align-items-center px-4 py-2 border-bottom" style="border-color:#F8FAFC!important;">
                            <div class="me-3 rounded-2 d-flex align-items-center justify-content-center fw-medium text-white flex-shrink-0"
                                style="width:34px;height:34px;background:linear-gradient(135deg,#2563EB,#38BDF8);font-size:0.72rem;">
                                {{ strtoupper(substr($payment->student->name ?? 'N', 0, 2)) }}
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <div class="fw-semibold text-dark text-truncate" style="font-size:0.8rem;">
                                    {{ $payment->student->name ?? '—' }}</div>
                                <div class="text-muted" style="font-size:0.68rem;">{{ $payment->payment_date->format('d M Y') }}
                                </div>
                            </div>
                            <div class="fw-medium text-success ms-2" style="font-size:0.82rem;white-space:nowrap;">
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

    {{-- ── ROW 4: PREMIUM VISITOR TREND & REALTIME TICKERS ── --}}
    @if(auth()->user()->institute && auth()->user()->institute->feature_visitor)
    <div class="row g-4 mb-4">
        {{-- Visitor Entries Trend --}}
        <div class="col-lg-6">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04); background: #ffffff;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-semibold text-dark mb-0">Visitor Traffic Trend</h6>
                    <p class="text-muted small mb-0">Daily registrations over the last 7 days</p>
                </div>
                <div class="card-body p-4">
                    <div style="height: 220px; position: relative;">
                        <canvas id="visitorTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Live Gate Logs --}}
        <div class="col-lg-6">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04); background: #ffffff;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-semibold text-dark mb-0">Live Gate Register Ticker</h6>
                        <p class="text-muted small mb-0">Recent guest check-ins</p>
                    </div>
                    @can('manage-visitors')
                        <a href="{{ route('visitors.index') }}" class="text-success fw-semibold" style="font-size:0.72rem; text-decoration:none;">Full Console</a>
                    @endcan
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.82rem;">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.65rem; letter-spacing: 0.5px; position: sticky; top:0; z-index:1;">
                                <tr>
                                    <th class="border-0 px-4">Visitor</th>
                                    <th class="border-0">Whom to Meet</th>
                                    <th class="border-0">Time</th>
                                    <th class="border-0 px-4 text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentVisitors as $visitor)
                                    <tr style="border-color:#F8FAFC!important;">
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
                                                <div>{{ $visitor->check_in_time->format('h:i A') }}</div>
                                                <div class="text-muted" style="font-size:0.7rem;">{{ $visitor->check_in_time->format('d M') }}</div>
                                            @else
                                                <div class="text-muted italic">Pending</div>
                                            @endif
                                        </td>
                                        <td class="px-4 text-end">
                                            @if($visitor->status === 'pending')
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1" style="font-size:0.65rem;">Awaiting</span>
                                            @elseif($visitor->status === 'checked_in')
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size:0.65rem;">Inside</span>
                                            @elseif($visitor->status === 'checked_out')
                                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1" style="font-size:0.65rem;">Out</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size:0.65rem;">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">No visitor records logged.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ── NEEDS ATTENTION BANNER ── --}}
    @if($noAttendanceToday > 0 && !auth()->user()->isReceptionist())
        <div class="alert border-0 d-flex align-items-center gap-3 mb-0"
            style="background:#FEF3C7;border-radius:14px;padding:14px 20px;">
            <i class="fas fa-exclamation-triangle text-warning fs-5"></i>
            <div>
                <span class="fw-medium text-dark" style="font-size:0.88rem;">Attendance not marked for {{ $noAttendanceToday }}
                    student{{ $noAttendanceToday > 1 ? 's' : '' }} today.</span>
                <a href="{{ route('attendance.index') }}" class="text-primary fw-semibold ms-2" style="font-size:0.82rem;">Mark
                    attendance →</a>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        @if(!auth()->user()->isPrincipal())
        // ── 6-Month Revenue Line Chart ──
        const revCtx = document.getElementById('revenueChart').getContext('2d');
        const revData = @json($revenueData);
        const revGrad = revCtx.createLinearGradient(0, 0, 0, 300);
        revGrad.addColorStop(0, 'rgba(37,99,235,0.2)');
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
                    borderWidth: 2.5,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2563EB',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { callback: v => '₹' + v.toLocaleString() } },
                    x: { grid: { display: false } }
                }
            }
        });
        @endif

        // ── Today's Attendance Ring ──
        @if($todayAttendancePct !== null)
            const ringCtx = document.getElementById('attendanceRing').getContext('2d');
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
                options: { cutout: '78%', plugins: { legend: { display: false }, tooltip: { enabled: false } }, animation: { animateRotate: true } }
            });
        @endif

    // ── 7-Day Attendance Trend Bar ──
    const trendCtx = document.getElementById('attendanceTrendChart').getContext('2d');
        const trendData = @json($attendanceTrend);
        new Chart(trendCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(trendData),
                datasets: [{
                    label: 'Attendance %',
                    data: Object.values(trendData),
                    backgroundColor: Object.values(trendData).map(v => v >= 75 ? 'rgba(16,185,129,0.75)' : 'rgba(239,68,68,0.7)'),
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => ctx.raw + '%' } } },
                scales: {
                    y: { beginAtZero: true, max: 100, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { callback: v => v + '%' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // ── Students per Batch Donut ──
        const batchCtx = document.getElementById('batchChart').getContext('2d');
        const batchData = @json($studentsPerBatch);
        new Chart(batchCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(batchData),
                datasets: [{
                    data: Object.values(batchData),
                    backgroundColor: ['#2563EB', '#10B981', '#F59E0B', '#10B981', '#14B8A6', '#06B6D4'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 12, font: { size: 10 } } } }
            }
        });

        // ── Visitor Traffic Trend Line Chart ──
        const visCtx = document.getElementById('visitorTrendChart').getContext('2d');
        const visData = @json($visitorTrend);
        const visGrad = visCtx.createLinearGradient(0, 0, 0, 180);
        visGrad.addColorStop(0, 'rgba(25, 135, 84, 0.15)');
        visGrad.addColorStop(1, 'rgba(25, 135, 84, 0.0)');
        new Chart(visCtx, {
            type: 'line',
            data: {
                labels: Object.keys(visData),
                datasets: [{
                    label: 'Visitors',
                    data: Object.values(visData),
                    borderColor: '#198754',
                    backgroundColor: visGrad,
                    borderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#198754',
                    pointBorderWidth: 1.5,
                    pointRadius: 3,
                    fill: true,
                    tension: 0.35
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        grid: { color: 'rgba(0,0,0,0.03)' }, 
                        ticks: { stepSize: 1, font: { size: 9 } } 
                    },
                    x: { grid: { display: false }, ticks: { font: { size: 9 } } }
                }
            }
        });
    </script>
@endpush