<?php

namespace App\Modules\Registration\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(module_path('registration', 'Resources/Lang', 'app'), 'registration');
        $this->loadViewsFrom(module_path('registration', 'Resources/Views', 'app'), 'registration');
        $this->loadMigrationsFrom(module_path('registration', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('registration', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('registration', 'Database/Factories', 'app'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
