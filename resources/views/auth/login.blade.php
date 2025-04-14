<x-guest-layout>

   
       

    <div style="
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #fffdf5; /* vàng kem nhẹ */
    ">
        <div style="
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.85); 
            border-radius: 30px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
                <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 1.5rem;">Welcome back!</h2>


                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />


        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label><input type="radio" name="level" value="{{ \App\Models\User::ROLE_ADMIN }}" checked> Quản lý</label><br>
            <label><input type="radio" name="level" value="{{ \App\Models\User::ROLE_USER }}"> Khách hàng</label><br>
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf


                    <!-- Email -->
                    <div style="margin-bottom: 1rem;">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <x-label for="password" :value="__('Password')" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-gray-900 underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <x-button>
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                    @if (Route::has('register'))
                    <div class="text-center text-sm text-gray-600">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="text-sm font-light" style="color: #1D4ED8;">
                            Create one
                        </a>
                    </div>
                    @endif


                </form>
            </div>
        </div>
    </div>
</x-guest-layout>