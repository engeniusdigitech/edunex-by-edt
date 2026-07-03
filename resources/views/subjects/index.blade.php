@extends('layouts.admin')

@section('title', 'Manage Subjects')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-medium text-dark mb-1">Subjects</h4>
        <p class="text-muted small mb-0">Manage the subjects offered by your institute</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary btn-modern shadow-sm" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
            <i class="fas fa-plus me-2"></i> Add Subject
        </button>
        <div class="dropdown">
            <button class="btn btn-outline-secondary btn-modern dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-file-import me-2"></i> Import
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><h6 class="dropdown-header text-muted"><i class="fas fa-upload me-1"></i> Upload Data</h6></li>
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importSubjectsModal">
                        <i class="fas fa-table text-success me-2"></i> Import Excel / CSV
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><h6 class="dropdown-header text-muted"><i class="fas fa-download me-1"></i> Download Sample</h6></li>
                <li>
                    <a class="dropdown-item" href="{{ asset('samples/subjects-sample.csv') }}" download>
                        <i class="fas fa-file-csv text-primary me-2"></i> Sample CSV
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
</div>
@endif
@if(session('warning'))
<div class="alert alert-warning bg-white border border-warning border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-exclamation-triangle text-warning me-2"></i> {{ session('warning') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger bg-white border border-danger border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-times-circle text-danger me-2"></i> {{ session('error') }}
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
                        <td class="ps-4 py-3 fw-medium text-dark">{{ $subject->name }}</td>
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
                            <button type="button" class="btn btn-sm btn-light text-primary border shadow-sm rounded-circle p-2 me-1" 
                                data-bs-toggle="modal" data-bs-target="#editSubjectModal{{ $subject->id }}" title="Edit Subject">
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
                            <h6 class="fw-medium text-dark">No subjects found</h6>
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

@foreach($subjects as $subject)
<!-- Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal{{ $subject->id }}" tabindex="-1" aria-labelledby="editSubjectModalLabel{{ $subject->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="editSubjectModalLabel{{ $subject->id }}">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('subjects/' . $subject->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Subject Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $subject->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign to Batch</label>
                        <select name="batch_id" class="form-select" required>
                            <option value="">-- Select a Batch --</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}" {{ $subject->batch_id == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="editSubjectIsActive{{ $subject->id }}" value="1" {{ $subject->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="editSubjectIsActive{{ $subject->id }}">Active Subject</label>
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
@endforeach

{{-- Import Subjects Modal --}}
<div class="modal fade" id="importSubjectsModal" tabindex="-1" aria-labelledby="importSubjectsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <div>
                    <h5 class="modal-title fw-semibold" id="importSubjectsModalLabel">
                        <i class="fas fa-file-import text-primary me-2"></i> Import Subjects
                    </h5>
                    <p class="text-muted small mb-0 mt-1">Upload an Excel or CSV file to bulk-import subjects.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('subjects.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-3">
                    <div class="alert alert-info border-0 rounded-3 small" style="background:#EFF6FF;color:#1D4ED8;">
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Required columns:</strong> name, batch_id (batch name or ID)<br>
                        <strong>Optional:</strong> is_active (1 = active, 0 = inactive)
                    </div>
                    <div class="mb-3">
                        <label for="subjects_import_file" class="form-label fw-medium">Select File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="subjects_import_file" name="import_file" accept=".xlsx,.xls,.csv" required>
                        <div class="form-text">Accepted formats: .xlsx, .xls, .csv (max 5 MB)</div>
                    </div>
                    <a href="{{ asset('samples/subjects-sample.csv') }}" download class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-download me-1"></i> Download Sample CSV
                    </a>
                </div>
                <div class="modal-footer border-top-0 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-modern">
                        <i class="fas fa-upload me-2"></i> Import Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
