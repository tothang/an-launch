<?php

namespace App\Modules\Registration\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class UserRegistration extends Model
{
    public const STATUS_NOT_REGISTERED   = 'Not Registered';
    public const STATUS_FULLY_REGISTERED = 'Fully Registered';

    protected $fillable = [
        'status',
        'forename',
        'surname',
        'email',
        'attending',
        'reason_not_attending',
        'registered_at',
    ];

    protected $dontDisplay = [
        'status',
        'registered_at',
    ];

    protected $dates = [
        'registered_at',
    ];

    protected $casts = [
        'attending' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function inheritableFields(Model $model): array
    {
        return [
            'forename' => $model->forename,
            'surname' => $model->surname,
            'email' => $model->email,
        ];
    }

    public function register(array $additionalFields = []): self
    {
        return tap($this)
            ->update(array_merge(
                [
                    'status' => static::STATUS_FULLY_REGISTERED,
                    'registered_at' => now(),
                ],
                $additionalFields
            ));
    }

    public function reset(): void
    {
        $this->update([
            'status' => self::STATUS_NOT_REGISTERED,
            'attending' => false,
            'registered_at' => null,
        ]);
    }

    public function isRegistered(): bool
    {
        return $this->status === self::STATUS_FULLY_REGISTERED;
    }

    public function summary(): Collection
    {
        return $this->mapForSummary(
            collect(array_diff($this->fillable, $this->dontDisplay))
        );
    }

    protected function mapForSummary(Collection $fields): Collection
    {
        return $fields->flip()
            ->map(function ($value, $key) {
                if (in_array($key, array_keys($this->getCasts(), 'boolean'), false)) {
                    return (bool) $this->{$key} ? 'Yes' : 'No';
                }

                ucwords(str_replace(['_', '-'], ' ', $key));

                return $this->{$key};
            })->filter();
    }

    public function scopeRegistered(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_FULLY_REGISTERED);
    }

    public function scopeAttending(Builder $query): Builder
    {
        return $query->registered()->where('attending', true);
    }

    public function scopeNotAttending(Builder $query): Builder
    {
        return $query->registered()->where('attending', false);
    }
}
