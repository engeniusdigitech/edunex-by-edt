<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $payment->receipt_number ?? str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            color: #1e293b;
            background: #fff;
            padding: 0;
        }

        /* ── Watermark ─────────────────────────────────── */
        .watermark {
            position: fixed;
            top: 38%;
            left: 20%;
            width: 60%;
            font-size: 80px;
            font-weight: 700;
            color: rgba(16, 185, 129, 0.06);
            text-transform: uppercase;
            letter-spacing: 10px;
            transform: rotate(-30deg);
            pointer-events: none;
        }

        /* ── Page wrapper ──────────────────────────────── */
        .page { padding: 32px 40px; }

        /* ── Header strip ──────────────────────────────── */
        .header-strip {
            background: linear-gradient(135deg, #1e40af 0%, #0d9488 100%);
            color: #fff;
            padding: 22px 40px;
            display: table;
            width: 100%;
        }
        .header-left  { display: table-cell; vertical-align: middle; width: 60%; }
        .header-right { display: table-cell; vertical-align: middle; text-align: right; }

        .institute-name { font-size: 20px; font-weight: 700; letter-spacing: -0.3px; }
        .institute-sub  { font-size: 11px; opacity: 0.8; margin-top: 2px; }

        .receipt-badge {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.4);
            border-radius: 6px;
            padding: 6px 14px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 6px;
        }
        .receipt-number { font-size: 20px; font-weight: 700; letter-spacing: -0.5px; }

        /* ── Status pill ───────────────────────────────── */
        .status-pill {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .status-paid    { background: #d1fae5; color: #065f46; }
        .status-partial { background: #fef3c7; color: #92400e; }

        /* ── Two-col layout ────────────────────────────── */
        .two-col { display: table; width: 100%; margin: 24px 0; }
        .col-left  { display: table-cell; width: 50%; vertical-align: top; padding-right: 20px; }
        .col-right { display: table-cell; width: 50%; vertical-align: top; padding-left: 20px; border-left: 1px solid #e2e8f0; }

        .section-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94a3b8;
            margin-bottom: 10px;
        }

        .info-row { display: table; width: 100%; margin-bottom: 6px; }
        .info-key { display: table-cell; color: #64748b; width: 45%; font-size: 12px; }
        .info-val { display: table-cell; color: #1e293b; font-weight: 600; font-size: 12px; }

        /* ── Fee breakdown table ───────────────────────── */
        .breakdown-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .breakdown-table thead tr { background: #f1f5f9; }
        .breakdown-table th {
            padding: 10px 14px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #64748b;
        }
        .breakdown-table th:last-child { text-align: right; }
        .breakdown-table td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; font-size: 12px; color: #1e293b; }
        .breakdown-table td:last-child { text-align: right; font-weight: 600; }

        .breakdown-table .subtotal-row td { background: #f8fafc; font-weight: 500; color: #475569; font-size: 11px; }
        .breakdown-table .total-row td { background: #eff6ff; font-weight: 700; font-size: 14px; color: #1e40af; border-top: 2px solid #bfdbfe; }
        .breakdown-table .balance-row td { background: #fff7ed; color: #9a3412; font-weight: 600; font-size: 12px; }
        .breakdown-table .balance-row td:last-child { color: #dc2626; }

        /* ── Summary box ───────────────────────────────── */
        .summary-box {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            margin: 20px 0;
        }
        .summary-box-row { display: table; width: 100%; }
        .summary-box-cell {
            display: table-cell;
            padding: 14px 18px;
            text-align: center;
            border-right: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        .summary-box-cell:last-child { border-right: none; }
        .summary-box-cell .label { font-size: 10px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        .summary-box-cell .value { font-size: 16px; font-weight: 700; margin-top: 4px; }
        .value-blue  { color: #1e40af; }
        .value-green { color: #059669; }
        .value-red   { color: #dc2626; }

        /* ── Transaction details ───────────────────────── */
        .txn-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 18px;
            margin-top: 20px;
        }
        .txn-grid { display: table; width: 100%; }
        .txn-item  { display: table-cell; padding-right: 24px; }
        .txn-item:last-child { padding-right: 0; }
        .txn-item .tl { font-size: 9px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #94a3b8; margin-bottom: 3px; }
        .txn-item .tv { font-size: 12px; font-weight: 600; color: #1e293b; word-break: break-all; }

        /* ── Footer ────────────────────────────────────── */
        .footer {
            margin-top: 28px;
            padding-top: 16px;
            border-top: 1px dashed #cbd5e1;
            text-align: center;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.6;
        }
        .footer strong { color: #64748b; }

        .divider { border: none; border-top: 1px solid #e2e8f0; margin: 20px 0; }
    </style>
</head>
<body>

<div class="watermark">PAID</div>

{{-- Header --}}
<div class="header-strip">
    <div class="header-left">
        <div class="institute-name">{{ $institute->name ?? 'EduNex ERP Institute' }}</div>
        @if(!empty($institute->address))
            <div class="institute-sub">{{ $institute->address }}</div>
        @endif
        @if(!empty($institute->contact_email))
            <div class="institute-sub">{{ $institute->contact_email }}</div>
        @endif
    </div>
    <div class="header-right">
        <div class="receipt-badge">Payment Receipt</div>
        <div class="receipt-number">#{{ $payment->receipt_number ?? str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</div>
        <div style="margin-top:6px; font-size:11px; opacity:0.85;">
            {{ $payment->payment_date?->format('d F Y') ?? now()->format('d F Y') }}
        </div>
    </div>
</div>

<div class="page">

    {{-- Student + Payment Info --}}
    <div class="two-col">
        <div class="col-left">
            <div class="section-label">Billed To</div>
            <div class="info-row">
                <div class="info-key">Name</div>
                <div class="info-val">{{ $student->name ?? '—' }}</div>
            </div>
            @if(!empty($student->email))
            <div class="info-row">
                <div class="info-key">Email</div>
                <div class="info-val">{{ $student->email }}</div>
            </div>
            @endif
            @if(!empty($student->phone))
            <div class="info-row">
                <div class="info-key">Phone</div>
                <div class="info-val">{{ $student->phone }}</div>
            </div>
            @endif
            @if(!empty($student->batch->name))
            <div class="info-row">
                <div class="info-key">Batch</div>
                <div class="info-val">{{ $student->batch->name }}</div>
            </div>
            @endif
            @if(!empty($student->roll_number))
            <div class="info-row">
                <div class="info-key">Roll No.</div>
                <div class="info-val">{{ $student->roll_number }}</div>
            </div>
            @endif
        </div>
        <div class="col-right">
            <div class="section-label">Payment Details</div>
            <div class="info-row">
                <div class="info-key">Receipt No.</div>
                <div class="info-val">{{ $payment->receipt_number ?? str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="info-row">
                <div class="info-key">Date</div>
                <div class="info-val">{{ $payment->payment_date?->format('d M Y') ?? now()->format('d M Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-key">Method</div>
                <div class="info-val">{{ ucwords(str_replace('_', ' ', $payment->gateway ?? $payment->payment_method)) }}</div>
            </div>
            <div class="info-row">
                <div class="info-key">Status</div>
                <div class="info-val">
                    @php $isFullyPaid = $studentFee && $studentFee->due_amount <= 0; @endphp
                    <span class="status-pill {{ $isFullyPaid ? 'status-paid' : 'status-partial' }}">
                        {{ $isFullyPaid ? 'Fully Paid' : 'Partial Payment' }}
                    </span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-key">Currency</div>
                <div class="info-val">{{ strtoupper($payment->currency ?? 'INR') }}</div>
            </div>
        </div>
    </div>

    <hr class="divider">

    {{-- Fee Breakdown Table --}}
    <div class="section-label">Fee Breakdown</div>
    <table class="breakdown-table">
        <thead>
            <tr>
                <th style="width:55%">Description</th>
                <th style="width:25%; text-align:right;">Total Fee</th>
                <th style="width:20%; text-align:right;">This Payment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $payment->feeStructure->name ?? 'Fee Payment' }}</strong><br>
                    <span style="color:#64748b; font-size:11px;">
                        Category: {{ $payment->feeStructure->category->name ?? 'General' }}
                    </span>
                </td>
                <td style="text-align:right;">
                    {{ strtoupper($payment->currency ?? 'INR') }}
                    {{ number_format($studentFee->amount ?? $payment->amount_paid, 2) }}
                </td>
                <td style="text-align:right;">
                    {{ strtoupper($payment->currency ?? 'INR') }}
                    {{ number_format($payment->amount_paid, 2) }}
                </td>
            </tr>

            @if($studentFee && ($studentFee->paid_amount - $payment->amount_paid) > 0)
            <tr class="subtotal-row">
                <td colspan="2">Previously Paid</td>
                <td>
                    {{ strtoupper($payment->currency ?? 'INR') }}
                    {{ number_format($studentFee->paid_amount - $payment->amount_paid, 2) }}
                </td>
            </tr>
            @endif

            <tr class="total-row">
                <td colspan="2">Total Paid to Date</td>
                <td>
                    {{ strtoupper($payment->currency ?? 'INR') }}
                    {{ number_format($studentFee->paid_amount ?? $payment->amount_paid, 2) }}
                </td>
            </tr>

            @if($studentFee && $studentFee->due_amount > 0)
            <tr class="balance-row">
                <td colspan="2">Outstanding Balance</td>
                <td>
                    {{ strtoupper($payment->currency ?? 'INR') }}
                    {{ number_format($studentFee->due_amount, 2) }}
                </td>
            </tr>
            @endif
        </tbody>
    </table>

    {{-- Summary Boxes --}}
    <div class="summary-box">
        <div class="summary-box-row">
            <div class="summary-box-cell">
                <div class="label">Total Fee</div>
                <div class="value value-blue">₹{{ number_format($studentFee->amount ?? $payment->amount_paid, 2) }}</div>
            </div>
            <div class="summary-box-cell">
                <div class="label">This Payment</div>
                <div class="value value-green">₹{{ number_format($payment->amount_paid, 2) }}</div>
            </div>
            <div class="summary-box-cell">
                <div class="label">Total Paid</div>
                <div class="value value-green">₹{{ number_format($studentFee->paid_amount ?? $payment->amount_paid, 2) }}</div>
            </div>
            <div class="summary-box-cell">
                <div class="label">Balance Due</div>
                <div class="value {{ ($studentFee->due_amount ?? 0) > 0 ? 'value-red' : 'value-green' }}">
                    ₹{{ number_format($studentFee->due_amount ?? 0, 2) }}
                </div>
            </div>
        </div>
    </div>

    {{-- Transaction ID (if any) --}}
    @if($payment->transaction_id || $payment->razorpay_payment_id)
    <div class="txn-box">
        <div class="txn-grid">
            @if($payment->transaction_id)
            <div class="txn-item">
                <div class="tl">Transaction ID</div>
                <div class="tv">{{ $payment->transaction_id }}</div>
            </div>
            @endif
            @if($payment->gateway)
            <div class="txn-item">
                <div class="tl">Gateway</div>
                <div class="tv">{{ ucfirst($payment->gateway) }}</div>
            </div>
            @endif
            <div class="txn-item">
                <div class="tl">Payment Method</div>
                <div class="tv">{{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}</div>
            </div>
        </div>
    </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        <strong>{{ $institute->name ?? 'EduNex ERP Institute' }}</strong><br>
        This is a computer-generated receipt and does not require a physical signature.<br>
        @if(!empty($institute->contact_email))
            For queries, contact <strong>{{ $institute->contact_email }}</strong>
        @endif
    </div>

</div>
</body>
</html>
