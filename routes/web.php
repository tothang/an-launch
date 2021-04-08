<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require 'auth.php';
require 'admin.php';
require 'standalone.php';

/**
 * Entryway to product type...
 */
Route::get('/', [
    'middleware' => ['auth'],
    'uses' => 'IndexController',
    'as' => 'index',
]);

Route::group([
    'middleware' => [
        'check_confirmation_language',
    ],
], function () {
    Route::get('welcome', 'WelcomeController@index')->name('welcome');
    Route::get('agenda', 'WelcomeController@index')->name('agenda.index');
    Route::get('support', 'WelcomeController@index')->name('support.index');
    Route::get('broadcasts', 'WelcomeController@index')->name('broadcasts.index');
    Route::get('speaker', 'WelcomeController@index')->name('speaker.index');
    Route::get('on-demand', 'WelcomeController@index')->name('on_demand.index');
});

Route::get('/mail-preview', 'PreviewMailController@index')->name('mail_preview');
Route::get('sign-out', 'WelcomeController@index')->name('sign_out.index');

Route::redirect('/home', '/');

Route::get('send-mail-decline-invitation', 'TestSendMailController@sendMailDeclineInvitation')->name('send-mail.decline-invitation');
