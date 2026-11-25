<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SecretaryResidentController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $query = User::query()
            ->where('role', User::ROLE_RESIDENT)
            ->withCount('reports')
            ->latest();

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return view('secretary.residents.index', [
            'user' => $request->user(),
            'residents' => $query->paginate(12)->withQueryString(),
            'search' => $search,
            'incomingCount' => Report::where('status', 'submitted')->count(),
        ]);
    }
}
