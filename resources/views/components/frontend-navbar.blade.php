<style>
/* ══════════════════════════════════════
   NAVBAR — EduNex ERP
   Desktop: clean pill nav with mega-drop
   Mobile: slide-in drawer with grouped links
══════════════════════════════════════ */

#nb {
    position: fixed; top: 0; left: 0; right: 0;
    z-index: 1000;
    font-family: 'Inter', system-ui, sans-serif;
    transition: background 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
}

/* ── TOP BAR ── */
.nb-bar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 40px; height: 80px;
    transition: height 0.3s ease;
}
#nb.scrolled .nb-bar { height: 66px; }
#nb.scrolled {
    background: hsla(222, 47%, 6%, 0.92);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border-bottom: 1px solid hsla(217,33%,17%,0.8);
    box-shadow: 0 2px 32px hsla(0,0%,0%,0.3);
}

/* ── LOGO ── */
.nb-logo {
    display: flex; align-items: center; gap: 10px;
    text-decoration: none; flex-shrink: 0;
    z-index: 1010; position: relative;
}
.nb-logo img { display: block; transition: all 0.3s; }
.nb-logo-icon  { height: 46px; }
.nb-logo-name  { height: 30px; opacity: 0.92; }
#nb.scrolled .nb-logo-icon { height: 40px; }
#nb.scrolled .nb-logo-name { height: 26px; }

