@extends('secretary.layout')

@section('title', 'Secretary Dashboard')

@push('styles')
    .notice-banner {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 18px;
        padding: 14px 18px;
        border: 1px solid #cce2f8;
        border-radius: 10px;
        background: #e8f3fe;
    }

    .notice-banner-icon {
        width: 20px;
        height: 20px;
        margin-top: 1px;
        flex: 0 0 20px;
        color: #1660ad;
    }

    .notice-banner-title {
        margin: 0;
        font-size: 0.85rem;
        font-weight: 700;
        color: #0f2942;
    }

    .notice-banner-copy {
        margin: 3px 0 0;
        font-size: 0.8rem;
        color: #466584;
        line-height: 1.45;
    }

    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 18px;
    }

    .kpi-card {
        background: #ffffff;
        border: 1px solid #e1ebf4;
        border-radius: 12px;
        padding: 16px 18px;
    }

    .kpi-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #647b93;
    }

    .kpi-value {
        margin: 6px 0 6px;
        font-size: 1.9rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: #0f2942;
        line-height: 1.1;
    }

    .kpi-sub {
        font-size: 0.74rem;
        font-weight: 600;
        color: #216bb7;
    }

    .middle-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
        gap: 16px;
        margin-bottom: 18px;
        align-items: start;
    }

    .queue-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 14px;
        font-size: 0.76rem;
        color: #647b93;
    }

    .mini-pagination {
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .mini-pagination a {
        color: #294661;
        font-weight: 600;
    }

    .mini-pagination a:hover {
        color: #0d5aa7;
    }

    .mini-pagination .page-disabled {
        color: #a6b7c8;
    }

    .mini-pagination .page-current {
        color: #0f2942;
        font-weight: 800;
    }

    .status-bars {
        display: grid;
        gap: 14px;
    }

    .status-bar-row {
        display: grid;
        grid-template-columns: 74px minmax(0, 1fr) 26px;
        align-items: center;
        gap: 12px;
        font-size: 0.8rem;
    }

    .status-bar-label {
        color: #46607a;
        font-weight: 600;
    }

    .status-bar-track {
        height: 7px;
        border-radius: 999px;
        background: #edf3f8;
        overflow: hidden;
    }

    .status-bar-fill {
        height: 100%;
        border-radius: 999px;
        background: #1866b4;
    }

    .status-bar-count {
        text-align: right;
        font-weight: 700;
        color: #0f2942;
    }

    .bottom-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(0, 1fr);
        gap: 16px;
    }

    .appointment-list {
        display: grid;
        gap: 14px;
        margin-bottom: 16px;
    }

    .appointment-item {
        display: grid;
        grid-template-columns: 82px minmax(0, 1fr);
        gap: 12px;
        align-items: start;
    }

    .appointment-time {
        font-size: 0.82rem;
        font-weight: 800;
        color: #0f2942;
    }

    .appointment-duration {
        margin-top: 2px;
        font-size: 0.73rem;
        color: #7c92a8;
    }

    .appointment-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #0f2942;
    }

    .appointment-meta {
        margin-top: 3px;
        font-size: 0.76rem;
        color: #647b93;
    }

    .spotlight-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
    }

    .spotlight-title {
        margin: 0;
        font-size: 0.94rem;
        font-weight: 800;
        color: #0f2942;
    }

    .spotlight-body {
        margin: 0 0 10px;
        font-size: 0.83rem;
        color: #334e68;
        line-height: 1.55;
    }

    .spotlight-meta {
        margin: 0 0 16px;
        font-size: 0.75rem;
        color: #7c92a8;
    }

    .empty-note {
        margin: 0 0 14px;
        padding: 16px;
        border-radius: 9px;
        background: #f8fbfe;
        border: 1px dashed #d3e2f0;
        color: #5d748c;
        font-size: 0.82rem;
        line-height: 1.5;
    }

    @media (max-width: 1080px) {
        .kpi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .middle-grid,
        .bottom-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 520px) {
        .kpi-card {
            padding: 14px;
        }

        .kpi-value {
            font-size: 1.65rem;
        }

        .appointment-item {
            grid-template-columns: 1fr;
            gap: 4px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eef4fa;
        }

        .appointment-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }
    }
@endpush

