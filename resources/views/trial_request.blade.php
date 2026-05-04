<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="Start Your Best Institute Management Software Free Trial | EduNex" description="Experience the #1 institute management system for free. Start your 7-day trial of EduNex institute software today and automate your educational center." />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @include('components.frontend-styles')
    
    <style>
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

        /* Form */
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
    <div class="mesh-bg">
        <div class="mesh-circle-1"></div>
        <div class="mesh-circle-2"></div>
        <div class="mesh-circle-3"></div>
        <div class="mesh-circle-4"></div>
    </div>

    <!-- Navigation -->
    @include('components.frontend-navbar')

    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title animate__animated animate__fadeInUp">Start Your Free Institute Software Trial</h1>
            <p class="fs-5 text-muted max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s" style="max-width: 700px;">
                Ready to upgrade your workflow with the best <strong>institute management system</strong>? Fill the form below, and our team will get your institute set up.
            </p>
        </div>
    </div>

    <section class="py-5 my-5">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card border-0 shadow-lg rounded-4 p-5 glass">
                        <div class="text-center mb-5">
                            <h4 class="fw-bold"><i class="fab  text-success fa-2x mb-3"></i><br>Let's Get connected for trial</h4>
                            <p class="text-muted">Fill out these basic details. This will send a direct WhatsApp message to our enrollment team.</p>
                        </div>

                        <form id="trialForm" onsubmit="sendToWhatsApp(event)">
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-muted small text-uppercase">Institute Name</label>
                                    <input type="text" id="institute" class="form-control" placeholder="e.g. Apex Institute classes" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-muted small text-uppercase">Your Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="John Doe" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-muted small text-uppercase">Phone Number</label>
                                    <input type="tel" id="phone" class="form-control" placeholder="12345 67890" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold text-muted small text-uppercase">Selected Plan</label>
                                    <input type="text" id="plan" class="form-control bg-light" value="{{ $planName }}" readonly>
                                </div>
                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-modern w-100 py-3 text-white shadow-sm fw-bold fs-5" style="background-color: #25D366; border-radius: 16px;">
                                        Submit <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
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
                    <div class="footer-brand"><img src="{{ asset('images/logo.png') }}" alt="EduCore Logo" style="max-height: 64px;" class="me-2"></div>
                    <p class="footer-text text-white-50 mb-0">Elevating institute management software.<br>A product by <a href="https://engeniusdigitech.netlify.app/" target="_blank" class="text-white fw-bold text-decoration-none border-bottom border-light pb-1">Engenius Digitech</a>.</p>
                </div>
                <div class="col-md-6 text-md-end footer-text">
                    <a href="{{ route('about') }}" class="text-decoration-none text-white opacity-75 me-3 hover-opacity-100">About Us</a>
                    <a href="{{ route('contact') }}" class="text-decoration-none text-white opacity-75 me-3 hover-opacity-100">Contact Us</a>
                    <a href="#" class="text-decoration-none text-white opacity-75 hover-opacity-100">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function sendToWhatsApp(e) {
            e.preventDefault();
            
            const institute = document.getElementById('institute').value.trim();
            const name = document.getElementById('name').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const plan = document.getElementById('plan').value;
            
            // Build the message
            let message = `Hello Engenius Digitech,\n\nI am interested in starting my EduNex Trial.\n\n`;
            message += `*Institute:* ${institute}\n`;
            message += `*Name:* ${name}\n`;
            message += `*Contact:* ${phone}\n`;
            message += `*Selected Plan:* ${plan}\n\n`;
            message += `Could you please help us set up our account?`;
            
            // Encode the message
            const encodedMessage = encodeURIComponent(message);
            
            // The provided WhatsApp number
            const waNumber = '918160490089'; 
            
            // WhatsApp redirection URL
            const finalUrl = `https://wa.me/${waNumber}?text=${encodedMessage}`;
            
            // Open window
            window.location.href = finalUrl;
        }
    </script>
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
