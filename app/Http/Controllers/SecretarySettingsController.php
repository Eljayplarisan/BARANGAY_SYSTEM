<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SecretarySettingsController extends Controller
{
    public function index(Request $request): View
    {
        $byCategory = Report::query()
            ->select('category', DB::raw('COUNT(*) as total'))
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        $blotterCount = Report::where('type', 'blotter')->count();
        $maintenanceCount = Report::where('type', 'complaint')->count();
        $residentCount = User::where('role', User::ROLE_RESIDENT)->count();

        return view('secretary.settings.index', [
            'user' => $request->user(),
            'byCategory' => $byCategory,
            'blotterCount' => $blotterCount,
            'maintenanceCount' => $maintenanceCount,
            'residentCount' => $residentCount,
            'incomingCount' => Report::where('status', 'submitted')->count(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->update($validated);

        return redirect()
            ->route('secretary.settings.index')
            ->with('status', 'Secretary account details updated.');
    }
}
