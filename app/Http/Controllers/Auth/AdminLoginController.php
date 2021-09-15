<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
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
         $input = $request->all();
  
        $this->validate($request, [
            'user_name' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->user_name, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
        //dd($fieldType);
        if(auth()->attempt(array($fieldType => $input['user_name'], 'password' => $input['password'])))
        {
            return redirect()->route('dashboard');
        }else{
            //echo "dsdskjd";
            return redirect()->route('visitor.login')
                ->with('error','Email address and password are wrong.');
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
