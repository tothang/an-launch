<?php

namespace App\Modules\Wordclouds\Providers;

use App\Modules\Wordclouds\Models\Wordcloud;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Modules\Wordclouds\Http\Controllers';

    public function boot(): void
    {
        parent::boot();

        Route::bind('wordcloud', function($wordcloud){
            return Wordcloud::withTrashed()->find($wordcloud);
        });
    }

    public function map(): void
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::group([
            'middleware' => 'web',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require module_path('wordclouds', 'Routes/web.php');
        });
    }

    protected function mapApiRoutes(): void
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require module_path('wordclouds', 'Routes/api.php', 'app');
        });
    }
}
