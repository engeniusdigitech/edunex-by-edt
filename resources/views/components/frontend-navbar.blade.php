<nav id="frontend-navbar" class="navbar navbar-expand-lg fixed-top navbar-glass py-3">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center mb-0 text-decoration-none"
            style="padding: 0;">
            <img src="{{ asset('images/logo.png') }}" alt="EduCore Logo" class="img-fluid" style="max-height: 65px;">
        </a>
        
        <button class="navbar-toggler custom-toggler border-0 shadow-none p-2" type="button" 
            id="mobileMenuToggle" aria-label="Toggle navigation">
            <div class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <div class="collapse navbar-collapse luxury-drawer" id="navbarNav">
            {{-- Mobile Close Button (Corner) --}}
            <div class="d-lg-none p-3 text-end">
                <button class="btn-close-drawer" type="button" id="closeDrawer">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <ul class="navbar-nav ms-auto align-items-center gap-3 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a href="{{ url('/') }}"
                        class="nav-link fw-semibold px-2 {{ request()->is('/') ? 'text-primary' : 'text-secondary' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about') }}"
                        class="nav-link fw-semibold px-2 {{ request()->routeIs('about') ? 'text-primary' : 'text-secondary' }}">About
                        Us</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pricing') }}"
                        class="nav-link fw-semibold px-2 {{ request()->routeIs('pricing') ? 'text-primary' : 'text-secondary' }}">Pricing</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}"
                        class="nav-link fw-semibold px-2 {{ request()->routeIs('contact') ? 'text-primary' : 'text-secondary' }}">Contact
                        Us</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('blogs') }}"
                        class="nav-link fw-semibold px-2 {{ request()->routeIs('blogs') ? 'text-primary' : 'text-secondary' }}">Blogs</a>
                </li>

                @if (Route::has('login'))
                    @if(auth()->guard('student')->check())
                        <li class="nav-item"><a href="{{ route('student.dashboard') }}"
                                class="btn btn-primary-glow btn-modern py-2 px-4 shadow-sm w-100 w-lg-auto">Student Dashboard</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('student.logout') }}" class="m-0 w-100 w-lg-auto">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-modern py-2 px-4 w-100 w-lg-auto">Logout</button>
                            </form>
                        </li>
                    @elseif(auth()->check())
                        @if(auth()->user()->isSuperAdmin())
                            <li class="nav-item"><a href="{{ route('superadmin.dashboard') }}"
                                    class="btn btn-primary-glow btn-modern py-2 px-4 shadow-sm w-100 w-lg-auto">Admin Panel</a></li>
                        @else
                            <li class="nav-item"><a href="{{ url('/dashboard') }}"
                                    class="btn btn-primary-glow btn-modern py-2 px-4 shadow-sm w-100 w-lg-auto">Dashboard</a></li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="m-0 w-100 w-lg-auto">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-modern py-2 px-4 w-100 w-lg-auto">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item btn-group-desktop w-100 w-lg-auto d-flex flex-column flex-lg-row">
                            <a href="{{ route('student.login') }}"
                                class="btn btn-student-portal btn-modern w-100 w-lg-auto">Student Login</a>
                            <a href="{{ route('login') }}"
                                class="btn btn-outline-modern btn-modern w-100 w-lg-auto">Log in</a>
                            <a href="{{ route('pricing') }}"
                                class="btn btn-primary-glow btn-modern w-100 w-lg-auto">Start Free Trial</a>
                        </li>
                    @endif
                @endif
            </ul>
            
            {{-- Mobile Footer Info --}}
            <div class="d-lg-none mt-auto p-4 text-center">
                <p class="text-muted small mb-0">© {{ date('Y') }} EduNex. Best Institute Management Software</p>
            </div>
        </div>
    </div>
</nav>

{{-- Backdrop Overlay --}}
<div class="nav-overlay" id="navOverlay"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('frontend-navbar');
        const toggler = document.getElementById('mobileMenuToggle');
        const drawer = document.getElementById('navbarNav');
        const overlay = document.getElementById('navOverlay');
        const closeBtn = document.getElementById('closeDrawer');
        
        function handleScroll() {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        function toggleMenu() {
            const isOpen = navbar.classList.contains('menu-open');
            if (isOpen) {
                navbar.classList.remove('menu-open');
                drawer.classList.remove('show');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                navbar.classList.add('menu-open');
                drawer.classList.add('show');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        toggler.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
        closeBtn.addEventListener('click', toggleMenu);
        
        // Handle nav link clicks (close drawer)
        document.querySelectorAll('.luxury-drawer .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (navbar.classList.contains('menu-open')) toggleMenu();
            });
        });

        window.addEventListener('scroll', handleScroll);
        handleScroll();
    });
</script>