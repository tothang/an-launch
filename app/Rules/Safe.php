<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class Safe implements Rule
{
    public const SEARCH = [
        '=cmd',
    ];

    public function validate($attribute, $value): bool
    {
        return $this->passes($attribute, $value);
    }

    public function passes($attribute, $value): bool
    {
        return Str::contains($value, self::SEARCH) === false;
    }

    public function message(): string
    {
        return __('validation.safe');
    }
}
