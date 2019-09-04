<?php

namespace Modules\Companies\Entities;
use Modules\Companies\Http\Requests\StoreBranchRequest;
use Modules\Companies\Http\Requests\UpdateBranchRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Users\Entities\User;
use Illuminate\Foundation\Http\FormRequest;

use BranchesService;

class Branch extends Model
{
    protected $fillable = ['name', 'company_id'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function store(FormRequest $request){

        $user = User::where('login_id', auth()->user()->id)->first();

        $this->company_id = Company::find($user->company_id)->id; 
        $this->name = $request->name;
        $this->address = $request->address;
        $this->phone = $request->phone;
        $this->color = $request->color;
        $this->save();

        BranchesService::addUserToBranches($user->id, array($this->id));

        return $this;
    }

    public function storeUpdated(FormRequest $request){ 
        $this->name = $request->name;
        $this->address = $request->address;
        $this->phone = $request->phone;
        $this->color = $request->color;
        $this->save();

        return $this;
    }
}
