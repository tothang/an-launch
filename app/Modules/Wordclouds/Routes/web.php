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

Route::group([
    'middleware' => 'auth:admin',
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function(){
    Route::get('wordclouds/select-stream', [
        'uses' => 'StreamSelectController',
        'as' => 'wordclouds.select-stream',
    ]);

    Route::patch('wordclouds/moderate/{entry}', [
        'uses' => 'ModerationController@update',
        'as' => 'wordclouds.moderation.update',
    ]);

    Route::get('wordclouds/screen/{wordcloud}', [
        'uses' => 'ShowScreenController',
        'as' => 'wordclouds.screen.show',
    ]);
    Route::resource('stream.wordclouds', 'WordcloudController', [
        'names' => 'wordclouds',
    ])->shallow();

    Route::put('wordclouds/{wordcloud}/restore', [
        'uses' => 'WordcloudController@restore',
        'as' => 'wordclouds.restore',
    ]);
    Route::resource('wordclouds.entries', 'EntryController', [
        'names' => 'wordclouds.entries',
    ]);
    Route::patch('wordclouds/{wordcloud}/activity',[
        'uses' => 'ToggleActiveController',
        'as' => 'wordclouds.activity.update',
    ]);

});
