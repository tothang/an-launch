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
    'middleware' => 'auth',
    'prefix' => 'social',
], function () {
    /**
     * Forum
     */
    Route::resource('forum', 'ForumController')
        ->parameters(['forum' => 'forum_topic'])
        ->except('store');

    /**
     * Social feed
     */
    Route::get('feed', [
        'uses' => 'FeedController',
        'as' => 'feed.index'
    ]);
});

Route::group([
    'middleware' => 'auth:admin',
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.social.',
], static function () {
    /**
     * Forum
     */
    Route::resource('forum', 'ForumController')
        ->parameters(['forum' => 'forum_topic']);

    Route::resource('forum.thread', 'ForumThreadController')
        ->parameters([
            'forum' => 'forum_topic',
            'thread' => 'forum_thread',
        ])
        ->only('show', 'destroy');

    /**
     * Social feed
     */
    Route::resource('feed', 'FeedController')
        ->parameters(['feed' => 'social_post']);

    Route::get('feed/{social_post}/image', 'DestroyPostImageController')
        ->name('feed.destroy-image');

    /**
     * Poly management
     */
    Route::delete('comment/{comment}/destroy', [
        'uses' => 'DestroyCommentController',
        'as' => 'comment.destroy',
    ]);
});
