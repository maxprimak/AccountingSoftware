<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['login_id', 'person_id', 'branch_id'];

    //get company_id auth login
    public function getCompany($login_id){
        // $guard = auth()->user()->id;
        $id = User::join('branches', 'branches.id', '=', 'users.branch_id')
                                ->select('branches.company_id')
                                ->where('users.login_id',$login_id)
                                ->first();
        return $id->company_id;
    }
}
