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

// disables register
Auth::routes(['register' => false]);

// redirect requests to register to login
Route::get('/register', function () {
  return view('auth.login')->with('error', 'Registration is not possible.');
});

Route::get('/about', function () {
  return view('about');
});

Route::get('/settings', 'SettingsController@index')->middleware('auth');
Route::get('/settings/edit', 'SettingsController@edit')->middleware('auth');
Route::post('/settings/edit', 'SettingsController@update')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', 'ProductsController')->middleware('auth');
Route::resource('product-categories', 'ProductCategoriesController')->middleware('auth');
Route::resource('suppliers', 'SuppliersController')->middleware('auth');
Route::resource('storage-locations', 'StorageLocationsController')->middleware('auth');
Route::resource('customers', 'CustomersController')->middleware('auth');

Route::get('/stock/add', 'ProductStocksController@addView')->middleware('auth');
Route::post('/stock/add', 'ProductStocksController@addStock')->middleware('auth');

Route::get('/stock/remove', 'ProductStocksController@removeView')->middleware('auth');
Route::post('/stock/remove', 'ProductStocksController@removeStock')->middleware('auth');

Route::get('/stock/move', 'ProductStocksController@moveView')->middleware('auth');
Route::post('/stock/move', 'ProductStocksController@moveStock')->middleware('auth');
