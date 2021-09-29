<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use App\Appointment;
use DB;

class AppointmentController extends Controller
{
    public function appointmentlist(Request $request){
        $from_date = date('Y-m-d 00:00:01', strtotime($request->from_date));
        $to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));

        $query = "select appointment.*,employee.employee_id as employee_id, employee.first_name as firstName,employee.last_name as lName,visitor_registration.name as visitorName from appointment left join employee on appointment.employee_id=employee.employee_id left join visitor_registration on appointment.visitor_id=visitor_registration.id";
        //dd($query);
        $data['appointment'] =Appointment::all();
        //dd($data['appointment']);
        if ($request->isMethod('post')) {
                $status = $request->status;
                $from_date = $request->from_date;
                $to_date = $request->to_date;

                $from_date = date('Y-m-d 00:00:01', strtotime($request->from_date));
                $to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));
                //dd($to_date);

                if($status == '-1' && $from_date == ' ' && $to_date ==''){
                }else{
                    $query = $query. " where 1=1 ";

                    if($status != '-1'){
                        $query = $query . " AND appointment.status = '".$status."'";
                    }

                     if($from_date){
                        //$query = $query . " AND customers.created_at = '".$entry_date."'";
                         $query = $query . " AND appointment.date_time like '%".$from_date."%'";
                         //echo "<pre>";print_r($query);die();
                         //dd($query);
                     }

                     if($to_date){
                        //$query = $query . " AND customers.created_at = '".$entry_date."'";
                         $query = $query . " AND appointment.date_time like '%".$to_date."%'";
                         //echo "<pre>";print_r($query);die();
                         // dd($query);
                     }
                }

                $data['appointmentData'] = DB::select($query);
                 //dd($data['appointmentData']);

                return view('backend.appointment.appointment_list',$data);
            }

        $data['appointmentData'] = DB::select($query);
        //dd($data['appointmentData']);
        return view('backend.appointment.appointment_list',$data);
    }
}
