<?php

/*
 * To return new views from the API add in a 'type' below
 *
 * 'Types' can simply return a view:
 * e.g. 'agenda' => 'experience::api.agenda.index'
 *
 * Or you can return a view and pass it a users segment relation:
 * e.g. 'breakout-b1' => [
 *      'view' => 'experience::api.breakouts.b1.index'
 *      'user-segment-relation' => [
 *          'breakout'
 *      ],
 *  ]
 */

return [
    'breakout-b1' => [
        'view' => 'experience::api.breakouts.b1',
        'user-segment-relation' => [
            'streams'
        ],
    ],
];
