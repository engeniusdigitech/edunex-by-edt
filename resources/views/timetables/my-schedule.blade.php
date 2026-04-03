@extends('layouts.admin')

@section('title', 'My Teaching Schedule')

@section('content')
<div class="row g-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                    <i class="fas fa-calendar-alt fa-2x"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1">Your Weekly Schedule</h4>
                    <p class="text-muted small mb-0">Overview of all your assigned batches and lectures.</p>
                </div>
            </div>
        </div>

        {{-- Weekly Grid --}}
        <div class="row g-4">
            @php
                $days = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'];
            @endphp
            
            @foreach($days as $dayNum => $dayName)
                <div class="col-xl col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                        <div class="card-header bg-white py-3 border-0 text-center border-bottom">
                            <h6 class="mb-0 fw-bold text-primary text-uppercase letter-spacing-1">{{ $dayName }}</h6>
                        </div>
                        <div class="card-body p-3 bg-light/30">
                            @php
                                $daySlots = ($slots[$dayNum] ?? collect())->sortBy('start_time');
                            @endphp

                            @forelse($daySlots as $slot)
                                <div class="bg-white border rounded-4 p-3 mb-3 shadow-sm hover-translate transition-all">
                                    <h6 class="fw-bold text-dark mb-2">{{ $slot->subject->name }}</h6>
                                    <div class="text-primary small fw-bold mb-2">
                                        <i class="far fa-clock me-1"></i> 
                                        {{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i class="fas fa-layer-group text-muted small" style="width: 14px;"></i>
                                        <span class="text-muted" style="font-size: 0.75rem;">Batch: <strong class="text-dark">{{ $slot->batch->name }}</strong></span>
                                    </div>
                                    @if($slot->room_number)
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-door-open text-muted small" style="width: 14px;"></i>
                                            <span class="text-muted" style="font-size: 0.7rem;">Room: {{ $slot->room_number }}</span>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-5 opacity-50">
                                    <i class="fas fa-coffee fa-2x mb-2"></i>
                                    <p class="small mb-0">Free Day</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .letter-spacing-1 { letter-spacing: 1px; }
    .transition-all { transition: all 0.3s ease; }
    .hover-translate:hover { transform: translateY(-5px); border-color: var(--bs-primary) !important; }
</style>
@endsection
