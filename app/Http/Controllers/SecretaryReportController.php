<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SecretaryReportController extends Controller
{
    public function incoming(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $tab = trim((string) $request->query('tab', 'all'));
        $typeFilter = trim((string) $request->query('type', ''));
        $dateFilter = trim((string) $request->query('date', ''));

        if (! in_array($tab, ['all', 'submitted', 'received'], true)) {
            $tab = 'all';
        }

        $submittedCount = Report::where('status', 'submitted')->count();
        $receivedCount = Report::where('status', 'received')->count();
        $intakeCount = $submittedCount + $receivedCount;

        $query = Report::with('user')
            ->whereIn('status', $tab === 'all' ? ['submitted', 'received'] : [$tab])
            ->orderByRaw("CASE WHEN status = 'submitted' THEN 0 ELSE 1 END")
            ->latest();

        if (in_array($typeFilter, ['blotter', 'complaint'], true)) {
            $query->where('type', $typeFilter);
        }

        if ($dateFilter === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($dateFilter === '7d') {
            $query->where('created_at', '>=', now()->subDays(7));
        } elseif ($dateFilter === '30d') {
            $query->where('created_at', '>=', now()->subDays(30));
        }

        if ($search !== '') {
            $this->applySearch($query, $search);
        }

        $ongoingExample = Report::where('status', 'ongoing')->latest('updated_at')->first();

        return view('secretary.reports.incoming', [
            'user' => $request->user(),
            'reports' => $query->paginate(8)->withQueryString(),
            'incomingCount' => $submittedCount,
            'submittedCount' => $submittedCount,
            'receivedCount' => $receivedCount,
            'intakeCount' => $intakeCount,
            'tab' => $tab,
            'search' => $search,
            'typeFilter' => $typeFilter,
            'dateFilter' => $dateFilter,
            'ongoingExample' => $ongoingExample,
        ]);
    }

    public function blotters(Request $request): View
    {
        return $this->renderReportList($request, [
            'activeNav' => 'blotters',
            'eyebrow' => '03 / BLOTTER LEDGER',
            'title' => 'Blotter Records',
            'subtitle' => 'Official barangay blotter entries from initial filing through resolution and closure.',
            'fixedType' => 'blotter',
            'routeName' => 'secretary.reports.blotters',
        ]);
    }

    public function cases(Request $request): View
    {
        return $this->renderReportList($request, [
            'activeNav' => 'cases',
            'eyebrow' => '05 / CASE MANAGEMENT',
            'title' => 'Case Management',
            'subtitle' => 'Track and manage all blotter and community maintenance cases across every stage.',
            'fixedType' => null,
            'routeName' => 'secretary.cases.index',
        ]);
    }

    public function show(Request $request, Report $report): View
    {
        $report->load(['user', 'appointments' => fn ($query) => $query->orderBy('scheduled_at')]);

        $steps = Report::STATUSES;
        $currentIndex = array_search($report->status, $steps, true);
        $currentIndex = $currentIndex === false ? 0 : $currentIndex;
        $history = is_array($report->status_history) ? $report->status_history : [];

        $timeline = [];
        foreach ($steps as $index => $statusKey) {
            $recordedDate = null;
            if ($statusKey === 'submitted') {
                $recordedDate = $report->created_at->format('M j, Y');
            } elseif (! empty($history[$statusKey]['at'])) {
                $recordedDate = Carbon::parse($history[$statusKey]['at'])->format('M j, Y');
            } elseif ($index <= $currentIndex) {
                $recordedDate = $report->updated_at->format('M j, Y');
            }

            $timeline[] = [
                'key' => $statusKey,
                'label' => ucfirst($statusKey),
                'date' => $recordedDate ?? 'Not yet',
                'reached' => $index <= $currentIndex,
                'current' => $index === $currentIndex,
                'message' => $history[$statusKey]['message'] ?? null,
            ];
        }

        $receivedAt = null;
        if ($report->status !== 'submitted') {
            $receivedAt = ! empty($history['received']['at'])
                ? Carbon::parse($history['received']['at'])->format('M j')
                : $report->updated_at->format('M j');
        }

        $internalNotes = is_array($report->internal_notes) ? $report->internal_notes : [];
        if ($internalNotes === [] && filled($report->secretary_notes)) {
            $internalNotes[] = [
                'author' => $request->user()->name,
                'note' => $report->secretary_notes,
                'created_at' => $report->updated_at->toIso8601String(),
            ];
        }

        $formalCode = ($report->type === 'blotter' ? 'BR-' : 'MR-')
            .$report->created_at->format('Y').'-'
            .str_pad((string) $report->id, 3, '0', STR_PAD_LEFT);

        return view('secretary.reports.show', [
            'user' => $request->user(),
            'report' => $report,
            'timeline' => $timeline,
            'statuses' => Report::STATUSES,
            'receivedAt' => $receivedAt,
            'internalNotes' => $internalNotes,
            'formalCode' => $formalCode,
            'incomingCount' => Report::where('status', 'submitted')->count(),
        ]);
    }

    public function updateStatus(Request $request, Report $report): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in(Report::STATUSES)],
            'assigned_to' => ['nullable', 'string', 'max:255'],
            'resident_message' => ['nullable', 'string', 'max:1000'],
        ]);

        $history = is_array($report->status_history) ? $report->status_history : [];
        if (empty($history['submitted']['at'])) {
            $history['submitted'] = [
                'at' => $report->created_at->toIso8601String(),
                'message' => null,
            ];
        }

        $newStatus = $validated['status'];
        $nowIso = now()->toIso8601String();

        if ($newStatus !== 'submitted' && empty($history['received']['at'])) {
            $history['received'] = [
                'at' => $nowIso,
                'message' => null,
            ];
        }

        $message = trim((string) ($validated['resident_message'] ?? ''));
        $history[$newStatus] = [
            'at' => $nowIso,
            'message' => $message !== '' ? $message : ($history[$newStatus]['message'] ?? null),
        ];

        $updates = [
            'status' => $newStatus,
            'status_history' => $history,
        ];

        if ($request->has('assigned_to')) {
            $updates['assigned_to'] = $validated['assigned_to'];
        }

        if ($message !== '') {
            $updates['resident_message'] = $message;
        }

        $report->update($updates);

        return back()->with(
            'status',
            $report->referenceCode().' updated to '.ucfirst($report->status).' and synced to resident tracking.'
        );
    }

    public function storeNote(Request $request, Report $report): RedirectResponse
    {
        $validated = $request->validate([
            'note' => ['required', 'string', 'max:1000'],
        ]);

        $notes = is_array($report->internal_notes) ? $report->internal_notes : [];
        $notes[] = [
            'author' => $request->user()->name,
            'note' => trim($validated['note']),
            'created_at' => now()->toIso8601String(),
        ];

        $report->update([
            'internal_notes' => $notes,
            'secretary_notes' => trim($validated['note']),
        ]);

        return back()->with('status', 'Internal secretary note saved (staff only).');
    }

    public function attachment(Report $report): StreamedResponse
    {
        abort_unless(
            $report->attachment_path && Storage::exists($report->attachment_path),
            404
        );

        return Storage::response($report->attachment_path);
    }

    /**
     * @param array{activeNav: string, eyebrow: string, title: string, subtitle: string, fixedType: ?string, routeName: string} $config
     */
    private function renderReportList(Request $request, array $config): View
    {
        $search = trim((string) $request->query('search', ''));
        $statusFilter = trim((string) $request->query('status', ''));

        $query = Report::with('user')->latest();

        if ($config['fixedType'] !== null) {
            $query->where('type', $config['fixedType']);
        }

        if ($statusFilter !== '' && in_array($statusFilter, Report::STATUSES, true)) {
            $query->where('status', $statusFilter);
        }

        if ($search !== '') {
            $this->applySearch($query, $search);
        }

        return view('secretary.reports.index', [
            'user' => $request->user(),
            'reports' => $query->paginate(10)->withQueryString(),
            'incomingCount' => Report::where('status', 'submitted')->count(),
            'statuses' => Report::STATUSES,
            'search' => $search,
            'statusFilter' => $statusFilter,
            ...$config,
        ]);
    }

    private function applySearch($query, string $search): void
    {
        $numericId = preg_replace('/[^0-9]/', '', $search);

        $query->where(function ($builder) use ($search, $numericId) {
            $builder->where('category', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', "%{$search}%"));

            if ($numericId !== '') {
                $builder->orWhere('id', (int) $numericId);
            }
        });
    }
}
