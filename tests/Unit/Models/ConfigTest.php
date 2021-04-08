<?php

namespace Tests\Unit\Models;

use App\Config;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Config::create([
            'key' => 'test',
            'value' => '1',
        ]);
    }

    /** @test */
    public function retrieves_the_value_of_a_given_key(): void
    {
        self::assertEquals('1', Config::getFromCache('test'));
    }

    /** @test */
    public function retrieves_the_boolean_value_of_a_given_key(): void
    {
        self::assertIsBool(Config::getBoolFromCache('test'));
        self::assertEquals(true, Config::getBoolFromCache('test'));
    }

    /** @test */
    public function returns_null_if_key_not_found(): void
    {
        self::assertNull(Config::getFromCache('not-found'));
    }

    /** @test */
    public function caches_retrieved_values(): void
    {
        $cacheKey = app_auto_prefix('test');

        self::assertFalse(cache()->has($cacheKey));

        Config::getFromCache('test');

        self::assertTrue(cache()->has($cacheKey));
    }
}
