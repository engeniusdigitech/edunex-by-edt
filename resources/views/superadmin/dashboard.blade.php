@extends('layouts.admin')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="row mb-5 g-4">
    <div class="col-md-6">
        <div class="card card-stat h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-box me-4" style="background: linear-gradient(135deg, #4F46E5, #818CF8); box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                    <i class="fas fa-school"></i>
                </div>
                <div>
                    <h6 class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Total Institutes</h6>
                    <h2 class="mb-0 fw-black text-dark" style="font-weight: 800;">{{ $totalInstitutes }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-stat h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-box me-4" style="background: linear-gradient(135deg, #10B981, #34D399); box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h6 class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Active Subscriptions</h6>
                    <h2 class="mb-0 fw-black text-dark" style="font-weight: 800;">{{ $activeSubscriptions }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0" style="background: linear-gradient(135deg, #0F172A, #1E293B);">
    <div class="card-body p-5 text-white">
        <div class="d-flex align-items-center mb-3">
            <i class="fas fa-laptop-code fa-2x text-primary me-3"></i>
            <h4 class="fw-bold mb-0">Welcome Platform Owner</h4>
        </div>
        <p class="text-white opacity-75 fs-5 mb-0">Use the sidebar to manage onboarded institutes, oversee global metrics, and configure subscription plans running on the EduNex engine.</p>
    </div>
</div>
@endsection
