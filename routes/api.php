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
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
//    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
//    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
//    Route::post('password/reset', 'ResetPasswordController@reset');
});

//Route::group(['middleware' => 'auth:sanctum'], function () {
//    Route::post('update_token', 'Auth\LoginController@updateToken');
//
//});