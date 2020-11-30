<?php

namespace Modules\Login\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
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
use Modules\Login\Transformers\AuthTokenResource;
use Newsletter;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        if(!Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password, 'is_active' => 1])) {
            return response()->json([
                'error' => 'invalid_credentials'
            ], 401);
        }

        $user = auth('web')->user();
        $tokenResult = $this->getToken($user);
        return response()->json(new AuthTokenResource($tokenResult));
    }

    public function getToken($user){
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return $tokenResult;

    }

    protected function regValidator(array $data)
    {
        return Validator::make($data, [
            'g-recaptcha-response' => 'recaptcha',
            'username' => 'required|min:6|unique:logins,username',
            'email' => 'required|email:rfc,dns,strict|unique:logins,email',
            'password' => 'required|min:8',
            'repassword' => 'required|same:password',
        ]);
    }

    public function register(Request $request){
        $validator = $this->regValidator($request->all());
        if ($validator->fails()) return response()->json($validator->errors(), 422);

        $user = Login::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => 1,
        ]);

        // $user->sendEmailVerificationNotification();

        $tokenResult = $this->getToken($user);

        Newsletter::subscribe($request->email);
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'is_registered' => 0,
            'plan' => 'free',
            'extra_branches_paid' => 0,
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

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return string
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        // check if they're an existing user
        $existingUser = Login::where('email', $user->email)->first();
        if($existingUser){
            $tokenResult = $this->getToken($existingUser);
        } else {
            $newUser = Login::create([
                'username' => $user->email,
                'email' => $user->email,
                'email_verified_at' => now (),
                'password' => Hash::make($user->id),
                'is_active' => 1,
            ]);
            $tokenResult = $this->getToken($newUser);
        }

        return response()->json(new AuthTokenResource($tokenResult));
    }

}
