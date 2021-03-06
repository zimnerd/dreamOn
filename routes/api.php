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
Route::get('/', function () {
   return response()->json(['status' => 'ok'], 200);
});
Route::post('login', ['as' => 'login', 'uses' => 'API\UserController@login']);
Route::post('forgot', 'API\UserController@forgot');
Route::post('reset', 'PasswordResetController@reset');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'API\UserController@user');
    Route::post('logout', 'API\UserController@logout');
    Route::post('dream/create', 'API\DreamController@create');
    Route::post('comment/create', 'API\CommentController@create');
    Route::post('comment/like', 'API\LikeController@commentlike');
    Route::post('reply/create', 'API\CommentController@createReply');
    Route::post('dream/like', 'API\LikeController@dreamlike');
    Route::post('dream/read', 'API\ReadController@create');
    Route::post('profile/create', 'API\ProfileController@create');
    Route::get('profile/list', 'API\ProfileController@list');
    Route::post('profile/update/{id}', 'API\ProfileController@update');
    Route::get('dream/list', 'API\DreamController@list');
    Route::get('dream_category/list', 'API\DreamCategoryController@list');
    Route::get('system_status/listbyarea/{area}', 'API\SystemStatusController@listbyarea');
    Route::get('system_status/list', 'API\SystemStatusController@list');
    Route::get('dream/show/{id}', 'API\DreamController@show');
    Route::post('dream/update/{id}', 'API\DreamController@update');
    Route::post('dream/delete/{id}', 'API\DreamController@delete');
    Route::post('quote/create', 'API\QuoteController@create');
    Route::get('quote/show/{id}', 'API\QuoteController@show');
    Route::get('quote/randquote', 'API\QuoteController@randquote');
    Route::get('quote/list', 'API\QuoteController@list');
});
Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});
