<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="About EduNex ERP — School Management Software Company | Institute ERP by Engenius Digitech" description="EduNex ERP (also known as EduNext ERP) is built by Engenius Digitech — engineers and educators creating the best School Management System and Institute ERP. Learn our mission to digitize schools and institutes across India." keywords="edunex, edunext, edunex erp, edunext erp, about edunex, about edunext erp, about school management software company, school ERP company, institute software developer, school software company, EduNex ERP about, Engenius Digitech school ERP, best school management system, school software brand" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')
<style>
*,*::before,*::after{box-sizing:border-box;}
body{
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
.about-hero{
    padding:100px 0 80px;
    text-align:center;position:relative;overflow:hidden;
}
.about-hero::before{
    content:'';position:absolute;top:-200px;left:50%;transform:translateX(-50%);
    width:800px;height:600px;
    background:radial-gradient(ellipse,hsla(174,72%,56%,0.12) 0%,transparent 70%);
    pointer-events:none;
}
.eyebrow{
    display:inline-flex;align-items:center;gap:7px;
    background:hsla(174,72%,56%,0.1);border:1px solid hsla(174,72%,56%,0.22);
    border-radius:9999px;padding:5px 14px;
    font-size:0.72rem;font-weight:600;color:hsl(174,72%,70%);
    text-transform:uppercase;letter-spacing:1px;margin-bottom:22px;
}
.page-h1{font-size:clamp(2.8rem,6vw,4.5rem);font-weight: 500;letter-spacing:-3px;line-height:1.06;margin-bottom:18px;color:#fff;}
.page-sub{font-size:1rem;color:var(--muted);line-height:1.85;max-width:560px;margin:0 auto;}

/* White section */
.light-sec{background:hsl(222,47%,5%)!important;padding:90px 0;border-top:1px solid hsl(217,33%,17%);border-bottom:1px solid hsl(217,33%,17%);}
.light-sec .sec-eyebrow{color:hsl(174,72%,60%);}
.light-sec .sec-h2{font-size:clamp(2rem,3.5vw,2.8rem);font-weight: 500;letter-spacing:-1.5px;color:hsl(210,40%,98%);margin-bottom:16px;}
.light-sec .sec-sub{color:hsl(215,20%,65%);font-size:0.95rem;line-height:1.8;}

/* Mission cards */
.m-card{
    background:hsl(222,47%,8%);border:1px solid hsl(217,33%,17%);border-radius:16px;
    padding:28px;height:100%;transition:all 0.25s ease;position:relative;overflow:hidden;
}
.m-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:var(--gradient);opacity:0;transition:opacity 0.25s;}
.m-card:hover{border-color:hsla(174,72%,56%,0.4);box-shadow:0 0 24px hsla(174,72%,56%,0.1);transform:translateY(-4px);}
.m-card:hover::before{opacity:1;}
.m-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.15rem;margin-bottom:18px;}
.m-title{font-size:1rem;font-weight: 500;color:hsl(210,40%,98%);margin-bottom:8px;}
.m-desc{font-size:0.85rem;color:hsl(215,20%,65%);line-height:1.75;}

/* Story section */
.story-sec{padding:90px 0;}
.story-stat{text-align:center;}
.s-val{font-size:2.2rem;font-weight: 500;letter-spacing:-1.5px;line-height:1;}
.s-lbl{font-size:0.7rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.8px;margin-top:4px;}

