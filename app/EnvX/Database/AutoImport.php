<?php

namespace App\EnvX\Database;

use Illuminate\Support\Collection;

class AutoImport extends AutoSeed
{
    public function execute(): Collection
    {
        $this->init();

        $this->collectRows()->each(function (array $rowData): void {
            $actioned = $this->model::{$this->method}(
                ...$this->buildMethodParams($this->cleanFields($rowData))
            );

            if ($actioned !== null) {
                $this->actioned->push($actioned);

                if ($this->actionedCallback) {
                    call_user_func($this->actionedCallback, $actioned, $rowData);
                }
            }

        });

        return $this->actioned;
    }

    protected function cleanFields(&$rowData): array
    {
        if (isset($rowData['email'])) {
            $rowData['email'] = strtolower(trim(str_replace(',', '.', $rowData['email'])));
        }

        return $rowData;
    }
}
