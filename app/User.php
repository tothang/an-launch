<?php

namespace App;

use App\EnvX\Concerns\Emailable;
use App\EnvX\Concerns\HasTokens;
use App\Modules\Analytics\Concerns\Analyticable;
use App\Modules\PollsAndQuizzes\Concerns\HasQuizResults;
use App\Modules\Registration\Concerns\CanRegister;
use App\Modules\Webinar\Http\Traits\InteractsWithWebinar;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,
        InteractsWithWebinar,
        Analyticable,
        CanRegister,
        HasQuizResults,
        Emailable,
        HasTokens;

    public const FIRST_LOGIN = 1;
    public const DID_LOGIN = 0;
    public const STATUS_NEW = 'new';
    public const STATUS_INVITED = 'invited';
    public const STATUS_PASSWORD_CREATED = 'password_created';
    public const STATUS_REGISTERED = 'registered';
    public const STATUS_DECLINED = 'declined';
    public const STATUSES = [
        self::STATUS_NEW => 'New',
        self::STATUS_INVITED => 'Invited',
        self::STATUS_PASSWORD_CREATED => 'Password created',
        self::STATUS_REGISTERED => 'Registered',
        self::STATUS_DECLINED => 'Declined',
    ];

    public const BRAND_HYSTER = 'Hyster';
    public const BRAND_YALE = 'Yale';
    public const BRANDS = [
        self::BRAND_HYSTER => 'Hyster',
        self::BRAND_YALE => 'Yale'
    ];

    public const TITLE_MR = 'Mr';
    public const TITLE_MRS = 'Mrs';
    public const TITLE_MISS = 'Miss';
    public const TITLES = [
        self::TITLE_MR => 'Mr',
        self::TITLE_MRS => 'Mrs',
        self::TITLE_MISS => 'Miss',
    ];

    public const ROLE_DEALER = 'Dealer';
    public const ROLE_EMPLOYEE = 'Employee';
    public const ROLES = [
        self::ROLE_DEALER => 'Dealer',
        self::ROLE_EMPLOYEE => 'Employee'
    ];

    public const LANGUAGE_ENGLISH = 'English';
    public const LANGUAGE_GERMAN = 'German';
    public const LANGUAGE_FRENCH = 'French';
    public const LANGUAGE_SPANISH = 'Spanish';
    public const LANGUAGE_ITALIAN = 'Italian';
    public const LANGUAGE_RUSSIAN = 'Russian';
    public const LANGUAGE_POLISH = 'Polish';
    public const LANGUAGE_CZECH = 'Czech';
    public const LANGUAGE_DUTCH = 'Dutch';
    public const LANGUAGES = [
        self::LANGUAGE_ENGLISH => 'English',
        self::LANGUAGE_GERMAN => 'German',
        self::LANGUAGE_FRENCH => 'French',
        self::LANGUAGE_SPANISH => 'Spanish',
        self::LANGUAGE_ITALIAN => 'Italian',
        self::LANGUAGE_POLISH => 'Polish',
        self::LANGUAGE_RUSSIAN => 'Russian',
        self::LANGUAGE_CZECH => 'Czech',
        self::LANGUAGE_DUTCH => 'Dutch',
    ];

    public const LOCALE_MAPPING = [
        self::LANGUAGE_ENGLISH => 'en',
        self::LANGUAGE_GERMAN => 'de',
        self::LANGUAGE_FRENCH => 'fr',
        self::LANGUAGE_SPANISH => 'es',
        self::LANGUAGE_ITALIAN => 'it',
        self::LANGUAGE_POLISH => 'pl',
        self::LANGUAGE_RUSSIAN => 'ru',
        self::LANGUAGE_CZECH => 'cs',
        self::LANGUAGE_DUTCH => 'nl',
    ];

    public const LOCALE_TO_LANGUAGE = [
        'en' => self::LANGUAGE_ENGLISH,
        'de' => self::LANGUAGE_GERMAN,
        'fr' => self::LANGUAGE_FRENCH,
        'es' => self::LANGUAGE_SPANISH,
        'it' => self::LANGUAGE_ITALIAN,
        'pl' => self::LANGUAGE_POLISH,
        'ru' => self::LANGUAGE_RUSSIAN,
        'cs' => self::LANGUAGE_CZECH,
        'nl' => self::LANGUAGE_DUTCH,
    ];

    public const SEEN_ONBOARDING = 1;

    protected $fillable = [
        'forename',
        'surname',
        'email',
        'password',
        'setup_complete',
        'api_token',
        'seen_onboarding',
        'session_id',
        'title',
        'role',
        'dealership_name',
        'employee_function',
        'brand',
        'breakout_group',
        'status',
        'declined_reason',
        'language',
        'country_office_location',
        'region',
        'city',
        'first_login'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'setup_complete' => 'boolean',
    ];

    public function segments(): BelongsToMany
    {
        return $this->belongsToMany(Segment::class);
    }

    public function getNameAttribute(): string
    {
        return "{$this->forename} {$this->surname}";
    }

    public function isEmployee(): bool
    {
        return $this->role === self::ROLE_EMPLOYEE;
    }

    public function isFirstLogin(): bool
    {
        return $this->first_login === self::FIRST_LOGIN;
    }

    public function isRegisteredEvent(): bool
    {
        return $this->status === self::STATUS_REGISTERED;
    }

    public function seenOnBoarding(): bool
    {
        return $this->seen_onboarding === self::SEEN_ONBOARDING;
    }

    public function getStatusStringify(): string
    {
        return self::STATUSES[$this->status] ?? '';
    }

    public function getBrandStringify(): string
    {
        return $this->brand ?? '';
    }

    public function getRoleStringify(): string
    {
        return $this->role ?? '';
    }

    public function getLanguageStringify(): string
    {
        return $this->language ?? '';
    }

    public function getTitleStringify(): string
    {
        return $this->title ?? '';
    }

    public function getDealerShipNameOrEmployeeFunction(): ?string
    {
        return $this->isEmployee() ? $this->employee_function : $this->dealership_name;
    }

    public function getLocaleAttribute()
    {
        return self::LOCALE_MAPPING[$this->language] ?? 'en';
    }

    /**
     * @param string $type
     * @return string
     */
    public function generateAuthToken(string $type = Token::TYPE_AUTH): string
    {
        $token = tap($this)
            ->update(['needs_reset' => 1])
            ->generateTokenAuth();

        return $token;
    }

    public function scopeBrandHyster($query) {
        return $query->where('brand', self::BRAND_HYSTER);
    }

    public function scopeBrandYale($query) {
        return $query->where('brand', self::BRAND_YALE);
    }

    public function scopeNew($query) {
        return $query->where('status', self::STATUS_NEW);
    }

    public function isRegistered(): bool
    {
        return $this->status === self::STATUS_REGISTERED;
    }

    public function isPasswordCreated()
    {
        return $this->status === self::STATUS_PASSWORD_CREATED;
    }

    public function isDeclined()
    {
        return $this->status === self::STATUS_DECLINED;
    }

    public static function getLocaleMapping (string $language)
    {
        return self::LOCALE_MAPPING[$language];
    }
}
