<?php

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
Route::get('/visitor-login', 'Auth\VisitorLoginController@showLoginForm')->name('visitor.login');
Route::post('/visitor_login_check', 'Auth\VisitorLoginController@visitor_login_check')->name('visitor.login_check');
Route::post('/visitor_logout', 'Auth\VisitorLoginController@logout')->name('visitor.logout');

Route::middleware('visitor')->group(function(){
	Route::get('/dashboard', 'Backend\HomeController@dashboard')->name('dashboard');
	////*************all visitor************
    Route::get('/all-visitor','Backend\VisitorController@allVisitor')->name('all-visitor');
    //Visitor Delete & Forword
    Route::post('/delete/all/visitors','Backend\VisitorController@deleteAll');
    Route::post('/activate/all/visitors','Backend\VisitorController@forwordAll');
    ///*********employee***************//
    Route::get('/all-forward-visitor','Backend\EmployeeController@forwardingVisitor')->name('forward-visitor');
    ////*************Appoinment*********************////
    Route::match(['get','post'],'official/list','Backend\OfficialController@officiallist')->name('official.list');
    Route::get('/create/appointment/{employee_id}','Backend\OfficialController@createAppointment')->name('showAppointmentForm');
    Route::post('/store/appointment','Backend\OfficialController@storeAppointment')->name('storeAppointment');
    /////**********Appontment List And searching******************/////
    Route::match(['get','post'],'appointment/list','Backend\AppointmentController@appointmentlist')->name('appointment.list');
});


/////**********************frontend**********************************
Route::get('/','Frontend\HomeController@index')->name('home');
///*********************registration*******************
Route::get('/registration','Frontend\RegistrationController@register')->name('register');
Route::post('/register','Frontend\RegistrationController@storeRegister')->name('store.register');


