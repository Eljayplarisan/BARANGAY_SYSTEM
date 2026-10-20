<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Barangay Ward II</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                --navy-900: #012d53;
                --navy-800: #013d66;
                --navy-700: #014477;
                --navy-600: #0b5c8d;
                --navy-500: #1d73b7;
                --aqua-300: #8fd9ff;
                --aqua-200: #b5ebff;
                --sky-100: #eaf7ff;
                --white: #ffffff;
                --pill: #d9eefb;
                --text: #123d63;
                --muted: #3a6e97;
                --shadow: rgba(6, 25, 55, 0.18);
            }

            * { box-sizing: border-box; }

            html, body {
                margin: 0;
                min-height: 100%;
                font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
                background: #eef5f9;
                color: var(--text);
            }

            body {
                display: flex;
                justify-content: center;
            }

            a { text-decoration: none; }

            .page-shell {
                width: 100%;
                max-width: 1440px;
                min-height: 100vh;
                background: #f4f8fb;
            }

            .topbar {
                background: linear-gradient(180deg, rgba(0,46,83,1) 0%, rgba(0,60,101,1) 100%);
                color: var(--white);
                padding: 18px 48px 17px 42px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: inset 0 -1px 0 rgba(255,255,255,0.12);
            }

            .brand {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 2px;
            }

            .brand-mark {
                font-size: clamp(1.4rem, 1.4vw, 2rem);
                font-weight: 800;
                letter-spacing: 0.04em;
                line-height: 1.1;
                display: block;
            }

            .brand-subtitle {
                font-size: 0.78rem;
                color: #dfeefb;
                font-weight: 500;
                letter-spacing: 0.01em;
            }

            .nav {
                display: flex;
                align-items: center;
                gap: 28px;
                font-weight: 600;
            }

            .nav a {
                color: rgba(255,255,255,0.9);
                font-size: 0.96rem;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .nav a.active {
                color: #6fe0ff;
            }

            .nav a.active::before {
                content: "";
                width: 8px;
                height: 8px;
                background: #7fe4ff;
                border-radius: 999px;
                display: inline-block;
                box-shadow: 0 0 12px rgba(127,228,255,0.75);
            }

            .login-btn {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                border: 1px solid rgba(255,255,255,0.3);
                background: rgba(74,180,255,0.12);
                color: var(--white);
                border-radius: 999px;
                padding: 10px 18px;
                font-weight: 700;
                box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
            }

            .login-btn svg {
                width: 18px;
                height: 18px;
                stroke: currentColor;
            }

            .hero {
                position: relative;
                background:
                    linear-gradient(90deg, rgba(1,42,70,0.88) 0%, rgba(1,42,70,0.78) 35%, rgba(2,70,104,0.56) 100%),
                    url('{{ asset('images/city-hall-background.png') }}') center / cover;
                padding: 32px 42px 0 42px;
                display: grid;
                grid-template-columns: 1fr;
                min-height: 500px;
                overflow: hidden;
            }

            .hero-copy {
                position: relative;
                z-index: 1;
            }

            .hero-copy {
                padding: 36px 18px 0 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .eyebrow {
                color: #7fe2ff;
                font-size: 1.02rem;
                font-weight: 800;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                margin-bottom: 18px;
            }

            .hero-copy h1 {
                margin: 0;
                font-size: clamp(2.5rem, 4vw, 5rem);
                line-height: 0.93;
                letter-spacing: -0.05em;
                color: #f5fbff;
                max-width: 560px;
                font-weight: 800;
            }

            .hero-copy h1 .highlight {
                color: #7ae0ff;
            }

            .hero-copy p {
                margin: 26px 0 0;
                max-width: 520px;
                font-size: 1.06rem;
                color: rgba(232,245,255,0.9);
                line-height: 1.6;
            }

            .cta-row {
                margin-top: 30px;
                display: flex;
                gap: 18px;
                flex-wrap: wrap;
            }

            .primary-btn,
            .secondary-btn,
            .action-btn,
            .report-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                min-height: 56px;
                border-radius: 16px;
                padding: 0 24px;
                border: 0;
                cursor: pointer;
                font-weight: 800;
                font-size: 1.02rem;
                transition: transform 0.18s ease, box-shadow 0.18s ease;
            }

            .primary-btn:hover,
            .secondary-btn:hover,
            .action-btn:hover,
            .report-btn:hover {
                transform: translateY(-1px);
            }

            .primary-btn {
                background: linear-gradient(180deg, #1c8fe9 0%, #0d6ec7 100%);
                color: var(--white);
                box-shadow: 0 14px 24px rgba(18, 118, 196, 0.28);
            }

            .secondary-btn {
                background: rgba(255,255,255,0.08);
                border: 1px solid rgba(255,255,255,0.5);
                color: var(--white);
            }

            .primary-btn svg,
            .secondary-btn svg,
            .action-btn svg,
            .report-btn svg,
            .mini-icon svg,
            .panel-icon svg,
            .circle svg {
                width: 20px;
                height: 20px;
                stroke: currentColor;
                fill: none;
                stroke-width: 2.1;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .main-cards {
                margin: 0 42px;
                display: grid;
                grid-template-columns: 1fr 1.4fr;
                gap: 22px;
                background: transparent;
                position: relative;
                top: -22px;
            }

            .card {
                background: rgba(225, 242, 255, 0.85);
                border: 1px solid rgba(83, 137, 182, 0.18);
                border-radius: 22px;
                box-shadow: 0 10px 28px rgba(30, 86, 130, 0.12);
            }

            .login-card,
            .report-card {
                padding: 18px 18px 24px;
                min-height: 270px;
            }

            .top-card {
                display: flex;
                align-items: center;
                gap: 14px;
                margin-bottom: 16px;
            }

            .panel-icon {
                width: 52px;
                height: 52px;
                border-radius: 16px;
                background: linear-gradient(180deg, #ebf7ff 0%, #d6ecff 100%);
                color: #0d6ec7;
                display: grid;
                place-items: center;
            }

            .panel-title {
                margin: 0;
                font-size: clamp(1.2rem, 2vw, 2.1rem);
                line-height: 1.2;
                color: #0c3b66;
                letter-spacing: -0.05em;
            }

            .account-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 18px;
                margin-top: 12px;
            }

            .account-box {
                background: rgba(255,255,255,0.2);
                border: 1px solid rgba(40, 104, 175, 0.18);
                border-radius: 18px;
                padding: 18px 18px 14px;
                min-height: 170px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .account-box h4 {
                margin: 0 0 8px;
                font-size: 1.04rem;
                color: #0f4f8d;
            }

            .account-box p {
                margin: 0;
                flex: 1;
                color: #3f6f9f;
                font-size: 0.92rem;
                line-height: 1.5;
            }

            .account-box .action-btn {
                width: 100%;
                margin-top: 18px;
                background: linear-gradient(180deg, #1e86de 0%, #0c70c7 100%);
                color: var(--white);
                min-height: 42px;
                border-radius: 12px;
                font-size: 0.95rem;
                padding-inline: 18px;
            }

            .report-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 18px;
                margin-top: 12px;
            }

            .report-box {
                background: rgba(255,255,255,0.15);
                border: 1px solid rgba(40, 104, 175, 0.18);
                border-radius: 18px;
                padding: 20px 18px 16px;
                display: flex;
                flex-direction: column;
                min-height: 190px;
            }

            .report-box .mini-icon {
                width: 46px;
                height: 46px;
                border-radius: 14px;
                background: linear-gradient(180deg, #fee5c6 0%, #d8ecff 100%);
                color: #0b6ec5;
                display: grid;
                place-items: center;
                margin-bottom: 12px;
            }

            .report-box h4 {
                margin: 0 0 8px;
                font-size: 1.05rem;
                color: #0f4f8d;
            }

            .report-box p {
                margin: 0;
                flex: 1;
                color: #3f6f9f;
                font-size: 0.9rem;
                line-height: 1.5;
            }

            .report-btn {
                width: 100%;
                margin-top: 16px;
                background: linear-gradient(180deg, #1e86de 0%, #0c70c7 100%);
                color: var(--white);
                min-height: 42px;
                border-radius: 12px;
                font-size: 0.95rem;
            }

            .selected-report {
                margin: 10px 42px 4px;
                background: rgba(227, 242, 255, 0.85);
                border: 1px solid rgba(83, 137, 182, 0.18);
                border-radius: 16px;
                padding: 16px 18px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
            }

            .selected-report .selected-meta {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .selected-report .mini-icon {
                width: 38px;
                height: 38px;
                border-radius: 12px;
                background: linear-gradient(180deg, #dff3ff 0%, #cfeaff 100%);
                color: #0a66b7;
                display: grid;
                place-items: center;
            }

            .selected-label {
                color: #496d92;
                font-size: 0.7rem;
                letter-spacing: 0.14em;
                font-weight: 800;
                text-transform: uppercase;
            }

            .selected-report strong {
                color: #0d4a82;
                font-size: 1.08rem;
                display: block;
                margin-top: 2px;
            }

            .change-link {
                color: #0d6ec7;
                font-weight: 700;
                cursor: pointer;
                font-size: 0.95rem;
            }

            .note-box {
                margin: 18px 42px 0;
                display: flex;
                gap: 8px;
                align-items: center;
                background: rgba(221, 238, 250, 0.72);
                border: 1px solid rgba(83, 137, 182, 0.18);
                border-radius: 16px;
                padding: 16px 18px;
                color: #2b5d86;
                font-size: 0.95rem;
                line-height: 1.5;
            }

            .note-box .note-badge {
                width: 26px;
                height: 26px;
                border-radius: 50%;
                background: #dfeefb;
                display: grid;
                place-items: center;
                color: #0d6ec7;
                font-size: 1rem;
                flex-shrink: 0;
            }

            .bottom-grid {
                margin: 30px 42px 0;
                padding: 0 0 18px;
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 18px;
            }

            .info-card {
                background: rgba(227, 242, 255, 0.75);
                border: 1px solid rgba(83, 137, 182, 0.18);
                border-radius: 18px;
                padding: 16px 18px 18px;
                min-height: 140px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .info-card .row {
                display: flex;
                align-items: center;
                gap: 14px;
                margin-bottom: 8px;
            }

            .info-card .circle {
                width: 52px;
                height: 52px;
                border-radius: 50%;
                background: linear-gradient(180deg, #d8efff 0%, #c5ebff 100%);
                color: #0a66b7;
                display: grid;
                place-items: center;
            }

            .info-card h4 {
                margin: 0;
                color: #0d477e;
                font-size: 1.18rem;
                letter-spacing: -0.03em;
            }

            .info-card p {
                margin: 0;
                color: #3d6d97;
                line-height: 1.55;
                font-size: 0.96rem;
            }

            .site-footer {
                background: linear-gradient(180deg, rgba(1,43,73,1) 0%, rgba(1,30,59,1) 100%);
                color: rgba(255,255,255,0.9);
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                padding: 24px 42px 26px;
                margin-top: 26px;
                position: relative;
                overflow: hidden;
            }

            .site-footer::before {
                content: "";
                position: absolute;
                left: -8%;
                right: -8%;
                bottom: 70%;
                height: 120px;
                background: rgba(109, 185, 224, 0.18);
                border-radius: 50% 50% 0 0 / 100% 100% 0 0;
                transform: rotate(-2deg);
            }

            .footer-copy,
            .footer-links {
                position: relative;
                z-index: 1;
            }

            .footer-copy {
                font-size: 0.96rem;
                color: rgba(255,255,255,0.9);
            }

            .footer-copy strong {
                font-weight: 800;
            }

            .footer-links {
                display: flex;
                align-items: center;
                gap: 20px;
                font-size: 0.9rem;
                color: rgba(255,255,255,0.9);
            }

            .footer-links a {
                color: rgba(255,255,255,0.9);
            }

            @media (max-width: 1100px) {
                .hero {
                    grid-template-columns: 1fr;
                    padding-bottom: 16px;
                }

                .hero-copy {
                    padding-top: 18px;
                }

                .main-cards {
                    grid-template-columns: 1fr;
                    margin-top: 20px;
                }

                .bottom-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 720px) {
                .topbar {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 16px;
                }

                .nav {
                    flex-wrap: wrap;
                    gap: 14px 18px;
                }

                .hero, .main-cards, .selected-report, .note-box, .bottom-grid, .site-footer {
                    margin-left: 16px;
                    margin-right: 16px;
                }

                .hero {
                    padding-left: 16px;
                    padding-right: 16px;
                }

                .account-grid,
                .report-grid {
                    grid-template-columns: 1fr;
                }

                .site-footer {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
                }
            }
        </style>
    </head>
    <body>
        <div class="page-shell">
            <header class="topbar">
                <div class="brand" aria-label="Barangay Ward II logo and name">
                    <div class="brand-mark">BARANGAY WARD II</div>
                    <div class="brand-subtitle">Barangay Blotter and Monitoring System</div>
                </div>

                <nav class="nav" aria-label="Main navigation">
                    <a href="#" class="active">Home</a>
                    <a href="#">About</a>
                    <a href="#">Contact</a>
                    <a href="{{ route('login') }}" class="login-btn">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 10V8a4 4 0 1 1 8 0v2M6 10h12v9H6z"></path></svg>
                        Log In
                    </a>
                </nav>
            </header>

            <main>
                <section class="hero">
                    <div class="hero-copy">
                        <div class="eyebrow">Safe • clean • orderly</div>
                        <h1>
                            A safer and stronger<br>
                            community, <span class="highlight">together.</span>
                        </h1>
                        <p>
                            Report and monitor your community concerns,
                            for a cleaner, safer, and more responsive
                            Barangay Ward II.
                        </p>

                        <div class="cta-row">
                            <button class="primary-btn" type="button">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 4.5h8l3 3v11.5A2 2 0 0 1 17 21H7a2 2 0 0 1-2-2V6.5a2 2 0 0 1 2-2zm0 0V8h8V4.5"></path><path d="M9 13h6M9 17h6"></path></svg>
                                Report a Concern
                            </button>
                            <button class="secondary-btn" type="button">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20.5a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15zm0-11.5V12l3 3"></path></svg>
                                Track My Report
                            </button>
                        </div>
                    </div>

                </section>

                <section class="main-cards">
                    <div class="card login-card">
                        <div class="top-card">
                            <div class="panel-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M8 11V9a4 4 0 1 1 8 0v2M6 11h12v8H6z"></path></svg>
                            </div>
                            <h2 class="panel-title">Sign in to continue your report</h2>
                        </div>

                        <div class="account-grid">
                            <div class="account-box">
                                <h4>Already have an account?</h4>
                                <p>Log in to your existing account before continuing to your dashboard.</p>
                                <a class="action-btn" href="{{ route('login') }}">Log In</a>
                            </div>
                            <div class="account-box">
                                <h4>New resident account</h4>
                                <p>Register to access your resident dashboard and begin your selected report.</p>
                                <a class="action-btn" href="{{ route('register') }}">Register</a>
                            </div>
                        </div>
                    </div>

                    <div class="card report-card">
                        <div class="top-card">
                            <div class="panel-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M7 4.5h7l4 4v11a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-13a2 2 0 0 1 2-2z"></path><path d="M14 4.5V9h4"></path><path d="M8 13h8M8 17h8"></path></svg>
                            </div>
                            <h2 class="panel-title">What would you like to report?</h2>
                        </div>

                        <div class="report-grid">
                            <div class="report-box">
                                <div class="mini-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M7 4.5h7l4 4v11a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-13a2 2 0 0 1 2-2z"></path><path d="M14 4.5V9h4"></path><path d="M8 13h8M8 17h8"></path></svg>
                                </div>
                                <h4>Blotter Report</h4>
                                <p>Report an incident or situation that needs the attention of the barangay.</p>
                                <button class="report-btn" type="button">Choose Blotter Report</button>
                            </div>

                            <div class="report-box">
                                <div class="mini-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M12 3v4m0 10v4M3 12h4m10 0h4M7.5 7.5l2.8 2.8m5.4 5.4 2.8 2.8m0-11l-2.8 2.8m-5.4 5.4-2.8 2.8"></path></svg>
                                </div>
                                <h4>Maintenance Report</h4>
                                <p>Report a community maintenance issue, such as a pothole or damaged streetlight.</p>
                                <button class="report-btn" type="button">Choose Maintenance Report</button>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="selected-report">
                    <div class="selected-meta">
                        <div class="mini-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M7 4.5h7l4 4v11a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-13a2 2 0 0 1 2-2z"></path><path d="M14 4.5V9h4"></path><path d="M8 13h8M8 17h8"></path></svg>
                        </div>
                        <div>
                            <div class="selected-label">Selected report</div>
                            <strong>Blotter Report</strong>
                        </div>
                    </div>
                    <div class="change-link">Change report</div>
                </div>

                <div class="note-box">
                    <div class="note-badge" aria-hidden="true">i</div>
                    <div>
                        An account is required to submit a report.<br>
                        New here? Register after choosing a report. Have an account but not signed in? Log in to continue.<br>
                        Already signed in? Choosing either report takes you directly to your dashboard.
                    </div>
                </div>

                <section class="bottom-grid" aria-label="Support information">
                    <article class="info-card">
                        <div class="row">
                            <div class="circle" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M7 12h10M7 16h10M7 8h10M5 4.5h14a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-11a2 2 0 0 1 2-2z"></path></svg>
                            </div>
                            <h4>What can you report?</h4>
                        </div>
                        <p>Complaints, incidents, and community concerns.</p>
                    </article>

                    <article class="info-card">
                        <div class="row">
                            <div class="circle" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M7 4.5h7l4 4v11a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-13a2 2 0 0 1 2-2z"></path><path d="M14 4.5V9h4"></path><path d="M8 13h8M8 17h8"></path></svg>
                            </div>
                            <h4>How to report?</h4>
                        </div>
                        <p>Easy and simple steps to submit a report.</p>
                    </article>

                    <article class="info-card">
                        <div class="row">
                            <div class="circle" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M5 18.5v-7a7 7 0 0 1 14 0v7"></path><path d="M8 18.5v-4h8v4"></path><path d="M12 4.5V2"></path></svg>
                            </div>
                            <h4>Contact Us</h4>
                        </div>
                        <p>Barangay officials and contact information.</p>
                    </article>
                </section>
            </main>

            <footer class="site-footer">
                <div class="footer-copy"><strong>Barangay Ward II</strong> • Community Service. Our Priority.</div>
                <div class="footer-links">
                    <a href="#">Terms of Service</a>
                    <a href="#">Data Privacy Policy</a>
                </div>
            </footer>
        </div>
    </body>
</html>
