<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="Terms and Conditions | EduNex Institute Management System" description="Review the terms and conditions for using the EduNex institute management platform." />
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
            <span class="section-tag">Usage Rights</span>
            <h1 class="fw-black display-4 mb-3" style="letter-spacing: -2px;">Terms & Conditions</h1>
            <p class="text-muted fw-500">Last Updated: March 26, 2026</p>
        </div>
    </header>

    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="legal-content">
                    <p>By accessing or using the <strong>EduNex</strong> platform, you agree to be bound by these Terms and Conditions. Please read them carefully.</p>

                    <h2>1. Service Provision</h2>
                    <p>EduNex provides a SaaS-based institute management system. We strive for 99.9% uptime but do not guarantee uninterrupted service due to maintenance or external factors.</p>

                    <h2>2. User Responsibility</h2>
                    <p>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You agree not to use the platform for any unlawful activities.</p>

                    <h2>3. Intellectual Property</h2>
                    <p>All software, design, and content on the EduNex platform (excluding user-uploaded data) are the exclusive property of Engenius Digitech.</p>

                    <h2>4. Limitation of Liability</h2>
                    <p>Engenius Digitech shall not be liable for any indirect, incidental, or consequential damages resulting from the use or inability to use our service.</p>

                    <h2>5. Governing Law</h2>
                    <p>These terms are governed by the laws of India. Any disputes shall be subject to the exclusive jurisdiction of the courts in Vadodara, Gujarat.</p>
                </div>
            </div>
        </div>
    </div>

    <x-frontend-footer />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('components.whatsapp-widget')
</body>
</html>
