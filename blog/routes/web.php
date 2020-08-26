<?php


Route::get('/', 'indexController@dom');

Route::get('/product', 'ProductController@product');

Route::get('/cart', 'CartController@cart', function () {
    //
})->middleware('auth');

Route::post('/cart/add', 'CartController@cartAdd', function () {
    //
})->middleware('auth');

Route::post('/cart/delete', 'CartController@cartDelete');

Route::post('/cart/pay', 'CartController@cartPay');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
