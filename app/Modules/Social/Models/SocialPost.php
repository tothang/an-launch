<?php

namespace App\Modules\Social\Models;

use App\Modules\Social\Concerns\BelongsToUser;
use App\Modules\Social\Concerns\Commentable;
use App\Modules\Social\Concerns\Likeable;
use App\Modules\Social\Concerns\Pinnable;
use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    use Commentable, Likeable, Pinnable, BelongsToUser;

    protected $guarded = ['id'];

    public const API_RELATIONS = [
        'user',
        'likes',
        'likes.user',
        'comments',
        'comments.user'
    ];

    public function withPosted(): string
    {
        return $this->posted = $this->created_at->format('F j Y, g:ia');
    }

    private function defaultApiFields(): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'image' => $this->image,
            'likes' => $this->likes->pluck('user_id'),
            'user' => optional($this->user)->name,
        ];
    }

    public function forApi(): array
    {
        return array_merge($this->defaultApiFields(), [
            'comments' => $this->comments->map->forApi()->all(),
        ]);
    }

    public function forPusher(?Comment $comment): array
    {
        if ($comment === null) {
            return $this->defaultApiFields();
        }

        return $this->forPusherWithComment($comment);
    }

    private function forPusherWithComment(Comment $comment): array
    {
        return array_merge($this->defaultApiFields(), [
            'comments' => [
                $comment->forApi(),
            ],
        ]);
    }
}
