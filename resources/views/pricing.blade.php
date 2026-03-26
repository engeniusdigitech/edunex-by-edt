<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="Best Education Management Software Pricing & Institute ERP Plans | EduNex" description="Scalable, transparent pricing for the #1 institute management system. Get a custom quote for our premier education management software." />
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

        /* ── PRICING CARD ── */
        .plan-card {
            background: #ffffff;
            border-radius: 40px;
            border: 1px solid rgba(0,0,0,0.05);
            padding: 60px;
            position: relative;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 20px 60px -10px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .plan-card.recommended {
            border: 2px solid var(--primary-color);
            transform: scale(1.05);
            z-index: 2;
        }

        .plan-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 50px 100px -20px rgba(79, 70, 229, 0.12);
        }

        .plan-badge {
            position: absolute;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 8px 24px;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 10px 20px -5px rgba(236, 72, 153, 0.4);
        }

        .plan-price {
            font-size: 2.5rem;
            font-weight: 950;
            color: var(--dark-bg);
            letter-spacing: -2px;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 40px 0;
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
            padding: 20px 30px;
            border-radius: 24px;
            font-weight: 800;
            font-size: 1.15rem;
            text-decoration: none;
            transition: all 0.4s;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            box-shadow: 0 15px 30px -5px rgba(79, 70, 229, 0.4);
        }

        .plan-cta:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 45px -5px rgba(79, 70, 229, 0.5);
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

        /* ── FAQ MODERNIZE ── */
        .accordion-item {
            border: none !important;
            border-radius: 28px !important;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.6) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .accordion-item:hover {
            transform: translateX(10px);
            background: #fff !important;
        }

        .accordion-button {
            padding: 30px;
            font-weight: 800;
            color: var(--dark-bg);
            font-size: 1.1rem;
            border-radius: 28px !important;
            background: transparent !important;
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            color: var(--primary-color);
        }

        .accordion-body {
            padding: 0 30px 30px;
            color: var(--text-muted);
            font-weight: 500;
            line-height: 1.7;
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
          "name": "What happens after the 7-day trial?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "You can choose to continue using EduNex for your institute. If you decide not to continue, your data remains secure but the portal features will be restricted."
          }
        },
        {
          "@type": "Question",
          "name": "Are there any hidden limits?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "We offer a single comprehensive platform that includes everything. There are no feature tiers to worry about — you always have the best version of EduNex."
          }
        },
        {
          "@type": "Question",
          "name": "Is there a setup fee?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Zero. No onboarding fees, no implementation fees."
          }
        },
        {
          "@type": "Question",
          "name": "How does onboarding work?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Once you start your trial, our team provides full support to help you import your existing data and set up your institute seamlessly."
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
    </div>

    <!-- Navigation -->
    @include('components.frontend-navbar')

    <!-- Page Header -->
    <header class="page-header text-center pb-0">
        <div class="container px-4">
            <span class="section-tag animate__animated animate__fadeInDown">Global Access</span>
            <h1 class="hero-title animate__animated animate__zoomIn">
                Simple, transparent<br>
                <span>one plan for all.</span>
            </h1>
            <p class="text-muted fs-5 mt-4 mx-auto animate__animated animate__fadeInUp animate__delay-1s"
                style="max-width: 600px; font-weight: 500;">
                Get the complete, unlimited <strong>institute software</strong> platform for your entire institute. No hidden fees, no gating features.
            </p>
        </div>
    </header>

    <!-- Pricing Section -->
    <section class="py-5">
        <div class="container px-4">
            
            <div class="row justify-content-center align-items-center g-4">
                <div class="col-lg-7">
                    <div class="plan-card recommended animate__animated animate__fadeInUp animate__delay-1s">
                        <div class="plan-badge">⭐ Recommended</div>
                        
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h2 class="fw-black text-dark mb-1" style="letter-spacing: -1px;">Professional Plan</h2>
                                <p class="text-muted small fw-bold text-uppercase ls-1">Unlimited Scale</p>
                            </div>
                        </div>

                        <p class="text-muted mb-5 fw-500">Transform your institute with our most powerful platform. Dedicated for growth-minded centers.</p>

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <ul class="feature-list m-0 p-0" style="border:none;">
                                    <li><i class="fas fa-check-circle"></i> Smart Fee Tracking</li>
                                    <li><i class="fas fa-check-circle"></i> Live Class Integration</li>
                                    <li><i class="fas fa-check-circle"></i> Staff Management</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list m-0 p-0" style="border:none;">
                                    <li><i class="fas fa-check-circle"></i> Student Portal (PWA)</li>
                                    <li><i class="fas fa-check-circle"></i> Custom PDF Reports</li>
                                    <li><i class="fas fa-check-circle"></i> 24/7 Priority Support</li>
                                </ul>
                            </div>
                        </div>

                        <a href="{{ route('trial.request') }}" class="plan-cta">
                            Get Best Quote
                        </a>
                        <p class="text-center text-muted small mt-4 mb-0 fw-600">Enterprise-grade features. 24/7 dedicated support.</p>
                    </div>
                </div>

                <div class="col-lg-5 ps-lg-5 mt-5 mt-lg-0 animate__animated animate__fadeInRight animate__delay-2s">
                    <div class="p-4 rounded-4" style="background: rgba(79, 70, 229, 0.03); border: 1px dashed rgba(79, 70, 229, 0.2);">
                        <h4 class="fw-black mb-3">Enterprise Needs?</h4>
                        <p class="text-muted mb-4 small">Looking for multi-branch setups or custom feature development for large-scale franchises?</p>
                        <a href="{{ route('contact') }}" class="btn btn-dark btn-modern w-100 py-3">Talk to our Experts</a>

                        <div class="mt-5 border-top pt-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-primary text-white rounded-circle p-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <span class="small fw-700">Enterprise Grade Security</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-primary text-white rounded-circle p-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem;">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <span class="small fw-700">Instant Setup (Under 2 mins)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Strip -->
    <section class="py-5" style="background: #f8fafc; border-top: 1px solid #e2e8f0;">
        <div class="container px-4">
            <div class="row row-cols-2 row-cols-md-4 g-4 text-center">
                <div class="col">
                    <h6 class="text-muted text-uppercase ls-2 mb-2" style="font-size: 0.7rem;">Uptime</h6>
                    <h4 class="fw-black">99.9%</h4>
                </div>
                <div class="col">
                    <h6 class="text-muted text-uppercase ls-2 mb-2" style="font-size: 0.7rem;">Support</h6>
                    <h4 class="fw-black">24/7</h4>
                </div>
                <div class="col">
                    <h6 class="text-muted text-uppercase ls-2 mb-2" style="font-size: 0.7rem;">Institutes</h6>
                    <h4 class="fw-black">150+</h4>
                </div>
                <div class="col">
                    <h6 class="text-muted text-uppercase ls-2 mb-2" style="font-size: 0.7rem;">Feedback</h6>
                    <h4 class="fw-black">4.9/5</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container px-4 py-5">
            <div class="text-center mb-5">
                <span class="section-tag">Transparency</span>
                <h2 class="fw-black display-6" style="letter-spacing: -2px;">Frequently Asked Questions</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
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
                            <div class="accordion-item animate__animated animate__fadeInUp" style="animation-delay: {{ $i * 0.1 }}s">
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

    <x-frontend-footer />

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('components.whatsapp-widget')
</body>

</html>