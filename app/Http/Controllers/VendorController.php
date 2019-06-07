<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\State;
use App\Stock;
use App\PaymentMethod;

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
        $vendors = Vendor::with(['stock.lotting.sale'])->get();
        $states = State::all();
        $payment_methods = State::pluck('name');
        // return $payment_methods;
        return view('backend.pages.vendors',compact('vendors','states','payment_methods'));
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
        'vendor_code' => 'required|unique:vendors',
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
        
        $vendor = Vendor::create($request->all());

        return back()->with('message','Vendor Added Successfully');
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
        $states = State::all();
        $payment_methods = State::pluck('name');
        $vendor = Vendor::find($id);

        $view = view('backend.modals.render.edit_vendor')
                    ->with([
                        'vendor' => $vendor,
                        'states' => $states,
                        'payment_methods' => $payment_methods,
                    ])
                    ->render();

        $response = [
           'status' => true,
           'title' => $vendor->first_name.' '.$vendor->first_name,
           'html' => $view
        ];
       return response()->json($response);
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
        unset($request['_method']);
        unset($request['_token']);
        $update = Vendor::where('id',$id)->update($request->all());
        if($update)
            return back()->with('message','Update Successfull');
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
