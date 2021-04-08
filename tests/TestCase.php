<?php

namespace Tests;

use App\Providers\ProductServiceProvider;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setProductType(string $type): void
    {
        config()->set('envx.product-type', $type);

        $this->app->register(ProductServiceProvider::class, true);
    }
}
