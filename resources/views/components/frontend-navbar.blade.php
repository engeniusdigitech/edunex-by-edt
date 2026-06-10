<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

/* ══════════════════════════════════
   NAVBAR BASE
══════════════════════════════════ */
#nb {
    position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
    font-family: 'Inter', system-ui, sans-serif;
    transition: all 0.3s ease;
}
.nb-bar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 48px; height: 110px;
    transition: all 0.3s ease;
}
#nb.scrolled .nb-bar {
    height: 85px;
    background: hsla(222,47%,7%,0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid hsl(217,33%,16%);
    box-shadow: 0 4px 30px rgba(0,0,0,0.2);
}

/* Brand */
.nb-logo { display: flex; align-items: center; gap: 8px; text-decoration: none; z-index: 1010; position: relative; }
.nb-logo img { display: block; transition: height 0.3s; }

/* ── DESKTOP NAV ── */
.nb-desktop {
    display: flex; align-items: center; gap: 6px;
    margin-left: 50px;
}
.nb-desktop a {
    font-size: 0.95rem; font-weight: 500;
    color: hsl(215,20%,65%); text-decoration: none;
    padding: 8px 16px; border-radius: 8px;
    transition: color 0.2s, background 0.2s;
    white-space: nowrap;
}
.nb-desktop a:hover { color: #fff; background: rgba(255,255,255,0.07); }
.nb-desktop a.active { color: hsl(174,72%,56%); font-weight: 600; }
.nb-dropdown {
    position: relative;
}
.nb-drop-trigger {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 0.95rem; font-weight: 500;
    color: hsl(215,20%,65%);
    padding: 8px 16px; border-radius: 8px;
    cursor: pointer; white-space: nowrap;
    transition: color 0.2s, background 0.2s;
}
.nb-drop-trigger:hover,
.nb-dropdown:focus-within .nb-drop-trigger,
.nb-dropdown:hover .nb-drop-trigger {
    color: #fff; background: rgba(255,255,255,0.07);
}
.nb-drop-trigger.active { color: hsl(174,72%,56%); font-weight: 600; }
.nb-drop-trigger i { font-size: 0.68rem; transition: transform 0.2s; }
.nb-dropdown:hover .nb-drop-trigger i,
.nb-dropdown:focus-within .nb-drop-trigger i { transform: rotate(180deg); }
.nb-menu {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    min-width: 190px;
    padding: 8px;
    border-radius: 12px;
    background: hsla(222,47%,7%,0.98);
    border: 1px solid hsl(217,33%,17%);
    box-shadow: 0 18px 40px rgba(0,0,0,0.28);
    opacity: 0;
    visibility: hidden;
    transform: translateY(8px);
    transition: opacity 0.18s, transform 0.18s, visibility 0.18s;
}
.nb-dropdown:hover .nb-menu,
.nb-dropdown:focus-within .nb-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}
.nb-desktop .nb-menu a {
    display: flex;
    align-items: center;
    gap: 9px;
    width: 100%;
    padding: 10px 12px;
    font-size: 0.86rem;
    border-radius: 8px;
}
.nb-desktop .nb-menu a i {
    width: 16px;
    color: hsl(174,72%,56%);
    text-align: center;
}

