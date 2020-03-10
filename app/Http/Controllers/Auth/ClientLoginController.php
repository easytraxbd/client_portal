<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function loginForm()
    {
        return view('auth.client_login');
    }
    public function login(Request $request)
    {
        $errorArray=[];
        $work_phone = $request->work_phone;

        $request->validate([
            'work_phone' => 'required|string|max:14',
            'password' => 'required|string',
        ]);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if (Auth::guard('client')->attempt(['work_phone' => $work_phone, 'password' => $request->password],$request->remember)){
            return redirect()->intended(route('dashboard'));
        }
        $this->incrementLoginAttempts($request);
        //check if phone number exist in database
        if (!in_array($work_phone,Client::pluck('work_phone')->toarray()) ){
            $errorArray["work_phone"] = "Number not exists";
        }
        else{
            $errorArray["password"] = "Wrong password";
        }
        return back()->withInput($request->except('password'))->withErrors($errorArray);
    }

//    protected function guard()
//    {
//        return Auth::guard('client');
//    }

//    public function logout(Request $request)
//    {
//        // Get the session key for this client
//        $sessionKey = $this->guard()->getName();
//
//        // Logout current client by guard
//        $this->guard()->logout();
//
//        // Delete single session key (just for this client)
//        $request->session()->forget($sessionKey);
//
//        // After logout, redirect to login screen again
//        return redirect()->route('client.login.form');
//    }
}
