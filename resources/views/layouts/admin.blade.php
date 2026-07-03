<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EduNex ERP') - Dashboard</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        :root {
            /* ── Brand Tokens ── */
            --primary:       #0D9488;  /* teal-600 */
            --primary-hover: #0F766E;  /* teal-700 */
            --primary-light: rgba(13,148,136,0.12);
            --blue:          #2563EB;
            --blue-light:    rgba(37,99,235,0.10);
            --amber:         #F59E0B;
            --emerald:       #10B981;
            --red:           #EF4444;
            --sky:           #0EA5E9;

            /* ── Surfaces ── */
            --bg:            #F1F5F9;  /* slate-100 */
            --sidebar-bg:    #0F172A;  /* slate-900 */
            --card:          #FFFFFF;
            --border:        #E2E8F0;  /* slate-200 */
            --border-dark:   #CBD5E1;

            /* ── Text ── */
            --text-primary:  #0A0F1E;
            --text-secondary:#1E293B;
            --text-muted:    #475569;

            /* ── Legacy compat ── */
            --primary-color: #0D9488;
            --secondary-color: #10B981;
            --dark-bg: #0F172A;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: #0A0F1E;
            overflow-x: hidden;
        }
        p, span, div, td, th, li, label, input, select, textarea { color: inherit; }
        .text-muted { color: #475569 !important; }
        .text-secondary { color: #334155 !important; }
        small, .small { color: #334155; }

        /* ── Sidebar ── */
        .sidebar {
            height: 100vh;
            overflow-y: auto;
            background-color: #FFFFFF;
            border-right: 1px solid #E8EDF5;
            padding-top: 0;
            box-shadow: 2px 0 16px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1040;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb {
            background: #E2E8F0;
            border-radius: 10px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #CBD5E1;
        }

        .sidebar-brand-container {
            padding: 22px 20px 20px;
            border-bottom: 1px solid #F1F5F9;
            position: relative;
        }

        .sidebar-logo-badge {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg,#2563EB,#0D9488);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: #fff;
            box-shadow: 0 2px 8px rgba(37,99,235,0.2);
            flex-shrink: 0;
        }

        .sidebar-brand-name {
            font-size: 0.88rem;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.2px;
            line-height: 1.2;
        }

        .sidebar-brand-subtitle {
            font-size: 0.58rem;
            color: #94A3B8;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            margin-top: 2px;
        }

        .sidebar-header {
            font-size: 9.5px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 4px;
            margin-top: 22px;
            color: #64748B;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar-header::after {
            content: '';
            flex-grow: 1;
            height: 1px;
            background: #F1F5F9;
            margin-right: 4px;
        }

        .sidebar a {
            color: #1E293B;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 9px 14px;
            margin: 1px 10px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.83rem;
            position: relative;
            transition: all 0.18s ease;
            border: 1px solid transparent;
        }

        .sidebar a i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            font-size: 0.9rem;
            color: #475569;
            transition: all 0.18s;
            flex-shrink: 0;
        }

        .sidebar a:hover {
            background-color: #F8FAFC;
            color: #0F172A;
        }

        .sidebar a:hover i {
            color: #64748B;
        }

        .sidebar a.active {
            background: linear-gradient(135deg,#EFF6FF,#F0FDFA);
            color: #0D9488;
            font-weight: 700;
            border: 1px solid #CCFBF1;
            border-left: 3px solid #0D9488;
            border-radius: 0 10px 10px 0;
            margin-left: 0;
            padding-left: 21px;
        }

        .sidebar a.active i {
            color: #0D9488;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.35);
            backdrop-filter: blur(2px);
            z-index: 1030;
        }
        .sidebar-overlay.show { display: block; }

        @media (max-width: 767.98px) {
            .sidebar { position: fixed; left: -280px; width: 280px; }
            .sidebar.show { left: 0; }
        }

        /* ── Main Content ── */
        .main-content {
            padding: 28px 32px;
            position: relative;
            z-index: 1;
        }
        @media (max-width: 767.98px) { .main-content { padding: 16px; } }

        /* Subtle background texture */
        .bg-map {
            position: fixed;
            top: -20vh; right: -20vw;
            width: 55vw; height: 55vh;
            background: radial-gradient(circle, rgba(13,148,136,0.04), transparent 65%);
            z-index: 0;
            pointer-events: none;
        }

        /* ── Top Navbar ── */
        .top-navbar {
            background: #ffffff !important;
            border-bottom: 1px solid var(--border);
            padding: 14px 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        @media (max-width: 767.98px) { .top-navbar { padding: 12px 16px; } }

        .navbar-brand-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--text-primary);
            letter-spacing: -0.2px;
        }

        .user-profile {
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--text-secondary);
            background: #F8FAFC;
            padding: 7px 14px;
            border-radius: 50px;
            border: 1px solid var(--border);
        }

        /* ── Cards ── */
        .card {
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 4px 16px rgba(0,0,0,0.04);
            transition: box-shadow 0.25s ease, transform 0.25s ease;
            background: #ffffff;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08), 0 12px 32px rgba(0,0,0,0.06);
            transform: translateY(-2px);
        }

        .icon-box {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--sky));
            box-shadow: 0 4px 12px rgba(13,148,136,0.25);
            flex-shrink: 0;
        }

        /* ── Buttons ── */
        .btn-modern { border-radius: 50px; padding: 8px 24px; font-weight: 600; }

        /* ── Sidebar Dropdowns ── */
        .sidebar a[data-bs-toggle="collapse"] { position: relative; }
        .sidebar a[data-bs-toggle="collapse"] .dropdown-arrow {
            transition: transform 0.2s ease;
            font-size: 0.68rem;
            color: #475569;
        }
        .sidebar a[data-bs-toggle="collapse"]:not(.collapsed) .dropdown-arrow {
            transform: rotate(180deg);
            color: #94A3B8;
        }
        .sidebar .collapse {
            position: relative;
            padding-left: 6px;
            margin-left: 24px;
            border-left: 2px solid #F1F5F9;
            margin-bottom: 4px;
            margin-top: 2px;
        }
        .sidebar .collapse a {
            margin: 1px 8px 1px 0 !important;
            font-size: 0.79rem !important;
            padding: 7px 10px !important;
            color: #334155 !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            border: none !important;
        }
        .sidebar .collapse a:hover {
            background-color: #F8FAFC !important;
            color: #0F172A !important;
            padding-left: 14px !important;
        }
        .sidebar .collapse a.active {
            background: #F0FDFA !important;
            color: #0D9488 !important;
            border-left: none !important;
            padding-left: 10px !important;
            border-radius: 8px !important;
            margin-left: 0 !important;
        }
        .sidebar .collapse a i { color: #64748B !important; font-size: 0.78rem !important; }
        .sidebar .collapse a:hover i { color: #64748B !important; }
        .sidebar .collapse a.active i { color: #0D9488 !important; }

        /* ── Global Buttons ── */
        .btn-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #fff !important;
            font-weight: 600 !important;
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: var(--primary-hover) !important;
            border-color: var(--primary-hover) !important;
            box-shadow: 0 4px 12px rgba(13,148,136,0.3) !important;
        }
        .btn-success {
            background-color: #059669 !important;
            border-color: #059669 !important;
            color: #fff !important;
            font-weight: 600 !important;
        }
        .btn-success:hover, .btn-success:focus {
            background-color: #047857 !important;
            border-color: #047857 !important;
        }
        .btn-outline-primary {
            color: var(--primary) !important;
            border-color: var(--primary) !important;
            background-color: transparent !important;
            font-weight: 600 !important;
        }
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background-color: var(--primary-light) !important;
            color: var(--primary) !important;
        }
        .btn-outline-success {
            color: #059669 !important;
            border-color: #059669 !important;
            background-color: transparent !important;
            font-weight: 600 !important;
        }
        .btn-outline-success:hover {
            background-color: rgba(5,150,105,0.1) !important;
        }
        .btn-outline-danger {
            color: var(--red) !important;
            border-color: rgba(239,68,68,0.4) !important;
            background: transparent !important;
            font-weight: 600 !important;
        }
        .btn-outline-danger:hover {
            background: rgba(239,68,68,0.08) !important;
            border-color: var(--red) !important;
        }

        /* ── Table enhancements ── */
        .table { --bs-table-hover-bg: rgba(13,148,136,0.04); }
        .table thead th { font-size: 0.68rem; font-weight: 700; letter-spacing: 0.6px; color: var(--text-muted); text-transform: uppercase; border-color: var(--border) !important; }
        .table-light { background-color: #F8FAFC !important; --bs-table-bg: #F8FAFC; }

        /* ── Badge refinements ── */
        .badge { font-weight: 600; letter-spacing: 0.2px; }

        /* ── Page header ── */
        .page-header {
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }
        .page-header-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.4px;
        }
        .page-header-subtitle {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* ── KPI Card specific ── */
        .kpi-card { overflow: hidden; position: relative; }
        .kpi-icon-wrap {
            width: 42px; height: 42px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
        }
        .kpi-value {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--text-primary);
            letter-spacing: -1px;
            line-height: 1;
        }
        .kpi-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
            color: var(--text-muted);
        }
        .kpi-trend {
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 2px 7px;
            border-radius: 20px;
        }
        .kpi-trend.up { color: #059669; background: rgba(5,150,105,0.1); }
        .kpi-trend.down { color: var(--red); background: rgba(239,68,68,0.1); }
        .kpi-trend.neutral { color: #0EA5E9; background: rgba(14,165,233,0.1); }
        .kpi-sparkline { opacity: 0.5; margin-top: 8px; }

        /* ── Chart card header ── */
        .chart-card-header {
            padding: 20px 24px 0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .chart-card-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-primary);
        }
        .chart-card-subtitle {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* ── Section label ── */
        .section-label {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 12px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── Scrollbar for content area ── */
        .col-lg-10::-webkit-scrollbar { width: 6px; }
        .col-lg-10::-webkit-scrollbar-track { background: transparent; }
        .col-lg-10::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 6px; }
    </style>
    @stack('styles')
</head>

<body>
    <div class="bg-map" aria-hidden="true"></div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="container-fluid p-0" style="height:100vh;overflow:hidden;">
        <div class="row g-0" style="height:100vh;overflow:hidden;">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 sidebar d-flex flex-column h-100" id="adminSidebar">
                <div class="sidebar-brand-container d-flex align-items-center gap-3">
                    <div class="sidebar-logo-badge">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="min-w-0" style="overflow:hidden;">
                        <div class="sidebar-brand-name text-truncate">
                            @if(auth()->check() && auth()->user()->institute_id && auth()->user()->institute)
                                {{ auth()->user()->institute->name }}
                            @elseif(auth()->check() && auth()->user()->isSuperAdmin())
                                Super Admin
                            @else
                                EduNex ERP
                            @endif
                        </div>
                        <div class="sidebar-brand-subtitle">Admin Portal</div>
                    </div>
                </div>

                @if(auth()->user() && auth()->user()->isSuperAdmin())
                    <h6 class="sidebar-header">Super Admin</h6>
                    <a href="{{ route('superadmin.dashboard') }}"
                        class="{{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i>
                        Dashboard</a>
                    <a href="{{ route('superadmin.institutes.index') }}"
                        class="{{ request()->routeIs('superadmin.institutes.*') ? 'active' : '' }}"><i
                            class="fas fa-school"></i> Institutes</a>
                @else
                    <h6 class="sidebar-header">Institute Panel</h6>
                    @if(!auth()->user()->isWarden())
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i
                                class="fas fa-home"></i> Dashboard</a>
                    @endif

                    @can('manage-attendance')
                        @php
                            $showAttendance = !auth()->user()->isTeacher() || auth()->user()->isClassTeacher();
                        @endphp
                        @if($showAttendance && auth()->user()->institute && auth()->user()->institute->feature_attendance)
                            <a href="{{ route('attendance.index') }}" class="{{ request()->routeIs('attendance.*') ? 'active' : '' }}"><i class="fas fa-calendar-check"></i> Student's Attendance</a>
                        @endif
                    @endcan

                    @php
                        $isUsersActive = request()->routeIs('principals.*') || request()->routeIs('staff.*') || request()->routeIs('students.*');
                        $canShowUsersDropdown = auth()->user()->can('manage-staff') || auth()->user()->can('manage-students');
                    @endphp
                    @if($canShowUsersDropdown)
                        <a href="#usersCollapse" data-bs-toggle="collapse" class="{{ $isUsersActive ? '' : 'collapsed' }}" aria-expanded="{{ $isUsersActive ? 'true' : 'false' }}">
                            <i class="fas fa-users-cog"></i>
                            <span class="flex-grow-1">Users</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ $isUsersActive ? 'show' : '' }}" id="usersCollapse">
                            @can('manage-staff')
                                <a href="{{ route('staff.index') }}" class="{{ request()->routeIs('staff.*') ? 'active' : '' }} small py-2"><i class="fas fa-user-tie"></i> Staff</a>
                                @if(auth()->user()->isInstituteAdmin() && auth()->user()->institute->isSchool())
                                    <a href="{{ route('principals.index') }}" class="{{ request()->routeIs('principals.*') ? 'active' : '' }} small py-2"><i class="fas fa-user-shield"></i> Principal</a>
                                @endif
                            @endcan
                            @can('manage-students')
                                <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }} small py-2"><i class="fas fa-user-graduate"></i> Students</a>
                            @endcan
                        </div>
                    @endif

                    @can('manage-institute-settings')
                        @if(auth()->user()->institute->feature_hr)
                            @php
                                $isHrActive = request()->routeIs('institute.attendance-settings.*')
                                    || request()->routeIs('staff-attendance.admin')
                                    || request()->routeIs('staff-salaries.*')
                                    || request()->routeIs('staff-payrolls.*');
                            @endphp
                            <a href="#hrCollapse" data-bs-toggle="collapse" class="{{ $isHrActive ? '' : 'collapsed' }}" aria-expanded="{{ $isHrActive ? 'true' : 'false' }}">
                                <i class="fas fa-id-badge"></i>
                                <span class="flex-grow-1">Staff HR</span>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                            </a>
                            <div class="collapse {{ $isHrActive ? 'show' : '' }}" id="hrCollapse">
                                <a href="{{ route('institute.attendance-settings.edit') }}" class="{{ request()->routeIs('institute.attendance-settings.*') ? 'active' : '' }} small py-2"><i class="fas fa-map-marker-alt"></i> Location Settings</a>
                                <a href="{{ route('staff-attendance.admin') }}" class="{{ request()->routeIs('staff-attendance.admin') ? 'active' : '' }} small py-2"><i class="fas fa-clipboard-list"></i> Staff Attendance</a>
                                <a href="{{ route('staff-salaries.index') }}" class="{{ request()->routeIs('staff-salaries.*') ? 'active' : '' }} small py-2"><i class="fas fa-rupee-sign"></i> Salaries</a>
                                <a href="{{ route('staff-payrolls.index') }}" class="{{ request()->routeIs('staff-payrolls.*') ? 'active' : '' }} small py-2"><i class="fas fa-file-invoice-dollar"></i> Payroll</a>
                            </div>
                        @endif
                    @endcan

                    @if(!auth()->user()->institute || auth()->user()->institute->feature_hr)
                    @php
                        $user = auth()->user();
                        $canManageStudentLeaves = $user->isInstituteAdmin() || $user->isPrincipal() || $user->isClassTeacher();
                        $isLeavesActive = request()->routeIs('leaves.index') || request()->routeIs('leaves.students');
                    @endphp
                    <a href="#leavesCollapse" data-bs-toggle="collapse" class="{{ $isLeavesActive ? '' : 'collapsed' }}" aria-expanded="{{ $isLeavesActive ? 'true' : 'false' }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="flex-grow-1">Leave Management</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <div class="collapse {{ $isLeavesActive ? 'show' : '' }}" id="leavesCollapse">
                        @if($canManageStudentLeaves)
                            <a href="{{ route('leaves.students') }}" class="{{ request()->routeIs('leaves.students') ? 'active' : '' }} small py-2"><i class="fas fa-user-clock"></i> Student's Leaves</a>
                        @endif
                        <a href="{{ route('leaves.index') }}" class="{{ request()->routeIs('leaves.index') ? 'active' : '' }} small py-2"><i class="fas fa-user-tie"></i> Staff Leave</a>
                    </div>
                    @endif

                    @if(auth()->user()->institute && auth()->user()->institute->feature_visitor)
                    @can('manage-visitors')
                        @php
                            $isVisitorsActive = request()->routeIs('visitors.*');
                        @endphp
                        <a href="#visitorCollapse" data-bs-toggle="collapse" class="{{ $isVisitorsActive ? '' : 'collapsed' }}" aria-expanded="{{ $isVisitorsActive ? 'true' : 'false' }}">
                            <i class="fas fa-id-badge"></i>
                            <span class="flex-grow-1">Visitor Management</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ $isVisitorsActive ? 'show' : '' }}" id="visitorCollapse">
                            <a href="{{ route('visitors.index', ['status' => 'pending']) }}" class="{{ $isVisitorsActive && request('status', 'pending') === 'pending' ? 'active' : '' }} small py-2">
                                <i class="fas fa-clock"></i> Awaiting Approval
                                <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger ms-auto" style="font-size:0.7rem; border: 1px solid rgba(239, 68, 68, 0.25);">{{ \App\Models\Visitor::where('status', 'pending')->count() }}</span>
                            </a>
                            <a href="{{ route('visitors.index', ['status' => 'checked_in']) }}" class="{{ $isVisitorsActive && request('status') === 'checked_in' ? 'active' : '' }} small py-2">
                                <i class="fas fa-sign-in-alt"></i> Inside Campus
                                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary ms-auto" style="font-size:0.7rem; border: 1px solid rgba(37, 99, 235, 0.25);">{{ \App\Models\Visitor::where('status', 'checked_in')->count() }}</span>
                            </a>
                            <a href="{{ route('visitors.index', ['status' => 'checked_out']) }}" class="{{ $isVisitorsActive && request('status') === 'checked_out' ? 'active' : '' }} small py-2">
                                <i class="fas fa-sign-out-alt"></i> Checked Out
                                <span class="badge rounded-pill bg-success bg-opacity-10 text-success ms-auto" style="font-size:0.7rem; border: 1px solid rgba(16, 185, 129, 0.25);">{{ \App\Models\Visitor::where('status', 'checked_out')->count() }}</span>
                            </a>
                            <a href="{{ route('visitors.index', ['status' => 'rejected']) }}" class="{{ $isVisitorsActive && request('status') === 'rejected' ? 'active' : '' }} small py-2">
                                <i class="fas fa-times-circle"></i> Rejected
                                <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-auto" style="font-size:0.7rem; border: 1px solid rgba(100, 116, 139, 0.25);">{{ \App\Models\Visitor::where('status', 'rejected')->count() }}</span>
                            </a>
                        </div>
                    @endcan
                    @endif

                    @if(auth()->user()->canUseBiometricAttendance())
                        <a href="{{ route('staff-attendance.mark') }}" class="{{ request()->routeIs('staff-attendance.mark') ? 'active' : '' }}">
                            <i class="fas fa-fingerprint"></i> Mark Attendance
                        </a>
                    @endif

                    @can('manage-payments')
                        @if(auth()->user()->institute->feature_fees)
                            @php
                                $isFeesActive = request()->routeIs('payments.*') || 
                                               request()->routeIs('fee-allocations.*') || 
                                               request()->routeIs('fee-categories.*') || 
                                               request()->routeIs('fee-structures.*') || 
                                               request()->routeIs('payment-gateways.*');
                                $showFees = !auth()->user()->isPrincipal() && !auth()->user()->isTeacher();
                            @endphp
                            @if($showFees)
                                <a href="#feesCollapse" data-bs-toggle="collapse" class="{{ $isFeesActive ? '' : 'collapsed' }}" aria-expanded="{{ $isFeesActive ? 'true' : 'false' }}">
                                    <i class="fas fa-money-bill-wave"></i> 
                                    <span class="flex-grow-1">Fees & Payments</span>
                                    <i class="fas fa-chevron-down dropdown-arrow"></i>
                                </a>
                                <div class="collapse {{ $isFeesActive ? 'show' : '' }}" id="feesCollapse">
                                    <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*') ? 'active' : '' }} small py-2"><i class="fas fa-wallet"></i> Payments</a>
                                    <a href="{{ route('fee-allocations.create') }}" class="{{ request()->routeIs('fee-allocations.*') ? 'active' : '' }} small py-2"><i class="fas fa-user-plus"></i> Allocate Fees</a>
                                    <a href="{{ route('fee-categories.index') }}" class="{{ request()->routeIs('fee-categories.*') ? 'active' : '' }} small py-2"><i class="fas fa-tags"></i> Categories</a>
                                    <a href="{{ route('fee-structures.index') }}" class="{{ request()->routeIs('fee-structures.*') ? 'active' : '' }} small py-2"><i class="fas fa-sitemap"></i> Structures</a>
                                    <a href="{{ route('payment-gateways.settings') }}" class="{{ request()->routeIs('payment-gateways.*') ? 'active' : '' }} small py-2"><i class="fas fa-credit-card"></i> Settings</a>
                                </div>
                            @endif
                        @endif
                    @endcan

                    @if(auth()->user()->institute && auth()->user()->institute->feature_accounting)
                    @can('manage-payments')
                        @php
                            $isAccountingActive = request()->routeIs('accounting.*') || request()->routeIs('expenses.*');
                        @endphp
                        <a href="#accountingCollapse" data-bs-toggle="collapse" class="{{ $isAccountingActive ? '' : 'collapsed' }}" aria-expanded="{{ $isAccountingActive ? 'true' : 'false' }}">
                            <i class="fas fa-calculator"></i> 
                            <span class="flex-grow-1">Accounting &amp; Tally</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ $isAccountingActive ? 'show' : '' }}" id="accountingCollapse">
                            <a href="{{ route('accounting.dashboard') }}" class="{{ request()->routeIs('accounting.dashboard') ? 'active' : '' }} small py-2"><i class="fas fa-chart-line"></i> Dashboard</a>
                            <a href="{{ route('accounting.ledgers.index') }}" class="{{ request()->routeIs('accounting.ledgers.*') ? 'active' : '' }} small py-2"><i class="fas fa-list-ul"></i> Chart of Accounts</a>
                            <a href="{{ route('expenses.index') }}" class="{{ request()->routeIs('expenses.*') ? 'active' : '' }} small py-2"><i class="fas fa-receipt"></i> Expense Ledger</a>
                            <a href="{{ route('accounting.gst.reports') }}" class="{{ request()->routeIs('accounting.gst.*') ? 'active' : '' }} small py-2"><i class="fas fa-file-invoice"></i> GST Statements</a>
                        </div>
                    @endcan
                    @endif

                    

                    @if(!auth()->user()->isReceptionist() && !auth()->user()->isLibrarian() && !auth()->user()->isWarden())
                        @if(auth()->user()->institute && auth()->user()->institute->feature_academics)
                        @php
                            $isAcademicsActive = request()->routeIs('batches.*')
                                || request()->routeIs('subjects.*')
                                || request()->routeIs('timetables.index')
                                || request()->routeIs('timetables.my-schedule');
                        @endphp
                        <a href="#academicsCollapse" data-bs-toggle="collapse" class="{{ $isAcademicsActive ? '' : 'collapsed' }}" aria-expanded="{{ $isAcademicsActive ? 'true' : 'false' }}">
                            <i class="fas fa-graduation-cap"></i>
                            <span class="flex-grow-1">Academics</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ $isAcademicsActive ? 'show' : '' }}" id="academicsCollapse">
                            @can('manage-batches')
                                <a href="{{ route('batches.index') }}" class="{{ request()->routeIs('batches.*') ? 'active' : '' }} small py-2"><i class="fas fa-layer-group"></i> Batches</a>
                            @endcan
                            @if(!auth()->user()->isTeacher())
                                <a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.*') ? 'active' : '' }} small py-2"><i class="fas fa-book"></i> Subjects</a>
                            @endif
                            @if(!auth()->user()->isTeacher())
                                <a href="{{ route('timetables.index') }}" class="{{ request()->routeIs('timetables.index') ? 'active' : '' }} small py-2"><i class="fas fa-calendar-alt"></i> Timetable</a>
                            @endif
                            @if(auth()->user()->isTeacher() || auth()->user()->isPrincipal() || auth()->user()->isInstituteAdmin())
                                <a href="{{ route('timetables.my-schedule') }}" class="{{ request()->routeIs('timetables.my-schedule') ? 'active' : '' }} small py-2"><i class="fas fa-user-clock"></i> My Schedule</a>
                            @endif
                        </div>
                        @endif

                        @if(auth()->user()->institute && auth()->user()->institute->feature_lms)
                        @php
                            $isLmsActive = request()->routeIs('homework.*') || request()->routeIs('live-lectures.*') || request()->routeIs('study-materials.*');
                        @endphp
                        <a href="#lmsCollapse" data-bs-toggle="collapse" class="{{ $isLmsActive ? '' : 'collapsed' }}" aria-expanded="{{ $isLmsActive ? 'true' : 'false' }}">
                            <i class="fas fa-graduation-cap"></i>
                            <span class="flex-grow-1">LMS</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ $isLmsActive ? 'show' : '' }}" id="lmsCollapse">
                            <a href="{{ route('study-materials.index') }}" class="{{ request()->routeIs('study-materials.*') ? 'active' : '' }} small py-2"><i class="fas fa-folder-open"></i> Study Materials</a>
                            @if(auth()->user()->institute->feature_live_classes)
                                <a href="{{ route('live-lectures.index') }}" class="{{ request()->routeIs('live-lectures.*') ? 'active' : '' }} small py-2"><i class="fas fa-video"></i> Live/Recorded Lectures</a>
                            @endif
                            <a href="{{ route('homework.index') }}" class="{{ request()->routeIs('homework.*') ? 'active' : '' }} small py-2"><i class="fas fa-tasks"></i> Assignments</a>
                        </div>
                        @endif

                        @if(auth()->user()->institute && auth()->user()->institute->feature_exams)
                        @php
                            $isExamsTestsActive = request()->routeIs('tests.*') || request()->routeIs('online-exams.*') || request()->routeIs('question-bank.*');
                        @endphp
                        <a href="#examsTestsCollapse" data-bs-toggle="collapse" class="{{ $isExamsTestsActive ? '' : 'collapsed' }}" aria-expanded="{{ $isExamsTestsActive ? 'true' : 'false' }}">
                            <i class="fas fa-file-signature"></i>
                            <span class="flex-grow-1">Exams &amp; Tests</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ $isExamsTestsActive ? 'show' : '' }}" id="examsTestsCollapse">
                            <a href="{{ route('tests.index') }}" class="{{ request()->routeIs('tests.*') ? 'active' : '' }} small py-2"><i class="fas fa-file-alt"></i> Tests &amp; Exams</a>
                            <a href="{{ route('online-exams.index') }}" class="{{ request()->routeIs('online-exams.*') ? 'active' : '' }} small py-2"><i class="fas fa-laptop-code"></i> Online Exams</a>
                            <a href="{{ route('question-bank.index') }}" class="{{ request()->routeIs('question-bank.*') ? 'active' : '' }} small py-2"><i class="fas fa-database"></i> Question Banks</a>
                        </div>
                        @endif

                        <!-- Store & Inventory -->
                        @if(auth()->user()->institute && auth()->user()->institute->feature_inventory)
                        @can('manage-inventory')
                            @php
                                $isStoreActive = request()->routeIs('inventory-items.*')
                                    || request()->routeIs('inventory-suppliers.*')
                                    || request()->routeIs('purchase-orders.*');
                            @endphp
                            <a href="#storeCollapse" data-bs-toggle="collapse" class="{{ $isStoreActive ? '' : 'collapsed' }}" aria-expanded="{{ $isStoreActive ? 'true' : 'false' }}">
                                <i class="fas fa-boxes-stacked"></i>
                                <span class="flex-grow-1">Store &amp; Inventory</span>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                            </a>
                            <div class="collapse {{ $isStoreActive ? 'show' : '' }}" id="storeCollapse">
                                <a href="{{ route('inventory.dashboard') }}" class="{{ request()->routeIs('inventory.dashboard') ? 'active' : '' }} small py-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                                <a href="{{ route('inventory-items.index') }}" class="{{ request()->routeIs('inventory-items.*') ? 'active' : '' }} small py-2"><i class="fas fa-boxes-stacked"></i> Stock Items</a>
                                <a href="{{ route('inventory-suppliers.index') }}" class="{{ request()->routeIs('inventory-suppliers.*') ? 'active' : '' }} small py-2"><i class="fas fa-truck-field"></i> Suppliers / Vendors</a>
                                <a href="{{ route('purchase-orders.index') }}" class="{{ request()->routeIs('purchase-orders.*') ? 'active' : '' }} small py-2"><i class="fas fa-file-signature"></i> Purchase Orders</a>
                            </div>
                        @endcan
                        @endif
                    @endif

                    <!-- Hostel Management -->
                    @if(auth()->user()->institute && auth()->user()->institute->feature_hostel)
                    @can('manage-hostels')
                        @php
                            $isHostelActive = request()->routeIs('hostels.*')
                                || request()->routeIs('hostel-allocations.*')
                                || request()->routeIs('hostel-messes.*')
                                || request()->routeIs('hostel-bills.*');
                        @endphp
                        <a href="#hostelCollapse" data-bs-toggle="collapse" class="{{ $isHostelActive ? '' : 'collapsed' }}" aria-expanded="{{ $isHostelActive ? 'true' : 'false' }}">
                            <i class="fas fa-hotel"></i>
                            <span class="flex-grow-1">Hostel Management</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ $isHostelActive ? 'show' : '' }}" id="hostelCollapse">
                            <a href="{{ route('hostels.dashboard') }}" class="{{ request()->routeIs('hostels.dashboard') ? 'active' : '' }} small py-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                            <a href="{{ route('hostels.index') }}" class="{{ request()->routeIs('hostels.*') ? 'active' : '' }} small py-2"><i class="fas fa-hotel"></i> Hostels &amp; Rooms</a>
                            <a href="{{ route('hostel-allocations.index') }}" class="{{ request()->routeIs('hostel-allocations.*') ? 'active' : '' }} small py-2"><i class="fas fa-user-tag"></i> Room Allocations</a>
                            <a href="{{ route('hostel-messes.index') }}" class="{{ request()->routeIs('hostel-messes.*') ? 'active' : '' }} small py-2"><i class="fas fa-utensils"></i> Mess &amp; Menus</a>
                            <a href="{{ route('hostel-bills.index') }}" class="{{ request()->routeIs('hostel-bills.*') ? 'active' : '' }} small py-2"><i class="fas fa-file-invoice-dollar"></i> Hostel Invoices</a>
                        </div>
                    @endcan
                    @endif

                    @if(auth()->user()->institute && auth()->user()->institute->feature_library)
                    @if(auth()->user()->isTeacher() || auth()->user()->isStaff())
                        @if(!auth()->user()->can('manage-library'))
                            <a href="{{ route('teacher.library.index') }}" class="{{ request()->routeIs('teacher.library.*') ? 'active' : '' }}">
                                <i class="fas fa-book-reader"></i> Teacher/Staff Library
                            </a>
                        @endif
                    @endif

                    @can('manage-library')
                        <a href="#libraryMainCollapse" data-bs-toggle="collapse" class="{{ request()->routeIs('library.*') ? '' : 'collapsed' }}">
                            <i class="fas fa-book-reader"></i>
                            <span class="flex-grow-1">Library Management</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ request()->routeIs('library.*') ? 'show' : '' }}" id="libraryMainCollapse">
                            <a href="{{ route('library.dashboard') }}" class="{{ request()->routeIs('library.dashboard') ? 'active' : '' }} small py-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                            <a href="{{ route('library.books.index') }}" class="{{ request()->routeIs('library.books.*') ? 'active' : '' }} small py-2"><i class="fas fa-book"></i> Books Catalog</a>
                            <a href="{{ route('library.categories.index') }}" class="{{ request()->routeIs('library.categories.*') ? 'active' : '' }} small py-2"><i class="fas fa-layer-group"></i> Categories</a>
                            <a href="{{ route('library.authors.index') }}" class="{{ request()->routeIs('library.authors.*') ? 'active' : '' }} small py-2"><i class="fas fa-user-edit"></i> Authors</a>
                            <a href="{{ route('library.publishers.index') }}" class="{{ request()->routeIs('library.publishers.*') ? 'active' : '' }} small py-2"><i class="fas fa-building"></i> Publishers</a>
                            <a href="{{ route('library.issues.index') }}" class="{{ request()->routeIs('library.issues.*') ? 'active' : '' }} small py-2"><i class="fas fa-hand-holding"></i> Book Issues</a>
                            <a href="{{ route('library.returns.index') }}" class="{{ request()->routeIs('library.returns.*') ? 'active' : '' }} small py-2"><i class="fas fa-undo"></i> Book Returns</a>
                            <a href="{{ route('library.reservations.index') }}" class="{{ request()->routeIs('library.reservations.*') ? 'active' : '' }} small py-2"><i class="fas fa-bookmark"></i> Reservations</a>
                            <a href="{{ route('library.fines.index') }}" class="{{ request()->routeIs('library.fines.*') ? 'active' : '' }} small py-2"><i class="fas fa-coins"></i> Fines</a>
                            <a href="{{ route('library.digital-resources.index') }}" class="{{ request()->routeIs('library.digital-resources.*') ? 'active' : '' }} small py-2"><i class="fas fa-desktop"></i> Digital Library</a>
                            <a href="{{ route('library.reports.index') }}" class="{{ request()->routeIs('library.reports.*') ? 'active' : '' }} small py-2"><i class="fas fa-chart-pie"></i> Reports</a>
                            <a href="{{ route('library.settings.edit') }}" class="{{ request()->routeIs('library.settings.*') ? 'active' : '' }} small py-2"><i class="fas fa-cog"></i> Settings</a>
                        </div>
                    @endcan
                    @endif

                    @if((auth()->user()->isInstituteAdmin() || auth()->user()->isPrincipal()) && auth()->user()->institute && auth()->user()->institute->feature_transport)
                        @php
                            $isTransportActive = request()->routeIs('transport.*');
                        @endphp
                        <a href="#transportCollapse" data-bs-toggle="collapse" class="{{ $isTransportActive ? '' : 'collapsed' }}" aria-expanded="{{ $isTransportActive ? 'true' : 'false' }}">
                            <i class="fas fa-bus"></i>
                            <span class="flex-grow-1">Transport Management</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ $isTransportActive ? 'show' : '' }}" id="transportCollapse">
                            <a href="{{ route('transport.dashboard') }}" class="{{ request()->routeIs('transport.dashboard') ? 'active' : '' }} small py-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                            <a href="{{ route('transport.tracking.index') }}" class="{{ request()->routeIs('transport.tracking.*') ? 'active' : '' }} small py-2"><i class="fas fa-map-marker-alt"></i> Live Tracking</a>
                            <a href="{{ route('transport.vehicles') }}" class="{{ request()->routeIs('transport.vehicles') ? 'active' : '' }} small py-2"><i class="fas fa-bus-alt"></i> Vehicles</a>
                            <a href="{{ route('transport.routes') }}" class="{{ request()->routeIs('transport.routes') ? 'active' : '' }} small py-2"><i class="fas fa-route"></i> Routes</a>
                            <a href="{{ route('transport.stops') }}" class="{{ request()->routeIs('transport.stops') ? 'active' : '' }} small py-2"><i class="fas fa-map-pin"></i> Stops</a>
                            <a href="{{ route('transport.drivers') }}" class="{{ request()->routeIs('transport.drivers') ? 'active' : '' }} small py-2"><i class="fas fa-id-card"></i> Drivers</a>
                            <a href="{{ route('transport.allocations') }}" class="{{ request()->routeIs('transport.allocations') ? 'active' : '' }} small py-2"><i class="fas fa-user-check"></i> Allocations</a>
                        </div>
                    @endif

                    @if(!auth()->user()->institute || auth()->user()->institute->feature_curriculum)
                    @php
                        $isCurriculumActive = request()->routeIs('class-chat.*') || request()->routeIs('gallery.*') || request()->routeIs('discipline.*') || request()->routeIs('notifications.*');
                        $showChat = auth()->user()->isInstituteAdmin() || auth()->user()->isPrincipal() || auth()->user()->isTeacher();
                        $showGallery = !auth()->user()->isReceptionist();
                        $showDiscipline = !auth()->user()->isReceptionist();
                    @endphp
                    <a href="#curriculumCollapse" data-bs-toggle="collapse" class="{{ $isCurriculumActive ? '' : 'collapsed' }}" aria-expanded="{{ $isCurriculumActive ? 'true' : 'false' }}">
                        <i class="fas fa-graduation-cap"></i>
                        <span class="flex-grow-1">Curriculum</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <div class="collapse {{ $isCurriculumActive ? 'show' : '' }}" id="curriculumCollapse">
                        @if($showChat)
                            <a href="{{ route('class-chat.index') }}" class="{{ request()->routeIs('class-chat.*') ? 'active' : '' }} small py-2"><i class="fas fa-comments"></i> Class Chatroom</a>
                        @endif
                        @if(auth()->user()->isInstituteAdmin() || auth()->user()->isTeacher() || auth()->user()->isPrincipal() || auth()->user()->isReceptionist() || auth()->user()->isLibrarian() || auth()->user()->isWarden())
                            <a href="{{ route('notifications.index') }}" class="{{ request()->routeIs('notifications.*') ? 'active' : '' }} small py-2"><i class="fas fa-bell"></i> Notifications</a>
                        @endif
                        @if($showGallery)
                            <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'active' : '' }} small py-2"><i class="fas fa-images"></i> Image Gallery</a>
                        @endif
                        @if($showDiscipline)
                            <a href="{{ route('discipline.index') }}" class="{{ request()->routeIs('discipline.*') ? 'active' : '' }} small py-2"><i class="fas fa-balance-scale"></i> Discipline</a>
                        @endif
                    </div>
                    @endif

                    @if(auth()->user()->isInstituteAdmin() || auth()->user()->isTeacher() || auth()->user()->isPrincipal() || auth()->user()->isReceptionist() || auth()->user()->isLibrarian())
                        @if(!auth()->user()->institute || auth()->user()->institute->feature_reports)
                        @php
                            $isReportsActive = request()->routeIs('reports.defaulters')
                                || request()->routeIs('reports.attendance')
                                || request()->routeIs('reports.lms')
                                || request()->routeIs('reports.exams');
                            $showAttendanceRep = !auth()->user()->isTeacher() || auth()->user()->isClassTeacher();
                            $showDefaultersRep = auth()->user()->isInstituteAdmin() || auth()->user()->isReceptionist();
                            $showAcademicsRep  = auth()->user()->can('manage-academics');
                        @endphp
                        @if(!auth()->user()->isLibrarian() && ($showAttendanceRep || $showDefaultersRep || $showAcademicsRep))
                            <a href="#reportsCollapse" data-bs-toggle="collapse" class="{{ $isReportsActive ? '' : 'collapsed' }}" aria-expanded="{{ $isReportsActive ? 'true' : 'false' }}">
                                <i class="fas fa-chart-pie"></i>
                                <span class="flex-grow-1">Reports</span>
                                <i class="fas fa-chevron-down dropdown-arrow"></i>
                            </a>
                            <div class="collapse {{ $isReportsActive ? 'show' : '' }}" id="reportsCollapse">
                                @if($showDefaultersRep)
                                    <a href="{{ route('reports.defaulters') }}" class="{{ request()->routeIs('reports.defaulters') ? 'active' : '' }} small py-2"><i class="fas fa-exclamation-triangle"></i> Defaulters</a>
                                @endif
                                @if($showAttendanceRep)
                                    <a href="{{ route('reports.attendance') }}" class="{{ request()->routeIs('reports.attendance') ? 'active' : '' }} small py-2"><i class="fas fa-chart-bar"></i> Attendance Report</a>
                                @endif
                                @if($showAcademicsRep)
                                    @if(!auth()->user()->institute || auth()->user()->institute->feature_lms)
                                        <a href="{{ route('reports.lms') }}" class="{{ request()->routeIs('reports.lms') ? 'active' : '' }} small py-2"><i class="fas fa-graduation-cap"></i> LMS Report</a>
                                    @endif
                                    @if(!auth()->user()->institute || auth()->user()->institute->feature_exams)
                                        <a href="{{ route('reports.exams') }}" class="{{ request()->routeIs('reports.exams') ? 'active' : '' }} small py-2"><i class="fas fa-file-signature"></i> Exams Report</a>
                                    @endif
                                @endif
                            </div>
                        @endif
                        @endif

                        @if((auth()->user()->isInstituteAdmin() || auth()->user()->isPrincipal() || auth()->user()->isTeacher()) && auth()->user()->institute && auth()->user()->institute->feature_whatsapp)
                            <a href="{{ route('whatsapp.index') }}" class="{{ request()->routeIs('whatsapp.*') ? 'active' : '' }}">
                                <i class="fab fa-whatsapp" style="color: #198754;"></i> WhatsApp Center
                            </a>
                        @endif

                        <a href="{{ route('profile.edit') }}"
                            class="{{ request()->routeIs('profile.*') ? 'active' : '' }}"><i class="fas fa-user-circle text-primary"></i>
                            My Profile</a>
                    @endif
                @endif

                <div class="mt-auto mb-4 text-center w-100 px-3">
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-10 col-md-9" style="height:100vh;overflow-y:auto;position:relative;">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg top-navbar sticky-top">
                    <div class="container-fluid px-0">
                        <button class="btn border-0 d-md-none me-2 shadow-none p-1" id="sidebarToggle" style="color:#64748B;">
                            <i class="fas fa-bars" style="font-size:1.15rem;"></i>
                        </button>
                        <span class="navbar-brand-title mb-0">@yield('title', 'Overview')</span>
                        <div class="d-flex align-items-center ms-auto gap-2">
                            <a href="{{ route('profile.edit') }}" class="text-decoration-none d-flex align-items-center gap-2 user-profile">
                                <img src="{{ auth()->user()->profile_image_url }}"
                                     alt="Profile"
                                     class="rounded-circle"
                                     style="width:28px;height:28px;object-fit:cover;border:2px solid #E2E8F0;">
                                <div class="d-none d-sm-block" style="line-height:1.2;">
                                    <div style="font-size:0.8rem;font-weight:700;color:#0F172A;">{{ auth()->user()->name ?? 'Admin User' }}</div>
                                    <div style="font-size:0.65rem;color:#94A3B8;text-transform:uppercase;letter-spacing:0.5px;">
                                        @if(auth()->user()->isSuperAdmin()) Super Admin
                                        @elseif(auth()->user()->isInstituteAdmin()) Admin
                                        @elseif(auth()->user()->isPrincipal()) Principal
                                        @elseif(auth()->user()->isTeacher()) Teacher
                                        @elseif(auth()->user()->isReceptionist()) Receptionist
                                        @else Staff @endif
                                    </div>
                                </div>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" style="border-radius:10px;padding:7px 14px;font-size:0.78rem;font-weight:600;">
                                    <i class="fas fa-sign-out-alt me-1"></i>
                                    <span class="d-none d-sm-inline">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="main-content container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.getElementById('adminSidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        });
        document.getElementById('sidebarOverlay')?.addEventListener('click', function () {
            document.getElementById('adminSidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
        });
    </script>
    @stack('scripts')
    @yield('modals')

    @if(auth()->check() && !auth()->user()->isSuperAdmin() && auth()->user()->institute_id)
    <!-- ─── Staff Group Chat Widget ─── -->
    <style>
        /* ── Bubble ── */
        #chatBubble {
            position: fixed; bottom: 24px; right: 24px;
            display: flex; align-items: center; gap: 10px;
            background: #0F172A; color: #fff;
            border: none; border-radius: 50px;
            padding: 0 20px 0 6px; height: 50px;
            cursor: pointer; z-index: 9000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            transition: box-shadow 0.2s, transform 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        #chatBubble:hover { box-shadow: 0 8px 28px rgba(0,0,0,0.28); transform: translateY(-2px); }
        .cb-icon {
            width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg,#6366F1,#0D9488);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; flex-shrink: 0;
        }
        .cb-label { font-size: 0.8rem; font-weight: 500; letter-spacing: 0.1px; }
        #chatBadgeLeft {
            position: absolute; top: -5px; right: -5px;
            background: #EF4444; color: #fff; border-radius: 50%;
            width: 18px; height: 18px; font-size: 0.6rem; font-weight: 600;
            display: none; align-items: center; justify-content: center;
            border: 2px solid #fff;
        }
        #chatBadgeRight {
            position: absolute; top: -5px; right: 14px;
            background: #F59E0B; color: #fff; border-radius: 50%;
            width: 18px; height: 18px; font-size: 0.6rem; font-weight: 600;
            display: none; align-items: center; justify-content: center;
            border: 2px solid #fff;
        }

        /* ── Panel ── */
        #chatPanel {
            position: fixed; bottom: 86px; right: 24px;
            width: 360px; height: 520px;
            border-radius: 20px;
            background: #fff;
            border: 1px solid #E8EDF5;
            box-shadow: 0 20px 60px rgba(0,0,0,0.14);
            z-index: 8999; display: none; flex-direction: column; overflow: hidden;
            transform-origin: bottom right;
        }
        #chatPanel.open { display: flex; animation: chatPop 0.25s cubic-bezier(0.34,1.56,0.64,1); }
        @keyframes chatPop { from { opacity:0; transform:scale(0.88) translateY(12px); } to { opacity:1; transform:scale(1) translateY(0); } }

        /* ── Header ── */
        .chat-header {
            background: #0F172A;
            padding: 14px 16px;
            display: flex; align-items: center; gap: 12px; flex-shrink: 0;
        }
        .chat-header-av {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg,#6366F1,#0D9488);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; flex-shrink: 0;
        }
        .chat-header-info { flex: 1; }
        .chat-header-name { font-size: 0.88rem; font-weight: 500; color: #fff; }
        .chat-header-status { font-size: 0.65rem; color: rgba(255,255,255,0.4); display: flex; align-items: center; gap: 5px; margin-top: 1px; }
        .chat-online-dot { width: 6px; height: 6px; border-radius: 50%; background: #4ADE80; display: inline-block; box-shadow: 0 0 5px #4ADE80; }
        .chat-close-btn {
            width: 28px; height: 28px; border-radius: 8px;
            background: rgba(255,255,255,0.08); border: none; color: rgba(255,255,255,0.6);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: background 0.15s, color 0.15s; flex-shrink: 0;
        }
        .chat-close-btn:hover { background: rgba(255,255,255,0.16); color: #fff; }

        /* ── Messages ── */
        #chatMessages {
            flex: 1; overflow-y: auto; padding: 14px 14px 8px;
            display: flex; flex-direction: column; gap: 12px;
            background: #F8FAFC;
        }
        #chatMessages::-webkit-scrollbar { width: 3px; }
        #chatMessages::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 3px; }

        .chat-msg { display: flex; gap: 8px; align-items: flex-end; max-width: 85%; }
        .chat-msg.me { flex-direction: row-reverse; align-self: flex-end; }
        .chat-avatar { width: 28px; height: 28px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 2px solid #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
        .chat-bubble-wrap { display: flex; flex-direction: column; }
        .chat-msg.me .chat-bubble-wrap { align-items: flex-end; }
        .chat-sender { font-size: 0.62rem; color: #94A3B8; margin-bottom: 3px; }
        .chat-msg.me .chat-sender { color: #6366F1; }
        .chat-text {
            background: #fff; border: 1px solid #EEF2F7;
            border-radius: 14px 14px 14px 3px;
            padding: 8px 12px; font-size: 0.8rem; color: #1E293B;
            line-height: 1.5; word-break: break-word;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .chat-msg.me .chat-text {
            background: #0F172A; color: #E2E8F0;
            border: none; border-radius: 14px 14px 3px 14px;
        }
        .chat-time { font-size: 0.58rem; color: #CBD5E1; margin-top: 3px; }
        .chat-mention { color: #6366F1; background: rgba(99,102,241,0.08); border-radius: 4px; padding: 0 3px; }
        .chat-msg.me .chat-mention { color: #A5B4FC; background: rgba(255,255,255,0.1); }

        /* ── Input ── */
        .chat-input-area {
            padding: 10px 12px; background: #fff;
            border-top: 1px solid #F1F5F9;
            display: flex; align-items: flex-end; gap: 8px; flex-shrink: 0;
        }
        #chatInput {
            flex: 1; border: 1.5px solid #E8EDF5; border-radius: 12px;
            padding: 9px 12px; font-size: 0.8rem; font-family: 'Outfit', sans-serif;
            resize: none; outline: none; color: #0F172A;
            transition: border-color 0.2s; line-height: 1.4;
            max-height: 90px; overflow-y: auto; background: #F8FAFC;
        }
        #chatInput:focus { border-color: #6366F1; background: #fff; }
        #chatInput::placeholder { color: #CBD5E1; }
        #chatSendBtn {
            width: 36px; height: 36px; border-radius: 10px;
            background: #0F172A; color: #fff; border: none; font-size: 0.82rem;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; flex-shrink: 0; transition: background 0.2s, transform 0.15s;
        }
        #chatSendBtn:hover { background: #1E293B; transform: scale(1.06); }

        /* ── Mention dropdown ── */
        #mentionDropdown {
            position: absolute; bottom: 72px; right: 24px;
            width: 210px; background: #fff;
            border: 1px solid #E8EDF5; border-radius: 14px;
            box-shadow: 0 8px 28px rgba(0,0,0,0.1);
            z-index: 9001; display: none; overflow: hidden;
        }
        .mention-item {
            padding: 9px 14px; cursor: pointer; font-size: 0.8rem;
            color: #1E293B; transition: background 0.12s;
            display: flex; align-items: center; gap: 8px;
        }
        .mention-item:hover { background: #F5F3FF; color: #6366F1; }
        .mention-avatar-sm { width: 22px; height: 22px; border-radius: 50%; object-fit: cover; }

        /* ── Empty ── */
        .chat-empty {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            color: #CBD5E1; font-size: 0.8rem; text-align: center; gap: 8px;
        }
        @media (max-width: 480px) {
            #chatPanel { width: calc(100vw - 24px); right: 12px; }
            #mentionDropdown { right: 12px; }
        }
    </style>

    <!-- Mention Dropdown -->
    <div id="mentionDropdown"></div>

    <!-- Chat Bubble -->
    <button id="chatBubble" title="Staff Group Chat">
        <div class="cb-icon"><i class="fas fa-comments"></i></div>
        <span class="cb-label">Staff Chat</span>
        <span id="chatBadgeLeft"></span>
        <span id="chatBadgeRight"></span>
    </button>

    <!-- Chat Panel -->
    <div id="chatPanel">
        <div class="chat-header">
            <div class="chat-header-av"><i class="fas fa-comments" style="color:#fff;font-size:0.9rem;"></i></div>
            <div class="chat-header-info">
                <div class="chat-header-name">Staff Group Chat</div>
                <div class="chat-header-status"><span class="chat-online-dot"></span> Active now</div>
            </div>
            <button class="chat-close-btn" id="chatCloseBtn"><i class="fas fa-xmark" style="font-size:0.75rem;"></i></button>
        </div>
        <div id="chatMessages">
            <div class="chat-empty">
                <i class="fas fa-comments" style="font-size:2rem;opacity:0.2;display:block;margin-bottom:6px;"></i>
                Loading messages...
            </div>
        </div>
        <div class="chat-input-area">
            <textarea id="chatInput" rows="1" placeholder="Message staff… @ to mention"></textarea>
            <button id="chatSendBtn" title="Send"><i class="fas fa-paper-plane" style="font-size:0.8rem;"></i></button>
        </div>
    </div>

    <script>
    (function() {
        const bubble     = document.getElementById('chatBubble');
        const panel      = document.getElementById('chatPanel');
        const closeBtn   = document.getElementById('chatCloseBtn');
        const msgList    = document.getElementById('chatMessages');
        const input      = document.getElementById('chatInput');
        const sendBtn    = document.getElementById('chatSendBtn');
        const badgeLeft  = document.getElementById('chatBadgeLeft');
        const badgeRight = document.getElementById('chatBadgeRight');
        const mentionDiv = document.getElementById('mentionDropdown');

        let isOpen       = false;
        let pollInterval = null;
        let lastId       = 0;
        let staffList    = [];
        let isSending    = false;
        const CSRF       = document.querySelector('meta[name="csrf-token"]')?.content || '';
        
        const LOCAL_KEY  = 'chat_last_read_id_{{ auth()->id() ?? 0 }}';
        let lastReadId   = parseInt(localStorage.getItem(LOCAL_KEY)) || 0;
        let unreadCount  = 0;
        let isMentioned  = false;
        const myName     = "{{ auth()->user()->name ?? '' }}";

        // ── Helpers ──────────────────────────────────────────────────
        function highlightMentions(text) {
            return text
                .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
                .replace(/@([\w\s]{2,30}?)(?=\s|$|[^a-zA-Z\s])/g, '<span class="chat-mention">@$1</span>');
        }

        function renderMessage(m) {
            const div = document.createElement('div');
            div.className = 'chat-msg' + (m.is_me ? ' me' : '');
            div.setAttribute('data-id', m.id);
            div.innerHTML = `
                <img class="chat-avatar" src="${m.user_avatar}" alt="${m.user_name}">
                <div class="chat-bubble-wrap">
                    <div class="chat-sender">${m.is_me ? 'You' : m.user_name} · ${m.user_role}</div>
                    <div class="chat-text">${highlightMentions(m.message)}</div>
                    <div class="chat-time">${m.time}</div>
                </div>`;
            return div;
        }

        function scrollBottom() {
            msgList.scrollTop = msgList.scrollHeight;
        }

        function updateBadges() {
            if (unreadCount > 0) {
                badgeLeft.style.display = 'flex';
                badgeLeft.textContent = unreadCount > 9 ? '9+' : unreadCount;
            } else {
                badgeLeft.style.display = 'none';
            }
            
            if (isMentioned) {
                badgeRight.style.display = 'flex';
                badgeRight.textContent = '@';
            } else {
                badgeRight.style.display = 'none';
            }
        }
        
        function markAsRead(id) {
            if (id > lastReadId) {
                lastReadId = id;
                localStorage.setItem(LOCAL_KEY, lastReadId);
            }
            unreadCount = 0;
            isMentioned = false;
            updateBadges();
        }

        // ── Fetch messages ──────────────────────────────────────────
        async function fetchMessages(isOpening = false, isFirstLoad = false) {
            try {
                const res  = await fetch('{{ route("chat.index") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                const data = await res.json();
                staffList  = data.staff || [];

                if (isOpening) {
                    msgList.innerHTML = '';
                    if (data.messages.length === 0) {
                        msgList.innerHTML = '<div class="chat-empty"><i class="fas fa-comments" style="font-size:2rem;opacity:0.3;"></i><div>No messages yet. Say hi! 👋</div></div>';
                    } else {
                        data.messages.forEach(m => { msgList.appendChild(renderMessage(m)); });
                        lastId = data.messages[data.messages.length - 1].id;
                        scrollBottom();
                    }
                    markAsRead(lastId);
                } else {
                    let hasNew = false;
                    data.messages.forEach(m => {
                        if (m.id > lastId) {
                            if (!isFirstLoad) {
                                const empty = msgList.querySelector('.chat-empty');
                                if (empty) empty.remove();
                                msgList.appendChild(renderMessage(m));
                            }
                            lastId = m.id;
                            hasNew = true;
                        }
                    });
                    if (hasNew && !isFirstLoad && isOpen) {
                        scrollBottom();
                        markAsRead(lastId);
                    }
                }
                
                // Recalculate unread count based on lastReadId if closed
                if (!isOpen) {
                    unreadCount = 0;
                    isMentioned = false;
                    data.messages.forEach(m => {
                        if (m.id > lastReadId) {
                            unreadCount++;
                            if (m.message.includes('@' + myName)) {
                                isMentioned = true;
                            }
                        }
                    });
                    updateBadges();
                }
            } catch(e) { console.warn('Chat fetch error', e); }
        }

        // ── Send ─────────────────────────────────────────────────────
        async function sendMessage() {
            const text = input.value.trim();
            if (!text || isSending) return;
            isSending = true;
            input.value = '';
            autoResize();
            try {
                const res = await fetch('{{ route("chat.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ message: text }),
                });
                const m = await res.json();
                if (m.id) {
                    const empty = msgList.querySelector('.chat-empty');
                    if (empty) empty.remove();
                    msgList.appendChild(renderMessage(m));
                    lastId = m.id;
                    markAsRead(lastId);
                    scrollBottom();
                }
            } catch(e) { input.value = text; console.warn('Send error', e); }
            finally { isSending = false; }
        }

        // ── Open / Close ─────────────────────────────────────────────
        function openChat() {
            isOpen = true;
            panel.classList.add('open');
            bubble.style.background = 'linear-gradient(135deg, #10B981, #22C55E)';
            fetchMessages(true, false);
            pollInterval = setInterval(() => fetchMessages(false, false), 3000);
            setTimeout(() => input.focus(), 200);
        }

        function closeChat() {
            isOpen = false;
            panel.classList.remove('open');
            bubble.style.background = 'linear-gradient(135deg, #2563EB, #0EA5E9)';
            clearInterval(pollInterval);
            pollInterval = null;
            mentionDiv.style.display = 'none';
        }

        bubble.addEventListener('click', () => isOpen ? closeChat() : openChat());
        closeBtn.addEventListener('click', closeChat);

        // ── Input auto-resize ────────────────────────────────────────
        function autoResize() {
            input.style.height = 'auto';
            input.style.height = Math.min(input.scrollHeight, 100) + 'px';
        }
        input.addEventListener('input', autoResize);

        // ── Send on Enter (Shift+Enter = newline) ────────────────────
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                mentionDiv.style.display = 'none';
                sendMessage();
            }
        });
        sendBtn.addEventListener('click', () => { mentionDiv.style.display = 'none'; sendMessage(); });

        // ── @mention autocomplete ────────────────────────────────────
        input.addEventListener('input', function() {
            const val = input.value;
            const atIdx = val.lastIndexOf('@');
            if (atIdx === -1) { mentionDiv.style.display = 'none'; return; }
            const query = val.slice(atIdx + 1).toLowerCase();
            const matches = staffList.filter(s => s.name.toLowerCase().startsWith(query));
            if (!matches.length) { mentionDiv.style.display = 'none'; return; }

            mentionDiv.innerHTML = matches.slice(0, 6).map(s => `
                <div class="mention-item" data-name="${s.name}">
                    <img class="mention-avatar-sm" src="https://ui-avatars.com/api/?name=${encodeURIComponent(s.name)}&color=7F9CF5&background=EBF4FF" alt="${s.name}">
                    ${s.name}
                </div>`).join('');
            mentionDiv.style.display = 'block';

            mentionDiv.querySelectorAll('.mention-item').forEach(item => {
                item.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    const newVal = val.slice(0, atIdx) + '@' + name + ' ';
                    input.value = newVal;
                    mentionDiv.style.display = 'none';
                    input.focus();
                    autoResize();
                });
            });
        });

        document.addEventListener('click', function(e) {
            if (!mentionDiv.contains(e.target) && e.target !== input) {
                mentionDiv.style.display = 'none';
            }
        });

        // ── Poll even when closed (silent badge) ─────────────────────
        // Fetch once on page load to initialize badges
        fetchMessages(false, true);
        
        // Light poll every 15s when panel is closed to show badge
        setInterval(() => { if (!isOpen) fetchMessages(false, false); }, 15000);
    })();
    </script>
    @endif

    @stack('modals')
</body>

</html>