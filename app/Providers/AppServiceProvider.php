<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Application;

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
            $pendingApplicationsCount = Application::where('status', 'Pending')->count();
            $view->with('pendingApplicationsCount', $pendingApplicationsCount);
        });
    }
}
