<?php

namespace App\Modules\PollsAndQuizzes\Concerns;

use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Modules\PollsAndQuizzes\Models\PollAndQuizResponse;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

trait HasQuizResults
{
    public function pollAndQuizResponses(): HasMany
    {
        return $this->hasMany(PollAndQuizResponse::class);
    }

    public function quizScore(): int
    {
        return $this->pollAndQuizResponses->reduce(function($carry, $response) {
            return $carry + $response->answer->correct;
        }, 0);
    }

    public static function leaderboardResults(Stream $stream): Collection
    {
        return self::with(['pollAndQuizResponses' => function ($query) use ($stream) {
            $query->whereHas('question.quiz', function ($query) use ($stream) {
                $query->where('stream_id', $stream->id);
            })->get();
        }])
            ->get()
            ->sortByDesc(function($user) use ($stream) {
                return $user->quizScore();
            });
    }
}
