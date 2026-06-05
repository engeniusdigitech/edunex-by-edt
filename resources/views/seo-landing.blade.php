<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo 
        title="Best Institute and School Management Software in {{ $city }}, {{ $country }} | {{ $city }} Education System" 
        description="EduNex is the top-rated Institute and School Management system and Institute and School Management software in {{ $city }}. Automate fees, attendance, and student portals for your {{ $city }} educational center." 
    />
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')

<style>
/* â”€â”€ Reset & Base â”€â”€ */
*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
    font-family: 'Inter', system-ui, sans-serif;
    background: hsl(222, 47%, 6%);
    color: hsl(210, 40%, 98%);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    line-height: 1.6;
}

/* â”€â”€ Design Tokens (matching engeniusdigitech) â”€â”€ */
:root {
    --bg:        hsl(222, 47%, 6%);
    --card-bg:   hsl(222, 47%, 8%);
    --border:    hsl(217, 33%, 17%);
    --muted:     hsl(215, 20%, 65%);
    --primary:   hsl(174, 72%, 56%);   /* teal */
    --secondary: hsl(217, 91%, 60%);   /* blue */
    --accent:    hsl(262, 83%, 58%);   /* violet */
    --foreground: hsl(210, 40%, 98%);
    --radius: 0.75rem;
    --glow-primary: 0 0 40px hsla(174, 72%, 56%, 0.3);
    --glow-secondary: 0 0 40px hsla(217, 91%, 60%, 0.3);
    --gradient-primary: linear-gradient(135deg, hsl(174,72%,56%), hsl(217,91%,60%));
    --gradient-secondary: linear-gradient(135deg, hsl(217,91%,60%), hsl(262,83%,58%));
    --shadow-card: 0 8px 32px hsla(0,0%,0%, 0.3);
    --shadow-elevated: 0 20px 60px hsla(0,0%,0%, 0.4);
}

