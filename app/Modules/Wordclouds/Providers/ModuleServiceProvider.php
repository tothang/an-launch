<?php

namespace App\Modules\Wordclouds\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'wordclouds');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'wordclouds');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'wordclouds');
        $this->loadConfigsFrom(__DIR__.'/../config');
        $this->loadFactoriesFrom(__DIR__.'/../Database/Factories');
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
