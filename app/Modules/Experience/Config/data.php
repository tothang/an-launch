<?php

use App\Modules\Agenda\Models\AgendaItem;
use App\Modules\Webinar\Models\Stream;

/*
 * To return new data from the API add in a 'type' below
 *
 * 'Types' can simply return a model:
 * e.g. 'agenda' => AgendaItem::class
 *
 * Or they can return a model with a scope:
 * e.g. 'breakouts' => [
 *      'model' => Stream::class,
 *      'scope' => 'breakouts'
 *  ]
 */

return [
    'breakouts' => [
        'model' => Stream::class,
        'scope' => 'breakouts'
    ],
    'agenda' => AgendaItem::class,
];
