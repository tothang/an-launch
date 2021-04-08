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

Route::post('questions', [
    'uses' => 'Api\IndexQuestionsController',
    'as' => 'api.questions',
]);

Route::get('questions/speakers', [
    'uses' => 'Api\ShowSpeakersController',
    'as' => 'api.questions.speakers',
]);

Route::post('questions/store', [
    'uses' => 'Api\StoreQuestionController',
    'as' => 'api.questions.store',
]);

Route::post('questions/{question}/toggleLike', [
    'uses' => 'Api\ToggleLikeController',
    'as' => 'api.questions.like.toggle',
]);
