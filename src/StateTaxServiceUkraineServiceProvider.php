<?php

namespace Gavan4eg\StateTaxServiceUkraine;

use Illuminate\Support\ServiceProvider;

class StateTaxServiceUkraineServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/statetax.php', 'statetax');

        // Register the service the package provides.
        $this->app->singleton('statetaxserviceukraine', function ($app) {
            return new StateTaxServiceUkraine;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['statetaxserviceukraine'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {

        $this->publishes([
            __DIR__.'/../config/statetax.php' => config_path('statetax.php'),
        ], 'statetax.config');
    }
}
