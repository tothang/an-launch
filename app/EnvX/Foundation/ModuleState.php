<?php

namespace App\EnvX\Foundation;

use Caffeinated\Modules\Facades\Module;

class ModuleState
{
    private $modules;

    private $forceEnableAll;

    public function __construct(array $moduleSlugs, bool $forceEnableAll)
    {
        $this->modules = $moduleSlugs;
        $this->forceEnableAll = $forceEnableAll;
    }

    public function checkEnabled(string $moduleSlug): bool
    {
        if ($this->forceEnableAll) {
            return true;
        }

        return in_array($moduleSlug, $this->modules, false);
    }

    public function getEnabled(): array
    {
        if ($this->forceEnableAll) {
            return Module::slugs()->all();
        }

        return $this->modules;
    }
}
