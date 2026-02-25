@extends('layouts.admin')

@section('title', 'Subscription Plans')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">Global Plans</h4>
        <p class="text-muted small mb-0">Manage platform subscription pricing tiers</p>
    </div>
    <a href="{{ route('superadmin.plans.create') }}" class="btn btn-primary btn-modern shadow-sm">
        <i class="fas fa-plus me-2"></i> Add Plan
    </a>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
</div>
@endif

<div class="row g-4">
    @foreach($plans as $plan)
    <div class="col-md-4">
        <div class="card h-100 border-0 p-2 text-center" style="background: {{ $plan->is_active ? 'linear-gradient(to bottom, #ffffff, #F8FAFC)' : '#F1F5F9' }}; {{ $plan->is_active ? 'box-shadow: 0 15px 30px -5px rgba(0,0,0,0.05);' : '' }}">
            <div class="card-body p-4 d-flex flex-column align-items-center">
                @if($plan->is_active)
                    <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-1 mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.7rem;">Active</span>
                @else
                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle rounded-pill px-3 py-1 mb-3 text-uppercase" style="letter-spacing: 1px; font-size: 0.7rem;">Inactive</span>
                @endif
                
                <h4 class="fw-bold text-dark mb-3">{{ $plan->name }}</h4>
                <div class="mb-4">
                    <span class="fs-4 text-muted fw-semibold">₹</span>
                    <span class="display-5 fw-black text-primary" style="font-weight: 800;">{{ number_format($plan->price, 2) }}</span>
                </div>
                
                <p class="text-muted fw-medium py-3 border-top border-bottom w-100"><i class="far fa-calendar-alt text-primary me-2"></i> {{ $plan->duration_days }} Days Access</p>
                
                <div class="mt-auto w-100 pt-3">
                    <button class="btn btn-outline-primary btn-modern w-100 fw-bold">Edit Plan</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
