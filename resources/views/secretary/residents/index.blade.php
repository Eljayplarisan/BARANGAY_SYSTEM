@extends('secretary.layout')

@section('title', 'Residents')

@push('styles')
    .toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 16px;
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
            <span class="eyebrow">04 / RESIDENT DIRECTORY</span>
            <h1 class="page-title">Residents</h1>
            <p class="page-subtitle">Registered Barangay Ward II residents and their submitted report counts.</p>
        </div>
    </div>

    <form class="toolbar" method="GET" action="{{ route('secretary.residents.index') }}">
        <div class="toolbar-search">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input class="form-control" type="search" name="search" value="{{ $search }}" placeholder="Search resident name, purok/address, phone, or email" aria-label="Search residents">
        </div>
        <button class="btn-secondary" type="submit">Search</button>
    </form>

    <section class="list-card">
        @if ($residents->isEmpty())
            <div class="empty-state">No registered residents found.</div>
        @else
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Resident ID</th>
                            <th>Full name</th>
                            <th>Address / Purok</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Reports</th>
                            <th>Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($residents as $resident)
                            <tr>
                                <td class="report-ref">R-{{ str_pad((string) $resident->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td><strong>{{ $resident->name }}</strong></td>
                                <td>{{ $resident->address ?: '—' }}</td>
                                <td>{{ $resident->phone ?: '—' }}</td>
                                <td>{{ $resident->email }}</td>
                                <td><span class="status-pill status-submitted">{{ $resident->reports_count }}</span></td>
                                <td>{{ $resident->created_at->format('M j, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="list-footer">
                <span>Showing {{ $residents->firstItem() }}&ndash;{{ $residents->lastItem() }} of {{ $residents->total() }} {{ \Illuminate\Support\Str::plural('resident', $residents->total()) }}</span>
                <div class="mini-pagination">
                    @if ($residents->onFirstPage())
                        <span class="page-disabled">Previous</span>
                    @else
                        <a href="{{ $residents->previousPageUrl() }}">Previous</a>
                    @endif
                    <span class="page-current">{{ $residents->currentPage() }}</span>
                    @if ($residents->hasMorePages())
                        <a href="{{ $residents->nextPageUrl() }}">Next</a>
                    @else
                        <span class="page-disabled">Next</span>
                    @endif
                </div>
            </div>
        @endif
    </section>
@endsection
