<?php

namespace App\Modules\Speakers\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'speakers');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'speakers');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'speakers');
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
