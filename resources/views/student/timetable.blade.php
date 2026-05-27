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
            --primary-blue: #2563EB;
            --primary-blue-light: #3B82F6;
            --primary-blue-dark: #1D4ED8;
            --primary-green: #10B981;
            --primary-green-light: #34D399;
            --primary-green-dark: #059669;
            --gradient-blue-green: linear-gradient(135deg, #2563EB 0%, #0D9488 50%, #10B981 100%);
            --gradient-blue-green-reverse: linear-gradient(135deg, #10B981 0%, #0D9488 50%, #2563EB 100%);
            --amber: #F59E0B;
            --red: #EF4444;
            --bg: #F0F9FF;
            --card: #ffffff;
            --border: #E0F2FE;
            --text: #0F172A;
            --muted: #64748B;
            --radius: 20px;
        }

        body { font-family: 'Inter', sans-serif; background: linear-gradient(180deg, #F0F9FF 0%, #ECFDF5 100%); color: var(--text); min-height: 100vh; }
        .top-navbar { background: #fff; border-bottom: 1px solid var(--border); padding: 0 32px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-brand .brand-badge { width: 40px; height: 40px; background: var(--gradient-blue-green); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; font-weight: 500; color: #fff; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); }
        .nav-brand .brand-name { font-size: 0.95rem; font-weight: 500; color: var(--text); }
        
        .page { max-width: 1400px; margin: 0 auto; padding: 28px 24px 60px; }
        .day-column { margin-bottom: 24px; }
        .day-header { font-weight: 500; font-size: 0.85rem; color: var(--primary-blue); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
        .day-header::after { content: ''; flex-grow: 1; height: 1px; background: var(--border); }
        
        .slot-card { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; margin-bottom: 18px; transition: all 0.3s; box-shadow: 0 4px 12px -4px rgba(37, 99, 235, 0.08); }
        .slot-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px -6px rgba(37, 99, 235, 0.15); border-color: var(--primary-blue); }
        
        .slot-time { font-weight: 500; font-size: 0.85rem; color: var(--primary-blue); margin-bottom: 10px; }
        .slot-subject { font-weight: 500; font-size: 1rem; color: var(--text); margin-bottom: 4px; }
        .slot-teacher { font-size: 0.85rem; color: var(--muted); display: flex; align-items: center; gap: 6px; }
        .slot-room { font-size: 0.8rem; font-weight: 600; color: var(--muted); margin-top: 12px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.08) 0%, rgba(16, 185, 129, 0.08) 100%); display: inline-flex; align-items: center; gap: 4px; padding: 6px 12px; border-radius: 8px; }
        
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
            <a href="{{ route('student.dashboard') }}" class="text-muted text-decoration-none small fw-medium">DASHBOARD</a>
            <form action="{{ route('student.logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger border-0 fw-medium">LOGOUT</button>
            </form>
        </div>
    </nav>

    <div class="page">
        <div class="mb-4">
            <h4 class="fw-medium mb-1">Your Weekly Timetable</h4>
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
                            <p class="small fw-medium">No Classes</p>
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
