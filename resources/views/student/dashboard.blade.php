@extends('student.layouts.app')

@section('title', 'Student Dashboard')

@push('styles')
<style>
/* ── Base ── */
body { background: #F1F5F9 !important; }
.dashboard-wrap { padding: 0; max-width: 1100px; margin: 0 auto; }

/* ── Hero ── */
.dash-hero {
    background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 50%, #0D4D6B 100%);
    border-radius: 24px;
    padding: 32px 36px;
    margin-bottom: 20px;
    position: relative;
    overflow: hidden;
    color: #fff;
}
.dash-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='400' height='200' viewBox='0 0 400 200' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='350' cy='40' r='120' fill='rgba(255,255,255,0.03)'/%3E%3Ccircle cx='380' cy='160' r='80' fill='rgba(255,255,255,0.03)'/%3E%3Ccircle cx='50' cy='180' r='100' fill='rgba(255,255,255,0.02)'/%3E%3C/svg%3E") right center / auto 100% no-repeat;
    pointer-events: none;
}
.hero-inner { position: relative; z-index: 1; display: flex; align-items: center; gap: 24px; flex-wrap: wrap; }
.hero-avatar {
    width: 72px; height: 72px; border-radius: 22px; flex-shrink: 0;
    background: linear-gradient(135deg, #6366F1, #0D9488);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.7rem; font-weight: 900; color: #fff;
    box-shadow: 0 8px 24px rgba(99,102,241,0.4);
    border: 3px solid rgba(255,255,255,0.15);
    letter-spacing: -1px;
}
.hero-info { flex: 1; min-width: 0; }
.hero-greeting { font-size: 0.78rem; font-weight: 700; color: rgba(255,255,255,0.55); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 4px; }
.hero-name { font-size: 1.6rem; font-weight: 900; color: #fff; letter-spacing: -0.5px; margin: 0 0 6px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.hero-meta { font-size: 0.8rem; color: rgba(255,255,255,0.5); display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
.hero-meta span { display: flex; align-items: center; gap: 5px; }
.hero-stats { display: flex; gap: 12px; flex-wrap: wrap; }
.hero-stat {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 14px; padding: 12px 20px;
    text-align: center; min-width: 90px;
    backdrop-filter: blur(10px);
}
.hero-stat-val { font-size: 1.6rem; font-weight: 900; color: #fff; letter-spacing: -1px; line-height: 1; }
.hero-stat-lbl { font-size: 0.65rem; font-weight: 700; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 0.8px; margin-top: 3px; }
.hero-stat.good .hero-stat-val { color: #34D399; }
.hero-stat.warn .hero-stat-val { color: #FBBF24; }
.hero-stat.bad  .hero-stat-val { color: #F87171; }

/* ── Two-col layout ── */
.dash-grid { display: grid; grid-template-columns: 1fr 340px; gap: 20px; align-items: start; }
@media(max-width: 900px) { .dash-grid { grid-template-columns: 1fr; } }

/* ── Card base ── */
.dcard {
    background: #fff; border: 1px solid #E2E8F0;
    border-radius: 20px; overflow: hidden;
    box-shadow: 0 1px 8px rgba(0,0,0,0.04);
}
.dcard-head {
    padding: 18px 22px 0;
    display: flex; align-items: center; justify-content: space-between;
}
.dcard-title {
    font-size: 0.88rem; font-weight: 800; color: #0F172A;
    display: flex; align-items: center; gap: 8px;
}
.dcard-title i { font-size: 3rem; }
.dcard-link { font-size: 1.2rem; font-weight: 700; color: #29e50c; text-decoration: none; }
.dcard-body { padding: 18px 22px 22px; }

/* ── Attendance Ring ── */
.att-ring-wrap { position: relative; width: 130px; height: 130px; flex-shrink: 0; }
.att-ring-wrap svg { transform: rotate(-90deg); }
.att-ring-center {
    position: absolute; inset: 0;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
}
.att-ring-center .rv { font-size: 1.7rem; font-weight: 900; color: #0F172A; line-height: 1; letter-spacing: -1px; }
.att-ring-center .rl { font-size: 0.6rem; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 2px; }
.att-story-layout { display: flex; align-items: center; gap: 24px; }
.att-narrative { flex: 1; }
.att-headline { font-size: 0.95rem; font-weight: 800; color: #0F172A; margin-bottom: 4px; }
.att-subtext { font-size: 0.78rem; color: #64748B; line-height: 1.55; margin-bottom: 16px; }
.att-pills { display: flex; gap: 8px; flex-wrap: wrap; }
.att-pill {
    display: flex; align-items: center; gap: 6px;
    background: #F8FAFC; border: 1px solid #E8EDF5;
    border-radius: 10px; padding: 6px 12px;
}
.att-pill .dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
.att-pill .pv { font-size: 0.9rem; font-weight: 800; color: #0F172A; }
.att-pill .pl { font-size: 0.6rem; font-weight: 600; color: #94A3B8; text-transform: uppercase; }

/* ── Progress bar ── */
.prog-bar-wrap { margin-top: 16px; }
.prog-bar-track { height: 8px; background: #F1F5F9; border-radius: 99px; overflow: hidden; }
.prog-bar-fill { height: 100%; border-radius: 99px; transition: width 1s cubic-bezier(0.34,1.56,0.64,1); }

/* ── Monthly bars ── */
.month-bars { display: flex; align-items: flex-end; gap: 6px; height: 100px; padding: 0 2px; }
.m-bar-group { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 3px; min-width: 0; }
.m-bar-track { width: 100%; background: #F1F5F9; border-radius: 6px; flex: 1; display: flex; flex-direction: column-reverse; overflow: hidden; }
.m-bar-fill { border-radius: 5px; transition: height 0.8s cubic-bezier(0.34,1.56,0.64,1); }
.m-bar-pct { font-size: 0.6rem; font-weight: 800; }
.m-bar-lbl { font-size: 0.62rem; font-weight: 700; color: #94A3B8; }

/* ── Quick Access ── */
.quick-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
@media(max-width:480px) { .quick-grid { grid-template-columns: repeat(3, 1fr); } }
.qbtn {
    display: flex; flex-direction: column; align-items: center; gap: 8px;
    padding: 16px 8px 12px;
    background: #fff; border: 1px solid #E8EDF5; border-radius: 16px;
    text-decoration: none; color: #0F172A; text-align: center;
    transition: all 0.2s; box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.qbtn:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); border-color: transparent; color: #0F172A; }
.qbtn-icon { width: 44px; height: 44px; border-radius: 13px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
.qbtn-lbl { font-size: 0.68rem; font-weight: 700; line-height: 1.2; color: #475569; }

/* ── Sidebar widgets ── */
.stat-widget {
    background: #fff; border: 1px solid #E2E8F0;
    border-radius: 20px; padding: 20px;
    box-shadow: 0 1px 8px rgba(0,0,0,0.04);
    margin-bottom: 16px;
}
.sw-label { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #94A3B8; margin-bottom: 14px; display: flex; align-items: center; gap: 6px; }

/* ── Fee card ── */
.fee-card {
    border-radius: 20px; padding: 22px;
    background: linear-gradient(135deg, #0D9488, #0891B2);
    color: #fff; position: relative; overflow: hidden;
    margin-bottom: 16px;
}
.fee-card::before { content: ''; position: absolute; top: -30px; right: -20px; width: 130px; height: 130px; background: rgba(255,255,255,0.07); border-radius: 50%; }
.fee-card::after  { content: ''; position: absolute; bottom: -40px; left: 40px; width: 90px; height: 90px; background: rgba(255,255,255,0.05); border-radius: 50%; }

/* ── Motivational ── */
.moti-card {
    border-radius: 20px; padding: 20px 22px;
    background: #F5F3FF; border: 1px solid #DDD6FE;
    display: flex; align-items: flex-start; gap: 16px;
    margin-bottom: 16px;
}
.moti-icon-wrap {
    width: 48px; height: 48px; border-radius: 14px;
    background: linear-gradient(135deg, #7C3AED, #6366F1);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; color: #fff; flex-shrink: 0;
}
.moti-title { font-size: 0.88rem; font-weight: 800; color: #4C1D95; margin-bottom: 4px; }
.moti-text  { font-size: 0.78rem; color: #6D28D9; line-height: 1.55; margin: 0; }

/* ── Leave ── */
.leave-row {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 0; border-bottom: 1px solid #F1F5F9;
}
.leave-row:last-child { border-bottom: none; }
.lv-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0; }
.lv-type { font-size: 0.82rem; font-weight: 700; color: #0F172A; }
.lv-date { font-size: 0.7rem; color: #94A3B8; }
.lbadge { display: inline-block; padding: 3px 10px; border-radius: 50px; font-size: 0.62rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
.lbadge.pending  { background: #FEF9C3; color: #854D0E; border: 1px solid #FDE68A; }
.lbadge.approved { background: #D1FAE5; color: #065F46; border: 1px solid #A7F3D0; }
.lbadge.rejected { background: #FEE2E2; color: #991B1B; border: 1px solid #FECACA; }

/* ── Section label ── */
.sec-lbl { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #94A3B8; margin: 0 0 12px; }

/* ── Responsive ── */
@media(max-width:640px) {
    .dash-hero { padding: 20px; }
    .hero-name { font-size: 1.25rem; }
    .hero-stats { gap: 8px; }
    .hero-stat { padding: 10px 14px; min-width: 72px; }
    .hero-stat-val { font-size: 1.2rem; }
    .att-story-layout { flex-direction: column; align-items: flex-start; }
}
</style>
@endpush

@section('content')
@php
    $student   = auth()->guard('student')->user();
    $hour      = (int) now()->format('H');
    $pct       = $attendancePercentage;
    $circ      = 2 * pi() * 52;
    $offset    = $circ - ($pct / 100) * $circ;
    $absPct    = $totalClasses > 0 ? ($absentClasses / $totalClasses * 100) : 0;
    $absOffset = $circ - ($absPct / 100) * $circ;

    $ringColor  = $pct >= 90 ? '#10B981' : ($pct >= 75 ? '#6366F1' : ($pct >= 50 ? '#F59E0B' : '#EF4444'));
    $statClass  = $pct >= 75 ? 'good' : ($pct >= 50 ? 'warn' : 'bad');
    $tip        = $pct >= 90
        ? "Top-tier consistency! You're in the elite 90%+ club — keep it up."
        : ($pct >= 75
            ? "Just " . max(0, ceil($totalClasses * 0.9) - ($presentClasses + $lateClasses)) . " more classes to break the 90% barrier!"
            : "Every class counts. Start fresh today — your future self will thank you.");
    $totalAttended = $presentClasses + $lateClasses;
@endphp

<div class="dashboard-wrap">

    {{-- ── Hero ── --}}
    <div class="dash-hero" style="margin-bottom:20px;">
        <div class="hero-inner">
            <div class="hero-avatar">{{ strtoupper(substr($student->name, 0, 2)) }}</div>
            <div class="hero-info">
                <h1 class="hero-name">{{ $student->name }}</h1>
                <div class="hero-meta">
                    <span><i class="fas fa-building"></i> {{ $student->institute->name ?? 'Student Portal' }}</span>
                    <span><i class="fas fa-calendar"></i> {{ now()->format('d M Y') }}</span>
                    @if($student->batch)
                    <span><i class="fas fa-layer-group"></i> {{ $student->batch->name }}</span>
                    @endif
                </div>
            </div>
            <div class="hero-stats">
                <div class="hero-stat {{ $statClass }}">
                    <div class="hero-stat-val">{{ $pct }}%</div>
                    <div class="hero-stat-lbl">Attendance</div>
                </div>
                <div class="hero-stat good">
                    <div class="hero-stat-val">{{ $presentClasses }}</div>
                    <div class="hero-stat-lbl">Present</div>
                </div>
                <div class="hero-stat bad">
                    <div class="hero-stat-val">{{ $absentClasses }}</div>
                    <div class="hero-stat-lbl">Absent</div>
                </div>
                @if($lateClasses > 0)
                <div class="hero-stat warn">
                    <div class="hero-stat-val">{{ $lateClasses }}</div>
                    <div class="hero-stat-lbl">Late</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Attendance progress bar --}}
        <div style="position:relative;z-index:1;margin-top:20px;">
                                <a href="{{ route('student.attendance.index') }}" class="dcard-link">All Records <i class="fas fa-arrow-right" style="font-size:0.65rem;"></i></a>

            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                
                <span style="font-size:0.72rem;font-weight:700;color:rgba(255,255,255,0.5);">Overall Attendance Progress</span>
                <span style="font-size:0.72rem;font-weight:800;color:{{ $pct >= 75 ? '#34D399' : '#FBBF24' }};">
                    @if($pct >= 90) Outstanding @elseif($pct >= 75) On Track @elseif($pct >= 50) Needs Effort @else Critical @endif
                </span>
                
            </div>
            <div style="height:6px;background:rgba(255,255,255,0.1);border-radius:99px;overflow:hidden;">
                <div style="height:100%;width:{{ $pct }}%;background:{{ $pct >= 75 ? 'linear-gradient(90deg,#10B981,#34D399)' : ($pct >= 50 ? 'linear-gradient(90deg,#F59E0B,#FBBF24)' : 'linear-gradient(90deg,#EF4444,#F87171)') }};border-radius:99px;transition:width 1s;"></div>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:4px;">
                <span style="font-size:0.65rem;color:rgba(255,255,255,0.35);">0%</span>
                <span style="font-size:0.65rem;color:rgba(255,255,255,0.35);">75% target</span>
                <span style="font-size:0.65rem;color:rgba(255,255,255,0.35);">100%</span>
            </div>
        </div>
    </div>

    <!-- ── fees ── -->
     <div class="fees" style="margin-bottom:20px;">
        <div class="dcard">
            <div class="dcard-head" style="margin-bottom:4px;">
                <div class="dcard-title"><i class="fas fa-wallet" style="color:#10B981;"></i> Fee Summary</div>
            </div>
                <a href="{{ route('student.fees.index') }}" class="dcard-link" style="margin-left:16px;">Fees Records <i class="fas fa-arrow-right" style="font-size:0.65rem;"></i></a>
            <div class="dcard-body">
                @if($student->institute && $student->institute->feature_fees)
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                        <span style="font-size:0.75rem;font-weight:700;color:#475569;">Total Fees</span>
                        <span style="font-size:0.75rem;font-weight:800;color:#0F172A;">₹{{ number_format($totalFees, 2) }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                        <span style="font-size:0.75rem;font-weight:700;color:#475569;">Paid</span>
                        <span style="font-size:0.75rem;font-weight:800;color:#0F172A;">₹{{ number_format($paidFees, 2) }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-size:0.75rem;font-weight:700;color:#475569;">Due</span>
                        <span style="font-size:0.75rem;font-weight:800;color:#EF4444;">₹{{ number_format($balanceFees, 2) }}</span>
                    </div>
                @else
                    <p style="font-size:0.78rem;color:#64748B;">Fee management is not enabled for your institute.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="dash-grid">

        {{-- ── LEFT COLUMN ── --}}
        <div>

            {{-- Quick Access --}}
            <div class="dcard" style="margin-bottom:16px;">
                <div class="dcard-head" style="margin-bottom:4px;">
                    <div class="dcard-title"><i class="fas fa-grid-2" style="color:#6366F1;"></i> Quick Access</div>
                </div>
                <div class="dcard-body">
                    <div class="quick-grid">
                        @php
                        $qlinks = [];
                        if(!$student->institute || $student->institute->feature_attendance)
                            $qlinks[] = ['fa-calendar-check','#EEF2FF','#6366F1','Attendance',route('student.attendance.index')];
                        if(!$student->institute || $student->institute->feature_hr)
                            $qlinks[] = ['fa-umbrella-beach','#FFFBEB','#D97706','Leaves',route('student.leaves.index')];
                        if(!$student->institute || $student->institute->feature_exams) {
                            $qlinks[] = ['fa-file-pen','#F5F3FF','#7C3AED','Tests',route('student.tests.index')];
                            $qlinks[] = ['fa-laptop-code','#F0F9FF','#0284C7','Online Exams',route('student.online-exams.index')];
                        }
                        if(!$student->institute || $student->institute->feature_lms) {
                            $qlinks[] = ['fa-book-open','#F0FDFA','#0D9488','Materials',route('student.study-materials.index')];
                            $qlinks[] = ['fa-clipboard-list','#ECFDF5','#059669','Assignments',route('student.homework.index')];
                        }
                        if($student->institute && $student->institute->feature_live_classes)
                            $qlinks[] = ['fa-video','#FFF1F2','#E11D48','Lectures',route('student.lectures.index')];
                        if(!$student->institute || $student->institute->feature_academics)
                            $qlinks[] = ['fa-table-cells','#ECFEFF','#0891B2','Timetable',route('student.timetable.index')];
                        if($student->institute && $student->institute->feature_library)
                            $qlinks[] = ['fa-book-reader','#FFF7ED','#EA580C','Library',route('student.library.index')];
                        if($student->institute && $student->institute->feature_fees)
                            $qlinks[] = ['fa-wallet','#F0FDFA','#0D9488','Fees',route('student.fees.index')];
                        if($student->institute && $student->institute->feature_transport)
                            $qlinks[] = ['fa-bus','#F0FDFA','#0D9488','Transport',route('student.transport.index')];
                        if($student->institute && $student->institute->feature_hostel) {
                            $qlinks[] = ['fa-bed','#F5F3FF','#7C3AED','My Room',route('student.hostel.my-room')];
                            $qlinks[] = ['fa-utensils','#FFF7ED','#EA580C','Mess Menu',route('student.hostel.mess-menu')];
                        }
                        if(!$student->institute || $student->institute->feature_curriculum) {
                            if($student->batch_id)
                                $qlinks[] = ['fa-comments','#ECFDF5','#059669','Class Chat',route('student.class-chat.index')];
                            $qlinks[] = ['fa-images','#FDF2F8','#DB2777','Gallery',route('student.gallery.index')];
                        }
                        $qlinks[] = ['fa-circle-user','#EEF2FF','#6366F1','Profile',route('student.profile.edit')];
                        @endphp

                        @foreach($qlinks as $q)
                        <a href="{{ $q[4] }}" class="qbtn">
                            <div class="qbtn-icon" style="background:{{ $q[1] }};color:{{ $q[2] }};"><i class="fas {{ $q[0] }}"></i></div>
                            <div class="qbtn-lbl">{{ $q[3] }}</div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>{{-- /left --}}

        {{-- ── RIGHT SIDEBAR ── --}}
        <div>

            {{-- Motivational --}}
            <div class="moti-card">
                <div class="moti-icon-wrap"><i class="fas {{ $pct >= 90 ? 'fa-rocket' : ($pct >= 75 ? 'fa-lightbulb' : 'fa-seedling') }}"></i></div>
                <div>
                    <div class="moti-title">Your Academic Journey</div>
                    <p class="moti-text">{{ $tip }}</p>
                </div>
            </div>

            {{-- Fee Summary --}}
            @if($student->institute && $student->institute->feature_fees)
            <div class="fee-card">
                <div style="position:relative;z-index:1;">
                    <div style="font-size:0.68rem;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.6);margin-bottom:6px;"><i class="fas fa-wallet"></i> Fee Summary</div>
                    @if($recentPayments && $recentPayments->count() > 0)
                    <div style="font-size:1.8rem;font-weight:900;letter-spacing:-1px;color:#fff;line-height:1;">{{ currencySymbol() }}{{ number_format($recentPayments->first()->amount_paid) }}</div>
                    <div style="font-size:0.75rem;color:rgba(255,255,255,0.6);margin-top:4px;margin-bottom:16px;">Last payment · {{ $recentPayments->first()->created_at->format('d M Y') }}</div>
                    @else
                    <div style="font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:16px;">No payments yet</div>
                    @endif
                    <a href="{{ route('student.fees.index') }}" style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.25);color:#fff;text-decoration:none;padding:8px 16px;border-radius:10px;font-size:0.78rem;font-weight:700;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        View Fees <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endif

            {{-- Leave Management --}}
            @if(!$student->institute || $student->institute->feature_hr)
            <div class="stat-widget">
                <div class="sw-label">
                    <i class="fas fa-calendar-xmark" style="color:#D97706;"></i> Leave Requests
                    @php $pendingCnt = $recentLeaves->where('status','pending')->count(); @endphp
                    @if($pendingCnt > 0)
                    <span style="margin-left:auto;background:#FEF9C3;color:#854D0E;border:1px solid #FDE68A;border-radius:20px;padding:2px 8px;font-size:0.6rem;font-weight:800;">{{ $pendingCnt }} pending</span>
                    @endif
                </div>

                @forelse($recentLeaves->take(3) as $leave)
                <div class="leave-row">
                    <div class="lv-icon" style="background:#FFFBEB;color:#D97706;"><i class="fas fa-calendar-minus"></i></div>
                    <div style="flex:1;min-width:0;">
                        <div class="lv-type">{{ $leave->type }}</div>
                        <div class="lv-date">{{ $leave->start_date->format('d M') }} – {{ $leave->end_date->format('d M') }} · {{ $leave->start_date->diffInDays($leave->end_date)+1 }}d</div>
                    </div>
                    <span class="lbadge {{ $leave->status }}">{{ $leave->status }}</span>
                </div>
                @empty
                <div style="text-align:center;padding:16px 0;color:#CBD5E1;">
                    <i class="fas fa-calendar" style="font-size:1.5rem;display:block;margin-bottom:8px;opacity:0.4;"></i>
                    <div style="font-size:0.8rem;color:#94A3B8;font-weight:600;">No leave records</div>
                </div>
                @endforelse

                <div style="margin-top:14px;display:flex;gap:8px;">
                    <a href="{{ route('student.leaves.create') }}" style="flex:1;text-align:center;background:linear-gradient(135deg,#6366F1,#4F46E5);color:#fff;border-radius:10px;padding:9px;font-size:0.78rem;font-weight:700;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;box-shadow:0 4px 12px rgba(99,102,241,0.3);">
                        <i class="fas fa-plus"></i> Apply Leave
                    </a>
                    <a href="{{ route('student.leaves.index') }}" style="background:#F8FAFC;border:1px solid #E2E8F0;color:#6366F1;border-radius:10px;padding:9px 14px;font-size:0.78rem;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:5px;">
                        All <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endif

            {{-- Recent Notifications --}}
            <div class="stat-widget">
                <div class="sw-label"><i class="fas fa-bell" style="color:#6366F1;"></i> Notifications</div>
                @if($student->unreadNotifications && $student->unreadNotifications->count() > 0)
                @foreach($student->unreadNotifications->take(3) as $notif)
                <div style="display:flex;align-items:flex-start;gap:10px;padding:8px 0;border-bottom:1px solid #F1F5F9;">
                    <div style="width:8px;height:8px;border-radius:50%;background:#6366F1;margin-top:5px;flex-shrink:0;"></div>
                    <div style="font-size:0.78rem;color:#0F172A;line-height:1.4;">{{ Str::limit($notif->data['message'] ?? 'New notification', 60) }}</div>
                </div>
                @endforeach
                @else
                <div style="text-align:center;padding:12px 0;color:#CBD5E1;">
                    <i class="fas fa-bell-slash" style="font-size:1.4rem;display:block;margin-bottom:8px;opacity:0.4;"></i>
                    <div style="font-size:0.78rem;color:#94A3B8;">No new notifications</div>
                </div>
                @endif
                <a href="{{ route('student.notifications.index') }}" style="display:block;text-align:center;margin-top:12px;font-size:0.75rem;font-weight:700;color:#6366F1;text-decoration:none;">View All Notifications</a>
            </div>

        </div>{{-- /sidebar --}}
    </div>{{-- /dash-grid --}}

</div>
@endsection

@push('scripts')
<script>
// Animate bars on load
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.prog-bar-fill, .m-bar-fill').forEach(el => {
        const w = el.style.width || el.style.height;
        el.style.transition = 'all 1s cubic-bezier(0.34,1.56,0.64,1)';
    });
});
</script>
@endpush
