<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing - EduCore</title>
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
            font-size: 1rem;
        }

        .btn-primary-glow {
            background: linear-gradient(135deg, var(--primary-color), #6366F1);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        }

        .btn-primary-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(79, 70, 229, 0.5);
            color: white;
        }

        .btn-outline-modern {
            background: white;
            color: var(--text-main);
            border: 1px solid #E2E8F0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .btn-outline-modern:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
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

        /* Pricing Cards */
        .pricing-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            border: 1px solid #F1F5F9;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.03);
            transition: all 0.4s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .pricing-card.popular {
            border-color: var(--primary-color);
            box-shadow: 0 20px 50px -10px rgba(79, 70, 229, 0.15);
            transform: translateY(-10px);
        }

        .pricing-badge {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 5px 20px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .pricing-price {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--dark-bg);
            margin: 20px 0;
            line-height: 1;
        }

        .pricing-currency {
            font-size: 1.5rem;
            vertical-align: super;
            color: var(--text-muted);
        }

        .pricing-period {
            font-size: 1rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .pricing-features {
            list-style: none;
            padding: 0;
            margin: 30px 0;
            text-align: left;
            flex-grow: 1;
        }

        .pricing-features li {
            margin-bottom: 15px;
            color: var(--text-main);
            display: flex;
            align-items: center;
        }

        .pricing-features li i {
            color: #10B981;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .btn-pricing {
            width: 100%;
            padding: 14px;
            font-size: 1.1rem;
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
    @include('components.frontend-navbar')

    <div class="page-header" style="padding: 160px 0 100px;">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side text -->
                <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0 pe-lg-5">
                    <h1 class="page-title animate__animated animate__fadeInUp">Simple, Transparent Pricing</h1>
                    <p class="fs-5 text-muted animate__animated animate__fadeInUp animate__delay-1s">
                        Choose the perfect plan to scale your educational institute. No hidden fees, cancel anytime.
                    </p>
                </div>
                
                <!-- Right Side pricing card -->
                <div class="col-lg-6">
                    <div class="row justify-content-center">
                        @forelse($plans as $index => $plan)
                        <div class="col-md-10">
                            <div class="pricing-card popular text-center shadow-lg" style="border: 2px solid var(--primary-color);">
                                <div class="pricing-badge">RECOMMENDED</div>
                                
                                <h4 class="fw-bold text-dark">{{ $plan->name }}</h4>
                                <div class="pricing-price">
                                    <span class="pricing-currency">₹</span>{{ number_format($plan->price, 0) }}
                                    <span class="pricing-period">/ {{ $plan->duration_days }} days</span>
                                </div>
                                <p class="text-muted mb-4 border-bottom pb-4">Perfect for growing institutes to manage their operations efficiently.</p>
                                
                                <ul class="pricing-features">
                                    <li><i class="fas fa-check-circle"></i> Unlimited Students Enrollment</li>
                                    <li><i class="fas fa-check-circle"></i> Bulk Attendance Tracking</li>
                                    <li><i class="fas fa-check-circle"></i> Complete Fee Management</li>
                                    <li><i class="fas fa-check-circle"></i> Student Portal Access</li>
                                    <li><i class="fas fa-check-circle"></i> Exportable PDF Reports</li>
                                    <li><i class="fas fa-check-circle"></i> Priority Support</li>
                                </ul>
                                
                                <a href="{{ route('trial.request', ['plan' => $plan->name]) }}" class="btn btn-modern btn-pricing btn-primary text-white mt-3" style="background: linear-gradient(135deg, var(--primary-color), #6366F1); border: none;">
                                    Get Started
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info border-0 shadow-sm rounded-4 p-4 text-center">
                                <i class="fas fa-info-circle fa-2x mb-3 text-info"></i>
                                <h5>Pricing plans are currently being updated.</h5>
                                <p class="mb-0">Please check back soon or contact support for customized enterprise pricing.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <a href="{{ route('contact') }}" class="text-decoration-none text-white opacity-75 me-3 hover-opacity-100">Contact Us</a>
                    <a href="#" class="text-decoration-none text-white opacity-75 me-3 hover-opacity-100">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .hover-opacity-100 { transition: opacity 0.3s; }
        .hover-opacity-100:hover { opacity: 1 !important; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translate3d(0, 40px, 0); }
            to { opacity: 1; transform: translate3d(0, 0, 0); }
        }
        .animate__fadeInUp { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
        .animate__delay-1s { animation-delay: 0.2s; }
    </style>
</body>
</html>
