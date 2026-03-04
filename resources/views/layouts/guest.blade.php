<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduNex') }} - Authentication</title>

        <!-- PWA Manifest -->
        <link rel="manifest" href="/manifest.json">
        <meta name="theme-color" content="#4F46E5">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Tailwind is already imported via Vite, but we will add custom CSS for the modern look -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary-color: #4F46E5;
                --secondary-color: #EC4899;
                --dark-bg: #0F172A;
            }

            body {
                font-family: 'Outfit', sans-serif;
                background-color: #FAFAF9;
                position: relative;
                overflow-x: hidden;
            }

            /* Animated Background */
            .auth-bg {
                position: fixed;
                top: 0; left: 0; width: 100vw; height: 100vh;
                background: radial-gradient(circle at top left, rgba(79, 70, 229, 0.08), transparent 40%),
                            radial-gradient(circle at bottom right, rgba(236, 72, 153, 0.08), transparent 40%);
                z-index: -1;
            }

            /* Glassmorphic Card */
            .auth-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.6);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
                border-radius: 24px;
                padding: 40px;
                width: 100%;
                max-width: 480px;
                animation: fadeInUp 0.6s ease-out forwards;
            }

            /* Inputs Override */
            .auth-card input[type="email"],
            .auth-card input[type="password"],
            .auth-card input[type="text"] {
                border-radius: 12px;
                border: 1px solid #E2E8F0;
                padding: 12px 16px;
                background-color: #F8FAFC;
                transition: all 0.3s;
                font-family: 'Outfit', sans-serif;
            }

            .auth-card input:focus {
                box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
                border-color: var(--primary-color);
                background-color: #fff;
            }

            /* Button Override */
            .auth-btn {
                background: linear-gradient(135deg, var(--primary-color), #6366F1);
                color: white;
                border-radius: 50px;
                padding: 12px 24px;
                font-weight: 600;
                transition: all 0.3s;
                border: none;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
            }

            .auth-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
            }

            @keyframes fadeInUp {
                from { opacity: 0; transform: translate3d(0, 20px, 0); }
                to { opacity: 1; transform: translate3d(0, 0, 0); }
            }
        </style>
    </head>
    <body class="text-gray-900 antialiased min-h-screen flex flex-col justify-center items-center">
        <div class="auth-bg"></div>

        <!-- Back to Home -->
        <a href="{{ url('/') }}" class="absolute top-6 left-6 flex items-center text-gray-500 hover:text-indigo-600 transition-colors z-10 font-medium">
            <i class="fas fa-arrow-left mr-2"></i> Back to Home
        </a>

        <!-- Logo -->
        <div class="mb-8 text-center animate__animated animate__fadeInDown">
            <a href="{{ url('/') }}" class="flex items-center justify-center text-3xl font-extrabold text-indigo-600 no-underline" style="display: flex; flex-direction: column; text-decoration: none;">
                <img src="{{ asset('images/logo.png') }}" alt="EduCore Logo" class="mb-2" style="max-height: 100px;">
            </a>
            <p class="text-gray-500 mt-4 font-medium">Welcome to the future of education</p>
        </div>

        <!-- Auth Card -->
        <div class="auth-card">
            {{ $slot }}
        </div>
        
        <div class="mt-8 text-center text-sm text-gray-400">
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
