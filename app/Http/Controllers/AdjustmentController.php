<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\PaymentMethod;

class AdjustmentController extends Controller
{
    public function index(){
    	$states = State::all();
        $payment_methods = PaymentMethod::all();
    	return view('backend.pages.adjustments',compact('states','payment_methods'));
    }
    public function set_state(Request $request){
    	$validatedData = $request->validate([
        'name' => 'required',
    	]);
    	$state = State::Create($request->all());
    	return back()->with('message','State Created Successfully');
	}
    public function set_payment_method(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        ]);
        $payment_method = PaymentMethod::Create($request->all());
        return back()->with('message','Payment Method Created Successfully');
    }
}
