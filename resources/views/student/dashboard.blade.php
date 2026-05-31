@extends('student.layouts.app')

@section('title', 'Student Dashboard')

@push('styles')
<style>
    /* Reset layout container since we don't have a sidebar anymore */
    .dashboard-container {
        padding: 10px 0;
    }

    /* Solid colors as requested */
    .box-attendance {
        background-color: #2563EB; /* Solid Blue */
        color: #fff;
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }
    
    .box-fees {
        background-color: #10B981; /* Solid Green */
        color: #fff;
        border-radius: 16px;
        padding: 24px;
        height: 100%;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .btn-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
        padding: 0 10px;
    }

    .page-btn {
        flex: 1 1 100px;
        min-width: 100px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px 10px;
        text-align: center;
        text-decoration: none;
        color: var(--text);
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        box-shadow: 0 4px 12px -4px rgba(0,0,0,0.05);
    }

    .page-btn:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        transform: translateY(-2px);
        color: #2563EB;
        border-color: rgba(37, 99, 235, 0.2);
    }

    .page-btn i {
        font-size: 1.8rem;
        color: #2563EB; /* Solid Blue icon */
        transition: transform 0.2s;
    }

    .page-btn:hover i {
        transform: scale(1.1);
    }

    .page-btn span {
        font-size: 0.85rem;
        font-weight: 600;
    }

    .more-arrow {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.9);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        background: rgba(0,0,0,0.15);
        padding: 6px 16px;
        border-radius: 50px;
        transition: background 0.2s;
    }

    .more-arrow:hover {
        color: #fff;
        background: rgba(0,0,0,0.25);
    }

    .notif-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    <div class="row g-4 mb-4">
        <!-- Attendance Block -->
        <div class="col-md-6">
            <div class="box-attendance d-flex flex-column justify-content-between">
                <div>
                    <h5 class="mb-3" style="font-weight: 600; opacity: 0.9;">Attendance</h5>
                    <div class="d-flex align-items-baseline gap-2 mb-2">
                        <h1 class="mb-0 fw-bold" style="font-size: 3rem; letter-spacing: -1px;">{{ $attendancePercentage }}%</h1>
                    </div>
                    <p style="opacity: 0.85; font-size:0.9rem; margin-bottom: 0;">You attended {{ $presentClasses }} out of {{ $totalClasses }} classes.</p>
                </div>
                <div class="text-end mt-4">
                    <a href="{{ route('student.attendance.index') }}" class="more-arrow">More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Fees Block -->
        <div class="col-md-6">
            <div class="box-fees d-flex flex-column justify-content-between">
                <div>
                    <h5 class="mb-3" style="font-weight: 600; opacity: 0.9;">Fees</h5>
                    @if($recentPayments && $recentPayments->count() > 0)
                        @php $last = $recentPayments->first(); @endphp
                        <div class="d-flex align-items-baseline gap-2 mb-2">
                            <h2 class="mb-0 fw-bold" style="font-size: 2.5rem; letter-spacing: -1px;">{{ currencySymbol() }}{{ number_format($last->amount_paid, 2) }}</h2>
                            <span style="opacity:0.85; font-size:0.9rem;">Last Paid</span>
                        </div>
                        <p style="opacity: 0.85; font-size:0.9rem; margin-bottom: 0;">{{ $last->payment_date->format('M d, Y') }} - {{ $last->feeStructure->name ?? 'Fee' }}</p>
                    @else
                        <div class="d-flex align-items-baseline gap-2 mb-2">
                            <h2 class="mb-0 fw-bold" style="font-size: 2.5rem; letter-spacing: -1px;">{{ currencySymbol() }}0.00</h2>
                        </div>
                        <p style="opacity: 0.85; font-size:0.9rem; margin-bottom: 0;">No recent fee transactions.</p>
                    @endif
                </div>
                <div class="text-end mt-4">
                    <a href="{{ route('student.fees.index') }}" class="more-arrow">More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Buttons Grid -->
    <div class="btn-grid">
        <!-- Tests (Placeholder) -->
        <a href="{{ route('student.tests.index') }}" class="page-btn">
            <i class="fas fa-file-alt"></i>
            <span>Tests</span>
        </a>

        <!-- Library -->
        <a href="{{ route('student.library.index') }}" class="page-btn">
            <i class="fas fa-book-reader"></i>
            <span>Library</span>
        </a>
        
        <!-- Homework (Placeholder) -->
        <a href="{{ route('student.homework.index') }}" class="page-btn">
            <i class="fas fa-tasks"></i>
            <span>Homework</span>
        </a>
        
        <!-- Lectures -->
        @if(auth()->guard('student')->user()->institute->feature_live_classes)
        <a href="{{ route('student.lectures.index') }}" class="page-btn">
            <i class="fas fa-video"></i>
            <span>Lectures</span>
        </a>
        @endif
        
        <!-- Timetable -->
        <a href="{{ route('student.timetable.index') }}" class="page-btn">
            <i class="fas fa-calendar-alt"></i>
            <span>Timetable</span>
        </a>
        
        <!-- Leaves -->
        <a href="{{ route('student.leaves.index') }}" class="page-btn">
            <i class="fas fa-calendar-minus"></i>
            <span>Leaves</span>
        </a>
        
        <!-- Profile -->
        <a href="{{ route('student.profile.edit') }}" class="page-btn">
            <i class="fas fa-user-circle"></i>
            <span>Profile</span>
        </a>

        <!-- Image Gallery -->
        <a href="{{ route('student.gallery.index') }}" class="page-btn">
            <i class="fas fa-images"></i>
            <span>Image Gallery</span>
        </a>

        <!-- Discipline -->
        <a href="{{ route('student.discipline.index') }}" class="page-btn">
            <i class="fas fa-balance-scale"></i>
            <span>Discipline</span>
        </a>
    </div>

</div>
@endsection