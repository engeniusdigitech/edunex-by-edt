<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal Login - EduNex</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --secondary: #06b6d4;
            --bg-start: #083344;
            --bg-end: #020617;
            --glass-bg: rgba(255, 255, 255, 0.05);
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
            opacity: 0.5;
            animation: float 20s infinite ease-in-out alternate;
        }

        .blob-1 {
            top: -10%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: var(--primary);
            border-radius: 50%;
            animation-delay: 0s;
        }

        .blob-2 {
            bottom: -20%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: var(--secondary);
            border-radius: 50%;
            animation-delay: -5s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-30px, 50px) scale(1.1); }
            66% { transform: translate(20px, -20px) scale(0.9); }
            100% { transform: translate(0, 0) scale(1); }
        }

        /* Premium Glassmorphic Card */
        .glass-card {
            position: relative;
            z-index: 10;
            background: var(--glass-bg);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 48px 40px;
            width: 100%;
            max-width: 440px;
            transform: translateY(20px);
            opacity: 0;
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
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

        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            transition: color 0.3s;
        }

        .input-group input {
            width: 100%;
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 14px;
            padding: 14px 16px 14px 45px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        .input-group input:focus {
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.6);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .input-group input:focus + .input-icon {
            color: var(--primary);
        }

        /* Premium Button */
        .btn-premium {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 14px;
            padding: 14px 24px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 20px -10px rgba(6, 182, 212, 0.6);
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
            box-shadow: 0 15px 25px -10px rgba(6, 182, 212, 0.8);
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

        /* Alerts */
        .alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 24px;
        }
        .alert ul { margin: 0; padding-left: 20px; color: #fca5a5; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="glass-card">
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="background: linear-gradient(135deg, var(--primary), var(--secondary)); width: 64px; height: 64px; border-radius: 20px; display: inline-flex; justify-content: center; align-items: center; margin-bottom: 16px; box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.5);">
                <i class="fas fa-user-graduate" style="font-size: 28px; color: white;"></i>
            </div>
            <h2 class="brand-font" style="font-size: 1.75rem; font-weight: 700; color: white; margin: 0 0 8px 0;">Student Portal</h2>
            <p style="color: var(--text-muted); margin: 0; font-size: 0.95rem;">Empower your learning journey.</p>
        </div>

        @if($errors->any())
            <div class="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.login') }}" method="POST">
            @csrf
            
            <div class="input-group">
                <label>Student Email</label>
                <div class="input-wrapper">
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="student@example.com">
                    <i class="fas fa-envelope input-icon"></i>
                </div>
            </div>

            <div class="input-group" style="margin-bottom: 20px;">
                <label>Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" required placeholder="••••••••">
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>

            <label class="custom-checkbox" style="margin-bottom: 32px;">
                <input type="checkbox" name="remember" id="remember">
                <span style="font-size: 0.9rem; color: var(--text-muted);">Remember my device</span>
            </label>

            <button type="submit" class="btn-premium">
                Access Portal <i class="fas fa-arrow-right"></i>
            </button>
        </form>
        
        <div style="text-align: center; margin-top: 30px; color: var(--text-muted); font-size: 0.8rem;">
            &copy; {{ date('Y') }} EduNex Systems
        </div>
    </div>
</body>
</html>
