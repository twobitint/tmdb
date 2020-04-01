<?php

namespace Twobitint\TMDB;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TMDBServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(API::class, function ($app) {
            return new API();
        });

        $this->mergeConfigFrom(__DIR__.'/config/tmdb.php', 'tmdb');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/tmdb.php' => config_path('tmdb.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [API::class];
    }
}
