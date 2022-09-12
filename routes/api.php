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
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@socialLogin');
//    Route::get('social-auth/{provider}/callback', [\App\Http\Controllers\API\Auth\LoginController::class, 'providerCallback']);
//    Route::get('social-auth/{provider}', [\App\Http\Controllers\API\Auth\LoginController::class, 'redirectToProvider'])->name('social.redirect');
//    Route::post('register', 'RegisterController@register');
});
Route::get('get-letters', 'API@getLetters');
Route::get('get-sub-letters/{letterId?}', 'API@getSubLetters');
Route::get('get-words/{letterId?}', 'API@getWords');
Route::get('questions/{letterId?}', 'API@getQuestions');
