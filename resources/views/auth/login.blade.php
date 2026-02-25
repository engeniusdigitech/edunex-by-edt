<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Sign in to your account</h2>
        <p class="text-gray-500 text-sm mt-1">Manage everything in one central hub.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-semibold text-sm text-gray-700 uppercase tracking-wide mb-1">{{ __('Email Address') }}</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@institute.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-600" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block font-semibold text-sm text-gray-700 uppercase tracking-wide">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-600" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-gray-600 font-medium">{{ __('Keep me logged in') }}</span>
            </label>
        </div>

        <div>
            <button type="submit" class="auth-btn">
                {{ __('Secure Sign In') }} <i class="fas fa-arrow-right ml-2 opacity-70"></i>
            </button>
        </div>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Don't have an institute account? 
                <a href="{{ route('trial.request') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Contact us to get started</a>
            </p>
        </div>
    </form>
</x-guest-layout>
