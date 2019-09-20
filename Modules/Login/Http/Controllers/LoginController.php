<?php

namespace Modules\Login\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use CreateUsersService;

class LoginController extends Controller
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     *
     *
     */
    public function showLoginForm(){
        return view('login::login_form');
    }

    /**
     *
     *
     */
    public function authenticate(Request $request){
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password /*, 'is_active' => 1*/]))
            {   
                return redirect()->intended($this->redirectPath());
            }
            else{
                return redirect()->back()->withInput()->with('message', 'Username or password incorrect');
            }
    }

    /**
     *
     *
     */
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
