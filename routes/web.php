<?php

use App\Http\Controllers\Backend\OfficialController;
use App\Http\Controllers\Backend\AppointmentController;
use App\Http\Controllers\Backend\ReceptionistController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });
////*************all visitor************
//Route::get('/all-visitor','Backend\VisitorController@allVisitor')->name('all-visitor');
//Visitor Delete & Forword
//Route::post('/delete/all/visitors','Backend\VisitorController@deleteAll');
//Route::post('/activate/all/visitors','Backend\VisitorController@forwordAll');
///*********employee***************//
//Route::get('/all-forward-visitor','Backend\EmployeeController@forwardingVisitor')->name('forward-visitor');


Route::get('/visitor-login', 'Auth\VisitorLoginController@showLoginForm')->name('visitor.login');
Route::post('/visitor_login_check', 'Auth\VisitorLoginController@visitor_login_check')->name('visitor.login_check');
Route::post('/visitor_logout', 'Auth\VisitorLoginController@logout')->name('visitor.logout');

Route::middleware('visitor')->group(function(){
	Route::get('/dashboard', 'Backend\HomeController@dashboard')->name('dashboard');
    ////*************Appoinment*********************////
    Route::match(['get','post'],'official/list','Backend\OfficialController@officiallist')->name('official.list');

    Route::group(['prefix' => 'appointment'], function () {
        Route::get('/create/{employee_id}',[OfficialController::class, 'createAppointment'])->name('showAppointmentForm');
        Route::post('/store',[OfficialController::class, 'storeAppointment'])->name('storeAppointment');
        /////**********Appontment List And searching******************/////
        Route::match(['get','post'],'/list',[AppointmentController::class, 'appointmentlist'])->name('appointment.list');
     });
});

Route::middleware('receptionist')->group(function(){
    Route::get('/receptionists-dashboard', 'Backend\HomeController@receptionistDashboard')->name('receptionist.dashboard');
    Route::group(['prefix' => 'receptionists'], function () {
      Route::match(['get','post'],'/appointment-list', [ReceptionistController::class,'checkAppointmentList'])->name('checkAppointmentList');
      Route::get('/create/appointment/{appointment_id}',[ReceptionistController::class, 'receptionistsCreateAppointment'])->name('showreReptionistsAppointment');
      Route::post('/store',[ReceptionistController::class, 'storeReceptionistsData'])->name('storeReceptionistsData');
      Route::get('/all/visitor', [SectionController::class, 'allVisitorAppontmentData'])->name('allVisitorAppontmentData');
      //Route::get('/render/section/datatable','Admin\SectionController@rendersectionDataTable');
    });
});


/////**********************frontend**********************************
Route::get('/','Frontend\HomeController@index')->name('home');
///*********************registration*******************
Route::get('/registration','Frontend\RegistrationController@register')->name('register');
Route::post('/register','Frontend\RegistrationController@storeRegister')->name('store.register');


