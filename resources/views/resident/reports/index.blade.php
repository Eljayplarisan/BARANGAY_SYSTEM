<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Reports | Barangay Ward II</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root { color-scheme: light; font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; color: #123d70; background: #edf7ff; }
            * { box-sizing: border-box; }
            body { min-height: 100vh; margin: 0; padding: 7px; background: #e8f5ff; }
            button, a { font: inherit; }
            a { color: inherit; text-decoration: none; }
            .app-shell { min-height: calc(100vh - 14px); overflow: hidden; border: 1px solid #8bc8f3; border-radius: 12px; background: #fafdff; box-shadow: 0 10px 28px rgba(21, 89, 144, 0.12); }
            .topbar { min-height: 68px; display: flex; align-items: center; justify-content: space-between; gap: 20px; padding: 10px 28px; background: linear-gradient(110deg, #1375cf, #07519a 68%, #064987); color: #fff; }
            .brand { display: flex; flex-direction: column; align-items: flex-start; gap: 3px; min-width: 0; }
            .brand-mark { display: block; font-size: 1.05rem; font-weight: 800; letter-spacing: 0.035em; line-height: 1.2; }
            .brand-subtitle { display: block; margin-top: 3px; color: #e4f2ff; font-size: 0.75rem; }
            .user-menu { display: flex; align-items: center; gap: 10px; color: #fff; font-size: 0.82rem; font-weight: 600; }
            .user-avatar { width: 34px; height: 34px; display: grid; place-items: center; overflow: hidden; border-radius: 50%; background: #f5fbff; color: #0755a1; }
            .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
            .user-avatar svg { width: 21px; height: 21px; }
            .dashboard-layout { min-height: calc(100vh - 84px); display: grid; grid-template-columns: 220px minmax(0, 1fr); }
            .sidebar { padding: 24px 12px; border-right: 1px solid #b9ddf8; background: radial-gradient(ellipse at bottom left, rgba(174, 222, 255, 0.38), transparent 55%), #f6fbff; }
            .side-nav { display: grid; gap: 7px; }
            .nav-item { min-height: 42px; display: flex; align-items: center; gap: 13px; padding: 0 12px; border-radius: 9px; color: #184d84; font-size: 0.82rem; font-weight: 500; }
            .nav-item svg { width: 19px; height: 19px; flex: 0 0 19px; fill: none; stroke: currentColor; stroke-width: 1.9; stroke-linecap: round; stroke-linejoin: round; }
            .nav-item.active { background: #d5ebff; color: #064d93; font-weight: 800; }
            .nav-item:not(.active):hover { background: #e7f4ff; }
            .nav-item.disabled { color: #6282a2; cursor: not-allowed; }
            .logout-form { margin-top: 2px; }
            .logout-form button { width: 100%; border: 0; background: transparent; text-align: left; cursor: pointer; }
            .workspace { min-width: 0; padding: clamp(18px, 2.7vw, 34px); background: radial-gradient(ellipse at 15% 100%, rgba(197, 231, 255, 0.38), transparent 55%), linear-gradient(145deg, #fcfeff, #f4faff); }
            .page-heading { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; }
            .heading-icon { width: 27px; height: 27px; flex: 0 0 27px; color: #0758a6; }
            .page-heading h1 { margin: 0; color: #093f7a; font-size: 1.18rem; line-height: 1.3; font-weight: 800; }
            .page-heading p { margin: 3px 0 0; color: #35669b; font-size: 0.76rem; }
            .reports-table-wrap, .report-details { overflow: hidden; border: 1px solid #c6e2fa; border-radius: 10px; background: rgba(255, 255, 255, 0.58); }
            .reports-table { width: 100%; border-collapse: collapse; color: #214d7a; font-size: 0.72rem; }
            .reports-table th, .reports-table td { padding: 9px 10px; border-bottom: 1px solid #d9e9f8; text-align: left; white-space: nowrap; }
            .reports-table th { color: #174a7e; font-weight: 700; }
            .reports-table tbody tr:last-child td { border-bottom: 0; }
            .reports-table tbody tr:hover { background: #f2f9ff; }
            .report-number { color: #0758a6; font-weight: 600; }
            .status-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 62px; padding: 4px 9px; border-radius: 999px; background: #eaf1f7; color: #3e6789; font-size: 0.67rem; }
            .status-submitted { background: #dcefff; color: #0758a6; }
            .status-received, .status-referred { background: #d9edff; color: #0758a6; }
            .status-ongoing { background: #ffe7af; color: #805600; }
            .status-resolved { background: #d5f4ed; color: #087362; }
            .status-closed { background: #e9eff4; color: #526c82; }
            .view-link { display: inline-flex; align-items: center; justify-content: center; min-width: 52px; padding: 4px 11px; border-radius: 999px; background: #d9efff; color: #0758a6; font-weight: 700; }
            .empty-state { padding: 22px; color: #54789c; text-align: center; font-size: 0.82rem; }
            .details-heading { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin: 16px 0 7px; }
            .details-heading h2 { margin: 0; color: #093f7a; font-size: 0.95rem; font-weight: 800; }
            .timeline-link { color: #0758a6; font-size: 0.7rem; font-weight: 700; }
            .detail-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 9px 13px; border-bottom: 1px solid #d9e9f8; color: #164c83; font-size: 0.76rem; }
            .detail-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 10px; padding: 9px 13px; }
            .detail-label { display: block; margin-bottom: 3px; color: #527698; font-size: 0.66rem; }
            .detail-value { color: #174a7e; font-size: 0.7rem; }
            .detail-description { padding: 8px 13px; border-bottom: 1px solid #d9e9f8; color: #24527e; font-size: 0.7rem; line-height: 1.5; }
            .detail-description strong { margin-right: 8px; color: #527698; font-weight: 500; }
            .timeline { display: grid; grid-template-columns: repeat(6, minmax(0, 1fr)); padding: 12px 10px 9px; }
            .timeline-step { position: relative; display: grid; justify-items: center; gap: 4px; color: #93a9bd; text-align: center; font-size: 0.62rem; }
            .timeline-step:not(:last-child)::after { position: absolute; top: 11px; left: calc(50% + 12px); width: calc(100% - 24px); height: 1px; background: #d5e1ea; content: ""; }
            .timeline-step.complete:not(:last-child)::after { background: #4fa3e2; }
            .timeline-step.current:not(:last-child)::after { background: linear-gradient(90deg, #4fa3e2 50%, #d5e1ea 50%); }
            .timeline-dot { z-index: 1; width: 22px; height: 22px; display: grid; place-items: center; border-radius: 50%; background: #e4ebf1; color: #92a8bb; font-size: 0.72rem; }
            .timeline-step.complete .timeline-dot { background: #1780d4; color: #fff; }
            .timeline-step.current .timeline-dot { background: #42b7ad; color: #fff; }
            .timeline-step.complete .timeline-label, .timeline-step.current .timeline-label { color: #0758a6; font-weight: 700; }
            .timeline-step.current .timeline-label { color: #138b83; }
            .timeline-date { color: #809bb4; font-size: 0.6rem; }
            @media (max-width: 900px) {
                .dashboard-layout { grid-template-columns: 190px minmax(0, 1fr); }
                .workspace { padding: 18px 14px; }
                .reports-table th, .reports-table td { padding: 8px 6px; font-size: 0.66rem; }
            }
            @media (max-width: 700px) {
                body { padding: 0; }
                .app-shell { min-height: 100vh; border-radius: 0; }
                .dashboard-layout { min-height: calc(100vh - 68px); grid-template-columns: 1fr; }
                .sidebar { padding: 9px 10px; border-right: 0; border-bottom: 1px solid #b9ddf8; }
                .side-nav { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 4px; }
                .nav-item { min-height: 39px; justify-content: center; gap: 6px; padding: 0 5px; font-size: 0.72rem; }
                .nav-item svg { width: 17px; height: 17px; flex-basis: 17px; }
                .logout-form { margin: 0; }
                .logout-form button { justify-content: center; }
                .workspace { padding: 16px 10px; }
                .reports-table-wrap { overflow-x: auto; }
                .reports-table { min-width: 680px; }
            }
            @media (max-width: 520px) {
                .topbar { min-height: 62px; padding: 8px 12px; }
                .brand-mark { font-size: 0.8rem; }
                .brand-subtitle { font-size: 0.6rem; }
                .user-menu { gap: 6px; font-size: 0.68rem; }
                .user-avatar { width: 30px; height: 30px; }
                .side-nav { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                .detail-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                .timeline { padding-inline: 2px; }
                .timeline-step { font-size: 0.55rem; }
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
                <a class="user-menu" href="{{ route('resident.profile.edit') }}" aria-label="Open profile">
                    <span class="user-avatar">
                        @if ($user->profile_photo_path)
                            <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="">
                        @else
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>
                        @endif
                    </span>
                    <span>{{ $user->name }}</span>
                    <span aria-hidden="true">⌄</span>
                </a>
            </header>

            <div class="dashboard-layout">
                <aside class="sidebar">
                    <nav class="side-nav" aria-label="Resident navigation">
                        <a class="nav-item" href="{{ route('resident.dashboard') }}"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 11 9-8 9 8"></path><path d="M5 10v10h5v-6h4v6h5V10"></path></svg>Dashboard</a>
                        <a class="nav-item" href="{{ route('resident.reports.create') }}"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><path d="M14 3v6h6M8 14h8M8 18h5"></path><path d="m7.5 9.5-1 2.5 2.5-1 6-6-1.5-1.5z"></path></svg>Report</a>
                        <a class="nav-item active" href="{{ route('resident.reports.index') }}" aria-current="page"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="4" width="14" height="17" rx="2"></rect><path d="M9 4V2h6v2M8 9h8M8 13h8M8 17h5"></path></svg>My Reports</a>
                        <span class="nav-item disabled" aria-disabled="true"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"></path></svg>Notifications</span>
                        <a class="nav-item" href="{{ route('resident.profile.edit') }}"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>Profile</a>
                        <form class="logout-form" method="POST" action="{{ route('logout') }}">@csrf<button class="nav-item" type="submit"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 17l5-5-5-5M15 12H3"></path><path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"></path></svg>Log Out</button></form>
                    </nav>
                </aside>

                <main class="workspace">
                    <div class="page-heading">
                        <svg class="heading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="4" width="14" height="17" rx="2"></rect><path d="M9 4V2h6v2M8 9h8M8 13h8M8 17h5"></path></svg>
                        <div>
                            <h1>My Reports</h1>
                            <p>View the status and updates of your submitted reports.</p>
                        </div>
                    </div>

                    <div class="reports-table-wrap">
                        @if ($reports->isEmpty())
                            <div class="empty-state">You haven’t submitted any reports yet. <a href="{{ route('resident.reports.create') }}">Create your first report</a>.</div>
                        @else
                            <table class="reports-table">
                                <thead>
                                    <tr><th>Report No.</th><th>Type</th><th>Category</th><th>Date Submitted</th><th>Status</th><th>Action</th></tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td class="report-number">CR-{{ str_pad((string) $report->id, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ ucfirst($report->type) }}</td>
                                            <td>{{ $report->category }}</td>
                                            <td>{{ $report->created_at->format('M j, Y') }}</td>
                                            <td><span class="status-badge status-{{ strtolower($report->status) }}">{{ ucfirst($report->status) }}</span></td>
                                            <td><a class="view-link" href="{{ route('resident.reports.index', ['report' => $report->id]) }}">View</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    @if ($selectedReport)
                        <div class="details-heading">
                            <h2>Report Details</h2>
                            <a class="timeline-link" href="#report-timeline">View Timeline</a>
                        </div>
                        <section class="report-details" aria-label="Selected report details">
                            <div class="detail-header">
                                <strong>CR-{{ str_pad((string) $selectedReport->id, 4, '0', STR_PAD_LEFT) }}</strong>
                                <span>Submitted {{ $selectedReport->created_at->format('M j, Y') }}</span>
                            </div>
                            <div class="detail-grid">
                                <div><span class="detail-label">Type</span><span class="detail-value">{{ ucfirst($selectedReport->type) }}</span></div>
                                <div><span class="detail-label">Category</span><span class="detail-value">{{ $selectedReport->category }}</span></div>
                                <div><span class="detail-label">Date Submitted</span><span class="detail-value">{{ $selectedReport->created_at->format('M j, Y') }}</span></div>
                                <div><span class="detail-label">Status</span><span class="status-badge status-{{ strtolower($selectedReport->status) }}">{{ ucfirst($selectedReport->status) }}</span></div>
                            </div>
                            <div class="detail-grid">
                                <div><span class="detail-label">Location</span><span class="detail-value">{{ $selectedReport->location }}</span></div>
                            </div>
                            <div class="detail-description"><strong>Description</strong>{{ $selectedReport->description }}</div>
                            <div class="timeline" id="report-timeline" aria-label="Report progress timeline">
                                @foreach ($timeline as $step)
                                    <div class="timeline-step {{ $step['state'] }}">
                                        <span class="timeline-dot">{{ $step['state'] === 'upcoming' ? '·' : '✓' }}</span>
                                        <span class="timeline-label">{{ $step['label'] }}</span>
                                        <span class="timeline-date">{{ $step['date'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </main>
            </div>
        </div>
    </body>
</html>
