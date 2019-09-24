<?php

namespace Modules\Login\Http\Controllers;

use Modules\Login\Entities\Login;
use Modules\Login\Entities\Person;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registration';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 
     * 
     */
    public function showRegisterForm(){
        return view('login::register_form');
    }

    /**
    * Handle a registration request for the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {   
        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return Redirect::to('/register')
                        ->withErrors($validator)
                        ->withInput();
        }
        $login = $this->createLogin($request->all());
        Auth::login($login, true);
        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|min:6|unique:logins,username',
            'email' => 'required|email|unique:logins,email',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Modules\Login\Entities\Login
     */
    protected function createLogin(array $data)
    {   
        $login = Login::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);

        $login->sendEmailVerificationNotification();

        return $login;
    }
}
