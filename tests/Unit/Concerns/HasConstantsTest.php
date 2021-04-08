<?php

namespace Tests\Unit\Concerns;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Util\CreatesTestModel;
use Tests\Util\InteractsWithNonPublicMembers;
use Tests\Util\TestModel;

class HasConstantsTest extends TestCase
{
    use RefreshDatabase, CreatesTestModel, InteractsWithNonPublicMembers;

    /** @test */
    public function collects_the_inheritors_constants(): void
    {
        $expecting = collect([
            'A' => 'a',
            'B' => 'b',
            'PREFIXED_A' => 'a',
            'PREFIXED_B' => 'b',
            'CREATED_AT' => 'created_at',
            'UPDATED_AT' => 'updated_at',
        ]);

        self::assertEquals(
            $expecting,
            $this->callNonPublicMethod($this->bootTestModel(), 'constants')
        );
    }

    /** @test */
    public function returns_an_array_of_the_classes_constants_that_match_a_given_prefix(): void
    {
        $expecting = [
            'a' => 'a',
            'b' => 'b',
        ];

        self::assertEquals($expecting, TestModel::constByPrefix('PREFIXED_'));
    }
}
