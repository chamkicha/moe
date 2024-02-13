<?php

namespace App\Providers;
use App\Observers\ApplicationObserver;
use App\Models\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Application::observe(ApplicationObserver::class);
    }
}
