<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip - {{ $staffPayroll->user->name }} - {{ $staffPayroll->period_label }}</title>
    <!-- Inter Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
            padding: 40px 20px;
        }
        .payslip-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #E2E8F0;
            padding: 40px;
        }
        .school-header {
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 24px;
            margin-bottom: 24px;
        }
        .payslip-title {
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #2563EB;
        }
        .detail-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            color: #64748B;
            letter-spacing: 0.5px;
        }
        .detail-value {
            font-size: 0.9rem;
            font-weight: 500;
            color: #1E293B;
        }
        .table-salary th {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: #F1F5F9 !important;
            color: #475569;
        }
        .table-salary td {
            font-size: 0.9rem;
        }
        .summary-box {
            background-color: #EFF6FF;
            border: 1px solid #BFDBFE;
            border-radius: 12px;
            padding: 20px;
        }
        .sig-line {
            border-top: 1px solid #CBD5E1;
            width: 180px;
            margin-top: 50px;
            padding-top: 8px;
            font-size: 0.8rem;
            color: #64748B;
            text-align: center;
        }
        @media print {
            body {
                background-color: #FFFFFF;
                padding: 0;
            }
            .payslip-container {
                box-shadow: none;
                border: 0;
                padding: 0;
                max-width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

<div class="container no-print mb-4 d-flex justify-content-between align-items-center" style="max-width: 800px;">
    <button onclick="window.close()" class="btn btn-outline-secondary rounded-pill px-3.5"><i class="fas fa-times me-2"></i>Close Window</button>
    <button onclick="window.print()" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="fas fa-print me-2"></i>Print Payslip</button>
</div>

<div class="payslip-container">
    <!-- Header -->
    <div class="school-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            @if($staffPayroll->user->institute && $staffPayroll->user->institute->logo)
                <img src="{{ asset('storage/' . $staffPayroll->user->institute->logo) }}" alt="Logo" style="max-height: 55px; border-radius: 8px;">
            @else
                <div class="bg-primary-subtle text-primary rounded d-flex align-items-center justify-content-center fw-bold" style="width: 55px; height: 55px; font-size:1.4rem;">
                    {{ strtoupper(substr($staffPayroll->user->institute->name ?? 'EN', 0, 2)) }}
                </div>
            @endif
            <div>
                <h4 class="fw-bold mb-0 text-dark">{{ $staffPayroll->user->institute->name ?? 'EduNex ERP Institution' }}</h4>
                <span class="text-muted small">{{ $staffPayroll->user->institute->contact_email ?? 'engeniusdigitech@gmail.com' }} | {{ $staffPayroll->user->institute->phone ?? 'Gate Office' }}</span>
            </div>
        </div>
        <div class="text-md-end">
            <h5 class="payslip-title mb-1">Pay Slip</h5>
            <span class="badge bg-primary rounded-pill">{{ $staffPayroll->period_label }}</span>
        </div>
    </div>

    <!-- Employee Details Grid -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="detail-label">Employee Name</div>
            <div class="detail-value">{{ $staffPayroll->user->name }}</div>
        </div>
        <div class="col-6 col-md-3">
            <div class="detail-label">Designation / Role</div>
            <div class="detail-value">{{ $staffPayroll->user->role->name }}</div>
        </div>
        <div class="col-6 col-md-3">
            <div class="detail-label">Working Days</div>
            <div class="detail-value">{{ $staffPayroll->working_days }} days</div>
        </div>
        <div class="col-6 col-md-3">
            <div class="detail-label">Present Days</div>
            <div class="detail-value">{{ $staffPayroll->present_days }} days</div>
        </div>

        <div class="col-6 col-md-3">
            <div class="detail-label">Paid Leaves Used</div>
            <div class="detail-value">{{ $staffPayroll->paid_leaves_used ?? 0 }} days</div>
        </div>
        <div class="col-6 col-md-3">
            <div class="detail-label">Voucher Number</div>
            <div class="detail-value">PAY-{{ $staffPayroll->year }}{{ str_pad($staffPayroll->month, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($staffPayroll->id, 4, '0', STR_PAD_LEFT) }}</div>
        </div>
        <div class="col-6 col-md-3">
            <div class="detail-label">Status</div>
            <div class="detail-value text-capitalize fw-semibold text-{{ $staffPayroll->status === 'paid' ? 'success' : 'primary' }}">
                {{ $staffPayroll->status }}
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="detail-label">Disbursed At</div>
            <div class="detail-value">{{ $staffPayroll->paid_at ? $staffPayroll->paid_at->format('d M, Y') : 'Pending Outflow' }}</div>
        </div>
    </div>

    <!-- Salary Breakdown Table -->
    <div class="row g-4 mb-4">
        <!-- Earnings -->
        <div class="col-md-6 col-12">
            <table class="table table-bordered table-salary align-middle">
                <thead>
                    <tr>
                        <th>Earnings (Gross Additions)</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Basic Salary (Pro-rated)</td>
                        <td class="text-end">₹{{ number_format($staffPayroll->basic_salary, 2) }}</td>
                    </tr>
                    <tr>
                        <td>House Rent Allowance (HRA)</td>
                        <td class="text-end">₹{{ number_format($staffPayroll->hra, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Other Special Allowances</td>
                        <td class="text-end">₹{{ number_format($staffPayroll->allowances, 2) }}</td>
                    </tr>
                    <tr class="fw-bold table-light">
                        <td>Gross Earnings (A)</td>
                        <td class="text-end">₹{{ number_format($staffPayroll->gross_salary, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Deductions -->
        <div class="col-md-6 col-12">
            <table class="table table-bordered table-salary align-middle">
                <thead>
                    <tr>
                        <th>Deductions (Withholdings)</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Provident Fund (PF)</td>
                        <td class="text-end">₹{{ number_format($staffPayroll->pf_deduction ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Employee State Insurance (ESIC)</td>
                        <td class="text-end">₹{{ number_format($staffPayroll->esic_deduction ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Income Tax / TDS</td>
                        <td class="text-end">₹{{ number_format($staffPayroll->tds_deduction ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Other Deductions / Absences</td>
                        <td class="text-end">₹{{ number_format($staffPayroll->deductions, 2) }}</td>
                    </tr>
                    @php
                        $totDeductions = (float) $staffPayroll->deductions + (float) ($staffPayroll->pf_deduction ?? 0) + (float) ($staffPayroll->esic_deduction ?? 0) + (float) ($staffPayroll->tds_deduction ?? 0);
                    @endphp
                    <tr class="fw-bold table-light">
                        <td>Total Deductions (B)</td>
                        <td class="text-end">₹{{ number_format($totDeductions, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Final Net Salary Payable Summary Box -->
    <div class="summary-box mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <div class="text-uppercase fw-semibold text-primary" style="font-size:0.75rem; letter-spacing:0.5px;">Net Salary Payable (A - B)</div>
            <h2 class="fw-bold text-primary mb-0">₹{{ number_format($staffPayroll->net_salary, 2) }}</h2>
        </div>
        <div class="text-end">
            <span class="text-muted small">Generated By:</span>
            <div class="fw-semibold text-dark">{{ $staffPayroll->generatedBy->name ?? 'System Administrator' }}</div>
        </div>
    </div>

    @if($staffPayroll->notes)
        <div class="mb-4">
            <div class="detail-label">Narration / Notes</div>
            <div class="text-muted small">{{ $staffPayroll->notes }}</div>
        </div>
    @endif

    <!-- Signatures -->
    <div class="d-flex justify-content-between align-items-center mt-5 pt-4">
        <div class="sig-line">Employee Signature</div>
        <div class="sig-line">Director / Warden Stamp</div>
    </div>
</div>

</body>
</html>
