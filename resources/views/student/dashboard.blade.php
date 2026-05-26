<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal — {{ $student->institute->name ?? 'EduNex' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0EA5E9">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #2563EB;
            --primary-blue-light: #3B82F6;
            --primary-blue-dark: #1D4ED8;
            --primary-green: #10B981;
            --primary-green-light: #34D399;
            --primary-green-dark: #059669;
            --gradient-blue-green: linear-gradient(135deg, #2563EB 0%, #0D9488 50%, #10B981 100%);
            --gradient-blue-green-reverse: linear-gradient(135deg, #10B981 0%, #0D9488 50%, #2563EB 100%);
            --amber: #F59E0B;
            --red: #EF4444;
            --bg: #F0F9FF;
            --card: #ffffff;
            --border: #E0F2FE;
            --text: #0F172A;
            --muted: #64748B;
            --radius: 20px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            font-family: 'Inter', sans-serif;
            background: #F8FAFC;
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── SIDEBAR LAYOUT ── */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: #fff;
            border-right: 1px solid var(--border);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-brand .brand-logo {
            width: 44px;
            height: 44px;
            background: var(--gradient-blue-green);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 800;
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .sidebar-brand .brand-text {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.2;
        }

        .sidebar-brand .brand-sub {
            font-size: 0.65rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 16px;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-section-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--muted);
            margin-bottom: 12px;
            padding-left: 12px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--muted);
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            margin-bottom: 4px;
        }

        .nav-item:hover {
            background: rgba(37, 99, 235, 0.06);
            color: var(--primary-blue);
        }

        .nav-item.active {
            background: var(--gradient-blue-green);
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(16, 185, 129, 0.05) 100%);
            border-radius: 14px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.7rem;
            color: var(--muted);
        }

        .logout-btn {
            width: 36px;
            height: 36px;
            border: none;
            background: rgba(239, 68, 68, 0.1);
            border-radius: 10px;
            color: var(--red);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logout-btn:hover {
            background: var(--red);
            color: #fff;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 32px;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1001;
            width: 44px;
            height: 44px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-brand .brand-badge {
            width: 40px;
            height: 40px;
            background: var(--gradient-blue-green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            font-weight: 800;
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .nav-brand .brand-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.1;
        }

        .nav-brand .brand-sub {
            font-size: 0.62rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-right .student-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--muted);
        }

        .nav-right .avatar {
            width: 40px;
            height: 40px;
            background: var(--gradient-blue-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
            font-weight: 700;
            color: #fff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .notif-icon-btn {
            width: 36px;
            height: 36px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            font-size: 0.82rem;
            cursor: pointer;
            position: relative;
            text-decoration: none;
            transition: all .2s;
        }

        .notif-icon-btn:hover {
            background: var(--gradient-blue-green);
            color: #fff;
            border-color: var(--primary-blue);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .notif-dot {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 16px;
            height: 16px;
            background: var(--primary-green);
            border-radius: 50%;
            font-size: 0.6rem;
            color: #fff;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
        }

        .logout-btn {
            background: none;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 6px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .logout-btn:hover {
            border-color: var(--red);
            color: var(--red);
        }

        /* ── PAGE ── */
        .page {
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 0.95rem;
            color: var(--muted);
        }

        /* ── QUICK ACTIONS ── */
        .quick-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }

        .quick-action-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text);
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .quick-action-btn:hover {
            border-color: var(--primary-blue);
            background: rgba(37, 99, 235, 0.03);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
        }

        .quick-action-btn i {
            color: var(--primary-blue);
        }

        .quick-action-btn.primary {
            background: var(--gradient-blue-green);
            color: #fff;
            border: none;
        }

        .quick-action-btn.primary i {
            color: #fff;
        }

        .quick-action-btn.primary:hover {
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }

        /* ── HERO ── */
        .hero {
            background: var(--gradient-blue-green);
            border-radius: 24px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            margin-bottom: 32px;
            box-shadow: 0 20px 40px -12px rgba(37, 99, 235, 0.25), 0 10px 20px -8px rgba(16, 185, 129, 0.2);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -60px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -100px;
            right: 120px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero .tag {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.85);
            border-radius: 50px;
            padding: 3px 12px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .hero h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
            line-height: 1.2;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .hero p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.87rem;
            margin: 0;
        }

        .hero .batch-badge {
            margin-top: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .hero-icon-bg {
            position: absolute;
            right: 32px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 7rem;
            color: rgba(255, 255, 255, 0.04);
        }

        .hero-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 2;
        }

        .student-hero-img {
            width: 110px;
            height: 110px;
            border-radius: 32px;
            object-fit: cover;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .student-hero-img:hover {
            transform: scale(1.05) rotate(2deg);
        }

        /* ── STAT CARDS ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: var(--gradient-blue-green);
            opacity: 0.03;
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(37, 99, 235, 0.12);
            border-color: var(--primary-blue-light);
        }

        .stat-card:hover::before {
            opacity: 0.06;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 16px;
            background: var(--gradient-blue-green);
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .stat-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
            background: var(--gradient-blue-green);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-hint {
            font-size: 0.75rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-trend {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
            margin-left: auto;
        }

        .stat-trend.up {
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary-green);
        }

        .stat-trend.down {
            background: rgba(239, 68, 68, 0.1);
            color: var(--red);
        }

        .prog {
            height: 8px;
            border-radius: 99px;
            background: #E2E8F0;
            overflow: hidden;
            margin-top: 12px;
            position: relative;
        }

        .prog .fill {
            height: 100%;
            border-radius: 99px;
            background: var(--gradient-blue-green);
            position: relative;
            overflow: hidden;
        }

        .prog .fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* ── BADGES & STATUS ── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-badge.success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--primary-green);
        }

        .status-badge.warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--amber);
        }

        .status-badge.danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--red);
        }

        .status-badge.info {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-blue);
        }

        /* ── LOADING STATES ── */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ── BUTTON STATES ── */
        .btn-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ── MAIN GRID ── */
        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            align-items: start;
        }

        .col-wide {
            grid-column: span 2;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1200px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .col-wide {
                grid-column: span 1;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 24px 20px;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .mobile-overlay.open {
                display: block;
            }

            .stats-row {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .hero {
                padding: 28px 24px;
            }

            .hero h2 {
                font-size: 1.4rem;
            }

            .quick-actions {
                flex-direction: column;
            }

            .quick-action-btn {
                width: 100%;
                justify-content: center;
            }

            .page-header {
                padding-left: 50px;
            }
        }

        @media (max-width: 480px) {
            .stats-row {
                grid-template-columns: 1fr;
            }

            .main-content {
                padding: 20px 16px;
            }

            .hero {
                padding: 24px 20px;
            }

            .hero h2 {
                font-size: 1.2rem;
            }

            .page-header {
                padding-left: 50px;
            }

            .page-title {
                font-size: 1.4rem;
            }
        }

        /* ── TOUCH OPTIMIZATIONS ── */
        @media (hover: none) and (pointer: coarse) {
            .nav-item,
            .quick-action-btn,
            .app-card,
            .stat-card {
                min-height: 44px;
                min-width: 44px;
            }

            .quick-action-btn:active {
                transform: scale(0.98);
            }

            .app-card:active {
                transform: scale(0.98);
            }

            .nav-item:active {
                background: rgba(37, 99, 235, 0.1);
            }
        }

        /* ── SEARCH & FILTERS ── */
        .search-bar {
            position: relative;
            margin-bottom: 24px;
        }

        .search-input {
            width: 100%;
            padding: 14px 20px 14px 48px;
            border: 1px solid var(--border);
            border-radius: 14px;
            font-size: 0.9rem;
            background: #fff;
            transition: all 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 1rem;
        }

        .filter-tags {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-tag {
            padding: 8px 16px;
            border: 1px solid var(--border);
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--muted);
            background: #fff;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-tag:hover {
            border-color: var(--primary-blue);
            color: var(--primary-blue);
        }

        .filter-tag.active {
            background: var(--gradient-blue-green);
            color: #fff;
            border-color: transparent;
        }

        /* ── FORM UX IMPROVEMENTS ── */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
        }

        .form-label .required {
            color: var(--red);
            margin-left: 2px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 12px;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-control.error {
            border-color: var(--red);
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .form-control.success {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .form-hint {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 6px;
        }

        .form-error {
            font-size: 0.75rem;
            color: var(--red);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-success {
            font-size: 0.75rem;
            color: var(--primary-green);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 0.9rem;
        }

        .input-with-icon {
            padding-left: 42px;
        }

        .input-clear {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            cursor: pointer;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .input-clear:hover {
            color: var(--red);
        }

        /* ── CARD ── */
        .card-block {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px -4px rgba(37, 99, 235, 0.05);
            transition: all 0.3s;
        }

        .card-block:hover {
            box-shadow: 0 8px 20px -6px rgba(37, 99, 235, 0.08);
        }

        .card-head {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.02) 0%, rgba(16, 185, 129, 0.02) 100%);
        }

        .card-head h6 {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-head h6 i {
            color: var(--primary-blue);
        }

        .card-link {
            font-size: 0.72rem;
            color: var(--primary-blue);
            font-weight: 600;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .card-link:hover {
            background: rgba(37, 99, 235, 0.08);
            text-decoration: none;
        }

        /* ── BATCH INFO ── */
        .batch-info {
            background: var(--gradient-blue-green);
            border-radius: var(--radius);
            padding: 20px 24px;
            color: white;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.2);
        }

        .batch-info::after {
            content: '';
            position: absolute;
            right: -20px;
            top: -20px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 50%;
        }

        .batch-ico {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .batch-info .b-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: .6;
        }

        .batch-info .b-name {
            font-size: 1rem;
            font-weight: 700;
            margin: 2px 0;
        }

        .batch-info .b-time {
            font-size: 0.75rem;
            opacity: .65;
        }

        /* ── LECTURES CTA ── */
        .lectures-cta {
            background: #0F172A;
            border-radius: var(--radius);
            padding: 18px 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .lectures-cta .lc-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-blue-green);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #fff;
            margin: 0 auto 12px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .lectures-cta h6 {
            color: #fff;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .lectures-cta p {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            margin-bottom: 12px;
        }

        .btn-lectures {
            background: var(--gradient-blue-green);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 10px 0;
            font-size: 0.85rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            text-decoration: none;
            display: block;
            transition: all .3s;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-lectures:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-lectures:hover {
            opacity: .85;
            color: #fff;
        }

        /* ── LIST ITEMS ── */
        .list-item {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            gap: 14px;
            transition: background 0.2s;
        }

        .list-item:hover {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.02) 0%, rgba(16, 185, 129, 0.02) 100%);
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .list-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--gradient-blue-green);
            margin-top: 6px;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
        }

        .item-content {
            flex: 1;
        }

        .item-title {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text);
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .item-sub {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .item-due {
            font-size: 0.75rem;
            color: var(--red);
            font-weight: 600;
            margin-top: 4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            background: rgba(239, 68, 68, 0.08);
            border-radius: 6px;
        }

        /* ── TESTS ── */
        .tab-row {
            display: flex;
            gap: 6px;
            padding: 12px 20px 0;
        }

        .t-pill {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            border: 1px solid var(--border);
            background: none;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
        }

        .t-pill.active {
            background: var(--gradient-blue-green);
            border-color: var(--primary-blue);
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .t-pane {
            display: none;
        }

        .t-pane.active {
            display: block;
        }

        .test-row {
            padding: 12px 20px;
            border-bottom: 1px solid #F1F5F9;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .test-row:last-child {
            border-bottom: none;
        }

        .t-date {
            text-align: center;
            min-width: 38px;
        }

        .t-month {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary-blue);
        }

        .t-day {
            font-size: 1.2rem;
            font-weight: 800;
            line-height: 1;
            color: var(--text);
        }

        .t-name {
            font-size: 0.84rem;
            font-weight: 600;
        }

        .t-info {
            font-size: 0.7rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .t-score {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--primary-blue);
        }

        .t-total {
            font-size: 0.7rem;
            color: var(--muted);
        }

        /* ── PAYMENTS ── */
        .pay-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pay-table th {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
            font-weight: 600;
            padding: 12px 20px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            background: #F8FAFC;
        }

        .pay-table td {
            padding: 13px 20px;
            font-size: 0.82rem;
            border-bottom: 1px solid #F8FAFC;
            vertical-align: middle;
        }

        .pay-table tr:last-child td {
            border-bottom: none;
        }

        .pay-table tr:hover td {
            background: #FAFBFC;
        }

        .pay-name {
            font-weight: 600;
        }

        .pay-method {
            font-size: 0.68rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .pay-amt {
            font-weight: 700;
            font-variant-numeric: tabular-nums;
        }

        .badge-paid {
            background: #D1FAE5;
            color: #065F46;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 50px;
        }

        /* ── NOTIFICATIONS ── */
        .notif-row {
            padding: 13px 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-bottom: 1px solid #F1F5F9;
        }

        .notif-row:last-child {
            border-bottom: none;
        }

        .notif-ico {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(14, 165, 233, 0.1);
            color: var(--indigo);
            font-size: 0.8rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .notif-ico.warning { background: rgba(245, 158, 11, 0.15); color: var(--amber); }
        .notif-ico.danger { background: rgba(239, 68, 68, 0.15); color: var(--red); }
        .notif-ico.success { background: rgba(16, 185, 129, 0.15); color: var(--primary-green); }
        .notif-ico.primary { background: rgba(37, 99, 235, 0.15); color: var(--primary-blue); }
        .notif-ico.info { background: rgba(37, 99, 235, 0.15); color: var(--primary-blue); }

        .notif-title {
            font-size: 0.82rem;
            font-weight: 600;
        }

        .notif-msg {
            font-size: 0.73rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .dismiss-btn {
            margin-left: auto;
            flex-shrink: 0;
            background: none;
            border: 1px solid var(--border);
            border-radius: 7px;
            padding: 3px 9px;
            font-size: 0.68rem;
            color: var(--muted);
            cursor: pointer;
            transition: all .2s;
        }

        .dismiss-btn:hover {
            border-color: var(--primary-green);
            color: var(--primary-green);
            background: rgba(16, 185, 129, 0.1);
        }

        /* ── EMPTY ── */
        .empty-box {
            text-align: center;
            padding: 30px 16px;
            color: var(--muted);
        }

        .empty-box i {
            font-size: 2rem;
            opacity: .3;
            display: block;
            margin-bottom: 10px;
            background: var(--gradient-blue-green);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .empty-box span {
            font-size: 0.8rem;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 960px) {
            .main-grid {
                grid-template-columns: 1fr 1fr;
            }

            .col-wide {
                grid-column: span 2;
            }

            .stats-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .col-wide {
                grid-column: span 1;
            }

            .stats-row {
                grid-template-columns: 1fr 1fr;
            }

            .hero h2 {
                font-size: 1.3rem;
            }

            .hero-icon-bg {
                display: none;
            }

            .top-navbar {
                padding: 0 16px;
            }

            .page {
                padding: 16px 14px 40px;
            }

            .nav-right .student-name {
                display: none;
            }
        }

        /* ── APP GRID DASHBOARD ── */
        .app-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .app-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px 20px;
            text-align: center;
            cursor: pointer;
            transition: all .3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .app-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-blue-green);
            border-radius: 20px 20px 0 0;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .app-card:hover::before {
            opacity: 1;
        }

        .app-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 32px rgba(37, 99, 235, 0.15);
            border-color: var(--primary-blue);
        }

        .app-card.active {
            border-color: var(--primary-blue);
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(16, 185, 129, 0.05) 100%);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
        }

        .app-card.active::before {
            opacity: 1;
        }

        .app-card-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            margin-bottom: 14px;
            transition: transform 0.3s;
        }

        .app-card:hover .app-card-icon {
            transform: scale(1.1);
        }

        .app-card-icon.bg-amber {
            background: rgba(245, 158, 11, 0.1);
            color: var(--amber);
        }

        .app-card-icon.bg-indigo {
            background: var(--gradient-blue-green);
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .app-card-icon.bg-emerald {
            background: var(--gradient-blue-green-reverse);
            color: #fff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .app-card-icon.bg-pink {
            background: var(--gradient-blue-green);
            color: #fff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .app-card-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .app-card-badge {
            font-size: 0.68rem;
            color: var(--muted);
            font-weight: 500;
        }

        /* ── ACTIVE SECTION SWAP ── */
        .app-section {
            display: none;
        }

        .app-section.active {
            display: block;
            animation: fadeIn .3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .app-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .app-card {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <div class="mobile-overlay" onclick="toggleSidebar()"></div>

    <!-- ── SIDEBAR ── -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('student.dashboard') }}" class="sidebar-brand">
                @if($student->institute && $student->institute->logo)
                    <img src="{{ asset('storage/' . $student->institute->logo) }}" alt="Logo"
                        class="brand-logo" style="width: 44px; height: 44px; object-fit: cover;">
                @else
                    <div class="brand-logo">EN</div>
                @endif
                <div>
                    <div class="brand-text">{{ $student->institute->name ?? 'EduNex' }}</div>
                    <div class="brand-sub">Student Portal</div>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Main</div>
                <a href="{{ route('student.dashboard') }}" class="nav-item active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('student.timetable.index') }}" class="nav-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Timetable</span>
                </a>
                <a href="{{ route('student.lectures.index') }}" class="nav-item">
                    <i class="fas fa-video"></i>
                    <span>Live Lectures</span>
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Academics</div>
                <a href="{{ route('student.fees.index') }}" class="nav-item">
                    <i class="fas fa-wallet"></i>
                    <span>Fees & Payments</span>
                </a>
                <a href="{{ route('student.leaves.index') }}" class="nav-item">
                    <i class="fas fa-calendar-minus"></i>
                    <span>Leave Requests</span>
                </a>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Account</div>
                <a href="{{ route('student.profile.edit') }}" class="nav-item">
                    <i class="fas fa-user-circle"></i>
                    <span>My Profile</span>
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <img src="{{ $student->profile_image_url }}" alt="Profile" class="user-avatar">
                <div class="user-info">
                    <div class="user-name">{{ $student->name }}</div>
                    <div class="user-role">Student</div>
                </div>
                <form method="POST" action="{{ route('student.logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ── MAIN CONTENT ── -->
    <div class="main-content">
        <div class="page">

        

        <!-- Hero Banner -->
        <div class="hero">
            <div class="hero-flex">
                <div class="hero-text-content">
                    <div class="tag">{{ now()->format('l, d M Y') }}</div>
                    <h2>Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening') }}!</h2>
                    <p>Here's an overview of your academics and activity.</p>
                    @if($student->batch)
                        <div class="batch-badge">
                            <i class="fas fa-users" style="font-size:0.7rem;opacity:.7;"></i>
                            <strong>{{ $student->batch->name }}</strong>
                            @if($student->batch->schedule_time)
                                &nbsp;·&nbsp; <i class="far fa-clock" style="font-size:0.7rem;opacity:.7;"></i>
                                {{ $student->batch->schedule_time }}
                            @endif
                        </div>
                    @endif
                </div>
                <div class="hero-avatar-content">
                    <a href="{{ route('student.profile.edit') }}">
                        <img src="{{ $student->profile_image_url }}" alt="Profile" class="student-hero-img">
                    </a>
                </div>
            </div>
            <i class="fas fa-graduation-cap hero-icon-bg"></i>
        </div>

        <!-- Attendance Section -->
        @if(isset($attendancePercentage))
        <div class="card-block">
            <div class="card-head">
                <h6><i class="fas fa-chart-pie"></i> Attendance Overview</h6>
            </div>
            <div style="padding: 24px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                    <div>
                        <div style="font-size: 0.85rem; color: var(--muted); margin-bottom: 4px;">Overall Attendance</div>
                        <div style="font-size: 2rem; font-weight: 800; background: var(--gradient-blue-green); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ $attendancePercentage }}%</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 0.85rem; color: var(--muted); margin-bottom: 4px;">Classes Attended</div>
                        <div style="font-size: 1.25rem; font-weight: 700; color: var(--text);">{{ $presentClasses ?? 0 }} / {{ $totalClasses ?? 0 }}</div>
                    </div>
                </div>
                <div class="prog">
                    <div class="fill" style="width: {{ $attendancePercentage }}%;"></div>
                </div>
            </div>
        </div>
        @endif

        <!-- App Grid Menu -->
        <div class="app-grid mb-4">
            <div class="app-card active" onclick="switchSection('homework', this)">
                <div class="app-card-icon bg-amber"><i class="fas fa-book-open"></i></div>
                <div class="app-card-title">Homework</div>
                <div class="app-card-badge">{{ $activeHomeworks->count() }} Active</div>
            </div>
            <div class="app-card" onclick="switchSection('lectures', this)">
                <div class="app-card-icon bg-indigo"><i class="fas fa-video"></i></div>
                <div class="app-card-title">Live Lectures</div>
                <div class="app-card-badge">View Library</div>
            </div>
            <div class="app-card" onclick="switchSection('fees', this)">
                <div class="app-card-icon bg-emerald"><i class="fas fa-wallet"></i></div>
                <div class="app-card-title">Fees Details</div>
                <div class="app-card-badge">Check Ledger</div>
            </div>
            <div class="app-card" onclick="window.location.href='{{ route('student.timetable.index') }}'">
                <div class="app-card-icon bg-pink"><i class="fas fa-calendar-alt"></i></div>
                <div class="app-card-title">Timetable</div>
                <div class="app-card-badge">Weekly Schedule</div>
            </div>
            <div class="app-card" onclick="window.location.href='{{ route('student.leaves.index') }}'">
                <div class="app-card-icon bg-indigo"><i class="fas fa-calendar-minus"></i></div>
                <div class="app-card-title">Leave Request</div>
                <div class="app-card-badge">History & Apply</div>
            </div>
            
            <div class="app-card" onclick="window.location.href='{{ route('student.profile.edit') }}'">
                <div class="app-card-icon bg-amber"><i class="fas fa-user-circle"></i></div>
                <div class="app-card-title">My Profile</div>
                <div class="app-card-badge">View & Edit</div>
            </div>
        </div>

        <!-- Notifications (if any) -->
        @if($student->unreadNotifications->count() > 0)
            <div class="card-block mb-0" id="notif-section" style="margin-bottom:20px;">
                <div class="card-head">
                    <h6><i class="fas fa-bell me-2" style="color:var(--pink);"></i>Notifications</h6>
                    <span style="font-size:0.7rem;color:var(--muted);">{{ $student->unreadNotifications->count() }}
                        unread</span>
                </div>
                @foreach($student->unreadNotifications as $notification)
                    <div class="notif-row">
                        <div class="notif-ico {{ $notification->data['color'] ?? 'primary' }}">
                            <i class="{{ $notification->data['icon'] ?? 'fas fa-info-circle' }}"></i>
                        </div>
                        <div style="flex:1;">
                            <div class="notif-title">{{ $notification->data['title'] }}</div>
                            <div class="notif-msg">{{ $notification->data['message'] }}</div>
                        </div>
                        <form action="{{ route('student.notifications.read', $notification->id) }}" method="POST">
                            @csrf
                            <button class="dismiss-btn" type="submit"><i class="fas fa-check me-1"></i>Dismiss</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Switchable Detail Sections -->
        <div class="app-section active" id="sec-homework">
            <div class="card-block">
                <div class="card-head">
                    <h6>Current Assignments</h6>
                </div>
                @forelse($activeHomeworks as $hw)
                    <div class="list-item">
                        <div class="list-dot"></div>
                        <div style="width: 100%;">
                            <div class="item-title">{{ $hw->title }}</div>
                            <div class="item-due"><i class="far fa-clock me-1"></i>Due {{ $hw->due_date->format('M d, Y') }}
                            </div>
                            @if($hw->description)
                                <div class="item-sub mb-2">{{ Str::limit($hw->description, 100) }}</div>
                            @endif
                            @if($hw->attachments && $hw->attachments->count() > 0)
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach($hw->attachments as $attachment)
                                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="text-decoration-none" style="background:#F1F5F9; border:1px solid #E2E8F0; padding:4px 10px; border-radius:6px; font-size:0.7rem; color:#2563EB; font-weight:600;">
                                            <i class="fas fa-paperclip me-1"></i> View Attachment
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-box"><i class="fas fa-check-circle"
                            style="color:var(--emerald);opacity:.4;"></i><span>No active assignments</span></div>
                @endforelse
            </div>
        </div>

        <div class="app-section" id="sec-lectures">
            <div class="batch-info">
                <div class="batch-ico"><i class="fas fa-users"></i></div>
                <div>
                    <div class="b-label">Your Batch</div>
                    <div class="b-name">{{ $student->batch->name ?? 'Not Assigned' }}</div>
                    <div class="b-time"><i
                            class="far fa-clock me-1"></i>{{ $student->batch->schedule_time ?? 'Schedule pending' }}
                    </div>
                </div>
            </div>
            <div class="lectures-cta">
                <div class="lc-icon"><i class="fas fa-video"></i></div>
                <h6>Live Lecture Library</h6>
                <p>Access recordings and join live sessions for your batch.</p>
                <a href="{{ route('student.lectures.index') }}" class="btn-lectures">
                    <i class="fas fa-play-circle me-1"></i> View Lectures
                </a>
            </div>
        </div>

        <div class="app-section" id="sec-fees">
            <div class="card-block mb-3 p-3 bg-primary bg-opacity-10 border-0 rounded-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1 fw-bold text-primary">Manage Your Fees</h6>
                        <p class="text-muted small mb-0">Check due amounts or pay online.</p>
                    </div>
                    <a href="{{ route('student.fees.index') }}" class="btn btn-primary rounded-pill px-3 shadow-sm" style="font-size:0.8rem; font-weight:600;">
                        <i class="fas fa-credit-card me-1"></i> Pay Now
                    </a>
                </div>
            </div>

            <div class="card-block">
                <div class="card-head">
                    <h6>Recent Fee Transactions</h6>
                </div>
                <table class="pay-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPayments as $payment)
                            <tr>
                                <td style="color:var(--muted);">{{ $payment->payment_date->format('M d, Y') }}</td>
                                <td>
                                    <div class="pay-name">{{ $payment->feeStructure->name ?? 'General Fee' }}</div>
                                </td>
                                <td class="pay-amt">₹{{ number_format($payment->amount_paid, 2) }}</td>
                                <td><span class="badge-paid">Paid</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-box"><i class="fas fa-receipt"></i><span>No payment records</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="app-section" id="sec-attendance">
            <div class="card-block">
                <div class="card-head">
                    <h6>Attendance Report</h6>
                </div>
                <div class="p-4 text-center">
                    <h2 style="font-size:3rem; font-weight:800; color:var(--indigo);">{{ $attendancePercentage }}%</h2>
                    <p class="text-muted small">You attended {{ $presentClasses }} out of {{ $totalClasses }} classes
                    </p>
                    <div class="progress" style="height:10px; border-radius:50px;">
                        <div class="progress-bar bg-indigo" style="width: {{ $attendancePercentage }}%"></div>
                    </div>
                </div>
            </div>
        </div><!-- /main-grid -->
    </div><!-- /page -->

        </div><!-- /page -->
    </div><!-- /main-content -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.mobile-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }

        function switchTab(tab, btn) {
            document.querySelectorAll('.t-pane').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.t-pill').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + tab).classList.add('active');
            btn.classList.add('active');
        }

        function switchSection(sectionId, btn) {
            document.querySelectorAll('.app-section').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.app-card').forEach(b => b.classList.remove('active'));
            document.getElementById('sec-' + sectionId).classList.add('active');
            btn.classList.add('active');
        }

        // Animate progress bars
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.prog .fill').forEach(function (el) {
                const w = el.style.width;
                el.style.width = '0';
                setTimeout(() => { el.style.width = w; }, 150);
            });
        });

        // PWA
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => navigator.serviceWorker.register('/sw.js'));
        }
    </script>
</body>

</html>