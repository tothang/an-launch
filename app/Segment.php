<?php

namespace App;

use App\Modules\Agenda\Models\AgendaItem;
use App\Modules\BreakoutRooms\Models\Breakout;
use App\Modules\Notifications\Models\Notification;
use App\Modules\Webinar\Models\Stream;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Segment extends Model
{
    public const TYPE_DEFAULT = 'ALL';

    protected $fillable = [
        'name'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function streams(): MorphToMany
    {
        return $this->morphedByMany(Stream::class, 'segmentable');
    }

    public function agendaItems(): MorphToMany
    {
        return $this->morphedByMany(AgendaItem::class, 'segmentable');
    }

    public function notifications(): MorphToMany
    {
        return $this->morphedByMany(Notification::class, 'segmentable');
    }

    public function breakouts(): MorphToMany
    {
        return $this->morphedByMany(Breakout::class, 'segmentable');
    }
}
