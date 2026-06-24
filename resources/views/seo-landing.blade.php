<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@php
    use Illuminate\Support\Str;
    // Determine terminology based on page type
    $isSchool    = isset($type) && $type === 'school';
    $typeLabel   = $isSchool ? 'School'    : 'Institute';
    $erpLabel    = $isSchool ? 'School ERP' : 'Institute ERP';
    $softLabel   = $isSchool ? 'School Management Software' : 'Institute Management Software';
    $systemLabel = $isSchool ? 'School Management System'   : 'Institute Management System';
    $prefix      = $isSchool ? 'school-erp' : 'institute-erp';

    // Location fields — support both new model-based vars and legacy plain vars
    $city    = $city    ?? 'India';
    $state   = $state   ?? null;
    $country = $country ?? 'India';

    $stateVal    = $state ?: null;
    $statePart   = $stateVal ? ", {$stateVal}" : '';
    $locationStr = isset($location) ? $location->displayName() : "{$city}{$statePart}, {$country}";

    // Canonical URL — use model-generated URL if passed, else current URL
    $canonicalUrl = $canonicalUrl ?? url()->current();

    // Breadcrumbs — use model-generated breadcrumbs if passed, else build minimal ones
    $breadcrumbs = $breadcrumbs ?? [
        ['label' => 'Home',    'url' => url('/')],
        ['label' => $country,  'url' => url("{$prefix}/" . Str::slug($country))],
        ['label' => $city,     'url' => $canonicalUrl],
    ];

    // SEO meta — unique title + description per location
    $seoTitle = "Best {$softLabel} in {$locationStr} | {$erpLabel} & {$typeLabel} Software — EduNex ERP";

    $seoDesc = $isSchool
        ? "EduNex ERP is the #1 School Management Software & School ERP in {$locationStr}. Our School Management System automates student attendance, online fee collection, school payroll, library, and parent communication for schools in {$city}."
        : "EduNex ERP is the top-rated Institute Management Software & Institute ERP in {$locationStr}. Automate student attendance, fees, academics, and payroll for coaching centers and institutes in {$city}.";

    $stateKw = $stateVal ? ", {$erpLabel} {$stateVal}, school erp {$stateVal}, school management system {$stateVal}" : '';
    $seoKeywords = $isSchool
        ? "school erp {$city}, school software {$city}, school management software {$city}, school management system {$city}, schoolerp {$city}{$stateKw}, school administration software, best school management software, online school management system, school ERP {$country}, student management system, school fee management software, EduNex ERP school"
        : "institute erp {$city}, institute software {$city}, institute management software {$city}, coaching class software {$city}, coaching center software {$city}{$stateKw}, training institute software, institute management system, coaching institute ERP, student management system, EduNex ERP institute, best institute software {$city}";
@endphp
    <x-seo
        :title="$seoTitle"
        :description="$seoDesc"
        :keywords="$seoKeywords"
        :canonical="$canonicalUrl"
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
    padding: 150px 0 80px;
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
    .hero-content { padding: 130px 0 40px; }
    .display-wrapper { padding-bottom: 0; }
    .mobile-mockup { display: none; }
    .desktop-mockup { border-radius: 10px; }
}

@media(max-width:768px) {
    .hero { min-height: auto; }
    .hero-content { padding: 140px 0 50px; }
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
    .hero-content { padding: 130px 0 28px; }
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

/* Custom SEO landing page styles (Light Theme) */
.badge-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(13,148,136,0.08); border: 1px solid rgba(13,148,136,0.2);
    color: #0D9488; border-radius: 9999px;
    font-size: 0.72rem; font-weight: 600; padding: 4px 14px;
    text-transform: uppercase; letter-spacing: 1px;
}
.badge-pill.blue {
    background: rgba(37,99,235,0.08); border-color: rgba(37,99,235,0.2);
    color: #2563EB;
}
.card-glass {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.04);
}

