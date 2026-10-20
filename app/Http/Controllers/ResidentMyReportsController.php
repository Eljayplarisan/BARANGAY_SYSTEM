<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResidentMyReportsController extends Controller
{
    public function __invoke(Request $request): View
    {
        $reports = $request->user()
            ->reports()
            ->latest()
            ->get();

        $selectedReport = null;
        if ($request->filled('report')) {
            $selectedReport = $request->user()
                ->reports()
                ->whereKey($request->integer('report'))
                ->firstOrFail();
        } else {
            $selectedReport = $reports->first();
        }

        return view('resident.reports.index', [
            'user' => $request->user(),
            'reports' => $reports,
            'selectedReport' => $selectedReport,
            'timeline' => $selectedReport
                ? $this->timelineFor($selectedReport)
                : [],
        ]);
    }

    /**
     * @return array<int, array{label: string, date: string, state: string}>
     */
    private function timelineFor(Report $report): array
    {
        $steps = ['Submitted', 'Received', 'Referred', 'Ongoing', 'Resolved', 'Closed'];
        $currentStep = array_search(ucfirst($report->status), $steps, true);
        $currentStep = $currentStep === false ? 0 : $currentStep;

        return array_map(
            fn (string $label, int $index): array => [
                'label' => $label,
                'date' => $index === 0 ? $report->created_at->format('M j') : '',
                'state' => $index < $currentStep ? 'complete' : ($index === $currentStep ? 'current' : 'upcoming'),
            ],
            $steps,
            array_keys($steps)
        );
    }
}
