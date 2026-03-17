<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing — EduNex</title>
    <meta name="description"
        content="Simple, transparent pricing for EduNex institute management software. One powerful plan, no hidden fees.">
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
        /* ── HERO ── */
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

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            letter-spacing: -2px;
            line-height: 1.1;
            color: var(--dark-bg);
            margin-bottom: 24px;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-sub {
            font-size: 1.25rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 500px;
        }

        /* ── PRICING CARD ── */
        .plan-card {
            background: #ffffff;
            border-radius: 36px;
            border: 1px solid var(--border-color);
            padding: 60px;
            position: relative;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 40px 100px -30px rgba(0, 0, 0, 0.1);
        }

        .plan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 50px 120px -30px rgba(79, 70, 229, 0.15);
            border-color: var(--primary-color);
        }

        .plan-badge {
            position: absolute;
            top: -16px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 6px 20px;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 20px -5px rgba(236, 72, 153, 0.4);
        }

        .plan-name {
            font-size: 0.9rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .plan-headline {
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--dark-bg);
            margin-bottom: 30px;
            letter-spacing: -0.5px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0 0 40px;
        }

        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            font-size: 1rem;
            color: var(--text-main);
            padding: 12px 0;
            border-bottom: 1px solid #F8FAFC;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-list li i {
            color: #10B981;
            font-size: 1.1rem;
            margin-top: 4px;
        }

        .plan-cta {
            display: block;
            width: 100%;
            text-align: center;
            padding: 18px 30px;
            border-radius: 20px;
            font-weight: 800;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: #fff;
            box-shadow: 0 10px 30px -5px rgba(79, 70, 229, 0.4);
        }

        .plan-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px -5px rgba(79, 70, 229, 0.5);
            color: #fff;
        }

        /* ── TRUST STRIP ── */
        .trust-strip {
            background: var(--dark-bg);
            padding: 24px 0;
            border-radius: 0;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            font-size: 0.85rem;
        }

        .trust-item i {
            color: #10B981;
        }

        /* ── FAQ ── */
        .accordion-item {
            border: 1px solid var(--border-color) !important;
            border-radius: 20px !important;
            margin-bottom: 12px;
            overflow: hidden;
            background: #fff;
        }

        .accordion-button {
            padding: 24px;
            font-weight: 700;
            color: var(--dark-bg);
            border-radius: 0 !important;
        }

        .accordion-button:not(.collapsed) {
            background: #EEF2FF;
            color: var(--primary-color);
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
            <span class="section-tag animate__animated animate__fadeInDown">Trial & Access</span>
            <h1 class="hero-title animate__animated animate__zoomIn">
                Unlock your institute's<br>
                <span>True Potential.</span>
            </h1>
            <p class="text-muted fs-5 mt-4 max-w-xl mx-auto animate__animated animate__fadeInUp animate__delay-1s"
                style="max-width: 600px;">
                Get the complete, unlimited EduNex platform for your entire institute. No gating features, no arbitrary
                limits.
            </p>
        </div>
    </header>

    <!-- Pricing Section -->
    <section class="py-5">
        <div class="container px-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 animate__animated animate__fadeInLeft">
                    <h2 class="fw-black mb-4 display-6">Everything you need<br>to manage and grow.</h2>
                    <ul class="feature-list mb-5">
                        <li><i class="fas fa-check-circle"></i> <span><strong>Smart Fee Tracking</strong> &
                                reminders</span></li>
                        <li><i class="fas fa-check-circle"></i> <span><strong>Live Class Integration</strong> (Jitsi
                                Conferencing)</span></li>
                        <li><i class="fas fa-check-circle"></i> <span><strong>Staff Management</strong> with custom
                                permissions</span></li>
                        <li><i class="fas fa-check-circle"></i> <span><strong>Interactive Student Portal</strong> (PWA
                                Support)</span></li>
                        <li><i class="fas fa-check-circle"></i> <span><strong>Automated PDF Reports</strong> for all
                                metrics</span></li>
                    </ul>
                    <a href="{{ route('trial.request') }}" class="btn btn-outline-modern btn-lg px-5 py-3">Start Your
                        Free Trial</a>
                </div>

                <div class="col-lg-6 offset-lg-1">
                    <div class="plan-card animate__animated animate__fadeInRight animate__delay-1s">
                        <div class="plan-badge">⭐ Recommended</div>
                        <div class="plan-name">The Complete Platform</div>
                        <h2 class="plan-headline">EduNex Professional</h2>

                        <div class="d-flex align-items-baseline gap-2 mb-4">
                            <span class="display-5 fw-black text-dark">Full Access</span>
                        </div>

                        <p class="text-muted mb-4">Get full access to all features with no student limits and 24/7
                            dedicated support.</p>

                        <a href="{{ route('trial.request') }}" class="plan-cta">
                            Start 7-Day Free Trial
                        </a>
                        <p class="text-center text-muted small mt-4 mb-0">No credit card required to start.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Strip -->
    <section class="trust-strip mt-5">
        <div class="container px-4">
            <div class="row justify-content-center g-4">
                <div class="col-auto">
                    <div class="trust-item"><i class="fas fa-lock"></i> SSL Encrypted</div>
                </div>
                <div class="col-auto">
                    <div class="trust-item"><i class="fas fa-cloud"></i> 99.9% Cloud Uptime</div>
                </div>
                <div class="col-auto">
                    <div class="trust-item"><i class="fas fa-headset"></i> Dedicated Support</div>
                </div>
                <div class="col-auto">
                    <div class="trust-item"><i class="fas fa-database"></i> Data Isolation</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 mt-5">
        <div class="container px-4 py-5">
            <div class="text-center mb-5">
                <span class="section-tag">Common Questions</span>
                <h2 class="fw-black display-6">Pricing & Access FAQ</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="pricingFaq">
                        @php
                            $faqs = [
                                ['q' => 'What happens after the 7-day trial?', 'a' => 'You can choose to continue using EduNex for your institute. If you decide not to continue, your data remains secure but the portal features will be restricted.'],
                                ['q' => 'Are there any hidden limits?', 'a' => 'We offer a single comprehensive platform that includes everything. There are no feature tiers to worry about — you always have the best version of EduNex.'],
                                ['q' => 'Is there a setup fee?', 'a' => 'Zero. No onboarding fees, no implementation fees.'],
                                ['q' => 'How does onboarding work?', 'a' => 'Once you start your trial, our team provides full support to help you import your existing data and set up your institute seamlessly.']
                            ];
                        @endphp

                        @foreach($faqs as $i => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $i === 0 ? '' : 'collapsed' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#pq{{ $i }}">
                                        {{ $faq['q'] }}
                                    </button>
                                </h2>
                                <div id="pq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                                    data-bs-parent="#pricingFaq">
                                    <div class="accordion-body">
                                        {{ $faq['a'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                    <p class="text-muted small mb-4">The ultimate SaaS platform for modern educational institutes. Built
                        by educators, for educators.</p>
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
                    </ul>
                </div>
                <div class="col-md-4 col-lg-4 text-md-end">
                    <h6 class="fw-bold mb-4">Product by</h6>
                    <h5 class="fw-black text-dark mb-1">Engenius Digitech</h5>
                    <p class="text-muted small">Specialized in SaaS solutions</p>
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