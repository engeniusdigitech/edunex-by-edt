@extends('layouts.admin')

@section('title', 'Manage Principals')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">School Principals</h4>
        <p class="text-muted small mb-0">Manage principal accounts for your school</p>
    </div>
    <a href="{{ route('principals.create') }}" class="btn btn-primary btn-modern shadow-sm">
        <i class="fas fa-user-plus me-2"></i> Add Principal
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
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Name & Email</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Role</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Joined Date</th>
                        <th class="py-3 text-end pe-4 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($principals as $principal)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3 fw-bold" style="width: 40px; height: 40px;">
                                    {{ substr($principal->name, 0, 2) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $principal->name }}</div>
                                    <div class="small text-muted">{{ $principal->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium">Principal</span>
                        </td>
                        <td class="py-3 text-muted fw-medium">{{ $principal->created_at->format('M d, Y') }}</td>
                        <td class="py-3 text-end pe-4">
                            <a href="{{ route('principals.edit', $principal) }}" class="btn btn-sm btn-light text-primary border shadow-sm rounded-circle p-2 me-1" title="Edit Principal"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('principals.destroy', $principal) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this principal?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger border shadow-sm rounded-circle p-2" title="Delete Principal"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($principals->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                <i class="fas fa-user-shield fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark">No principals found</h6>
                            <p class="text-muted small mb-0">Get started by creating your first principal.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-4">
    {{ $principals->links() }}
</div>
@endsection
