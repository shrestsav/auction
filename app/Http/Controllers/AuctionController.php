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
        $auctions = Auction::select('auction_no','venue','date','time')->get();
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
        // return $request->all();
        // if(count($request->all())){
        //     $sales = Sale::create($request->all());
        //     Stock::where('vendor_id',$request->vendor_id)->where('form_no',$request->form_no)->where('item_no',$request->item_no)->update(['sold'=>$request->quantity]);
        //     Lotting::where('vendor_id',$request->vendor_id)->where('form_no',$request->form_no)->where('item_no',$request->item_no)->update(['sold'=>$request->quantity]);
        // }
        $auctions = Auction::all();
        $buyers = Buyer::select('id','buyer_code','first_name','last_name')->get();
        return view('backend.pages.auction_events',compact('auctions','buyers'));
    }
    public function ajax_save_new_sale(Request $request){
        $rule = ['lotting_id' => 'required',
                'auction_id' => 'required',
                'vendor_id' => 'required',
                'buyer_id' => 'required',
                'invoice_id' => 'required',
                'form_no' => 'required',
                'item_no' => 'required',
                'lot_no' => 'required',
                'rate' => 'required',
                'quantity' => 'required',
                'discount' => 'required',
                'buyers_premium_amount' => 'required'
                ];
        $msg = ['lotting_id.required' => 'Something is not right',
                'auction_id.required' => 'Please select Auction First',
                'vendor_id.required' => 'Something is not right',
                'buyer_id.required' => 'Something is not right',
                'invoice_id.required' => 'Enter Invoice Number',
                'form_no.required' => 'Something is not right',
                'item_no.required' => 'Something is not right',
                'lot_no.required' => 'Something is not right',
                'rate.required' => 'Please Enter Rate',
                'quantity.required' => 'Please Enter Quantity',
                'discount.required' => 'Please Enter Discount',
                'buyers_premium_amount.required' => 'Please Enter BP AMOUNT',
                ];

        $validate = Validator::make($request->all(), $rule, $msg);
        if($validate->fails()){
            return response($validate->errors(),401);
        }

        // Check for Duplicate Entries
        $existing_item = Sale::where('auction_id','=',$request->auction_id)->where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->where('buyer_id','=',$request->buyer_id)->where('invoice_id','=',$request->invoice_id)->get();

        // If Entry already exists then throw 401 error
        if(count($existing_item)){
            return response()->json(['error'=>'You have already added the item, You may want to edit it instead'],401);
        }

        

        // Check if Quantity is greater than available stocks in auction
        // $check_stock_quantity = Lotting::where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->pluck('quantity')->toArray();

        // Check for Left Item
        $stocks = Lotting::select('quantity','sold')->where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->get()->toArray();
        $left_stocks = $stocks[0]['quantity'] - $stocks[0]['sold'];

        // Check if Quantity is greater than available stocks in auction
        if($request->quantity > $left_stocks)
            return response()->json(['error'=>'Selected quantity is higher than available stocks'],401);

        // Update Stocks Sold Attribute in Stock and Lotting Table
        Stock::where('vendor_id',$request->vendor_id)
                ->where('form_no',$request->form_no)
                ->where('item_no',$request->item_no)
                ->increment('sold',$request->quantity);
        Lotting::where('vendor_id',$request->vendor_id)
                ->where('form_no',$request->form_no)
                ->where('item_no',$request->item_no)
                ->increment('sold',$request->quantity);
        $item = Sale::create($request->all());
        return response()->json(['success'=>'Item has been added successfully']);
    }

}
