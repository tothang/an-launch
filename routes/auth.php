<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * User
 */
Auth::routes(['register' => false]);

Route::get('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

/**
 * Password creation
 */
Route::group([
    'middleware' => ['auth:web,admin', 'setupComplete'],
    'namespace' => 'Auth',
], static function () {
    Route::get('create-password', [
        'uses' => 'CreatePasswordController@show',
        'as' => 'create-password.show',
    ]);
    Route::post('create-password', [
        'uses' => 'CreatePasswordController@store',
        'as' => 'create-password.store',
    ]);
});

Route::group([
    'namespace' => 'Auth',
], static function () {
    Route::get('set-password', [
        'uses' => 'SetPasswordController@show',
        'as' => 'set-password.show',
    ]);
    Route::post('set-password', [
        'uses' => 'SetPasswordController@store',
        'as' => 'set-password.store',
    ]);
});


Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('confirmation-language', 'ConfirmationLanguageController@index')->name('confirmation-language');
    Route::post('confirmation-language', 'ConfirmationLanguageController@store')->name('store-confirmation-language');
});
