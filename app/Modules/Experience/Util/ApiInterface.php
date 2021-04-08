<?php

namespace App\Modules\Experience\Util;

use App\User;
use Illuminate\Support\Collection;

interface ApiInterface
{
    public function __construct(User $user, ?string $type);

    public function get();

    public function getAllData();

    public function getDataForUser();

    public function getUserSegmentRelation(): Collection;

    public function typeIsArray(): bool;
}
