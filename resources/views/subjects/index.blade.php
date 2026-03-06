@extends('layouts.admin')

@section('title', 'Manage Subjects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">Subjects</h4>
        <p class="text-muted small mb-0">Manage the subjects offered by your institute</p>
    </div>
    <button type="button" class="btn btn-primary btn-modern shadow-sm" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
        <i class="fas fa-plus me-2"></i> Add Subject
    </button>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
</div>
@endif

<div class="card border-0 bg-white shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F8FAFC;">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Subject Name</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Batch</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Created At</th>
                        <th class="py-3 text-end pe-4 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td class="ps-4 py-3 fw-bold text-dark">{{ $subject->name }}</td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium">{{ $subject->batch->name ?? 'No Batch' }}</span>
                        </td>
                        <td class="py-3">
                            @if($subject->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2 fw-medium">Active</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill px-3 py-2 fw-medium">Inactive</span>
                            @endif
                        </td>
                        <td class="py-3 text-muted fw-medium">{{ $subject->created_at->format('M d, Y') }}</td>
                        <td class="py-3 text-end pe-4">
                            <button type="button" class="btn btn-sm btn-light text-primary border shadow-sm rounded-circle p-2 me-1 edit-subject-btn" 
                                data-id="{{ $subject->id }}" data-name="{{ $subject->name }}" data-batch_id="{{ $subject->batch_id }}" data-is_active="{{ $subject->is_active }}"
                                data-bs-toggle="modal" data-bs-target="#editSubjectModal" title="Edit Subject">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this subject? This might affect records referencing it.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger border shadow-sm rounded-circle p-2" title="Delete Subject"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                    @if($subjects->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark">No subjects found</h6>
                            <p class="text-muted small mb-0">Get started by creating your first subject.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-4">
    {{ $subjects->links() }}
</div>
@endsection

@section('modals')
<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="addSubjectModalLabel">Add New Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Subject Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g. Mathematics">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign to Batch</label>
                        <select name="batch_id" class="form-select" required>
                            <option value="">-- Select a Batch --</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActiveAdd" value="1" checked>
                        <label class="form-check-label" for="isActiveAdd">Active Subject</label>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Subject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSubjectForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Subject Name</label>
                        <input type="text" name="name" id="editSubjectName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign to Batch</label>
                        <select name="batch_id" id="editSubjectBatchId" class="form-select" required>
                            <option value="">-- Select a Batch --</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="editSubjectIsActive" value="1">
                        <label class="form-check-label" for="editSubjectIsActive">Active Subject</label>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Subject</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editBtns = document.querySelectorAll('.edit-subject-btn');
        const editForm = document.getElementById('editSubjectForm');
        const editName = document.getElementById('editSubjectName');
        const editIsActive = document.getElementById('editSubjectIsActive');
        const editBatchId = document.getElementById('editSubjectBatchId');

        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const batchId = this.dataset.batch_id;
                const isActive = this.dataset.is_active;

                editForm.action = `/subjects/${id}`;
                editName.value = name;
                editBatchId.value = batchId;
                editIsActive.checked = isActive == '1' || isActive == true;
            });
        });
    });
</script>
@endsection
