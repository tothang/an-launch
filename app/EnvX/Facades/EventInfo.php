<?php

namespace App\EnvX\Facades;

use App\EnvX\Event\EventInfo as BaseEventInfo;
use Illuminate\Support\Facades\Facade;

/**
 * @method dates(): EventDatesHandler
 * @method date(): EventDateFormatter
 * @method time(): EventTimeFormatter
 * @method emailSubjectPrefix(): string
 *
 * @see \App\EnvX\Event\EventInfo
 * @see \App\EnvX\Event\EventDatesHandler
 * @see \App\EnvX\Event\EventDateFormatter
 * @see \App\EnvX\Event\EventTimeFormatter
 */
class EventInfo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaseEventInfo::class;
    }
}
