<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'user'], function () {
    Route::get('search', 'UserController@search')->name('user_search');
    Route::get('{user}/get-users', 'UserController@getUsers')->name('user_get_users');
});

Route::group(['prefix' => 'chat'], function () {
    Route::post('create/{user}', 'ChatController@store')->name('chat_store');
    Route::get('{chat}/get-messages', 'ChatController@getMessages')->name('chat_messages');
});

Route::group(['prefix' => 'message'], function () {
    Route::post('send', 'MessageController@store')->name('message_store');
});

