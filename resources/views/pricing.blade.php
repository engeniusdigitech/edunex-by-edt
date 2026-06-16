<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="School Management Software Pricing | Institute ERP Plans & Free Trial — EduNex ERP" description="EduNex ERP offers affordable, transparent pricing for school management software and institute ERP. Choose from Basic, Premium, Premium + Mobile, or Custom plans. Start a 7-day free trial." keywords="school management software price, institute ERP pricing, school software cost, best school management software, school ERP subscription, affordable institute software, school management system pricing, coaching class software pricing, EduNex ERP pricing, school software free trial" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')
    
    @verbatim
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "What is the difference between the Premium and Premium + Mobile App plans?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "The Premium + Mobile App plan includes a custom-branded mobile app for your school on Android and iOS stores, enabling direct push notifications, live-chat with teachers, and dedicated account management, alongside all Premium ERP features."
          }
        },
        {
          "@type": "Question",
          "name": "What happens after the 7-day trial?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "You can choose to subscribe to any of our 4 pricing plans. If you decide not to proceed, your data remains secure but access to ERP services will be restricted."
          }
        },
        {
          "@type": "Question",
          "name": "Are there setup or implementation fees?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "There are zero hidden setup fees for Basic, Premium, and Premium + Mobile App plans. We assist with initial remote onboarding and data imports for free."
          }
        },
        {
          "@type": "Question",
          "name": "Can I upgrade or downgrade my plan later?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, you can upgrade, downgrade, or cancel your subscription at any time. Pricing will be prorated accordingly."
          }
        }
      ]
    }
    </script>
    @endverbatim

<style>
*,*::before,*::after{box-sizing:border-box;}
body {
    font-family:'Inter',system-ui,sans-serif;
    background:hsl(222,47%,6%);
    color:hsl(210,40%,98%);
    overflow-x:hidden;
    -webkit-font-smoothing:antialiased;
}
:root{
    --bg:hsl(222,47%,6%);
    --card:hsl(222,47%,8%);
    --border:hsl(217,33%,17%);
    --muted:hsl(215,20%,65%);
    --primary:hsl(174,72%,56%);
    --secondary:hsl(217,91%,60%);
    --gradient:linear-gradient(135deg,hsl(174,72%,56%),hsl(217,91%,60%));
}
section{background:transparent!important;}
.g-text{background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}

/* Hero */
.pricing-hero{
    padding:120px 0 60px;
    text-align:center;position:relative;overflow:hidden;
}
.pricing-hero::before{
    content:'';position:absolute;top:-200px;left:50%;transform:translateX(-50%);
    width:800px;height:550px;
    background:radial-gradient(ellipse,hsla(217,91%,60%,0.15) 0%,transparent 70%);
    pointer-events:none;
}
.eyebrow{
    display:inline-flex;align-items:center;gap:7px;
    background:hsla(174,72%,56%,0.1);border:1px solid hsla(174,72%,56%,0.22);
    border-radius:9999px;padding:6px 16px;
    font-size:0.72rem;font-weight:600;color:hsl(174,72%,70%);
    text-transform:uppercase;letter-spacing:1.5px;margin-bottom:24px;
}
.page-h1{font-size:clamp(2.5rem,5vw,4.2rem);font-weight: 800;letter-spacing:-2.5px;line-height:1.08;margin-bottom:20px;color:#fff;}
.page-sub{font-size:1.05rem;color:var(--muted);line-height:1.75;max-width:620px;margin:0 auto;}

/* Toggle Switch Styles */
.pricing-toggle-wrap {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.03);
    padding: 6px 8px;
    border-radius: 999px;
    border: 1px solid var(--border);
    margin-top: 25px;
}
.pricing-toggle-btn {
    border: none;
    background: transparent;
    color: var(--muted);
    font-weight: 600;
    font-size: 0.88rem;
    padding: 10px 24px;
    border-radius: 999px;
    transition: all 0.3s ease;
    cursor: pointer;
}
.pricing-toggle-btn.active {
    background: var(--gradient);
    color: hsl(222,47%,6%);
    box-shadow: 0 4px 15px rgba(174, 72, 56, 0.25);
}

