<?php

namespace Tests\Unit\Rules;

use App\Rules\Safe;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class SafeTest extends TestCase
{
    /** @test */
    public function passes_if_only_safe_strings_present(): void
    {
        self::assertTrue(Validator::make(['name' => 'Test'], ['name' => 'safe'])->passes());

        self::assertContains('=cmd', Safe::SEARCH);
        self::assertFalse(Validator::make(['name' => 'Test =cmd'], ['name' => 'safe'])->passes());
    }
}
