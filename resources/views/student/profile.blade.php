<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile — {{ $student->institute->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #2563EB;
            --primary-blue-light: #3B82F6;
            --primary-blue-dark: #1D4ED8;
            --primary-green: #10B981;
            --primary-green-light: #34D399;
            --primary-green-dark: #059669;
            --gradient-blue-green: linear-gradient(135deg, #2563EB 0%, #0D9488 50%, #10B981 100%);
            --gradient-blue-green-reverse: linear-gradient(135deg, #10B981 0%, #0D9488 50%, #2563EB 100%);
            --bg: #F8FAFC;
            --card: #ffffff;
            --border: #E0F2FE;
            --text: #0F172A;
            --muted: #64748B;
            --radius: 20px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            font-family: 'Inter', sans-serif;
            background: #F8FAFC;
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── SIDEBAR LAYOUT ── */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: #fff;
            border-right: 1px solid var(--border);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-brand .brand-logo {
            width: 44px;
            height: 44px;
            background: var(--gradient-blue-green);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 500;
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .sidebar-brand .brand-text {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text);
            line-height: 1.2;
        }

        .sidebar-brand .brand-sub {
            font-size: 0.65rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 16px;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-section-title {
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--muted);
            margin-bottom: 12px;
            padding-left: 12px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--muted);
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            margin-bottom: 4px;
        }

        .nav-item:hover {
            background: rgba(37, 99, 235, 0.06);
            color: var(--primary-blue);
        }

        .nav-item.active {
            background: var(--gradient-blue-green);
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(16, 185, 129, 0.05) 100%);
            border-radius: 14px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.7rem;
            color: var(--muted);
        }

        .logout-btn {
            width: 36px;
            height: 36px;
            border: none;
            background: rgba(239, 68, 68, 0.1);
            border-radius: 10px;
            color: var(--red);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn:hover {
            background: var(--red);
            color: #fff;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 32px;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            width: 44px;
            height: 44px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-name {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text);
            line-height: 1.1;
        }

        .brand-sub {
            font-size: 0.62rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 0.95rem;
            color: var(--muted);
        }

        .profile-header {
            background: var(--gradient-blue-green);
            border-radius: var(--radius);
            padding: 48px;
            color: #fff;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px -12px rgba(37, 99, 235, 0.25), 0 10px 20px -8px rgba(16, 185, 129, 0.2);
        }

        .profile-header::after {
            content: "\f19d";
            font-family: "Font Awesome 6 Free";
            font-weight: 500;
            position: absolute;
            right: -30px;
            bottom: -30px;
            font-size: 12rem;
            opacity: 0.08;
            transform: rotate(-15deg);
        }

        .profile-img-container {
            width: 120px;
            height: 120px;
            position: relative;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            border-radius: 32px;
            object-fit: cover;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        .img-edit-btn {
            position: absolute;
            bottom: -6px;
            right: -6px;
            width: 36px;
            height: 36px;
            background: var(--gradient-blue-green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            transition: all 0.2s;
        }

        .img-edit-btn:hover {
            transform: scale(1.1);
        }

        .card-custom {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 36px;
            box-shadow: 0 8px 20px -6px rgba(37, 99, 235, 0.08);
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid var(--border);
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s;
            background: #fcfdfe;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: #fff;
        }

        .back-btn {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            transition: color 0.2s;
        }

        .back-btn:hover {
            color: var(--primary-blue);
        }

        .btn-save {
            background: var(--gradient-blue-green);
            border: none;
            border-radius: 14px;
            padding: 14px 36px;
            font-weight: 500;
            color: #fff;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        }

        .batch-info-tag {
            background: rgba(255, 255, 255, 0.25);
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.78rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body>

    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <div class="mobile-overlay" onclick="toggleSidebar()"></div>

    <!-- ── SIDEBAR ── -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('student.dashboard') }}" class="sidebar-brand">
                @if($student->institute && $student->institute->logo)
                    <img src="{{ asset('storage/' . $student->institute->logo) }}" alt="Logo"
                        class="brand-logo" style="width: 44px; height: 44px; object-fit: cover;">
                @else
                    <div class="brand-logo">EN</div>
                @endif
                <div>
                    <div class="brand-text">{{ $student->institute->name ?? 'EduNex' }}</div>
                    <div class="brand-sub">Student Portal</div>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Main</div>
                <a href="{{ route('student.dashboard') }}" class="nav-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('student.timetable.index') }}" class="nav-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Timetable</span>
                </a>
                <a href="{{ route('student.lectures.index') }}" class="nav-item">
                    <i class="fas fa-video"></i>
                    <span>Live Lectures</span>
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Academics</div>
                <a href="{{ route('student.fees.index') }}" class="nav-item">
                    <i class="fas fa-wallet"></i>
                    <span>Fees & Payments</span>
                </a>
                <a href="{{ route('student.leaves.index') }}" class="nav-item">
                    <i class="fas fa-calendar-minus"></i>
                    <span>Leave Requests</span>
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Account</div>
                <a href="{{ route('student.profile.edit') }}" class="nav-item active">
                    <i class="fas fa-user-circle"></i>
                    <span>My Profile</span>
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <img src="{{ $student->profile_image_url }}" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <div class="user-name">{{ $student->name }}</div>
                    <div class="user-role">Student</div>
                </div>
                <form method="POST" action="{{ route('student.logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ── MAIN CONTENT ── -->
    <div class="main-content">
        <div class="page">
        <a href="{{ route('student.dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="profile-header">
            <div class="d-flex align-items-center gap-4 flex-wrap flex-sm-nowrap">
                <div class="profile-img-container">
                    <img src="{{ $student->profile_image_url }}" alt="Profile" class="profile-img" id="display-img">
                </div>
                <div>
                    <h2 class="mb-2 fw-medium">{{ $student->name }}</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <div class="batch-info-tag">
                            <i class="fas fa-users"></i> {{ $student->batch->name ?? 'No Batch' }}
                        </div>
                        <div class="batch-info-tag">
                            <i class="fas fa-id-card"></i> ID: #{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom">
            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile_image" id="profile_image_input" class="d-none" accept="image/*">
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control bg-light" value="{{ $student->email }}" disabled>
                            <p class="text-muted mt-2 mb-0" style="font-size: 0.75rem;">Email cannot be changed.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enrolled Since</label>
                            <input type="text" class="form-control bg-light" value="{{ $student->enrollment_date->format('d M Y') }}" disabled>
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="opacity: 0.1;">

                <div class="d-flex justify-content-center align-items-center p-3 bg-light rounded-4 border">
                    <p class="text-muted mb-0 small fw-medium text-center">
                        <i class="fas fa-info-circle me-1"></i> Profile editing is managed by the administration. Please contact your coordinator for any changes.
                    </p>
                </div>
            </form>
        </div><!-- /page -->
    </div><!-- /main-content -->

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.mobile-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }

        document.getElementById('profile_image_input').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('display-img').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
</body>

</html>
