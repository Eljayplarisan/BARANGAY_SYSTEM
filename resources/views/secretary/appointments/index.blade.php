@extends('secretary.layout')

@section('title', 'Appointments & Schedules')

@push('styles')
    .schedule-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
        gap: 16px;
        align-items: start;
    }

    .schedule-col {
        display: grid;
        gap: 16px;
    }

    .appt-list {
        display: grid;
        gap: 12px;
        padding-top: 12px;
        border-top: 1px solid #edf3f8;
    }

    .appt-row {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #eef4fa;
    }

    .appt-row:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .appt-left {
        display: grid;
        grid-template-columns: 96px minmax(0, 1fr);
        gap: 12px;
    }

    .appt-time {
        font-size: 0.82rem;
        font-weight: 800;
        color: #0f2942;
    }

    .appt-date-sub {
        margin-top: 2px;
        font-size: 0.72rem;
        color: #7c92a8;
    }

    .appt-title {
        font-size: 0.86rem;
        font-weight: 700;
        color: #0f2942;
    }

    .appt-meta {
        margin-top: 3px;
        font-size: 0.76rem;
        color: #647b93;
    }

    .appt-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
    }

    .mini-btn {
        min-height: 30px;
        padding: 0 10px;
        border: 1px solid #d5e3f0;
        border-radius: 6px;
        background: #ffffff;
        color: #294661;
        font-size: 0.74rem;
        font-weight: 700;
        cursor: pointer;
    }

    .mini-btn:hover {
        border-color: #0d5aa7;
        color: #0d5aa7;
    }

    .schedule-form {
        display: grid;
        gap: 12px;
        padding-top: 12px;
        border-top: 1px solid #edf3f8;
    }

    .form-2col {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .empty-note {
        margin: 0;
        padding: 16px;
        border-radius: 9px;
        background: #f8fbfe;
        border: 1px dashed #d3e2f0;
        color: #5d748c;
        font-size: 0.82rem;
    }

    @media (max-width: 960px) {
        .schedule-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 540px) {
        .appt-left,
        .form-2col {
            grid-template-columns: 1fr;
            gap: 6px;
        }
    }
@endpush

@section('content')
    <div class="page-header">
        <div>
            <span class="eyebrow">06 / SCHEDULING</span>
            <h1 class="page-title">Appointments &amp; Schedules</h1>
            <p class="page-subtitle">Coordinate resident consultations, Lupong Tagapamayapa mediations, and site inspections.</p>
        </div>
    </div>

    <div class="schedule-grid">
        <div class="schedule-col">
            <article class="card">
                <div class="card-header">
                    <h2 class="card-title">Today's appointments</h2>
                    <span class="card-meta">{{ $todayAppointments->count() }} total</span>
                </div>

                @if ($todayAppointments->isEmpty())
                    <p class="empty-note">No appointments scheduled for today.</p>
                @else
                    <div class="appt-list">
                        @foreach ($todayAppointments as $appointment)
                            <div class="appt-row">
                                <div class="appt-left">
                                    <div>
                                        <div class="appt-time">{{ $appointment->scheduled_at->format('g:i A') }}</div>
                                        <div class="appt-date-sub">{{ $appointment->duration_minutes }} minutes</div>
                                    </div>
                                    <div>
                                        <div class="appt-title">
                                            {{ $appointment->title }}@if ($appointment->report) &middot; <a class="action-link" href="{{ route('secretary.reports.show', $appointment->report) }}">{{ $appointment->report->referenceCode() }}</a>@endif
                                        </div>
                                        <div class="appt-meta">
                                            {{ $appointment->location }}@if ($appointment->assignee) &middot; {{ $appointment->assignee }}@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="appt-actions">
                                    <span class="status-pill status-{{ strtolower($appointment->status) }}">{{ ucfirst($appointment->status) }}</span>
                                    @if ($appointment->status === 'scheduled')
                                        <form method="POST" action="{{ route('secretary.appointments.update', $appointment) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button class="mini-btn" type="submit">Complete</button>
                                        </form>
                                        <form method="POST" action="{{ route('secretary.appointments.update', $appointment) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button class="mini-btn" type="submit">Cancel</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </article>

            <article class="card">
                <div class="card-header">
                    <h2 class="card-title">Upcoming schedules</h2>
                    <span class="card-meta">{{ $upcomingAppointments->count() }} scheduled</span>
                </div>

                @if ($upcomingAppointments->isEmpty())
                    <p class="empty-note">No upcoming appointments scheduled yet.</p>
                @else
                    <div class="appt-list">
                        @foreach ($upcomingAppointments as $appointment)
                            <div class="appt-row">
                                <div class="appt-left">
                                    <div>
                                        <div class="appt-time">{{ $appointment->scheduled_at->format('M j, g:i A') }}</div>
                                        <div class="appt-date-sub">{{ $appointment->duration_minutes }} minutes</div>
                                    </div>
                                    <div>
                                        <div class="appt-title">
                                            {{ $appointment->title }}@if ($appointment->report) &middot; <a class="action-link" href="{{ route('secretary.reports.show', $appointment->report) }}">{{ $appointment->report->referenceCode() }}</a>@endif
                                        </div>
                                        <div class="appt-meta">
                                            {{ $appointment->location }}@if ($appointment->assignee) &middot; {{ $appointment->assignee }}@endif
                                        </div>
                                    </div>
                                </div>
                                <span class="status-pill status-{{ strtolower($appointment->status) }}">{{ ucfirst($appointment->status) }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </article>
        </div>

        <article class="card">
            <div class="card-header">
                <h2 class="card-title">Schedule an appointment</h2>
                <span class="card-meta">New entry</span>
            </div>

            <form class="schedule-form" method="POST" action="{{ route('secretary.appointments.store') }}">
                @csrf
                <div class="form-field">
                    <label for="title">Appointment title *</label>
                    <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Resident consultation or Site inspection" required>
                </div>

                <div class="form-field">
                    <label for="report_id">Linked report (optional)</label>
                    <select id="report_id" class="form-control" name="report_id">
                        <option value="">None (general appointment)</option>
                        @foreach ($reports as $reportOption)
                            <option value="{{ $reportOption->id }}" @selected((int) old('report_id', $preselectedReportId) === $reportOption->id)>
                                {{ $reportOption->referenceCode() }} &middot; {{ $reportOption->category }} ({{ ucfirst($reportOption->status) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-2col">
                    <div class="form-field">
                        <label for="scheduled_at">Date &amp; time *</label>
                        <input id="scheduled_at" class="form-control" type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" required>
                    </div>
                    <div class="form-field">
                        <label for="duration_minutes">Duration (minutes) *</label>
                        <input id="duration_minutes" class="form-control" type="number" name="duration_minutes" value="{{ old('duration_minutes', 30) }}" min="10" max="240" required>
                    </div>
                </div>

                <div class="form-field">
                    <label for="location">Location *</label>
                    <input id="location" class="form-control" type="text" name="location" value="{{ old('location', 'Barangay hall') }}" placeholder="e.g. Barangay hall or Purok 3" required>
                </div>

                <div class="form-field">
                    <label for="assignee">Assigned councilor / team</label>
                    <input id="assignee" class="form-control" type="text" name="assignee" value="{{ old('assignee') }}" placeholder="e.g. Councilor Elena Reyes or Maintenance team">
                </div>

                <div class="form-field">
                    <label for="notes">Notes (optional)</label>
                    <textarea id="notes" class="form-control" name="notes" placeholder="Agenda or preparation notes...">{{ old('notes') }}</textarea>
                </div>

                <button class="btn-primary" type="submit">Save appointment</button>
            </form>
        </article>
    </div>
@endsection
