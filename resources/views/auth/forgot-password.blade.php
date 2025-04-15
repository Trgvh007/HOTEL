<x-guest-layout>
    <div style="
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #fef3c7;
    ">
        <div style="
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
            padding: 2rem 2.5rem;
            max-width: 400px;
            width: 100%;
        ">

            <!-- Logo -->
            <div style="display: flex; justify-content: center; margin-bottom: 1.5rem;">
                <a href="/">
                    <img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 12rem;">
                </a>
            </div>

            <!-- Heading -->
            <h2 style="text-align: center; font-size: 1.5rem; font-weight: bold; color: #374151; margin-bottom: 0.5rem;">
                Forgot your password?
            </h2>
            <p style="text-align: center; font-size: 0.875rem; color: #4B5563; margin-bottom: 1.5rem;">
                No worries! Enter your email and we’ll send you a reset link 💌
            </p>

            <!-- Session Status -->
            @if (session('status'))
                <div style="color: green; text-align: center; margin-bottom: 1rem;">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div style="color: red; margin-bottom: 1rem;">
                    <ul style="font-size: 0.875rem;">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div style="margin-bottom: 1.5rem;">
                    <label for="email" style="display: block; text-align: center; margin-bottom: 0.5rem; color: #374151;">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        style="
                            width: 100%;
                            padding: 0.5rem;
                            border: 1px solid #D1D5DB;
                            border-radius: 0.375rem;
                            text-align: center;
                        "
                    >
                </div>

                <!-- Submit Button -->
                <div style="text-align: center;">
                    <button type="submit" style="
                        background-color: #1D4ED8;
                        color: white;
                        padding: 0.5rem 1.5rem;
                        font-size: 0.875rem;
                        border: none;
                        border-radius: 0.375rem;
                        cursor: pointer;
                    ">
                        {{ __('Send Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
