<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo title="Start Your Best Institute and School Management Software Free Trial | EduNex" description="Experience the #1 Institute and School Management system for free. Start your 7-day trial of EduNex institute software today and automate your educational center." />
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
            padding: 180px 0 100px;
            position: relative;
        }
        
        .page-title {
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            font-weight: 500;
            letter-spacing: -2px;
            line-height: 1.1;
            margin-bottom: 24px;
        }

        .page-title span {
            color: var(--primary-color);
        }

        /* Form Styling */
        .trial-card {
            border-radius: 32px;
            padding: 50px;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .form-control {
            padding: 16px 20px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            background: rgba(241, 245, 249, 0.5);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: #fff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .btn-whatsapp {
            background: #25D366;
            color: white !important;
            box-shadow: 0 10px 20px rgba(37, 211, 102, 0.2);
        }

        .btn-whatsapp:hover {
            background: #22c35e;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(37, 211, 102, 0.3);
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
        <div class="container px-4">
            <h1 class="page-title animate__animated animate__fadeInUp">
                Start Your <span>Free Trial</span> Today
            </h1>
            <p class="fs-5 text-muted mx-auto animate__animated animate__fadeInUp animate__delay-1s" style="max-width: 700px;">
                Experience the most complete and intuitive <strong>Institute and School Management system</strong>. Fill out the form below, and our team will get you started instantly.
            </p>
        </div>
    </div>

    <section class="py-5 mb-5">
        <div class="container px-4">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="trial-card glass animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="text-center mb-5">
                            <div class="icon-box mx-auto mb-4" style="background: #ECFDF5; color: #10B981; width: 80px; height: 80px; border-radius: 24px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <h3 class="fw-medium mb-2">Registration for Trial</h3>
                            <p class="text-muted small">We'll connect with you via WhatsApp to set up your account.</p>
                        </div>

                        <form id="trialForm" onsubmit="sendToWhatsApp(event)">
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">Institute Name</label>
                                    <input type="text" id="institute" class="form-control" placeholder="e.g. Apex Institute classes" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Billy Doe" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" id="phone" class="form-control" placeholder="12345 67890" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Selected Plan</label>
                                    <input type="text" id="plan" class="form-control" value="{{ $planName }}" readonly style="background: rgba(0,0,0,0.03);">
                                </div>
                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn btn-modern btn-whatsapp w-100 py-3 fw-medium fs-6">
                                        Submit Request <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-frontend-footer />

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
