<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management — EduNex</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --indigo: #6366F1;
            --indigo-dark: #4F46E5;
            --pink: #EC4899;
            --emerald: #10B981;
            --amber: #F59E0B;
            --red: #EF4444;
            --bg: #F1F5F9;
            --card: #ffffff;
            --border: #E2E8F0;
            --text: #0F172A;
            --muted: #64748B;
            --radius: 16px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        .top-navbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-brand .brand-badge {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--indigo), var(--pink));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 800;
            color: #fff;
        }

        .nav-brand .brand-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 28px 24px 60px;
        }

        .card-block {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .btn-apply {
            background: linear-gradient(135deg, var(--indigo), #818CF8);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .btn-apply:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.3);
        }

        .status-badge {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending { background: #FEF3C7; color: #92400E; }
        .status-approved { background: #D1FAE5; color: #065F46; }
        .status-rejected { background: #FEE2E2; color: #991B1B; }

        .leave-item {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            transition: background 0.2s;
        }

        .leave-item:last-child { border-bottom: none; }
        .leave-item:hover { background: #FAFBFC; }

        .leave-type { font-weight: 700; font-size: 1rem; color: var(--text); }
        .leave-date { font-size: 0.85rem; color: var(--muted); margin-top: 4px; }
        .leave-reason { font-size: 0.88rem; color: var(--text); margin-top: 8px; opacity: 0.8; }
        
        .rejection-note {
            background: #FFF1F2;
            border: 1px solid #FECDD3;
            padding: 10px 15px;
            border-radius: 10px;
            margin-top: 12px;
            font-size: 0.8rem;
            color: #BE123C;
        }

        @media (max-width: 640px) {
            .page { padding: 16px 12px 60px; }
            .header-section { flex-direction: column; align-items: stretch; gap: 16px; }
            .top-navbar { padding: 0 16px; }
        }
    </style>
</head>
<body>
    <nav class="top-navbar">
        <a href="{{ route('student.dashboard') }}" class="nav-brand">
            <div class="brand-badge text-uppercase">EN</div>
            <div class="brand-name">EDUNEX <span class="d-block d-sm-inline" style="font-size: 0.7rem; opacity: 0.6;">STUDENT PORTAL</span></div>
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('student.dashboard') }}" class="text-muted text-decoration-none small fw-bold">DASHBOARD</a>
            <form action="{{ route('student.logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger border-0 fw-bold">LOGOUT</button>
            </form>
        </div>
    </nav>

    <div class="page">
        <div class="header-section">
            <div>
                <h4 class="fw-bold mb-1">Leave History</h4>
                <p class="text-muted small mb-0">Track and manage your leave applications.</p>
            </div>
            <a href="{{ route('student.leaves.create') }}" class="btn-apply text-center">
                <i class="fas fa-plus me-2"></i> Apply for Leave
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card-block">
            @forelse($leaves as $leave)
                <div class="leave-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="leave-type">{{ $leave->type }}</div>
                            <div class="leave-date">
                                <i class="far fa-calendar-alt me-1"></i> 
                                {{ $leave->start_date->format('d M Y') }} - {{ $leave->end_date->format('d M Y') }}
                                <span class="mx-1 text-muted">•</span>
                                <span class="fw-bold" style="color: var(--indigo);">{{ $leave->start_date->diffInDays($leave->end_date) + 1 }} Days</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            @if($leave->canBeWithdrawnByApplicant())
                                <form action="{{ route('student.leaves.revert', $leave->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none p-0 fw-bold shadow-none" style="font-size: 0.75rem;" onclick="return confirm('Withdraw your leave request?')">
                                        <i class="fas fa-undo me-1"></i> WITHDRAW
                                    </button>
                                </form>
                            @endif
                            <span class="status-badge status-{{ $leave->status }}">
                                {{ $leave->status }}
                            </span>
                        </div>
                    </div>
                    <div class="leave-reason">{{ $leave->reason }}</div>
                    
                    @if($leave->status === 'rejected' && $leave->rejection_reason)
                        <div class="rejection-note">
                            <i class="fas fa-info-circle me-1"></i> <strong>Rejection Reason:</strong> {{ $leave->rejection_reason }}
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="mb-3 opacity-25">
                        <i class="fas fa-calendar-minus fa-4x"></i>
                    </div>
                    <h6 class="fw-bold text-muted">No Leave Records Found</h6>
                    <p class="small text-muted">When you apply for a leave, it will appear here.</p>
                </div>
            @endforelse
        </div>

        @if($leaves->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $leaves->links() }}
            </div>
        @endif
    </div>
</body>
</html>
