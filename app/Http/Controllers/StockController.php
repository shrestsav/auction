<?php

namespace SYSAuction\Http\Controllers;
use SYSAuction\Vendor;
use SYSAuction\Stock;


use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::select('id','vendor_code','first_name','last_name')->get();
        $stocks = Stock::join('vendors','stocks.vendor_id','=','vendors.id')
                ->get();
        return view('backend.pages.stocks',compact('vendors','stocks'));
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
            'vendor_id' => 'required',
            'commission' => 'required',
            'form_no' => 'required',
            'item_no' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'reserve' => 'required',
            'date' => 'required',
        ]);

        //Check for Existing form_no and item_no
        $exists_forms_with_items = Stock::where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->exists();
        
        if($exists_forms_with_items)
            return back()->withErrors('Form no and Item no exists already');
        
        $stock = Stock::create($request->all());

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
}