/* Pricing Grid */
.pricing-grid {
    position: relative;
    z-index: 10;
}
.pricing-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 24px;
    padding: 48px 32px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
}
.pricing-card:hover {
    transform: translateY(-8px);
    border-color: hsla(174,72%,56%,0.3);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5), 0 0 50px rgba(174, 72, 56, 0.08);
}

/* Highlighted (Premium + Mobile App) Card */
.pricing-card.highlighted {
    background: rgba(174, 72, 56, 0.03);
    border: 1px solid hsla(174,72%,56%,0.4);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.55), 0 0 55px rgba(174, 72, 56, 0.16);
}
.pricing-card.highlighted::before {
    content: '';
    position: absolute;
    top: -1px; left: -1px; right: -1px; bottom: -1px;
    background: linear-gradient(135deg, hsl(174,72%,56%), hsl(217,91%,60%));
    z-index: -1;
    border-radius: 25px;
    opacity: 0.35;
    transition: opacity 0.4s ease;
}
.pricing-card.highlighted:hover::before {
    opacity: 0.7;
}

/* Plan Badge */
.plan-badge {
    position: absolute;
    top: -14px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--gradient);
    color: hsl(222,47%,6%);
    font-weight: 700;
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    padding: 6px 18px;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(174, 72, 56, 0.35);
    white-space: nowrap;
}

/* Card Header elements */
.plan-icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 24px;
}
.plan-icon.basic { color: #38bdf8; background: rgba(56, 189, 248, 0.08); border: 1px solid rgba(56, 189, 248, 0.15); }
.plan-icon.premium { color: #a855f7; background: rgba(168, 85, 247, 0.08); border: 1px solid rgba(168, 85, 247, 0.15); }
.plan-icon.premium-app { color: #f43f5e; background: rgba(244, 63, 94, 0.08); border: 1px solid rgba(244, 63, 94, 0.15); }
.plan-icon.custom { color: #fbbf24; background: rgba(251, 191, 36, 0.08); border: 1px solid rgba(251, 191, 36, 0.15); }

.plan-name {
    font-size: 1.4rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 6px;
    letter-spacing: -0.3px;
}
.plan-subtitle {
    font-size: 0.78rem;
    color: var(--muted);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 24px;
}

/* Pricing Display */
.plan-price-wrap {
    margin-bottom: 28px;
    min-height: 80px;
}
.price-monthly, .price-annually {
    transition: opacity 0.3s ease;
}
.price-annually {
    display: none;
}
.billing-annual .price-monthly {
    display: none;
}
.billing-annual .price-annually {
    display: block;
}
.price-currency {
    font-size: 1.6rem;
    font-weight: 700;
    color: #fff;
    vertical-align: super;
}
.price-number {
    font-size: 2.8rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: -1.5px;
}
.price-period {
    font-size: 0.95rem;
    color: var(--muted);
}
.price-subtext {
    font-size: 0.78rem;
    color: var(--muted);
    margin-top: 4px;
    font-weight: 500;
}

/* Features List */
.plan-features {
    list-style: none;
    padding: 0;
    margin: 0 0 36px 0;
    flex-grow: 1;
}
.plan-features li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 0.86rem;
    color: hsl(215, 20%, 82%);
    padding: 10px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.04);
}
.plan-features li:last-child {
    border-bottom: none;
}
.plan-features li i {
    font-size: 0.9rem;
    margin-top: 3px;
    flex-shrink: 0;
}
.plan-features li i.fa-circle-check {
    color: var(--primary);
}
.plan-features li i.fa-circle-xmark {
    color: rgba(255, 255, 255, 0.2);
}

/* Plan Button */
.plan-btn {
    display: block;
    width: 100%;
    text-align: center;
    padding: 14px 24px;
    border-radius: 14px;
    font-weight: 600;
    font-size: 0.92rem;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.04);
    color: #fff;
}
.plan-btn:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #fff;
    border-color: rgba(255, 255, 255, 0.18);
    transform: translateY(-2px);
}
.plan-btn.btn-featured {
    background: var(--gradient);
    color: hsl(222,47%,6%);
    border: none;
    box-shadow: 0 10px 25px rgba(174, 72, 56, 0.25);
}
.plan-btn.btn-featured:hover {
    background: linear-gradient(135deg, hsl(174,72%,60%), hsl(217,91%,65%));
    color: hsl(222,47%,6%);
    box-shadow: 0 15px 30px rgba(174, 72, 56, 0.35);
    transform: translateY(-2px);
}

