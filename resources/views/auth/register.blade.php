<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create Resident Account | Barangay Ward II</title>
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

            .register-shell {
                width: min(100%, 1120px);
                min-height: min(650px, calc(100vh - 32px));
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
                    url('{{ asset('images/city-hall-background.png') }}') center 45% / cover;
            }

            .brand {
                min-height: 78px;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
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
                padding: 24px 28px 30px;
                background: linear-gradient(155deg, rgba(7, 85, 160, 0.4), rgba(7, 62, 125, 0.82) 85%);
            }

            .intro-copy h1 {
                max-width: 360px;
                margin: 0 0 24px;
                font-size: clamp(1.2rem, 2vw, 1.6rem);
                line-height: 1.38;
                font-weight: 700;
            }

            .intro-note {
                display: flex;
                align-items: center;
                gap: 12px;
                color: #e2efff;
                font-size: 0.84rem;
                line-height: 1.55;
            }

            .intro-note-icon {
                width: 36px;
                height: 36px;
                display: grid;
                flex: 0 0 36px;
                place-items: center;
                border-radius: 50%;
                background: #f4f9ff;
                color: #07509a;
            }

            .intro-note-icon svg {
                width: 20px;
                height: 20px;
            }

            .form-panel {
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 20px clamp(24px, 4vw, 56px);
            }

            .back-home {
                align-self: flex-start;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 16px;
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
                margin-bottom: 14px;
            }

            .user-icon {
                width: 44px;
                height: 44px;
                display: grid;
                flex: 0 0 44px;
                place-items: center;
                border-radius: 12px;
                background: #e6f1fc;
                color: #0759a8;
            }

            .user-icon svg {
                width: 28px;
                height: 28px;
            }

            .form-heading h2 {
                margin: 0;
                color: #143f6c;
                font-size: 1.3rem;
                line-height: 1.3;
            }

            .form-heading p {
                margin: 3px 0 0;
                color: #66809b;
                font-size: 0.8rem;
            }

            .register-form {
                display: grid;
                gap: 8px;
            }

            .form-alert {
                margin-bottom: 14px;
                padding: 11px 13px;
                border: 1px solid #b8dfc2;
                border-radius: 7px;
                background: #effaf1;
                color: #24613a;
                font-size: 0.8rem;
                line-height: 1.5;
            }

            .form-errors {
                border-color: #f0c5c5;
                background: #fff3f3;
                color: #8b2525;
            }

            .form-errors ul {
                margin: 0;
                padding-left: 18px;
            }

            .field-row {
                display: grid;
                grid-template-columns: 28px minmax(0, 1fr);
                align-items: center;
                gap: 10px;
            }

            .field-icon {
                width: 21px;
                height: 21px;
                color: #15548c;
                stroke: currentColor;
                fill: none;
                stroke-width: 1.8;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .field-control label {
                display: block;
                margin-bottom: 4px;
                color: #345c80;
                font-size: 0.77rem;
                font-weight: 700;
            }

            .field-control input {
                width: 100%;
                height: 38px;
                padding: 0 12px;
                border: 1px solid #d7e1eb;
                border-radius: 7px;
                outline: none;
                background: #fff;
                color: #153e65;
                font: inherit;
                font-size: 0.78rem;
                transition: border-color 0.15s ease, box-shadow 0.15s ease;
            }

            .field-control input::placeholder {
                color: #9aabba;
            }

            .field-control input:focus {
                border-color: #3280c5;
                box-shadow: 0 0 0 3px rgba(50, 128, 197, 0.13);
            }

            .role-field {
                display: flex;
                align-items: center;
                justify-content: space-between;
                min-height: 35px;
                padding: 0 11px;
                border: 1px solid #d7e1eb;
                border-radius: 7px;
                background: #f5f9fd;
                color: #345c80;
                font-size: 0.78rem;
                font-weight: 700;
            }

            .role-badge {
                padding: 4px 9px;
                border-radius: 999px;
                background: #e1effb;
                color: #0756a8;
                font-size: 0.7rem;
                font-weight: 800;
            }

            .terms-row {
                width: calc(100% - 38px);
                justify-self: end;
                display: flex;
                align-items: flex-start;
                gap: 9px;
                color: #617a94;
                font-size: 0.73rem;
                line-height: 1.55;
            }

            .terms-row input {
                width: 16px;
                height: 16px;
                flex: 0 0 16px;
                margin: 2px 0 0;
                accent-color: #0756a8;
            }

            .terms-row a {
                text-decoration: underline;
                text-underline-offset: 2px;
            }

            .terms-error {
                width: calc(100% - 38px);
                justify-self: end;
                margin: -5px 0 0;
                color: #a32626;
                font-size: 0.72rem;
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

            .register-button {
                width: calc(100% - 38px);
                min-height: 40px;
                justify-self: end;
                margin-top: 2px;
                border: 0;
                border-radius: 7px;
                background: linear-gradient(180deg, #1877d1, #0756a8);
                color: #fff;
                font: inherit;
                font-size: 0.9rem;
                font-weight: 800;
                cursor: pointer;
            }

            .register-button:hover {
                background: linear-gradient(180deg, #126dc3, #064d99);
            }

            .login-prompt {
                width: calc(100% - 38px);
                justify-self: end;
                margin: 12px 0 0;
                color: #6b8197;
                text-align: center;
                font-size: 0.76rem;
            }

            .login-prompt a {
                margin-left: 8px;
            }

            .terms-details {
                width: calc(100% - 38px);
                align-self: flex-end;
                margin-top: 5px;
                color: #617a94;
                font-size: 0.7rem;
                line-height: 1.5;
            }

            .terms-details summary {
                color: #075aab;
                cursor: pointer;
                font-weight: 700;
            }

            .terms-details p {
                margin: 5px 0 0;
            }

            @media (min-width: 721px) and (max-height: 760px) {
                .register-shell {
                    min-height: calc(100vh - 24px);
                }

                .brand {
                    min-height: 64px;
                }

                .intro-copy {
                    padding: 18px 24px 22px;
                }

                .intro-copy h1 {
                    margin-bottom: 14px;
                    font-size: 1.25rem;
                }

                .form-panel {
                    padding-block: 12px;
                }

                .form-heading {
                    margin-bottom: 10px;
                }

                .register-form {
                    gap: 6px;
                }

                .field-control input {
                    height: 35px;
                }

                .register-button {
                    min-height: 36px;
                }
            }

            @media (max-width: 720px) {
                body {
                    padding: 14px;
                }

                .register-shell {
                    width: min(100%, 500px);
                    grid-template-columns: 1fr;
                }

                .brand {
                    min-height: 70px;
                    padding-inline: 20px;
                }

                .intro-copy {
                    padding: 20px;
                }

                .intro-copy h1 {
                    margin-bottom: 14px;
                }

                .form-panel {
                    padding: 28px 22px;
                }
            }

            @media (max-width: 380px) {
                body {
                    padding: 8px;
                }

                .form-panel {
                    padding-inline: 16px;
                }

                .field-row {
                    grid-template-columns: 22px minmax(0, 1fr);
                    gap: 7px;
                }
            }
        </style>
    </head>
    <body>
        <main class="register-shell">
            <aside class="intro-panel">
                <div class="brand">
                    <div class="brand-mark">BARANGAY WARD II</div>
                    <div class="brand-subtitle">Barangay Blotter and Monitoring System</div>
                </div>
                <div class="intro-copy">
                    <h1>Join our community and help make a safer, cleaner, and stronger Barangay.</h1>
                    <div class="intro-note">
                        <span class="intro-note-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3"></circle><path d="M5.5 20v-1.5a6.5 6.5 0 0 1 13 0V20z"></path></svg>
                        </span>
                        <span>Report concerns, track progress, and be part of the change.</span>
                    </div>
                </div>
            </aside>

            <section class="form-panel" aria-labelledby="register-title">
                <a class="back-home" href="{{ url('/') }}">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m14 18-6-6 6-6"></path><path d="M8 12h12"></path></svg>
                    <span>Back to Home</span>
                </a>

                <div class="form-heading">
                    <span class="user-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="7" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>
                    </span>
                    <div>
                        <h2 id="register-title">Create Resident Account</h2>
                        <p>Fill in your details to get started.</p>
                    </div>
                </div>

                @if (session('status'))
                    <div class="form-alert" role="status">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="form-alert form-errors" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="register-form" method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="field-row">
                        <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="3.5"></circle><path d="M5 20v-1.5a7 7 0 0 1 14 0V20z"></path></svg>
                        <div class="field-control">
                            <label for="name">Full Name <span aria-hidden="true">*</span></label>
                            <input id="name" name="name" type="text" placeholder="Enter your full name" value="{{ old('name') }}" autocomplete="name" required>
                        </div>
                    </div>

                    <div class="field-row">
                        <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0z"></path><circle cx="12" cy="10" r="2.5"></circle></svg>
                        <div class="field-control">
                            <label for="address">Address / Purok <span aria-hidden="true">*</span></label>
                            <input id="address" name="address" type="text" placeholder="Enter your address / purok" value="{{ old('address') }}" autocomplete="street-address" required>
                        </div>
                    </div>

                    <div class="field-row">
                        <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 3h3l2 5-2.2 1.7a15 15 0 0 0 4.5 4.5L16 12l5 2v3a3 3 0 0 1-3 3A15 15 0 0 1 4 6a3 3 0 0 1 3-3z"></path></svg>
                        <div class="field-control">
                            <label for="phone">Contact Number <span aria-hidden="true">*</span></label>
                            <input id="phone" name="phone" type="tel" placeholder="Enter your phone number" value="{{ old('phone') }}" autocomplete="tel" required>
                        </div>
                    </div>

                    <div class="field-row">
                        <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="m4 7 8 6 8-6"></path></svg>
                        <div class="field-control">
                            <label for="email">Email Address <span aria-hidden="true">*</span></label>
                            <input id="email" name="email" type="email" placeholder="Enter your email address" value="{{ old('email') }}" autocomplete="email" required>
                        </div>
                    </div>

                    <div class="field-row">
                        <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="3.5"></circle><path d="M5 20v-1.5a7 7 0 0 1 14 0V20z"></path></svg>
                        <div class="field-control">
                            <label>Account Role</label>
                            <div class="role-field" aria-label="Account role: Resident">
                                <span>Resident</span>
                                <span class="role-badge">Resident</span>
                            </div>
                        </div>
                    </div>

                    <div class="field-row">
                        <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3M12 14v3"></path></svg>
                        <div class="field-control">
                            <label for="password">Password <span aria-hidden="true">*</span></label>
                            <div class="password-input">
                                <input id="password" name="password" type="password" placeholder="Create a password" autocomplete="new-password" required>
                                <button class="toggle-password" type="button" aria-label="Show password" aria-pressed="false" data-password-toggle="password">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2.5 12s3.3-6 9.5-6 9.5 6 9.5 6-3.3 6-9.5 6-9.5-6-9.5-6z"></path><circle cx="12" cy="12" r="2.5"></circle></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="field-row">
                        <svg class="field-icon" viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"></rect><path d="M8 10V7a4 4 0 0 1 8 0v3M12 14v3"></path></svg>
                        <div class="field-control">
                            <label for="password_confirmation">Confirm Password <span aria-hidden="true">*</span></label>
                            <div class="password-input">
                                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm your password" autocomplete="new-password" required>
                                <button class="toggle-password" type="button" aria-label="Show password" aria-pressed="false" data-password-toggle="password_confirmation">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2.5 12s3.3-6 9.5-6 9.5 6 9.5 6-3.3 6-9.5 6-9.5-6-9.5-6z"></path><circle cx="12" cy="12" r="2.5"></circle></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <label class="terms-row" for="terms_accepted">
                        <input id="terms_accepted" name="terms_accepted" type="checkbox" value="1" @checked(old('terms_accepted')) required>
                        <span>I have read and agree to the <a href="#terms">Terms and Conditions</a> and <a href="#privacy">Data Privacy Policy</a>.</span>
                    </label>
                    @error('terms_accepted')
                        <p class="terms-error">{{ $message }}</p>
                    @enderror

                    <button class="register-button" type="submit">REGISTER</button>
                </form>

                <details id="terms" class="terms-details">
                    <summary>Terms and Conditions</summary>
                    <p>Register using accurate information and use this account only to access Barangay Ward II resident services. You are responsible for keeping your password private.</p>
                </details>
                <details id="privacy" class="terms-details">
                    <summary>Data Privacy Policy</summary>
                    <p>Your registration details are used to create and manage your resident account and support barangay services. By registering, you consent to this information being stored for those purposes.</p>
                </details>

                <p class="login-prompt">Already have an account? <a href="{{ route('login') }}">Log In</a></p>
            </section>
        </main>
        <script>
            document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
                toggle.addEventListener('click', () => {
                    const input = document.getElementById(toggle.dataset.passwordToggle);
                    const showing = input.type === 'password';
                    input.type = showing ? 'text' : 'password';
                    toggle.setAttribute('aria-label', showing ? 'Hide password' : 'Show password');
                    toggle.setAttribute('aria-pressed', String(showing));
                });
            });
        </script>
    </body>
</html>
