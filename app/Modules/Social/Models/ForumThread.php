<?php

namespace App\Modules\Social\Models;

use App\Modules\Social\Concerns\BelongsToUser;
use App\Modules\Social\Concerns\Commentable;
use App\Modules\Social\Concerns\Likeable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumThread extends Model
{
    use Commentable, Likeable, BelongsToUser;

    protected $guarded = ['id'];

    public const API_RELATIONS = [
        'comments',
        'comments.user',
        'likes',
        'user'
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(ForumTopic::class, 'forum_topic_id');
    }

    private function defaultApiFields(): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'user' => $this->user->name,
            'posted' => $this->created_at->format('F j Y, g:ia'),
            'likes' => $this->likes->pluck('user_id'),
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