</style>

    @php
        // Pre-compute all values used in JSON-LD to avoid PHP 8.5 parse errors
        // from single-quoted strings with special chars inside {{ }} ternaries.
        $_pageType    = $location->type === 'city' ? 'WebPage' : 'CollectionPage';
        $_placeType   = $location->type === 'city' ? 'City' : ($location->type === 'state' ? 'State' : 'Country');
        $_parentType  = $location->type === 'city' ? 'State' : 'Country';
        $_parentName  = $location->type === 'city' ? ($stateVal ?? $country) : $country;
        $_isCity      = $location->type === 'city';
        $_isState     = $location->type === 'state';
        $_isCountry   = $location->type === 'country';
        $_hasParent   = $location->type === 'city' || $location->type === 'state';
        $_cityE       = addslashes($city);
        $_stateE      = $stateVal ? addslashes($stateVal) : '';
        $_countryE    = addslashes($country);
        $_statepart   = $stateVal ? ', ' . addslashes($stateVal) : '';
        $_locFull     = addslashes($city) . ($stateVal ? ', ' . addslashes($stateVal) : '') . ', ' . addslashes($country);
        $_parentE     = addslashes($location->type === 'city' ? ($stateVal ?? $country) : $country);
        $_seoTitleE   = addslashes($seoTitle);
        $_seoDescE    = addslashes($seoDesc);
        $_erpLabelE   = addslashes($erpLabel);
        $_softLabelE  = addslashes($softLabel);
        $_dateModE    = $location->last_modified->format('Y-m-d');
        $_erpRole         = $isSchool ? 'school' : 'institute';
        $_forRole         = $isSchool ? 'schools' : 'institutes';
        $_attendanceLabel = $isSchool ? 'Student' : 'Batch';
        $_stateOrCtry = addslashes($stateVal ?? $country);
        $_captionE    = 'EduNex ' . $erpLabel . ' — ' . addslashes($city);
    @endphp
    <!-- ══ 1. WebPage ════════════════════════════════════════════════════════ -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "{!! $_pageType !!}",
      "@@id": "{!! $canonicalUrl !!}#webpage",
      "name": "{!! $_seoTitleE !!}",
      "description": "{!! $_seoDescE !!}",
      "url": "{!! $canonicalUrl !!}",
      "inLanguage": "en-IN",
      "dateModified": "{!! $_dateModE !!}",
      "isPartOf": {
        "@@type": "WebSite",
        "@@id": "https://edunexerp.online#website",
        "name": "EduNex ERP",
        "url": "https://edunexerp.online"
      },
      "publisher": {
        "@@type": "Organization",
        "@@id": "https://edunexerp.online#organization",
        "name": "EduNex ERP by Engenius Digitech",
        "url": "https://edunexerp.online",
        "logo": {
          "@@type": "ImageObject",
          "url": "https://edunexerp.online/images/logo.png",
          "width": 200,
          "height": 60
        }
      },
      "primaryImageOfPage": {
        "@@type": "ImageObject",
        "url": "https://edunexerp.online/images/hero-banner-2.png",
        "width": 1200,
        "height": 630,
        "caption": "{!! $_captionE !!}"
      },
      "speakableSpecification": {
        "@@type": "SpeakableSpecification",
        "cssSelector": ["h1", "h2", ".hero-sub", ".sec-desc", ".sec-title"]
      },
      "breadcrumb": { "@@id": "{!! $canonicalUrl !!}#breadcrumb" },
      "about": {
        "@@type": "SoftwareApplication",
        "@@id": "https://edunexerp.online#app",
        "name": "EduNex ERP"
      },
      "mentions": [
        {
          "@@type": "{!! $_placeType !!}",
          "name": "{!! $_cityE !!}",
          "containedInPlace": {
            "@@type": "Country",
            "name": "{!! $_countryE !!}"
          }
        }
      ]
    }
    </script>

    <!-- ══ 2. Organization + LocalBusiness ═══════════════════════════════════ -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": ["Organization", "LocalBusiness"],
      "@@id": "https://edunexerp.online#organization",
      "name": "EduNex ERP",
      "legalName": "Engenius Digitech",
      "alternateName": ["EduNex ERP Software", "EduNex School Management", "EduNex Institute Management"],
      "url": "https://edunexerp.online",
      "logo": {
        "@@type": "ImageObject",
        "url": "https://edunexerp.online/images/logo.png",
        "width": 200,
        "height": 60
      },
      "image": "https://edunexerp.online/images/hero-banner-2.png",
      "description": "EduNex ERP by Engenius Digitech is a comprehensive cloud-based School and Institute ERP delivering attendance, fee management, payroll, library, hostel, and live lecture modules to educational institutions across {!! $_countryE !!} and worldwide.",
      "foundingDate": "2022",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Vadodara",
        "addressLocality": "Vadodara",
        "addressRegion": "Gujarat",
        "postalCode": "390001",
        "addressCountry": "IN"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": 22.3072,
        "longitude": 73.1812
      },
      "areaServed": [
        { "@@type": "Country", "name": "{!! $_countryE !!}" }
        @if($_isState || $_isCity)
        ,{ "@@type": "State", "name": "{!! $_stateE !!}" }
        @endif
        @if($_isCity)
        ,{ "@@type": "City", "name": "{!! $_cityE !!}" }
        @endif
      ],
      "contactPoint": [
        {
          "@@type": "ContactPoint",
          "telephone": "+91-9099988888",
          "contactType": "customer service",
          "areaServed": ["IN", "AE", "US", "GB", "AU", "CA", "SG", "SA", "QA", "KW", "OM", "NP", "BD", "LK", "MY"],
          "availableLanguage": ["English", "Hindi", "Gujarati"],
          "contactOption": "TollFree",
          "hoursAvailable": {
            "@@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
            "opens": "09:00",
            "closes": "18:30"
          }
        },
        {
          "@@type": "ContactPoint",
          "telephone": "+91-9099988888",
          "contactType": "sales",
          "availableLanguage": ["English", "Hindi"]
        },
        {
          "@@type": "ContactPoint",
          "contactType": "technical support",
          "url": "https://edunexerp.online/contact",
          "availableLanguage": ["English", "Hindi"]
        }
      ],
      "sameAs": [
        "https://www.facebook.com/edunexerp",
        "https://twitter.com/edunexerp",
        "https://www.instagram.com/edunexerp",
        "https://www.linkedin.com/company/edunexerp",
        "https://www.youtube.com/@edunexerp"
      ],
      "hasOfferCatalog": {
        "@@type": "OfferCatalog",
        "name": "{!! $_erpLabelE !!} Plans",
        "itemListElement": [
          {
            "@@type": "Offer",
            "name": "Starter Plan",
            "description": "For small schools up to 200 students. Includes attendance, fees, and timetable.",
            "price": "4999",
            "priceCurrency": "INR",
            "priceValidUntil": "2027-03-31",
            "availability": "https://schema.org/InStock",
            "url": "https://edunexerp.online/pricing"
          },
          {
            "@@type": "Offer",
            "name": "Growth Plan",
            "description": "For growing institutes up to 1000 students. All modules including payroll.",
            "price": "9999",
            "priceCurrency": "INR",
            "priceValidUntil": "2027-03-31",
            "availability": "https://schema.org/InStock",
            "url": "https://edunexerp.online/pricing"
          },
          {
            "@@type": "Offer",
            "name": "Enterprise Plan",
            "description": "Unlimited students, multi-branch, white-label, dedicated support.",
            "price": "0",
            "priceCurrency": "INR",
            "priceValidUntil": "2027-03-31",
            "availability": "https://schema.org/InStock",
            "url": "https://edunexerp.online/contact"
          }
        ]
      },
      "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "184",
        "bestRating": "5",
        "worstRating": "1"
      },
      "review": [
        {
          "@@type": "Review",
          "reviewRating": { "@@type": "Rating", "ratingValue": "5", "bestRating": "5" },
          "author": { "@@type": "Person", "name": "Ramesh Patel" },
          "datePublished": "2025-11-10",
          "reviewBody": "EduNex ERP transformed our school completely. Fee collection, attendance, and payroll are fully automated. Highly recommend for any school in {!! $_cityE !!}."
        },
        {
          "@@type": "Review",
          "reviewRating": { "@@type": "Rating", "ratingValue": "5", "bestRating": "5" },
          "author": { "@@type": "Person", "name": "Priya Sharma" },
          "datePublished": "2025-10-22",
          "reviewBody": "The AI biometric attendance is a game changer. No more manual registers. Support team is incredibly responsive."
        },
        {
          "@@type": "Review",
          "reviewRating": { "@@type": "Rating", "ratingValue": "5", "bestRating": "5" },
          "author": { "@@type": "Person", "name": "Mohammed Al Rashid" },
          "datePublished": "2025-09-14",
          "reviewBody": "We deployed EduNex ERP across our three coaching branches. The centralized dashboard saves us hours of admin work every day."
        }
      ]
    }
    </script>

    <!-- ══ 3. SoftwareApplication ══════════════════════════════════════════ -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "SoftwareApplication",
      "@@id": "https://edunexerp.online#app",
      "name": "EduNex ERP",
      "alternateName": "EduNex {!! $_erpLabelE !!}",
      "applicationCategory": "BusinessApplication",
      "applicationSubCategory": "EducationApplication",
      "operatingSystem": "Web Browser, Android 6.0+, iOS 13+",
      "softwareVersion": "2.0",
      "releaseNotes": "https://edunexerp.online/blogs",
      "url": "https://edunexerp.online",
      "downloadUrl": "https://edunexerp.online/pricing",
      "screenshot": [
        {
          "@@type": "ImageObject",
          "url": "https://edunexerp.online/images/hero-banner-2.png",
          "caption": "EduNex ERP Admin Dashboard",
          "width": 1280,
          "height": 720
        },
        {
          "@@type": "ImageObject",
          "url": "https://edunexerp.online/images/mobile-screen.png",
          "caption": "EduNex ERP Mobile App",
          "width": 390,
          "height": 844
        }
      ],
      "featureList": [
        "AI Face Recognition Staff Attendance",
        "GPS Geofenced Biometric Check-In",
        "Online Fee Collection with Razorpay",
        "WhatsApp Fee Reminders & Notifications",
        "Student Batch-wise Attendance Management",
        "Live Video Lecture Platform",
        "Statutory HR & Payroll with PF/ESIC/TDS",
        "Library Management System",
        "Hostel & Boarding Management",
        "Digital Online Examinations & Proctoring",
        "Store & Inventory Management",
        "Student & Parent Mobile Portal App",
        "Transport Route GPS Tracking",
        "Multi-Branch Centralized Dashboard",
        "Discipline & Behavior Scoring",
        "Image Gallery & Event Management",
        "Digital Study Materials Repository",
        "Timetable & Class Scheduling",
        "Academic Reports & Analytics",
        "WhatsApp API Business Integration"
      ],
      "offers": {
        "@@type": "Offer",
        "price": "4999",
        "priceCurrency": "INR",
        "priceValidUntil": "2027-03-31",
        "availability": "https://schema.org/InStock",
        "url": "https://edunexerp.online/pricing",
        "seller": { "@@id": "https://edunexerp.online#organization" }
      },
      "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "184",
        "bestRating": "5",
        "worstRating": "1"
      },
      "provider": { "@@id": "https://edunexerp.online#organization" },
      "countriesSupported": "IN AE US GB AU CA SG SA QA KW OM BH NP BD LK MY ZA KE NG DE FR NL JP KR HK ID PH TH VN NZ"
    }
    </script>

    <!-- ══ 4. Service (location-specific) ════════════════════════════════════ -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Service",
      "@@id": "{!! $canonicalUrl !!}#service",
      "name": "{!! $_erpLabelE !!} in {!! $_cityE !!}",
      "alternateName": "{!! $_softLabelE !!} {!! $_cityE !!}",
      "description": "{!! $_seoDescE !!}",
      "serviceType": "{!! $_erpLabelE !!}",
      "category": "Educational Technology Software",
      "provider": { "@@id": "https://edunexerp.online#organization" },
      "areaServed": {
        "@@type": "{!! $_placeType !!}",
        "name": "{!! $_cityE !!}"
        @if($_hasParent)
        ,"containedInPlace": {
          "@@type": "Country",
          "name": "{!! $_countryE !!}"
        }
        @endif
      },
      "audience": {
        "@@type": "EducationalAudience",
        "educationalRole": "{!! $_erpRole !!} administrator"
      },
      "offers": {
        "@@type": "Offer",
        "price": "4999",
        "priceCurrency": "INR",
        "priceValidUntil": "2027-03-31",
        "availability": "https://schema.org/InStock",
        "url": "https://edunexerp.online/pricing"
      },
      "hasOfferCatalog": {
        "@@type": "OfferCatalog",
        "name": "{!! $_erpLabelE !!} Modules",
        "itemListElement": [
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "{!! addslashes($_attendanceLabel) !!} Attendance Management" } },
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "Online Fee Collection & Billing" } },
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "HR & Statutory Payroll" } },
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "Library Management System" } },
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "Online Examinations & Assessment" } },
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "Live Video Lecture Platform" } },
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "AI Biometric Staff Attendance" } },
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "WhatsApp Parent Communication" } },
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "Hostel & Boarding Management" } },
          { "@@type": "Offer", "itemOffered": { "@@type": "Service", "name": "Multi-Branch Centralized Dashboard" } }
        ]
      },
      "termsOfService": "https://edunexerp.online/legal/terms",
      "url": "{!! $canonicalUrl !!}"
    }
    </script>

    <!-- ══ 5. FAQPage (location-injected) ════════════════════════════════════ -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "@@id": "{!! $canonicalUrl !!}#faq",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "Is EduNex ERP available for {!! $_forRole !!} in {!! $_cityE !!}?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Yes! EduNex ERP provides full {!! $_erpLabelE !!} services for {!! $_forRole !!} in {!! $_locFull !!}. Our cloud platform is accessible from anywhere. Our onboarding team supports localised setup, fee structures, and compliance for your region."
          }
        },
        {
          "@@type": "Question",
          "name": "What is the best {!! $_erpLabelE !!} software in {!! $_cityE !!}?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "EduNex ERP by Engenius Digitech is rated the #1 {!! $_erpLabelE !!} in {!! $_cityE !!} for its comprehensive feature set: AI biometric attendance, online fee collection with Razorpay, WhatsApp reminders, payroll, live lectures, library management, and a dedicated mobile app for students and parents. Trusted by 100+ institutions globally."
          }
        },
        {
          "@@type": "Question",
          "name": "How fast can we set up EduNex ERP for our {!! $_erpRole !!}?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Setup is incredibly fast — our cloud platform requires no local server installation. Once you sign up, our onboarding team migrates your student database, configures your fee structures, and gets your {!! $_erpRole !!} in {!! $_cityE !!} live in under 15 minutes."
          }
        },
        {
          "@@type": "Question",
          "name": "Does the AI Biometric Attendance require expensive hardware?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "No. EduNex ERP’s AI face recognition runs on any standard Android or iOS tablet, smartphone, or laptop camera — no dedicated biometric machines needed. Combined with GPS geofencing, it prevents proxy attendance and verifies staff check-ins in under 2 seconds."
          }
        },
        {
          "@@type": "Question",
          "name": "Can we manage multiple campuses or branches in {!! $_cityE !!} from one account?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Yes. EduNex ERP’s multi-branch dashboard lets trustees and administrators view consolidated metrics, financial reports, and attendance trends across all campuses in {!! $_cityE !!} and beyond — all from a single master login."
          }
        },
        {
          "@@type": "Question",
          "name": "How does the WhatsApp fee reminder system work?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "EduNex ERP integrates with the official WhatsApp Business API. The billing engine monitors overdue fees automatically, and administrators can dispatch personalised payment links to parents’ WhatsApp numbers in one click. Parents pay instantly via UPI, card, or net banking through Razorpay."
          }
        },
        {
          "@@type": "Question",
          "name": "How secure is our {!! $_erpRole !!}’s data on EduNex ERP?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Security is our highest priority. EduNex ERP uses a multi-tenant cloud architecture where each institution’s data is housed in a completely isolated database silo, encrypted at rest and in transit. Your student records, fee histories, and payroll data are 100% invisible to other institutions on the platform."
          }
        },
        {
          "@@type": "Question",
          "name": "What is the pricing for EduNex {!! $_erpLabelE !!}?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "EduNex ERP pricing starts from ₹4,999/year for small institutions (up to 200 students). Plans scale based on student count and required modules. A free trial is available so you can test all features before committing. Visit edunexerp.online/pricing for full plan details."
          }
        }
      ]
    }
    </script>

    <!-- ══ 6. BreadcrumbList ═══════════════════════════════════════════════ -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BreadcrumbList",
      "@@id": "{!! $canonicalUrl !!}#breadcrumb",
      "itemListElement": [
        @foreach($breadcrumbs as $i => $crumb)
        @php $_cLabel = addslashes($crumb['label']); $_cUrl = $crumb['url']; @endphp
        {
          "@@type": "ListItem",
          "position": {!! $i + 1 !!},
          "name": "{!! $_cLabel !!}",
          "item": "{!! $_cUrl !!}"
        }
        @if(!$loop->last),@endif
        @endforeach
      ]
    }
    </script>

    @if($_isCountry && $statesInCountry->isNotEmpty())
    <!-- ══ 7a. ItemList — states in this country ══════════════════════════ -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "ItemList",
      "@@id": "{!! $canonicalUrl !!}#regions",
      "name": "{!! $_erpLabelE !!} Coverage — Regions in {!! $_countryE !!}",
      "description": "Browse EduNex {!! $_erpLabelE !!} pages for every state and province in {!! $_countryE !!}.",
      "numberOfItems": {!! $statesInCountry->count() !!},
      "itemListElement": [
        @foreach($statesInCountry as $i => $loc)
        @php $_locName = $_erpLabelE . ' in ' . addslashes($loc->state_name); $_locUrl = url($prefix . '/' . $loc->country_slug . '/' . $loc->state_slug); @endphp
        {
          "@@type": "ListItem",
          "position": {!! $i + 1 !!},
          "name": "{!! $_locName !!}",
          "url": "{!! $_locUrl !!}"
        }
        @if(!$loop->last),@endif
        @endforeach
      ]
    }
    </script>
    @endif

    @if($_isState && $statesInCountry->isNotEmpty())
    <!-- ══ 7b. ItemList — sibling regions in same country ════════════════ -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "ItemList",
      "@@id": "{!! $canonicalUrl !!}#related-regions",
      "name": "Other {!! $_erpLabelE !!} Regions in {!! $_countryE !!}",
      "description": "Explore EduNex {!! $_erpLabelE !!} coverage in other states and provinces across {!! $_countryE !!}.",
      "numberOfItems": {!! $statesInCountry->count() !!},
      "itemListElement": [
        @foreach($statesInCountry as $i => $loc)
        @php $_locName = $_erpLabelE . ' in ' . addslashes($loc->state_name); $_locUrl = url($prefix . '/' . $loc->country_slug . '/' . $loc->state_slug); @endphp
        {
          "@@type": "ListItem",
          "position": {!! $i + 1 !!},
          "name": "{!! $_locName !!}",
          "url": "{!! $_locUrl !!}"
        }
        @if(!$loop->last),@endif
        @endforeach
      ]
    }
    </script>
    @endif

    @if($_isCity && $siblingsInState->isNotEmpty())
    <!-- ══ 7c. ItemList — nearby cities in same state ═════════════════════ -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "ItemList",
      "@@id": "{!! $canonicalUrl !!}#nearby-cities",
      "name": "EduNex {!! $_erpLabelE !!} — Nearby Cities in {!! $_stateOrCtry !!}",
      "description": "EduNex {!! $_erpLabelE !!} is also available in these nearby cities.",
      "numberOfItems": {!! $siblingsInState->count() !!},
      "itemListElement": [
        @foreach($siblingsInState as $i => $loc)
        @php $_locName = $_erpLabelE . ' in ' . addslashes($loc->city_name); $_locUrl = url($prefix . '/' . $loc->country_slug . '/' . $loc->state_slug . '/' . $loc->city_slug); @endphp
        {
          "@@type": "ListItem",
          "position": {!! $i + 1 !!},
          "name": "{!! $_locName !!}",
          "url": "{!! $_locUrl !!}"
        }
        @if(!$loop->last),@endif
        @endforeach
      ]
    }
    </script>
    @endif

