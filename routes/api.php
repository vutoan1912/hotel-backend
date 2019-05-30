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
Route::post('authenticate', 'Auth\LoginController@authenticate');
Route::post('register', 'Auth\RegisterController@register');

//Upload
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

//Slide
Route::post('slide', 'Upload\UploadSlideController@upload');
Route::post('slide-set-status', 'Hotel\SlideController@set');
Route::get('slide', 'Hotel\SlideController@get');
