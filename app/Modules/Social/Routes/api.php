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
], function () {
    Route::get('forum/{forum_topic}', 'ForumController@index');
    Route::post('forum/{forum_topic}', 'ForumController@store');

    Route::get('feed', 'FeedController@index');
    Route::post('feed', 'FeedController@store');

    /**
     * Poly relation creation
     */
    Route::get('like/{likeable_type}/{likeable_id}', 'ToggleLikeController')->name('like');
    Route::post('comment/{commentable_type}/{commentable_id}', 'StoreCommentController');
});