/* ══════════════════════════════════════
   DESKTOP NAV
══════════════════════════════════════ */
.nb-desktop {
    display: flex; align-items: center; gap: 2px;
    margin-left: 32px; flex: 1;
}
.nb-link {
    font-size: 0.875rem; font-weight: 500;
    color: hsl(215,20%,65%); text-decoration: none;
    padding: 8px 14px; border-radius: 8px;
    transition: color 0.2s, background 0.2s;
    white-space: nowrap;
}
.nb-link:hover { color: #fff; background: hsla(210,40%,98%,0.07); }
.nb-link.active { color: hsl(174,72%,60%); font-weight: 600; }

/* Drop trigger */
.nb-drop { position: relative; }
.nb-drop-btn {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.875rem; font-weight: 500;
    color: hsl(215,20%,65%);
    padding: 8px 14px; border-radius: 8px;
    cursor: pointer; white-space: nowrap;
    user-select: none;
    transition: color 0.2s, background 0.2s;
}
.nb-drop-btn:hover,
.nb-drop.open .nb-drop-btn {
    color: #fff; background: hsla(210,40%,98%,0.07);
}
.nb-drop-btn.active { color: hsl(174,72%,60%); font-weight: 600; }
.nb-drop-btn svg {
    width: 10px; height: 10px; flex-shrink: 0;
    stroke: currentColor; fill: none; stroke-width: 2;
    stroke-linecap: round; stroke-linejoin: round;
    transition: transform 0.25s ease;
}
.nb-drop.open .nb-drop-btn svg { transform: rotate(180deg); }

/* Dropdown panel */
.nb-panel {
    position: absolute; top: calc(100% + 12px); left: 0;
    padding: 8px; border-radius: 14px;
    background: hsla(222,47%,7%,0.98);
    border: 1px solid hsl(217,33%,18%);
    box-shadow: 0 20px 48px hsla(0,0%,0%,0.32), 0 4px 12px hsla(0,0%,0%,0.16);
    opacity: 0; visibility: hidden;
    transform: translateY(6px) scale(0.98);
    transform-origin: top left;
    transition: opacity 0.18s ease, transform 0.18s ease, visibility 0.18s;
    min-width: 200px;
    pointer-events: none;
}
.nb-panel::before {
    content: '';
    position: absolute;
    top: -16px; left: 0; right: 0;
    height: 16px;
    background: transparent;
}
.nb-drop.open .nb-panel {
    opacity: 1; visibility: visible;
    transform: translateY(0) scale(1);
    pointer-events: all;
}
.nb-panel a {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px; border-radius: 8px;
    font-size: 0.845rem; font-weight: 500;
    color: hsl(215,20%,68%); text-decoration: none;
    transition: background 0.15s, color 0.15s;
    white-space: nowrap;
}
.nb-panel a:hover { background: hsla(174,72%,56%,0.09); color: #fff; }
.nb-panel-icon {
    width: 28px; height: 28px; border-radius: 7px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.72rem;
    background: hsla(174,72%,56%,0.12); color: hsl(174,72%,60%);
}
.nb-panel a:hover .nb-panel-icon { background: hsla(174,72%,56%,0.2); }
.nb-panel-divider {
    height: 1px; background: hsl(217,33%,17%); margin: 6px 0;
}
.nb-panel-label {
    font-size: 0.65rem; font-weight: 600; letter-spacing: 1.2px;
    text-transform: uppercase; color: hsl(215,20%,40%);
    padding: 6px 12px 4px;
}

/* Mega panel */
.nb-mega {
    min-width: 720px;
    display: grid; grid-template-columns: 1fr 1fr 1fr;
    gap: 0;
}
.nb-mega-col { padding: 4px; }
.nb-mega-col + .nb-mega-col { border-left: 1px solid hsl(217,33%,17%); }
.nb-mega .nb-panel-icon { background: hsla(217,91%,60%,0.12); color: hsl(217,91%,70%); }
.nb-mega a:hover .nb-panel-icon { background: hsla(217,91%,60%,0.2); }

/* ── DESKTOP RIGHT CTAs ── */
.nb-ctas {
    display: flex; align-items: center; gap: 10px;
    margin-left: 16px; flex-shrink: 0;
}
.nbc {
    display: inline-flex; align-items: center; gap: 7px;
    font-family: inherit; font-size: 0.845rem; font-weight: 600;
    padding: 9px 18px; border-radius: 9px;
    text-decoration: none; cursor: pointer; border: none;
    transition: all 0.2s; white-space: nowrap; line-height: 1.2;
}
.nbc-ghost {
    background: hsla(210,40%,98%,0.05);
    color: hsl(215,20%,68%) !important;
    border: 1px solid hsl(217,33%,18%);
}
.nbc-ghost:hover { background: hsla(210,40%,98%,0.1); color: #fff !important; border-color: hsl(217,33%,26%); }
.nbc-solid {
    background: linear-gradient(135deg, hsl(174,72%,56%), hsl(217,91%,60%));
    color: hsl(222,47%,6%) !important; font-weight: 700;
    box-shadow: 0 0 18px hsla(174,72%,56%,0.28), 0 2px 8px hsla(0,0%,0%,0.2);
}
.nbc-solid:hover { opacity: 0.9; transform: translateY(-1px); color: hsl(222,47%,6%) !important; box-shadow: 0 0 28px hsla(174,72%,56%,0.4); }
.nbc-red {
    background: hsla(0,72%,56%,0.1);
    color: hsl(0,90%,72%) !important;
    border: 1px solid hsla(0,72%,56%,0.22);
}
.nbc-red:hover { background: hsla(0,72%,56%,0.18); color: hsl(0,90%,80%) !important; }

/* ══════════════════════════════════════
   HAMBURGER
══════════════════════════════════════ */
.nb-ham {
    display: none;
    width: 44px; height: 44px;
    background: hsla(210,40%,98%,0.05);
    border: 1px solid hsl(217,33%,18%);
    border-radius: 10px; cursor: pointer;
    flex-direction: column; align-items: center; justify-content: center;
    gap: 5px; flex-shrink: 0;
    transition: background 0.2s, border-color 0.2s;
    z-index: 1010;
}
.nb-ham:hover { background: hsla(210,40%,98%,0.1); border-color: hsl(217,33%,26%); }
.nb-ham span {
    display: block; width: 20px; height: 2px;
    background: hsl(174,72%,56%); border-radius: 2px;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    transform-origin: center;
}
body.nb-open .nb-ham span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
body.nb-open .nb-ham span:nth-child(2) { opacity: 0; transform: scaleX(0); }
body.nb-open .nb-ham span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* ══════════════════════════════════════
   MOBILE DRAWER
══════════════════════════════════════ */
.nb-drawer {
    display: none;
    position: fixed;
    top: 80px;          /* starts RIGHT below the navbar bar */
    right: 0; bottom: 0;
    width: min(360px, 94vw);
    z-index: 998;
    background: hsl(222,47%,6%);
    border-left: 1px solid hsl(217,33%,17%);
    border-top: 1px solid hsl(217,33%,17%);
    box-shadow: -16px 8px 48px hsla(0,0%,0%,0.5);
    flex-direction: column;
    transform: translateX(100%);
    transition: transform 0.32s cubic-bezier(0.4,0,0.2,1);
    overscroll-behavior: contain;
}
.nb-drawer.open { transform: translateX(0); }

/* Drawer overlay */
.nb-overlay {
    display: none;
    position: fixed; inset: 0;
    z-index: 997;
    background: hsla(222,47%,4%,0.6);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}
.nb-overlay.open { opacity: 1; pointer-events: all; }

/* Drawer inner — this is the scrollable section */
.nb-drawer-inner { 
    display: flex; flex-direction: column; 
    flex: 1 1 0; 
    padding: 8px 0 16px; 
    overflow-y: auto;
    overflow-x: hidden;
    overscroll-behavior: contain;
    min-height: 0;
}

/* Drawer section */
.nb-drawer-section { padding: 0 12px; margin-bottom: 4px; }
.nb-drawer-section-title {
    font-size: 0.62rem; font-weight: 700; letter-spacing: 1.4px;
    text-transform: uppercase; color: hsl(215,20%,38%);
    padding: 14px 12px 8px;
}
.nb-drawer-section-divider {
    height: 1px; background: hsl(217,33%,15%);
    margin: 8px 12px;
}

/* Drawer links */
.nb-dlink {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 12px; border-radius: 10px;
    font-size: 0.9rem; font-weight: 500;
    color: hsl(215,20%,68%); text-decoration: none;
    transition: background 0.15s, color 0.15s;
    cursor: pointer;
}
.nb-dlink:hover, .nb-dlink.active {
    background: hsla(174,72%,56%,0.08);
    color: #fff;
}
.nb-dlink.active { color: hsl(174,72%,60%); }
.nb-dlink-icon {
    width: 34px; height: 34px; border-radius: 8px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.8rem;
}
.di-teal  { background: hsla(174,72%,56%,0.14); color: hsl(174,72%,60%); }
.di-blue  { background: hsla(217,91%,60%,0.14); color: hsl(217,91%,72%); }
.di-amber { background: hsla(38,92%,50%,0.14);  color: hsl(38,92%,62%); }
.di-violet{ background: hsla(262,83%,58%,0.14); color: hsl(262,83%,72%); }
.di-rose  { background: hsla(347,77%,50%,0.14); color: hsl(347,77%,68%); }
.di-green { background: hsla(142,72%,45%,0.14); color: hsl(142,72%,58%); }
.nb-dlink-text { flex: 1; }
.nb-dlink-text span { display: block; }
.nb-dlink-text .nb-dlink-sub {
    font-size: 0.72rem; color: hsl(215,20%,45%);
    margin-top: 1px; font-weight: 400;
}
.nb-dlink-arrow { font-size: 0.65rem; color: hsl(215,20%,35%); }

/* Collapsible group in drawer */
.nb-dgroup-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 11px 12px; border-radius: 10px;
    font-size: 0.9rem; font-weight: 500;
    color: hsl(215,20%,68%); cursor: pointer;
    transition: background 0.15s, color 0.15s;
    user-select: none;
}
.nb-dgroup-header:hover { background: hsla(210,40%,98%,0.05); color: #fff; }
.nb-dgroup-header .di { 
    display: flex; align-items: center; gap: 12px; 
}
.nb-dgroup-chevron {
    font-size: 0.6rem; color: hsl(215,20%,35%);
    transition: transform 0.25s ease;
}
.nb-dgroup.expanded .nb-dgroup-chevron { transform: rotate(180deg); }
.nb-dgroup-body {
    max-height: 0; overflow: hidden;
    transition: max-height 0.3s ease;
    padding-left: 10px;
}
.nb-dgroup.expanded .nb-dgroup-body { max-height: 400px; }

/* Drawer CTAs — STICKY at the very bottom, never scrolls away */
.nb-drawer-ctas {
    padding: 14px 12px 28px;
    display: flex; flex-direction: column; gap: 8px;
    border-top: 1px solid hsl(217,33%,15%);
    background: hsl(222,47%,6%); /* solid so it covers content beneath */
    flex-shrink: 0; /* never shrink, always at bottom */
}
.nb-drawer-ctas .nbc {
    display: flex; align-items: center; justify-content: center;
    width: 100%; padding: 13px 20px; border-radius: 11px;
    font-size: 0.9rem;
}

/* ══════════════════════════════════════
   RESPONSIVE BREAKPOINTS
══════════════════════════════════════ */
@media (max-width: 991px) {
    .nb-desktop { display: none; }
    .nb-ctas    { display: none; }
    .nb-ham     { display: flex; }
    .nb-drawer  { display: flex; }
    .nb-overlay { display: block; }
    .nb-bar     { padding: 0 20px; }
}
@media (min-width: 992px) {
    .nb-drawer  { display: none !important; }
    .nb-overlay { display: none !important; }
    .nb-ham     { display: none !important; }
}
@media (max-width: 1280px) and (min-width: 992px) {
    .nb-bar { padding: 0 24px; }
    .nb-desktop { gap: 0; margin-left: 16px; }
    .nb-link, .nb-drop-btn { padding: 7px 10px; font-size: 0.82rem; }
    .nbc { padding: 8px 12px; font-size: 0.8rem; }
    .nb-ctas { gap: 7px; margin-left: 10px; }
}
@media (max-width: 1100px) and (min-width: 992px) {
    .nb-link, .nb-drop-btn { padding: 6px 8px; font-size: 0.80rem; }
    .nbc { padding: 7px 10px; font-size: 0.78rem; }
}

/* Stagger animation for drawer links */
.nb-drawer-inner .nb-dlink {
    opacity: 0; transform: translateX(14px);
    transition: opacity 0.28s ease, transform 0.28s ease, background 0.15s, color 0.15s;
}
.nb-drawer.open .nb-drawer-inner .nb-dlink { opacity: 1; transform: translateX(0); }

/* Individual delays — target each link in order */
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(1)  { transition-delay: 0.04s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(2)  { transition-delay: 0.07s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(3)  { transition-delay: 0.10s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(4)  { transition-delay: 0.13s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(5)  { transition-delay: 0.16s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(6)  { transition-delay: 0.18s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(7)  { transition-delay: 0.20s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(8)  { transition-delay: 0.22s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(9)  { transition-delay: 0.24s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(10) { transition-delay: 0.26s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(11) { transition-delay: 0.28s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(12) { transition-delay: 0.30s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(13) { transition-delay: 0.32s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(14) { transition-delay: 0.34s; }
.nb-drawer.open .nb-drawer-inner .nb-dlink:nth-of-type(15) { transition-delay: 0.36s; }

.nb-drawer-ctas {
    opacity: 0; transform: translateY(6px);
    transition: opacity 0.28s 0.38s ease, transform 0.28s 0.38s ease;
}
.nb-drawer.open .nb-drawer-ctas { opacity: 1; transform: translateY(0); }

</style>

{{-- Overlay --}}
<div class="nb-overlay" id="nbOverlay"></div>

{{-- Navbar bar --}}
<div id="nb">
    <div class="nb-bar">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="nb-logo" aria-label="EduNex ERP Home">
            <img src="{{ asset('images/logo.png') }}"      alt="EduNex ERP Logo" class="nb-logo-icon">
            <img src="{{ asset('images/logo-name.png') }}" alt="EduNex ERP"      class="nb-logo-name">
        </a>

        {{-- Desktop nav --}}
        <nav class="nb-desktop" aria-label="Main navigation">

            <a href="{{ url('/') }}" class="nb-link {{ request()->is('/') ? 'active' : '' }}">Home</a>

            {{-- Features mega-drop --}}
            <div class="nb-drop" id="dropFeatures">
                <div class="nb-drop-btn {{ request()->routeIs('digital.assessment') || request()->routeIs('features.*') ? 'active' : '' }}" role="button" tabindex="0" aria-haspopup="true" aria-expanded="false">
                    Features
                    <svg viewBox="0 0 12 12"><polyline points="2,4 6,8 10,4"/></svg>
                </div>
                <div class="nb-panel nb-mega" role="menu">
                    <div class="nb-mega-col">
                        <div class="nb-panel-label">Core Platform</div>
                        <a href="{{ url('/') }}#features" role="menuitem">
                            <span class="nb-panel-icon"><i class="fas fa-university"></i></span> Complete ERP
                        </a>
                        <a href="{{ url('/') }}#staff" role="menuitem">
                            <span class="nb-panel-icon"><i class="fas fa-fingerprint"></i></span> AI Biometrics
                        </a>
                        <a href="{{ url('/') }}#mobile-app" role="menuitem">
                            <span class="nb-panel-icon"><i class="fas fa-mobile-alt"></i></span> Mobile App
                        </a>
                    </div>
                    <div class="nb-mega-col">
                        <div class="nb-panel-label">Security &amp; Finance</div>
                        <a href="{{ route('features.visitor-gate') }}" role="menuitem">
                            <span class="nb-panel-icon" style="background:hsla(38,92%,50%,0.12);color:hsl(38,92%,62%);"><i class="fas fa-id-badge"></i></span> Visitor Gate Security
                        </a>
                        <a href="{{ route('features.accounting-tally') }}" role="menuitem">
                            <span class="nb-panel-icon" style="background:hsla(347,77%,50%,0.12);color:hsl(347,77%,68%);"><i class="fas fa-calculator"></i></span> Accounting &amp; Tally
                        </a>
                        <a href="{{ route('features.transit-tracking') }}" role="menuitem">
                            <span class="nb-panel-icon" style="background:hsla(142,72%,45%,0.12);color:hsl(142,72%,58%);"><i class="fas fa-map-location-dot"></i></span> GPS Transit Tracking
                        </a>
                        <a href="{{ route('features.statutory-payroll') }}" role="menuitem">
                            <span class="nb-panel-icon" style="background:hsla(217,91%,60%,0.12);color:hsl(217,91%,70%);"><i class="fas fa-file-invoice-dollar"></i></span> Statutory Payroll
                        </a>
                    </div>
                    <div class="nb-mega-col">
                        <div class="nb-panel-label">Academic &amp; Management</div>
                        <a href="{{ route('digital.assessment') }}" role="menuitem">
                            <span class="nb-panel-icon" style="background:hsla(262,83%,58%,0.12);color:hsl(262,83%,72%);"><i class="fas fa-laptop-code"></i></span> Online Assessment
                        </a>
                        <a href="{{ route('features.inventory-management') }}" role="menuitem">
                            <span class="nb-panel-icon" style="background:hsla(174,72%,56%,0.12);color:hsl(174,72%,60%);"><i class="fas fa-boxes-stacked"></i></span> Inventory Management
                        </a>
                        <a href="{{ route('features.hostel-management') }}" role="menuitem">
                            <span class="nb-panel-icon" style="background:hsla(262,83%,58%,0.12);color:hsl(262,83%,72%);"><i class="fas fa-bed"></i></span> Hostel Management
                        </a>
                        <a href="{{ route('features.library-management') }}" role="menuitem">
                            <span class="nb-panel-icon" style="background:hsla(142,72%,45%,0.12);color:hsl(142,72%,58%);"><i class="fas fa-book-open"></i></span> Library Management
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('pricing') }}" class="nb-link {{ request()->routeIs('pricing') ? 'active' : '' }}">Pricing</a>

            {{-- Company drop --}}
            <div class="nb-drop" id="dropCompany">
                <div class="nb-drop-btn {{ request()->routeIs('about') || request()->routeIs('blogs') ? 'active' : '' }}" role="button" tabindex="0" aria-haspopup="true" aria-expanded="false">
                    Company
                    <svg viewBox="0 0 12 12"><polyline points="2,4 6,8 10,4"/></svg>
                </div>
                <div class="nb-panel" style="min-width:220px;" role="menu">
                    <a href="{{ route('about') }}" role="menuitem">
                        <span class="nb-panel-icon"><i class="fas fa-building"></i></span> About EduNex ERP
                    </a>
                    <a href="{{ route('blogs') }}" role="menuitem">
                        <span class="nb-panel-icon" style="background:hsla(38,92%,50%,0.12);color:hsl(38,92%,62%);"><i class="fas fa-newspaper"></i></span> Blog &amp; Insights
                    </a>
                    <a href="https://engeniusdigitech.netlify.app" target="_blank" rel="noopener noreferrer" role="menuitem">
                        <span class="nb-panel-icon" style="background:hsla(262,83%,58%,0.12);color:hsl(262,83%,72%);"><i class="fas fa-external-link-alt"></i></span> Engenius Digitech
                    </a>
                    <div class="nb-panel-divider"></div>
                    <a href="{{ asset('edunex-erp-brochure.html') }}" role="menuitem">
                        <span class="nb-panel-icon" style="background:hsla(217,91%,60%,0.12);color:hsl(217,91%,72%);"><i class="fas fa-eye"></i></span> View Brochure
                    </a>
                    <a href="{{ asset('edunex-erp-brochure.pdf') }}" download role="menuitem">
                        <span class="nb-panel-icon" style="background:hsla(217,91%,60%,0.12);color:hsl(217,91%,72%);"><i class="fas fa-file-arrow-down"></i></span> Download PDF
                    </a>
                </div>
            </div>

            <a href="{{ route('contact') }}" class="nb-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>

        </nav>

        {{-- Desktop CTAs --}}
        <div class="nb-ctas">
            @if(Route::has('login'))
                @if(auth()->guard('student')->check())
                    <a href="{{ route('student.dashboard') }}" class="nbc nbc-solid">
                        <i class="fas fa-gauge-high"></i> Dashboard
                    </a>
                    <form method="POST" action="{{ route('student.logout') }}" style="margin:0;">@csrf
                        <button type="submit" class="nbc nbc-red"><i class="fas fa-right-from-bracket"></i> Logout</button>
                    </form>
                @elseif(auth()->check())
                    @if(auth()->user()->isSuperAdmin())
                        <a href="{{ route('superadmin.dashboard') }}" class="nbc nbc-solid">
                            <i class="fas fa-shield-halved"></i> Admin Panel
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="nbc nbc-solid">
                            <i class="fas fa-gauge-high"></i> Dashboard
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">@csrf
                        <button type="submit" class="nbc nbc-red"><i class="fas fa-right-from-bracket"></i> Logout</button>
                    </form>
                @else
                    <a href="{{ route('student.login') }}" class="nbc nbc-ghost" style="font-size:0.82rem;padding:8px 13px;">
                        <i class="fas fa-user-graduate"></i> Student
                    </a>
                    <a href="{{ route('login') }}" class="nbc nbc-ghost">
                        <i class="fas fa-right-to-bracket"></i> Log in
                    </a>
                    <a href="{{ route('pricing') }}" class="nbc nbc-solid">
                        <i class="fas fa-rocket"></i> Free Trial
                    </a>
                @endif
            @endif
        </div>

        {{-- Hamburger --}}
        <button class="nb-ham" id="nbHam" aria-label="Open menu" aria-expanded="false" aria-controls="nbDrawer">
            <span></span><span></span><span></span>
        </button>

    </div>
</div>

{{-- ══════════════════════════════════════
     MOBILE DRAWER
══════════════════════════════════════ --}}
<div class="nb-drawer" id="nbDrawer" aria-label="Mobile navigation" role="dialog" aria-modal="true">
    <div class="nb-drawer-inner">

        {{-- Main Links --}}
        <div class="nb-drawer-section">
            <a href="{{ url('/') }}" class="nb-dlink {{ request()->is('/') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-teal"><i class="fas fa-house"></i></span>
                <span class="nb-dlink-text"><span>Home</span></span>
                <i class="fas fa-chevron-right nb-dlink-arrow"></i>
            </a>
            <a href="{{ route('pricing') }}" class="nb-dlink {{ request()->routeIs('pricing') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-green"><i class="fas fa-tag"></i></span>
                <span class="nb-dlink-text">
                    <span>Pricing</span>
                    <span class="nb-dlink-sub">Plans &amp; free trial</span>
                </span>
                <i class="fas fa-chevron-right nb-dlink-arrow"></i>
            </a>
            <a href="{{ route('contact') }}" class="nb-dlink {{ request()->routeIs('contact') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-blue"><i class="fas fa-headset"></i></span>
                <span class="nb-dlink-text">
                    <span>Contact Us</span>
                    <span class="nb-dlink-sub">Talk to our team</span>
                </span>
                <i class="fas fa-chevron-right nb-dlink-arrow"></i>
            </a>
        </div>

        <div class="nb-drawer-section-divider"></div>

        {{-- Features Group (collapsible) --}}
        <div class="nb-drawer-section">
            <div class="nb-drawer-section-title">Features</div>
            <a href="{{ route('digital.assessment') }}" class="nb-dlink {{ request()->routeIs('digital.assessment') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-blue"><i class="fas fa-laptop-code"></i></span>
                <span class="nb-dlink-text">
                    <span>Online Assessment</span>
                    <span class="nb-dlink-sub">Digital exam platform</span>
                </span>
            </a>
            <a href="{{ route('features.visitor-gate') }}" class="nb-dlink {{ request()->routeIs('features.visitor-gate') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-amber"><i class="fas fa-id-badge"></i></span>
                <span class="nb-dlink-text">
                    <span>Visitor Gate Security</span>
                    <span class="nb-dlink-sub">Digital visitor register</span>
                </span>
            </a>
            <a href="{{ route('features.accounting-tally') }}" class="nb-dlink {{ request()->routeIs('features.accounting-tally') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-rose"><i class="fas fa-calculator"></i></span>
                <span class="nb-dlink-text">
                    <span>Accounting &amp; Tally</span>
                    <span class="nb-dlink-sub">Ledger, expenses &amp; Tally sync</span>
                </span>
            </a>
            <a href="{{ route('features.transit-tracking') }}" class="nb-dlink {{ request()->routeIs('features.transit-tracking') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-teal"><i class="fas fa-map-location-dot"></i></span>
                <span class="nb-dlink-text">
                    <span>GPS Transit Tracking</span>
                    <span class="nb-dlink-sub">Live transport maps</span>
                </span>
            </a>
            <a href="{{ route('features.statutory-payroll') }}" class="nb-dlink {{ request()->routeIs('features.statutory-payroll') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-blue"><i class="fas fa-file-invoice-dollar"></i></span>
                <span class="nb-dlink-text">
                    <span>Statutory Payroll</span>
                    <span class="nb-dlink-sub">PF, ESI &amp; compliance</span>
                </span>
            </a>
            <a href="{{ route('features.inventory-management') }}" class="nb-dlink {{ request()->routeIs('features.inventory-management') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-teal"><i class="fas fa-boxes-stacked"></i></span>
                <span class="nb-dlink-text">
                    <span>Inventory Management</span>
                    <span class="nb-dlink-sub">Stock and store tracking</span>
                </span>
            </a>
            <a href="{{ route('features.hostel-management') }}" class="nb-dlink {{ request()->routeIs('features.hostel-management') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-violet"><i class="fas fa-bed"></i></span>
                <span class="nb-dlink-text">
                    <span>Hostel Management</span>
                    <span class="nb-dlink-sub">Room &amp; mess allocator</span>
                </span>
            </a>
            <a href="{{ route('features.library-management') }}" class="nb-dlink {{ request()->routeIs('features.library-management') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-green"><i class="fas fa-book-open"></i></span>
                <span class="nb-dlink-text">
                    <span>Library Management</span>
                    <span class="nb-dlink-sub">Books issue &amp; QR scan</span>
                </span>
            </a>
        </div>

        <div class="nb-drawer-section-divider"></div>

        {{-- Company --}}
        <div class="nb-drawer-section">
            <div class="nb-drawer-section-title">Company</div>
            <a href="{{ route('about') }}" class="nb-dlink {{ request()->routeIs('about') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-teal"><i class="fas fa-building"></i></span>
                <span class="nb-dlink-text"><span>About Us</span></span>
            </a>
            <a href="{{ route('blogs') }}" class="nb-dlink {{ request()->routeIs('blogs') ? 'active' : '' }}">
                <span class="nb-dlink-icon di-amber"><i class="fas fa-newspaper"></i></span>
                <span class="nb-dlink-text"><span>Blog &amp; Insights</span></span>
            </a>
            <a href="{{ asset('edunex-erp-brochure.html') }}" class="nb-dlink">
                <span class="nb-dlink-icon di-blue"><i class="fas fa-eye"></i></span>
                <span class="nb-dlink-text">
                    <span>View Brochure</span>
                    <span class="nb-dlink-sub">Interactive brochure</span>
                </span>
            </a>
            <a href="{{ asset('edunex-erp-brochure.pdf') }}" download class="nb-dlink">
                <span class="nb-dlink-icon di-blue"><i class="fas fa-file-arrow-down"></i></span>
                <span class="nb-dlink-text">
                    <span>Download PDF</span>
                    <span class="nb-dlink-sub">EduNex ERP brochure</span>
                </span>
            </a>
        </div>

    </div>{{-- /nb-drawer-inner --}}

    {{-- Drawer CTAs --}}
    <div class="nb-drawer-ctas">
        @if(Route::has('login'))
            @if(auth()->guard('student')->check())
                <a href="{{ route('student.dashboard') }}" class="nbc nbc-solid">
                    <i class="fas fa-gauge-high"></i> Student Dashboard
                </a>
                <form method="POST" action="{{ route('student.logout') }}" style="margin:0;">@csrf
                    <button type="submit" class="nbc nbc-red" style="width:100%;display:flex;align-items:center;justify-content:center;gap:7px;">
                        <i class="fas fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            @elseif(auth()->check())
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('superadmin.dashboard') }}" class="nbc nbc-solid">
                        <i class="fas fa-shield-halved"></i> Admin Panel
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}" class="nbc nbc-solid">
                        <i class="fas fa-gauge-high"></i> Go to Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">@csrf
                    <button type="submit" class="nbc nbc-red" style="width:100%;display:flex;align-items:center;justify-content:center;gap:7px;">
                        <i class="fas fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('pricing') }}" class="nbc nbc-solid">
                    <i class="fas fa-rocket"></i> Start Free Trial
                </a>
                <a href="{{ route('login') }}" class="nbc nbc-ghost">
                    <i class="fas fa-right-to-bracket"></i> Staff Log in
                </a>
                <a href="{{ route('student.login') }}" class="nbc nbc-ghost">
                    <i class="fas fa-user-graduate"></i> Student Portal
                </a>
            @endif
        @endif
    </div>
</div>

<script>
(function () {
    var nb      = document.getElementById('nb');
    var ham     = document.getElementById('nbHam');
    var drawer  = document.getElementById('nbDrawer');
    var overlay = document.getElementById('nbOverlay');
    var open    = false;

    /* ── Drawer open/close ── */
    function openDrawer() {
        open = true;
        drawer.classList.add('open');
        overlay.classList.add('open');
        document.body.classList.add('nb-open');
        document.body.style.overflow = 'hidden';
        ham.setAttribute('aria-expanded', 'true');
        ham.setAttribute('aria-label', 'Close menu');
    }
    function closeDrawer() {
        open = false;
        drawer.classList.remove('open');
        overlay.classList.remove('open');
        document.body.classList.remove('nb-open');
        document.body.style.overflow = '';
        ham.setAttribute('aria-expanded', 'false');
        ham.setAttribute('aria-label', 'Open menu');
    }
    function toggleDrawer() { open ? closeDrawer() : openDrawer(); }

    ham.addEventListener('click', toggleDrawer);
    overlay.addEventListener('click', closeDrawer);

    /* Close on nav link click */
    drawer.querySelectorAll('a').forEach(function (a) {
        a.addEventListener('click', function () { if (open) closeDrawer(); });
    });

    /* Escape key */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && open) closeDrawer();
    });

    /* ── Scroll: add .scrolled + sync drawer top ── */
    function syncDrawerTop() {
        var scrolled = window.scrollY > 10;
        nb.classList.toggle('scrolled', scrolled);
        drawer.style.top = scrolled ? '66px' : '80px';
    }
    window.addEventListener('scroll', syncDrawerTop, { passive: true });
    syncDrawerTop(); // run once on load

    /* ── Desktop dropdowns (click + keyboard) ── */
    document.querySelectorAll('.nb-drop').forEach(function (drop) {
        var btn = drop.querySelector('.nb-drop-btn');
        var leaveTimeout = null;

        function openDrop() {
            if (leaveTimeout) {
                clearTimeout(leaveTimeout);
                leaveTimeout = null;
            }
            // close others
            document.querySelectorAll('.nb-drop.open').forEach(function (d) {
                if (d !== drop) {
                    d.classList.remove('open');
                    d.querySelector('.nb-drop-btn').setAttribute('aria-expanded', 'false');
                }
            });
            drop.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
        }
        function closeDrop() {
            drop.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
        }
        function toggleDrop() { drop.classList.contains('open') ? closeDrop() : openDrop(); }

        btn.addEventListener('click', toggleDrop);
        btn.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggleDrop(); }
        });

        /* Close when mouse leaves the whole drop (with brief delay to bridge gaps) */
        drop.addEventListener('mouseleave', function () {
            if (window.innerWidth >= 992) {
                leaveTimeout = setTimeout(closeDrop, 250);
            } else {
                closeDrop();
            }
        });

        /* Open on hover for desktop (cancelling close timeouts) */
        drop.addEventListener('mouseenter', function () {
            if (leaveTimeout) {
                clearTimeout(leaveTimeout);
                leaveTimeout = null;
            }
            if (window.innerWidth >= 992) openDrop();
        });
    });

    /* Close dropdowns clicking elsewhere */
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.nb-drop')) {
            document.querySelectorAll('.nb-drop.open').forEach(function (d) {
                d.classList.remove('open');
                d.querySelector('.nb-drop-btn').setAttribute('aria-expanded', 'false');
            });
        }
    });
})();
</script>
