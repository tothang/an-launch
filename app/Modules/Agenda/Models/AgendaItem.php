<?php

namespace App\Modules\Agenda\Models;

use App\EnvX\Concerns\Segmentable;
use Illuminate\Database\Eloquent\Model;

class AgendaItem extends Model
{
    use Segmentable;

    protected $table = 'agenda';

    protected $fillable = [
        'datetime',
        'title',
        'description',
    ];

    protected $dates = [
        'datetime',
    ];

    public function getDateAttribute(): string
    {
        return $this->datetime->toDateString();
    }

    public function getTimeAttribute(): string
    {
        return $this->datetime->format('H:i');
    }
}
