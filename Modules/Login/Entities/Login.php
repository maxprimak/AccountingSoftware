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
        $role_id = Login::join('users', 'users.login_id', '=', 'logins.id')
                            ->join('employees', 'employees.user_id', '=', 'users.id')
                            ->select('employees.role_id')
                            ->find($this->id)->role_id;
        
        return $role_id;
    }

    public function isHead(){ return Employee::where('user_id', User::where('login_id', $this->id)->first()->id)->first()->role_id == 1; }
    public function isTopManager(){ return Employee::where('user_id', User::where('login_id', $this->id)->first()->id)->first()->role_id == 2; }
    public function isTech(){ return Employee::where('user_id', User::where('login_id', $this->id)->first()->id)->first()->role_id == 3; }
    public function isSalesManager(){ return Employee::where('user_id', User::where('login_id', $this->id)->first()->id)->first()->role_id == 4; }
    public function isCourier(){ return Employee::where('user_id', User::where('login_id', $this->id)->first()->id)->first()->role_id == 5; }
    public function isNotCourier(){ return Employee::where('user_id', User::where('login_id', $this->id)->first()->id)->first()->role_id != 5; }


}
