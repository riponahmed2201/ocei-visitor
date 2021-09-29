<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VisitorRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VisitorLoginController extends Controller
{
    private $errors= [];
    protected $redirectTo = '/dashboard';

    public function showLoginForm(){
        return view('backend.auth.login');
    }

    /**
     * Override
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function visitor_login_check(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $auth = VisitorRegistration::where('email','=', $request->email)->first();
        //dd($auth);
        if ($auth) {
            if (Hash::check($request->password, $auth->password)) {
                session([
                     'id' =>$auth->id,
                     'email' =>$auth->email,
                     'name' =>$auth->name,
                     'role' =>$auth->role,
                ]);
                //dd(session()->get());
                if ($auth->role == 'visitor') {
                    return redirect('/dashboard');
                }else{
                    return redirect('/visitor-login');
                }

            }else{
                return redirect('/visitor-login')
                ->withInput($request->only('name'))
                ->withErrors($this->errors);
            }
        }else{
            return back()->with('failed','No Account For This Email');
        }
    }
    

    protected function guard()
    {
        return Auth::guard('guest');
    }
    /**
     * Override
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
