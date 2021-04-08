<?php

namespace App\Modules\BreakoutRooms\Models;

use App\EnvX\Concerns\Segmentable;
use Illuminate\Database\Eloquent\Model;

class Breakout extends Model
{
    use Segmentable;

    protected $fillable = [
        'title',
        'description',
        'link',
    ];
}
