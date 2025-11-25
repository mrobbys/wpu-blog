<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="user_cred" :value="__('Email or Username')" />
            <x-text-input
                id="user_cred"
                class="mt-1 block w-full"
                type="text"
                name="user_cred"
                :value="old('user_cred')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('user_cred')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input
                id="password"
                class="mt-1 block w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4 block">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded-sm border-gray-300 text-indigo-600 shadow-xs focus:ring-indigo-500"
                    name="remember"
                />
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="mt-4 flex items-center justify-center">
            @if (Route::has('register'))
                <a class="group rounded-md text-sm text-gray-600" href="{{ route('register') }}">
                    Don't have an account?
                    <strong class="group-hover:underline">Register</strong>
                </a>
            @endif
        </div>

        <div class="mt-4 flex items-center justify-end">
            @if (Route::has('password.request'))
                <a
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900"
                    href="{{ route('password.request') }}"
                >
                    Forgot your password?
                </a>
            @endif

            <x-primary-button class="ms-3">Login</x-primary-button>
        </div>
    </form>
</x-guest-layout>
