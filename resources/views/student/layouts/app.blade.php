<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Portal') — {{ auth()->guard('student')->user()->institute->name ?? 'EduNex' }}
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
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

        .notif-icon-btn,
        .nav-icon-btn {
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

        .notif-icon-btn:hover,
        .nav-icon-btn:hover {
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
        }
    </style>
    @stack('styles')
</head>

<body>

    @php
        $student = auth()->guard('student')->user();
    @endphp

    <!-- ── TOP NAVBAR ── -->
    <header class="top-navbar">
        <a href="{{ route('student.dashboard') }}" class="nav-brand">
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
            @if($student->unreadNotifications && $student->unreadNotifications->count() > 0)
                <a href="{{ route('student.dashboard') }}#notif-section" class="notif-icon-btn" title="Notifications">
                    <i class="fas fa-bell"></i>
                    <div class="notif-dot">{{ $student->unreadNotifications->count() }}</div>
                </a>
            @endif
            <a href="{{ route('student.fees.index') }}"
                class="nav-icon-btn d-none d-sm-flex {{ request()->routeIs('student.fees.*') ? 'bg-indigo text-white border-indigo' : '' }}"
                title="My Fees"
                style="{{ request()->routeIs('student.fees.*') ? 'background:var(--indigo);color:#fff;border-color:var(--indigo);' : '' }}">
                <i class="fas fa-wallet"></i>
            </a>
            <a href="{{ route('student.lectures.index') }}"
                class="nav-icon-btn d-none d-sm-flex {{ request()->routeIs('student.lectures.*') ? 'bg-indigo text-white border-indigo' : '' }}"
                title="Live Lectures"
                style="{{ request()->routeIs('student.lectures.*') ? 'background:var(--indigo);color:#fff;border-color:var(--indigo);' : '' }}">
                <i class="fas fa-video"></i>
            </a>
            <span class="student-name d-none d-sm-inline">{{ $student->name }}</span>
            <div class="avatar">{{ strtoupper(substr($student->name, 0, 2)) }}</div>
            <form method="POST" action="{{ route('student.logout') }}" style="margin:0;">
                @csrf
                <button class="logout-btn" type="submit"><i class="fas fa-sign-out-alt"></i> <span
                        class="d-none d-sm-inline">Logout</span></button>
            </form>
        </div>
    </header>

    <!-- ── PAGE ── -->
    <div class="page">
        @yield('content')
    </div><!-- /page -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>