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

Route::group([
    'middleware' => [
        'auth',
        'registered'
    ]
], static function () {
    Route::get('register', [
        'uses' => 'RegistrationController@index',
        'as' => 'registration.index',
    ]);

    Route::post('register/{registration}', [
        'uses' => 'RegistrationController@update',
        'as' => 'registration.update',
    ]);

});

Route::get('declined-invitation', [
    'uses' => 'RegistrationController@declineInvitation',
    'as' => 'registration.declineInvitation',
]);

Route::post('declined-invitation', [
    'uses' => 'RegistrationController@postDeclineInvitation',
    'as' => 'registration.postDeclineInvitation',
]);

Route::get('confirmation', [
    'uses' => 'ConfirmationController',
    'as' => 'registration.confirmation',
    'middleware' => 'notRegistered',
]);

Route::group([
    'middleware' => 'auth:admin',
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.',
], static function () {
    Route::resource('registrations', 'RegistrationController')->except('show', 'edit');

    Route::get('registrations/{user}/edit', [
        'uses' => 'RegistrationController@edit',
        'as' => 'registrations.edit',
    ]);
});
