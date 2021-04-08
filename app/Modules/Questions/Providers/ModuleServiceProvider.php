<?php

namespace App\Modules\Questions\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'questions');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'questions');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'questions');
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ComposerServiceProvider::class);
    }
}
