<?php

namespace App\EnvX\Concerns;

use App\Token;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

trait HasTokens
{
    public static function bootHasTokens(): void
    {
        static::deleting(static function (Model $model) {
            $model->tokens()->delete();
        });
    }

    public function tokens(): MorphMany
    {
        return $this->morphMany(Token::class, 'tokenable');
    }

    public function purge(string $type): void
    {
        $this->tokens()->whereType($type)->delete();
    }

    public function generateToken(string $type = Token::TYPE_AUTH): string
    {
        $this->purge($type);

        return $this->tokens()->create([
            'type' => $type,
            'token' => Token::generate(),
            'expires_at' => Token::expiryFor($type),
        ])->token;
    }

    public function getToken(string $type = Token::TYPE_AUTH): ?Model
    {
        return $this->tokens->firstWhere('type', $type);
    }

    public function __call($name, $arguments)
    {
        $type = Str::after($name, 'Token');
        $method = Str::before($name, $type);

        if (in_array($type = strtoupper(Str::kebab($type)), Token::types(), true)) {
            return $this->$method($type);
        }

        return parent::__call($name, $arguments);
    }
}
