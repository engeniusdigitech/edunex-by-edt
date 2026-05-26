@extends('layouts.admin')

@section('title', 'Staff Attendance Report')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold mb-1">Staff Attendance</h3>
        <p class="text-muted mb-0">Biometric mark-in / mark-out records</p>
    </div>
    <form method="GET" class="d-flex gap-2 align-items-center">
        <input type="date" name="date" class="form-control" value="{{ $date->format('Y-m-d') }}">
        <button class="btn btn-primary">View</button>
    </form>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Staff</th>
                    <th>Role</th>
                    <th>Mark IN</th>
                    <th>Mark OUT</th>
                    <th>Face</th>
                    <th>Distance (IN)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffMembers as $member)
                    @php $att = $attendances->get($member->id); @endphp
                    <tr>
                        <td class="fw-semibold">{{ $member->name }}</td>
                        <td><span class="badge bg-light text-dark">{{ $member->role->name }}</span></td>
                        <td>{{ $att?->mark_in_at?->format('h:i A') ?? '—' }}</td>
                        <td>{{ $att?->mark_out_at?->format('h:i A') ?? '—' }}</td>
                        <td>
                            @if($att?->face_verified_in)
                                <i class="fas fa-check-circle text-success" title="Verified"></i>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $att?->mark_in_distance_meters ? $att->mark_in_distance_meters . 'm' : '—' }}</td>
                        <td>
                            <span class="badge bg-{{ ($att && $att->mark_in_at) ? 'success' : 'secondary' }}">
                                {{ $att && $att->mark_in_at ? 'Present' : 'Absent' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
