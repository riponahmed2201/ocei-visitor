<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use App\Appointment;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function appointmentlist(Request $request)
    {
        $from_date = date('Y-m-d 00:00:01', strtotime($request->from_date));
        $to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));

        $appointmentData = DB::table('appointment')
            ->leftJoin('employee', 'appointment.employee_id', '=', 'employee.employee_id')
            ->leftJoin('visitor_registration', 'appointment.visitor_id', '=', 'visitor_registration.id')
            ->select('appointment.*', 'employee.employee_id as employee_id', 'employee.first_name as firstName', 'employee.last_name as lName', 'visitor_registration.name as visitorName')
            ->get();

        if ($request->isMethod('post')) {
            $status = $request->status;
            if ($status) {
                //dd($status);
                $appointmentData = DB::table('appointment')
                    ->leftJoin('employee', 'appointment.employee_id', '=', 'employee.employee_id')
                    ->leftJoin('visitor_registration', 'appointment.visitor_id', '=', 'visitor_registration.id')
                    ->select('appointment.*', 'employee.employee_id as employee_id', 'employee.first_name as firstName', 'employee.last_name as lName', 'visitor_registration.name as visitorName')
                    ->where('appointment.status', $status)
                    ->orWhereBetween('appointment.date_time', [$from_date, $to_date])
                    ->get();
                //dd($appointmentData);
                return view('backend.appointment.appointment_list', compact('appointmentData'));
            }
        }

        return view('backend.appointment.appointment_list', compact('appointmentData'));
    }
}
