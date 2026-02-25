<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore - The Ultimate Coaching Management SaaS</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #EC4899;
            --dark-bg: #0F172A;
            --text-main: #1E293B;
            --text-muted: #64748B;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            background-color: #FAFAF9;
            overflow-x: hidden;
        }

        /* Glassmorphic Navbar */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }

        /* Modern Gradient Hero */
        .hero-section {
            position: relative;
            padding: 160px 0 100px;
            background: radial-gradient(circle at top left, rgba(79, 70, 229, 0.08), transparent 40%),
                        radial-gradient(circle at bottom right, rgba(236, 72, 153, 0.08), transparent 40%);
            overflow: hidden;
        }

        .hero-badge {
            display: inline-block;
            padding: 8px 16px;
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary-color);
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 24px;
            border: 1px solid rgba(79, 70, 229, 0.2);
            backdrop-filter: blur(4px);
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 24px;
            color: var(--dark-bg);
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
            font-weight: 400;
        }

        /* Buttons */
        .btn-modern {
            padding: 14px 32px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            font-size: 1.1rem;
        }

        .btn-primary-glow {
            background: linear-gradient(135deg, var(--primary-color), #6366F1);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        }

        .btn-primary-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(79, 70, 229, 0.5);
            color: white;
        }

        .btn-outline-modern {
            background: white;
            color: var(--text-main);
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .btn-outline-modern:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Features */
        .features-section {
            padding: 100px 0;
            background: #ffffff;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--dark-bg);
            letter-spacing: -1px;
        }

        .feature-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px 30px;
            border: 1px solid #F1F5F9;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.03);
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(79,70,229,0.03), rgba(236,72,153,0.03));
            z-index: -1;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.08);
            border-color: rgba(79,70,229,0.1);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .icon-wrapper {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 24px;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .feature-card:hover .icon-wrapper {
            transform: scale(1.1) rotate(-5deg);
        }

        .icon-blue { background: #EEF2FF; color: var(--primary-color); }
        .icon-pink { background: #FDF2F8; color: var(--secondary-color); }
        .icon-emerald { background: #ECFDF5; color: #10B981; }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--dark-bg);
        }

        .feature-desc {
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* Dashboard Preview / Abstract shape */
        .dashboard-preview {
            position: relative;
            margin-top: 60px;
            z-index: 10;
        }
        
        .preview-image {
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .glow-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            height: 80%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            filter: blur(120px);
            opacity: 0.15;
            z-index: -1;
        }

        /* Footer */
        .footer {
            background: var(--dark-bg);
            color: white;
            padding: 80px 0 40px;
        }

        .footer-brand {
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(135deg, #fff, rgba(255,255,255,0.7));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
            display: inline-block;
        }

        .footer-text {
            color: #94A3B8;
            line-height: 1.7;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title { font-size: 3rem; }
            .hero-section { padding: 120px 0 60px; }
        }
    </style>
</head>
<body class="antialiased">

    <!-- Navigation -->
    @include('components.frontend-navbar')

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-badge animate__animated animate__fadeInDown">
                        ✨ Next-Gen Coaching Management <span class="text-muted fw-normal ms-1">| By <a href="https://engeniusdigitech.netlify.app/" target="_blank" class="text-primary text-decoration-none fw-bold">Engenius Digitech</a></span>
                    </div>
                    <h1 class="hero-title animate__animated animate__zoomIn">
                        The ultimate operating system for <br> <span>modern coaching centers.</span>
                    </h1>
                    <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                        Automate fee collections, track real-time attendance, and engage students with an enterprise-grade SaaS platform designed essentially for educators.
                    </p>
                    
                    <div class="d-flex justify-content-center gap-3 flex-column flex-sm-row animate__animated animate__fadeInUp animate__delay-1s">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : url('/dashboard') }}" class="btn btn-primary-glow btn-modern btn-lg">
                                    Launch Dashboard <i class="fas fa-rocket ms-2"></i>
                                </a>
                            @else
                                <a href="{{ route('contact') }}" class="btn btn-primary-glow btn-modern btn-lg">
                                    Get Started Now
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-outline-modern btn-modern btn-lg">
                                    Institute Login
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>

            <div class="dashboard-preview mt-5 pt-4 d-none d-md-block">
                <div class="glow-bg"></div>
                <!-- Dashboard Image Preview -->
                <div class="mx-auto rounded-4 shadow-lg overflow-hidden border" style="max-width: 900px; position: relative;">
                    <img src="{{ asset('images/hero-banner.png') }}" class="img-fluid w-100" alt="EduCore Dashboard Preview">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="section-header ms-auto me-auto" style="max-width: 700px;">
                <h2>Everything you need to scale.</h2>
                <p class="text-muted fs-5 mt-3">Powerful tools designed specifically for educational institutes, giving you back hours of administrative time every week.</p>
            </div>
            
            <div class="row g-5">
                <!-- Feature 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-wrapper icon-blue">
                            <i class="fas fa-clipboard-user"></i>
                        </div>
                        <h3 class="feature-title">Student Hub</h3>
                        <p class="feature-desc">Dedicated student portals. Seamless onboarding, active batch assignments, and profile management without the paperwork.</p>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-wrapper icon-emerald">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h3 class="feature-title">Automated Finances</h3>
                        <p class="feature-desc">Track cash and online payments against structural fee plans. Generate PDF reports and identify defaulters instantly.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-wrapper icon-pink">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h3 class="feature-title">Smart Communication</h3>
                        <p class="feature-desc">Blast pre-filled WhatsApp reminders for pending dues with a single click and push alerts directly to student dashboards.</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-wrapper" style="background: #FFFBEB; color: #D97706;">
                            <i class="fas fa-fingerprint"></i>
                        </div>
                        <h3 class="feature-title">Role-Based Access</h3>
                        <p class="feature-desc">Secure your institute data. Assign granular permissions to Teachers and Receptionists so they only see what matters.</p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-wrapper" style="background: #F3E8FF; color: #9333EA;">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="feature-title">Deep Reporting</h3>
                        <p class="feature-desc">Interactive dashboard charts and exportable PDF analytics for monthly attendance and revenue metrics.</p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-wrapper" style="background: #E0F2FE; color: #0284C7;">
                            <i class="fas fa-server"></i>
                        </div>
                        <h3 class="feature-title">Multi-Tenant Core</h3>
                        <p class="feature-desc">Built for scale. A rigorous global scope architecture ensures your institute's data is isolated with enterprise-grade security.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="bg-dark rounded-4 p-5 text-center position-relative overflow-hidden shadow-lg" style="background: var(--dark-bg);">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at center, rgba(79,70,229,0.3) 0%, transparent 60%);"></div>
                <div class="position-relative z-1">
                    <h2 class="text-white fw-bold display-5 mb-4">Ready to transform your institute?</h2>
                    <p class="text-white-50 fs-5 mb-5 mx-auto" style="max-width: 600px;">Join the next generation of educators managing their coaching centers effortlessly with EduCore.</p>
                    <a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern btn-lg px-5">Start Your Free Trial</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center text-md-start">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h2 class="footer-brand mb-0"><i class="fas fa-layer-group me-2"></i> EduCore</h2>
                    <p class="footer-text mb-0">Elevating the standard of coaching management software.<br>A product by <a href="https://engeniusdigitech.netlify.app/" target="_blank" class="text-white fw-bold text-decoration-none border-bottom border-light pb-1">Engenius Digitech</a>.</p>
                </div>
                <div class="col-md-6 text-md-end footer-text">
                    <a href="{{ route('about') }}" class="text-decoration-none text-white opacity-75 me-3 hover-opacity-100">About Us</a>
                    <a href="{{ route('contact') }}" class="text-decoration-none text-white opacity-75 me-3 hover-opacity-100">Contact Us</a>
                    <a href="#" class="text-decoration-none text-white opacity-75 hover-opacity-100">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .hover-opacity-100 { transition: opacity 0.3s; }
        .hover-opacity-100:hover { opacity: 1 !important; }
        
        /* Simple animation keyframes */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translate3d(0, 40px, 0); }
            to { opacity: 1; transform: translate3d(0, 0, 0); }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translate3d(0, -40px, 0); }
            to { opacity: 1; transform: translate3d(0, 0, 0); }
        }
        @keyframes zoomIn {
            from { opacity: 0; transform: scale3d(0.9, 0.9, 0.9); }
            to { opacity: 1; transform: scale3d(1, 1, 1); }
        }
        .animate__fadeInUp { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
        .animate__fadeInDown { animation: fadeInDown 0.8s ease-out forwards; opacity: 0; }
        .animate__zoomIn { animation: zoomIn 0.8s ease-out forwards; opacity: 0; }
        .animate__delay-1s { animation-delay: 0.2s; }
    </style>
</body>
</html>