@section('content')
    <div class="page-header">
        <div>
            <span class="eyebrow">01 / START HERE</span>
            <h1 class="page-title">{{ $greeting }}, {{ $user->name }}</h1>
            <p class="page-subtitle">A clear view of reports that need your attention today.</p>
        </div>
        <a class="btn-primary" href="{{ route('secretary.reports.incoming') }}">Open incoming reports</a>
    </div>

    <section class="notice-banner" role="status" aria-live="polite">
        <svg class="notice-banner-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>
        <div>
            @if ($incomingCount > 0)
                <p class="notice-banner-title">
                    {{ $incomingCount }} new {{ \Illuminate\Support\Str::plural('submission', $incomingCount) }} {{ $incomingCount === 1 ? 'is' : 'are' }} waiting to be received.
                </p>
                <p class="notice-banner-copy">Open the queue, check the resident's original details, then mark each report as Received.</p>
            @else
                <p class="notice-banner-title">All caught up &mdash; no new submissions are waiting to be received.</p>
                <p class="notice-banner-copy">New resident blotter and maintenance reports will appear here as soon as they are filed.</p>
            @endif
        </div>
    </section>

    <section class="kpi-grid" aria-label="Report summary statistics">
        <article class="kpi-card">
            <div class="kpi-label">All reports</div>
            <div class="kpi-value">{{ $totalReports }}</div>
            <div class="kpi-sub">All statuses &middot; {{ now()->format('M Y') }}</div>
        </article>

        <article class="kpi-card">
            <div class="kpi-label">Active reports</div>
            <div class="kpi-value">{{ $activeReports }}</div>
            <div class="kpi-sub">Submitted through Ongoing</div>
        </article>

        <article class="kpi-card">
            <div class="kpi-label">Resolved</div>
            <div class="kpi-value">{{ $resolvedReports }}</div>
            <div class="kpi-sub">Ready for closure review</div>
        </article>

        <article class="kpi-card">
            <div class="kpi-label">Closed</div>
            <div class="kpi-value">{{ $closedReports }}</div>
            <div class="kpi-sub">Completed and archived</div>
        </article>
    </section>

    <section class="middle-grid">
        <article class="card">
            <div class="card-header">
                <h2 class="card-title">Recent submissions</h2>
                <span class="card-meta">Queue preview</span>
            </div>

            @if ($recentSubmissions->isEmpty())
                <p class="empty-note">No resident submissions have been filed yet. Once residents submit a blotter or maintenance report, it will show up here for review.</p>
            @else
                <div class="table-wrap">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Report ID</th>
                                <th>Submission type</th>
                                <th>Submitted</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentSubmissions as $report)
                                <tr>
                                    <td class="report-ref">{{ $report->referenceCode() }}</td>
                                    <td>{{ $report->submissionTypeLabel() }}</td>
                                    <td>{{ $report->created_at->format('M j, Y') }}</td>
                                    <td>
                                        <span class="status-pill status-{{ strtolower($report->status) }}">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a class="action-link" href="{{ route('secretary.reports.show', $report) }}">Review &rarr;</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="queue-footer">
                    <span>
                        @if ($incomingCount > 0)
                            {{ $incomingCount }} new {{ \Illuminate\Support\Str::plural('submission', $incomingCount) }}
                        @else
                            Showing {{ $recentSubmissions->total() }} {{ \Illuminate\Support\Str::plural('report', $recentSubmissions->total()) }}
                        @endif
                    </span>
                    <div class="mini-pagination" aria-label="Submissions pagination">
                        @if ($recentSubmissions->onFirstPage())
                            <span class="page-disabled">Previous</span>
                        @else
                            <a href="{{ $recentSubmissions->previousPageUrl() }}">Previous</a>
                        @endif

                        <span class="page-current">{{ $recentSubmissions->currentPage() }}</span>

                        @if ($recentSubmissions->hasMorePages())
                            <a href="{{ $recentSubmissions->nextPageUrl() }}">Next</a>
                        @else
                            <span class="page-disabled">Next</span>
                        @endif
                    </div>
                </div>
            @endif
        </article>

        <article class="card">
            <div class="card-header">
                <h2 class="card-title">Reports by status</h2>
                <span class="card-meta">{{ $totalReports }} total</span>
            </div>

            <div class="status-bars">
                @foreach ($statusBreakdown as $row)
                    <div class="status-bar-row">
                        <span class="status-bar-label">{{ $row['label'] }}</span>
                        <div class="status-bar-track" aria-hidden="true">
                            <div class="status-bar-fill" style="width: {{ $row['percent'] }}%"></div>
                        </div>
                        <span class="status-bar-count">{{ $row['count'] }}</span>
                    </div>
                @endforeach
            </div>
        </article>
    </section>

    <section class="bottom-grid">
        <article class="card">
            <div class="card-header">
                <h2 class="card-title">Today's appointments</h2>
                <span class="card-meta">{{ $todayAppointments->count() }} scheduled</span>
            </div>

            @if ($todayAppointments->isEmpty())
                <p class="empty-note">No consultations or site inspections scheduled for today.</p>
            @else
                <div class="appointment-list">
                    @foreach ($todayAppointments as $appointment)
                        <div class="appointment-item">
                            <div>
                                <div class="appointment-time">{{ $appointment->scheduled_at->format('g:i A') }}</div>
                                <div class="appointment-duration">{{ $appointment->duration_minutes }} minutes</div>
                            </div>
                            <div>
                                <div class="appointment-title">
                                    {{ $appointment->title }}@if ($appointment->report) &middot; {{ $appointment->report->referenceCode() }}@endif
                                </div>
                                <div class="appointment-meta">
                                    {{ $appointment->location }}@if ($appointment->assignee) &middot; {{ $appointment->assignee }}@endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <a class="action-link" href="{{ route('secretary.appointments.index') }}">View appointments &amp; schedules &rarr;</a>
        </article>

        <article class="card">
            <div class="card-header">
                <h2 class="card-title">Continue ongoing work</h2>
                <span class="card-meta">Report spotlight</span>
            </div>

            @if ($spotlightReport)
                <div class="spotlight-head">
                    <h3 class="spotlight-title">{{ $spotlightReport->referenceCode() }} &middot; {{ $spotlightReport->category }}</h3>
                    <span class="status-pill status-{{ strtolower($spotlightReport->status) }}">
                        {{ ucfirst($spotlightReport->status) }}
                    </span>
                </div>
                <p class="spotlight-body">{{ \Illuminate\Support\Str::limit($spotlightReport->description, 150) }}</p>
                <p class="spotlight-meta">
                    {{ $spotlightReport->location }} &middot; Submitted {{ $spotlightReport->created_at->format('M j, Y') }} &middot; Updated {{ $spotlightReport->updated_at->format('M j') }}
                </p>
                <a class="action-link" href="{{ route('secretary.reports.show', $spotlightReport) }}">Open report detail / review &rarr;</a>
            @else
                <p class="empty-note">No active reports in progress right now. Newly received or ongoing cases will appear here for quick follow-up.</p>
                <a class="action-link" href="{{ route('secretary.cases.index') }}">Open case management &rarr;</a>
            @endif
        </article>
    </section>
@endsection
