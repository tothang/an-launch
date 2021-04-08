<?php

namespace App\EnvX\Database;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use League\Csv\Reader;

class AutoSeed extends Seeder
{
    protected const METHOD_CREATE = 'create';
    protected const METHOD_FIRST_WHERE = 'firstWhere';
    protected const METHOD_FIRST_OR_CREATE = 'firstOrCreate';
    protected const METHOD_UPDATE_OR_CREATE = 'updateOrCreate';

    protected $model;

    private $possibleFields;

    protected $method;

    private $findBy = '';

    private $pathToData;

    private $headers;

    protected $actioned;

    protected $actionedCallback;

    private $overrides;

    public function updateOrCreate(string $model, string $findBy, ?callable $overrides = null): self
    {
        $this->model = $model;
        $this->findBy = $findBy;
        $this->method = self::METHOD_UPDATE_OR_CREATE;
        $this->overrides = $overrides;

        return $this;
    }

    public function skipOrCreate(string $model, string $findBy, ?callable $overrides = null): self
    {
        $this->model = $model;
        $this->findBy = $findBy;
        $this->method = self::METHOD_FIRST_OR_CREATE;
        $this->overrides = $overrides;

        return $this;
    }

    public function performEach(string $model, string $findBy, callable $action): self
    {
        $this->model = $model;
        $this->findBy = $findBy;
        $this->method = self::METHOD_FIRST_WHERE;
        $this->actionedCallback = $action;

        return $this;
    }

    public function refresh(string $model, ?callable $overrides = null): self
    {
        $this->model = $model;
        $this->method = self::METHOD_CREATE;
        $this->overrides = $overrides;

        $model::truncate();

        return $this;
    }

    public function using(string $pathToData): self
    {
        $this->pathToData = $pathToData;

        return $this;
    }

    public function then(callable $callback): self
    {
        $this->actionedCallback = $callback;

        return $this;
    }

    protected function init(): void
    {
        $this->actioned = collect();
        $this->possibleFields = Schema::getColumnListing((new $this->model)->getTable());
    }

    protected function execute(): Collection
    {
        $this->init();

        $output = tap($this->command->getOutput())->progressStart();

        $this->collectRows()->each(function (array $rowData) use ($output): void {
            $this->actioned->push(
                $actioned = $this->model::{$this->method}(...$this->buildMethodParams($rowData))
            );

            if ($this->actionedCallback) {
                call_user_func($this->actionedCallback, $actioned, $rowData);
            }

            $output->progressAdvance();
        });

        $output->progressFinish();

        return $this->actioned;
    }

    protected function collectRows(): Collection
    {
        $file = Reader::createFromPath(
            $this->pathToData ?? AutoSeedFileLocator::for($this->model)
        );

        $this->headers = collect($file->fetchOne());

        return collect($file->setHeaderOffset(0)->getRecords());
    }

    protected function locator(array $rowData): array
    {
        return [$this->findBy => $rowData[$this->findBy]];
    }

    protected function buildMethodParams(array $rowData): array
    {
        $params = [
            $this->buildFieldValueArray($rowData)
        ];

        if ($this->method !== self::METHOD_CREATE) {
            array_unshift($params, $this->locator($rowData));
        }

        if ($this->method === self::METHOD_FIRST_WHERE) {
            return $this->buildWhere($rowData);
        }

        return $params;
    }

    protected function buildFieldValueArray(array $rowData): array
    {
        return array_merge(
            $this->autoMapFields($rowData),
            $this->overrides ? call_user_func($this->overrides, $rowData) : []
        );
    }

    private function autoMapFields(array $rowData): array
    {
        $fields = [];

        $this->headers
            ->filter(function (string $header): bool {
                return $this->headerExistsOnModel($header);
            })
            ->each(static function ($header) use (&$fields, $rowData): void {
                $fields[$header] = $rowData[$header] === 'NULL' ? null : $rowData[$header];
            });

        return $fields;
    }

    private function headerExistsOnModel(string $header): bool
    {
        return in_array($header, $this->possibleFields, false);
    }

    private function buildWhere(array $rowData): array
    {
        $locatorArray = $this->locator($rowData);

        return [
            array_key_first($locatorArray),
            $locatorArray[$this->findBy],
        ];
    }

    public function __destruct()
    {
        if ($this->model !== null) {
            $this->execute();
        }
    }
}
