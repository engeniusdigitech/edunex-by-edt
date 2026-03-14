@extends('student.layouts.app')

@section('title', 'Secure Payment - Razorpay')

@section('content')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h4 class="mt-4 fw-bold">Connecting to Razorpay Secure Checkout</h4>
                <p class="text-muted">Please wait, do not refresh or close this window.</p>
            </div>
        </div>
    </div>

    <!-- Razorpay Checkout Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ $gatewayConfig->razorpay_key }}",
            "amount": "{{ $order->amount }}",
            "currency": "INR",
            "name": "{{ $student->institute->name }}",
            "description": "Fee Payment: {{ $fee->feeStructure->name }}",
            "image": "{{ $student->institute->logo ? asset('storage/' . $student->institute->logo) : asset('images/logo.png') }}",
            "order_id": "{{ $order->id }}",
            "handler": function (response) {
                // Use synchronous verification for immediate updates
                fetch("{{ route('student.fees.razorpay.verify') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        student_fee_id: "{{ $fee->id }}",
                        amount: "{{ $amount }}"
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            window.location.href = data.redirect;
                        } else {
                            alert("Verification failed. Please contact support if amount was debited.");
                            window.location.href = "{{ route('student.fees.index') }}";
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        window.location.href = "{{ route('student.fees.index') }}";
                    });
            },
            "prefill": {
                "name": "{{ $student->name }}",
                "email": "{{ $student->email }}",
                "contact": "{{ $student->phone }}"
            },
            "theme": {
                "color": "#4F46E5"
            },
            "modal": {
                "ondismiss": function () {
                    window.location.href = "{{ route('student.fees.cancel') }}";
                }
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.on('payment.failed', function (response) {
            alert("Payment Failed: " + response.error.description);
            window.location.href = "{{ route('student.fees.cancel') }}";
        });

        // Automatically open the checkout when the page loads
        window.onload = function () {
            rzp1.open();
        };
    </script>
@endsection