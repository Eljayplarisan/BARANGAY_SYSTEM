<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @include('partials.mobile-head')
        <title>Forgot Password | Barangay Ward II</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            * { box-sizing: border-box; }
            body {
                min-height: 100vh;
                margin: 0;
                display: grid;
                place-items: center;
                padding: 20px;
                background: #edf3f8;
                color: #153e65;
                font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            }
            .reset-card {
                width: min(100%, 460px);
                padding: 34px;
                border: 1px solid #d8e3ee;
                border-radius: 14px;
                background: #fff;
                box-shadow: 0 18px 50px rgba(20, 58, 96, 0.14);
            }
            .brand {
                margin: -34px -34px 28px;
                padding: 18px 24px;
                border-radius: 14px 14px 0 0;
                background: #064b91;
                color: #fff;
                font-weight: 800;
                letter-spacing: 0.04em;
            }
            h1 { margin: 0 0 8px; font-size: 1.4rem; }
            p { margin: 0 0 20px; color: #66809b; font-size: 0.88rem; line-height: 1.6; }
            label { display: block; margin-bottom: 7px; color: #345c80; font-size: 0.8rem; font-weight: 700; }
            input {
                width: 100%;
                height: 46px;
                padding: 0 12px;
                border: 1px solid #d7e1eb;
                border-radius: 7px;
                outline: none;
                font: inherit;
            }
            input:focus { border-color: #3280c5; box-shadow: 0 0 0 3px rgba(50, 128, 197, 0.13); }
            button {
                width: 100%;
                min-height: 46px;
                margin-top: 18px;
                border: 0;
                border-radius: 7px;
                background: linear-gradient(180deg, #1877d1, #0756a8);
                color: #fff;
                font: inherit;
                font-weight: 800;
                cursor: pointer;
            }
            .message {
                margin-bottom: 16px;
                padding: 11px 13px;
                border: 1px solid #f0c5c5;
                border-radius: 7px;
                background: #fff3f3;
                color: #8b2525;
                font-size: 0.8rem;
            }
            .success { border-color: #b8dfc2; background: #effaf1; color: #24613a; }
            .back { display: block; margin-top: 18px; text-align: center; color: #075aab; font-size: 0.82rem; font-weight: 700; text-decoration: none; }
            @media (max-width: 480px) {
                body { padding: 12px; }
                .reset-card { padding: 24px 18px; }
                .brand { margin: -24px -18px 22px; padding: 16px 18px; }
                input { font-size: 16px; }
            }
        </style>
    </head>
    <body>
        <main class="reset-card">
            <div class="brand">BARANGAY WARD II</div>
            <h1>Reset your password</h1>
            <p>Enter the email address associated with your account. We’ll send you a link to choose a new password.</p>

            @if (session('status'))
                <div class="message success" role="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="message" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                <button type="submit">Send Password Reset Link</button>
            </form>

            <a class="back" href="{{ route('login') }}">Back to Log In</a>
        </main>
    </body>
</html>
