<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\Stock;
use App\Vendor;

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
        //
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

}
