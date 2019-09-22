<?php

namespace Modules\Login\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Users\Entities\User;
use Modules\Employees\Entities\Employee;

class Login extends Authenticatable implements MustVerifyEmail
{   
    use Notifiable;

    protected $fillable = ['id', 'username', 'password', 'remember_token', 'email', 'email_verified_at'];
    public $timestamps = false;

    public function store(FormRequest $request){
        $this->username = $request->username;
        $this->password = bcrypt($request->password);
        $this->email = $request->email;
        $this->save();

        return $this;
    }

    public function checkRole(){
        $role_id = $this->getRoleId();
        
        return $role_id;
    }

    public function getRoleId(){

        try{

            $user = User::where('login_id', $this->id)->firstOrFail();
            $employee = Employee::where('user_id', $user->id)->firstOrFail();
            return $employee->role_id;

        }catch(\Exception $e){
            return 1;
        }

    }

    public function isHead(){ return $this->getRoleId() == 1; }
    public function isTopManager(){ return $this->getRoleId() == 2; }
    public function isTech(){ return $this->getRoleId() == 3; }
    public function isSalesManager(){ return $this->getRoleId() == 4; }
    public function isCourier(){ return $this->getRoleId() == 5; }
    public function isNotCourier(){ return $this->getRoleId() != 5; }


}
