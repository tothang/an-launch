<?php

namespace App\Modules\PollsAndQuizzes\Models;

use App\Modules\Webinar\Models\Stream;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rutorika\Sortable\SortableTrait;

class PollAndQuiz extends Model
{
    use SoftDeletes,
        SortableTrait;

    public const TYPE_POLL = 'Poll';
    public const TYPE_QUIZ = 'Quiz';

    public static $types = [
        self::TYPE_POLL,
        self::TYPE_QUIZ,
    ];

    protected $table = 'polls_and_quizzes';

    protected $fillable = [
        'position',
        'stream_id',
        'type',
        'name',
        'description',
        'active',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(PollAndQuizQuestion::class);
    }

    public function answers(): HasManyThrough
    {
        return $this->hasManyThrough(PollAndQuizAnswer::class, PollAndQuizQuestion::class);
    }

    public function responses(): HasManyThrough
    {
        return $this->hasManyThrough(PollAndQuizResponse::class, PollAndQuizQuestion::class);
    }

    public function stream(): BelongsTo
    {
        return $this->belongsTo(Stream::class);
    }

    public function scopePolls($query): Builder
    {
        return $query->where('type', self::TYPE_POLL);
    }

    public function scopeQuizzes($query): Builder
    {
        return $query->where('type', self::TYPE_QUIZ);
    }

    public function scopeActive($query): Builder
    {
        return $query->where('active', 1);
    }

    public function setQuestionsInactive(): string
    {
        return $this->questions->map(function ($question) {
            $question->active = 0;
            $question->save();
        });
    }

    public function scopeAnswered(Builder $query): Builder
    {
        return $query->has('responses');
    }

    public function active(): bool
    {
        return $this->questions->reduce(function ($carry, $question) {
            return $carry ? $carry : $question->active;
        }, false);
    }
}
