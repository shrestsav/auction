<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\State;
use App\Stock;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
            
        $vendors = Vendor::select('id','vendor_code','first_name','last_name','joined_date','address','mobile')->get();
        $states = State::all();
        $stocks = Stock::orderBy('vendor_id')->get();
        $vendors_with_stocks = Stock::select('vendor_id')->groupBy('vendor_id')->get();
        return view('backend.pages.vendors',compact('vendors','states','stocks','vendors_with_stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create";
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
        'joined_date' => 'required',
        'gst_status' => 'required',
        'payment_method' => 'required',
        'commission' => 'required',
        'address' => 'required',
        'suburb' => 'required',
        'state' => 'required',
        'postcode' => 'required',
        ]);
        // Generate Vendor Code
        $Ids = Vendor::all();
        
        if(count($Ids))
            $id = $Ids->last()->id + 1;
        else
            $id = 1;
        $request->merge(['vendor_code' => 'V'.$id]);
        $vendor = Vendor::create($request->all());

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
