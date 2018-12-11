<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth'])->group(function () {
	Route::get('user', 'Auth\LoginController@getAuthenticatedUser');
	Route::get('users-with-messages', 'ChatController@usersWithMessages');
	Route::patch('online', 'ChatController@onlineUpdate');
	Route::post('interlocutor/{interlocutor}/messages', 'MessagesController@store');
	Route::patch('interlocutor/{interlocutor}/messages/read', 'MessagesController@read');
});

Route::post('user/login', 'Auth\LoginController@login');

Route::get('date-ranges', 'DateRangesController@list');
Route::post('date-ranges', 'DateRangesController@store');
