<?php

namespace App\Modules\Experience\Models;

use App\EnvX\Concerns\HasConstants;
use Illuminate\Database\Eloquent\Model;

class ExperienceContent extends Model
{
    use HasConstants;

    public const TYPE_LOBBY = 'Lobby';
    public const TYPE_BREAKOUT = 'Breakout';

    protected $fillable = [
        'ref',
        'type',
        'name',
        'body',
    ];
}
