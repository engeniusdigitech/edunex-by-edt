@props(['wide' => false, 'hideLogo' => false])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduNex') }} - Premium Authentication</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary: #6366f1;
                --primary-hover: #4f46e5;
                --secondary: #ec4899;
                --bg-start: #0f172a;
                --bg-end: #1e1b4b;
                --glass-bg: rgba(255, 255, 255, 0.03);
                --glass-border: rgba(255, 255, 255, 0.1);
                --text-main: #f8fafc;
                --text-muted: #94a3b8;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, var(--bg-start), var(--bg-end));
                color: var(--text-main);
                min-height: 100vh;
                margin: 0;
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
            }

            h1, h2, h3, h4, h5, h6, .brand-font {
                font-family: 'Outfit', sans-serif;
            }

            /* Animated Background Blobs */
            .blob {
                position: absolute;
                filter: blur(80px);
                z-index: 0;
                opacity: 0.6;
                animation: float 20s infinite ease-in-out alternate;
            }

            .blob-1 {
                top: -10%;
                left: -10%;
                width: 500px;
                height: 500px;
                background: var(--primary);
                border-radius: 50%;
                animation-delay: 0s;
            }

            .blob-2 {
                bottom: -20%;
                right: -10%;
                width: 600px;
                height: 600px;
                background: var(--secondary);
                border-radius: 50%;
                animation-delay: -5s;
            }

            .blob-3 {
                top: 40%;
                left: 50%;
                width: 400px;
                height: 400px;
                background: #8b5cf6;
                border-radius: 50%;
                transform: translate(-50%, -50%);
                animation-delay: -10s;
            }

            @keyframes float {
                0% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0, 0) scale(1); }
            }

            /* Premium Glassmorphic Card */
            .glass-card {
                position: relative;
                z-index: 10;
                background: var(--glass-bg);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border: 1px solid var(--glass-border);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
                border-radius: 28px;
                padding: 48px 40px;
                width: 100%;
                max-width: 440px;
                transform: translateY(20px);
                opacity: 0;
                animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                overflow: hidden; /* Added to clip child content in split mode */
            }

            .glass-card.wide {
                max-width: 980px; /* Reduced by 2% from 1000px */
                padding: 0; /* Padding will be handled by columns */
            }

            .auth-split {
                display: flex;
                flex-direction: row;
                height: 100%;
                min-height: 600px;
            }

            .auth-form-side {
                flex: 0.85; /* Narrower form column */
                padding: 48px 60px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                position: relative;
                z-index: 5;
            }

            .auth-visual-side {
                flex: 1.35;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
                padding: 48px 60px 48px 120px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                position: relative;
                overflow: hidden;
                margin-left: -70px; /* Shifted right (from -80px) */
                clip-path: polygon(70px 0, 100% 0, 100% 100%, 0 100%);
                z-index: 10;
            }

            @media (max-width: 1024px) {
                .glass-card {
                    margin: 20px;
                }
                .glass-card.wide {
                    max-width: 440px;
                    margin: 20px;
                }
                .auth-split {
                    flex-direction: column;
                }
                .auth-visual-side {
                    display: none; /* Hide visual on small screens for better UX */
                }
                .auth-form-side {
                    padding: 32px 24px;
                }
            }

            @keyframes slideUp {
                to { transform: translateY(0); opacity: 1; }
            }

            /* Inputs */
            .input-group {
                margin-bottom: 24px;
                position: relative;
            }

            .input-group label {
                display: block;
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--text-muted);
                margin-bottom: 8px;
                transition: color 0.3s;
            }

            .input-group input {
                width: 100%;
                background: rgba(15, 23, 42, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: white;
                border-radius: 14px;
                padding: 14px 16px;
                font-size: 1rem;
                outline: none;
                transition: all 0.3s;
                box-sizing: border-box;
            }

            .input-group input:focus {
                border-color: var(--primary);
                background: rgba(15, 23, 42, 0.6);
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
            }

            .input-group input:focus + label,
            .input-group input:not(:placeholder-shown) + label {
                color: var(--text-main);
            }

            /* Premium Button */
            .btn-premium {
                width: 100%;
                background: linear-gradient(135deg, var(--primary), #8b5cf6);
                color: white;
                border: none;
                border-radius: 14px;
                padding: 14px 24px;
                font-size: 1rem;
                font-weight: 600;
                font-family: 'Outfit', sans-serif;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 10px;
                box-shadow: 0 10px 20px -10px rgba(99, 102, 241, 0.6);
            }

            .btn-premium::before {
                content: '';
                position: absolute;
                top: 0; left: -100%; width: 100%; height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: all 0.5s;
            }

            .btn-premium:hover {
                transform: translateY(-2px);
                box-shadow: 0 15px 25px -10px rgba(99, 102, 241, 0.8);
            }

            .btn-premium:hover::before {
                left: 100%;
            }

            /* Custom Checkbox */
            .custom-checkbox {
                display: flex;
                align-items: center;
                gap: 10px;
                cursor: pointer;
            }

            .custom-checkbox input {
                appearance: none;
                width: 20px;
                height: 20px;
                border: 2px solid rgba(255, 255, 255, 0.2);
                border-radius: 6px;
                background: rgba(15, 23, 42, 0.4);
                position: relative;
                cursor: pointer;
                transition: all 0.3s;
            }

            .custom-checkbox input:checked {
                background: var(--primary);
                border-color: var(--primary);
            }

            .custom-checkbox input:checked::after {
                content: '✓';
                position: absolute;
                color: white;
                font-size: 14px;
                top: -1px; left: 3px;
            }

            /* Links */
            .link-premium {
                color: var(--primary);
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s;
            }

            .link-premium:hover {
                color: #8b5cf6;
                text-shadow: 0 0 10px rgba(139, 92, 246, 0.4);
            }

            /* Logo */
            .auth-logo {
                display: flex;
                justify-content: center;
                margin-bottom: 2rem;
            }
            .auth-logo img {
                height: 60px;
                object-fit: contain;
                animation: pulse 3s infinite;
            }

            @keyframes pulse {
                0% { filter: drop-shadow(0 0 10px rgba(139,92,246,0.2)); }
                50% { filter: drop-shadow(0 0 20px rgba(139,92,246,0.6)); }
                100% { filter: drop-shadow(0 0 10px rgba(139,92,246,0.2)); }
            }
        </style>
    </head>
    <body>
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <a href="{{ url('/') }}" style="position: absolute; top: 30px; left: 30px; color: var(--text-muted); text-decoration: none; display: flex; align-items: center; gap: 8px; font-weight: 500; z-index: 20; transition: color 0.3s;">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>

        <div class="glass-card {{ $wide ? 'wide' : '' }}">
            @if(!isset($hideLogo) || !$hideLogo)
                <div class="auth-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="EduNex Logo">
                    </a>
                </div>
            @endif
            {{ $slot }}
        </div>
        
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js').then(function(registration) {
                        console.log('PWA ServiceWorker registration successful with scope: ', registration.scope);
                    }, function(err) {
                        console.log('PWA ServiceWorker registration failed: ', err);
                    });
                });
            }
        </script>
    </body>
</html>
