<?php

namespace App\Modules\BreakoutRooms\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(module_path('breakout-rooms', 'Resources/Lang', 'app'), 'breakout-rooms');
        $this->loadViewsFrom(module_path('breakout-rooms', 'Resources/Views', 'app'), 'breakout-rooms');
        $this->loadMigrationsFrom(module_path('breakout-rooms', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('breakout-rooms', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('breakout-rooms', 'Database/Factories', 'app'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
