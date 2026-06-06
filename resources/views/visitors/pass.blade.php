<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Gate Pass - {{ $visitor->pass_number }}</title>
    <!-- Inter Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F1F5F9;
            color: #1E293B;
            padding: 40px 20px;
        }
        .badge-container {
            max-width: 440px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid #E2E8F0;
            overflow: hidden;
            position: relative;
        }
        .badge-header {
            background: linear-gradient(135deg, #1D4ED8, #2563EB);
            color: #FFFFFF;
            padding: 24px;
            text-align: center;
        }
        .badge-tag {
            background-color: #EF4444;
            color: #FFFFFF;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 2px;
            font-weight: 800;
            padding: 6px 16px;
            border-radius: 50px;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }
        .qr-wrapper {
            text-align: center;
            padding: 24px 0;
            background-color: #FAFAFA;
            border-bottom: 1px dashed #E2E8F0;
        }
        .qr-image {
            border: 8px solid #FFFFFF;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            border-radius: 12px;
        }
        .badge-details {
            padding: 24px;
        }
        .detail-item {
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #F1F5F9;
            padding-bottom: 8px;
        }
        .detail-item:last-child {
            margin-bottom: 0;
            border-bottom: 0;
            padding-bottom: 0;
        }
        .detail-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            color: #64748B;
        }
        .detail-value {
            font-size: 0.85rem;
            font-weight: 600;
            color: #0F172A;
            text-align: right;
        }
        .badge-footer {
            background-color: #F8FAFC;
            padding: 20px;
            text-align: center;
            font-size: 0.75rem;
            color: #64748B;
            border-top: 1px solid #E2E8F0;
            font-weight: 500;
        }
        @media print {
            body {
                background-color: #FFFFFF;
                padding: 0;
            }
            .badge-container {
                box-shadow: none;
                border: 2px solid #000000;
                margin-top: 20px;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

<div class="container no-print mb-4 d-flex justify-content-between align-items-center" style="max-width: 440px;">
    <a href="{{ route('visitors.index') }}" class="btn btn-outline-secondary rounded-pill px-3.5"><i class="fas fa-arrow-left me-2"></i>Logs Register</a>
    <button onclick="window.print()" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="fas fa-print me-2"></i>Print Badge</button>
</div>

<div class="badge-container">
    <!-- Header -->
    <div class="badge-header">
        <h5 class="fw-bold mb-1" style="font-size:1.15rem; letter-spacing:0.5px;">{{ $visitor->institute->name ?? 'Apex Institute' }}</h5>
        <div class="text-white-50 small mb-3">Gate Access Credential</div>
        <span class="badge-tag">Visitor Pass</span>
    </div>

    <!-- QR Code Mockup -->
    <div class="qr-wrapper">
        <img class="qr-image" src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&data={{ $visitor->pass_number }}" alt="QR Code" width="140" height="140">
        <div class="fw-bold text-dark mt-2" style="font-size:1.1rem; letter-spacing:0.5px;">{{ $visitor->pass_number }}</div>
    </div>

    <!-- Details -->
    <div class="badge-details">
        <div class="detail-item">
            <span class="detail-label">Name</span>
            <span class="detail-value text-dark fw-bold">{{ $visitor->visitor_name }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Phone</span>
            <span class="detail-value">{{ $visitor->phone_number }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Meeting Host</span>
            <span class="detail-value">
                @if($visitor->whomToMeet)
                    {{ $visitor->whomToMeet->name }} ({{ $visitor->whomToMeet->role->name }})
                @else
                    {{ $visitor->whom_to_meet_name ?: 'Generic Meet' }}
                @endif
            </span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Purpose</span>
            <span class="detail-value">{{ $visitor->purpose }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Gate Point</span>
            <span class="detail-value">{{ $visitor->gate_number }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Vehicle</span>
            <span class="detail-value">{{ $visitor->vehicle_number ?: 'N/A' }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Check-In</span>
            <span class="detail-value">{{ $visitor->check_in_time->format('h:i A, d M Y') }}</span>
        </div>
    </div>

    <!-- Footer instructions -->
    <div class="badge-footer">
        <i class="fas fa-exclamation-triangle text-danger me-1"></i> Please wear this badge visibly at all times. Return to main security gate upon exit check-out.
    </div>
</div>

</body>
</html>
