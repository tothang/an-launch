<?php

namespace Tests\Unit\Foundation;

use App\EnvX\Foundation\ModuleState;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ModuleCacheTest extends TestCase
{
    private function moduleState(array $modules = ['test-module-slug']): ModuleState
    {
        return (new ModuleState($modules, false));
    }

    /** @test */
    public function checks_if_a_module_is_enabled(): void
    {
        $moduleState = $this->moduleState();

        $this->assertTrue($moduleState->checkEnabled('test-module-slug'));
    }

    /** @test */
    public function retrieves_an_array_of_the_currently_cached_module_slugs(): void
    {
        $moduleState = $this->moduleState(['enabled', 'also-enabled']);

        $this->assertEquals(['enabled', 'also-enabled'], $moduleState->getEnabled());
    }
}
