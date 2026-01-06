<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // 1. Added Import
use Illuminate\Support\Facades\Auth; // 2. Added Import

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Your existing Admin Alias
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);

        // 3. ADDED: Redirect Logic for "Already Logged In" users
        // This breaks the loop when visiting the login page while logged in.
        $middleware->redirectUsersTo(function (Request $request) {
            $user = Auth::user();

            if ($user && $user->role === 'admin') {
                return route('admin.dashboard');
            }

            // Default for regular users
            return route('user.dashboard');
        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
