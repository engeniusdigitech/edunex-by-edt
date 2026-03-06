<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduNex - The Ultimate Institute Management SaaS</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-light: #6366F1;
            --secondary-color: #EC4899;
            --dark-bg: #0F172A;
            --card-bg: #ffffff;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            background-color: #ffffff;
            overflow-x: hidden;
        }

        /* ── MESH GRADIENT BACKGROUNDS ── */
        .mesh-bg {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -1;
            overflow: hidden;
        }
        .mesh-circle-1 {
            position: absolute; top: -10%; left: -10%;
            width: 60%; height: 60%;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.05), transparent 70%);
            filter: blur(80px);
        }
        .mesh-circle-2 {
            position: absolute; bottom: -10%; right: -10%;
            width: 50%; height: 50%;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.04), transparent 70%);
            filter: blur(80px);
        }

        /* ── NAVBAR ── */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        /* ── HERO ── */
        .hero-section {
            padding: 180px 0 100px;
            position: relative;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary-color);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 24px;
            border: 1px solid rgba(79, 70, 229, 0.15);
        }
        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
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
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
        }

        /* ── BUTTONS ── */
        .btn-modern {
            padding: 14px 36px;
            font-weight: 700;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1.05rem;
        }
        .btn-primary-glow {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            box-shadow: 0 10px 30px -5px rgba(79, 70, 229, 0.4);
            border: none;
        }
        .btn-primary-glow:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px -5px rgba(79, 70, 229, 0.5);
            color: white;
        }
        .btn-outline-modern {
            background: #ffffff;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
        }
        .btn-outline-modern:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* ── FLOATING MOCKUP ── */
        .mockup-container {
            position: relative;
            margin-top: 80px;
            perspective: 1000px;
        }
        .mockup-img {
            max-width: 1000px;
            width: 100%;
            border-radius: 24px;
            box-shadow: 0 50px 100px -20px rgba(0,0,0,0.25);
            border: 8px solid #ffffff;
            transform: rotateX(5deg) scale(0.95);
            transition: all 0.6s ease;
        }
        .mockup-container:hover .mockup-img {
            transform: rotateX(0deg) scale(1);
        }

        /* ── IMPACT STATS ── */
        .stats-section {
            padding: 60px 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            background: #fafafa;
        }
        .stat-card {
            text-align: center;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-bg);
            margin-bottom: 5px;
        }
        .stat-label {
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── FEATURES ── */
        .features-section {
            padding: 100px 0;
        }
        .section-tag {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 16px;
            display: block;
        }
        .section-title {
            font-size: 3rem;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }
        .feature-card {
            background: var(--card-bg);
            border-radius: 28px;
            padding: 40px;
            border: 1px solid var(--border-color);
            height: 100%;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-color);
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.08);
        }
        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            margin-bottom: 24px;
            transition: all 0.4s ease;
        }
        .feature-card:hover .icon-box {
            transform: rotate(-10deg) scale(1.1);
        }
        .feature-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 16px;
        }
        .feature-desc {
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ── HOW IT WORKS ── */
        .step-num {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800;
            margin-bottom: 16px;
        }

        /* ── FAQ ── */
        .faq-section { padding: 100px 0; background: #fafafa; }
        .accordion-item {
            border: 1px solid var(--border-color) !important;
            border-radius: 20px !important;
            margin-bottom: 16px;
            overflow: hidden;
            background: #fff;
        }
        .accordion-button {
            padding: 24px;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--dark-bg);
            box-shadow: none !important;
        }
        .accordion-button:not(.collapsed) {
            background: #EEF2FF;
            color: var(--primary-color);
        }
        .accordion-body { padding: 24px; color: var(--text-muted); line-height: 1.6; }

        /* ── FINAL CTA ── */
        .cta-section { padding: 100px 0; }
        .cta-card {
            background: var(--dark-bg);
            border-radius: 32px;
            padding: 80px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-card::before {
            content: '';
            position: absolute; top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.1), transparent 70%);
        }

        /* ── FOOTER ── */
        .footer {
            background: #ffffff;
            padding: 80px 0 40px;
            border-top: 1px solid var(--border-color);
        }
        .footer-logo { font-size: 1.8rem; font-weight: 900; color: var(--primary-color); }
        .footer-link { color: var(--text-muted); text-decoration: none; font-weight: 500; transition: color 0.3s; }
        .footer-link:hover { color: var(--primary-color); }

    </style>
