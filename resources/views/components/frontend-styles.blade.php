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
        background-color: transparent !important;
        background: transparent !important;
        border-bottom: 2px solid transparent !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: none !important;
    }

    #frontend-navbar.scrolled {
        background-color: rgba(255, 255, 255, 0.8) !important;
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1) !important;
        padding-top: 12px !important;
        padding-bottom: 12px !important;
    }

    /* ── BUTTONS ── */
    .btn-modern {
        padding: 12px 28px;
        font-weight: 700;
        border-radius: 14px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-primary-glow {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        color: white !important;
        box-shadow: 0 10px 30px -5px rgba(79, 70, 229, 0.4);
        border: none;
    }
    .btn-primary-glow:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px -5px rgba(79, 70, 229, 0.5);
    }
    .btn-outline-modern {
        background: #ffffff;
        color: var(--text-main) !important;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
    }
    .btn-outline-modern:hover {
        border-color: var(--primary-color);
        color: var(--primary-color) !important;
        transform: translateY(-2px);
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
