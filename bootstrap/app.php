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

// 💡 TAMBAHKAN BLOK KODE INI TEPAT DI BAWAH VARIABEL $app SEBELUM return
if (isset($_ENV['NOW_REGION']) || env('LOG_CHANNEL') === 'stderr') {
    $app->useBootstrapPath('/tmp/bootstrap');
    
    // Paksa Laravel mengompilasi file Blade ke dalam folder /tmp yang writeable
    config(['view.compiled' => '/tmp/storage/framework/views']);
}

return $app;
