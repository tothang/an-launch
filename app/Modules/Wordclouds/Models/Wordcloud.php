<?php

namespace App\Modules\Wordclouds\Models;

use App\Modules\Webinar\Models\Stream;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wordcloud extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'position',
        'question',
        'action',
        'active',
        'character_limit',
    ];

    public function entries()
    {
        return $this->hasMany(WordcloudEntry::class);
    }

    public function userEntries()
    {
        return $this->hasManyThrough(UserWordcloudEntry::class, WordcloudEntry::class);
    }

    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeActiveAndUnanswered(Builder $query, int $userId): Builder
    {
        return $query->where('active', 1)->whereDoesntHave('userEntries', function ($query) use ($userId) {
            $query->where('registration_id', $userId);
        });
    }

    public function createEntry(array $data): Model
    {
        $currentEntries = $this->entries()->where('word', $data)->first();

        if ($currentEntries === null) {
            $currentEntries = $this->entries()->create($data);
        } else {
            $currentEntries->increment('count');
        }

        return $currentEntries;
    }

    public function getWordString()
    {
        $records = $this->entries()->get();

        return $records->each(function ($record) {
            if ($record->count > 6) {
                // Adjust this to change max count for screen
                $record->count = $record->count / 4 + 5;
            }
            return $record->count . ' ' . $record->word;
        });
    }
}
