<?php

namespace App\Modules\Speakers\Providers;

use App\Modules\Speakers\Models\Speaker;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Modules\Speakers\Http\Controllers';

    public function boot(): void
    {
        parent::boot();

        Route::bind('speaker', function($speaker){
           return Speaker::withTrashed()->find($speaker);
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
            require module_path('speakers', 'Routes/web.php');
        });
    }

    protected function mapApiRoutes(): void
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require module_path('speakers', 'Routes/api.php');
        });
    }
}
