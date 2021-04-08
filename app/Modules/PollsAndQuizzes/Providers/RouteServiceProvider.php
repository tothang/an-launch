<?php

namespace App\Modules\PollsAndQuizzes\Providers;

use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Modules\PollsAndQuizzes\Http\Controllers';

    public function boot(): void
    {
        parent::boot();

        Route::bind('poll_and_quiz', function ($pollAndQuiz) {
            return PollAndQuiz::withTrashed()->find($pollAndQuiz);
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
            require module_path('polls-and-quizzes', 'Routes/web.php', 'app');
        });
    }

    protected function mapApiRoutes(): void
    {
        Route::group([
            'middleware' => 'auth:api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require module_path('polls-and-quizzes', 'Routes/api.php', 'app');
        });
    }
}
