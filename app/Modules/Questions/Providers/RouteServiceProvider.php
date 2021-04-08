<?php

namespace App\Modules\Questions\Providers;

use App\Modules\Questions\Models\Question;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Modules\Questions\Http\Controllers';

    public function boot(): void
    {
        parent::boot();

        Route::bind('question', function($question){
           return Question::find($question);
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
            require module_path('questions', 'Routes/web.php');
        });
    }

    protected function mapApiRoutes(): void
    {
        Route::group([
            'middleware' => ['api', 'auth:api'],
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require module_path('questions', 'Routes/api.php');
        });
    }
}
