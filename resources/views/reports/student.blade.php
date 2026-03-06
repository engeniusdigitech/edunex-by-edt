@extends('layouts.admin')

@section('title', 'Student Report — ' . $student->name)

@section('content')

{{-- Back + Download --}}
<div class="mb-4 d-flex align-items-center justify-content-between">
    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
    <a href="{{ route('reports.student.pdf', $student) }}" class="btn btn-danger shadow-sm">
        <i class="fas fa-file-pdf me-2"></i> Download PDF
    </a>
</div>

{{-- ── HEADER CARD ── --}}
<div class="card border-0 mb-4" style="background: linear-gradient(135deg, #4F46E5, #7C3AED 60%, #EC4899); border-radius: 18px; overflow: hidden;">
    <div class="card-body p-4 d-flex align-items-center gap-4" style="position:relative;">
        {{-- Avatar --}}
        <div class="d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
             style="width:70px;height:70px;border-radius:50%;background:rgba(255,255,255,0.15);font-size:1.6rem;border:3px solid rgba(255,255,255,0.25);">
            {{ strtoupper(substr($student->name, 0, 2)) }}
        </div>
        <div>
            <h4 class="fw-bold text-white mb-1">{{ $student->name }}</h4>
            <div class="d-flex flex-wrap gap-3" style="font-size:0.82rem;color:rgba(255,255,255,0.7);">
                @if($student->email)
                    <span><i class="far fa-envelope me-1"></i>{{ $student->email }}</span>
                @endif
                @if($student->phone)
                    <span><i class="fas fa-phone-alt me-1"></i>{{ $student->phone }}</span>
                @endif
                <span><i class="fas fa-users me-1"></i>{{ $student->batch->name ?? 'No Batch' }}</span>
                <span><i class="far fa-calendar-alt me-1"></i>Enrolled {{ $student->enrollment_date?->format('M d, Y') }}</span>
            </div>
        </div>
        <i class="fas fa-user-graduate" style="position:absolute;right:30px;top:50%;transform:translateY(-50%);font-size:6rem;color:rgba(255,255,255,0.07);"></i>
    </div>
</div>

