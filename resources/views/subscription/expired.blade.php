@extends('layouts.admin')

@section('title', 'Subscription Expired')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card shadow-sm text-center" style="max-width: 500px;">
        <div class="card-body p-5">
            <h1 class="display-1 text-danger mb-4"><i class="fas fa-exclamation-triangle"></i></h1>
            <h2 class="card-title mb-3">Subscription Expired</h2>
            <p class="card-text text-muted mb-4">
                Your institute's subscription to Edunex has expired. To restore full access to all features, please renew your subscription.
            </p>
            
            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <p class="text-muted small">
                If you are an Institute Admin, please contact the Super Admin for a renewal. <br>
                For support, email: <strong>support@edunex.com</strong>
            </p>
            
            <!-- Optional: Replace with a button to a billing page if you ever build one -->
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary mt-3">Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection
