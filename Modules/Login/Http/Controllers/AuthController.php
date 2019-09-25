<?php

namespace Modules\Login\Http\Controllers;

use Modules\Login\Entities\Login;
use Modules\Login\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request){

        if(!Auth::attempt(['email' => $request->username, 'password' => $request->password /*'is_active' => 1*/]))
            return response()->json([
                'error' => 'invalid_credentials'
            ], 401);

        $user = $request->user();

        $tokenResult = $this->getToken($user, $request);

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
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

    public function register(RegisterRequest $request){

        $user = Login::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => 'shouldbedeleted',
        ]);

        $user->sendEmailVerificationNotification();

        $tokenResult = $this->getToken($user, $request);

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_in' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

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