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

Auth::routes();
Route::get('check', 'HomeController@mail_check')->name('mail_check');
Route::post('send_check', 'ApiController@send_create_check');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'IndexController@index')->name('index');
Route::get('index', 'IndexController@index')->name('index');
Route::get('house', 'HouseController@index');
Route::get('shop', 'ShopController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/orders', 'HomeController@order')->name('orders');
