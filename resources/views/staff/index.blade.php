@extends('layouts.admin')

@section('title', 'Manage Staff')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-medium text-dark mb-1">Institute Staff</h4>
        <p class="text-muted small mb-0">Manage teachers, receptionists, and administrators</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('staff.create') }}" class="btn btn-primary btn-modern shadow-sm">
            <i class="fas fa-user-plus me-2"></i> Add Staff
        </a>
        <div class="dropdown">
            <button class="btn btn-outline-secondary btn-modern dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-file-import me-2"></i> Import
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><h6 class="dropdown-header text-muted"><i class="fas fa-upload me-1"></i> Upload Data</h6></li>
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importStaffModal">
                        <i class="fas fa-table text-success me-2"></i> Import Excel / CSV
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><h6 class="dropdown-header text-muted"><i class="fas fa-download me-1"></i> Download Sample</h6></li>
                <li>
                    <a class="dropdown-item" href="{{ asset('samples/staff-sample.csv') }}" download>
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
        <form action="{{ route('staff.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0" placeholder="Search by name or email..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="role_id" class="form-select bg-light border-0">
                    <option value="">All Roles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 btn-modern">Filter</button>
                    @if(request()->anyFilled(['search', 'role_id']))
                        <a href="{{ route('staff.index') }}" class="btn btn-light border w-100 btn-modern">Clear</a>
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
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Name & Email</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Role</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Biometric</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Joined Date</th>
                        <th class="py-3 text-end pe-4 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staffMembers as $staff)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3 fw-medium" style="width: 40px; height: 40px;">
                                    {{ substr($staff->name, 0, 2) }}
                                </div>
                                <div>
                                    <div class="fw-medium text-dark">{{ $staff->name }}</div>
                                    <div class="small text-muted">{{ $staff->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            @if($staff->isTeacher())
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium">Teacher</span>
                            @elseif($staff->isReceptionist())
                                <span class="badge bg-info bg-opacity-10 text-info border border-info-subtle rounded-pill px-3 py-2 fw-medium">Receptionist</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle rounded-pill px-3 py-2 fw-medium">Staff</span>
                            @endif
                        </td>
                        <td class="py-3">
                            @if($staff->hasFaceEnrolled())
                                <span class="badge bg-success-subtle text-success border border-success-subtle"><i class="fas fa-fingerprint me-1"></i> Enrolled</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Not enrolled</span>
                            @endif
                        </td>
                        <td class="py-3 text-muted fw-medium">{{ $staff->created_at->format('M d, Y') }}</td>
                        <td class="py-3 text-end pe-4">
                            <a href="{{ route('staff.edit', $staff) }}" class="btn btn-sm btn-light text-primary border shadow-sm rounded-circle p-2 me-1" title="Edit Staff"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('staff.destroy', $staff) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this staff member?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger border shadow-sm rounded-circle p-2" title="Delete Staff"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($staffMembers->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                <i class="fas fa-user-tie fa-2x"></i>
                            </div>
                            <h6 class="fw-medium text-dark">No staff members found</h6>
                            <p class="text-muted small mb-0">Get started by onboarding your first team member.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-4">
    {{ $staffMembers->links() }}
</div>

{{-- Import Staff Modal --}}
<div class="modal fade" id="importStaffModal" tabindex="-1" aria-labelledby="importStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <div>
                    <h5 class="modal-title fw-semibold" id="importStaffModalLabel">
                        <i class="fas fa-file-import text-primary me-2"></i> Import Staff
                    </h5>
                    <p class="text-muted small mb-0 mt-1">Upload an Excel or CSV file to bulk-import staff members.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staff.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-3">
                    <div class="alert alert-info border-0 rounded-3 small" style="background:#EFF6FF;color:#1D4ED8;">
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Required columns:</strong> name, email<br>
                        <strong>Optional:</strong> role_name (Teacher / Receptionist / Librarian / Warden), password<br>
                        <strong>Note:</strong> If password is blank, defaults to <code>Pass@1234</code>.
                    </div>
                    <div class="mb-3">
                        <label for="staff_import_file" class="form-label fw-medium">Select File <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="staff_import_file" name="import_file" accept=".xlsx,.xls,.csv" required>
                        <div class="form-text">Accepted formats: .xlsx, .xls, .csv (max 5 MB)</div>
                    </div>
                    <a href="{{ asset('samples/staff-sample.csv') }}" download class="btn btn-sm btn-outline-secondary">
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
