<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Timetable — EduNex</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --indigo: #6366F1;
            --indigo-dark: #4F46E5;
            --pink: #EC4899;
            --emerald: #10B981;
            --amber: #F59E0B;
            --red: #EF4444;
            --bg: #F1F5F9;
            --card: #ffffff;
            --border: #E2E8F0;
            --text: #0F172A;
            --muted: #64748B;
            --radius: 16px;
        }

        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        .top-navbar { background: #fff; border-bottom: 1px solid var(--border); padding: 0 32px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-brand .brand-badge { width: 36px; height: 36px; background: linear-gradient(135deg, var(--indigo), var(--pink)); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; font-weight: 800; color: #fff; }
        .nav-brand .brand-name { font-size: 0.95rem; font-weight: 700; color: var(--text); }
        
        .page { max-width: 1400px; margin: 0 auto; padding: 28px 24px 60px; }
        .day-column { margin-bottom: 24px; }
        .day-header { font-weight: 800; font-size: 0.85rem; color: var(--indigo); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
        .day-header::after { content: ''; flex-grow: 1; height: 1px; background: var(--border); }
        
        .slot-card { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px; margin-bottom: 16px; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .slot-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); border-color: var(--indigo); }
        
        .slot-time { font-weight: 700; font-size: 0.82rem; color: var(--indigo); margin-bottom: 8px; }
        .slot-subject { font-weight: 800; font-size: 1rem; color: var(--text); margin-bottom: 4px; }
        .slot-teacher { font-size: 0.85rem; color: var(--muted); display: flex; align-items: center; gap: 6px; }
        .slot-room { font-size: 0.78rem; font-weight: 600; color: var(--muted); margin-top: 10px; background: #F8FAFC; display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 6px; }
        
        @media (max-width: 640px) {
            .top-navbar { padding: 0 16px; }
            .page { padding: 16px 12px 60px; }
        }
    </style>
</head>
<body>
    <nav class="top-navbar">
        <a href="{{ route('student.dashboard') }}" class="nav-brand">
            <div class="brand-badge text-uppercase">EN</div>
            <div class="brand-name">EDUNEX <span class="d-none d-sm-inline" style="font-size: 0.7rem; opacity: 0.6; margin-left: 5px;">STUDENT TIMETABLE</span></div>
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('student.dashboard') }}" class="text-muted text-decoration-none small fw-bold">DASHBOARD</a>
            <form action="{{ route('student.logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger border-0 fw-bold">LOGOUT</button>
            </form>
        </div>
    </nav>

    <div class="page">
        <div class="mb-4">
            <h4 class="fw-bold mb-1">Your Weekly Timetable</h4>
            <p class="text-muted small mb-0">Full schedule for <strong>{{ auth('student')->user()->batch->name }}</strong></p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mt-1">
            @php
                $days = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'];
            @endphp
            
            @foreach($days as $dayNum => $dayName)
                <div class="col day-column">
                    <div class="day-header">
                        <i class="far fa-calendar-alt"></i> {{ $dayName }}
                    </div>
                    
                    @php
                        $daySlots = ($slots[$dayNum] ?? collect())->sortBy('start_time');
                    @endphp

                    @forelse($daySlots as $slot)
                        <div class="slot-card">
                            <div class="slot-time">
                                <i class="far fa-clock me-1"></i> 
                                {{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}
                            </div>
                            <div class="slot-subject">{{ $slot->subject->name }}</div>
                            <div class="slot-teacher">
                                <i class="fas fa-user-tie"></i> {{ $slot->teacher->name }}
                            </div>
                            @if($slot->room_number)
                                <div class="slot-room text-uppercase">
                                    <i class="fas fa-door-open"></i> Room: {{ $slot->room_number }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-4 opacity-25">
                            <i class="fas fa-calendar-minus fa-2x mb-2"></i>
                            <p class="small fw-bold">No Classes</p>
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
