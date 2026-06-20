<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Portal') — {{ auth()->guard('student')->user()->institute->name ?? 'EduNex ERP' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <meta name="theme-color" content="#0EA5E9">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --indigo: #6366F1;
            --indigo-dark: #4F46E5;
            --teal: #0D9488;
            --pink: #EC4899;
            --emerald: #10B981;
            --amber: #F59E0B;
            --red: #EF4444;
            --sky: #0EA5E9;
            --bg: #F8FAFC;
            --card: #ffffff;
            --border: #E8EDF5;
            --text: #0F172A;
            --muted: #64748B;
            --radius: 16px;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── DASHBOARD NAVBAR ── */
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

        .nav-brand .brand-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text);
            line-height: 1.1;
        }

        .nav-brand .brand-sub {
            font-size: 0.65rem;
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
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text);
        }

        .nav-right .avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--indigo), var(--pink));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: #fff;
        }

        .notif-icon-btn {
            width: 38px;
            height: 38px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            font-size: 0.9rem;
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
            top: -4px;
            right: -4px;
            width: 16px;
            height: 16px;
            background: var(--red);
            border-radius: 50%;
            font-size: 0.6rem;
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
        }

        .logout-btn {
            background: none;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 0.8rem;
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

        /* ── SUBPAGE NAVBAR (Lectures Style) ── */
        .subpage-navbar {
            background: #ffffff !important;
            border-bottom: 1px solid rgba(37, 99, 235, 0.08);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 28px 24px 60px;
        }

        @media (max-width: 640px) {
            .top-navbar { padding: 0 16px; height: 60px; }
            .nav-brand .brand-name { font-size: 0.85rem; }
            .nav-right .student-name { display: none; }
            .logout-btn span { display: none; }
            .page { padding: 16px 12px 60px; }
        }

        /* Global button styles */
        .btn-primary {
            background: linear-gradient(135deg, #6366F1, #4F46E5) !important;
            color: #fff !important;
            border-color: #6366F1 !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 12px rgba(99,102,241,0.25) !important;
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background: linear-gradient(135deg, #4F46E5, #4338CA) !important;
            border-color: #4F46E5 !important;
            box-shadow: 0 6px 16px rgba(99,102,241,0.35) !important;
        }
        .btn-success {
            background: linear-gradient(135deg, #10B981, #059669) !important;
            color: #fff !important;
            border-color: #10B981 !important;
            font-weight: 600 !important;
        }
        .btn-outline-primary {
            color: #6366F1 !important;
            border-color: #6366F1 !important;
            background-color: transparent !important;
            font-weight: 600 !important;
        }
        .btn-outline-primary:hover {
            background-color: #6366F1 !important;
            color: #fff !important;
        }
    </style>
    @stack('styles')
</head>

<body>

    @php
        $student = auth()->guard('student')->user();
    @endphp

    @if(request()->routeIs('student.dashboard'))
        <!-- ── DASHBOARD NAVBAR ── -->
        <header class="top-navbar">
            <a href="{{ route('student.dashboard') }}" class="nav-brand">
                @if($student->institute && $student->institute->logo)
                    <img src="{{ asset('storage/' . $student->institute->logo) }}" alt="Logo"
                        style="max-height: 40px; border-radius: 8px;">
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 40px; border-radius: 8px;">
                @endif
                <div>
                    <div class="brand-name">{{ $student->institute->name ?? 'EduNex ERP' }}</div>
                    <div class="brand-sub">Student Portal</div>
                </div>
            </a>
            <div class="nav-right">
                <a href="{{ route('student.notifications.index') }}" class="notif-icon-btn" title="Notifications">
                    <i class="fas fa-bell"></i>
                    @if($student->unreadNotifications && $student->unreadNotifications->count() > 0)
                        <div class="notif-dot">{{ $student->unreadNotifications->count() }}</div>
                    @endif
                </a>
                
                <a href="{{ route('student.profile.edit') }}" style="text-decoration: none;" class="d-flex align-items-center gap-2">
                    <span class="student-name d-none d-sm-inline">{{ $student->name }}</span>
                    <div class="avatar">{{ strtoupper(substr($student->name, 0, 2)) }}</div>
                </a>
                <form method="POST" action="{{ route('student.logout') }}" style="margin:0;">
                    @csrf
                    <button class="logout-btn" type="submit"><i class="fas fa-sign-out-alt"></i> <span
                            class="d-none d-sm-inline">Logout</span></button>
                </form>
            </div>
        </header>
    @else
        <!-- ── SUBPAGE NAVBAR ── -->
        <nav class="subpage-navbar">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('student.dashboard') }}" class="btn btn-light rounded-pill px-4 shadow-sm border">
                        <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
                    </a>
                    <div class="d-flex align-items-center">
                        <span class="me-3 d-flex align-items-center">
                            <i class="fas fa-user-circle me-2 fs-4" style="color: #2563EB;"></i>
                            <span class="fw-semibold" style="color: #1E293B;">{{ $student->name }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </nav>
    @endif

    <!-- ── PAGE ── -->
    <div class="page">
        @yield('content')
    </div><!-- /page -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>