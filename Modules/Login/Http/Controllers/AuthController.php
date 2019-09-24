<?php

namespace Modules\Login\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
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

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_in' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

        
        /*
        $http = new \GuzzleHttp\Client;
        try {
            $response = $http->post('http://127.0.0.1:8000/oauth/token', [
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
    }*/
    }

}