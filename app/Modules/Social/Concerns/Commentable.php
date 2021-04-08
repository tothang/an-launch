<?php

namespace App\Modules\Social\Concerns;

use App\Modules\Social\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Commentable
{
    public static function bootCommentable(): void
    {
        static::deleted(static function (Model $model) {
            return $model->comments()->delete();
        });
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function commentCount(): int
    {
        return $this->comments()->count();
    }
}
