<x-guest-layout>
    <div style="
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #fffdf5; /* Nền vàng nhạt nhẹ hơn */
    ">
        <div style="
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.85); /* blur nhẹ */
            border-radius: 30px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* đổ bóng nhẹ */
        ">
            <!-- Logo -->
            <div style="
                background-color: #fff7dd;
                padding: 3rem;
                display: flex;
                justify-content: center;
                align-items: center;
            ">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 300px;">
            </div>

            <!-- Form -->
            <div style="padding: 3rem; width: 400px;">
                <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 1.5rem;">Nice to meet you!</h2>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div style="margin-bottom: 1rem;">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Email -->
                    <div style="margin-bottom: 1rem;">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 1rem;">
                        <x-label for="password" :value="__('Password')" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    </div>

                    <!-- Register Button -->
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <a class="text-sm text-gray-600 hover:text-gray-900 underline" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button>
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
