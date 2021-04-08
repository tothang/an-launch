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

Route::post('/polls-and-quizzes/', 'Api\PollAndQuizController@show');
Route::post('/polls-and-quizzes/{questionId}', 'Api\PollAndQuizController@store');
Route::post('/polls-and-quizzes-score', 'Api\PollAndQuizScoreController@show');
