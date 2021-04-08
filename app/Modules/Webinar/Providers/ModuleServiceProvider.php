<?php

namespace App\Modules\Webinar\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'webinar');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'webinar');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'webinar');
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
