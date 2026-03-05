<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduNex') - Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
            min-height: 100vh; 
            background: var(--dark-bg);
            border-right: 1px solid rgba(255,255,255,0.05);
            padding-top: 24px; 
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
            position: relative;
            z-index: 1040;
            transition: all 0.3s ease;
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
            margin-bottom: 12px; 
            margin-top: 24px;
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
            background-color: rgba(255,255,255,0.05); 
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
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5); z-index: 1030;
        }
        .sidebar-overlay.show { display: block; }

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
        .main-content { padding: 32px; position: relative; z-index: 1; }
        
        @media (max-width: 767.98px) {
            .main-content { padding: 16px; }
        }
        
        /* Background Gradient Map */
        .bg-map {
            position: fixed;
            top: -20vh; right: -20vw; width: 60vw; height: 60vh;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.04), transparent 60%);
            z-index: 0; pointer-events: none;
        }

        /* Top Navbar */
        .top-navbar {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 16px 32px;
        }
        @media (max-width: 767.98px) {
            .top-navbar { padding: 12px 16px; }
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
            border: 1px solid rgba(0,0,0,0.03); 
            border-radius: 20px; 
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.02); 
            transition: all 0.3s ease;
            background: #ffffff;
        }
        .card:hover {
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }
        .icon-box { 
            width: 56px; height: 56px; 
            border-radius: 16px; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 24px; color: white; 
            background: linear-gradient(135deg, var(--primary-color), #6366F1);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.2);
        }
        
        /* Badges & Overrides */
        .btn-modern {
            border-radius: 50px;
            padding: 8px 24px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="bg-map"></div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar d-flex flex-column h-100" id="adminSidebar">
                <div class="text-center d-block">
                    <a href="{{ url('/') }}" class="sidebar-brand mb-0 text-decoration-none d-flex flex-column align-items-center justify-content-center" style="padding: 10px 0;">
                        <img src="{{ asset('images/logo.png') }}" alt="EduCore Logo" class="img-fluid mb-2" style="max-height: 72px;">
                    </a>
                </div>
                
                @if(auth()->user() && auth()->user()->isSuperAdmin())
                    <h6 class="sidebar-header">Super Admin</h6>
                    <a href="{{ route('superadmin.dashboard') }}" class="{{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
                    <a href="{{ route('superadmin.institutes.index') }}" class="{{ request()->routeIs('superadmin.institutes.*') ? 'active' : '' }}"><i class="fas fa-school"></i> Institutes</a>
                    <a href="{{ route('superadmin.plans.index') }}" class="{{ request()->routeIs('superadmin.plans.*') ? 'active' : '' }}"><i class="fas fa-tags"></i> Plans</a>
                @else
                    <h6 class="sidebar-header">Institute Panel</h6>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
                    @can('manage-staff')
                    <a href="{{ route('staff.index') }}" class="{{ request()->routeIs('staff.*') ? 'active' : '' }}"><i class="fas fa-user-tie"></i> Staff</a>
                    @endcan
                    @can('manage-students')
                    <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}"><i class="fas fa-users"></i> Students</a>
                    @endcan
                    @can('manage-attendance')
                    <a href="{{ route('attendance.index') }}" class="{{ request()->routeIs('attendance.*') ? 'active' : '' }}"><i class="fas fa-calendar-check"></i> Attendance</a>
                    @endcan
                    @can('manage-payments')
                    <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*') ? 'active' : '' }}"><i class="fas fa-wallet"></i> Payments</a>
                    @endcan

                    <h6 class="sidebar-header mt-3">Academics</h6>
                    <a href="{{ route('homework.index') }}" class="{{ request()->routeIs('homework.*') ? 'active' : '' }}"><i class="fas fa-book-open"></i> Homework</a>
                    <a href="{{ route('tests.index') }}" class="{{ request()->routeIs('tests.*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Tests & Exams</a>
                    <a href="{{ route('live-lectures.index') }}" class="{{ request()->routeIs('live-lectures.*') ? 'active' : '' }}"><i class="fas fa-video"></i> Live Lectures</a>
                    
                    @if(auth()->user()->isInstituteAdmin())
                    <h6 class="sidebar-header mt-3">Analytics</h6>
                    <a href="{{ route('reports.attendance') }}" class="{{ request()->routeIs('reports.attendance') ? 'active' : '' }}"><i class="fas fa-chart-bar"></i> Attendance Rep</a>
                    <a href="{{ route('reports.defaulters') }}" class="{{ request()->routeIs('reports.defaulters') ? 'active' : '' }}"><i class="fas fa-exclamation-triangle"></i> Defaulters</a>
                    @endif
                @endif
                
                <div class="mt-auto mb-4 text-center w-100 px-3">
                </div>
            </div>
            
            <!-- Main Content Area -->
            <div class="col-md-10 vh-100 overflow-auto position-relative">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg top-navbar sticky-top">
                    <div class="container-fluid px-0">
                        <button class="btn border-0 d-md-none me-2 shadow-none" id="sidebarToggle">
                            <i class="fas fa-bars fs-4 text-dark"></i>
                        </button>
                        <span class="navbar-brand-title mb-0">@yield('title', 'Overview')</span>
                        <div class="d-flex align-items-center ms-auto">
                            <span class="user-profile me-3 d-none d-sm-inline-block"><i class="fas fa-user-circle me-2 text-primary"></i>{{ auth()->user()->name ?? 'Admin User' }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button class="btn btn-outline-danger btn-modern btn-sm"><i class="fas fa-sign-out-alt me-1"></i> <span class="d-none d-sm-inline">Logout</span></button>
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
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        });
        document.getElementById('sidebarOverlay')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
        });
    </script>
    @stack('scripts')
</body>
</html>
