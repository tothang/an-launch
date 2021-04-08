<?php

namespace App\Modules\Notifications\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(module_path('notifications', 'Resources/Lang', 'app'), 'notifications');
        $this->loadViewsFrom(module_path('notifications', 'Resources/Views', 'app'), 'notifications');
        $this->loadMigrationsFrom(module_path('notifications', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('notifications', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('notifications', 'Database/Factories', 'app'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
