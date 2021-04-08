<?php

namespace App\Modules\Social\Providers;

use App\Modules\Social\Models\ForumThread;
use App\Modules\Social\Models\ForumTopic;
use App\Modules\Social\Models\SocialPost;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Modules\Social\Http\Controllers';

    public function boot(): void
    {
        parent::boot();

        Route::model('forum_topic', ForumTopic::class);
        Route::model('forum_thread', ForumThread::class);
        Route::model('social_post', SocialPost::class);
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
            require module_path('social', 'Routes/web.php', 'app');
        });
    }

    protected function mapApiRoutes(): void
    {
        Route::group([
            'middleware' => ['auth:api', 'api'],
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require module_path('social', 'Routes/api.php', 'app');
        });
    }
}