/* Values */
.val-card{
    background:var(--card);border:1px solid var(--border);
    border-radius:14px;padding:28px;height:100%;
    transition:all 0.25s ease;
}
.val-card:hover{border-color:hsla(174,72%,56%,0.35);box-shadow:0 0 24px hsla(174,72%,56%,0.1);transform:translateY(-3px);}
.v-icon{width:44px;height:44px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:1.05rem;margin-bottom:16px;}
.v-title{font-size:0.95rem;font-weight: 500;color:#fff;margin-bottom:6px;}
.v-desc{font-size:0.82rem;color:var(--muted);line-height:1.75;}

/* Stats */
.stats-sec{
    background:hsl(222,47%,5%);
    border-top:1px solid var(--border);
    border-bottom:1px solid var(--border);
    padding:60px 0;
}
.big-stat{text-align:center;}
.bs-val{font-size:2.5rem;font-weight: 500;letter-spacing:-2px;line-height:1;}
.bs-lbl{font-size:0.72rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.8px;margin-top:6px;}
.stat-div{width:1px;height:50px;background:var(--border);}

/* CTA */
.cta-sec{padding:90px 0;}
.cta-box{
    background:var(--card);border:1px solid var(--border);
    border-radius:20px;padding:60px 40px;text-align:center;
    position:relative;overflow:hidden;
}
.cta-box::before{
    content:'';position:absolute;top:-150px;left:50%;transform:translateX(-50%);
    width:600px;height:400px;
    background:radial-gradient(ellipse,hsla(174,72%,56%,0.12) 0%,transparent 70%);
    pointer-events:none;
}
.cta-btn{
    display:inline-flex;align-items:center;gap:8px;
    background:var(--gradient);color:hsl(222,47%,6%);
    text-decoration:none;padding:13px 28px;border-radius:10px;
    font-weight: 500;font-size:0.95rem;
    box-shadow:0 0 24px hsla(174,72%,56%,0.28);
    transition:all 0.25s;
}
.cta-btn:hover{opacity:0.9;transform:translateY(-2px);color:hsl(222,47%,6%);}

@media(max-width:768px){.page-h1{font-size:2.5rem;letter-spacing:-2px;}.cta-box{padding:40px 24px;}}
</style>
</head>
<body>
@include('components.frontend-navbar')

<!-- Hero -->
<section class="about-hero">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="eyebrow"><i class="fas fa-info-circle"></i> About EduNex ERP</div>
        <h1 class="page-h1">Built to transform<br>how <span class="g-text">institutes work.</span></h1>
        <p class="page-sub">We believe every institute deserves world-class software. EduNex ERP is the AI-powered platform that makes it possible — for coaching centers, schools, and skill institutes.</p>
    </div>
</section>

<!-- Mission -->
<section class="light-sec">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow" style="display:block;font-size:0.72rem;font-weight: 500;text-transform:uppercase;letter-spacing:1.5px;color:hsl(174,72%,38%);margin-bottom:14px;">Our Mission</span>
            <h2 class="sec-h2">Three principles we<br>build everything around.</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach([
                ['i'=>'fa-bolt','bg'=>'rgba(16,185,129,0.1)','c'=>'hsl(174,72%,38%)','t'=>'Simplify','d'=>'Complex institute operations — attendance, fees, payroll, academics — should be manageable in one click. Not spreadsheets.'],
                ['i'=>'fa-robot','bg'=>'rgba(37,99,235,0.08)','c'=>'hsl(217,91%,50%)','t'=>'Automate','d'=>'Manual work kills productivity. We automate everything that can be automated — so your staff focuses on what actually matters.'],
                ['i'=>'fa-seedling','bg'=>'rgba(245,158,11,0.1)','c'=>'hsl(38,92%,45%)','t'=>'Empower','d'=>'Every teacher, owner, and student deserves tools that make their experience better. EduNex ERP is built for every stakeholder.'],
            ] as $m)
            <div class="col-md-4">
                <div class="m-card">
                    <div class="m-icon" style="background:{{ $m['bg'] }};color:{{ $m['c'] }};"><i class="fas {{ $m['i'] }}"></i></div>
                    <div class="m-title">{{ $m['t'] }}</div>
                    <div class="m-desc">{{ $m['d'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Story -->
<section class="story-sec">
    <div class="container px-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span style="display:block;font-size:0.72rem;font-weight: 500;text-transform:uppercase;letter-spacing:1.5px;color:var(--primary);margin-bottom:14px;">Our Story</span>
                <h2 style="font-size:clamp(2rem,3.5vw,2.8rem);font-weight: 500;letter-spacing:-1.5px;color:#fff;margin-bottom:20px;">Started with one question:<br><em style="font-style:normal;">"Why is this so hard?"</em></h2>
                <p style="color:var(--muted);font-size:0.95rem;line-height:1.9;margin-bottom:20px;">
                    EduNex ERP was born from frustration. Institute owners were managing hundreds of students using WhatsApp groups, paper registers, and disconnected tools. It was chaotic — and it didn't have to be.
                </p>
                <p style="color:var(--muted);font-size:0.95rem;line-height:1.9;margin-bottom:32px;">
                    The team at <strong style="color:#fff;">Engenius Digitech</strong> — a SaaS company based in Vadodara, Gujarat — built EduNex ERP to solve this from the ground up. One platform, every operation, zero chaos.
                </p>
                <div class="d-flex gap-5 flex-wrap">
                    <div class="story-stat">
                        <div class="s-val g-text">2020</div>
                        <div class="s-lbl">Founded</div>
                    </div>
                    <div class="story-stat">
                        <div class="s-val g-text">100+</div>
                        <div class="s-lbl">Institutes</div>
                    </div>
                    <div class="story-stat">
                        <div class="s-val g-text">Vadodara</div>
                        <div class="s-lbl">Headquarter</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div style="background:var(--card);border:1px solid var(--border);border-radius:20px;padding:36px;position:relative;overflow:hidden;">
                    <div style="position:absolute;top:-100px;right:-80px;width:300px;height:300px;border-radius:50%;background:hsla(217,91%,60%,0.08);filter:blur(60px);pointer-events:none;"></div>
                    @foreach([
                        ['i'=>'fa-building','c'=>'bi-blue','t'=>'Engenius Digitech','d'=>'Founded with the mission of building specialized SaaS products.'],
                        ['i'=>'fa-rocket','c'=>'bi-teal','t'=>'EduNex ERP Launched','d'=>'AI-powered institute management platform goes live. 100+ institutes onboarded.'],
                        ['i'=>'fa-fingerprint','c'=>'bi-amber','t'=>'AI Biometrics Added','d'=>'Face recognition + GPS tracking for staff attendance launched.'],
                        ['i'=>'fa-money-bill-wave','c'=>'bi-violet','t'=>'Payroll Module','d'=>'One-click payroll, digital payslips, and salary management rolled out.'],
                        ['i'=>'fa-book-reader','c'=>'bi-rose','t'=>'Library & Discipline','d'=>'Full digital library management and behavior tracking added natively.'],
                    ] as $ev)
                    <div class="d-flex gap-3 mb-4 {{ !$loop->last ? 'pb-4' : '' }}" style="{{ !$loop->last ? 'border-bottom:1px solid var(--border);' : '' }}">
                        <div style="width:40px;height:40px;border-radius:10px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:0.9rem;
                            {{ $ev['c'] === 'bi-blue' ? 'background:hsla(217,91%,60%,0.15);color:hsl(217,91%,70%);' : '' }}
                            {{ $ev['c'] === 'bi-teal' ? 'background:hsla(174,72%,56%,0.15);color:hsl(174,72%,60%);' : '' }}
                            {{ $ev['c'] === 'bi-amber' ? 'background:hsla(38,92%,50%,0.15);color:hsl(38,92%,60%);' : '' }}
                            {{ $ev['c'] === 'bi-violet' ? 'background:hsla(262,83%,58%,0.15);color:hsl(262,83%,70%);' : '' }}
                        "><i class="fas {{ $ev['i'] }}"></i></div>
                        <div>
                            <div style="font-size:0.88rem;font-weight: 500;color:#fff;margin-bottom:4px;">{{ $ev['t'] }}</div>
                            <div style="font-size:0.78rem;color:var(--muted);line-height:1.6;">{{ $ev['d'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section style="padding:0 0 90px;">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span style="display:block;font-size:0.72rem;font-weight: 500;text-transform:uppercase;letter-spacing:1.5px;color:var(--primary);margin-bottom:14px;">What We Stand For</span>
            <h2 style="font-size:clamp(2rem,3.5vw,2.8rem);font-weight: 500;letter-spacing:-1.5px;color:#fff;margin-bottom:0;">Our Core Values</h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['i'=>'fa-lightbulb','bg'=>'hsla(38,92%,50%,0.15)','c'=>'hsl(38,92%,60%)','t'=>'Innovation','d'=>'We push boundaries with AI biometrics, GPS tracking, and smart automation to constantly improve how institutes operate.'],
                ['i'=>'fa-shield-halved','bg'=>'hsla(217,91%,60%,0.15)','c'=>'hsl(217,91%,70%)','t'=>'Reliability','d'=>'99.9% uptime. Multi-tenant isolation. Your data is safe, separate, and always available when you need it.'],
                ['i'=>'fa-headset','bg'=>'hsla(174,72%,56%,0.15)','c'=>'hsl(174,72%,60%)','t'=>'Support','d'=>"We don't just sell you software. We walk with you — from onboarding to scaling — with 24/7 dedicated support."],
                ['i'=>'fa-lock','bg'=>'hsla(262,83%,58%,0.15)','c'=>'hsl(262,83%,70%)','t'=>'Security','d'=>'Data encrypted at rest and in transit. Multi-tenant architecture ensures no institute ever sees another\'s data.'],
            ] as $v)
            <div class="col-md-6 col-lg-3">
                <div class="val-card">
                    <div class="v-icon" style="background:{{ $v['bg'] }};color:{{ $v['c'] }};"><i class="fas {{ $v['i'] }}"></i></div>
                    <div class="v-title">{{ $v['t'] }}</div>
                    <div class="v-desc">{{ $v['d'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats-sec">
    <div class="container px-4">
        <div class="d-flex align-items-center justify-content-center gap-4 gap-md-5 flex-wrap text-center">
            <div class="big-stat"><div class="bs-val g-text">100<span>+</span></div><div class="bs-lbl">Institutes Onboarded</div></div>
            <div class="stat-div d-none d-md-block"></div>
            <div class="big-stat"><div class="bs-val g-text">50K<span>+</span></div><div class="bs-lbl">Students Managed</div></div>
            <div class="stat-div d-none d-md-block"></div>
            <div class="big-stat"><div class="bs-val g-text">99.9<span>%</span></div><div class="bs-lbl">Platform Uptime</div></div>
            <div class="stat-div d-none d-md-block"></div>
            <div class="big-stat"><div class="bs-val g-text">24/7</div><div class="bs-lbl">Support Available</div></div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-sec">
    <div class="container px-4">
        <div class="cta-box">
            <span style="display:inline-flex;align-items:center;gap:6px;background:hsla(174,72%,56%,0.1);border:1px solid hsla(174,72%,56%,0.22);border-radius:9999px;padding:4px 14px;font-size:0.72rem;font-weight:600;color:hsl(174,72%,70%);text-transform:uppercase;letter-spacing:1px;margin-bottom:22px;">
                <i class="fas fa-rocket"></i> Get Started
            </span>
            <h2 style="font-size:clamp(2rem,3.5vw,2.8rem);font-weight: 500;letter-spacing:-1.5px;color:#fff;margin-bottom:14px;">Join 100+ institutes<br>already using EduNex ERP.</h2>
            <p style="color:var(--muted);font-size:1rem;max-width:460px;margin:0 auto 32px;line-height:1.8;">Start your free trial today. No credit card, no setup fee, no commitments.</p>
            <div class="d-flex gap-3 flex-wrap justify-content-center">
                <a href="{{ route('pricing') }}" class="cta-btn">Start Free Trial <i class="fas fa-rocket"></i></a>
                <a href="{{ route('contact') }}" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.06);border:1px solid var(--border);color:#fff;text-decoration:none;padding:13px 28px;border-radius:10px;font-weight:600;font-size:0.95rem;transition:all 0.2s;">
                    Contact Us <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<x-frontend-footer/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@include('components.whatsapp-widget')
</body>
</html>