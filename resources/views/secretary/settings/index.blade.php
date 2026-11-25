@extends('secretary.layout')

@section('title', 'Reports & Settings')

@push('styles')
    .settings-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr);
        gap: 16px;
        align-items: start;
    }

    .summary-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }

    .stat-box {
        padding: 14px 16px;
        border: 1px solid #e1ebf4;
        border-radius: 10px;
        background: #ffffff;
    }

    .stat-box-label {
        font-size: 0.74rem;
        font-weight: 600;
        color: #647b93;
    }

    .stat-box-val {
        margin-top: 4px;
        font-size: 1.55rem;
        font-weight: 800;
        color: #0f2942;
    }

    .category-list {
        display: grid;
        gap: 10px;
        padding-top: 12px;
        border-top: 1px solid #edf3f8;
    }

    .category-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        font-size: 0.84rem;
        color: #294661;
    }

    .settings-form {
        display: grid;
        gap: 12px;
        padding-top: 12px;
        border-top: 1px solid #edf3f8;
    }

    @media (max-width: 900px) {
        .settings-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 540px) {
        .summary-stats {
            grid-template-columns: 1fr;
        }
    }
@endpush

@section('content')
    <div class="page-header">
        <div>
            <span class="eyebrow">07 / REPORTS &amp; SETTINGS</span>
            <h1 class="page-title">Reports &amp; Settings</h1>
            <p class="page-subtitle">Overview of barangay report totals by classification and secretary account settings.</p>
        </div>
        <button class="btn-secondary" type="button" onclick="window.print()">Print summary</button>
    </div>

    <div class="summary-stats">
        <div class="stat-box">
            <div class="stat-box-label">Blotter Reports</div>
            <div class="stat-box-val">{{ $blotterCount }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-box-label">Maintenance Reports</div>
            <div class="stat-box-val">{{ $maintenanceCount }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-box-label">Registered Residents</div>
            <div class="stat-box-val">{{ $residentCount }}</div>
        </div>
    </div>

    <div class="settings-grid">
        <article class="card">
            <div class="card-header">
                <h2 class="card-title">Reports by category</h2>
                <span class="card-meta">{{ $blotterCount + $maintenanceCount }} total</span>
            </div>

            @if ($byCategory->isEmpty())
                <p style="margin:0;color:#647b93;font-size:0.84rem;">No reports submitted yet.</p>
            @else
                <div class="category-list">
                    @foreach ($byCategory as $row)
                        <div class="category-row">
                            <span>{{ $row->category }}</span>
                            <span class="status-pill status-submitted">{{ $row->total }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </article>

        <article class="card">
            <div class="card-header">
                <h2 class="card-title">Secretary profile</h2>
                <span class="card-meta">{{ $user->email }}</span>
            </div>

            <form class="settings-form" method="POST" action="{{ route('secretary.settings.update') }}">
                @csrf
                @method('PUT')
                <div class="form-field">
                    <label for="name">Full name</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="form-field">
                    <label for="phone">Contact number</label>
                    <input id="phone" class="form-control" type="tel" name="phone" value="{{ old('phone', $user->phone) }}" required>
                </div>
                <div class="form-field">
                    <label for="address">Office / Address</label>
                    <input id="address" class="form-control" type="text" name="address" value="{{ old('address', $user->address) }}" required>
                </div>
                <button class="btn-primary" type="submit">Save settings</button>
            </form>
        </article>
    </div>
@endsection
