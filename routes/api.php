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
	Route::get('users', 'UsersController@list');
	Route::post('interlocutor/{interlocutor}/messages', 'MessagesController@store');
	Route::get('interlocutor/{interlocutor}/messages', 'MessagesController@list');
});

Route::post('user/login', 'Auth\LoginController@login');
