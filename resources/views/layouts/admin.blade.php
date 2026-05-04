<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EduNex') - Dashboard</title>
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
            --primary-color: #4F46E5;
            --secondary-color: #EC4899;
            --dark-bg: #0F172A;
            --sidebar-bg: #ffffff;
            --bg-color: #FAFAF9;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: #1E293B;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            overflow-y: auto;
            background: var(--dark-bg);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1040;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: #ffffff !important;
            letter-spacing: -0.5px;
            margin-bottom: 2rem;
        }

        .sidebar-header {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
            margin-top: 10px;
            color: #64748B;
            padding-left: 20px;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar a i {
            width: 24px;
            text-align: center;
            margin-right: 12px;
            color: #94A3B8;
            transition: color 0.3s;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            transform: translateX(4px);
        }

        .sidebar a:hover i {
            color: #ffffff;
        }

        .sidebar a.active {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.2), rgba(99, 102, 241, 0.2));
            color: #ffffff;
            font-weight: 600;
            border-left: 3px solid var(--primary-color);
            border-radius: 0 12px 12px 0;
            margin-left: 0;
            padding-left: 29px;
        }

        .sidebar a.active i {
            color: var(--primary-color);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1030;
        }

        .sidebar-overlay.show {
            display: block;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                left: -280px;
                width: 280px;
            }

            .sidebar.show {
                left: 0;
            }
        }

        /* Main Content Styling */
        .main-content {
            padding: 32px;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 767.98px) {
            .main-content {
                padding: 16px;
            }
        }

        /* Background Gradient Map */
        .bg-map {
            position: fixed;
            top: -20vh;
            right: -20vw;
            width: 60vw;
            height: 60vh;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.04), transparent 60%);
            z-index: 0;
            pointer-events: none;
        }

        /* Top Navbar */
        .top-navbar {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 16px 32px;
        }

        @media (max-width: 767.98px) {
            .top-navbar {
                padding: 12px 16px;
            }
        }

        .navbar-brand-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: #1E293B;
        }

        .user-profile {
            font-weight: 600;
            color: #475569;
            background: #F1F5F9;
            padding: 8px 16px;
            border-radius: 50px;
        }

        /* Cards */
        .card {
            border: 1px solid rgba(0, 0, 0, 0.03);
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            background: linear-gradient(135deg, var(--primary-color), #6366F1);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.2);
        }

        /* Badges & Overrides */
        .btn-modern {
            border-radius: 50px;
            padding: 8px 24px;
            font-weight: 600;
        }

        /* Sidebar Dropdown Styling */
        .sidebar a[data-bs-toggle="collapse"] {
            position: relative;
        }
        .sidebar a[data-bs-toggle="collapse"] .dropdown-arrow {
            transition: transform 0.3s ease;
            font-size: 0.75rem;
        }
        .sidebar a[data-bs-toggle="collapse"]:not(.collapsed) .dropdown-arrow {
            transform: rotate(180deg);
        }
        .sidebar .collapse a {
            margin-left: 20px;
            margin-right: 12px;
            font-size: 0.85rem;
            padding: 8px 16px;
        }
        .sidebar .collapse a i {
            font-size: 0.85rem;
            width: 20px;
        }
    </style>
</head>

<body>
    <div class="bg-map"></div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="container-fluid p-0" style="height:100vh;overflow:hidden;">
        <div class="row g-0" style="height:100vh;overflow:hidden;">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 sidebar d-flex flex-column h-100" id="adminSidebar">
                <div class="d-flex flex-column align-items-center gap-1 px-3 py-2"
                    style="border-bottom:1px solid rgba(255,255,255,0.06);text-align:center;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                        style="height:80px;width:80px;object-fit:contain;border-radius:14px;flex-shrink:0;">
                    <div style="line-height:1.2;min-width:0;">
                        <div
                            style="font-size:0.82rem;font-weight:700;color:#fff;overflow:hidden;text-overflow:ellipsis;">
                            @if(auth()->check() && auth()->user()->institute_id && auth()->user()->institute)
                                {{ auth()->user()->institute->name }}
                            @elseif(auth()->check() && auth()->user()->isSuperAdmin())
                                Super Admin
                            @else
                                EduNex
                            @endif
                        </div>
                        <div style="font-size:0.62rem;color:#64748B;text-transform:uppercase;letter-spacing:1px;">Admin
                            Panel</div>
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
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i
                            class="fas fa-home"></i> Dashboard</a>
                    @can('manage-staff')
                        @if(auth()->user()->isInstituteAdmin() && auth()->user()->institute->isSchool())
                            <a href="{{ route('principals.index') }}" class="{{ request()->routeIs('principals.*') ? 'active' : '' }}"><i
                                    class="fas fa-user-shield"></i> Principals</a>
                        @endif
                        <a href="{{ route('staff.index') }}" class="{{ request()->routeIs('staff.*') ? 'active' : '' }}"><i
                                class="fas fa-user-tie"></i> Staff</a>
                    @endcan
                    @can('manage-students')
                        <a href="{{ route('students.index') }}"
                            class="{{ request()->routeIs('students.*') ? 'active' : '' }}"><i class="fas fa-users"></i>
                            Students</a>
                    @endcan
                    @can('manage-attendance')
                        @php
                            $showAttendance = !auth()->user()->isTeacher() || auth()->user()->isClassTeacher();
                        @endphp
                        @if($showAttendance)
                            <a href="{{ route('attendance.index') }}"
                                class="{{ request()->routeIs('attendance.*') ? 'active' : '' }}"><i
                                    class="fas fa-calendar-check"></i> Attendance</a>
                        @endif
                    @endcan

                    <a href="{{ route('leaves.index') }}" class="{{ request()->routeIs('leaves.index') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i> Leave Management
                    </a>

                    @php
                        $user = auth()->user();
                        $canManageStudentLeaves = $user->isInstituteAdmin() || $user->isPrincipal() || $user->isClassTeacher();
                    @endphp

                    @if($canManageStudentLeaves)
                        <a href="{{ route('leaves.students') }}" class="{{ request()->routeIs('leaves.students') ? 'active' : '' }}">
                            <i class="fas fa-user-clock"></i> Student Leaves
                        </a>
                    @endif
                    @can('manage-payments')
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
                    @endcan

                    @if(!auth()->user()->isReceptionist())
                        <h6 class="sidebar-header mt-3">Academics</h6>
                        @can('manage-batches')
                            <a href="{{ route('batches.index') }}" class="{{ request()->routeIs('batches.*') ? 'active' : '' }}"><i
                                    class="fas fa-layer-group"></i> Batches</a>
                        @endcan
                        
                        @if(!auth()->user()->isTeacher())
                            <a href="{{ route('subjects.index') }}"
                                class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}"><i class="fas fa-book"></i>
                                Subjects</a>
                        @endif

                        <a href="{{ route('homework.index') }}"
                            class="{{ request()->routeIs('homework.*') ? 'active' : '' }}"><i class="fas fa-book-open"></i>
                            Homework</a>
                        
                        @if(!auth()->user()->isTeacher())
                            <a href="{{ route('timetables.index') }}" class="{{ request()->routeIs('timetables.index') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt"></i> Timetable
                            </a>
                        @endif
                        
                        @if(auth()->user()->isTeacher() || auth()->user()->isPrincipal() || auth()->user()->isInstituteAdmin())
                            <a href="{{ route('timetables.my-schedule') }}" class="{{ request()->routeIs('timetables.my-schedule') ? 'active' : '' }}">
                                <i class="fas fa-user-clock"></i> My Schedule
                            </a>
                        @endif

                        <a href="{{ route('tests.index') }}" class="{{ request()->routeIs('tests.*') ? 'active' : '' }}"><i
                                class="fas fa-file-alt"></i> Tests & Exams</a>
                        <a href="{{ route('live-lectures.index') }}"
                            class="{{ request()->routeIs('live-lectures.*') ? 'active' : '' }}"><i class="fas fa-video"></i>
                            Live Lectures</a>
                    @endif

                    @if(auth()->user()->isInstituteAdmin() || auth()->user()->isTeacher() || auth()->user()->isPrincipal() || auth()->user()->isReceptionist())
                        <h6 class="sidebar-header mt-3">Analytics & Reports</h6>
                        
                        @if(!auth()->user()->isReceptionist())
                            @php
                                $showAttendanceRep = !auth()->user()->isTeacher() || auth()->user()->isClassTeacher();
                            @endphp
                            @if($showAttendanceRep)
                                <a href="{{ route('reports.attendance') }}"
                                    class="{{ request()->routeIs('reports.attendance') ? 'active' : '' }}"><i
                                        class="fas fa-chart-bar"></i> Attendance Rep</a>
                            @endif
                            
                            @if(auth()->user()->isInstituteAdmin() || auth()->user()->isReceptionist())
                                <a href="{{ route('reports.defaulters') }}"
                                    class="{{ request()->routeIs('reports.defaulters') ? 'active' : '' }}"><i
                                        class="fas fa-exclamation-triangle"></i> Defaulters</a>
                            @endif
                        @endif

                        <a href="{{ route('notifications.index') }}"
                            class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}"><i class="fas fa-bell"></i>
                            Notifications</a>

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
                        <button class="btn border-0 d-md-none me-2 shadow-none" id="sidebarToggle">
                            <i class="fas fa-bars fs-4 text-dark"></i>
                        </button>
                        <span class="navbar-brand-title mb-0">@yield('title', 'Overview')</span>
                        <div class="d-flex align-items-center ms-auto">
                            <a href="{{ route('profile.edit') }}" class="text-decoration-none d-flex align-items-center me-3">
                                <img src="{{ auth()->user()->profile_image_url }}" 
                                     alt="Profile" 
                                     class="rounded-circle border border-2 border-white shadow-sm me-2" 
                                     style="width: 32px; height: 32px; object-fit: cover;">
                                <span class="user-profile d-none d-sm-inline-block text-dark fw-semibold">
                                    {{ auth()->user()->name ?? 'Admin User' }}
                                </span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button class="btn btn-outline-danger btn-modern btn-sm"><i
                                        class="fas fa-sign-out-alt me-1"></i> <span
                                        class="d-none d-sm-inline">Logout</span></button>
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
        /* Chat Bubble */
        #chatBubble {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4F46E5, #6366F1);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            cursor: pointer;
            z-index: 9000;
            box-shadow: 0 8px 24px rgba(79,70,229,0.4);
            transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.3s;
            border: none;
        }
        #chatBubble:hover { transform: scale(1.12); box-shadow: 0 12px 32px rgba(79,70,229,0.5); }
        #chatBadge {
            position: absolute;
            top: -4px; right: -4px;
            background: #EF4444;
            color: #fff;
            border-radius: 50%;
            width: 20px; height: 20px;
            font-size: 0.65rem;
            font-weight: 700;
            display: none;
            align-items: center;
            justify-content: center;
        }
        /* Chat Panel */
        #chatPanel {
            position: fixed;
            bottom: 96px;
            right: 28px;
            width: 360px;
            height: 520px;
            border-radius: 24px;
            background: rgba(255,255,255,0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(79,70,229,0.12);
            box-shadow: 0 24px 64px -12px rgba(0,0,0,0.18);
            z-index: 8999;
            display: none;
            flex-direction: column;
            overflow: hidden;
            transform-origin: bottom right;
            animation: chatOpen 0.3s cubic-bezier(0.34,1.56,0.64,1);
        }
        #chatPanel.open { display: flex; }
        @keyframes chatOpen {
            from { opacity: 0; transform: scale(0.85); }
            to   { opacity: 1; transform: scale(1); }
        }
        /* Panel Header */
        .chat-header {
            background: linear-gradient(135deg, #4F46E5, #6366F1);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .chat-header-title { color: #fff; font-weight: 700; font-size: 1rem; display: flex; align-items: center; gap: 10px; }
        .chat-online-dot { width: 8px; height: 8px; border-radius: 50%; background: #4ADE80; box-shadow: 0 0 6px #4ADE80; display: inline-block; }
        .chat-close-btn { background: rgba(255,255,255,0.2); border: none; color: #fff; border-radius: 8px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s; }
        .chat-close-btn:hover { background: rgba(255,255,255,0.35); }
        /* Messages */
        #chatMessages {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            background: #f8fafc;
        }
        #chatMessages::-webkit-scrollbar { width: 4px; }
        #chatMessages::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .chat-msg { display: flex; gap: 8px; align-items: flex-end; max-width: 88%; }
        .chat-msg.me { flex-direction: row-reverse; align-self: flex-end; }
        .chat-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            object-fit: cover; flex-shrink: 0;
            border: 2px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .chat-bubble-wrap { display: flex; flex-direction: column; }
        .chat-msg.me .chat-bubble-wrap { align-items: flex-end; }
        .chat-sender { font-size: 0.65rem; font-weight: 700; color: #64748B; margin-bottom: 3px; }
        .chat-msg.me .chat-sender { color: #4F46E5; }
        .chat-text {
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 16px 16px 16px 4px;
            padding: 8px 12px;
            font-size: 0.82rem;
            color: #1E293B;
            line-height: 1.5;
            word-break: break-word;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .chat-msg.me .chat-text {
            background: linear-gradient(135deg, #4F46E5, #6366F1);
            color: #fff;
            border: none;
            border-radius: 16px 16px 4px 16px;
        }
        .chat-time { font-size: 0.6rem; color: #94A3B8; margin-top: 3px; }
        .chat-mention { color: #4F46E5; font-weight: 700; background: rgba(79,70,229,0.08); border-radius: 4px; padding: 0 3px; }
        .chat-msg.me .chat-mention { color: rgba(255,255,255,0.9); background: rgba(255,255,255,0.15); }
        /* Input Area */
        .chat-input-area {
            padding: 12px 16px;
            background: #fff;
            border-top: 1px solid #E2E8F0;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            flex-shrink: 0;
        }
        #chatInput {
            flex: 1;
            border: 1.5px solid #E2E8F0;
            border-radius: 14px;
            padding: 10px 14px;
            font-size: 0.83rem;
            font-family: 'Outfit', sans-serif;
            resize: none;
            outline: none;
            transition: border-color 0.2s;
            line-height: 1.4;
            max-height: 100px;
            overflow-y: auto;
            background: #f8fafc;
        }
        #chatInput:focus { border-color: #4F46E5; background: #fff; }
        #chatSendBtn {
            width: 40px; height: 40px; border-radius: 12px;
            background: linear-gradient(135deg, #4F46E5, #6366F1);
            color: #fff; border: none; font-size: 0.9rem;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; flex-shrink: 0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        #chatSendBtn:hover { transform: scale(1.08); box-shadow: 0 4px 12px rgba(79,70,229,0.35); }
        /* Mention dropdown */
        #mentionDropdown {
            position: absolute;
            bottom: 78px;
            right: 28px;
            width: 200px;
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            z-index: 9001;
            display: none;
            overflow: hidden;
        }
        .mention-item {
            padding: 10px 14px;
            cursor: pointer;
            font-size: 0.82rem;
            font-weight: 600;
            color: #1E293B;
            transition: background 0.15s;
            display: flex; align-items: center; gap: 8px;
        }
        .mention-item:hover { background: #EEF2FF; color: #4F46E5; }
        .mention-avatar-sm {
            width: 24px; height: 24px; border-radius: 50%;
            object-fit: cover; border: 1px solid #E2E8F0;
        }
        /* Empty state */
        .chat-empty {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            color: #94A3B8; font-size: 0.82rem; text-align: center; gap: 8px;
        }
        @media (max-width: 480px) {
            #chatPanel { width: calc(100vw - 32px); right: 16px; bottom: 80px; }
            #mentionDropdown { right: 16px; }
        }
    </style>

    <!-- Mention Dropdown -->
    <div id="mentionDropdown"></div>

    <!-- Chat Bubble Button -->
    <button id="chatBubble" title="Staff Group Chat">
        <i class="fas fa-comments"></i>
        <span id="chatBadge"></span>
    </button>

    <!-- Chat Panel -->
    <div id="chatPanel">
        <div class="chat-header">
            <div class="chat-header-title">
                <span class="chat-online-dot"></span>
                Staff Group Chat
            </div>
            <button class="chat-close-btn" id="chatCloseBtn" title="Close chat">
                <i class="fas fa-times" style="font-size:0.8rem;"></i>
            </button>
        </div>
        <div id="chatMessages">
            <div class="chat-empty">
                <i class="fas fa-comments" style="font-size:2rem; opacity:0.3;"></i>
                <div>Loading messages...</div>
            </div>
        </div>
        <div class="chat-input-area">
            <textarea id="chatInput" rows="1" placeholder="Type a message... use @ to mention someone"></textarea>
            <button id="chatSendBtn" title="Send message"><i class="fas fa-paper-plane"></i></button>
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
        const badge      = document.getElementById('chatBadge');
        const mentionDiv = document.getElementById('mentionDropdown');

        let isOpen       = false;
        let pollInterval = null;
        let lastId       = 0;
        let staffList    = [];
        let isSending    = false;
        const CSRF       = document.querySelector('meta[name="csrf-token"]')?.content || '';

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

        function showBadge(n) {
            if (n > 0) { badge.style.display = 'flex'; badge.textContent = n > 9 ? '9+' : n; }
            else { badge.style.display = 'none'; }
        }

        // ── Fetch messages ──────────────────────────────────────────
        async function fetchMessages(initial = false) {
            try {
                const res  = await fetch('{{ route("chat.index") }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                const data = await res.json();
                staffList  = data.staff || [];

                if (initial) {
                    msgList.innerHTML = '';
                    if (data.messages.length === 0) {
                        msgList.innerHTML = '<div class="chat-empty"><i class="fas fa-comments" style="font-size:2rem;opacity:0.3;"></i><div>No messages yet. Say hi! 👋</div></div>';
                    } else {
                        data.messages.forEach(m => { msgList.appendChild(renderMessage(m)); });
                        if (data.messages.length) lastId = data.messages[data.messages.length - 1].id;
                        scrollBottom();
                    }
                } else {
                    // Only append new ones
                    let newCount = 0;
                    data.messages.forEach(m => {
                        if (m.id > lastId) {
                            const empty = msgList.querySelector('.chat-empty');
                            if (empty) empty.remove();
                            msgList.appendChild(renderMessage(m));
                            lastId = m.id;
                            newCount++;
                        }
                    });
                    if (newCount > 0) {
                        scrollBottom();
                        if (!isOpen) showBadge(newCount);
                    }
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
                    scrollBottom();
                }
            } catch(e) { input.value = text; console.warn('Send error', e); }
            finally { isSending = false; }
        }

        // ── Open / Close ─────────────────────────────────────────────
        function openChat() {
            isOpen = true;
            panel.classList.add('open');
            bubble.style.background = 'linear-gradient(135deg, #EC4899, #F43F5E)';
            showBadge(0);
            fetchMessages(true);
            pollInterval = setInterval(() => fetchMessages(false), 3000);
            setTimeout(() => input.focus(), 200);
        }

        function closeChat() {
            isOpen = false;
            panel.classList.remove('open');
            bubble.style.background = 'linear-gradient(135deg, #4F46E5, #6366F1)';
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
        // Light poll every 15s when panel is closed to show badge
        setInterval(() => { if (!isOpen) fetchMessages(false); }, 15000);
    })();
    </script>
    @endif
</body>

</html>