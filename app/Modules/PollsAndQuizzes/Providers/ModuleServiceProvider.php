<?php

namespace App\Modules\PollsAndQuizzes\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(module_path('polls-and-quizzes', 'Resources/Lang', 'app'), 'polls-and-quizzes');
        $this->loadViewsFrom(module_path('polls-and-quizzes', 'Resources/Views', 'app'), 'polls-and-quizzes');
        $this->loadMigrationsFrom(module_path('polls-and-quizzes', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('polls-and-quizzes', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('polls-and-quizzes', 'Database/Factories', 'app'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
