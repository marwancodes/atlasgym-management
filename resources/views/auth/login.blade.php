<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen px-4 bg-gradient-to-br from-gray-900 via-gray-800 to-black">

        <div class="w-full max-w-md p-8 bg-gray-900/80 backdrop-blur
                    border border-gray-700 rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.6)]">

            <!-- Title -->
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-white">ATLAS GYM</h1>
                <p class="mt-1 text-sm text-gray-400">
                    Sign in to your account
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        class="block w-full mt-1 text-white bg-gray-800 border-gray-700 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="block w-full mt-1 text-white bg-gray-800 border-gray-700 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                               class="text-indigo-600 bg-gray-800 border-gray-600 rounded focus:ring-indigo-500"
                               name="remember">
                        <span class="text-sm text-gray-400 ms-2">
                            {{ __('Remember me') }}
                        </span>
                    </label>
                </div>

                <!-- Button -->
                <div class="pt-2">
                    <x-primary-button
                        class="w-full justify-center py-3 text-sm font-semibold
                               bg-indigo-600 hover:bg-indigo-700
                               shadow-[0_8px_30px_rgba(99,102,241,0.4)]
                               transition-all duration-200">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
