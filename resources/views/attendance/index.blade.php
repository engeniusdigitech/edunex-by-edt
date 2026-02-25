@extends('layouts.admin')

@section('title', 'Mark Attendance')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">Daily Attendance</h4>
        <p class="text-muted small mb-0">Record and monitor class attendance</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
</div>
@endif

<div class="card border-0 bg-white mb-5">
    <div class="card-body p-4">
        <form action="{{ route('attendance.index') }}" method="GET" class="row gx-4 align-items-end">
            <div class="col-md-4">
                <label class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Select Date</label>
                <input type="date" name="date" class="form-control form-control-lg bg-light border-0" value="{{ $date }}" required>
            </div>
            <div class="col-md-5">
                <label class="form-label text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">Select Batch</label>
                <select name="batch_id" class="form-select form-select-lg bg-light border-0" required>
                    <option value="">Choose Batch...</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ $batchId == $batch->id ? 'selected' : '' }}>
                            {{ $batch->name }} ({{ $batch->schedule_time }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-modern w-100 py-3"><i class="fas fa-search me-2"></i> Load Roster</button>
            </div>
        </form>
    </div>
</div>

@if($batchId && $students->isEmpty())
    <div class="alert alert-warning bg-warning bg-opacity-10 border border-warning-subtle text-warning-emphasis rounded-4 p-4 text-center">
        <i class="fas fa-exclamation-circle fa-2x mb-3"></i>
        <h6 class="fw-bold">No Students Found</h6>
        <p class="small mb-0">There are no active students assigned to this batch.</p>
    </div>
@elseif($batchId && $students->isNotEmpty())
    <div class="card border-0 bg-white shadow-sm">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2 px-4">
            <h5 class="fw-bold text-dark mb-0">Roster for {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</h5>
        </div>
        <div class="card-body p-0">
            <form action="{{ route('attendance.store') }}" method="POST">
                @csrf
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="batch_id" value="{{ $batchId }}">
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background-color: #F8FAFC;">
                            <tr>
                                <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Student Information</th>
                                <th class="py-3 text-end pe-4 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Attendance Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                @php
                                    $status = $student->attendances->first()->status ?? 'present'; // Default present
                                @endphp
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            @if($student->profile_image)
                                            <img src="{{ asset('storage/'.$student->profile_image) }}" class="rounded-circle me-3 object-fit-cover border" width="40" height="40">
                                            @else
                                            <div class="bg-secondary bg-opacity-10 text-secondary border rounded-circle d-flex justify-content-center align-items-center me-3 fw-bold" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                                {{ substr($student->name, 0, 2) }}
                                            </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold text-dark">{{ $student->name }}</div>
                                                <div class="small text-muted"><i class="fas fa-phone-alt me-1 text-opacity-50"></i> {{ $student->phone }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 text-end pe-4">
                                        <div class="btn-group shadow-sm rounded-pill p-1 bg-light border" role="group">
                                            <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]" id="present_{{ $student->id }}" value="present" {{ $status == 'present' ? 'checked' : '' }}>
                                            <label class="btn btn-sm btn-outline-success rounded-pill px-4 fw-medium border-0" for="present_{{ $student->id }}">Present</label>

                                            <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]" id="late_{{ $student->id }}" value="late" {{ $status == 'late' ? 'checked' : '' }}>
                                            <label class="btn btn-sm btn-outline-warning rounded-pill px-4 fw-medium border-0 mx-1" for="late_{{ $student->id }}">Late</label>

                                            <input type="radio" class="btn-check" name="attendance[{{ $student->id }}]" id="absent_{{ $student->id }}" value="absent" {{ $status == 'absent' ? 'checked' : '' }}>
                                            <label class="btn btn-sm btn-outline-danger rounded-pill px-4 fw-medium border-0" for="absent_{{ $student->id }}">Absent</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-light border-top text-end rounded-bottom d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-modern px-5 py-2">
                        <i class="fas fa-save me-2"></i> Save Records
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

@endsection
