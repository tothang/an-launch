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

], function(){
    Route::get('ask-a-question/confirmation', [
        'uses' => 'QuestionsController@confirmation',
        'as' => 'questions.confirmation',
    ]);
    Route::resource('ask-a-question', 'QuestionsController', [
        'names' => 'questions',
    ]);
});

Route::group([
    'middleware' => 'auth:admin',
    'namespace' => 'Admin',
    'prefix' => 'admin',
], function(){
    Route::get('questions/select-stream', [
        'uses' => 'StreamSelectController',
        'as' => 'admin.questions.select-stream',
    ]);

    Route::resource('stream.questions', 'QuestionsController', [
        'names' => 'admin.questions',
    ])->shallow();

    Route::group([
        'prefix' => 'stream/{stream}'
    ], function () {
        Route::get('/questions/moderate', [
            'uses' => 'ModerationController@index',
            'as' => 'admin.questions.moderation.index',
        ]);

        Route::get('/questions/facilitate', [
            'uses' => 'FacilitationController@index',
            'as' => 'admin.questions.facilitation.index',
        ]);

        Route::resource('/questions/answers', 'AnswersController', [
            'names' => 'admin.questions.answers',
        ])->only(['index', 'create', 'store']);

        Route::post('/questions/answers/import', [
            'as' => 'admin.questions.answers.import',
            'uses' => 'AnswersController@import',
        ]);
    });

    Route::resource('questions/answers', 'AnswersController', [
        'names' => 'admin.questions.answers',
    ])->except(['index', 'create', 'store']);

    Route::patch('questions/{question}/moderate', [
        'uses' => 'ModerationController@update',
        'as' => 'admin.questions.moderation.update',
    ]);

    Route::patch('/questions/{question}/facilitate', [
        'uses' => 'FacilitationController@update',
        'as' => 'admin.questions.facilitation.update',
    ]);
});
