<?php

namespace App\Modules\Webinar\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'label',
        'time',
    ];
}
