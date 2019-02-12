<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\Stock;
use App\Vendor;
use App\Lotting;
use Validator;

class LottingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions =  Auction::all();
        $stocks = Stock::all();
        $vendor_with_stocks_id = Stock::select('vendor_id')->get()->toArray();        
        $vendors_with_stocks = Vendor::whereIn('id', $vendor_with_stocks_id)->get();
        return view('backend.pages.lotting',compact('auctions','stocks','vendors_with_stocks'));
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
        // This has been shifted to ajax_save_new_lot
        return $request->all();
        // $lot = Lotting::create($request->all());

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

    public function ajax_get_vendor_stocks(Request $request)
    {
        $id = $request->id;
        $vendor_stocks = Vendor::find($id)->stock;
        return $vendor_stocks;
        // return response()->json(array('msg'=> 'hey'), 200);
    }

    public function ajax_get_auction_stocks(Request $request)
    {
        $existing_stocks = Lotting::select('lottings.vendor_id','vendors.vendor_code','vendors.first_name','vendors.last_name','lottings.lot_no','lottings.form_no','lottings.item_no','lottings.description','lottings.quantity','lottings.reserve','lottings.sold')
                        ->where('auction_id',$request->auction_id)
                        ->join('vendors','lottings.vendor_id','=','vendors.id')
                        ->get();

        return $existing_stocks;
    }
    public function ajax_save_new_lot(Request $request)
    {
        // return $request->all();
        $rule = ['auction_id' => 'bail|required',
                'vendor_id' => 'required',
                'form_no' => 'required',
                'item_no' => 'required',
                'lot_no' => 'required',
                'quantity' => 'required',
                'reserve' => 'required',
                'description' => 'required'
                ];
        $msg = ['auction_id.required' => 'Please select Auction First',
                'vendor_id.required' => 'Please Select Item',
                'form_no.required' => 'Please select Item',
                'item_no.required' => 'Please select Item',
                'description.required' => 'Please select Item',
                'lot_no.required' => 'Please Enter Lot Number',
                'quantity.required' => 'Please Enter Quantity',
                'reserve.required' => 'Please Enter Reserve',
                ];
        $validate = Validator::make($request->all(), $rule, $msg);
        if($validate->fails()){
            return response($validate->errors(),401);
        }

        // Check for Duplicate Entries
        $existing_lot = Lotting::where('auction_id','=',$request->auction_id)->where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->get();
        if(count($existing_lot)){
            return response()->json(['error'=>'This Item Already Exists in this Auction, You may want to edit it instead'],401);
        }




            $lot = Lotting::create($request->all());
            return response()->json(['success'=>'Lotting has been added successfully']);
    }

}
