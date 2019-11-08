<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

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

    // User Order API
    $router->post('user/update_od_arrival', 'User\ApiController@update_od_arrival');
    $router->post('user/order/{id}/get_order_detail_price', 'User\ApiController@get_order_detail_price');
    $router->post('user/order/{id}/recalculate_order_price', 'User\ApiController@recalculate_order_price');
    $router->post('user/order/{id}/update_order_and_detail', 'User\ApiController@update_order_and_detail');
    $router->post('user/order/{id}/get_all_product', 'User\ApiController@get_all_product');

    $router->post('user/order/create/create_order', 'User\ApiController@create_order');
    $router->post('user/order/{id}/create_order_detail', 'User\ApiController@create_order_detail');
    $router->post('user/order/{id}/delete_order_detail', 'User\ApiController@delete_order_detail');

    // User Order
    $router->get('user/order', 'User\OrderController@index');
    $router->get('user/order/create', 'User\OrderController@create');
    $router->get('user/order/{id}', 'User\OrderController@show');
    $router->get('user/order/{id}/edit', 'User\OrderController@edit');

    $router->resource('products', ProductController::class);
    $router->resource('product-singles', ProductSingleController::class);
    $router->resource('product-inventory-records', ProductInventoryRecordController::class);
    $router->resource('product-categories/create', 'ProductCategoryController', ['except' => ['create']])->names('admin.productCategory.create');

    $router->resource('users', UserController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('order-details', OrderDetailController::class);

    $router->resource('configs', ConfigController::class);
});