{{-- ── SUMMARY STAT CARDS ── --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
            <div class="card-body p-3">
                <div class="text-muted small text-uppercase fw-semibold mb-2" style="letter-spacing:1px;font-size:0.65rem;">Total Classes</div>
                <div class="fw-black text-dark" style="font-size:1.8rem;line-height:1;">{{ $totalClasses }}</div>
                <div class="text-muted small mt-1">recorded sessions</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
            <div class="card-body p-3">
                <div class="text-muted small text-uppercase fw-semibold mb-2" style="letter-spacing:1px;font-size:0.65rem;">Attended</div>
                <div class="fw-black {{ $percentage >= 75 ? 'text-success' : 'text-danger' }}" style="font-size:1.8rem;line-height:1;">{{ $presentCount }}</div>
                <div class="text-muted small mt-1">present + late</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
            <div class="card-body p-3">
                <div class="text-muted small text-uppercase fw-semibold mb-2" style="letter-spacing:1px;font-size:0.65rem;">Absent</div>
                <div class="fw-black text-danger" style="font-size:1.8rem;line-height:1;">{{ $absentCount }}</div>
                <div class="text-muted small mt-1">missed sessions</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
            <div class="card-body p-3">
                <div class="text-muted small text-uppercase fw-semibold mb-2" style="letter-spacing:1px;font-size:0.65rem;">Attendance %</div>
                <div class="fw-black {{ $percentage >= 75 ? 'text-success' : 'text-danger' }}" style="font-size:1.8rem;line-height:1;">{{ $percentage }}%</div>
                <div class="progress mt-2" style="height:5px;border-radius:99px;">
                    <div class="progress-bar {{ $percentage >= 75 ? 'bg-success' : 'bg-danger' }}" style="width:{{ $percentage }}%;border-radius:99px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">

    {{-- ── LEFT COL: Attendance Log ── --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                <h6 class="fw-bold text-dark text-uppercase mb-0" style="letter-spacing:1px;font-size:0.78rem;">
                    <i class="fas fa-calendar-check text-primary me-2"></i>Attendance Log
                </h6>
            </div>
            <div class="card-body p-0" style="max-height:520px;overflow-y:auto;">
                @forelse($attendanceByMonth as $monthKey => $records)
                {{-- Month header --}}
                <div class="px-4 py-2" style="background:#F8FAFC;border-top:1px solid #F1F5F9;border-bottom:1px solid #F1F5F9;">
                    <span class="fw-bold text-muted small text-uppercase" style="letter-spacing:1px;font-size:0.72rem;">
                        {{ \Carbon\Carbon::parse($monthKey . '-01')->format('F Y') }}
                    </span>
                    @php
                        $mPresent = $records->whereIn('status', ['present','late'])->count();
                        $mTotal   = $records->count();
                        $mPct     = $mTotal > 0 ? round($mPresent / $mTotal * 100) : 0;
                    @endphp
                    <span class="float-end fw-semibold {{ $mPct >= 75 ? 'text-success' : 'text-danger' }}" style="font-size:0.72rem;">{{ $mPct }}%</span>
                </div>
                @foreach($records as $att)
                <div class="d-flex align-items-center px-4 py-2 border-bottom" style="border-color:#F8FAFC!important;">
                    <div class="text-muted small me-3" style="min-width:90px;">
                        {{ $att->date->format('D, d M') }}
                    </div>
                    @if($att->status === 'present')
                        <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:#D1FAE5;color:#065F46;font-size:0.7rem;">Present</span>
                    @elseif($att->status === 'late')
                        <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:#FEF3C7;color:#92400E;font-size:0.7rem;">Late</span>
                    @else
                        <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:#FEE2E2;color:#991B1B;font-size:0.7rem;">Absent</span>
                    @endif
                </div>
                @endforeach
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-calendar-times fa-2x opacity-25 mb-2 d-block"></i>
                    <span class="small">No attendance records found.</span>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ── RIGHT COL: Tests + Payments ── --}}
    <div class="col-lg-7">

        {{-- Tests & Scores --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-2">
                <h6 class="fw-bold text-dark text-uppercase mb-0" style="letter-spacing:1px;font-size:0.78rem;">
                    <i class="fas fa-pen-to-square text-primary me-2"></i>Tests &amp; Scores
                </h6>
            </div>
            <div class="card-body p-0">
                @if($tests->isEmpty())
                <div class="text-center py-4 text-muted small">No tests scheduled for this batch.</div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background:#F8FAFC;">
                            <tr>
                                <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size:0.68rem;letter-spacing:1px;">Test</th>
                                <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size:0.68rem;letter-spacing:1px;">Date</th>
                                <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size:0.68rem;letter-spacing:1px;">Score</th>
                                <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size:0.68rem;letter-spacing:1px;">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tests as $test)
                            @php $score = $test->scores->first(); @endphp
                            <tr>
                                <td class="ps-4 py-3 fw-semibold text-dark">{{ $test->title }}</td>
                                <td class="py-3 text-muted small">{{ $test->test_date->format('d M Y') }}</td>
                                <td class="py-3">
                                    @if($score)
                                        <span class="fw-bold text-primary">{{ $score->score }}</span>
                                        <span class="text-muted small"> / {{ $test->total_marks }}</span>
                                    @else
                                        <span class="text-muted small fst-italic">Not entered</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    @if($score)
                                        @php $pct = round($score->score / $test->total_marks * 100); @endphp
                                        @if($pct >= 75)
                                            <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:#D1FAE5;color:#065F46;font-size:0.68rem;">Pass ({{ $pct }}%)</span>
                                        @elseif($pct >= 50)
                                            <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:#FEF3C7;color:#92400E;font-size:0.68rem;">Average ({{ $pct }}%)</span>
                                        @else
                                            <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:#FEE2E2;color:#991B1B;font-size:0.68rem;">Fail ({{ $pct }}%)</span>
                                        @endif
                                        @if($score->remarks)
                                            <div class="small text-muted fst-italic mt-1">{{ $score->remarks }}</div>
                                        @endif
                                    @else
                                        <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:#F1F5F9;color:#64748B;font-size:0.68rem;">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

        {{-- Payments --}}
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark text-uppercase mb-0" style="letter-spacing:1px;font-size:0.78rem;">
                    <i class="fas fa-wallet text-primary me-2"></i>Payment History
                </h6>
                <span class="fw-bold text-success" style="font-size:0.9rem;">₹{{ number_format($totalPaid, 2) }} total</span>
            </div>
            <div class="card-body p-0">
                @if($payments->isEmpty())
                <div class="text-center py-4 text-muted small">No payments recorded.</div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background:#F8FAFC;">
                            <tr>
                                <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size:0.68rem;letter-spacing:1px;">Date</th>
                                <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size:0.68rem;letter-spacing:1px;">Description</th>
                                <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size:0.68rem;letter-spacing:1px;">Amount</th>
                                <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size:0.68rem;letter-spacing:1px;">Method</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td class="ps-4 py-3 text-muted small">{{ $payment->payment_date->format('d M Y') }}</td>
                                <td class="py-3 fw-semibold text-dark">{{ $payment->feeStructure->name ?? 'General Fee' }}</td>
                                <td class="py-3 fw-bold text-dark">₹{{ number_format($payment->amount_paid, 2) }}</td>
                                <td class="py-3">
                                    @if($payment->payment_method === 'online')
                                        <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:#EDE9FE;color:#4C1D95;font-size:0.68rem;"><i class="fas fa-credit-card me-1"></i>Online</span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:#D1FAE5;color:#065F46;font-size:0.68rem;"><i class="fas fa-money-bill me-1"></i>Cash</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

    </div>{{-- /right col --}}

</div>{{-- /row --}}
@endsection
