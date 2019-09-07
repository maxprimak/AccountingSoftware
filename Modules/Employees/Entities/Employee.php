<?php

namespace Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Employees\Http\Requests\StoreEmployeeRequest;
use Modules\Employees\Http\Requests\UpdateEmployeeRequest;
use Modules\Users\Entities\User;

use BranchesService;

class Employee extends Model
{
    protected $fillable = ['user_id', 'role_id'];
    protected $appends = ['branch_id'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function store($request){
        $this->user_id = $request['user_id'];
        $this->role_id = $request['role_id'];
        $this->save();

        return $this;
    }

    public function storeUpdated(UpdateEmployeeRequest $request){
        $this->role_id = $request->role_id;
        $this->save();

        return $this;
    }

    public function getBranchIdAttribute()
    {

        return $this->attributes['branch_id'];

    }
}
