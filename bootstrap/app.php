<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// 💡 Tambahkan blok pengunci konfigurasi mutlak untuk Vercel di sini
if (isset($_ENV['NOW_REGION']) || env('LOG_CHANNEL') === 'stderr') {
    // 1. Relokasi folder cache agar tidak read-only
    $app->useBootstrapPath('/tmp/bootstrap');

    // 2. Paksa konfigurasi disuntikkan setelah container Laravel siap
    $app->booted(function () {
        config([
            'session.driver' => 'cookie',
            'cache.default' => 'array',
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => '/tmp/database.sqlite',
            'logging.default' => 'stderr',
            'view.compiled' => '/tmp/storage/framework/views',
        ]);
    });
}

return $app;
