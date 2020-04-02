<?php

namespace Twobitint\TMDB;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tmdb.php', 'tmdb');

        $this->app->bind(API::class, function ($app) {
            return new API($app['config']['tmdb']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/tmdb.php' => config_path('tmdb.php'),
        ]);

        Collection::macro('setPage', function ($page) {
            $this->page = $page;
            return $this;
        });
        Collection::macro('setTotalResults', function ($results) {
            $this->totalResults = $results;
            return $this;
        });
        Collection::macro('setTotalPages', function ($pages) {
            $this->totalPages = $pages;
            return $this;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [API::class];
    }
}
