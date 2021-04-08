<?php

namespace App\Modules\Analytics\Concerns;

use App\Modules\Analytics\Models\LoginLog;
use App\Modules\Analytics\Models\PageView;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Analyticable
{
    public function loginLogs(): HasMany
    {
        return $this->hasMany(LoginLog::class);
    }

    public function pageViews(): HasMany
    {
        return $this->hasMany(PageView::class);
    }

    public function getLastLogin(): string
    {
        if ($this->loginLogs()->count() === 0) {
            return 'n/a';
        }

        return $this->loginLogs->last()->created_at->diffForHumans();
    }
}
