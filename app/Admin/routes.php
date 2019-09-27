<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('users', UserController::class);

    $router->resource('products', ProductController::class);
    $router->resource('product-singles', ProductSingleController::class);
    $router->resource('product-inventory-records', ProductInventoryRecordController::class);

    $router->resource('orders', OrderController::class);
});
