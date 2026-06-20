<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo
        title="Digital Assessment Platform & Online Exam Software for Schools | EduNex ERP"
        description="EduNex ERP's Digital Assessment Platform lets schools and institutes create, conduct, auto-grade exams and publish report cards online. The best online exam software for schools with question banks, analytics, tab-switch prevention, and instant results."
        keywords="online exam software for schools india, digital assessment platform school, school exam management system, online test software for schools, school assessment software, MCQ exam software school, student exam portal, digital examination system, automated grading school software, school report card software, question bank software school, institute exam management, online examination platform, cbse online exam software, coaching class online test software, EduNex ERP assessment, best online exam software india"
    />
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700;0,14..32,800;0,14..32,900;1,14..32,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')

<style>
/* ═══════════════════════════════════════════
   DESIGN TOKENS
═══════════════════════════════════════════ */
:root {
    --bg:         #F8FAFC;
    --bg-alt:     #F1F5F9;
    --card-bg:    #FFFFFF;
    --border:     #E2E8F0;
    --muted:      #64748B;
    --primary:    #0D9488;   /* teal */
    --secondary:  hsl(217, 91%, 60%);   /* indigo/blue */
    --accent:     hsl(262, 83%, 58%);   /* violet */
    --foreground: #0F172A;
    --radius:     0.75rem;
    --navy:       hsl(226, 58%, 16%);
    --indigo:     hsl(234, 62%, 55%);
    --cyan:       hsl(188, 86%, 53%);

    --gradient-primary:   linear-gradient(135deg, #0D9488, hsl(217,91%,60%));
    --gradient-secondary: linear-gradient(135deg, hsl(217,91%,60%), hsl(262,83%,58%));
    --gradient-navy:      linear-gradient(135deg, hsl(226,58%,18%), hsl(234,62%,28%));
    --glow-cyan:   0 0 40px hsla(174,72%,56%,0.2);
    --glow-indigo: 0 0 40px hsla(217,91%,60%,0.2);
    --shadow-card: 0 8px 32px rgba(0,0,0,0.06);
    --shadow-elevated: 0 20px 60px rgba(0,0,0,0.08);
}

*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
    font-family: 'Inter', system-ui, sans-serif;
    background: var(--bg);
    color: var(--foreground);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    line-height: 1.6;
}

/* ── Gradient Text ── */
.g-text {
    background: var(--gradient-primary);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.g-text-2 {
    background: var(--gradient-secondary);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}

/* ── Shared Section Styles ── */
.sec-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.72rem; font-weight: 600; letter-spacing: 1.5px;
    text-transform: uppercase; color: var(--primary);
    background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2);
    border-radius: 9999px; padding: 5px 14px; margin-bottom: 16px;
}
.sec-eyebrow.indigo {
    color: hsl(217,91%,70%);
    background: hsla(217,91%,60%,0.1); border-color: hsla(217,91%,60%,0.2);
}
.sec-eyebrow.violet {
    color: hsl(262,83%,72%);
    background: hsla(262,83%,58%,0.1); border-color: hsla(262,83%,58%,0.2);
}
.sec-title {
    font-size: clamp(2rem, 4vw, 3.2rem);
    font-weight: 700; letter-spacing: -2px; line-height: 1.1; margin-bottom: 18px;
}
.sec-desc {
    font-size: 1rem; color: var(--muted); line-height: 1.85; max-width: 560px;
}

/* ── Buttons ── */
.btn-primary-dap {
    background: var(--gradient-primary); color: #FFFFFF;
    border: none; padding: 14px 30px; border-radius: 10px;
    font-weight: 700; font-size: 0.9rem;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; transition: all 0.25s ease;
    box-shadow: var(--glow-cyan);
}
.btn-primary-dap:hover { color: #FFFFFF; opacity: 0.9; transform: translateY(-2px); }
.btn-outline-dap {
    background: transparent; color: var(--foreground);
    border: 1px solid var(--border); padding: 14px 30px; border-radius: 10px;
    font-weight: 600; font-size: 0.9rem;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; transition: all 0.25s ease;
}
.btn-outline-dap:hover { color: var(--foreground); border-color: var(--primary); background: hsla(174,72%,56%,0.08); }

/* ── Card Glass ── */
.card-glass {
    background: var(--card-bg); border: 1px solid var(--border);
    border-radius: 16px; transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.card-glass:hover {
    border-color: hsla(174,72%,56%,0.4);
    box-shadow: 0 0 32px hsla(174,72%,56%,0.12);
    transform: translateY(-3px);
}

/* ── Badge Pill ── */
.badge-pill-dap {
    display: inline-flex; align-items: center; gap: 6px;
    background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.25);
    color: hsl(174,72%,70%); border-radius: 9999px;
    font-size: 0.72rem; font-weight: 600; padding: 4px 14px;
    text-transform: uppercase; letter-spacing: 1px;
}

/* ─────────────────────────────────────────
   HERO SECTION
───────────────────────────────────────── */
.dap-hero {
    min-height: 100vh; background: var(--bg);
    position: relative; overflow: hidden;
    display: flex; flex-direction: column;
}
.dap-hero::before {
    content: ''; position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 80% 60% at 20% 40%, hsla(217,91%,60%,0.08) 0%, transparent 60%),
        radial-gradient(ellipse 60% 50% at 80% 20%, hsla(174,72%,56%,0.07) 0%, transparent 55%),
        radial-gradient(ellipse 50% 40% at 60% 80%, hsla(262,83%,58%,0.06) 0%, transparent 60%);
    pointer-events: none;
}
/* Animated grid lines */
.dap-hero::after {
    content: ''; position: absolute; inset: 0;
    background-image:
        linear-gradient(hsla(215,20%,65%,0.15) 1px, transparent 1px),
        linear-gradient(90deg, hsla(215,20%,65%,0.15) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none; opacity: 0.5;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black, transparent);
}
.dap-hero-content {
    flex: 1; display: flex; align-items: center;
    padding: 100px 0 80px; position: relative; z-index: 2;
}

/* Hero Kicker */
.dap-kicker {
    display: inline-flex; align-items: center; gap: 10px;
    background: hsla(217,91%,60%,0.1); border: 1px solid hsla(217,91%,60%,0.25);
    border-radius: 9999px; padding: 7px 18px;
    font-size: 0.73rem; font-weight: 300; color: hsl(217,91%,75%);
    margin-bottom: 28px;
}
.kicker-live { width: 7px; height: 7px; background: hsl(174,72%,56%); border-radius: 50%; animation: kicker-pulse 2s infinite; }
@keyframes kicker-pulse { 0%,100%{opacity:1;box-shadow:0 0 0 0 hsla(174,72%,56%,0.4)} 50%{opacity:0.7;box-shadow:0 0 0 5px hsla(174,72%,56%,0)} }

.dap-h1 {
    font-size: clamp(2.8rem, 5.5vw, 5rem);
    font-weight: 800; letter-spacing: -3px; line-height: 1.02; margin-bottom: 24px;
}
.dap-sub {
    font-size: 1.1rem; color: var(--muted); line-height: 1.9;
    margin-bottom: 40px; max-width: 520px;
}

/* Feature pills under hero */
.hero-feat-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 40px; }
.hpill {
    display: inline-flex; align-items: center; gap: 7px;
    background: #F8FAFC; border: 1px solid #E2E8F0;
    border-radius: 9px; padding: 7px 14px; font-size: 0.76rem; font-weight: 500; color: var(--muted);
    transition: all 0.2s;
}
.hpill:hover { border-color: var(--primary); color: var(--foreground); background: hsla(174,72%,56%,0.06); }
.hpill i { color: var(--primary); font-size: 0.72rem; }

/* ─ Hero Dashboard Mockup ─ */
.hero-mockup-wrap { position: relative; z-index: 3; }
.hero-dashboard {
    background: #FFFFFF; border: 1px solid #E2E8F0;
    border-radius: 16px; overflow: hidden;
    box-shadow: var(--shadow-elevated), 0 0 0 1px #E2E8F0;
}
.mockup-topbar {
    background: #F8FAFC; border-bottom: 1px solid #E2E8F0;
    padding: 12px 20px; display: flex; align-items: center; gap: 14px;
}
.topbar-dots { display: flex; gap: 6px; }
.topbar-dot { width: 11px; height: 11px; border-radius: 50%; }
.topbar-dot:nth-child(1) { background: hsl(0,72%,58%); }
.topbar-dot:nth-child(2) { background: hsl(38,92%,55%); }
.topbar-dot:nth-child(3) { background: hsl(132,60%,52%); }
.topbar-title { font-size: 0.78rem; font-weight: 600; color: var(--muted); margin-left: 8px; }
.topbar-status {
    margin-left: auto; display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.7rem; color: hsl(174,72%,60%);
    background: hsla(174,72%,56%,0.1); padding: 3px 10px; border-radius: 9999px;
    border: 1px solid hsla(174,72%,56%,0.2);
}
.status-dot { width: 6px; height: 6px; border-radius: 50%; background: hsl(174,72%,56%); animation: kicker-pulse 2s infinite; }

.mockup-body { display: grid; grid-template-columns: 190px 1fr; min-height: 380px; }
.mockup-sidebar {
    background: #F8FAFC; border-right: 1px solid #E2E8F0;
    padding: 16px 12px;
}
.mock-nav-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px; border-radius: 8px; font-size: 0.76rem;
    font-weight: 500; color: var(--muted); margin-bottom: 3px; cursor: pointer;
    transition: all 0.2s;
}
.mock-nav-item.active {
    background: hsla(217,91%,60%,0.15); color: hsl(217,91%,70%);
    border: 1px solid hsla(217,91%,60%,0.2);
}
.mock-nav-item i { width: 14px; text-align: center; font-size: 0.72rem; }
.mock-nav-divider { height: 1px; background: #E2E8F0; margin: 10px 6px; }

.mockup-main { padding: 20px; }
.mock-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
.mock-page-title { font-size: 0.9rem; font-weight: 700; color: var(--foreground); }
.mock-btn {
    background: var(--gradient-primary); color: #FFFFFF;
    border: none; padding: 6px 14px; border-radius: 7px;
    font-size: 0.72rem; font-weight: 700; cursor: pointer;
}

/* Stat row in mockup */
.mock-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 8px; margin-bottom: 14px; }
.mock-stat {
    background: #F8FAFC; border: 1px solid #E2E8F0;
    border-radius: 10px; padding: 12px;
}
.mock-stat-val { font-size: 1.35rem; font-weight: 700; line-height: 1; margin-bottom: 3px; }
.mock-stat-lbl { font-size: 0.65rem; color: var(--muted); font-weight: 500; }

