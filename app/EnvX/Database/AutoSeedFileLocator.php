<?php

namespace App\EnvX\Database;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AutoSeedFileLocator
{
    private $model;

    public function __construct(string $model)
    {
        $this->model = $model;
    }

    public static function for(string $model): string
    {
        return (new static($model))->guessPath();
    }

    public function guessPath(): string
    {
        $modelBasename = class_basename($this->model);

        if (Str::before($this->model, '\\') !== 'App') {
            throw new CannotAutoLocatePackageModelData($modelBasename);
        }

        if (File::exists($filePath = $this->buildFilePath($modelBasename)) === false) {
            throw new CannotLocateModelDataFile($modelBasename);
        }

        return $filePath ?? $this->buildFilePath($modelBasename);
    }

    private function buildFilePath(string $modelBasename): string
    {
        return lcfirst($this->buildDirPath($this->model) . self::fileNameFor($modelBasename));
    }

    private function buildDirPath(string $modelNamespace): string
    {
        if (Str::contains($modelNamespace, 'Module')) {
            $databaseDir = 'Database';
        }

        return Str::beforeLast(
                str_replace('\\', '/', $modelNamespace),
                class_basename($this->model)
            ) . '../' . ($databaseDir ?? 'database') . '/data/';
    }

    public static function fileNameFor(string $model): string
    {
        return Str::snake(Str::plural(lcfirst(class_basename($model)))) . '.csv';
    }
}
