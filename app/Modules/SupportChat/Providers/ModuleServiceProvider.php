<?php

namespace App\Modules\SupportChat\Providers;

use App\Modules\SupportChat\Models\SupportChat;
use Caffeinated\Modules\Support\ServiceProvider;
use Illuminate\Support\Facades\View as SupportView;
use Illuminate\View\View;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(module_path('support-chat', 'Resources/Lang', 'app'), 'support-chat');
        $this->loadViewsFrom(module_path('support-chat', 'Resources/Views', 'app'), 'support-chat');
        $this->loadMigrationsFrom(module_path('support-chat', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('support-chat', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('support-chat', 'Database/Factories', 'app'));

        SupportView::composer(['layouts.*', 'experience::layouts.app'], function (View $view) {
            $supportChat = SupportChat::where('brand', config('app.brand'))->first();

            $view->with('supportChat', $supportChat ?: new SupportChat());
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
