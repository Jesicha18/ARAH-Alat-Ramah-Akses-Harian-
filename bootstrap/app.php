<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // Tambahkan ini agar routes/api.php terbaca
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
        ->withMiddleware(function (Middleware $middleware) {
            $middleware->validateCsrfTokens(except: [
                'api/*' // Ini bakal matiin CSRF untuk semua URL yang depannya /api/
            ]);
        })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
