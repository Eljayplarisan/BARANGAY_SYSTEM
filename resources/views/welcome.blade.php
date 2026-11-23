<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @include('partials.mobile-head')
        <title>Barangay Ward II — Blotter & Community Monitoring Portal</title>
        <meta name="description" content="Official Barangay Ward II Blotter and Community Monitoring Portal. Report incidents, file community concerns, and track blotter resolutions online from your phone, laptop, or computer.">
        <link rel="canonical" href="{{ url('/') }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Barangay Ward II — Blotter & Community Monitoring Portal">
        <meta property="og:description" content="Report incidents, file community concerns, and track blotter resolutions online for Barangay Ward II.">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:image" content="{{ asset('images/barangay-logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
            :root {
                --navy-950: #011d38;
                --navy-900: #012b50;
                --navy-850: #023663;
                --navy-800: #03437a;
                --navy-700: #0a5699;
                --navy-600: #126ec0;
                --blue-500: #1a88e1;
                --blue-400: #42a5f5;
                --aqua-300: #7fd6ff;
                --aqua-200: #b5e8ff;
                --sky-100: #eaf6ff;
                --sky-50: #f4faff;
                --white: #ffffff;
                --card-bg: rgba(255, 255, 255, 0.92);
                --card-glass: rgba(240, 248, 255, 0.88);
                --card-border: rgba(144, 194, 238, 0.38);
                --card-hover-border: rgba(26, 136, 225, 0.6);
                --text-main: #0c3359;
                --text-muted: #3a6286;
                --text-light: #6d93b6;
                --blotter-red: #ea1d42;
                --blotter-red-bg: #fff1f4;
                --blotter-red-border: #fca5b5;
                --teal-green: #0a9b88;
                --teal-green-bg: #eafaf7;
                --teal-green-border: #99e6db;
                --amber-gold: #c27d00;
                --amber-gold-bg: #fff8e8;
                --shadow-sm: 0 2px 8px rgba(1, 35, 66, 0.06);
                --shadow-md: 0 8px 24px rgba(1, 35, 66, 0.09);
                --shadow-lg: 0 16px 36px rgba(1, 35, 66, 0.12);
                --shadow-xl: 0 24px 50px rgba(1, 35, 66, 0.16);
                --radius-sm: 8px;
                --radius-md: 14px;
                --radius-lg: 20px;
                --radius-xl: 26px;
                --radius-full: 9999px;
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            html {
                scroll-behavior: smooth;
                overflow-x: hidden;
            }

            body {
                min-height: 100vh;
                font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                background: linear-gradient(180deg, #e7f2fa 0%, #f1f8fc 100%);
                color: var(--text-main);
                display: flex;
                justify-content: center;
                overflow-x: hidden;
                -webkit-font-smoothing: antialiased;
            }

            section[id],
            article[id] {
                scroll-margin-top: 84px;
            }

            a {
                text-decoration: none;
                color: inherit;
            }

            button {
                font-family: inherit;
                cursor: pointer;
                border: none;
                background: none;
            }

            /* Container Shell */
            .page-shell {
                width: 100%;
                max-width: 1440px;
                min-height: 100vh;
                background: #f5f9fc;
                box-shadow: 0 0 50px rgba(1, 35, 66, 0.1);
                display: flex;
                flex-direction: column;
            }

            /* Top Bar */
            .topbar {
                background: linear-gradient(135deg, #012445 0%, #01345f 60%, #024379 100%);
                color: var(--white);
                padding: 14px 44px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: 0 4px 18px rgba(0, 24, 48, 0.22);
                position: sticky;
                top: 0;
                z-index: 100;
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 14px;
                transition: opacity 0.2s ease;
            }

            .brand:hover {
                opacity: 0.95;
            }

            .brand-seal-wrap {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                background: #ffffff;
                padding: 2px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.28), 0 0 0 2px rgba(127, 214, 255, 0.5);
                flex-shrink: 0;
            }

            .brand-seal {
                width: 100%;
                height: 100%;
                object-fit: contain;
                border-radius: 50%;
            }

            .brand-text {
                display: flex;
                flex-direction: column;
                line-height: 1.15;
            }

            .brand-mark {
                font-size: 1.28rem;
                font-weight: 800;
                letter-spacing: 0.04em;
                color: #ffffff;
                text-transform: uppercase;
            }

            .brand-subtitle {
                font-size: 0.74rem;
                color: #cbe7ff;
                font-weight: 500;
                letter-spacing: 0.02em;
            }

            .nav {
                display: flex;
                align-items: center;
                gap: 24px;
                font-weight: 600;
            }

            .nav-link {
                color: rgba(255, 255, 255, 0.85);
                font-size: 0.92rem;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 6px 12px;
                border-radius: var(--radius-full);
                transition: all 0.2s ease;
            }

            .nav-link:hover {
                color: #ffffff;
                background: rgba(255, 255, 255, 0.1);
            }

            .nav-link.active {
                color: #7fd6ff;
                background: rgba(127, 214, 255, 0.12);
            }

            .nav-link.active::before {
                content: "";
                width: 6px;
                height: 6px;
                background: #7fd6ff;
                border-radius: 50%;
                box-shadow: 0 0 8px #7fd6ff;
            }

            .auth-btn {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: linear-gradient(135deg, #167ad4 0%, #0c5ea8 100%);
                color: var(--white);
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: var(--radius-full);
                padding: 9px 20px;
                font-size: 0.9rem;
                font-weight: 700;
                box-shadow: 0 4px 14px rgba(9, 74, 134, 0.38);
                transition: all 0.2s ease;
            }

            .auth-btn:hover {
                background: linear-gradient(135deg, #1c89ec 0%, #116ec2 100%);
                transform: translateY(-1px);
                box-shadow: 0 6px 18px rgba(9, 74, 134, 0.5);
                color: #ffffff;
            }

            .auth-btn svg {
                width: 17px;
                height: 17px;
            }

            /* Hero Section */
            .hero {
                position: relative;
                background:
                    linear-gradient(90deg, rgba(1, 33, 61, 0.94) 0%, rgba(2, 45, 82, 0.88) 42%, rgba(2, 63, 112, 0.68) 100%),
                    url('{{ asset('images/city-hall-background.png') }}') center / cover no-repeat;
                padding: 56px 48px 72px 48px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                min-height: 480px;
                overflow: hidden;
            }

            .hero::after {
                content: "";
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 50px;
                background: linear-gradient(to top, #f5f9fc, transparent);
                pointer-events: none;
            }

            .hero-content {
                position: relative;
                z-index: 2;
                max-width: 660px;
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 6px 15px;
                background: rgba(127, 214, 255, 0.16);
                border: 1px solid rgba(127, 214, 255, 0.45);
                border-radius: var(--radius-full);
                color: #8ce1ff;
                font-size: 0.78rem;
                font-weight: 800;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                margin-bottom: 20px;
                backdrop-filter: blur(6px);
            }

            .hero-badge svg {
                width: 14px;
                height: 14px;
                fill: currentColor;
            }

            .hero h1 {
                font-size: clamp(2.3rem, 4vw, 3.8rem);
                font-weight: 800;
                line-height: 1.08;
                letter-spacing: -0.04em;
                color: #ffffff;
                margin-bottom: 18px;
            }

            .hero h1 .highlight {
                background: linear-gradient(135deg, #7fe0ff 0%, #a4eaff 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .hero-lead {
                font-size: clamp(1rem, 1.3vw, 1.15rem);
                color: rgba(226, 241, 255, 0.92);
                line-height: 1.6;
                margin-bottom: 32px;
                max-width: 540px;
            }

            .cta-group {
                display: flex;
                align-items: center;
                gap: 16px;
                flex-wrap: wrap;
            }

            .btn-primary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                background: linear-gradient(135deg, #1886e3 0%, #0d68bd 100%);
                color: #ffffff;
                font-size: 1rem;
                font-weight: 700;
                padding: 14px 28px;
                border-radius: var(--radius-md);
                box-shadow: 0 8px 22px rgba(14, 104, 189, 0.42);
                transition: all 0.2s ease;
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #2293f3 0%, #1077d7 100%);
                transform: translateY(-2px);
                box-shadow: 0 12px 28px rgba(14, 104, 189, 0.52);
                color: #ffffff;
            }

            .btn-secondary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
                font-size: 1rem;
                font-weight: 700;
                padding: 14px 26px;
                border-radius: var(--radius-md);
                border: 1px solid rgba(255, 255, 255, 0.4);
                backdrop-filter: blur(6px);
                transition: all 0.2s ease;
            }

            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.22);
                border-color: rgba(255, 255, 255, 0.7);
                transform: translateY(-2px);
                color: #ffffff;
            }

            .btn-icon svg {
                width: 19px;
                height: 19px;
                stroke: currentColor;
                stroke-width: 2.2;
                fill: none;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            /* Interactive Main Cards Container */
            .main-content {
                padding: 0 44px 30px;
                margin-top: -34px;
                position: relative;
                z-index: 10;
            }

            .interactive-cards-grid {
                display: grid;
                grid-template-columns: 1fr 1.35fr;
                gap: 26px;
                align-items: stretch;
            }

            .portal-card {
                background: var(--card-bg);
                border: 1px solid var(--card-border);
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-md);
                padding: 26px 26px 28px;
                display: flex;
                flex-direction: column;
                backdrop-filter: blur(14px);
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .portal-card:hover {
                box-shadow: var(--shadow-lg);
                border-color: rgba(26, 136, 225, 0.45);
            }

            .portal-header {
                display: flex;
                align-items: center;
                gap: 14px;
                margin-bottom: 20px;
                padding-bottom: 16px;
                border-bottom: 1px solid rgba(175, 213, 244, 0.35);
            }

            .portal-icon-box {
                width: 48px;
                height: 48px;
                border-radius: var(--radius-md);
                display: grid;
                place-items: center;
                flex-shrink: 0;
            }

            .portal-icon-box.auth {
                background: linear-gradient(135deg, #e3f2fd 0%, #cbe7ff 100%);
                color: #0b68bd;
            }

            .portal-icon-box.report {
                background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
                color: #0d8a70;
            }

            .portal-icon-box svg {
                width: 24px;
                height: 24px;
                stroke: currentColor;
                stroke-width: 2;
                fill: none;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .portal-title-wrap h2 {
                font-size: 1.32rem;
                font-weight: 800;
                color: var(--navy-900);
                letter-spacing: -0.02em;
                line-height: 1.2;
            }

            .portal-title-wrap p {
                font-size: 0.83rem;
                color: var(--text-muted);
                margin-top: 3px;
            }

            /* Sub-boxes for Login/Register */
            .sub-card-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                flex: 1;
            }

            .sub-card {
                background: #f7fbff;
                border: 1px solid #d4e7f8;
                border-radius: var(--radius-md);
                padding: 20px 18px 18px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                transition: all 0.2s ease;
            }

            .sub-card:hover {
                border-color: var(--blue-400);
                background: #ffffff;
                box-shadow: var(--shadow-sm);
                transform: translateY(-2px);
            }

            .sub-card h4 {
                font-size: 1.02rem;
                font-weight: 700;
                color: var(--navy-850);
                margin-bottom: 8px;
            }

            .sub-card p {
                font-size: 0.86rem;
                color: var(--text-muted);
                line-height: 1.5;
                margin-bottom: 18px;
                flex: 1;
            }

            .btn-card-action {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
                padding: 11px 16px;
                border-radius: var(--radius-sm);
                font-size: 0.9rem;
                font-weight: 700;
                transition: all 0.2s ease;
            }

            .btn-login {
                background: linear-gradient(135deg, #1877cb 0%, #0d5ea6 100%);
                color: #ffffff;
                box-shadow: 0 4px 12px rgba(13, 94, 166, 0.25);
            }

            .btn-login:hover {
                background: linear-gradient(135deg, #1d86e4 0%, #106bc0 100%);
                color: #ffffff;
                box-shadow: 0 6px 16px rgba(13, 94, 166, 0.38);
            }

            .btn-register {
                background: #ffffff;
                color: #0b61aa;
                border: 1.5px solid #a3cef5;
            }

            .btn-register:hover {
                background: #f0f7ff;
                border-color: #1a88e1;
                color: #084c87;
            }

            /* Report Choice Selection Boxes */
            .report-choice-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                flex: 1;
            }

            .report-choice-box {
                background: #f7fbff;
                border: 2px solid #d4e7f8;
                border-radius: var(--radius-md);
                padding: 22px 18px 18px;
                display: flex;
                flex-direction: column;
                cursor: pointer;
                transition: all 0.2s ease;
                position: relative;
            }

            .report-choice-box:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-sm);
            }

            .report-choice-box.active {
                background: #ffffff;
                border-color: #1a88e1;
                box-shadow: 0 6px 20px rgba(26, 136, 225, 0.22);
            }

            .report-choice-box.type-blotter.active {
                border-color: var(--blotter-red);
                box-shadow: 0 6px 20px rgba(234, 29, 66, 0.22);
            }

            .report-choice-box.type-complaint.active {
                border-color: var(--teal-green);
                box-shadow: 0 6px 20px rgba(10, 155, 136, 0.22);
            }

            .choice-badge {
                position: absolute;
                top: 14px;
                right: 14px;
                font-size: 0.68rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                padding: 3px 8px;
                border-radius: var(--radius-full);
            }

            .type-blotter .choice-badge {
                background: var(--blotter-red-bg);
                color: var(--blotter-red);
                border: 1px solid var(--blotter-red-border);
            }

            .type-complaint .choice-badge {
                background: var(--teal-green-bg);
                color: var(--teal-green);
                border: 1px solid var(--teal-green-border);
            }

            .choice-icon {
                width: 44px;
                height: 44px;
                border-radius: var(--radius-sm);
                display: grid;
                place-items: center;
                margin-bottom: 14px;
            }

            .type-blotter .choice-icon {
                background: #ffe5ea;
                color: var(--blotter-red);
            }

            .type-complaint .choice-icon {
                background: #e2f7f3;
                color: var(--teal-green);
            }

            .choice-icon svg {
                width: 22px;
                height: 22px;
                stroke: currentColor;
                stroke-width: 2.2;
                fill: none;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .report-choice-box h4 {
                font-size: 1.05rem;
                font-weight: 700;
                color: var(--navy-900);
                margin-bottom: 8px;
            }

            .report-choice-box p {
                font-size: 0.85rem;
                color: var(--text-muted);
                line-height: 1.5;
                margin-bottom: 18px;
                flex: 1;
            }

            .btn-select-report {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
                padding: 10px 14px;
                border-radius: var(--radius-sm);
                font-size: 0.88rem;
                font-weight: 700;
                border: 1.5px solid transparent;
                transition: all 0.2s ease;
            }

            .type-blotter .btn-select-report {
                background: #fff0f3;
                color: var(--blotter-red);
                border-color: var(--blotter-red-border);
            }

            .type-blotter.active .btn-select-report,
            .type-blotter .btn-select-report:hover {
                background: var(--blotter-red);
                color: #ffffff;
                border-color: var(--blotter-red);
            }

            .type-complaint .btn-select-report {
                background: #eafaf7;
                color: var(--teal-green);
                border-color: var(--teal-green-border);
            }

            .type-complaint.active .btn-select-report,
            .type-complaint .btn-select-report:hover {
                background: var(--teal-green);
                color: #ffffff;
                border-color: var(--teal-green);
            }

            /* Selected Report Tracker Banner */
            .selected-report-banner {
                margin-top: 24px;
                background: linear-gradient(135deg, #ffffff 0%, #f4faff 100%);
                border: 1.5px solid #aed6f8;
                border-radius: var(--radius-md);
                padding: 16px 24px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                box-shadow: var(--shadow-sm);
            }

            .selected-info {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .selected-indicator-icon {
                width: 40px;
                height: 40px;
                border-radius: var(--radius-sm);
                display: grid;
                place-items: center;
                background: #e3f2fd;
                color: #0b6abf;
                flex-shrink: 0;
            }

            .selected-indicator-icon svg {
                width: 22px;
                height: 22px;
                stroke: currentColor;
                stroke-width: 2.2;
                fill: none;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .selected-label {
                font-size: 0.72rem;
                font-weight: 800;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: var(--text-light);
            }

            .selected-title {
                font-size: 1.08rem;
                font-weight: 800;
                color: var(--navy-900);
            }

            .selected-actions {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .change-report-btn {
                font-size: 0.88rem;
                font-weight: 700;
                color: #0f6cbf;
                padding: 6px 12px;
                border-radius: var(--radius-sm);
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .change-report-btn:hover {
                background: #e6f3ff;
            }

            .btn-proceed-filing {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: linear-gradient(135deg, #1877cb 0%, #0c5ea6 100%);
                color: #ffffff;
                padding: 9px 18px;
                border-radius: var(--radius-sm);
                font-size: 0.88rem;
                font-weight: 700;
                transition: all 0.2s ease;
            }

            .btn-proceed-filing:hover {
                background: linear-gradient(135deg, #1e87e4 0%, #106bc0 100%);
                color: #ffffff;
                transform: translateY(-1px);
            }

            /* Informational Guidance Box */
            .guidance-notice {
                margin-top: 18px;
                background: rgba(223, 239, 252, 0.65);
                border: 1px solid #b7dcf8;
                border-radius: var(--radius-md);
                padding: 16px 20px;
                display: flex;
                align-items: flex-start;
                gap: 14px;
                color: #174a7a;
                font-size: 0.88rem;
                line-height: 1.55;
            }

            .notice-icon {
                width: 24px;
                height: 24px;
                border-radius: 50%;
                background: #0d6ec7;
                color: #ffffff;
                display: grid;
                place-items: center;
                font-weight: 800;
                font-size: 0.82rem;
                flex-shrink: 0;
                margin-top: 2px;
            }

            /* 3-Column Info & Support Section */
            .support-section {
                padding: 28px 44px 44px;
            }

            .section-heading-center {
                text-align: center;
                margin-bottom: 28px;
            }

            .section-heading-center h3 {
                font-size: 1.45rem;
                font-weight: 800;
                color: var(--navy-900);
                letter-spacing: -0.02em;
            }

            .section-heading-center p {
                font-size: 0.9rem;
                color: var(--text-muted);
                margin-top: 4px;
            }

            .support-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 22px;
            }

            .support-card {
                background: #ffffff;
                border: 1px solid #d8eaf8;
                border-radius: var(--radius-lg);
                padding: 24px 22px;
                box-shadow: var(--shadow-sm);
                display: flex;
                flex-direction: column;
                transition: all 0.2s ease;
            }

            .support-card:hover {
                transform: translateY(-3px);
                box-shadow: var(--shadow-md);
                border-color: #aed5f8;
            }

            .support-card-top {
                display: flex;
                align-items: center;
                gap: 14px;
                margin-bottom: 12px;
            }

            .support-circle-icon {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: grid;
                place-items: center;
                flex-shrink: 0;
            }

            .support-circle-icon.blue {
                background: #e5f3ff;
                color: #0b6ec5;
            }

            .support-circle-icon.teal {
                background: #e2f7f3;
                color: #0b8e7c;
            }

            .support-circle-icon.orange {
                background: #fff1e5;
                color: #c96810;
            }

            .support-circle-icon svg {
                width: 22px;
                height: 22px;
                stroke: currentColor;
                stroke-width: 2;
                fill: none;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .support-card-top h4 {
                font-size: 1.12rem;
                font-weight: 800;
                color: var(--navy-900);
            }

            .support-card p {
                font-size: 0.88rem;
                color: var(--text-muted);
                line-height: 1.6;
            }

            .support-card ul {
                list-style: none;
                margin-top: 10px;
            }

            .support-card ul li {
                font-size: 0.84rem;
                color: var(--text-muted);
                display: flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 6px;
            }

            .support-card ul li svg {
                width: 14px;
                height: 14px;
                stroke: #167ad4;
                stroke-width: 2.5;
                flex-shrink: 0;
            }

            /* Site Footer */
            .site-footer {
                margin-top: auto;
                background: linear-gradient(135deg, #011b33 0%, #012a4d 60%, #013763 100%);
                color: rgba(255, 255, 255, 0.88);
                padding: 30px 44px;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            .footer-content {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                flex-wrap: wrap;
            }

            .footer-brand-side {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .footer-seal {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: #ffffff;
                padding: 2px;
                object-fit: contain;
            }

            .footer-copy {
                font-size: 0.88rem;
                line-height: 1.4;
            }

            .footer-copy strong {
                color: #ffffff;
                font-weight: 700;
            }

            .footer-copy span {
                display: block;
                font-size: 0.76rem;
                color: #9ac4ea;
            }

            .footer-links {
                display: flex;
                align-items: center;
                gap: 22px;
                font-size: 0.84rem;
                font-weight: 500;
            }

            .footer-links a {
                color: rgba(255, 255, 255, 0.78);
                transition: color 0.2s ease;
            }

            .footer-links a:hover {
                color: #7fd6ff;
            }

            .mobile-menu-toggle {
                display: none;
                width: 44px;
                height: 44px;
                align-items: center;
                justify-content: center;
                border-radius: var(--radius-sm);
                border: 1px solid rgba(255, 255, 255, 0.28);
                background: rgba(255, 255, 255, 0.1);
                color: #ffffff;
                flex-shrink: 0;
            }

            .mobile-menu-toggle svg {
                width: 22px;
                height: 22px;
                stroke: currentColor;
                stroke-width: 2.2;
                fill: none;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            /* Responsive Design Breakpoints */
            @media (max-width: 1080px) {
                .interactive-cards-grid {
                    grid-template-columns: 1fr;
                }

                .support-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 768px) {
                .topbar {
                    padding: 12px 16px;
                    flex-wrap: wrap;
                    gap: 12px;
                }

                .brand {
                    gap: 10px;
                    min-width: 0;
                    flex: 1;
                }

                .brand-seal-wrap {
                    width: 40px;
                    height: 40px;
                }

                .brand-mark {
                    font-size: 1rem;
                }

                .brand-subtitle {
                    font-size: 0.68rem;
                }

                .mobile-menu-toggle {
                    display: inline-flex;
                }

                .nav {
                    display: none;
                    width: 100%;
                    flex-direction: column;
                    align-items: stretch;
                    gap: 8px;
                    padding-top: 12px;
                    border-top: 1px solid rgba(255, 255, 255, 0.14);
                }

                .nav.is-open {
                    display: flex;
                }

                .nav-link {
                    min-height: 44px;
                    padding: 10px 14px;
                    border-radius: var(--radius-sm);
                }

                .auth-btn {
                    min-height: 44px;
                    justify-content: center;
                    margin-top: 4px;
                }

                .hero {
                    min-height: auto;
                    padding: 34px 18px 56px;
                }

                .hero h1 {
                    font-size: clamp(1.85rem, 8vw, 2.3rem);
                }

                .hero-lead {
                    margin-bottom: 24px;
                    font-size: 0.96rem;
                }

                .main-content,
                .support-section {
                    padding-left: 16px;
                    padding-right: 16px;
                }

                .portal-card {
                    padding: 20px 16px 22px;
                }

                .sub-card-grid,
                .report-choice-grid {
                    grid-template-columns: 1fr;
                }

                .selected-report-banner {
                    flex-direction: column;
                    align-items: flex-start;
                    padding: 16px;
                }

                .selected-actions {
                    width: 100%;
                    justify-content: space-between;
                    flex-wrap: wrap;
                }

                .site-footer {
                    padding: 24px 18px calc(24px + env(safe-area-inset-bottom));
                }

                .footer-content {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 16px;
                }

                .footer-links {
                    flex-wrap: wrap;
                    gap: 12px 18px;
                }
            }

            @media (max-width: 480px) {
                .cta-group {
                    flex-direction: column;
                    align-items: stretch;
                }

                .btn-primary,
                .btn-secondary,
                .btn-card-action,
                .btn-select-report,
                .btn-proceed-filing {
                    min-height: 46px;
                    width: 100%;
                    justify-content: center;
                }

                .selected-actions {
                    flex-direction: column-reverse;
                    align-items: stretch;
                    gap: 10px;
                }

                .change-report-btn {
                    min-height: 42px;
                    text-align: center;
                }
            }
        </style>
    </head>
    <body>
        <div class="page-shell">
            <!-- Header / Top Bar -->
            <header class="topbar">
                <a href="{{ url('/') }}" class="brand" aria-label="Barangay Ward II Official Portal">
                    <div class="brand-seal-wrap">
                        <img class="brand-seal" src="{{ asset('images/barangay-logo.png') }}" alt="Official Barangay Seal">
                    </div>
                    <div class="brand-text">
                        <span class="brand-mark">BARANGAY WARD II</span>
                        <span class="brand-subtitle">Blotter & Community Monitoring System</span>
                    </div>
                </a>

                <button type="button" class="mobile-menu-toggle" id="mobile-menu-toggle" aria-expanded="false" aria-controls="main-nav" aria-label="Toggle navigation menu">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>

                <nav id="main-nav" class="nav" aria-label="Main Navigation">
                    <a href="{{ url('/') }}" class="nav-link active">Home</a>
                    <a href="#about-section" class="nav-link">About</a>
                    <a href="#support-section" class="nav-link">Services</a>
                    <a href="#contact-section" class="nav-link">Contact</a>

                    @auth
                        <a href="{{ route('resident.dashboard') }}" class="auth-btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="auth-btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                            Log In
                        </a>
                    @endauth
                </nav>
            </header>

            <main>
                <!-- Hero Banner -->
                <section class="hero" aria-labelledby="hero-title">
                    <div class="hero-content">
                        <div class="hero-badge">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2L3 7v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-9-5z"></path></svg>
                            Safe • Clean • Orderly — Official Portal
                        </div>
                        <h1 id="hero-title">
                            A safer and stronger<br>
                            community, <span class="highlight">together.</span>
                        </h1>
                        <p class="hero-lead">
                            Report incidents, request community assistance, and track blotter resolutions online for a cleaner, safer, and more responsive Barangay Ward II.
                        </p>

                        <div class="cta-group">
                            <a href="#report-portal" class="btn-primary btn-icon">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                                Report a Concern
                            </a>
                            @auth
                                <a href="{{ route('resident.reports.index') }}" class="btn-secondary btn-icon">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    Track My Reports
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-secondary btn-icon">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    Track My Report
                                </a>
                            @endauth
                        </div>
                    </div>
                </section>

                <!-- Interactive Main Gateway (Sign in + Report Choice) -->
                <section id="report-portal" class="main-content" aria-label="Resident Action Gateway">
                    <div class="interactive-cards-grid">

                        <!-- Left Card: Sign in / Account Portal -->
                        <div class="portal-card">
                            <div class="portal-header">
                                <div class="portal-icon-box auth" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </div>
                                <div class="portal-title-wrap">
                                    @auth
                                        <h2>Welcome back, {{ auth()->user()->name }}!</h2>
                                        <p>You are authenticated. Proceed directly to your resident services.</p>
                                    @else
                                        <h2>Sign in to continue your report</h2>
                                        <p>Authenticate your account to log and monitor community concerns.</p>
                                    @endauth
                                </div>
                            </div>

                            @auth
                                <div class="sub-card-grid">
                                    <div class="sub-card">
                                        <h4>Resident Dashboard</h4>
                                        <p>Access your central workspace to file blotters, submit complaints, or manage details.</p>
                                        <a class="btn-card-action btn-login" href="{{ route('resident.dashboard') }}">Open Dashboard</a>
                                    </div>
                                    <div class="sub-card">
                                        <h4>Track Submissions</h4>
                                        <p>Check real-time status updates and timelines of your active filed reports.</p>
                                        <a class="btn-card-action btn-register" href="{{ route('resident.reports.index') }}">My Reports</a>
                                    </div>
                                </div>
                            @else
                                <div class="sub-card-grid">
                                    <div class="sub-card">
                                        <h4>Already have an account?</h4>
                                        <p>Log in to your existing resident profile before continuing to your dashboard.</p>
                                        <a class="btn-card-action btn-login" href="{{ route('login') }}">Log In</a>
                                    </div>
                                    <div class="sub-card">
                                        <h4>New resident account</h4>
                                        <p>Register to access your resident dashboard and begin your selected report.</p>
                                        <a class="btn-card-action btn-register" href="{{ route('register') }}">Register</a>
                                    </div>
                                </div>
                            @endauth
                        </div>

                        <!-- Right Card: What would you like to report? -->
                        <div class="portal-card">
                            <div class="portal-header">
                                <div class="portal-icon-box report" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                                <div class="portal-title-wrap">
                                    <h2>What would you like to report?</h2>
                                    <p>Select your intended report type to load the appropriate intake protocol.</p>
                                </div>
                            </div>

                            <div class="report-choice-grid">
                                <!-- Choice 1: Blotter Report -->
                                <div id="choice-blotter" class="report-choice-box type-blotter active" onclick="selectReportType('blotter')">
                                    <span class="choice-badge">Official Record</span>
                                    <div class="choice-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                                    </div>
                                    <h4>Blotter Report</h4>
                                    <p>Report an incident, offense, or situation that requires official recording in the barangay blotter ledger.</p>
                                    <button class="btn-select-report" type="button" aria-label="Select Blotter Report">Choose Blotter Report</button>
                                </div>

                                <!-- Choice 2: Maintenance / Complaint Report -->
                                <div id="choice-complaint" class="report-choice-box type-complaint" onclick="selectReportType('complaint')">
                                    <span class="choice-badge">Community Issue</span>
                                    <div class="choice-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                                    </div>
                                    <h4>Maintenance Report</h4>
                                    <p>Report a public utility issue, such as damaged streetlights, potholes, drainage, or general civic concerns.</p>
                                    <button class="btn-select-report" type="button" aria-label="Select Maintenance Report">Choose Maintenance Report</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Selected Report Dynamic Status Indicator -->
                    <div class="selected-report-banner" role="status" aria-live="polite">
                        <div class="selected-info">
                            <div id="selected-badge-icon" class="selected-indicator-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            </div>
                            <div>
                                <span class="selected-label">Selected Report Mode</span>
                                <h3 id="selected-report-title" class="selected-title">Blotter Report</h3>
                            </div>
                        </div>

                        <div class="selected-actions">
                            <button class="change-report-btn" type="button" onclick="focusReportChoices()">Change report</button>
                            @auth
                                <a id="btn-proceed-direct" class="btn-proceed-filing" href="{{ route('resident.reports.create', ['type' => 'blotter']) }}">
                                    Proceed to File
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </a>
                            @else
                                <a id="btn-proceed-auth" class="btn-proceed-filing" href="{{ route('login') }}">
                                    Continue to Login
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Guidance Notice Box -->
                    <div class="guidance-notice">
                        <div class="notice-icon" aria-hidden="true">i</div>
                        <div>
                            <strong>An authenticated resident account is required to lodge an official report.</strong><br>
                            New here? Select your report type above, then proceed to <strong>Register</strong>. Have an account but not signed in? Click <strong>Log In</strong>. Already signed in? Choosing either report takes you straight to your protected filing form.
                        </div>
                    </div>
                </section>

                <!-- Information & Services Section -->
                <section id="about-section" class="support-section">
                    <div class="section-heading-center">
                        <h3>Citizen Support & Assistance Services</h3>
                        <p>Learn how Barangay Ward II assists residents with blotters, community maintenance, and mediation.</p>
                    </div>

                    <div class="support-grid">
                        <!-- Card 1 -->
                        <article class="support-card">
                            <div class="support-card-top">
                                <div class="support-circle-icon blue" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </div>
                                <h4>What can you report?</h4>
                            </div>
                            <p>Residents can file complaints, incidents, and community issues across 8 sanctioned classifications:</p>
                            <ul>
                                <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> Peace and Order & Dispute Blotters</li>
                                <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> Infrastructure & Utility Hazards</li>
                                <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> Health, Sanitation & Kasambahay</li>
                            </ul>
                        </article>

                        <!-- Card 2 -->
                        <article id="support-section" class="support-card">
                            <div class="support-card-top">
                                <div class="support-circle-icon teal" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
                                </div>
                                <h4>How to report?</h4>
                            </div>
                            <p>Our online reporting follows a secure, transparent, 3-step intake workflow:</p>
                            <ul>
                                <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> 1. Sign in or create a verified account</li>
                                <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> 2. Submit details, location, and photo/PDF</li>
                                <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> 3. Track resolution on your live timeline</li>
                            </ul>
                        </article>

                        <!-- Card 3 -->
                        <article id="contact-section" class="support-card">
                            <div class="support-card-top">
                                <div class="support-circle-icon orange" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                </div>
                                <h4>Contact Us</h4>
                            </div>
                            <p>Direct assistance is available at the Barangay Ward II Hall:</p>
                            <ul>
                                <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> Office Hours: Mon – Fri (8:00 AM – 5:00 PM)</li>
                                <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> Emergency Hotline: 911 / (02) 8123-4567</li>
                                <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg> Email: secretary@barangayward2.gov.ph</li>
                            </ul>
                        </article>
                    </div>
                </section>
            </main>

            <!-- Footer -->
            <footer class="site-footer">
                <div class="footer-content">
                    <div class="footer-brand-side">
                        <img class="footer-seal" src="{{ asset('images/barangay-logo.png') }}" alt="Barangay Seal">
                        <div class="footer-copy">
                            <strong>Barangay Ward II Blotter & Community Monitoring Portal</strong>
                            <span>Republic of the Philippines • Liga ng mga Barangay • Official Citizen Services</span>
                        </div>
                    </div>

                    <div class="footer-links">
                        <a href="{{ route('register') }}">Resident Registration</a>
                        <a href="{{ route('login') }}">Resident Login</a>
                        <a href="#about-section">Terms of Service</a>
                        <a href="#about-section">Data Privacy (RA 10173)</a>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Interactive Dynamic Selection Script -->
        <script>
            let currentType = 'blotter';

            function selectReportType(type) {
                currentType = type;
                const blotterBox = document.getElementById('choice-blotter');
                const complaintBox = document.getElementById('choice-complaint');
                const titleElem = document.getElementById('selected-report-title');
                const badgeIcon = document.getElementById('selected-badge-icon');
                const directProceedBtn = document.getElementById('btn-proceed-direct');

                if (type === 'blotter') {
                    blotterBox.classList.add('active');
                    complaintBox.classList.remove('active');
                    titleElem.textContent = 'Blotter Report';
                    badgeIcon.style.color = '#ea1d42';
                    badgeIcon.style.background = '#ffe5ea';
                    badgeIcon.innerHTML = '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>';
                    if (directProceedBtn) {
                        directProceedBtn.href = "{{ route('resident.reports.create') }}?type=blotter";
                    }
                } else {
                    complaintBox.classList.add('active');
                    blotterBox.classList.remove('active');
                    titleElem.textContent = 'Maintenance / Complaint Report';
                    badgeIcon.style.color = '#0a9b88';
                    badgeIcon.style.background = '#e2f7f3';
                    badgeIcon.innerHTML = '<svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>';
                    if (directProceedBtn) {
                        directProceedBtn.href = "{{ route('resident.reports.create') }}?type=complaint";
                    }
                }
            }

            function focusReportChoices() {
                const portal = document.getElementById('report-portal');
                if (portal) {
                    portal.scrollIntoView({ behavior: 'smooth' });
                }
            }

            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mainNav = document.getElementById('main-nav');
            if (mobileMenuToggle && mainNav) {
                mobileMenuToggle.addEventListener('click', () => {
                    const isOpen = mainNav.classList.toggle('is-open');
                    mobileMenuToggle.setAttribute('aria-expanded', String(isOpen));
                });

                mainNav.querySelectorAll('a').forEach((link) => {
                    link.addEventListener('click', () => {
                        mainNav.classList.remove('is-open');
                        mobileMenuToggle.setAttribute('aria-expanded', 'false');
                    });
                });
            }
        </script>
    </body>
</html>
