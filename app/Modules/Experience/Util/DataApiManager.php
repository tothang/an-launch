<?php

namespace App\Modules\Experience\Util;

use App\Modules\Agenda\Models\AgendaItem;
use App\Modules\Experience\Exceptions\TypeNotFoundException;
use App\User;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Support\Collection;

class DataApiManager implements ApiInterface
{
    /*
     * To return new data from the API add in a 'type' in Experience/Config/data.php
     *
     * 'Types' can simply return a model:
     * e.g. 'agenda' => AgendaItem::class
     *
     * Or they can return a model with a scope:
     * e.g. 'breakouts' => [
     *      'model' => Stream::class,
     *      'scope' => 'breakouts'
     *  ]
     */
    public $types;
    private $user;
    private $type;
    private $model;

    public function __construct(User $user, ?string $type)
    {
        $this->types = config('data', 'experience');
        $this->user = $user;
        $this->type = $type;
        $this->model = $this->types[$this->type] ?? null;
    }

    public function get(): Collection
    {
        if ($this->type === null) {
            return $this->getAllData();
        }

        if ($this->model === null) {
            throw new TypeNotFoundException($this->types);
        }

        return $this->getDataForUser();
    }

    public function getAllData(): Collection
    {
        return collect($this->types)->mapWithKeys(static function ($model, $type) {

            if (is_array($model)) {
                return [$type => app($model['model'])->{$model['scope']}()->get()];
            }

            return [$type => app($model)];
        });
    }

    public function getDataForUser(): Collection
    {
        return $this->getUserSegmentRelation();
    }

    public function getUserSegmentRelation(): Collection
    {
        $relation = $this->user->segments()->first()->{$this->getTableName()}();

        if ($this->getScope() !== null) {
            $relation = $relation->{$this->getScope()}();
        }

        return $relation->get();
    }

    private function getTableName(): string
    {
        if ($this->typeIsArray()) {
            return app($this->model['model'])->getTable();
        }

        return app($this->model)->getTable();
    }

    private function getScope(): ?string
    {
        if ($this->typeIsArray()) {
            return $this->model['scope'];
        }

        return null;
    }

    public function typeIsArray(): bool
    {
        return is_array($this->model);
    }
}
