<style>
    :root {
        --primary-color: #4F46E5;
        --primary-light: #6366F1;
        --secondary-color: #EC4899;
        --dark-bg: #0F172A;
        --card-bg: #ffffff;
        --text-main: #1E293B;
        --text-muted: #64748B;
        --border-color: #E2E8F0;
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: rgba(255, 255, 255, 0.3);
    }

    body {
        font-family: 'Outfit', sans-serif;
        color: var(--text-main);
        background: #f8fafc; /* Slightly softer than pure white */
        overflow-x: hidden;
        position: relative;
    }

    section {
        background: transparent !important;
        position: relative;
        z-index: 10;
    }

    .bg-light {
        background-color: rgba(248, 250, 252, 0.5) !important;
    }

    .bg-white {
        background-color: rgba(255, 255, 255, 0.5) !important;
    }

    /* ── GLASSMORPHISM UTILITY ── */
    .glass {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(16px) saturate(180%);
        -webkit-backdrop-filter: blur(16px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.08);
    }

    .glass-dark {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* ── MESH GRADIENT BACKGROUNDS ── */
    .mesh-bg {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: -1;
        overflow: hidden;
        pointer-events: none;
        background-color: #f8fafc;
    }
    .mesh-circle {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.3;
    }
    .mesh-circle-1 {
        width: 1000px; height: 1000px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, transparent 70%);
        top: -300px; right: -200px;
    }
    .mesh-circle-2 {
        width: 800px; height: 800px;
        background: radial-gradient(circle, rgba(236, 72, 153, 0.18) 0%, transparent 70%);
        bottom: 20%; left: -200px;
    }
    .mesh-circle-3 {
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.12) 0%, transparent 70%);
        top: 20%; left: 30%;
    }
    .mesh-circle-4 {
        width: 900px; height: 900px;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, transparent 70%);
        bottom: -200px; right: 10%;
    }

    /* ── NAVBAR ── */
    #frontend-navbar {
        background-color: transparent;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1050;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    #frontend-navbar .container {
        max-width: 1400px; /* Wider container for premium feel */
    }

    #frontend-navbar.scrolled {
        background-color: rgba(255, 255, 255, 0.9) !important;
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
        box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.08) !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }

    /* Desktop Navigation Links */
    @media (min-width: 992px) {
        .navbar-nav {
            gap: 1.5rem !important;
        }
        
        .nav-link {
            font-size: 0.95rem !important;
            color: var(--text-main) !important;
            position: relative;
            padding: 0.5rem 0 !important;
            white-space: nowrap;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.text-primary::after {
            width: 100%;
        }

        /* Desktop Button Group */
        .nav-item.btn-group-desktop {
            margin-left: 1rem;
            display: flex !important;
            align-items: center;
            gap: 0.75rem !important;
        }
    }

    /* ── CUSTOM HAMBURGER ── */
    .hamburger-icon {
        width: 24px;
        height: 18px;
        position: relative;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .hamburger-icon span {
        display: block;
        height: 2px;
        width: 100%;
        background-color: var(--primary-color);
        border-radius: 2px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    #frontend-navbar.menu-open .hamburger-icon span:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    #frontend-navbar.menu-open .hamburger-icon span:nth-child(2) {
        opacity: 0;
        transform: translateX(20px);
    }

    #frontend-navbar.menu-open .hamburger-icon span:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }

    /* ── LUXURY DRAWER (MOBILE) ── */
    @media (max-width: 991.98px) {
        #frontend-navbar.menu-open {
            z-index: 9999 !important;
        }

        .luxury-drawer {
            position: fixed;
            top: 0;
            right: -100%;
            width: 85%;
            height: 100vh;
            background: #ffffff; /* Solid background to prevent double-blur */
            z-index: 1060;
            display: flex !important;
            flex-direction: column;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
            border-left: 1px solid rgba(0, 0, 0, 0.05);
            visibility: hidden;
            overflow-y: auto;
        }

        .luxury-drawer.show {
            right: 0 !important;
            visibility: visible !important;
        }

        .btn-close-drawer {
            width: 44px;
            height: 44px;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important;
            background: rgba(0, 0, 0, 0.05) !important;
            color: var(--text-main) !important;
            border: none !important;
            transition: all 0.3s ease;
            -webkit-appearance: none;
            cursor: pointer;
            outline: none;
        }

        .btn-close-drawer:active {
            background: rgba(0, 0, 0, 0.1) !important;
            transform: scale(0.9);
        }

        .navbar-nav {
            padding: 20px 30px;
            width: 100%;
        }

        .nav-item {
            width: 100%;
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .luxury-drawer.show .nav-item {
            opacity: 1;
            transform: translateX(0);
        }

        /* Staggered Delay for Nav Items */
        .luxury-drawer.show .nav-item:nth-child(1) { transition-delay: 0.1s; }
        .luxury-drawer.show .nav-item:nth-child(2) { transition-delay: 0.15s; }
        .luxury-drawer.show .nav-item:nth-child(3) { transition-delay: 0.2s; }
        .luxury-drawer.show .nav-item:nth-child(4) { transition-delay: 0.25s; }
        .luxury-drawer.show .nav-item:nth-child(5) { transition-delay: 0.3s; }
        .luxury-drawer.show .nav-item:nth-child(6) { transition-delay: 0.35s; }

        .nav-link {
            font-size: 1.25rem !important;
            padding: 16px 0 !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
            display: block;
            width: 100%;
            color: var(--text-main) !important;
            font-weight: 700 !important; /* Bold links for premium feel */
        }

        .btn-modern {
            margin-top: 10px;
            width: 100%;
            padding: 18px !important;
        }

        /* Backdrop Overlay - This provides the 'glass' effect behind the drawer */
        .nav-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 9998; /* Just below the drawer */
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .nav-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    }

    /* ── BUTTONS ── */
    .btn-modern {
        padding: 10px 24px;
        font-weight: 700;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.88rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap; /* Prevent multi-line wrapping */
        border: none;
    }
    
    .btn-primary-glow {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white !important;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.2);
    }
    
    .btn-primary-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.3);
    }

    .btn-outline-modern {
        background: transparent;
        color: var(--text-main) !important;
        border: 1.5px solid var(--border-color) !important;
    }

    .btn-outline-modern:hover {
        background: rgba(79, 70, 229, 0.05);
        border-color: var(--primary-color) !important;
        color: var(--primary-color) !important;
        transform: translateY(-2px);
    }

    /* Hierarchy Fix */
    .btn-student-portal {
        background: rgba(79, 70, 229, 0.04);
        color: var(--primary-color) !important;
        border: 1px solid rgba(79, 70, 229, 0.1) !important;
    }
    
    .btn-student-portal:hover {
        background: rgba(79, 70, 229, 0.08);
    }

    /* ── FOOTER ── */
    .footer {
        background: #ffffff;
        padding: 80px 0 40px;
        border-top: 1px solid var(--border-color);
        position: relative;
        z-index: 50;
    }
    .footer-logo { font-size: 1.8rem; font-weight: 900; color: var(--primary-color); }
    .footer-link { color: var(--text-muted); text-decoration: none; font-weight: 500; transition: color 0.3s; }
    .footer-link:hover { color: var(--primary-color); }
</style>
