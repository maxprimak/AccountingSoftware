<?php

namespace Modules\Login\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Login\Entities\Login;

class VerificationApiController extends Controller
{
    public function verify(Request $request) {
        $userID = $request['id'];
        $user = Login::findOrFail($userID);
        $date = date('Y-m-d');
        $user->email_verified_at = $date; 
        $user->save();
        return "<script>alert('Your email was successfully verified!'); window.location.href = 'https://relist.at'</script>";
        //return redirect('https://relist.at');
    }
}
