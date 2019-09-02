<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use BranchesService;

class User extends Model
{
    protected $fillable = ['login_id', 'person_id', 'branch_id', 'is_active'];

    public function store($login, $person, FormRequest $request){
            $this->login_id = $login->id;
            $this->person_id = $person->id;
            $this->company_id = User::where('login_id', auth()->id())->first()->company_id;
            $this->is_active = true;
            $this->save();

            BranchesService::addUserToBranches($this->id, $request->branch_id);

            return $this;
    }

}
