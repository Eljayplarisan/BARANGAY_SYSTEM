<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResidentReportController extends Controller
{
    private const CATEGORIES = [
        'Infrastructure',
        'Peace and Order',
        'Education',
        'Profession',
        'Health',
        'Kasambahay and Environment',
        'Senior Citizen',
        'Other',
    ];

    public function create(Request $request): View
    {
        $type = $request->query('type', 'complaint');

        abort_unless(in_array($type, ['blotter', 'complaint'], true), 404);

        return view('resident.reports.create', [
            'type' => $type,
            'categories' => self::CATEGORIES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:blotter,complaint'],
            'category' => ['required', 'string', 'in:'.implode(',', self::CATEGORIES)],
            'occurred_at' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
        ]);

        $attachmentPath = $request->file('attachment')?->store('report-attachments');

        Report::create([
            'user_id' => $request->user()->id,
            'type' => $validated['type'],
            'category' => $validated['category'],
            'occurred_at' => $validated['occurred_at'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'attachment_path' => $attachmentPath,
            'status' => 'submitted',
        ]);

        return redirect()
            ->route('resident.dashboard')
            ->with('status', 'Your report has been submitted successfully.');
    }
}
