<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserJobController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Root Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
});



Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect (REQUIRED by Breeze)
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
    Route::post('/applications/{application}/approve',[ApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('/applications/{application}/reject',[ApplicationController::class, 'reject'])->name('applications.reject');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('user')->group(function () {

    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/jobs', [UserJobController::class, 'index'])->name('user.jobs');

    Route::post('/apply/{job}', [ApplicationController::class, 'store'])->name('apply.job');

    Route::get('/applications', [UserController::class, 'applications'])->name('user.applications');

    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::post('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');

    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.change.password');
});

require __DIR__.'/auth.php';
