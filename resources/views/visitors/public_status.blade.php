<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status - {{ $visitor->pass_number }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563EB;
            --success-color: #10B981;
            --danger-color: #EF4444;
            --bg-color: #F8FAFC;
            --text-main: #0F172A;
            --text-muted: #64748B;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 10px;
        }

        .status-container {
            width: 100%;
            max-width: 480px;
            background-color: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.02);
            overflow: hidden;
            text-align: center;
            padding: 40px 24px;
        }

        /* Spinner Animations */
        .spinner-outer {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px auto;
            position: relative;
        }

        .spinner-pending {
            border: 5px solid rgba(37, 99, 235, 0.1);
            border-top: 5px solid var(--primary-color);
            animation: spin 1.5s linear infinite;
        }

        .spinner-approved {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            font-size: 2.2rem;
            animation: scaleUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .spinner-rejected {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            font-size: 2.2rem;
            animation: scaleUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes scaleUp {
            from { transform: scale(0.6); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .detail-box {
            background-color: #F1F5F9;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            text-align: left;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(0,0,0,0.03);
            padding-bottom: 8px;
        }
        .detail-item:last-child {
            margin-bottom: 0;
            border-bottom: 0;
            padding-bottom: 0;
        }

        .detail-label {
            color: var(--text-muted);
            font-weight: 500;
        }
        .detail-val {
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .badge-pending {
            background-color: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.05);
        }

        .badge-approved {
            background-color: rgba(16, 185, 129, 0.15);
            color: var(--success-color);
        }

        .badge-rejected {
            background-color: rgba(239, 68, 68, 0.15);
            color: var(--danger-color);
        }

        .btn-pass {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 14px 28px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s ease;
        }
        .btn-pass:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="status-container">
    <!-- Status Icon/Spinner -->
    <div id="statusIcon" class="spinner-outer spinner-pending"></div>

    <!-- Status Badge -->
    <div id="statusBadge" class="status-badge badge-pending">
        Pending Approval
    </div>

    <!-- Message text -->
    <h4 id="statusTitle" class="fw-bold mb-2">Awaiting Approval</h4>
    <p id="statusDesc" class="text-secondary small mb-4 px-3">
        Your check-in details have been sent. Please wait at the gate/desk while the security receptionist reviews your request.
    </p>

    <!-- Details Card -->
    <div class="detail-box">
        <div class="detail-item">
            <span class="detail-label">Pass Reference</span>
            <span class="detail-val text-primary">{{ $visitor->pass_number }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Visitor Name</span>
            <span class="detail-val">{{ $visitor->visitor_name }}</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Whom to Meet</span>
            <span class="detail-val text-truncate" style="max-width: 200px;">
                @if($visitor->whomToMeet)
                    {{ $visitor->whomToMeet->name }}
                @else
                    {{ $visitor->whom_to_meet_name }}
                @endif
            </span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Purpose</span>
            <span class="detail-val">{{ $visitor->purpose }}</span>
        </div>
    </div>

    <!-- Dynamic Actions Area -->
    <div id="actionArea">
        <div class="text-muted small">
            <i class="fas fa-sync fa-spin me-2 text-primary"></i>Checking approval status live...
        </div>
    </div>
</div>

<script>
const visitorId = {{ $visitor->id }};
const checkUrl = "{{ route('visitors.check-status', $visitor->id) }}";
const passUrl = "{{ route('visitors.pass', $visitor->id) }}";

let pollInterval = setInterval(checkVisitorStatus, 3000);

function checkVisitorStatus() {
    fetch(checkUrl)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'checked_in') {
                clearInterval(pollInterval);
                updateToApproved();
            } else if (data.status === 'rejected') {
                clearInterval(pollInterval);
                updateToRejected();
            }
        })
        .catch(err => console.error("Error checking visitor status:", err));
}

function updateToApproved() {
    const icon = document.getElementById('statusIcon');
    icon.className = "spinner-outer spinner-approved";
    icon.innerHTML = '<i class="fas fa-check"></i>';

    const badge = document.getElementById('statusBadge');
    badge.className = "status-badge badge-approved";
    badge.textContent = "Approved";

    document.getElementById('statusTitle').textContent = "Access Approved!";
    document.getElementById('statusDesc').innerHTML = "Your entry pass has been authorized. You may now enter the premises. <strong>Click below to open your gate pass pass.</strong>";

    document.getElementById('actionArea').innerHTML = `
        <a href="${passUrl}" target="_blank" class="btn-pass">
            <i class="fas fa-id-card"></i> View Gate Pass
        </a>
    `;
}

function updateToRejected() {
    const icon = document.getElementById('statusIcon');
    icon.className = "spinner-outer spinner-rejected";
    icon.innerHTML = '<i class="fas fa-times"></i>';

    const badge = document.getElementById('statusBadge');
    badge.className = "status-badge badge-rejected";
    badge.textContent = "Declined";

    document.getElementById('statusTitle').textContent = "Entry Request Declined";
    document.getElementById('statusDesc').textContent = "Your entry request has been declined. Please contact the security desk for more details.";

    document.getElementById('actionArea').innerHTML = `
        <div class="text-danger fw-bold"><i class="fas fa-times-circle me-1"></i> Access Denied</div>
    `;
}
</script>

</body>
</html>
