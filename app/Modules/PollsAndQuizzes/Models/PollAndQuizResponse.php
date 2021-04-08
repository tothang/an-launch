<?php

namespace App\Modules\PollsAndQuizzes\Models;

use App\Modules\Polls\Services\RedisCacheHelper;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PollAndQuizResponse extends Model
{
    use SoftDeletes;

    protected $table = 'poll_and_quiz_responses';

    protected $fillable = [
        'poll_and_quiz_answer_id',
        'poll_and_quiz_question_id',
        'user_id',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(PollAndQuizQuestion::class, 'poll_and_quiz_question_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(PollAndQuizAnswer::class, 'poll_and_quiz_answer_id');
    }

    public function scopeCorrectAnswersForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId)->whereHas('answer', function($answer) {
            $answer->where('correct', 1);
        })->distinct('poll_and_quiz_question_id');
    }
}
