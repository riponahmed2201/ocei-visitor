<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\VisitorRegistration;
use App\Employee;
use DB;

class RegistrationController extends Controller
{
    public function register(){
        $departments=DB::table('department')->get();
        $designations=DB::table('designation')->get();
        $employees=DB::table('employee')->get();
        //dd($designation);
        return view('frontend.auth.register')->with(compact('departments','designations','employees'));
    }

    public function storeRegister(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
            //dd($data);
             $this->validate($request,[
            'name'=>'required',
            'phone'=>'required|min:11|numeric',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password'
            ]);
             
             $visitor_register=new VisitorRegistration;
             $visitor_register->name=$data['name'];
             $visitor_register->phone=$data['phone'];
             $visitor_register->password=Hash::make($data['password']);
             $visitor_register->role=$data['role'];
             $visitor_register->status=1;
              if(!empty($request->input('address'))) {
                    $visitor_register->address = $request->address;
                } else {
                    $visitor_register->address = 'Null';
             }

              if(!empty($request->input('email'))) {
                    $visitor_register->email = $request->email;
                } else {
                    $visitor_register->email = 'Null';
             }
             // file upload
                if ($request->hasFile('image')){
                    $photo = $request->file('image');
                    $filename = time().".".$photo->getClientOriginalExtension();
                    $destination_path = public_path('profile/images');
                    $photo->move($destination_path,$filename);
                    $visitor_register->image = $filename;
                }
             $visitor_register->save();
             return redirect()->back()->with('success','Successfully Visitor Register Created!');
        }
    }
}
