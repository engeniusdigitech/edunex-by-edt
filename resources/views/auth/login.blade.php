<x-guest-layout>
    <div style="text-align: center; margin-bottom: 32px;">
        <h2 class="brand-font" style="font-size: 1.75rem; font-weight: 700; color: white; margin: 0 0 8px 0;">Welcome Back</h2>
        <p style="color: var(--text-muted); margin: 0; font-size: 0.95rem;">Empowering education through brilliant tools.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: #34d399; padding: 12px; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@institute.com" />
            <x-input-error :messages="$errors->get('email')" style="color: #f43f5e; margin-top: 8px; font-size: 0.85rem;" />
        </div>

        <div class="input-group" style="margin-bottom: 16px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <label for="password" style="margin: 0;">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a class="link-premium" style="font-size: 0.85rem;" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" style="color: #f43f5e; margin-top: 8px; font-size: 0.85rem;" />
        </div>

        <label class="custom-checkbox" style="margin-bottom: 32px;">
            <input type="checkbox" name="remember" id="remember_me">
            <span style="font-size: 0.9rem; color: var(--text-muted);">{{ __('Keep me securely logged in') }}</span>
        </label>

        <button type="submit" class="btn-premium">
            {{ __('Sign In to Dashboard') }} <i class="fas fa-arrow-right"></i>
        </button>
        
        <div style="text-align: center; margin-top: 24px;">
            <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">
                Don't have an institute account? <br>
                <a href="{{ route('trial.request') }}" class="link-premium" style="display: inline-block; margin-top: 8px;">Contact us to get started</a>
            </p>
        </div>
    </form>
</x-guest-layout>
