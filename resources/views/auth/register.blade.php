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

            <!-- Register Form -->
            <div style="padding: 3rem; width: 400px;">
                <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 1.5rem;">Nice to meet you!</h2>

                @if ($errors->any())
                    <div style="color: red; margin-bottom: 1rem;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div style="margin-bottom: 1rem;">
                        <label for="name">Name</label><br>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <!-- Email -->
                    <div style="margin-bottom: 1rem;">
                        <label for="email">Email</label><br>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 1rem;">
                        <label for="password">Password</label><br>
                        <input id="password" type="password" name="password" required autocomplete="new-password" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <!-- Confirm Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password_confirmation">Confirm Password</label><br>
                        <input id="password_confirmation" type="password" name="password_confirmation" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <!-- Submit -->
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <a href="{{ route('login') }}" style="color: #1D4ED8;">Already registered?</a>
                        <button type="submit" style="background-color: #1D4ED8; color: white; padding: 8px 16px; border: none; border-radius: 6px;">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
