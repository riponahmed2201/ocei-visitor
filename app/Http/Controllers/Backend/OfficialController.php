<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use App\Appointment;
use DB;

class OfficialController extends Controller
{
    public function officiallist(Request $request){
        //$query = "select * from employee";
        $query = "select designation.*,employee.employee_id as employee_id, employee.first_name as firstName,employee.last_name as lName,employee.phone as ephn,employee.email as eemail from designation left join employee on designation.designation_id=employee.designation_id AND designation.designation_name='Admin' OR designation.designation_name='Accounts' OR designation.designation_name='Asst Accounts' OR designation.designation_name='Inspector' OR designation.designation_name='Sr Inspector' OR designation.designation_name='Licencing Board'";
        //dd($query);
        $data['designations'] =Designation::orderBy('designation_name','DESC')
        ->where('designation_name','=','Admin')
        ->orWhere('designation_name','=','Inspector')
        ->orWhere('designation_name','=','Accounts')
        ->orWhere('designation_name','=','Asst Accounts')
        ->orWhere('designation_name','=','Licencing Board')
        ->orWhere('designation_name','=','Sr Inspector')
        ->get();
        
        if ($request->isMethod('post')) {
          $designation_name = $request->designation_name;

          if($designation_name == '-1'){
          }
          else{
              $query = $query. " where 1=1 ";

              if($designation_name != '-1'){
                  $query = $query . " AND designation.designation_name = '".$designation_name."'";
              }
          }
           //dd($query);
          $data['employee'] = DB::select($query);

           //dd($data['employee']);

          return view('backend.official.official_list',$data);
      }
      else{

          $data['employee'] = DB::select($query);
          //dd($data['employee']);
          return view('backend.official.official_list',$data);
      }

    }

    public function createAppointment($employee_id){
       $employee=DB::table('employee')->where('employee_id',$employee_id)->first();
       //dd($employee);
       return view('backend.official.create_appointment',compact('employee'));
    }

    public function storeAppointment(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
            //dd($data);
             $this->validate($request,[
            'date_time'=>'required',
            'purpose'=>'required'
            ]);

             $appointment=new Appointment;
             $appointment->visitor_id=$data['visitor_id'];
             $appointment->employee_id=$data['employee_id'];
             $appointment->date_time=$data['date_time'];
             $appointment->date_time=date("Y-m-d H:i:s",strtotime($data['date_time']));
             $appointment->purpose=$data['purpose'];
             $appointment->status=1;
              if(!empty($request->input('request_detail'))) {
                    $appointment->request_detail = $request->request_detail;
                } else {
                    $appointment->request_detail = 'Null';
             }
             // file upload
                if ($request->hasFile('document')){
                    $photo = $request->file('document');
                    $filename = time().".".$photo->getClientOriginalExtension();
                    $destination_path = public_path('documents');
                    $photo->move($destination_path,$filename);
                    $appointment->document = $filename;
                }
              //dd($appointment);
             $appointment->save();
             return redirect()->back()->with('success','Successfully Appointment Created!');
        }
    }
}
