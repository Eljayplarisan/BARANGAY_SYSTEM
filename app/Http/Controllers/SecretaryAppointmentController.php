<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SecretaryAppointmentController extends Controller
{
    public function index(Request $request): View
    {
        $todayAppointments = Appointment::with('report')
            ->whereDate('scheduled_at', today())
            ->orderBy('scheduled_at')
            ->get();

        $upcomingAppointments = Appointment::with('report')
            ->where('scheduled_at', '>', today()->endOfDay())
            ->orderBy('scheduled_at')
            ->get();

        $pastAppointments = Appointment::with('report')
            ->where('scheduled_at', '<', today()->startOfDay())
            ->latest('scheduled_at')
            ->limit(10)
            ->get();

        $reports = Report::query()
            ->latest()
            ->limit(50)
            ->get();

        return view('secretary.appointments.index', [
            'user' => $request->user(),
            'todayAppointments' => $todayAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'pastAppointments' => $pastAppointments,
            'reports' => $reports,
            'preselectedReportId' => $request->integer('report') ?: null,
            'incomingCount' => Report::where('status', 'submitted')->count(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'report_id' => ['nullable', 'integer', 'exists:reports,id'],
            'scheduled_at' => ['required', 'date'],
            'duration_minutes' => ['required', 'integer', 'min:10', 'max:240'],
            'location' => ['required', 'string', 'max:255'],
            'assignee' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        Appointment::create([
            ...$validated,
            'created_by' => $request->user()->id,
            'status' => 'scheduled',
        ]);

        return redirect()
            ->route('secretary.appointments.index')
            ->with('status', 'Appointment scheduled successfully.');
    }

    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in(Appointment::STATUSES)],
        ]);

        $appointment->update($validated);

        return back()->with('status', 'Appointment marked as '.ucfirst($appointment->status).'.');
    }
}