/* â”€â”€ Gradient Text â”€â”€ */
.g-text {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.g-text-2 {
    background: var(--gradient-secondary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* â”€â”€ Shared â”€â”€ */
.badge-pill {
    display: inline-flex; align-items: center; gap: 6px;
    background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.25);
    color: hsl(174,72%,70%); border-radius: 9999px;
    font-size: 0.72rem; font-weight: 600; padding: 4px 14px;
    text-transform: uppercase; letter-spacing: 1px;
}
.badge-pill.blue {
    background: hsla(217,91%,60%,0.1); border-color: hsla(217,91%,60%,0.25);
    color: hsl(217,91%,75%);
}

.sec-eyebrow {
    display: block; font-size: 0.72rem; font-weight: 500;
    text-transform: uppercase; letter-spacing: 1.5px;
    color: hsl(174,72%,56%); margin-bottom: 14px;
}
.sec-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 500; letter-spacing: -1.5px;
    line-height: 1.1; margin-bottom: 18px;
}
.sec-desc {
    font-size: 1rem; color: var(--muted);
    line-height: 1.85; max-width: 540px;
}

/* â”€â”€ Buttons â”€â”€ */
.btn-primary {
    background: var(--gradient-primary);
    color: hsl(222,47%,6%); border: none;
    padding: 13px 28px; border-radius: 10px;
    font-weight: 500; font-size: 0.9rem;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; transition: all 0.25s ease;
    box-shadow: var(--glow-primary);
}
.btn-primary:hover { color: hsl(222,47%,6%); opacity: 0.92; transform: translateY(-2px); }

.btn-outline {
    background: transparent;
    color: var(--foreground); border: 1px solid var(--border);
    padding: 13px 28px; border-radius: 10px;
    font-weight: 600; font-size: 0.9rem;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; transition: all 0.25s ease;
}
.btn-outline:hover { color: var(--foreground); border-color: var(--primary); background: hsla(174,72%,56%,0.08); }

/* â”€â”€ Card base â”€â”€ */
.card-glass {
    background: hsl(222,47%,8%);
    border: 1px solid var(--border);
    border-radius: 12px;
    box-shadow: var(--shadow-card);
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.card-glass:hover {
    border-color: hsla(174,72%,56%,0.4);
    box-shadow: var(--glow-primary);
    transform: translateY(-4px) scale(1.01);
}

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   HERO
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.hero {
    min-height: 100vh;
    background: var(--bg);
    position: relative;
    overflow: hidden;
    display: flex; flex-direction: column;
}

/* Background glow blobs */
.hero-blob {
    position: absolute; border-radius: 50%;
    filter: blur(80px); pointer-events: none; opacity: 0.6;
}
.blob-1 {
    width: 600px; height: 600px;
    background: hsla(174,72%,56%,0.12);
    top: -200px; left: -100px;
}
.blob-2 {
    width: 500px; height: 500px;
    background: hsla(217,91%,60%,0.1);
    top: 100px; right: -150px;
}
.blob-3 {
    width: 300px; height: 300px;
    background: hsla(262,83%,58%,0.08);
    bottom: 0; left: 40%;
}

.hero-content {
    flex: 1; display: flex; align-items: center;
    padding: 140px 0 80px;
    position: relative; z-index: 2;
}

.hero-kicker {
    display: inline-flex; align-items: center; gap: 8px;
    background: hsla(174,72%,56%,0.1);
    border: 1px solid hsla(174,72%,56%,0.2);
    border-radius: 9999px; padding: 6px 16px;
    font-size: 0.73rem; font-weight: 600; color: hsl(174,72%,70%);
    margin-bottom: 24px;
}
.kicker-dot {
    width: 7px; height: 7px; background: hsl(174,72%,56%);
    border-radius: 50%;
    animation: pulse-dot 2s cubic-bezier(0.4,0,0.6,1) infinite;
}
@keyframes pulse-dot {
    0%,100% { opacity: 1; }
    50% { opacity: 0.4; }
}

.hero-h1 {
    font-size: clamp(2.8rem, 6vw, 4.8rem);
    font-weight: 500; letter-spacing: -3px;
    line-height: 1.05; margin-bottom: 22px;
    color: hsl(210,40%,98%);
}
.hero-sub {
    font-size: 1.05rem; color: var(--muted);
    line-height: 1.9; margin-bottom: 36px; max-width: 500px;
}
.hero-features {
    display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 36px;
}
.hfeat {
    display: inline-flex; align-items: center; gap: 6px;
    background: hsla(210,40%,98%,0.04);
    border: 1px solid hsla(210,40%,98%,0.09);
    border-radius: 8px; padding: 6px 12px;
    font-size: 0.75rem; font-weight: 500; color: var(--muted);
}
.hfeat i { color: hsl(174,72%,56%); font-size: 0.7rem; }

/* Hero dashboard mockup */
.hero-img-wrap {
    position: relative;
}
.hero-screen {
    width: 100%; border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-elevated), 0 0 0 1px hsla(210,40%,98%,0.03);
}
/* Floating notification cards */
.notif-card {
    position: absolute;
    background: hsla(222,47%,8%,0.95);
    border: 1px solid hsla(210,40%,98%,0.12);
    border-radius: 12px; padding: 12px 16px;
    display: flex; align-items: center; gap: 10px;
    animation: notif-float 4s ease-in-out infinite;
    min-width: 200px;
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
.portal-display { position: relative; z-index: 10; margin-top: 2rem; }
.portal-tabs { display: flex; gap: 12px; justify-content: center; margin-bottom: 24px; }
.portal-tab-btn {
    background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09);
    color: var(--muted); padding: 8px 24px; border-radius: 30px; font-size: 0.85rem; font-weight: 500; cursor: pointer; transition: all 0.3s ease;
}
.portal-tab-btn:hover { background: hsla(210,40%,98%,0.08); color: hsl(210,40%,98%); }
.portal-tab-btn.active {
    background: hsla(174,72%,56%,0.15); color: hsl(174,72%,60%); border-color: hsla(174,72%,56%,0.3); box-shadow: var(--glow-primary);
}
.portal-content { display: none; animation: fadeIn 0.5s ease; }
.portal-content.active { display: block; }
.display-wrapper { position: relative; padding-bottom: 12%; }
.desktop-mockup {
    width: 100%; border-radius: 12px; border: 1px solid var(--border);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 0 1px hsla(210,40%,98%,0.05);
}
.mobile-mockup {
    position: absolute; bottom: -8%; right: calc(-5% + 30px); width: 28%; border-radius: 16px; border: 4px solid #1a1a1a;
    box-shadow: 0 15px 30px rgba(0,0,0,0.6); background: #000; overflow: hidden;
}
.mobile-mockup img { width: 100%; display: block; border-radius: 12px; }
.portal-text { text-align: center; margin-top: 1.5rem; }
.portal-text h3 { font-size: 1.35rem; color: var(--foreground); font-weight: 500; margin-bottom: 0.5rem; letter-spacing: -0.5px; }
.portal-text p { font-size: 0.95rem; color: var(--muted); line-height: 1.7; max-width: 400px; margin: 0 auto; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

/* Stats strip */
.stats-strip {
    border-top: 1px solid var(--border);
    background: hsla(222,47%,8%,0.6);
    padding: 36px 0;
    position: relative; z-index: 2;
}
.stat-val  { font-size: 2rem; font-weight: 500; letter-spacing: -1.5px; line-height: 1; }
.stat-lbl  { font-size: 0.73rem; color: var(--muted); font-weight: 500; margin-top: 3px; }
.stat-pipe { width: 1px; height: 40px; background: var(--border); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   FEATURES (dark)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.feat-section {
    background: hsl(222,47%,5%);
    padding: 100px 0;
    border-top: 1px solid var(--card-border);
}
.feat-section .sec-eyebrow { color: hsl(174,72%,60%); }
.feat-section .sec-title   { color: hsl(210,40%,98%); }
.feat-section .sec-desc    { color: var(--muted); }

/* Feature magazine grid */
.feat-magazine { display: grid; grid-template-columns: 1fr 1fr 1fr; grid-template-rows: auto auto; gap: 14px; }
.feat-hero { grid-column: span 2; grid-row: span 2; }
@media(max-width:991px) { .feat-magazine { grid-template-columns: 1fr 1fr; } .feat-hero { grid-column: span 2; grid-row: span 1; } }
@media(max-width:640px)  { .feat-magazine { grid-template-columns: 1fr; } .feat-hero { grid-column: span 1; } }

.feat-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 16px; padding: 26px;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    position: relative; overflow: hidden; height: 100%;
}
.feat-card.is-hero { padding: 36px; }
.feat-card::after {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: var(--gradient-primary); opacity: 0; transition: opacity 0.3s;
}
.feat-card:hover { border-color: hsla(174,72%,56%,0.45); box-shadow: 0 0 32px hsla(174,72%,56%,0.12); transform: translateY(-3px); }
.feat-card:hover::after { opacity: 1; }
.feat-icon-wrap { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 20px; }
.feat-hero .feat-icon-wrap { width: 60px; height: 60px; font-size: 1.5rem; margin-bottom: 24px; }
.feat-name { font-size: 0.92rem; font-weight: 500; color: hsl(210,40%,98%); margin-bottom: 7px; letter-spacing: -0.3px; }
.feat-hero .feat-name { font-size: 1.35rem; letter-spacing: -0.8px; margin-bottom: 12px; }
.feat-desc { font-size: 0.82rem; color: var(--muted); line-height: 1.75; }
.feat-hero .feat-desc { font-size: 0.95rem; line-height: 1.85; max-width: 420px; }
.feat-hero-chips { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 24px; }
.feat-chip { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.05); border: 1px solid var(--card-border); border-radius: 8px; padding: 5px 12px; font-size: 0.72rem; font-weight: 600; color: var(--muted); }
.feat-chip i { color: var(--primary); font-size: 0.65rem; }
/* How it works - big number style */
.how-step { position: relative; padding: 40px 32px; }
.how-step-num {
    font-size: 7rem; font-weight: 500; line-height: 1;
    color: rgba(255,255,255,0.04); letter-spacing: -4px;
    position: absolute; top: 10px; right: 20px; pointer-events: none;
    font-variant-numeric: tabular-nums;
}
.how-step-inner { position: relative; z-index: 2; }
.how-step-badge {
    display: inline-flex; align-items: center; justify-content: center;
    width: 36px; height: 36px; border-radius: 10px;
    background: var(--gradient-primary); color: hsl(222,47%,6%);
    font-weight: 500; font-size: 0.85rem; margin-bottom: 18px;
}
.how-step-arrow {
    position: absolute; right: -8px; top: 50%; transform: translateY(-50%);
    font-size: 1.1rem; color: hsla(174,72%,56%,0.3);
    z-index: 3;
}
@media(max-width:767px) { .how-step-arrow { display: none; } .how-step-num { font-size: 5rem; } }
.how-step-t { font-size: 1rem; font-weight: 500; color: hsl(210,40%,98%); margin-bottom: 8px; }
.how-step-d { font-size: 0.82rem; color: var(--muted); line-height: 1.75; }
/* Why EduNex - before/after */
.why-split { display: grid; grid-template-columns: 1fr 1fr; gap: 0; border: 1px solid var(--card-border); border-radius: 20px; overflow: hidden; }
@media(max-width:767px) { .why-split { grid-template-columns: 1fr; } }
.why-before { background: hsla(0,50%,15%,0.25); border-right: 1px solid var(--card-border); padding: 36px; }
.why-after  { background: hsla(174,50%,10%,0.4); padding: 36px; }
.why-label {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; font-weight: 500; text-transform: uppercase; letter-spacing: 1.5px;
    border-radius: 7px; padding: 5px 12px; margin-bottom: 24px;
}
.why-label.before { background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(239,68,68,0.2); }
.why-label.after  { background: hsla(174,72%,56%,0.12); color: hsl(174,72%,65%); border: 1px solid hsla(174,72%,56%,0.2); }
.why-row { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 16px; }
.why-row:last-child { margin-bottom: 0; }
.why-icon-x { width: 28px; height: 28px; border-radius: 7px; background: rgba(239,68,68,0.12); color: #f87171; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0; margin-top: 2px; }
.why-icon-c { width: 28px; height: 28px; border-radius: 7px; background: hsla(174,72%,56%,0.12); color: hsl(174,72%,60%); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0; margin-top: 2px; }
.why-text { font-size: 0.88rem; color: var(--muted); line-height: 1.6; }
.why-text strong { color: hsl(210,40%,98%); font-weight: 600; }
.why-divider { display: flex; align-items: center; justify-content: center; background: var(--card-border); width: 1px; position: relative; }
.why-vs {
    position: absolute; width: 44px; height: 44px; border-radius: 50%;
    background: var(--card-bg); border: 1px solid var(--card-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem; font-weight: 500; color: var(--muted);
}

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   STAFF SECTION (dark)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.staff-section {
    background: var(--bg);
    padding: 100px 0;
    position: relative; overflow: hidden;
}
.staff-blob-1 {
    position:absolute; width:500px; height:500px; border-radius:50%;
    background:hsla(217,91%,60%,0.08); filter:blur(80px);
    top:-100px; right:-100px; pointer-events:none;
}
.staff-blob-2 {
    position:absolute; width:400px; height:400px; border-radius:50%;
    background:hsla(174,72%,56%,0.07); filter:blur(80px);
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
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px; padding: 28px;
    position: relative; overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.bcard:hover {
    border-color: hsla(174,72%,56%,0.35);
    box-shadow: 0 0 30px hsla(174,72%,56%,0.12);
}
.bcard-title { font-size: 1rem; font-weight: 500; color: var(--foreground); margin-bottom: 8px; letter-spacing: -0.3px; }
.bcard-desc  { font-size: 0.83rem; color: var(--muted); line-height: 1.75; }
.bicon {
    width: 44px; height: 44px; border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; margin-bottom: 16px;
}
.bi-teal   { background:hsla(174,72%,56%,0.15); color:hsl(174,72%,60%); }
.bi-blue   { background:hsla(217,91%,60%,0.15); color:hsl(217,91%,70%); }
.bi-amber  { background:hsla(38,92%,50%,0.15);  color:hsl(38,92%,60%); }
.bi-violet { background:hsla(262,83%,58%,0.15); color:hsl(262,83%,70%); }
.bi-rose   { background:hsla(347,77%,50%,0.15); color:hsl(347,77%,65%); }

/* mini tag inside bcard */
.mtag {
    display:inline-flex; align-items:center; gap:4px;
    background:hsla(210,40%,98%,0.05); border:1px solid hsla(210,40%,98%,0.09);
    border-radius:6px; padding:3px 9px; font-size:0.68rem; font-weight:600; color:var(--muted);
    margin:3px 2px 0 0;
}

/* Face scan widget */
.scan-widget {
    background: hsla(217,91%,60%,0.06);
    border: 1px solid hsla(217,91%,60%,0.18);
    border-radius: 12px; padding: 14px 16px; margin-top: 18px;
    display: flex; align-items: center; gap: 14px;
}
.scan-avatar {
    width: 48px; height: 48px; border-radius: 50%;
    background: linear-gradient(135deg, hsl(217,91%,50%), hsl(174,72%,50%));
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
.scan-ok { font-size: 0.7rem; font-weight: 500; color: hsl(174,72%,60%); margin-top: 6px; }

/* GPS widget */
.gps-widget {
    background: hsla(174,72%,56%,0.07);
    border: 1px solid hsla(174,72%,56%,0.18);
    border-radius: 12px; padding: 12px 14px; margin-top: 16px;
    display: flex; align-items: center; gap: 10px;
}
.gps-dot { width: 9px; height: 9px; border-radius: 50%; background: hsl(174,72%,56%); flex-shrink: 0; position: relative; }
.gps-dot::after {
    content:''; position:absolute; inset:-4px; border-radius:50%;
    background: transparent; border: 1.5px solid hsla(174,72%,56%,0.35);
    animation: ping 1.5s cubic-bezier(0,0,0.2,1) infinite;
}
@keyframes ping { 75%,100%{transform:scale(2);opacity:0} }

/* Mini bar chart */
.mini-bars { display:flex; align-items:flex-end; gap:4px; height:52px; margin-top:16px; }
.mbar { flex:1; border-radius:4px 4px 0 0; background:hsla(210,40%,98%,0.06); }
.mbar.hi { background: var(--gradient-primary); }

/* Salary slip */
.slip { border: 1px solid var(--border); border-radius: 10px; overflow: hidden; margin-top: 14px; }
.slip-row { display:flex; justify-content:space-between; align-items:center; padding:8px 14px; border-bottom: 1px solid var(--border); font-size: 0.78rem; }
.slip-row:last-child { border: none; background: hsla(174,72%,56%,0.06); }
.sl { color: var(--muted); }
.sv { font-weight: 500; color: var(--foreground); }
.sv.g { color: hsl(174,72%,56%); }
.sv.r { color: hsl(0,72%,65%); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   HOW IT WORKS (white)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.how-section {
    background: var(--dark);
    padding: 100px 0;
    border-top: 1px solid var(--card-border);
}
.how-section .sec-eyebrow { color: hsl(174,72%,60%); }
.how-section .sec-title   { color: hsl(210,40%,98%); }
.how-section .sec-desc    { color: var(--muted); }

.step-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 14px; padding: 28px; height: 100%;
    transition: all 0.25s ease;
}
.step-card:hover { border-color: hsla(174,72%,56%,0.4); box-shadow: 0 0 24px hsla(174,72%,56%,0.1); transform: translateY(-3px); }
.step-num {
    width: 40px; height: 40px; border-radius: 50%;
    background: var(--gradient-primary); color: hsl(222,47%,6%);
    display: flex; align-items: center; justify-content: center;
    font-weight: 500; font-size: 0.9rem; margin-bottom: 16px;
}
.step-t { font-size: 0.95rem; font-weight: 500; color: hsl(210,40%,98%); margin-bottom: 6px; }
.step-d { font-size: 0.83rem; color: var(--muted); line-height: 1.75; }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   SOCIAL PROOF / USE CASES (dark)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.proof-section { background: var(--bg); padding: 90px 0; }
.uc-chip {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--card-bg); border: 1px solid var(--border);
    border-radius: 10px; padding: 12px 20px;
    font-size: 0.85rem; font-weight: 600; color: var(--muted);
    transition: all 0.2s ease; text-decoration: none;
}
.uc-chip:hover { border-color: hsl(174,72%,56%); color: hsl(174,72%,70%); }
.uc-chip i { color: hsl(174,72%,56%); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   TESTIMONIALS (dark)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.testi-section { background: hsl(222,47%,5%); padding: 90px 0; }
.t-card {
    background: var(--card-bg); border: 1px solid var(--border);
    border-radius: 16px; padding: 28px; height: 100%;
    transition: all 0.3s ease;
}
.t-card:hover { border-color: hsla(174,72%,56%,0.3); box-shadow: 0 0 24px hsla(174,72%,56%,0.08); }
.t-stars { color: hsl(38,92%,60%); font-size: 0.85rem; margin-bottom: 14px; }
.t-quote { font-size: 0.88rem; color: var(--muted); line-height: 1.85; margin-bottom: 20px; font-style: italic; }
.t-name  { font-size: 0.85rem; font-weight: 500; color: var(--foreground); }
.t-role  { font-size: 0.73rem; color: var(--muted); margin-top: 2px; }
.t-av {
    width: 40px; height: 40px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 500; font-size: 0.8rem; color: hsl(222,47%,6%); flex-shrink: 0;
}

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   COMPARISON (dark)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.compare-section { background: hsl(222,47%,5%); padding: 90px 0; border-top: 1px solid var(--card-border); }
.compare-section .sec-eyebrow { color: hsl(174,72%,60%); }
.compare-section .sec-title { color: hsl(210,40%,98%); }
.ctable { border: 1px solid var(--card-border); border-radius: 14px; overflow: hidden; }
.ctable table { margin: 0; }
.ctable thead { background: hsla(217,33%,17%,0.5); }
.ctable thead th { font-size: 0.75rem; font-weight: 500; text-transform: uppercase; letter-spacing: 0.8px; padding: 16px 20px; border: none; color: var(--muted); }
.ctable tbody tr { border-color: var(--card-border) !important; }
.ctable tbody td { padding: 13px 20px; font-size: 0.88rem; font-weight: 500; color: hsl(210,40%,80%); background: var(--card-bg); }
.ctable tbody tr:hover td { background: hsla(217,33%,17%,0.5); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   FAQ (dark)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.faq-section { background: var(--bg); padding: 90px 0; }
.faq-item {
    border: 1px solid var(--border); border-radius: 12px;
    overflow: hidden; margin-bottom: 10px;
    transition: border-color 0.2s ease;
}
.faq-item:hover { border-color: hsla(174,72%,56%,0.3); }
.accordion-button {
    background: var(--card-bg) !important; color: var(--foreground) !important;
    font-weight: 600; font-size: 0.9rem;
    padding: 18px 22px;
    box-shadow: none !important;
}
.accordion-button::after { filter: invert(1); }
.accordion-body {
    background: var(--card-bg); color: var(--muted);
    font-size: 0.87rem; line-height: 1.85;
    padding: 0 22px 20px; border-top: 1px solid var(--border);
}

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   CTA FINAL
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.cta-section { background: var(--bg); padding: 100px 0; }
.cta-box {
    border-radius: 20px; padding: 70px 50px; text-align: center;
    position: relative; overflow: hidden;
    background: var(--card-bg); border: 1px solid var(--border);
}
.cta-box::before {
    content: ''; position: absolute; top: -200px; left: 50%;
    transform: translateX(-50%); width: 700px; height: 400px;
    background: radial-gradient(ellipse, hsla(174,72%,56%,0.15) 0%, transparent 70%);
    pointer-events: none;
}
.cta-box h2 { font-size: clamp(1.8rem,3.5vw,2.8rem); font-weight: 500; letter-spacing:-1.5px; color: var(--foreground); margin-bottom: 14px; }
.cta-box p  { color: var(--muted); font-size: 1rem; max-width: 480px; margin: 0 auto 36px; line-height: 1.8; }
.trust-item { font-size: 0.78rem; color: var(--muted); display: inline-flex; align-items: center; gap: 5px; }
.trust-item i { color: hsl(174,72%,56%); }

@media(max-width:991px) {
    .hero-content { padding: 120px 0 40px; }
}

@media(max-width:768px) {
    .hero-content { padding: 210px 0 50px; }
    .hero-h1, .hero-h2 { font-size: clamp(1.9rem, 7vw, 2.4rem) !important; letter-spacing: -1px; line-height: 1.2; margin-bottom: 14px; }
    .hero-kicker { font-size: 0.68rem; padding: 5px 12px; margin-bottom: 16px; }
    .notif-card { display: none; }
    .cta-box { padding: 44px 24px; }
    .feat-grid { grid-template-columns: 1fr; }
}

@media(max-width:480px) {
    .hero-content { padding: 190px 0 28px; }
}
</style>

    <!-- FAQ Schema JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "How fast can we set up Edunex ERP for our school?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Setting up Edunex ERP is incredibly fast. Because the software is hosted on a secure cloud network, there is no need for local server installations or complex IT setups. Once you sign up, our dedicated onboarding team can help migrate your student databases, configure your custom fee structures, and get your system live in under 15 minutes."
          }
        },
        {
          "@@type": "Question",
          "name": "Does the Face Recognition Attendance system require expensive specialized hardware?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Not at all. Unlike legacy biometric systems that require expensive dedicated machines and wiring, Edunex ERP’s AI facial recognition runs smoothly on any standard Android or iOS tablet, smartphone, or laptop camera. This dramatically lowers the entry cost for schools and makes deployment effortless."
          }
        },
        {
          "@@type": "Question",
          "name": "How secure is our school's student and financial data on your platform?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Data security is our highest priority. Edunex ERP utilizes a modern multi-tenant cloud architecture, which means that your school's data is housed in a completely isolated database silo. It is fully encrypted at rest and in transit. Your records, fee histories, and employee payrolls are 100% invisible to any other academy on the platform."
          }
        },
        {
          "@@type": "Question",
          "name": "Can we manage multiple school campuses or coaching branches from one account?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Yes! If you manage a chain of schools or coaching institutes across {{ $city }} and nearby regions, Edunex ERP offers a centralized dashboard. Trustees and administrators can view overall metrics, monitor financial reports, check overall attendance trends, and switch between campuses seamlessly using a single master login."
          }
        },
        {
          "@@type": "Question",
          "name": "How does the automated fee reminder system work on WhatsApp?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Our system integrates directly with authorized WhatsApp APIs. The billing engine automatically monitors pending tuition dues on your ledgers. With one click, administrators can dispatch personalized payment links directly to parents' WhatsApp numbers. Parents can click the link and securely clear the balance instantly using UPI or card."
          }
        }
      ]
    }
    </script>

    <!-- Local Business Schema JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "EducationalOrganization",
      "name": "Edunex ERP {{ $city }}",
      "description": "Provider of premium school management software, student ERP systems, and AI face biometric attendance platforms for schools and coaching institutes in {{ $city }}, {{ $country }}.",
      "url": "https://edunex.com/best-school-management-software-in-{{ Str::slug($city) }}",
      "logo": "https://edunex.com/images/logo.png",
      "address": {
        "@@type": "PostalAddress",
        "addressLocality": "{{ $city }}",
        "addressCountry": "{{ $country }}"
      },
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "+91-99999-88888",
        "contactType": "customer service",
        "areaServed": "{{ $city }}",
        "availableLanguage": ["English", "Hindi"]
      },
      "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "184"
      }
    }
    </script>

    <!-- Breadcrumb Schema JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "https://edunex.com"
        },
        {
          "@@type": "ListItem",
          "position": 2,
          "name": "School ERP in {{ $country }}",
          "item": "https://edunex.com/school-erp-in-{{ Str::slug($country) }}"
        },
        {
          "@@type": "ListItem",
          "position": 3,
          "name": "Best School Management Software in {{ $city }}",
          "item": "https://edunex.com/best-school-management-software-in-{{ Str::slug($city) }}"
        }
      ]
    }
    </script>

