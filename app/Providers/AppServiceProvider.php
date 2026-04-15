<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// IMPORT THE USER MODEL AND OBSERVER HERE
use App\Models\User;
use App\Observers\UserObserver;

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
        // ATTACH THE OBSERVER TO THE USER MODEL
        User::observe(UserObserver::class);
    }
}