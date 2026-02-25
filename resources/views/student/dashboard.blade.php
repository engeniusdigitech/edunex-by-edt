<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - EduCore</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#4F46E5">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #EC4899;
            --bg-color: #FAFAF9;
        }
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: var(--bg-color); 
            color: #1E293B;
            overflow-x: hidden;
            position: relative;
        }
        
        /* Background Gradient Map */
        .bg-map {
            position: fixed;
            top: -20vh; left: -20vw; width: 60vw; height: 60vh;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.05), transparent 60%);
            z-index: -1; pointer-events: none;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 16px 0;
        }
        .navbar-brand { font-weight: 800; color: #1E293B !important; font-size: 1.25rem; }
        
        /* Cards */
        .card { 
            border: 1px solid rgba(0,0,0,0.03); 
            border-radius: 20px; 
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.02); 
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }
        .card-stat { background: #ffffff; }
        .icon-box { 
            width: 50px; height: 50px; 
            border-radius: 14px; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 20px; color: white; 
        }

        /* Banner */
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary-color), #818CF8);
            border-radius: 20px;
            color: white;
            box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.3);
            position: relative;
            overflow: hidden;
        }
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background: radial-gradient(circle at top right, rgba(255,255,255,0.2), transparent 60%);
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="bg-map"></div>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top mb-5">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center mb-0 text-decoration-none" style="padding: 0;">
                <!-- Icon Wrapper -->
                <div class="me-2 d-flex align-items-center justify-content-center shadow-sm" 
                     style="width: 44px; height: 44px; background: linear-gradient(135deg, rgba(79,70,229,0.1), rgba(236,72,153,0.1)); border-radius: 12px; border: 1px solid rgba(79,70,229,0.15);">
                    <i class="fas fa-layer-group fs-5" 
                       style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                </div>
                <!-- Text Details -->
                <div class="d-flex flex-column justify-content-center">
                    <span class="fw-bolder" style="font-size: 1.35rem; letter-spacing: -0.5px; line-height: 1;">
                        <span style="color: var(--dark-bg) !important;">{{ $student->institute->name }}</span>
                    </span>
                    <span class="fw-bold" style="font-size: 0.65rem; letter-spacing: 1px; text-transform: uppercase; margin-top: 3px; display: flex; align-items: center; color: var(--text-muted) !important;">
                        <span style="display: inline-block; width: 12px; height: 2px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border-radius: 2px; margin-right: 6px;"></span>
                        Powered by EduCore
                    </span>
                </div>
            </a>
            <div class="d-flex align-items-center ms-auto">
                <span class="me-4 fw-semibold text-secondary d-none d-sm-block">{{ $student->name }}</span>
                <form method="POST" action="{{ route('student.logout') }}" class="m-0">
                    @csrf
                    <button class="btn btn-outline-danger shadow-sm fw-semibold" style="border-radius: 50px; padding: 6px 20px;">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <!-- Welcome Banner -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 welcome-banner">
                    <div class="card-body p-5 d-flex justify-content-between align-items-center z-1">
                        <div>
                            <span class="badge bg-white text-primary fw-bold mb-3 px-3 py-2 rounded-pill shadow-sm">Student Dashboard</span>
                            <h2 class="fw-bold mb-2 display-6">Welcome back, {{ explode(' ', $student->name)[0] }}!</h2>
                            <p class="mb-0 text-white-50 fs-5">Here is an overview of your progress in <strong class="text-white">{{ $student->batch->name ?? 'your batch' }}</strong>.</p>
                        </div>
                        <div class="d-none d-md-block text-white opacity-25">
                            <i class="fas fa-user-graduate" style="font-size: 8rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications Area -->
        @if($student->unreadNotifications->count() > 0)
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0" style="border-left: 4px solid var(--secondary-color) !important; background: rgba(255, 255, 255, 0.8);">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-4 text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem;">
                            <i class="fas fa-bell text-pink-500 me-2" style="color: var(--secondary-color);"></i> Action Required ({{ $student->unreadNotifications->count() }})
                        </h6>
                        @foreach($student->unreadNotifications as $notification)
                        <div class="alert bg-white border border-light shadow-sm alert-dismissible fade show mb-3 d-flex align-items-center rounded-4 p-3" role="alert">
                            <div class="icon-box bg-{{ $notification->data['color'] ?? 'primary' }} bg-opacity-10 me-4 flex-shrink-0" style="color: var(--{{ $notification->data['color'] == 'danger' ? 'secondary' : 'primary' }}-color, #4F46E5);">
                                <i class="{{ $notification->data['icon'] ?? 'fas fa-info-circle' }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-dark fw-bold">{{ $notification->data['title'] }}</h6>
                                <p class="mb-0 text-muted">{{ $notification->data['message'] }}</p>
                            </div>
                            <form action="{{ route('student.notifications.read', $notification->id) }}" method="POST" class="ms-3">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-light border shadow-sm rounded-circle" style="width: 32px; height: 32px; padding: 0;"><i class="fas fa-check text-success"></i></button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row g-5">
            <!-- Left Column: Stats -->
            <div class="col-md-4">
                <h5 class="fw-bold mb-4 text-dark fs-4">Overview</h5>
                
                <div class="card card-stat mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 1px;">Attendance Rate</h6>
                                <h2 class="mb-0 fw-black {{ $attendancePercentage >= 75 ? 'text-success' : 'text-danger' }}" style="font-weight: 800;">
                                    {{ $attendancePercentage }}<small class="fs-5">%</small>
                                </h2>
                            </div>
                            <div class="icon-box" style="background: {{ $attendancePercentage >= 75 ? 'linear-gradient(135deg, #10B981, #34D399)' : 'linear-gradient(135deg, #EF4444, #F87171)' }}; box-shadow: 0 10px 15px -3px {{ $attendancePercentage >= 75 ? 'rgba(16, 185, 129, 0.3)' : 'rgba(239, 68, 68, 0.3)' }}">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-muted small">
                            You have attended <strong class="text-dark">{{ $presentClasses }}</strong> out of <strong class="text-dark">{{ $totalClasses }}</strong> recorded classes.
                        </div>
                        <div class="progress mt-3 rounded-pill" style="height: 8px; background-color: #F1F5F9;">
                            <div class="progress-bar rounded-pill {{ $attendancePercentage >= 75 ? 'bg-success' : 'bg-danger' }}" role="progressbar" style="width: {{ $attendancePercentage }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="card card-stat">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 1px;">Active Batch</h6>
                                <h5 class="mb-1 fw-bold text-dark">{{ $student->batch->name ?? 'Not Assigned' }}</h5>
                                <div class="text-muted small border-top pt-2 mt-2"><i class="far fa-clock me-1"></i> {{ $student->batch->schedule_time ?? 'Schedule pending' }}</div>
                            </div>
                            <div class="icon-box" style="background: linear-gradient(135deg, #3B82F6, #60A5FA); box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Homework Area -->
                <h5 class="fw-bold mt-5 mb-4 text-dark fs-4">Current Assignments</h5>
                @forelse($activeHomeworks as $hw)
                <div class="card border-0 mb-3" style="border-left: 4px solid var(--primary-color) !important;">
                    <div class="card-body p-3 d-flex align-items-center">
                        <div class="icon-box bg-primary bg-opacity-10 me-3 shadow-none text-primary" style="width: 40px; height: 40px; border-radius: 10px;">
                            <i class="fas fa-book-open fs-6"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold text-dark">{{ $hw->title }}</h6>
                            <div class="small fw-semibold text-danger"><i class="far fa-clock me-1"></i> Due: {{ $hw->due_date->format('M d, Y') }}</div>
                        </div>
                    </div>
                    @if($hw->description)
                    <div class="card-footer bg-white border-top-0 pt-0 pb-3 ps-5 ms-3">
                        <p class="small text-muted mb-0">{{ $hw->description }}</p>
                    </div>
                    @endif
                </div>
                @empty
                <div class="card border-0 bg-transparent shadow-none mb-4">
                    <div class="card-body py-4 px-0 text-center text-muted">
                        <i class="fas fa-check-circle fs-3 text-success opacity-50 mb-2"></i>
                        <h6 class="fw-semibold">All caught up!</h6>
                        <p class="small mb-0">No active homework assignments for your batch.</p>
                    </div>
                </div>
                @endforelse

                <!-- Tests Area -->
                <h5 class="fw-bold mt-5 mb-4 text-dark fs-4">Tests & Exams</h5>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-pill px-4 fw-semibold" id="pills-upcoming-tab" data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button" role="tab">Upcoming</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-4 fw-semibold" id="pills-results-tab" data-bs-toggle="pill" data-bs-target="#pills-results" type="button" role="tab">Past Results</button>
                    </li>
                </ul>
                
                <div class="tab-content" id="pills-tabContent">
                    <!-- Upcoming Tests Tab -->
                    <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel">
                        @forelse($upcomingTests as $test)
                        <div class="card border-0 mb-3">
                            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="text-center me-4 pe-4 border-end">
                                        <div class="text-primary fw-bold text-uppercase small">{{ $test->test_date->format('M') }}</div>
                                        <h3 class="fw-black text-dark mb-0 lh-1">{{ $test->test_date->format('d') }}</h3>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold text-dark">{{ $test->title }}</h6>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-3">
                                            Max Marks: {{ $test->total_marks }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-muted">
                            <p class="small mb-0">No upcoming tests scheduled.</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Past Results Tab -->
                    <div class="tab-pane fade" id="pills-results" role="tabpanel">
                        @forelse($pastTests as $test)
                        <div class="card border-0 mb-3 bg-light bg-opacity-50">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1 fw-bold text-dark">{{ $test->title }}</h6>
                                        <div class="small fw-semibold text-muted">{{ $test->test_date->format('M d, Y') }}</div>
                                    </div>
                                    @php
                                        $score = $test->scores->first();
                                    @endphp
                                    <div class="text-end">
                                        @if($score)
                                            <div class="fw-black text-primary fs-5">{{ $score->score }} <span class="text-muted fw-semibold fs-6">/ {{ $test->total_marks }}</span></div>
                                            @if($score->remarks)
                                                <div class="small text-muted fst-italic mt-1">{{ $score->remarks }}</div>
                                            @endif
                                        @else
                                            <span class="badge bg-warning bg-opacity-25 text-warning-emphasis rounded-pill px-3">Result Pending</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-muted">
                            <p class="small mb-0">No past test results available yet.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Right Column: Payments -->
            <div class="col-md-8">
                <h5 class="fw-bold mb-4 text-dark fs-4">Recent Transactions</h5>
                
                <div class="card border-0 bg-white">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead style="background-color: #F8FAFC;">
                                    <tr>
                                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Date</th>
                                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Details</th>
                                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Amount</th>
                                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentPayments as $payment)
                                    <tr>
                                        <td class="ps-4 py-4 text-muted fw-medium">{{ $payment->payment_date->format('M d, Y') }}</td>
                                        <td class="py-4">
                                            <div class="fw-bold text-dark mb-1">{{ $payment->feeStructure->name ?? 'General Fee' }}</div>
                                            <div class="small text-muted">
                                            @if($payment->payment_method === 'online')
                                                <i class="fas fa-credit-card me-1 border p-1 rounded"></i> Transfer
                                            @else
                                                <i class="fas fa-money-bill me-1 border p-1 rounded"></i> Cash
                                            @endif
                                            </div>
                                        </td>
                                        <td class="py-4 fw-black text-dark fs-5" style="font-family: monospace;">₹{{ number_format($payment->amount_paid, 2) }}</td>
                                        <td class="py-4">
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2 fw-bold">Success</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    @if($recentPayments->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                                <i class="fas fa-receipt fa-2x"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">No transaction history</h6>
                                            <p class="text-muted small mb-0">Your payment records will appear here.</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Branding Removed -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(function(registration) {
                    console.log('PWA ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    console.log('PWA ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
</body>
</html>
