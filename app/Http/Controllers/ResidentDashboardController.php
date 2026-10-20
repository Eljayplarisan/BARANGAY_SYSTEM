<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ResidentDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('resident.dashboard');
    }
}
