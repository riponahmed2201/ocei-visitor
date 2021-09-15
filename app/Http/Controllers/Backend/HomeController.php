<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VisitorAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function dashboard(){
        return view('backend.dashboard.dashboard');
    }

    public function profile(){
        return view('backend.profile.profile');
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'name'=>'required|min:6',
            'mobile'=>'required|min:11',
            'email'=>'required|email|unique:admins,email,'.Auth::id(),
        ]);
          $visitors=VisitorAdmin::find(Auth::id());
          $visitors->name=$request->name;
          $visitors->mobile=$request->mobile;
          $visitors->email=$request->email;
          $visitors->save();
          //Session::flash('success','Successfully Profile Updated');
          return redirect()->back()->with('success','Successfully Profile Updated!');
    }

     //Update password
    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password'=>'required',
            'password'=>'required||min:6|confirmed',
            // 'password_confirmation'=>'required|same:new_password',
        ]);
        $hashedPassword=Auth::user()->password;
        //dd($hashedPassword);
        if(Hash::check($request->old_password,$hashedPassword)){
                if(! Hash::check($request['password'],$hashedPassword)){
                $visitors = VisitorAdmin::find(Auth::guard('system_admin')->user()->id);
                $visitors->password = Hash::make($request->password);
                $visitors->save();
                Session::flash('success','You Have Successfully Changed The Password');
                Auth::logout();
                return redirect()->route('visitor.login');
               }else{
                Session::flash('error','New Password Cannot Be The Same As Old Pass');
                return redirect()->back();
               }
        }else{
            Session::flash('error','Old Password Does Not Matched');
            return redirect()->back();
        }
    }

}
