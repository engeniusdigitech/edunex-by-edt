<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo
        title="EduNex ERP | #1 School Management Software, School ERP & Institute Management System"
        description="EduNex ERP — India's #1 School Management Software & Institute ERP. Automates student attendance, online fee collection, school payroll, library, live lectures, and parent portal. Trusted by 100+ schools. Start free trial today."
        keywords="edunex, edunex erp, edunexerp, EduNex ERP, school management software, school erp, schoolerp, school software, school management system, institute erp, institute management software, coaching class software, coaching center software, training institute software, student management system, best school management software india, school administration software, school fee management software, online school fee collection, school attendance software, ai biometric attendance school, school payroll software, online school management system, cbse school management software, icse school erp, gujarat board school software, state board school erp, school management software vadodara, school erp gujarat, school erp ahmedabad, school erp india, coaching center management software, tuition class software, school management app, cloud school erp, saas school management, affordable school erp india, best school software 2024, school erp free trial, school software with whatsapp, school management system with parent app"
    />
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')

<style>
.hero-copy { margin-top: 0; }
@media(max-width:991px) {
    .hero-copy { margin-top: 0; }
}

/* ── Reset & Base ── */
*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
    font-family: 'Inter', system-ui, sans-serif;
    background: #F8FAFC;
    color: #0F172A;
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    line-height: 1.6;
}

