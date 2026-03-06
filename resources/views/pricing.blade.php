<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing — EduNex</title>
    <meta name="description" content="Simple, transparent pricing for EduNex institute management software. One powerful plan, no hidden fees.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-light: #6366F1;
            --secondary-color: #EC4899;
            --dark-bg: #0F172A;
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
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        /* ── HERO ── */
        .page-header {
            padding: 180px 0 100px;
            position: relative;
        }
        .section-tag {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 20%;
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
        .hero-sub { font-size: 1.25rem; color: var(--text-muted); line-height: 1.7; max-width: 500px; }

        /* ── PRICING CARD ── */
        .plan-card {
            background: #ffffff;
            border-radius: 36px;
            border: 1px solid var(--border-color);
            padding: 60px;
            position: relative;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 40px 100px -30px rgba(0,0,0,0.1);
        }
        .plan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 50px 120px -30px rgba(79, 70, 229, 0.15);
            border-color: var(--primary-color);
        }
        .plan-badge {
            position: absolute; top: -16px; left: 50%; transform: translateX(-50%);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: #fff; font-size: 0.75rem; font-weight: 800;
            padding: 6px 20px; border-radius: 50px;
            text-transform: uppercase; letter-spacing: 1px;
            box-shadow: 0 10px 20px -5px rgba(236, 72, 153, 0.4);
        }
        .plan-name { font-size: 0.9rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; color: var(--text-muted); margin-bottom: 10px; }
        .plan-headline { font-size: 1.75rem; font-weight: 900; color: var(--dark-bg); margin-bottom: 30px; letter-spacing: -0.5px; }
        
        .feature-list { list-style: none; padding: 0; margin: 0 0 40px; }
        .feature-list li {
            display: flex; align-items: flex-start; gap: 15px;
            font-size: 1rem; color: var(--text-main);
            padding: 12px 0;
            border-bottom: 1px solid #F8FAFC;
        }
        .feature-list li:last-child { border-bottom: none; }
        .feature-list li i { color: #10B981; font-size: 1.1rem; margin-top: 4px; }
        
        .plan-cta {
            display: block; width: 100%; text-align: center;
            padding: 18px 30px; border-radius: 20px;
            font-weight: 800; font-size: 1.1rem;
            text-decoration: none; transition: all 0.3s;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: #fff;
            box-shadow: 0 10px 30px -5px rgba(79, 70, 229, 0.4);
        }
        .plan-cta:hover { transform: translateY(-3px); box-shadow: 0 15px 40px -5px rgba(79, 70, 229, 0.5); color: #fff; }

        /* ── TRUST STRIP ── */
        .trust-strip { background: var(--dark-bg); padding: 24px 0; border-radius: 0; }
        .trust-item { display: flex; align-items: center; gap: 10px; color: rgba(255,255,255,0.7); font-weight: 600; font-size: 0.85rem; }
        .trust-item i { color: #10B981; }

        /* ── FAQ ── */
        .accordion-item {
            border: 1px solid var(--border-color) !important;
            border-radius: 20px !important;
            margin-bottom: 12px;
            overflow: hidden;
            background: #fff;
        }
        .accordion-button { padding: 24px; font-weight: 700; color: var(--dark-bg); }
        .accordion-button:not(.collapsed) { background: #EEF2FF; color: var(--primary-color); }

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

    @include('components.frontend-navbar')

    {{-- ── HERO ── --}}
    <header class="page-header">
        <div class="container px-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-tag animate__animated animate__fadeInDown">Simple Transparent Model</span>
                    <h1 class="hero-title animate__animated animate__zoomIn">
                        Everything you need.<br>
                        <span>Without complexity.</span>
                    </h1>
                    <p class="hero-sub animate__animated animate__fadeInUp animate__delay-1s">
                        We don't believe in charging per student or gating features. You get the complete, unlimited EduNex platform for your entire institute.
                    </p>
                    <div class="d-flex gap-4 flex-wrap mt-5 animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="d-flex align-items-center gap-2 small fw-bold text-muted">
                            <i class="fas fa-check-circle text-success"></i> 7-day free trial
                        </div>
                        <div class="d-flex align-items-center gap-2 small fw-bold text-muted">
                            <i class="fas fa-check-circle text-success"></i> No setup fees
                        </div>
                        <div class="d-flex align-items-center gap-2 small fw-bold text-muted">
                            <i class="fas fa-check-circle text-success"></i> Unlimited everything
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    @forelse($plans as $plan)
                    <div class="plan-card animate__animated animate__fadeInRight animate__delay-1s">
                        <div class="plan-badge">⭐ Recommended</div>
                        <div class="plan-name">{{ $plan->name }}</div>
                        <h2 class="plan-headline">The Professional Edition</h2>
                        
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> <span><strong>Unlimited Students</strong> — grow without extra costs</span></li>
                            <li><i class="fas fa-check-circle"></i> <span><strong>Smart Fee Tracking</strong> & automated reminders</span></li>
                            <li><i class="fas fa-check-circle"></i> <span><strong>Live Class Integration</strong> (Jitsi Conferencing)</span></li>
                            <li><i class="fas fa-check-circle"></i> <span><strong>Staff Management</strong> with custom permissions</span></li>
                            <li><i class="fas fa-check-circle"></i> <span><strong>Interactive Student Portal</strong> (PWA Support)</span></li>
                            <li><i class="fas fa-check-circle"></i> <span><strong>Automated PDF Reports</strong> for all metrics</span></li>
                        </ul>
                        
                        <a href="{{ route('trial.request', ['plan' => $plan->name]) }}" class="plan-cta">
                            Start Your Free Trial
                        </a>
                        <p class="text-center text-muted small mt-3 fw-bold">Cancel at any time. No card required.</p>
                    </div>
                    @empty
                    <div class="alert border-0 shadow-sm rounded-4 p-5 text-center" style="background:#F1F5F9;">
                        <i class="fas fa-clock fa-2x mb-3 text-muted"></i>
                        <h5 class="fw-bold">Contact us for custom setup</h5>
                        <p class="mb-0 small text-muted">We're currently scaling our infrastructure for new institutes.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </header>

    {{-- ── TRUST STRIP ── --}}
    <div class="trust-strip">
        <div class="container px-4">
            <div class="d-flex align-items-center justify-content-center gap-5 flex-wrap">
                <div class="trust-item"><i class="fas fa-lock"></i> SSL Encrypted</div>
                <div class="trust-item"><i class="fas fa-cloud"></i> 99.9% Cloud Uptime</div>
                <div class="trust-item"><i class="fas fa-headset"></i> Dedicated Support</div>
                <div class="trust-item"><i class="fas fa-shield-alt"></i> Data Isolation</div>
            </div>
        </div>
    </div>

    {{-- ── FAQ ── --}}
    <section class="py-5 bg-light">
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
                            ['q'=>'What happens after the 7-day trial?', 'a'=>'You can choose to continue by subscribing to our flat monthly plan. If you decide not to continue, your data remains secure but the portal features will be restricted.'],
                            ['q'=>'Can I upgrade or downgrade?', 'a'=>'We offer a single comprehensive plan that includes everything. There are no tiers to worry about — you always have the best version of EduNex.'],
                            ['q'=>'Is there any limit student enrollment?', 'a'=>'Absolutely not. Our core philosophy is that your growth shouldn\'t cost you more. Enroll 10 or 10,000 students — the price stays exactly the same.'],
                            ['q'=>'How do I get my data if I cancel?', 'a'=>'You can export your student records, payment history, and attendance logs to CSV/PDF at any time from your admin dashboard.'],
                        ];
                        @endphp
                        @foreach($faqs as $i => $faq)
                        <div class="accordion-item shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#pq{{ $i }}">
                                    {{ $faq['q'] }}
                                </button>
                            </h2>
                            <div id="pq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#pricingFaq">
                                <div class="accordion-body">{{ $faq['a'] }}</div>
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
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex" style="max-height: 50px;" class="me-2">
                    </div>
                    <p class="text-muted small mb-4">The ultimate SaaS platform for modern educational institutes. Built by educators, for educators.</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
