@extends('secretary.layout')

@section('title', 'Incoming Reports')

@push('styles')
    .kpi-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 16px;
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
        font-size: 1.85rem;
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

    .filter-bar {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 200px 150px;
        gap: 10px;
        margin-bottom: 12px;
    }

    .search-box {
        position: relative;
    }

    .search-box svg {
        position: absolute;
        top: 50%;
        left: 12px;
        width: 16px;
        height: 16px;
        transform: translateY(-50%);
        color: #7c92a8;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        pointer-events: none;
    }

    .search-box input {
        padding-left: 36px;
    }

    .intake-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 16px;
    }

    .intake-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 36px;
        padding: 0 14px;
        border: 1px solid #d5e3f0;
        border-radius: 8px;
        background: #ffffff;
        color: #294661;
        font-size: 0.8rem;
        font-weight: 700;
        transition: all 0.15s ease;
    }

    .intake-tab:hover {
        border-color: #9dc2e6;
        color: #0d5aa7;
    }

    .intake-tab.active {
        border-color: #0d5aa7;
        background: #0d5aa7;
        color: #ffffff;
    }

    .type-cell-main {
        font-weight: 700;
        color: #0f2942;
    }

    .type-cell-sub {
        margin-top: 2px;
        font-size: 0.75rem;
        color: #647b93;
    }

    .queue-card {
        background: #ffffff;
        border: 1px solid #e1ebf4;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 18px;
    }

    .queue-card .table-wrap {
        border: 0;
        border-radius: 0;
    }

    .queue-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 13px 16px;
        border-top: 1px solid #eef4fa;
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

    .guidance-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(0, 1fr);
        gap: 16px;
        align-items: start;
    }

    .guide-title {
        margin: 0 0 10px;
        font-size: 0.96rem;
        font-weight: 700;
        color: #0f2942;
    }

    .guide-divider {
        height: 1px;
        background: #edf3f8;
        margin: 0 0 12px;
    }

    .guide-copy {
        margin: 0 0 12px;
        font-size: 0.82rem;
        line-height: 1.55;
        color: #3f5c78;
    }

    .guide-highlight {
        margin: 0;
        font-size: 0.82rem;
        font-weight: 700;
        color: #0d5aa7;
    }

    .info-callout {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 16px 18px;
        border: 1px solid #cde2f8;
        border-radius: 12px;
        background: #e8f3fe;
    }

    .info-callout svg {
        width: 19px;
        height: 19px;
        flex: 0 0 19px;
        margin-top: 1px;
        color: #1660ad;
    }

    .info-callout-title {
        margin: 0 0 4px;
        font-size: 0.84rem;
        font-weight: 800;
        color: #0f2942;
    }

    .info-callout-copy {
        margin: 0;
        font-size: 0.8rem;
        line-height: 1.5;
        color: #466584;
    }

    .empty-queue {
        padding: 32px 20px;
        text-align: center;
        color: #5d748c;
        font-size: 0.86rem;
    }

    @media (max-width: 900px) {
        .filter-bar {
            grid-template-columns: 1fr 1fr;
        }

        .search-box {
            grid-column: 1 / -1;
        }

        .guidance-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .kpi-grid-3 {
            grid-template-columns: 1fr;
        }

        .filter-bar {
            grid-template-columns: 1fr;
        }
    }