</head>
<body>

@include('components.frontend-navbar')

<section class="hero">
    <div class="hero-blob blob-1"></div>
    <div class="hero-blob blob-2"></div>
    <div class="hero-blob blob-3"></div>

    <div class="hero-content">
        <div class="container px-4">
            <div class="row align-items-center g-5">

                <!-- Copy -->
                <div class="col-lg-6 text-center text-lg-start hero-copy">
                    <h1 class="hero-h2">
                        The smartest way<br>to run your<br>
                        <span class="g-text">School or institute in {{$city}}.</span>
                    </h1>
                    <p class="hero-sub">
                        Attendance, fees, live lectures, AI biometric staff management, and payroll. All automated in one platform built for {{ $city }}'s coaching centers and schools.
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

                    <div class="d-flex gap-3 flex-wrap justify-content-center justify-content-lg-start hero-cta-btns">
                        @auth
                            <a href="{{ auth()->user()->isSuperAdmin() ? route('superadmin.dashboard') : url('/dashboard') }}" class="btn-primary">
                                Dashboard <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('pricing') }}" class="btn-primary">
                                Start Free Trial <i class="fas fa-rocket"></i>
                            </a>
                            <a href="#staff" class="btn-outline">
                                <i class="fas fa-fingerprint"></i> See AI Features
                            </a>
                        @endauth
                    </div>
                    <p style="margin-top:14px;font-size:0.75rem;color:var(--muted);">
                        <i class="fas fa-shield-alt me-1" style="color:hsl(174,72%,56%);"></i> No credit card &nbsp;·&nbsp;
                        <i class="fas fa-clock me-1" style="color:hsl(217,91%,60%);"></i> Live in 15 minutes
                    </p>
                </div>

                <!-- Visual -->
                <div class="col-lg-6" >
                    <div class="portal-display">
                        <div class="display-wrapper">
                            <img src="{{ asset('images/hero-banner-2.png') }}" alt="EduNex ERP Dashboard" class="desktop-mockup">
                        </div>
                        <div class="portal-text" style="max-width: 650px;">
                            <h3>All in One ERP</h3>
                            <p>Manage your entire Educational Institute from one central interface. Track attendance, fees, and more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<!-- ══════════════ MOBILE APP ══════════════ -->
