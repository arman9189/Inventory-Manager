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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('products', 'ProductsController')->middleware('auth');
Route::resource('product-categories', 'ProductCategoriesController')->middleware('auth');
Route::resource('suppliers', 'SuppliersController')->middleware('auth');
Route::resource('storage-locations', 'StorageLocationsController')->middleware('auth');

Route::get('/stock/add', 'ProductStocksController@addView')->middleware('auth');
Route::post('/stock/add', 'ProductStocksController@addStock')->middleware('auth');

Route::get('/stock/remove', 'ProductStocksController@removeView')->middleware('auth');
Route::post('/stock/remove', 'ProductStocksController@removeStock')->middleware('auth');
