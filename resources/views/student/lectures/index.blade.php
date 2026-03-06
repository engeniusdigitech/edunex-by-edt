<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Lectures - {{ auth('student')->user()->institute->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-color: #4F46E5; --secondary-color: #EC4899; --bg-color: #FAFAF9; }
        body { font-family: 'Outfit', sans-serif; background-color: var(--bg-color); color: #1E293B; overflow-x: hidden; }
        .bg-map { position: fixed; top: -20vh; left: -20vw; width: 60vw; height: 60vh; background: radial-gradient(circle, rgba(79, 70, 229, 0.05), transparent 60%); z-index: -1; pointer-events: none; }
        .navbar { background: rgba(255, 255, 255, 0.9) !important; backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0,0,0,0.05); padding: 16px 0; }
        .card { border: 1px solid rgba(0,0,0,0.03); border-radius: 20px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.02); background: #ffffff; }
        .subject-header { color: var(--primary-color); border-bottom: 2px solid rgba(79, 70, 229, 0.1); padding-bottom: 10px; margin-bottom: 20px; font-weight: 700; }
        
        /* Live Card Styling */
        .live-session-card {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-radius: 20px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            animation: pulse-shadow 2s infinite;
        }
        .live-session-card::before {
            content: '';
            position: absolute;
            top: -40%; right: -20%;
            width: 250px; height: 250px;
            background: radial-gradient(circle, rgba(255,255,255,0.15), transparent 70%);
            pointer-events: none;
        }
        @keyframes pulse-shadow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.3); }
            50% { box-shadow: 0 0 0 16px rgba(239,68,68,0); }
        }
        .live-badge-student {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.25); color: white;
            font-size: 0.75rem; font-weight: 700;
            padding: 4px 12px; border-radius: 20px; letter-spacing: 1px;
        }
        .live-badge-student .dot { width: 8px; height: 8px; background: white; border-radius: 50%; animation: blink 1s infinite; }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.2} }
        .btn-join-live {
            background: white; color: #ef4444;
            border: none; border-radius: 50px;
            padding: 12px 32px; font-weight: 800;
            font-size: 1rem; cursor: pointer;
            transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 10px;
        }
        .btn-join-live:hover { transform: scale(1.04); box-shadow: 0 10px 20px rgba(0,0,0,0.2); color: #dc2626; }
        
        /* Regular lecture card */
        .lecture-card { transition: all 0.3s ease; height: 100%; }
        .lecture-card:hover { box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); transform: translateY(-2px); border-color: var(--primary-color) !important; }
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
                <span class="me-3"><i class="fas fa-user-circle me-2 text-primary fs-4"></i><span class="fw-semibold">{{ auth('student')->user()->name }}</span></span>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="fw-bold mb-1" style="letter-spacing: -1px;">Live Lectures</h1>
                <p class="text-muted fs-5 mb-0">Lectures for {{ auth('student')->user()->batch->name }}</p>
            </div>
            <i class="fas fa-broadcast-tower fa-3x" style="color: var(--primary-color); opacity: 0.1;"></i>
        </div>

        {{-- ===== LIVE NOW SECTION ===== --}}
        @if($liveLectures->isNotEmpty())
        <div class="mb-5">
            <h4 class="fw-bold mb-3 text-danger"><i class="fas fa-circle me-2" style="animation: blink 1s infinite; font-size: 0.8rem;"></i> Happening Now</h4>
            <div class="row g-4">
                @foreach($liveLectures as $lecture)
                <div class="col-md-6 col-lg-4">
                    <div class="live-session-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="live-badge-student"><div class="dot"></div> LIVE</div>
                            <span class="text-white-50 small">{{ $lecture->subject }}</span>
                        </div>
                        <h4 class="fw-bold text-white mb-1">{{ $lecture->title }}</h4>
                        @if($lecture->description)
                            <p class="text-white-50 small mb-4">{{ Str::limit($lecture->description, 80) }}</p>
                        @else
                            <div class="mb-4"></div>
                        @endif
                        <a href="{{ route('student.lectures.join', $lecture) }}" class="btn-join-live">
                            <i class="fas fa-video"></i> Join Live Session
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- ===== PAST LECTURES SECTION ===== --}}
        @if($groupedLectures->isNotEmpty())
        <div>
            <h4 class="fw-bold mb-4">Recording Library</h4>
            @foreach($groupedLectures as $subject => $lectures)
            <div class="mb-5">
                <h5 class="subject-header"><i class="fas fa-book me-2"></i>{{ $subject }}</h5>
                <div class="row g-4">
                    @foreach($lectures as $lecture)
                    <div class="col-md-6 col-lg-4">
                        <div class="card lecture-card p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="fw-bold mb-0 text-dark">{{ $lecture->title }}</h5>
                                <span class="badge bg-light text-secondary border rounded-pill px-2 py-1">
                                    <i class="far fa-calendar-alt me-1"></i>{{ $lecture->recorded_at->format('M d') }}
                                </span>
                            </div>
                            @if($lecture->description)
                                <p class="text-muted small mb-4">{{ Str::limit($lecture->description, 100) }}</p>
                            @else
                                <p class="text-muted small mb-4 opacity-50"><i>No description provided.</i></p>
                            @endif
                            <div class="mt-auto">
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border rounded-pill px-3 py-2 fw-semibold">
                                    <i class="fas fa-check-circle me-1"></i> Session Ended
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($liveLectures->isEmpty() && $groupedLectures->isEmpty())
        <div class="text-center py-5 bg-white border rounded-4 shadow-sm my-5">
            <i class="fas fa-broadcast-tower fa-4x text-muted mb-3 opacity-25"></i>
            <h4 class="fw-bold text-dark">No Lectures Yet</h4>
            <p class="text-muted mb-0">Check back when your teacher starts a live session!</p>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
