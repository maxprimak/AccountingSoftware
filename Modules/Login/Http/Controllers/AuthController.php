<?php

namespace Modules\Login\Http\Controllers;

use Modules\Login\Entities\Login;
use Modules\Login\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Modules\Login\Http\Requests\LoginRequest;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login(LoginRequest $request){

        if(!Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password, 'is_active' => 1]))

        return response()->json([
                'error' => 'invalid_credentials'
            ], 401);

        $user = $request->user();

        $tokenResult = $this->getToken($user, $request);

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'plan' => ($user->getCompany() == null) ? "no_company_yet" : $user->getCompany()->getStripePlanName(),
            'extra_branches_paid' => ($user->getCompany() == null) ? "no_company_yet" : $user->getCompany()->getExtraBranchesAmount(),
            'is_registered' => ($user->isRegistered()) ? 1 : 0,
            'expires_in' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

    }

    public function getToken($user, $request){

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return $tokenResult;

    }

    protected function regValidator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|min:6|unique:logins,username',
            'email' => 'required|email:rfc,dns,strict|unique:logins,email',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
            'recaptchaToken' => 'required',
            'ip' => 'required'
        ]);
    }

    public function register(Request $request){
        $validator = $this->regValidator($request->all());
        if ($validator->fails()) return response()->json($validator->errors(), 422);
        if (!$this->checkRecaptcha($request->recaptchaToken, $request->ip)) return response()->json("Recaptcha is not correct", 422);

        $user = Login::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'plan' => 'free',
            'additional_items' => '0',
            'is_active' => 1,
        ]);

        $user->sendEmailVerificationNotification(); 

        $tokenResult = $this->getToken($user, $request);

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'is_registered' => 0,
            'expires_in' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

    }

    protected function checkRecaptcha($token, $ip)
    {
        $response = (new Client)->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret'   => env('RECAPTCHA_KEY'),
                'response' => $token,
                'remoteip' => $ip,
            ],
        ]);
        $response = json_decode((string)$response->getBody(), true);
        return $response['success'];
    }

    public function logout(){

        if(auth('api')->user() != null){

            auth('api')->user()->tokens->each(function($token, $key){
                $token->delete();
            });

            return response()->json(['status' => 'logged_out'], 200);

        }
        else{

            return response()->json(['status' => 'not_logged_in'], 401);

        }

    }

}
