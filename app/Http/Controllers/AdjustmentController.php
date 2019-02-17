<?php

namespace SYSAuction\Http\Controllers;

use Illuminate\Http\Request;
use SYSAuction\State;

class AdjustmentController extends Controller
{
    public function index(){
    	$states = State::all();
    	return view('backend.pages.adjustments',compact('states'));
    }
    public function set_state(Request $request){
    	$validatedData = $request->validate([
        'name' => 'required',
    	]);
    	$state = State::Create($request->all());
    	return back();
	}
}
