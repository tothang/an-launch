<?php

namespace Tests\Unit\Models;

use App\Token;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Util\InteractsWithNonPublicMembers;

class TokenTest extends TestCase
{
    use RefreshDatabase, InteractsWithNonPublicMembers;

    /** @test */
    public function provides_an_array_of_available_types(): void
    {
        self::assertIsArray(Token::types());
        self::assertContains(Token::TYPE_AUTH, Token::types());
    }

    /** @test */
    public function can_be_generated(): void
    {
        $token = Token::generate();

        self::assertIsString($token);
        self::assertEquals(strlen($token), Token::$length);
    }

    /** @test */
    public function provides_the_expiry_in_days_for_a_given_token(): void
    {
        Carbon::setTestNow('2020-01-01');

        $expiries = $this->getNonPublicProperty((new Token), 'expiries');

        self::assertEquals(
            now()->addDays($expiries[Token::TYPE_AUTH]),
            Token::expiryFor(Token::TYPE_AUTH)
        );
    }

    /** @test */
    public function returns_null_when_a_token_does_not_have_an_expiry(): void
    {
        self::assertNull(Token::expiryFor('not-a-type'));
    }

    /** @test */
    public function retrieves_an_active_record_by_its_token(): void
    {
        $token = factory(Token::class)->create(['token' => 'find-by-this']);

        $fetched = Token::fetch('find-by-this');

        self::assertEquals($token->id, $fetched->id);
    }

    /** @test */
    public function returns_null_if_the_token_attempting_to_be_fetched_does_not_exist_or_has_expired(): void
    {
        $expired = factory(Token::class)->create(['expires_at' => now()]);
        $doesNotExist = 'not-a-token';

        self::assertNull(Token::fetch($expired));
        self::assertNull(Token::fetch($doesNotExist));
    }

    /** @test */
    public function scopes_to_include_active_tokens_only(): void
    {
        $active = factory(Token::class)->create();
        $permanent = factory(Token::class)->state('permanent')->create();
        factory(Token::class)->state('expired')->create();

        self::assertEquals(3, Token::count());

        $tokens = Token::active()->get();
        self::assertCount(2, $tokens);
        self::assertEquals($active->id, $tokens->first()->id);
        self::assertEquals($permanent->id, $tokens->last()->id);
    }

    /** @test */
    public function scopes_to_include_expired_tokens_only(): void
    {
        $expired = factory(Token::class)->state('expired')->create();
        factory(Token::class)->state('permanent')->create();
        factory(Token::class)->create();

        self::assertEquals(3, Token::count());

        $tokens = Token::expired()->get();
        self::assertCount(1, $tokens);
        self::assertEquals($expired->id, $tokens->first()->id);
    }
}
