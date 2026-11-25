<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SecretaryDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $rawCounts = Report::query()
            ->select('status', DB::raw('COUNT(*) as aggregate'))
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        $statusCounts = [];
        foreach (Report::STATUSES as $status) {
            $statusCounts[$status] = (int) ($rawCounts[$status] ?? 0);
        }

        $totalReports = array_sum($statusCounts);
        $incomingCount = $statusCounts['submitted'];
        $activeReports = $statusCounts['submitted']
            + $statusCounts['received']
            + $statusCounts['referred']
            + $statusCounts['ongoing'];
        $resolvedReports = $statusCounts['resolved'];
        $closedReports = $statusCounts['closed'];

        $maxStatusCount = max(1, ...array_values($statusCounts));
        $statusBreakdown = [];
        foreach (Report::STATUSES as $status) {
            $count = $statusCounts[$status];
            $statusBreakdown[] = [
                'key' => $status,
                'label' => ucfirst($status),
                'count' => $count,
                'percent' => $totalReports > 0 ? (int) round(($count / $maxStatusCount) * 100) : 0,
            ];
        }

        $submissionsQuery = Report::with('user')->latest();
        if ($incomingCount > 0) {
            $submissionsQuery->where('status', 'submitted');
        }
        $recentSubmissions = $submissionsQuery->paginate(3)->withQueryString();

        $todayAppointments = Appointment::with('report')
            ->whereDate('scheduled_at', today())
            ->where('status', 'scheduled')
            ->orderBy('scheduled_at')
            ->get();

        $spotlightReport = Report::with('user')
            ->where('status', 'ongoing')
            ->latest('updated_at')
            ->first()
            ?? Report::with('user')
                ->whereIn('status', Report::ACTIVE_STATUSES)
                ->latest('updated_at')
                ->first();

        $hour = now()->hour;
        $greeting = match (true) {
            $hour < 12 => 'Good morning',
            $hour < 18 => 'Good afternoon',
            default => 'Good evening',
        };

        return view('secretary.dashboard', [
            'user' => $request->user(),
            'greeting' => $greeting,
            'incomingCount' => $incomingCount,
            'totalReports' => $totalReports,
            'activeReports' => $activeReports,
            'resolvedReports' => $resolvedReports,
            'closedReports' => $closedReports,
            'statusBreakdown' => $statusBreakdown,
            'recentSubmissions' => $recentSubmissions,
            'todayAppointments' => $todayAppointments,
            'spotlightReport' => $spotlightReport,
        ]);
    }
}
