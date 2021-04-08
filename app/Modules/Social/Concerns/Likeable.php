<?php

namespace App\Modules\Social\Concerns;

use App\Modules\Social\Models\Like;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Likeable
{
    public static function bootLikeable(): void
    {
        static::deleted(static function (Model $model) {
            return $model->likes()->delete();
        });
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function likeCount(): int
    {
        return $this->likes()->count();
    }

    public function likedBy(User $user): bool
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
