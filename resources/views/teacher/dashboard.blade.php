@extends('layouts.admin')

@section('title', 'Teacher Dashboard')

@section('content')

    {{-- ── ROW 1: 4 STAT CARDS ── --}}
    <div class="row g-3 mb-4">
        {{-- Total Students --}}
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(79,70,229,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted"
                            style="font-size:0.62rem;letter-spacing:1px;">Students</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(79,70,229,0.1);color:#4F46E5;font-size:0.75rem;">
                            <i class="fas fa-users"></i></div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $totalStudents }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">assigned students</div>
                </div>
            </div>
        </div>
        {{-- Active Batches --}}
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(16,185,129,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted"
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
        {{-- Homework --}}
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(99,102,241,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted"
                            style="font-size:0.62rem;letter-spacing:1px;">Homework</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(99,102,241,0.1);color:#6366F1;font-size:0.75rem;">
                            <i class="fas fa-book-open"></i></div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $activeHomework }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">active tasks</div>
                </div>
            </div>
        </div>
        {{-- Upcoming Tests --}}
        <div class="col-6 col-md-3">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(239,68,68,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-bold text-muted"
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
    </div>

    {{-- ── ROW 2: TODAY'S ATTENDANCE SNAPSHOT (FULL WIDTH) ── --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-12">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-bold text-dark mb-0">Today's Attendance</h6>
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
                                <div class="fw-bold text-success" style="font-size:1.1rem;">{{ $todayPresent }}</div>
                                <div class="text-muted" style="font-size:0.7rem;">Present</div>
                            </div>
                            <div>
                                <div class="fw-bold text-danger" style="font-size:1.1rem;">{{ $todayTotal - $todayPresent }}
                                </div>
                                <div class="text-muted" style="font-size:0.7rem;">Absent</div>
                            </div>
                            <div>
                                <div class="fw-bold text-dark" style="font-size:1.1rem;">{{ $todayTotal }}</div>
                                <div class="text-muted" style="font-size:0.7rem;">Total</div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-calendar-times fa-2x text-muted opacity-25 mb-3 d-block"></i>
                            <div class="fw-semibold text-muted small">No class attendance marked today</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ── ROW 3: ATTENDANCE TREND + BATCH DONUT ── --}}
    <div class="row g-4 mb-4">
        {{-- 7-day Attendance Trend --}}
        <div class="col-lg-7">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-bold text-dark mb-0">Attendance Trend</h6>
                    <p class="text-muted small mb-0">Last 7 days — Percentage</p>
                </div>
                <div class="card-body p-4">
                    <canvas id="attendanceTrendChart" height="160"></canvas>
                </div>
            </div>
        </div>

        {{-- Students per Batch distribution --}}
        <div class="col-lg-5">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-bold text-dark mb-0">Students by Batch</h6>
                    <p class="text-muted small mb-0">Assigned Batches Distribution</p>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center" style="min-height:220px;">
                    <canvas id="batchChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- ── NEEDS ATTENTION BANNER ── --}}
    @if($noAttendanceToday > 0)
        <div class="alert border-0 d-flex align-items-center gap-3 mb-0"
            style="background:#FEF3C7;border-radius:14px;padding:14px 20px;">
            <i class="fas fa-exclamation-triangle text-warning fs-5"></i>
            <div>
                <span class="fw-bold text-dark" style="font-size:0.88rem;">Attendance not marked for {{ $noAttendanceToday }}
                    student{{ $noAttendanceToday > 1 ? 's' : '' }} today.</span>
                <a href="{{ route('attendance.index') }}" class="text-primary fw-semibold ms-2" style="font-size:0.82rem;">Mark
                    attendance →</a>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
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
                    backgroundColor: ['#4F46E5', '#10B981', '#F59E0B', '#EC4899', '#8B5CF6', '#06B6D4'],
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
    </script>
@endpush