<?php

namespace App\Providers;

use App\Providers\Virtual\BroadcastServiceProvider;
use App\Providers\Virtual\ExperienceServiceProvider;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    private $providers = [
        'broadcast' => BroadcastServiceProvider::class,
        'experience' => ExperienceServiceProvider::class,
    ];

    public function register(): void
    {
        $this->app->register(
            $this->providers[config('envx.product-type')]
        );
    }
}
