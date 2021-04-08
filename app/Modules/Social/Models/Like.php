<?php

namespace App\Modules\Social\Models;

use App\Modules\Social\Concerns\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    use BelongsToUser;

    protected $guarded = ['id'];

    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }
}
