<?php

namespace App\Modules\Agenda\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(module_path('agenda', 'Resources/Lang', 'app'), 'agenda');
        $this->loadViewsFrom(module_path('agenda', 'Resources/Views', 'app'), 'agenda');
        $this->loadMigrationsFrom(module_path('agenda', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('agenda', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('agenda', 'Database/Factories', 'app'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
