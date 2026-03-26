<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="Refund Policy | EduNex 100% Satisfaction Guarantee" description="Learn about our 7-day money-back guarantee and refund process." />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('components.frontend-styles')
    <style>
        .legal-header { padding: 120px 0 60px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
        .legal-content { font-size: 1.1rem; line-height: 1.8; color: #475569; }
        .legal-content h2 { color: #1e293b; font-weight: 800; margin-top: 2.5rem; margin-bottom: 1.5rem; letter-spacing: -1px; }
        .legal-content p { margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <x-frontend-navbar />

    <header class="legal-header text-center">
        <div class="container px-4">
            <span class="section-tag">Customer First</span>
            <h1 class="fw-black display-4 mb-3" style="letter-spacing: -2px;">Refund Policy</h1>
            <p class="text-muted fw-500">Last Updated: March 26, 2026</p>
        </div>
    </header>

    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="legal-content">
                    <p>At <strong>EduNex</strong>, we want to ensure you are 100% satisfied with our platform. We offer a transparent refund policy for our valued partners.</p>

                    <h2>1. 7-Day Money Back Guarantee</h2>
                    <p>If you are not satisfied with our service within the first 7 days of your paid subscription, you are eligible for a full refund, no questions asked.</p>

                    <h2>2. Refund Eligibility</h2>
                    <p>To request a refund, please email us at <strong>engeniusdigitech@gmail.com</strong> with your institute details. The request must be made within 7 days of the initial subscription payment.</p>

                    <h2>3. Processing Time</h2>
                    <p>Once approved, refunds are processed within 5-10 business days and credited back to the original payment method used during purchase.</p>

                    <h2>4. Non-Refundable Items</h2>
                    <p>Custom development work or branding services requested beyond the standard platform features are non-refundable once the work has commenced.</p>

                    <h2>5. Policy Changes</h2>
                    <p>Engenius Digitech reserves the right to modify this refund policy at any time. Any changes will be updated on this page.</p>
                </div>
            </div>
        </div>
    </div>

    <x-frontend-footer />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('components.whatsapp-widget')
</body>
</html>
