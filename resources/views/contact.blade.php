<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EduCore & Engenius Digitech</title>
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

        /* Contact Form */
        .contact-card {
            background: #fff;
            border-radius: 20px;
            padding: 50px;
            border: 1px solid #F1F5F9;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.03);
            position: relative;
        }

        .contact-info-box {
            background: linear-gradient(135deg, var(--dark-bg), #1E293B);
            color: white;
            border-radius: 20px;
            padding: 50px;
            height: 100%;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .contact-info-icon {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-right: 20px;
            margin-top: 5px;
        }

        .form-control, .form-select {
            padding: 14px 20px;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            background-color: #F8FAFC;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            border-color: var(--primary-color);
            background-color: #fff;
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

    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title animate__animated animate__fadeInUp">Get in Touch</h1>
            <p class="fs-5 text-muted max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s" style="max-width: 700px;">
                Looking to transform your coaching institute? Our team at Engenius Digitech is ready to help you deploy EduCore.
            </p>
        </div>
    </div>

    <section class="py-5 my-5">
        <div class="container py-4">
            
            <div class="row g-0 rounded-4 shadow-lg overflow-hidden border">
                <!-- Contact Form -->
                <div class="col-lg-7 p-5 bg-white">
                    <h3 class="fw-bold mb-4" style="color: var(--dark-bg);">Send us a message</h3>
                    <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Message sent successfully! We will get back to you shortly.');">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small uppercase">Full Name</label>
                                <input type="text" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small uppercase">Email Address</label>
                                <input type="email" class="form-control" placeholder="john@institute.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-muted small uppercase">Subject</label>
                                <select class="form-select">
                                    <option>Sales Inquiry</option>
                                    <option>Technical Support</option>
                                    <option>Custom Enterprise Plan</option>
                                    <option>General Question</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-muted small uppercase">Message</label>
                                <textarea class="form-control" rows="5" placeholder="How can we help you?" required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-modern w-100 py-3 text-white shadow-sm" style="background: linear-gradient(135deg, var(--primary-color), #6366F1);">Send Message <i class="fas fa-paper-plane ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-5 p-0">
                    <div class="contact-info-box d-flex flex-column justify-content-center">
                        <h4 class="fw-bold mb-5">Contact Information</h4>
                        
                        <div class="contact-info-item">
                            <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h6 class="fw-bold">Headquarters</h6>
                                <p class="text-white-50 mb-0">Engenius Digitech<br>Vadodara, Gujarat<br>India</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h6 class="fw-bold">Email Us</h6>
                                <p class="text-white-50 mb-0">hello@engeniusdigitech.com<br>support@educore.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-info-icon"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <h6 class="fw-bold">Call Us</h6>
                                <p class="text-white-50 mb-0">+91 (General Inquiries)</p>
                            </div>
                        </div>

                        <div class="mt-auto pt-5">
                            <h6 class="fw-bold mb-3 text-white-50">Connect with Engenius Digitech</h6>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-light rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-linkedin-in text-primary"></i></a>
                                <a href="#" class="btn btn-light rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-twitter text-info"></i></a>
                                <a href="https://engeniusdigitech.netlify.app/" target="_blank" class="btn btn-light rounded-circle" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-globe text-secondary"></i></a>
                            </div>
                        </div>
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
