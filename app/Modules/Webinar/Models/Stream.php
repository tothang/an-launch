<?php

namespace App\Modules\Webinar\Models;

use App\EnvX\Concerns\Segmentable;
use App\Exports\PollsAndQuizzes;
use App\Exports\Questions;
use App\Exports\UserEngagement;
use App\Exports\Wordclouds;
use App\Modules\PollsAndQuizzes\Models\PollAndQuiz;
use App\Modules\Questions\Models\Answer;
use App\Modules\Questions\Models\Question;
use App\Modules\Wordclouds\Models\Wordcloud;
use App\Segment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

class Stream extends Model
{
    use Segmentable;

    public const TYPE_MAIN = 'MAIN';
    public const TYPE_BREAKOUT = 'BREAKOUT';

    const BRAND_HYSTER = 'hyster';
    const BRAND_YALE = 'yale';

    public const REPORTS = [
        UserEngagement::class,
        PollsAndQuizzes::class,
        Questions::class,
        Wordclouds::class
    ];

    protected $guarded = ['id'];

    protected $dates = [
        'starts_at'
    ];

    protected $casts = [
        'is_live' => 'boolean',
    ];

    public function segments(): MorphToMany
    {
        return $this->morphToMany(Segment::class, 'segmentable');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function wordclouds(): HasMany
    {
        return $this->hasMany(Wordcloud::class);
    }

    public function pollsAndQuizzes(): HasMany
    {
        return $this->hasMany(PollAndQuiz::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public static function main(): self
    {
        $brand = isHyster() ? self::BRAND_HYSTER : self::BRAND_YALE;

        $stream = self::where('type', self::TYPE_MAIN)->where('brand', $brand)->first();

        return $stream ?: new self;
    }

    public static function singular(): bool
    {
        return self::count() === 1;
    }

    public function isMain(): bool
    {
        return $this->is(self::main());
    }

    public function getTimeAttribute(): ?string
    {
        return $this->starts_at ? $this->starts_at->format('H:i:s'): null;
    }

    public static function breakoutCodes()
    {
        return static::breakouts()->distinct('code')->get()->pluck('code');
    }

    public static function upcoming(?array $segments = []): Collection
    {
        if (empty($segments)) {
            return static::live()->notStarted()->get();
        }

        return static::whereHas('segments', function ($query) use ($segments) {
            return $query->whereIn('name', $segments);
        })->live()->notStarted()->get();
    }

    public function getStateText(): string
    {
        if (WebinarEvent::streamFinished($this)) {
            return 'Finished';
        }

        return $this->is_live ? 'Live' : 'Inactive';
    }

    public function getStateColour(): string
    {
        if (WebinarEvent::streamFinished($this)) {
            return 'success';
        }

        return $this->is_live ? 'danger' : 'warning';
    }

    public function scopeLive(Builder $query): Builder
    {
        return $query->where('is_live', 1);
    }

    public function scopeNotStarted(Builder $query): Builder
    {
        return $query->where('starts_at', '>', Carbon::now())->orWhere('starts_at', null);
    }

    public function scopeBreakouts(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_BREAKOUT);
    }

    public function isLive(): bool
    {
        return $this->is_live;
    }
}
