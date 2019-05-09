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
        $vendors_with_stocks = Vendor::select('vendors.id',
                                               'vendors.vendor_code',
                                               'vendors.first_name',
                                               'vendors.last_name')
                                        ->join('stocks','stocks.vendor_id','vendors.id')
                                        ->groupBy('vendors.id','vendors.first_name','vendors.last_name')
                                        ->get();
        //Stocks which are already added in auctions
        $added_stocks = Lotting::pluck('stock_id')->toArray();

        return view('backend.pages.lotting',compact('auctions','stocks','vendors_with_stocks','added_stocks'));
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
        $auction_id = $request->auction_id;
        $vendor_stocks = Stock::where('stocks.vendor_id','=',$id)
                              ->with(['lotting','lotting.sale'])
                              ->get();
        $added_stocks = Lotting::where('auction_id',$auction_id)->pluck('stock_id')->toArray();
        return response()->json([
                                'vendor_stocks'=>$vendor_stocks, 
                                'added_stocks'=>$added_stocks
                                ]);
    }

    public function ajax_get_auction_stocks(Request $request)
    {
        $existing_stocks = Lotting::select('lottings.id',
                                       'lottings.vendor_id',
                                       'vendors.vendor_code',
                                       'vendors.first_name',
                                       'vendors.last_name',
                                       'lottings.lot_no',
                                       'lottings.form_no',
                                       'lottings.item_no',
                                       'lottings.description',
                                       'lottings.quantity',
                                       'lottings.reserve')
                                    ->where('auction_id',$request->auction_id)
                                    ->join('vendors','lottings.vendor_id','=','vendors.id')
                                    ->with(['sale'])
                                    ->get();
        if(count($existing_stocks))
            return $existing_stocks;
        return response()->json(['error'=>'No Stocks in Auction'],401);
    }

    public function ajax_remove_lot_from_auction(Request $request)
    {
        $Remove_lot = Lotting::find($request->lotting_id)->delete();
        if($Remove_lot)
            return json_encode('Deleted');
        return response()->json(['error'=>'Data Could Not be deleted'],401);
    }

    public function ajax_save_new_lot(Request $request)
    {
        $rule = ['auction_id' => 'required',
                'stock_id' => 'required',
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
                'stock_id.required' => 'Please Select Item',
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

        // If Entry already exists then throw 401 error
        if(count($existing_lot)){
            return response()->json(['error'=>'This Item Already Exists in this Auction, You may want to edit it instead'],401);
        }

        // Check if Quantity is greater than available stocks
        $check_stock_quantity = Stock::where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->with(['lotting','lotting.sale'])->first();

        $auction_quantity = 0;

        if(count($check_stock_quantity->lotting)){
            foreach($check_stock_quantity->lotting as $auction){
                $auction_quantity += $auction->quantity;
            }
        }

        $available_quantity =  $check_stock_quantity->quantity - $auction_quantity;
        if($request->quantity > $available_quantity){
            return response()->json(['error'=>'Selected quantity is higher than available stocks'],401);
        }

        $lot = Lotting::create($request->all());
        return response()->json(['success'=>'Lotting has been added successfully','lotting_id'=>$lot->id]);
    }

    public function ajax_update_lot(Request $request)
    {
        $rule = ['auction_id' => 'required',
                'vendor_id' => 'required',
                'form_no' => 'required',
                'item_no' => 'required',
                'lot_no' => 'required',
                'quantity' => 'required',
                'reserve' => 'required',
                'description' => 'required'
                ];
                
        $msg = ['auction_id.required' => 'Please select Auction First',
                'vendor_id.required' => 'Vendor ID Empty',
                'form_no.required' => 'Form No is Empty',
                'item_no.required' => 'Item No is Empty',
                'description.required' => 'Description',
                'lot_no.required' => 'Please Enter Lot Number',
                'quantity.required' => 'Please Enter Quantity',
                'reserve.required' => 'Please Enter Reserve',
                ];

        $validate = Validator::make($request->all(), $rule, $msg);

        if($validate->fails()){
            return response($validate->errors(),401);
        }

        // Check for Lotting Entries
        $existing_lot = Lotting::where('auction_id','=',$request->auction_id)->where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->with(['sale']);


        // If Entry already exists then Update
        if($existing_lot->exists()){
            $existing_lot_quantity = $existing_lot->first()->quantity;
            $auction_quantity = 0;
            $auction_sale = 0;

            //Check if auction already has sold some items
            if(count($existing_lot->first()->sale)){
               foreach($existing_lot->first()->sale as $sales){
                    $auction_sale += $sales->quantity;
                } 
            }

            if($request->quantity < $auction_sale){
                return response()->json(['error'=>'Selected quantity is lesser than already sold stocks'],401);
            }

            // Check if Quantity is greater than available stocks
            $check_stock_quantity = Stock::where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->with(['lotting','lotting.sale'])->first();

            if(count($check_stock_quantity->lotting)){
                foreach($check_stock_quantity->lotting as $auction){
                    $auction_quantity += $auction->quantity;
                }
            }

            $available_quantity =  $check_stock_quantity->quantity - $auction_quantity + $existing_lot_quantity;

            if($request->quantity > $available_quantity){
                return response()->json(['error'=>'Selected quantity is higher than available stocks'],401);
            }

            $existing_lot = $existing_lot->update(['quantity'=>$request->quantity,
                                                   'reserve'=>$request->reserve, 
                                                   'lot_no'=>$request->lot_no]);

            return response()->json(['success'=>'Lotting updated successfully']);
        }

        return response()->json(['error'=>'Not Found'],401);
    }

}
