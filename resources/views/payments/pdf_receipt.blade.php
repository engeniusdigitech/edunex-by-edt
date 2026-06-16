<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $payment->receipt_number ?? str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        @page {
            margin: 0px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #334155;
            background: #ffffff;
            line-height: 1.5;
            padding: 0;
            margin: 0;
        }

        .watermark {
            position: absolute;
            top: 40%;
            left: 50%;
            width: 260px;
            height: 90px;
            margin-left: -130px;
            margin-top: -45px;
            font-size: 44px;
            font-weight: bold;
            border: 5px solid;
            border-radius: 8px;
            text-align: center;
            line-height: 80px;
            letter-spacing: 5px;
            text-transform: uppercase;
            z-index: -1;
            pointer-events: none;
        }

        .container {
            padding: 35px 40px 40px 40px;
        }

        .header-table {
            width: 100%;
            background: #0f172a;
            color: #ffffff;
            padding: 28px 40px;
            border-bottom: 4px solid #0d9488;
            border-collapse: collapse;
        }

        .header-logo-section {
            vertical-align: middle;
        }

        .header-meta-section {
            text-align: right;
            vertical-align: middle;
        }

        .info-table {
            width: 100%;
            margin: 20px 0 25px 0;
            border-collapse: collapse;
        }

        .info-card-cell {
            width: 48%;
            vertical-align: top;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
        }

        .info-spacing-cell {
            width: 4%;
        }

        .card-title {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }

        .card-primary-value {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .inner-info-table {
            width: 100%;
            font-size: 11px;
            border-collapse: collapse;
        }

        .inner-info-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .inner-info-key {
            color: #64748b;
            width: 32%;
        }

        .inner-info-val {
            font-weight: normal;
            color: #334155;
        }

        .breakdown-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .breakdown-table th {
            background: #f1f5f9;
            border-bottom: 2px solid #cbd5e1;
            padding: 10px 14px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            color: #475569;
            letter-spacing: 0.5px;
        }

        .breakdown-table td {
            padding: 12px 14px;
            font-size: 11px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            vertical-align: middle;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .summary-card-cell {
            width: 23.5%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px;
            text-align: center;
        }

        .summary-spacing-cell {
            width: 2%;
        }

        .summary-label {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.5px;
        }

        .summary-value {
            font-size: 13px;
            font-weight: bold;
            margin-top: 4px;
        }

        .txn-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 18px;
            margin-bottom: 25px;
        }

        .txn-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .txn-table td {
            vertical-align: top;
        }

        .txn-label {
            font-weight: bold;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 4px;
            font-size: 8px;
            letter-spacing: 0.5px;
        }

        .txn-value {
            font-weight: bold;
            color: #0f172a;
        }

        .footer {
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
            border-top: 1px dashed #cbd5e1;
            padding-top: 20px;
            line-height: 1.6;
        }
    </style>
</head>
<body>

@php
    $currencyCode = strtoupper($payment->currency ?? 'INR');
    $currencySymbols = [
        'INR' => '₹',
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        'JPY' => '¥',
        'AUD' => '$',
        'CAD' => '$',
    ];
    $currencySymbol = $currencySymbols[$currencyCode] ?? $currencyCode;
    $isFullyPaid = $studentFee && $studentFee->due_amount <= 0;
    $hasLogo = $institute && !empty($institute->logo) && file_exists(storage_path('app/public/' . $institute->logo));
@endphp

{{-- Watermark Background --}}
<div class="watermark" style="color: {{ $isFullyPaid ? 'rgba(16, 185, 129, 0.06)' : 'rgba(245, 158, 11, 0.06)' }}; border-color: {{ $isFullyPaid ? 'rgba(16, 185, 129, 0.06)' : 'rgba(245, 158, 11, 0.06)' }};">
    {{ $isFullyPaid ? 'PAID' : 'PARTIAL' }}
</div>

{{-- Top Full-Bleed Header Section --}}
<table class="header-table" cellpadding="0" cellspacing="0">
    <tr>
        <td class="header-logo-section">
            <table cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                <tr>
                    @if($hasLogo)
                    <td style="vertical-align: middle; padding-right: 15px;">
                        <img src="{{ storage_path('app/public/' . $institute->logo) }}" style="max-height: 48px; max-width: 150px; display: block;">
                    </td>
                    @endif
                    <td style="vertical-align: middle; @if($hasLogo) border-left: 1px solid rgba(255,255,255,0.2); padding-left: 15px; @endif">
                        <div style="font-size: 16px; font-weight: bold; letter-spacing: -0.5px; line-height: 1.2;">
                            {{ $institute->name ?? 'EduNex ERP Institute' }}
                        </div>
                        @if(!empty($institute->address))
                            <div style="font-size: 10px; color: #94a3b8; margin-top: 4px; line-height: 1.3; max-width: 280px;">
                                {{ $institute->address }}
                            </div>
                        @endif
                        @if(!empty($institute->contact_email))
                            <div style="font-size: 10px; color: #94a3b8; margin-top: 2px;">
                                {{ $institute->contact_email }}
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
        <td class="header-meta-section">
            <span style="background: {{ $isFullyPaid ? 'rgba(16, 185, 129, 0.2)' : 'rgba(245, 158, 11, 0.2)' }}; border: 1px solid {{ $isFullyPaid ? '#10b981' : '#f59e0b' }}; color: {{ $isFullyPaid ? '#34d399' : '#fbbf24' }}; border-radius: 4px; padding: 4px 10px; font-size: 9px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase;">
                {{ $isFullyPaid ? 'Fully Paid' : 'Partial Receipt' }}
            </span>
            <div style="font-size: 18px; font-weight: bold; margin-top: 10px; color: #ffffff;">
                #{{ $payment->receipt_number ?? str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}
            </div>
            <div style="font-size: 10px; color: #94a3b8; margin-top: 4px;">
                {{ $payment->payment_date?->format('d F Y') ?? now()->format('d F Y') }}
            </div>
        </td>
    </tr>
</table>

<div class="container">

    {{-- Info Cards Section --}}
    <table class="info-table" cellpadding="0" cellspacing="0">
        <tr>
            {{-- Billed To Card --}}
            <td class="info-card-cell">
                <div class="card-title">Billed To</div>
                <div class="card-primary-value">{{ $student->name ?? '—' }}</div>
                
                <table class="inner-info-table" cellpadding="0" cellspacing="0">
                    @if(!empty($student->email))
                    <tr>
                        <td class="inner-info-key">Email:</td>
                        <td class="inner-info-val">{{ $student->email }}</td>
                    </tr>
                    @endif
                    @if(!empty($student->phone))
                    <tr>
                        <td class="inner-info-key">Phone:</td>
                        <td class="inner-info-val">{{ $student->phone }}</td>
                    </tr>
                    @endif
                    @if(!empty($student->batch->name))
                    <tr>
                        <td class="inner-info-key">Batch:</td>
                        <td class="inner-info-val">{{ $student->batch->name }}</td>
                    </tr>
                    @endif
                    @if(!empty($student->roll_number))
                    <tr>
                        <td class="inner-info-key">Roll No:</td>
                        <td class="inner-info-val">{{ $student->roll_number }}</td>
                    </tr>
                    @endif
                </table>
            </td>

            <td class="info-spacing-cell"></td>

            {{-- Payment Details Card --}}
            <td class="info-card-cell">
                <div class="card-title">Payment Info</div>
                
                <table class="inner-info-table" cellpadding="0" cellspacing="0" style="margin-top: 4px;">
                    <tr>
                        <td class="inner-info-key">Receipt No:</td>
                        <td class="inner-info-val" style="font-weight: bold; color: #0f172a;">
                            #{{ $payment->receipt_number ?? str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="inner-info-key">Date:</td>
                        <td class="inner-info-val">{{ $payment->payment_date?->format('d M Y') ?? now()->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td class="inner-info-key">Method:</td>
                        <td class="inner-info-val">{{ ucwords(str_replace('_', ' ', $payment->gateway ?? $payment->payment_method)) }}</td>
                    </tr>
                    <tr>
                        <td class="inner-info-key">Currency:</td>
                        <td class="inner-info-val" style="text-transform: uppercase;">{{ $currencyCode }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- Fee Breakdown Table --}}
    <div style="font-size: 9px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; color: #64748b; margin-bottom: 8px; margin-top: 5px;">
        Fee Breakdown
    </div>
    
    <table class="breakdown-table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 50%;">Description</th>
                <th style="width: 25%; text-align: right;">Total structure Fee</th>
                <th style="width: 25%; text-align: right;">This Payment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div style="font-weight: bold; color: #0f172a; margin-bottom: 3px;">
                        {{ $payment->feeStructure->name ?? 'Fee Payment' }}
                    </div>
                    <div style="font-size: 10px; color: #64748b;">
                        Category: {{ $payment->feeStructure->category->name ?? 'General' }}
                    </div>
                </td>
                <td style="text-align: right; color: #334155;">
                    {{ $currencySymbol }} {{ number_format($studentFee->amount ?? $payment->amount_paid, 2) }}
                </td>
                <td style="text-align: right; font-weight: bold; color: #0f172a;">
                    {{ $currencySymbol }} {{ number_format($payment->amount_paid, 2) }}
                </td>
            </tr>
            
            @if($studentFee && ($studentFee->paid_amount - $payment->amount_paid) > 0)
            <tr style="background: #f8fafc;">
                <td colspan="2" style="text-align: right; font-size: 10px; color: #475569; padding: 10px 14px;">
                    Previously Paid:
                </td>
                <td style="text-align: right; font-size: 10px; color: #475569; padding: 10px 14px;">
                    {{ $currencySymbol }} {{ number_format($studentFee->paid_amount - $payment->amount_paid, 2) }}
                </td>
            </tr>
            @endif
            
            <tr style="background: #eff6ff;">
                <td colspan="2" style="text-align: right; font-size: 11px; font-weight: bold; color: #1e40af; padding: 12px 14px; border-top: 1px solid #bfdbfe;">
                    Total Paid to Date:
                </td>
                <td style="text-align: right; font-size: 11px; font-weight: bold; color: #1e40af; padding: 12px 14px; border-top: 1px solid #bfdbfe;">
                    {{ $currencySymbol }} {{ number_format($studentFee->paid_amount ?? $payment->amount_paid, 2) }}
                </td>
            </tr>
            
            @if($studentFee && $studentFee->due_amount > 0)
            <tr style="background: #fff7ed;">
                <td colspan="2" style="text-align: right; font-size: 11px; font-weight: bold; color: #c2410c; padding: 12px 14px; border-top: 1px solid #fed7aa;">
                    Outstanding Balance:
                </td>
                <td style="text-align: right; font-size: 11px; font-weight: bold; color: #ea580c; padding: 12px 14px; border-top: 1px solid #fed7aa;">
                    {{ $currencySymbol }} {{ number_format($studentFee->due_amount, 2) }}
                </td>
            </tr>
            @endif
        </tbody>
    </table>

    {{-- Summary Cards Grid --}}
    <table class="summary-table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="summary-card-cell">
                <div class="summary-label">Total Structure Fee</div>
                <div class="summary-value" style="color: #1e40af;">
                    {{ $currencySymbol }}{{ number_format($studentFee->amount ?? $payment->amount_paid, 2) }}
                </div>
            </td>
            
            <td class="summary-spacing-cell"></td>
            
            <td class="summary-card-cell">
                <div class="summary-label">This Payment</div>
                <div class="summary-value" style="color: #059669;">
                    {{ $currencySymbol }}{{ number_format($payment->amount_paid, 2) }}
                </div>
            </td>
            
            <td class="summary-spacing-cell"></td>
            
            <td class="summary-card-cell">
                <div class="summary-label">Total Paid to Date</div>
                <div class="summary-value" style="color: #059669;">
                    {{ $currencySymbol }}{{ number_format($studentFee->paid_amount ?? $payment->amount_paid, 2) }}
                </div>
            </td>
            
            <td class="summary-spacing-cell"></td>
            
            <td class="summary-card-cell" style="background: {{ ($studentFee->due_amount ?? 0) > 0 ? '#fff7ed' : '#f0fdf4' }}; border-color: {{ ($studentFee->due_amount ?? 0) > 0 ? '#fed7aa' : '#bbf7d0' }};">
                <div class="summary-label" style="color: {{ ($studentFee->due_amount ?? 0) > 0 ? '#c2410c' : '#15803d' }};">Balance Due</div>
                <div class="summary-value" style="color: {{ ($studentFee->due_amount ?? 0) > 0 ? '#ea580c' : '#16a34a' }};">
                    {{ $currencySymbol }}{{ number_format($studentFee->due_amount ?? 0, 2) }}
                </div>
            </td>
        </tr>
    </table>

    {{-- Transaction Metadata Box --}}
    @if($payment->transaction_id || $payment->razorpay_payment_id)
    <div class="txn-card">
        <table class="txn-table" cellpadding="0" cellspacing="0">
            <tr>
                @if($payment->transaction_id)
                <td style="padding-right: 20px;">
                    <div class="txn-label">Transaction ID</div>
                    <div class="txn-value">{{ $payment->transaction_id }}</div>
                </td>
                @endif
                @if($payment->gateway)
                <td style="padding-right: 20px; width: 25%;">
                    <div class="txn-label">Payment Gateway</div>
                    <div class="txn-value">{{ ucfirst($payment->gateway) }}</div>
                </td>
                @endif
                <td style="width: 30%;">
                    <div class="txn-label">Payment Method</div>
                    <div class="txn-value">{{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}</div>
                </td>
            </tr>
        </table>
    </div>
    @endif

    {{-- Invoice Footer --}}
    <div class="footer">
        <div style="font-weight: bold; color: #475569; margin-bottom: 4px; font-size: 10px;">
            {{ $institute->name ?? 'EduNex ERP Institute' }}
        </div>
        This is a computer-generated invoice receipt and does not require a physical signature.<br>
        @if(!empty($institute->contact_email))
            For support or queries, contact <strong>{{ $institute->contact_email }}</strong>
        @endif
    </div>

</div>

</body>
</html>
