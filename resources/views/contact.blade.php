<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us — EduNex & Engenius Digitech</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-light: #6366F1;
            --secondary-color: #EC4899;
            --dark-bg: #0F172A;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            background-color: #ffffff;
            overflow-x: hidden;
        }

        /* ── MESH GRADIENT BACKGROUNDS ── */
        .mesh-bg {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -1;
            overflow: hidden;
        }
        .mesh-circle-1 {
            position: absolute; top: -10%; left: -10%;
            width: 60%; height: 60%;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.05), transparent 70%);
            filter: blur(80px);
        }
        .mesh-circle-2 {
            position: absolute; bottom: -10%; right: -10%;
            width: 50%; height: 50%;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.04), transparent 70%);
            filter: blur(80px);
        }

        /* ── NAVBAR ── */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* ── PAGE HEADER ── */
        .page-header {
            padding: 180px 0 100px;
            position: relative;
        }
        .section-tag {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 16px;
            display: block;
        }
        .page-title {
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            font-weight: 900;
            letter-spacing: -2px;
            color: var(--dark-bg);
            line-height: 1.1;
        }
        .page-title span {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ── CONTACT CONTAINER ── */
        .contact-container {
            background: #ffffff;
            border-radius: 40px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            box-shadow: 0 40px 100px -20px rgba(0,0,0,0.1);
        }

        /* ── FORM STYLING ── */
        .contact-form-side {
            padding: 60px;
        }
        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text-main);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .form-control, .form-select {
            padding: 16px 20px;
            border-radius: 16px;
            border: 1.5px solid var(--border-color);
            background: #F8FAFC;
            font-weight: 500;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            background: #ffffff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        /* ── INFO SIDE ── */
        .contact-info-side {
            background: var(--dark-bg);
            padding: 60px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            height: 100%;
        }
        .contact-info-side::before {
            content: '';
            position: absolute; top: -50%; right: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.1), transparent 70%);
        }

        .info-pill {
            background: rgba(255,255,255,0.05);
            border-radius: 20px;
            padding: 24px;
            border: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        .info-pill:hover {
            background: rgba(255,255,255,0.08);
            transform: translateX(5px);
        }
        .info-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: var(--primary-color);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 16px;
        }

        /* ── BUTTONS ── */
        .btn-modern {
            padding: 16px 36px;
            font-weight: 700;
            border-radius: 18px;
            transition: all 0.3s;
            font-size: 1.05rem;
        }
        .btn-primary-glow {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
            border: none;
        }
        .btn-primary-glow:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px -5px rgba(79, 70, 229, 0.5);
            color: white;
        }

        /* ── FOOTER ── */
        .footer {
            background: #ffffff;
            padding: 80px 0 40px;
            border-top: 1px solid var(--border-color);
        }
        .footer-logo { font-size: 1.8rem; font-weight: 900; color: var(--primary-color); }
        .footer-link { color: var(--text-muted); text-decoration: none; font-weight: 500; transition: color 0.3s; }
        .footer-link:hover { color: var(--primary-color); }

    </style>
