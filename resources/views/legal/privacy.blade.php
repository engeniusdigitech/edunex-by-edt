<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="Privacy Policy | EduNex Education Management Software" description="Read our privacy policy to understand how we protect your institute's data." />
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
            <span class="section-tag">Legal Architecture</span>
            <h1 class="fw-black display-4 mb-3" style="letter-spacing: -2px;">Privacy Policy</h1>
            <p class="text-muted fw-500">Last Updated: March 26, 2026</p>
        </div>
    </header>

    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="legal-content">
                    <p>At <strong>EduNex</strong> (a product of Engenius Digitech), we take your privacy and the security of your institute's data extremely seriously. This Privacy Policy outlines how we collect, use, and protect your information.</p>

                    <h2>1. Data Collection</h2>
                    <p>We collect information necessary to provide our school management services, including:</p>
                    <ul>
                        <li>Institute details (Name, Address, Logo)</li>
                        <li>Staff and Student records provided by you</li>
                        <li>Payment information for subscription purposes</li>
                        <li>Usage logs to improve platform performance</li>
                    </ul>

                    <h2>2. How We Use Data</h2>
                    <p>Your data is used exclusively to facilitate the operations of your institute through our platform. We do not sell or share your data with third-party advertisers.</p>

                    <h2>3. Data Security</h2>
                    <p>EduNex uses industry-standard encryption (SSL/TLS) for data in transit and secure server-side storage. Our multi-tenant architecture ensures that your institute's data is logically isolated from others.</p>

                    <h2>4. Your Rights</h2>
                    <p>You retain full ownership of the data you upload. You can export or request deletion of your data at any time through our support team.</p>

                    <h2>5. Contact Us</h2>
                    <p>If you have questions about this policy, please contact us at <strong>engeniusdigitech@gmail.com</strong>.</p>
                </div>
            </div>
        </div>
    </div>

    <x-frontend-footer />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('components.whatsapp-widget')
</body>
</html>