/* ── DESKTOP BUTTONS ── */
.nb-ctas { display: flex; align-items: center; gap: 12px; }
.nb-ctas a, .nb-ctas button {
    display: inline-flex; align-items: center; gap: 8px;
    font-family: 'Inter', system-ui, sans-serif;
    font-size: 0.88rem; font-weight: 600;
    padding: 10px 20px; border-radius: 9px;
    text-decoration: none; cursor: pointer; border: none;
    transition: all 0.2s; white-space: nowrap; line-height: 1.2;
}
.nb-ghost {
    background: rgba(255,255,255,0.06);
    color: hsl(215,20%,65%) !important;
    border: 1px solid hsl(217,33%,17%);
}
.nb-ghost:hover { background: rgba(255,255,255,0.11); color: #fff !important; }
.nb-solid {
    background: linear-gradient(135deg,hsl(174,72%,56%),hsl(217,91%,60%));
    color: hsl(222,47%,6%) !important; font-weight: 500;
    box-shadow: 0 0 16px hsla(174,72%,56%,0.3);
}
.nb-solid:hover { opacity: 0.88; transform: translateY(-1px); color: hsl(222,47%,6%) !important; }
.nb-red {
    background: rgba(239,68,68,0.1);
    color: #f87171 !important;
    border: 1px solid rgba(239,68,68,0.2);
}
.nb-red:hover { background: rgba(239,68,68,0.18); color: #fca5a5 !important; }

/* ══════════════════════════════════
   HAMBURGER BUTTON
══════════════════════════════════ */
.nb-ham {
    display: none;
    width: 50px; height: 50px;
    background: rgba(255,255,255,0.06);
    border: 1px solid hsl(217,33%,18%);
    border-radius: 12px;
    cursor: pointer;
    flex-direction: column;
    align-items: center; justify-content: center;
    gap: 5.5px;
    z-index: 1010; position: relative;
    transition: background 0.2s;
    flex-shrink: 0;
}
.nb-ham:hover { background: rgba(255,255,255,0.1); }
.nb-ham span {
    display: block;
    width: 18px; height: 2px;
    border-radius: 2px;
    background: hsl(174,72%,56%);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: center;
}
/* X state */
body.nb-open .nb-ham span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
body.nb-open .nb-ham span:nth-child(2) { opacity: 0; transform: scaleX(0); }
body.nb-open .nb-ham span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* ══════════════════════════════════
   FULL-SCREEN MOBILE MENU
══════════════════════════════════ */
.nb-mobile-menu {
    display: none; /* shown only on mobile */
    position: fixed; inset: 0; z-index: 999;
    background: hsl(222,47%,6%);
    flex-direction: column;
    padding-top: 95px; /* below navbar */
    opacity: 0;
    transform: translateY(-12px);
    transition: opacity 0.3s ease, transform 0.3s ease;
    pointer-events: none;
    overflow-y: auto;
    overscroll-behavior: contain;
}
.nb-mobile-menu.open {
    opacity: 1;
    transform: translateY(0);
    pointer-events: all;
}

/* Gradient accent line at top */
.nb-mobile-menu::before {
    content: '';
    display: block;
    height: 2px;
    background: linear-gradient(90deg, hsl(174,72%,56%), hsl(217,91%,60%));
    position: absolute;
    top: 0; left: 0; right: 0;
}

/* Mobile links */
.nb-mobile-links {
    padding: 32px 28px 0;
    padding-left: 40px;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.nb-mobile-links a {
    display: flex; align-items: center; justify-content: center; gap: 12px;
    width: 100%; max-width: 320px;
    padding: 17px 12px;
    font-size: 1.25rem; font-weight: 600; letter-spacing: -0.3px;
    color: hsl(215,20%,70%); text-decoration: none; text-align: center;
    border-bottom: 1px solid hsla(217,33%,17%,0.6);
    opacity: 0; transform: translateY(12px);
    transition: opacity 0.32s ease, transform 0.32s ease, color 0.2s;
}
.nb-mobile-menu.open .nb-mobile-links a { opacity: 1; transform: translateY(0); }
.nb-mobile-menu.open .nb-mobile-links a:nth-child(1) { transition-delay: 0.06s; }
.nb-mobile-menu.open .nb-mobile-links a:nth-child(2) { transition-delay: 0.10s; }
.nb-mobile-menu.open .nb-mobile-links a:nth-child(3) { transition-delay: 0.14s; }
.nb-mobile-menu.open .nb-mobile-links a:nth-child(4) { transition-delay: 0.18s; }
.nb-mobile-menu.open .nb-mobile-links a:nth-child(5) { transition-delay: 0.22s; }

.nb-mobile-links a:last-child { border-bottom: none; }
.nb-mobile-links a:hover { color: #fff; }
.nb-mobile-links a.active { color: hsl(174,72%,60%); }
.nb-mobile-links a .nb-arr {
    font-size: 0.7rem; color: hsl(215,20%,35%);
    transition: transform 0.2s, color 0.2s;
}
.nb-mobile-links a:hover .nb-arr,
.nb-mobile-links a.active .nb-arr {
    transform: translateX(3px);
    color: hsl(174,72%,56%);
}

/* Mobile CTA buttons */
.nb-mobile-ctas {
    padding: 24px 24px 40px;
    display: flex; flex-direction: column; gap: 10px;
    border-top: 1px solid hsl(217,33%,16%);
    opacity: 0; transform: translateY(10px);
    transition: opacity 0.3s 0.28s ease, transform 0.3s 0.28s ease;
}
.nb-mobile-menu.open .nb-mobile-ctas { opacity: 1; transform: translateY(0); }
.nb-mobile-ctas a, .nb-mobile-ctas button {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    font-family: 'Inter', system-ui, sans-serif;
    font-size: 0.95rem; font-weight: 600;
    padding: 14px 20px; border-radius: 12px;
    text-decoration: none; cursor: pointer; border: none;
    transition: all 0.2s; width: 100%;
}
.nb-mobile-ctas .nb-solid {
    background: linear-gradient(135deg,hsl(174,72%,56%),hsl(217,91%,60%));
    color: hsl(222,47%,6%) !important; font-weight: 500;
    box-shadow: 0 0 24px hsla(174,72%,56%,0.3);
}
.nb-mobile-ctas .nb-ghost {
    background: rgba(255,255,255,0.05);
    color: hsl(215,20%,65%) !important;
    border: 1px solid hsl(217,33%,18%);
}
.nb-mobile-ctas .nb-red {
    background: rgba(239,68,68,0.1);
    color: #f87171 !important;
    border: 1px solid rgba(239,68,68,0.2);
}

/* ══════════════════════════════════
   RESPONSIVE BREAKPOINTS
══════════════════════════════════ */
@media(max-width: 991px) {
    .nb-desktop { display: none; }
    .nb-ctas    { display: none; }
    .nb-ham     { display: flex; }
    .nb-mobile-menu { display: flex; }
    .nb-bar { padding: 0 28px; }
}
@media(min-width: 992px) {
    .nb-mobile-menu { display: none !important; }
}
</style>

<div id="nb">
    <div class="nb-bar">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="nb-logo">
            <img src="{{ asset('images/logo.png') }}"      alt="EduNex ERP" style="height:64px;">
            <img src="{{ asset('images/logo-name.png') }}" alt="EduNex ERP" style="height:44px; margin-left:8px;">
        </a>

        {{-- Desktop nav links --}}
        <nav class="nb-desktop">
            <a href="{{ url('/') }}"         class="{{ request()->is('/')            ? 'active' : '' }}">Home</a>
            <div class="nb-dropdown">
                <div class="nb-drop-trigger {{ request()->is('engenius-digitech*') ? 'active' : '' }}" tabindex="0">
                    Engenius Digitech <i class="fas fa-chevron-down"></i>
                </div>
                <div class="nb-menu">
                    <a href="https://engeniusdigitech.netlify.app" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-link"></i> Engenius Digitech
                    </a>
                    <a href="{{ asset('about') }}">
                        <i class="fas fa-building"></i> About EduNex ERP
                    </a>
                    <a href="{{ asset('blog') }}">
                        <i class="fas fa-file"></i> Blog 
                    </a>
                </div>
            </div>
            <a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">Pricing</a>
            <div class="nb-dropdown">
                <div class="nb-drop-trigger {{ request()->is('edunex-erp-brochure*') ? 'active' : '' }}" tabindex="0">
                    Brochure <i class="fas fa-chevron-down"></i>
                </div>
                <div class="nb-menu">
                    <a href="{{ asset('edunex-erp-brochure.html') }}">
                        <i class="fas fa-eye"></i> View Brochure
                    </a>
                    <a href="{{ asset('edunex-erp-brochure.pdf') }}" download>
                        <i class="fas fa-file-arrow-down"></i> Download PDF
                    </a>
                </div>
            </div>
            <div class="nb-dropdown">
                <div class="nb-drop-trigger {{ request()->routeIs('digital.assessment') || request()->routeIs('features.*') ? 'active' : '' }}" tabindex="0">
                    What's New <i class="fas fa-chevron-down"></i>
                </div>
                <div class="nb-menu" style="min-width: 260px;">
                    <a href="{{ route('digital.assessment') }}">
                        <i class="fas fa-laptop-code"></i> Online Assessment
                    </a>
                    <a href="{{ route('features.visitor-gate') }}">
                        <i class="fas fa-id-badge"></i> Visitor Gate Security
                    </a>
                    <a href="{{ route('features.tally-accounting') }}">
                        <i class="fas fa-calculator"></i> Tally Sync Accounting
                    </a>
                    <a href="{{ route('features.transit-tracking') }}">
                        <i class="fas fa-map-location-dot"></i> Live GPS Transit Maps
                    </a>
                    <a href="{{ route('features.statutory-payroll') }}">
                        <i class="fas fa-file-invoice-dollar"></i> Statutory Payroll
                    </a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
        </nav>

        {{-- Desktop CTA --}}
        <div class="nb-ctas">
            @if(Route::has('login'))
                @if(auth()->guard('student')->check())
                    <a href="{{ route('student.dashboard') }}" class="nb-solid">Dashboard</a>
                    <form method="POST" action="{{ route('student.logout') }}" style="margin:0;">@csrf
                        <button type="submit" class="nb-red">Logout</button>
                    </form>
                @elseif(auth()->check())
                    @if(auth()->user()->isSuperAdmin())
                        <a href="{{ route('superadmin.dashboard') }}" class="nb-solid">Admin Panel</a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="nb-solid">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">@csrf
                        <button type="submit" class="nb-red">Logout</button>
                    </form>
                @else
                    <a href="{{ route('student.login') }}" class="nb-ghost">Student Login</a>
                    <a href="{{ route('login') }}"         class="nb-ghost">Log in</a>
                    <a href="{{ route('pricing') }}"       class="nb-solid">Start Free Trial</a>
                @endif
            @endif
        </div>

        {{-- Hamburger (mobile) --}}
        <button class="nb-ham" id="nbHam" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</div>

{{-- Full-screen mobile menu --}}
<div class="nb-mobile-menu" id="nbMobileMenu">
    <div class="nb-mobile-links">
        <a href="{{ url('/') }}"         class="{{ request()->is('/')            ? 'active' : '' }}">Home         <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ route('about') }}"   class="{{ request()->routeIs('about')   ? 'active' : '' }}">About Us     <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">Pricing      <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ route('digital.assessment') }}" class="{{ request()->routeIs('digital.assessment') ? 'active' : '' }}">Online Assessment <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ route('features.visitor-gate') }}" class="{{ request()->routeIs('features.visitor-gate') ? 'active' : '' }}">Visitor Gate Security <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ route('features.tally-accounting') }}" class="{{ request()->routeIs('features.tally-accounting') ? 'active' : '' }}">Tally Sync Accounting <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ route('features.transit-tracking') }}" class="{{ request()->routeIs('features.transit-tracking') ? 'active' : '' }}">Live GPS Transit Maps <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ route('features.statutory-payroll') }}" class="{{ request()->routeIs('features.statutory-payroll') ? 'active' : '' }}">Statutory Payroll <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ asset('edunex-erp-brochure.html') }}" class="{{ request()->is('edunex-erp-brochure.html') ? 'active' : '' }}">View Brochure <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ asset('edunex-erp-brochure.pdf') }}" download>Download PDF <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ route('blogs') }}"   class="{{ request()->routeIs('blogs')   ? 'active' : '' }}">Blogs        <i class="fas fa-arrow-right nb-arr"></i></a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us   <i class="fas fa-arrow-right nb-arr"></i></a>
    </div>

    <div class="nb-mobile-ctas">
        @if(Route::has('login'))
            @if(auth()->guard('student')->check())
                <a href="{{ route('student.dashboard') }}" class="nb-solid">
                    <i class="fas fa-gauge-high"></i> Student Dashboard
                </a>
                <form method="POST" action="{{ route('student.logout') }}" style="margin:0;">@csrf
                    <button type="submit" class="nb-red"><i class="fas fa-right-from-bracket"></i> Logout</button>
                </form>
            @elseif(auth()->check())
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('superadmin.dashboard') }}" class="nb-solid">
                        <i class="fas fa-shield-halved"></i> Admin Panel
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}" class="nb-solid">
                        <i class="fas fa-gauge-high"></i> Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">@csrf
                    <button type="submit" class="nb-red"><i class="fas fa-right-from-bracket"></i> Logout</button>
                </form>
            @else
                <a href="{{ route('pricing') }}" class="nb-solid">
                    <i class="fas fa-rocket"></i> Start Free Trial
                </a>
                <a href="{{ route('login') }}" class="nb-ghost">
                    <i class="fas fa-right-to-bracket"></i> Staff Log in
                </a>
                <a href="{{ route('student.login') }}" class="nb-ghost">
                    <i class="fas fa-user-graduate"></i> Student Login
                </a>
            @endif
        @endif
    </div>
</div>

<script>
(function(){
    var nb  = document.getElementById('nb');
    var ham = document.getElementById('nbHam');
    var menu= document.getElementById('nbMobileMenu');
    var open= false;

    function toggleMenu(){
        open = !open;
        if(open){
            menu.classList.add('open');
            document.body.classList.add('nb-open');
            document.body.style.overflow = 'hidden';
        } else {
            menu.classList.remove('open');
            document.body.classList.remove('nb-open');
            document.body.style.overflow = '';
        }
    }

    ham.addEventListener('click', toggleMenu);

    // Close on link click
    menu.querySelectorAll('a').forEach(function(a){
        a.addEventListener('click', function(){
            if(open) toggleMenu();
        });
    });

    // Escape key
    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape' && open) toggleMenu();
    });

    // Scroll → scrolled class
    window.addEventListener('scroll', function(){
        nb.classList.toggle('scrolled', window.scrollY > 10);
    }, { passive: true });
    if(window.scrollY > 10) nb.classList.add('scrolled');
})();
</script>
