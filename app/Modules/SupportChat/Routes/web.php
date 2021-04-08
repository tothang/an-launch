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
    'middleware' => 'auth:admin',
    'namespace' => 'Admin',
    'prefix' => 'admin',
], function(){
    Route::resource('support-chat', 'SupportChatController')
        ->middleware('hasSupportChat')
        ->names('admin.support-chat');

    Route::get('support-chat/{support_chat}/edit', 'SupportChatController@edit')
        ->name('admin.support-chat.edit');
    Route::patch('support-chat/{support_chat}/edit', 'SupportChatController@update')
        ->name('admin.support-chat.update');
});
