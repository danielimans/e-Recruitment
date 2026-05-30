<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserJobController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Root Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // 1. If user is logged in, send them to their dashboard
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }

    // 2. If NOT logged in, show the Landing Page (welcome.blade.php)
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect (Generic)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->get('/dashboard', function () {
    return Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/jobs', JobController::class);
    Route::get('/applications', [AdminController::class, 'applications'])->name('admin.applications');
    Route::post('/applications/{application}/approve', [ApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('user')->group(function () {

    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/jobs', [UserJobController::class, 'index'])->name('user.jobs.index');

    Route::post('/apply/{job}', [ApplicationController::class, 'store'])->name('apply.job');

    Route::get('/applications', [UserController::class, 'applications'])->name('user.applications');

    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::post('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');

    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change.password');

    // Resume Builder Routes
    Route::get('/resume-builder', [ResumeController::class, 'index'])->name('user.resume');
    Route::post('/resume-builder/save', [ResumeController::class, 'store'])->name('user.resume.store');

});

use Illuminate\Support\Facades\Artisan;

Route::get('/run-migration', function () {
    // This runs the command programmatically
    Artisan::call('migrate', ['--force' => true]);

    return 'Migration run successfully! output: '.Artisan::output();
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
