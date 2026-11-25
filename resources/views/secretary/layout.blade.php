<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @include('partials.mobile-head')
        <title>@yield('title', 'Secretary Dashboard') | Barangay Ward II</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                color-scheme: light;
                --bg-canvas: #f5f9fd;
                --surface: #ffffff;
                --border: #e1ebf4;
                --border-strong: #cddceb;
                --navy-900: #0f2942;
                --navy-700: #294661;
                --blue-primary: #0d5aa7;
                --blue-hover: #094a8c;
                --blue-eyebrow: #1a6bc0;
                --blue-soft: #e8f3fe;
                --blue-active-bg: #dceeff;
                --blue-active-text: #0b58a3;
                --text-muted: #5d748c;
                --text-subtle: #7c92a8;
            }

            * {
                box-sizing: border-box;
            }

            html, body {
                margin: 0;
                padding: 0;
                min-height: 100vh;
                font-family: 'Plus Jakarta Sans', 'Segoe UI', system-ui, sans-serif;
                background: var(--bg-canvas);
                color: var(--navy-900);
                -webkit-font-smoothing: antialiased;
                overflow-x: hidden;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            button, input, select, textarea {
                font: inherit;
            }

            .secretary-shell {
                min-height: 100vh;
                display: grid;
                grid-template-columns: 230px minmax(0, 1fr);
            }

            /* Mobile Topbar (hidden on desktop) */
            .mobile-topbar {
                display: none;
                position: sticky;
                top: 0;
                z-index: 40;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                padding: 10px 14px;
                background: #ffffff;
                border-bottom: 1px solid var(--border);
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                gap: 10px;
                min-width: 0;
            }

            .menu-toggle {
                width: 42px;
                height: 42px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border: 1px solid var(--border);
                border-radius: 9px;
                background: #f8fbfe;
                color: var(--navy-900);
                cursor: pointer;
                flex-shrink: 0;
            }

            .menu-toggle svg {
                width: 20px;
                height: 20px;
                stroke: currentColor;
                stroke-width: 2;
                fill: none;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .mobile-brand-text {
                display: flex;
                flex-direction: column;
                min-width: 0;
            }

            .mobile-brand-title {
                font-size: 0.9rem;
                font-weight: 800;
                color: var(--navy-900);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .mobile-brand-sub {
                font-size: 0.7rem;
                color: var(--text-muted);
            }

            .mobile-incoming-pill {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 7px 11px;
                border-radius: 999px;
                background: var(--blue-active-bg);
                color: var(--blue-active-text);
                font-size: 0.76rem;
                font-weight: 700;
                white-space: nowrap;
            }

            .sidebar-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                z-index: 45;
                background: rgba(15, 41, 66, 0.42);
                backdrop-filter: blur(2px);
            }

            .sidebar-backdrop.is-open {
                display: block;
            }

            /* Sidebar */
            .sidebar {
                position: sticky;
                top: 0;
                height: 100vh;
                display: flex;
                flex-direction: column;
                padding: 18px 14px 20px;
                background: var(--surface);
                border-right: 1px solid var(--border);
                overflow-y: auto;
            }

            .sidebar-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 10px 10px;
            }

            .sidebar-label {
                font-size: 0.67rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--text-subtle);
            }

            .sidebar-close {
                display: none;
                width: 34px;
                height: 34px;
                align-items: center;
                justify-content: center;
                border: 1px solid var(--border);
                border-radius: 8px;
                background: #f8fbfe;
                color: var(--navy-700);
                cursor: pointer;
            }

            .sidebar-nav {
                display: grid;
                gap: 4px;
            }

            .nav-link {
                min-height: 40px;
                display: flex;
                align-items: center;
                gap: 11px;
                padding: 8px 11px;
                border-radius: 8px;
                color: var(--navy-700);
                font-size: 0.84rem;
                font-weight: 600;
                transition: background 0.15s ease, color 0.15s ease;
            }

            .nav-link svg {
                width: 17px;
                height: 17px;
                flex: 0 0 17px;
                fill: none;
                stroke: currentColor;
                stroke-width: 1.9;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .nav-link:hover {
                background: #f1f7fd;
                color: var(--blue-active-text);
            }

            .nav-link.active {
                background: var(--blue-active-bg);
                color: var(--blue-active-text);
                font-weight: 700;
            }

            .nav-badge {
                margin-left: auto;
                min-width: 20px;
                height: 20px;
                padding: 0 6px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 999px;
                font-size: 0.72rem;
                font-weight: 800;
                color: var(--blue-active-text);
                background: #eaf4ff;
            }

            .nav-link.active .nav-badge {
                background: #ffffff;
            }

            .sidebar-footer {
                margin-top: auto;
                padding: 20px 10px 4px;
            }

            .sidebar-motto-title {
                margin: 0 0 6px;
                font-size: 0.82rem;
                font-weight: 800;
                line-height: 1.35;
                color: var(--navy-900);
            }

            .sidebar-motto-copy {
                margin: 0 0 14px;
                font-size: 0.72rem;
                line-height: 1.5;
                color: var(--text-subtle);
            }

            .sidebar-meta {
                padding-top: 12px;
                margin-bottom: 12px;
                border-top: 1px solid #edf2f7;
                font-size: 0.71rem;
                color: var(--text-subtle);
            }

            .logout-btn {
                width: 100%;
                min-height: 36px;
                display: inline-flex;
                align-items: center;
                gap: 9px;
                padding: 6px 2px;
                border: 0;
                background: transparent;
                color: var(--navy-700);
                font-size: 0.82rem;
                font-weight: 600;
                cursor: pointer;
                text-align: left;
            }

            .logout-btn:hover {
                color: var(--blue-primary);
            }

            .logout-btn svg {
                width: 16px;
                height: 16px;
                fill: none;
                stroke: currentColor;
                stroke-width: 1.9;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            /* Main Workspace */
            .main-column {
                min-width: 0;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .workspace {
                width: 100%;
                max-width: 1220px;
                margin: 0 auto;
                padding: 22px clamp(16px, 3vw, 32px) 28px;
                flex: 1;
            }

            .page-header {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 16px;
                margin-bottom: 18px;
            }

            .eyebrow {
                display: block;
                margin-bottom: 5px;
                font-size: 0.69rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--blue-eyebrow);
            }

            .page-title {
                margin: 0;
                font-size: clamp(1.38rem, 2.2vw, 1.8rem);
                font-weight: 800;
                letter-spacing: -0.025em;
                line-height: 1.2;
                color: var(--navy-900);
            }

            .page-subtitle {
                margin: 5px 0 0;
                font-size: 0.86rem;
                color: var(--text-muted);
                line-height: 1.45;
            }

            .btn-primary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                min-height: 40px;
                padding: 0 18px;
                border: 0;
                border-radius: 8px;
                background: var(--blue-primary);
                color: #ffffff;
                font-size: 0.84rem;
                font-weight: 700;
                cursor: pointer;
                white-space: nowrap;
                transition: background 0.15s ease;
            }

            .btn-primary:hover {
                background: var(--blue-hover);
            }

            .btn-secondary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                min-height: 38px;
                padding: 0 14px;
                border: 1px solid var(--border-strong);
                border-radius: 8px;
                background: #ffffff;
                color: var(--navy-700);
                font-size: 0.82rem;
                font-weight: 700;
                cursor: pointer;
                white-space: nowrap;
                transition: background 0.15s ease, border-color 0.15s ease;
            }

            .btn-secondary:hover {
                background: #f4f9fe;
                border-color: #9ec3e6;
                color: var(--blue-active-text);
            }

            .flash-banner {
                margin-bottom: 16px;
                padding: 12px 15px;
                border: 1px solid #b9e4c9;
                border-radius: 10px;
                background: #eefbf3;
                color: #165e36;
                font-size: 0.84rem;
                font-weight: 600;
            }

            .error-banner {
                margin-bottom: 16px;
                padding: 12px 15px;
                border: 1px solid #f5c2c7;
                border-radius: 10px;
                background: #fff5f5;
                color: #9b1c1c;
                font-size: 0.84rem;
            }

            .error-banner ul {
                margin: 0;
                padding-left: 18px;
            }

            .card {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: 18px 20px;
            }

            .card-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                margin-bottom: 14px;
            }

            .card-title {
                margin: 0;
                font-size: 0.98rem;
                font-weight: 700;
                color: var(--navy-900);
            }

            .card-meta {
                font-size: 0.76rem;
                font-weight: 600;
                color: var(--text-subtle);
            }

            .status-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 0.74rem;
                font-weight: 700;
                white-space: nowrap;
            }

            .status-submitted { background: #e5f1fd; color: #0b58a3; }
            .status-received { background: #e0f2fe; color: #0369a1; }
            .status-referred { background: #ede9fe; color: #5b21b6; }
            .status-ongoing { background: #fef3c7; color: #92400e; }
            .status-resolved { background: #d1fae5; color: #065f46; }
            .status-closed { background: #edf2f7; color: #475569; }
            .status-scheduled { background: #e5f1fd; color: #0b58a3; }
            .status-completed { background: #d1fae5; color: #065f46; }
            .status-cancelled { background: #fee2e2; color: #991b1b; }

            .action-link {
                color: var(--blue-primary);
                font-size: 0.82rem;
                font-weight: 700;
                white-space: nowrap;
            }

            .action-link:hover {
                text-decoration: underline;
            }

            .table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border: 1px solid #e7eff7;
                border-radius: 10px;
            }

            .data-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 0.82rem;
            }

            .data-table th {
                padding: 11px 14px;
                background: #f8fbfe;
                border-bottom: 1px solid #e7eff7;
                color: var(--text-muted);
                font-size: 0.75rem;
                font-weight: 700;
                text-align: left;
                white-space: nowrap;
            }

            .data-table td {
                padding: 13px 14px;
                border-bottom: 1px solid #eef4fa;
                color: var(--navy-900);
                vertical-align: middle;
            }

            .data-table tbody tr:last-child td {
                border-bottom: 0;
            }

            .data-table tbody tr:hover {
                background: #fafdff;
            }

            .report-ref {
                color: var(--blue-primary);
                font-weight: 800;
                white-space: nowrap;
            }

            .form-field {
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .form-field label {
                font-size: 0.78rem;
                font-weight: 700;
                color: var(--navy-700);
            }

            .form-control {
                width: 100%;
                min-height: 40px;
                padding: 8px 12px;
                border: 1px solid var(--border-strong);
                border-radius: 8px;
                background: #ffffff;
                color: var(--navy-900);
                font-size: 0.85rem;
                outline: none;
                transition: border-color 0.15s ease, box-shadow 0.15s ease;
            }

            .form-control:focus {
                border-color: var(--blue-eyebrow);
                box-shadow: 0 0 0 3px rgba(26, 107, 192, 0.12);
            }

            textarea.form-control {
                min-height: 88px;
                resize: vertical;
            }

            .workspace-footer {
                width: 100%;
                max-width: 1220px;
                margin: 0 auto;
                padding: 12px clamp(16px, 3vw, 32px) calc(18px + env(safe-area-inset-bottom));
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                border-top: 1px solid #e6eff7;
                color: var(--text-subtle);
                font-size: 0.75rem;
            }

            @media (max-width: 960px) {
                .secretary-shell {
                    grid-template-columns: 1fr;
                }

                .mobile-topbar {
                    display: flex;
                }

                .sidebar {
                    position: fixed;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    z-index: 50;
                    width: min(275px, 84vw);
                    transform: translateX(-100%);
                    transition: transform 0.2s ease;
                    box-shadow: 8px 0 28px rgba(15, 41, 66, 0.18);
                }

                .sidebar.is-open {
                    transform: translateX(0);
                }

                .sidebar-close {
                    display: inline-flex;
                }

                .page-header {
                    flex-direction: column;
                    align-items: stretch;
                }

                .page-header .btn-primary {
                    width: 100%;
                    min-height: 44px;
                }
            }

            @media (max-width: 640px) {
                .form-control {
                    font-size: 16px;
                    min-height: 44px;
                }

                .workspace-footer {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 4px;
                }
            }

            @stack('styles')
        </style>
    </head>
    <body>
        <div class="secretary-shell">
            <header class="mobile-topbar">
                <div class="mobile-brand">
                    <button type="button" class="menu-toggle" id="sidebar-open" aria-label="Open workspace navigation" aria-controls="secretary-sidebar" aria-expanded="false">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </button>
                    <div class="mobile-brand-text">
                        <span class="mobile-brand-title">Barangay Ward II</span>
                        <span class="mobile-brand-sub">Secretary Workspace</span>
                    </div>
                </div>
                <a class="mobile-incoming-pill" href="{{ route('secretary.reports.incoming') }}">
                    Incoming ({{ $incomingCount ?? 0 }})
                </a>
            </header>

            <div class="sidebar-backdrop" id="sidebar-backdrop"></div>

            <aside class="sidebar" id="secretary-sidebar" aria-label="Secretary workspace navigation">
                <div class="sidebar-header">
                    <span class="sidebar-label">Workspace</span>
                    <button type="button" class="sidebar-close" id="sidebar-close" aria-label="Close navigation">&times;</button>
                </div>

                <nav class="sidebar-nav">
                    <a class="nav-link {{ request()->routeIs('secretary.dashboard') ? 'active' : '' }}" href="{{ route('secretary.dashboard') }}" @if (request()->routeIs('secretary.dashboard')) aria-current="page" @endif>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1.5"></rect><rect x="14" y="3" width="7" height="7" rx="1.5"></rect><rect x="14" y="14" width="7" height="7" rx="1.5"></rect><rect x="3" y="14" width="7" height="7" rx="1.5"></rect></svg>
                        <span>Dashboard</span>
                    </a>

                    <a class="nav-link {{ request()->routeIs('secretary.reports.incoming') ? 'active' : '' }}" href="{{ route('secretary.reports.incoming') }}" @if (request()->routeIs('secretary.reports.incoming')) aria-current="page" @endif>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg>
                        <span>Incoming Reports</span>
                        <span class="nav-badge">{{ $incomingCount ?? 0 }}</span>
                    </a>

                    <a class="nav-link {{ request()->routeIs('secretary.reports.blotters') ? 'active' : '' }}" href="{{ route('secretary.reports.blotters') }}" @if (request()->routeIs('secretary.reports.blotters')) aria-current="page" @endif>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        <span>Blotter Records</span>
                    </a>

                    <a class="nav-link {{ request()->routeIs('secretary.residents.*') ? 'active' : '' }}" href="{{ route('secretary.residents.index') }}" @if (request()->routeIs('secretary.residents.*')) aria-current="page" @endif>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>Residents</span>
                    </a>

                    <a class="nav-link {{ request()->routeIs('secretary.cases.*') || request()->routeIs('secretary.reports.show') ? 'active' : '' }}" href="{{ route('secretary.cases.index') }}" @if (request()->routeIs('secretary.cases.*') || request()->routeIs('secretary.reports.show')) aria-current="page" @endif>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        <span>Case Management</span>
                    </a>

                    <a class="nav-link {{ request()->routeIs('secretary.appointments.*') ? 'active' : '' }}" href="{{ route('secretary.appointments.index') }}" @if (request()->routeIs('secretary.appointments.*')) aria-current="page" @endif>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span>Appointments &amp; Schedules</span>
                    </a>

                    <a class="nav-link {{ request()->routeIs('secretary.settings.*') ? 'active' : '' }}" href="{{ route('secretary.settings.index') }}" @if (request()->routeIs('secretary.settings.*')) aria-current="page" @endif>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                        <span>Reports &amp; Settings</span>
                    </a>
                </nav>

                <div class="sidebar-footer">
                    <p class="sidebar-motto-title">Community service, our priority.</p>
                    <p class="sidebar-motto-copy">One report reference, from resident submission to closure.</p>
                    <div class="sidebar-meta">{{ now()->format('M j, Y') }} &middot; Secretary desk</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="logout-btn" type="submit">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            <span>Log out</span>
                        </button>
                    </form>
                </div>
            </aside>

            <div class="main-column">
                <main class="workspace">
                    @if (session('status'))
                        <div class="flash-banner" role="status">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="error-banner" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </main>

                <footer class="workspace-footer">
                    <span>Barangay Ward II &middot; Secretary services</span>
                    <span>Live barangay records &middot; {{ now()->format('M j, Y') }}</span>
                </footer>
            </div>
        </div>

        <script>
            const sidebar = document.getElementById('secretary-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const openBtn = document.getElementById('sidebar-open');
            const closeBtn = document.getElementById('sidebar-close');

            function setSidebarOpen(open) {
                if (!sidebar || !backdrop) return;
                sidebar.classList.toggle('is-open', open);
                backdrop.classList.toggle('is-open', open);
                if (openBtn) openBtn.setAttribute('aria-expanded', String(open));
            }

            if (openBtn) openBtn.addEventListener('click', () => setSidebarOpen(true));
            if (closeBtn) closeBtn.addEventListener('click', () => setSidebarOpen(false));
            if (backdrop) backdrop.addEventListener('click', () => setSidebarOpen(false));
        </script>
    </body>
</html>
