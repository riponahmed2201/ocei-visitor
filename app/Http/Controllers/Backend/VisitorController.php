<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class VisitorController extends Controller
{
    public function allVisitor(){
        Session::put('page','visitor-visitors');
        $visitors=DB::table('visitor_registration')
        ->join('department', 'visitor_registration.department_id', '=', 'department.department_id')
        ->join('designation', 'visitor_registration.designation_id', '=', 'designation.designation_id')
        ->select('visitor_registration.*', 'department.department_name as deptName', 'designation.designation_name as desigName')
        ->get();
        //dd($data['visitors']);
        return view('backend.visitor.all_visitor')->with(compact('visitors'));
    }
}