/* Comparison Matrix Section */
.comparison-section {
    padding: 100px 0;
    border-top: 1px solid var(--border);
    position: relative;
    overflow: hidden;
}
.comparison-section::before {
    content: '';
    position: absolute;
    bottom: -150px;
    left: 50%;
    transform: translateX(-50%);
    width: 900px;
    height: 450px;
    background: radial-gradient(ellipse, hsla(174,72%,56%,0.04) 0%, transparent 70%);
    pointer-events: none;
}
.comp-table-wrap {
    background: rgba(255, 255, 255, 0.01);
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 36px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.comp-table {
    width: 100%;
    min-width: 850px;
    border-collapse: collapse;
}
.comp-table th, .comp-table td {
    padding: 18px 20px;
    text-align: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.04);
}
.comp-table th {
    font-weight: 700;
    color: #fff;
    font-size: 0.95rem;
    letter-spacing: -0.2px;
}
.comp-table th:first-child, .comp-table td:first-child {
    text-align: left;
    font-weight: 600;
    color: #fff;
    width: 32%;
}
.comp-table td:first-child {
    color: hsl(215, 20%, 85%);
    font-size: 0.9rem;
}
.comp-table tr.category-row td {
    background: rgba(255, 255, 255, 0.02);
    font-weight: 700;
    color: var(--primary);
    text-transform: uppercase;
    font-size: 0.72rem;
    letter-spacing: 1.5px;
    text-align: left;
    padding: 14px 20px;
    border-bottom: 1px solid rgba(174, 72, 56, 0.15);
}
.comp-table td i.fa-circle-check {
    color: var(--primary);
    font-size: 1.1rem;
}
.comp-table td i.fa-circle-xmark {
    color: rgba(255, 255, 255, 0.15);
    font-size: 1.1rem;
}
.comp-table td {
    font-size: 0.88rem;
    color: hsl(215, 20%, 80%);
}

/* Stats Strip */
.stats-strip{
    background: hsl(222, 47%, 4.5%);
    border-top:1px solid var(--border);
    border-bottom:1px solid var(--border);
    padding:50px 0;
}
.stat-val{font-size:2rem;font-weight: 800;letter-spacing:-1px;line-height:1;}
.stat-lbl{font-size:0.72rem;color:var(--muted);font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-top:6px;}
.stat-div{width:1px;height:45px;background:var(--border);}

/* FAQ */
.faq-item{
    border:1px solid var(--border)!important;border-radius:16px!important;
    margin-bottom:12px;overflow:hidden;background:var(--card)!important;
    transition:border-color 0.25s;
}
.faq-item:hover{border-color:hsla(174,72%,56%,0.25)!important;}
.accordion-button{
    background:var(--card)!important;color:#fff!important;
    font-weight:600;font-size:0.92rem;padding:20px 24px;box-shadow:none!important;
}
.accordion-button::after{filter:invert(1);}
.accordion-button:not(.collapsed){color:var(--primary)!important;}
.accordion-body{
    background:var(--card);color:var(--muted);
    font-size:0.88rem;line-height:1.8;
    padding:0 24px 22px;border-top:1px solid var(--border);
}
/* AI Banner */
.ai-banner-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(16, 163, 127, 0.08);
    border: 1px solid rgba(16, 163, 127, 0.25);
    color: #10a37f !important;
    font-weight: 600;
    font-size: 0.82rem;
    padding: 8px 20px;
    border-radius: 999px;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: 24px;
}
.ai-banner-btn:hover {
    background: rgba(16, 163, 127, 0.16);
    border-color: rgba(16, 163, 127, 0.4);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(16, 163, 127, 0.15);
}
.ai-banner-btn img {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    object-fit: cover;
}
@media(max-width:1200px){
    .pricing-card { padding: 40px 24px; }
}
@media(max-width:992px){
    .pricing-hero { padding: 100px 0 50px; }
    .page-h1 { font-size: 2.8rem; }
}
@media(max-width:768px){
    .pricing-card { padding: 36px 20px; }
    .comp-table-wrap { padding: 20px; }
}

