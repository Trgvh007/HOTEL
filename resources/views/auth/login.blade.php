<x-guest-layout>
    <div style="
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #fffdf5;
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

            <!-- Login Form -->
            <div style="padding: 3rem; width: 400px;">
                <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 1.5rem;">Welcome back!</h2>

                @if (session('status'))
                    <div style="color: green; margin-bottom: 1rem;">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div style="color: red; margin-bottom: 1rem;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div style="margin-bottom: 1rem;">
                        <label for="email">Email</label><br>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password">Password</label><br>
                        <input id="password" type="password" name="password" required autocomplete="current-password" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <!-- Remember Me -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <label>
                            <input type="checkbox" name="remember">
                            <span style="margin-left: 4px;">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="color: #1D4ED8;">Forgot your password?</a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <div style="text-align: right;">
                        <button type="submit" style="background-color: #1D4ED8; color: white; padding: 8px 16px; border: none; border-radius: 6px;">Log in</button>
                    </div>

                    <!-- Register Link -->
                    @if (Route::has('register'))
                        <div style="text-align: center; margin-top: 1rem;">
                            Don’t have an account?
                            <a href="{{ route('register') }}" style="color: #1D4ED8;">Create one</a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
