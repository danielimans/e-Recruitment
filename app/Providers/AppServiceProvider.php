<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            View::composer('partials.sidebar-admin', function ($view) {

            if (Auth::check() && Auth::user()->role === 'admin') {

                $pendingApplicationsCount = Application::where('status', 'Pending')->count();

                $view->with('pendingApplicationsCount', $pendingApplicationsCount);
            }
        });
    }
}
