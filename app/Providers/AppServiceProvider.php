<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Pastikan log diarahkan ke folder /tmp jika berjalan di Vercel
        if (env('LOG_CHANNEL') === 'stderr' || isset($_ENV['NOW_REGION'])) {
            $this->app->useStoragePath('/tmp/storage');
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
