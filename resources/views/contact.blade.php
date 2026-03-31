<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="Contact Top Institute Management System Support | EduNex" description="Get in touch for EduNex institute software inquiries, custom education management system deployments, and expert support." />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    @include('components.frontend-styles')

    <style>
        /* ── PAGE HEADER ── */
        .page-header {
            padding: 160px 0 80px;
            position: relative;
        }

        .section-tag {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 20px;
            display: inline-block;
            background: rgba(79, 70, 229, 0.08);
            padding: 6px 16px;
            border-radius: 50px;
        }

        .page-title {
            font-size: clamp(2.5rem, 6vw, 4.8rem);
            font-weight: 950;
            letter-spacing: -3px;
            color: var(--dark-bg);
            line-height: 1;
        }

        .page-title span {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ── CONTACT CONTAINER ── */
        .contact-wrapper {
            max-width: 1100px;
            margin: 0 auto;
        }

        .contact-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 48px;
            border: 1px solid var(--glass-border);
            overflow: hidden;
            box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.08);
        }

        /* ── FORM STYLING ── */
        .contact-form-side {
            padding: 70px;
        }

        .form-label {
            font-weight: 750;
            font-size: 0.8rem;
            color: var(--dark-bg);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
            opacity: 0.8;
        }

        .form-control,
        .form-select {
            padding: 18px 24px;
            border-radius: 20px;
            border: 2px solid transparent;
            background: #f1f5f9;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            color: var(--dark-bg);
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .form-control:focus,
        .form-select:focus {
            background: #ffffff;
            border-color: var(--primary-color);
            box-shadow: 0 12px 24px -8px rgba(79, 70, 229, 0.2);
            transform: translateY(-2px);
        }

        /* ── INFO SIDE ── */
        .contact-info-side {
            background: linear-gradient(165deg, #0f172a 0%, #1e1b4b 100%);
            padding: 70px;
            color: #ffffff;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .contact-info-side::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: var(--primary-color);
            filter: blur(120px);
            opacity: 0.15;
            top: -100px;
            right: -100px;
            pointer-events: none;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 24px;
            transition: all 0.4s;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .info-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: scale(1.02) translateX(10px);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .info-icon {
            width: 56px;
            height: 56px;
            min-width: 56px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: #fff;
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);
        }

        .info-content h6 {
            font-weight: 800;
            font-size: 1rem;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .info-content p {
            font-size: 0.9rem;
            opacity: 0.7;
            margin-bottom: 0;
            line-height: 1.5;
        }

        @media (max-width: 991px) {
            .contact-form-side, .contact-info-side {
                padding: 40px 24px;
            }
            .page-header {
                padding: 120px 0 60px;
            }
        }
    </style>
</head>

<body>

    <div class="mesh-bg">
        <div class="mesh-circle-1"></div>
        <div class="mesh-circle-2"></div>
        <div class="mesh-circle-3"></div>
        <div class="mesh-circle-4"></div>
    </div>

    <!-- Navigation -->
    @include('components.frontend-navbar')

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center mb-0 rounded-0" role="alert" style="background:#ECFDF5; border:none; border-bottom:1px solid #A7F3D0; color:#065F46; font-weight:600;">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Page Header -->
    <header class="page-header text-center">
        <div class="container px-4">
            <span class="section-tag animate__animated animate__fadeInDown">Get in Touch</span>
            <h1 class="page-title animate__animated animate__zoomIn">
                Let's start your<br>
                <span>digital transformation.</span>
            </h1>
            <p class="text-muted fs-5 mt-4 max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s"
                style="max-width: 700px;">
                Whether you have a technical question or need a custom <strong>education management system</strong> deployment, our team at Engenius
                Digitech is here to help you scale.
            </p>
        </div>
    </header>

    <!-- Main Contact Section -->
    <section class="py-5 mb-5 px-3">
        <div class="contact-wrapper">
            <div class="contact-container animate__animated animate__fadeInUp glass">
                <div class="row g-0">
                    <!-- Form Side -->
                    <div class="col-lg-7">
                        <div class="contact-form-side">
                            <h3 class="fw-black mb-5" style="letter-spacing: -1px;">Send us a message</h3>
                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="e.g. Arjun Sharma" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="arjun@institute.com" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Inquiry Type</label>
                                        <select name="inquiry_type" class="form-select">
                                            <option>General Sales Inquiry</option>
                                            <option>Partner with us</option>
                                            <option>Technical Support</option>
                                            <option>Custom Enterprise Setup</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Your Message</label>
                                        <textarea name="message" class="form-control" rows="5"
                                            placeholder="Tell us about your institute and how we can help..." required></textarea>
                                    </div>
                                    <div class="col-12 pt-3">
                                        <button type="submit" class="btn btn-primary-glow btn-modern w-100 py-3 shadow-lg">
                                            Submit Inquiry <i class="fas fa-paper-plane ms-2"></i>
                                        </button>
                                        <p class="text-center text-muted small mt-4 fw-500">
                                            <i class="fas fa-clock me-1 text-primary"></i> We typically respond within 1 business day.
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Info Side -->
                    <div class="col-lg-5">
                        <div class="contact-info-side glass-dark">
                            <h3 class="fw-black mb-5" style="letter-spacing: -1px;">Contact Details</h3>

                            <div class="info-card">
                                <div class="info-icon"><i class="fas fa-headset"></i></div>
                                <div class="info-content">
                                    <h6>Dedicated Support</h6>
                                    <p>support@edunex.com</p>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon" style="background: linear-gradient(135deg, var(--secondary-color), #ec4899);"><i class="fas fa-paper-plane"></i></div>
                                <div class="info-content">
                                    <h6>Sales & Partnerships</h6>
                                    <p>engeniusdigitech@gmail.com</p>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon" style="background: linear-gradient(135deg, #10B981, #059669);"><i class="fas fa-location-dot"></i></div>
                                <div class="info-content">
                                    <h6>Headquarters</h6>
                                    <p>Vadodara, Gujarat, India.</p>
                                </div>
                            </div>

                            <div class="mt-auto pt-5 border-top border-white border-opacity-10">
                                <p class="text-white-50 small mb-3 fw-bold text-uppercase ls-1">Crafted by</p>
                                <a href="https://engeniusdigitech.com" target="_blank" class="text-decoration-none">
                                    <h4 class="text-white fw-black mb-1">Engenius Digitech</h4>
                                    <p class="text-white-50 small mb-4">Leading specialized SaaS solutions <i class="fas fa-external-link-alt ms-1 text-xs"></i></p>
                                </a>
                                <div class="d-flex gap-3">
                                    <a href="https://www.linkedin.com/company/engenius-digitech" target="_blank" class="btn btn-primary rounded-circle shadow-sm" style="width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; background: #0077b5; border: none;">
                                        <i class="fab fa-linkedin-in text-white"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Section -->
    <section class="py-5 bg-light">
        <div class="container px-4 py-5 text-center">
            <h2 class="fw-black mb-4">Want a direct demo?</h2>
            <p class="text-muted mb-5 mx-auto" style="max-width: 500px;">Our team can walk you through the entire
                platform and help you set up your first batch in minutes.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="mailto:engeniusdigitech@gmail.com" class="btn btn-dark btn-modern px-5">
                    <i class="fas fa-envelope me-2"></i> Email Sales Team
                </a>
            </div>
        </div>
    </section>

    <x-frontend-footer />

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('components.whatsapp-widget')
</body>

</html>