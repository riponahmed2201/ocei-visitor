<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:system_admin');
    }

    public function dashboard(){
        return view('backend.dashboard.dashboard');
    }

}
