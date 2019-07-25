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
Route::post('users/login', 'usersController@login');


Route::middleware('auth:api')->get('/tarot', function (Request $request) {
    return $request->tarot();
});


Route::get('tarots/{id}', 'tarotController@get');
Route::get('tarots', 'tarotController@getAll');
Route::post('tarots', 'tarotController@create');
Route::put('tarots/{id}', 'tarotController@update');
Route::patch('tarots/{id}/status', 'tarotController@updateStatus');
Route::delete('tarots/{id}', 'tarotController@delete');
Route::patch('tarots/{id}/response', 'tarotController@updateResponse');


Route::get('reiki/{id}', 'reikiController@get');
Route::get('reiki', 'reikiController@getAll');
Route::post('reiki', 'reikiController@create');
Route::put('reiki/{id}', 'reikiController@update');
Route::patch('reiki/{id}/status', 'reikiController@updateStatus');
Route::delete('reiki/{id}', 'reikiController@delete');
Route::patch('reiki/{id}/response', 'reikiController@updateResponse');

Route::get('akashic/{id}', 'akashicController@get');
Route::get('akashic', 'akashicController@getAll');
Route::post('akashic', 'akashicController@create');
Route::put('akashic/{id}', 'akashicController@update');
Route::patch('akashic/{id}/status', 'akashicController@updateStatus');
Route::delete('akashic/{id}', 'akashicController@delete');
Route::patch('akashic/{id}/response', 'akashicController@updateResponse');