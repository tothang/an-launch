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

], function(){

    Route::get('speakers', [
        'uses' => 'SpeakerController@index',
        'as' => 'speakers.index',
    ]);
    Route::get('speakers/{speaker}', [
        'uses' => 'SpeakerController@show',
        'as' => 'speakers.show',
    ]);

});

Route::group([
    'middleware' => 'auth:admin',
    'namespace' => 'Admin',
    'prefix' => 'admin',
], function () {
    Route::resource('speakers', 'SpeakerController', [
        'names' => 'admin.speakers',
    ]);
    Route::put('speakers/{speaker}/restore', [
        'uses' => 'SpeakerController@restore',
        'as' => 'admin.speakers.restore',
    ]);
});
