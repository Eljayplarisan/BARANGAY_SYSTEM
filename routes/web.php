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
use App\Http\Middleware\EnsureResident;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

Route::middleware(['auth', EnsureResident::class])->group(function () {
    Route::get('/dashboard', ResidentDashboardController::class)->name('resident.dashboard');
    Route::get('/reports/create', [ResidentReportController::class, 'create'])->name('resident.reports.create');
    Route::get('/my-reports', ResidentMyReportsController::class)->name('resident.reports.index');
    Route::post('/reports', [ResidentReportController::class, 'store'])->name('resident.reports.store');
    Route::get('/profile', [ResidentProfileController::class, 'edit'])->name('resident.profile.edit');
    Route::put('/profile', [ResidentProfileController::class, 'update'])->name('resident.profile.update');
    Route::post('/logout', AuthenticatedSessionLogoutController::class)->name('logout');
});
