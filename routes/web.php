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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'room','as' => 'room.'], function(){
    Route::get('/','RoomController@index') -> name('index');
    Route::get('/create','RoomController@create') -> name('create');
    Route::post('/store','RoomController@store') -> name('store');
    Route::get('/edit/{id}','RoomController@edit') ->name('edit');
    Route::post('/update/{id}','RoomController@update') ->name('update');
    Route::post('/delete/{id}','RoomController@destroy') ->name('destroy');
    Route::get('/detail/{id}','RoomController@show') ->name('show');
});


Route::group(['prefix' => 'customer','as' => 'customer.'], function(){
    Route::get('/','CustomerController@index') -> name('index');
    Route::get('/create','CustomerController@create') -> name('create');
    Route::post('/store','CustomerController@store') -> name('store');
    Route::get('/edit/{id}','CustomerController@edit') ->name('edit');
    Route::post('/update/{id}','CustomerController@update') ->name('update');
    Route::post('/delete/{id}','CustomerController@destroy') ->name('destroy');
    Route::get('/detail/{id}','CustomerController@show') ->name('show');
});


Route::group(['prefix' => 'booking','as' => 'booking.'], function(){
    Route::get('/','BookingController@index') -> name('index');
    Route::get('/create','BookingController@create') -> name('create');
    Route::post('/store','BookingController@store') -> name('store');
    Route::get('/edit/{id}','BookingController@edit') ->name('edit');
    Route::post('/update/{id}','BookingController@update') ->name('update');
    Route::post('/delete/{id}','BookingController@destroy') ->name('destroy');
    Route::get('/detail/{id}','BookingController@show') ->name('show');
});


Route::group(['prefix' => 'findroom','as' => 'findroom.'], function(){
    Route::get('/', 'FindRoomController@index')->name('find_rooms');
    Route::get('/search', 'FindRoomController@show')->name('show_rooms');
});
//code năm mới 10:27 AM , 02/02/2020

Auth::routes();

//Admin site
Route::group(['prefix' => 'admin' , 'as' => 'admin.' ,'namespace' => 'Admin'],function (){
    Route::get('/login', 'LoginController@showLogin')->name('show-login');
    Route::post('/handle-login','LoginController@handleLogin')->name('handle-login');
    Route::group(['middleware' => 'admin-check-login'],function ()
    {
        Route::get('/','DashboardController@index')->name('dashboard');
    });
});