</head>
<body>

@include('components.frontend-navbar')

<section class="hero">
    <!-- Background layers -->
    <div class="hero-grid"></div>
    <div class="hero-orb orb-teal"></div>
    <div class="hero-orb orb-blue"></div>
    <div class="hero-orb orb-violet"></div>

    <div class="hero-content">
        <div class="container px-4">
            <div class="row align-items-center g-5">

                <!-- Copy -->
                <div class="col-lg-6 text-center text-lg-start hero-copy">
                    <h1 class="hero-h1">
                        {{ $isSchool ? 'Best School Management Software' : 'Smartest Institute ERP' }}<br>
                        <span class="hero-grad">for {{ $typeLabel }}s in {{ $city }}.</span>
                    </h1>
                    <p class="hero-sub">
                        @if($isSchool)
                            The complete <strong>School Management System</strong> for {{ $city }} schools. Automate attendance, fees, payroll, and parent communication with the #1 <strong>School ERP Software</strong>.
                        @else
                            The complete <strong>Institute Management Software</strong> for {{ $city }} coaching centers. Automate fees, attendance, live lectures, and payroll with our top-rated <strong>Institute ERP</strong>.
                        @endif
                    </p>

                    <div class="hero-features">
                        <span class="hfeat"><i class="fas fa-university"></i> Complete ERP</span>
                        <span class="hfeat"><i class="fas fa-credit-card"></i> Online Fee Payments</span>
                        <span class="hfeat"><i class="fab fa-whatsapp"></i> WhatsApp Integration</span>
                        <span class="hfeat"><i class="fas fa-book-open"></i> Academics Management</span>
                        <span class="hfeat"><i class="fas fa-video"></i> Live Lectures</span>
                        <span class="hfeat"><i class="fas fa-face-smile-beam"></i> AI Staff Biometrics</span>
                        <span class="hfeat"><i class="fas fa-chart-line"></i> Analytics & Reports</span>
                        <span class="hfeat"><i class="fas fa-book"></i> Library Management</span>
                        <span class="hfeat"><i class="fas fa-mobile-alt"></i> Android & iOS App</span>
                        <span class="hfeat"><i class="fas fa-users"></i> Parent & Student Portal</span>
                        <span class="hfeat"><i class="fas fa-cogs"></i> And much more...</span>
                    </div>

                    <div class="hero-cta-wrap">
                        @auth
                            <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : url('/dashboard') }}" class="btn-hero-primary">
                                Dashboard <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('pricing') }}" class="btn-hero-primary">
                                Start Free Trial <i class="fas fa-rocket"></i>
                            </a>
                            <a href="#staff" class="btn-hero-ghost">
                                <i class="fas fa-fingerprint"></i> See AI Features
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
                        <span><strong style="color:rgba(255,255,255,0.82);">100+ institutes</strong> in {{ $country }} trust EduNex ERP</span>
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
                                    <input type="hidden" name="inquiry_type" value="Demo Request — SEO Landing Page ({{ $city }})">
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
                                            <textarea name="message" placeholder="Tell us about your institute in {{ $city }} — type, student count, what you need..." required></textarea>
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
<!-- ══════════════ MOBILE APP ══════════════ -->

    <!-- ══════════════ Dashboard Screenshot ══════════════ -->
<section id="dashboard" class="staff-section" style="background:#fff; border-top:1px solid #E8EDF5; padding:80px 0;">  
    <div class="staff-blob-2" style="background:hsla(262,83%,58%,0.07); top:-100px; left:-100px;"></div>
    <div class="staff-blob-1" style="background:hsla(217,91%,60%,0.08); bottom:-80px; right:-80px;"></div>
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="sec-eyebrow" style="color:#7C3AED;">All-in-One Dashboard</span>
                <h2 class="sec-title">Manage your entire {{ $typeLabel }} from a single dashboard.</h2>

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
                    <img src="{{ asset('images/dashboard.png') }}" alt="EduNex {{ $erpLabel }} Dashboard" style="max-width: 924px; width: 100%; position:relative; z-index:2; filter: drop-shadow(0 25px 50px rgba(0,0,0,0.5));">
                </div>
            </div>           
        </div>
    </div>
</section>

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
                <span class="sec-eyebrow" style="color: #7C3AED;">Dedicated Mobile App</span>
                <h2 class="sec-title">The entire institute in <br><span class="g-text-2">their pocket.</span></h2>
                <p class="sec-desc mb-4">Empower your students and parents with a modern, native-like mobile app. They can check timetables, track attendance, pay fees, and join live classes from anywhere.</p>
                
                <ul class="feat-list mb-4" style="max-width: 450px; list-style: none; padding: 0;">
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:var(--muted);"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> Real-time attendance & result notifications</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:var(--muted);"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> Online fee payments with instant receipts</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:var(--muted);"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> One-tap join for live video lectures</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:var(--muted);"><i class="fas fa-check-circle" style="color:#7C3AED; font-size:1.1rem;"></i> Access study materials & homework</li>
                </ul>

                <div class="d-flex gap-3 mt-4">
                    <a href="{{ route('contact') }}" class="btn-primary" style="background: var(--gradient-secondary); box-shadow: var(--glow-secondary);">See App Demo <i class="fas fa-mobile-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Stats strip -->
    <div class="stats-strip">
        <div class="container px-4">
            <div class="d-flex align-items-center justify-content-center gap-4 gap-md-5 flex-wrap text-center">
                <div><div class="stat-val g-text">100<span>+</span></div><div class="stat-lbl">Institutes</div></div>
                <div class="stat-pipe d-none d-md-block"></div>
                <div><div class="stat-val g-text">50K<span>+</span></div><div class="stat-lbl">Students</div></div>
                <div class="stat-pipe d-none d-md-block"></div>
                <div><div class="stat-val g-text">99.9<span>%</span></div><div class="stat-lbl">Uptime</div></div>
                <div class="stat-pipe d-none d-md-block"></div>
                <div><div class="stat-val g-text">24/7</div><div class="stat-lbl">Support</div></div>
                <div class="stat-pipe d-none d-md-block"></div>
                <div><div class="stat-val" style="color:hsl(38,92%,60%);">5★</div><div class="stat-lbl">Rating</div></div>
            </div>
        </div>
    </div>

