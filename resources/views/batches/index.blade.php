@extends('layouts.admin')

@section('title', 'Manage Batches')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">Batches</h4>
        <p class="text-muted small mb-0">Manage the batches and classes offered by your institute</p>
    </div>
    <button type="button" class="btn btn-primary btn-modern shadow-sm" data-bs-toggle="modal" data-bs-target="#addBatchModal">
        <i class="fas fa-plus me-2"></i> Add Batch
    </button>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
</div>
@endif

<!-- Filters -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
        <form action="{{ route('batches.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0" placeholder="Search batches by name..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 btn-modern">Filter</button>
                    @if(request()->filled('search'))
                        <a href="{{ route('batches.index') }}" class="btn btn-light border w-100 btn-modern">Clear</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 bg-white shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F8FAFC;">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Batch Name</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Schedule</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Created At</th>
                        <th class="py-3 text-end pe-4 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($batches as $batch)
                    <tr>
                        <td class="ps-4 py-3 fw-bold text-dark">{{ $batch->name }}</td>
                        <td class="py-3 text-muted">{{ $batch->schedule_time ?? 'Not Specified' }}</td>
                        <td class="py-3">
                            @if($batch->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2 fw-medium">Active</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill px-3 py-2 fw-medium">Inactive</span>
                            @endif
                        </td>
                        <td class="py-3 text-muted fw-medium">{{ $batch->created_at->format('M d, Y') }}</td>
                        <td class="py-3 text-end pe-4">
                            <button type="button" class="btn btn-sm btn-light text-primary border shadow-sm rounded-circle p-2 me-1 edit-batch-btn" 
                                data-id="{{ $batch->id }}" data-name="{{ $batch->name }}" data-schedule="{{ $batch->schedule_time }}" data-is_active="{{ $batch->is_active }}"
                                data-bs-toggle="modal" data-bs-target="#editBatchModal" title="Edit Batch">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            <form action="{{ route('batches.destroy', $batch) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this batch? This will affect all associated students, subjects, and records.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger border shadow-sm rounded-circle p-2" title="Delete Batch"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                    @if($batches->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                <i class="fas fa-users-class fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark">No batches found</h6>
                            <p class="text-muted small mb-0">Get started by creating your first batch.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-4">
    {{ $batches->links() }}
</div>
@endsection

@section('modals')
<!-- Add Batch Modal -->
<div class="modal fade" id="addBatchModal" tabindex="-1" aria-labelledby="addBatchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="addBatchModalLabel">Add New Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('batches.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Batch Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Class 10th A, Morning Batch">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Schedule Days</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                <div class="form-check form-check-inline m-0 border px-3 py-2 rounded-3 bg-light" style="cursor: pointer;">
                                    <input class="form-check-input mt-1" type="checkbox" name="days[]" value="{{ $day }}" id="add_day_{{ $day }}" style="cursor: pointer;">
                                    <label class="form-check-label ms-1 user-select-none fw-medium text-dark" for="add_day_{{ $day }}" style="cursor: pointer;">{{ $day }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Start Time</label>
                            <input type="time" name="start_time" class="form-control rounded-3" id="start_time">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">End Time</label>
                            <input type="time" name="end_time" class="form-control rounded-3" id="end_time">
                        </div>
                    </div>
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActiveAdd" value="1" checked>
                        <label class="form-check-label" for="isActiveAdd">Active Batch</label>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Batch</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Batch Modal -->
<div class="modal fade" id="editBatchModal" tabindex="-1" aria-labelledby="editBatchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="editBatchModalLabel">Edit Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editBatchForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Batch Name</label>
                        <input type="text" name="name" id="editBatchName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Schedule Days</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                <div class="form-check form-check-inline m-0 border px-3 py-2 rounded-3 bg-light" style="cursor: pointer;">
                                    <input class="form-check-input mt-1 edit-day-checkbox" type="checkbox" name="days[]" value="{{ $day }}" id="edit_day_{{ $day }}" style="cursor: pointer;">
                                    <label class="form-check-label ms-1 user-select-none fw-medium text-dark" for="edit_day_{{ $day }}" style="cursor: pointer;">{{ $day }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Start Time</label>
                            <input type="time" name="start_time" class="form-control rounded-3" id="edit_start_time">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">End Time</label>
                            <input type="time" name="end_time" class="form-control rounded-3" id="edit_end_time">
                        </div>
                    </div>
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="editBatchIsActive" value="1">
                        <label class="form-check-label" for="editBatchIsActive">Active Batch</label>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Batch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function convertTo24Hour(time12h) {
            if(!time12h) return '';
            const match = time12h.match(/(\d+):(\d+)\s*(AM|PM)/i);
            if(!match) return time12h; // fallback
            let hours = parseInt(match[1], 10);
            const minutes = match[2];
            const modifier = match[3].toUpperCase();
            
            if (hours === 12) {
                hours = 0;
            }
            if (modifier === 'PM') {
                hours += 12;
            }
            return `${hours.toString().padStart(2, '0')}:${minutes}`;
        }

        const editBtns = document.querySelectorAll('.edit-batch-btn');
        const editForm = document.getElementById('editBatchForm');
        const editName = document.getElementById('editBatchName');
        const editIsActive = document.getElementById('editBatchIsActive');
        const editStartTime = document.getElementById('edit_start_time');
        const editEndTime = document.getElementById('edit_end_time');

        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const schedule = this.dataset.schedule || '';
                const isActive = this.dataset.is_active;

                editForm.action = `/batches/${id}`;
                editName.value = name;
                editIsActive.checked = isActive == '1' || isActive == true;

                // Reset fields
                document.querySelectorAll('.edit-day-checkbox').forEach(cb => cb.checked = false);
                editStartTime.value = '';
                editEndTime.value = '';

                // Parse schedule: "Mon, Wed (09:00 AM - 10:30 AM)"
                const match = schedule.match(/^(.*?)\s*\((.*?)\s*-\s*(.*?)\)$/);
                if (match) {
                    const days = match[1].split(',').map(d => d.trim());
                    const start = convertTo24Hour(match[2].trim());
                    const end = convertTo24Hour(match[3].trim());

                    days.forEach(d => {
                        const cb = document.getElementById(`edit_day_${d}`);
                        if(cb) cb.checked = true;
                    });
                    editStartTime.value = start;
                    editEndTime.value = end;
                }
            });
        });
    });
</script>
@endsection
