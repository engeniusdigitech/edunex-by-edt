@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
/* ══════════════════════════════════════════════
   DASHBOARD v3 — BOLD & VISUAL
══════════════════════════════════════════════ */

/* ── Hero ── */
.db-hero {
    background: linear-gradient(135deg, #0F172A 0%, #1A2E4A 45%, #0C3547 100%);
    border-radius: 22px;
    padding: 28px 32px 24px;
    margin-bottom: 22px;
    position: relative;
    overflow: hidden;
}
.db-hero::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 260px; height: 260px;
    border-radius: 50%;
    background: rgba(99,102,241,0.08);
    pointer-events: none;
}
.db-hero::after {
    content: '';
    position: absolute;
    bottom: -80px; right: 120px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(13,148,136,0.06);
    pointer-events: none;
}
.db-hero-inner { position: relative; z-index: 1; display: flex; align-items: center; gap: 18px; flex-wrap: wrap; }
.db-hero-av {
    width: 58px; height: 58px; border-radius: 18px; flex-shrink: 0;
    background: linear-gradient(135deg,#6366F1,#0D9488);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; font-weight: 500; color: #fff; letter-spacing: -1px;
    box-shadow: 0 8px 24px rgba(99,102,241,0.35);
    border: 2px solid rgba(255,255,255,0.15);
}
.db-hero-text { flex: 1; min-width: 0; }
.db-hero-greet { font-size: 0.68rem; font-weight: 400; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 1.8px; }
.db-hero-name { font-size: 1.35rem; font-weight: 500; color: #fff; letter-spacing: -0.5px; margin: 3px 0 5px; line-height: 1; }
.db-hero-sub  { font-size: 0.72rem; font-weight: 300; color: rgba(255,255,255,0.4); display: flex; gap: 14px; flex-wrap: wrap; }
.db-hero-sub span { display: flex; align-items: center; gap: 5px; font-weight: 300; }
.db-live-badge {
    display: inline-flex; align-items: center; gap: 6px; margin-top: 10px;
    background: rgba(16,185,129,0.15); border: 1px solid rgba(16,185,129,0.25);
    border-radius: 50px; padding: 4px 12px;
    font-size: 0.62rem; font-weight: 400; color: #34D399; text-transform: uppercase; letter-spacing: 0.8px;
}
.db-live-dot { width: 6px; height: 6px; border-radius: 50%; background: #34D399; animation: livePulse 2s ease infinite; }
@keyframes livePulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(1.4)} }

.db-hero-chips { display: flex; gap: 10px; flex-wrap: wrap; margin-left: auto; }
.hero-chip {
    min-width: 80px; padding: 10px 16px; text-align: center;
    background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px; backdrop-filter: blur(8px);
}
.hero-chip .hc-val { font-size: 1.4rem; font-weight: 500; color: #fff; letter-spacing: -1px; line-height: 1; }
.hero-chip .hc-lbl { font-size: 0.6rem; font-weight: 300; color: rgba(255,255,255,0.38); text-transform: uppercase; letter-spacing: 0.8px; margin-top: 3px; }
.hero-chip.green .hc-val { color: #34D399; }

/* ── Section title ── */
.db-sec { display: flex; align-items: center; gap: 8px; margin: 20px 0 12px; }
.db-sec-label { font-size: 0.65rem; font-weight: 400; text-transform: uppercase; letter-spacing: 1.4px; color: #94A3B8; white-space: nowrap; }
.db-sec-line { flex: 1; height: 1px; background: #F1F5F9; }

/* ── COLORFUL KPI CARDS ── */
.kpi-block {
    border-radius: 18px; padding: 20px 20px 16px;
    position: relative; overflow: hidden;
    color: #fff;
    min-height: 130px;
    display: flex; flex-direction: column; justify-content: space-between;
    transition: transform 0.2s, box-shadow 0.2s;
}
.kpi-block:hover { transform: translateY(-4px); }
.kpi-block::after {
    content: '';
    position: absolute;
    top: -30px; right: -30px;
    width: 100px; height: 100px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
    pointer-events: none;
}
.kpi-block::before {
    content: '';
    position: absolute;
    bottom: -20px; left: -10px;
    width: 70px; height: 70px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    pointer-events: none;
}
.kpi-block-icon {
    width: 38px; height: 38px; border-radius: 12px;
    background: rgba(255,255,255,0.18);
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; color: #fff;
    position: relative; z-index: 1;
    margin-bottom: 10px;
}
.kpi-block-val {
    font-size: 2rem; font-weight: 500; letter-spacing: -1.5px;
    line-height: 1; color: #fff; position: relative; z-index: 1;
}
.kpi-block-lbl {
    font-size: 0.65rem; font-weight: 400; text-transform: uppercase;
    letter-spacing: 0.8px; color: rgba(255,255,255,0.65);
    margin-top: 4px; position: relative; z-index: 1;
}
.kpi-block-sub {
    font-size: 0.7rem; color: rgba(255,255,255,0.5);
    margin-top: 2px; position: relative; z-index: 1;
}

.kb-blue   { background: linear-gradient(135deg,#2563EB,#4F88FF); box-shadow: 0 8px 24px rgba(37,99,235,0.35); }
.kb-teal   { background: linear-gradient(135deg,#0D9488,#2DD4BF); box-shadow: 0 8px 24px rgba(13,148,136,0.35); }
.kb-violet { background: linear-gradient(135deg,#7C3AED,#A78BFA); box-shadow: 0 8px 24px rgba(124,58,237,0.35); }
.kb-sky    { background: linear-gradient(135deg,#0284C7,#38BDF8); box-shadow: 0 8px 24px rgba(2,132,199,0.35); }
.kb-amber  { background: linear-gradient(135deg,#D97706,#FCD34D); box-shadow: 0 8px 24px rgba(217,119,6,0.35); }
.kb-rose   { background: linear-gradient(135deg,#BE185D,#F472B6); box-shadow: 0 8px 24px rgba(190,24,93,0.35); }

/* ── Ops Console ── */
.ops-tile {
    background: #fff; border-radius: 16px; border: 1px solid #EEF2F7;
    padding: 18px; display: flex; align-items: flex-start; gap: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: all 0.2s;
}
.ops-tile:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.09); transform: translateY(-3px); }
.ops-tile-icon {
    width: 46px; height: 46px; border-radius: 14px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
}
.ops-tile-val { font-size: 1.8rem; font-weight: 500; color: #0F172A; letter-spacing: -1.5px; line-height: 1; }
.ops-tile-lbl { font-size: 0.62rem; font-weight: 400; text-transform: uppercase; letter-spacing: 0.8px; color: #94A3B8; margin-top: 2px; }
.ops-tile-desc { font-size: 0.72rem; color: #64748B; margin-top: 6px; }
.ops-tile-cta { display: inline-flex; align-items: center; gap: 4px; font-size: 0.7rem; font-weight: 400; margin-top: 8px; text-decoration: none; }

/* ── Today Attendance Card ── */
.glance-card {
    background: linear-gradient(135deg,#F5F3FF,#EFF6FF);
    border: 1px solid #DDD6FE; border-radius: 18px; padding: 22px; height: 100%;
}

/* ── Chart card ── */
.c-card {
    background: #fff; border-radius: 18px; border: 1px solid #EEF2F7;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04); overflow: hidden; height: 100%;
}
.c-card-head { padding: 18px 22px 0; display: flex; align-items: flex-start; justify-content: space-between; }
.c-card-title { font-size: 0.92rem; font-weight: 400; color: #0F172A; }
.c-card-sub   { font-size: 0.7rem; color: #94A3B8; margin-top: 2px; }
.c-card-body  { padding: 14px 20px 18px; }

/* ── Alert ── */
.db-alert {
    display: flex; align-items: center; gap: 14px;
    background: linear-gradient(135deg,#FFFBEB,#FEF9C3);
    border: 1px solid #FDE68A; border-radius: 14px; padding: 14px 18px; margin-bottom: 18px;
}

/* ── Gate table ── */
.g-table { width: 100%; font-size: 0.78rem; border-collapse: collapse; }
.g-table thead th { font-size: 0.6rem; font-weight: 400; text-transform: uppercase; letter-spacing: 0.7px; color: #94A3B8; padding: 10px 16px; background: #F8FAFC; border-bottom: 1px solid #F1F5F9; }
.g-table tbody td { padding: 11px 16px; border-bottom: 1px solid #F8FAFC; color: #475569; vertical-align: middle; }
.g-table tbody tr:hover td { background: #FAFBFF; }
.g-table tbody tr:last-child td { border-bottom: none; }

/* ── Payment row ── */
.p-row { display: flex; align-items: center; gap: 12px; padding: 11px 22px; border-bottom: 1px solid #F8FAFC; transition: background 0.15s; }
.p-row:hover { background: #FAFBFF; }
.p-row:last-child { border-bottom: none; }
.p-av { width: 34px; height: 34px; border-radius: 10px; background: #EEF2FF; color: #6366F1; display: flex; align-items: center; justify-content: center; font-size: 0.72rem; font-weight: 400; flex-shrink: 0; }
.p-name { font-size: 0.82rem; font-weight: 400; color: #0F172A; }
.p-date { font-size: 0.66rem; color: #94A3B8; }
.p-amt  { font-size: 0.85rem; font-weight: 400; color: #0D9488; white-space: nowrap; }

/* ── Revenue Highlight ── */
.rev-highlight {
    background: linear-gradient(135deg,#0F172A,#1E3A5F);
    border-radius: 12px; padding: 12px 18px;
    display: flex; align-items: center; gap: 14px; margin-top: 12px;
}
.rev-highlight-val { font-size: 1.4rem; font-weight: 500; color: #34D399; letter-spacing: -1px; }
.rev-highlight-lbl { font-size: 0.68rem; font-weight: 400; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.6px; margin-top: 2px; }

/* ── Attendance bar ── */
.att-bar-track { height: 8px; background: #EDE9FE; border-radius: 50px; overflow: hidden; margin-top: 10px; }
.att-bar-fill  { height: 100%; border-radius: 50px; transition: width 1s ease; }
</style>

<x-biometric-attendance-card />

@php
    $user = auth()->user();
    $hour = (int) now()->format('H');
    $greeting = $hour < 12 ? 'Good Morning' : ($hour < 17 ? 'Good Afternoon' : 'Good Evening');
@endphp

{{-- ══ HERO ══ --}}
<div class="db-hero mb-4">
    <div class="db-hero-inner">
        <div class="db-hero-av">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
        <div class="db-hero-text">
            <div class="db-hero-greet">
                @if($hour < 12)<i class="fas fa-sun" style="color:#FCD34D;margin-right:4px;"></i>
                @elseif($hour < 17)<i class="fas fa-cloud-sun" style="color:#FCD34D;margin-right:4px;"></i>
                @else<i class="fas fa-moon" style="color:#A5B4FC;margin-right:4px;"></i>@endif
                {{ $greeting }}
            </div>
            <div class="db-hero-name">{{ $user->name }}</div>
            <div class="db-hero-sub">
                <span><i class="fas fa-building"></i>{{ $user->institute->name ?? 'Admin Panel' }}</span>
                <span><i class="fas fa-calendar-day"></i>{{ now()->format('D, d M Y') }}</span>
                @php
                    $roleLabel = $user->isSuperAdmin() ? 'Super Admin' : ($user->isInstituteAdmin() ? 'Admin' : ($user->isPrincipal() ? 'Principal' : ($user->isTeacher() ? 'Teacher' : ($user->isReceptionist() ? 'Receptionist' : 'Staff'))));
                @endphp
                <span><i class="fas fa-shield-halved"></i>{{ $roleLabel }}</span>
            </div>
            <div class="db-live-badge"><div class="db-live-dot"></div>System Active</div>
        </div>
        <div class="db-hero-chips">
            @if(!$user->isReceptionist())
            <div class="hero-chip green">
                <div class="hc-val">{{ $totalStudents }}</div>
                <div class="hc-lbl">Students</div>
            </div>
            <div class="hero-chip">
                <div class="hc-val">{{ $activeBatches }}</div>
                <div class="hc-lbl">Batches</div>
            </div>
            @endif
            @if(!$user->isPrincipal() && $user->institute && $user->institute->feature_fees)
            <div class="hero-chip">
                <div class="hc-val" style="font-size:1rem;">₹{{ number_format($monthlyRevenue/1000,1) }}K</div>
                <div class="hc-lbl">This Month</div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- ══ ALERT ══ --}}
@if($noAttendanceToday > 0 && !$user->isReceptionist())
<div class="db-alert">
    <div style="width:38px;height:38px;border-radius:12px;background:#FEF3C7;color:#D97706;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;">
        <i class="fas fa-triangle-exclamation"></i>
    </div>
    <div style="flex:1;">
        <div style="font-size:0.85rem;font-weight:400;color:#92400E;">{{ $noAttendanceToday }} student{{ $noAttendanceToday > 1 ? 's' : '' }} without attendance today</div>
        <div style="font-size:0.73rem;font-weight:300;color:#B45309;margin-top:2px;">Mark before the day ends to keep records accurate.</div>
    </div>
    <a href="{{ route('attendance.index') }}" style="flex-shrink:0;background:#D97706;color:#fff;border-radius:10px;padding:9px 18px;font-size:0.78rem;font-weight:700;text-decoration:none;">
        Mark Now <i class="fas fa-arrow-right ms-1"></i>
    </a>
</div>
@endif

{{-- ══ KPI BLOCKS ══ --}}
@if(!$user->isReceptionist())
<div class="db-sec">
    <div class="db-sec-label"><i class="fas fa-layer-group" style="color:#6366F1;font-size:0.75rem;"></i> Key Metrics</div>
    <div class="db-sec-line"></div>
    <span style="font-size:0.65rem;color:#CBD5E1;white-space:nowrap;">{{ now()->format('d M Y') }}</span>
</div>

<div class="row g-3 mb-2">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="kpi-block kb-blue">
            <div class="kpi-block-icon"><i class="fas fa-users"></i></div>
            <div>
                <div class="kpi-block-val">{{ $totalStudents }}</div>
                <div class="kpi-block-lbl">Total Students</div>
                <div class="kpi-block-sub">active enrollments</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="kpi-block kb-teal">
            <div class="kpi-block-icon"><i class="fas fa-layer-group"></i></div>
            <div>
                <div class="kpi-block-val">{{ $activeBatches }}</div>
                <div class="kpi-block-lbl">Active Batches</div>
                <div class="kpi-block-sub">running courses</div>
            </div>
        </div>
    </div>
    @if(!$user->isPrincipal() && $user->institute && $user->institute->feature_fees)
    <div class="col-6 col-md-4 col-xl-2">
        <div class="kpi-block kb-violet">
            <div class="kpi-block-icon"><i class="fas fa-wallet"></i></div>
            <div>
                <div class="kpi-block-val" style="font-size:1.3rem;">₹{{ number_format($monthlyRevenue,0) }}</div>
                <div class="kpi-block-lbl">Revenue</div>
                <div class="kpi-block-sub">collected this month</div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-6 col-md-4 col-xl-2">
        <div class="kpi-block kb-sky">
            <div class="kpi-block-icon"><i class="fas fa-chalkboard-user"></i></div>
            <div>
                <div class="kpi-block-val">{{ $totalStaff }}</div>
                <div class="kpi-block-lbl">Staff Members</div>
                <div class="kpi-block-sub">total headcount</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="kpi-block kb-amber">
            <div class="kpi-block-icon"><i class="fas fa-clipboard-list"></i></div>
            <div>
                <div class="kpi-block-val">{{ $activeHomework }}</div>
                <div class="kpi-block-lbl">Homework</div>
                <div class="kpi-block-sub">active assignments</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="kpi-block kb-rose">
            <div class="kpi-block-icon"><i class="fas fa-file-pen"></i></div>
            <div>
                <div class="kpi-block-val">{{ $upcomingTests }}</div>
                <div class="kpi-block-lbl">Tests</div>
                <div class="kpi-block-sub">upcoming scheduled</div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- ══ TODAY + TREND + REVENUE ══ --}}
@if(!$user->isReceptionist())
<div class="row g-3 mb-2">
    {{-- Today's Attendance --}}
    <div class="col-lg-4">
        <div class="glance-card">
            <div style="font-size:0.88rem;font-weight:800;color:#4C1D95;margin-bottom:2px;"><i class="fas fa-chart-pie me-2" style="color:#8B5CF6;"></i>Today's Attendance</div>
            <div style="font-size:0.7rem;color:#7C3AED;margin-bottom:16px;opacity:0.7;">{{ now()->format('l, d M Y') }}</div>
            @if($todayAttendancePct !== null)
            <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
                <div style="position:relative;width:110px;height:110px;flex-shrink:0;">
                    <canvas id="attendanceRing" width="110" height="110"></canvas>
                    <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                        <span style="font-size:1.4rem;font-weight:900;color:#0F172A;letter-spacing:-1px;line-height:1;">{{ $todayAttendancePct }}%</span>
                        <span style="font-size:0.55rem;font-weight:700;color:#94A3B8;text-transform:uppercase;">present</span>
                    </div>
                </div>
                <div style="flex:1;">
                    <div style="font-size:0.65rem;font-weight:700;color:#7C3AED;text-transform:uppercase;letter-spacing:0.6px;margin-bottom:4px;">Rate</div>
                    <div class="att-bar-track">
                        <div class="att-bar-fill" style="width:{{ $todayAttendancePct }}%;background:{{ $todayAttendancePct >= 75 ? 'linear-gradient(90deg,#10B981,#34D399)' : ($todayAttendancePct >= 50 ? 'linear-gradient(90deg,#F59E0B,#FCD34D)' : 'linear-gradient(90deg,#EF4444,#FCA5A5)') }};"></div>
                    </div>
                    <div style="display:flex;gap:16px;margin-top:14px;">
                        <div>
                            <div style="font-size:1.2rem;font-weight:900;color:#10B981;letter-spacing:-0.8px;">{{ $todayPresent }}</div>
                            <div style="font-size:0.6rem;font-weight:700;color:#94A3B8;text-transform:uppercase;">Present</div>
                        </div>
                        <div>
                            <div style="font-size:1.2rem;font-weight:900;color:#EF4444;letter-spacing:-0.8px;">{{ $todayTotal - $todayPresent }}</div>
                            <div style="font-size:0.6rem;font-weight:700;color:#94A3B8;text-transform:uppercase;">Absent</div>
                        </div>
                        <div>
                            <div style="font-size:1.2rem;font-weight:900;color:#6366F1;letter-spacing:-0.8px;">{{ $todayTotal }}</div>
                            <div style="font-size:0.6rem;font-weight:700;color:#94A3B8;text-transform:uppercase;">Total</div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div style="text-align:center;padding:20px 0;">
                <i class="fas fa-calendar-xmark" style="font-size:2.5rem;color:#DDD6FE;display:block;margin-bottom:12px;"></i>
                <div style="font-size:0.85rem;font-weight:600;color:#7C3AED;opacity:0.6;">No attendance marked today</div>
                @if($noAttendanceToday > 0)
                <a href="{{ route('attendance.index') }}" style="display:inline-block;margin-top:14px;background:linear-gradient(135deg,#7C3AED,#6366F1);color:#fff;border-radius:10px;padding:9px 20px;font-size:0.78rem;font-weight:700;text-decoration:none;"><i class="fas fa-plus me-1"></i>Mark Now</a>
                @endif
            </div>
            @endif
        </div>
    </div>

    {{-- Attendance Trend --}}
    <div class="col-lg-4">
        <div class="c-card">
            <div class="c-card-head">
                <div>
                    <div class="c-card-title">Attendance Trend</div>
                    <div class="c-card-sub">7-day presence rate</div>
                </div>
            </div>
            <div class="c-card-body"><canvas id="attendanceTrendChart" height="160"></canvas></div>
        </div>
    </div>

    {{-- Revenue --}}
    @if(!$user->isPrincipal() && $user->institute && $user->institute->feature_fees)
    <div class="col-lg-4">
        <div class="c-card">
            <div class="c-card-head">
                <div>
                    <div class="c-card-title">Revenue Overview</div>
                    <div class="c-card-sub">Last 6 months fee collection</div>
                </div>
            </div>
            <div class="c-card-body">
                <div style="position:relative;height:120px;"><canvas id="revenueChart"></canvas></div>
                <div class="rev-highlight">
                    <div style="flex:1;">
                        <div class="rev-highlight-val">₹{{ number_format($monthlyRevenue,0) }}</div>
                        <div class="rev-highlight-lbl">Collected this month</div>
                    </div>
                    <i class="fas fa-arrow-trend-up" style="font-size:1.5rem;color:rgba(255,255,255,0.15);"></i>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-lg-4">
        <div class="c-card">
            <div class="c-card-head">
                <div>
                    <div class="c-card-title">Students by Batch</div>
                    <div class="c-card-sub">Enrollment distribution</div>
                </div>
            </div>
            <div class="c-card-body" style="display:flex;align-items:center;justify-content:center;min-height:200px;">
                <canvas id="batchChart"></canvas>
            </div>
        </div>
    </div>
    @endif
</div>
@endif

{{-- ══ OPS CONSOLE ══ --}}
@if($user->institute && ($user->institute->feature_hr || $user->institute->feature_visitor))
<div class="db-sec">
    <div class="db-sec-label"><i class="fas fa-shield-halved" style="color:#0D9488;font-size:0.75rem;"></i> Campus Operations</div>
    <div class="db-sec-line"></div>
</div>
<div class="row g-3 mb-2">
    @if($user->institute->feature_visitor)
    <div class="col-6 col-md-3">
        <div class="ops-tile">
            <div class="ops-tile-icon" style="background:#FFF1F2;color:#E11D48;"><i class="fas fa-clock"></i></div>
            <div>
                <div class="ops-tile-val {{ $visitorsPendingCount > 0 ? 'text-danger' : '' }}">{{ $visitorsPendingCount }}</div>
                <div class="ops-tile-lbl">Gate Approvals</div>
                <div class="ops-tile-desc">Awaiting entry</div>
                @can('manage-visitors')
                <a href="{{ route('visitors.index', ['status'=>'pending']) }}" class="ops-tile-cta" style="color:#E11D48;">Review <i class="fas fa-arrow-right" style="font-size:0.55rem;"></i></a>
                @endcan
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="ops-tile">
            <div class="ops-tile-icon" style="background:#F0FDFA;color:#0D9488;"><i class="fas fa-door-open"></i></div>
            <div>
                <div class="ops-tile-val">{{ $visitorsActiveCount }}</div>
                <div class="ops-tile-lbl">On Campus</div>
                <div class="ops-tile-desc">Guests currently inside</div>
                @can('manage-visitors')
                <a href="{{ route('visitors.index', ['status'=>'checked_in']) }}" class="ops-tile-cta" style="color:#0D9488;">View <i class="fas fa-arrow-right" style="font-size:0.55rem;"></i></a>
                @endcan
            </div>
        </div>
    </div>
    @endif
    @if($user->institute->feature_hr)
    <div class="col-6 col-md-3">
        <div class="ops-tile">
            <div class="ops-tile-icon" style="background:#FFFBEB;color:#D97706;"><i class="fas fa-calendar-minus"></i></div>
            <div>
                <div class="ops-tile-val">{{ $pendingStaffLeavesCount }}</div>
                <div class="ops-tile-lbl">Staff Leaves</div>
                <div class="ops-tile-desc">Pending approval</div>
                @can('manage-staff')
                <a href="{{ route('leaves.index') }}" class="ops-tile-cta" style="color:#D97706;">Approve <i class="fas fa-arrow-right" style="font-size:0.55rem;"></i></a>
                @endcan
            </div>
        </div>
    </div>
    @if(!$user->isPrincipal() && !$user->isReceptionist())
    <div class="col-6 col-md-3">
        <div class="ops-tile" style="background:linear-gradient(135deg,#F0FDFA,#EFF6FF);border-color:#CCFBF1;">
            <div class="ops-tile-icon" style="background:#fff;color:#0D9488;box-shadow:0 2px 8px rgba(13,148,136,0.12);"><i class="fas fa-money-bill-transfer"></i></div>
            <div>
                <div class="ops-tile-val" style="font-size:1.3rem;color:#0D9488;">₹{{ number_format($totalPayrollThisMonth,0) }}</div>
                <div class="ops-tile-lbl">Monthly Payroll</div>
                <div class="ops-tile-desc">Disbursed this month</div>
                <a href="{{ route('staff-payrolls.index') }}" class="ops-tile-cta" style="color:#0D9488;">Details <i class="fas fa-arrow-right" style="font-size:0.55rem;"></i></a>
            </div>
        </div>
    </div>
    @endif
    @endif
</div>
@endif

{{-- ══ GATE + PAYMENTS + BATCH ══ --}}
<div class="db-sec">
    <div class="db-sec-label"><i class="fas fa-bolt" style="color:#F59E0B;font-size:0.75rem;"></i> Live Activity</div>
    <div class="db-sec-line"></div>
</div>
<div class="row g-3 mb-4">
    @if($user->institute && $user->institute->feature_visitor)
    <div class="col-lg-6">
        <div class="c-card">
            <div class="c-card-head" style="padding-bottom:12px;">
                <div>
                    <div class="c-card-title"><i class="fas fa-tower-broadcast me-2" style="color:#6366F1;font-size:0.8rem;"></i>Live Gate Ticker</div>
                    <div class="c-card-sub">Recent visitor activity</div>
                </div>
                @can('manage-visitors')
                <a href="{{ route('visitors.index') }}" style="font-size:0.7rem;font-weight:700;color:#6366F1;text-decoration:none;">Full Console <i class="fas fa-arrow-right" style="font-size:0.55rem;"></i></a>
                @endcan
            </div>
            <div style="overflow-x:auto;max-height:240px;overflow-y:auto;">
                <table class="g-table">
                    <thead>
                        <tr>
                            <th>Visitor</th><th>Whom to Meet</th><th>Time</th><th style="text-align:right;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentVisitors as $v)
                        <tr>
                            <td>
                                <div style="font-weight:700;color:#0F172A;font-size:0.8rem;">{{ $v->visitor_name }}</div>
                                <div style="font-size:0.65rem;color:#94A3B8;">{{ $v->purpose }}</div>
                            </td>
                            <td style="color:#475569;font-size:0.8rem;">{{ optional($v->whomToMeet)->name ?? $v->whom_to_meet_name ?? '—' }}</td>
                            <td>
                                @if($v->check_in_time)
                                <div style="font-weight:700;color:#0F172A;font-size:0.78rem;">{{ $v->check_in_time->format('h:i A') }}</div>
                                <div style="font-size:0.62rem;color:#94A3B8;">{{ $v->check_in_time->format('d M') }}</div>
                                @else<span style="color:#94A3B8;font-size:0.78rem;">Pending</span>@endif
                            </td>
                            <td style="text-align:right;">
                                @if($v->status==='pending')
                                <span style="background:#FEF9C3;color:#854D0E;border:1px solid #FDE68A;border-radius:20px;padding:3px 10px;font-size:0.6rem;font-weight:700;">Awaiting</span>
                                @elseif($v->status==='checked_in')
                                <span style="background:#D1FAE5;color:#065F46;border:1px solid #A7F3D0;border-radius:20px;padding:3px 10px;font-size:0.6rem;font-weight:700;">Inside</span>
                                @elseif($v->status==='checked_out')
                                <span style="background:#F1F5F9;color:#64748B;border:1px solid #E2E8F0;border-radius:20px;padding:3px 10px;font-size:0.6rem;font-weight:700;">Out</span>
                                @else
                                <span style="background:#FEE2E2;color:#991B1B;border:1px solid #FECACA;border-radius:20px;padding:3px 10px;font-size:0.6rem;font-weight:700;">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" style="text-align:center;padding:28px;color:#94A3B8;font-size:0.8rem;"><i class="fas fa-inbox" style="font-size:1.5rem;display:block;margin-bottom:8px;opacity:0.4;"></i>No visitor records today.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    @if(!$user->isPrincipal() && $user->institute && $user->institute->feature_fees)
    <div class="col-lg-{{ $user->institute->feature_visitor ? '3' : '6' }}">
        <div class="c-card">
            <div class="c-card-head" style="padding-bottom:12px;">
                <div>
                    <div class="c-card-title"><i class="fas fa-receipt me-2" style="color:#0D9488;font-size:0.8rem;"></i>Recent Payments</div>
                    <div class="c-card-sub">Latest fee transactions</div>
                </div>
                <a href="{{ route('payments.index') }}" style="font-size:0.7rem;font-weight:700;color:#0D9488;text-decoration:none;">All <i class="fas fa-arrow-right" style="font-size:0.55rem;"></i></a>
            </div>
            <div style="max-height:250px;overflow-y:auto;">
                @forelse($recentPayments as $pay)
                <div class="p-row">
                    <div class="p-av">{{ strtoupper(substr($pay->student->name ?? 'N', 0, 2)) }}</div>
                    <div style="flex:1;min-width:0;">
                        <div class="p-name text-truncate">{{ $pay->student->name ?? '—' }}</div>
                        <div class="p-date">{{ $pay->payment_date->format('d M Y') }}</div>
                    </div>
                    <div class="p-amt">₹{{ number_format($pay->amount_paid,0) }}</div>
                </div>
                @empty
                <div style="text-align:center;padding:28px;color:#94A3B8;font-size:0.8rem;"><i class="fas fa-inbox" style="font-size:1.5rem;display:block;margin-bottom:8px;opacity:0.4;"></i>No payments this month.</div>
                @endforelse
            </div>
        </div>
    </div>
    @endif

    @if(!$user->isReceptionist())
    <div class="col-lg-3">
        <div class="c-card">
            <div class="c-card-head">
                <div>
                    <div class="c-card-title"><i class="fas fa-chart-pie me-2" style="color:#6366F1;font-size:0.8rem;"></i>By Batch</div>
                    <div class="c-card-sub">Student distribution</div>
                </div>
            </div>
            <div class="c-card-body" style="display:flex;align-items:center;justify-content:center;min-height:180px;">
                <canvas id="batchChart2"></canvas>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
if (typeof Chart !== 'undefined') {
    Chart.defaults.font.family = "'Outfit', sans-serif";
    Chart.defaults.color = '#64748B';
}

// Attendance Ring
@if($todayAttendancePct !== null)
(function(){
    const el = document.getElementById('attendanceRing');
    if (!el) return;
    const pct = {{ $todayAttendancePct }};
    const color = pct >= 75 ? '#10B981' : pct >= 50 ? '#F59E0B' : '#EF4444';
    new Chart(el.getContext('2d'), {
        type: 'doughnut',
        data: { datasets: [{ data: [pct, 100-pct], backgroundColor: [color,'#EDE9FE'], borderWidth: 0, hoverOffset: 0 }] },
        options: { cutout:'80%', plugins:{ legend:{display:false}, tooltip:{enabled:false} }, animation:{ animateRotate:true, duration:1200, easing:'easeOutQuart' } }
    });
})();
@endif

// Attendance Trend
(function(){
    const el = document.getElementById('attendanceTrendChart');
    if (!el) return;
    const vals = Object.values(@json($attendanceTrend));
    const labels = Object.keys(@json($attendanceTrend));
    const colors = vals.map(v => v>=75?'rgba(16,185,129,0.85)':v>=50?'rgba(245,158,11,0.85)':'rgba(239,68,68,0.85)');
    new Chart(el.getContext('2d'), {
        type: 'bar',
        data: { labels, datasets: [{ label:'%', data:vals, backgroundColor:colors, borderRadius:7, borderSkipped:false, barThickness:18 }] },
        options: {
            responsive:true, maintainAspectRatio:false,
            plugins:{ legend:{display:false}, tooltip:{ backgroundColor:'#0F172A', padding:10, borderRadius:8, displayColors:false, callbacks:{label:c=>c.raw+'% present'} } },
            scales:{ y:{ beginAtZero:true, max:100, grid:{color:'rgba(0,0,0,0.03)'}, ticks:{callback:v=>v+'%',font:{size:10}} }, x:{ grid:{display:false}, ticks:{font:{size:10}} } }
        }
    });
})();

// Revenue
(function(){
    const el = document.getElementById('revenueChart');
    if (!el) return;
    const ctx = el.getContext('2d');
    const rawVals = Object.values(@json($revenueData)).map(Number);
    const allZero = rawVals.every(v => v === 0);
    const grad = ctx.createLinearGradient(0,0,0,180);
    grad.addColorStop(0,'rgba(37,99,235,0.15)');
    grad.addColorStop(1,'rgba(37,99,235,0)');
    new Chart(ctx, {
        type:'line',
        data:{ labels:Object.keys(@json($revenueData)), datasets:[{ data:rawVals, borderColor:'#2563EB', backgroundColor:grad, borderWidth:2.5, pointBackgroundColor:'#fff', pointBorderColor:'#2563EB', pointBorderWidth:2, pointRadius:5, fill:true, tension:0.4 }] },
        options:{
            responsive:true, maintainAspectRatio:false,
            plugins:{ legend:{display:false}, tooltip:{ backgroundColor:'#0F172A', padding:10, borderRadius:8, displayColors:false, callbacks:{label:c=>'₹'+Number(c.raw).toLocaleString('en-IN')} } },
            scales:{
                y:{
                    beginAtZero:true,
                    suggestedMax: allZero ? 10000 : undefined,
                    grid:{color:'rgba(0,0,0,0.04)'},
                    border:{display:false},
                    ticks:{
                        maxTicksLimit:5,
                        font:{size:10},
                        callback: v => {
                            if(v>=100000) return '₹'+Math.round(v/100000)+'L';
                            if(v>=1000)   return '₹'+Math.round(v/1000)+'K';
                            return '₹'+v;
                        }
                    }
                },
                x:{ grid:{display:false}, border:{display:false}, ticks:{font:{size:10}} }
            }
        }
    });
})();

// Batch Donut
['batchChart','batchChart2'].forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    new Chart(el.getContext('2d'), {
        type:'doughnut',
        data:{ labels:Object.keys(@json($studentsPerBatch)), datasets:[{ data:Object.values(@json($studentsPerBatch)), backgroundColor:['#6366F1','#0D9488','#F59E0B','#E11D48','#0EA5E9','#10B981','#8B5CF6','#EC4899'], borderWidth:0, hoverOffset:8 }] },
        options:{ responsive:true, maintainAspectRatio:false, cutout:'68%', plugins:{ legend:{ position:'bottom', labels:{ usePointStyle:true, padding:10, font:{size:9} } }, tooltip:{ backgroundColor:'#0F172A', padding:8, borderRadius:8 } } }
    });
});
</script>
@endpush