<section id="mobile-app" class="staff-section" style="background: hsl(222,47%,5%); border-top: 1px solid var(--border);">
    <div class="staff-blob-2" style="background:hsla(262,83%,58%,0.07); top:-100px; left:-100px;"></div>
    <div class="staff-blob-1" style="background:hsla(217,91%,60%,0.08); bottom:-80px; right:-80px;"></div>
    <div class="container px-4" style="position:relative;z-index:2;">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-6 text-center">
                <div style="position:relative; display:inline-block;">
                    <!-- Decorative glow behind phone -->
                    <div style="position:absolute; inset:20px; background:var(--gradient-secondary); filter:blur(60px); opacity:0.3; border-radius:50%;"></div>
                    <img src="{{ asset('images/mobile-screen.png') }}" alt="EduNex Mobile App" style="max-width: 250px; width: 100%; position:relative; z-index:2; filter: drop-shadow(0 25px 50px rgba(0,0,0,0.5));">
                </div>
            </div>
            <div class="col-lg-6">
                <span class="sec-eyebrow" style="color: hsl(262,83%,65%);">Dedicated Mobile App</span>
                <h2 class="sec-title">The entire institute in <br><span class="g-text-2">their pocket.</span></h2>
                <p class="sec-desc mb-4">Empower your students and parents with a modern, native-like mobile app. They can check timetables, track attendance, pay fees, and join live classes from anywhere.</p>
                
                <ul class="feat-list mb-4" style="max-width: 450px; list-style: none; padding: 0;">
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:var(--muted);"><i class="fas fa-check-circle" style="color:hsl(262,83%,65%); font-size:1.1rem;"></i> Real-time attendance & result notifications</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:var(--muted);"><i class="fas fa-check-circle" style="color:hsl(262,83%,65%); font-size:1.1rem;"></i> Online fee payments with instant receipts</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:var(--muted);"><i class="fas fa-check-circle" style="color:hsl(262,83%,65%); font-size:1.1rem;"></i> One-tap join for live video lectures</li>
                    <li style="display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; font-size:0.9rem; color:var(--muted);"><i class="fas fa-check-circle" style="color:hsl(262,83%,65%); font-size:1.1rem;"></i> Access study materials & homework</li>
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
</section>

