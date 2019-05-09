<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\Buyer;
use App\Sale;
use App\Stock;
use App\Lotting;
use Validator;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions = Auction::with('lottings','lottings.vendor','lottings.sale')->get();
        return view('backend.pages.auctions',compact('auctions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'venue' => 'required',
        'date' => 'required',
        'time' => 'required',
        ]);

        // Generate Auction Code
        $Ids = Auction::all();
        
        if(count($Ids))
            $id = $Ids->last()->id + 1;
        else
            $id = 1;
        $request->merge(['auction_no' => 'A'.$id]);
        $auction = Auction::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function auction_event(Request $request)
    {
        $auctions = Auction::all();
        $buyers = Buyer::select('id','buyer_code','first_name','last_name')->get();
        return view('backend.pages.auction_events',compact('auctions','buyers'));
    }

    public function ajax_remove_sale(Request $request)
    {
        $remove_sale = Sale::find($request->sale_id)->delete();

        if($remove_sale)
            return json_encode('Deleted');
        return response()->json(['error'=>'Data Could Not be deleted'],401);
    }


    public function ajax_save_new_sale(Request $request)
    {
        $rule = ['lotting_id' => 'required',
                'auction_id' => 'required',
                'vendor_id' => 'required',
                'buyer_id' => 'required',
                'invoice_id' => 'required',
                'form_no' => 'required',
                'item_no' => 'required',
                'lot_no' => 'required',
                'rate' => 'required',
                'quantity' => 'bail|required|numeric|min:1',
                'discount' => 'required',
                'buyers_premium_amount' => 'bail|required|numeric|min:0'
                ];
        $msg = ['lotting_id.required' => 'Something is not right',
                'auction_id.required' => 'Please select Auction First',
                'vendor_id.required' => 'Something is not right',
                'buyer_id.required' => 'Please Select Buyer First',
                'invoice_id.required' => 'Enter Invoice Number',
                'form_no.required' => 'Something is not right',
                'item_no.required' => 'Something is not right',
                'lot_no.required' => 'Something is not right',
                'rate.required' => 'Please Enter Rate',
                'quantity.required' => 'Please Enter Quantity',
                'quantity.min' => 'Please Enter Quantity greater than 0',
                'discount.required' => 'Please Enter Discount',
                'buyers_premium_amount.required' => 'Please Enter BP AMOUNT',
                'buyers_premium_amount.min' => 'BP AMOUNT Negative',
                ];

        $validate = Validator::make($request->all(), $rule, $msg);
        if($validate->fails()){
            return response($validate->errors(),401);
        }

        // Check for Duplicate Entries
        $existing_item = Sale::where('auction_id','=',$request->auction_id)->where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->where('buyer_id','=',$request->buyer_id)->where('invoice_id','=',$request->invoice_id)->get();

        if(count($existing_item)){
            return response()->json(['error'=>'You have already added the item, You may want to edit it instead'],401);
        }

        $existing_invoice = Sale::where('invoice_id','=',$request->invoice_id)->where('buyer_id','!=',$request->buyer_id);

        if($existing_invoice->exists())
            return response()->json(['error'=>'You cannot Used this invoice number'],401);

        // Check for Left Item
        $stocks = Lotting::select('id','quantity')->where('id','=',$request->lotting_id)->with(['sale'])->first();
        $total_sale = 0;
        if(count($stocks->sale)){
            foreach($stocks->sale as $sale){
                $total_sale += $sale->quantity;
            }
        }
        $left_stocks = $stocks->quantity - $total_sale;

        // Check if Quantity is greater than available stocks in auction
        if($request->quantity > $left_stocks)
            return response()->json(['error'=>'Selected quantity is higher than available stocks'],401);

        $item = Sale::create($request->all());

        return response()->json(['success'=>'Item has been added successfully','sale_id'=>$item->id]);
    }

    public function ajax_check_invoice(Request $request){
        $invoice = Sale::where('invoice_id','=',$request->invoice_id);
        if($invoice->exists()){
            $invoice_buyer = $invoice->where('buyer_id','=',$request->buyer_id);
            if($invoice_buyer->exists()){
                return response()->json(['success'=>'Invoice number for selected buyer already exists, you can continue using the same invoice number or change it']);
            }
            return response()->json(['error'=>'You cannot use this invoice number, it already exists'],401);
        }
        return response()->json(false);
    }

}
