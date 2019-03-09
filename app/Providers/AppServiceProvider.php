<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        // $this->registerBladeComponents();
    }

    /**
     * Register Blade components.
     *
     * @return void
     */
    protected function registerBladeComponents()
    {
        Blade::component('components.alert', 'alert');
        Blade::component('components.errors', 'errors');
        Blade::component('components.modal', 'modal');
    }
}
