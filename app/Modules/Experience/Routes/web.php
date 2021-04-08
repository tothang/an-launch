<?php

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

/**
 * Admin
 */
Route::group([
    'middleware' => 'auth:admin',
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.experience.',
], static function () {
    Route::resource('experience/content', 'ContentController');
});

/**
 * User
 */
Route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('landing', 'LandingController')->name('landing');

    Route::get('experience', 'ExperienceController')
        ->middleware('notRegistered:landing')
        ->name('experience');
});
