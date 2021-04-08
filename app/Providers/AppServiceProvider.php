<?php

namespace App\Providers;

use App\EnvX\Event\EventInfo;
use App\Rules\Safe;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EventInfo::class, function (): EventInfo {
            return EventInfo::consume(config('envx.event'));
        });

        $this->app->rebinding('request', static function (Application $app, Request $request): void {
            $request->setTrustedHosts([$request->getHost()]);
        });
    }

    public function boot(): void
    {
        Validator::extend('safe', Safe::class);
    }
}
