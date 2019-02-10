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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::middleware(['auth'])->group(function () {
	Route::post('set_sidebar','HomeController@ajax_set_sidebar');
	Route::resource('vendors','VendorController');
	Route::resource('buyers','BuyerController');
	Route::resource('auctions','AuctionController');
	Route::resource('stocks','StockController');
});