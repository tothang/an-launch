<?php

namespace App\Modules\Social\Models;

use App\Modules\Social\Concerns\Likeable;
use App\Modules\Social\Concerns\Pinnable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumTopic extends Model
{
    use Likeable, Pinnable;

    protected $guarded = ['id'];

    public const PUSHER_RELATIONS = [
        'likes',
        'likes.user',
    ];

    public const API_RELATIONS = [
        'likes',
        'likes.user',
        'threads',
        'threads.comments',
        'threads.comments.user',
        'threads.likes',
        'threads.user'
    ];

    public function threads(): HasMany
    {
        return $this->hasMany(ForumThread::class);
    }

    public function withLastPost(): ?string
    {
        return $this->threads()->exists()
            ? $this->lastPost = $this->threads->last()->created_at->format('F j Y, g:ia')
            : null;
    }

    private function defaultApiFields(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'comment_count' => $this->getCommentCount(),
            'likes' => $this->likes->pluck('user_id'),
        ];
    }

    public function forApi(): array
    {
        return array_merge($this->defaultApiFields(), [
            'threads' => $this->threads->map->forApi(),
        ]);
    }

    public function forPusher(): array
    {
        return $this->defaultApiFields();
    }

    public function getCommentCount(): int
    {
        return array_sum($this->threads->map->commentCount()->toArray());
    }
}
