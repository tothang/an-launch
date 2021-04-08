<?php

namespace App\Modules\Analytics\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class PageView extends Model
{
    protected $fillable = [
        'user_id',
        'url',
        'time_spent',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function countByUrl(): Collection
    {
        return self::selectRaw('url, count(*) as page_views, sum(time_spent)/60 as time_spent')
            ->groupBy('url')
            ->orderByDesc('page_views')
            ->get();
    }
}
