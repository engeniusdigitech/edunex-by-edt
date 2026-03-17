<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us — EduNex & Engenius Digitech</title>
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
            padding: 126px 0 100px;
            position: relative;
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

        .page-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            letter-spacing: -2px;
            color: var(--dark-bg);
            line-height: 1.1;
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

        .story-img-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            border-top: 5px solid var(--primary-color);
            border-left: 5px solid var(--primary-color);
            border-radius: 20px 0 0 0;
        }

        .story-img-container::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100px;
            height: 100px;
            border-bottom: 5px solid var(--secondary-color);
            border-right: 5px solid var(--secondary-color);
            border-radius: 0 0 20px 0;
        }

        .story-img {
            border-radius: 30px;
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.15);
        }

        /* ── VISION/MISSION CARDS ── */
        .vision-card {
            background: #ffffff;
            border-radius: 32px;
            padding: 50px;
            border: 1px solid var(--border-color);
            height: 100%;
            transition: all 0.4s ease;
        }

        .vision-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
            transform: translateY(-5px);
        }

        .icon-box {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 30px;
        }

        /* ── CORE VALUES ── */
        .value-item {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .value-icon {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* ── BRAND FOCUS (Engenius) ── */
        .brand-focus {
            background: var(--dark-bg);
            border-radius: 40px;
            padding: 80px 60px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .brand-focus::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.08), transparent 70%);
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
    <section class="py-5">
        <div class="container px-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="story-img-container animate__animated animate__fadeInLeft">
                        <img src="{{ asset('images/about-us.jpg') }}" alt="Our Team" class="img-fluid story-img">
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeInRight">
                    <span class="section-tag">Our History</span>
                    <h2 class="fw-black mb-4 display-6">Born out of necessity.</h2>
                    <p class="text-muted mb-4 fs-5">At <strong>Engenius Digitech</strong>, we observed the
                        administrative struggles of hundreds of coaching centers and schools. Manual fee tracking,
                        fragmented attendance logs, and poor student communication were holding educators back.</p>
                    <p class="text-muted mb-4">We decided to build a platform that solves these problems once and for
                        all. EduNex was crafted with a "premium-first" approach — ensuring that enterprise-grade power
                        is accessible to every institute, regardless of size.</p>

                    <div class="row g-4 mt-2">
                        <div class="col-sm-6">
                            <h4 class="fw-bold mb-1">100%</h4>
                            <p class="small text-muted mb-0">Client-Focused Approach</p>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="fw-bold mb-1">24/7</h4>
                            <p class="small text-muted mb-0">Platform Monitoring</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-5 bg-light">
        <div class="container px-4 py-5">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="vision-card">
                        <div class="icon-box" style="background: #EEF2FF; color: #4F46E5;">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Our Vision</h3>
                        <p class="text-muted mb-0 fs-5 lh-base">To be the global gold standard for educational
                            operations, where technology acts as a silent partner in the classroom, letting teachers
                            focus entirely on teaching.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vision-card">
                        <div class="icon-box" style="background: #FDF2F8; color: #DB2777;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Our Mission</h3>
                        <p class="text-muted mb-0 fs-5 lh-base">To simplify institute management through beautiful
                            design and powerful automation, making administrative excellence achievable for every
                            educator on the planet.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values & Focus -->
    <section class="py-5">
        <div class="container px-4 py-5">
            <div class="row g-5">
                <div class="col-lg-5">
                    <span class="section-tag">Core Values</span>
                    <h2 class="fw-black mb-4 display-6">What drives us every single day.</h2>
                    <p class="text-muted mb-5">Our principles are the foundation of everything we build. We don't just
                        ship code; we ship solutions that matter.</p>

                    <div class="value-item">
                        <div class="value-icon"><i class="fas fa-heart"></i></div>
                        <div>
                            <h5 class="fw-bold">Empathy for Educators</h5>
                            <p class="text-muted small">We listen to the daily struggles of teachers and owners to build
                                features that actualy save time.</p>
                        </div>
                    </div>
                    <div class="value-item">
                        <div class="value-icon"><i class="fas fa-shield-halved"></i></div>
                        <div>
                            <h5 class="fw-bold">Security by Default</h5>
                            <p class="text-muted small">We treat your institute's data with the same level of security
                                as financial institutions do.</p>
                        </div>
                    </div>
                    <div class="value-item">
                        <div class="value-icon"><i class="fas fa-bolt"></i></div>
                        <div>
                            <h5 class="fw-bold">Relentless Innovation</h5>
                            <p class="text-muted small">We're never "done." We continuously push updates to make EduNex
                                faster and more capable.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="brand-focus animate__animated animate__fadeIn">
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex"
                            style="height: 50px; filter: brightness(0) invert(1);" class="mb-4">
                        <h3 class="fw-black mb-4">A product by Engenius Digitech</h3>
                        <p class="text-white-50 mb-4 fs-5">EduNex is the flagship product of <strong>Engenius
                                Digitech</strong>, a specialized software agency dedicated to crafting premium digital
                            experiences.</p>
                        <p class="text-white-50 mb-5">When you choose EduNex, you're not just getting a tool; you're
                            getting the support of a senior team of designers and developers who are passionate about
                            scaling your business.</p>

                        <a href="https://engeniusdigitech.netlify.app/" target="_blank"
                            class="btn btn-light btn-modern fw-bold px-4">
                            Explore Engenius Digitech <i class="fas fa-external-link-alt ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-5">
        <div class="container px-4 py-5 text-center">
            <h2 class="fw-black mb-4 display-5">Join the digital revolution.</h2>
            <p class="text-muted mb-5 mx-auto" style="max-width: 500px;">Experience the easiest way to manage your
                students, staff, and finances in one place.</p>
            <a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern px-5 py-3">View Pricing Plans <i
                    class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container px-4">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex" style="max-height: 50px;" class="me-2">
                    </div>
                    <p class="text-muted small mb-4">The ultimate SaaS platform for modern educational institutes. Built
                        by educators, for educators.</p>
                    <div class="d-flex gap-3">
                        <a href="https://www.linkedin.com/company/engenius-digitech/?viewAsMember=true" target="_blank"
                            class="footer-link fs-5"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h6 class="fw-bold mb-4">Platform</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}#features" class="footer-link small">Features</a></li>
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
    @include('components.whatsapp-widget')
</body>

</html>