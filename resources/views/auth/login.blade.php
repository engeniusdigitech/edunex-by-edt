<x-guest-layout :wide="true" :hideLogo="true">

<style>
/* INPUT ICON STYLE */
.input-wrapper {
    position: relative;
}
.input-wrapper i {
    position: absolute;
    top: 50%;
    left: 14px;
    transform: translateY(-50%);
    color: #94a3b8;
}
.input-wrapper input {
    padding-left: 40px !important;
}

/* STATUS */
.status-box {
    background: rgba(16,185,129,0.1);
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 20px;
    color: #34d399;
}

/* ERROR */
.error {
    color: #f43f5e;
    font-size: 0.8rem;
    margin-top: 5px;
}

/* REMEMBER */
.remember {
    margin-bottom: 20px;
}

/* BUTTON */
.btn-premium {
    width: 100%;
    padding: 16px;
    border-radius: 16px;
    background: linear-gradient(135deg,#6366f1,#8b5cf6);
    border: none;
    color: white;
    font-weight: 600;
    transition: 0.3s;
    box-shadow: 0 10px 30px rgba(99,102,241,0.4);
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}
.btn-premium:hover {
    transform: scale(1.03);
    box-shadow: 0 20px 40px rgba(99,102,241,0.6);
}

/* RIGHT SIDE */
.auth-visual-side h3 {
    font-size: 1.8rem;
    margin-bottom: 10px;
}
.feature {
    display: flex;
    gap: 12px;
    margin-top: 20px;
    padding: 15px;
    border-radius: 12px;
    background: rgba(255,255,255,0.03);
    transition: 0.3s;
}
.feature:hover {
    transform: translateY(-3px);
}

/* BOTTOM TEXT */
.bottom-text {
    margin-top: 25px;
    text-align: center;
    color: #94a3b8;
}
.bottom-text a {
    color: #6366f1;
}
</style>

<div class="auth-split">

    <!-- LEFT SIDE -->
    <div class="auth-form-side">

        <div style="margin-bottom: 32px;">
            <div style="margin-bottom: 20px;">
                <img src="{{ asset('images/logo.png') }}" style="height:45px;">
            </div>

            <h2 style="font-size: 2rem; font-weight: 800;">Welcome Back 👋</h2>
            <p style="color: var(--text-muted);">
                Login to manage your institute smarter & faster.
            </p>
        </div>

        @if (session('status'))
            <div class="status-box">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="input-group">
                <label>Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" required placeholder="Email Address">
                </div>
                <x-input-error :messages="$errors->get('email')" class="error" />
            </div>

            <!-- PASSWORD -->
            <div class="input-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" required placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('password')" class="error" />
            </div>

            <!-- REMEMBER -->
            <div class="remember">
                <label class="custom-checkbox">
                    <input type="checkbox" name="remember">
                    <span>Keep me logged in</span>
                </label>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn-premium">
                Sign In <i class="fas fa-arrow-right"></i>
            </button>

            <div class="bottom-text">
                Don’t have an account?
                <a href="{{ route('trial.request') }}">Contact us</a>
            </div>
        </form>
    </div>

    <!-- RIGHT SIDE -->
    <div class="auth-visual-side">
        <h3>The Future of Institute Management 🚀</h3>
        <p>Powerful tools to run your institute like a pro.</p>

        <div class="feature">
            <i class="fas fa-chart-line"></i>
            <div>
                <h4>Smart Analytics</h4>
                <p>Track performance in real-time</p>
            </div>
        </div>

        <div class="feature">
            <i class="fas fa-user-check"></i>
            <div>
                <h4>Attendance System</h4>
                <p>Automated tracking system</p>
            </div>
        </div>

        <div class="feature">
            <i class="fas fa-shield-alt"></i>
            <div>
                <h4>Secure Data</h4>
                <p>Enterprise-level protection</p>
            </div>
        </div>
    </div>

</div>
</x-guest-layout>