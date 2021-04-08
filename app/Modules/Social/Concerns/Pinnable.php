<?php

namespace App\Modules\Social\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Pinnable
{
    public static function bootPinnable(): void
    {
        static::addGlobalScope('pinned', static function (Builder $builder) {
            $builder->orderByDesc('pinned')->orderByDesc('pinned_at');
        });
    }

    public function setPinnedAttribute($value)
    {
        $this->attributes['pinned'] = $value;
        $this->attributes['pinned_at'] = $value ? now() : null;
    }
}
