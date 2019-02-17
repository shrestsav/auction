<?php

namespace SYSAuction\Http\Controllers;

use Illuminate\Http\Request;
use SYSAuction\Buyer;
use SYSAuction\State;
use SYSAuction\Sale;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'fasdf';
        $buyers = Buyer::select('id','buyer_code','first_name','last_name','address','mobile','comments')->get();
        $states = State::all();
        $purchases = Sale::join('lottings','lottings.id','sales.lotting_id')->orderBy('buyer_id')->get();
        // return $purchases;
        $buyers_with_purchases = Sale::select('buyer_id')->groupBy('buyer_id')->get();
        return view('backend.pages.buyers',compact('buyers','states','purchases','buyers_with_purchases'));
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
        'first_name' => 'required',
        'last_name' => 'required',
        'buyers_premium' => 'required',
        'address' => 'required',
        'suburb' => 'required',
        'state' => 'required',
        'postcode' => 'required',
        ]);
        // Generate Buyer Code
        $Ids = Buyer::all();
        // return $request->buyers_premium;
        if(count($Ids))
            $id = $Ids->last()->id + 1;
        else
            $id = 1;
        $request->merge(['buyer_code' => 'B'.$id]);
        $buyer = Buyer::create($request->all());

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