@media (max-width: 576px) {
    /* Hero Section */
    .pricing-hero {
        padding: 80px 0 40px !important;
    }
    .page-h1 {
        font-size: 2.0rem !important;
        letter-spacing: -1.5px !important;
        line-height: 1.15 !important;
    }
    .page-sub {
        font-size: 0.9rem !important;
        line-height: 1.6 !important;
        padding: 0 10px;
    }

    /* Interactive Inline ChatGPT Banner */
    .ai-banner-btn {
        padding: 6px 12px !important;
        font-size: 0.72rem !important;
        gap: 6px !important;
        margin-top: 16px !important;
        max-width: 100%;
        white-space: nowrap;
    }
    .ai-banner-btn img {
        width: 14px !important;
        height: 14px !important;
        flex-shrink: 0;
    }
    .ai-banner-btn i {
        font-size: 0.6rem !important;
        flex-shrink: 0;
    }

    /* Billing Switcher */
    .pricing-toggle-wrap {
        padding: 4px 6px !important;
        width: 100%;
        max-width: 320px;
        justify-content: center;
        margin-top: 15px !important;
    }
    .pricing-toggle-btn {
        padding: 8px 16px !important;
        font-size: 0.8rem !important;
        flex: 1;
        text-align: center;
        white-space: nowrap;
    }

    /* Pricing Cards */
    .pricing-card {
        padding: 28px 16px !important;
        border-radius: 18px !important;
    }
    .plan-icon {
        width: 44px !important;
        height: 44px !important;
        font-size: 1.25rem !important;
        margin-bottom: 18px !important;
    }
    .plan-name {
        font-size: 1.25rem !important;
    }
    .plan-subtitle {
        font-size: 0.72rem !important;
        margin-bottom: 16px !important;
    }
    .plan-price-wrap {
        margin-bottom: 20px !important;
        min-height: 70px !important;
    }
    .price-number {
        font-size: 2.3rem !important;
    }
    .plan-features {
        margin-bottom: 24px !important;
    }
    .plan-features li {
        font-size: 0.8rem !important;
        gap: 8px !important;
        padding: 8px 0 !important;
    }
    .plan-btn {
        padding: 10px 18px !important;
        font-size: 0.85rem !important;
        border-radius: 10px !important;
    }

    /* Stats Strip */
    .stats-strip {
        padding: 30px 0 !important;
    }
    .stat-val {
        font-size: 1.6rem !important;
    }
    .stat-lbl {
        font-size: 0.65rem !important;
    }

    /* Detailed Feature Matrix Sticky Layout */
    .comp-table th:first-child,
    .comp-table td:first-child {
        position: -webkit-sticky !important;
        position: sticky !important;
        left: 0 !important;
        background: hsl(222, 47%, 6%) !important;
        z-index: 5 !important;
        width: 140px !important;
        min-width: 140px !important;
        border-right: 1px solid var(--border) !important;
    }
    .comp-table tr.category-row td {
        position: -webkit-sticky !important;
        position: sticky !important;
        left: 0 !important;
        background: rgba(255, 255, 255, 0.02) !important;
        z-index: 4 !important;
    }

    /* FAQ accordion adjustments */
    .accordion-button {
        padding: 16px 20px !important;
        font-size: 0.85rem !important;
    }
    .accordion-body {
        padding: 0 20px 18px !important;
        font-size: 0.8rem !important;
    }
}
</style>
</head>
<body>
@include('components.frontend-navbar')