/* ── Design Tokens — Light Theme ── */
:root {
    --bg:        #F8FAFC;
    --card-bg:   #FFFFFF;
    --border:    #E8EDF5;
    --card-border: #E8EDF5;
    --muted:     #64748B;
    --primary:   #0D9488;
    --secondary: #2563EB;
    --accent:    hsl(262, 83%, 58%);
    --foreground: #0F172A;
    --radius: 0.75rem;
    --glow-primary: 0 0 40px rgba(13,148,136, 0.15);
    --glow-secondary: 0 0 40px rgba(37,99,235, 0.15);
    --gradient-primary: linear-gradient(135deg, #0D9488, #2563EB);
    --gradient-secondary: linear-gradient(135deg, #2563EB, hsl(262,83%,58%));
    --shadow-card: 0 4px 20px -4px rgba(0,0,0,0.08);
    --shadow-elevated: 0 12px 40px -8px rgba(0,0,0,0.12);
    --dark: #F8FAFC;
}

/* ── Gradient Text ── */
.g-text {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.g-text-2 {
    background: linear-gradient(135deg, #7C3AED, #2563EB);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ── Shared ── */
.badge-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: #F0FDFA; border: 1px solid #99F6E4;
    color: #0D9488; border-radius: 9999px;
    font-size: 0.72rem; font-weight: 600; padding: 4px 14px;
    text-transform: uppercase; letter-spacing: 1px;
}
.badge-pill.blue {
    background: #EFF6FF; border-color: #BFDBFE;
    color: #2563EB;
}

.sec-eyebrow {
    display: block; font-size: 0.72rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1.5px;
    color: #0D9488; margin-bottom: 14px;
}
.sec-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700; letter-spacing: -1.5px;
    line-height: 1.1; margin-bottom: 18px;
    color: #0F172A;
}
.sec-desc {
    font-size: 1rem; color: #64748B;
    line-height: 1.85; max-width: 540px;
}

/* ── Buttons ── */
.btn-primary {
    background: var(--gradient-primary);
    color: #fff; border: none;
    padding: 13px 28px; border-radius: 10px;
    font-weight: 700; font-size: 0.9rem;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; transition: all 0.25s ease;
    box-shadow: 0 4px 16px rgba(13,148,136,0.25);
}
.btn-primary:hover { color: #fff; opacity: 0.92; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(13,148,136,0.35); }

.btn-outline {
    background: #fff;
    color: #374151; border: 1px solid #E2E8F0;
    padding: 13px 28px; border-radius: 10px;
    font-weight: 600; font-size: 0.9rem;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; transition: all 0.25s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.btn-outline:hover { color: #0D9488; border-color: #0D9488; background: #F0FDFA; }

/* ── Card base ── */
.card-glass {
    background: #fff;
    border: 1px solid #E8EDF5;
    border-radius: 12px;
    box-shadow: var(--shadow-card);
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.card-glass:hover {
    border-color: rgba(13,148,136,0.4);
    box-shadow: 0 8px 32px rgba(13,148,136,0.12);
    transform: translateY(-4px) scale(1.01);
}

/* ═══════════════════════════
   HERO — Dark Cinema Edition
═══════════════════════════ */
.hero {
    min-height: 100vh;
    background: linear-gradient(135deg, #050C1A 0%, #09152B 50%, #040C1C 100%);
    position: relative;
    overflow: hidden;
    display: flex; flex-direction: column;
}
/* Grid overlay */
.hero-grid {
    position: absolute; inset: 0; pointer-events: none; z-index: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.022) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.022) 1px, transparent 1px);
    background-size: 54px 54px;
}
/* Glowing orbs */
.hero-orb {
    position: absolute; border-radius: 50%;
    filter: blur(110px); pointer-events: none;
    animation: orb-drift 16s ease-in-out infinite;
}
.orb-teal   { width: 750px; height: 750px; background: rgba(13,148,136,0.26); top: -260px; left: -130px; }
.orb-blue   { width: 600px; height: 600px; background: rgba(37,99,235,0.20);  top: -80px;  right: -200px; animation-delay: -5s; }
.orb-violet { width: 480px; height: 480px; background: rgba(124,58,237,0.14); bottom: -120px; right: 12%; animation-delay: -10s; }
@keyframes orb-drift {
    0%,100% { transform: translate(0,0) scale(1); }
    33%  { transform: translate(40px,-30px) scale(1.06); }
    66%  { transform: translate(-25px,20px) scale(0.94); }
}
.hero-content {
    flex: 1; display: flex; align-items: center;
    padding: 190px 0 80px;
    position: relative; z-index: 2;
}
/* Trust kicker badge */
.hero-trust-kicker {
    display: inline-flex; align-items: center; gap: 9px;
    background: rgba(13,148,136,0.13);
    border: 1px solid rgba(52,211,153,0.28);
    border-radius: 9999px; padding: 7px 18px;
    font-size: 0.73rem; font-weight: 700; color: #34D399;
    margin-bottom: 26px; letter-spacing: 0.4px;
}
.hero-kicker-dot {
    width: 8px; height: 8px; background: #34D399; border-radius: 50%;
    box-shadow: 0 0 10px rgba(52,211,153,0.8);
    animation: kicker-pulse 2s ease-in-out infinite;
}
@keyframes kicker-pulse {
    0%,100% { opacity:1; box-shadow:0 0 10px rgba(52,211,153,0.8); }
    50% { opacity:0.5; box-shadow:0 0 3px rgba(52,211,153,0.3); }
}
.hero-h1 {
    font-size: clamp(2rem, 3.8vw, 3.6rem);
    font-weight: 500; letter-spacing: -1.5px;
    line-height: 1.1; margin-bottom: 20px; color: #FFFFFF;
}
.hero-h1 .hero-grad {
    background: linear-gradient(90deg, #34D399 0%, #60A5FA 55%, #A78BFA 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.hero-sub {
    font-size: 1.03rem; color: rgba(255,255,255,0.60);
    line-height: 1.85; margin-bottom: 26px; max-width: 480px;
}
.hero-features {
    display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 28px;
}
.hfeat {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.09);
    border-radius: 8px; padding: 5px 12px;
    font-size: 0.73rem; font-weight: 500; color: rgba(255,255,255,0.72);
    transition: all 0.2s ease; cursor: default;
}
.hfeat:hover { background: rgba(13,148,136,0.18); border-color: rgba(52,211,153,0.28); color: #fff; }
.hfeat i { color: #34D399; font-size: 0.68rem; }
/* CTA buttons */
.hero-cta-wrap { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 24px; }
.btn-hero-primary {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, #0D9488 0%, #1D4ED8 100%);
    color: #fff; text-decoration: none;
    padding: 14px 30px; border-radius: 12px;
    font-weight: 700; font-size: 0.95rem;
    transition: all 0.25s ease;
    box-shadow: 0 0 30px rgba(13,148,136,0.45), 0 4px 20px rgba(0,0,0,0.4);
}
.btn-hero-primary:hover { color:#fff; transform:translateY(-2px); box-shadow:0 0 44px rgba(13,148,136,0.65), 0 8px 28px rgba(0,0,0,0.5); }
.btn-hero-ghost {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.07);
    color: rgba(255,255,255,0.88); border: 1px solid rgba(255,255,255,0.15);
    padding: 14px 26px; border-radius: 12px;
    font-weight: 600; font-size: 0.95rem; text-decoration: none;
    transition: all 0.25s ease; backdrop-filter: blur(8px);
}
.btn-hero-ghost:hover { color:#fff; background:rgba(255,255,255,0.14); border-color:rgba(255,255,255,0.28); transform:translateY(-2px); }
/* Social proof */
.hero-social-row { display: flex; align-items: center; gap: 14px; font-size: 0.8rem; color: rgba(255,255,255,0.44); }
.hero-avatars { display: flex; }
.hero-avatar {
    width: 30px; height: 30px; border-radius: 50%;
    border: 2px solid rgba(13,148,136,0.65);
    margin-left: -9px; background: linear-gradient(135deg,#0D9488,#2563EB);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.58rem; font-weight: 800; color: #fff; flex-shrink: 0;
}
.hero-avatars .hero-avatar:first-child { margin-left: 0; }
/* Form column */
.hero-form-wrap { position: relative; }
/* Floating notification toasts */
.hero-notif {
    position: absolute;
    background: rgba(255,255,255,0.97);
    border-radius: 14px; padding: 11px 15px;
    display: flex; align-items: center; gap: 11px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.45), 0 0 0 1px rgba(255,255,255,0.12);
    min-width: 192px; z-index: 20; font-size: 0.75rem;
    animation: hero-notif-float 5s ease-in-out infinite;
    pointer-events: none;
}
.hero-notif-1 { top: 7%;  right: -18px; }
.hero-notif-2 { bottom: 9%; left: -22px; animation-delay: -2.5s; }
@keyframes hero-notif-float { 0%,100% { transform:translateY(0); } 50% { transform:translateY(-7px); } }
.hero-notif-icon {
    width: 34px; height: 34px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.88rem; flex-shrink: 0;
}
.hero-notif-title { font-weight: 700; color: #0F172A; line-height: 1.2; font-size: 0.75rem; }
.hero-notif-sub { color: #64748B; font-size: 0.66rem; margin-top: 1px; }

/* Hero dashboard mockup */
.hero-img-wrap {
    position: relative;
}
.hero-screen {
    width: 100%; border-radius: 16px;
    border: 1px solid #E2E8F0;
    box-shadow: var(--shadow-elevated), 0 0 0 1px rgba(0,0,0,0.02);
}
/* Floating notification cards */
.notif-card {
    position: absolute;
    background: #fff;
    border: 1px solid #E8EDF5;
    border-radius: 12px; padding: 12px 16px;
    display: flex; align-items: center; gap: 10px;
    animation: notif-float 4s ease-in-out infinite;
    min-width: 200px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.10);
}
.notif-1 { top: 12%; right: -20px; }
.notif-2 { bottom: 16%; left: -20px; animation-delay: 1.8s; }
@keyframes notif-float {
    0%,100% { transform: translateY(0px); }
    50%      { transform: translateY(-8px); }
}
.notif-icon {
    width: 36px; height: 36px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.95rem; flex-shrink: 0;
}
/* Portal Mockup Display */
.portal-display { position: relative; z-index: 10; margin-top: 2rem; width: 100%; }
.portal-tabs { display: flex; gap: 12px; justify-content: center; margin-bottom: 24px; }
.portal-tab-btn {
    background: #F8FAFC; border: 1px solid #E2E8F0;
    color: #64748B; padding: 8px 24px; border-radius: 30px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease;
}
.portal-tab-btn:hover { background: #F0FDFA; color: #0D9488; border-color: #99F6E4; }
.portal-tab-btn.active {
    background: #F0FDFA; color: #0D9488; border-color: #0D9488; box-shadow: 0 0 16px rgba(13,148,136,0.15);
}
.portal-content { display: none; animation: fadeIn 0.5s ease; }
.portal-content.active { display: block; }
.display-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 0;
    padding-right: 8%;
}
.desktop-mockup {
    width: 100%; display: block; border-radius: 12px; border: 1px solid #E2E8F0;
    box-shadow: 0 20px 40px rgba(0,0,0,0.10), 0 0 0 1px rgba(0,0,0,0.02);
}
.mobile-mockup {
    position: absolute; bottom: -6%; right: -4%; width: 26%; border-radius: 14px; border: 3px solid #1a1a1a;
    box-shadow: 0 15px 30px rgba(0,0,0,0.6); background: #000; overflow: hidden;
}
.mobile-mockup img { width: 100%; display: block; border-radius: 11px; }
.portal-text { text-align: center; margin-top: 1.5rem; }
.portal-text h3 { font-size: 1.35rem; color: #0F172A; font-weight: 700; margin-bottom: 0.5rem; letter-spacing: -0.5px; }
.portal-text p { font-size: 0.95rem; color: #64748B; line-height: 1.7; max-width: 400px; margin: 0 auto; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

/* Stats strip */
.stats-strip {
    background: #fff;
    border-top: 1px solid #E8EDF5;
    border-bottom: 1px solid #E8EDF5;
    padding: 36px 0;
}
.stat-val  { font-size: 2rem; font-weight: 600; letter-spacing: -1.5px; line-height: 1; }
.stat-lbl  { font-size: 0.72rem; color: #94A3B8; font-weight: 400; margin-top: 5px; text-transform: uppercase; letter-spacing: 0.6px; }
.stat-pipe { width: 1px; height: 36px; background: #E2E8F0; }

/* ═══════════════════════════
   FEATURES (light)
═══════════════════════════ */
.feat-section {
    background: #F8FAFC;
    padding: 100px 0;
    border-top: 1px solid #E8EDF5;
}

/* Feature magazine grid */
.feat-magazine { display: grid; grid-template-columns: 1fr 1fr 1fr; grid-template-rows: auto auto; gap: 14px; }
.feat-hero { grid-column: span 2; grid-row: span 2; }
@media(max-width:991px) { .feat-magazine { grid-template-columns: 1fr 1fr; } .feat-hero { grid-column: span 2; grid-row: span 1; } }
@media(max-width:640px)  { .feat-magazine { grid-template-columns: 1fr; } .feat-hero { grid-column: span 1; } }

.feat-card {
    background: #fff;
    border: 1px solid #E8EDF5;
    border-radius: 16px; padding: 26px;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    position: relative; overflow: hidden; height: 100%;
    box-shadow: 0 2px 12px -4px rgba(0,0,0,0.06);
}
.feat-card.is-hero { padding: 36px; }
.feat-card::after {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: var(--gradient-primary); opacity: 0; transition: opacity 0.3s;
    border-radius: 16px 16px 0 0;
}
.feat-card:hover { border-color: rgba(13,148,136,0.3); box-shadow: 0 8px 32px rgba(13,148,136,0.1); transform: translateY(-3px); }
.feat-card:hover::after { opacity: 1; }
.feat-icon-wrap { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 20px; }
.feat-hero .feat-icon-wrap { width: 60px; height: 60px; font-size: 1.5rem; margin-bottom: 24px; }
.feat-name { font-size: 0.92rem; font-weight: 700; color: #0F172A; margin-bottom: 7px; letter-spacing: -0.3px; }
.feat-hero .feat-name { font-size: 1.35rem; letter-spacing: -0.8px; margin-bottom: 12px; }
.feat-desc { font-size: 0.82rem; color: #64748B; line-height: 1.75; }
.feat-hero .feat-desc { font-size: 0.95rem; line-height: 1.85; max-width: 420px; }
.feat-hero-chips { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 24px; }
.feat-chip { display: inline-flex; align-items: center; gap: 6px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 5px 12px; font-size: 0.72rem; font-weight: 600; color: #475569; }
.feat-chip i { color: #0D9488; font-size: 0.65rem; }
/* How it works - big number style */
.how-step { position: relative; padding: 40px 32px; }
.how-step-num {
    font-size: 7rem; font-weight: 900; line-height: 1;
    color: rgba(0,0,0,0.04); letter-spacing: -4px;
    position: absolute; top: 10px; right: 20px; pointer-events: none;
    font-variant-numeric: tabular-nums;
}
.how-step-inner { position: relative; z-index: 2; }
.how-step-badge {
    display: inline-flex; align-items: center; justify-content: center;
    width: 36px; height: 36px; border-radius: 10px;
    background: var(--gradient-primary); color: #fff;
    font-weight: 700; font-size: 0.85rem; margin-bottom: 18px;
}
.how-step-arrow {
    position: absolute; right: -8px; top: 50%; transform: translateY(-50%);
    font-size: 1.1rem; color: hsla(174,72%,56%,0.3);
    z-index: 3;
}
@media(max-width:767px) { .how-step-arrow { display: none; } .how-step-num { font-size: 5rem; } }
.how-step-t { font-size: 1rem; font-weight: 700; color: #0F172A; margin-bottom: 8px; }
.how-step-d { font-size: 0.82rem; color: #64748B; line-height: 1.75; }
/* Why EduNex ERP - before/after */
.why-split { display: grid; grid-template-columns: 1fr 1fr; gap: 0; border: 1px solid #E8EDF5; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px -4px rgba(0,0,0,0.08); }
@media(max-width:767px) { .why-split { grid-template-columns: 1fr; } }
.why-before { background: #FEF9F9; border-right: 1px solid #E8EDF5; padding: 36px; }
.why-after  { background: #F0FDFA; padding: 36px; }
.why-label {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;
    border-radius: 7px; padding: 5px 12px; margin-bottom: 24px;
}
.why-label.before { background: #FEE2E2; color: #DC2626; border: 1px solid #FECACA; }
.why-label.after  { background: #CCFBF1; color: #0D9488; border: 1px solid #99F6E4; }
.why-row { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 16px; }
.why-row:last-child { margin-bottom: 0; }
.why-icon-x { width: 28px; height: 28px; border-radius: 7px; background: #FEE2E2; color: #EF4444; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0; margin-top: 2px; }
.why-icon-c { width: 28px; height: 28px; border-radius: 7px; background: #CCFBF1; color: #0D9488; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0; margin-top: 2px; }
.why-text { font-size: 0.88rem; color: #64748B; line-height: 1.6; }
.why-text strong { color: #0F172A; font-weight: 700; }
.why-divider { display: flex; align-items: center; justify-content: center; background: var(--card-border); width: 1px; position: relative; }
.why-vs {
    position: absolute; width: 44px; height: 44px; border-radius: 50%;
    background: var(--card-bg); border: 1px solid var(--card-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem; font-weight: 500; color: var(--muted);
}

/* ═══════════════════════════
   STAFF SECTION (light)
═══════════════════════════ */
.staff-section {
    background: #fff;
    padding: 100px 0;
    position: relative; overflow: hidden;
    border-top: 1px solid #E8EDF5;
}
.staff-blob-1 {
    position:absolute; width:500px; height:500px; border-radius:50%;
    background:rgba(37,99,235,0.05); filter:blur(80px);
    top:-100px; right:-100px; pointer-events:none;
}
.staff-blob-2 {
    position:absolute; width:400px; height:400px; border-radius:50%;
    background:rgba(13,148,136,0.05); filter:blur(80px);
    bottom:-80px; left:-80px; pointer-events:none;
}

/* Bento grid */
.bento { display: grid; grid-template-columns: repeat(12,1fr); gap: 12px; }
.b7  { grid-column: span 7; }
.b5  { grid-column: span 5; }
.b4  { grid-column: span 4; }
.b8  { grid-column: span 8; }
.b12 { grid-column: span 12; }
@media(max-width:991px) { .b7,.b5,.b4,.b8,.b12 { grid-column: span 12 !important; } }

.bcard {
    background: #fff;
    border: 1px solid #E8EDF5;
    border-radius: 16px; padding: 28px;
    position: relative; overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    box-shadow: 0 2px 12px -4px rgba(0,0,0,0.06);
}
.bcard:hover {
    border-color: rgba(13,148,136,0.3);
    box-shadow: 0 8px 32px rgba(13,148,136,0.1);
    transform: translateY(-2px);
}
.bcard-title { font-size: 1rem; font-weight: 700; color: #0F172A; margin-bottom: 8px; letter-spacing: -0.3px; }
.bcard-desc  { font-size: 0.83rem; color: #64748B; line-height: 1.75; }
.bicon {
    width: 44px; height: 44px; border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; margin-bottom: 16px;
}
.bi-teal   { background:#F0FDFA; color:#0D9488; }
.bi-blue   { background:#EFF6FF; color:#2563EB; }
.bi-amber  { background:#FFFBEB; color:#D97706; }
.bi-violet { background:#F5F3FF; color:#7C3AED; }
.bi-rose   { background:#FFF1F2; color:#E11D48; }

/* mini tag inside bcard */
.mtag {
    display:inline-flex; align-items:center; gap:4px;
    background:#F8FAFC; border:1px solid #E2E8F0;
    border-radius:6px; padding:3px 9px; font-size:0.68rem; font-weight:600; color:#475569;
    margin:3px 2px 0 0;
}

/* Face scan widget */
.scan-widget {
    background: #EFF6FF;
    border: 1px solid #BFDBFE;
    border-radius: 12px; padding: 14px 16px; margin-top: 18px;
    display: flex; align-items: center; gap: 14px;
}
.scan-avatar {
    width: 48px; height: 48px; border-radius: 50%;
    background: linear-gradient(135deg, #2563EB, #0D9488);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.3rem; flex-shrink: 0; position: relative;
}
.scan-avatar::after {
    content:''; position:absolute; inset:-5px; border-radius:50%;
    border: 1.5px dashed hsla(217,91%,60%,0.5);
    animation: spin 8s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }
.scan-bars { flex: 1; }
.sbar { height: 4px; background: hsla(217,91%,60%,0.1); border-radius: 9999px; margin-bottom: 5px; overflow: hidden; }
.sbar-fill { height: 100%; background: var(--gradient-primary); border-radius: 9999px; animation: scanfill 2.5s ease-in-out infinite; }
.sbar-fill.d1 { animation-delay: 0.3s; }
.sbar-fill.d2 { animation-delay: 0.6s; }
@keyframes scanfill { 0%{width:0%} 70%{width:85%} 100%{width:85%;opacity:0.3} }
.scan-ok { font-size: 0.7rem; font-weight: 700; color: #0D9488; margin-top: 6px; }

/* GPS widget */
.gps-widget {
    background: #F0FDFA;
    border: 1px solid #99F6E4;
    border-radius: 12px; padding: 12px 14px; margin-top: 16px;
    display: flex; align-items: center; gap: 10px;
}
.gps-dot { width: 9px; height: 9px; border-radius: 50%; background: #0D9488; flex-shrink: 0; position: relative; }
.gps-dot::after {
    content:''; position:absolute; inset:-4px; border-radius:50%;
    background: transparent; border: 1.5px solid hsla(174,72%,56%,0.35);
    animation: ping 1.5s cubic-bezier(0,0,0.2,1) infinite;
}
@keyframes ping { 75%,100%{transform:scale(2);opacity:0} }

/* Mini bar chart */
.mini-bars { display:flex; align-items:flex-end; gap:4px; height:52px; margin-top:16px; }
.mbar { flex:1; border-radius:4px 4px 0 0; background:#E2E8F0; }
.mbar.hi { background: var(--gradient-primary); }

/* Salary slip */
.slip { border: 1px solid #E8EDF5; border-radius: 10px; overflow: hidden; margin-top: 14px; }
.slip-row { display:flex; justify-content:space-between; align-items:center; padding:8px 14px; border-bottom: 1px solid #F1F5F9; font-size: 0.78rem; }
.slip-row:last-child { border: none; background: #F0FDFA; }
.sl { color: #64748B; }
.sv { font-weight: 600; color: #0F172A; }
.sv.g { color: #0D9488; }
.sv.r { color: #EF4444; }

/* ═══════════════════════════
   HOW IT WORKS (light)
═══════════════════════════ */
.how-section {
    background: #F8FAFC;
    padding: 100px 0;
    border-top: 1px solid #E8EDF5;
}

.step-card {
    background: #fff;
    border: 1px solid #E8EDF5;
    border-radius: 14px; padding: 28px; height: 100%;
    transition: all 0.25s ease;
    box-shadow: 0 2px 12px -4px rgba(0,0,0,0.06);
}
.step-card:hover { border-color: rgba(13,148,136,0.4); box-shadow: 0 8px 24px rgba(13,148,136,0.1); transform: translateY(-3px); }
.step-num {
    width: 40px; height: 40px; border-radius: 50%;
    background: var(--gradient-primary); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.9rem; margin-bottom: 16px;
}
.step-t { font-size: 0.95rem; font-weight: 700; color: #0F172A; margin-bottom: 6px; }
.step-d { font-size: 0.83rem; color: #64748B; line-height: 1.75; }

/* ═══════════════════════════
   SOCIAL PROOF / USE CASES (light)
═══════════════════════════ */
.proof-section { background: #fff; padding: 90px 0; border-top: 1px solid #E8EDF5; }
.uc-chip {
    display: inline-flex; align-items: center; gap: 8px;
    background: #F8FAFC; border: 1px solid #E2E8F0;
    border-radius: 10px; padding: 12px 20px;
    font-size: 0.85rem; font-weight: 600; color: #475569;
    transition: all 0.2s ease; text-decoration: none;
}
.uc-chip:hover { border-color: #0D9488; color: #0D9488; background: #F0FDFA; }
.uc-chip i { color: #0D9488; }

/* ═══════════════════════════
   TESTIMONIALS (light)
═══════════════════════════ */
.testi-section { background: #F8FAFC; padding: 90px 0; border-top: 1px solid #E8EDF5; }
.t-card {
    background: #fff; border: 1px solid #E8EDF5;
    border-radius: 16px; padding: 28px; height: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 2px 12px -4px rgba(0,0,0,0.06);
}
.t-card:hover { border-color: rgba(13,148,136,0.3); box-shadow: 0 8px 28px rgba(13,148,136,0.09); transform: translateY(-2px); }
.t-stars { color: #F59E0B; font-size: 0.85rem; margin-bottom: 14px; }
.t-quote { font-size: 0.88rem; color: #475569; line-height: 1.85; margin-bottom: 20px; font-style: italic; }
.t-name  { font-size: 0.85rem; font-weight: 700; color: #0F172A; }
.t-role  { font-size: 0.73rem; color: #94A3B8; margin-top: 2px; }
.t-av {
    width: 40px; height: 40px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 500; font-size: 0.8rem; color: hsl(222,47%,6%); flex-shrink: 0;
}

/* ═══════════════════════════
   COMPARISON (light)
═══════════════════════════ */
.compare-section { background: #fff; padding: 90px 0; border-top: 1px solid #E8EDF5; }
.ctable { border: 1px solid #E8EDF5; border-radius: 14px; overflow: hidden; box-shadow: 0 2px 12px -4px rgba(0,0,0,0.06); }
.ctable table { margin: 0; }
.ctable thead { background: #F8FAFC; }
.ctable thead th { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; padding: 16px 20px; border: none; color: #94A3B8; }
.ctable tbody tr { border-color: #F1F5F9 !important; }
.ctable tbody td { padding: 13px 20px; font-size: 0.88rem; font-weight: 500; color: #374151; background: #fff; }
.ctable tbody tr:hover td { background: #F8FAFC; }

/* ═══════════════════════════
   FAQ (light)
═══════════════════════════ */
.faq-section { background: #F8FAFC; padding: 90px 0; border-top: 1px solid #E8EDF5; }
.faq-item {
    border: 1px solid #E8EDF5; border-radius: 12px;
    overflow: hidden; margin-bottom: 10px;
    transition: border-color 0.2s ease;
    background: #fff;
    box-shadow: 0 1px 6px -2px rgba(0,0,0,0.05);
}
.faq-item:hover { border-color: rgba(13,148,136,0.3); }
.accordion-button {
    background: #fff !important; color: #0F172A !important;
    font-weight: 700; font-size: 0.9rem;
    padding: 18px 22px;
    box-shadow: none !important;
}
.accordion-button:not(.collapsed) { color: #0D9488 !important; background: #F0FDFA !important; }
.accordion-body {
    background: #fff; color: #64748B;
    font-size: 0.87rem; line-height: 1.85;
    padding: 0 22px 20px; border-top: 1px solid #F1F5F9;
}

/* ═══════════════════════════
   CTA FINAL
═══════════════════════════ */
.cta-section { background: #F8FAFC; padding: 100px 0; border-top: 1px solid #E8EDF5; }
.cta-box {
    border-radius: 24px; padding: 70px 50px; text-align: center;
    position: relative; overflow: hidden;
    background: linear-gradient(135deg, #0D9488 0%, #2563EB 100%);
    border: none;
}
.cta-box::before {
    content: ''; position: absolute; top: -200px; left: 50%;
    transform: translateX(-50%); width: 700px; height: 400px;
    background: radial-gradient(ellipse, rgba(255,255,255,0.1) 0%, transparent 70%);
    pointer-events: none;
}
.cta-box h2 { font-size: clamp(1.8rem,3.5vw,2.8rem); font-weight: 800; letter-spacing:-1.5px; color: #fff; margin-bottom: 14px; }
.cta-box p  { color: rgba(255,255,255,0.85); font-size: 1rem; max-width: 480px; margin: 0 auto 36px; line-height: 1.8; }
.trust-item { font-size: 0.78rem; color: rgba(255,255,255,0.8); display: inline-flex; align-items: center; gap: 5px; }
.trust-item i { color: rgba(255,255,255,0.9); }

@media(max-width:991px) {
    .hero-content { padding: 170px 0 40px; }
    .display-wrapper { padding-bottom: 0; }
    .mobile-mockup { display: none; }
    .desktop-mockup { border-radius: 10px; }
}

@media(max-width:768px) {
    .hero { min-height: auto; }
    .hero-content { padding: 180px 0 50px; }
    .hero-h1, .hero-h2 { font-size: clamp(1.9rem, 7vw, 2.4rem) !important; letter-spacing: -1px; line-height: 1.2; margin-bottom: 14px; }
    .hero-sub { font-size: 0.92rem; margin-bottom: 20px; max-width: 100%; line-height: 1.7; }
    .hero-trust-kicker { font-size: 0.68rem; padding: 5px 14px; margin-bottom: 18px; }
    .hero-features { display: grid; grid-template-columns: 1fr 1fr; gap: 6px; margin-bottom: 20px; }
    .hfeat { font-size: 0.7rem; padding: 5px 10px; justify-content: center; }
    .hfeat i { font-size: 0.65rem; }
    .hero-notif { display: none; }
    .hero-cta-wrap { flex-direction: column; gap: 10px; }
    .btn-hero-primary,
    .btn-hero-ghost { width: 100%; justify-content: center; font-size: 0.9rem; padding: 13px 20px; }
    .notif-card { display: none; }
    .cta-box { padding: 44px 24px; }
    .feat-grid { grid-template-columns: 1fr; }
    .portal-tabs { gap: 8px; margin-bottom: 16px; flex-wrap: wrap; justify-content: center; }
    .portal-tab-btn { font-size: 0.75rem; padding: 6px 16px; }
    .portal-display { margin-top: 28px; }
    .portal-text h3 { font-size: 1.1rem; }
    .portal-text p { font-size: 0.83rem; }
    .stats-strip { padding: 24px 0; }
    .stat-val { font-size: 1.6rem; }
    .stat-lbl { font-size: 0.65rem; margin-top: 2px; }
}

@media(max-width:480px) {
    .hero-content { padding: 170px 0 28px; }
    .hero-h1, .hero-h2 { font-size: 1.75rem !important; margin-bottom: 12px; }
    .hero-sub { font-size: 0.88rem; margin-bottom: 16px; }
    .stat-pipe { display: none; }
}

/* ── Hero Contact Form ── */
.hero-form-card {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 40px 90px -12px rgba(0,0,0,0.65), 0 0 0 1px rgba(255,255,255,0.10);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
    position: relative;
}
.hero-form-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 1px; z-index: 1;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.22), transparent);
    pointer-events: none;
}
.hero-form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 55px 110px -12px rgba(0,0,0,0.75), 0 0 0 1px rgba(255,255,255,0.14), 0 0 60px rgba(13,148,136,0.12);
}
.hf-head {
    background: linear-gradient(135deg, #0D9488 0%, #1D4ED8 100%);
    padding: 24px 28px 20px;
}
.hf-head-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.2);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 500;
    padding: 4px 12px;
    border-radius: 20px;
    margin-bottom: 10px;
    letter-spacing: 0.3px;
}
.hf-head-title {
    font-size: 1.25rem;
    font-weight: 500;
    color: #fff;
    letter-spacing: -0.5px;
    margin: 0 0 4px;
    line-height: 1.3;
}
.hf-head-sub {
    font-size: 0.76rem;
    color: rgba(255,255,255,0.72);
    margin: 0;
}
.hf-body {
    background: #fff;
    padding: 24px 28px 20px;
}
.hf-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.hf-group { margin-bottom: 14px; }
.hf-lbl {
    display: block;
    font-size: 0.69rem;
    font-weight: 500;
    color: #64748B;
    margin-bottom: 5px;
}
.hf-inp-wrap { position: relative; }
.hf-ico {
    position: absolute;
    left: 11px;
    top: 50%;
    transform: translateY(-50%);
    color: #94A3B8;
    font-size: 0.75rem;
    pointer-events: none;
    z-index: 1;
}
.hf-inp-wrap input,
.hf-inp-wrap textarea,
.hf-inp-wrap select {
    width: 100%;
    padding: 10px 12px 10px 32px;
    border: 1.5px solid #E2E8F0;
    border-radius: 10px;
    font-size: 0.84rem;
    color: #0F172A;
    background: #F8FAFC;
    font-family: inherit;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    appearance: none;
}
.hf-inp-wrap textarea {
    padding-top: 10px;
    resize: none;
    min-height: 82px;
    line-height: 1.5;
}
.hf-inp-wrap input:focus,
.hf-inp-wrap textarea:focus,
.hf-inp-wrap select:focus {
    border-color: #0D9488;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(13,148,136,0.1);
}
.hf-inp-wrap input::placeholder,
.hf-inp-wrap textarea::placeholder { color: #CBD5E1; }
.hf-submit {
    width: 100%;
    padding: 13px 20px;
    background: linear-gradient(135deg, #0D9488, #1D4ED8);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: inherit;
    transition: opacity 0.2s, transform 0.15s;
    margin-bottom: 14px;
    letter-spacing: -0.2px;
}
.hf-submit:hover { opacity: 0.88; transform: translateY(-1px); }
.hf-submit:active { transform: translateY(0); }
.hf-submit:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
.hf-trust {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
    padding-top: 12px;
    border-top: 1px solid #F1F5F9;
}
.hf-trust-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.69rem;
    color: #94A3B8;
}
.hf-trust-item i { color: #0D9488; font-size: 0.7rem; }
.hf-success-wrap {
    text-align: center;
    padding: 28px 12px;
}
.hf-success-icon {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    background: #F0FDF9;
    border: 2px solid #99F6E4;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    color: #0D9488;
    margin: 0 auto 16px;
}
.hf-success-wrap h3 {
    font-size: 1.15rem;
    font-weight: 500;
    color: #0F172A;
    letter-spacing: -0.4px;
    margin: 0 0 8px;
}
.hf-success-wrap p {
    font-size: 0.83rem;
    color: #475569;
    line-height: 1.7;
    margin: 0 0 20px;
}

@media(max-width:768px) {
    .hf-head, .hf-body { padding-left: 20px; padding-right: 20px; }
    .hf-row { grid-template-columns: 1fr; }
}

/* ===========================================
   MOBILE RESPONSIVE FIXES — Welcome Page
=========================================== */

@media(max-width:991px) {
    #dashboard img,
    #mobile-app img { max-width: 100% !important; }
    #dashboard .col-lg-6.text-center > div,
    #mobile-app .col-lg-6.text-center > div { width: 100%; }
    #staff .col-lg-5 { justify-content: flex-start !important; }
}

@media(max-width:768px) {
    .staff-section  { padding: 56px 0; }
    .feat-section   { padding: 56px 0; }
    .how-section    { padding: 56px 0; }
    .proof-section  { padding: 56px 0; }
    .compare-section{ padding: 56px 0; }
    .testi-section  { padding: 56px 0; }
    .faq-section    { padding: 56px 0; }
    .cta-section    { padding: 56px 0; }
    .sec-title { font-size: clamp(1.6rem, 6vw, 2.2rem); letter-spacing: -1px; }
    .sec-desc  { font-size: 0.9rem; }
    .hero-social-row { flex-direction: column; align-items: flex-start; gap: 8px; }
    .stats-strip { padding: 20px 0; }
    .stats-strip .d-flex { gap: 16px 24px !important; }
    .stat-val { font-size: 1.5rem; }
    .ftab-nav { gap: 6px; margin-bottom: 32px; }
    .ftab-btn { font-size: 0.74rem; padding: 8px 14px; gap: 6px; }
    .ftab-btn i { font-size: 0.78rem; }
    .fspot-left { padding: 24px 18px !important; }
    .fspot-row  { padding: 14px 12px; }
    .ai-flow-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 8px; }
    .ai-flow-scroll svg { min-width: 680px; }
    .bcard { padding: 20px 16px; }
    .bcard-title { font-size: 0.9rem; }
    #staff .bcard.b12 .col-lg-4 { margin-bottom: 12px; }
    #staff .bcard.b12 .col-lg-4:last-child { margin-bottom: 0; }
    .dash-sidebar { display: none !important; }
    .dash-main-area { grid-column: 1 / -1 !important; }
    .dash-outer-grid { grid-template-columns: 1fr !important; }
    .dash-kpi-grid { grid-template-columns: 1fr 1fr !important; gap: 8px !important; }
    .dash-charts-grid { grid-template-columns: 1fr !important; }
    .why-before, .why-after { padding: 28px 20px; }
    .t-card { padding: 22px 18px; }
    .cta-box { padding: 40px 20px !important; }
    .cta-box h2 { font-size: clamp(1.5rem, 6vw, 2.2rem); }
    .cta-box p { font-size: 0.9rem; margin-bottom: 24px; }
    .cta-box .d-flex.gap-3 { flex-direction: column; align-items: stretch; }
    .cta-box .d-flex.gap-3 a { width: 100%; justify-content: center; }
    .cta-box .d-flex.gap-4 { gap: 10px 20px !important; justify-content: center; }
    .accordion-button { font-size: 0.84rem; padding: 14px 16px; }
    .accordion-body { padding: 0 16px 16px; font-size: 0.84rem; }
    .ctable { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .ctable table { min-width: 480px; }
    .city-seo-section { padding: 32px 0 !important; }
}

@media(max-width:576px) {
    .hero-form-card { border-radius: 14px; }
    .hf-head { padding: 18px 16px 14px; }
    .hf-body { padding: 16px 16px 14px; }
    .hf-head-title { font-size: 1.1rem; }
    .stats-strip .d-flex { display: grid !important; grid-template-columns: 1fr 1fr; gap: 16px !important; text-align: center; }
    .stat-pipe { display: none; }
    .stat-val { font-size: 1.8rem; }
    .ftab-nav { display: grid; grid-template-columns: 1fr 1fr; }
    .ftab-btn { justify-content: center; }
    .proof-section .d-flex { display: grid !important; grid-template-columns: 1fr 1fr; gap: 10px; }
    .uc-chip { justify-content: center; }
    #dashboard img { max-width: 100% !important; border-radius: 10px; }
    #mobile-app img { max-width: 200px !important; }
    .trust-item { font-size: 0.73rem; }
    #staff .col-lg-5.d-flex { flex-direction: column !important; align-items: flex-start !important; }
    #staff .col-lg-5 .btn-primary, #staff .col-lg-5 .btn-outline { width: 100%; justify-content: center; }
    .bento { grid-template-columns: 1fr !important; }
    .b4, .b5, .b7, .b8, .b12 { grid-column: span 1 !important; }
}

@media(max-width:400px) {
    .hero-h1 { font-size: 1.6rem !important; }
    .hero-features { grid-template-columns: 1fr !important; }
    .hfeat { justify-content: flex-start; }
    .stat-val { font-size: 1.5rem; }
    .ftab-nav { grid-template-columns: 1fr; }
    .proof-section .d-flex { grid-template-columns: 1fr !important; }
}

/* Mobile vertical timeline responsive styles */
.timeline-mobile {
    display: none;
    flex-direction: column;
    gap: 12px;
    align-items: center;
    max-width: 480px;
    margin: 0 auto;
    padding: 16px 8px;
}
.mobile-time-step {
    display: flex;
    align-items: center;
    gap: 16px;
    width: 100%;
    background: var(--step-bg);
    border: 1px solid var(--step-border);
    border-radius: 16px;
    padding: 16px 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    text-align: left;
}
.mts-num {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #FFF;
    border: 2px solid var(--step-color);
    color: var(--step-color);
    font-size: 1.15rem;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}
.mts-content {
    flex: 1;
}
.mts-tag {
    display: inline-block;
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--step-color);
    margin-bottom: 2px;
}
.mts-title {
    font-size: 0.95rem;
    font-weight: 800;
    color: #0F172A;
    margin: 0 0 2px;
}
.mts-desc {
    font-size: 0.8rem;
    color: #64748B;
    margin: 0;
    line-height: 1.4;
}
.mobile-time-arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    color: var(--step-color);
    margin: -4px 0;
    opacity: 0.7;
    animation: bounce-arrow 2s infinite;
}
@keyframes bounce-arrow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(3px); }
}

@media(max-width: 767px) {
    .timeline-desktop {
        display: none !important;
    }
    .timeline-mobile {
        display: flex !important;
    }
}
</style>

<!-- FAQPage Schema — 20 comprehensive Q&As for rich results -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    {
      "@@type": "Question",
      "name": "What is EduNex ERP?",
      "acceptedAnswer": { "@@type": "Answer", "text": "EduNex ERP is India's #1 School Management Software and Institute ERP, built by Engenius Digitech. It automates student attendance using AI face recognition, online fee collection, school payroll, library management, live video lectures, and provides a mobile app for students and parents. Trusted by 100+ schools, coaching institutes, and colleges." }
    },
    {
      "@@type": "Question",
      "name": "Who makes EduNex ERP?",
      "acceptedAnswer": { "@@type": "Answer", "text": "EduNex ERP is developed and maintained by Engenius Digitech, a technology company based in Vadodara, Gujarat, India. The product is purpose-built for schools, coaching institutes, and educational organisations across India and globally." }
    },
    {
      "@@type": "Question",
      "name": "What does EduNex ERP stand for?",
      "acceptedAnswer": { "@@type": "Answer", "text": "EduNex ERP stands for Education Nexus Enterprise Resource Planning — a complete, AI-powered school and institute management platform that connects student management, fees, attendance, payroll, library, live lectures, and parent communication in one unified system." }
    },
    {
      "@@type": "Question",
      "name": "Is EduNex ERP suitable for CBSE, ICSE, and State Board schools?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. EduNex ERP is fully compatible with CBSE, ICSE, Gujarat Board, Rajasthan Board, Maharashtra Board, and all State Board schools across India. The academic management, timetable, and report card modules are flexible enough to match any board's curriculum structure." }
    },
    {
      "@@type": "Question",
      "name": "How does AI face biometric attendance work in EduNex ERP?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Staff and students open the EduNex ERP dashboard on any device with a camera. The on-device AI scans their face and matches it against their enrolled biometric descriptor. GPS location is also verified simultaneously. Attendance is marked in under 2 seconds — no dedicated biometric hardware, fingerprint scanner, or internet connection is required for the face scan itself." }
    },
    {
      "@@type": "Question",
      "name": "How does online fee collection work in EduNex ERP?",
      "acceptedAnswer": { "@@type": "Answer", "text": "EduNex ERP integrates with Razorpay (India) and Stripe (global) to enable secure online fee collection. Parents receive a fee invoice directly on WhatsApp or SMS with a payment link. They can pay via UPI, Net Banking, Debit Card, Credit Card, or Wallet. The receipt is generated instantly and the school's accounts are updated in real-time." }
    },
    {
      "@@type": "Question",
      "name": "Can EduNex ERP be used for coaching centres and tuition classes?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. EduNex ERP is widely used by coaching centers, tuition classes, skill institutes, and training academies. Features like batch management, online fee collection, WhatsApp updates, live lectures, homework, and online tests are especially popular with coaching centres. It is one of the best coaching centre management software options available." }
    },
    {
      "@@type": "Question",
      "name": "Is there a free trial for EduNex ERP?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes! EduNex ERP offers a 7-day free trial with full access to all features and modules. No credit card required. Your institute can go live in under 15 minutes. Visit the pricing page at edunexerp.online/pricing to start your free trial today." }
    },
    {
      "@@type": "Question",
      "name": "How much does school management software cost?",
      "acceptedAnswer": { "@@type": "Answer", "text": "EduNex ERP offers affordable pricing plans starting from a free 7-day trial. Paid plans are available on a monthly or annual subscription basis with pricing tailored to the size of your institute. There are no hidden fees or per-student charges. Visit the pricing page on edunexerp.online for the latest pricing." }
    },
    {
      "@@type": "Question",
      "name": "Is EduNex ERP cloud-based?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. EduNex ERP is a fully cloud-based SaaS school management system. All your data is securely stored in the cloud with 99.9% uptime. You do not need to install any software or maintain any servers. Access the ERP from any web browser on any device — PC, tablet, or smartphone." }
    },
    {
      "@@type": "Question",
      "name": "Does EduNex ERP have a mobile app for students and parents?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. EduNex ERP provides a dedicated Student and Parent Mobile App powered by Progressive Web App (PWA) technology. Students and parents can install it directly from the browser on Android or iOS — no App Store or Play Store download needed. They can track attendance, view results, pay fees, join live lectures, and receive real-time updates." }
    },
    {
      "@@type": "Question",
      "name": "How does school payroll work in EduNex ERP?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Set each staff member's basic salary, allowances, and deduction rules once. Every month, one click generates net pay for all staff, creates individual PDF payslips, and can send them directly via WhatsApp. PF, ESI, TDS, and other statutory deductions are calculated automatically in compliance with Indian labour law." }
    },
    {
      "@@type": "Question",
      "name": "Is student data secure on EduNex ERP?",
      "acceptedAnswer": { "@@type": "Answer", "text": "EduNex ERP uses a multi-tenant architecture where each institute's data is completely isolated from all others. All data is encrypted at rest and in transit using industry-standard TLS/SSL. No institute can ever access another institute's data. Regular automated backups ensure your data is always safe." }
    },
    {
      "@@type": "Question",
      "name": "Can EduNex ERP handle multiple branches or campuses?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. EduNex ERP has full multi-branch support. School groups, college chains, and coaching franchises can manage all their branches from a single admin panel. Each branch has its own students, staff, fees, timetables, and reports, while the head office gets a consolidated view across all locations." }
    },
    {
      "@@type": "Question",
      "name": "How do we import existing student and staff data into EduNex ERP?",
      "acceptedAnswer": { "@@type": "Answer", "text": "EduNex ERP makes data migration seamless. You can upload all your existing student, parent, and staff data using standard Excel or CSV templates available in the dashboard. Alternatively, our onboarding support team will help migrate your legacy records from any previous software at zero cost." }
    },
    {
      "@@type": "Question",
      "name": "Does EduNex ERP send WhatsApp notifications to parents?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. EduNex ERP has deep WhatsApp integration. Schools can send automated attendance alerts, fee reminders, exam results, circular notices, and custom messages to parents directly via WhatsApp. This eliminates SMS costs and ensures higher read rates since most parents are active on WhatsApp." }
    },
    {
      "@@type": "Question",
      "name": "Can students take online exams on EduNex ERP?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. EduNex ERP includes a full Online Examination module with a Question Bank. Teachers can create MCQ, short answer, or essay-type tests. Students take exams directly on the platform via web browser or mobile. Results are auto-calculated for objective tests and instant notifications are sent to parents." }
    },
    {
      "@@type": "Question",
      "name": "Is EduNex ERP available in Vadodara, Ahmedabad, and other Gujarat cities?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. EduNex ERP is actively used by schools, coaching institutes, and colleges across Gujarat — including Vadodara, Ahmedabad, Surat, Rajkot, Gandhinagar, Anand, Bhavnagar, and other cities. As a cloud-based platform, EduNex ERP is available to any institute in India or worldwide." }
    },
    {
      "@@type": "Question",
      "name": "What is the best school management software in India?",
      "acceptedAnswer": { "@@type": "Answer", "text": "EduNex ERP by Engenius Digitech is widely regarded as one of the best school management software solutions in India for 2024 and 2025. It combines AI biometric attendance, online fee collection, payroll, library, live lectures, and parent communication in a single affordable platform. Trusted by 100+ institutes and rated 4.9/5 by users." }
    },
    {
      "@@type": "Question",
      "name": "Does EduNex ERP support digital assessment and online tests?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. The Digital Assessment module in EduNex ERP allows schools and coaching institutes to conduct MCQ tests, written exams, and competitive test-style assessments online. The Question Bank supports tagging by subject, topic, difficulty level, and chapter. Auto-marking saves teachers hours of manual checking." }
    }
  ]
}
</script>

<!-- HowTo Schema — setup guide for voice search & how-to rich results -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "HowTo",
  "name": "How to Set Up EduNex ERP for Your School or Institute",
  "description": "A step-by-step guide to get your school or coaching institute live on EduNex ERP school management software in under 15 minutes.",
  "totalTime": "PT15M",
  "estimatedCost": { "@@type": "MonetaryAmount", "currency": "INR", "value": "0" },
  "supply": [
    { "@@type": "HowToSupply", "name": "An internet-connected device (PC, tablet, or phone)" },
    { "@@type": "HowToSupply", "name": "Your institute's basic details (name, address, board)" },
    { "@@type": "HowToSupply", "name": "Student and staff data (Excel/CSV)" }
  ],
  "step": [
    {
      "@@type": "HowToStep",
      "position": 1,
      "name": "Start Your Free Trial",
      "text": "Visit edunexerp.online/pricing and click 'Start Free Trial'. No credit card required. Fill in your institute name and admin email to create your account.",
      "url": "{{ url('/pricing') }}"
    },
    {
      "@@type": "HowToStep",
      "position": 2,
      "name": "Configure Your Institute Profile",
      "text": "Enter your institute's name, address, board (CBSE, ICSE, State Board), academic year, and logo. This takes under 3 minutes."
    },
    {
      "@@type": "HowToStep",
      "position": 3,
      "name": "Import Students and Staff",
      "text": "Upload your existing student and staff records using the built-in Excel template. Or, our support team can migrate your data from any previous software at zero cost."
    },
    {
      "@@type": "HowToStep",
      "position": 4,
      "name": "Set Up Fee Structures and Payment Gateway",
      "text": "Define your fee categories, amounts, and due dates. Connect Razorpay or Stripe to enable online fee collection in minutes."
    },
    {
      "@@type": "HowToStep",
      "position": 5,
      "name": "Enroll Staff in AI Biometric Attendance",
      "text": "Open the biometric attendance module on any camera-enabled device. Click 'Enroll Staff', look at the camera for 3 seconds, and the AI captures the face descriptor. Done — no hardware needed."
    },
    {
      "@@type": "HowToStep",
      "position": 6,
      "name": "Set Up Timetables and Academics",
      "text": "Create class batches, assign subjects and teachers, and set your weekly timetable. Students and parents see the live timetable in the mobile app immediately."
    },
    {
      "@@type": "HowToStep",
      "position": 7,
      "name": "Share the Student & Parent App Link",
      "text": "Send parents the PWA install link via WhatsApp. They tap 'Add to Home Screen' and the EduNex ERP student app appears on their phone — no App Store required. Your institute is now fully live."
    }
  ]
}
</script>

<!-- Service Schema — individual EduNex modules as Services -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ItemList",
  "name": "EduNex ERP School Management Features",
  "description": "Complete list of school and institute management modules in EduNex ERP",
  "numberOfItems": 14,
  "itemListElement": [
    {
      "@@type": "ListItem", "position": 1,
      "item": {
        "@@type": "Service",
        "name": "AI Face Biometric Attendance",
        "description": "Automated staff and student attendance using on-device AI face recognition. No hardware needed. Marks attendance in under 2 seconds.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "Attendance Management Software",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 2,
      "item": {
        "@@type": "Service",
        "name": "Online School Fee Collection",
        "description": "Collect school fees online via UPI, Net Banking, Debit Card, or Credit Card using Razorpay and Stripe integration. Automatic receipts and real-time ledger updates.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Fee Management Software",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 3,
      "item": {
        "@@type": "Service",
        "name": "School Payroll & HR Management",
        "description": "One-click monthly payroll processing with automatic PF, ESI, TDS deductions. PDF payslip generation and WhatsApp delivery to staff.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Payroll Software",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 4,
      "item": {
        "@@type": "Service",
        "name": "Library Management System",
        "description": "QR barcode-based book tracking, issue and return management, digital e-book library, and automated fine collection for school and college libraries.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Library Management Software",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 5,
      "item": {
        "@@type": "Service",
        "name": "Live & Recorded Video Lectures",
        "description": "Conduct live video lectures and upload recorded sessions. Students access from the mobile app. Full scheduling, attendance tracking, and recording archive.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "Online Learning Platform for Schools",
        "areaServed": "Worldwide"
      }
    },
    {
      "@@type": "ListItem", "position": 6,
      "item": {
        "@@type": "Service",
        "name": "Student & Parent Mobile App",
        "description": "PWA-based mobile app for students and parents. View timetables, track attendance, pay fees, join live classes, and receive WhatsApp notifications — from any smartphone.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Mobile App",
        "areaServed": "Worldwide"
      }
    },
    {
      "@@type": "ListItem", "position": 7,
      "item": {
        "@@type": "Service",
        "name": "Online Examination & Assessment",
        "description": "Create MCQ, written, and competitive-style tests. Full Question Bank with subject, topic, and difficulty tagging. Auto-mark objective tests and notify results instantly.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "Online Examination Software for Schools",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 8,
      "item": {
        "@@type": "Service",
        "name": "WhatsApp Integration for Schools",
        "description": "Automated WhatsApp messages for attendance alerts, fee reminders, exam results, timetable updates, and custom circulars to all parents and students.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School WhatsApp Notification System",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 9,
      "item": {
        "@@type": "Service",
        "name": "School Bus & Transport Tracking",
        "description": "Live GPS tracking of school buses. Parents track the bus on their mobile app. Route management, driver assignment, and vehicle maintenance logs.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Transport Management Software",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 10,
      "item": {
        "@@type": "Service",
        "name": "Hostel Management System",
        "description": "Room allocation, hostel fee billing, mess menu planning, student check-in/check-out tracking, and warden management — all in one module.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Hostel Management Software",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 11,
      "item": {
        "@@type": "Service",
        "name": "Visitor & Gate Management",
        "description": "Digital visitor registration at campus gates. QR-based visitor passes, check-in/check-out logs, and real-time alerts to staff. Eliminate paper visitor registers.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Gate Management Software",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 12,
      "item": {
        "@@type": "Service",
        "name": "School Inventory & Store Management",
        "description": "Track stationery, lab equipment, sports goods, and other school inventory. Purchase order management, stock alerts, and Tally integration.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Inventory Management Software",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 13,
      "item": {
        "@@type": "Service",
        "name": "School Accounting & Tally Integration",
        "description": "Double-entry ledger, GST reporting, expense tracking, and one-click Tally XML export for schools and institutes.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Accounting Software",
        "areaServed": "IN"
      }
    },
    {
      "@@type": "ListItem", "position": 14,
      "item": {
        "@@type": "Service",
        "name": "Analytics & Reports Dashboard",
        "description": "Real-time analytics dashboard for school principals and admins. Track attendance trends, fee collection, student performance, and staff productivity from a single view.",
        "provider": { "@@type": "Organization", "name": "EduNex ERP" },
        "serviceType": "School Analytics Software",
        "areaServed": "IN"
      }
    }
  ]
}
</script>

</head>
<body>

@include('components.frontend-navbar')

<!-- ══════════════ HERO ══════════════ -->
<section class="hero">
    <!-- Background layers -->
    <div class="hero-grid"></div>
    <div class="hero-orb orb-teal"></div>
    <div class="hero-orb orb-blue"></div>
    <div class="hero-orb orb-violet"></div>

    <div class="hero-content">
        <div class="container px-4">
            <div class="row align-items-center g-5">

                <!-- ── Left: Copy ── -->
                <div class="col-lg-6 text-center text-lg-start hero-copy">

                    <!-- H1 — SEO-rich, memorable -->
                    <h1 class="hero-h1">
                        India's <span class="hero-grad">#1 School ERP</span><br>
                        &amp; Institute<br>Management Software.
                    </h1>

                    <!-- Subtitle -->
                    <p class="hero-sub">
                        Automate admissions, online fee collection, AI attendance, payroll, WhatsApp alerts &amp; 30+ operations — all from one cloud platform trusted by schools across India.
                    </p>

                    <!-- Feature chips -->
                    <div class="hero-features">
                        <span class="hfeat"><i class="fas fa-university"></i> Complete ERP</span>
                        <span class="hfeat"><i class="fas fa-credit-card"></i> Online Fee Collection</span>
                        <span class="hfeat"><i class="fab fa-whatsapp"></i> WhatsApp Alerts</span>
                        <span class="hfeat"><i class="fas fa-brain"></i> AI Face Attendance</span>
                        <span class="hfeat"><i class="fas fa-video"></i> Live Lectures</span>
                        <span class="hfeat"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</span>
                        <span class="hfeat"><i class="fas fa-mobile-alt"></i> Android &amp; iOS App</span>
                        <span class="hfeat"><i class="fas fa-book"></i> Library Management</span>
                        <span class="hfeat"><i class="fas fa-users"></i> Parent Portal</span>
                        <span class="hfeat"><i class="fas fa-cogs"></i> 30+ modules</span>
                    </div>

                    <!-- CTA buttons -->
                    <div class="hero-cta-wrap">
                        @auth
                            <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : url('/dashboard') }}" class="btn-hero-primary">
                                Dashboard <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('pricing') }}" class="btn-hero-primary">
                                Start Free Trial <i class="fas fa-rocket"></i>
                            </a>
                            <a href="{{ route('contact') }}" class="btn-hero-ghost">
                                <i class="fas fa-play-circle"></i> Book Demo
                            </a>
                        @endauth
                    </div>

                    <!-- Social proof -->
                    <div class="hero-social-row">
                        <div class="hero-avatars">
                            <div class="hero-avatar">RS</div>
                            <div class="hero-avatar">AM</div>
                            <div class="hero-avatar">PD</div>
                            <div class="hero-avatar">KS</div>
                            <div class="hero-avatar">VR</div>
                        </div>
                        <span><strong style="color:rgba(255,255,255,0.82);">100+ institutes</strong> across India trust EduNex ERP</span>
                    </div>
                    <p style="margin-top:14px; font-size:0.74rem; color:rgba(255,255,255,0.3);">
                        <i class="fas fa-shield-alt me-1" style="color:#34D399;"></i> No credit card required &nbsp;·&nbsp;
                        <i class="fas fa-clock me-1" style="color:#60A5FA;"></i> Live in 15 minutes
                    </p>
                </div>

                <!-- ── Right: Contact Form ── -->
                <div class="col-lg-6 hero-form-wrap">

                    <!-- Floating notification: Fee collected -->
                    <div class="hero-notif hero-notif-1">
                        <div class="hero-notif-icon" style="background:#F0FDF4;">
                            <i class="fas fa-check-circle" style="color:#16A34A; font-size:1rem;"></i>
                        </div>
                        <div>
                            <div class="hero-notif-title">Fee Collected</div>
                            <div class="hero-notif-sub">₹15,000 — Arjun Shah, Class 10</div>
                        </div>
                    </div>

                    <!-- Floating notification: AI Attendance -->
                    <div class="hero-notif hero-notif-2">
                        <div class="hero-notif-icon" style="background:#EFF6FF;">
                            <i class="fas fa-fingerprint" style="color:#2563EB; font-size:1rem;"></i>
                        </div>
                        <div>
                            <div class="hero-notif-title">AI Attendance Done</div>
                            <div class="hero-notif-sub">247/250 marked in 45 seconds</div>
                        </div>
                    </div>

                    <!-- Form card -->
                    <div class="hero-form-card">
                        <div id="hero-form-inner">
                            <div class="hf-head">
                                <span class="hf-head-eyebrow"><i class="fas fa-paper-plane"></i> Get in Touch</span>
                                <h3 class="hf-head-title">Book a live demo today</h3>
                                <p class="hf-head-sub">Tell us about your institute — we'll set up a personalised walkthrough.</p>
                            </div>
                            <div class="hf-body">
                                <form id="hero-ejs-form" novalidate>
                                    <input type="hidden" name="inquiry_type" value="Demo Request — Hero Form">
                                    <div class="hf-row">
                                        <div class="hf-group">
                                            <label class="hf-lbl">Your Name</label>
                                            <div class="hf-inp-wrap">
                                                <i class="fas fa-user hf-ico"></i>
                                                <input type="text" name="name" placeholder="Arjun Sharma" required>
                                            </div>
                                        </div>
                                        <div class="hf-group">
                                            <label class="hf-lbl">Email Address</label>
                                            <div class="hf-inp-wrap">
                                                <i class="fas fa-envelope hf-ico"></i>
                                                <input type="email" name="email" placeholder="you@institute.com" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hf-group">
                                        <label class="hf-lbl">Your Message</label>
                                        <div class="hf-inp-wrap">
                                            <i class="fas fa-comment-alt hf-ico" style="top:14px;transform:none;"></i>
                                            <textarea name="message" placeholder="Tell us about your institute — type, student count, what you need..." required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" id="hero-ejs-btn" class="hf-submit">
                                        <span id="hero-ejs-text"><i class="fas fa-paper-plane"></i> Send Message</span>
                                        <span id="hero-ejs-loading" style="display:none;align-items:center;">
                                            <span class="spinner-border spinner-border-sm me-2"></span>Sending…
                                        </span>
                                    </button>
                                    <div class="hf-trust">
                                        <span class="hf-trust-item"><i class="fas fa-shield-alt"></i> Data is safe</span>
                                        <span class="hf-trust-item"><i class="fas fa-clock"></i> Reply in 1 business day</span>
                                        <span class="hf-trust-item"><i class="fas fa-star"></i> 100+ institutes</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

    <!-- ══════════════ Dashboard Screenshot ══════════════ -->
<section id="dashboard" class="staff-section">  
    <div class="staff-blob-2" style="background:hsla(262,83%,58%,0.07); top:-100px; left:-100px;"></div>
    <div class="staff-blob-1" style="background:hsla(217,91%,60%,0.08); bottom:-80px; right:-80px;"></div>
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="sec-eyebrow" style="color:#7C3AED;">All-in-One Dashboard</span>
                <h2 class="sec-title">Manage your entire educational institute from a single dashboard.</h2>

                <ul class="feat-list mb-4" style="max-width: 450px; list-style: none; padding: 0;">
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:#475569;"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> Real-time analytics & reports</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:#475569;"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> Quick access to student & staff records</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:#475569;"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> Seamless integration with other tools</li>
                </ul>
            </div>
            <div class="col-lg-6 text-center">
                <div style="position:relative; display:inline-block;">
                    <!-- Decorative glow behind dashboard -->
                    <div style="position:absolute; inset:20px; background:var(--gradient-secondary); filter:blur(60px); opacity:0.3; border-radius:50%;"></div>
                    <img src="{{ asset('images/dashboard.png') }}" alt="EduNex ERP Dashboard" style="max-width: 924px; width: 100%; position:relative; z-index:2; filter: drop-shadow(0 25px 50px rgba(0,0,0,0.5));">
                </div>
            </div>           
        </div>
    </div>
</section>

    <!-- ══════════════ MOBILE APP ══════════════ -->
<section id="mobile-app" class="staff-section">
    <div class="staff-blob-2" style="background:hsla(262,83%,58%,0.07); top:-100px; left:-100px;"></div>
    <div class="staff-blob-1" style="background:hsla(217,91%,60%,0.08); bottom:-80px; right:-80px;"></div>
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5">
             <div class="col-lg-6 text-center">
                <div style="position:relative; display:inline-block;">
                    <!-- Decorative glow behind phone -->
                    <div style="position:absolute; inset:20px; background:var(--gradient-secondary); filter:blur(60px); opacity:0.3; border-radius:50%;"></div>
                    <img src="{{ asset('images/mobile-screen.png') }}" alt="EduNex ERP Mobile App" style="max-width: 250px; width: 100%; position:relative; z-index:2; filter: drop-shadow(0 25px 50px rgba(0,0,0,0.5));">
                </div>
            </div>
            <div class="col-lg-6">
                <span class="sec-eyebrow" style="color:#7C3AED;">Dedicated Mobile App</span>
                <h2 class="sec-title">The entire institute or School in <br><span class="g-text-2">their pocket.</span></h2>
                <p class="sec-desc mb-4">Empower your students and parents with a modern, native-like mobile app. They can check timetables, track attendance, pay fees, and join live classes from anywhere.</p>

                <ul class="feat-list mb-4" style="max-width: 450px; list-style: none; padding: 0;">
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:#475569;"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> Real-time attendance & result notifications</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:#475569;"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> Online fee payments with instant receipts</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:#475569;"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> One-tap join for live video lectures</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:#475569;"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> Access study materials & homework</li>
                </ul>

                <div class="d-flex gap-3 mt-4">
                    <a href="{{ route('contact') }}" class="btn-primary" style="background: linear-gradient(135deg,#7C3AED,#2563EB);">See App Demo <i class="fas fa-mobile-alt"></i></a>
                </div>
            </div>
           
        </div>
    </div>
</section>


<!-- ══════════════ INSTITUTE STORY VISUAL ══════════════ -->
<section class="story-section">
<style>
.story-section {
    background: linear-gradient(160deg, #F0FDFA 0%, #EFF6FF 50%, #F5F3FF 100%);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}
.story-section::before {
    content: '';
    position: absolute; top: -120px; left: -120px;
    width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(13,148,136,0.08), transparent 70%);
    pointer-events: none;
}
.story-section::after {
    content: '';
    position: absolute; bottom: -100px; right: -100px;
    width: 350px; height: 350px; border-radius: 50%;
    background: radial-gradient(circle, rgba(99,102,241,0.08), transparent 70%);
    pointer-events: none;
}
.story-header {
    text-align: center;
    margin-bottom: 56px;
}
.story-eyebrow-pill {
    display: inline-flex; align-items: center; gap: 8px;
    background: #fff;
    border: 1px solid rgba(13,148,136,0.25);
    border-radius: 999px; padding: 6px 18px;
    font-size: 0.72rem; font-weight: 700;
    color: #0D9488; text-transform: uppercase; letter-spacing: 1.2px;
    box-shadow: 0 2px 12px rgba(13,148,136,0.1);
    margin-bottom: 18px;
}
.story-eyebrow-pill i { font-size: 0.7rem; }
.story-header-title {
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800; color: #0F172A;
    letter-spacing: -1px; line-height: 1.2;
    margin: 0;
}
.story-header-title span {
    background: linear-gradient(135deg, #0D9488, #6366F1);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}
.story-frame {
    position: relative;
    max-width: 860px;
    margin: 0 auto;
}
.story-frame-glow {
    position: absolute; inset: -2px;
    border-radius: 26px;
    background: linear-gradient(135deg, #0D9488, #6366F1, #2563EB);
    z-index: 0;
    filter: blur(0px);
    opacity: 0.7;
}
.story-frame-inner {
    position: relative; z-index: 1;
    background: #fff;
    border-radius: 24px;
    padding: 6px;
    box-shadow: 0 32px 80px rgba(0,0,0,0.12);
}
.story-frame-inner img {
    width: 100%; display: block;
    border-radius: 20px;
}
.story-frame-top {
    display: flex; align-items: center; gap: 6px;
    padding: 10px 16px 4px;
}
.story-dot { width: 10px; height: 10px; border-radius: 50%; }
.story-frame-label {
    margin-left: auto;
    font-size: 0.68rem; font-weight: 700;
    color: #94A3B8; letter-spacing: 0.5px;
}
.story-floating-badge {
    position: absolute;
    background: #fff;
    border-radius: 14px;
    padding: 10px 16px;
    display: flex; align-items: center; gap: 10px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    font-size: 0.75rem; font-weight: 700; color: #0F172A;
    z-index: 10;
    animation: float-badge 4s ease-in-out infinite;
}
.story-badge-1 { top: -18px; left: -24px; animation-delay: 0s; }
.story-badge-2 { bottom: -18px; right: -24px; animation-delay: 2s; }
@keyframes float-badge {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
.story-badge-icon {
    width: 32px; height: 32px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem; color: #fff; flex-shrink: 0;
}
.story-badge-sub { font-size: 0.65rem; font-weight: 500; color: #64748B; margin-top: 1px; }
.story-stats {
    display: flex; justify-content: center; gap: 40px;
    margin-top: 52px; flex-wrap: wrap;
}
.story-stat {
    text-align: center;
    padding: 20px 28px;
    background: #fff;
    border-radius: 16px;
    border: 1px solid #E8EDF5;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    min-width: 120px;
    transition: all 0.25s;
}
.story-stat:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(13,148,136,0.12); border-color: #0D9488; }
.story-stat-val { font-size: 1.8rem; font-weight: 900; letter-spacing: -1.5px; line-height: 1; background: linear-gradient(135deg,#0D9488,#2563EB); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
.story-stat-lbl { font-size: 0.68rem; font-weight: 600; color: #64748B; text-transform: uppercase; letter-spacing: 0.8px; margin-top: 5px; }
@media(max-width:768px) {
    .story-badge-1, .story-badge-2 { display: none; }
    .story-stats { gap: 16px; }
    .story-stat { padding: 16px 20px; min-width: 90px; }
    .story-stat-val { font-size: 1.4rem; }
}
</style>
    <div class="container px-4" style="position:relative;z-index:2;">

        <div class="story-header">
            <div class="story-eyebrow-pill"><i class="fas fa-book-open"></i> The EduNex ERP Story</div>
            <h2 class="story-header-title">One platform. <span>Every workflow.</span><br>Zero chaos.</h2>
        </div>

        <div class="story-frame">
            <!-- Gradient border glow -->
            <div class="story-frame-glow"></div>

            <!-- Browser chrome -->
            <div class="story-frame-inner">
                <div class="story-frame-top">
                    <div class="story-dot" style="background:#FF5F57;"></div>
                    <div class="story-dot" style="background:#FEBC2E;"></div>
                    <div class="story-dot" style="background:#28C840;"></div>
                    <div class="story-frame-label">edunexerp.online</div>
                </div>
                <img src="{{ asset('images/process.jpg') }}" alt="EduNex ERP Story">
            </div>

            <!-- Floating badge 1 -->
            <div class="story-floating-badge story-badge-1">
                <div class="story-badge-icon" style="background:linear-gradient(135deg,#0D9488,#2563EB);"><i class="fas fa-fingerprint"></i></div>
                <div>
                    <div>AI Attendance</div>
                    <div class="story-badge-sub">Marked in &lt;2 seconds</div>
                </div>
            </div>

            <!-- Floating badge 2 -->
            <div class="story-floating-badge story-badge-2">
                <div class="story-badge-icon" style="background:linear-gradient(135deg,#F59E0B,#EF4444);"><i class="fas fa-money-bill-wave"></i></div>
                <div>
                    <div>Auto Payroll</div>
                    <div class="story-badge-sub">WhatsApp payslips sent</div>
                </div>
            </div>
        </div>

        <!-- Stats row -->
        <div class="story-stats">
            <div class="story-stat">
                <div class="story-stat-val">100+</div>
                <div class="story-stat-lbl">Institutes</div>
            </div>
            <div class="story-stat">
                <div class="story-stat-val">50K+</div>
                <div class="story-stat-lbl">Students</div>
            </div>
            <div class="story-stat">
                <div class="story-stat-val">99.9%</div>
                <div class="story-stat-lbl">Uptime</div>
            </div>
            <div class="story-stat">
                <div class="story-stat-val">15m</div>
                <div class="story-stat-lbl">Go Live</div>
            </div>
            <div class="story-stat">
                <div class="story-stat-val">5★</div>
                <div class="story-stat-lbl">Rating</div>
            </div>
        </div>

    </div>
</section>

<!-- ══════════════ FEATURES ══════════════ -->
<section id="features" class="feat-section">
<style>
.ftab-nav { display:flex; gap:8px; flex-wrap:wrap; justify-content:center; margin-bottom:48px; }
.ftab-btn {
    display:inline-flex; align-items:center; gap:8px;
    padding:10px 20px; border-radius:50px;
    font-size:0.8rem; font-weight:700; cursor:pointer;
    border:1.5px solid #E2E8F0; background:#fff; color:#64748B;
    transition:all 0.2s; white-space:nowrap;
}
.ftab-btn:hover { border-color:#0D9488; color:#0D9488; background:#F0FDFA; }
.ftab-btn.active { background:#0D9488; color:#fff; border-color:#0D9488; box-shadow:0 4px 14px rgba(13,148,136,0.25); }
.ftab-btn i { font-size:0.85rem; }

.ftab-panel { display:none; }
.ftab-panel.active { display:block; }

.fmod-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
@media(max-width:900px){ .fmod-grid { grid-template-columns:repeat(2,1fr); } }
@media(max-width:540px){ .fmod-grid { grid-template-columns:1fr; } }

.fmod-card {
    background:#fff; border:1.5px solid #E8EDF5; border-radius:18px;
    padding:28px 24px; transition:all 0.25s; cursor:default;
    display:flex; flex-direction:column; gap:14px;
}
.fmod-card:hover { border-color:#0D9488; box-shadow:0 8px 28px rgba(13,148,136,0.1); transform:translateY(-3px); }
.fmod-card.clickable { cursor:pointer; }

.fmod-icon {
    width:48px; height:48px; border-radius:14px;
    display:flex; align-items:center; justify-content:center;
    font-size:1.1rem; flex-shrink:0;
}
.fmod-title { font-size:0.95rem; font-weight:800; color:#0F172A; line-height:1.3; }
.fmod-desc { font-size:0.8rem; color:#64748B; line-height:1.65; margin:0; }
.fmod-tag {
    display:inline-flex; align-items:center; gap:5px;
    font-size:0.65rem; font-weight:700; text-transform:uppercase;
    letter-spacing:0.8px; padding:3px 10px; border-radius:20px;
    width:fit-content;
}

/* Spotlight (left panel + right list) */
.fspot { display:grid; grid-template-columns:1fr 1fr; gap:28px; align-items:start; }
@media(max-width:768px){ .fspot { grid-template-columns:1fr; } }
.fspot-left {
    background:linear-gradient(135deg,#F0FDFA,#EFF6FF);
    border:1.5px solid #CCFBF1; border-radius:20px; padding:36px 30px;
}
.fspot-right { display:flex; flex-direction:column; gap:14px; }
.fspot-row {
    display:flex; align-items:flex-start; gap:14px;
    background:#fff; border:1.5px solid #E8EDF5; border-radius:14px; padding:18px 16px;
    transition:all 0.2s;
}
.fspot-row:hover { border-color:#0D9488; background:#F0FDFA; }
.fspot-row-icon { width:38px; height:38px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:0.9rem; flex-shrink:0; }
.fspot-row-title { font-size:0.85rem; font-weight:700; color:#0F172A; }
.fspot-row-desc { font-size:0.75rem; color:#64748B; margin:2px 0 0; line-height:1.5; }
</style>

    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow">Platform Features</span>
            <h2 class="sec-title">One platform. <span class="g-text">Every need covered.</span></h2>
            <p class="sec-desc" style="margin:0 auto;">Tap a category to explore what EduNex ERP does for that part of your institute.</p>
        </div>

        <!-- Tab Navigation -->
        <div class="ftab-nav">
            <button class="ftab-btn active" onclick="switchTab('students')"><i class="fas fa-user-graduate"></i> Students</button>
            <button class="ftab-btn" onclick="switchTab('staff')"><i class="fas fa-chalkboard-user"></i> Staff & HR</button>
            <button class="ftab-btn" onclick="switchTab('academics')"><i class="fas fa-book-open"></i> Academics</button>
            <button class="ftab-btn" onclick="switchTab('finance')"><i class="fas fa-wallet"></i> Finance</button>
            <button class="ftab-btn" onclick="switchTab('operations')"><i class="fas fa-building"></i> Operations</button>
        </div>

        <!-- ── Tab: Students ── -->
        <div class="ftab-panel active" id="tab-students">
            <div class="fspot">
                <div class="fspot-left">
                    <div style="width:52px;height:52px;border-radius:14px;background:#0D9488;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;margin-bottom:20px;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 style="font-size:1.3rem;font-weight:800;color:#0F172A;margin-bottom:10px;">Student Attendance</h3>
                    <p style="font-size:0.85rem;color:#64748B;line-height:1.7;margin-bottom:20px;">Mark an entire batch present in one tap. Every mark instantly notifies parents via WhatsApp and auto-builds monthly reports — no manual work.</p>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        @foreach(['One-tap batch marking','Auto WhatsApp parent alerts','Monthly PDF reports','Low-attendance flag & follow-up'] as $pt)
                        <div style="display:flex;align-items:center;gap:10px;font-size:0.8rem;font-weight:600;color:#0F172A;">
                            <div style="width:20px;height:20px;border-radius:50%;background:#0D9488;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas fa-check" style="font-size:0.55rem;color:#fff;"></i></div>
                            {{ $pt }}
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="fspot-right">
                    @foreach([
                        ['fa-user-plus','#EFF6FF','#2563EB','Admissions & Enrolment','Digital admission forms, document uploads, and instant fee collection on the spot.'],
                        ['fa-id-card','#F5F3FF','#7C3AED','Student Portal & App','Students view timetables, results, fees, and notices on a dedicated mobile app — 24/7.'],
                        ['fa-star-half-stroke','#FFFBEB','#D97706','Exam Results & Report Cards','Publish results with one click. Print or share digital mark-sheets and report cards.'],
                        ['fa-shield-halved','#FFF1F2','#E11D48','Discipline Management','Track behavior with dynamic point scoring. Log incidents, send alerts, monitor trends.'],
                        ['fa-images','#F0FDFA','#0D9488','Gallery & Notices','Share event photos and announcements directly to the student dashboard and app.'],
                    ] as $r)
                    <div class="fspot-row">
                        <div class="fspot-row-icon" style="background:{{ $r[1] }};color:{{ $r[2] }};"><i class="fas {{ $r[0] }}"></i></div>
                        <div>
                            <div class="fspot-row-title">{{ $r[3] }}</div>
                            <div class="fspot-row-desc">{{ $r[4] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ── Tab: Staff & HR ── -->
        <div class="ftab-panel" id="tab-staff">
            <div class="fspot">
                <div class="fspot-left" style="background:linear-gradient(135deg,#EFF6FF,#F5F3FF);border-color:#BFDBFE;">
                    <div style="width:52px;height:52px;border-radius:14px;background:#2563EB;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;margin-bottom:20px;">
                        <i class="fas fa-fingerprint"></i>
                    </div>
                    <h3 style="font-size:1.3rem;font-weight:800;color:#0F172A;margin-bottom:10px;">AI Face + GPS Attendance</h3>
                    <p style="font-size:0.85rem;color:#64748B;line-height:1.7;margin-bottom:20px;">Staff open the app, the AI scans their face and verifies GPS location simultaneously — attendance is marked in under 2 seconds. No hardware, no proxies.</p>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        @foreach(['On-device AI, no internet needed','GPS geofenced to your campus','Anti-spoof & liveness detection','Offline sync when reconnected'] as $pt)
                        <div style="display:flex;align-items:center;gap:10px;font-size:0.8rem;font-weight:600;color:#0F172A;">
                            <div style="width:20px;height:20px;border-radius:50%;background:#2563EB;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas fa-check" style="font-size:0.55rem;color:#fff;"></i></div>
                            {{ $pt }}
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="fspot-right">
                    @foreach([
                        ['fa-file-invoice-dollar','#FFFBEB','#D97706','One-Click Payroll','Generate and WhatsApp payslips to all staff in a single click. PF, ESIC, TDS automated.'],
                        ['fa-umbrella-beach','#F0FDFA','#0D9488','Leave Management','Staff apply online, managers approve with one tap. Balances auto-deducted from payroll.'],
                        ['fa-user-tie','#F5F3FF','#7C3AED','Staff Profiles & Roles','Full staff directory with role-based access control. Each teacher sees only their data.'],
                        ['fa-chart-bar','#EFF6FF','#2563EB','HR Reports','Monthly attendance summaries, late/absent trends, and exportable payroll registers.'],
                    ] as $r)
                    <div class="fspot-row">
                        <div class="fspot-row-icon" style="background:{{ $r[1] }};color:{{ $r[2] }};"><i class="fas {{ $r[0] }}"></i></div>
                        <div>
                            <div class="fspot-row-title">{{ $r[3] }}</div>
                            <div class="fspot-row-desc">{{ $r[4] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ── Tab: Academics ── -->
        <div class="ftab-panel" id="tab-academics">
            <div class="fmod-grid">
                @foreach([
                    ['fa-video','#F5F3FF','#7C3AED','Live Lectures','Host live classes directly inside EduNex ERP. Students join from the mobile app — no Zoom link needed.',''],
                    ['fa-laptop-code','#EFF6FF','#2563EB','Online Examinations','Secure MCQ & subjective exams with auto-grading, question banks, and proctoring alerts.','NEW'],
                    ['fa-book-open','#F0FDFA','#0D9488','Course & Batch Management','Create courses, assign batches, set schedules and timetables — all in one place.',''],
                    ['fa-file-alt','#FFFBEB','#D97706','Study Materials','Upload PDFs, videos, and notes. Students access them anytime from their portal.',''],
                    ['fa-book-reader','#FFF1F2','#E11D48','Library Management','Track physical books, manage issue/return, handle fines, and add digital resources.',''],
                    ['fa-graduation-cap','#F5F3FF','#7C3AED','Results & Report Cards','Publish marks and generate printable/digital report cards with one click.',''],
                ] as $f)
                <div class="fmod-card">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div class="fmod-icon" style="background:{{ $f[1] }};color:{{ $f[2] }};"><i class="fas {{ $f[0] }}"></i></div>
                        <div>
                            <div class="fmod-title">{{ $f[3] }}
                                @if($f[5])<span style="background:#EFF6FF;color:#2563EB;font-size:0.58rem;font-weight:800;padding:2px 7px;border-radius:20px;margin-left:6px;vertical-align:middle;">{{ $f[5] }}</span>@endif
                            </div>
                        </div>
                    </div>
                    <p class="fmod-desc">{{ $f[4] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ── Tab: Finance ── -->
        <div class="ftab-panel" id="tab-finance">
            <div class="fspot">
                <div class="fspot-left" style="background:linear-gradient(135deg,#FFFBEB,#FFF7ED);border-color:#FDE68A;">
                    <div style="width:52px;height:52px;border-radius:14px;background:#D97706;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;margin-bottom:20px;">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3 style="font-size:1.3rem;font-weight:800;color:#0F172A;margin-bottom:10px;">Fee Collection & Payments</h3>
                    <p style="font-size:0.85rem;color:#64748B;line-height:1.7;margin-bottom:20px;">Students pay online via Razorpay. Overdue fees trigger automatic WhatsApp reminders. Every payment generates an instant receipt — zero manual follow-up.</p>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        @foreach(['Razorpay online payment link','Auto WhatsApp overdue reminders','Instant digital receipt on payment','Fee structure per batch/course'] as $pt)
                        <div style="display:flex;align-items:center;gap:10px;font-size:0.8rem;font-weight:600;color:#0F172A;">
                            <div style="width:20px;height:20px;border-radius:50%;background:#D97706;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas fa-check" style="font-size:0.55rem;color:#fff;"></i></div>
                            {{ $pt }}
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="fspot-right">
                    @foreach([
                        ['fa-calculator','#EFF6FF','#2563EB','Accounting & Tally Sync','Double-entry ledger, GST reports (CGST/SGST/IGST), and Tally XML export.','NEW'],
                        ['fa-file-invoice-dollar','#F5F3FF','#7C3AED','Payroll & Statutory','Automate PF, ESIC, TDS. Generate payslips and send to staff WhatsApp in one click.',''],
                        ['fa-chart-pie','#F0FDFA','#0D9488','Finance Dashboard','Real-time revenue, collection rate, pending dues — all visible at a glance.',''],
                        ['fa-building-columns','#FFFBEB','#D97706','Hostel Billing','Auto-generate monthly hostel fee statements for boarders with mess and amenity charges.','NEW'],
                    ] as $r)
                    <div class="fspot-row">
                        <div class="fspot-row-icon" style="background:{{ $r[1] }};color:{{ $r[2] }};"><i class="fas {{ $r[0] }}"></i></div>
                        <div>
                            <div class="fspot-row-title">{{ $r[3] }} @if($r[5])<span style="background:#EFF6FF;color:#2563EB;font-size:0.6rem;font-weight:800;padding:2px 7px;border-radius:20px;margin-left:6px;">{{ $r[5] }}</span>@endif</div>
                            <div class="fspot-row-desc">{{ $r[4] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ── Tab: Operations ── -->
        <div class="ftab-panel" id="tab-operations">
            <div class="fmod-grid">
                @foreach([
                    ['fa-hotel','#F0FDFA','#0D9488','Hostel Management','Room allocations, roommate directory, mess menu planning, and auto monthly billing.','NEW'],
                    ['fa-boxes-stacked','#FFFBEB','#D97706','Store & Inventory','Track stationery, uniforms, lab supplies. Purchase requisitions and auto stock adjustment.','NEW'],
                    ['fa-id-badge','#EFF6FF','#2563EB','Visitor Gate Security','QR self-registration, receptionist approval screen, printable visitor gate passes.','NEW'],
                    ['fa-bus','#F5F3FF','#7C3AED','Transit & Route Tracking','GPS route simulator, TSP route optimizer, student boarding checklist, parent alerts.','NEW'],
                    ['fa-chart-line','#F0FDFA','#0D9488','Analytics & Reports','Attendance trends, fee collection status, staff punctuality — all in one live dashboard.',''],
                    ['fa-bell','#FFF1F2','#E11D48','Notifications & Alerts','Push notifications, WhatsApp alerts, and in-app notices to students, staff, and parents.',''],
                ] as $f)
                <div class="fmod-card">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div class="fmod-icon" style="background:{{ $f[1] }};color:{{ $f[2] }};"><i class="fas {{ $f[0] }}"></i></div>
                        <div>
                            <div class="fmod-title">{{ $f[3] }}
                                @if($f[5])<span style="background:#EFF6FF;color:#2563EB;font-size:0.58rem;font-weight:800;padding:2px 7px;border-radius:20px;margin-left:6px;vertical-align:middle;">{{ $f[5] }}</span>@endif
                            </div>
                        </div>
                    </div>
                    <p class="fmod-desc">{{ $f[4] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- View all features link -->
        <div class="text-center mt-5">
            <a href="{{ route('pricing') }}" class="btn-outline">See all features &amp; pricing <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<script>
function switchTab(id) {
    document.querySelectorAll('.ftab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.ftab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + id).classList.add('active');
    event.currentTarget.classList.add('active');
}
</script>

<!-- ══════════════ STAFF INTELLIGENCE ══════════════ -->
<section id="staff" class="staff-section" style="background:#F8FAFC;">
    <div class="staff-blob-1"></div>
    <div class="staff-blob-2"></div>
    <div class="container px-4" style="position:relative;z-index:2;">

        <div class="row align-items-end mb-5">
            <div class="col-lg-7">
                <span class="sec-eyebrow">Staff Intelligence</span>
                <h2 class="sec-title">AI-powered staff<br>management. <span class="g-text">Fully automated.</span></h2>
                <p class="sec-desc">Biometric face recognition, GPS check-ins, one-click payroll — everything your HR team needs, on autopilot.</p>
            </div>
            <div class="col-lg-5 text-lg-end mt-4 mt-lg-0 d-flex gap-3 justify-content-lg-end flex-wrap">
                <a href="{{ route('contact') }}" class="btn-primary"><i class="fas fa-play"></i> See Live Demo</a>
                <a href="{{ route('pricing') }}" class="btn-outline">Pricing <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- AI Attendance Visual Story -->
        <style>
        .staff-visual {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            align-items: center;
            margin-top: 20px;
        }
        @media(max-width:991px) { .staff-visual { grid-template-columns: 1fr; } }

        .staff-visual-img-wrap {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
        }
        .staff-visual-img {
            width: 100%; display: block;
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        }
        .staff-visual-badge {
            position: absolute;
            bottom: 20px; left: 20px;
            background: #fff;
            border-radius: 14px;
            padding: 10px 16px;
            display: flex; align-items: center; gap: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            font-size: 0.78rem; font-weight: 600; color: #0F172A;
        }
        .staff-visual-badge-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: #10B981;
            box-shadow: 0 0 0 3px rgba(16,185,129,0.2);
            flex-shrink: 0;
        }

        .staff-steps { display: flex; flex-direction: column; gap: 20px; }
        .staff-step-card {
            background: #fff;
            border: 1px solid #E8EDF5;
            border-radius: 16px;
            padding: 22px 24px;
            display: flex; align-items: flex-start; gap: 18px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            transition: all 0.25s ease;
        }
        .staff-step-card:hover {
            border-color: #0D9488;
            box-shadow: 0 8px 30px rgba(13,148,136,0.1);
            transform: translateY(-2px);
        }
        .staff-step-num {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.78rem; flex-shrink: 0;
            color: #fff;
        }
        .staff-step-body { flex: 1; }
        .staff-step-title { font-size: 0.95rem; font-weight: 700; color: #0F172A; margin-bottom: 5px; }
        .staff-step-desc { font-size: 0.82rem; color: #64748B; line-height: 1.7; margin: 0; }
        .staff-step-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px; }
        .staff-step-tag {
            display: inline-flex; align-items: center; gap: 4px;
            background: #F1F5F9; border-radius: 6px;
            padding: 3px 9px; font-size: 0.68rem; font-weight: 600; color: #475569;
        }
        </style>

        <div class="staff-visual">
            <!-- Left: Image -->
            <div class="staff-visual-img-wrap">
                <img src="{{ asset('images/attendance.jpg') }}" alt="Staff Biometric Attendance" class="staff-visual-img">
                <div class="staff-visual-badge">
                    <div class="staff-visual-badge-dot"></div>
                    Live — Attendance marked 2s ago
                </div>
            </div>

            <!-- Right: Feature cards -->
            <div class="staff-steps">
                <div class="staff-step-card">
                    <div class="staff-step-num" style="background:linear-gradient(135deg,#0D9488,#2563EB);">
                        <i class="fas fa-fingerprint" style="font-size:1rem;"></i>
                    </div>
                    <div class="staff-step-body">
                        <div class="staff-step-title">AI Face + GPS Verification</div>
                        <p class="staff-step-desc">Staff open the app, face is scanned and GPS verified simultaneously. Attendance marked in under 2 seconds — no PINs, no cards, zero proxies.</p>
                        <div class="staff-step-tags">
                            <span class="staff-step-tag"><i class="fas fa-bolt" style="color:#F59E0B;"></i> &lt;2 sec</span>
                            <span class="staff-step-tag"><i class="fas fa-location-dot" style="color:#EF4444;"></i> GPS Geofenced</span>
                            <span class="staff-step-tag"><i class="fas fa-shield-alt" style="color:#10B981;"></i> Anti-Spoof AI</span>
                        </div>
                    </div>
                </div>

                <div class="staff-step-card">
                    <div class="staff-step-num" style="background:linear-gradient(135deg,#F59E0B,#EF4444);">
                        <i class="fas fa-file-invoice-dollar" style="font-size:1rem;"></i>
                    </div>
                    <div class="staff-step-body">
                        <div class="staff-step-title">One-Click Payroll & Payslips</div>
                        <p class="staff-step-desc">Generate monthly payroll and WhatsApp PDF payslips to every staff member in a single click. PF, ESIC, TDS deductions automated.</p>
                        <div class="staff-step-tags">
                            <span class="staff-step-tag"><i class="fab fa-whatsapp" style="color:#25D366;"></i> WhatsApp Delivery</span>
                            <span class="staff-step-tag"><i class="fas fa-file-pdf" style="color:#EF4444;"></i> PDF Payslips</span>
                            <span class="staff-step-tag"><i class="fas fa-calculator" style="color:#6366F1;"></i> Auto Deductions</span>
                        </div>
                    </div>
                </div>

                <div class="staff-step-card">
                    <div class="staff-step-num" style="background:linear-gradient(135deg,#6366F1,#8B5CF6);">
                        <i class="fas fa-chart-bar" style="font-size:1rem;"></i>
                    </div>
                    <div class="staff-step-body">
                        <div class="staff-step-title">Punctuality & Attendance Analytics</div>
                        <p class="staff-step-desc">Live dashboard shows daily Mark-IN / Mark-OUT logs, late arrivals, absentee trends, and exportable monthly summaries for every staff member.</p>
                        <div class="staff-step-tags">
                            <span class="staff-step-tag"><i class="fas fa-download" style="color:#0D9488;"></i> CSV Export</span>
                            <span class="staff-step-tag"><i class="fas fa-clock" style="color:#F59E0B;"></i> Late Tracking</span>
                            <span class="staff-step-tag"><i class="fas fa-calendar-check" style="color:#2563EB;"></i> Monthly Reports</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ══════════════ HOW IT WORKS ══════════════ -->
<section class="how-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow">Get Started</span>
            <h2 class="sec-title" style="margin-bottom:12px;">Live in <span class="g-text">15 minutes.</span></h2>
            <p class="sec-desc" style="margin:0 auto;">No IT team. No migration headache. Just sign up and follow four steps.</p>
        </div>

        <!-- Step Journey -->
        <style>
        .step-journey { display:grid; grid-template-columns:1fr 32px 1fr 32px 1fr 32px 1fr; align-items:center; gap:0; }
        @media(max-width:640px){
            .step-journey { grid-template-columns:1fr 1fr; gap:24px 16px; }
            .step-connector { display:none !important; }
        }
        </style>
        <div style="max-width:900px;margin:0 auto;">
            <div class="step-journey">

                @php
                $steps = [
                    ['icon'=>'fa-building','bg'=>'#F0FDFA','border'=>'#0D9488','color'=>'#0D9488','num'=>'01','label'=>'Create Institute','sub'=>'2 min'],
                    ['icon'=>'fa-chalkboard-user','bg'=>'#EFF6FF','border'=>'#2563EB','color'=>'#2563EB','num'=>'02','label'=>'Add Staff & Batches','sub'=>'5 min'],
                    ['icon'=>'fa-user-plus','bg'=>'#F5F3FF','border'=>'#7C3AED','color'=>'#7C3AED','num'=>'03','label'=>'Enrol Students','sub'=>'5 min'],
                    ['icon'=>'fa-rocket','bg'=>'#FFFBEB','border'=>'#D97706','color'=>'#D97706','num'=>'04','label'=>'Go Live Today','sub'=>'Done ✓'],
                ];
                @endphp

                @foreach($steps as $i => $s)
                <!-- Step {{ $i+1 }} -->
                <div style="display:flex;flex-direction:column;align-items:center;gap:16px;">
                    <!-- Time badge -->
                    <div style="font-size:0.68rem;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:{{ $s['color'] }};background:{{ $s['bg'] }};border:1px solid {{ $s['border'] }};padding:3px 12px;border-radius:20px;">
                        {{ $s['sub'] }}
                    </div>
                    <!-- Icon circle -->
                    <div style="width:88px;height:88px;border-radius:50%;background:{{ $s['bg'] }};border:2.5px solid {{ $s['border'] }};display:flex;align-items:center;justify-content:center;font-size:1.6rem;color:{{ $s['color'] }};box-shadow:0 4px 20px {{ $s['bg'] }};flex-shrink:0;">
                        <i class="fas {{ $s['icon'] }}"></i>
                    </div>
                    <!-- Label -->
                    <div style="text-align:center;">
                        <div style="font-size:0.7rem;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:#94A3B8;margin-bottom:4px;">Step {{ $i+1 }}</div>
                        <div style="font-size:0.88rem;font-weight:700;color:#0F172A;">{{ $s['label'] }}</div>
                    </div>
                </div>
                @if($i < 3)
                <!-- Connector -->
                <div class="step-connector" style="display:flex;align-items:center;justify-content:center;padding-top:20px;">
                    <div style="width:32px;height:2px;background:linear-gradient(90deg,{{ $s['border'] }},{{ $steps[$i+1]['border'] }});border-radius:2px;position:relative;">
                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:18px;height:18px;border-radius:50%;background:{{ $s['border'] }};display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-check" style="font-size:0.45rem;color:#fff;"></i>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </div>
</section>

<!-- ══════════════ USE CASES ══════════════ -->
<section class="proof-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow">Who Is It For?</span>
            <h2 class="sec-title">Built for every<br>kind of institute.</h2>
        </div>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            @foreach([
                ['i'=>'fa-chalkboard-teacher','l'=>'Coaching Centers'],
                ['i'=>'fa-school','l'=>'KG to 12 Schools'],
                ['i'=>'fa-laptop-code','l'=>'Skill Training'],
                ['i'=>'fa-language','l'=>'Language Academies'],
                ['i'=>'fa-music','l'=>'Music & Arts'],
                ['i'=>'fa-dumbbell','l'=>'Sports Clubs'],
                ['i'=>'fa-flask','l'=>'Science Tuition'],
                ['i'=>'fa-paint-brush','l'=>'Creative Institutes'],
            ] as $u)
            <a href="{{ route('contact') }}" class="uc-chip"><i class="fas {{ $u['i'] }}"></i> {{ $u['l'] }}</a>
            @endforeach
        </div>
    </div>
</section>

<!-- ══════════════ WHY EDUNEX ERP ══════════════ -->
<section class="compare-section">
    <div class="container px-4">
        <div class="row align-items-end mb-5 g-4">
            <div class="col-lg-6">
                <span class="sec-eyebrow">Why EduNex ERP?</span>
                <h2 class="sec-title" style="margin-bottom:0;">Your team deserves<br>better than <span class="g-text">WhatsApp groups.</span></h2>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <p class="sec-desc" style="margin-bottom:0;">Real institutes, real pain. Here's what running an institute looks like before and after EduNex ERP.</p>
            </div>
        </div>

        <div class="why-split">
            <!-- BEFORE -->
            <div class="why-before">
                <div class="why-label before"><i class="fas fa-times-circle"></i> Before EduNex ERP</div>
                @foreach([
                    ['x'=>'fa-table','t'=>'Attendance in Excel','d'=>'Manual registers, daily data entry, and no parent notifications ever.'],
                    ['x'=>'fa-whatsapp','t'=>'Fees via WhatsApp','d'=>'"Fee paid bhai" — and you have to manually track who actually paid.'],
                    ['x'=>'fa-file-excel','t'=>'Payroll in spreadsheets','d'=>'3 hours every month calculating salaries. Wrong formulas. Late payments.'],
                    ['x'=>'fa-eye-slash','t'=>'Zero visibility','d'=>'No dashboards. No reports. No idea who\'s present, who paid, who\'s late.'],
                    ['x'=>'fa-mobile-alt','t'=>'No student portal','d'=>'Students call to check results, timetables, and fees. Your phone never stops.'],
                ] as $b)
                <div class="why-row">
                    <div class="why-icon-x"><i class="fas {{ $b['x'] }}"></i></div>
                    <div><div class="why-text"><strong>{{ $b['t'] }}</strong><br>{{ $b['d'] }}</div></div>
                </div>
                @endforeach
            </div>

            <!-- AFTER -->
            <div class="why-after">
                <div class="why-label after"><i class="fas fa-check-circle"></i> With EduNex ERP</div>
                @foreach([
                    ['c'=>'fa-fingerprint','t'=>'AI face + GPS attendance','d'=>'Staff attendance marked automatically in under 2 seconds. Zero proxies.'],
                    ['c'=>'fa-credit-card','t'=>'Automated fee collection','d'=>'Online payments, auto-reminders, real-time dashboard. Fees track themselves.'],
                    ['c'=>'fa-money-bill-wave','t'=>'One-click payroll','d'=>'Payslips generated and sent to every staff member\'s WhatsApp in one click.'],
                    ['c'=>'fa-book-reader','t'=>'Digital Library & Discipline','d'=>'Full control over books, resources, and student behavior tracking natively.'],
                    ['c'=>'fa-chart-bar','t'=>'Full visibility dashboard','d'=>'Live attendance, fee status, batch analytics — everything in one screen.'],
                    ['c'=>'fa-mobile-screen','t'=>'Dedicated Mobile App','d'=>'Students and parents check timetables, results, and fees on their phone app. Anytime.'],
                ] as $a)
                <div class="why-row">
                    <div class="why-icon-c"><i class="fas {{ $a['c'] }}"></i></div>
                    <div><div class="why-text"><strong>{{ $a['t'] }}</strong><br>{{ $a['d'] }}</div></div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('pricing') }}" class="btn-primary" style="font-size:0.92rem;padding:13px 28px;">Start Free Trial <i class="fas fa-arrow-right"></i></a>
            <p style="margin-top:12px;font-size:0.75rem;color:var(--muted);"><i class="fas fa-shield-alt me-1" style="color:var(--primary);"></i> No credit card required · Live in 15 minutes</p>
        </div>
    </div>
</section>

<!-- ══════════════ TESTIMONIALS ══════════════ -->
<section class="testi-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow">Real Stories</span>
            <h2 class="sec-title">Loved by institutes<br>worldwide.</h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['n'=>'Rajesh Kumar','r'=>'Director, Apex Coaching Center','i'=>'RK','c'=>'var(--gradient-primary)','q'=>'EduNex ERP completely changed how we manage our 300+ students. The fee reminders alone saved us 10+ hours of phone calls every month.'],
                ['n'=>'Priya Sharma','r'=>'Principal, Bright Minds Academy','i'=>'PS','c'=>'var(--gradient-secondary)','q'=>'The AI face attendance was a game changer — zero proxy marking. And the analytics give me full visibility into every batch.'],
                ['n'=>'Arjun Mehta','r'=>'Owner, CodeCraft Skill Institute','i'=>'AM','c'=>'linear-gradient(135deg,hsl(262,83%,58%),hsl(217,91%,60%))','q'=>'We run 6 tech courses with 400 students. EduNex ERP handles everything from live lectures to payslips in one beautiful platform.'],
            ] as $t)
            <div class="col-lg-4">
                <div class="t-card">
                    <div class="t-stars">★★★★★</div>
                    <p class="t-quote">"{{ $t['q'] }}"</p>
                    <div class="d-flex align-items-center gap-3 mt-auto">
                        <div class="t-av" style="background:{{ $t['c'] }};">{{ $t['i'] }}</div>
                        <div>
                            <div class="t-name">{{ $t['n'] }}</div>
                            <div class="t-role">{{ $t['r'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ══════════════ FAQ ══════════════ -->
<section class="faq-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow">Questions</span>
            <h2 class="sec-title">Everything you<br>need to know.</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAcc">
                    @foreach([
                        ['q'=>'What is EduNex ERP and what does it do?','a'=>'EduNex ERP is India\'s #1 School Management Software and Institute ERP. It automates student attendance using AI face recognition, collects fees online via Razorpay/Stripe, manages school payroll with automatic deductions, runs the library with QR barcodes, conducts live and recorded lectures, and connects parents with a dedicated mobile app. Trusted by 100+ schools, coaching institutes, and colleges.'],
                        ['q'=>'Is EduNex ERP suitable for CBSE and State Board schools?','a'=>'Yes. EduNex ERP is fully compatible with CBSE, ICSE, Gujarat Board, Maharashtra Board, Rajasthan Board, and all State Board schools. The academic modules — timetable, report cards, subjects, and exams — are flexible to match any curriculum structure.'],
                        ['q'=>'How does AI face biometric attendance work?','a'=>'Open the EduNex ERP dashboard on any camera-enabled device. The on-device AI scans the face and matches it against the enrolled biometric descriptor. GPS is verified simultaneously. Attendance is marked in under 2 seconds — no dedicated hardware, fingerprint scanner, or internet connection needed.'],
                        ['q'=>'How does online fee collection work?','a'=>'EduNex ERP integrates with Razorpay and Stripe. Parents receive a fee invoice via WhatsApp with a payment link. They can pay using UPI, Net Banking, or any card. The receipt is instant and accounts update in real-time. No more cash handling or manual fee registers.'],
                        ['q'=>'How does school payroll work?','a'=>'Set each staff member\'s salary, allowances, and deduction rules once. Every month, one click generates net pay, creates a PDF payslip with automatic PF, ESI, TDS deductions, and sends it to each staff member via WhatsApp.'],
                        ['q'=>'Can students use EduNex ERP on their phone?','a'=>'Yes. EduNex ERP uses Progressive Web App (PWA) technology. Students and parents install the app directly from the browser — no App Store download needed. They can check timetables, results, pay fees, join live lectures, and receive attendance alerts in real-time.'],
                        ['q'=>'Is my institute data secure?','a'=>'EduNex ERP uses a multi-tenant architecture where each institute\'s data is completely isolated. Data is encrypted at rest and in transit. No institute can ever access another\'s data. Automated daily backups ensure your data is always safe.'],
                        ['q'=>'Does EduNex ERP work for coaching centres and tuition classes?','a'=>'Yes. EduNex ERP is widely used by coaching centres, tuition classes, skill institutes, and training academies. Batch management, online fee collection, WhatsApp updates, live lectures, and online tests are especially popular with coaching centres.'],
                        ['q'=>'Is there a student limit?','a'=>'No. Enrol as many students as your institute can handle — all plans include unlimited students. No per-student fees, no hidden charges.'],
                        ['q'=>'How do we import our existing student and staff data?','a'=>'Upload your existing data using built-in Excel/CSV templates, or our onboarding team will migrate your legacy records from any previous software at zero cost.'],
                        ['q'=>'Does EduNex ERP send WhatsApp messages to parents?','a'=>'Yes. Automated WhatsApp messages for attendance alerts, fee reminders, exam results, and circulars are built in. Parents stay informed without any manual effort from staff.'],
                        ['q'=>'Can EduNex ERP handle multiple branches?','a'=>'Yes. Full multi-branch support is included. Manage all campuses from one admin panel. Each branch has its own data while head office gets a consolidated real-time view.'],
                        ['q'=>'Does the system support global currencies and payment gateways?','a'=>'Yes. EduNex ERP supports INR, USD, EUR, and other currencies. It integrates with Razorpay (India) and Stripe (global) for online fee collections anywhere in the world.'],
                        ['q'=>'Are software updates and support included?','a'=>'Yes. All updates, new features, and security patches are included in your subscription. Priority email and WhatsApp support is available 6 days a week.'],
                    ] as $i => $faq)
                    <div class="faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h2>
                        <div id="faq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#faqAcc">
                            <div class="accordion-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════ CTA ══════════════ -->
<section class="cta-section">
    <div class="container px-4">
        <div class="cta-box">
            <span class="badge-pill mb-4"><i class="fas fa-rocket me-1"></i> Get Started Today</span>
            <h2>Ready to transform<br>your institute?</h2>
            <p>Join 100+ institutes that have automated their operations. 7-day free trial, no credit card required.</p>
            <div class="d-flex gap-3 flex-wrap justify-content-center mb-4">
                <a href="{{ route('pricing') }}" style="background:#fff;color:#0D9488;border:none;padding:14px 32px;border-radius:10px;font-weight:700;font-size:0.95rem;display:inline-flex;align-items:center;gap:8px;text-decoration:none;box-shadow:0 4px 16px rgba(0,0,0,0.15);transition:all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">Start Free Trial <i class="fas fa-rocket"></i></a>
                <a href="{{ route('contact') }}" style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.4);padding:14px 32px;border-radius:10px;font-weight:600;font-size:0.95rem;display:inline-flex;align-items:center;gap:8px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">Talk to Sales <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="d-flex gap-4 justify-content-center flex-wrap">
                <span class="trust-item"><i class="fas fa-check"></i> No credit card</span>
                <span class="trust-item"><i class="fas fa-check"></i> 7-day free trial</span>
                <span class="trust-item"><i class="fas fa-check"></i> Cancel anytime</span>
                <span class="trust-item"><i class="fas fa-check"></i> 24/7 support</span>
            </div>
        </div>
    </div>
</section>

<!-- Brand JSON-LD -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "SoftwareApplication",
  "name": "EduNex ERP",
  "alternateName": ["Edunex", "EduNex School Software", "EduNex Institute Software", "edunexerp"],
  "applicationCategory": "EducationalApplication",
  "operatingSystem": "Web, Android, iOS",
  "url": "{{ url('/') }}",
  "description": "EduNex ERP is the #1 School Management Software and Institute ERP. Features include AI face biometric attendance, online fee collection, payroll, live lectures, library management, and a mobile app for students and parents.",
  "offers": {
    "@@type": "Offer",
    "price": "0",
    "priceCurrency": "INR",
    "description": "Free 7-day trial with no credit card required"
  },
  "aggregateRating": {
    "@@type": "AggregateRating",
    "ratingValue": "5",
    "reviewCount": "150",
    "bestRating": "5"
  },
  "publisher": {
    "@@type": "Organization",
    "name": "Engenius Digitech",
    "url": "{{ url('/') }}"
  }
}
</script>

<x-frontend-footer/>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script>
    function switchPortal(portalId) {
        document.querySelectorAll('.portal-content').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.portal-tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById(portalId + '-portal').classList.add('active');
        event.currentTarget.classList.add('active');
    }

    // Hero contact form — EmailJS
    (function() { emailjs.init({ publicKey: 'lmK1jA7aTfhahMzac' }); })();

    document.getElementById('hero-ejs-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn  = document.getElementById('hero-ejs-btn');
        const txt  = document.getElementById('hero-ejs-text');
        const load = document.getElementById('hero-ejs-loading');

        btn.disabled = true;
        txt.style.display  = 'none';
        load.style.display = 'flex';

        emailjs.sendForm('service_0xkqhcr', 'template_fghjchm', this)
            .then(function() {
                document.getElementById('hero-form-inner').innerHTML = `
                    <div class="hf-head">
                        <span class="hf-head-eyebrow"><i class="fas fa-check-circle"></i> Message Sent</span>
                        <h3 class="hf-head-title">We'll be in touch soon!</h3>
                        <p class="hf-head-sub">Our team typically responds within 1 business day.</p>
                    </div>
                    <div class="hf-body hf-success-wrap">
                        <div class="hf-success-icon"><i class="fas fa-check"></i></div>
                        <p>Thanks for reaching out! We've received your message and will schedule your personalised demo shortly.</p>
                        <a href="/pricing" style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#0D9488,#1D4ED8);color:#fff;text-decoration:none;padding:11px 24px;border-radius:10px;font-size:0.85rem;font-weight:500;">
                            <i class="fas fa-rocket"></i> View Pricing & Plans
                        </a>
                    </div>`;
            }, function(error) {
                btn.disabled = false;
                txt.style.display = 'flex';
                load.style.display = 'none';
                alert('Something went wrong. Please email us at engeniusdigitech@gmail.com');
                console.error('EmailJS error:', error);
            });
    });
</script>
@include('components.whatsapp-widget')
</body>
</html>
