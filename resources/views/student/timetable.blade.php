@extends('student.layouts.app')

@section('title', 'My Timetable')

@push('styles')
<style>
    .day-column { margin-bottom: 24px; }
    .day-header { font-weight: 500; font-size: 0.85rem; color: #2563EB; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
    .day-header::after { content: ''; flex-grow: 1; height: 1px; background: #E2E8F0; }
    
    .slot-card { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 20px; margin-bottom: 18px; transition: all 0.3s; box-shadow: 0 4px 12px -4px rgba(37, 99, 235, 0.08); }
    .slot-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px -6px rgba(37, 99, 235, 0.15); border-color: #2563EB; }
    
    .slot-time { font-weight: 500; font-size: 0.85rem; color: #2563EB; margin-bottom: 10px; }
    .slot-subject { font-weight: 500; font-size: 1rem; color: #0F172A; margin-bottom: 4px; }
    .slot-teacher { font-size: 0.85rem; color: #64748B; display: flex; align-items: center; gap: 6px; }
    .slot-room { font-size: 0.8rem; font-weight: 600; color: #64748B; margin-top: 12px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.08) 0%, rgba(16, 185, 129, 0.08) 100%); display: inline-flex; align-items: center; gap: 4px; padding: 6px 12px; border-radius: 8px; }
</style>
@endpush

@section('content')
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
@endsection
