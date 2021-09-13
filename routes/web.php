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
Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('visitor.login');
Route::post('/logout', 'Auth\AdminLoginController@logout')->name('visitor.logout');

Route::get('/dashboard', 'Backend\HomeController@dashboard')->name('dashboard');

Route::get('/profile','Backend\HomeController@profile')->name('profile');
Route::post('update/Profile','Backend\HomeController@updateProfile')->name('update.profile');
Route::post('/update/password','Backend\HomeController@updatePassword')
->name('update.password');


