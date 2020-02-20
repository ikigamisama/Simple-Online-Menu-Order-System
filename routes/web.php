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

Route::get('/', 'OrderController@welcomeOrder');
Route::get('/menu/{category?}', 'OrderController@index');
Route::get('/order_summary', 'OrderController@summaryOrder');
Route::get('/order_success', 'OrderController@doneOrder');
Route::post('/add_name', 'OrderController@addName');
Route::post('/add_order', 'OrderController@addOrder');
Route::post('/edit_quantity_order', 'OrderController@editQuantityOrder');
Route::post('/delete_order', 'OrderController@deleteOrder');
Route::post('/clear_order', 'OrderController@clearOrder');
Route::post('/submit_order', 'OrderController@submitOrder');
Route::post('/apply_coupon', 'OrderController@applyCoupon');