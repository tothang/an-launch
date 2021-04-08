<?php

namespace Tests\Unit\Auth\Handlers;

use App\EnvX\Auth\Handlers\Handler;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use ReflectionClass;
use Tests\Util\InteractsWithNonPublicMembers;

trait HandlesAuthContractTests
{
    use InteractsWithNonPublicMembers;

    public function attemptLoginWithPassword(Handler $handler, string $password, Authenticatable $user): void
    {
        $handler->setRequest(request()->merge(['email' => $user->email, 'password' => $password]))
            ->attemptLogin($user);
    }

    public function shouldCreateConsideringPassword(Handler $handler, string $password): bool
    {
        return $handler->setRequest(request()->merge(['password' => $password]))
            ->shouldCreate();
    }

    /** @test */
    public function sets_its_request_when_required(): void
    {
        $handler = $this->authHandler()->setRequest(request());

        self::assertSame(request(), $this->getNonPublicProperty($handler, 'request'));
    }

    /** @test */
    public function defines_login_validation_rules(): void
    {
        $handler = $this->authHandler();

        $expected = ['email' => 'required|email:filter|safe'];
        $expectedIfPassword = ['password' => 'required'];
        $expectedIfRecaptcha = ['g-recaptcha-response' => 'required|captcha'];

        if ($handler->requiresPassword()) {
            $expected = array_merge($expected, $expectedIfPassword);
        }

        self::assertSame($expected, $handler->rules());

        config()->set('envx.recaptcha', true);
        $expected = array_merge($expected, $expectedIfRecaptcha);

        self::assertSame($expected, $handler->rules());
    }

    /** @test */
    public function returns_new_user_from_creator(): void
    {
        $handler = $this->authHandler()->setRequest(
            request()->merge([
                'email' => 'user@example.com',
            ])
        );

        self::assertInstanceOf(User::class, $handler->create());
    }
}
