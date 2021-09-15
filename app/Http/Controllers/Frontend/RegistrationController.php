<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VisitorRegistration;
use DB;

class RegistrationController extends Controller
{
    public function register(){
        $departments=DB::table('department')->get();
        $designations=DB::table('designation')->get();
        //dd($designation);
        return view('frontend.auth.register')->with(compact('departments','designations'));
    }

    public function storeRegister(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
            //dd($data);
             $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required|min:11|numeric',
            'gender'=>'required',
            'date_of_birth'=>'required',
            'designation_id'=>'required',
            'department_id'=>'required'
            ]);
             
             $visitor_register=new VisitorRegistration;
             $visitor_register->name=$data['name'];
             $visitor_register->email = isset($data['email']) ?  : NULL;
             $visitor_register->mobile=$data['mobile'];
             $visitor_register->date_of_birth=$data['date_of_birth'];
             $visitor_register->gender=$data['gender'];
             $visitor_register->designation_id=$data['designation_id'];
             $visitor_register->department_id=$data['department_id'];
             $visitor_register->save();
             return redirect()->back()->with('success','Successfully Visitor Created!');
        }
    }
}
