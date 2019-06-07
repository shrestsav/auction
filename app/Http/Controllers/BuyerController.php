<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buyer;
use App\State;
use App\Sale;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers = Buyer::with('purchases')->get();
        $states = State::all();
        return view('backend.pages.buyers',compact('buyers','states'));
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
            'buyer_code' => 'required|unique:buyers',
            'first_name' => 'required',
            'last_name' => 'required',
            'buyers_premium' => 'required',
            'address' => 'required',
            'suburb' => 'required',
            'state' => 'required',
            'postcode' => 'required',
        ]);

        $buyer = Buyer::create($request->all());

        return back()->with('message','Buyer Added Successfully');
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
        $buyer = Buyer::find($id);

        $view = view('backend.modals.render.edit_buyer')
                    ->with([
                        'buyer' => $buyer,
                        'states' => $states,
                    ])
                    ->render();

        $response = [
           'status' => true,
           'title' => $buyer->first_name.' '.$buyer->first_name,
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
        $update = Buyer::where('id',$id)->update($request->all());
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
