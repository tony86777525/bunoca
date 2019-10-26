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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'IndexController@index')->name('index');
Route::get('index', 'IndexController@index')->name('index');
Route::get('house', 'HouseController@index');
Route::get('shop/{id}/', 'ShopController@index')->name('shop');
Route::post('shop/{id}/set_buy_record', 'ApiController@set_buy_record');

// API
Route::post('home/send_check', 'ApiController@send_create_check');
Route::post('home/get_order_detail_price', 'ApiController@get_order_detail_price');
Route::post('home/delete_order_detail', 'ApiController@delete_order_detail');
Route::post('home/create_order', 'ApiController@create_order');
Route::post('/home/shoppingPay/result', 'ApiController@shopping_pay_result');
Route::post('/home/update_user', 'ApiController@update_user');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/shoppingCart', 'HomeController@shopping_cart')->name('shoppingCart');
Route::get('/home/shoppingPay/{o_no}', 'HomeController@shopping_pay')->name('shoppingPay');
Route::get('/home/orderRecord', 'HomeController@order_record')->name('orderRecord');
Route::get('/home/orderRecord/{o_no}/detail', 'HomeController@order_detail')->name('orderDetail');
Route::get('/home/user', 'HomeController@user')->name('user');

