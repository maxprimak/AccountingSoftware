<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use BranchesService;
use Modules\Companies\Entities\Branch;
use Modules\Employees\Entities\Employee;

class User extends Model
{
    protected $fillable = ['login_id', 'person_id', 'branch_id', 'is_active'];

    public function store($login, $person, FormRequest $request){
            $this->login_id = $login->id;
            $this->person_id = $person->id;
            $this->company_id = User::where('login_id', auth('api')->id())->first()->company_id;
            $this->save();

            //$branch_id = $request->branch_id;
            $branch_id = Branch::where('company_id',$this->company_id)->pluck('id')->toArray();

            BranchesService::addUserToBranches($this->id, $branch_id);

            return $this;
    }

}
