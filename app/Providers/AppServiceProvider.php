<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // paksa https
        if (request()->header('x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }

        Vite::prefetch(concurrency: 3);
        Inertia::share([
            'translations' => [
                // 'actions' => trans('actions'),
                // 'madin' => trans('madin'),
            ],
        ]);
    }
}