<!-- ══════════════ ABOUT SCHOOL ERP ══════════════ -->
<section id="about-erp" class="feat-section" style="background: #fff; border-top: 1px solid #E8EDF5; padding: 80px 0;">
    <div class="container px-4">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="badge-pill mb-3"><i class="fas fa-school me-1"></i> Local Education Landscape</span>
                <h2 class="sec-title" style="margin-bottom:20px;">Modernizing {{ $typeLabel }} Operations in <span class="g-text">{{ $city }}</span></h2>
                @if($isSchool)
                <p class="sec-desc" style="font-size:0.95rem; margin-bottom:24px;">{{ $city }}'s educational sector is undergoing a digital transformation. Schools running on manual registers, disjointed spreadsheets, and WhatsApp groups are falling behind. Our <strong>School Management Software</strong> — a fully-integrated <strong>School ERP System</strong> — centralizes all operations: student enrolment, fee collections, attendance, academics, payroll, and parent communication. From CBSE and ICSE to state boards, EduNex ERP's <strong>School Management System</strong> is built for the complexity of modern schools in {{ $city }}.</p>
                @else
                <p class="sec-desc" style="font-size:0.95rem; margin-bottom:24px;">The educational landscape in {{ $city }} is experiencing rapid growth. Coaching institutes, training centers, and skill academies can no longer afford to operate using manual registers, disjointed spreadsheets, or WhatsApp groups. Our <strong>Institute Management Software</strong> — a powerful <strong>Institute ERP</strong> — automates student enrollments, fee collections, attendance, live lectures, and payroll in one unified platform.</p>
                @endif
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-check-circle" style="color:var(--primary); margin-top:3px;"></i>
                            <div>
                                <h6 class="mb-1" style="font-weight:600; font-size:0.9rem;">State & Central Boards</h6>
                                <p style="font-size:0.75rem; color:var(--muted); line-height:1.4; margin-bottom:0;">Tailored for CBSE, ICSE, IB, and State Board compliance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-check-circle" style="color:var(--primary); margin-top:3px;"></i>
                            <div>
                                <h6 class="mb-1" style="font-weight:600; font-size:0.9rem;">Multi-Branch Sync</h6>
                                <p style="font-size:0.75rem; color:var(--muted); line-height:1.4; margin-bottom:0;">Unify multiple campuses in {{ $city }} effortlessly.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-glass p-4" style="background: var(--card-bg); border-color: var(--border);">
                    <h4 style="font-size:1.15rem; font-weight:600; margin-bottom:20px; letter-spacing:-0.5px;" class="g-text">Operational Bottlenecks We Solve:</h4>
                    
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="bicon bi-rose" style="width:36px; height:36px; border-radius:8px; font-size:0.9rem; flex-shrink:0; margin-bottom:0; display:flex; align-items:center; justify-content:center;"><i class="fas fa-chart-pie"></i></div>
                        <div>
                            <h5 style="font-size:0.9rem; font-weight:500; color:var(--foreground); margin-bottom:4px;">Administration & Enrollment Bottlenecks</h5>
                            <p style="font-size:0.8rem; color:var(--muted); line-height:1.6; margin-bottom:0;">Consolidate disconnected tools into a single multi-tenant cloud dashboard. Track student Lifecycle milestones seamlessly.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="bicon bi-amber" style="width:36px; height:36px; border-radius:8px; font-size:0.9rem; flex-shrink:0; margin-bottom:0; display:flex; align-items:center; justify-content:center;"><i class="fas fa-money-check-dollar"></i></div>
                        <div>
                            <h5 style="font-size:0.9rem; font-weight:500; color:var(--foreground); margin-bottom:4px;">Complex Cash Flow & Fee Collections</h5>
                            <p style="font-size:0.8rem; color:var(--muted); line-height:1.6; margin-bottom:0;">Automate invoicing, online payments with Razorpay, and direct WhatsApp reminders to reduce fee outstanding to zero.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="bicon bi-blue" style="width:36px; height:36px; border-radius:8px; font-size:0.9rem; flex-shrink:0; margin-bottom:0; display:flex; align-items:center; justify-content:center;"><i class="fas fa-id-card"></i></div>
                        <div>
                            <h5 style="font-size:0.9rem; font-weight:500; color:var(--foreground); margin-bottom:4px;">Proxy Records & Attendance Drudgery</h5>
                            <p style="font-size:0.8rem; color:var(--muted); line-height:1.6; margin-bottom:0;">Biometric AI face scanning verified by GPS geofencing prevents buddy punching and marks entries in under 2 seconds.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3">
                        <div class="bicon bi-violet" style="width:36px; height:36px; border-radius:8px; font-size:0.9rem; flex-shrink:0; margin-bottom:0; display:flex; align-items:center; justify-content:center;"><i class="fas fa-comments"></i></div>
                        <div>
                            <h5 style="font-size:0.9rem; font-weight:500; color:var(--foreground); margin-bottom:4px;">Scattered Communication & WhatsApp Spam</h5>
                            <p style="font-size:0.8rem; color:var(--muted); line-height:1.6; margin-bottom:0;">Deliver structured daily homework, results, and notifications directly on a sleek parent app without messy group chats.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════ FEATURES ══════════════ -->
