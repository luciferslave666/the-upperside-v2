<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

        // --- PERBAIKAN DI SINI ---
        // Tambahkan logika redirect berdasarkan role
        RedirectIfAuthenticated::redirectUsing(function ($request) {
            $user = $request->user();

            if ($user) {
                if ($user->role == 'admin') {
                    return route('admin.dashboard');
                } else if ($user->role == 'karyawan') {
                    return route('pos.index');
                }
            }

            // Fallback (seharusnya tidak terpakai, tapi aman)
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();