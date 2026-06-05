@extends('layouts.admin')
@section('title', 'Results — ' . $onlineExam->title)
@section('content')
<style>
.oe-rhdr{background:linear-gradient(135deg,#0F172A,#1E1B4B,#1e3a5f);border-radius:20px;padding:30px 36px;margin-bottom:28px;position:relative;overflow:hidden;border:1px solid rgba(99,102,241,.2);}
.oe-rhdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.06) 1px,transparent 1px);background-size:28px 28px;border-radius:20px;}
.oe-rhdr::after{content:'';position:absolute;top:-60px;right:-60px;width:220px;height:220px;border-radius:50%;background:radial-gradient(circle,rgba(79,70,229,.2) 0%,transparent 65%);}
.oe-rhdr-inner{position:relative;z-index:2;}
.oe-kpi{background:#fff;border:1px solid #F1F5F9;border-radius:16px;padding:20px 22px;box-shadow:0 4px 16px rgba(0,0,0,.04);transition:all .2s;}
.oe-kpi:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.08);}
.oe-kpi-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:12px;}
.oe-kpi-val{font-size:1.8rem;font-weight:800;letter-spacing:-1px;line-height:1;margin-bottom:4px;}
.oe-kpi-lbl{font-size:.68rem;font-weight:600;color:#64748B;text-transform:uppercase;letter-spacing:.5px;}
.oe-card{background:#fff;border:1px solid #F1F5F9;border-radius:18px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.04);}
.oe-card-hdr{padding:16px 24px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;display:flex;align-items:center;justify-content:space-between;}
.oe-card-title{font-size:.88rem;font-weight:700;color:#1E293B;display:flex;align-items:center;gap:10px;}
.rank-badge{width:26px;height:26px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;flex-shrink:0;}
.proctor-dot{width:8px;height:8px;border-radius:50%;background:#DC2626;margin:0 2px;display:inline-block;}
</style>

<div class="oe-rhdr">
    <div class="oe-rhdr-inner d-flex align-items-start gap-3 flex-wrap">
        <a href="{{ route('online-exams.index') }}" style="width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,.08);border:1.5px solid rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;flex-shrink:0;"><i class="fas fa-arrow-left"></i></a>
        <div style="flex:1;">
            <div style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;"><i class="fas fa-chart-bar me-1"></i> Result Analytics</div>
            <h2 style="font-size:1.45rem;font-weight:800;color:#fff;margin:0 0 8px;letter-spacing:-.5px;">{{ $onlineExam->title }}</h2>
            <div style="display:flex;flex-wrap:wrap;gap:8px;">
                <span style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:4px 12px;font-size:.72rem;font-weight:600;color:rgba(255,255,255,.7);"><i class="fas fa-layer-group me-1" style="color:#67E8F9;"></i>{{ $onlineExam->batch->name }}</span>
                <span style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:4px 12px;font-size:.72rem;font-weight:600;color:rgba(255,255,255,.7);"><i class="fas fa-clock me-1" style="color:#67E8F9;"></i>{{ $onlineExam->duration_minutes }} min</span>
                <span style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:4px 12px;font-size:.72rem;font-weight:600;color:rgba(255,255,255,.7);"><i class="fas fa-bullseye me-1" style="color:#67E8F9;"></i>{{ $onlineExam->total_marks }} marks</span>
            </div>
        </div>
    </div>
</div>

{{-- KPIs --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="oe-kpi">
            <div class="oe-kpi-icon" style="background:#EEF2FF;color:#4F46E5;"><i class="fas fa-users"></i></div>
            <div class="oe-kpi-val" style="color:#4F46E5;">{{ $totalStudents }}</div>
            <div class="oe-kpi-lbl">Total Students</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="oe-kpi">
            <div class="oe-kpi-icon" style="background:#ECFEFF;color:#06B6D4;"><i class="fas fa-user-check"></i></div>
            <div class="oe-kpi-val" style="color:#06B6D4;">{{ $attempted }}</div>
            <div class="oe-kpi-lbl">Attempted</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="oe-kpi">
            <div class="oe-kpi-icon" style="background:#F0FDF4;color:#059669;"><i class="fas fa-check-double"></i></div>
            <div class="oe-kpi-val" style="color:#059669;">{{ $passed }}</div>
            <div class="oe-kpi-lbl">Passed</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="oe-kpi">
            <div class="oe-kpi-icon" style="background:#FFFBEB;color:#D97706;"><i class="fas fa-chart-line"></i></div>
            <div class="oe-kpi-val" style="color:#D97706;">{{ $avgPct }}%</div>
            <div class="oe-kpi-lbl">Avg Score</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Score Distribution Chart --}}
    <div class="col-lg-8">
        <div class="oe-card">
            <div class="oe-card-hdr">
                <div class="oe-card-title">
                    <div style="width:30px;height:30px;border-radius:8px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:.72rem;"><i class="fas fa-chart-bar"></i></div>
                    Score Distribution
                </div>
            </div>
            <div style="padding:24px;">
                <canvas id="distChart" height="120"></canvas>
            </div>
        </div>
    </div>

    {{-- Pass/Fail Donut --}}
    <div class="col-lg-4">
        <div class="oe-card h-100">
            <div class="oe-card-hdr">
                <div class="oe-card-title">
                    <div style="width:30px;height:30px;border-radius:8px;background:#F0FDF4;color:#059669;display:flex;align-items:center;justify-content:center;font-size:.72rem;"><i class="fas fa-chart-pie"></i></div>
                    Pass / Fail
                </div>
            </div>
            <div style="padding:24px;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:16px;">
                <canvas id="pfChart" style="max-width:180px;max-height:180px;"></canvas>
                <div style="display:flex;gap:16px;font-size:.78rem;">
                    <div style="display:flex;align-items:center;gap:6px;"><span style="width:12px;height:12px;border-radius:4px;background:#059669;display:inline-block;"></span> Pass: <strong>{{ $passed }}</strong></div>
                    <div style="display:flex;align-items:center;gap:6px;"><span style="width:12px;height:12px;border-radius:4px;background:#DC2626;display:inline-block;"></span> Fail: <strong>{{ $attempted - $passed }}</strong></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Student Rankings --}}
    <div class="col-lg-7">
        <div class="oe-card">
            <div class="oe-card-hdr">
                <div class="oe-card-title">
                    <div style="width:30px;height:30px;border-radius:8px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:.72rem;"><i class="fas fa-trophy"></i></div>
                    Student Rankings
                </div>
            </div>
            @forelse($sessions as $i => $session)
            @php
                $pct = $session->percentage ?? 0;
                $rank = $i + 1;
                $rankColors = ['#D97706','#64748B','#92400E'];
                $rankBg = ['#FFFBEB','#F8FAFC','#FFF7ED'];
            @endphp
            <div style="display:flex;align-items:center;gap:14px;padding:14px 24px;border-bottom:1px solid #F8FAFC;transition:background .15s;" onmouseover="this.style.background='#FAFBFF'" onmouseout="this.style.background=''">
                <div class="rank-badge" style="background:{{ $rank<=3 ? $rankBg[$rank-1] : '#F8FAFC' }};color:{{ $rank<=3 ? $rankColors[$rank-1] : '#94A3B8' }};">
                    @if($rank===1)🥇@elseif($rank===2)🥈@elseif($rank===3)🥉@else{{ $rank }}@endif
                </div>
                <div style="width:38px;height:38px;border-radius:10px;background:#EEF2FF;display:flex;align-items:center;justify-content:center;font-size:.85rem;font-weight:800;color:#4F46E5;flex-shrink:0;">{{ strtoupper(substr($session->student->name??'?',0,1)) }}</div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:.85rem;font-weight:700;color:#1E293B;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $session->student->name ?? 'Unknown' }}</div>
                    <div style="height:5px;background:#F1F5F9;border-radius:9999px;margin-top:6px;overflow:hidden;">
                        <div style="height:100%;width:{{ $pct }}%;background:{{ $pct>=($onlineExam->pass_percentage) ? '#059669' : '#DC2626' }};border-radius:9999px;transition:width .6s;"></div>
                    </div>
                </div>
                <div style="text-align:right;flex-shrink:0;">
                    <div style="font-size:1rem;font-weight:800;color:{{ $pct>=($onlineExam->pass_percentage)?'#059669':'#DC2626' }};">{{ $pct }}%</div>
                    <div style="font-size:.68rem;color:#94A3B8;">{{ $session->score }}/{{ $onlineExam->total_marks }}</div>
                </div>
                <div>
                    <span style="font-size:.65rem;font-weight:700;padding:3px 8px;border-radius:6px;{{ $session->is_passed?'background:#F0FDF4;color:#059669;':'background:#FEF2F2;color:#DC2626;' }}">
                        {{ $session->is_passed ? 'Pass' : 'Fail' }}
                    </span>
                </div>
                {{-- Proctoring indicator --}}
                @if($session->tab_switch_count > 0)
                <div title="{{ $session->tab_switch_count }} tab switch(es) detected" style="cursor:help;">
                    <span style="background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;font-size:.62rem;font-weight:700;padding:3px 7px;border-radius:6px;white-space:nowrap;"><i class="fas fa-exclamation-triangle me-1"></i>{{ $session->tab_switch_count }}x</span>
                </div>
                @endif
            </div>
            @empty
            <div style="text-align:center;padding:48px;font-size:.85rem;color:#94A3B8;">No submissions yet.</div>
            @endforelse
        </div>
    </div>

    {{-- Question Accuracy --}}
    <div class="col-lg-5">
        <div class="oe-card">
            <div class="oe-card-hdr">
                <div class="oe-card-title">
                    <div style="width:30px;height:30px;border-radius:8px;background:#ECFEFF;color:#06B6D4;display:flex;align-items:center;justify-content:center;font-size:.72rem;"><i class="fas fa-tasks"></i></div>
                    Question Accuracy
                </div>
            </div>
            <div style="padding:8px 0;max-height:460px;overflow-y:auto;">
                @forelse($questionStats as $i => $qs)
                <div style="padding:12px 20px;border-bottom:1px solid #F8FAFC;">
                    <div style="font-size:.78rem;font-weight:600;color:#1E293B;margin-bottom:6px;line-height:1.4;">Q{{ $i+1 }}. {{ Str::limit($qs['question'], 70) }}</div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="flex:1;height:6px;background:#F1F5F9;border-radius:9999px;overflow:hidden;">
                            <div style="height:100%;width:{{ $qs['accuracy'] }}%;background:{{ $qs['accuracy']>=60?'#059669':($qs['accuracy']>=30?'#D97706':'#DC2626') }};border-radius:9999px;"></div>
                        </div>
                        <span style="font-size:.72rem;font-weight:700;color:{{ $qs['accuracy']>=60?'#059669':($qs['accuracy']>=30?'#D97706':'#DC2626') }};min-width:32px;text-align:right;">{{ $qs['accuracy'] }}%</span>
                    </div>
                    <div style="font-size:.65rem;color:#94A3B8;margin-top:3px;">{{ $qs['correct'] }}/{{ $qs['total'] }} correct</div>
                </div>
                @empty
                <div style="text-align:center;padding:40px;font-size:.83rem;color:#94A3B8;">No answer data yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const distData = @json($distribution);
const labels = ['0–9%','10–19%','20–29%','30–39%','40–49%','50–59%','60–69%','70–79%','80–89%','90–100%'];
new Chart(document.getElementById('distChart'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Students',
            data: distData,
            backgroundColor: distData.map((v, i) => i < 4 ? 'rgba(220,38,38,.25)' : 'rgba(79,70,229,.35)'),
            borderColor:     distData.map((v, i) => i < 4 ? '#DC2626' : '#4F46E5'),
            borderWidth: 2, borderRadius: 8,
        }]
    },
    options: {
        responsive: true, plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } }, x: { grid: { display: false } } }
    }
});
new Chart(document.getElementById('pfChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pass','Fail'],
        datasets: [{ data: [{{ $passed }},{{ $attempted - $passed }}], backgroundColor: ['#059669','#DC2626'], borderWidth: 0, hoverOffset: 6 }]
    },
    options: { responsive: true, cutout: '70%', plugins: { legend: { display: false } } }
});
</script>
@endpush
@endsection
