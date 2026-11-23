<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @include('partials.mobile-head')
        <title>Log In | Barangay Ward II</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                color-scheme: light;
                font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
                color: #153e65;
                background: #edf3f8;
            }

            * {
                box-sizing: border-box;
            }

            body {
                min-height: 100vh;
                margin: 0;
                display: grid;
                place-items: center;
                padding: 16px;
            }

            a {
                color: #075aab;
                font-weight: 700;
                text-decoration: none;
            }

            .login-shell {
                width: min(100%, 1120px);
                min-height: min(560px, calc(100vh - 32px));
                display: grid;
                grid-template-columns: 0.78fr 1.22fr;
                overflow: hidden;
                border: 1px solid #d8e3ee;
                border-radius: 14px;
                background: #fff;
                box-shadow: 0 18px 50px rgba(20, 58, 96, 0.14);
            }

            .intro-panel {
                display: flex;
                flex-direction: column;
                color: #fff;
                background:
                    linear-gradient(180deg, rgba(4, 37, 72, 0.14), rgba(4, 50, 96, 0.48) 46%, rgba(5, 58, 112, 0.97)),
                    url('{{ asset('images/city-hall-background.png') }}') center / cover;
            }

            .brand {
                min-height: 78px;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                justify-content: center;
                gap: 3px;
                padding: 14px 24px;
                background: rgba(6, 75, 145, 0.62);
            }

            .brand-mark {
                font-size: 0.95rem;
                font-weight: 800;
                letter-spacing: 0.04em;
                line-height: 1.2;
                display: block;
            }

            .brand-subtitle {
                margin-top: 3px;
                color: #d4e7fa;
                font-size: 0.64rem;
            }

            .intro-copy {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                padding: 28px;
                background: linear-gradient(155deg, rgba(7, 85, 160, 0.12), rgba(7, 62, 125, 0.76) 85%);
            }

            .intro-copy h1 {
                max-width: 360px;
                margin: 0 0 24px;
                font-size: clamp(1.35rem, 2.3vw, 1.8rem);
                line-height: 1.4;
                font-weight: 800;
            }

            .intro-note {
                display: grid;
                gap: 12px;
                color: #e2efff;
                font-size: 0.84rem;
                line-height: 1.55;
            }

            .intro-note-item {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .intro-note-icon {
                width: 34px;
                height: 34px;
                display: grid;
                flex: 0 0 34px;
                place-items: center;
                border-radius: 50%;
                background: #f4f9ff;
                color: #07509a;
            }

            .intro-note-icon svg {
                width: 19px;
                height: 19px;
            }

            .form-panel {
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 32px clamp(24px, 4vw, 56px);
            }

            .back-home {
                align-self: flex-start;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 26px;
                color: #315f88;
                font-size: 0.8rem;
                font-weight: 700;
            }

            .back-home svg {
                width: 18px;
                height: 18px;
                fill: none;
                stroke: currentColor;
                stroke-width: 2;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .back-home:hover {
                color: #075aab;
            }

            .form-heading {
                display: flex;
                align-items: center;
                gap: 14px;
                margin-bottom: 32px;
            }

            .user-icon {
                width: 48px;
                height: 48px;
                display: grid;
                flex: 0 0 48px;
                place-items: center;
                border-radius: 50%;
                background: #0a63b5;
                color: #fff;
            }

            .user-icon svg {
                width: 28px;
                height: 28px;
            }

            .form-heading h2 {
                margin: 0;
                color: #143f6c;
                font-size: 1.35rem;
                line-height: 1.3;
            }

            .form-heading p {
                margin: 3px 0 0;
                color: #66809b;
                font-size: 0.85rem;
            }

            .form-alert {
                margin: -14px 0 18px;
                padding: 11px 13px;
                border: 1px solid #f0c5c5;
                border-radius: 7px;
                background: #fff3f3;
                color: #8b2525;
                font-size: 0.8rem;
                line-height: 1.5;
            }

            .form-status {
                border-color: #b8dfc2;
                background: #effaf1;
                color: #24613a;
            }

            .login-form {
                display: grid;
                gap: 20px;
            }

            .field-row {
                display: grid;
                grid-template-columns: 24px minmax(0, 1fr);
                align-items: start;
                gap: 12px;
            }

            .field-icon {
                width: 21px;
                height: 21px;
                margin-top: 24px;
                color: #15548c;
                stroke: currentColor;
                fill: none;
                stroke-width: 1.8;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .field-control label {
                display: block;
                margin-bottom: 7px;
                color: #345c80;
                font-size: 0.8rem;
                font-weight: 700;
            }

            .field-control input[type="email"],
            .field-control input[type="password"],
            .field-control input[type="text"] {
                width: 100%;
                height: 46px;
                padding: 0 12px;
                border: 1px solid #d7e1eb;
                border-radius: 7px;
                outline: none;
                background: #fff;
                color: #153e65;
                font: inherit;
                font-size: 0.82rem;
                transition: border-color 0.15s ease, box-shadow 0.15s ease;
            }

            .field-control input::placeholder {
                color: #9aabba;
            }

            .field-control input:focus {
                border-color: #3280c5;
                box-shadow: 0 0 0 3px rgba(50, 128, 197, 0.13);
            }

            .password-input {
                position: relative;
            }

            .password-input input {
                padding-right: 42px;
            }

            .toggle-password {
                position: absolute;
                top: 50%;
                right: 10px;
                width: 26px;
                height: 26px;
                display: grid;
                place-items: center;
                padding: 0;
                transform: translateY(-50%);
                border: 0;
                background: transparent;
                color: #6d859c;
                cursor: pointer;
            }

            .toggle-password svg {
                width: 18px;
                height: 18px;
                fill: none;
                stroke: currentColor;
                stroke-width: 1.8;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .form-options {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin: -2px 0 2px 36px;
                font-size: 0.78rem;
            }

            .remember-option {
                display: inline-flex;
                align-items: center;
                gap: 9px;
                color: #345c80;
                font-weight: 600;
                cursor: pointer;
            }

            .remember-option input {
                width: 18px;
                height: 18px;
                margin: 0;
                accent-color: #0756a8;
            }

            .login-button {
                min-height: 46px;
                margin-left: 36px;
                border: 0;
                border-radius: 7px;
                background: linear-gradient(180deg, #1877d1, #0756a8);
                color: #fff;
                font: inherit;
                font-size: 0.95rem;
                font-weight: 800;
                cursor: pointer;
            }

            .login-button:hover {
                background: linear-gradient(180deg, #126dc3, #064d99);
            }

            .register-prompt {
                margin: 18px 0 0 36px;
                color: #6b8197;
                text-align: center;
                font-size: 0.78rem;
            }

            .register-prompt a {
                margin-left: 8px;
            }

            @media (max-width: 720px) {
                body {
                    padding: 14px;
                }

                .login-shell {
                    width: min(100%, 500px);
                    grid-template-columns: 1fr;
                }

                .brand {
                    min-height: 70px;
                    padding-inline: 20px;
                }

                .intro-copy {
                    padding: 22px;
                }

                .intro-copy h1 {
                    margin-bottom: 14px;
                }

                .form-panel {
                    padding: 30px 22px;
                }

                .form-heading {
                    margin-bottom: 24px;
                }

                .field-control input[type="email"],
                .field-control input[type="password"],
                .field-control input[type="text"] {
                    height: 46px;
                    font-size: 16px;
                }
            }

            @media (max-width: 480px) {
                body {
                    padding: 10px 10px calc(10px + env(safe-area-inset-bottom));
                }

                .form-panel {
                    padding: 24px 16px;
                }

                .form-options {
                    margin-left: 0;
                    flex-wrap: wrap;
                    font-size: 0.8rem;
                }

                .login-button,
                .register-prompt {
                    margin-left: 0;
                }

                .login-button {
                    min-height: 48px;
                }
            }
        </style>
    </head>
    <body>
        <main class="login-shell">
            <aside class="intro-panel">
                <div class="brand">
                    <div class="brand-mark">BARANGAY WARD II</div>
                    <div class="brand-subtitle">Barangay Blotter and Monitoring System</div>
                </div>
                <div class="intro-copy">
                    <h1>A safer and stronger community, together.</h1>
                    <div class="intro-note">
                        <div class="intro-note-item">
                            <span class="intro-note-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v4m0 10v4M3 12h4m10 0h4M7.5 7.5l2.8 2.8m5.4 5.4 2.8 2.8m0-11-2.8 2.8m-5.4 5.4-2.8 2.8"></path></svg>
                            </span>
                            <span>Report concerns, track progress,</span>
                        </div>
                        <div class="intro-note-item">
                            <span class="intro-note-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3"></circle><path d="M5.5 20v-1.5a6.5 6.5 0 0 1 13 0V20z"></path></svg>
                            </span>
                            <span>and be part of the change.</span>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="form-panel" aria-labelledby="login-title">
                <a class="back-home" href="{{ url('/') }}">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m14 18-6-6 6-6"></path><path d="M8 12h12"></path></svg>
                    <span>Back to Home</span>
                </a>

                <div class="form-heading">
                    <span class="user-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="7" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>
                    </span>
                    <div>
                        <h2 id="login-title">Welcome Back!</h2>
                        <p>Login to your account.</p>
                    </div>
                </div>

                @if (session('status'))
                    <div class="form-alert form-status" role="status">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="form-alert" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="login-form" method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="field-row">
                        <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="m4 7 8 6 8-6"></path></svg>
                        <div class="field-control">
                            <label for="email">Email Address <span aria-hidden="true">*</span></label>
                            <input id="email" name="email" type="email" placeholder="Enter your email address" value="{{ old('email') }}" autocomplete="username" required autofocus>
                        </div>
                    </div>

                    <div class="field-row">
                        <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3M12 14v3"></path></svg>
                        <div class="field-control">
                            <label for="password">Password <span aria-hidden="true">*</span></label>
                            <div class="password-input">
                                <input id="password" name="password" type="password" placeholder="Enter your password" autocomplete="current-password" required>
                                <button class="toggle-password" type="button" aria-label="Show password" aria-pressed="false" data-password-toggle>
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2.5 12s3.3-6 9.5-6 9.5 6 9.5 6-3.3 6-9.5 6-9.5-6-9.5-6z"></path><circle cx="12" cy="12" r="2.5"></circle></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-option" for="remember">
                            <input id="remember" name="remember" type="checkbox" value="1">
                            <span>Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </div>

                    <button class="login-button" type="submit">Log In</button>
                </form>

                <p class="register-prompt">Don’t have an account? <a href="{{ route('register') }}">Register</a></p>
            </section>
        </main>
        <script>
            const passwordToggle = document.querySelector('[data-password-toggle]');
            passwordToggle.addEventListener('click', () => {
                const input = document.getElementById('password');
                const showing = input.type === 'password';
                input.type = showing ? 'text' : 'password';
                passwordToggle.setAttribute('aria-label', showing ? 'Hide password' : 'Show password');
                passwordToggle.setAttribute('aria-pressed', String(showing));
            });
        </script>
    </body>
</html>
