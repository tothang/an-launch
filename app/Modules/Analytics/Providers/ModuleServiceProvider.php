<?php

namespace App\Modules\Analytics\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(module_path('analytics', 'Resources/Lang', 'app'), 'analytics');
        $this->loadViewsFrom(module_path('analytics', 'Resources/Views', 'app'), 'analytics');
        $this->loadMigrationsFrom(module_path('analytics', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('analytics', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('analytics', 'Database/Factories', 'app'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
