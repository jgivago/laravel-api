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

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});

Route::get('messages', 'MessageController@index');
Route::get('messages/show/{message}', 'MessageController@show');
Route::get('messages/showbyuser/{user}', 'MessageController@showbyuser');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('users','AuthController@users');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::get('user/destroy/{user}', 'AuthController@destroy');
        Route::post('user/update/{user}', 'AuthController@update');

        Route::post('messages/store', 'MessageController@store');
        Route::get('message/destroy/{message}', 'MessageController@destroy');
        Route::post('message/update/{message}', 'MessageController@update');
    });
});
