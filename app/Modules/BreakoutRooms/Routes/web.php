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
], function() {
    Route::resource('breakouts', 'BreakoutController', [
        'names' => 'admin.breakouts',
    ])->except('show');
});
