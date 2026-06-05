@extends('layouts.admin')

@section('title', 'Enter Marks — ' . $test->title)

@section('content')
<style>
.dap-marks-header {
    background:linear-gradient(135deg,#0F172A,#1E1B4B);
    border-radius:18px; padding:28px 32px; margin-bottom:28px;
    border:1px solid rgba(99,102,241,0.2); position:relative; overflow:hidden;
}
.dap-marks-header::before {
    content:''; position:absolute; inset:0; border-radius:18px;
    background-image:linear-gradient(rgba(99,102,241,0.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,0.06) 1px,transparent 1px);
    background-size:28px 28px;
}
.dap-marks-header-inner { position:relative;z-index:2; }

.dap-marks-card { background:#fff; border:1px solid #F1F5F9; border-radius:18px; box-shadow:0 4px 20px rgba(0,0,0,0.05); overflow:hidden; }
.dap-marks-card-header {
    padding:18px 28px; border-bottom:1px solid #F1F5F9; background:#FAFAFA;
    display:flex; align-items:center; justify-content:space-between;
}

.marks-row { border-bottom:1px solid #F8FAFC; transition:background 0.15s; }
.marks-row:last-child { border-bottom:none; }
.marks-row:hover { background:#FAFBFF; }
.marks-row td { padding:14px 24px; vertical-align:middle; }

.marks-input {
    border:1.5px solid #E2E8F0; border-radius:10px; padding:9px 14px;
    font-size:0.88rem; font-weight:700; color:#1E293B; text-align:center;
    width:110px; font-family:'Outfit',sans-serif; transition:all 0.2s;
    background:#fff;
}
.marks-input:focus { border-color:#4F46E5; box-shadow:0 0 0 3px rgba(79,70,229,0.1); outline:none; }
.marks-input.invalid { border-color:#DC2626; background:#FEF2F2; }

.remarks-input {
    border:1.5px solid #E2E8F0; border-radius:10px; padding:9px 14px;
    font-size:0.8rem; color:#475569; font-family:'Outfit',sans-serif;
    transition:all 0.2s; background:#F8FAFC; width:100%;
}
.remarks-input:focus { border-color:#4F46E5; box-shadow:0 0 0 3px rgba(79,70,229,0.1); outline:none; background:#fff; }

.student-avatar {
    width:36px; height:36px; border-radius:10px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    font-size:0.8rem; font-weight:800; color:#fff;
}
.dap-save-btn {
    background:linear-gradient(135deg,#059669,#0D9488); color:#fff; border:none;
    padding:13px 32px; border-radius:12px; font-size:0.9rem; font-weight:700;
    display:inline-flex; align-items:center; gap:10px; cursor:pointer;
    transition:all 0.2s; box-shadow:0 4px 20px rgba(5,150,105,0.3);
    font-family:'Outfit',sans-serif;
}
.dap-save-btn:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(5,150,105,0.4); }

.score-indicator {
    display:inline-block; width:34px; height:34px; border-radius:9px;
    display:flex; align-items:center; justify-content:center; font-size:0.65rem; font-weight:800;
}
</style>

{{-- Header --}}
<div class="dap-marks-header mb-4">
    <div class="dap-marks-header-inner">
        <div class="d-flex align-items-start gap-3 flex-wrap">
            <a href="{{ route('tests.index') }}"
               style="width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,0.08);border:1.5px solid rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;flex-shrink:0;transition:all 0.2s;"
               onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div style="flex:1;">
                <div style="font-size:0.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;">
                    <i class="fas fa-tasks me-1"></i> Enter Marks
                </div>
                <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:0 0 10px;letter-spacing:-0.5px;">{{ $test->title }}</h2>
                <div style="display:flex;flex-wrap:wrap;gap:10px;">
                    <span style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:8px;padding:5px 12px;font-size:0.72rem;font-weight:600;color:rgba(255,255,255,0.7);">
                        <i class="fas fa-layer-group me-1" style="color:#67E8F9;"></i>{{ $test->batch->name }}
                    </span>
                    <span style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:8px;padding:5px 12px;font-size:0.72rem;font-weight:600;color:rgba(255,255,255,0.7);">
                        <i class="fas fa-calendar-alt me-1" style="color:#67E8F9;"></i>{{ $test->test_date->format('d M, Y') }}
                    </span>
                    <span style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:8px;padding:5px 12px;font-size:0.72rem;font-weight:600;color:rgba(255,255,255,0.7);">
                        <i class="fas fa-bullseye me-1" style="color:#67E8F9;"></i>Total Marks: {{ $test->total_marks }}
                    </span>
                    <span style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);border-radius:8px;padding:5px 12px;font-size:0.72rem;font-weight:600;color:rgba(255,255,255,0.7);">
                        <i class="fas fa-users me-1" style="color:#67E8F9;"></i>{{ $test->batch->students->count() }} Students
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@if($test->batch->students->isEmpty())
<div class="dap-marks-card">
    <div style="text-align:center;padding:60px 24px;">
        <div style="font-size:3rem;opacity:0.15;margin-bottom:16px;"><i class="fas fa-user-graduate"></i></div>
        <div style="font-size:1rem;font-weight:700;color:#1E293B;margin-bottom:6px;">No Students in This Batch</div>
        <div style="font-size:0.83rem;color:#94A3B8;">Add students to the batch first, then enter their marks here.</div>
    </div>
</div>
@else

{{-- Live stats bar --}}
<div class="row g-3 mb-4" id="statsRow">
    <div class="col-6 col-lg-3">
        <div style="background:#fff;border:1px solid #F1F5F9;border-radius:14px;padding:16px 20px;box-shadow:0 2px 12px rgba(0,0,0,0.04);">
            <div style="font-size:1.6rem;font-weight:800;color:#4F46E5;line-height:1;" id="totalStudents">{{ $test->batch->students->count() }}</div>
            <div style="font-size:0.7rem;font-weight:600;color:#64748B;text-transform:uppercase;letter-spacing:0.5px;margin-top:4px;">Total Students</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div style="background:#fff;border:1px solid #F1F5F9;border-radius:14px;padding:16px 20px;box-shadow:0 2px 12px rgba(0,0,0,0.04);">
            <div style="font-size:1.6rem;font-weight:800;color:#059669;line-height:1;" id="liveEntered">0</div>
            <div style="font-size:0.7rem;font-weight:600;color:#64748B;text-transform:uppercase;letter-spacing:0.5px;margin-top:4px;">Marks Entered</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div style="background:#fff;border:1px solid #F1F5F9;border-radius:14px;padding:16px 20px;box-shadow:0 2px 12px rgba(0,0,0,0.04);">
            <div style="font-size:1.6rem;font-weight:800;color:#D97706;line-height:1;" id="liveAvg">—</div>
            <div style="font-size:0.7rem;font-weight:600;color:#64748B;text-transform:uppercase;letter-spacing:0.5px;margin-top:4px;">Live Average</div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div style="background:#fff;border:1px solid #F1F5F9;border-radius:14px;padding:16px 20px;box-shadow:0 2px 12px rgba(0,0,0,0.04);">
            <div style="font-size:1.6rem;font-weight:800;color:#DC2626;line-height:1;" id="liveFail">—</div>
            <div style="font-size:0.7rem;font-weight:600;color:#64748B;text-transform:uppercase;letter-spacing:0.5px;margin-top:4px;">Below Pass (40%)</div>
        </div>
    </div>
</div>

{{-- Marks form --}}
<div class="dap-marks-card">
    <div class="dap-marks-card-header">
        <div style="font-size:0.88rem;font-weight:700;color:#1E293B;display:flex;align-items:center;gap:10px;">
            <div style="width:32px;height:32px;border-radius:9px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:0.75rem;">
                <i class="fas fa-pen"></i>
            </div>
            Student Score Entry
        </div>
        <div style="font-size:0.72rem;color:#94A3B8;font-weight:600;">
            Pass mark: {{ ceil($test->total_marks * 0.4) }} (40%)
        </div>
    </div>

    <form action="{{ route('tests.store_marks', $test) }}" method="POST" id="marksForm">
        @csrf
        <div class="table-responsive">
            <table class="table mb-0" style="border-collapse:separate;border-spacing:0;">
                <thead style="background:#FAFAFA;border-bottom:1.5px solid #F1F5F9;">
                    <tr>
                        <th style="padding:12px 24px;font-size:0.68rem;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:#64748B;border:none;width:50px;">#</th>
                        <th style="padding:12px 24px;font-size:0.68rem;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:#64748B;border:none;">Student</th>
                        <th style="padding:12px 24px;font-size:0.68rem;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:#64748B;border:none;width:180px;">Score / {{ $test->total_marks }}</th>
                        <th style="padding:12px 24px;font-size:0.68rem;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:#64748B;border:none;">%</th>
                        <th style="padding:12px 24px;font-size:0.68rem;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:#64748B;border:none;">Remarks</th>
                        <th style="padding:12px 24px;font-size:0.68rem;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:#64748B;border:none;width:80px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $avatarColors = ['#4F46E5','#06B6D4','#059669','#D97706','#7C3AED','#DC2626','#0D9488']; @endphp
                    @foreach($test->batch->students as $index => $student)
                    @php $existingScore = $scores->get($student->id); @endphp
                    <tr class="marks-row">
                        <td style="font-size:0.8rem;font-weight:700;color:#94A3B8;">{{ $index + 1 }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div class="student-avatar" style="background:{{ $avatarColors[$index % 7] }};">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-size:0.85rem;font-weight:700;color:#1E293B;">{{ $student->name }}</div>
                                    <div style="font-size:0.7rem;color:#94A3B8;">{{ $student->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input type="number"
                                   name="scores[{{ $student->id }}][score]"
                                   class="marks-input score-field"
                                   value="{{ old('scores.'.$student->id.'.score', $existingScore?->score) }}"
                                   min="0"
                                   max="{{ $test->total_marks }}"
                                   step="0.01"
                                   data-max="{{ $test->total_marks }}"
                                   placeholder="—">
                            @error('scores.'.$student->id.'.score')
                                <div style="font-size:0.68rem;color:#DC2626;margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <span class="pct-display" style="font-size:0.85rem;font-weight:700;color:#94A3B8;">—</span>
                        </td>
                        <td>
                            <input type="text"
                                   name="scores[{{ $student->id }}][remarks]"
                                   class="remarks-input"
                                   value="{{ old('scores.'.$student->id.'.remarks', $existingScore?->remarks) }}"
                                   placeholder="Optional feedback...">
                        </td>
                        <td>
                            <span class="pass-fail-badge" style="font-size:0.68rem;font-weight:700;color:#94A3B8;">—</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="padding:20px 28px;border-top:1px solid #F1F5F9;background:#FAFAFA;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <div style="font-size:0.78rem;color:#64748B;">
                <i class="fas fa-info-circle me-1" style="color:#4F46E5;"></i>
                Scores are saved immediately. Students can view results from their portal.
            </div>
            <button type="submit" class="dap-save-btn">
                <i class="fas fa-save"></i> Save All Marks
            </button>
        </div>
    </form>
</div>
@endif

@push('scripts')
<script>
(function() {
    const totalMarks = {{ $test->total_marks }};
    const passThreshold = totalMarks * 0.4;
    const inputs = document.querySelectorAll('.score-field');

    function updateStats() {
        const vals = [];
        inputs.forEach(inp => {
            const v = parseFloat(inp.value);
            if (!isNaN(v)) vals.push(v);
        });
        document.getElementById('liveEntered').textContent = vals.length;
        if (vals.length > 0) {
            const avg = vals.reduce((a,b)=>a+b,0)/vals.length;
            document.getElementById('liveAvg').textContent = avg.toFixed(1);
            document.getElementById('liveFail').textContent = vals.filter(v=>v<passThreshold).length;
        } else {
            document.getElementById('liveAvg').textContent = '—';
            document.getElementById('liveFail').textContent = '—';
        }
    }

    inputs.forEach(inp => {
        // Init existing values
        if (inp.value !== '') triggerUpdate(inp);

        inp.addEventListener('input', function() {
            triggerUpdate(this);
            updateStats();
        });
    });

    function triggerUpdate(inp) {
        const row = inp.closest('tr');
        const pctEl = row.querySelector('.pct-display');
        const badgeEl = row.querySelector('.pass-fail-badge');
        const v = parseFloat(inp.value);
        const max = parseFloat(inp.dataset.max);

        if (isNaN(v) || inp.value === '') {
            pctEl.textContent = '—'; pctEl.style.color = '#94A3B8';
            badgeEl.textContent = '—'; badgeEl.style.color = '#94A3B8';
            inp.classList.remove('invalid');
            return;
        }
        if (v < 0 || v > max) {
            inp.classList.add('invalid');
            pctEl.textContent = '!'; pctEl.style.color = '#DC2626';
            badgeEl.textContent = 'Error'; badgeEl.style.color = '#DC2626';
            return;
        }
        inp.classList.remove('invalid');
        const pct = ((v / max) * 100).toFixed(1);
        pctEl.textContent = pct + '%';
        const passed = v >= passThreshold;
        pctEl.style.color = passed ? '#059669' : '#DC2626';
        badgeEl.textContent = passed ? 'Pass ✓' : 'Fail ✗';
        badgeEl.style.color = passed ? '#059669' : '#DC2626';
        badgeEl.style.fontWeight = '700';
    }

    updateStats();
})();
</script>
@endpush

@endsection
