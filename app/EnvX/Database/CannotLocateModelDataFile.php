<?php

namespace App\EnvX\Database;

use Exception;

class CannotLocateModelDataFile extends Exception
{
    public function __construct(string $model)
    {
        parent::__construct(
            "Cannot auto-locate data path for model: '{$model}'. Filename expected: "
            . AutoSeedFileLocator::fileNameFor($model)
        );
    }
}
