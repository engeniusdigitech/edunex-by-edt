<x-guest-layout :split="true">

<style>
/* Custom premium login page layout for EduNex ERP */
.split-container {
    display: flex;
    min-height: 100vh;
    width: 100vw;
    background: #ffffff;
}

/* LEFT PANEL (BRAND/VISUAL SIDE) */
.brand-panel {
    flex: 1;
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
    position: relative;
    padding: 60px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: #ffffff;
    overflow: hidden;
}

/* Subtle background accent pattern */
.brand-panel::before {
    content: '';
    position: absolute;
    top: -20%;
    right: -20%;
    width: 60%;
    height: 60%;
    background: radial-gradient(circle, rgba(27, 117, 215, 0.08) 0%, transparent 70%);
    z-index: 1;
}
.brand-panel::after {
    content: '';
    position: absolute;
    bottom: -10%;
    left: -10%;
    width: 50%;
    height: 50%;
    background: radial-gradient(circle, rgba(27, 117, 215, 0.08) 0%, transparent 70%);
    z-index: 1;
}

.brand-header {
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 5;
    position: relative;
}
.brand-header img.logo-icon {
    height: 48px;
    object-fit: contain;
}
.brand-header img.logo-name {
    height: 28px;
    object-fit: contain;
    filter: brightness(0) invert(1); /* pure white typography */
}

.brand-content {
    z-index: 5;
    position: relative;
    max-width: 500px;
    margin-top: auto;
    margin-bottom: auto;
}
.brand-title {
    font-family: 'Outfit', sans-serif;
    font-size: 3.5rem;
    font-weight: 500;
    line-height: 1.15;
    margin-bottom: 24px;
    letter-spacing: -0.03em;
}
.brand-title span {
    color: #1B75D7; /* EduNex ERP primary blue */
}
.brand-description {
    font-size: 1.1rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 0;
}

.brand-footer {
    z-index: 5;
    position: relative;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.4);
}

/* RIGHT PANEL (FORM PANEL) */
.form-panel {
    flex: 1.1;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px;
    position: relative;
}

.form-container {
    width: 100%;
    max-width: 400px;
}

.back-to-home {
    position: absolute;
    top: 40px;
    right: 40px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #64748B;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: color 0.3s;
}
.back-to-home:hover {
    color: #1B75D7;
}

.form-header {
    margin-bottom: 36px;
}
.form-header h2 {
    font-family: 'Outfit', sans-serif;
    font-size: 2.2rem;
    font-weight: 500;
    color: #0F172A;
    margin-bottom: 8px;
    letter-spacing: -0.02em;
}
.form-header p {
    color: #64748B;
    font-size: 0.95rem;
    margin-bottom: 0;
}

/* Form Styles matching EduNex ERP */
.form-group {
    margin-bottom: 24px;
}
.form-group label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 8px;
}
.input-field-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}
.input-field-wrapper i {
    position: absolute;
    left: 16px;
    color: #94A3B8;
    font-size: 0.95rem;
}
.input-field-wrapper input {
    width: 100%;
    padding: 14px 16px 14px 44px;
    font-size: 0.95rem;
    border: 1px solid #E2E8F0;
    border-radius: 12px;
    background: #FFFFFF;
    color: #0F172A;
    outline: none;
    transition: all 0.3s ease;
}
.input-field-wrapper input::placeholder {
    color: #94A3B8;
}
.input-field-wrapper input:focus {
    border-color: #1B75D7; /* focused blue border */
    box-shadow: 0 0 0 4px rgba(27, 117, 215, 0.08);
}

