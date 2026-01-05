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
    // Cek apakah sedang berjalan di Vercel (Production)
    if (env('APP_ENV') === 'production') {
        // Paksa folder storage ke /tmp agar bisa ditulis
        $this->app->useStoragePath('/tmp/storage');

        // Buat folder view secara paksa jika belum ada
        if (!is_dir('/tmp/storage/framework/views')) {
            mkdir('/tmp/storage/framework/views', 0755, true);
        }
    }
}
}
