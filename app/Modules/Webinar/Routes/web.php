<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('teaser', [
    'uses' => 'TeaserController@index',
    'as' => 'teaser.index'
])->middleware(['verified_user_by_token']);

Route::get('holding/download-calendar', [
    'uses' => 'HoldingController@download_calendar',
    'as' => 'holding.download-calendar',
]);

Route::group([
    'middleware' => [
        'auth',
        'check_confirmation_language'
    ],
], static function () {
    Route::get('onboarding', [
        'uses' => 'OnboardingController@index',
        'as' => 'onboarding.index',
        'middleware' => [
            'seen_onboard',
            'streamNotLive'
        ]
    ]);

    Route::post('onboarding', [
        'uses' => 'OnboardingController@update',
        'as' => 'onboarding.update',
    ]);

    Route::get('holding', [
        'uses' => 'HoldingController',
        'as' => 'holding',
        'middleware' => [
            'onboarding',
            'streamLive',
            'check_registered',
        ]
    ]);

    Route::get('contact', [
        'uses' => 'ContactController@index',
        'as' => 'contact.index',
    ]);

    Route::get('faq', [
        'uses' => 'FaqController@index',
        'as' => 'faq.index',
    ]);

    Route::get('broadcast/{code?}', [
        'uses' => 'WebinarController',
        'as' => 'webinar',
        'middleware' => [
            'onboarding',
            'streamNotLive'
        ]
    ]);
});

require 'admin.php';
require 'standalone.php';
