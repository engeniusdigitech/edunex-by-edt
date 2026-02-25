@extends('layouts.admin')

@section('title', 'Manage Institutes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">Onboarded Institutes</h4>
        <p class="text-muted small mb-0">Manage all schools and institutes using the platform</p>
    </div>
    <a href="{{ route('superadmin.institutes.create') }}" class="btn btn-primary btn-modern shadow-sm">
        <i class="fas fa-plus me-2"></i> Add Institute
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
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">ID</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Institute Information</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Subdomain</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Status</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Sub Expiry</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($institutes as $institute)
                    <tr>
                        <td class="ps-4 py-3 text-muted">#{{ $institute->id }}</td>
                        <td class="py-3">
                            <div class="fw-bold text-dark">{{ $institute->name }}</div>
                            <div class="small text-muted"><i class="far fa-envelope me-1"></i> {{ $institute->contact_email }} &bull; <i class="fas fa-phone-alt me-1"></i> {{ $institute->phone }}</div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-light text-dark border px-2 py-1" style="font-family: monospace;">{{ $institute->subdomain }}.educore.test</span>
                        </td>
                        <td class="py-3">
                            @if($institute->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2">Active</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill px-3 py-2">Suspended</span>
                            @endif
                        </td>
                        <td class="py-3">
                            @php $sub = $institute->subscriptions->first(); @endphp
                            @if($sub)
                                <span class="fw-medium">{{ $sub->ends_at->format('M d, Y') }}</span>
                            @else
                                <span class="text-muted fst-italic">No Plan</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-4">
    {{ $institutes->links() }}
</div>
@endsection
