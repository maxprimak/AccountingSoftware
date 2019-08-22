<?php

namespace Modules\Companies\Entities;
use Modules\Companies\Http\Requests\StoreBranchRequest;
use Modules\Companies\Http\Requests\UpdateBranchRequest;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'company_id'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function store(StoreBranchRequest $request){
        $this->company_id = 1; //company of this user in the future
        $this->name = $request->name;
        $this->address = $request->address;
        $this->phone = $request->phone;
        $this->color = $request->color;
        $this->save();

        return $this;
    }

    public function storeUpdated(UpdateBranchRequest $request){
        $this->company_id = 1; //company of this user in the future
        $this->name = $request->name;
        $this->address = $request->address;
        $this->phone = $request->phone;
        $this->color = $request->color;
        $this->save();

        return $this;
    }
}
