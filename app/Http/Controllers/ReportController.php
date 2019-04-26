<?php

namespace App\Http\Controllers;
use App;
use App\Sale;
use App\Vendor;
use App\Buyer;
use Validator;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function total_sales(Request $request){

        $vendors = Vendor::select('id','vendor_code','first_name','last_name')->get();
        $buyers = Buyer::select('id','buyer_code','first_name','last_name')->get();

    	$all_sales = Sale::select('sales.form_no as form_no',
					    		'sales.item_no as item_no',
					    		'sales.invoice_id',
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
                            
    	return view('backend.pages.total_sales',compact('all_sales','vendors','buyers'));
    }
    public function invoices(Request $request){

        $unique_invoices = Sale::select('invoice_id')
             ->groupBy('invoice_id')->get();

        $invoices = Sale::select('sales.form_no as form_no',
                                'sales.item_no as item_no',
                                'sales.invoice_id',
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
        
        $invoices_sum = Sale::select(
                        \DB::raw('sum(quantity) as quantity_sum'),
                        \DB::raw('sum(quantity*rate) as total_sum'),
                        \DB::raw('sum(discount) as discount_sum'),
                        \DB::raw('sum((quantity*rate)-discount) as net_total_sum'),
                        \DB::raw('sum(buyers_premium_amount) as buyers_premium_amount_sum'),
                        \DB::raw('sum((quantity*rate)-discount+buyers_premium_amount) as grand_total_sum'),
                        'sales.invoice_id',
                        'buyers.buyer_code')
                       ->join('buyers','buyers.id','=','sales.buyer_id')
                       ->groupBy('sales.invoice_id','buyers.buyer_code')
                       ->get();  
        // return $invoices_sum;
    	return view('backend.pages.all_invoice',compact('invoices','unique_invoices','invoices_sum'));
    }

    public function print_invoice(Request $request){

        $buyer_info = Sale::select('buyers.buyer_code','buyers.first_name','buyers.last_name','buyers.address','buyers.state','buyers.mobile')
                            ->join('buyers','buyers.id','sales.buyer_id')
                            ->where('invoice_id',$request->invoice_id)
                            ->groupBy('buyers.buyer_code','buyers.first_name','buyers.last_name','buyers.address','buyers.state','buyers.mobile')
                            ->get();

        $invoice_id = $request->invoice_id;

        $invoices = Sale::select('vendors.vendor_code','sales.item_no','lottings.description','sales.quantity','sales.rate','sales.discount','sales.buyers_premium_amount',
                                 \DB::raw('((sales.quantity*sales.rate)-sales.discount) as net_total'),
                                 \DB::raw('((sales.quantity*sales.rate)-sales.discount+sales.buyers_premium_amount) as grand_total'))
                          ->join('lottings','lottings.id','sales.lotting_id')
                          ->join('vendors','vendors.id','sales.vendor_id')
                          ->join('buyers','buyers.id','sales.buyer_id')
                          ->where('invoice_id',$request->invoice_id)
                          ->get();

        return view('backend.layouts.print_invoice',compact('invoices','buyer_info','invoice_id'));
        
    }
    public function ajax_invoice_report(Request $request){
        $rule = [
                'type' => 'required'
                ];
        $msg = [
                'type.required' => 'Type not Defined'
               ];

        $validate = Validator::make($request->all(), $rule, $msg);
        if($validate->fails()){
            return response($validate->errors(),401);
        }

        $report = Sale::select('sales.form_no as form_no',
                            'sales.item_no as item_no',
                            'sales.invoice_id',
                            'sales.rate as rate',
                            'sales.quantity as quantity',
                            'sales.discount as discount',
                            'sales.buyers_premium_amount as buyers_premium_amount',
                            'vendors.vendor_code',
                            'auctions.auction_no',
                            'buyers.buyer_code',
                            'stocks.commission',
                            'lottings.description as description')
                        ->join('vendors','vendors.id','=','sales.vendor_id')
                        ->join('buyers','buyers.id','=','sales.buyer_id')
                        ->join('auctions','auctions.id','=','sales.auction_id')
                        ->join('lottings','lottings.id','=','sales.lotting_id')
                        ->join('stocks','lottings.stock_id','=','stocks.id');
                        
        if($request->type=='vendor_report'){
            $report = $report->where('sales.vendor_id','=',$request->vendor_id)
                             ->get();
        }
        elseif($request->type=='buyer_report'){
            $report = $report->where('sales.buyer_id','=',$request->buyer_id)
                             ->get();
        }
        return response()->json($report);
    }
}
