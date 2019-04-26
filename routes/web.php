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
	Route::post('check_invoice','AuctionController@ajax_check_invoice');

	Route::get('stocks','StockController@index')->name('stocks.index');
	Route::post('stocks','StockController@store')->name('stocks.store');
	Route::get('stocks/{id}/edit','StockController@edit')->name('stocks.edit');
	Route::post('stocks/{id}','StockController@update')->name('stocks.update');

	Route::resource('lotting','LottingController');
	Route::post('get_vendor_stocks','LottingController@ajax_get_vendor_stocks');
	Route::post('get_auction_stocks','LottingController@ajax_get_auction_stocks');
	Route::post('save_new_lot','LottingController@ajax_save_new_lot');
	Route::post('update_lot','LottingController@ajax_update_lot');
	Route::post('remove_lot_from_auction','LottingController@ajax_remove_lot_from_auction');

	Route::get('adjustments','AdjustmentController@index')->name('adjustments.index');
	Route::post('set_state','AdjustmentController@set_state')->name('adjustments.set_state');
	Route::post('set_payment_method','AdjustmentController@set_payment_method')->name('adjustments.set_payment_method');

	//REPORTS
	Route::get('total_sales','ReportController@total_sales')->name('reports.sales');
	Route::get('invoices','ReportController@invoices')->name('reports.invoices');
	Route::get('print_invoice','ReportController@print_invoice')->name('reports.print_invoice');
	Route::post('ajax_invoice_report','ReportController@ajax_invoice_report')->name('reports.ajax_invoice_report');
});
