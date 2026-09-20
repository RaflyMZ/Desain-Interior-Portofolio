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
        // 💡 Di Laravel 11, biarkan metode register ini kosong atau bersihkan dari kode require jembatan Vercel
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