<!-- ══════════════ ABOUT SCHOOL ERP ══════════════ -->
<section id="about-erp" class="feat-section" style="background: hsl(222,47%,5%); border-top: 1px solid var(--border); padding: 90px 0;">
    <div class="container px-4">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="badge-pill mb-3"><i class="fas fa-school me-1"></i> Local Education Landscape</span>
                <h2 class="sec-title" style="margin-bottom:20px;">Modernizing School Operations in <span class="g-text">{{ $city }}</span></h2>
                <p class="sec-desc" style="font-size:0.95rem; margin-bottom:24px;">The educational landscape in {{ $city }} is experiencing an unprecedented evolution. As schools, colleges, and coaching academies strive to match global academic standards, the administrative burden on administrators, trustees, and educators has grown exponentially. From national curricula like CBSE and ICSE to prestigious international boards (IB/IGCSE) and regional state curricula, schools are tasked with managing dense, complex academic programs. With this rapid expansion comes a critical need for modernization: institutions can no longer afford to operate using siloed desktop applications, manual registers, or disjointed WhatsApp groups.</p>
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
                    <div class="feat-icon-wrap" style="background:hsla(174,72%,56%,0.18);color:hsl(174,72%,60%);"><i class="fas fa-fingerprint"></i></div>
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
                <div class="feat-icon-wrap" style="background:rgba(37,99,235,0.12);color:hsl(217,91%,70%);"><i class="fas fa-credit-card"></i></div>
                <div class="feat-name">Fee &amp; Payments</div>
                <div class="feat-desc">Online collection with Razorpay. Automatic WhatsApp reminders. Real-time dashboards.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(245,158,11,0.12);color:hsl(38,92%,60%);"><i class="fas fa-money-bill-wave"></i></div>
                <div class="feat-name">Payroll &amp; Salary Slips</div>
                <div class="feat-desc">One click runs payroll. PDF payslips land on WhatsApp automatically every month.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(16,185,129,0.1);color:hsl(174,72%,60%);"><i class="fas fa-calendar-check"></i></div>
                <div class="feat-name">Student Attendance</div>
                <div class="feat-desc">Batch-wise marking in one tap. Monthly reports auto-generated, parents notified instantly.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(139,92,246,0.12);color:hsl(262,83%,70%);"><i class="fas fa-video"></i></div>
                <div class="feat-name">Live Lectures</div>
                <div class="feat-desc">Host live classes inside EduNex. Students join via their dedicated mobile app — no Zoom needed.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(16,185,129,0.1);color:hsl(174,72%,60%);"><i class="fas fa-chart-line"></i></div>
                <div class="feat-name">Analytics &amp; Reports</div>
                <div class="feat-desc">Full visibility: student performance, attendance trends, fee collection, and staff punctuality.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(236,72,153,0.1);color:hsl(330,81%,60%);"><i class="fas fa-book-reader"></i></div>
                <div class="feat-name">Library Management</div>
                <div class="feat-desc">Complete digital library system. Track books, manage issues, handle fines, and provide digital resources.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(234,88,12,0.1);color:hsl(24,98%,55%);"><i class="fas fa-balance-scale"></i></div>
                <div class="feat-name">Discipline Management</div>
                <div class="feat-desc">Track student behavior with dynamic scoring. Log infractions, deduct points, and monitor progress.</div>
            </div>
            <div class="feat-card">
                <div class="feat-icon-wrap" style="background:rgba(14,165,233,0.1);color:hsl(199,89%,58%);"><i class="fas fa-images"></i></div>
                <div class="feat-name">Image Gallery</div>
                <div class="feat-desc">Share memories securely. Upload photos and videos of institute events directly to student dashboards.</div>
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
<section id="staff" class="staff-section">
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

        <div class="bento">

            <!-- Face Recognition -->
            <div class="bcard b7">
                <div class="bicon bi-blue"><i class="fas fa-face-smile-beam"></i></div>
                <div class="bcard-title">AI Face Recognition</div>
                <div class="bcard-desc">Staff mark attendance with a glance. On-device AI identifies and verifies in under 1 second — no PINs, cards, or manual entries.</div>
                <div class="mt-2 mb-1">
                    <span class="mtag"><i class="fas fa-bolt" style="color:hsl(38,92%,60%);"></i> &lt;1 sec scan</span>
                    <span class="mtag"><i class="fas fa-shield-alt" style="color:hsl(174,72%,56%);"></i> Anti-spoof</span>
                    <span class="mtag"><i class="fas fa-wifi-slash"></i> Offline capable</span>
                </div>
                <div class="scan-widget">
                    <div class="scan-avatar"><i class="fas fa-user"></i></div>
                    <div class="scan-bars">
                        <div style="font-size:0.65rem;font-weight: 500;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:7px;">Scanning face…</div>
                        <div class="sbar"><div class="sline-fill sbar-fill"></div></div>
                        <div class="sbar"><div class="sline-fill sbar-fill d1"></div></div>
                        <div class="sbar"><div class="sline-fill sbar-fill d2"></div></div>
                        <div class="scan-ok"><i class="fas fa-check-circle me-1"></i>Identity Verified</div>
                    </div>
                </div>
            </div>

            <!-- GPS -->
            <div class="bcard b5">
                <div class="bicon bi-teal"><i class="fas fa-location-dot"></i></div>
                <div class="bcard-title">GPS Location Verification</div>
                <div class="bcard-desc">Staff can only check in from within your institute's geofence. Configurable radius prevents remote or fake attendance.</div>
                <div class="mt-2 mb-1">
                    <span class="mtag"><i class="fas fa-map-pin" style="color:hsl(174,72%,56%);"></i> 100m geofence</span>
                    <span class="mtag"><i class="fas fa-satellite-dish"></i> Real-time GPS</span>
                </div>
                <div class="gps-widget">
                    <div class="gps-dot"></div>
                    <div style="flex:1;">
                        <div style="font-size:0.78rem;font-weight: 500;color:hsl(174,72%,60%);">Location Verified ✓</div>
                        <div style="font-size:0.68rem;color:var(--muted);">Within 43m · Just now</div>
                    </div>
                    <span style="background:hsla(174,72%,56%,0.12);border:1px solid hsla(174,72%,56%,0.25);border-radius:6px;padding:2px 8px;font-size:0.65rem;font-weight: 500;color:hsl(174,72%,60%);">LIVE</span>
                </div>
            </div>

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
                <div class="bicon bi-amber"><i class="fas fa-money-bill-wave"></i></div>
                <div class="bcard-title">Payroll Processing</div>
                <div class="bcard-desc">One-click monthly payroll. Deductions, bonuses, and net salary calculated automatically.</div>
                <div class="mini-bars">
                    <div class="mbar" style="height:28%;"></div>
                    <div class="mbar" style="height:50%;"></div>
                    <div class="mbar" style="height:38%;"></div>
                    <div class="mbar" style="height:68%;"></div>
                    <div class="mbar" style="height:55%;"></div>
                    <div class="mbar hi" style="height:90%;"></div>
                </div>
                <div style="font-size:0.67rem;color:var(--muted);margin-top:4px;">Monthly payroll volume (6 months)</div>
                <div class="mt-2"><span class="mtag"><i class="fas fa-check" style="color:hsl(38,92%,60%);"></i> Auto deductions</span><span class="mtag">Bonus tracking</span></div>
            </div>

            <!-- Salary Slips -->
            <div class="bcard b4">
                <div class="bicon bi-violet"><i class="fas fa-file-invoice-dollar"></i></div>
                <div class="bcard-title">Digital Salary Slips</div>
                <div class="bcard-desc">Auto-generated payslips every month, delivered to staff via WhatsApp instantly.</div>
                <div class="slip">
                    <div class="slip-row"><span class="sl">Basic Salary</span><span class="sv">₹22,000</span></div>
                    <div class="slip-row"><span class="sl">Bonus</span><span class="sv g">+₹2,500</span></div>
                    <div class="slip-row"><span class="sl">Deductions</span><span class="sv r">−₹1,200</span></div>
                    <div class="slip-row"><span class="sl" style="font-weight: 500;color:var(--foreground);">Net Pay</span><span class="sv g" style="font-size:0.9rem;">₹23,300</span></div>
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
                        ['n'=>'03','t'=>'Enrol your students','d'=>'Add students, collect fees instantly, they get portal access on the spot.','c'=>'hsla(262,83%,58%,0.08)','bc'=>'hsla(262,83%,58%,0.2)'],
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
<section id="success-story" class="feat-section" style="background: hsl(222,47%,6%); border-top: 1px solid var(--border); padding: 90px 0;">
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
                        <p style="font-size:0.83rem; color:var(--muted); line-height:1.7; margin-bottom:0;"><strong>The Transformation:</strong> In the summer of 2025, the academy partnered with Edunex ERP to execute a complete digital transformation. Within 48 hours, our onboarding team migrated their historical student databases into a secure multi-tenant cloud environment. Teachers began marking attendance in one tap on classroom tablets, and the academy deployed face biometrics at the staff entrance to automate HR check-ins, launching the Edunex Parent App for real-time progress tracking and online fee collections.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 style="font-size:1.05rem; font-weight:600; margin-bottom:20px; letter-spacing:-0.3px;"><i class="fas fa-chart-line text-primary me-2"></i> Unprecedented 60-Day Results:</h4>
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div style="background: hsla(210,40%,98%,0.03); border: 1px solid var(--border); border-radius:10px; padding: 16px; text-align:center;">
                                <div style="font-size:2rem; font-weight:600; color: hsl(174,72%,60%);">100%</div>
                                <div style="font-size:0.75rem; color:var(--muted); margin-top:4px;">Fee Arrears Recovered</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background: hsla(210,40%,98%,0.03); border: 1px solid var(--border); border-radius:10px; padding: 16px; text-align:center;">
                                <div style="font-size:2rem; font-weight:600; color: hsl(217,91%,70%);">12 Hrs</div>
                                <div style="font-size:0.75rem; color:var(--muted); margin-top:4px;">Saved Per Teacher/Mo</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background: hsla(210,40%,98%,0.03); border: 1px solid var(--border); border-radius:10px; padding: 16px; text-align:center;">
                                <div style="font-size:2rem; font-weight:600; color: hsl(38,92%,60%);">98%</div>
                                <div style="font-size:0.75rem; color:var(--muted); margin-top:4px;">Staff Punctuality Improvement</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div style="background: hsla(210,40%,98%,0.03); border: 1px solid var(--border); border-radius:10px; padding: 16px; text-align:center;">
                                <div style="font-size:2rem; font-weight:600; color: hsl(262,83%,70%);">4.8★</div>
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

