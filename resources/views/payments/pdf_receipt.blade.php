<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $payment->receipt_number ?? $payment->id }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; color: #333; margin: 0; padding: 20px; }
        .header { border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
        .institute-name { font-size: 24px; font-weight: bold; color: #4F46E5; }
        .receipt-title { font-size: 20px; float: right; color: #666; }
        .details-table { width: 100%; margin-bottom: 40px; }
        .details-table td { vertical-align: top; width: 50%; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        .items-table th, .items-table td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        .items-table th { background: #f8fafc; font-weight: bold; color: #666; text-transform: uppercase; font-size: 12px; }
        .total-row { font-weight: bold; font-size: 18px; color: #4F46E5; }
        .footer { text-align: center; color: #999; font-size: 12px; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>

<div class="header">
    <span class="institute-name">{{ $institute->name ?? 'EduNex Institute' }}</span>
    <span class="receipt-title">PAYMENT RECEIPT</span>
</div>

<table class="details-table">
    <tr>
        <td>
            <strong>Billed To:</strong><br><br>
            {{ $student->name }}<br>
            {{ $student->email }}<br>
            {{ $student->phone }}<br>
            Batch: {{ $student->batch->name ?? 'N/A' }}
        </td>
        <td style="text-align: right;">
            <strong>Receipt No:</strong> {{ $payment->receipt_number ?? str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}<br>
            <strong>Date:</strong> {{ $payment->payment_date->format('M d, Y') }}<br>
            <strong>Status:</strong> <span style="color: #10B981;">Paid</span><br>
            <strong>Method:</strong> {{ ucfirst($payment->gateway ?? $payment->payment_method) }}<br>
            @if($payment->transaction_id)
            <strong>Transaction ID:</strong> {{ $payment->transaction_id }}
            @endif
        </td>
    </tr>
</table>

<table class="items-table">
    <thead>
        <tr>
            <th>Description</th>
            <th style="text-align: right;">Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <strong>{{ $payment->feeStructure->name ?? 'General Fee' }}</strong><br>
                <span style="color:#666; font-size:12px;">Category: {{ $payment->feeStructure->category->name ?? 'N/A' }}</span>
            </td>
            <td style="text-align: right; font-size: 16px;">
                {{ strtoupper($payment->currency) }} {{ number_format($payment->amount_paid, 2) }}
            </td>
        </tr>
        <tr>
            <td style="text-align: right; border-bottom: none; padding-top:20px;"><strong>Total Paid:</strong></td>
            <td class="total-row" style="text-align: right; border-bottom: none; padding-top:20px;">
                {{ strtoupper($payment->currency) }} {{ number_format($payment->amount_paid, 2) }}
            </td>
        </tr>
    </tbody>
</table>

<div class="footer">
    This is an auto-generated receipt. For any questions, please contact {{ $institute->contact_email ?? 'support' }}.
</div>

</body>
</html>
