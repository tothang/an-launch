<?php

namespace App\Modules\Wordclouds\Models;

use App\DelX\DelegateRegistration\BaseDelegateRegistration;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserWordcloudEntry extends Model
{
    protected $fillable = [
        'registration_id',
        'wordcloud_entry_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registration()
    {
        return $this->belongsTo(BaseDelegateRegistration::class, 'registration_id');
    }

    public function wordcloudEntry()
    {
        return $this->belongsTo(WordcloudEntry::class);
    }
}
