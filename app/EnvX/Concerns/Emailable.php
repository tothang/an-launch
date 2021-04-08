<?php

namespace App\EnvX\Concerns;

use App\Admin;
use App\EmailLog;
use App\EnvX\Email\Mailer;
use App\Mail\PasswordReset;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Emailable
{
    public static function bootEmailable(): void
    {
        static::deleting(static function (Model $model) {
            $model->emailLogs()->delete();
        });
    }

    public function emailLogs(): MorphMany
    {
        return $this->morphMany(EmailLog::class, 'emailable');
    }

    public function sendPasswordResetNotification($token): void
    {
        app(Mailer::class)->send($this, PasswordReset::class, [$token]);
    }

    public function recentlyEmailed(): bool
    {
        return $this->emailLogs()
            ->whereBetween('created_at', [now()->subDay(), now()])
            ->exists();
    }

    public function scopeInvited(Builder $query): Builder
    {
        return self::withEmail(class_basename(config('envx.emails.invite-yale')));
    }

    public function scopeWithEmail(Builder $query, string $email): Builder
    {
        return $query->whereHas('emailLogs', static function (Builder $query) use ($email) {
            return $query->where('type', $email);
        });
    }

    public function scopeWithoutEmail(Builder $query, string $email): Builder
    {
        return $query->whereDoesntHave('emailLogs', static function (Builder $query) use ($email) {
            return $query->where('type', $email);
        });
    }
}
