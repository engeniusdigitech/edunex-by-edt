@extends('layouts.admin')

@section('title', 'Manage Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-medium text-dark mb-1">Student Directory</h4>
        <p class="text-muted small mb-0">View and manage all enrolled students</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-modern shadow-sm">
            <i class="fas fa-user-plus me-2"></i> Add Student
        </a>
        <div class="dropdown">
            <button class="btn btn-outline-secondary btn-modern dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-file-import me-2"></i> Import
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><h6 class="dropdown-header text-muted"><i class="fas fa-upload me-1"></i> Upload Data</h6></li>
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importStudentsModal">
                        <i class="fas fa-table text-success me-2"></i> Import Excel / CSV
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><h6 class="dropdown-header text-muted"><i class="fas fa-download me-1"></i> Download Sample</h6></li>
                <li>
                    <a class="dropdown-item" href="{{ asset('samples/students-sample.csv') }}" download>
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

<!-- Filters -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-3">
        <form action="{{ route('students.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0" placeholder="Search by name, email or phone..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="batch_id" class="form-select bg-light border-0">
                    <option value="">All Batches</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 btn-modern">Filter</button>
                    @if(request()->anyFilled(['search', 'batch_id']))
                        <a href="{{ route('students.index') }}" class="btn btn-light border w-100 btn-modern">Clear</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 bg-white">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F8FAFC;">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Student</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Contact Info</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Batch Assignment</th>
                    <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Enrolled On</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                @if($student->profile_image)
                                <img src="{{ asset('storage/'.$student->profile_image) }}" class="rounded-circle me-3 object-fit-cover border" width="40" height="40">
                                @else
                                <div class="bg-secondary bg-opacity-10 text-secondary border rounded-circle d-flex justify-content-center align-items-center me-3 fw-medium" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                    {{ substr($student->name, 0, 2) }}
                                </div>
                                @endif
                                <div>
                                    <div class="fw-medium text-dark">{{ $student->name }}</div>
                                    <div class="small text-muted" style="font-family: monospace;">ID: #{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            <div class="small text-dark mb-1"><i class="far fa-envelope text-muted me-1"></i> {{ $student->email }}</div>
                            <div class="small text-dark"><i class="fas fa-phone-alt text-muted me-1"></i> {{ $student->phone }}</div>
                        </td>
                        <td class="py-3">
                            @if($student->batch)
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium"><i class="fas fa-users me-1"></i> {{ $student->batch->name }}</span>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill px-3 py-2 fst-italic">Unassigned</span>
                            @endif
                        </td>
                        <td class="py-3 text-muted fw-medium">{{ $student->enrollment_date->format('M d, Y') }}</td>
                        <td class="py-3">
                            <a href="{{ route('reports.student', $student) }}" class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-chart-bar"></i> Report</a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($students->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                <i class="fas fa-user-graduate fa-2x"></i>
                            </div>
                            <h6 class="fw-medium text-dark">No students found</h6>
                            <p class="text-muted small mb-0">Start adding students to track performance and attendance.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-4">
    {{ $students->links() }}
</div>

{{-- Import Students Modal --}}
<div class="modal fade" id="importStudentsModal" tabindex="-1" aria-labelledby="importStudentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <div>
                    <h5 class="modal-title fw-semibold" id="importStudentsModalLabel">
                        <i class="fas fa-file-import text-primary me-2"></i> Import Students
                    </h5>
                    <p class="text-muted small mb-0 mt-1">Upload an Excel or CSV file to bulk-import students.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-3">
                    <div class="alert alert-info border-0 rounded-3 small" style="background:#EFF6FF;color:#1D4ED8;">
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Required columns:</strong> name, phone, batch_id (name or ID)<br>
                        <strong>Optional:</strong> email, roll_number, gender, blood_group, father_name, mother_name, parent_email, alternate_phone_1, enrollment_date, password<br>
                        <strong>Note:</strong> If password is blank, student's phone number is used.
                    </div>
                    <div class="mb-3">
                        <label for="students_import_file" class="form-label fw-medium">Select File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="students_import_file" name="import_file" accept=".xlsx,.xls,.csv" required>
                        <div class="form-text">Accepted formats: .xlsx, .xls, .csv (max 5 MB)</div>
                    </div>
                    <a href="{{ asset('samples/students-sample.csv') }}" download class="btn btn-sm btn-outline-secondary">
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
