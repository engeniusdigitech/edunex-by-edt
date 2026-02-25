@extends('layouts.admin')

@section('title', 'Manage Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">Student Directory</h4>
        <p class="text-muted small mb-0">View and manage all enrolled students</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary btn-modern shadow-sm">
        <i class="fas fa-user-plus me-2"></i> Add Student
    </a>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
</div>
@endif

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
                                <div class="bg-secondary bg-opacity-10 text-secondary border rounded-circle d-flex justify-content-center align-items-center me-3 fw-bold" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                    {{ substr($student->name, 0, 2) }}
                                </div>
                                @endif
                                <div>
                                    <div class="fw-bold text-dark">{{ $student->name }}</div>
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
                    </tr>
                    @endforeach
                    @if($students->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                <i class="fas fa-user-graduate fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark">No students found</h6>
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
@endsection
