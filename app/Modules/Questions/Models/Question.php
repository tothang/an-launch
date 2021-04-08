<?php

namespace App\Modules\Questions\Models;

use App\Modules\Webinar\Models\Stream;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'stream_id',
        'from',
        'to',
        'question',
        'read',
        'on_screen',
        'status',
        'hidden',
    ];

    protected $casts = [
        'read' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(QuestionLikes::class);
    }

    public function stream(): BelongsTo
    {
        return $this->belongsTo(Stream::class);
    }

    public function getItemForLiveChat(): self
    {
        $this->like_count = $this->likes()->count();

        return $this;
    }

    public function scopeWaiting($query)
    {
        return $query->where('status', 'waiting');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeNotRejected($query)
    {
        return $query->where('status', '!=', 'rejected');
    }

    public function scopeHidden($query)
    {
        return $query->where('hidden', 1);
    }

    public function scopeNotHidden($query)
    {
        return $query->where('hidden', 0);
    }

    public function scopeRead($query)
    {
        return $query->where('read', 1);
    }

    public function scopeUnread($query)
    {
        return $query->where('read', 0);
    }

    public function scopeBySpeaker($query, $speaker)
    {
        return $query->where('to', $speaker);
    }

    public function scopeBySpeakers(Builder $query, array $speakers): Builder
    {
        return $query->whereIn('to', $speakers);
    }

    public function scopeForModeration(Builder $query, ?array $speakers = []): Builder
    {
        if ($this->shouldQuerySpeakers($speakers)) {
            $query = $query->bySpeakers($speakers);
        }

        return $query->waiting();
    }

    public function scopeForFacilitation(Builder $query, ?array $speakers = []): Builder
    {
        if ($this->shouldQuerySpeakers($speakers)) {
            $query = $query->bySpeakers($speakers);
        }

        return $query->notHidden()->accepted();
    }

    private function shouldQuerySpeakers(?array $speakers = []): bool
    {
        return $speakers && in_array('All', $speakers, true) === false && module_enabled('speakers');
    }

    public static function getForLiveChat(int $userId): Collection
    {
        return static::accepted()
            ->get([
                'id',
                'stream_id',
                'from',
                'question',
            ])
            ->map(static function (Question $question) use ($userId) {
                $question->like_count = $question->likes()->count();
                $question->liked = $question->likes()->byUser($userId)->exists();

                return $question;
            })
            ->sortByDesc('like_count')
            ->values();
    }
}
