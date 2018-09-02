<?php
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
Route::post('login',[ 'as' => 'login', 'uses' =>  'API\UserController@login']);
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'API\UserController@user');
    Route::post('logout', 'API\UserController@logout');
    Route::post('dream/create', 'API\DreamController@create');
    Route::get('dream/list', 'API\DreamController@list');
    Route::get('dream/show/{id}', 'API\DreamController@show');
    Route::post('dream/update/{id}', 'API\DreamController@update');
    Route::post('dream/delete/{id}', 'API\DreamController@delete');
    Route::post('quote/create', 'API\QuoteController@create');
    Route::get('quote/show/{id}', 'API\QuoteController@show');
});
