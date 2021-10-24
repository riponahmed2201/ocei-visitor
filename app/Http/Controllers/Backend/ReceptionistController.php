<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use App\Appointment;
use App\VisitorRegistration;
use App\Receptionist;
use DB;

class ReceptionistController extends Controller
{
    public function checkAppointmentList(Request $request){
        $query = "select appointment.*,visitor_registration.phone as visitorPhone,visitor_registration.name as visitorName,employee.first_name as empeeName,employee.last_name as epeeLastName from appointment left join visitor_registration on appointment.visitor_id=visitor_registration.id left join employee on appointment.employee_id=employee.employee_id";
        //dd($query);
        $data['visitorAppointments'] =VisitorRegistration::select('phone')
        ->get();
        
        if ($request->isMethod('post')) {
          $phone = $request->phone;

          if($phone == '-1'){
          }
          else{
              $query = $query. " where 1=1 ";

              if($phone != '-1'){
                  $query = $query . " AND visitor_registration.phone = '".$phone."'";
              }
          }
           //dd($query);
          $data['checkAppointmentList'] = DB::select($query);

           //dd($data['checkAppointmentList']);

          return view('backend.receptionist.appointment_list',$data);
      }
      else{

          $data['checkAppointmentList'] = DB::select($query);
          //dd($data['checkAppointmentList']);
          return view('backend.receptionist.appointment_list',$data);
      }
    }

    public function receptionistsCreateAppointment($appointment_id){
       //$appointments=DB::table('appointment')->where('id',$appointment_id)->first();
       $appointments=DB::table('appointment')
            ->leftJoin('employee', 'appointment.employee_id', '=', 'employee.employee_id')
            ->leftJoin('visitor_registration', 'appointment.visitor_id', '=', 'visitor_registration.id')
            ->select('appointment.*', 'employee.first_name as firstName', 'employee.last_name as lName', 'visitor_registration.name as visitorName','visitor_registration.phone as visitorPhn')
            ->where('appointment.id','=',$appointment_id)
            ->first();
       //dd($appointments);
       return view('backend.receptionist.create_appointment',compact('appointments'));
    }

    public function storeReceptionistsData(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
             $this->validate($request,[
            'appointment_id'=>'required'
            ]);

             $appointment=new Receptionist;
             $appointment->visitor_id=$data['visitor_id'];
             $appointment->employee_id=$data['employee_id'];
             $appointment->date_time=$data['date_time'];
             $appointment->purpose=$data['purpose'];
             $appointment->request_detail=$data['request_detail'];
             $appointment->appointment_id=$data['appointment_id'];
             $appointment->status=0;
             $appointment->save();
             //dd($appointment);
             return redirect()->back()->with('success','Successfully Saved Data!');
        }
    }
}
