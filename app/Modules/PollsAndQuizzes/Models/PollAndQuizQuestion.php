<?php

namespace App\Modules\PollsAndQuizzes\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Rutorika\Sortable\SortableTrait;

class PollAndQuizQuestion extends Model
{
    use SoftDeletes,
        SortableTrait;

    protected $fillable = [
        'position',
        'poll_and_quiz_id',
        'title',
        'active',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(PollAndQuiz::class, 'poll_and_quiz_id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(PollAndQuizResponse::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(PollAndQuizAnswer::class);
    }

    public function scopeQuizzes(Builder $query): Builder
    {
        return $query->whereHas('quiz', function ($quiz) {
            $quiz->where('type', PollAndQuiz::TYPE_QUIZ);
        });
    }

    public function scopeUnanswered(Builder $query)
    {
        return $query->whereDoesntHave('responses', function ($query) {
            return $query->where('user_id', Auth::user()->id);
        });
    }

    public function correctAnswer(): self
    {
        return $this->answers()->correct()->get();
    }

    public function multipleAnswers(): bool
    {
        return $this->answers()->where('correct', 1)->count() > 1;
    }

    public function scopeActiveAndUnanswered(Builder $query, int $userId): Builder
    {
        return $query->where('active', 1)->whereDoesntHave('responses', function ($response) use ($userId) {
            $response->where('user_id', $userId);
        });
    }

    public function percentage()
    {
        $responses = $this->responses;
        $answers = $this->answers;
        $totalVotes = $responses->count() ?: 10;

        return $answers->map(function ($answer) use ($responses, $totalVotes) {
            // TODO - Default Value

            $responseCount = $responses->where('poll_and_quiz_answer_id', $answer->id)->count();

            return ($responseCount/$totalVotes)*100;
        })->values();
    }

    public function correctResponses(): int
    {
        return $this->responses->reduce(function ($carry, $response) {
            return $carry + $response->answer->correct;
        }, 0);
    }

    public function incorrectResponses(): int
    {
        return $this->responses->reduce(function ($carry, $response) {
            return $carry + !$response->answer->correct;
        }, 0);
    }
}
