<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSetting;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $UserSetting = UserSetting::where('user_id',Auth::user()->id)->get();
        if(count($UserSetting))
            $theme_sidebar = $UserSetting->first()->theme_sidebar;
        else
            $theme_sidebar = '';
        
        session(['theme_sidebar' => $theme_sidebar]);

        return view('backend.pages.dashboard');

    }

    public function ajax_set_sidebar(Request $request)
    {
        // Check if already exists
        if(count(UserSetting::where('user_id',$request->id)->get())){
            UserSetting::where('user_id',$request->id)->update(['theme_sidebar'=>$request->theme_sidebar]);
        }
        else{
            $theme_sidebar = new UserSetting;
            $theme_sidebar->user_id = $request->id;
            $theme_sidebar->theme_sidebar = $request->theme_sidebar;
            $theme_sidebar->save();
        }
        // Update Session
        session(['theme_sidebar' => $request->theme_sidebar]);
        return 'Updated Successfully';
    }
}
