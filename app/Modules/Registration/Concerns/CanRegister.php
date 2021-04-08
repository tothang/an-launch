<?php

namespace App\Modules\Registration\Concerns;

use App\Modules\Registration\Models\UserRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait CanRegister
{
    public static function bootCanRegister(): void
    {
        static::deleting(static function (Model $model) {
            $model->registration()->delete();
        });
    }

    public function registration(): HasOne
    {
        return $this->hasOne(UserRegistration::class);
    }

    public function getRegistrationAttribute(): Model
    {
        return $this->registration()->firstOrCreate(
            ['user_id' => $this->id],
            UserRegistration::inheritableFields($this)
        );
    }

    public function isRegistered(): bool
    {
        return $this->registration->isRegistered();
    }

    public function isAttending(): bool
    {
        return $this->registration->attending ?? 0;
    }

    public function registrationStatus(): string
    {
        return $this->registration->status;
    }

    public function statusHtmlClass(): string
    {
        return $this->isRegistered() ? 'success' : 'danger';
    }

    public function scopeRegistered(Builder $query): Builder
    {
        return $query->whereHas('registration', static function (Builder $query): Builder {
            return $query->whereStatus(UserRegistration::STATUS_FULLY_REGISTERED);
        });
    }

    public function scopeNotRegistered(Builder $query): Builder
    {
        return $query->doesntHave('registration')
            ->orWhereHas('registration', static function (Builder $query): Builder {
                return $query->where('status', '!=', UserRegistration::STATUS_FULLY_REGISTERED);
            });
    }
}
