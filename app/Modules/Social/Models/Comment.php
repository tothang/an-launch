<?php

namespace App\Modules\Social\Models;

use App\Modules\Social\Concerns\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use BelongsToUser;

    protected $guarded = ['id'];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function forApi(): array
    {
        return [
            'id' => $this->id,
            'comment' => $this->body,
            'user' => $this->user->name,
        ];
    }
}
