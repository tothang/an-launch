<?php

namespace App\EnvX\Database;

use Exception;

class CannotAutoLocatePackageModelData extends Exception
{
    public function __construct(string $model)
    {
        parent::__construct(
            "Cannot auto-locate data path for package model: '{$model}'. Implement using() method to specify a file path."
        );
    }
}
