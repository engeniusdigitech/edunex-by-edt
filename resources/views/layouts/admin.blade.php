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
            --primary-color: #2563EB;
            --secondary-color: #10B981;
            --dark-bg: #0F172A;
            --sidebar-bg: #ffffff;
            --bg-color: #d9f1e1;
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
            background-color: #eefaf3;
            border-right: 1px solid #d3ebd6;
            padding-top: 0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 1040;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(25, 135, 84, 0.2);
            border-radius: 10px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(25, 135, 84, 0.4);
        }

        .sidebar-brand-container {
            padding: 28px 20px;
            border-bottom: 1px solid #d3ebd6;
            background-color: #e2f4e8;
            position: relative;
        }

        .sidebar-brand-name {
            font-size: 0.95rem;
            font-weight: 800;
            color: #0f5132;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sidebar-brand-subtitle {
            font-size: 0.6rem;
            color: #198754;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 800;
            margin-top: 6px;
        }

        .sidebar-header {
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            margin-top: 28px;
            color: #4a6d59;
            padding-left: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar-header::after {
            content: '';
            flex-grow: 1;
            height: 1px;
            background: #d3ebd6;
            margin-right: 16px;
        }

        .sidebar a {
            color: #355245;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 16px;
            margin: 2px 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.88rem;
            position: relative;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .sidebar a i {
            width: 22px;
            text-align: center;
            margin-right: 12px;
            font-size: 1.1rem;
            color: #557c67;
            transition: all 0.2s;
        }

        .sidebar a:hover {
            background-color: #dbf2e3;
            color: #0f5132;
            border-color: #c3ebd0;
            padding-left: 20px;
        }

        .sidebar a:hover i {
            color: #198754;
            transform: scale(1.05);
        }

        .sidebar a.active {
            background-color: #d1e7dd;
            color: #0f5132;
            font-weight: 700;
            border-left: 4px solid #198754;
            border-radius: 0 12px 12px 0;
            margin-left: 0;
            padding-left: 24px;
            border-color: #b7dbcb #b7dbcb #b7dbcb #198754;
        }

        .sidebar a.active i {
            color: #0f5132;
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
            background: radial-gradient(circle, rgba(37, 99, 235, 0.04), transparent 60%);
            z-index: 0;
            pointer-events: none;
        }

        /* Top Navbar */
        .top-navbar {
            background: #ffffff !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 16px 32px;
        }

        @media (max-width: 767.98px) {
            .top-navbar {
                padding: 12px 16px;
            }
        }

        .navbar-brand-title {
            font-weight: 500;
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
            background: linear-gradient(135deg, var(--primary-color), #0EA5E9);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
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
            transition: transform 0.2s ease;
            font-size: 0.72rem;
            color: #557c67;
        }
        .sidebar a[data-bs-toggle="collapse"]:not(.collapsed) .dropdown-arrow {
            transform: rotate(180deg);
            color: #0f5132;
        }
        .sidebar .collapse {
            position: relative;
            padding-left: 8px;
            margin-left: 28px;
            border-left: 1px dashed #a3cfbb;
            margin-bottom: 6px;
            margin-top: 2px;
        }
        .sidebar .collapse a {
            margin: 2px 10px 2px 0 !important;
            font-size: 0.82rem;
            padding: 8px 12px !important;
            color: #4a6d59;
            border-radius: 8px;
            font-weight: 500;
        }
        .sidebar .collapse a:hover {
            background-color: #dbf2e3 !important;
            color: #0f5132;
            padding-left: 16px !important;
            border-left: none !important;
        }
        .sidebar .collapse a.active {
            background-color: #d1e7dd !important;
            color: #0f5132 !important;
            border-left: none !important;
            padding-left: 12px !important;
            border-radius: 8px !important;
            margin-left: 0 !important;
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
                <div class="sidebar-brand-container text-center">
                    <div class="sidebar-brand-name px-2 text-truncate">
                        @if(auth()->check() && auth()->user()->institute_id && auth()->user()->institute)
                            {{ auth()->user()->institute->name }}
                        @elseif(auth()->check() && auth()->user()->isSuperAdmin())
                            Super Admin
                        @else
                            EduNex
                        @endif
                    </div>
                    <div class="sidebar-brand-subtitle">Admin Portal</div>
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

                    @can('manage-attendance')
                        @php
                            $showAttendance = !auth()->user()->isTeacher() || auth()->user()->isClassTeacher();
                        @endphp
                        @if($showAttendance)
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

                    @can('manage-visitors')
                        <a href="{{ route('visitors.index') }}" class="{{ request()->routeIs('visitors.*') ? 'active' : '' }}">
                            <i class="fas fa-id-badge"></i> Visitor Management
                        </a>
                    @endcan

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

                    

                    @if(!auth()->user()->isReceptionist() && !auth()->user()->isLibrarian())
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

                        @php
                            $isHomeworkLecturesActive = request()->routeIs('homework.*') || request()->routeIs('live-lectures.*');
                        @endphp
                        <a href="#homeworkLecturesCollapse" data-bs-toggle="collapse" class="{{ $isHomeworkLecturesActive ? '' : 'collapsed' }}" aria-expanded="{{ $isHomeworkLecturesActive ? 'true' : 'false' }}">
                            <i class="fas fa-book-open"></i>
                            <span class="flex-grow-1">Homework &amp; Lectures</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="collapse {{ $isHomeworkLecturesActive ? 'show' : '' }}" id="homeworkLecturesCollapse">
                            <a href="{{ route('homework.index') }}" class="{{ request()->routeIs('homework.*') ? 'active' : '' }} small py-2"><i class="fas fa-book-open"></i> Homework</a>
                            @if(auth()->user()->institute->feature_live_classes)
                                <a href="{{ route('live-lectures.index') }}" class="{{ request()->routeIs('live-lectures.*') ? 'active' : '' }} small py-2"><i class="fas fa-video"></i> Live Lectures</a>
                            @endif
                        </div>

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

                        <!-- Hostel Management -->
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
                            <a href="{{ route('hostels.index') }}" class="{{ request()->routeIs('hostels.*') ? 'active' : '' }} small py-2"><i class="fas fa-hotel"></i> Hostels &amp; Rooms</a>
                            <a href="{{ route('hostel-allocations.index') }}" class="{{ request()->routeIs('hostel-allocations.*') ? 'active' : '' }} small py-2"><i class="fas fa-user-tag"></i> Room Allocations</a>
                            <a href="{{ route('hostel-messes.index') }}" class="{{ request()->routeIs('hostel-messes.*') ? 'active' : '' }} small py-2"><i class="fas fa-utensils"></i> Mess &amp; Menus</a>
                            <a href="{{ route('hostel-bills.index') }}" class="{{ request()->routeIs('hostel-bills.*') ? 'active' : '' }} small py-2"><i class="fas fa-file-invoice-dollar"></i> Hostel Invoices</a>
                        </div>

                        <!-- Store & Inventory -->
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
                            <a href="{{ route('inventory-items.index') }}" class="{{ request()->routeIs('inventory-items.*') ? 'active' : '' }} small py-2"><i class="fas fa-boxes-stacked"></i> Stock Items</a>
                            <a href="{{ route('inventory-suppliers.index') }}" class="{{ request()->routeIs('inventory-suppliers.*') ? 'active' : '' }} small py-2"><i class="fas fa-truck-field"></i> Suppliers / Vendors</a>
                            <a href="{{ route('purchase-orders.index') }}" class="{{ request()->routeIs('purchase-orders.*') ? 'active' : '' }} small py-2"><i class="fas fa-file-signature"></i> Purchase Orders</a>
                        </div>
                    @endif

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

                    @if(auth()->user()->isInstituteAdmin() || auth()->user()->isPrincipal())
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
                        @if(auth()->user()->isInstituteAdmin() || auth()->user()->isTeacher() || auth()->user()->isPrincipal() || auth()->user()->isReceptionist() || auth()->user()->isLibrarian())
                            <a href="{{ route('notifications.index') }}" class="{{ request()->routeIs('notifications.*') ? 'active' : '' }} small py-2"><i class="fas fa-bell"></i> Notifications</a>
                        @endif
                        @if($showGallery)
                            <a href="{{ route('gallery.index') }}" class="{{ request()->routeIs('gallery.*') ? 'active' : '' }} small py-2"><i class="fas fa-images"></i> Image Gallery</a>
                        @endif
                        @if($showDiscipline)
                            <a href="{{ route('discipline.index') }}" class="{{ request()->routeIs('discipline.*') ? 'active' : '' }} small py-2"><i class="fas fa-balance-scale"></i> Discipline</a>
                        @endif
                    </div>

                    @if(auth()->user()->isInstituteAdmin() || auth()->user()->isTeacher() || auth()->user()->isPrincipal() || auth()->user()->isReceptionist() || auth()->user()->isLibrarian())
                        @php
                            $isReportsActive = request()->routeIs('reports.defaulters') || request()->routeIs('reports.attendance');
                            $showAttendanceRep = !auth()->user()->isTeacher() || auth()->user()->isClassTeacher();
                            $showDefaultersRep = auth()->user()->isInstituteAdmin() || auth()->user()->isReceptionist();
                        @endphp
                        @if(!auth()->user()->isLibrarian() && ($showAttendanceRep || $showDefaultersRep))
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
                            </div>
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
            background: linear-gradient(135deg, #2563EB, #0EA5E9);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            cursor: pointer;
            z-index: 9000;
            box-shadow: 0 8px 24px rgba(37,99,235,0.4);
            transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.3s;
            border: none;
        }
        #chatBubble:hover { transform: scale(1.12); box-shadow: 0 12px 32px rgba(37,99,235,0.5); }
        #chatBadgeLeft {
            position: absolute;
            top: -4px; left: -4px;
            background: #EF4444;
            color: #fff;
            border-radius: 50%;
            width: 20px; height: 20px;
            font-size: 0.65rem;
            font-weight: 500;
            display: none;
            align-items: center;
            justify-content: center;
        }
        #chatBadgeRight {
            position: absolute;
            top: -4px; right: -4px;
            background: #F59E0B;
            color: #fff;
            border-radius: 50%;
            width: 20px; height: 20px;
            font-size: 0.75rem;
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
            background: #ffffff;
            border: 1px solid rgba(37,99,235,0.12);
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
            background: linear-gradient(135deg, #2563EB, #0EA5E9);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .chat-header-title { color: #fff; font-weight: 500; font-size: 1rem; display: flex; align-items: center; gap: 10px; }
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
        .chat-sender { font-size: 0.65rem; font-weight: 500; color: #64748B; margin-bottom: 3px; }
        .chat-msg.me .chat-sender { color: #2563EB; }
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
            background: linear-gradient(135deg, #2563EB, #0EA5E9);
            color: #fff;
            border: none;
            border-radius: 16px 16px 4px 16px;
        }
        .chat-time { font-size: 0.6rem; color: #94A3B8; margin-top: 3px; }
        .chat-mention { color: #2563EB; font-weight: 500; background: rgba(37,99,235,0.08); border-radius: 4px; padding: 0 3px; }
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
        #chatInput:focus { border-color: #2563EB; background: #fff; }
        #chatSendBtn {
            width: 40px; height: 40px; border-radius: 12px;
            background: linear-gradient(135deg, #2563EB, #0EA5E9);
            color: #fff; border: none; font-size: 0.9rem;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; flex-shrink: 0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        #chatSendBtn:hover { transform: scale(1.08); box-shadow: 0 4px 12px rgba(37,99,235,0.35); }
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
        .mention-item:hover { background: #EFF6FF; color: #2563EB; }
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
        <span id="chatBadgeLeft"></span>
        <i class="fas fa-comments"></i>
        <span id="chatBadgeRight"></span>
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
            <textarea id="chatInput" rows="1" placeholder="Use @ to mention someone"></textarea>
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