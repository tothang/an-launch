<?php

namespace App;

use App\EnvX\Concerns\Emailable;
use App\EnvX\Concerns\HasTokens;
use \Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    public const ADFS_GROUP_DEVELOPERS = 'SG - Developers';

    public const ROLE_ROOT = 'root';
    public const ROLE_BASIC = 'basic';

    use Emailable,
        HasRoles,
        HasTokens;

    protected $fillable = [
        'forename',
        'surname',
        'email',
        'password',
        'setup_complete',
        'session_id',
        'adfs_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'setup_complete' => 'boolean',
    ];

    public function getNameAttribute(): string
    {
        return "{$this->forename} {$this->surname}";
    }

    public function isRoot(): bool
    {
        return $this->hasRole('root');
    }
}
