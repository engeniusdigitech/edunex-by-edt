<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - EduCore & Engenius Digitech</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #EC4899;
            --dark-bg: #0F172A;
            --text-main: #1E293B;
            --text-muted: #64748B;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            background-color: #FAFAF9;
            overflow-x: hidden;
        }

        /* Glassmorphic Navbar */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }

        .btn-modern {
            padding: 10px 24px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
        }

        .btn-outline-modern {
            background: white;
            color: var(--text-main);
            border: 1px solid #E2E8F0;
        }

        .btn-outline-modern:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .page-header {
            padding: 160px 0 80px;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.05), rgba(236, 72, 153, 0.05));
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .page-title {
            font-size: 3.5rem;
            font-weight: 800;
            letter-spacing: -1px;
            color: var(--dark-bg);
            margin-bottom: 1rem;
        }

        /* Footer */
        .footer {
            background: var(--dark-bg);
            color: white;
            padding: 80px 0 40px;
        }
        .footer-brand {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>
<body class="antialiased">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-glass py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="fas fa-layer-group me-2 fs-3 text-primary"></i> 
                EduCore
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

    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title animate__animated animate__fadeInUp">Our Story</h1>
            <p class="fs-5 text-muted max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s" style="max-width: 700px;">
                EduCore is built and maintained by <strong>Engenius Digitech</strong>. We empower innovation and craft digital excellence for modern educational institutes.
            </p>
        </div>
    </div>

    <section class="py-5 my-5">
        <div class="container py-4">
            <div class="row align-items-center mb-5 pb-5 border-bottom">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Team meeting" class="img-fluid rounded-4 shadow-lg">
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <h2 class="fw-bold mb-4" style="color: var(--dark-bg);">Empowering Innovation</h2>
                    <p class="fs-5 text-muted mb-4">At Engenius Digitech, we partner with founders and teams to design, build, and scale modern software tailored to solve real-world problems.</p>
                    <p class="text-muted">EduCore is born out of the necessity to streamline the chaotic nature of coaching management. We combined our deep expertise in software development with top-tier design to bring you a platform that doesn't just work—it delights.</p>
                    
                    <a href="https://engeniusdigitech.netlify.app/" target="_blank" class="btn btn-outline-primary mt-3 rounded-pill px-4 fw-semibold border-2">
                        Visit Engenius Digitech <i class="fas fa-external-link-alt ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="row pt-4 text-center">
                <div class="col-12 mb-5">
                    <h3 class="fw-bold">Why choose EduCore?</h3>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100 border">
                        <i class="fas fa-code fa-3x text-primary mb-3"></i>
                        <h5 class="fw-bold">Modern Tech Stack</h5>
                        <p class="text-muted small">Built on robust frameworks ensuring unmatched speed, security, and multi-tenant data isolation.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100 border">
                        <i class="fas fa-paint-brush fa-3x text-pink mb-3" style="color: var(--secondary-color);"></i>
                        <h5 class="fw-bold">Premium Design</h5>
                        <p class="text-muted small">We believe B2B software doesn't have to be ugly. Experience a beautiful, intuitive interface.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100 border">
                        <i class="fas fa-headset fa-3x text-success mb-3"></i>
                        <h5 class="fw-bold">Expert Support</h5>
                        <p class="text-muted small">Backed directly by the senior talent at Engenius Digitech. We succeed when you succeed.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center text-md-start">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="footer-brand"><i class="fas fa-layer-group me-2"></i> EduCore</div>
                    <p class="footer-text text-white-50 mb-0">Elevating coaching management software.<br>A product by <a href="https://engeniusdigitech.netlify.app/" target="_blank" class="text-white fw-bold text-decoration-none border-bottom border-light pb-1">Engenius Digitech</a>.</p>
                </div>
                <div class="col-md-6 text-md-end footer-text">
                    <a href="{{ route('about') }}" class="text-decoration-none text-white opacity-75 me-3 hover-opacity-100">About Us</a>
                    <a href="{{ route('pricing') }}" class="text-decoration-none text-white opacity-75 me-3 hover-opacity-100">Pricing</a>
                    <a href="{{ route('contact') }}" class="text-decoration-none text-white opacity-75 me-3 hover-opacity-100">Contact Us</a>
                    <a href="#" class="text-decoration-none text-white opacity-75 hover-opacity-100">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translate3d(0, 40px, 0); }
            to { opacity: 1; transform: translate3d(0, 0, 0); }
        }
        .animate__fadeInUp { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
        .animate__delay-1s { animation-delay: 0.2s; }
    </style>
</body>
</html>
