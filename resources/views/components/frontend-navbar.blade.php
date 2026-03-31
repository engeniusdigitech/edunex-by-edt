<nav id="frontend-navbar" class="navbar navbar-expand-lg fixed-top navbar-glass py-3">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center mb-0 text-decoration-none"
            style="padding: 0;">
            <img src="{{ asset('images/logo.png') }}" alt="EduCore Logo" class="img-fluid" style="max-height: 65px;">
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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
                                class="btn btn-primary-glow btn-modern py-2 px-4 shadow-sm">Student Dashboard</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('student.logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-modern py-2 px-4">Logout</button>
                            </form>
                        </li>
                    @elseif(auth()->check())
                        @if(auth()->user()->isSuperAdmin())
                            <li class="nav-item"><a href="{{ route('superadmin.dashboard') }}"
                                    class="btn btn-primary-glow btn-modern py-2 px-4 shadow-sm">Super Admin Panel</a></li>
                        @else
                            <li class="nav-item"><a href="{{ url('/dashboard') }}"
                                    class="btn btn-primary-glow btn-modern py-2 px-4 shadow-sm">Institute Dashboard</a></li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-modern py-2 px-4">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('student.login') }}"
                                class="btn btn-outline-modern btn-modern py-2 px-4 shadow-sm">Student Login</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('login') }}"
                                class="btn btn-outline-modern btn-modern py-2 px-4">Log in</a></li>
                        <li class="nav-item"><a href="{{ route('pricing') }}"
                                class="btn btn-primary-glow btn-modern py-2 px-4">Start Free Trial</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('frontend-navbar');
        
        function handleScroll() {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Initial check
    });
</script>