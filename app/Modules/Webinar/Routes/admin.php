<?php

Route::group([
    'middleware' => ['auth:admin', 'setup'],
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], static function () {
    /**
     * Streams
     */
    Route::get('select-stream/{route?}', [
        'uses' => 'StreamController@index',
        'as' => 'streams.index',
    ]);
    Route::resource('streams', 'StreamController')
        ->only(['edit', 'update', 'show', 'create', 'store', 'destroy']);

    /**
     * User Engagement
     */
    Route::get('engagement', [
        'uses' => 'EngagementController@index',
        'as' => 'engagement',
    ]);
    Route::get('engagement/{stream}', [
        'uses' => 'EngagementController@show',
        'as' => 'engagement.show',
    ]);
    Route::get('engagement-data/{stream}', [
        'uses' => 'Datatable\EngagementController',
        'as' => 'engagement.datatable',
    ]);
});
