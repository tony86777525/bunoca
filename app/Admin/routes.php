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

    // User Procuct API
    $router->delete('user/product/{id}', 'User\ApiController@delete_product');
    $router->post('user/product/create_product', 'User\ApiController@create_product');
    $router->post('user/product/{id}/update_product', 'User\ApiController@update_product');
    $router->post('user/product/{id}/update_product_single', 'User\ApiController@update_product_single');
    $router->post('user/product/{id}/delete_product_single', 'User\ApiController@delete_product_single');
    $router->post('user/update_ps_inventory', 'User\ApiController@update_ps_inventory');
    // User Procuct
    $router->get('user/product', 'User\ProductController@index');
    $router->get('user/product/create', 'User\ProductController@create');
    $router->get('user/product/{id}', 'User\ProductController@show');
    $router->get('user/product/{id}/edit', 'User\ProductController@edit');
    $router->resource('products', ProductController::class);
    $router->resource('product-singles', ProductSingleController::class);
    $router->resource('product-inventory-records', ProductInventoryRecordController::class);
    // User Order
    $router->get('user/order', 'User\OrderController@index');
    $router->get('user/order/create', 'User\OrderController@create');
    $router->get('user/order/{id}/edit', 'User\OrderController@edit');

    $router->resource('orders', OrderController::class);
    $router->resource('order-details', OrderDetailController::class);
});
