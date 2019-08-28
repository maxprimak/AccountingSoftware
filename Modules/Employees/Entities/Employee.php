<?php

namespace Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Employees\Http\Requests\StoreEmployeeRequest;
use Modules\Employees\Http\Requests\UpdateEmployeeRequest;

class Employee extends Model
{
    protected $fillable = ['user_id', 'role_id'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function store($request){
        // dd($request['user_id']);
        $this->user_id = $request['user_id'];
        $this->role_id = $request['role_id'];
        $this->save();

        return $this;
    }

    public function storeUpdated(UpdateEmployeeRequest $request){
        $this->user_id = $request->user_id;
        $this->role_id = $request->role_id;
        $this->save();

        return $this;
    }
}
