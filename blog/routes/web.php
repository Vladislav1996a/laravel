<?php


Route::get('/', 'HomeController@index');

Route::get('/product', 'ProductController@product');

Route::get('/cart', 'CartController@cart');

Route::get('/order', 'OrderController@order');


Route::post('/cart/add/{id}', 'CartController@cartAdd')->name('cart-add');
