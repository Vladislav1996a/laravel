<?php


Route::get('/page', 'indexController@dom');

Route::get('/product', 'ProductController@product');

Route::get('/cart', 'CartController@cart');

Route::get('/order', 'OrderController@order');


Route::post('/cart/add', 'CartController@cartAdd');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
