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
        transition: all 0.3s ease;
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
    }
    .footer-logo { font-size: 1.8rem; font-weight: 900; color: var(--primary-color); }
    .footer-link { color: var(--text-muted); text-decoration: none; font-weight: 500; transition: color 0.3s; }
    .footer-link:hover { color: var(--primary-color); }
</style>