</head>
<body>

    <div class="mesh-bg">
        <div class="mesh-circle-1"></div>
        <div class="mesh-circle-2"></div>
    </div>

    <!-- Navigation -->
    @include('components.frontend-navbar')

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container px-4">
            <div class="hero-badge animate__animated animate__fadeInDown">
                ✨ Trusted by 150+ institutes across the country
            </div>
            <h1 class="hero-title animate__animated animate__zoomIn">
                Automate your institute.<br>
                <span>Empower your educators.</span>
            </h1>
            <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                The most complete, intuitive, and feature-rich platform to manage your educational center. From fee tracking to live classes — everything in one place.
            </p>

            {{-- Category Scroller --}}
            <div class="d-flex justify-content-center gap-2 flex-wrap mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                @foreach(['Coaching Centers', 'K-12 Schools', 'Music Academies', 'Language Schools', 'Skill Training', 'Sports Clubs'] as $cat)
                    <span class="badge rounded-pill px-3 py-2 border text-muted fw-500" style="background:#fff; font-size: 0.78rem;">{{ $cat }}</span>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center gap-3 flex-column flex-sm-row animate__animated animate__fadeInUp animate__delay-1s">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : url('/dashboard') }}" class="btn btn-primary-glow btn-modern">
                            Open Dashboard <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    @else
                        <a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern">
                            Start 7-Day Free Trial
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-modern btn-modern">
                            Institute Login
                        </a>
                    @endauth
                @endif
            </div>

            <div class="mockup-container animate__animated animate__fadeInUp animate__delay-2s">
                <img src="{{ asset('images/hero-banner.png') }}" alt="EduNex Dashboard" class="mockup-img">
            </div>
        </div>
    </section>

    <!-- Impact Stats -->
    <section class="stats-section">
        <div class="container px-4">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">150+</div>
                        <div class="stat-label">Institutes</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Students</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container px-4">
            <div class="text-center mb-5">
                <span class="section-tag">Powerful Features</span>
                <h2 class="section-title">Built for serious growth</h2>
                <p class="text-muted fs-5">Everything you need to run a modern education business.</p>
            </div>

            <div class="row g-4">
                {{-- Group: Academic --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-box" style="background: #EEF2FF; color: #4F46E5;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="feature-title">Batch Intelligence</h3>
                        <p class="feature-desc">Organize students into batches with specific subjects, teachers, and schedules. Real-time attendance tracking with daily logs.</p>
                    </div>
                </div>

                {{-- Group: Financial --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-box" style="background: #ECFDF5; color: #10B981;">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <h3 class="feature-title">Fee Automation</h3>
                        <p class="feature-desc">Set complex fee structures. Record payments, send automated WhatsApp reminders for dues, and identify defaulters instantly.</p>
                    </div>
                </div>

                {{-- Group: Communication --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-box" style="background: #FFF7ED; color: #F97316;">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h3 class="feature-title">Direct Notifications</h3>
                        <p class="feature-desc">Push alerts directly to individual students or entire batches. Keep everyone informed with portal-wide announcements.</p>
                    </div>
                </div>

                {{-- Group: Learning --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-box" style="background: #FDF2F8; color: #DB2777;">
                            <i class="fas fa-video"></i>
                        </div>
                        <h3 class="feature-title">Live Lectures</h3>
                        <p class="feature-desc">Integrated Jitsi video conferencing. Students join live classes directly from their dashboard with no external links needed.</p>
                    </div>
                </div>

                {{-- Group: Student Portal --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-box" style="background: #F0F9FF; color: #0EA5E9;">
                            <i class="fas fa-mobile-screen-button"></i>
                        </div>
                        <h3 class="feature-title">Student App / PWA</h3>
                        <p class="feature-desc">Our platform is a full PWA. Students can "install" the portal on their mobile home screen for a native app experience.</p>
                    </div>
                </div>

                {{-- Group: Security --}}
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-box" style="background: #F5F3FF; color: #8B5CF6;">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 class="feature-title">Enterprise Security</h3>
                        <p class="feature-desc">Strict multi-tenant isolation. Your data is isolated at the database level with granular role-based access for staff.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section class="py-5">
        <div class="container px-4 py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-tag">Seamless Onboarding</span>
                    <h2 class="section-title">Zero setup friction.</h2>
                    <p class="text-muted mb-5">Go from manual spreadsheets to automated management in less than 30 minutes.</p>
                    
                    <div class="mb-4">
                        <div class="step-num">1</div>
                        <h5 class="fw-bold">Create your Institute</h5>
                        <p class="text-muted small">Register and choose your custom subdomain for your staff and student portals.</p>
                    </div>
                    <div class="mb-4">
                        <div class="step-num">2</div>
                        <h5 class="fw-bold">Setup Batches & Subjects</h5>
                        <p class="text-muted small">Define your academic structure and fee plans for each category of study.</p>
                    </div>
                    <div class="mb-4">
                        <div class="step-num">3</div>
                        <h5 class="fw-bold">Import Students</h5>
                        <p class="text-muted small">Bulk upload students. Each student automatically gets login credentials for their portal.</p>
                    </div>
                    <div>
                        <div class="step-num">4</div>
                        <h5 class="fw-bold">Go Live</h5>
                        <p class="text-muted small">Start marking attendance, collecting fees, and sending automated portal notifications.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5 bg-white border rounded-4 shadow-sm">
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex" style="height: 60px;" class="mb-4">
                        <h4 class="fw-black mb-3">Save 20+ hours every month.</h4>
                        <p class="text-muted mb-4">"EduNex completely changed how we handle our 200+ students. The fee reminders alone saved us hours of repetitive phone calls."</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">RK</div>
                            <div>
                                <div class="fw-bold small">Rajesh Kumar</div>
                                <div class="text-muted" style="font-size: 0.75rem;">Director, Apex Classes</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container px-4">
            <div class="text-center mb-5">
                <span class="section-tag">Common Questions</span>
                <h2 class="section-title">Need clarity? We got you.</h2>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="welcomeFaq">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#f1">
                                    Is my institute data secure and private?
                                </button>
                            </h2>
                            <div id="f1" class="accordion-collapse collapse show" data-bs-parent="#welcomeFaq">
                                <div class="accordion-body">
                                    Absolutely. EduNex is built on a multi-tenant global scope architecture. This means your data is logically isolated from other institutes, and our database is encrypted at rest and in transit.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f2">
                                    Can students access it on their phones?
                                </button>
                            </h2>
                            <div id="f2" class="accordion-collapse collapse" data-bs-parent="#welcomeFaq">
                                <div class="accordion-body">
                                    Yes! The entire student portal is a Progressive Web App (PWA). Students can simply open the link on their mobile browser and tap "Add to Home Screen" to get a native app-like experience without downloading from the Play Store.
                               </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f3">
                                    How do fee reminders work?
                                </button>
                            </h2>
                            <div id="f3" class="accordion-collapse collapse" data-bs-parent="#welcomeFaq">
                                <div class="accordion-body">
                                    Our system automatically identifies students with pending dues. From the dashboard, you can click "Send Reminder" which generates a pre-filled WhatsApp message or triggers a portal notification instantly.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f4">
                                    Is there a limit on the number of students?
                                </button>
                            </h2>
                            <div id="f4" class="accordion-collapse collapse" data-bs-parent="#welcomeFaq">
                                <div class="accordion-body">
                                    No. Unlike our competitors, we believe in supporting your growth. We don't charge you based on student count. Enroll as many students as your institute can handle.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="cta-section">
        <div class="container px-4">
            <div class="cta-card shadow-lg animate__animated animate__fadeIn">
                <h2 class="text-white fw-black display-5 mb-4 position-relative z-1">Ready to lead your institute<br>into the digital age?</h2>
                <p class="text-white-50 fs-5 mb-5 mx-auto position-relative z-1" style="max-width: 600px;">
                    Join over 150 institutes that have already automated their operations with EduNex. Start your 7-day free trial today.
                </p>
                <div class="position-relative z-1">
                    <a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern px-5 py-3">Get Started Today <i class="fas fa-rocket ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container px-4">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex" style="height: 50px;" class="me-2">
                    </div>
                    <p class="text-muted small mb-4">The ultimate SaaS platform for modern educational institutes. Built by educators, for educators.</p>
                    <div class="d-flex gap-3">
                        <a href="https://www.linkedin.com/company/engenius-digitech/?viewAsMember=true" target="_blank" class="footer-link fs-5"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h6 class="fw-bold mb-4">Platform</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#features" class="footer-link small">Features</a></li>
                        <li class="mb-2"><a href="{{ route('pricing') }}" class="footer-link small">Pricing</a></li>
                        <li class="mb-2"><a href="#" class="footer-link small">Live Demo</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h6 class="fw-bold mb-4">Company</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('about') }}" class="footer-link small">About Us</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}" class="footer-link small">Contact</a></li>
                        <li class="mb-2"><a href="#" class="footer-link small">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-4 text-md-end">
                    <h6 class="fw-bold mb-4">Product by</h6>
                    <a href="https://engeniusdigitech.netlify.app/" target="_blank" class="text-decoration-none">
                        <h5 class="fw-black text-dark mb-1">Engenius Digitech</h5>
                        <p class="text-muted small">Specialized in SaaS solutions</p>
                    </a>
                </div>
            </div>
            <div class="border-top mt-5 pt-4 text-center">
                <p class="text-muted small mb-0">© {{ date('Y') }} EduNex. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
