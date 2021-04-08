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
], function () {
    Route::get('poll-and-quiz/select-stream', [
        'uses' => 'StreamSelectController',
        'as' => 'admin.poll-and-quiz.select-stream',
    ]);

    Route::get('stream/{stream}/poll-and-quiz/host', 'PollAndQuizHostController@index')->name('admin.poll-and-quiz.host');
    Route::get('stream/{stream}/poll-and-quiz/leaderboard', 'LeaderboardController@index')->name('admin.poll-and-quiz.leaderboard');

    Route::resource('stream.poll-and-quiz', 'PollAndQuizController', [
        'names' => 'admin.poll-and-quiz',
    ])->shallow();

    Route::put('poll-and-quiz/{poll_and_quiz}/restore', 'PollAndQuizController@restore')->name('admin.poll-and-quiz.restore');

    Route::resource('poll-and-quiz.poll-and-quiz-question', 'QuestionController')->names('admin.poll-and-quiz.questions');
    Route::put('poll-and-quiz/{poll_and_quiz}/poll-and-quiz-question/{id}/restore', 'QuestionController@restore')->name('admin.poll-and-quiz.questions.restore');

    Route::resource('poll-and-quiz.poll-and-quiz-question.poll-and-quiz-answer', 'AnswerController')->names('admin.poll-and-quiz.questions.answers');
    Route::resource('poll-and-quiz.poll-and-quiz-question.poll-and-quiz-responses', 'ResponseController')->names('admin.poll-and-quiz.questions.responses');

    Route::patch('poll-and-quiz/{poll_and_quiz}/poll-and-quiz-question/{poll_and_quiz_question}/active', 'ActiveController@update')->name('admin.poll-and-quiz-question.active.update');

    Route::get('poll-and-quiz/{poll_and_quiz_question}/results', 'ResultController@show')->name('admin.poll-and-quiz.results');
    Route::get('poll-and-quiz/{poll_and_quiz}/scores', 'ScoreController@show')->name('admin.poll-and-quiz.scores.show');
});
