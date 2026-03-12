@extends('layouts.admin')

@section('title', 'Payment Gateway Settings')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-0 fw-bold">Payment Gateway Settings</h3>
            <p class="text-muted">Configure Razorpay and Stripe API keys for your institute to accept online payments.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 rounded-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('payment-gateways.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if(auth()->user()->institute->country === 'IN')
                        <!-- Razorpay Section -->
                        <h5 class="fw-bold mb-3 text-primary"><i class="fas fa-wallet me-2"></i>Razorpay Settings (India)</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Razorpay Key ID</label>
                                <input type="text" name="razorpay_key" class="form-control" value="{{ old('razorpay_key', $gateway->razorpay_key) }}" placeholder="rzp_test_...">
                                @error('razorpay_key')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Razorpay Key Secret</label>
                                <input type="password" name="razorpay_secret" class="form-control" value="{{ old('razorpay_secret', $gateway->razorpay_secret) }}" placeholder="Enter secret">
                                @error('razorpay_secret')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @else

                        <!-- Stripe Section -->
                        <h5 class="fw-bold mb-3" style="color: #6366F1;"><i class="fab fa-stripe me-2"></i>Stripe Settings (International)</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Stripe Publishable Key</label>
                                <input type="text" name="stripe_public_key" class="form-control" value="{{ old('stripe_public_key', $gateway->stripe_public_key) }}" placeholder="pk_test_...">
                                @error('stripe_public_key')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Stripe Secret Key</label>
                                <input type="password" name="stripe_secret_key" class="form-control" value="{{ old('stripe_secret_key', $gateway->stripe_secret_key) }}" placeholder="sk_test_...">
                                @error('stripe_secret_key')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-muted small">Stripe Webhook Secret</label>
                                <input type="password" name="stripe_webhook_secret" class="form-control" value="{{ old('stripe_webhook_secret', $gateway->stripe_webhook_secret) }}" placeholder="whsec_...">
                                <small class="text-muted d-block mt-1">Found in Stripe Dashboard -> Developers -> Webhooks</small>
                                @error('stripe_webhook_secret')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @endif

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 12px;">
                                <i class="fas fa-save me-2"></i>Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Instructions / Help Sidebar -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card border-0 shadow-sm rounded-4 bg-light">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-info"></i>Configuration Help</h5>
                    
                    @if(auth()->user()->institute->country === 'IN')
                    <h6 class="fw-bold mt-4 fs-6">Razorpay Webhooks</h6>
                    <p class="text-muted small mb-2">Configure these endpoints in your Razorpay Dashboard:</p>
                    <code class="d-block bg-white p-2 rounded border small mb-3 text-break">
                        {{ url('/api/webhooks/razorpay') }}
                    </code>
                    @else
                    <h6 class="fw-bold mt-4 fs-6">Stripe Webhooks</h6>
                    <p class="text-muted small mb-2">Configure these endpoints in your Stripe Dashboard:</p>
                    <code class="d-block bg-white p-2 rounded border small mb-3 text-break">
                        {{ url('/api/webhooks/stripe') }}
                    </code>
                    <p class="text-muted small">Events to listen for: <br><code>checkout.session.completed</code></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
