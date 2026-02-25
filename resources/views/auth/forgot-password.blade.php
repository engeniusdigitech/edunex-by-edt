<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900"><i class="fas fa-lock text-indigo-500 mr-2"></i> Reset Password</h2>
    </div>

    <div class="mb-6 text-sm text-gray-500 text-center leading-relaxed">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <label for="email" class="block font-semibold text-sm text-gray-700 uppercase tracking-wide mb-1">{{ __('Email Address') }}</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="admin@institute.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-600" />
        </div>

        <div>
            <button type="submit" class="auth-btn">
                {{ __('Email Password Reset Link') }} <i class="fas fa-paper-plane ml-2 opacity-70"></i>
            </button>
        </div>
        
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                <i class="fas fa-arrow-left mr-1"></i> Back to sign in
            </a>
        </div>
    </form>
</x-guest-layout>
