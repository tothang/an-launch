<?php

namespace App\Modules\SupportChat\Models;

use App\EnvX\Concerns\HasConstants;
use Illuminate\Database\Eloquent\Model;

class SupportChat extends Model
{
    use HasConstants;

    public const TYPE_FRESHCHAT = 'Fresh Chat';

    protected $table = 'support_chat_config';

    protected $fillable = [
        'api_token',
        'is_active',
        'name',
        'type',
        'logo',
        'colour',
        'background_colour',
        'brand',
    ];
}
