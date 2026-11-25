@extends('secretary.layout')

@section('title', $title)

@push('styles')
    .toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 14px;
    }

    .toolbar-search {
        position: relative;
        flex: 1 1 280px;
    }

    .toolbar-search svg {
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
    }

    .toolbar-search input {
        padding-left: 36px;
    }

    .status-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 16px;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        min-height: 34px;
        padding: 0 13px;
        border: 1px solid #d5e3f0;
        border-radius: 8px;
        background: #ffffff;
        color: #294661;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .filter-pill.active {
        border-color: #0d5aa7;
        background: #0d5aa7;
        color: #ffffff;
    }

    .list-card {
        background: #ffffff;
        border: 1px solid #e1ebf4;
        border-radius: 12px;
        overflow: hidden;
    }

    .list-card .table-wrap {
        border: 0;
        border-radius: 0;
    }

    .type-main { font-weight: 700; color: #0f2942; }
    .type-sub { margin-top: 2px; font-size: 0.74rem; color: #647b93; }

    .list-footer {
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

    .mini-pagination a { color: #294661; font-weight: 600; }
    .mini-pagination a:hover { color: #0d5aa7; }
    .mini-pagination .page-disabled { color: #a6b7c8; }
    .mini-pagination .page-current { color: #0f2942; font-weight: 800; }

    .empty-state {
        padding: 32px 20px;
        text-align: center;
        color: #5d748c;
        font-size: 0.86rem;
    }
@endpush

@section('content')
    <div class="page-header">
        <div>
            <span class="eyebrow">{{ $eyebrow }}</span>
            <h1 class="page-title">{{ $title }}</h1>
            <p class="page-subtitle">{{ $subtitle }}</p>
        </div>
        <a class="btn-primary" href="{{ route('secretary.reports.incoming') }}">Open incoming reports</a>
    </div>

    <form class="toolbar" method="GET" action="{{ route($routeName) }}">
        @if ($statusFilter !== '')
            <input type="hidden" name="status" value="{{ $statusFilter }}">
        @endif
        <div class="toolbar-search">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input class="form-control" type="search" name="search" value="{{ $search }}" placeholder="Search report ID, resident, category, or location" aria-label="Search reports">
        </div>
        <button class="btn-secondary" type="submit">Search</button>
    </form>

    <div class="status-pills" aria-label="Filter by status">
        <a class="filter-pill {{ $statusFilter === '' ? 'active' : '' }}" href="{{ route($routeName, array_filter(['search' => $search])) }}">All statuses</a>
        @foreach ($statuses as $statusOption)
            <a class="filter-pill {{ $statusFilter === $statusOption ? 'active' : '' }}" href="{{ route($routeName, array_filter(['status' => $statusOption, 'search' => $search])) }}">
                {{ ucfirst($statusOption) }}
            </a>
        @endforeach
    </div>

    <section class="list-card">
        @if ($reports->isEmpty())
            <div class="empty-state">No records found matching your filter.</div>
        @else
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Resident</th>
                            <th>Submission type / category</th>
                            <th>Location</th>
                            <th>Assigned</th>
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
                                    <div class="type-main">{{ $report->submissionTypeLabel() }}</div>
                                    <div class="type-sub">{{ $report->category }}</div>
                                </td>
                                <td>{{ $report->location }}</td>
                                <td>{{ $report->assigned_to ?: '—' }}</td>
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

            <div class="list-footer">
                <span>Showing {{ $reports->firstItem() }}&ndash;{{ $reports->lastItem() }} of {{ $reports->total() }} {{ \Illuminate\Support\Str::plural('report', $reports->total()) }}</span>
                <div class="mini-pagination">
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
@endsection
