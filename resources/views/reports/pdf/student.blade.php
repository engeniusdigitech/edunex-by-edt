<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report — {{ $student->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1E293B; background: #fff; }

        /* Header */
        .header {
            background: #4F46E5;
            color: white;
            padding: 22px 28px;
            border-radius: 0 0 12px 12px;
            margin-bottom: 20px;
        }
        .header .institute { font-size: 10px; opacity: 0.7; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .header h1 { font-size: 20px; font-weight: bold; margin-bottom: 6px; }
        .header .meta { font-size: 10px; opacity: 0.75; }
        .header .meta span { margin-right: 18px; }
        .generated { text-align: right; font-size: 9px; color: #94A3B8; margin-bottom: 16px; }

        /* Stat row */
        .stat-row { display: flex; gap: 10px; margin-bottom: 20px; }
        .stat-box {
            flex: 1;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 12px 14px;
            text-align: center;
        }
        .stat-label { font-size: 8px; text-transform: uppercase; letter-spacing: 1px; color: #64748B; margin-bottom: 4px; }
        .stat-val { font-size: 22px; font-weight: bold; line-height: 1; }
        .stat-sub { font-size: 8px; color: #94A3B8; margin-top: 3px; }
        .green { color: #10B981; }
        .red { color: #EF4444; }
        .indigo { color: #6366F1; }
        .amber { color: #F59E0B; }

        /* Progress bar */
        .prog-wrap { margin-top: 6px; background: #E2E8F0; border-radius: 99px; height: 5px; overflow: hidden; }
        .prog-fill { height: 5px; border-radius: 99px; }

        /* Section heading */
        .section-title {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: bold;
            color: #64748B;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        /* Two-col layout */
        .two-col { display: flex; gap: 16px; margin-bottom: 20px; }
        .col-left { width: 38%; }
        .col-right { flex: 1; }

        /* Table */
        table { width: 100%; border-collapse: collapse; font-size: 10px; }
        th { background: #F8FAFC; padding: 7px 10px; text-align: left; font-size: 8px; text-transform: uppercase; letter-spacing: 0.8px; color: #64748B; font-weight: bold; border-bottom: 1px solid #E2E8F0; }
        td { padding: 7px 10px; border-bottom: 1px solid #F1F5F9; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }

        /* Attendance log */
        .att-month { background: #F8FAFC; padding: 4px 8px; font-size: 8px; text-transform: uppercase; letter-spacing: 1px; color: #64748B; font-weight: bold; border-bottom: 1px solid #E2E8F0; display: flex; justify-content: space-between; }
        .att-row { display: flex; align-items: center; padding: 4px 8px; border-bottom: 1px solid #F8FAFC; gap: 10px; }
        .att-date { font-size: 9px; color: #64748B; min-width: 80px; }
        .badge { font-size: 8px; font-weight: bold; padding: 2px 8px; border-radius: 99px; }
        .badge-present { background: #D1FAE5; color: #065F46; }
        .badge-late    { background: #FEF3C7; color: #92400E; }
        .badge-absent  { background: #FEE2E2; color: #991B1B; }
        .badge-pass    { background: #D1FAE5; color: #065F46; }
        .badge-avg     { background: #FEF3C7; color: #92400E; }
        .badge-fail    { background: #FEE2E2; color: #991B1B; }
        .badge-pending { background: #F1F5F9; color: #64748B; }
        .badge-online  { background: #EDE9FE; color: #4C1D95; }
        .badge-cash    { background: #D1FAE5; color: #065F46; }

        /* Footer */
        .footer { text-align: center; font-size: 8px; color: #CBD5E1; margin-top: 20px; padding-top: 10px; border-top: 1px solid #F1F5F9; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="institute">{{ $student->institute->name ?? 'EduNex' }} &mdash; Student Report</div>
        <h1>{{ $student->name }}</h1>
        <div class="meta">
            @if($student->email)<span>&#9993; {{ $student->email }}</span>@endif
            @if($student->phone)<span>&#9742; {{ $student->phone }}</span>@endif
            <span>&#128101; {{ $student->batch->name ?? 'No Batch' }}</span>
            <span>Enrolled: {{ $student->enrollment_date?->format('d M Y') }}</span>
        </div>
    </div>

    <div class="generated">Report generated on {{ now()->format('d M Y, h:i A') }}</div>

    <!-- Stat Row -->
    <div class="stat-row">
        <div class="stat-box">
            <div class="stat-label">Total Classes</div>
            <div class="stat-val indigo">{{ $totalClasses }}</div>
            <div class="stat-sub">sessions recorded</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Attended</div>
            <div class="stat-val {{ $percentage >= 75 ? 'green' : 'red' }}">{{ $presentCount }}</div>
            <div class="stat-sub">present + late</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Late</div>
            <div class="stat-val amber">{{ $lateCount }}</div>
            <div class="stat-sub">marked late</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Absent</div>
            <div class="stat-val red">{{ $absentCount }}</div>
            <div class="stat-sub">missed sessions</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Attendance %</div>
            <div class="stat-val {{ $percentage >= 75 ? 'green' : 'red' }}">{{ $percentage }}%</div>
            <div class="prog-wrap">
                <div class="prog-fill" style="width:{{ $percentage }}%;background:{{ $percentage >= 75 ? '#10B981' : '#EF4444' }};"></div>
            </div>
        </div>
    </div>

    <!-- Two-col: Attendance log | Tests -->
    <div class="two-col">

        <!-- Attendance Log -->
        <div class="col-left">
            <div class="section-title">Attendance Log</div>
            @forelse($attendanceByMonth as $monthKey => $records)
            <div class="att-month">
                <span>{{ \Carbon\Carbon::parse($monthKey . '-01')->format('F Y') }}</span>
                @php $mPct = $records->count() > 0 ? round($records->whereIn('status',['present','late'])->count() / $records->count() * 100) : 0; @endphp
                <span class="{{ $mPct >= 75 ? 'green' : 'red' }}">{{ $mPct }}%</span>
            </div>
            @foreach($records as $att)
            <div class="att-row">
                <div class="att-date">{{ $att->date->format('D, d M Y') }}</div>
                @if($att->status === 'present')
                    <span class="badge badge-present">Present</span>
                @elseif($att->status === 'late')
                    <span class="badge badge-late">Late</span>
                @else
                    <span class="badge badge-absent">Absent</span>
                @endif
            </div>
            @endforeach
            @empty
            <p style="color:#94A3B8;font-size:9px;padding:8px;">No attendance records found.</p>
            @endforelse
        </div>

        <!-- Right: Tests + Payments -->
        <div class="col-right">

            <!-- Tests -->
            <div class="section-title">Tests &amp; Scores</div>
            @if($tests->isEmpty())
                <p style="color:#94A3B8;font-size:9px;margin-bottom:16px;">No tests scheduled for this batch.</p>
            @else
            <table style="margin-bottom:18px;">
                <thead>
                    <tr>
                        <th>Test</th>
                        <th>Date</th>
                        <th>Score</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tests as $test)
                    @php $score = $test->scores->first(); @endphp
                    <tr>
                        <td style="font-weight:bold;">{{ $test->title }}</td>
                        <td style="color:#64748B;">{{ $test->test_date->format('d M Y') }}</td>
                        <td>
                            @if($score)
                                <strong>{{ $score->score }}</strong> / {{ $test->total_marks }}
                            @else
                                <span style="color:#94A3B8;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($score)
                                @php $pct = round($score->score / $test->total_marks * 100); @endphp
                                @if($pct >= 75)
                                    <span class="badge badge-pass">Pass ({{ $pct }}%)</span>
                                @elseif($pct >= 50)
                                    <span class="badge badge-avg">Average ({{ $pct }}%)</span>
                                @else
                                    <span class="badge badge-fail">Fail ({{ $pct }}%)</span>
                                @endif
                            @else
                                <span class="badge badge-pending">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <!-- Payments -->
            <div class="section-title">Payment History &nbsp;&mdash;&nbsp; Total: &#8377;{{ number_format($totalPaid, 2) }}</div>
            @if($payments->isEmpty())
                <p style="color:#94A3B8;font-size:9px;">No payments recorded.</p>
            @else
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Method</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td style="color:#64748B;">{{ $payment->payment_date->format('d M Y') }}</td>
                        <td style="font-weight:bold;">{{ $payment->feeStructure->name ?? 'General Fee' }}</td>
                        <td style="font-weight:bold;">&#8377;{{ number_format($payment->amount_paid, 2) }}</td>
                        <td>
                            @if($payment->payment_method === 'online')
                                <span class="badge badge-online">Online</span>
                            @else
                                <span class="badge badge-cash">Cash</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

        </div><!-- /col-right -->
    </div><!-- /two-col -->

    <div class="footer">Generated by EduNex &bull; {{ $student->institute->name ?? '' }} &bull; Confidential</div>

</body>
</html>