<!-- Hero Section -->
<section class="pricing-hero">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="eyebrow"><i class="fas fa-tag"></i> PRICING PLANS</div>
        <h1 class="page-h1">Choose the perfect plan<br>for your <span class="g-text">Institute</span></h1>
        <p class="page-sub">Simple, predictable pricing plans designed to help institutes digitalize seamlessly, improve operations, and connect better with parents.</p>
        <!-- Interactive Inline Perplexity Badge -->
        <div class="d-flex justify-content-center">
            <a href="https://www.perplexity.ai/search?q=About+Edunex+erp+by+Engenius+Digitech" target="_blank" class="ai-banner-btn">
                <img src="{{ asset('images/gpt.png') }}" alt="Perplexity">
                <span>Ask Perplexity about Edunex ERP</span>
                <i class="fas fa-arrow-up-right-from-square ms-2" style="font-size: 0.68rem; opacity: 0.8;"></i>
            </a>
        </div>

        <!-- Billing Switcher -->
        <div class="d-flex align-items-center justify-content-center flex-wrap gap-3 mt-4">
            <div class="pricing-toggle-wrap">
                <button class="pricing-toggle-btn active" id="btn-monthly" onclick="setBillingCycle('monthly')">Monthly</button>
                <button class="pricing-toggle-btn" id="btn-annual" onclick="setBillingCycle('annual')">
                    Annually <span class="badge bg-success-subtle text-success ms-1" style="font-size:0.65rem;">Save 20%</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Cards Grid -->
