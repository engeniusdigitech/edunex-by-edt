<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="EduNex Pricing — Simple, Transparent Institute Management Software Plans" description="One plan, everything included. Get a custom quote for our AI-powered institute management platform. No hidden fees." />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')
    @verbatim
    <script type="application/ld+json">
    {"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"What happens after the 7-day trial?","acceptedAnswer":{"@type":"Answer","text":"You can choose to continue using EduNex. If not, your data stays secure but features become restricted."}},{"@type":"Question","name":"Are there hidden limits?","acceptedAnswer":{"@type":"Answer","text":"No. One plan with everything included — no feature tiers, no upgrade walls."}},{"@type":"Question","name":"Is there a setup fee?","acceptedAnswer":{"@type":"Answer","text":"Zero. No onboarding fees, no implementation fees."}},{"@type":"Question","name":"How does onboarding work?","acceptedAnswer":{"@type":"Answer","text":"Our team guides you through every step and helps you import existing data seamlessly."}}]}
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
    padding:150px 0 70px;
    text-align:center;position:relative;overflow:hidden;
}
.pricing-hero::before{
    content:'';position:absolute;top:-200px;left:50%;transform:translateX(-50%);
    width:700px;height:500px;
    background:radial-gradient(ellipse,hsla(217,91%,60%,0.13) 0%,transparent 70%);
    pointer-events:none;
}
.eyebrow{
    display:inline-flex;align-items:center;gap:7px;
    background:hsla(217,91%,60%,0.1);border:1px solid hsla(217,91%,60%,0.22);
    border-radius:9999px;padding:5px 14px;
    font-size:0.72rem;font-weight:600;color:hsl(217,91%,75%);
    text-transform:uppercase;letter-spacing:1px;margin-bottom:22px;
}
.page-h1{font-size:clamp(2.5rem,5vw,4rem);font-weight: 500;letter-spacing:-2.5px;line-height:1.08;margin-bottom:18px;color:#fff;}
.page-sub{font-size:1rem;color:var(--muted);line-height:1.85;max-width:520px;margin:0 auto;}

/* Plan card */
.plan-wrap{position:relative;max-width:740px;margin:0 auto;}
.plan-recommended-badge{
    display:inline-flex;align-items:center;gap:6px;
    background:var(--gradient);color:hsl(222,47%,6%);
    font-size:0.72rem;font-weight: 500;text-transform:uppercase;letter-spacing:1px;
    padding:5px 16px;border-radius:9999px;
    position:absolute;top:-18px;left:50%;transform:translateX(-50%);
    white-space:nowrap;
}
.plan-card{
    background:var(--card);border:1px solid var(--border);
    border-radius:20px;padding:48px;
    box-shadow:0 0 0 1px hsla(174,72%,56%,0.15),0 0 60px hsla(174,72%,56%,0.08);
    transition:box-shadow 0.3s ease;
}
.plan-card:hover{box-shadow:0 0 0 1px hsla(174,72%,56%,0.3),0 0 80px hsla(174,72%,56%,0.12);}
.plan-name{font-size:1.5rem;font-weight: 500;color:#fff;letter-spacing:-0.5px;margin-bottom:6px;}
.plan-sub{font-size:0.82rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.8px;font-weight:600;}
.plan-desc{font-size:0.9rem;color:var(--muted);line-height:1.75;margin:20px 0 32px;}

.feat-list{list-style:none;padding:0;margin:0;}
.feat-list li{
    display:flex;align-items:flex-start;gap:12px;
    font-size:0.88rem;color:hsl(215,20%,80%);
    padding:10px 0;border-bottom:1px solid hsla(210,40%,98%,0.05);
}
.feat-list li:last-child{border:none;}
.feat-list li i{color:var(--primary);font-size:0.85rem;margin-top:2px;flex-shrink:0;}

.plan-cta{
    display:block;width:100%;text-align:center;
    padding:16px 24px;border-radius:12px;
    font-weight: 500;font-size:0.95rem;text-decoration:none;
    background:var(--gradient);color:hsl(222,47%,6%);
    box-shadow:0 0 24px hsla(174,72%,56%,0.3);
    transition:all 0.25s ease;
}
.plan-cta:hover{opacity:0.9;transform:translateY(-2px);color:hsl(222,47%,6%);}

/* Enterprise box */
.ent-box{
    background:hsla(217,91%,60%,0.05);
    border:1px solid hsla(217,91%,60%,0.18);
    border-radius:16px;padding:32px;height:100%;
}
.ent-title{font-size:1.1rem;font-weight: 500;color:#fff;margin-bottom:10px;letter-spacing:-0.3px;}
.ent-desc{font-size:0.85rem;color:var(--muted);line-height:1.75;margin-bottom:24px;}
.ent-cta{
    display:block;text-align:center;
    padding:13px 20px;border-radius:10px;
    background:rgba(255,255,255,0.06);border:1px solid var(--border);
    color:#fff;font-weight: 500;font-size:0.88rem;text-decoration:none;
    transition:all 0.2s;
}
.ent-cta:hover{color:#fff;background:rgba(255,255,255,0.1);border-color:hsla(174,72%,56%,0.4);}
.ent-feat{display:flex;align-items:center;gap:10px;font-size:0.82rem;color:var(--muted);margin-bottom:10px;}
.ent-feat i{color:var(--primary);font-size:0.8rem;}

/* Stats strip */
.stats-strip{
    background:hsl(222,47%,5%);
    border-top:1px solid var(--border);
    border-bottom:1px solid var(--border);
    padding:40px 0;
}
.stat-val{font-size:1.8rem;font-weight: 500;letter-spacing:-1px;line-height:1;}
.stat-lbl{font-size:0.7rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.8px;margin-top:4px;}
.stat-div{width:1px;height:40px;background:var(--border);}

/* FAQ */
.faq-item{
    border:1px solid var(--border)!important;border-radius:12px!important;
    margin-bottom:10px;overflow:hidden;background:var(--card)!important;
    transition:border-color 0.2s;
}
.faq-item:hover{border-color:hsla(174,72%,56%,0.3)!important;}
.accordion-button{
    background:var(--card)!important;color:#fff!important;
    font-weight:600;font-size:0.9rem;padding:18px 22px;box-shadow:none!important;
}
.accordion-button::after{filter:invert(1);}
.accordion-button:not(.collapsed){color:var(--primary)!important;}
.accordion-body{
    background:var(--card);color:var(--muted);
    font-size:0.87rem;line-height:1.85;
    padding:0 22px 20px;border-top:1px solid var(--border);
}

@media(max-width:768px){
    .page-h1{font-size:2.5rem;letter-spacing:-2px;}
    .plan-card{padding:32px 24px;}
}
</style>
</head>
<body>
@include('components.frontend-navbar')

<!-- Hero -->
<section class="pricing-hero">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="eyebrow"><i class="fas fa-tag"></i> Pricing</div>
        <h1 class="page-h1">Simple, transparent.<br><span class="g-text">One plan, all features.</span></h1>
        <p class="page-sub">No tiers. No feature gating. Everything you need to run a modern institute — in one comprehensive plan.</p>
    </div>
</section>

<!-- Pricing Card + Enterprise -->
<section style="padding:0 0 80px;">
    <div class="container px-4">
        <div class="row justify-content-center g-4 align-items-start">
            <div class="col-lg-7">
                <div class="plan-wrap" style="padding-top:24px;">
                    <div class="plan-recommended-badge"><i class="fas fa-star"></i> Recommended</div>
                    <div class="plan-card">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <div class="plan-name">Professional Plan</div>
                                <div class="plan-sub">Unlimited Scale</div>
                            </div>
                        </div>
                        <p class="plan-desc">Everything your institute needs — from attendance to payroll — all in one platform. Custom pricing based on your institute size.</p>

                        <div class="row g-0">
                            <div class="col-md-6">
                                <ul class="feat-list pe-md-3">
                                    <li><i class="fas fa-check-circle"></i> AI Face Biometric Attendance</li>
                                    <li><i class="fas fa-check-circle"></i> GPS Staff Location Tracking</li>
                                    <li><i class="fas fa-check-circle"></i> Smart Fee Tracking</li>
                                    <li><i class="fas fa-check-circle"></i> One-Click Payroll</li>
                                    <li><i class="fas fa-check-circle"></i> Digital Salary Slips</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feat-list ps-md-3">
                                    <li><i class="fas fa-check-circle"></i> Live Class Integration</li>
                                    <li><i class="fas fa-check-circle"></i> Student Portal (PWA)</li>
                                    <li><i class="fas fa-check-circle"></i> WhatsApp Fee Reminders</li>
                                    <li><i class="fas fa-check-circle"></i> Custom PDF Reports</li>
                                    <li><i class="fas fa-check-circle"></i> 24/7 Priority Support</li>
                                </ul>
                            </div>
                        </div>

                        <div style="margin:32px 0 24px;padding:20px;background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:12px;text-align:center;">
                            <div style="font-size:0.75rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;">Custom Pricing</div>
                            <div style="font-size:1.1rem;font-weight: 500;color:#fff;">Based on your institute size &amp; needs</div>
                            <div style="font-size:0.78rem;color:var(--muted);margin-top:4px;">Get a personalized quote in under 24 hours</div>
                        </div>

                        <a href="{{ route('trial.request') }}" class="plan-cta">
                            Get Best Quote &nbsp;<i class="fas fa-arrow-right"></i>
                        </a>
                        <p style="text-align:center;font-size:0.75rem;color:var(--muted);margin-top:14px;">
                            <i class="fas fa-shield-alt me-1" style="color:var(--primary);"></i> 7-day free trial · No credit card required
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="ent-box">
                    <div class="ent-title">Enterprise / Multi-Branch?</div>
                    <p class="ent-desc">Multi-campus setups, custom feature development, API integrations, or large-scale franchise deployments — our enterprise team can help.</p>
                    <a href="{{ route('contact') }}" class="ent-cta mb-4">Talk to our Experts <i class="fas fa-arrow-right ms-2"></i></a>
                    <div style="margin-top:24px;padding-top:24px;border-top:1px solid var(--border);">
                        <div class="ent-feat"><i class="fas fa-building"></i> Multi-branch management</div>
                        <div class="ent-feat"><i class="fas fa-shield-halved"></i> Enterprise-grade security</div>
                        <div class="ent-feat"><i class="fas fa-plug"></i> API &amp; custom integrations</div>
                        <div class="ent-feat"><i class="fas fa-bolt"></i> Setup under 2 minutes</div>
                        <div class="ent-feat"><i class="fas fa-headset"></i> Dedicated account manager</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats-strip">
    <div class="container px-4">
        <div class="d-flex align-items-center justify-content-center gap-4 gap-md-5 flex-wrap text-center">
            <div><div class="stat-val g-text">99.9%</div><div class="stat-lbl">Uptime</div></div>
            <div class="stat-div d-none d-md-block"></div>
            <div><div class="stat-val g-text">24/7</div><div class="stat-lbl">Support</div></div>
            <div class="stat-div d-none d-md-block"></div>
            <div><div class="stat-val g-text">100+</div><div class="stat-lbl">Institutes</div></div>
            <div class="stat-div d-none d-md-block"></div>
            <div><div class="stat-val" style="color:hsl(38,92%,60%);">4.9★</div><div class="stat-lbl">Rating</div></div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section style="padding:90px 0;">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span style="display:block;font-size:0.72rem;font-weight: 500;text-transform:uppercase;letter-spacing:1.5px;color:var(--primary);margin-bottom:14px;">Transparency</span>
            <h2 style="font-size:clamp(1.8rem,3vw,2.5rem);font-weight: 500;letter-spacing:-1.5px;color:#fff;margin-bottom:0;">Frequently Asked Questions</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="pricingFaq">
                    @php
                    $faqs = [
                        ['q'=>'What happens after the 7-day trial?','a'=>'You can choose to continue using EduNex for your institute. If you decide not to continue, your data remains secure but the portal features will be restricted.'],
                        ['q'=>'Are there any hidden limits?','a'=>'We offer a single comprehensive platform that includes everything. There are no feature tiers to worry about — you always have the best version of EduNex.'],
                        ['q'=>'Is there a setup fee?','a'=>'Zero. No onboarding fees, no implementation fees. We want you to start with full confidence.'],
                        ['q'=>'How does onboarding work?','a'=>'Once you start your trial, our team provides full support to help you import your existing data and set up your institute seamlessly within minutes.'],
                        ['q'=>'Can I get a custom quote for my institute?','a'=>'Absolutely. Use the Get Best Quote button above or contact our team directly. We respond within 1 business day with a tailored pricing proposal.'],
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
@include('components.whatsapp-widget')
</body>
</html>