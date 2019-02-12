<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\Buyer;
use App\Sale;
use App\Stock;
use App\Lotting;

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
        if(count($request->all())){
            $sales = Sale::create($request->all());
            Stock::where('vendor_id',$request->vendor_id)->where('form_no',$request->form_no)->where('item_no',$request->item_no)->update(['sold'=>$request->quantity]);
            Lotting::where('vendor_id',$request->vendor_id)->where('form_no',$request->form_no)->where('item_no',$request->item_no)->update(['sold'=>$request->quantity]);
        }
        $auctions = Auction::all();
        $buyers = Buyer::select('id','buyer_code','first_name','last_name')->get();
        return view('backend.pages.auction_events',compact('auctions','buyers'));
    }
}