<section style="padding: 20px 0 80px;" id="pricing-plans-container">
    <div class="container px-4">
        <div class="row g-4 justify-content-center pricing-grid">
            
            <!-- Basic Plan -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="pricing-card">
                    <div>
                        <div class="plan-icon basic">
                            <i class="fas fa-school-flag"></i>
                        </div>
                        <div class="plan-name">Basic Plan</div>
                        <div class="plan-subtitle">For Smaller Academies</div>
                        
                        <div class="plan-price-wrap">
                            <!-- Monthly Price Row -->
                            <div class="price-monthly">
                                <span class="price-currency">$</span>
                                <span class="price-number">19</span>
                                <span class="price-period">/ mo</span>
                                <div class="price-subtext">Billed monthly</div>
                            </div>
                            <!-- Annual Price Row -->
                            <div class="price-annually">
                                <span class="price-currency">$</span>
                                <span class="price-number">15</span>
                                <span class="price-period">/ mo</span>
                                <div class="price-subtext">Billed annually ($180/yr)</div>
                            </div>
                        </div>

                        <ul class="plan-features">
                            <li><i class="fa-solid fa-circle-check"></i> Student & Staff Registry</li>
                            <li><i class="fa-solid fa-circle-check"></i> Standard Attendance Module</li>
                            <li><i class="fa-solid fa-circle-check"></i> Fees & Ledger Management</li>
                            <li><i class="fa-solid fa-circle-check"></i> Class Schedules & Timetables</li>
                            <li><i class="fa-solid fa-circle-check"></i> Homework & Syllabus Planner</li>
                            <li><i class="fa-solid fa-circle-check"></i> Secure Cloud Database</li>
                            <li><i class="fa-solid fa-circle-check"></i> Email Support</li>
                            <li><i class="fa-solid fa-circle-xmark"></i> AI Biometric Face Attendance</li>
                            <li><i class="fa-solid fa-circle-xmark"></i> Branded Mobile App</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ route('trial.request', ['plan' => 'Basic Plan']) }}" class="plan-btn">
                            Start 7-Day Trial <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Premium Plan -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="pricing-card">
                    <div>
                        <div class="plan-icon premium">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="plan-name">Premium Plan</div>
                        <div class="plan-subtitle">For Modern Schools</div>
                        
                        <div class="plan-price-wrap">
                            <!-- Monthly Price Row -->
                            <div class="price-monthly">
                                <span class="price-currency">$</span>
                                <span class="price-number">49</span>
                                <span class="price-period">/ mo</span>
                                <div class="price-subtext">Billed monthly</div>
                            </div>
                            <!-- Annual Price Row -->
                            <div class="price-annually">
                                <span class="price-currency">$</span>
                                <span class="price-number">39</span>
                                <span class="price-period">/ mo</span>
                                <div class="price-subtext">Billed annually ($468/yr)</div>
                            </div>
                        </div>

                        <ul class="plan-features">
                            <li><i class="fa-solid fa-circle-check"></i> Everything in Basic</li>
                            <li><i class="fa-solid fa-circle-check"></i> AI Face Biometric Attendance</li>
                            <li><i class="fa-solid fa-circle-check"></i> GPS Staff Location Tracking</li>
                            <li><i class="fa-solid fa-circle-check"></i> Online Exams & Gradebook</li>
                            <li><i class="fa-solid fa-circle-check"></i> AI Proctoring & Question Bank</li>
                            <li><i class="fa-solid fa-circle-check"></i> WhatsApp Alerts & Reminders</li>
                            <li><i class="fa-solid fa-circle-check"></i> One-click Automated Payroll</li>
                            <li><i class="fa-solid fa-circle-check"></i> Priority Ticket Support</li>
                            <li><i class="fa-solid fa-circle-xmark"></i> Custom Branded Mobile App</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ route('trial.request', ['plan' => 'Premium Plan']) }}" class="plan-btn">
                            Start 7-Day Trial <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Premium + Mobile App Plan -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="pricing-card highlighted">
                    <div class="plan-badge"><i class="fas fa-crown me-1"></i> Best Value</div>
                    <div>
                        <div class="plan-icon premium-app">
                            <i class="fas fa-mobile-screen-button"></i>
                        </div>
                        <div class="plan-name">Premium + App</div>
                        <div class="plan-subtitle">Complete Branded Suite</div>
                        
                        <div class="plan-price-wrap">
                            <!-- Monthly Price Row -->
                            <div class="price-monthly">
                                <span class="price-currency">$</span>
                                <span class="price-number">99</span>
                                <span class="price-period">/ mo</span>
                                <div class="price-subtext">Billed monthly</div>
                            </div>
                            <!-- Annual Price Row -->
                            <div class="price-annually">
                                <span class="price-currency">$</span>
                                <span class="price-number">79</span>
                                <span class="price-period">/ mo</span>
                                <div class="price-subtext">Billed annually ($948/yr)</div>
                            </div>
                        </div>

                        <ul class="plan-features">
                            <li><i class="fa-solid fa-circle-check"></i> Everything in Premium</li>
                            <li><i class="fa-solid fa-circle-check"></i> <strong>Branded App (Android & iOS)</strong></li>
                            <li><i class="fa-solid fa-circle-check"></i> Real-time Push Notifications</li>
                            <li><i class="fa-solid fa-circle-check"></i> Live Classes Integration</li>
                            <li><i class="fa-solid fa-circle-check"></i> Student-Teacher Discussion Chat</li>
                            <li><i class="fa-solid fa-circle-check"></i> Digital Library & Study Hub</li>
                            <li><i class="fa-solid fa-circle-check"></i> Dedicated Account Manager</li>
                            <li><i class="fa-solid fa-circle-check"></i> Instant WhatsApp Live Chat Support</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ route('trial.request', ['plan' => 'Premium + Mobile App Plan']) }}" class="plan-btn btn-featured">
                            Start 7-Day Trial <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Custom Plan -->
            <div class="col-xl-3 col-md-6 col-12">
                <div class="pricing-card">
                    <div>
                        <div class="plan-icon custom">
                            <i class="fas fa-sliders"></i>
                        </div>
                        <div class="plan-name">Custom Plan</div>
                        <div class="plan-subtitle">For Enterprise Networks</div>
                        
                        <div class="plan-price-wrap d-flex flex-column justify-content-center" style="min-height:80px;">
                            <div class="price-number" style="font-size: 2.2rem;">Custom</div>
                            <div class="price-subtext">Tailored pricing based on scale</div>
                        </div>

                        <ul class="plan-features">
                            <li><i class="fa-solid fa-circle-check"></i> Everything in Premium + App</li>
                            <li><i class="fa-solid fa-circle-check"></i> Multi-branch / Multi-campus ERP</li>
                            <li><i class="fa-solid fa-circle-check"></i> Custom Domain (White-labeled)</li>
                            <li><i class="fa-solid fa-circle-check"></i> Custom API Integrations (e.g. Tally)</li>
                            <li><i class="fa-solid fa-circle-check"></i> Dedicated On-site Staff Onboarding</li>
                            <li><i class="fa-solid fa-circle-check"></i> Custom Module Development</li>
                            <li><i class="fa-solid fa-circle-check"></i> 99.9% SLA Uptime Guarantee</li>
                            <li><i class="fa-solid fa-circle-check"></i> Dedicated DB Server Instances</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ route('contact') }}" class="plan-btn">
                            Contact Sales <i class="fas fa-envelope ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Stats Strip -->