<section id="features" class="feat-section">
    <div class="container px-4">
        <div class="row align-items-end mb-5">
            <div class="col-lg-7">
                <span class="sec-eyebrow">Platform Features</span>
                <h2 class="sec-title" style="margin-bottom:0;">Everything your institute<br>needs. <span class="g-text">All connected.</span></h2>
            </div>
            <div class="col-lg-5 mt-3 mt-lg-0">
                <p class="sec-desc" style="margin-bottom:0;">Every module talks to each other — from a student's first enrolment to a teacher's monthly payslip. Nothing falls through the cracks.</p>
            </div>
        </div>
        <div class="feat-magazine">
            <!-- Hero card -->
            <div class="feat-hero">
                <div class="feat-card is-hero" style="background:hsla(174,72%,56%,0.06);border-color:hsla(174,72%,56%,0.2);height:100%;">
                    <div class="feat-icon-wrap" style="background:hsla(174,72%,56%,0.18);color:#0D9488;"><i class="fas fa-fingerprint"></i></div>
                    <div class="feat-name">AI Biometric Staff Attendance</div>
                    <div class="feat-desc">The world's most reliable staff attendance — face recognition verified by GPS in under 2 seconds. No buddy punching, no manual entries, no excuses.</div>
                    <div class="feat-hero-chips">
                        <span class="feat-chip"><i class="fas fa-bolt"></i> &lt;2 sec verification</span>
                        <span class="feat-chip"><i class="fas fa-shield-alt"></i> Anti-spoof AI</span>
                        <span class="feat-chip"><i class="fas fa-location-dot"></i> GPS geofenced</span>
                        <span class="feat-chip"><i class="fas fa-wifi-slash"></i> Offline capable</span>
                    </div>
                </div>
            </div>
            <!-- Small cards -->
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(37,99,235,0.12);color:#2563EB;"><i class="fas fa-credit-card"></i></div>
                <div class="feat-name">Fee &amp; Payments</div>
                <div class="feat-desc">Online collection with Razorpay. Automatic WhatsApp reminders. Real-time dashboards.</div>
            </div>
            <div class="feat-card" style="cursor: pointer;" onclick="window.location='{{ auth()->check() ? route('staff-payrolls.index') : route('login') }}'">
                <div class="feat-icon-wrap" style="background:rgba(245,158,11,0.12);color:#B45309;"><i class="fas fa-file-invoice-dollar"></i></div>
                <div class="feat-name">Statutory HR &amp; Payroll <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size:0.6rem;padding:2px 8px;margin-left:4px;">ENHANCED</span></div>
                <div class="feat-desc">Configurable PF/ESIC rates, automated Indian tax TDS brackets, separate Casual/Earned leave tracking, and attendance pro-rating.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(16,185,129,0.1);color:#047857;"><i class="fas fa-calendar-check"></i></div>
                <div class="feat-name">Student Attendance</div>
                <div class="feat-desc">Batch-wise marking in one tap. Monthly reports auto-generated, parents notified instantly.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(139,92,246,0.12);color:#6D28D9;"><i class="fas fa-video"></i></div>
                <div class="feat-name">Live Lectures</div>
                <div class="feat-desc">Host live classes inside EduNex ERP. Students join via their dedicated mobile app — no Zoom needed.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(16,185,129,0.1);color:#047857;"><i class="fas fa-chart-line"></i></div>
                <div class="feat-name">Analytics &amp; Reports</div>
                <div class="feat-desc">Full visibility: student performance, attendance trends, fee collection, and staff punctuality.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(236,72,153,0.1);color:#BE185D;"><i class="fas fa-book-reader"></i></div>
                <div class="feat-name">Library Management</div>
                <div class="feat-desc">Complete digital library system. Track books, manage issues, handle fines, and provide digital resources.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(234,88,12,0.1);color:#C2410C;"><i class="fas fa-balance-scale"></i></div>
                <div class="feat-name">Discipline Management</div>
                <div class="feat-desc">Track student behavior with dynamic scoring. Log infractions, deduct points, and monitor progress.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(14,165,233,0.1);color:#0369A1;"><i class="fas fa-images"></i></div>
                <div class="feat-name">Image Gallery</div>
                <div class="feat-desc">Share memories securely. Upload photos and videos of institute events directly to student dashboards.</div>
            </div>
            <div class="feat-card" style="cursor: pointer;" onclick="window.location='{{ route('digital.assessment') }}'">
                <div class="feat-icon-wrap" style="background:rgba(99,102,241,0.12);color:#4338CA;"><i class="fas fa-laptop-code"></i></div>
                <div class="feat-name">Online Examinations <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size:0.6rem;padding:2px 8px;margin-left:4px;">NEW</span></div>
                <div class="feat-desc">Conduct secure online exams. Auto-grading MCQs, centralized question banks, performance charts, and remote proctoring alerts. <span style="color:#0D9488;font-weight:600;display:block;margin-top:6px;">Explore Platform <i class="fas fa-arrow-right"></i></span></div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(20,184,166,0.12);color:#0F766E;"><i class="fas fa-hotel"></i></div>
                <div class="feat-name">Hostel Management <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size:0.6rem;padding:2px 8px;margin-left:4px;">NEW</span></div>
                <div class="feat-desc">Complete boarding school suite. Manage room allocations, roommates directory, mess menus, and auto-generate monthly billing statements.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(245,158,11,0.12);color:#B45309;"><i class="fas fa-boxes"></i></div>
                <div class="feat-name">Store &amp; Inventory <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size:0.6rem;padding:2px 8px;margin-left:4px;">NEW</span></div>
                <div class="feat-desc">Track stationery, uniforms, and lab supplies. Manage vendor directories, purchase requisitions, and auto-adjust stock levels upon delivery.</div>
            </div>
            <div class="feat-card" style="cursor: pointer;" onclick="window.location='{{ auth()->check() ? route('visitors.index') : route('login') }}'">
                <div class="feat-icon-wrap" style="background:rgba(16,185,129,0.12);color:#047857;"><i class="fas fa-id-badge"></i></div>
                <div class="feat-name">Visitor Gate Security <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size:0.6rem;padding:2px 8px;margin-left:4px;">NEW</span></div>
                <div class="feat-desc">Self-registration QR gate poster, receptionist live approval wait status screen, and printable visitor gate passes.</div>
            </div>
            <div class="feat-card" style="cursor: pointer;" onclick="window.location='{{ auth()->check() ? route('accounting.dashboard') : route('login') }}'">
                <div class="feat-icon-wrap" style="background:rgba(99,102,241,0.12);color:#4338CA;"><i class="fas fa-calculator"></i></div>
                <div class="feat-name">Accounting &amp; Tally Sync <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size:0.6rem;padding:2px 8px;margin-left:4px;">NEW</span></div>
                <div class="feat-desc">Double-entry ledger journal vouchers, dynamic GST reports (CGST/SGST/IGST), and standard Tally XML sync data exporter.</div>
            </div>
            <div class="feat-card" style="cursor: pointer;" onclick="window.location='{{ auth()->check() ? route('transport.tracking.index') : route('login') }}'">
                <div class="feat-icon-wrap" style="background:rgba(14,165,233,0.12);color:#0284C7;"><i class="fas fa-map-location-dot"></i></div>
                <div class="feat-name">Transit Tracking &amp; TSP <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size:0.6rem;padding:2px 8px;margin-left:4px;">NEW</span></div>
                <div class="feat-desc">GPS route tracking simulator with Leaflet maps, nearest-neighbor TSP route optimizer, student boarding checklist, and parent alerts.</div>
            </div>
        </div>

        <!-- In-depth features accordion -->
        <div class="text-center mt-5 mb-4 pt-4">
            <span class="badge-pill mb-2"><i class="fas fa-magnifying-glass me-1"></i> Deep-Dive Modules</span>
            <h3 style="font-size:1.65rem; font-weight:600; letter-spacing:-0.5px; margin-bottom:12px;">Core Modules In-Depth</h3>
            <p style="font-size:0.9rem; color:var(--muted); max-width:500px; margin:0 auto 30px;">Explore the full capabilities and workflow details of our twelve primary administration and educational management tools.</p>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="accordion" id="featuresAccLeft">
                    @foreach([
                        [
                            'title' => 'Student Information Management',
                            'icon' => 'fa-user-graduate',
                            'd1' => 'Manage the entire student lifecycle from initial inquiry and admission to final alumni graduation. Edunex ERP stores detailed student profiles, including emergency medical history, parent contact information, document repositories, and academic records in a highly secure, searchable cloud database.',
                            'd2' => 'With this module, administrators can manage student transfers between sections, issue digital transfer certificates (TC), and track extracurricular milestones. The intuitive search interface allows teachers to instantly retrieve student profiles during parent-teacher meetings, ensuring that every discussion is backed by accurate, historical data.'
                        ],
                        [
                            'title' => 'Attendance Management',
                            'icon' => 'fa-calendar-check',
                            'd1' => 'Say goodbye to dusty attendance registers and slow manual entries. The digital attendance module allows teachers to mark daily student presence in under a minute via a mobile phone or classroom tablet. The system automatically calculates monthly attendance percentages and alerts administrators to chronic absenteeism.',
                            'd2' => 'Once marked, the system immediately cross-references the data and updates the parent app. If a student is marked absent without prior leave approval, an automated WhatsApp alert is dispatched to the parent, ensuring full transparency and keeping student safety at the center of school operations.'
                        ],
                        [
                            'title' => 'Face Recognition Attendance',
                            'icon' => 'fa-face-smile-beam',
                            'd1' => 'The crown jewel of our attendance suite is the AI-powered Facial Recognition Module. Designed to run on any standard tablet or smartphone camera, the system utilizes advanced neural networks to identify and verify staff or student identities in under two seconds with 99.9% accuracy.',
                            'd2' => 'To ensure absolute security, the system features sophisticated anti-spoofing technology, preventing the use of printed photos or digital screens to fake check-ins. Combined with GPS geofencing, this ensures that staff and students are physically present on school grounds before their mark-in time is recorded.'
                        ],
                        [
                            'title' => 'Staff Management',
                            'icon' => 'fa-users-gear',
                            'd1' => 'Empower your HR department with a comprehensive staff directory, digital profiles, and a robust payroll processing system. Track teacher qualifications, contract renewals, historical teaching schedules, and leave balances in a single, organized interface.',
                            'd2' => 'The payroll engine integrates directly with our biometric attendance logs. With one click, the system calculates working hours, deducts unpaid leaves, factors in bonuses or overtime, and generates compliant digital salary slips. These slips are automatically converted into PDFs and delivered to teachers\' phones via WhatsApp.'
                        ],
                        [
                            'title' => 'Fee Collection',
                            'icon' => 'fa-credit-card',
                            'd1' => 'Simplify school financial administration with a powerful digital ledger system. Administrators can set up custom fee structures, accommodating monthly tuition, quarterly transport fees, one-time lab charges, sibling discounts, and individual scholarships.',
                            'd2' => 'Parents can pay fees securely online through major payment gateways, instantly receiving an automated, digital tax receipt. The system automatically reconciles payments, flags outstanding accounts on a real-time ledger, and sends automated WhatsApp payment links to defaulters, reducing administrative cash management to zero.'
                        ],
                        [
                            'title' => 'Examination Management',
                            'icon' => 'fa-file-invoice',
                            'd1' => 'Create, schedule, and execute exam structures across multiple terms, classes, and subjects. The exam manager allows controllers of examinations to set up grade scales, define passing criteria, and schedule exam dates with zero conflicts.',
                            'd2' => 'Teachers can log marks directly into a fast, spreadsheet-like gradebook interface. Once finalized by the principal, report cards are compiled automatically. Parents can securely view and download high-quality digital PDF report cards via their mobile app, eliminating paper printing costs.'
                        ]
                    ] as $i => $feat)
                    <div class="faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#featLeft{{ $i }}">
                                <i class="fas {{ $feat['icon'] }} me-2 text-primary"></i> {{ $feat['title'] }}
                            </button>
                        </h2>
                        <div id="featLeft{{ $i }}" class="accordion-collapse collapse" data-bs-parent="#featuresAccLeft">
                            <div class="accordion-body">
                                <p class="mb-3" style="color: var(--foreground); font-size: 0.88rem; font-weight: 500;">{{ $feat['d1'] }}</p>
                                <p class="mb-0" style="color: var(--muted); font-size: 0.83rem; line-height: 1.75;">{{ $feat['d2'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 mt-3 mt-lg-0">
                <div class="accordion" id="featuresAccRight">
                    @foreach([
                        [
                            'title' => 'Timetable Management',
                            'icon' => 'fa-calendar-alt',
                            'd1' => 'Designing a conflict-free school timetable is a massive administrative headache that usually takes days. Edunex ERP\'s smart scheduling algorithm automates this process in minutes, dynamically balancing teacher availability, classroom capacity, and subject requirements.',
                            'd2' => 'If a teacher goes on sudden leave, the system immediately suggests substitute teachers who are free during those periods, ensuring that classes are never left unsupervised. Timetable updates are instantly pushed to the mobile apps of teachers, students, and parents.'
                        ],
                        [
                            'title' => 'Parent Mobile App',
                            'icon' => 'fa-mobile-screen',
                            'd1' => 'Bring parents closer to their child\'s educational journey with our beautiful, highly intuitive mobile application. Available for both iOS and Android platforms, the app serves as a centralized hub for all school-related updates.',
                            'd2' => 'Parents can check daily attendance logs, view teacher feedback, review homework assignments, download exam timetables, view gallery photos of school events, track their child\'s school bus, and pay outstanding fee invoices securely via UPI or cards—all from their smartphone.'
                        ],
                        [
                            'title' => 'Homework Management',
                            'icon' => 'fa-book-open',
                            'd1' => 'Keep classrooms highly organized with our digital homework and assignment portal. Teachers can upload daily assignments, attach supplementary reading PDFs, link reference YouTube videos, and set clear submission deadlines.',
                            'd2' => 'Students receive instant push notifications on their phones when homework is assigned. They can upload completed assignments directly through the app. Teachers can review submissions, provide personalized digital feedback, and assign grades, keeping parents informed of their child\'s academic consistency.'
                        ],
                        [
                            'title' => 'Library Management',
                            'icon' => 'fa-book-reader',
                            'd1' => 'Transform your school library into a modern, digitized media center. The library management module tracks your entire catalog of books, journals, and digital assets, organizing them by subject, author, and publisher using smart indexing.',
                            'd2' => 'Librarians can issue and return books with simple barcode scanning. The system automatically tracks due dates, calculates overdue fines, and sends automated return reminders to students through the mobile portal, ensuring a highly organized and fully utilized library ecosystem.'
                        ],
                        [
                            'title' => 'Transport Management',
                            'icon' => 'fa-bus',
                            'd1' => 'Ensure absolute peace of mind during daily school commutes. The transport module allows administrators to map out routes, designate safe pickup/drop-off points, assign students to specific buses, and manage driver profiles and vehicle maintenance records.',
                            'd2' => 'By integrating standard GPS trackers, parents can monitor the real-time location of their child\'s bus on the mobile app. The system automatically sends a notification when the bus is 5 minutes away from their stop, reducing wait times in extreme weather.'
                        ],
                        [
                            'title' => 'Online Admissions',
                            'icon' => 'fa-paper-plane',
                            'd1' => 'Modernize your enrollment process and eliminate paper forms. The online admission portal allows prospective parents to submit application forms, upload required documents (birth certificates, transfer certificates, academic records), and pay registration fees online.',
                            'd2' => 'Administrators can track inquiries, schedule admission tests, conduct interviews, and transition selected candidates into active students in a single click, eliminating manual data entry and creating a professional, welcoming first impression for new families.'
                        ]
                    ] as $i => $feat)
                    <div class="faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#featRight{{ $i }}">
                                <i class="fas {{ $feat['icon'] }} me-2 text-primary"></i> {{ $feat['title'] }}
                            </button>
                        </h2>
                        <div id="featRight{{ $i }}" class="accordion-collapse collapse" data-bs-parent="#featuresAccRight">
                            <div class="accordion-body">
                                <p class="mb-3" style="color: var(--foreground); font-size: 0.88rem; font-weight: 500;">{{ $feat['d1'] }}</p>
                                <p class="mb-0" style="color: var(--muted); font-size: 0.83rem; line-height: 1.75;">{{ $feat['d2'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

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
        <div style="background:linear-gradient(135deg,#F0FDFA,#EFF6FF);border:1px solid #E2E8F0;border-radius:20px;padding:36px 32px;margin-bottom:40px;overflow:hidden;position:relative;">
            <div style="position:absolute;top:-60px;right:-60px;width:220px;height:220px;border-radius:50%;background:rgba(13,148,136,0.06);"></div>
            <div style="position:absolute;bottom:-40px;left:-40px;width:160px;height:160px;border-radius:50%;background:rgba(37,99,235,0.05);"></div>
            <div class="text-center mb-4" style="position:relative;z-index:2;">
                <span style="font-size:0.7rem;font-weight:800;text-transform:uppercase;letter-spacing:2px;color:#0D9488;">How it works — in 2 seconds</span>
                <h3 style="font-size:1.3rem;font-weight:800;color:#0F172A;margin-top:8px;margin-bottom:0;">The complete AI attendance flow</h3>
            </div>
            <div class="ai-flow-scroll" style="position:relative;z-index:2;">
            <svg viewBox="0 0 800 160" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:auto;max-height:160px;">
                <!-- Step 1: Open App -->
                <g>
                    <rect x="10" y="30" width="130" height="100" rx="12" fill="#fff" stroke="#E2E8F0" stroke-width="1.5"/>
                    <!-- Phone frame -->
                    <rect x="40" y="40" width="70" height="80" rx="8" fill="#F8FAFC" stroke="#CBD5E1" stroke-width="1"/>
                    <rect x="50" y="52" width="50" height="50" rx="4" fill="#EFF6FF"/>
                    <!-- Camera scan lines in phone -->
                    <line x1="50" y1="62" x2="100" y2="62" stroke="#2563EB" stroke-width="1" opacity=".3"/>
                    <line x1="50" y1="72" x2="100" y2="72" stroke="#2563EB" stroke-width="1" opacity=".3"/>
                    <line x1="50" y1="82" x2="100" y2="82" stroke="#2563EB" stroke-width="1" opacity=".3"/>
                    <line x1="50" y1="92" x2="100" y2="92" stroke="#2563EB" stroke-width="1" opacity=".3"/>
                    <!-- Face outline -->
                    <ellipse cx="75" cy="74" rx="14" ry="16" fill="none" stroke="#2563EB" stroke-width="1.5" opacity=".7"/>
                    <circle cx="70" cy="70" r="2" fill="#2563EB" opacity=".7"/>
                    <circle cx="80" cy="70" r="2" fill="#2563EB" opacity=".7"/>
                    <path d="M69 79 Q75 83 81 79" stroke="#2563EB" stroke-width="1.5" fill="none" opacity=".7"/>
                    <!-- Corner brackets on face -->
                    <path d="M54 55 L54 60 M54 55 L59 55" stroke="#0D9488" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <path d="M96 55 L96 60 M96 55 L91 55" stroke="#0D9488" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <path d="M54 95 L54 90 M54 95 L59 95" stroke="#0D9488" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <path d="M96 95 L96 90 M96 95 L91 95" stroke="#0D9488" stroke-width="2" fill="none" stroke-linecap="round"/>
                    <!-- Home button -->
                    <circle cx="75" cy="112" r="5" fill="#CBD5E1"/>
                    <text x="75" y="143" text-anchor="middle" font-size="9" font-weight="700" fill="#0F172A">Open EduNex App</text>
                    <text x="75" y="155" text-anchor="middle" font-size="8" fill="#64748B">Camera activates</text>
                </g>

                <!-- Arrow 1 -->
                <g>
                    <line x1="148" y1="80" x2="178" y2="80" stroke="#0D9488" stroke-width="2"/>
                    <polygon points="178,75 188,80 178,85" fill="#0D9488"/>
                    <text x="168" y="72" text-anchor="middle" font-size="8" fill="#0D9488" font-weight="700">instant</text>
                </g>

                <!-- Step 2: AI Scan -->
                <g>
                    <rect x="192" y="30" width="130" height="100" rx="12" fill="#fff" stroke="#E2E8F0" stroke-width="1.5"/>
                    <circle cx="257" cy="74" r="24" fill="#0D9488" opacity=".12"/>
                    <ellipse cx="257" cy="74" rx="15" ry="17" fill="none" stroke="#0D9488" stroke-width="2"/>
                    <circle cx="251" cy="70" r="2.5" fill="#0D9488"/>
                    <circle cx="263" cy="70" r="2.5" fill="#0D9488"/>
                    <path d="M250 82 Q257 87 264 82" stroke="#0D9488" stroke-width="2" fill="none"/>
                    <!-- Scanner beam line -->
                    <line x1="230" y1="74" x2="284" y2="74" stroke="#0D9488" stroke-width="1.5" stroke-dasharray="2 2"/>
                    <text x="257" y="143" text-anchor="middle" font-size="9" font-weight="700" fill="#0F172A">AI Facial Recognition</text>
                    <text x="257" y="155" text-anchor="middle" font-size="8" fill="#64748B">Verifies in 1 sec</text>
                </g>

                <!-- Arrow 2 -->
                <g>
                    <line x1="330" y1="80" x2="360" y2="80" stroke="#0D9488" stroke-width="2"/>
                    <polygon points="360,75 370,80 360,85" fill="#0D9488"/>
                </g>

                <!-- Step 3: GPS Geofence -->
                <g>
                    <rect x="374" y="30" width="130" height="100" rx="12" fill="#fff" stroke="#E2E8F0" stroke-width="1.5"/>
                    <circle cx="439" cy="74" r="25" fill="#EFF6FF"/>
                    <!-- Geofence circle -->
                    <circle cx="439" cy="74" r="20" fill="none" stroke="#2563EB" stroke-width="1.5" stroke-dasharray="3 3"/>
                    <!-- Pin -->
                    <path d="M439 58 C434 58 430 62 430 67 C430 74 439 82 439 82 C439 82 448 74 448 67 C448 62 444 58 439 58 Z" fill="#EF4444"/>
                    <circle cx="439" cy="66" r="3.5" fill="#fff"/>
                    <text x="439" y="143" text-anchor="middle" font-size="9" font-weight="700" fill="#0F172A">GPS Geofencing</text>
                    <text x="439" y="155" text-anchor="middle" font-size="8" fill="#64748B">Locks to school site</text>
                </g>

                <!-- Arrow 3 -->
                <g>
                    <line x1="512" y1="80" x2="542" y2="80" stroke="#0D9488" stroke-width="2"/>
                    <polygon points="542,75 552,80 542,85" fill="#0D9488"/>
                </g>

                <!-- Step 4: Marked -->
                <g>
                    <rect x="556" y="30" width="130" height="100" rx="12" fill="#F0FDFA" stroke="#99F6E4" stroke-width="1.5"/>
                    <!-- Big checkmark -->
                    <circle cx="621" cy="72" r="28" fill="#0D9488" opacity=".12"/>
                    <circle cx="621" cy="72" r="22" fill="#0D9488" opacity=".2"/>
                    <circle cx="621" cy="72" r="16" fill="#0D9488"/>
                    <path d="M612 72 l6 6 l12 -12" stroke="#fff" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <!-- Ping rings -->
                    <circle cx="621" cy="72" r="30" fill="none" stroke="#0D9488" stroke-width="1" opacity=".3"/>
                    <text x="621" y="115" text-anchor="middle" font-size="10" font-weight="800" fill="#0D9488">PRESENT ✓</text>
                    <text x="621" y="143" text-anchor="middle" font-size="9" font-weight="700" fill="#0F172A">Attendance Marked</text>
                    <text x="621" y="155" text-anchor="middle" font-size="8" fill="#64748B">Auto-logged in 2 seconds</text>
                </g>

                <!-- WhatsApp notification -->
                <g>
                    <rect x="698" y="40" width="95" height="50" rx="8" fill="#25D366" opacity=".1"/>
                    <rect x="698" y="40" width="95" height="50" rx="8" fill="none" stroke="#25D366" stroke-width="1"/>
                    <text x="745" y="58" text-anchor="middle" font-size="8" font-weight="700" fill="#128C7E">WhatsApp Alert</text>
                    <text x="745" y="70" text-anchor="middle" font-size="7" fill="#128C7E">"Ravi Kumar marked</text>
                    <text x="745" y="80" text-anchor="middle" font-size="7" fill="#128C7E">IN at 9:02 AM ✓"</text>
                    <line x1="698" y1="65" x2="686" y2="80" stroke="#25D366" stroke-dasharray="3 2" stroke-width="1"/>
                </g>
            </svg>
            </div>
        </div>

        <div class="bento">

            <!-- Staff Attendance -->
            <div class="bcard b4">
                <div class="bicon bi-teal"><i class="fas fa-calendar-check"></i></div>
                <div class="bcard-title">Staff Attendance</div>
                <div class="bcard-desc">Daily logs with Mark-IN, Mark-OUT times, hours on site, and exportable monthly summaries.</div>
                <div class="mt-2"><span class="mtag">Mark IN & OUT</span><span class="mtag">CSV export</span><span class="mtag">Monthly reports</span></div>
                <div style="display:flex;gap:24px;margin-top:20px;">
                    <div style="text-align:center;">
                        <div style="font-size:1.8rem;font-weight: 500;letter-spacing:-1.5px;" class="g-text">94%</div>
                        <div style="font-size:0.63rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Avg Attendance</div>
                    </div>
                    <div style="text-align:center;">
                        <div style="font-size:1.8rem;font-weight: 500;letter-spacing:-1.5px;color:var(--foreground);">8h12m</div>
                        <div style="font-size:0.63rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Avg Hours/Day</div>
                    </div>
                </div>
            </div>

            <!-- Payroll -->
            <div class="bcard b4">
                <div class="bicon bi-amber"><i class="fas fa-file-invoice-dollar"></i></div>
                <div class="bcard-title">Statutory Payroll</div>
                <div class="bcard-desc">Automatic PF/ESIC deductions, separate Casual/Earned leave caps, TDS tax slabs, and pro-rated net salary.</div>
                <div class="mini-bars">
                    <div class="mbar" style="height:28%;"></div>
                    <div class="mbar" style="height:50%;"></div>
                    <div class="mbar" style="height:38%;"></div>
                    <div class="mbar" style="height:68%;"></div>
                    <div class="mbar" style="height:55%;"></div>
                    <div class="mbar hi" style="height:90%;"></div>
                </div>
                <div style="font-size:0.67rem;color:var(--muted);margin-top:4px;">Payroll disbursement (6 months)</div>
                <div class="mt-2"><span class="mtag"><i class="fas fa-check" style="color:hsl(38,92%,60%);"></i> PF & ESIC rates</span><span class="mtag">TDS slabs</span></div>
            </div>

            <!-- Salary Slips -->
            <div class="bcard b4">
                <div class="bicon bi-violet"><i class="fas fa-file-invoice-dollar"></i></div>
                <div class="bcard-title">Digital Payslips</div>
                <div class="bcard-desc">Detailed itemized payslips covering statutory splits, sent via WhatsApp/email automatically.</div>
                <div class="slip">
                    <div class="slip-row"><span class="sl">Gross Salary</span><span class="sv">₹35,000</span></div>
                    <div class="slip-row"><span class="sl">PF / ESIC Deductions</span><span class="sv r">−₹1,800</span></div>
                    <div class="slip-row"><span class="sl">TDS Deduction</span><span class="sv r">−₹1,450</span></div>
                    <div class="slip-row"><span class="sl" style="font-weight: 500;color:var(--foreground);">Net Disbursed</span><span class="sv g" style="font-size:0.9rem;">₹31,750</span></div>
                </div>
            </div>

            <!-- Bottom strip -->
            <div class="bcard b12" style="background:hsla(217,91%,60%,0.05);border-color:hsla(217,91%,60%,0.18);">
                <div class="row g-4">
                    @foreach([
                        ['i'=>'fa-shield-halved','c'=>'bi-blue','t'=>'100% Proxy-Proof','d'=>'Face + GPS dual-verification. No buddy punching, ever.'],
                        ['i'=>'fa-chart-bar','c'=>'bi-teal','t'=>'Punctuality Analytics','d'=>'Late arrivals, absenteeism, and daily logs in one dashboard.'],
                        ['i'=>'fab fa-whatsapp','c'=>'bi-amber','t'=>'WhatsApp Payslips','d'=>'Salary slips sent to each staff member\'s phone every month.'],
                    ] as $s)
                    <div class="col-lg-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="bicon {{ $s['c'] }}" style="margin-bottom:0;flex-shrink:0;width:38px;height:38px;border-radius:9px;font-size:0.95rem;"><i class="{{ str_starts_with($s['i'],'fab') ? $s['i'] : 'fas '.$s['i'] }}"></i></div>
                            <div>
                                <div class="bcard-title" style="font-size:0.9rem;margin-bottom:4px;">{{ $s['t'] }}</div>
                                <div class="bcard-desc" style="font-size:0.8rem;">{{ $s['d'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══════════════ HOW IT WORKS ══════════════ -->
<section class="how-section">
    <div class="container px-4">
        <div class="row align-items-center mb-5 g-4">
            <div class="col-lg-5">
                <span class="sec-eyebrow">Get Started</span>
                <h2 class="sec-title" style="margin-bottom:12px;">Live in<br><span class="g-text">15 minutes.</span></h2>
                <p class="sec-desc">No IT team. No migration headache. Just sign up and follow four steps.</p>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    @foreach([
                        ['n'=>'01','t'=>'Create your institute','d'=>'Sign up, enter your institute name, city, and contact. Done in 2 minutes.','c'=>'hsla(174,72%,56%,0.08)','bc'=>'hsla(174,72%,56%,0.2)'],
                        ['n'=>'02','t'=>'Add batches & staff','d'=>'Create batches, assign teachers, set roles — all from a single screen.','c'=>'hsla(217,91%,60%,0.08)','bc'=>'hsla(217,91%,60%,0.2)'],
                        ['n'=>'03','t'=>'Enroll your students','d'=>'Add students, collect fees instantly, they get portal access on the spot.','c'=>'hsla(262,83%,58%,0.08)','bc'=>'hsla(262,83%,58%,0.2)'],
                        ['n'=>'04','t'=>'Go live today','d'=>'Mark attendance, run live classes, track fees — from day one.','c'=>'hsla(38,92%,50%,0.08)','bc'=>'hsla(38,92%,50%,0.2)'],
                    ] as $s)
                    <div class="col-md-6">
                        <div class="how-step" style="background:{{ $s['c'] }};border:1px solid {{ $s['bc'] }};border-radius:14px;">
                            <div class="how-step-num">{{ $s['n'] }}</div>
                            <div class="how-step-inner">
                                <div class="how-step-badge">{{ $s['n'] }}</div>
                                <div class="how-step-t">{{ $s['t'] }}</div>
                                <div class="how-step-d">{{ $s['d'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════ LOCAL SUCCESS STORY ══════════════ -->
<section id="success-story" class="feat-section" style="background: #fff; border-top: 1px solid #E8EDF5; padding: 80px 0;">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow">Local Success Story</span>
            <h2 class="sec-title">Empowering Excellence in <span class="g-text">{{ $city }}</span></h2>
            <p class="sec-desc mx-auto" style="max-width: 600px;">How a leading local institution completely modernized operations, streamlined schedules, and recovered fee backlogs.</p>
        </div>

        <div class="card-glass p-4 p-md-5" style="background: var(--card-bg); border-color: var(--border);">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div style="background: hsla(174,72%,56%,0.05); border: 1px dashed hsla(174,72%,56%,0.2); border-radius: 12px; padding: 24px;">
                        <h4 style="font-size:1.15rem; font-weight:600; margin-bottom:16px;" class="g-text"><i class="fas fa-university me-2"></i> {{ $city }} Progressive Academy</h4>
                        <p style="font-size:0.83rem; color:var(--muted); line-height:1.7; margin-bottom:14px;"><strong>The Challenge:</strong> Before implementing Edunex ERP, {{ $city }} Progressive Academy—a prestigious institution serving over 1,200 students—was struggling with severe administrative blockages. The school's administrative staff spent the first week of every month manually processing cash and checks at the fee counter, resulting in long queues and accounting errors. Teachers were losing nearly 15 minutes of every classroom day physically calling out roll attendance and filling out paper registers. More critically, the school struggled with tracking fee defaults, leading to nearly 30% of tuition payments remaining overdue at the end of each academic quarter.</p>
                        <p style="font-size:0.83rem; color:var(--muted); line-height:1.7; margin-bottom:0;"><strong>The Transformation:</strong> In the summer of 2025, the academy partnered with Edunex ERP to execute a complete digital transformation. Within 48 hours, our onboarding team migrated their historical student databases into a secure multi-tenant cloud environment. Teachers began marking attendance in one tap on classroom tablets, and the academy deployed face biometrics at the staff entrance to automate HR check-ins, launching the Edunex ERP Parent App for real-time progress tracking and online fee collections.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 style="font-size:1.05rem; font-weight:600; margin-bottom:20px; letter-spacing:-0.3px;"><i class="fas fa-chart-line text-primary me-2"></i> Unprecedented 60-Day Results:</h4>
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div style="background: #F8FAFC; border: 1px solid var(--border); border-radius:10px; padding: 16px; text-align:center;">
                                <div style="font-size:2rem; font-weight:600; color: #0D9488;">100%</div>
                                <div style="font-size:0.75rem; color:var(--muted); margin-top:4px;">Fee Arrears Recovered</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background: #F8FAFC; border: 1px solid var(--border); border-radius:10px; padding: 16px; text-align:center;">
                                <div style="font-size:2rem; font-weight:600; color: #2563EB;">12 Hrs</div>
                                <div style="font-size:0.75rem; color:var(--muted); margin-top:4px;">Saved Per Teacher/Mo</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background: #F8FAFC; border: 1px solid var(--border); border-radius:10px; padding: 16px; text-align:center;">
                                <div style="font-size:2rem; font-weight:600; color: #D97706;">98%</div>
                                <div style="font-size:0.75rem; color:var(--muted); margin-top:4px;">Staff Punctuality Improvement</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background: #F8FAFC; border: 1px solid var(--border); border-radius:10px; padding: 16px; text-align:center;">
                                <div style="font-size:2rem; font-weight:600; color: #7C3AED;">4.8★</div>
                                <div style="font-size:0.75rem; color:var(--muted); margin-top:4px;">Parent App Rating</div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:24px; padding-left:14px; border-left: 3px solid var(--primary);">
                        <p style="font-size:0.83rem; color:var(--foreground); font-style:italic; line-height:1.6; margin-bottom:6px;">"Edunex ERP didn't just digitize our spreadsheets; it completely transformed our school's culture. We are now running a highly efficient, paperless, and modern institution that parents trust."</p>
                        <strong style="font-size:0.78rem; color:var(--muted);">— Dr. Sarah Mitchell, School Principal</strong>
                    </div>
                </div>
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


<!-- ══════════════ TESTIMONIALS ══════════════ -->
<section class="testi-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow">Real Stories</span>
            <h2 class="sec-title">Loved by institutes<br>across {{ $city }}.</h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['n'=>'Rajesh Kumar','r'=>'Director, Apex Coaching Center','i'=>'RK','c'=>'var(--gradient-primary)','q'=>'EduNex ERP completely changed how we manage our 300+ students. The fee reminders alone saved us 10+ hours of phone calls every month.'],
                ['n'=>'SanjaySharma','r'=>'Principal, Bright Minds Academy','i'=>'PS','c'=>'var(--gradient-secondary)','q'=>'The AI face attendance was a game changer — zero proxy marking. And the analytics give me full visibility into every batch.'],
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
                        [
                            'q' => 'How fast can we set up Edunex ERP for our school?',
                            'a' => 'Setting up Edunex ERP is incredibly fast. Because the software is hosted on a secure cloud network, there is no need for local server installations or complex IT setups. Once you sign up, our dedicated onboarding team can help migrate your student databases, configure your custom fee structures, and get your system live in under 15 minutes.'
                        ],
                        [
                            'q' => 'Does the Face Recognition Attendance system require expensive specialized hardware?',
                            'a' => 'Not at all. Unlike legacy biometric systems that require expensive dedicated machines and wiring, Edunex ERP’s AI facial recognition runs smoothly on any standard Android or iOS tablet, smartphone, or laptop camera. This dramatically lowers the entry cost for schools and makes deployment effortless.'
                        ],
                        [
                            'q' => 'How secure is our school\'s student and financial data on your platform?',
                            'a' => 'Data security is our highest priority. Edunex ERP utilizes a modern multi-tenant cloud architecture, which means that your school\'s data is housed in a completely isolated database silo. It is fully encrypted at rest and in transit. Your records, fee histories, and employee payrolls are 100% invisible to any other academy on the platform.'
                        ],
                        [
                            'q' => 'Can we manage multiple school campuses or coaching branches from one account?',
                            'a' => 'Yes! If you manage a chain of schools or coaching institutes across {{ $city }} and nearby regions, Edunex ERP offers a centralized dashboard. Trustees and administrators can view overall metrics, monitor financial reports, check overall attendance trends, and switch between campuses seamlessly using a single master login.'
                        ],
                        [
                            'q' => 'How does the automated fee reminder system work on WhatsApp?',
                            'a' => 'Our system integrates directly with authorized WhatsApp APIs. The billing engine automatically monitors pending tuition dues on your ledgers. With one click, administrators can dispatch personalized payment links directly to parents\' WhatsApp numbers. Parents can click the link and securely clear the balance instantly using UPI or card.'
                        ],
                        [
                            'q' => 'Can our teachers grade exams and generate report cards using Edunex ERP?',
                            'a' => 'Absolutely. Edunex ERP features a highly flexible grading engine that supports CBSE, ICSE, IB, and regional state board structures. Teachers can input scores into a rapid, spreadsheet-style gradebook. The system automatically calculates aggregates, determines grades, and generates beautiful PDF report cards that parents can access directly on the app.'
                        ],
                        [
                            'q' => 'What happens if the school\'s internet goes down during attendance marking?',
                            'a' => 'We have designed our student and staff attendance modules with robust offline-first caching capabilities. If your school\'s internet connection drops, teachers can continue to mark student attendance or scan staff faces normally. The data is saved securely on the local device storage and automatically syncs to the cloud server once connection is restored.'
                        ],
                        [
                            'q' => 'Is there a limit to the number of students we can enroll on the platform?',
                            'a' => 'We believe in supporting the growth of your educational institution. Our plans do not penalize you for expanding. You can enroll as many students, create as many batches, and register as many parent accounts as your school requires—your license supports your growth with zero hidden student capacity fees.'
                        ],
                        [
                            'q' => 'Does Edunex ERP support transport tracking for school buses?',
                            'a' => 'Yes, we have a built-in Transport Management Module. By linking affordable GPS hardware on school buses or vans, the system streams live vehicle locations directly to the parent mobile app. The app automatically fires geofenced alerts when the bus is approaching the student\'s stop, ensuring safety and saving parents time.'
                        ],
                        [
                            'q' => 'Can parents apply for admissions online through our website?',
                            'a' => 'Yes, Edunex ERP provides a fully customizable public Online Admission Portal. You can link this portal directly to your school\'s website. Prospective parents can fill out application forms, securely upload necessary documents (birth certificates, photos), and pay admission fees online, which flows directly into your admissions queue.'
                        ],
                        [
                            'q' => 'Can teachers upload homework and assignments on the app?',
                            'a' => 'Yes. Through the teacher dashboard, educators can post daily homework, attach reading materials (PDFs, images), and link online resources or videos. Students receive an immediate push notification on their mobile devices, can submit their completed work through the app, and receive digital grades and feedback from teachers.'
                        ],
                        [
                            'q' => 'Can we process staff payroll and generate payslips with this software?',
                            'a' => 'Yes, Edunex ERP includes a comprehensive HR and payroll engine. Because it is directly integrated with our Face Biometrics and GPS check-in logs, the payroll engine automatically factors in working days, late arrivals, and unpaid leaves to calculate precise net salaries. It generates digital payslips and sends them to staff via WhatsApp.'
                        ],
                        [
                            'q' => 'Does the parent mobile app work on both iOS and Android?',
                            'a' => 'Yes. The Edunex ERP Parent & Student App is fully optimized for both iOS and Android platforms. It is designed to be lightweight, incredibly fast, and exceptionally secure, offering families a modern, user-friendly interface to track all academic, fee, and transit updates.'
                        ],
                        [
                            'q' => 'What kind of support does Edunex ERP provide to our administrative staff?',
                            'a' => 'We pride ourselves on providing world-class, 24/7 technical support. Every school that joins the Edunex ERP family is assigned a dedicated customer success manager. We provide comprehensive virtual training sessions for your staff, supply detailed video guides, and are always available via call or WhatsApp to solve any query instantly.'
                        ],
                        [
                            'q' => 'Is there a contract or can we cancel our subscription anytime?',
                            'a' => 'We believe in earning your trust month after month. Edunex ERP offers flexible monthly and annual subscription options with no locked-in long-term contracts. You can choose the plan that best fits your school\'s budget and scale, and you have the complete freedom to upgrade, downgrade, or cancel your subscription at any time.'
                        ]
                    ] as $i => $faq)
                    <div class="faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">
                                {{ $faq['q'] }}
                            </button>
                        </h2>
                        <div id="faq{{ $i }}" class="accordion-collapse collapse" data-bs-parent="#faqAcc">
                            <div class="accordion-body">{{ $faq['a'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════ NEARBY AREAS SERVED ══════════════ -->
<section id="nearby-areas" class="feat-section" style="background: #F8FAFC; border-top: 1px solid #E8EDF5; padding: 80px 0;">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow">Areas We Serve</span>
            <h2 class="sec-title">Serving Schools & Institutes Across <span class="g-text">{{ $city }}</span></h2>
            <p class="sec-desc mx-auto" style="max-width: 600px;">We proudly provide premium educational ERP and school management software solutions to institutions in {{ $city }} and its surrounding districts, suburbs, and neighborhoods:</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row g-3">
                    @foreach([
                        'Central Business District (CBD)',
                        'Metro North Education Hub',
                        'Innovation Park Suburb',
                        'South Valley Academic District',
                        'Westside Residential Area',
                        'East Coast Suburb',
                        'Heights Knowledge Park',
                        'Tech Corridor District',
                        'Green Hills Academic Valley',
                        'Old Town School District',
                        'Harbor Side Education Zone',
                        'Lakeside Academic Circle',
                        'River Front Institutional Block',
                        'Crescent Hill Suburb',
                        'Metro South Transit Zone'
                    ] as $area)
                    <div class="col-md-4 col-sm-6">
                        <div class="card-glass p-3 text-center" style="background: var(--card-bg); border-color: var(--border); transition: all 0.2s ease;">
                            <span style="font-size:0.88rem; font-weight:500; color:#475569;"><i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $area }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ── Internal Location Linking (SEO: passes link equity through hierarchy) ── --}}
@if((isset($siblingsInState) && $siblingsInState->isNotEmpty()) || (isset($statesInCountry) && $statesInCountry->isNotEmpty()))
<section style="background:#F8FAFC; padding:60px 0; border-top:1px solid #E8EDF5;">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="badge-pill"><i class="fas fa-map-marker-alt"></i> Explore Nearby</span>
            <h2 class="sec-title mt-3" style="font-size:clamp(1.5rem,3vw,2rem);">
                More <span class="g-text">{{ $erpLabel }}</span> Locations
            </h2>
        </div>

        {{-- Sibling cities in the same state --}}
        @if(isset($siblingsInState) && $siblingsInState->isNotEmpty())
        <div class="mb-5">
            <h3 style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:#0D9488; margin-bottom:18px;">
                <i class="fas fa-city me-2"></i>Other Cities in {{ $state ?? $country }}
            </h3>
            <div class="row g-2">
                @foreach($siblingsInState as $sib)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ $sib->canonicalUrl($prefix) }}"
                       class="d-flex align-items-center gap-2 p-3 rounded"
                       style="background:#FFF; border:1px solid #E2E8F0; color:#475569; font-size:0.82rem; font-weight:500; text-decoration:none; transition:all .2s;"
                       onmouseover="this.style.borderColor='rgba(13,148,136,.4)';this.style.color='#0D9488'"
                       onmouseout="this.style.borderColor='#E2E8F0';this.style.color='#475569'">
                        <i class="fas fa-map-pin" style="color:#0D9488;font-size:.7rem;flex-shrink:0;"></i>
                        {{ $sib->city_name }}
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- States in the same country --}}
        @if(isset($statesInCountry) && $statesInCountry->isNotEmpty())
        <div>
            <h3 style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:#2563EB; margin-bottom:18px;">
                <i class="fas fa-map me-2"></i>States &amp; Provinces in {{ $country }}
            </h3>
            <div class="row g-2">
                @foreach($statesInCountry as $st)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ url($prefix . '/' . $st->country_slug . '/' . $st->state_slug) }}"
                       class="d-flex align-items-center gap-2 p-3 rounded"
                       style="background:#FFF; border:1px solid #E2E8F0; color:#475569; font-size:0.82rem; font-weight:500; text-decoration:none; transition:all .2s;"
                       onmouseover="this.style.borderColor='rgba(37,99,235,.4)';this.style.color='#2563EB'"
                       onmouseout="this.style.borderColor='#E2E8F0';this.style.color='#475569'">
                        <i class="fas fa-layer-group" style="color:#2563EB;font-size:.7rem;flex-shrink:0;"></i>
                        {{ $st->state_name }}
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endif

<!-- ══════════════ CTA ══════════════ -->
<section class="cta-section">
    <div class="container px-4">
        <div class="cta-box">
            <span class="badge-pill mb-4"><i class="fas fa-rocket me-1"></i> Get Started Today</span>
            <h2>Ready to transform<br>your institute?</h2>
            <p>Join 100+ institutes that have automated their operations. 7-day free trial, no credit card required.</p>
            <div class="d-flex gap-3 flex-wrap justify-content-center mb-4">
                <a href="{{ route('pricing') }}" class="btn-primary" style="font-size:0.95rem;padding:14px 32px;">Start Free Trial <i class="fas fa-rocket"></i></a>
                <a href="{{ route('contact') }}" class="btn-outline" style="font-size:0.95rem;padding:14px 32px;">Talk to Sales <i class="fas fa-arrow-right"></i></a>
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
