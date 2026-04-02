<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal — {{ $student->institute->name ?? 'EduNex' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#6366F1">
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

        * {
            box-sizing: border-box;
        }

        html,
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */
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
            line-height: 1.1;
        }

        .nav-brand .brand-sub {
            font-size: 0.62rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-right .student-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--muted);
        }

        .nav-right .avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--indigo), var(--pink));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            color: #fff;
        }

        .notif-icon-btn {
            width: 36px;
            height: 36px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            font-size: 0.82rem;
            cursor: pointer;
            position: relative;
            text-decoration: none;
            transition: all .2s;
        }

        .notif-icon-btn:hover {
            background: var(--indigo);
            color: #fff;
            border-color: var(--indigo);
        }

        .notif-dot {
            position: absolute;
            top: -3px;
            right: -3px;
            width: 14px;
            height: 14px;
            background: var(--pink);
            border-radius: 50%;
            font-size: 0.58rem;
            color: #fff;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
        }

        .logout-btn {
            background: none;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 6px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .logout-btn:hover {
            border-color: var(--red);
            color: var(--red);
        }

        /* ── PAGE ── */
        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 28px 24px 60px;
        }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(135deg, #4F46E5, #7C3AED 55%, #EC4899);
            border-radius: var(--radius);
            padding: 30px 32px;
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -30px;
            width: 220px;
            height: 220px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: 180px;
            width: 180px;
            height: 180px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .hero .tag {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.85);
            border-radius: 50px;
            padding: 3px 12px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .hero h2 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .hero p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.87rem;
            margin: 0;
        }

        .hero .batch-badge {
            margin-top: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .hero-icon-bg {
            position: absolute;
            right: 32px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 7rem;
            color: rgba(255, 255, 255, 0.07);
        }

        /* ── STAT CARDS ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-hint {
            font-size: 0.75rem;
            color: var(--muted);
        }

        .prog {
            height: 5px;
            border-radius: 99px;
            background: #E2E8F0;
            overflow: hidden;
            margin-top: 10px;
        }

        .prog .fill {
            height: 100%;
            border-radius: 99px;
        }

        /* ── MAIN GRID ── */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .col-wide {
            grid-column: span 2;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr 1fr;
            }

            .col-wide {
                grid-column: span 2;
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .top-navbar {
                padding: 0 16px;
                height: 56px;
            }

            .nav-brand .brand-name {
                font-size: 0.82rem;
            }

            .nav-right .student-name {
                display: none;
            }

            .logout-btn span {
                display: none;
            }

            .page {
                padding: 16px 12px 60px;
            }

            .hero {
                padding: 22px 20px;
            }

            .hero h2 {
                font-size: 1.2rem;
            }

            .hero-icon-bg {
                font-size: 4rem;
                right: 16px;
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .main-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .col-wide {
                grid-column: span 1;
            }
        }

        /* ── CARD ── */
        .card-block {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-head {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-head h6 {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text);
            margin: 0;
        }

        .card-link {
            font-size: 0.72rem;
            color: var(--indigo);
            font-weight: 600;
            text-decoration: none;
        }

        .card-link:hover {
            text-decoration: underline;
        }

        /* ── BATCH INFO ── */
        .batch-info {
            background: linear-gradient(135deg, var(--indigo), #818CF8);
            border-radius: var(--radius);
            padding: 18px 20px;
            color: white;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
            overflow: hidden;
        }

        .batch-info::after {
            content: '';
            position: absolute;
            right: -20px;
            top: -20px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 50%;
        }

        .batch-ico {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .batch-info .b-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: .6;
        }

        .batch-info .b-name {
            font-size: 1rem;
            font-weight: 700;
            margin: 2px 0;
        }

        .batch-info .b-time {
            font-size: 0.75rem;
            opacity: .65;
        }

        /* ── LECTURES CTA ── */
        .lectures-cta {
            background: #0F172A;
            border-radius: var(--radius);
            padding: 18px 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .lectures-cta .lc-icon {
            width: 46px;
            height: 46px;
            background: rgba(99, 102, 241, 0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #818CF8;
            margin: 0 auto 10px;
        }

        .lectures-cta h6 {
            color: #fff;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .lectures-cta p {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            margin-bottom: 12px;
        }

        .btn-lectures {
            background: linear-gradient(135deg, var(--indigo), #818CF8);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 0;
            font-size: 0.8rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            text-decoration: none;
            display: block;
            transition: opacity .2s;
        }

        .btn-lectures:hover {
            opacity: .85;
            color: #fff;
        }

        /* ── LIST ITEMS ── */
        .list-item {
            padding: 13px 20px;
            border-bottom: 1px solid #F1F5F9;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .list-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--indigo);
            margin-top: 6px;
            flex-shrink: 0;
        }

        .item-title {
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--text);
            line-height: 1.3;
        }

        .item-sub {
            font-size: 0.72rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .item-due {
            font-size: 0.72rem;
            color: var(--red);
            font-weight: 500;
            margin-top: 2px;
        }

        /* ── TESTS ── */
        .tab-row {
            display: flex;
            gap: 6px;
            padding: 12px 20px 0;
        }

        .t-pill {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            border: 1px solid var(--border);
            background: none;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
        }

        .t-pill.active {
            background: var(--indigo);
            border-color: var(--indigo);
            color: #fff;
        }

        .t-pane {
            display: none;
        }

        .t-pane.active {
            display: block;
        }

        .test-row {
            padding: 12px 20px;
            border-bottom: 1px solid #F1F5F9;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .test-row:last-child {
            border-bottom: none;
        }

        .t-date {
            text-align: center;
            min-width: 38px;
        }

        .t-month {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--indigo);
        }

        .t-day {
            font-size: 1.2rem;
            font-weight: 800;
            line-height: 1;
            color: var(--text);
        }

        .t-name {
            font-size: 0.84rem;
            font-weight: 600;
        }

        .t-info {
            font-size: 0.7rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .t-score {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--indigo);
        }

        .t-total {
            font-size: 0.7rem;
            color: var(--muted);
        }

        /* ── PAYMENTS ── */
        .pay-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pay-table th {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
            font-weight: 600;
            padding: 12px 20px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            background: #F8FAFC;
        }

        .pay-table td {
            padding: 13px 20px;
            font-size: 0.82rem;
            border-bottom: 1px solid #F8FAFC;
            vertical-align: middle;
        }

        .pay-table tr:last-child td {
            border-bottom: none;
        }

        .pay-table tr:hover td {
            background: #FAFBFC;
        }

        .pay-name {
            font-weight: 600;
        }

        .pay-method {
            font-size: 0.68rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .pay-amt {
            font-weight: 700;
            font-variant-numeric: tabular-nums;
        }

        .badge-paid {
            background: #D1FAE5;
            color: #065F46;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 50px;
        }

        /* ── NOTIFICATIONS ── */
        .notif-row {
            padding: 13px 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-bottom: 1px solid #F1F5F9;
        }

        .notif-row:last-child {
            border-bottom: none;
        }

        .notif-ico {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(99, 102, 241, 0.1);
            color: var(--indigo);
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .notif-title {
            font-size: 0.82rem;
            font-weight: 600;
        }

        .notif-msg {
            font-size: 0.73rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .dismiss-btn {
            margin-left: auto;
            flex-shrink: 0;
            background: none;
            border: 1px solid var(--border);
            border-radius: 7px;
            padding: 3px 9px;
            font-size: 0.68rem;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
        }

        .dismiss-btn:hover {
            border-color: var(--emerald);
            color: var(--emerald);
        }

        /* ── EMPTY ── */
        .empty-box {
            text-align: center;
            padding: 30px 16px;
            color: var(--muted);
        }

        .empty-box i {
            font-size: 1.8rem;
            opacity: .25;
            display: block;
            margin-bottom: 8px;
        }

        .empty-box span {
            font-size: 0.8rem;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 960px) {
            .main-grid {
                grid-template-columns: 1fr 1fr;
            }

            .col-wide {
                grid-column: span 2;
            }

            .stats-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .col-wide {
                grid-column: span 1;
            }

            .stats-row {
                grid-template-columns: 1fr 1fr;
            }

            .hero h2 {
                font-size: 1.3rem;
            }

            .hero-icon-bg {
                display: none;
            }

            .top-navbar {
                padding: 0 16px;
            }

            .page {
                padding: 16px 14px 40px;
            }

            .nav-right .student-name {
                display: none;
            }
        }

        /* ── APP GRID DASHBOARD ── */
        .app-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .app-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .app-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-color: var(--indigo);
        }

        .app-card.active {
            border-color: var(--indigo);
            background: rgba(99, 102, 241, 0.02);
        }

        .app-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 12px;
        }

        .app-card-icon.bg-amber {
            background: rgba(245, 158, 11, 0.1);
            color: var(--amber);
        }

        .app-card-icon.bg-indigo {
            background: rgba(99, 102, 241, 0.1);
            color: var(--indigo);
        }

        .app-card-icon.bg-emerald {
            background: rgba(16, 185, 129, 0.1);
            color: var(--emerald);
        }

        .app-card-icon.bg-pink {
            background: rgba(236, 72, 153, 0.1);
            color: var(--pink);
        }

        .app-card-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .app-card-badge {
            font-size: 0.68rem;
            color: var(--muted);
            font-weight: 500;
        }

        /* ── ACTIVE SECTION SWAP ── */
        .app-section {
            display: none;
        }

        .app-section.active {
            display: block;
            animation: fadeIn .3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .app-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .app-card {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- ── TOP NAVBAR ── -->
    <header class="top-navbar">
        <a href="#" class="nav-brand">
            @if($student->institute && $student->institute->logo)
                <img src="{{ asset('storage/' . $student->institute->logo) }}" alt="Logo"
                    style="max-height: 40px; border-radius: 8px;">
            @else
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 40px; border-radius: 8px;">
            @endif
            <div>
                <div class="brand-name">{{ $student->institute->name ?? 'EduNex' }}</div>
                <div class="brand-sub">Student Portal</div>
            </div>
        </a>
        <div class="nav-right">
            @if($student->unreadNotifications->count() > 0)
                <a href="#notif-section" class="notif-icon-btn" title="Notifications">
                    <i class="fas fa-bell"></i>
                    <div class="notif-dot">{{ $student->unreadNotifications->count() }}</div>
                </a>
            @endif
            <a href="{{ route('student.fees.index') }}" class="notif-icon-btn d-none d-sm-flex" title="My Fees">
                <i class="fas fa-wallet"></i>
            </a>
            <a href="{{ route('student.lectures.index') }}" class="notif-icon-btn d-none d-sm-flex"
                title="Live Lectures">
                <i class="fas fa-video"></i>
            </a>
            <span class="student-name d-none d-sm-inline">{{ $student->name }}</span>
            <div class="avatar">{{ strtoupper(substr($student->name, 0, 2)) }}</div>
            <form method="POST" action="{{ route('student.logout') }}" style="margin:0;">
                @csrf
                <button class="logout-btn" type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </header>

    <!-- ── PAGE ── -->
    <div class="page">

        <!-- Hero Banner -->
        <div class="hero">
            <div class="tag">{{ now()->format('l, d M Y') }}</div>
            <h2>Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening') }},
                {{ explode(' ', $student->name)[0] }}! 👋
            </h2>
            <p>Here's an overview of your academics and activity.</p>
            @if($student->batch)
                <div class="batch-badge">
                    <i class="fas fa-users" style="font-size:0.7rem;opacity:.7;"></i>
                    <strong>{{ $student->batch->name }}</strong>
                    @if($student->batch->schedule_time)
                        &nbsp;·&nbsp; <i class="far fa-clock" style="font-size:0.7rem;opacity:.7;"></i>
                        {{ $student->batch->schedule_time }}
                    @endif
                </div>
            @endif
            <i class="fas fa-graduation-cap hero-icon-bg"></i>
        </div>

        <!-- App Grid Menu -->
        <div class="app-grid mb-4">
            <div class="app-card active" onclick="switchSection('homework', this)">
                <div class="app-card-icon bg-amber"><i class="fas fa-book-open"></i></div>
                <div class="app-card-title">Homework</div>
                <div class="app-card-badge">{{ $activeHomeworks->count() }} Active</div>
            </div>
            <div class="app-card" onclick="switchSection('lectures', this)">
                <div class="app-card-icon bg-indigo"><i class="fas fa-video"></i></div>
                <div class="app-card-title">Live Lectures</div>
                <div class="app-card-badge">View Library</div>
            </div>
            <div class="app-card" onclick="switchSection('fees', this)">
                <div class="app-card-icon bg-emerald"><i class="fas fa-wallet"></i></div>
                <div class="app-card-title">Fees Details</div>
                <div class="app-card-badge">Check Ledger</div>
            </div>
            <div class="app-card" onclick="switchSection('attendance', this)">
                <div class="app-card-icon bg-pink"><i class="fas fa-chart-pie"></i></div>
                <div class="app-card-title">Attendance</div>
                <div class="app-card-badge">{{ $attendancePercentage }}% Rate</div>
            </div>
            <div class="app-card" onclick="window.location.href='{{ route('student.leaves.index') }}'">
                <div class="app-card-icon bg-indigo"><i class="fas fa-calendar-minus"></i></div>
                <div class="app-card-title">Leave Request</div>
                <div class="app-card-badge">History & Apply</div>
            </div>
        </div>

        <!-- Notifications (if any) -->
        @if($student->unreadNotifications->count() > 0)
            <div class="card-block mb-0" id="notif-section" style="margin-bottom:20px;">
                <div class="card-head">
                    <h6><i class="fas fa-bell me-2" style="color:var(--pink);"></i>Notifications</h6>
                    <span style="font-size:0.7rem;color:var(--muted);">{{ $student->unreadNotifications->count() }}
                        unread</span>
                </div>
                @foreach($student->unreadNotifications as $notification)
                    <div class="notif-row">
                        <div class="notif-ico"><i class="{{ $notification->data['icon'] ?? 'fas fa-info-circle' }}"></i></div>
                        <div style="flex:1;">
                            <div class="notif-title">{{ $notification->data['title'] }}</div>
                            <div class="notif-msg">{{ $notification->data['message'] }}</div>
                        </div>
                        <form action="{{ route('student.notifications.read', $notification->id) }}" method="POST">
                            @csrf
                            <button class="dismiss-btn" type="submit"><i class="fas fa-check me-1"></i>Dismiss</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Switchable Detail Sections -->
        <div class="app-section active" id="sec-homework">
            <div class="card-block">
                <div class="card-head">
                    <h6>Current Assignments</h6>
                </div>
                @forelse($activeHomeworks as $hw)
                    <div class="list-item">
                        <div class="list-dot"></div>
                        <div style="width: 100%;">
                            <div class="item-title">{{ $hw->title }}</div>
                            <div class="item-due"><i class="far fa-clock me-1"></i>Due {{ $hw->due_date->format('M d, Y') }}
                            </div>
                            @if($hw->description)
                                <div class="item-sub mb-2">{{ Str::limit($hw->description, 100) }}</div>
                            @endif
                            @if($hw->attachments && $hw->attachments->count() > 0)
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach($hw->attachments as $attachment)
                                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="text-decoration-none" style="background:#F1F5F9; border:1px solid #E2E8F0; padding:4px 10px; border-radius:6px; font-size:0.7rem; color:#4F46E5; font-weight:600;">
                                            <i class="fas fa-paperclip me-1"></i> View Attachment
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-box"><i class="fas fa-check-circle"
                            style="color:var(--emerald);opacity:.4;"></i><span>No active assignments</span></div>
                @endforelse
            </div>
        </div>

        <div class="app-section" id="sec-lectures">
            <div class="batch-info">
                <div class="batch-ico"><i class="fas fa-users"></i></div>
                <div>
                    <div class="b-label">Your Batch</div>
                    <div class="b-name">{{ $student->batch->name ?? 'Not Assigned' }}</div>
                    <div class="b-time"><i
                            class="far fa-clock me-1"></i>{{ $student->batch->schedule_time ?? 'Schedule pending' }}
                    </div>
                </div>
            </div>
            <div class="lectures-cta">
                <div class="lc-icon"><i class="fas fa-video"></i></div>
                <h6>Live Lecture Library</h6>
                <p>Access recordings and join live sessions for your batch.</p>
                <a href="{{ route('student.lectures.index') }}" class="btn-lectures">
                    <i class="fas fa-play-circle me-1"></i> View Lectures
                </a>
            </div>
        </div>

        <div class="app-section" id="sec-fees">
            <div class="card-block mb-3 p-3 bg-primary bg-opacity-10 border-0 rounded-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1 fw-bold text-primary">Manage Your Fees</h6>
                        <p class="text-muted small mb-0">Check due amounts or pay online.</p>
                    </div>
                    <a href="{{ route('student.fees.index') }}" class="btn btn-primary rounded-pill px-3 shadow-sm" style="font-size:0.8rem; font-weight:600;">
                        <i class="fas fa-credit-card me-1"></i> Pay Now
                    </a>
                </div>
            </div>

            <div class="card-block">
                <div class="card-head">
                    <h6>Recent Fee Transactions</h6>
                </div>
                <table class="pay-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPayments as $payment)
                            <tr>
                                <td style="color:var(--muted);">{{ $payment->payment_date->format('M d, Y') }}</td>
                                <td>
                                    <div class="pay-name">{{ $payment->feeStructure->name ?? 'General Fee' }}</div>
                                </td>
                                <td class="pay-amt">₹{{ number_format($payment->amount_paid, 2) }}</td>
                                <td><span class="badge-paid">Paid</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-box"><i class="fas fa-receipt"></i><span>No payment records</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-section" id="sec-attendance">
            <div class="card-block">
                <div class="card-head">
                    <h6>Attendance Report</h6>
                </div>
                <div class="p-4 text-center">
                    <h2 style="font-size:3rem; font-weight:800; color:var(--indigo);">{{ $attendancePercentage }}%</h2>
                    <p class="text-muted small">You attended {{ $presentClasses }} out of {{ $totalClasses }} classes
                    </p>
                    <div class="progress" style="height:10px; border-radius:50px;">
                        <div class="progress-bar bg-indigo" style="width: {{ $attendancePercentage }}%"></div>
                    </div>
                </div>
            </div>
        </div><!-- /main-grid -->
    </div><!-- /page -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchTab(tab, btn) {
            document.querySelectorAll('.t-pane').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.t-pill').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + tab).classList.add('active');
            btn.classList.add('active');
        }

        function switchSection(sectionId, btn) {
            document.querySelectorAll('.app-section').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.app-card').forEach(b => b.classList.remove('active'));
            document.getElementById('sec-' + sectionId).classList.add('active');
            btn.classList.add('active');
        }

        // Animate progress bars
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.prog .fill').forEach(function (el) {
                const w = el.style.width;
                el.style.width = '0';
                setTimeout(() => { el.style.width = w; }, 150);
            });
        });

        // PWA
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => navigator.serviceWorker.register('/sw.js'));
        }
    </script>
</body>

</html>