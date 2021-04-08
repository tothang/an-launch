<?php

namespace App\EnvX\Concerns;

use App\Segment;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Segmentable
{
    public function segments(): MorphToMany
    {
        return $this->morphToMany(Segment::class, 'segmentable');
    }
}
