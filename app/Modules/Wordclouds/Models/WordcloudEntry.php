<?php

namespace App\Modules\Wordclouds\Models;

use Illuminate\Database\Eloquent\Model;

class WordcloudEntry extends Model
{
    protected $fillable = [
        'wordcloud_id',
        'word',
        'count',
        'status',
    ];

    public function wordcloud()
    {
        return $this->belongsTo(Wordcloud::class);
    }

    public function registration()
    {
        return $this->belongsTo(BaseDelegateRegistration::class, 'registration_id');
    }

    public function userEntries()
    {
        return $this->hasMany(UserWordcloudEntry::class);
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeWaiting($query)
    {
        return $query->where('status', 'waiting');
    }
}
