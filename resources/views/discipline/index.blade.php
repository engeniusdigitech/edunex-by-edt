@extends('layouts.admin')

@section('title', 'Discipline Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Discipline Management</h4>
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logModal">
        <i class="fas fa-exclamation-triangle me-2"></i> Log Infraction
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Level</th>
                        <th>Points</th>
                        <th>Reason</th>
                        <th>Reported By</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr>
                            <td>{{ $record->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <div class="fw-medium">{{ $record->student->name }}</div>
                                <div class="small text-muted">{{ $record->student->batch->name ?? '' }}</div>
                            </td>
                            <td>
                                @if($record->issue_level == 'small')
                                    <span class="badge bg-warning text-dark"><i class="fas fa-exclamation-circle me-1"></i> Small</span>
                                @elseif($record->issue_level == 'mid')
                                    <span class="badge bg-orange text-white" style="background-color: #fd7e14;"><i class="fas fa-exclamation-triangle me-1"></i> Mid</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-radiation me-1"></i> Big</span>
                                @endif
                            </td>
                            <td class="text-danger fw-bold">-{{ $record->points_deducted }}</td>
                            <td>{{ Str::limit($record->reason, 50) }}</td>
                            <td>{{ $record->reporter->name ?? 'System' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No discipline records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $records->links() }}
        </div>
    </div>
</div>

<!-- Log Infraction Modal -->
@push('modals')
<div class="modal fade" id="logModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header bg-danger text-white border-bottom-0 rounded-top-4">
                <h5 class="modal-title fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> Log Infraction</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('discipline.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Student</label>
                        <select name="student_id" class="form-select" required>
                            <option value="">Select a student...</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->batch->name ?? 'No batch' }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium">Issue Level</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="issue_level" id="levelSmall" value="small" required>
                                <label class="form-check-label text-warning fw-medium" for="levelSmall">Small (-1 pts)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="issue_level" id="levelMid" value="mid">
                                <label class="form-check-label fw-medium" style="color: #fd7e14;" for="levelMid">Mid (-3 pts)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="issue_level" id="levelBig" value="big">
                                <label class="form-check-label text-danger fw-medium" for="levelBig">Big (-5 pts)</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Detailed Reason</label>
                        <textarea name="reason" class="form-control" rows="3" required placeholder="Describe the incident..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4">Submit Log</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush
@endsection
