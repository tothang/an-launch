<?php

namespace App\Providers;

use App\Config;
use App\Http\ViewComposers\AdminMenu;
use App\Http\ViewComposers\Dashboard;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.admin.partials.nav-left', AdminMenu::class);

        View::composer([
            'admin.dashboard',
            'admin.reports.dashboard',
        ], Dashboard::class);

        View::composer('webinar::admin.streams.select', function ($view) {
            return $view->with('streams', Stream::all());
        });

        View::composer('layouts.*', function ($view) {
            return $view->with('theme', config('app.brand') == 'hyster' ? 'dark' : 'light')
            ->with('brand', config('app.brand'));
        });

        View::composer('layouts.*', function($view) {
            return $view->with('stream', Stream::main());
        });
    }
}
