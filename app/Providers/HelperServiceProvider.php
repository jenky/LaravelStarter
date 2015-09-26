<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\HelperManager;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('helper', function ($app) { 
            return new HelperManager($app); 
        });

        $this->app->alias('helper', HelperManager::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['helper'];
    }
}