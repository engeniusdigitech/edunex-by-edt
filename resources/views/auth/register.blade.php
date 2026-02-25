<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Create an Account</h2>
        <p class="text-gray-500 text-sm mt-1">Start managing your institute effectively.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-semibold text-sm text-gray-700 uppercase tracking-wide mb-1">{{ __('Name') }}</label>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-pink-600" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block font-semibold text-sm text-gray-700 uppercase tracking-wide mb-1">{{ __('Email Address') }}</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="admin@institute.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-600" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-semibold text-sm text-gray-700 uppercase tracking-wide mb-1">{{ __('Password') }}</label>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-600" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 mb-6">
            <label for="password_confirmation" class="block font-semibold text-sm text-gray-700 uppercase tracking-wide mb-1">{{ __('Confirm Password') }}</label>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-pink-600" />
        </div>

        <div>
            <button type="submit" class="auth-btn">
                {{ __('Create Account') }} <i class="fas fa-user-plus ml-2 opacity-70"></i>
            </button>
        </div>
        
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Already registered? 
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in here</a>
            </p>
        </div>
    </form>
</x-guest-layout>