/* Table in mockup */
.mock-table { background: #F8FAFC; border-radius: 10px; border: 1px solid #E2E8F0; overflow: hidden; }
.mock-table-header {
    display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
    padding: 8px 14px; background: #F1F5F9;
    font-size: 0.62rem; font-weight: 600; text-transform: uppercase;
    letter-spacing: 0.7px; color: var(--muted);
}
.mock-table-row {
    display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
    padding: 8px 14px; border-top: 1px solid #E2E8F0;
    font-size: 0.7rem; color: #334155; align-items: center;
}
.mock-score { font-weight: 700; }
.mock-score.hi { color: hsl(132,60%,55%); }
.mock-score.mid { color: hsl(38,92%,60%); }
.mock-score.lo { color: hsl(0,72%,60%); }
.mock-badge {
    display: inline-flex; padding: 2px 8px; border-radius: 9999px;
    font-size: 0.62rem; font-weight: 600;
}
.mock-badge.pass { background: hsla(132,60%,52%,0.15); color: hsl(132,60%,60%); }
.mock-badge.fail { background: hsla(0,72%,58%,0.15); color: hsl(0,72%,65%); }

/* Floating notification */
.float-notif {
    position: absolute; right: -18px; top: 20%;
    background: #FFFFFF; border: 1px solid #E2E8F0;
    border-radius: 14px; padding: 13px 16px;
    display: flex; align-items: center; gap: 12px;
    min-width: 220px; z-index: 10;
    animation: float-anim 4s ease-in-out infinite;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
}
.float-notif-2 {
    position: absolute; left: -22px; bottom: 15%;
    animation-delay: 2s;
}
@keyframes float-anim { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
.fnotif-icon {
    width: 38px; height: 38px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0;
}

/* ─────────────────────────────────────────
   MODULES OVERVIEW SECTION
───────────────────────────────────────── */
.modules-section {
    background: var(--bg-alt); padding: 110px 0;
    border-top: 1px solid var(--border); position: relative; overflow: hidden;
}
.modules-section::before {
    content: ''; position: absolute; top: -200px; right: -200px;
    width: 600px; height: 600px; border-radius: 50%;
    background: hsla(217,91%,60%,0.06); filter: blur(80px); pointer-events: none;
}

/* Magazine bento grid */
.bento-dap { display: grid; grid-template-columns: repeat(12,1fr); gap: 14px; }
.bd-7 { grid-column: span 7; }
.bd-5 { grid-column: span 5; }
.bd-4 { grid-column: span 4; }
.bd-8 { grid-column: span 8; }
.bd-6 { grid-column: span 6; }
.bd-12 { grid-column: span 12; }
@media(max-width:991px) { .bd-7,.bd-5,.bd-4,.bd-8,.bd-6 { grid-column: span 12 !important; } }

.bcard-dap {
    background: var(--card-bg); border: 1px solid var(--border);
    border-radius: 18px; padding: 30px; position: relative; overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.bcard-dap::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: var(--gradient-primary); opacity: 0; transition: opacity 0.3s;
}
.bcard-dap:hover { border-color: hsla(174,72%,56%,0.4); box-shadow: 0 0 40px hsla(174,72%,56%,0.1); transform: translateY(-4px); }
.bcard-dap:hover::before { opacity: 1; }

.bcard-dap.accent-indigo { border-color: hsla(217,91%,60%,0.2); }
.bcard-dap.accent-indigo:hover { border-color: hsla(217,91%,60%,0.45); box-shadow: 0 0 40px hsla(217,91%,60%,0.1); }
.bcard-dap.accent-indigo::before { background: var(--gradient-secondary); }

.bcard-dap.accent-violet { border-color: hsla(262,83%,58%,0.2); }
.bcard-dap.accent-violet:hover { border-color: hsla(262,83%,58%,0.45); box-shadow: 0 0 40px hsla(262,83%,58%,0.1); }
.bcard-dap.accent-violet::before { background: linear-gradient(135deg, hsl(262,83%,58%), hsl(217,91%,60%)); }

.bmod-icon {
    width: 52px; height: 52px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center; font-size: 1.3rem;
    margin-bottom: 20px;
}
.bi-cyan   { background: hsla(174,72%,56%,0.15); color: hsl(174,72%,60%); }
.bi-indigo { background: hsla(217,91%,60%,0.15); color: hsl(217,91%,70%); }
.bi-violet { background: hsla(262,83%,58%,0.15); color: hsl(262,83%,72%); }
.bi-amber  { background: hsla(38,92%,50%,0.15);  color: hsl(38,92%,62%); }
.bi-rose   { background: hsla(347,77%,50%,0.15); color: hsl(347,77%,65%); }
.bi-green  { background: hsla(142,72%,50%,0.15); color: hsl(142,72%,60%); }

.bmod-title { font-size: 1.05rem; font-weight: 700; color: var(--foreground); margin-bottom: 8px; letter-spacing: -0.4px; }
.bmod-desc  { font-size: 0.84rem; color: var(--muted); line-height: 1.78; margin-bottom: 16px; }
.bmod-tags  { display: flex; flex-wrap: wrap; gap: 6px; }
.bmod-tag {
    display: inline-flex; align-items: center; gap: 5px;
    background: #F8FAFC; border: 1px solid #E2E8F0;
    border-radius: 7px; padding: 4px 10px; font-size: 0.68rem; font-weight: 600; color: var(--muted);
}
.bmod-tag i { font-size: 0.6rem; color: var(--primary); }

/* ─────────────────────────────────────────
   EXAM CREATION SECTION
───────────────────────────────────────── */
.exam-creation-section {
    background: var(--bg); padding: 110px 0;
    border-top: 1px solid var(--border); position: relative; overflow: hidden;
}
.exam-creation-section::before {
    content: ''; position: absolute; bottom: -100px; left: -200px;
    width: 500px; height: 500px; border-radius: 50%;
    background: hsla(174,72%,56%,0.06); filter: blur(80px); pointer-events: none;
}

/* Exam Builder UI Mockup */
.exam-builder {
    background: #FFFFFF; border: 1px solid #E2E8F0;
    border-radius: 18px; overflow: hidden;
    box-shadow: var(--shadow-elevated);
}
.eb-header {
    background: #F8FAFC; border-bottom: 1px solid #E2E8F0;
    padding: 14px 22px; display: flex; align-items: center; gap: 16px;
}
.eb-title { font-size: 0.85rem; font-weight: 700; color: var(--foreground); }
.eb-tabs { display: flex; gap: 2px; background: #F1F5F9; border-radius: 8px; padding: 2px; }
.eb-tab {
    padding: 5px 14px; border-radius: 6px; font-size: 0.73rem; font-weight: 600;
    color: var(--muted); cursor: pointer; transition: all 0.2s;
}
.eb-tab.active { background: #FFFFFF; color: var(--foreground); }
.eb-body { padding: 22px; }
.eb-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px; }
.eb-field label { display: block; font-size: 0.67rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.7px; margin-bottom: 5px; }
.eb-input {
    width: 100%; background: #FFFFFF; border: 1px solid #E2E8F0;
    border-radius: 8px; padding: 9px 13px; font-size: 0.78rem; color: var(--foreground);
    font-family: inherit;
}
.eb-input.highlight { border-color: hsla(217,91%,60%,0.4); box-shadow: 0 0 0 3px hsla(217,91%,60%,0.08); }

/* Question card in builder */
.q-card {
    background: #F8FAFC; border: 1px solid #E2E8F0;
    border-radius: 12px; padding: 16px; margin-bottom: 10px;
    position: relative;
}
.q-card.active-q { border-color: hsla(217,91%,60%,0.4); }
.q-num {
    display: inline-flex; align-items: center; justify-content: center;
    width: 24px; height: 24px; border-radius: 6px;
    background: var(--gradient-secondary); color: #FFFFFF;
    font-size: 0.65rem; font-weight: 800; margin-bottom: 10px;
}
.q-text { font-size: 0.8rem; color: var(--foreground); font-weight: 500; margin-bottom: 10px; }
.q-options { display: grid; grid-template-columns: 1fr 1fr; gap: 6px; }
.q-opt {
    background: #F1F5F9; border: 1px solid #E2E8F0;
    border-radius: 7px; padding: 6px 10px; font-size: 0.7rem; color: var(--muted);
    display: flex; align-items: center; gap: 7px;
}
.q-opt.correct { border-color: hsla(174,72%,56%,0.4); background: hsla(174,72%,56%,0.08); color: hsl(174,72%,65%); }
.q-opt-radio { width: 13px; height: 13px; border-radius: 50%; border: 2px solid #CBD5E1; flex-shrink: 0; }
.q-opt.correct .q-opt-radio { border-color: hsl(174,72%,56%); background: hsl(174,72%,56%); }

.eb-footer {
    background: #F8FAFC; border-top: 1px solid #E2E8F0;
    padding: 14px 22px; display: flex; align-items: center; justify-content: space-between;
}
.eb-save {
    background: var(--gradient-primary); color: #FFFFFF;
    border: none; padding: 9px 20px; border-radius: 8px;
    font-size: 0.78rem; font-weight: 700; cursor: pointer;
}

/* ─────────────────────────────────────────
   STUDENT EXAM PORTAL SECTION
───────────────────────────────────────── */
.student-portal-section {
    background: #F1F5F9; padding: 110px 0;
    border-top: 1px solid var(--border); position: relative; overflow: hidden;
}
.student-portal-section::after {
    content: ''; position: absolute; top: -150px; right: -150px;
    width: 500px; height: 500px; border-radius: 50%;
    background: hsla(262,83%,58%,0.06); filter: blur(80px); pointer-events: none;
}

/* Student exam UI */
.student-exam-ui {
    background: #FFFFFF; border: 1px solid #E2E8F0;
    border-radius: 18px; overflow: hidden; box-shadow: var(--shadow-elevated);
}
.seu-header {
    background: linear-gradient(135deg, hsl(226,58%,16%), hsl(234,62%,22%));
    padding: 14px 22px; display: flex; align-items: center; justify-content: space-between;
    border-bottom: 1px solid hsla(217,91%,60%,0.2);
}
.seu-exam-name { font-size: 0.88rem; font-weight: 700; color: var(--foreground); }
.seu-timer {
    display: flex; align-items: center; gap: 8px;
    background: hsla(0,72%,58%,0.15); border: 1px solid hsla(0,72%,58%,0.3);
    border-radius: 8px; padding: 6px 14px;
    font-size: 0.82rem; font-weight: 700; color: hsl(0,72%,65%);
    font-variant-numeric: tabular-nums;
}
.seu-body { display: grid; grid-template-columns: 1fr 220px; min-height: 380px; }
.seu-main { padding: 22px; border-right: 1px solid #E2E8F0; }
.seu-q-num { font-size: 0.68rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 8px; }
.seu-q-text { font-size: 0.88rem; font-weight: 600; color: var(--foreground); line-height: 1.6; margin-bottom: 18px; }
.seu-opts { display: flex; flex-direction: column; gap: 8px; }
.seu-opt {
    display: flex; align-items: center; gap: 12px;
    background: #F8FAFC; border: 1px solid #E2E8F0;
    border-radius: 10px; padding: 11px 14px; cursor: pointer; transition: all 0.2s;
}
.seu-opt:hover { border-color: hsla(217,91%,60%,0.3); background: hsla(217,91%,60%,0.05); }
.seu-opt.selected { border-color: hsla(217,91%,60%,0.5); background: hsla(217,91%,60%,0.1); }
.seu-opt-radio {
    width: 16px; height: 16px; border-radius: 50%; border: 2px solid #CBD5E1;
    flex-shrink: 0; display: flex; align-items: center; justify-content: center;
}
.seu-opt.selected .seu-opt-radio { border-color: hsl(217,91%,60%); background: hsl(217,91%,60%); }
.seu-opt.selected .seu-opt-radio::after { content: ''; width: 6px; height: 6px; border-radius: 50%; background: white; }
.seu-opt-text { font-size: 0.8rem; color: #334155; }
.seu-opt.selected .seu-opt-text { color: hsl(217,91%,75%); font-weight: 600; }

/* Question navigator */
.seu-sidebar { padding: 18px; }
.seu-progress-label { font-size: 0.68rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 10px; }
.seu-progress-bar { height: 5px; background: #E2E8F0; border-radius: 9999px; overflow: hidden; margin-bottom: 16px; }
.seu-progress-fill { height: 100%; background: var(--gradient-primary); border-radius: 9999px; width: 40%; }
.seu-q-grid { display: grid; grid-template-columns: repeat(5,1fr); gap: 6px; }
.seu-q-dot {
    aspect-ratio: 1; border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.65rem; font-weight: 700; cursor: pointer; transition: all 0.2s;
}
.seu-q-dot.answered { background: hsla(217,91%,60%,0.2); color: hsl(217,91%,70%); border: 1px solid hsla(217,91%,60%,0.3); }
.seu-q-dot.current  { background: var(--gradient-secondary); color: white; }
.seu-q-dot.unanswered { background: #F1F5F9; color: var(--muted); border: 1px solid #E2E8F0; }
.seu-submit { background: var(--gradient-primary); color: #FFFFFF; border: none; width: 100%; padding: 10px; border-radius: 9px; font-size: 0.8rem; font-weight: 700; cursor: pointer; margin-top: 16px; }

.seu-footer {
    border-top: 1px solid #E2E8F0; padding: 14px 22px;
    display: flex; align-items: center; justify-content: space-between;
    background: #F8FAFC;
}
.seu-nav-btns { display: flex; gap: 8px; }
.seu-btn-prev { background: #F1F5F9; border: 1px solid #E2E8F0; color: var(--muted); padding: 7px 16px; border-radius: 7px; font-size: 0.75rem; font-weight: 600; cursor: pointer; }
.seu-btn-next { background: var(--gradient-secondary); color: white; border: none; padding: 7px 16px; border-radius: 7px; font-size: 0.75rem; font-weight: 700; cursor: pointer; }

/* ─────────────────────────────────────────
   ANALYTICS SECTION
───────────────────────────────────────── */
.analytics-section {
    background: var(--bg); padding: 110px 0;
    border-top: 1px solid var(--border); position: relative; overflow: hidden;
}
.analytics-section::before {
    content: ''; position: absolute; top: -100px; left: 50%;
    transform: translateX(-50%); width: 800px; height: 400px;
    background: radial-gradient(ellipse, hsla(217,91%,60%,0.08) 0%, transparent 70%);
    pointer-events: none;
}

/* Analytics dashboard mockup */
.analytics-ui {
    background: #FFFFFF; border: 1px solid #E2E8F0;
    border-radius: 18px; overflow: hidden; box-shadow: var(--shadow-elevated);
}
.au-header {
    background: #F8FAFC; border-bottom: 1px solid #E2E8F0;
    padding: 14px 22px; display: flex; align-items: center; gap: 14px;
}
.au-title { font-size: 0.88rem; font-weight: 700; color: var(--foreground); }
.au-filter {
    margin-left: auto; display: flex; gap: 6px;
}
.au-filter-btn {
    background: #F1F5F9; border: 1px solid #E2E8F0;
    color: var(--muted); padding: 5px 12px; border-radius: 6px; font-size: 0.7rem; font-weight: 600; cursor: pointer;
}
.au-filter-btn.active { background: hsla(217,91%,60%,0.15); color: hsl(217,91%,70%); border-color: hsla(217,91%,60%,0.3); }
.au-body { padding: 22px; }

/* KPI row */
.au-kpis { display: grid; grid-template-columns: repeat(4,1fr); gap: 10px; margin-bottom: 20px; }
.au-kpi { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px; }
.au-kpi-val { font-size: 1.5rem; font-weight: 800; line-height: 1; margin-bottom: 4px; }
.au-kpi-lbl { font-size: 0.65rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.6px; }
.au-kpi-change { font-size: 0.68rem; font-weight: 600; margin-top: 6px; display: flex; align-items: center; gap: 4px; }
.au-kpi-change.up { color: hsl(142,72%,55%); }
.au-kpi-change.down { color: hsl(0,72%,60%); }

/* Chart area */
.au-charts { display: grid; grid-template-columns: 1.5fr 1fr; gap: 14px; }
.au-chart-box { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 16px; }
.au-chart-title { font-size: 0.75rem; font-weight: 700; color: var(--foreground); margin-bottom: 14px; }

/* Bar chart simulation */
.bar-chart { display: flex; align-items: flex-end; gap: 6px; height: 100px; }
.bar-chart-bar { flex: 1; border-radius: 5px 5px 0 0; position: relative; }
.bar-chart-bar::after { content: attr(data-label); position: absolute; bottom: -18px; left: 50%; transform: translateX(-50%); font-size: 0.58rem; color: var(--muted); white-space: nowrap; }
.bar-chart-wrap { padding-bottom: 22px; }

/* Donut chart simulation */
.donut-wrap {
    display: flex; align-items: center; gap: 16px;
}
.donut {
    width: 90px; height: 90px; border-radius: 50%; flex-shrink: 0;
    background: conic-gradient(
        hsl(174,72%,56%) 0% 60%,
        hsl(217,91%,60%) 60% 80%,
        hsl(262,83%,58%) 80% 92%,
        #E2E8F0 92% 100%
    );
    position: relative;
}
.donut::after {
    content: '76%'; position: absolute; inset: 16px; border-radius: 50%;
    background: #F8FAFC; display: flex; align-items: center; justify-content: center;
    font-size: 0.75rem; font-weight: 800; color: var(--foreground);
}
.donut-legend { display: flex; flex-direction: column; gap: 6px; }
.donut-leg-item { display: flex; align-items: center; gap: 7px; font-size: 0.68rem; color: var(--muted); }
.donut-leg-dot { width: 9px; height: 9px; border-radius: 3px; flex-shrink: 0; }

/* Subject performance bars */
.subject-bars { display: flex; flex-direction: column; gap: 10px; }
.sub-bar-row { display: flex; align-items: center; gap: 12px; }
.sub-bar-label { font-size: 0.7rem; color: var(--muted); width: 65px; flex-shrink: 0; }
.sub-bar-track { flex: 1; height: 8px; background: #E2E8F0; border-radius: 9999px; overflow: hidden; }
.sub-bar-fill { height: 100%; border-radius: 9999px; }
.sub-bar-val { font-size: 0.7rem; font-weight: 700; width: 30px; text-align: right; flex-shrink: 0; }

/* Ranking table */
.rank-table { overflow: hidden; }
.rank-row { display: flex; align-items: center; gap: 12px; padding: 8px 0; border-bottom: 1px solid #E2E8F0; }
.rank-row:last-child { border: none; }
.rank-num { width: 22px; height: 22px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 0.62rem; font-weight: 800; flex-shrink: 0; }
.rank-1 { background: hsla(38,92%,50%,0.2); color: hsl(38,92%,60%); }
.rank-2 { background: hsla(215,20%,65%,0.2); color: hsl(215,20%,70%); }
.rank-3 { background: hsla(25,70%,45%,0.2); color: hsl(25,70%,60%); }
.rank-other { background: #F1F5F9; color: var(--muted); }
.rank-name { font-size: 0.74rem; font-weight: 600; color: var(--foreground); flex: 1; }
.rank-score { font-size: 0.74rem; font-weight: 700; color: hsl(174,72%,60%); }

/* ─────────────────────────────────────────
   REPORT CARD SECTION
───────────────────────────────────────── */
.report-section {
    background: #F1F5F9; padding: 110px 0;
    border-top: 1px solid var(--border); position: relative; overflow: hidden;
}
.report-section::before {
    content: ''; position: absolute; bottom: -100px; right: -100px;
    width: 400px; height: 400px; border-radius: 50%;
    background: hsla(174,72%,56%,0.06); filter: blur(80px); pointer-events: none;
}

/* Report Card UI */
.report-card-ui {
    background: #FFFFFF; border: 1px solid #E2E8F0;
    border-radius: 18px; overflow: hidden; box-shadow: var(--shadow-elevated);
    max-width: 520px;
}
.rc-header {
    background: linear-gradient(135deg, hsl(217,91%,25%), hsl(234,62%,20%));
    padding: 22px; border-bottom: 1px solid hsla(217,91%,60%,0.2);
}
.rc-school { font-size: 0.68rem; font-weight: 600; color: hsl(217,91%,70%); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 4px; }
.rc-title { font-size: 1rem; font-weight: 800; color: white; margin-bottom: 14px; }
.rc-student-row { display: flex; align-items: center; gap: 14px; }
.rc-avatar {
    width: 46px; height: 46px; border-radius: 12px;
    background: linear-gradient(135deg, hsl(174,72%,45%), hsl(217,91%,55%));
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; font-weight: 800; color: white; flex-shrink: 0;
}
.rc-student-name { font-size: 0.85rem; font-weight: 700; color: white; }
.rc-student-meta { font-size: 0.7rem; color: hsla(210,40%,98%,0.6); margin-top: 2px; }
.rc-grade-badge {
    margin-left: auto; background: linear-gradient(135deg, hsl(174,72%,45%), hsl(38,92%,55%));
    padding: 6px 14px; border-radius: 9px;
    font-size: 0.78rem; font-weight: 800; color: white;
}

.rc-body { padding: 20px; }
.rc-section-title { font-size: 0.68rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 12px; }
.rc-subject-table { margin-bottom: 20px; }
.rc-sub-row { display: grid; grid-template-columns: 1.5fr 80px 80px 70px; gap: 8px; align-items: center; padding: 8px 0; border-bottom: 1px solid #E2E8F0; }
.rc-sub-row:last-child { border: none; }
.rc-sub-name { font-size: 0.76rem; color: #334155; font-weight: 500; }
.rc-sub-marks { font-size: 0.76rem; font-weight: 700; text-align: center; }
.rc-sub-grade { font-size: 0.72rem; font-weight: 800; text-align: center; padding: 2px 7px; border-radius: 5px; }
.rc-grade-a { background: hsla(142,72%,50%,0.15); color: hsl(142,72%,60%); }
.rc-grade-b { background: hsla(217,91%,60%,0.15); color: hsl(217,91%,70%); }
.rc-grade-c { background: hsla(38,92%,50%,0.15); color: hsl(38,92%,62%); }
.rc-grade-d { background: hsla(0,72%,58%,0.15); color: hsl(0,72%,65%); }
.rc-sub-pct { font-size: 0.72rem; color: var(--muted); text-align: right; }

.rc-summary {
    background: #F8FAFC; border-radius: 12px; padding: 16px;
    display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px;
    margin-bottom: 16px;
}
.rc-sum-item { text-align: center; }
.rc-sum-val { font-size: 1.3rem; font-weight: 800; line-height: 1; margin-bottom: 3px; }
.rc-sum-lbl { font-size: 0.62rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.6px; }

.rc-footer {
    border-top: 1px solid #E2E8F0; padding: 14px 20px;
    display: flex; align-items: center; gap: 10px;
}
.rc-dl-btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--gradient-primary); color: #FFFFFF;
    border: none; padding: 9px 18px; border-radius: 8px;
    font-size: 0.76rem; font-weight: 700; cursor: pointer;
}
.rc-share-btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: #F1F5F9; border: 1px solid #E2E8F0;
    color: var(--muted); padding: 9px 16px; border-radius: 8px;
    font-size: 0.76rem; font-weight: 600; cursor: pointer;
}

/* ─────────────────────────────────────────
   QUESTION BANK SECTION
───────────────────────────────────────── */
.qbank-section {
    background: var(--bg); padding: 110px 0;
    border-top: 1px solid var(--border); position: relative; overflow: hidden;
}
.qbank-section::after {
    content: ''; position: absolute; top: -100px; left: -100px;
    width: 400px; height: 400px; border-radius: 50%;
    background: hsla(262,83%,58%,0.06); filter: blur(80px); pointer-events: none;
}

/* Question Bank UI */
.qbank-ui {
    background: #FFFFFF; border: 1px solid #E2E8F0;
    border-radius: 18px; overflow: hidden; box-shadow: var(--shadow-elevated);
}
.qb-header {
    background: #F8FAFC; border-bottom: 1px solid #E2E8F0;
    padding: 14px 22px; display: flex; align-items: center; justify-content: space-between;
}
.qb-filters { display: flex; gap: 8px; }
.qb-filter {
    background: #F1F5F9; border: 1px solid #E2E8F0;
    border-radius: 7px; padding: 5px 12px; font-size: 0.7rem; font-weight: 600; color: var(--muted); cursor: pointer;
}
.qb-filter.active { border-color: hsla(262,83%,58%,0.4); color: hsl(262,83%,72%); background: hsla(262,83%,58%,0.1); }
.qb-body { padding: 18px; }

.qb-question {
    background: #F8FAFC; border: 1px solid #E2E8F0;
    border-radius: 12px; padding: 14px; margin-bottom: 10px; transition: all 0.2s;
}
.qb-question:hover { border-color: hsla(262,83%,58%,0.35); }
.qb-q-meta { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
.qb-q-subject { background: hsla(217,91%,60%,0.12); color: hsl(217,91%,70%); padding: 2px 8px; border-radius: 5px; font-size: 0.62rem; font-weight: 700; }
.qb-q-type { background: hsla(262,83%,58%,0.12); color: hsl(262,83%,72%); padding: 2px 8px; border-radius: 5px; font-size: 0.62rem; font-weight: 700; }
.qb-q-diff-easy { background: hsla(142,72%,50%,0.12); color: hsl(142,72%,60%); padding: 2px 8px; border-radius: 5px; font-size: 0.62rem; font-weight: 700; }
.qb-q-diff-med { background: hsla(38,92%,50%,0.12); color: hsl(38,92%,62%); padding: 2px 8px; border-radius: 5px; font-size: 0.62rem; font-weight: 700; }
.qb-q-diff-hard { background: hsla(0,72%,58%,0.12); color: hsl(0,72%,65%); padding: 2px 8px; border-radius: 5px; font-size: 0.62rem; font-weight: 700; }
.qb-q-text { font-size: 0.78rem; color: var(--foreground); font-weight: 500; line-height: 1.5; }
.qb-q-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 8px; }
.qb-q-marks { font-size: 0.65rem; color: var(--muted); }
.qb-q-actions { display: flex; gap: 5px; }
.qb-q-action { width: 26px; height: 26px; border-radius: 7px; background: #F1F5F9; border: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; color: var(--muted); cursor: pointer; }
.qb-q-action:hover { border-color: var(--primary); color: var(--primary); }

.qb-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-top: 16px; }
.qb-stat { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 12px; text-align: center; }
.qb-stat-val { font-size: 1.4rem; font-weight: 800; line-height: 1; margin-bottom: 3px; }
.qb-stat-lbl { font-size: 0.62rem; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; }

/* ─────────────────────────────────────────
   HOW IT WORKS
───────────────────────────────────────── */
.how-dap-section {
    background: #F1F5F9; padding: 110px 0;
    border-top: 1px solid var(--border);
}
.step-card-dap {
    background: var(--card-bg); border: 1px solid var(--border);
    border-radius: 18px; padding: 32px; height: 100%;
    position: relative; overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.step-card-dap::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: var(--gradient-primary); opacity: 0; transition: opacity 0.3s;
}
.step-card-dap:hover { border-color: hsla(174,72%,56%,0.4); box-shadow: 0 0 32px hsla(174,72%,56%,0.1); transform: translateY(-4px); }
.step-card-dap:hover::before { opacity: 1; }
.step-num-dap {
    width: 44px; height: 44px; border-radius: 12px;
    background: var(--gradient-primary); color: #FFFFFF;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 1rem; margin-bottom: 20px;
}
.step-big-num {
    position: absolute; bottom: 10px; right: 20px;
    font-size: 6rem; font-weight: 900; color: rgba(0,0,0,0.04);
    line-height: 1; letter-spacing: -4px; pointer-events: none;
    font-variant-numeric: tabular-nums;
}
.step-title-dap { font-size: 1rem; font-weight: 700; color: var(--foreground); margin-bottom: 8px; }
.step-desc-dap { font-size: 0.84rem; color: var(--muted); line-height: 1.78; }

/* ─────────────────────────────────────────
   BEFORE / AFTER
───────────────────────────────────────── */
.vs-section {
    background: var(--bg); padding: 110px 0;
    border-top: 1px solid var(--border); position: relative;
}
.vs-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0; border: 1px solid var(--border); border-radius: 20px; overflow: hidden; }
@media(max-width:767px) { .vs-grid { grid-template-columns: 1fr; } }
.vs-before { background: hsla(0,50%,15%,0.2); border-right: 1px solid var(--border); padding: 40px; }
.vs-after  { background: hsla(174,50%,10%,0.3); padding: 40px; }
.vs-label {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px;
    border-radius: 8px; padding: 5px 14px; margin-bottom: 28px;
}
.vs-label.before { background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(239,68,68,0.2); }
.vs-label.after  { background: hsla(174,72%,56%,0.12); color: hsl(174,72%,65%); border: 1px solid hsla(174,72%,56%,0.2); }
.vs-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 18px; }
.vs-item:last-child { margin-bottom: 0; }
.vs-icon-x { width: 30px; height: 30px; border-radius: 8px; background: rgba(239,68,68,0.12); color: #f87171; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0; margin-top: 2px; }
.vs-icon-c { width: 30px; height: 30px; border-radius: 8px; background: hsla(174,72%,56%,0.12); color: hsl(174,72%,60%); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0; margin-top: 2px; }
.vs-text { font-size: 0.9rem; color: var(--muted); line-height: 1.65; }
.vs-text strong { color: var(--foreground); font-weight: 600; }

/* ─────────────────────────────────────────
   CTA SECTION
───────────────────────────────────────── */
.dap-cta-section { background: var(--bg-alt); padding: 120px 0; border-top: 1px solid var(--border); }
.dap-cta-box {
    border-radius: 24px; padding: 80px 60px; text-align: center;
    position: relative; overflow: hidden;
    background: linear-gradient(135deg, hsl(226,58%,11%), hsl(234,62%,14%));
    border: 1px solid hsla(217,91%,60%,0.15);
}
.dap-cta-box::before {
    content: ''; position: absolute; top: -250px; left: 50%;
    transform: translateX(-50%); width: 900px; height: 500px;
    background: radial-gradient(ellipse, hsla(217,91%,60%,0.18) 0%, transparent 65%);
    pointer-events: none;
}
.dap-cta-box::after {
    content: ''; position: absolute;
    inset: 0; border-radius: 24px;
    background-image:
        linear-gradient(hsla(217,33%,30%,0.15) 1px, transparent 1px),
        linear-gradient(90deg, hsla(217,33%,30%,0.15) 1px, transparent 1px);
    background-size: 40px 40px;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black, transparent);
    pointer-events: none;
}
.dap-cta-content { position: relative; z-index: 2; }
.dap-cta-eyebrow { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 24px; background: hsla(217,91%,60%,0.12); border: 1px solid hsla(217,91%,60%,0.25); border-radius: 9999px; padding: 6px 16px; font-size: 0.72rem; font-weight: 600; color: hsl(217,91%,75%); text-transform: uppercase; letter-spacing: 1px; }
.dap-cta-h2 {
    font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 800; letter-spacing: -2px;
    color: var(--foreground); margin-bottom: 18px; line-height: 1.1;
}
.dap-cta-p { color: var(--muted); font-size: 1.05rem; max-width: 500px; margin: 0 auto 40px; line-height: 1.85; }
.dap-cta-trust { display: flex; gap: 24px; justify-content: center; flex-wrap: wrap; margin-top: 28px; }
.dap-cta-trust-item { font-size: 0.78rem; color: hsl(215,20%,55%); display: inline-flex; align-items: center; gap: 6px; }
.dap-cta-trust-item i { color: hsl(174,72%,56%); }

/* ─────────────────────────────────────────
   RESPONSIVE
───────────────────────────────────────── */
@media(max-width:991px) {
    .dap-hero-content { padding: 130px 0 60px; }
    .mockup-body { grid-template-columns: 1fr; min-height: auto; }
    .mockup-sidebar { display: none; }
    .float-notif { display: none; }
    .au-kpis { grid-template-columns: repeat(2,1fr); }
    .au-charts { grid-template-columns: 1fr; }
    .qb-stats { grid-template-columns: repeat(3,1fr); }
    .dap-cta-box { padding: 50px 30px; }
    .mock-stats { grid-template-columns: repeat(2,1fr); }
    .eb-row { grid-template-columns: 1fr; }
    .seu-body { grid-template-columns: 1fr; }
    .seu-sidebar { display: none; }
    .rc-summary { grid-template-columns: repeat(3,1fr); }
}
@media(max-width:768px) {
    .dap-hero-content { padding: 220px 0 60px; }
    .dap-h1 { font-size: clamp(2.2rem, 7vw, 3rem) !important; letter-spacing: -1.5px; }
    .dap-sub { font-size: 0.95rem; }
    .dap-cta-box { padding: 40px 22px; }
    .dap-cta-h2 { font-size: 1.8rem !important; letter-spacing: -1px; }
    .vs-before { border-right: none; border-bottom: 1px solid var(--border); }
    .au-kpis { grid-template-columns: repeat(2,1fr); }
    .qb-stats { grid-template-columns: repeat(3,1fr); }
    .rc-sub-row { grid-template-columns: 1fr 60px 55px; }
    .rc-sub-pct { display: none; }
    .rc-summary { grid-template-columns: repeat(3,1fr); }
    .hero-feat-pills { display: grid; grid-template-columns: 1fr 1fr; }
}
</style>
</head>
<body>

@include('components.frontend-navbar')

<!-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ -->
<section class="dap-hero">
    <div class="dap-hero-content">
        <div class="container px-4">
            <div class="row align-items-center g-5">

                <!-- Copy -->
                <div class="col-lg-5 text-center text-lg-start">
                    <div class="dap-kicker">
                        <span class="kicker-live"></span>
                        Digital Assessment Platform · EduNex ERP
                    </div>
                    <h1 class="dap-h1">
                        Exams. Evaluated.<br>
                        <span class="g-text">Instantly.</span>
                    </h1>
                    <p class="dap-sub">
                        Transform traditional paper-based examinations into a fully digital, data-driven assessment ecosystem — designed for schools, colleges, and coaching institutes.
                    </p>

                    <div class="hero-feat-pills">
                        <span class="hpill"><i class="fas fa-laptop"></i> Online Exams</span>
                        <span class="hpill"><i class="fas fa-database"></i> Question Bank</span>
                        <span class="hpill"><i class="fas fa-robot"></i> Auto Grading</span>
                        <span class="hpill"><i class="fas fa-chart-bar"></i> Analytics</span>
                        <span class="hpill"><i class="fas fa-file-invoice"></i> Report Cards</span>
                        <span class="hpill"><i class="fas fa-clock"></i> Live Timer</span>
                    </div>

                    <div class="d-flex gap-3 flex-wrap justify-content-center justify-content-lg-start">
                        <a href="{{ route('contact') }}" class="btn-primary-dap">
                            Request Demo <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('pricing') }}" class="btn-outline-dap">
                            <i class="fas fa-rocket"></i> Get Started
                        </a>
                    </div>
                    <p style="margin-top:14px;font-size:0.75rem;color:var(--muted);">
                        <i class="fas fa-shield-alt me-1" style="color:hsl(174,72%,56%);"></i> No credit card &nbsp;·&nbsp;
                        <i class="fas fa-bolt me-1" style="color:hsl(217,91%,60%);"></i> Live in 15 minutes &nbsp;·&nbsp;
                        <i class="fas fa-check me-1" style="color:hsl(142,72%,56%);"></i> Free 7-day trial
                    </p>
                </div>

                <!-- Dashboard Mockup -->
                <div class="col-lg-7" style="margin-top:-30px;">
                    <div class="hero-mockup-wrap position-relative">
                        <!-- Floating notification 1 -->
                        <div class="float-notif">
                            <div class="fnotif-icon" style="background:hsla(142,72%,50%,0.15);color:hsl(142,72%,60%);">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <div>
                                <div style="font-size:0.72rem;font-weight:700;color:var(--foreground);margin-bottom:2px;">Results Published!</div>
                                <div style="font-size:0.65rem;color:var(--muted);">Math Mid-Term · 124 students</div>
                            </div>
                        </div>
                        <!-- Floating notification 2 -->
                        <!-- <div class="float-notif float-notif-2">
                            <div class="fnotif-icon" style="background:hsla(217,91%,60%,0.15);color:hsl(217,91%,70%);">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <div style="font-size:0.72rem;font-weight:700;color:var(--foreground);margin-bottom:2px;">Exam Live Now</div>
                                <div style="font-size:0.65rem;color:var(--muted);">Physics Final · 38/40 joined</div>
                            </div>
                        </div> -->

                        <div class="hero-dashboard">
                            <div class="mockup-topbar">
                                <div class="topbar-dots">
                                    <div class="topbar-dot"></div>
                                    <div class="topbar-dot"></div>
                                    <div class="topbar-dot"></div>
                                </div>
                                <div class="topbar-title">EduNex ERP · Assessment Dashboard</div>
                                <div class="topbar-status">
                                    <div class="status-dot"></div>
                                    Live
                                </div>
                            </div>
                            <div class="mockup-body">
                                <div class="mockup-sidebar">
                                    <div class="mock-nav-item"><i class="fas fa-gauge-high"></i> Dashboard</div>
                                    <div class="mock-nav-item active"><i class="fas fa-clipboard-list"></i> Exams</div>
                                    <div class="mock-nav-item"><i class="fas fa-database"></i> Question Bank</div>
                                    <div class="mock-nav-item"><i class="fas fa-chart-bar"></i> Analytics</div>
                                    <div class="mock-nav-item"><i class="fas fa-file-invoice"></i> Report Cards</div>
                                    <div class="mock-nav-divider"></div>
                                    <div class="mock-nav-item"><i class="fas fa-cog"></i> Settings</div>
                                </div>
                                <div class="mockup-main">
                                    <div class="mock-header">
                                        <div class="mock-page-title">Exam Results Overview</div>
                                        <button class="mock-btn"><i class="fas fa-plus me-1"></i> New Exam</button>
                                    </div>
                                    <div class="mock-stats">
                                        <div class="mock-stat">
                                            <div class="mock-stat-val g-text">124</div>
                                            <div class="mock-stat-lbl">Appeared</div>
                                        </div>
                                        <div class="mock-stat">
                                            <div class="mock-stat-val" style="color:hsl(142,72%,60%);">98</div>
                                            <div class="mock-stat-lbl">Passed</div>
                                        </div>
                                        <div class="mock-stat">
                                            <div class="mock-stat-val" style="color:hsl(38,92%,60%);">79.2%</div>
                                            <div class="mock-stat-lbl">Avg Score</div>
                                        </div>
                                        <div class="mock-stat">
                                            <div class="mock-stat-val" style="color:hsl(0,72%,65%);">26</div>
                                            <div class="mock-stat-lbl">Failed</div>
                                        </div>
                                    </div>
                                    <div class="mock-table">
                                        <div class="mock-table-header">
                                            <span>Student Name</span>
                                            <span>Marks</span>
                                            <span>Percentage</span>
                                            <span>Status</span>
                                        </div>
                                        <div class="mock-table-row">
                                            <span>Aarav Sharma</span>
                                            <span class="mock-score hi">94/100</span>
                                            <span>94%</span>
                                            <span><span class="mock-badge pass">Pass</span></span>
                                        </div>
                                        <div class="mock-table-row">
                                            <span>SanjayMehta</span>
                                            <span class="mock-score mid">76/100</span>
                                            <span>76%</span>
                                            <span><span class="mock-badge pass">Pass</span></span>
                                        </div>
                                        <div class="mock-table-row">
                                            <span>Ravi Kumar</span>
                                            <span class="mock-score lo">38/100</span>
                                            <span>38%</span>
                                            <span><span class="mock-badge fail">Fail</span></span>
                                        </div>
                                        <div class="mock-table-row">
                                            <span>Sneha Patel</span>
                                            <span class="mock-score hi">88/100</span>
                                            <span>88%</span>
                                            <span><span class="mock-badge pass">Pass</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Stats Strip -->
    <div style="border-top:1px solid var(--border);background:hsla(222,47%,8%,0.6);padding:32px 0;position:relative;z-index:2;">
        <div class="container px-4">
            <div class="d-flex align-items-center justify-content-center gap-4 gap-md-5 flex-wrap text-center">
                <div><div class="stat-val g-text" style="font-size:1.8rem;font-weight:800;letter-spacing:-1px;">100+</div><div style="font-size:0.72rem;color:var(--muted);margin-top:3px;">Institutes</div></div>
                <div class="d-none d-md-block" style="width:1px;height:36px;background:var(--border);"></div>
                <div><div class="stat-val" style="font-size:1.8rem;font-weight:800;letter-spacing:-1px;color:hsl(217,91%,65%);">50K+</div><div style="font-size:0.72rem;color:var(--muted);margin-top:3px;">Exams Conducted</div></div>
                <div class="d-none d-md-block" style="width:1px;height:36px;background:var(--border);"></div>
                <div><div class="stat-val" style="font-size:1.8rem;font-weight:800;letter-spacing:-1px;color:hsl(142,72%,60%);">2M+</div><div style="font-size:0.72rem;color:var(--muted);margin-top:3px;">Questions Evaluated</div></div>
                <div class="d-none d-md-block" style="width:1px;height:36px;background:var(--border);"></div>
                <div><div class="stat-val" style="font-size:1.8rem;font-weight:800;letter-spacing:-1px;color:hsl(38,92%,60%);">99.9%</div><div style="font-size:0.72rem;color:var(--muted);margin-top:3px;">Uptime</div></div>
                <div class="d-none d-md-block" style="width:1px;height:36px;background:var(--border);"></div>
                <div><div class="stat-val" style="font-size:1.8rem;font-weight:800;letter-spacing:-1px;color:hsl(262,83%,70%);">< 2s</div><div style="font-size:0.72rem;color:var(--muted);margin-top:3px;">Auto Grading Speed</div></div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     MODULES BENTO GRID
══════════════════════════════════════════ -->
<section class="modules-section" id="modules">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="text-center mb-5">
            <span class="sec-eyebrow"><i class="fas fa-cubes"></i> All Modules</span>
            <h2 class="sec-title mx-auto" style="max-width:680px;">
                Everything you need to run<br>
                <span class="g-text">digital assessments.</span>
            </h2>
            <p class="sec-desc mx-auto text-center" style="max-width:560px;">
                Six deeply integrated modules that cover the complete examination lifecycle — from question creation to parent-accessible report cards.
            </p>
        </div>

        <div class="bento-dap">
            <!-- Online Examination - Large -->
            <div class="bd-7">
                <div class="bcard-dap" style="height:100%;">
                    <div class="bmod-icon bi-indigo"><i class="fas fa-laptop-code"></i></div>
                    <div class="bmod-title">Online Examination</div>
                    <div class="bmod-desc">
                        Create, schedule, and conduct exams entirely online. Support for MCQ, subjective, true/false, and fill-in-the-blank formats with built-in time limits and anti-cheat features.
                    </div>
                    <div class="bmod-tags">
                        <span class="bmod-tag"><i class="fas fa-check"></i> MCQ + Subjective</span>
                        <span class="bmod-tag"><i class="fas fa-check"></i> Time Limits</span>
                        <span class="bmod-tag"><i class="fas fa-check"></i> Auto Publish</span>
                        <span class="bmod-tag"><i class="fas fa-check"></i> Student Portal</span>
                        <span class="bmod-tag"><i class="fas fa-check"></i> Instant Results</span>
                    </div>
                </div>
            </div>

            <!-- Question Bank -->
            <div class="bd-5">
                <div class="bcard-dap accent-violet" style="height:100%;">
                    <div class="bmod-icon bi-violet"><i class="fas fa-database"></i></div>
                    <div class="bmod-title">Question Bank Management</div>
                    <div class="bmod-desc">
                        Centralized repository with subject-wise categorization and difficulty levels. Reuse, import, and organize thousands of questions effortlessly.
                    </div>
                    <div class="bmod-tags">
                        <span class="bmod-tag" style="color:hsl(262,83%,72%);border-color:hsla(262,83%,58%,0.15);">
                            <i class="fas fa-check" style="color:hsl(262,83%,72%);"></i> Subject Categories
                        </span>
                        <span class="bmod-tag" style="color:hsl(262,83%,72%);border-color:hsla(262,83%,58%,0.15);">
                            <i class="fas fa-check" style="color:hsl(262,83%,72%);"></i> Difficulty Levels
                        </span>
                        <span class="bmod-tag" style="color:hsl(262,83%,72%);border-color:hsla(262,83%,58%,0.15);">
                            <i class="fas fa-check" style="color:hsl(262,83%,72%);"></i> Bulk Import
                        </span>
                    </div>
                </div>
            </div>

            <!-- Automated Evaluation -->
            <div class="bd-4">
                <div class="bcard-dap" style="background:hsla(142,72%,50%,0.05);border-color:hsla(142,72%,50%,0.15);height:100%;">
                    <div class="bmod-icon bi-green"><i class="fas fa-robot"></i></div>
                    <div class="bmod-title">Automated Evaluation</div>
                    <div class="bmod-desc">
                        Instant MCQ grading with automatic score calculation. Reduce teacher workload by 80%.
                    </div>
                    <div style="margin-top:16px;background:#F8FAFC;border-radius:10px;padding:12px;">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                            <span style="font-size:0.68rem;color:var(--muted);">Grading progress</span>
                            <span style="font-size:0.68rem;font-weight:700;color:hsl(142,72%,60%);">100%</span>
                        </div>
                        <div style="height:6px;background:hsl(217,33%,20%);border-radius:9999px;overflow:hidden;">
                            <div style="height:100%;width:100%;background:linear-gradient(90deg,hsl(142,72%,50%),hsl(174,72%,56%));border-radius:9999px;"></div>
                        </div>
                        <div style="font-size:0.65rem;color:var(--muted);margin-top:6px;">124 answers graded in 1.8s</div>
                    </div>
                </div>
            </div>

            <!-- Performance Analytics -->
            <div class="bd-8">
                <div class="bcard-dap accent-indigo" style="height:100%;">
                    <div class="bmod-icon bi-indigo" style="background:hsla(38,92%,50%,0.15);color:hsl(38,92%,62%);"><i class="fas fa-chart-line"></i></div>
                    <div class="bmod-title">Performance Analytics</div>
                    <div class="bmod-desc">
                        Deep class-wise, subject-wise, and student-wise performance insights with interactive charts, ranking systems, and progress tracking across multiple exams.
                    </div>
                    <!-- Mini chart preview -->
                    <div style="display:flex;align-items:flex-end;gap:5px;height:56px;margin-top:16px;">
                        <div style="flex:1;height:40%;background:hsla(217,91%,60%,0.3);border-radius:4px 4px 0 0;"></div>
                        <div style="flex:1;height:60%;background:hsla(217,91%,60%,0.4);border-radius:4px 4px 0 0;"></div>
                        <div style="flex:1;height:50%;background:hsla(217,91%,60%,0.35);border-radius:4px 4px 0 0;"></div>
                        <div style="flex:1;height:75%;background:hsla(217,91%,60%,0.5);border-radius:4px 4px 0 0;"></div>
                        <div style="flex:1;height:65%;background:hsla(217,91%,60%,0.45);border-radius:4px 4px 0 0;"></div>
                        <div style="flex:1;height:88%;background:var(--gradient-secondary);border-radius:4px 4px 0 0;"></div>
                        <div style="flex:1;height:72%;background:hsla(217,91%,60%,0.5);border-radius:4px 4px 0 0;"></div>
                    </div>
                    <div class="bmod-tags mt-3">
                        <span class="bmod-tag" style="color:hsl(38,92%,62%);border-color:hsla(38,92%,50%,0.15);">
                            <i class="fas fa-chart-bar" style="color:hsl(38,92%,62%);"></i> Class Charts
                        </span>
                        <span class="bmod-tag" style="color:hsl(38,92%,62%);border-color:hsla(38,92%,50%,0.15);">
                            <i class="fas fa-trophy" style="color:hsl(38,92%,62%);"></i> Ranking
                        </span>
                        <span class="bmod-tag" style="color:hsl(38,92%,62%);border-color:hsla(38,92%,50%,0.15);">
                            <i class="fas fa-trending-up" style="color:hsl(38,92%,62%);"></i> Progress Tracking
                        </span>
                    </div>
                </div>
            </div>

            <!-- Report Cards -->
            <div class="bd-6">
                <div class="bcard-dap" style="background:hsla(217,91%,60%,0.04);border-color:hsla(217,91%,60%,0.12);height:100%;">
                    <div class="bmod-icon" style="background:hsla(217,91%,60%,0.15);color:hsl(217,91%,70%);"><i class="fas fa-file-invoice"></i></div>
                    <div class="bmod-title">Digital Report Cards</div>
                    <div class="bmod-desc">
                        Auto-generated digital report cards with PDF export, historical records, and secure parent-accessible portal.
                    </div>
                    <div style="margin-top:16px;border:1px solid hsla(217,91%,60%,0.2);border-radius:10px;overflow:hidden;">
                        <div style="background:linear-gradient(135deg,hsl(226,58%,14%),hsl(234,62%,18%));padding:10px 14px;font-size:0.68rem;font-weight:700;color:hsl(217,91%,75%);">
                            <i class="fas fa-certificate me-1"></i> Report Card Preview
                        </div>
                        <div style="padding:10px 14px;background:#F8FAFC;">
                            <div style="display:flex;justify-content:space-between;font-size:0.68rem;color:var(--muted);margin-bottom:5px;"><span>Mathematics</span><span style="color:hsl(142,72%,60%);font-weight:700;">A+</span></div>
                            <div style="display:flex;justify-content:space-between;font-size:0.68rem;color:var(--muted);margin-bottom:5px;"><span>Physics</span><span style="color:hsl(217,91%,70%);font-weight:700;">A</span></div>
                            <div style="display:flex;justify-content:space-between;font-size:0.68rem;color:var(--muted);"><span>Chemistry</span><span style="color:hsl(38,92%,62%);font-weight:700;">B+</span></div>
                        </div>
                    </div>
                    <div class="bmod-tags mt-3">
                        <span class="bmod-tag" style="color:hsl(217,91%,70%);border-color:hsla(217,91%,60%,0.15);">
                            <i class="fas fa-file-pdf" style="color:hsl(217,91%,70%);"></i> PDF Export
                        </span>
                        <span class="bmod-tag" style="color:hsl(217,91%,70%);border-color:hsla(217,91%,60%,0.15);">
                            <i class="fas fa-user-graduate" style="color:hsl(217,91%,70%);"></i> Parent Access
                        </span>
                    </div>
                </div>
            </div>

            <!-- Anti-Cheat -->
            <div class="bd-6">
                <div class="bcard-dap" style="background:hsla(0,72%,58%,0.04);border-color:hsla(0,72%,58%,0.12);height:100%;">
                    <div class="bmod-icon" style="background:hsla(0,72%,58%,0.15);color:hsl(0,72%,65%);"><i class="fas fa-shield-halved"></i></div>
                    <div class="bmod-title">Security & Anti-Cheat</div>
                    <div class="bmod-desc">
                        Enterprise-grade exam integrity. Tab-switch detection, full-screen mode enforcement, and randomized question orders to ensure fair assessments.
                    </div>
                    <div class="bmod-tags mt-3">
                        <span class="bmod-tag" style="color:hsl(0,72%,65%);border-color:hsla(0,72%,58%,0.15);">
                            <i class="fas fa-eye" style="color:hsl(0,72%,65%);"></i> Tab Detection
                        </span>
                        <span class="bmod-tag" style="color:hsl(0,72%,65%);border-color:hsla(0,72%,58%,0.15);">
                            <i class="fas fa-random" style="color:hsl(0,72%,65%);"></i> Randomized
                        </span>
                        <span class="bmod-tag" style="color:hsl(0,72%,65%);border-color:hsla(0,72%,58%,0.15);">
                            <i class="fas fa-lock" style="color:hsl(0,72%,65%);"></i> Fullscreen Lock
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     EXAM CREATION INTERFACE
══════════════════════════════════════════ -->
<section class="exam-creation-section" id="exam-creation">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <span class="sec-eyebrow"><i class="fas fa-edit"></i> Exam Builder</span>
                <h2 class="sec-title">
                    Create powerful exams<br>
                    <span class="g-text">in minutes.</span>
                </h2>
                <p class="sec-desc mb-4">
                    Intuitive exam builder with drag-and-drop question management. Set time limits, marks per question, negative marking, and schedule exams for any batch — all from one screen.
                </p>
                <ul style="list-style:none;padding:0;margin:0 0 32px;">
                    @foreach([
                        ['icon'=>'fa-file-alt','text'=>'MCQ, Subjective, True/False formats'],
                        ['icon'=>'fa-calendar-alt','text'=>'Schedule exams for specific dates & batches'],
                        ['icon'=>'fa-minus-circle','text'=>'Negative marking & partial scoring'],
                        ['icon'=>'fa-upload','text'=>'Bulk question import from Excel/CSV'],
                        ['icon'=>'fa-eye-slash','text'=>'Question randomization for each student'],
                    ] as $item)
                    <li style="display:flex;align-items:flex-start;gap:12px;margin-bottom:13px;font-size:0.88rem;color:var(--muted);">
                        <i class="fas {{ $item['icon'] }}" style="color:hsl(174,72%,56%);font-size:1rem;margin-top:1px;flex-shrink:0;"></i>
                        {{ $item['text'] }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('contact') }}" class="btn-primary-dap">
                    See It Live <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-7">
                <div class="exam-builder">
                    <div class="eb-header">
                        <div class="eb-title"><i class="fas fa-edit me-2" style="color:hsl(174,72%,56%);"></i>Exam Builder</div>
                        <div class="eb-tabs">
                            <div class="eb-tab active">Details</div>
                            <div class="eb-tab">Questions</div>
                            <div class="eb-tab">Settings</div>
                            <div class="eb-tab">Preview</div>
                        </div>
                    </div>
                    <div class="eb-body">
                        <div class="eb-row">
                            <div class="eb-field">
                                <label>Exam Title</label>
                                <input class="eb-input highlight" type="text" value="Mathematics Mid-Term Exam 2025" readonly>
                            </div>
                            <div class="eb-field">
                                <label>Duration</label>
                                <input class="eb-input" type="text" value="90 Minutes" readonly>
                            </div>
                        </div>
                        <div class="eb-row">
                            <div class="eb-field">
                                <label>Assigned Batch</label>
                                <input class="eb-input" type="text" value="Class 10 · Science" readonly>
                            </div>
                            <div class="eb-field">
                                <label>Schedule Date</label>
                                <input class="eb-input" type="text" value="15 Jun 2025 · 10:00 AM" readonly>
                            </div>
                        </div>

                        <!-- Question cards -->
                        <div style="font-size:0.68rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:10px;">Questions (3 of 30)</div>

                        <div class="q-card active-q">
                            <div class="q-num">Q1</div>
                            <div class="q-text">Which of the following is the correct formula for the quadratic equation?</div>
                            <div class="q-options">
                                <div class="q-opt correct"><div class="q-opt-radio"></div> x = (-b ± √(b²-4ac)) / 2a</div>
                                <div class="q-opt"><div class="q-opt-radio"></div> x = (b ± √(b²+4ac)) / 2a</div>
                                <div class="q-opt"><div class="q-opt-radio"></div> x = (-b ± √(b²-4ac)) / 4a</div>
                                <div class="q-opt"><div class="q-opt-radio"></div> x = (b² - 4ac) / 2a</div>
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:10px;">
                                <span style="font-size:0.65rem;color:var(--muted);">Marks: 2 · Difficulty: Medium · Topic: Algebra</span>
                                <div style="display:flex;gap:5px;">
                                    <div class="qb-q-action"><i class="fas fa-edit"></i></div>
                                    <div class="qb-q-action"><i class="fas fa-trash"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="q-card">
                            <div class="q-num">Q2</div>
                            <div class="q-text">Evaluate: ∫(2x + 3)dx</div>
                            <div style="font-size:0.7rem;color:var(--muted);margin-top:6px;">Subjective · 5 Marks · Difficulty: Hard</div>
                        </div>
                    </div>
                    <div class="eb-footer">
                        <span style="font-size:0.72rem;color:var(--muted);"><i class="fas fa-info-circle me-1"></i>30 questions · 60 total marks</span>
                        <div style="display:flex;gap:8px;">
                            <button style="background:#F1F5F9;border:1px solid #E2E8F0;color:var(--muted);padding:8px 16px;border-radius:8px;font-size:0.75rem;font-weight:600;cursor:pointer;">Preview</button>
                            <button class="eb-save"><i class="fas fa-save me-1"></i>Save & Schedule</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     STUDENT EXAM PORTAL
══════════════════════════════════════════ -->
<section class="student-portal-section" id="student-portal">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5 flex-lg-row-reverse">
            <div class="col-lg-5">
                <span class="sec-eyebrow indigo"><i class="fas fa-user-graduate"></i> Student Portal</span>
                <h2 class="sec-title">
                    A seamless exam experience<br>
                    <span class="g-text-2">for every student.</span>
                </h2>
                <p class="sec-desc mb-4">
                    Students access exams from any device through a clean, distraction-free portal. Navigate questions, review answers, and submit — all with a live countdown timer and progress tracker.
                </p>
                <ul style="list-style:none;padding:0;margin:0 0 32px;">
                    @foreach([
                        ['icon'=>'fa-mobile-alt','color'=>'hsl(217,91%,60%)','text'=>'Works on mobile, tablet, and desktop'],
                        ['icon'=>'fa-clock','color'=>'hsl(0,72%,65%)','text'=>'Live countdown timer with warning alerts'],
                        ['icon'=>'fa-list-ol','color'=>'hsl(174,72%,56%)','text'=>'Question navigator for easy navigation'],
                        ['icon'=>'fa-flag','color'=>'hsl(38,92%,60%)','text'=>'Flag questions to review before submission'],
                        ['icon'=>'fa-check-circle','color'=>'hsl(142,72%,56%)','text'=>'Instant result on exam submission'],
                    ] as $item)
                    <li style="display:flex;align-items:flex-start;gap:12px;margin-bottom:13px;font-size:0.88rem;color:var(--muted);">
                        <i class="fas {{ $item['icon'] }}" style="color:{{ $item['color'] }};font-size:1rem;margin-top:1px;flex-shrink:0;"></i>
                        {{ $item['text'] }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-7">
                <div class="student-exam-ui">
                    <div class="seu-header">
                        <div>
                            <div style="font-size:0.65rem;color:hsla(210,40%,98%,0.5);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:3px;">Mathematics Mid-Term · Class 10</div>
                            <div class="seu-exam-name">Final Examination 2025</div>
                        </div>
                        <div class="seu-timer">
                            <i class="fas fa-clock"></i>
                            01:24:38
                        </div>
                    </div>
                    <div class="seu-body">
                        <div class="seu-main">
                            <div class="seu-q-num">Question 12 of 30</div>
                            <div class="seu-q-text">
                                A train travels from Station A to Station B at 60 km/h and returns at 90 km/h. What is the average speed for the entire journey?
                            </div>
                            <div class="seu-opts">
                                <div class="seu-opt">
                                    <div class="seu-opt-radio"></div>
                                    <div class="seu-opt-text">70 km/h</div>
                                </div>
                                <div class="seu-opt">
                                    <div class="seu-opt-radio"></div>
                                    <div class="seu-opt-text">75 km/h</div>
                                </div>
                                <div class="seu-opt selected">
                                    <div class="seu-opt-radio"></div>
                                    <div class="seu-opt-text">72 km/h</div>
                                </div>
                                <div class="seu-opt">
                                    <div class="seu-opt-radio"></div>
                                    <div class="seu-opt-text">78 km/h</div>
                                </div>
                            </div>
                        </div>
                        <div class="seu-sidebar">
                            <div class="seu-progress-label">Progress</div>
                            <div class="seu-progress-bar">
                                <div class="seu-progress-fill"></div>
                            </div>
                            <div style="font-size:0.68rem;color:var(--muted);margin-bottom:12px;">12/30 answered</div>
                            <div class="seu-q-grid">
                                @for($i=1;$i<=20;$i++)
                                <div class="seu-q-dot {{ $i < 12 ? 'answered' : ($i === 12 ? 'current' : 'unanswered') }}">{{ $i }}</div>
                                @endfor
                            </div>
                            <button class="seu-submit">Submit Exam</button>
                        </div>
                    </div>
                    <div class="seu-footer">
                        <span style="font-size:0.72rem;color:var(--muted);">
                            <i class="fas fa-shield-alt me-1" style="color:hsl(142,72%,56%);"></i>Secure exam mode active
                        </span>
                        <div class="seu-nav-btns">
                            <button class="seu-btn-prev"><i class="fas fa-arrow-left me-1"></i>Prev</button>
                            <button class="seu-btn-next">Next <i class="fas fa-arrow-right ms-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     QUESTION BANK
══════════════════════════════════════════ -->
<section class="qbank-section" id="question-bank">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <span class="sec-eyebrow" style="color:hsl(262,83%,72%);background:hsla(262,83%,58%,0.1);border-color:hsla(262,83%,58%,0.2);">
                    <i class="fas fa-database"></i> Question Bank
                </span>
                <h2 class="sec-title">
                    Thousands of questions,<br>
                    <span class="g-text-2">perfectly organized.</span>
                </h2>
                <p class="sec-desc mb-4">
                    Build and maintain a centralized repository of questions across all subjects, topics, and difficulty levels. Reuse, remix, and import — never recreate.
                </p>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:32px;">
                    @foreach([
                        ['num'=>'5,200+','label'=>'Questions in Bank'],
                        ['num'=>'18','label'=>'Subjects Covered'],
                        ['num'=>'3','label'=>'Difficulty Levels'],
                        ['num'=>'100%','label'=>'Reusable'],
                    ] as $stat)
                    <div style="background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:16px;">
                        <div style="font-size:1.5rem;font-weight:800;line-height:1;margin-bottom:4px;" class="g-text-2">{{ $stat['num'] }}</div>
                        <div style="font-size:0.72rem;color:var(--muted);font-weight:500;">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('contact') }}" class="btn-outline-dap" style="border-color:hsla(262,83%,58%,0.4);color:hsl(262,83%,72%);">
                    <i class="fas fa-upload"></i> See Bulk Import
                </a>
            </div>
            <div class="col-lg-7">
                <div class="qbank-ui">
                    <div class="qb-header">
                        <div style="font-size:0.85rem;font-weight:700;color:var(--foreground);">
                            <i class="fas fa-database me-2" style="color:hsl(262,83%,72%);"></i>Question Repository
                        </div>
                        <div class="qb-filters">
                            <div class="qb-filter active">All</div>
                            <div class="qb-filter">MCQ</div>
                            <div class="qb-filter">Subjective</div>
                        </div>
                    </div>
                    <div class="qb-body">
                        <!-- Filters row -->
                        <div style="display:flex;gap:6px;margin-bottom:14px;flex-wrap:wrap;">
                            <div style="background:hsla(217,91%,60%,0.1);border:1px solid hsla(217,91%,60%,0.25);border-radius:7px;padding:4px 10px;font-size:0.68rem;font-weight:700;color:hsl(217,91%,70%);">Mathematics</div>
                            <div style="background:#F1F5F9;border:1px solid #E2E8F0;border-radius:7px;padding:4px 10px;font-size:0.68rem;font-weight:600;color:var(--muted);">Physics</div>
                            <div style="background:#F1F5F9;border:1px solid #E2E8F0;border-radius:7px;padding:4px 10px;font-size:0.68rem;font-weight:600;color:var(--muted);">Chemistry</div>
                            <div style="background:#F1F5F9;border:1px solid #E2E8F0;border-radius:7px;padding:4px 10px;font-size:0.68rem;font-weight:600;color:var(--muted);">All Subjects</div>
                        </div>

                        <div class="qb-question">
                            <div class="qb-q-meta">
                                <span class="qb-q-subject">Mathematics</span>
                                <span class="qb-q-type">MCQ</span>
                                <span class="qb-q-diff-hard">Hard</span>
                            </div>
                            <div class="qb-q-text">If α and β are roots of 2x² - 5x + 3 = 0, find the value of α³ + β³.</div>
                            <div class="qb-q-footer">
                                <span class="qb-q-marks"><i class="fas fa-star me-1" style="color:hsl(38,92%,60%);"></i>3 marks · Used in 4 exams</span>
                                <div class="qb-q-actions">
                                    <div class="qb-q-action"><i class="fas fa-plus"></i></div>
                                    <div class="qb-q-action"><i class="fas fa-edit"></i></div>
                                    <div class="qb-q-action"><i class="fas fa-copy"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="qb-question">
                            <div class="qb-q-meta">
                                <span class="qb-q-subject">Mathematics</span>
                                <span class="qb-q-type">MCQ</span>
                                <span class="qb-q-diff-med">Medium</span>
                            </div>
                            <div class="qb-q-text">What is the derivative of sin(3x²) with respect to x?</div>
                            <div class="qb-q-footer">
                                <span class="qb-q-marks"><i class="fas fa-star me-1" style="color:hsl(38,92%,60%);"></i>2 marks · Used in 7 exams</span>
                                <div class="qb-q-actions">
                                    <div class="qb-q-action"><i class="fas fa-plus"></i></div>
                                    <div class="qb-q-action"><i class="fas fa-edit"></i></div>
                                    <div class="qb-q-action"><i class="fas fa-copy"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="qb-question">
                            <div class="qb-q-meta">
                                <span class="qb-q-subject">Mathematics</span>
                                <span style="background:hsla(174,72%,56%,0.12);color:hsl(174,72%,65%);padding:2px 8px;border-radius:5px;font-size:0.62rem;font-weight:700;">Subjective</span>
                                <span class="qb-q-diff-easy">Easy</span>
                            </div>
                            <div class="qb-q-text">Explain the Fundamental Theorem of Calculus with a practical example.</div>
                            <div class="qb-q-footer">
                                <span class="qb-q-marks"><i class="fas fa-star me-1" style="color:hsl(38,92%,60%);"></i>5 marks · Used in 2 exams</span>
                                <div class="qb-q-actions">
                                    <div class="qb-q-action"><i class="fas fa-plus"></i></div>
                                    <div class="qb-q-action"><i class="fas fa-edit"></i></div>
                                    <div class="qb-q-action"><i class="fas fa-copy"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="qb-stats">
                            <div class="qb-stat">
                                <div class="qb-stat-val" style="color:hsl(217,91%,65%);">248</div>
                                <div class="qb-stat-lbl">Math Questions</div>
                            </div>
                            <div class="qb-stat">
                                <div class="qb-stat-val" style="color:hsl(262,83%,70%);">156</div>
                                <div class="qb-stat-lbl">Physics Qs</div>
                            </div>
                            <div class="qb-stat">
                                <div class="qb-stat-val" style="color:hsl(38,92%,60%);">189</div>
                                <div class="qb-stat-lbl">Chemistry Qs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     ANALYTICS DASHBOARD
══════════════════════════════════════════ -->
<section class="analytics-section" id="analytics">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="text-center mb-5">
            <span class="sec-eyebrow" style="color:hsl(38,92%,62%);background:hsla(38,92%,50%,0.1);border-color:hsla(38,92%,50%,0.2);">
                <i class="fas fa-chart-line"></i> Performance Analytics
            </span>
            <h2 class="sec-title mx-auto" style="max-width:680px;">
                Data that drives<br>
                <span class="g-text">better learning outcomes.</span>
            </h2>
            <p class="sec-desc mx-auto text-center" style="max-width:540px;">
                Visual analytics for class-wise performance, subject-wise trends, individual student progress, and instant ranking systems — all in one powerful dashboard.
            </p>
        </div>

        <div class="analytics-ui">
            <div class="au-header">
                <i class="fas fa-chart-bar" style="color:hsl(38,92%,60%);"></i>
                <div class="au-title">Performance Analytics Dashboard</div>
                <div class="au-filter">
                    <button class="au-filter-btn">Week</button>
                    <button class="au-filter-btn active">Month</button>
                    <button class="au-filter-btn">Term</button>
                    <button class="au-filter-btn">Year</button>
                </div>
            </div>
            <div class="au-body">
                <!-- KPIs -->
                <div class="au-kpis">
                    <div class="au-kpi">
                        <div class="au-kpi-val" style="color:hsl(174,72%,60%);">78.4%</div>
                        <div class="au-kpi-lbl">Class Avg Score</div>
                        <div class="au-kpi-change up"><i class="fas fa-arrow-up"></i> +3.2% vs last term</div>
                    </div>
                    <div class="au-kpi">
                        <div class="au-kpi-val" style="color:hsl(142,72%,60%);">82%</div>
                        <div class="au-kpi-lbl">Pass Rate</div>
                        <div class="au-kpi-change up"><i class="fas fa-arrow-up"></i> +5% improvement</div>
                    </div>
                    <div class="au-kpi">
                        <div class="au-kpi-val" style="color:hsl(217,91%,65%);">124</div>
                        <div class="au-kpi-lbl">Students Tracked</div>
                        <div class="au-kpi-change up"><i class="fas fa-arrow-up"></i> 12 new this month</div>
                    </div>
                    <div class="au-kpi">
                        <div class="au-kpi-val" style="color:hsl(0,72%,65%);">22</div>
                        <div class="au-kpi-lbl">Need Attention</div>
                        <div class="au-kpi-change down"><i class="fas fa-arrow-down"></i> -4 from last term</div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="au-charts">
                    <!-- Bar chart -->
                    <div class="au-chart-box">
                        <div class="au-chart-title">Subject-Wise Performance (%)</div>
                        <div class="bar-chart-wrap">
                            <div class="bar-chart">
                                <div class="bar-chart-bar" style="height:78%;background:linear-gradient(to top,hsl(174,72%,40%),hsl(174,72%,56%));" data-label="Math"></div>
                                <div class="bar-chart-bar" style="height:85%;background:linear-gradient(to top,hsl(217,91%,45%),hsl(217,91%,60%));" data-label="Physics"></div>
                                <div class="bar-chart-bar" style="height:71%;background:linear-gradient(to top,hsl(262,83%,45%),hsl(262,83%,58%));" data-label="Chem"></div>
                                <div class="bar-chart-bar" style="height:92%;background:linear-gradient(to top,hsl(142,72%,40%),hsl(142,72%,55%));" data-label="Bio"></div>
                                <div class="bar-chart-bar" style="height:68%;background:linear-gradient(to top,hsl(38,92%,40%),hsl(38,92%,55%));" data-label="Eng"></div>
                                <div class="bar-chart-bar" style="height:80%;background:linear-gradient(to top,hsl(347,77%,40%),hsl(347,77%,55%));" data-label="Hindi"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Right panel - ranking + donut -->
                    <div style="display:flex;flex-direction:column;gap:14px;">
                        <div class="au-chart-box">
                            <div class="au-chart-title">Pass / Fail Distribution</div>
                            <div class="donut-wrap">
                                <div class="donut"></div>
                                <div class="donut-legend">
                                    <div class="donut-leg-item"><div class="donut-leg-dot" style="background:hsl(174,72%,56%);"></div>Pass (76%)</div>
                                    <div class="donut-leg-item"><div class="donut-leg-dot" style="background:hsl(217,91%,60%);"></div>Merit (20%)</div>
                                    <div class="donut-leg-item"><div class="donut-leg-dot" style="background:hsl(262,83%,58%);"></div>Distinction (12%)</div>
                                    <div class="donut-leg-item"><div class="donut-leg-dot" style="background:hsl(217,33%,20%);"></div>Fail (8%)</div>
                                </div>
                            </div>
                        </div>

                        <div class="au-chart-box">
                            <div class="au-chart-title"><i class="fas fa-trophy me-1" style="color:hsl(38,92%,60%);"></i>Top Performers</div>
                            <div class="rank-table">
                                <div class="rank-row">
                                    <div class="rank-num rank-1">1</div>
                                    <div class="rank-name">Aarav Sharma</div>
                                    <div class="rank-score">96.2%</div>
                                </div>
                                <div class="rank-row">
                                    <div class="rank-num rank-2">2</div>
                                    <div class="rank-name">Sneha Patel</div>
                                    <div class="rank-score">94.8%</div>
                                </div>
                                <div class="rank-row">
                                    <div class="rank-num rank-3">3</div>
                                    <div class="rank-name">Rahul Nair</div>
                                    <div class="rank-score">91.5%</div>
                                </div>
                                <div class="rank-row">
                                    <div class="rank-num rank-other">4</div>
                                    <div class="rank-name">SanjayMehta</div>
                                    <div class="rank-score">89.3%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subject progress bars -->
                <div class="au-chart-box mt-3">
                    <div class="au-chart-title">Student Progress Tracking — Aarav Sharma</div>
                    <div class="subject-bars">
                        <div class="sub-bar-row">
                            <div class="sub-bar-label">Mathematics</div>
                            <div class="sub-bar-track"><div class="sub-bar-fill" style="width:96%;background:linear-gradient(90deg,hsl(174,72%,50%),hsl(174,72%,60%));"></div></div>
                            <div class="sub-bar-val" style="color:hsl(174,72%,60%);">96%</div>
                        </div>
                        <div class="sub-bar-row">
                            <div class="sub-bar-label">Physics</div>
                            <div class="sub-bar-track"><div class="sub-bar-fill" style="width:88%;background:linear-gradient(90deg,hsl(217,91%,50%),hsl(217,91%,65%));"></div></div>
                            <div class="sub-bar-val" style="color:hsl(217,91%,65%);">88%</div>
                        </div>
                        <div class="sub-bar-row">
                            <div class="sub-bar-label">Chemistry</div>
                            <div class="sub-bar-track"><div class="sub-bar-fill" style="width:74%;background:linear-gradient(90deg,hsl(262,83%,48%),hsl(262,83%,62%));"></div></div>
                            <div class="sub-bar-val" style="color:hsl(262,83%,65%);">74%</div>
                        </div>
                        <div class="sub-bar-row">
                            <div class="sub-bar-label">Biology</div>
                            <div class="sub-bar-track"><div class="sub-bar-fill" style="width:92%;background:linear-gradient(90deg,hsl(142,72%,42%),hsl(142,72%,58%));"></div></div>
                            <div class="sub-bar-val" style="color:hsl(142,72%,58%);">92%</div>
                        </div>
                        <div class="sub-bar-row">
                            <div class="sub-bar-label">English</div>
                            <div class="sub-bar-track"><div class="sub-bar-fill" style="width:81%;background:linear-gradient(90deg,hsl(38,92%,42%),hsl(38,92%,58%));"></div></div>
                            <div class="sub-bar-val" style="color:hsl(38,92%,58%);">81%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     REPORT CARDS
══════════════════════════════════════════ -->
<section class="report-section" id="report-cards">
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5 flex-lg-row-reverse">
            <div class="col-lg-5">
                <span class="sec-eyebrow indigo"><i class="fas fa-file-invoice"></i> Report Cards</span>
                <h2 class="sec-title">
                    Beautiful digital<br>
                    <span class="g-text">report cards — instantly.</span>
                </h2>
                <p class="sec-desc mb-4">
                    Auto-generate professional report cards the moment results are published. Download as PDF, share with parents, and maintain a complete historical record — all secured and cloud-backed.
                </p>
                <ul style="list-style:none;padding:0;margin:0 0 32px;">
                    @foreach([
                        ['icon'=>'fa-bolt','color'=>'hsl(38,92%,60%)','text'=>'Auto-generated instantly after exam evaluation'],
                        ['icon'=>'fa-file-pdf','color'=>'hsl(0,72%,65%)','text'=>'Professional PDF format, print-ready'],
                        ['icon'=>'fa-history','color'=>'hsl(217,91%,65%)','text'=>'Full historical records across all terms'],
                        ['icon'=>'fa-user-friends','color'=>'hsl(142,72%,56%)','text'=>'Parents access via secure portal or WhatsApp'],
                        ['icon'=>'fa-award','color'=>'hsl(174,72%,56%)','text'=>'Grade letters, percentages, ranks, and remarks'],
                    ] as $item)
                    <li style="display:flex;align-items:flex-start;gap:12px;margin-bottom:13px;font-size:0.88rem;color:var(--muted);">
                        <i class="fas {{ $item['icon'] }}" style="color:{{ $item['color'] }};font-size:1rem;margin-top:1px;flex-shrink:0;"></i>
                        {{ $item['text'] }}
                    </li>
                    @endforeach
                </ul>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <a href="{{ route('contact') }}" class="btn-primary-dap">Request Demo <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="report-card-ui">
                    <div class="rc-header">
                        <div class="rc-school">EduNex ERP · Assessment Platform</div>
                        <div class="rc-title">Academic Report Card · 2024–25</div>
                        <div class="rc-student-row">
                            <div class="rc-avatar">AS</div>
                            <div>
                                <div class="rc-student-name">Aarav Sharma</div>
                                <div class="rc-student-meta">Roll No. 12 · Class 10-A · Term II</div>
                            </div>
                            <div class="rc-grade-badge">A+ Grade</div>
                        </div>
                    </div>
                    <div class="rc-body">
                        <div class="rc-section-title">Subject-Wise Performance</div>
                        <div class="rc-subject-table">
                            <div class="rc-sub-row" style="font-size:0.62rem;font-weight:700;text-transform:uppercase;color:var(--muted);letter-spacing:0.7px;border-bottom:1px solid hsl(217,33%,20%);">
                                <span>Subject</span><span style="text-align:center;">Marks</span><span style="text-align:center;">Grade</span><span style="text-align:right;">%</span>
                            </div>
                            @foreach([
                                ['sub'=>'Mathematics','marks'=>'96/100','grade'=>'A+','pct'=>'96%','cls'=>'rc-grade-a','pcol'=>'hsl(174,72%,60%)'],
                                ['sub'=>'Physics','marks'=>'88/100','grade'=>'A','pct'=>'88%','cls'=>'rc-grade-a','pcol'=>'hsl(217,91%,65%)'],
                                ['sub'=>'Chemistry','marks'=>'74/100','grade'=>'B+','pct'=>'74%','cls'=>'rc-grade-b','pcol'=>'hsl(38,92%,60%)'],
                                ['sub'=>'Biology','marks'=>'92/100','grade'=>'A+','pct'=>'92%','cls'=>'rc-grade-a','pcol'=>'hsl(142,72%,60%)'],
                                ['sub'=>'English','marks'=>'81/100','grade'=>'A','pct'=>'81%','cls'=>'rc-grade-a','pcol'=>'hsl(174,72%,60%)'],
                            ] as $sub)
                            <div class="rc-sub-row">
                                <span class="rc-sub-name">{{ $sub['sub'] }}</span>
                                <span class="rc-sub-marks" style="color:{{ $sub['pcol'] }};text-align:center;">{{ $sub['marks'] }}</span>
                                <span class="rc-sub-grade {{ $sub['cls'] }}">{{ $sub['grade'] }}</span>
                                <span class="rc-sub-pct" style="color:{{ $sub['pcol'] }};">{{ $sub['pct'] }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="rc-summary">
                            <div class="rc-sum-item">
                                <div class="rc-sum-val" style="color:hsl(174,72%,60%);">431/500</div>
                                <div class="rc-sum-lbl">Total Marks</div>
                            </div>
                            <div class="rc-sum-item">
                                <div class="rc-sum-val" style="color:hsl(217,91%,65%);">86.2%</div>
                                <div class="rc-sum-lbl">Percentage</div>
                            </div>
                            <div class="rc-sum-item">
                                <div class="rc-sum-val" style="color:hsl(38,92%,60%);">Rank 1</div>
                                <div class="rc-sum-lbl">Class Rank</div>
                            </div>
                        </div>

                        <div style="background:hsla(142,72%,50%,0.08);border:1px solid hsla(142,72%,50%,0.2);border-radius:10px;padding:12px;margin-bottom:4px;">
                            <div style="font-size:0.68rem;font-weight:700;color:hsl(142,72%,60%);margin-bottom:4px;"><i class="fas fa-comment-alt me-1"></i>Teacher's Remark</div>
                            <div style="font-size:0.75rem;color:var(--muted);line-height:1.6;">Aarav has shown exceptional performance across all subjects. His consistency and dedication are commendable. Keep it up!</div>
                        </div>
                    </div>
                    <div class="rc-footer">
                        <button class="rc-dl-btn"><i class="fas fa-download"></i> Download PDF</button>
                        <button class="rc-share-btn"><i class="fab fa-whatsapp" style="color:hsl(142,60%,55%);"></i> Share via WhatsApp</button>
                        <button class="rc-share-btn" style="margin-left:auto;"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     HOW IT WORKS
══════════════════════════════════════════ -->
<section class="how-dap-section" id="how-it-works">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow"><i class="fas fa-route"></i> How It Works</span>
            <h2 class="sec-title mx-auto" style="max-width:600px;">
                From question creation<br>
                <span class="g-text">to published results in 5 steps.</span>
            </h2>
        </div>
        <div class="row g-3">
            @php
            $steps = [
                ['num'=>'01','title'=>'Build Question Bank','desc'=>'Add questions to your centralized repository — categorized by subject, topic, and difficulty. Import in bulk from Excel or add one by one.','icon'=>'fa-database'],
                ['num'=>'02','title'=>'Create & Schedule Exam','desc'=>'Use the exam builder to set title, duration, marks, assign a batch, and schedule the exact date and time. Preview before publishing.','icon'=>'fa-calendar-check'],
                ['num'=>'03','title'=>'Students Attempt Online','desc'=>'Students log into their portal, see scheduled exams, and take the test on any device with a live timer and secure environment.','icon'=>'fa-laptop-code'],
                ['num'=>'04','title'=>'Auto Evaluation & Scoring','desc'=>'The moment the exam ends, MCQs are graded instantly and scores are calculated automatically. No teacher effort needed.','icon'=>'fa-robot'],
                ['num'=>'05','title'=>'Analytics & Report Cards','desc'=>'View rich analytics dashboards and generate professional report cards with one click. Share results with parents via the portal.','icon'=>'fa-chart-bar'],
            ];
            @endphp
            @foreach($steps as $step)
            <div class="col-md-6 col-lg-4 {{ $loop->last ? 'col-lg-12' : '' }}">
                @if($loop->last)
                <div class="step-card-dap" style="background:linear-gradient(135deg,hsla(174,72%,56%,0.06),hsla(217,91%,60%,0.06));border-color:hsla(174,72%,56%,0.2);">
                    <div style="display:flex;align-items:center;gap:20px;">
                        <div class="step-num-dap"><span>{{ $step['num'] }}</span></div>
                        <div>
                            <div class="step-title-dap">{{ $step['title'] }}</div>
                            <div class="step-desc-dap">{{ $step['desc'] }}</div>
                        </div>
                    </div>
                </div>
                @else
                <div class="step-card-dap" style="position:relative;overflow:hidden;">
                    <div class="step-num-dap">{{ $step['num'] }}</div>
                    <div class="step-big-num">{{ $step['num'] }}</div>
                    <div style="width:44px;height:44px;border-radius:12px;background:hsla(174,72%,56%,0.1);display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:hsl(174,72%,60%);margin-bottom:16px;">
                        <i class="fas {{ $step['icon'] }}"></i>
                    </div>
                    <div class="step-title-dap">{{ $step['title'] }}</div>
                    <div class="step-desc-dap">{{ $step['desc'] }}</div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     BEFORE / AFTER
══════════════════════════════════════════ -->
<section class="vs-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow"><i class="fas fa-exchange-alt"></i> The Transformation</span>
            <h2 class="sec-title mx-auto" style="max-width:680px;">
                Why schools choose<br>
                <span class="g-text">EduNex ERP over paper exams.</span>
            </h2>
        </div>
        <div class="vs-grid">
            <div class="vs-before">
                <div class="vs-label before"><i class="fas fa-times"></i> Traditional Exams</div>
                <div class="vs-item">
                    <div class="vs-icon-x"><i class="fas fa-times"></i></div>
                    <div class="vs-text"><strong>Manual paper checking</strong> takes weeks per exam cycle, delaying results</div>
                </div>
                <div class="vs-item">
                    <div class="vs-icon-x"><i class="fas fa-times"></i></div>
                    <div class="vs-text"><strong>No performance analytics</strong> — impossible to identify weak students early</div>
                </div>
                <div class="vs-item">
                    <div class="vs-icon-x"><i class="fas fa-times"></i></div>
                    <div class="vs-text"><strong>Question papers recreated</strong> from scratch every exam — wasting teacher time</div>
                </div>
                <div class="vs-item">
                    <div class="vs-icon-x"><i class="fas fa-times"></i></div>
                    <div class="vs-text"><strong>Report cards done manually</strong> — prone to errors, takes days to issue</div>
                </div>
                <div class="vs-item">
                    <div class="vs-icon-x"><i class="fas fa-times"></i></div>
                    <div class="vs-text"><strong>Parents wait weeks</strong> for results through physical report card distribution</div>
                </div>
            </div>
            <div class="vs-after">
                <div class="vs-label after"><i class="fas fa-check"></i> With EduNex ERP</div>
                <div class="vs-item">
                    <div class="vs-icon-c"><i class="fas fa-check"></i></div>
                    <div class="vs-text"><strong>Instant auto-grading</strong> — MCQ results available within 2 seconds of submission</div>
                </div>
                <div class="vs-item">
                    <div class="vs-icon-c"><i class="fas fa-check"></i></div>
                    <div class="vs-text"><strong>Rich analytics dashboard</strong> identifies at-risk students before they fall behind</div>
                </div>
                <div class="vs-item">
                    <div class="vs-icon-c"><i class="fas fa-check"></i></div>
                    <div class="vs-text"><strong>Centralized question bank</strong> — reuse and remix thousands of questions in minutes</div>
                </div>
                <div class="vs-item">
                    <div class="vs-icon-c"><i class="fas fa-check"></i></div>
                    <div class="vs-text"><strong>Auto-generated report cards</strong> ready instantly, no manual entry, zero errors</div>
                </div>
                <div class="vs-item">
                    <div class="vs-icon-c"><i class="fas fa-check"></i></div>
                    <div class="vs-text"><strong>Parents get results instantly</strong> via the portal or WhatsApp the moment they're published</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════
     CTA
══════════════════════════════════════════ -->
<section class="dap-cta-section">
    <div class="container px-4">
        <div class="dap-cta-box">
            <div class="dap-cta-content">
                <div class="dap-cta-eyebrow"><i class="fas fa-rocket"></i> Get Started Today</div>
                <h2 class="dap-cta-h2">
                    Transform Examinations Into<br>
                    <span class="g-text">Data-Driven Assessments.</span>
                </h2>
                <p class="dap-cta-p">
                    Create exams, evaluate automatically, analyze performance, and publish results from a single platform. The complete digital assessment ecosystem for modern educational institutions.
                </p>
                <div class="d-flex gap-3 flex-wrap justify-content-center">
                    <a href="{{ route('contact') }}" class="btn-primary-dap" style="font-size:1rem;padding:16px 36px;">
                        Request Demo <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('pricing') }}" class="btn-outline-dap" style="font-size:1rem;padding:16px 36px;border-color:hsla(217,91%,60%,0.4);color:hsl(217,91%,75%);">
                        <i class="fas fa-rocket"></i> Get Started
                    </a>
                </div>
                <div class="dap-cta-trust">
                    <span class="dap-cta-trust-item"><i class="fas fa-check"></i> 7-day free trial</span>
                    <span class="dap-cta-trust-item"><i class="fas fa-check"></i> No credit card required</span>
                    <span class="dap-cta-trust-item"><i class="fas fa-check"></i> Setup in 15 minutes</span>
                    <span class="dap-cta-trust-item"><i class="fas fa-check"></i> 24/7 support</span>
                    <span class="dap-cta-trust-item"><i class="fas fa-check"></i> Cancel anytime</span>
                </div>
            </div>
        </div>
    </div>
</section>

<x-frontend-footer/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Tab switch animation for exam builder
document.querySelectorAll('.eb-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.eb-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});

// Filter button toggles
document.querySelectorAll('.au-filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.au-filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
document.querySelectorAll('.qb-filter').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.qb-filter').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});

// Animate progress bars on scroll
const subFills = document.querySelectorAll('.sub-bar-fill');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if(entry.isIntersecting) {
            const fill = entry.target;
            const width = fill.style.width;
            fill.style.width = '0%';
            setTimeout(() => { fill.style.transition = 'width 1.2s cubic-bezier(0.4,0,0.2,1)'; fill.style.width = width; }, 100);
            observer.unobserve(fill);
        }
    });
}, { threshold: 0.3 });
subFills.forEach(fill => observer.observe(fill));

// Animate KPI values on scroll
const kpis = document.querySelectorAll('.au-kpi-val,.mock-stat-val');
const kpiObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if(entry.isIntersecting) {
            entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
            kpiObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });
kpis.forEach(kpi => kpiObserver.observe(kpi));

// Card hover tilt effect for step cards
document.querySelectorAll('.step-card-dap').forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const cx = rect.width / 2;
        const cy = rect.height / 2;
        const rotX = ((y - cy) / cy) * -4;
        const rotY = ((x - cx) / cx) * 4;
        card.style.transform = `translateY(-4px) perspective(600px) rotateX(${rotX}deg) rotateY(${rotY}deg)`;
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = '';
    });
});

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}
</script>

@include('components.whatsapp-widget')
</body>
</html>
