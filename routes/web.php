<?php

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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'room','as' => 'room.'], function(){
    Route::get('/','RoomController@index') -> name('index');
    Route::get('/create','RoomController@create') -> name('create');
    Route::post('/store','RoomController@store') -> name('store');
    Route::get('/edit/{id}','RoomController@edit') ->name('edit');
    Route::post('/update/{id}','RoomController@update') ->name('update');
    Route::post('/delete/{id}','RoomController@destroy') ->name('destroy');
    Route::get('/detail/{id}','RoomController@show') ->name('show');
    Route::get('/search', 'FindRoomController@index')->name('find_rooms');
});


