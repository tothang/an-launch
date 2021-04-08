<?php

namespace Tests\Unit\Concerns;

use App\Token;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Util\CreatesTestModel;

class HasTokensTest extends TestCase
{
    use RefreshDatabase, CreatesTestModel;

    /** @test */
    public function generates_the_given_token_type(): void
    {
        $model = $this->bootTestModel();
        $model->generateToken(Token::TYPE_AUTH);

        self::assertEquals(1, $model->tokens->count());
    }

    /** @test */
    public function retrieves_the_given_token_type_for_the_inheritor_or_returns_null(): void
    {
        $model = $this->bootTestModel();

        self::assertNull($model->getToken(Token::TYPE_AUTH));

        $model->generateToken(Token::TYPE_AUTH);

        self::assertInstanceOf(Token::class, $model->fresh()->getToken(Token::TYPE_AUTH));
    }

    /** @test */
    public function deletes_all_inheritors_tokens_of_a_given_type(): void
    {
        $model = $this->bootTestModel();

        $model->generateToken(Token::TYPE_AUTH);
        $model->generateToken('AnotherTokenType');

        self::assertEquals(2, $model->tokens->count());

        $model->purge('AnotherTokenType');

        self::assertEquals(1, $model->fresh()->tokens->count());
        self::assertEquals(Token::TYPE_AUTH, $model->fresh()->tokens->first()->type);
    }

    /** @test */
    public function handles_dynamic_calls_to_valid_token_types(): void
    {
        $model = $this->bootTestModel();

        self::assertEquals(0, Token::count());

        $model->generateTokenAuth();

        self::assertEquals(1, Token::count());
    }
}
