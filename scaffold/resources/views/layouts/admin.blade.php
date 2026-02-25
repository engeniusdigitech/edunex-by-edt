<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduCore Dashboard')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #2c3e50; padding-top: 20px; }
        .sidebar a { color: #ecf0f1; text-decoration: none; display: block; padding: 10px 20px; margin-bottom: 5px; }
        .sidebar a:hover, .sidebar a.active { background-color: #34495e; border-left: 4px solid #3498db; }
        .main-content { padding: 20px; }
        .card-stat { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .icon-box { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: white; }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar d-none d-md-block">
                <h4 class="text-white text-center mb-4"><i class="fas fa-graduation-cap"></i> EduCore</h4>
                <a href="{{ route('dashboard') }}" class="active"><i class="fas fa-home me-2"></i> Dashboard</a>
                <a href="{{ route('students.index') }}"><i class="fas fa-users me-2"></i> Students</a>
                <a href="{{ route('attendance.index') }}"><i class="fas fa-calendar-check me-2"></i> Attendance</a>
                <a href="{{ route('payments.index') }}"><i class="fas fa-wallet me-2"></i> Payments</a>
                <a href="#"><i class="fas fa-cog me-2"></i> Settings</a>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">@yield('title', 'Dashboard')</span>
                        <div class="d-flex align-items-center">
                            <span class="me-3">{{ auth()->user()->name ?? 'Admin User' }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm">Logout</button>
                            </form>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="main-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
