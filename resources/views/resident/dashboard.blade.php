<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @include('partials.mobile-head')
        <title>Resident Dashboard | Barangay Ward II</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                color-scheme: light;
                font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
                color: #123d70;
                background: #edf7ff;
            }

            * { box-sizing: border-box; }

            body {
                min-height: 100vh;
                margin: 0;
                padding: 7px;
                background: #e8f5ff;
            }

            button, a { font: inherit; }
            a { color: inherit; text-decoration: none; }

            .app-shell {
                max-width: 1440px;
                margin: 0 auto;
                min-height: calc(100vh - 14px);
                overflow: hidden;
                border: 1px solid #8bc8f3;
                border-radius: 12px;
                background: #fafdff;
                box-shadow: 0 10px 28px rgba(21, 89, 144, 0.12);
            }

            .topbar {
                min-height: 68px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                padding: 10px 28px;
                background: linear-gradient(110deg, #1375cf, #07519a 68%, #064987);
                color: #fff;
            }

            .brand {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 3px;
                min-width: 0;
            }

            .brand-mark {
                font-size: 1.05rem;
                font-weight: 800;
                letter-spacing: 0.035em;
                line-height: 1.2;
                display: block;
            }

            .brand-subtitle {
                margin-top: 3px;
                color: #e4f2ff;
                font-size: 0.75rem;
            }

            .user-menu {
                display: flex;
                align-items: center;
                gap: 10px;
                color: #fff;
                font-size: 0.82rem;
                font-weight: 600;
            }

            .user-avatar {
                width: 34px;
                height: 34px;
                display: grid;
                place-items: center;
                overflow: hidden;
                border-radius: 50%;
                background: #f5fbff;
                color: #0755a1;
            }

            .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
            .user-avatar svg { width: 21px; height: 21px; }

            .dashboard-layout {
                min-height: calc(100vh - 84px);
                display: grid;
                grid-template-columns: 250px minmax(0, 1fr);
            }

            .sidebar {
                padding: 24px 14px;
                border-right: 1px solid #b9ddf8;
                background:
                    radial-gradient(ellipse at bottom left, rgba(174, 222, 255, 0.38), transparent 55%),
                    #f6fbff;
            }

            .side-nav {
                display: grid;
                gap: 7px;
            }

            .nav-item {
                min-height: 44px;
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 0 14px;
                border-radius: 9px;
                color: #184d84;
                font-size: 0.88rem;
                font-weight: 500;
                transition: background 0.15s ease;
            }

            .nav-item svg {
                width: 20px;
                height: 20px;
                flex: 0 0 20px;
                fill: none;
                stroke: currentColor;
                stroke-width: 1.9;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .nav-item.active {
                background: #d5ebff;
                color: #064d93;
                font-weight: 800;
            }

            .nav-item:not(.active):hover { background: #e7f4ff; }

            .nav-item.disabled {
                color: #6282a2;
                cursor: not-allowed;
            }

            .logout-form { margin-top: 2px; }
            .logout-form button {
                width: 100%;
                border: 0;
                background: transparent;
                text-align: left;
                cursor: pointer;
            }

            .workspace {
                min-width: 0;
                padding: clamp(24px, 4vw, 48px);
                background:
                    radial-gradient(ellipse at 15% 100%, rgba(197, 231, 255, 0.38), transparent 55%),
                    linear-gradient(145deg, #fcfeff, #f4faff);
            }

            .page-heading {
                display: flex;
                align-items: flex-start;
                gap: 16px;
                margin-bottom: 24px;
            }

            .heading-icon {
                width: 34px;
                height: 34px;
                flex: 0 0 34px;
                color: #0758a6;
            }

            .page-heading h1 {
                margin: 0;
                color: #093f7a;
                font-size: clamp(1.25rem, 2.2vw, 1.65rem);
                line-height: 1.3;
                font-weight: 800;
            }

            .page-heading p {
                margin: 6px 0 0;
                color: #35669b;
                font-size: 0.92rem;
            }

            .report-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 22px;
            }

            .report-card {
                min-height: 300px;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 28px 24px 22px;
                border: 1px solid;
                border-radius: 12px;
                text-align: center;
            }

            .report-card.blotter {
                border-color: #ff4564;
                background: linear-gradient(145deg, rgba(255, 241, 244, 0.7), rgba(255, 255, 255, 0.86));
                color: #f0143a;
            }

            .report-card.concern {
                border-color: #0bb79f;
                background: linear-gradient(145deg, rgba(235, 252, 248, 0.8), rgba(255, 255, 255, 0.88));
                color: #006d69;
            }

            .report-icon {
                width: 48px;
                height: 48px;
                margin-bottom: 14px;
            }

            .report-card h2 {
                min-height: 52px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                font-size: 1.12rem;
                line-height: 1.35;
                font-weight: 800;
            }

            .report-card p {
                max-width: 300px;
                margin: 12px 0 20px;
                color: #214b78;
                font-size: 0.9rem;
                line-height: 1.55;
            }

            .select-report {
                width: min(100%, 270px);
                min-height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-top: auto;
                border: 0;
                border-radius: 8px;
                color: #fff;
                font-size: 0.86rem;
                font-weight: 800;
                cursor: pointer;
                transition: filter 0.15s ease, transform 0.15s ease;
            }

            .select-report:hover {
                filter: brightness(0.95);
                transform: translateY(-1px);
            }

            .blotter .select-report { background: linear-gradient(100deg, #f13c5c, #e82d50); }
            .concern .select-report { background: linear-gradient(100deg, #1bb79e, #169f94); }

            .selection-status {
                min-height: 24px;
                margin: 16px 0 0;
                color: #285b8d;
                font-size: 0.85rem;
                text-align: center;
            }

            @media (max-width: 760px) {
                body { padding: 0; }
                .app-shell { min-height: 100vh; border: 0; border-radius: 0; box-shadow: none; }
                .topbar { position: sticky; top: 0; z-index: 30; min-height: 60px; padding: 10px 14px; gap: 10px; }
                .user-menu { min-width: 0; gap: 7px; }
                .user-menu a { max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
                .dashboard-layout { min-height: calc(100vh - 60px); grid-template-columns: 1fr; }
                .sidebar {
                    position: fixed;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    z-index: 40;
                    padding: 6px 6px calc(6px + env(safe-area-inset-bottom));
                    border-right: 0;
                    border-top: 1px solid #b9ddf8;
                    background: rgba(250, 253, 255, 0.97);
                    backdrop-filter: blur(10px);
                    box-shadow: 0 -4px 16px rgba(18, 61, 112, 0.1);
                }
                .side-nav { grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 4px; }
                .nav-item.disabled, .nav-item[aria-disabled="true"] { display: none; }
                .nav-item {
                    min-height: 50px;
                    flex-direction: column;
                    justify-content: center;
                    gap: 4px;
                    padding: 6px 4px;
                    border-radius: 8px;
                    font-size: 0.66rem;
                    line-height: 1.1;
                    text-align: center;
                }
                .nav-item svg { width: 19px; height: 19px; flex-basis: 19px; }
                .logout-form { margin: 0; }
                .logout-form button { justify-content: center; text-align: center; }
                .workspace { padding: 20px 16px calc(86px + env(safe-area-inset-bottom)); }
            }

            @media (max-width: 540px) {
                .brand-mark { font-size: 0.88rem; }
                .brand-subtitle { font-size: 0.64rem; }
                .user-menu { font-size: 0.74rem; }
                .user-avatar { width: 30px; height: 30px; }
                .report-grid { grid-template-columns: 1fr; gap: 14px; }
                .report-card { min-height: auto; padding: 22px 18px 20px; }
                .report-card h2 { min-height: auto; }
                .select-report { width: 100%; min-height: 46px; }
                .page-heading { gap: 11px; margin-bottom: 18px; }
                .page-heading p { font-size: 0.84rem; }
            }
        </style>
    </head>
    <body>
        <div class="app-shell">
            <header class="topbar">
                <a class="brand" href="{{ route('resident.dashboard') }}">
                    <span class="brand-mark">BARANGAY WARD II</span>
                    <span class="brand-subtitle">Blotter and Monitoring System</span>
                </a>
                <div class="user-menu">
                    <span class="user-avatar">
                        @if (auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/'.auth()->user()->profile_photo_path) }}" alt="">
                        @else
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>
                        @endif
                    </span>
                    <a href="{{ route('resident.profile.edit') }}">{{ auth()->user()->name }}</a>
                    <span aria-hidden="true">⌄</span>
                </div>
            </header>

            <div class="dashboard-layout">
                <aside class="sidebar">
                    <nav class="side-nav" aria-label="Resident navigation">
                        <a class="nav-item {{ request()->routeIs('resident.dashboard') ? 'active' : '' }}" href="{{ route('resident.dashboard') }}" @if (request()->routeIs('resident.dashboard')) aria-current="page" @endif>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 11 9-8 9 8"></path><path d="M5 10v10h5v-6h4v6h5V10"></path></svg>
                            Dashboard
                        </a>
                        <a class="nav-item {{ request()->routeIs('resident.reports.*') ? 'active' : '' }}" href="{{ route('resident.reports.create') }}" @if (request()->routeIs('resident.reports.*')) aria-current="page" @endif>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><path d="M14 3v6h6M8 14h8M8 18h5"></path><path d="m7.5 9.5-1 2.5 2.5-1 6-6-1.5-1.5z"></path></svg>
                            Report
                        </a>
                        <a class="nav-item {{ request()->routeIs('resident.reports.index') ? 'active' : '' }}" href="{{ route('resident.reports.index') }}" @if (request()->routeIs('resident.reports.index')) aria-current="page" @endif>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="4" width="14" height="17" rx="2"></rect><path d="M9 4V2h6v2M8 9h8M8 13h8M8 17h5"></path></svg>
                            My Reports
                        </a>
                        <span class="nav-item disabled" aria-disabled="true">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"></path></svg>
                            Notifications
                        </span>
                        <a class="nav-item" href="{{ route('resident.profile.edit') }}">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>
                            Profile
                        </a>
                        <form class="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-item" type="submit">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 17l5-5-5-5M15 12H3"></path><path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"></path></svg>
                                Log Out
                            </button>
                        </form>
                    </nav>
                </aside>

                <main class="workspace" id="report-selection">
                    <div class="page-heading">
                        <svg class="heading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><path d="M14 3v6h6M8 13h8M8 17h8"></path></svg>
                        <div>
                            <h1>What would you like to report?</h1>
                            <p>Choose the type of report that best describes your concern.</p>
                        </div>
                    </div>

                    <div class="report-grid">
                        <article class="report-card blotter">
                            <svg class="report-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><circle cx="24" cy="24" r="18"></circle><path d="M24 14v12"></path><circle cx="24" cy="32" r="1.4" fill="currentColor"></circle></svg>
                            <h2>Blotter Report</h2>
                            <p>For an event or situation that happened and needs to be reported to the barangay.</p>
                            <a class="select-report" href="{{ route('resident.reports.create', ['type' => 'blotter']) }}">Select</a>
                        </article>

                        <article class="report-card concern">
                            <svg class="report-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 9h32v22H25l-9 8v-8H8z"></path><path d="M15 17h18M15 23h18"></path></svg>
                            <h2>Submit a Complaint / Concern</h2>
                            <p>For a complaint or community concern that you want the barangay to address.</p>
                            <a class="select-report" href="{{ route('resident.reports.create', ['type' => 'complaint']) }}">Select</a>
                        </article>
                    </div>
                    @if (session('status'))
                        <p class="selection-status" role="status" aria-live="polite">{{ session('status') }}</p>
                    @endif
                </main>
            </div>
        </div>
    </body>
</html>
