<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Lectures - {{ auth('student')->user()->institute->name }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
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
        
        /* Cards */
        .card { 
            border: 1px solid rgba(0,0,0,0.03); 
            border-radius: 20px; 
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.02); 
            background: #ffffff;
        }
        
        .lecture-card {
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .lecture-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
            transform: translateY(-2px);
            border-color: var(--primary-color) !important;
        }

        .subject-header {
            color: var(--primary-color);
            border-bottom: 2px solid rgba(79, 70, 229, 0.1);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .btn-modern {
            border-radius: 50px;
            padding: 8px 24px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="bg-map"></div>

    <nav class="navbar navbar-expand-lg sticky-top mb-5">
        <div class="container">
            <a href="{{ route('student.dashboard') }}" class="btn btn-light rounded-pill px-4 shadow-sm border me-3">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
            <div class="ms-auto d-flex align-items-center">
                <span class="user-profile me-3"><i class="fas fa-user-circle me-2 text-primary fs-4"></i><span class="fw-semibold">{{ auth('student')->user()->name }}</span></span>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-bold mb-1" style="color: #0F172A; letter-spacing: -1px;">Live Lectures</h1>
                <p class="text-muted fs-5 mb-0">Recordings for {{ auth('student')->user()->batch->name }}</p>
            </div>
            <i class="fas fa-video fa-3x" style="color: var(--primary-color); opacity: 0.1;"></i>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @forelse($groupedLectures as $subject => $lectures)
            <div class="mb-5">
                <h3 class="subject-header"><i class="fas fa-book me-2"></i>{{ $subject }}</h3>
                
                <div class="row g-4">
                    @foreach($lectures as $lecture)
                    <div class="col-md-6 col-lg-4">
                        <div class="card lecture-card p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="fw-bold mb-0 text-dark">{{ $lecture->title }}</h5>
                                <span class="badge bg-light text-secondary border border-secondary border-opacity-25 rounded-pill px-2 py-1">
                                    <i class="far fa-calendar-alt me-1"></i>{{ $lecture->recorded_at->format('M d') }}
                                </span>
                            </div>
                            
                            @if($lecture->description)
                                <p class="text-muted small mb-4">{{ Str::limit($lecture->description, 100) }}</p>
                            @else
                                <p class="text-muted small mb-4 opacity-50"><i>No description provided.</i></p>
                            @endif
                            
                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ Storage::disk('public')->url($lecture->video_path) }}" target="_blank" class="btn btn-primary d-inline-flex align-items-center justify-content-center flex-grow-1" style="border-radius: 12px; background: linear-gradient(135deg, var(--primary-color), #6366F1); border: none;">
                                    <i class="fas fa-play me-2"></i> Watch
                                </a>
                                <a href="{{ route('student.lectures.download', $lecture) }}" class="btn btn-light border d-inline-flex align-items-center justify-content-center" style="border-radius: 12px; height: 38px; width: 38px;" title="Download">
                                    <i class="fas fa-download text-secondary"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-5 bg-white border rounded-4 shadow-sm my-5">
                <i class="fas fa-video-slash fa-4x text-muted mb-3 opacity-25"></i>
                <h4 class="fw-bold text-dark">No Lectures Available</h4>
                <p class="text-muted mb-0">There are no live lecture recordings for your batch yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
