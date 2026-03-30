@extends('layouts.admin')

@section('title', 'Teacher Dashboard')

@section('content')

    {{-- ── DASHBOARD HEADER & TOGGLE ── --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">Teacher Dashboard</h4>
            <p class="text-muted small mb-0">Welcome back, {{ auth()->user()->name }}</p>
        </div>
        @if($isClassTeacher)
            <div class="btn-group p-1 bg-white rounded-3 shadow-sm" style="border: 1px solid rgba(0,0,0,0.05);">
                <a href="{{ route('dashboard') }}" 
                   class="btn btn-sm {{ !$isMyClassView ? 'btn-primary shadow-sm' : 'btn-light border-0' }} px-3 fw-semibold" 
                   style="border-radius: 8px !important;">All Batches</a>
                <a href="{{ route('dashboard', ['view' => 'my_class']) }}" 
                   class="btn btn-sm {{ $isMyClassView ? 'btn-primary shadow-sm' : 'btn-light border-0' }} px-3 fw-semibold" 
                   style="border-radius: 8px !important;">My Class Only</a>
            </div>
        @endif
    </div>

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
                    <div class="text-muted" style="font-size:0.7rem;">{{ $isMyClassView ? 'class' : 'assigned' }} students</div>
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
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $activeBatchesCount }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">{{ $isMyClassView ? 'managed' : 'active' }} batches</div>
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

    @if($canSeeAttendance)
        {{-- ── CLASS MANAGEMENT VIEW (Attendance & Metrics) ── --}}
        <div class="row g-4 mb-4">
            <div class="col-lg-12">
                <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.04); background: linear-gradient(to right, #ffffff, #f8faff);">
                    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
                        <div class="d-flex align-items-center gap-2">
                             <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:32px;height:32px;background:rgba(79,70,229,0.1) !important;">
                                <i class="fas fa-calendar-check text-primary small"></i>
                             </div>
                            <h6 class="fw-bold text-dark mb-0">Today's Attendance {{ $isMyClassView ? '(My Class)' : '' }}</h6>
                        </div>
                        <p class="text-muted small mb-0 mt-1">{{ now()->format('D, d M Y') }}</p>
                    </div>
                    <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center">
                        @if($todayAttendancePct !== null)
                            <div style="position:relative;width:140px;height:140px;margin-bottom:16px;">
                                <canvas id="attendanceRing"></canvas>
                                <div
                                    style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                                    <span class="fw-black"
                                        style="font-size:1.8rem;color:#{{ $todayAttendancePct >= 75 ? '10B981' : 'EF4444' }};">{{ $todayAttendancePct }}%</span>
                                    <span class="text-muted" style="font-size:0.7rem; font-weight:600;">present</span>
                                </div>
                            </div>
                            <div class="d-flex gap-5 text-center mt-2">
                                <div>
                                    <div class="fw-bold text-success fs-5">{{ $todayPresent }}</div>
                                    <div class="text-muted small fw-medium">Present</div>
                                </div>
                                <div>
                                    <div class="fw-bold text-danger fs-5">{{ $todayTotal - $todayPresent }}</div>
                                    <div class="text-muted small fw-medium">Absent</div>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark fs-5">{{ $todayTotal }}</div>
                                    <div class="text-muted small fw-medium">Total</div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <div class="mb-3">
                                    <span class="display-6 opacity-25">🗓️</span>
                                </div>
                                <div class="fw-semibold text-muted">No attendance data for today yet</div>
                                <a href="{{ route('attendance.index') }}" class="btn btn-sm btn-outline-primary mt-3 px-3 rounded-pill fw-bold">Mark Attendance Now</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ── ATTENDANCE TREND + CLASS DISTRIBUTION ── --}}
        <div class="row g-4 mb-4">
            <div class="col-lg-7">
                <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.04);">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h6 class="fw-bold text-dark mb-0">Weekly Trend</h6>
                        <p class="text-muted small mb-0">Class presence over the last 7 days</p>
                    </div>
                    <div class="card-body p-4">
                        <canvas id="attendanceTrendChart" height="180"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.04);">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h6 class="fw-bold text-dark mb-0">Student Distribution</h6>
                        <p class="text-muted small mb-0">Students across managed batches</p>
                    </div>
                    <div class="card-body p-4 d-flex align-items-center justify-content-center">
                        <div style="height:220px; width:100%;">
                            <canvas id="batchChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- ── ACADEMIC OVERVIEW (Unified for Main Dashboard) ── --}}
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4" style="border-radius:20px; overflow:hidden;">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="fw-bold text-dark mb-0"><i class="fas fa-tasks text-primary me-2"></i> Upcoming Agenda</h6>
                            <span class="badge bg-light text-primary rounded-pill px-3">Academic Focus</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-muted small text-uppercase">
                                    <tr>
                                        <th class="ps-4 py-3 border-0">Task / Title</th>
                                        <th class="py-3 border-0">Batch & Subject</th>
                                        <th class="py-3 border-0">Date</th>
                                        <th class="pe-4 py-3 border-0 text-center">Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topHomework as $hw)
                                        <tr>
                                            <td class="ps-4 py-3 border-bottom-0">
                                                <div class="fw-bold text-dark">{{ $hw->title }}</div>
                                                <div class="text-muted small truncate" style="max-width:200px;">{{ Str::limit($hw->description, 40) }}</div>
                                            </td>
                                            <td class="py-3 border-bottom-0">
                                                <div class="badge bg-primary-subtle text-primary border-0 small px-2 py-1 mb-1" style="font-size:0.7rem;">{{ $hw->batch->name }}</div>
                                                <div class="text-muted" style="font-size:0.75rem;">{{ $hw->subject->name }}</div>
                                            </td>
                                            <td class="py-3 border-bottom-0">
                                                <div class="text-dark fw-semibold" style="font-size:0.85rem;">{{ $hw->due_date->format('d M') }}</div>
                                                <div class="text-muted small">{{ $hw->due_date->format('Y') }}</div>
                                            </td>
                                            <td class="pe-4 py-3 border-bottom-0 text-center">
                                                <span class="badge bg-indigo text-indigo border-0 small" style="background:rgba(79,70,229,0.1) !important; color:#4F46E5 !important;">Homework</span>
                                            </td>
                                        </tr>
                                    @empty
                                        @if($topTests->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <img src="https://illustrations.popsy.co/gray/work-from-home.svg" alt="Free" class="mb-3" style="height:100px; opacity:0.5;">
                                                <p class="text-muted mb-0">No upcoming homework or tests listed.</p>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforelse

                                    @foreach($topTests as $test)
                                        <tr class="border-top" style="border-top-color:rgba(0,0,0,0.03) !important;">
                                            <td class="ps-4 py-3 border-bottom-0">
                                                <div class="fw-bold text-dark">{{ $test->title }}</div>
                                                <div class="text-muted small">{{ $test->total_marks }} Marks Test</div>
                                            </td>
                                            <td class="py-3 border-bottom-0">
                                                <div class="badge bg-success-subtle text-success border-0 small px-2 py-1 mb-1" style="font-size:0.7rem;">{{ $test->batch->name }}</div>
                                                <div class="text-muted" style="font-size:0.75rem;">{{ $test->subject->name }}</div>
                                            </td>
                                            <td class="py-3 border-bottom-0">
                                                <div class="text-dark fw-semibold" style="font-size:0.85rem;">{{ $test->test_date->format('d M') }}</div>
                                                <div class="text-muted small">{{ $test->test_date->format('Y') }}</div>
                                            </td>
                                            <td class="pe-4 py-3 border-bottom-0 text-center">
                                                <span class="badge bg-danger-subtle text-danger border-0 small">Exam/Test</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                {{-- Quick Actions --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:20px; background: linear-gradient(135deg, #4F46E5, #6366F1);">
                    <div class="card-body p-4 text-white">
                        <h6 class="fw-bold mb-3">Quick Actions</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="{{ route('homework.index') }}" class="btn btn-white w-100 p-3 text-start bg-white border-0 shadow-sm" style="border-radius:14px; text-decoration:none;">
                                    <div class="text-primary mb-1"><i class="fas fa-plus-circle"></i></div>
                                    <div class="text-dark fw-bold small">Homework</div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('tests.index') }}" class="btn btn-white w-100 p-3 text-start bg-white border-0 shadow-sm" style="border-radius:14px; text-decoration:none;">
                                    <div class="text-danger mb-1"><i class="fas fa-file-invoice"></i></div>
                                    <div class="text-dark fw-bold small">New Test</div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('live-lectures.index') }}" class="btn btn-white w-100 p-3 text-start bg-white border-0 shadow-sm" style="border-radius:14px; text-decoration:none;">
                                    <div class="text-success mb-1"><i class="fas fa-video"></i></div>
                                    <div class="text-dark fw-bold small">Live Class</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Batch Chart --}}
                <div class="card border-0 shadow-sm" style="border-radius:20px;">
                    <div class="card-body p-4">
                         <h6 class="fw-bold text-dark mb-4">Batch Distribution</h6>
                         <div style="height:250px;">
                            <canvas id="batchChart"></canvas>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ── Students per Batch Donut (Universal) ──
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
                            backgroundColor: ['#4F46E5', '#10B981', '#F59E0B', '#EC4899', '#8B5CF6', '#06B6D4'],
                            borderWidth: 0,
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '72%',
                        plugins: { 
                            legend: { 
                                position: 'bottom', 
                                labels: { 
                                    usePointStyle: true, 
                                    padding: 20, 
                                    font: { size: 11, weight: '500' },
                                    color: '#64748b'
                                } 
                            },
                            tooltip: {
                                backgroundColor: '#1e293b',
                                padding: 12,
                                titleFont: { size: 13 },
                                bodyFont: { size: 13 },
                                cornerRadius: 8,
                                displayColors: true
                            }
                        }
                    }
                });
            }

            // ── Attendance Metrics (Conditional) ──
            @if($canSeeAttendance)
                // Today's Ring
                const ringCanvas = document.getElementById('attendanceRing');
                if (ringCanvas) {
                    const ringCtx = ringCanvas.getContext('2d');
                    const pct = {{ $todayAttendancePct ?? 0 }};
                    new Chart(ringCtx, {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                data: [pct, 100 - pct],
                                backgroundColor: [pct >= 75 ? '#10B981' : '#EF4444', '#F1F5F9'],
                                borderWidth: 0,
                                borderRadius: 10
                            }]
                        },
                        options: { 
                            cutout: '82%', 
                            plugins: { legend: { display: false }, tooltip: { enabled: false } }, 
                            animation: { animateRotate: true, duration: 1500 } 
                        }
                    });
                }

                // 7-Day Trend
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
                                backgroundColor: Object.values(trendData).map(v => v >= 75 ? 'rgba(16,185,129,0.8)' : 'rgba(239,68,68,0.7)'),
                                borderRadius: 8,
                                borderSkipped: false,
                                barThickness: 25
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { 
                                legend: { display: false }, 
                                tooltip: { 
                                    backgroundColor: '#1e293b',
                                    padding: 10,
                                    callbacks: { label: ctx => ' ' + ctx.raw + '%' } 
                                } 
                            },
                            scales: {
                                y: { 
                                    beginAtZero: true, 
                                    max: 100, 
                                    grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false }, 
                                    ticks: { 
                                        callback: v => v + '%',
                                        stepSize: 25,
                                        font: { size: 10 },
                                        color: '#94a3b8'
                                    } 
                                },
                                x: { grid: { display: false }, ticks: { font: { size: 10 }, color: '#94a3b8' } }
                            }
                        }
                    });
                }
            @endif
        });
    </script>
@endpush