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
Route::get('/visitor-login', 'Auth\AdminLoginController@showLoginForm')->name('visitor.login');
Route::post('/visitor_login_check', 'Auth\AdminLoginController@visitor_login_check')->name('visitor.login_check');
Route::post('/visitor_logout', 'Auth\AdminLoginController@logout')->name('visitor.logout');

Route::middleware('admin')->group(function(){
	Route::get('/dashboard', 'Backend\HomeController@dashboard')->name('dashboard');
	////*************all visitor************
    Route::get('/all-visitor','Backend\VisitorController@allVisitor')->name('all-visitor');
});


/////**********************frontend**********************************
Route::get('/','Frontend\HomeController@index')->name('home');
///*********************registration*******************
Route::get('/registration','Frontend\RegistrationController@register')->name('register');
Route::post('/register','Frontend\RegistrationController@storeRegister')->name('store.register');