</head>
<body>

    <div class="mesh-bg">
        <div class="mesh-circle-1"></div>
        <div class="mesh-circle-2"></div>
    </div>

    <!-- Navigation -->
    @include('components.frontend-navbar')

    <!-- Page Header -->
    <header class="page-header text-center">
        <div class="container px-4">
            <span class="section-tag animate__animated animate__fadeInDown">Get in Touch</span>
            <h1 class="page-title animate__animated animate__zoomIn">
                Let's start your<br>
                <span>digital transformation.</span>
            </h1>
            <p class="text-muted fs-5 mt-4 max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s" style="max-width: 700px;">
                Whether you have a technical question or need a custom enterprise solution, our team at Engenius Digitech is here to help.
            </p>
        </div>
    </header>

    <!-- Main Contact Section -->
    <section class="py-5 mb-5">
        <div class="container px-4 py-4">
            <div class="contact-container animate__animated animate__fadeInUp">
                <div class="row g-0">
                    <!-- Form Side -->
                    <div class="col-lg-7">
                        <div class="contact-form-side">
                            <h3 class="fw-black mb-5">Send us a message</h3>
                            <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Message received! Our team will reach out within 24 hours.');">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" placeholder="Arjun Sharma" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" placeholder="arjun@institute.com" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Inquiry Type</label>
                                        <select class="form-select">
                                            <option>General Sales Inquiry</option>
                                            <option>Partner with us</option>
                                            <option>Technical Support</option>
                                            <option>Custom Enterprise Setup</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Your Message</label>
                                        <textarea class="form-control" rows="5" placeholder="Tell us about your institute and how we can help..." required></textarea>
                                    </div>
                                    <div class="col-12 pt-3">
                                        <button type="submit" class="btn btn-primary-glow btn-modern w-100 py-3">
                                            Submit Message <i class="fas fa-paper-plane ms-2"></i>
                                        </button>
                                        <p class="text-center text-muted small mt-3">We typically respond within 1 business day.</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Info Side -->
                    <div class="col-lg-5">
                        <div class="contact-info-side">
                            <h3 class="fw-black mb-5">Contact Details</h3>
                            
                            <div class="info-pill">
                                <div class="info-icon"><i class="fas fa-headset"></i></div>
                                <h6 class="fw-bold text-white mb-2">Dedicated Support</h6>
                                <p class="text-white-50 small mb-0">For existing clients needing help with their portals.<br><strong>support@edunex.com</strong></p>
                            </div>

                            <div class="info-pill">
                                <div class="info-icon" style="background: var(--secondary-color);"><i class="fas fa-paper-plane"></i></div>
                                <h6 class="fw-bold text-white mb-2">Sales & Partnerships</h6>
                                <p class="text-white-50 small mb-0">For new institutes and customized plans.<br><strong>sales@engeniusdigitech.com</strong></p>
                            </div>

                            <div class="info-pill">
                                <div class="info-icon" style="background: #10B981;"><i class="fas fa-location-dot"></i></div>
                                <h6 class="fw-bold text-white mb-2">Headquarters</h6>
                                <p class="text-white-50 small mb-0">Engenius Digitech, Vadodara,<br>Gujarat, India.</p>
                            </div>

                            <div class="mt-5 pt-4 border-top border-white border-opacity-10">
                                <h6 class="fw-bold text-white-50 small text-uppercase mb-4">Crafted by</h6>
                                <a href="https://engeniusdigitech.netlify.app/" target="_blank" class="text-decoration-none">
                                    <h4 class="text-white fw-black mb-1">Engenius Digitech</h4>
                                    <p class="text-white-50 small">Visit our main portfolio <i class="fas fa-arrow-up-right-from-square ms-1"></i></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Section -->
    <section class="py-5 bg-light">
        <div class="container px-4 py-5 text-center">
            <h2 class="fw-black mb-4">Want a direct demo?</h2>
            <p class="text-muted mb-5 mx-auto" style="max-width: 500px;">Our team can walk you through the entire platform and help you set up your first batch in minutes.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="https://wa.me/91XXXXXXXXXX" target="_blank" class="btn btn-dark btn-modern px-5">
                    <i class="fab fa-whatsapp me-2"></i> WhatsApp Sales
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container px-4">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex" style="max-height: 50px;" class="me-2">
                    </div>
                    <p class="text-muted small mb-4">The ultimate SaaS platform for modern educational institutes. Built by educators, for educators.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="footer-link fs-5"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="footer-link fs-5"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="footer-link fs-5"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h6 class="fw-bold mb-4">Platform</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}#features" class="footer-link small">Features</a></li>
                        <li class="mb-2"><a href="{{ route('pricing') }}" class="footer-link small">Pricing</a></li>
                        <li class="mb-2"><a href="#" class="footer-link small">Live Demo</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h6 class="fw-bold mb-4">Company</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('about') }}" class="footer-link small">About Us</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}" class="footer-link small">Contact</a></li>
                        <li class="mb-2"><a href="#" class="footer-link small">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-4 text-md-end">
                    <h6 class="fw-bold mb-4">Product by</h6>
                    <a href="https://engeniusdigitech.netlify.app/" target="_blank" class="text-decoration-none">
                        <h5 class="fw-black text-dark mb-1">Engenius Digitech</h5>
                        <p class="text-muted small">Specialized in SaaS solutions</p>
                    </a>
                </div>
            </div>
            <div class="border-top mt-5 pt-4 text-center">
                <p class="text-muted small mb-0">© {{ date('Y') }} EduNex. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
