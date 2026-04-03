@extends('layouts.admin')

@section('title', 'Timetable Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <form action="{{ route('timetables.index') }}" method="GET" class="d-flex align-items-center gap-2 m-0 flex-grow-1" id="batchFilterForm">
                        <label class="fw-bold text-secondary text-nowrap mb-0 small">SELECT BATCH:</label>
                        <select name="batch_id" class="form-select border-0 bg-light rounded-3 shadow-none w-auto" onchange="this.form.submit()">
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}" {{ $selectedBatchId == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </form>

                    @if(auth()->user()->isInstituteAdmin() || auth()->user()->isPrincipal() || auth()->user()->isSuperAdmin())
                        <button type="button" class="btn btn-primary btn-modern px-4 py-2" data-bs-toggle="modal" data-bs-target="#addSlotModal">
                            <i class="fas fa-plus me-2"></i> Add Slot
                        </button>
                    @endif
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        {{-- Weekly Grid --}}
        <div class="row g-4">
            @php
                $days = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'];
            @endphp
            
            @foreach($days as $dayNum => $dayName)
                <div class="col-xl col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                        <div class="card-header bg-primary py-3 border-0 text-center">
                            <h6 class="mb-0 fw-bold text-white text-uppercase letter-spacing-1">{{ $dayName }}</h6>
                        </div>
                        <div class="card-body p-3 bg-light/50">
                            @php
                                $daySlots = $slots->where('day', $dayNum)->sortBy('start_time');
                            @endphp

                            @forelse($daySlots as $slot)
                                <div class="bg-white border rounded-4 p-3 mb-3 shadow-sm hover-translate transition-all">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="fw-bold text-primary mb-0 small">{{ $slot->subject->name }}</h6>
                                        @if(auth()->user()->isInstituteAdmin() || auth()->user()->isPrincipal() || auth()->user()->isSuperAdmin())
                                            <form action="{{ route('timetables.destroy', $slot->id) }}" method="POST" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 shadow-none border-0" onclick="return confirm('Remove this slot?')">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="text-secondary small mb-2">
                                        <i class="far fa-clock me-1 text-primary"></i> 
                                        {{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i class="fas fa-user-tie text-muted" style="width: 14px;"></i>
                                        <span class="text-dark fw-semibold" style="font-size: 0.75rem;">{{ $slot->teacher->name }}</span>
                                    </div>
                                    @if($slot->room_number)
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-door-open text-muted" style="width: 14px;"></i>
                                            <span class="text-muted" style="font-size: 0.7rem;">Room: {{ $slot->room_number }}</span>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-4 opacity-50">
                                    <i class="fas fa-calendar-minus fa-2x mb-2"></i>
                                    <p class="small mb-0">No Classes</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('modals')
{{-- Add Slot Modal --}}
<div class="modal fade" id="addSlotModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Add Timetable Slot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('timetables.store') }}" method="POST">
                @csrf
                <input type="hidden" name="batch_id" value="{{ $selectedBatchId }}">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Subject</label>
                        <select name="subject_id" class="form-select border-0 bg-light rounded-3 shadow-none py-2" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Teacher</label>
                        <select name="user_id" class="form-select border-0 bg-light rounded-3 shadow-none py-2" required>
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Day</label>
                            <select name="day" class="form-select border-0 bg-light rounded-3 shadow-none py-2" required>
                                @foreach($days as $num => $name)
                                    <option value="{{ $num }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Room Number</label>
                            <input type="text" name="room_number" class="form-control border-0 bg-light rounded-3 shadow-none py-2" placeholder="e.g. 101">
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Start Time</label>
                            <input type="time" name="start_time" class="form-control border-0 bg-light rounded-3 shadow-none py-2" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">End Time</label>
                            <input type="time" name="end_time" class="form-control border-0 bg-light rounded-3 shadow-none py-2" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4">
                    <button type="button" class="btn btn-light rounded-3 px-4 py-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-modern px-5 py-2">Save Slot</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-light\/50 { background-color: rgba(248, 249, 250, 0.5); }
    .letter-spacing-1 { letter-spacing: 1px; }
    .transition-all { transition: all 0.3s ease; }
    .hover-translate:hover { transform: translateY(-5px); border-color: var(--bs-primary) !important; }
</style>
@endsection
