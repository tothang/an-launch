<?php

namespace Tests\Util;

use App\EnvX\Concerns\Emailable;
use App\EnvX\Concerns\HasConstants;
use App\EnvX\Concerns\HasTokens;
use App\EnvX\Concerns\Segmentable;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    public const A = 'a';
    public const B = 'b';
    public const PREFIXED_A = 'a';
    public const PREFIXED_B = 'b';

    use Emailable,
        HasConstants,
        HasTokens,
        Segmentable;

    protected $table = 'test';

    protected $guarded = [];
}
