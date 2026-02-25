<nav class="navbar navbar-expand-lg fixed-top navbar-glass py-3">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center mb-0 text-decoration-none" style="padding: 0;">
            <!-- Icon Wrapper -->
            <div class="me-2 d-flex align-items-center justify-content-center shadow-sm" 
                 style="width: 44px; height: 44px; background: linear-gradient(135deg, rgba(79,70,229,0.1), rgba(236,72,153,0.1)); border-radius: 12px; border: 1px solid rgba(79,70,229,0.15);">
                <i class="fas fa-layer-group fs-5" 
                   style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
            </div>
            <!-- Text Details -->
            <div class="d-flex flex-column justify-content-center">
                <span class="fw-bolder" style="font-size: 1.45rem; letter-spacing: -0.5px; line-height: 1;">
                    <span style="color: var(--dark-bg) !important;">Edu</span><span style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Core</span>
                </span>
                <span class="fw-bold" style="font-size: 0.65rem; letter-spacing: 1px; text-transform: uppercase; margin-top: 3px; display: flex; align-items: center; color: var(--text-muted) !important;">
                    <span style="display: inline-block; width: 12px; height: 2px; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); border-radius: 2px; margin-right: 6px;"></span>
                    EnGenius DigiTech
                </span>
            </div>
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-3 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link fw-semibold px-2 {{ request()->is('/') ? 'text-primary' : 'text-secondary' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link fw-semibold px-2 {{ request()->routeIs('about') ? 'text-primary' : 'text-secondary' }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pricing') }}" class="nav-link fw-semibold px-2 {{ request()->routeIs('pricing') ? 'text-primary' : 'text-secondary' }}">Pricing</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link fw-semibold px-2 {{ request()->routeIs('contact') ? 'text-primary' : 'text-secondary' }}">Contact Us</a>
                </li>
                
                @if (Route::has('login'))
                    @auth
                        @if(auth()->user()->isSuperAdmin())
                            <li class="nav-item"><a href="{{ route('superadmin.dashboard') }}" class="btn btn-primary-glow btn-modern py-2 px-4 shadow-sm">Super Admin Panel</a></li>
                        @else
                            <li class="nav-item"><a href="{{ url('/dashboard') }}" class="btn btn-primary-glow btn-modern py-2 px-4 shadow-sm">Institute Dashboard</a></li>
                        @endif
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-outline-modern btn-modern py-2 px-4">Log in</a></li>
                        <li class="nav-item"><a href="{{ route('pricing') }}" class="btn btn-primary-glow btn-modern py-2 px-4">Start Free Trial</a></li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
