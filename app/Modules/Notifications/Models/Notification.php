<?php

namespace App\Modules\Notifications\Models;

use App\EnvX\Concerns\HasConstants;
use App\EnvX\Concerns\Segmentable;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasConstants,
        Segmentable;

    public const TYPE_TEXT = 'text';
    public const TYPE_LINK = 'link';
    public const BRAND_HYSTER = 'Hyster';
    public const BRAND_YALE = 'Yale';

    protected $fillable = [
        'title',
        'body',
        'link',
        'send_at',
        'sent_at',
        'is_global',
        'type',
        'content_en',
        'content_de',
        'content_fr',
        'content_es',
        'content_it',
        'content_pl',
        'content_ru',
        'content_cs',
        'content_nl',
        'brand',
    ];

    protected $dates = [
        'send_at',
        'sent_at',
    ];

    public function isGlobal(): bool
    {
        return $this->is_global;
    }
}
