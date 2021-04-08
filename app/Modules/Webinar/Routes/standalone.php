<?php

// Download calendar ics for event
Route::get('calender', [
    'uses' => 'CalendarController',
    'as' => 'calendar',
]);
