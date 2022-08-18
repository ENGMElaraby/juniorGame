<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], static function () {
//    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
});
Route::get('get-letters', 'API@getLetters');
Route::get('get-sub-letters/{letter?}', 'API@getSubLetters');
Route::get('get-words/{letter?}', 'API@getWords');
//Route::group(['middleware' => 'auth:sanctum'], function () {
//    Route::post('update_token', 'Auth\LoginController@updateToken');
//
//});