<section class="stats-strip">
    <div class="container px-4">
        <div class="d-flex align-items-center justify-content-center gap-4 gap-md-5 flex-wrap text-center">
            <div><div class="stat-val g-text">99.9%</div><div class="stat-lbl">Uptime SLA</div></div>
            <div class="stat-div d-none d-md-block"></div>
            <div><div class="stat-val g-text">100+</div><div class="stat-lbl">Institutes Live</div></div>
            <div class="stat-div d-none d-md-block"></div>
            <div><div class="stat-val g-text">15 min</div><div class="stat-lbl">Setup Time</div></div>
            <div class="stat-div d-none d-md-block"></div>
            <div><div class="stat-val" style="color:hsl(38,92%,60%);">4.9★</div><div class="stat-lbl">Rating</div></div>
        </div>
    </div>
</section>

<!-- Detailed Features Comparison Matrix -->
<section class="comparison-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="eyebrow"><i class="fas fa-layer-group"></i> Feature Matrix</span>
            <h2 class="fw-bold text-white mt-2" style="font-size:clamp(1.8rem, 3vw, 2.5rem); letter-spacing:-1px;">Compare our features in detail</h2>
            <p class="text-muted mx-auto" style="max-width:550px; font-size:0.95rem;">Find the plan that matches your exact institutional workflow needs.</p>
        </div>

        <div class="comp-table-wrap">
            <table class="comp-table">
                <thead>
                    <tr>
                        <th class="text-start">Features</th>
                        <th>Basic</th>
                        <th>Premium</th>
                        <th>Premium + App</th>
                        <th>Custom</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Platform Row Group -->
                    <tr class="category-row">
                        <td colspan="5">Core ERP Platform</td>
                    </tr>
                    <tr>
                        <td>Student & Staff Directory</td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Attendance & Timetable Planner</td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Homework & Syllabus Management</td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Daily Secure Backups</td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Multi-branch Management Console</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Custom Domain / White-label Portal</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>

                    <!-- Advanced Registry & Tracking -->
                    <tr class="category-row">
                        <td colspan="5">Attendance & Biometrics</td>
                    </tr>
                    <tr>
                        <td>Standard Digital Attendance</td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>AI Face Biometric Attendance</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>GPS-based Staff Geofence Tracking</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>

                    <!-- Academics & Exams -->
                    <tr class="category-row">
                        <td colspan="5">Academics & Exams</td>
                    </tr>
                    <tr>
                        <td>Standard Marks Entry & Report Cards</td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Online Exams & Proctoring System</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Auto-Generating Question Banks</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>

                    <!-- Mobile App & Communication -->
                    <tr class="category-row">
                        <td colspan="5">Mobile App & Communication</td>
                    </tr>
                    <tr>
                        <td>System Email Notifications</td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>WhatsApp Fee Reminders & Alerts</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Custom Android & iOS Mobile App</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Real-time Teacher-Parent Chat Hub</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Live Video Classes Integration</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>

                    <!-- Accounting & Integrations -->
                    <tr class="category-row">
                        <td colspan="5">Finance & Accounting</td>
                    </tr>
                    <tr>
                        <td>Invoicing & Ledger Maintenance</td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Payment Gateway Integrations</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Salary & Automating Payroll Module</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                    <tr>
                        <td>Tally Sync & Custom ERP Integrations</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>

                    <!-- Setup & Support -->
                    <tr class="category-row">
                        <td colspan="5">Support & Onboarding</td>
                    </tr>
                    <tr>
                        <td>Support Ticket System</td>
                        <td>Email only</td>
                        <td>Priority Ticket</td>
                        <td>Dedicated Account Mgr</td>
                        <td>24/7 Phone & On-site</td>
                    </tr>
                    <tr>
                        <td>Staff Onboarding Setup</td>
                        <td>Self-serve</td>
                        <td>Remote Assisted</td>
                        <td>Remote Assisted</td>
                        <td>Dedicated On-site</td>
                    </tr>
                    <tr>
                        <td>Custom Module Development</td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-xmark"></i></td>
                        <td><i class="fa-solid fa-circle-check"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Frequently Asked Questions -->
