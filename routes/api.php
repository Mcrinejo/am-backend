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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->users();
});

Route::get('healthcheck', 'defaultController@get');

Route::get('users/{id}', 'usersController@get');
Route::get('users', 'usersController@getAll');
Route::post('users', 'usersController@create');
Route::put('users/{id}', 'usersController@update');
Route::delete('users/{id}', 'usersController@delete');
Route::get('register/verify/{confirmation_code}', 'usersController@verified');