@endpush

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Incoming Reports</h1>
            <p class="page-subtitle">Review new resident submissions without changing their original content.</p>
        </div>
        <a class="btn-secondary" href="{{ route('secretary.reports.incoming') }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
            Refresh queue
        </a>
    </div>

    <section class="kpi-grid-3" aria-label="Incoming queue counts">
        <article class="kpi-card">
            <div class="kpi-label">Submitted</div>
            <div class="kpi-value">{{ $submittedCount }}</div>
            <div class="kpi-sub">Awaiting receipt</div>
        </article>

        <article class="kpi-card">
            <div class="kpi-label">Received</div>
            <div class="kpi-value">{{ $receivedCount }}</div>
            <div class="kpi-sub">Ready for next action</div>
        </article>

        <article class="kpi-card">
            <div class="kpi-label">Intake queue</div>
            <div class="kpi-value">{{ $intakeCount }}</div>
            <div class="kpi-sub">Submitted + Received</div>
        </article>
    </section>

    <form class="filter-bar" method="GET" action="{{ route('secretary.reports.incoming') }}">
        <input type="hidden" name="tab" value="{{ $tab }}">
        <div class="search-box">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input class="form-control" type="search" name="search" value="{{ $search }}" placeholder="Search report ID, resident or location" aria-label="Search report ID, resident or location">
        </div>

        <select class="form-control" name="type" aria-label="Filter by submission type" onchange="this.form.submit()">
            <option value="">All submission types</option>
            <option value="blotter" @selected($typeFilter === 'blotter')>Blotter Report</option>
            <option value="complaint" @selected($typeFilter === 'complaint')>Maintenance Report</option>
        </select>

        <select class="form-control" name="date" aria-label="Filter by date" onchange="this.form.submit()">
            <option value="">All dates</option>
            <option value="today" @selected($dateFilter === 'today')>Today</option>
            <option value="7d" @selected($dateFilter === '7d')>Last 7 days</option>
            <option value="30d" @selected($dateFilter === '30d')>Last 30 days</option>
        </select>
    </form>

    <div class="intake-tabs" role="tablist" aria-label="Intake status tabs">
        <a class="intake-tab {{ $tab === 'all' ? 'active' : '' }}" href="{{ route('secretary.reports.incoming', array_filter(['tab' => 'all', 'search' => $search, 'type' => $typeFilter, 'date' => $dateFilter])) }}">
            All intake &middot; {{ $intakeCount }}
        </a>
        <a class="intake-tab {{ $tab === 'submitted' ? 'active' : '' }}" href="{{ route('secretary.reports.incoming', array_filter(['tab' => 'submitted', 'search' => $search, 'type' => $typeFilter, 'date' => $dateFilter])) }}">
            Submitted &middot; {{ $submittedCount }}
        </a>
        <a class="intake-tab {{ $tab === 'received' ? 'active' : '' }}" href="{{ route('secretary.reports.incoming', array_filter(['tab' => 'received', 'search' => $search, 'type' => $typeFilter, 'date' => $dateFilter])) }}">
            Received &middot; {{ $receivedCount }}
        </a>
    </div>

    <section class="queue-card" aria-label="Incoming reports list">
        @if ($reports->isEmpty())
            <div class="empty-queue">
                No intake reports match your current filter.
            </div>
        @else
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Resident</th>
                            <th>Submission type / category</th>
                            <th>Location</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td class="report-ref">{{ $report->referenceCode() }}</td>
                                <td>{{ $report->user?->name ?? 'Resident' }}</td>
                                <td>
                                    <div class="type-cell-main">{{ $report->submissionTypeLabel() }}</div>
                                    <div class="type-cell-sub">{{ $report->category }}</div>
                                </td>
                                <td>{{ $report->location }}</td>
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
                    Showing {{ $reports->firstItem() }}&ndash;{{ $reports->lastItem() }} of {{ $reports->total() }} intake {{ \Illuminate\Support\Str::plural('report', $reports->total()) }}
                </span>
                <div class="mini-pagination" aria-label="Intake pagination">
                    @if ($reports->onFirstPage())
                        <span class="page-disabled">Previous</span>
                    @else
                        <a href="{{ $reports->previousPageUrl() }}">Previous</a>
                    @endif

                    <span class="page-current">{{ $reports->currentPage() }}</span>

                    @if ($reports->hasMorePages())
                        <a href="{{ $reports->nextPageUrl() }}">Next</a>
                    @else
                        <span class="page-disabled">Next</span>
                    @endif
                </div>
            </div>
        @endif
    </section>

    <section class="guidance-grid">
        <article class="card">
            <h2 class="guide-title">Next: review and receive</h2>
            <div class="guide-divider"></div>
            <p class="guide-copy">
                <strong>Review &rarr; Report Detail / Review.</strong> Check date/time, location, category, resident details, description and any attachments.
            </p>
            <p class="guide-highlight">Mark as Received &rarr; confirm resident-visible update</p>
        </article>

        <aside class="info-callout" role="note">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <div>
                @if ($ongoingExample)
                    <p class="info-callout-title">{{ $ongoingExample->referenceCode() }} is not a new submission.</p>
                    <p class="info-callout-copy">
                        It is already Ongoing. Open it from the <a class="action-link" href="{{ route('secretary.dashboard') }}">Dashboard</a> or <a class="action-link" href="{{ route('secretary.cases.index') }}">Case Management</a> to continue work.
                    </p>
                @else
                    <p class="info-callout-title">Only intake items appear in this queue.</p>
                    <p class="info-callout-copy">
                        Once a report moves to Referred, Ongoing, Resolved, or Closed, manage it from <a class="action-link" href="{{ route('secretary.cases.index') }}">Case Management</a>.
                    </p>
                @endif
            </div>
        </aside>
    </section>
@endsection