/* Options Wrapper (Remember Me & Forgot Password) */
.options-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
    font-size: 0.9rem;
}
.remember-me-checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    color: #64748B;
    user-select: none;
}
.remember-me-checkbox input {
    appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #CBD5E1;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    transition: all 0.2s;
}
.remember-me-checkbox input:checked {
    background: #1B75D7;
    border-color: #1B75D7;
}
.remember-me-checkbox input:checked::after {
    content: '✓';
    position: absolute;
    color: #FFFFFF;
    font-size: 11px;
    font-weight: 500;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.forgot-password-link {
    color: #1B75D7; /* EduNex ERP primary blue */
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s;
}
.forgot-password-link:hover {
    color: #155cb0;
}

/* Button & Action Link */
.btn-signin {
    width: 100%;
    padding: 14px 24px;
    font-family: 'Outfit', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    background: #1B75D7; /* EduNex ERP primary blue */
    color: #FFFFFF;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 10px 20px -10px rgba(27, 117, 215, 0.3);
    transition: all 0.3s ease;
}
.btn-signin:hover {
    background: #155cb0;
    transform: translateY(-1px);
    box-shadow: 0 15px 25px -10px rgba(27, 117, 215, 0.4);
}

.bottom-link {
    text-align: center;
    margin-top: 28px;
    color: #64748B;
    font-size: 0.9rem;
}
.bottom-link a {
    color: #0F172A;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}
.bottom-link a:hover {
    color: #1B75D7;
}

/* Error validation styling */
.validation-error {
    color: #DC2626;
    font-size: 0.8rem;
    margin-top: 6px;
    font-weight: 500;
}

/* Status Alert Box */
.alert-status-box {
    background: rgba(27, 117, 215, 0.08);
    border: 1px solid rgba(27, 117, 215, 0.2);
    color: #155cb0;
    padding: 14px 16px;
    border-radius: 12px;
    margin-bottom: 24px;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Responsive Scaling */
@media (max-width: 991.98px) {
    .brand-panel {
        display: none;
    }
    .form-panel {
        padding: 40px 24px;
    }
    .back-to-home {
        top: 24px;
        right: 24px;
    }
}
</style>

<div class="split-container">

    <!-- LEFT PANEL (BRAND/VISUAL SIDE) -->
    <div class="brand-panel">
        
        <!-- BRAND HEADER -->
        <div class="brand-header">
            <img src="{{ asset('images/logo.png') }}" alt="EduNex ERP Logo" class="logo-icon">
            <img src="{{ asset('images/logo-name.png') }}" alt="EduNex ERP" class="logo-name">
        </div>
        
        <!-- CENTER CONTENT -->
        <div class="brand-content">
            <h1 class="brand-title">Empower Your<br><span>Institute.</span></h1>
            <p class="brand-description">
                Log in to access your real-time analytics dashboard, manage student records, track biometric attendance, and streamline academics seamlessly.
            </p>
        </div>
        
        <!-- BOTTOM FOOTER -->
        <div class="brand-footer">
            &copy; {{ date('Y') }} Engenius Digitech. All rights reserved.
        </div>
        
    </div>

    <!-- RIGHT PANEL (FORM PANEL) -->
    <div class="form-panel">
        
        <a href="{{ url('/') }}" class="back-to-home">
            Back to Home <i class="fas fa-arrow-right"></i>
        </a>
        
        <div class="form-container">
            
            <div class="form-header">
                <h2>Welcome Back</h2>
                <p>Enter your credentials to access your account.</p>
            </div>

            @if (session('status'))
                <div class="alert-status-box">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- EMAIL ADDRESS -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-field-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@company.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="validation-error" />
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-field-wrapper">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="validation-error" />
                </div>

                <!-- REMEMBER & FORGOT PASSWORD -->
                <div class="options-wrapper">
                    <label class="remember-me-checkbox">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password-link">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- SIGN IN BUTTON -->
                <button type="submit" class="btn-signin">
                    Sign In <i class="fas fa-arrow-right"></i>
                </button>

                <!-- FOOTER LINK -->
                <div class="bottom-link">
                    Don't have an account? <a href="{{ route('trial.request') }}">Request a Demo</a>
                </div>
                
            </form>
            
        </div>
        
    </div>

</div>

</x-guest-layout>