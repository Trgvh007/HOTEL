<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-yellow-100">
        <div class="bg-white bg-opacity-80 backdrop-blur-md shadow-xl rounded-2xl px-10 py-8 w-full max-w-md">
            
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="/">
                    <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="w-48">
                </a>
            </div>

            <!-- Heading -->
            <h2 class="text-center text-2xl font-bold text-gray-700 mb-2">Forgot your password?</h2>
            <p class="text-center text-sm text-gray-600 mb-6">
                No worries! Enter your email and we’ll send you a reset link 💌
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="flex flex-col items-center mb-5">
                    <label for="email" class="mb-1 text-sm text-gray-700 w-full text-center padding:10px">Email</label>
                    <x-input id="email" class="w-64 text-center" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <x-button class="px-6 py-2 text-sm">
                        {{ __('Send Reset Link') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
