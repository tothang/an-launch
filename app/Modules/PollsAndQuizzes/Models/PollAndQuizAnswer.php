<?php

namespace App\Modules\PollsAndQuizzes\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rutorika\Sortable\SortableTrait;

class PollAndQuizAnswer extends Model
{
    use SoftDeletes,
        SortableTrait;

    protected $table = 'poll_and_quiz_answers';

    protected $fillable = [
        'position',
        'poll_and_quiz_question_id',
        'value',
        'correct',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(PollAndQuizQuestion::class, 'poll_and_quiz_question_id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(PollAndQuizResponse::class);
    }

    public function scopeCorrect(Builder $query): Builder
    {
        return $query->where('correct', 1);
    }
}
