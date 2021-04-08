<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => 'Api',
    'prefix' => 'analytics',
    'as' => 'api.analytics.'
], function () {
    Route::post('page-view', [
        'uses' => 'StorePageViewController',
        'as' => 'page-view.store',
    ]);

    Route::post('page-view/update', [
        'uses' => 'UpdatePageViewController',
        'as' => 'page-view.update',
    ]);
});
