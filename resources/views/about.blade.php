<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="Best Education Management Software & Institute ERP Vision | EduNex" description="Learn about the mission driving EduNex, the top education management system and institute management software designed for modern educational centers." />
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

        /* ── STORY SECTION ── */
        .story-img-container {
            position: relative;
            padding: 20px;
        }

        .story-img {
            border-radius: 48px;
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.15);
            border: 8px solid #fff;
        }

        /* ── VISION/MISSION CARDS ── */
        .vision-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 40px;
            padding: 60px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            height: 100%;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 20px 60px -10px rgba(0, 0, 0, 0.05);
        }

        .vision-card:hover {
            transform: translateY(-12px);
            border-color: var(--primary-color);
            box-shadow: 0 40px 100px -20px rgba(79, 70, 229, 0.12);
        }

        .icon-box {
            width: 72px;
            height: 72px;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px -5px rgba(0,0,0,0.1);
        }

        /* ── CORE VALUES ── */
        .value-item {
            display: flex;
            gap: 24px;
            margin-bottom: 40px;
        }

        .value-icon {
            flex-shrink: 0;
            width: 56px;
            height: 56px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1), rgba(236, 72, 153, 0.1));
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        /* ── BRAND FOCUS (Engenius) ── */
        .brand-focus {
            background: linear-gradient(165deg, #0f172a 0%, #1e1b4b 100%);
            border-radius: 56px;
            padding: 80px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 40px 100px -20px rgba(15, 23, 42, 0.3);
        }

        .brand-focus::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: var(--primary-color);
            filter: blur(150px);
            opacity: 0.1;
            bottom: -200px;
            left: -200px;
        }
    </style>
</head>

<body>

    <div class="mesh-bg">
        <div class="mesh-circle-1"></div>
        <div class="mesh-circle-2"></div>
    </div>

    <!-- Navigation -->
    @include('components.frontend-navbar')

    <!-- Page Header -->
    <header class="page-header text-center">
        <div class="container px-4">
            <span class="section-tag animate__animated animate__fadeInDown">Dedicated to Excellence</span>
            <h1 class="page-title animate__animated animate__zoomIn">
                We're building the future of<br>
                <span>educational technology.</span>
            </h1>
            <p class="text-muted fs-5 mt-4 max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s"
                style="max-width: 700px;">
                EduNex is more than just software. It's a commitment to streamlining operations, empowering teachers,
                and enriching the student experience.
            </p>
        </div>
    </header>

    <!-- Our Story Section -->
    <!-- Our Story Section -->
    <section class="py-5 mb-5">
        <div class="container px-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="story-img-container animate__animated animate__fadeInLeft">
                        <img src="{{ asset('images/about-us.jpg') }}" alt="Our Team" class="img-fluid story-img">
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight ps-lg-5">
                    <span class="section-tag">Our History</span>
                    <h2 class="fw-black mb-4 display-6" style="letter-spacing: -2px;">Best Education Management System Vision.</h2>
                    <p class="text-muted mb-4 fs-5 fw-500">At <strong>Engenius Digitech</strong>, we observed the administrative struggles of hundreds of coaching centers, academies, and schools. Manual fee tracking, fragmented attendance logs, and poor student communication were holding educators back.</p>
                    <p class="text-muted mb-4 fw-500">We decided to build the ultimate <strong>education management software</strong> that solves these problems once and for all. EduNex was crafted with a "premium-first" approach — ensuring that enterprise-grade power is accessible to every institute, regardless of size.</p>

                    <div class="row g-4 mt-3">
                        <div class="col-sm-6">
                            <h4 class="fw-black mb-1 text-primary">100%</h4>
                            <p class="small text-muted mb-0 fw-bold">Client-Focused Approach</p>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="fw-black mb-1 text-primary">24/7</h4>
                            <p class="small text-muted mb-0 fw-bold">Platform Monitoring</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-5 bg-light" style="border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
        <div class="container px-4 py-5">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="vision-card">
                        <div class="icon-box" style="background: #EEF2FF; color: #4F46E5;">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="fw-black mb-3" style="letter-spacing: -1px;">Our Vision</h3>
                        <p class="text-muted mb-0 fs-5 lh-base fw-500">To be the global gold standard for educational operations, where technology acts as a silent partner in the classroom, letting teachers focus entirely on teaching.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vision-card">
                        <div class="icon-box" style="background: #FDF2F8; color: #DB2777;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="fw-black mb-3" style="letter-spacing: -1px;">Our Mission</h3>
                        <p class="text-muted mb-0 fs-5 lh-base fw-500">To simplify institute management through beautiful design and powerful automation, making administrative excellence achievable for every educator on the planet.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values & Focus -->
    <section class="py-5 mt-4">
        <div class="container px-4 py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <span class="section-tag">Core Values</span>
                    <h2 class="fw-black mb-4 display-6" style="letter-spacing: -2px;">What drives us every day.</h2>
                    <p class="text-muted mb-5 fw-500">Our principles are the foundation of everything we build. We don't just ship code; we ship solutions that matter.</p>

                    <div class="value-item">
                        <div class="value-icon"><i class="fas fa-heart"></i></div>
                        <div>
                            <h5 class="fw-black mb-1">Empathy for Educators</h5>
                            <p class="text-muted small fw-500">We listen to the daily struggles of teachers and owners to build features that actually save time.</p>
                        </div>
                    </div>
                    <div class="value-item">
                        <div class="value-icon"><i class="fas fa-shield-halved"></i></div>
                        <div>
                            <h5 class="fw-black mb-1">Security by Default</h5>
                            <p class="text-muted small fw-500">We treat your institute's data with the same level of security as financial institutions do.</p>
                        </div>
                    </div>
                    <div class="value-item">
                        <div class="value-icon"><i class="fas fa-bolt"></i></div>
                        <div>
                            <h5 class="fw-black mb-1">Relentless Innovation</h5>
                            <p class="text-muted small fw-500">We're never "done." We continuously push updates to make EduNex faster and more capable.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="brand-focus animate__animated animate__fadeIn">
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex"
                            style="height: 50px; filter: brightness(0) invert(1);" class="mb-5">
                        <h2 class="fw-black mb-4">A product by Engenius Digitech</h2>
                        <p class="text-white-50 mb-4 fs-5">EduNex is the flagship product of <strong>Engenius Digitech</strong>, a specialized software agency dedicated to crafting premium digital experiences.</p>
                        <p class="text-white-50 mb-5">When you choose EduNex, you're not just getting a tool; you're getting the support of a senior team of designers and developers who are passionate about scaling your business.</p>

                        <a href="https://engeniusdigitech.com" target="_blank"
                            class="btn btn-light btn-modern fw-bold px-5 py-3 shadow-lg">
                            Explore our Portfolio <i class="fas fa-external-link-alt ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-5 my-5">
        <div class="container px-4 py-5 text-center">
            <h2 class="fw-black mb-4 display-5" style="letter-spacing: -3px;">Join the digital revolution.</h2>
            <p class="text-muted mb-5 mx-auto fs-5 fw-500" style="max-width: 500px;">Experience the easiest way to manage your students, staff, and finances in one place.</p>
            <a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern px-5 py-3 shadow-lg">View Pricing Plans <i
                    class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </section>

    <x-frontend-footer />

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('components.whatsapp-widget')
</body>

</html>