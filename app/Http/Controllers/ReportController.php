<?php

namespace App\Http\Controllers;
use App\Sale;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function total_sales(Request $request){
    	$all_sales = Sale::select('sales.form_no as form_no',
					    		'sales.item_no as item_no',
					    		'sales.rate as rate',
					    		'sales.quantity as quantity',
					    		'sales.discount as discount',
					    		'sales.buyers_premium_amount as buyers_premium_amount',
					    		'vendors.vendor_code',
					    		'auctions.auction_no',
					    		'buyers.buyer_code',
					    		'lottings.description as description')
					    	->join('vendors','vendors.id','=','sales.vendor_id')
    						->join('buyers','buyers.id','=','sales.buyer_id')
    						->join('auctions','auctions.id','=','sales.auction_id')
    						->join('lottings','lottings.id','=','sales.lotting_id')
    						->get();
    						// return $all_sales;
    	return view('backend.pages.total_sales',compact('all_sales'));
    }
}
