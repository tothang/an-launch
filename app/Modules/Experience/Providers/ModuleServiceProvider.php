<?php

namespace App\Modules\Experience\Providers;

use App\Config;
use Caffeinated\Modules\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(module_path('experience', 'Resources/Lang', 'app'), 'experience');
        $this->loadViewsFrom(module_path('experience', 'Resources/Views', 'app'), 'experience');
        $this->loadMigrationsFrom(module_path('experience', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('experience', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('experience', 'Database/Factories', 'app'));

        View::composer('experience::layouts.*', function ($view) {
            return $view->with('theme', Config::getFromCache('theme'))
                ->with('brand', config('app.brand'));
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
