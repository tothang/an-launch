<?php

namespace App\Providers\Virtual;

use Illuminate\Support\ServiceProvider;
use App\EnvX\Foundation\ModuleState;

class BaseServiceProvider extends ServiceProvider
{
    protected const GLOBAL_MODULES = [
        'webinar',
        'speakers',
        'questions',
        'polls-and-quizzes',
        'support-chat',
        'analytics',
    ];

    protected $modules = [];

    public function register(): void
    {
        $this->app->singleton(ModuleState::class, function (): ModuleState {
            return new ModuleState(
                array_merge(self::GLOBAL_MODULES, $this->modules, config('envx.additional-modules')),
                config('envx.force-enable-all-modules')
            );
        });
    }

    protected function loginRedirect(string $routeName): void
    {
        $this->app->bind('login.redirect', static function () use ($routeName): string {
            return $routeName;
        });
    }
}
