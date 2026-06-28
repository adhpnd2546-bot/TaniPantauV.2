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
        // Deteksi jika berjalan di server produksi (InfinityFree)
        if (isset($_SERVER['HTTP_HOST']) && !in_array($_SERVER['HTTP_HOST'], ['127.0.0.1', 'localhost', '127.0.0.1:8000'])) {
            $this->app->usePublicPath(base_path());
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
