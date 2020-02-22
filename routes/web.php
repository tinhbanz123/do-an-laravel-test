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


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'room','as' => 'room.'], function(){
    Route::get('/','RoomController@index') -> name('index');
    Route::get('/create','RoomController@create') -> name('create');
    Route::post('/store','RoomController@store') -> name('store');
    Route::get('/edit/{id}','RoomController@edit') ->name('edit');
    Route::post('/update/{id}','RoomController@update') ->name('update');
    Route::post('/delete/{id}','RoomController@destroy') ->name('destroy');
//    Route::get('/detail/{id}','RoomController@show') ->name('show');
    Route::get('/detail','RoomController@show') ->name('show');
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


Route::group(['prefix' => 'search-room','as' => 'search-room.'], function(){
    Route::get('/', 'SearchRoomController@index')->name('find_rooms');
});

Route::group(['prefix' => 'slide','as' => 'slide.'], function(){
    Route::get('/create/{id}', 'SlideController@create')->name('create');
    Route::post('/store','SlideController@store') ->name('store');
});


//code năm mới 10:27 AM , 02/02/2020

Auth::routes();

//Admin site
Route::group(['prefix' => 'admin' , 'as' => 'admin.' ,'namespace' => 'Admin'],function (){
    //'namespace' => 'Admin' == thư mục Admin (Controllers/Admin)
    Route::get('/login', 'LoginController@showLogin')->name('show-login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::post('/handle-login','LoginController@handleLogin')->name('handle-login');
    //name : handle-login
    //function : handleLogin
    Route::group(['middleware' => 'admin-check-login'],function ()
    {
        Route::get('/','DashboardController@index')->name('dashboard');
    });

});