<section style="padding: 30px 0 90px;">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="eyebrow"><i class="fas fa-circle-question"></i> Help Desk</span>
            <h2 class="fw-bold text-white mt-2" style="font-size:clamp(1.8rem, 3vw, 2.5rem); letter-spacing:-1px;">Frequently Asked Questions</h2>
            <p class="text-muted mx-auto" style="max-width:550px; font-size:0.95rem;">Have questions about our subscription tiers or features? We've got answers.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="pricingFaq">
                    @php
                    $faqs = [
                        [
                            'q' => 'What happens after the 7-day free trial?',
                            'a' => 'You can choose to subscribe to one of our premium plans (Basic, Premium, or Premium + Mobile App). If you decide not to continue, your database and recorded logs remain encrypted and secure, but the institute\'s login portals and features will be suspended.'
                        ],
                        [
                            'q' => 'Is a credit card required to start a trial?',
                            'a' => 'No credit card is required to sign up. Simply fill out our trial registration form, and we will contact you via WhatsApp to configure your institute\'s workspace and subdomain.'
                        ],
                        [
                            'q' => 'How does the custom-branded mobile app work?',
                            'a' => 'With the "Premium + Mobile App" plan, our development team compiles a custom version of the parent/student app with your logo, name, and color theme. We manage compiling, testing, and publishing it directly onto Google Play Store and Apple App Store under your developer accounts or our publisher network.'
                        ],
                        [
                            'q' => 'Are there any hidden limits on student registries?',
                            'a' => 'No! Our pricing is structured as flat rate per month. Unlike other platforms that charge scaling costs based on student count, we offer flat pricing to keep your institute\'s bookkeeping transparent and cost-effective.'
                        ],
                        [
                            'q' => 'Can we migrate our existing student and staff data?',
                            'a' => 'Yes, absolutely. Our onboarding team provides free spreadsheet templates. Once filled out, we will import your historical registers, parent profiles, fee records, and staff schedules directly into the database.'
                        ],
                        [
                            'q' => 'Do you charge a setup or implementation fee?',
                            'a' => 'We charge zero setup fees for standard installations. On-site implementation support or custom feature changes (in Custom Plan) may require custom quotes, which will be detailed in your service level agreements.'
                        ]
                    ];
                    @endphp
                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#pq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h2>
                        <div id="pq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                            data-bs-parent="#pricingFaq">
                            <div class="accordion-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<x-frontend-footer/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function setBillingCycle(cycle) {
    const btnMonthly = document.getElementById('btn-monthly');
    const btnAnnual = document.getElementById('btn-annual');
    const container = document.getElementById('pricing-plans-container');
    
    if (cycle === 'annual') {
        btnMonthly.classList.remove('active');
        btnAnnual.classList.add('active');
        container.classList.add('billing-annual');
    } else {
        btnAnnual.classList.remove('active');
        btnMonthly.classList.add('active');
        container.classList.remove('billing-annual');
    }
}
</script>

@include('components.whatsapp-widget')
</body>
</html>