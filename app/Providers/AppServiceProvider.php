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
        if (config('app.env') === 'production') {
        if (!is_dir('/tmp/storage/framework/views')) {
            mkdir('/tmp/storage/framework/views', 0755, true);
        }
    }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
        config(['view.compiled' => '/tmp/storage/framework/views']);
    }
    }
}
