<?php

namespace App\Modules\Social\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(module_path('social', 'Resources/Lang', 'app'), 'social');
        $this->loadViewsFrom(module_path('social', 'Resources/Views', 'app'), 'social');
        $this->loadMigrationsFrom(module_path('social', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('social', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('social', 'Database/Factories', 'app'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
