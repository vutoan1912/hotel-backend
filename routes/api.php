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
    return $request->user();
});

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');

Route::post('upload', 'Upload\UploadController@upload');

//About
Route::post('about', 'Hotel\AboutController@data');
Route::get('about', 'Hotel\AboutController@get');

//Room
Route::get('room', 'Hotel\RoomController@get');
Route::get('room-detail', 'Hotel\RoomController@getById');
Route::post('room', 'Hotel\RoomController@create');

//News
Route::get('news', 'Hotel\NewsController@get');
Route::get('news-detail', 'Hotel\NewsController@getById');
Route::post('news', 'Hotel\NewsController@create');
