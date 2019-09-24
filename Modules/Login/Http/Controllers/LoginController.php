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
    if (Auth::attempt(['username' => $request->username, 'password' => $request->password, /*'is_active' => 1*/]))
            {
                return response()->json(['token' => auth()->user()->api_token, 'user' => auth()->user()], 200);
            }
            else{
                return response()->json(['error' => 'login_error'], 401);
            }
    }

    public function customLogin(Request $request){


        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post('http://127.0.0.1:8888/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'client_secret' => 'H8bajC2BQA9vVvn2GNUjzCnmdzZ03oUzpwqGtSzW',
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
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
