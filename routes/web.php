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
	Route::get('auction_event','AuctionController@auction_event')->name('auction_event.index');
	Route::post('auction_event','AuctionController@auction_event')->name('auction_event.store');
	Route::post('save_new_sale','AuctionController@ajax_save_new_sale');
	Route::post('remove_sale','AuctionController@ajax_remove_sale');
	Route::resource('stocks','StockController');
	Route::resource('lotting','LottingController');
	Route::post('get_vendor_stocks','LottingController@ajax_get_vendor_stocks');
	Route::post('get_auction_stocks','LottingController@ajax_get_auction_stocks');
	Route::post('save_new_lot','LottingController@ajax_save_new_lot');
	Route::post('remove_lot_from_auction','LottingController@ajax_remove_lot_from_auction');

	Route::get('adjustments','AdjustmentController@index')->name('adjustments.index');
	Route::post('adjustments','AdjustmentController@set_state')->name('adjustments.store');

	Route::get('total_sales','ReportController@total_sales')->name('reports.sales');
});

	// Route::get('get_vendor_stocks','LottingController@ajax_get_vendor_stocks');