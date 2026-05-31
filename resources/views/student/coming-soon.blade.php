@extends('student.layouts.app')

@section('title', $module)

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 50vh;">
    <div class="text-center p-5 bg-white border rounded-4 shadow-sm" style="max-width: 500px; width: 100%;">
        <div class="mb-4 text-primary" style="opacity: 0.2;">
            <i class="fas fa-tools fa-5x"></i>
        </div>
        <h2 class="fw-bold mb-3">{{ $module }}</h2>
        <p class="text-muted mb-4 fs-5">This module is currently under development. Please check back later!</p>
        <a href="{{ route('student.dashboard') }}" class="btn btn-primary rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection
