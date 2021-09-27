<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    public function officiallist(){
        return view('backend.official.official_list');
    }
}
