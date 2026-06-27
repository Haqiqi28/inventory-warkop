<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // TAMBAHKAN INI
        $middleware->redirectGuestsTo(fn (Request $request) => route('login'));

        $middleware->redirectUsersTo(function (Request $request) {
            $user = $request->user();

            if (! $user) {
                return null;
            }

            return $user->role === 'admin'
                ? route('dashboard.admin')
                : route('dashboard.master');
        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();