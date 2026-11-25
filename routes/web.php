<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionLogoutController;
use App\Http\Controllers\ResidentDashboardController;
use App\Http\Controllers\ResidentReportController;
use App\Http\Controllers\ResidentMyReportsController;
use App\Http\Controllers\ResidentProfileController;
use App\Http\Controllers\SecretaryAppointmentController;
use App\Http\Controllers\SecretaryDashboardController;
use App\Http\Controllers\SecretaryReportController;
use App\Http\Controllers\SecretaryResidentController;
use App\Http\Controllers\SecretarySettingsController;
use App\Http\Middleware\EnsureResident;
use App\Http\Middleware\EnsureSecretary;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sitemap.xml', function () {
    $urls = [
        url('/'),
        route('login'),
        route('register'),
    ];

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'
        .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($urls as $loc) {
        $xml .= '<url><loc>'.e($loc).'</loc><changefreq>weekly</changefreq></url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
})->name('sitemap');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', AuthenticatedSessionLogoutController::class)->name('logout');
});

Route::middleware(['auth', EnsureResident::class])->group(function () {
    Route::get('/dashboard', ResidentDashboardController::class)->name('resident.dashboard');
    Route::get('/reports/create', [ResidentReportController::class, 'create'])->name('resident.reports.create');
    Route::get('/my-reports', ResidentMyReportsController::class)->name('resident.reports.index');
    Route::post('/reports', [ResidentReportController::class, 'store'])->name('resident.reports.store');
    Route::get('/profile', [ResidentProfileController::class, 'edit'])->name('resident.profile.edit');
    Route::put('/profile', [ResidentProfileController::class, 'update'])->name('resident.profile.update');
});

Route::middleware(['auth', EnsureSecretary::class])
    ->prefix('secretary')
    ->name('secretary.')
    ->group(function () {
        Route::get('/dashboard', SecretaryDashboardController::class)->name('dashboard');
        Route::get('/incoming-reports', [SecretaryReportController::class, 'incoming'])->name('reports.incoming');
        Route::get('/blotter-records', [SecretaryReportController::class, 'blotters'])->name('reports.blotters');
        Route::post('/blotter-records', [SecretaryReportController::class, 'storeBlotterEntry'])->name('reports.blotters.store');
        Route::get('/case-management', [SecretaryReportController::class, 'cases'])->name('cases.index');
        Route::patch('/case-management/{report}/assignment', [SecretaryReportController::class, 'updateAssignment'])->name('cases.assignment');
        Route::get('/reports/{report}', [SecretaryReportController::class, 'show'])->name('reports.show');
        Route::patch('/reports/{report}/status', [SecretaryReportController::class, 'updateStatus'])->name('reports.status');
        Route::post('/reports/{report}/notes', [SecretaryReportController::class, 'storeNote'])->name('reports.notes.store');
        Route::get('/reports/{report}/attachment', [SecretaryReportController::class, 'attachment'])->name('reports.attachment');
        Route::get('/residents', [SecretaryResidentController::class, 'index'])->name('residents.index');
        Route::get('/appointments', [SecretaryAppointmentController::class, 'index'])->name('appointments.index');
        Route::post('/appointments', [SecretaryAppointmentController::class, 'store'])->name('appointments.store');
        Route::patch('/appointments/{appointment}', [SecretaryAppointmentController::class, 'update'])->name('appointments.update');
        Route::get('/settings', [SecretarySettingsController::class, 'index'])->name('settings.index');
        Route::get('/settings/export-csv', [SecretarySettingsController::class, 'exportCsv'])->name('settings.export');
        Route::put('/settings', [SecretarySettingsController::class, 'update'])->name('settings.update');
        Route::put('/settings/password', [SecretarySettingsController::class, 'updatePassword'])->name('settings.password');
    });