<!-- ══════════════ WHY EDUNEX ══════════════ -->
<section class="compare-section">
    <div class="container px-4">
        <div class="row align-items-end mb-5 g-4">
            <div class="col-lg-6">
                <span class="sec-eyebrow">Why EduNex?</span>
                <h2 class="sec-title" style="margin-bottom:0;">Your team deserves<br>better than <span class="g-text">WhatsApp groups.</span></h2>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <p class="sec-desc" style="margin-bottom:0;">Real institutes, real pain. Here's what running an institute looks like before and after EduNex.</p>
            </div>
        </div>

        <div class="why-split">
            <!-- BEFORE -->
            <div class="why-before">
                <div class="why-label before"><i class="fas fa-times-circle"></i> Before EduNex</div>
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
                <div class="why-label after"><i class="fas fa-check-circle"></i> With EduNex</div>
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
            <p style="margin-top:12px;font-size:0.75rem;color:var(--muted);"><i class="fas fa-shield-alt me-1" style="color:var(--primary);"></i> No credit card required — Live in 15 minutes</p>
        </div>
    </div>
</section>

<!-- ══════════════ TESTIMONIALS ══════════════ -->
<section class="testi-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <span class="sec-eyebrow">Real Stories</span>
            <h2 class="sec-title">Loved by institutes<br>across {{ $city }}.</h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['n'=>'Rajesh Kumar','r'=>'Director, Apex Coaching Center','i'=>'RK','c'=>'var(--gradient-primary)','q'=>'EduNex completely changed how we manage our 300+ students. The fee reminders alone saved us 10+ hours of phone calls every month.'],
                ['n'=>'Priya Sharma','r'=>'Principal, Bright Minds Academy','i'=>'PS','c'=>'var(--gradient-secondary)','q'=>'The AI face attendance was a game changer — zero proxy marking. And the analytics give me full visibility into every batch.'],
                ['n'=>'Arjun Mehta','r'=>'Owner, CodeCraft Skill Institute','i'=>'AM','c'=>'linear-gradient(135deg,hsl(262,83%,58%),hsl(217,91%,60%))','q'=>'We run 6 tech courses with 400 students. EduNex handles everything from live lectures to payslips in one beautiful platform.'],
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
                            'a' => 'Yes. The Edunex Parent & Student App is fully optimized for both iOS and Android platforms. It is designed to be lightweight, incredibly fast, and exceptionally secure, offering families a modern, user-friendly interface to track all academic, fee, and transit updates.'
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
<section id="nearby-areas" class="feat-section" style="background: hsl(222,47%,5%); border-top: 1px solid var(--border); padding: 80px 0;">
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
                            <span style="font-size:0.88rem; font-weight:500; color:hsl(210,40%,85%);"><i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $area }}</span>
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
<script>
    function switchPortal(portalId) {
        document.querySelectorAll('.portal-content').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.portal-tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById(portalId + '-portal').classList.add('active');
        event.currentTarget.classList.add('active');
    }
</script>
@include('components.whatsapp-widget')
</body>
</html>
