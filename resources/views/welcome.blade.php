<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo />
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
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
        /* ── HERO REDESIGN ── */
        .hero-section {
            padding: 140px 0 100px;
            position: relative;
            overflow: hidden;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            color: var(--primary-color);
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 28px;
            border: 1px solid rgba(79, 70, 229, 0.15);
            box-shadow: 0 10px 30px -10px rgba(79, 70, 229, 0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4.2rem);
            font-weight: 950;
            line-height: 1.05;
            letter-spacing: -3px;
            margin-bottom: 28px;
            color: #0f172a;
        }

        .hero-title span {
            display: block;
            background: linear-gradient(135deg, #4f46e5 0%, #ec4899 50%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 10px 20px rgba(79, 70, 229, 0.15));
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #64748b;
            margin-bottom: 44px;
            max-width: 580px;
            line-height: 1.75;
            font-weight: 400;
        }

        /* Floating elements */
        .floating-shape {
            position: absolute;
            z-index: -1;
            pointer-events: none;
            opacity: 0.5;
            filter: blur(2px);
        }

        .shape-1 { top: 15%; left: 5%; animation: float 6s ease-in-out infinite; }
        .shape-2 { top: 60%; left: 10%; animation: float 8s ease-in-out infinite; }
        .shape-3 { top: 20%; right: 5%; animation: float 7s ease-in-out infinite; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .category-pill {
            background: rgba(255, 255, 255, 0.6) !important;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
            color: #475569 !important;
            font-weight: 600 !important;
            padding: 8px 16px !important;
            font-size: 0.75rem !important;
            transition: all 0.3s ease;
        }

        .category-pill:hover {
            background: #fff !important;
            border-color: var(--primary-color) !important;
            color: var(--primary-color) !important;
            transform: translateY(-2px);
        }

        /* ── IMPACT STATS ── */
        /* ── IMPACT STATS ── */
        .stats-section {
            padding: 80px 0;
            position: relative;
        }

        .stats-bar {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 40px;
            padding: 60px 40px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 40px 100px -20px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 2;
        }

        .stat-item {
            text-align: center;
            position: relative;
        }

        @media (min-width: 768px) {
            .stat-item:not(:last-child)::after {
                content: '';
                position: absolute;
                right: -12px;
                top: 20%;
                height: 60%;
                width: 1px;
                background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.08), transparent);
            }
        }

        .stat-number {
            font-size: clamp(2.5rem, 4vw, 3.8rem);
            font-weight: 950;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
            letter-spacing: -3px;
            line-height: 1;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .stat-icon {
            font-size: 1.2rem;
            color: var(--primary-light);
            margin-bottom: 15px;
            opacity: 0.7;
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
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* ── FAQ ── */
        .faq-section {
            padding: 100px 0;
            background: transparent;
        }

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

        .accordion-body {
            padding: 24px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ── FINAL CTA ── */
        .cta-section {
            padding: 100px 0;
        }

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
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.1), transparent 70%);
        }



        /* ── PORTAL SHOWCASE ── */
        .portal-showcase {
            position: relative;
            z-index: 1;
        }

        .portal-nav {
            display: inline-flex;
            background: rgba(255, 255, 255, 0.5);
            padding: 5px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .portal-nav-btn {
            padding: 10px 24px;
            border-radius: 15px;
            border: none;
            background: transparent;
            font-weight: 700;
            font-size: 0.85rem;
            color: #64748b;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .portal-nav-btn.active {
            background: var(--primary-color);
            color: #fff;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }

        .portal-display {
            position: relative;
            perspective: 1000px;
        }

        .portal-content {
            display: none;
            animation: fadeIn 0.6s ease-out;
        }

        .portal-content.active {
            display: block;
        }

        .display-wrapper {
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.5s ease;
            max-width: 580px;
            margin: 0 auto;
        }

        .desktop-mockup {
            width: 100%;
            border-radius: 24px;
            box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .glass-reflection {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 50%, rgba(255,255,255,0.05) 100%);
            pointer-events: none;
            z-index: 2;
            border-radius: 24px;
        }

        .mobile-mockup {
            position: absolute;
            bottom: -20px;
            right: -40px;
            width: 220px;
            border-radius: 32px;
            box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.3);
            border: 8px solid #1e293b;
            z-index: 5;
            background: #1e293b;
            overflow: hidden;
            transition: transform 0.5s ease;
        }

        .mobile-mockup img {
            width: 100%;
            height: auto;
            display: block;
        }

        .display-wrapper:hover .mobile-mockup {
            transform: translateY(-10px) rotate(-2deg);
        }

        .floating-info-card {
            position: absolute;
            padding: 15px 20px;
            border-radius: 20px;
            z-index: 10;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: float 5s ease-in-out infinite;
        }

        .card-1 { top: 15%; left: -20px; animation-delay: 0s; }
        .card-2 { top: 10%; left: -10px; animation-delay: 1s; }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @media (max-width: 991px) {
            .mobile-mockup {
                width: 180px;
                right: 0;
                bottom: -20px;
            }
        }

        @media (max-width: 767px) {
            .portal-display {
                min-height: 500px;
            }

            .mobile-mockup {
                position: relative;
                width: 240px;
                right: auto;
                bottom: auto;
                margin: 40px auto 0;
                display: block;
            }
        }
    </style>

    @verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Is my institute data secure and private?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Absolutely. EduNex is built on a multi-tenant global scope architecture. Your data is logically isolated from other institutes, and our database is encrypted at rest and in transit."
          }
        },
        {
          "@type": "Question",
          "name": "Can students access EduNex on their phones?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes! The entire student portal is a Progressive Web App (PWA). Students can simply open the link on their mobile browser and tap \u0027Add to Home Screen\u0027 to get a native app-like experience without downloading from the Play Store."
          }
        },
        {
          "@type": "Question",
          "name": "How do fee reminders work?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Our system automatically identifies students with pending dues. From the dashboard, you can click \u0027Send Reminder\u0027 which generates a pre-filled WhatsApp message or triggers a portal notification instantly."
          }
        },
        {
          "@type": "Question",
          "name": "Is there a limit on the number of students?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No. Unlike our competitors, we believe in supporting your growth. We don\u0027t charge you based on student count. Enroll as many students as your institute can handle."
          }
        }
      ]
    }
    </script>
    @endverbatim

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

    <!-- Hero Section -->
    <section class="hero-section" style="position: relative; z-index: 10;">
        <!-- Decorative Background Elements -->
        <div class="floating-shape shape-1">
            <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="60" r="60" fill="url(#paint0_linear_hero)" fill-opacity="0.1"/>
                <defs><linearGradient id="paint0_linear_hero" x1="0" y1="0" x2="120" y2="120" gradientUnits="userSpaceOnUse"><stop stop-color="#4F46E5"/><stop offset="1" stop-color="#EC4899"/></linearGradient></defs>
            </svg>
        </div>
        <div class="floating-shape shape-2">
            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="80" height="80" rx="20" fill="#F59E0B" fill-opacity="0.1"/>
            </svg>
        </div>
        <div class="floating-shape shape-3">
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 0L93.3013 25V75L50 100L6.69873 75V25L50 0Z" fill="#06B6D4" fill-opacity="0.1"/>
            </svg>
        </div>

        <div class="container px-4">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
                    <div class="hero-badge animate__animated animate__fadeInDown">
                        <span class="me-2">✨</span> Trusted by 100+ institutes
                    </div>
                    <h1 class="hero-title animate__animated animate__fadeInUp">
                        The Smarter Way to<br>
                        <span>Manage Your Institute.</span>
                    </h1>
                    <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                        EduNex is the ultimate <strong>all-in-one platform</strong> designed to automate every aspect of your educational business. From attendance to online fee payments — we've got you covered.
                    </p>

                    <div class="d-flex justify-content-center justify-content-lg-start gap-2 flex-wrap mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                        @foreach(['Coaching Centers', 'K-12 Schools', 'Skill Training', 'Language Academies', 'Music Schools', 'Sports Clubs'] as $cat)
                            <span class="badge rounded-pill category-pill">{{ $cat }}</span>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center justify-content-lg-start gap-3 flex-column flex-sm-row animate__animated animate__fadeInUp animate__delay-2s">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : url('/dashboard') }}"
                                    class="btn btn-primary-glow btn-modern px-5 py-3">
                                    Go to Dashboard <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            @else
                                <a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern px-5 py-3 shadow-lg">
                                    Start Your Free Trial <i class="fas fa-rocket ms-2"></i>
                                </a>
                                <a href="{{ route('login') }}" class="btn btn-outline-modern btn-modern px-5 py-3">
                                    Institute Login
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="portal-showcase animate__animated animate__zoomIn animate__delay-1s">
                        <div class="d-flex justify-content-center mb-4">
                            <div class="portal-nav glass">
                                <button class="portal-nav-btn active" onclick="switchPortal('admin')">Admin Hub</button>
                                <button class="portal-nav-btn" onclick="switchPortal('student')">Student App</button>
                            </div>
                        </div>

                        <div class="portal-display">
                            <!-- Admin Portal Content -->
                            <div id="admin-portal" class="portal-content active">
                                <div class="display-wrapper">
                                    <div class="glass-reflection"></div>
                                    <img src="{{ asset('images/hero-banner.png') }}" alt="EduNex Admin Dashboard" class="desktop-mockup">
                                    <div class="mobile-mockup">
                                        <img src="{{ asset('images/hero-banner-mobile.png') }}" alt="EduNex Mobile Admin">
                                    </div>
                                    <!-- Floating Info Cards -->
                                    <div class="floating-info-card card-1 d-none d-md-block glass">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="info-icon bg-success bg-opacity-10 text-success"><i class="fas fa-check-circle"></i></div>
                                            <div>
                                                <div class="fw-bold small">Attendance Done</div>
                                                <div class="text-muted" style="font-size: 0.65rem;">Batch A-12 updated</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Portal Content -->
                            <div id="student-portal" class="portal-content">
                                <div class="display-wrapper">
                                    <div class="glass-reflection"></div>
                                    <img src="{{ asset('images/hero-banner-2.png') }}" alt="EduNex Student Portal" class="desktop-mockup">
                                    <div class="mobile-mockup">
                                        <img src="{{ asset('images/hero-banner-2-mobile.png') }}" alt="EduNex Student App">
                                    </div>
                                    <div class="floating-info-card card-2 d-none d-md-block glass">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="info-icon bg-primary bg-opacity-10 text-primary"><i class="fas fa-receipt"></i></div>
                                            <div>
                                                <div class="fw-bold small">Fee Paid</div>
                                                <div class="text-muted" style="font-size: 0.65rem;">Via Student App</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Impact Stats -->
    <section class="stats-section">
        <div class="container px-4">
            <div class="stats-bar animate__animated animate__fadeInUp">
                <div class="row g-4 g-md-0">
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <div class="stat-icon"><i class="fas fa-school"></i></div>
                            <div class="stat-number">100+</div>
                            <div class="stat-label">Institutes</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <div class="stat-icon"><i class="fas fa-users"></i></div>
                            <div class="stat-number">50K+</div>
                            <div class="stat-label">Students</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <div class="stat-icon"><i class="fas fa-bolt"></i></div>
                            <div class="stat-number">99.9%</div>
                            <div class="stat-label">Uptime</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-item">
                            <div class="stat-icon"><i class="fas fa-headset"></i></div>
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ FEATURES SECTION — PREMIUM REDESIGN ══ -->
    <section id="features" class="features-section" style="position:relative;z-index:10;padding:100px 0;">
        <style>
            /* ── Feature Cards Redesign ── */
            .feat-card {
                border-radius: 28px;
                padding: 36px;
                border: 1px solid rgba(255,255,255,0.6);
                background: rgba(255,255,255,0.7);
                backdrop-filter: blur(18px);
                -webkit-backdrop-filter: blur(18px);
                box-shadow: 0 4px 24px rgba(0,0,0,0.04);
                transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.35s ease, border-color 0.3s;
                height: 100%;
                position: relative;
                overflow: hidden;
            }
            .feat-card::before {
                content:'';
                position:absolute;
                top:-60px; right:-60px;
                width:160px; height:160px;
                border-radius:50%;
                opacity:0.06;
                transition: opacity 0.35s ease, transform 0.35s ease;
            }
            .feat-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 24px 60px -12px rgba(0,0,0,0.12);
            }
            .feat-card:hover::before { opacity:0.12; transform: scale(1.2); }

            /* Card accent colours */
            .feat-card.c-indigo  { border-color:rgba(79,70,229,0.12); }
            .feat-card.c-indigo::before  { background:#4F46E5; }
            .feat-card.c-indigo:hover    { border-color:rgba(79,70,229,0.35); box-shadow:0 24px 60px -12px rgba(79,70,229,0.15); }

            .feat-card.c-green   { border-color:rgba(16,185,129,0.12); }
            .feat-card.c-green::before   { background:#10B981; }
            .feat-card.c-green:hover     { border-color:rgba(16,185,129,0.35); box-shadow:0 24px 60px -12px rgba(16,185,129,0.15); }

            .feat-card.c-orange  { border-color:rgba(249,115,22,0.12); }
            .feat-card.c-orange::before  { background:#F97316; }
            .feat-card.c-orange:hover    { border-color:rgba(249,115,22,0.35); box-shadow:0 24px 60px -12px rgba(249,115,22,0.12); }

            .feat-card.c-pink    { border-color:rgba(219,39,119,0.12); }
            .feat-card.c-pink::before    { background:#DB2777; }
            .feat-card.c-pink:hover      { border-color:rgba(219,39,119,0.35); box-shadow:0 24px 60px -12px rgba(219,39,119,0.12); }

            .feat-card.c-sky     { border-color:rgba(14,165,233,0.12); }
            .feat-card.c-sky::before     { background:#0EA5E9; }
            .feat-card.c-sky:hover       { border-color:rgba(14,165,233,0.35); box-shadow:0 24px 60px -12px rgba(14,165,233,0.12); }

            .feat-card.c-violet  { border-color:rgba(139,92,246,0.12); }
            .feat-card.c-violet::before  { background:#8B5CF6; }
            .feat-card.c-violet:hover    { border-color:rgba(139,92,246,0.35); box-shadow:0 24px 60px -12px rgba(139,92,246,0.12); }

            .feat-card.c-emerald { border-color:rgba(5,150,105,0.12); }
            .feat-card.c-emerald::before { background:#059669; }
            .feat-card.c-emerald:hover   { border-color:rgba(5,150,105,0.35); box-shadow:0 24px 60px -12px rgba(5,150,105,0.12); }

            .feat-card.c-amber   { border-color:rgba(217,119,6,0.12); }
            .feat-card.c-amber::before   { background:#D97706; }
            .feat-card.c-amber:hover     { border-color:rgba(217,119,6,0.35); box-shadow:0 24px 60px -12px rgba(217,119,6,0.12); }

            .feat-card.c-red     { border-color:rgba(220,38,38,0.12); }
            .feat-card.c-red::before     { background:#DC2626; }
            .feat-card.c-red:hover       { border-color:rgba(220,38,38,0.35); box-shadow:0 24px 60px -12px rgba(220,38,38,0.12); }

            .feat-card.c-purple  { border-color:rgba(124,58,237,0.12); }
            .feat-card.c-purple::before  { background:#7C3AED; }
            .feat-card.c-purple:hover    { border-color:rgba(124,58,237,0.35); box-shadow:0 24px 60px -12px rgba(124,58,237,0.12); }

            .feat-card.c-lime    { border-color:rgba(22,163,74,0.12); }
            .feat-card.c-lime::before    { background:#16A34A; }
            .feat-card.c-lime:hover      { border-color:rgba(22,163,74,0.35); box-shadow:0 24px 60px -12px rgba(22,163,74,0.12); }

            .feat-card.c-rose    { border-color:rgba(225,29,72,0.12); }
            .feat-card.c-rose::before    { background:#E11D48; }
            .feat-card.c-rose:hover      { border-color:rgba(225,29,72,0.35); box-shadow:0 24px 60px -12px rgba(225,29,72,0.12); }

            /* Icon box */
            .feat-icon {
                width:58px; height:58px; border-radius:18px;
                display:flex; align-items:center; justify-content:center;
                font-size:1.35rem; margin-bottom:22px; flex-shrink:0;
                transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
                position:relative; z-index:1;
            }
            .feat-card:hover .feat-icon { transform: rotate(-8deg) scale(1.15); }

            /* Title & desc */
            .feat-title {
                font-size:1.15rem; font-weight:800; margin-bottom:10px;
                color:#0F172A; position:relative; z-index:1;
            }
            .feat-desc {
                color:#64748B; font-size:0.875rem; line-height:1.65;
                position:relative; z-index:1;
            }

            /* Pill tags */
            .feat-pills { display:flex; flex-wrap:wrap; gap:6px; margin-top:18px; position:relative; z-index:1; }
            .feat-pill {
                font-size:0.68rem; font-weight:700; padding:4px 10px;
                border-radius:50px; text-transform:uppercase; letter-spacing:.6px;
            }

            /* NEW badge */
            .feat-new {
                position:absolute; top:18px; right:18px;
                background:linear-gradient(135deg,#4F46E5,#EC4899);
                color:#fff; font-size:0.6rem; font-weight:800;
                padding:3px 10px; border-radius:50px; letter-spacing:1px;
                text-transform:uppercase; z-index:2;
            }
        </style>

        <div class="container px-4">
            <!-- Section Header -->
            <div class="text-center mb-5 pb-2">
                <span class="section-tag">Powerful Features</span>
                <h2 class="section-title">Everything your institute needs</h2>
                <p class="text-muted fs-5" style="max-width:600px;margin:0 auto;">From attendance to live classes, fees to group chat — all in one beautifully designed platform.</p>
            </div>

            <!-- Row 1: 3 wide cards -->
            <div class="row g-4 mb-4">

                <!-- Batch Intelligence -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-indigo h-100">
                        <div class="feat-icon" style="background:#EEF2FF;color:#4F46E5;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="feat-title">Batch Intelligence</h3>
                        <p class="feat-desc">Organize students into batches with specific subjects, class teachers, and timetables. Mark attendance in bulk with real-time logs and daily reports.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#EEF2FF;color:#4F46E5;">Attendance</span>
                            <span class="feat-pill" style="background:#EEF2FF;color:#4F46E5;">Timetable</span>
                            <span class="feat-pill" style="background:#EEF2FF;color:#4F46E5;">Batches</span>
                        </div>
                    </div>
                </div>

                <!-- Fee Automation — UPDATED with student app -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-green h-100">
                        <div class="feat-icon" style="background:#ECFDF5;color:#10B981;">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <h3 class="feat-title">Fee Automation</h3>
                        <p class="feat-desc">Set complex fee structures, record manual payments, and send automated WhatsApp reminders. Students can also <strong>pay their fees directly via the Student App</strong> — Stripe & Razorpay supported.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#ECFDF5;color:#059669;">Online Payment</span>
                            <span class="feat-pill" style="background:#ECFDF5;color:#059669;">WhatsApp Alerts</span>
                            <span class="feat-pill" style="background:#ECFDF5;color:#059669;">Defaulter Reports</span>
                        </div>
                    </div>
                </div>

                <!-- Direct Notifications -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-orange h-100">
                        <div class="feat-icon" style="background:#FFF7ED;color:#F97316;">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h3 class="feat-title">Direct Notifications</h3>
                        <p class="feat-desc">Push instant alerts to individual students or entire batches. Broadcast portal-wide announcements and keep every student informed in seconds.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#FFF7ED;color:#F97316;">Portal Alerts</span>
                            <span class="feat-pill" style="background:#FFF7ED;color:#F97316;">Batch Broadcast</span>
                        </div>
                    </div>
                </div>

                <!-- Live Lectures -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-pink h-100">
                        <div class="feat-icon" style="background:#FDF2F8;color:#DB2777;">
                            <i class="fas fa-video"></i>
                        </div>
                        <h3 class="feat-title">Live Lectures</h3>
                        <p class="feat-desc">Built-in Jitsi video conferencing. Teachers start a live class from the dashboard and students join instantly — no external links, no third-party apps needed.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#FDF2F8;color:#DB2777;">Jitsi Meet</span>
                            <span class="feat-pill" style="background:#FDF2F8;color:#DB2777;">1-Click Join</span>
                            <span class="feat-pill" style="background:#FDF2F8;color:#DB2777;">Recordings</span>
                        </div>
                    </div>
                </div>

                <!-- Student App / PWA -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-sky h-100">
                        <div class="feat-icon" style="background:#F0F9FF;color:#0EA5E9;">
                            <i class="fas fa-mobile-screen-button"></i>
                        </div>
                        <h3 class="feat-title">Student App / PWA</h3>
                        <p class="feat-desc">A full Progressive Web App — no Play Store needed. Students install it from their browser, check timetables, pay fees, join live classes, and submit leaves — all from one tap.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#F0F9FF;color:#0EA5E9;">PWA</span>
                            <span class="feat-pill" style="background:#F0F9FF;color:#0EA5E9;">Android & iOS</span>
                            <span class="feat-pill" style="background:#F0F9FF;color:#0EA5E9;">Fee Payments</span>
                        </div>
                    </div>
                </div>

                <!-- Enterprise Security -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-violet h-100">
                        <div class="feat-icon" style="background:#F5F3FF;color:#8B5CF6;">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 class="feat-title">Enterprise Security</h3>
                        <p class="feat-desc">Strict multi-tenant isolation at the database level. Your institute's data is completely separated. Granular role-based access ensures every staff member only sees what they need.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#F5F3FF;color:#8B5CF6;">Multi-Tenant</span>
                            <span class="feat-pill" style="background:#F5F3FF;color:#8B5CF6;">Role-Based Access</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: 4 compact cards + 1 wide highlight card -->
            <div class="row g-4">

                <!-- Staff Group Chat — NEW badge -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-emerald h-100">
                        <span class="feat-new">New</span>
                        <div class="feat-icon" style="background:#ECFDF5;color:#059669;">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3 class="feat-title">Staff Group Chat</h3>
                        <p class="feat-desc">Real-time group chat for Admin, Teachers, Principal, and Receptionist. @mention any colleague to grab their attention. Institute-isolated — your conversations stay private.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#ECFDF5;color:#059669;">@Mentions</span>
                            <span class="feat-pill" style="background:#ECFDF5;color:#059669;">Group Chat</span>
                            <span class="feat-pill" style="background:#ECFDF5;color:#059669;">Real-Time</span>
                        </div>
                    </div>
                </div>

                <!-- Analytics & Reports -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-amber h-100">
                        <div class="feat-icon" style="background:#FEF3C7;color:#D97706;">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3 class="feat-title">Analytics & Reports</h3>
                        <p class="feat-desc">Revenue trends, attendance heatmaps, fee defaulter lists, and individual student performance — all exportable to PDF with one click.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#FEF3C7;color:#D97706;">PDF Export</span>
                            <span class="feat-pill" style="background:#FEF3C7;color:#D97706;">Revenue Charts</span>
                        </div>
                    </div>
                </div>

                <!-- Timetable Manager -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-red h-100">
                        <div class="feat-icon" style="background:#FEE2E2;color:#DC2626;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="feat-title">Timetable Manager</h3>
                        <p class="feat-desc">Build detailed weekly timetables, assign teachers to time slots, and let every staff member view their own personal schedule from any device.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#FEE2E2;color:#DC2626;">Weekly View</span>
                            <span class="feat-pill" style="background:#FEE2E2;color:#DC2626;">My Schedule</span>
                        </div>
                    </div>
                </div>

                <!-- Leave Management -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-purple h-100">
                        <div class="feat-icon" style="background:#EDE9FE;color:#7C3AED;">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <h3 class="feat-title">Leave Management</h3>
                        <p class="feat-desc">Students and staff submit leave requests online. Admins and principals approve or reject with a single click, with full history logs.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#EDE9FE;color:#7C3AED;">Staff Leaves</span>
                            <span class="feat-pill" style="background:#EDE9FE;color:#7C3AED;">Student Leaves</span>
                        </div>
                    </div>
                </div>

                <!-- Tests & Exams -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-lime h-100">
                        <div class="feat-icon" style="background:#F0FDF4;color:#16A34A;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="feat-title">Tests & Exams</h3>
                        <p class="feat-desc">Schedule tests, enter scores for each student per subject, and auto-generate report cards. Monitor academic progress over time.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#F0FDF4;color:#16A34A;">Score Entry</span>
                            <span class="feat-pill" style="background:#F0FDF4;color:#16A34A;">Report Cards</span>
                        </div>
                    </div>
                </div>

                <!-- Multi-Role Access -->
                <div class="col-lg-4 col-md-6">
                    <div class="feat-card c-rose h-100">
                        <div class="feat-icon" style="background:#FFF1F2;color:#E11D48;">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h3 class="feat-title">Multi-Role Access</h3>
                        <p class="feat-desc">Admin, Principal, Teacher, Receptionist — each role sees a tailored interface with exactly the tools they need and nothing more.</p>
                        <div class="feat-pills">
                            <span class="feat-pill" style="background:#FFF1F2;color:#E11D48;">4 Staff Roles</span>
                            <span class="feat-pill" style="background:#FFF1F2;color:#E11D48;">Custom Views</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <!-- ── USE CASES SECTION ── -->
    <section class="py-5" style="position:relative;z-index:10;">
        <div class="container px-4 py-4">
            <div class="text-center mb-5">
                <span class="section-tag">Who Is It For?</span>
                <h2 class="section-title">Built for every type of institute</h2>
                <p class="text-muted fs-5">Whether you run 20 students or 2,000 — EduNex scales with you.</p>
            </div>
            <div class="row g-4">
                @foreach([
                    ['icon'=>'fas fa-chalkboard-teacher','color'=>'#4F46E5','bg'=>'#EEF2FF','title'=>'Coaching Centers','desc'=>'Manage multiple batches, subjects, and fee plans. Automate reminders for dues.'],
                    ['icon'=>'fas fa-school','color'=>'#10B981','bg'=>'#ECFDF5','title'=>'K-12 Schools','desc'=>'Assign class teachers, mark daily attendance, manage exams and parent notifications.'],
                    ['icon'=>'fas fa-music','color'=>'#EC4899','bg'=>'#FDF2F8','title'=>'Music & Arts Academies','desc'=>'Track individual student progress, schedule lessons, and manage monthly fee collection.'],
                    ['icon'=>'fas fa-language','color'=>'#F59E0B','bg'=>'#FEF3C7','title'=>'Language Schools','desc'=>'Run multiple language courses simultaneously with dedicated student portals.'],
                    ['icon'=>'fas fa-dumbbell','color'=>'#8B5CF6','bg'=>'#F5F3FF','title'=>'Sports & Fitness Clubs','desc'=>'Manage memberships, attendance, schedules, and monthly billing with ease.'],
                    ['icon'=>'fas fa-laptop-code','color'=>'#0EA5E9','bg'=>'#F0F9FF','title'=>'Skill Training Centers','desc'=>'Deliver online and offline training with live lectures, homework, and assessments.'],
                ] as $uc)
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card glass d-flex align-items-start gap-4" style="padding:28px;">
                        <div class="icon-box flex-shrink-0" style="background:{{$uc['bg']}};color:{{$uc['color']}};width:50px;height:50px;font-size:1.2rem;border-radius:14px;">
                            <i class="{{$uc['icon']}}"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{$uc['title']}}</h5>
                            <p class="text-muted small mb-0">{{$uc['desc']}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── COMPARISON TABLE ── -->
    <section class="py-5" style="position:relative;z-index:10;">
        <div class="container px-4 py-4">
            <div class="text-center mb-5">
                <span class="section-tag">Why EduNex?</span>
                <h2 class="section-title">Stop managing with spreadsheets</h2>
                <p class="text-muted fs-5">See how EduNex stacks up against the alternatives.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="glass rounded-4 p-4 p-md-5">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" style="font-size:0.9rem;">
                                <thead>
                                    <tr>
                                        <th style="min-width:220px;font-size:0.8rem;text-transform:uppercase;letter-spacing:1px;color:#64748B;">Feature</th>
                                        <th class="text-center" style="color:#4F46E5;font-weight:800;">EduNex</th>
                                        <th class="text-center text-muted" style="font-weight:600;">Spreadsheets</th>
                                        <th class="text-center text-muted" style="font-weight:600;">WhatsApp Groups</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach([
                                        ['Fee automation & reminders', true, false, false],
                                        ['Attendance tracking', true, false, false],
                                        ['Student portal & login', true, false, false],
                                        ['Live video lectures', true, false, false],
                                        ['Role-based staff access', true, false, false],
                                        ['Performance analytics', true, false, false],
                                        ['Homework & test management', true, false, false],
                                        ['Group chat with @mentions', true, false, true],
                                    ] as [$feat, $a, $b, $c])
                                    <tr style="border-color:#F1F5F9;">
                                        <td class="fw-semibold text-dark">{{ $feat }}</td>
                                        <td class="text-center"><span style="color:#10B981;font-size:1.1rem;">✓</span></td>
                                        <td class="text-center"><span style="color:#EF4444;font-size:1.1rem;">{{ $b ? '✓' : '✗' }}</span></td>
                                        <td class="text-center"><span style="{{ $c ? 'color:#F59E0B' : 'color:#EF4444' }};font-size:1.1rem;">{{ $c ? '✓' : '✗' }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── TESTIMONIALS ── -->
    <section class="py-5" style="position:relative;z-index:10;">
        <div class="container px-4 py-4">
            <div class="text-center mb-5">
                <span class="section-tag">Real Stories</span>
                <h2 class="section-title">Loved by institute owners</h2>
            </div>
            <div class="row g-4">
                @foreach([
                    ['name'=>'Rajesh Kumar','role'=>'Director, Apex Coaching Center','initials'=>'RK','color'=>'#4F46E5','quote'=>'EduNex completely changed how we manage our 300+ students. The fee reminders alone saved us 10+ hours of phone calls every month. The WhatsApp integration is a game changer.'],
                    ['name'=>'Priya Sharma','role'=>'Principal, Bright Minds Academy','initials'=>'PS','color'=>'#EC4899','quote'=>'As a principal, the analytics dashboard gives me full visibility into attendance trends and student performance. I can now make data-driven decisions instead of guessing.'],
                    ['name'=>'Arjun Mehta','role'=>'Owner, CodeCraft Skill Institute','initials'=>'AM','color'=>'#10B981','quote'=>'We run 6 different technology courses with 400 students. EduNex handles all of it — from live lectures to test scores — in one place. The student PWA is brilliant!'],
                ] as $t)
                <div class="col-lg-4">
                    <div class="feature-card glass h-100" style="padding:36px;">
                        <div class="mb-4" style="color:#F59E0B;font-size:1rem;">★★★★★</div>
                        <p class="text-muted mb-4" style="line-height:1.7;font-size:0.95rem;">"{{ $t['quote'] }}"</p>
                        <div class="d-flex align-items-center gap-3 mt-auto">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0" style="width:44px;height:44px;background:{{$t['color']}};font-size:0.85rem;">{{ $t['initials'] }}</div>
                            <div>
                                <div class="fw-bold" style="font-size:0.9rem;">{{ $t['name'] }}</div>
                                <div class="text-muted" style="font-size:0.75rem;">{{ $t['role'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── MOBILE / PWA SECTION ── -->
    <section class="py-5" style="position:relative;z-index:10;">
        <div class="container px-4 py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center">
                    <div class="glass rounded-4 p-5 d-inline-block" style="background:linear-gradient(135deg,rgba(79,70,229,0.06),rgba(236,72,153,0.06));">
                        <div class="mb-4">
                            <div style="font-size:4rem;">📱</div>
                        </div>
                        <div class="row g-3 text-start">
                            @foreach(['Students check timetables anytime','View attendance & fee status','Join live lectures with 1 tap','Submit leave requests on the go','Download homework attachments'] as $item)
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background:rgba(255,255,255,0.7);">
                                    <div style="width:28px;height:28px;border-radius:8px;background:#EEF2FF;color:#4F46E5;display:flex;align-items:center;justify-content:center;font-size:0.75rem;flex-shrink:0;"><i class="fas fa-check"></i></div>
                                    <span class="fw-semibold" style="font-size:0.88rem;">{{ $item }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="section-tag">Mobile-First Experience</span>
                    <h2 class="section-title">Your institute in every student's pocket</h2>
                    <p class="text-muted fs-5 mb-4">EduNex is a full <strong>Progressive Web App (PWA)</strong>. No app store needed. Students simply open the link in their browser and tap "Add to Home Screen" — they get a native app experience instantly.</p>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <div class="glass rounded-3 px-4 py-3 text-center" style="min-width:120px;">
                            <div class="fw-black" style="font-size:1.8rem;color:#4F46E5;">0</div>
                            <div class="text-muted small">App Store<br>Downloads</div>
                        </div>
                        <div class="glass rounded-3 px-4 py-3 text-center" style="min-width:120px;">
                            <div class="fw-black" style="font-size:1.8rem;color:#10B981;">100%</div>
                            <div class="text-muted small">Works on<br>Any Device</div>
                        </div>
                        <div class="glass rounded-3 px-4 py-3 text-center" style="min-width:120px;">
                            <div class="fw-black" style="font-size:1.8rem;color:#EC4899;">1 tap</div>
                            <div class="text-muted small">To Install<br>on Phone</div>
                        </div>
                    </div>
                    <a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern px-5 py-3">Start Free Trial <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section class="py-5" style="position: relative; z-index: 10;">
        <div class="container px-4 py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-tag">Seamless Onboarding</span>
                    <h2 class="section-title">Zero setup friction.</h2>
                    <p class="text-muted mb-5">Go from manual spreadsheets to automated management in less than 30
                        minutes.</p>

                    <div class="mb-4">
                        <div class="step-num">1</div>
                        <h5 class="fw-bold">Create your Institute</h5>
                        <p class="text-muted small">Register and choose your custom subdomain for your staff and student
                            portals.</p>
                    </div>
                    <div class="mb-4">
                        <div class="step-num">2</div>
                        <h5 class="fw-bold">Setup Batches & Subjects</h5>
                        <p class="text-muted small">Define your academic structure and fee plans for each category of
                            study.</p>
                    </div>
                    <div class="mb-4">
                        <div class="step-num">3</div>
                        <h5 class="fw-bold">Import Students</h5>
                        <p class="text-muted small">Bulk upload students. Each student automatically gets login
                            credentials for their portal.</p>
                    </div>
                    <div>
                        <div class="step-num">4</div>
                        <h5 class="fw-bold">Go Live</h5>
                        <p class="text-muted small">Start marking attendance, collecting fees, and sending automated
                            portal notifications.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5 bg-white border rounded-4 shadow-sm glass">
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex" style="height: 60px;" class="mb-4">
                        <h4 class="fw-black mb-3">Save 20+ hours every month.</h4>
                        <p class="text-muted mb-4">"EduNex completely changed how we handle our 200+ students. The fee
                            reminders alone saved us hours of repetitive phone calls."</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                style="width: 40px; height: 40px;">RK</div>
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
    <section class="faq-section" style="position: relative; z-index: 10;">
        <div class="container px-4">
            <div class="text-center mb-5">
                <span class="section-tag">Common Questions</span>
                <h2 class="section-title">Need clarity? We got you.</h2>
                <p class="text-muted fs-5">Everything you need to know before getting started.</p>
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
                                    Absolutely. EduNex is built on a multi-tenant global scope architecture. Your data is logically isolated from other institutes, and our database is encrypted at rest and in transit. Each institute operates in a fully sandboxed environment.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f2">
                                    Can students access EduNex on their phones?
                                </button>
                            </h2>
                            <div id="f2" class="accordion-collapse collapse" data-bs-parent="#welcomeFaq">
                                <div class="accordion-body">
                                    Yes! The entire student portal is a Progressive Web App (PWA). Students simply open the link in their mobile browser and tap "Add to Home Screen" to get a native app-like experience — no Play Store or App Store download required.
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
                                    Our system automatically identifies students with pending dues. From the dashboard, click "Send Reminder" — it generates a pre-filled WhatsApp message or triggers an instant portal notification to the student. No manual follow-up needed.
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
                                    No. Unlike many competitors, we don't charge per student. Enroll as many students as your institute can handle. Your subscription covers the entire platform, regardless of how many students you manage.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f5">
                                    Can different staff members have different access levels?
                                </button>
                            </h2>
                            <div id="f5" class="accordion-collapse collapse" data-bs-parent="#welcomeFaq">
                                <div class="accordion-body">
                                    Yes. EduNex has granular role-based access control. You can assign roles like Institute Admin, Principal, Teacher, and Receptionist — each with a customized set of permissions. Teachers only see their batches; receptionists handle admissions without touching finances.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f6">
                                    How does the live lecture feature work?
                                </button>
                            </h2>
                            <div id="f6" class="accordion-collapse collapse" data-bs-parent="#welcomeFaq">
                                <div class="accordion-body">
                                    EduNex integrates with Jitsi Meet for video conferencing. Teachers schedule a live lecture, set the time, and start it from the dashboard. Students see a "Join" button appear on their portal at the scheduled time — no separate app or link needed.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f7">
                                    What is the Staff Group Chat feature?
                                </button>
                            </h2>
                            <div id="f7" class="accordion-collapse collapse" data-bs-parent="#welcomeFaq">
                                <div class="accordion-body">
                                    The Staff Group Chat is a built-in real-time messaging panel available to all institute staff — Admin, Teachers, Principal, and Receptionist. You can send messages, @mention specific colleagues, and collaborate without leaving EduNex. It's fully isolated per institute.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f8">
                                    How long does it take to set up EduNex?
                                </button>
                            </h2>
                            <div id="f8" class="accordion-collapse collapse" data-bs-parent="#welcomeFaq">
                                <div class="accordion-body">
                                    Most institutes are fully operational within 30 minutes. Create your account, add your batches and subjects, bulk-import your students via CSV, and you're live. Our support team is also available to assist with onboarding at no extra cost.
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
            <div class="cta-card shadow-lg animate__animated animate__fadeIn glass-dark">
                <h2 class="text-white fw-black display-5 mb-4 position-relative z-1">Ready to lead your
                    institute<br>into the digital age?</h2>
                <p class="text-white-50 fs-5 mb-5 mx-auto position-relative z-1" style="max-width: 600px;">
                    Join over 100 institutes that have already automated their operations with EduNex. Start your 7-day
                    free trial today.
                </p>
                <div class="position-relative z-1">
                    <a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern px-5 py-3">Get Started Today
                        <i class="fas fa-rocket ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <x-frontend-footer/>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function switchPortal(portal) {
            // Update buttons
            document.querySelectorAll('.portal-nav-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.innerText.toLowerCase().includes(portal)) {
                    btn.classList.add('active');
                }
            });

            // Update content
            document.querySelectorAll('.portal-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(portal + '-portal').classList.add('active');
        }
    </script>

    @include('components.whatsapp-widget')

</body>

</html>