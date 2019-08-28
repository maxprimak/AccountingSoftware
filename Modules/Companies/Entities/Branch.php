<?php

namespace Modules\Companies\Entities;
use Modules\Companies\Http\Requests\StoreBranchRequest;
use Modules\Companies\Http\Requests\UpdateBranchRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Users\Entities\User;


class Branch extends Model
{
    protected $fillable = ['name', 'company_id'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function store(StoreBranchRequest $request){

        $user = User::where('login_id', auth()->user()->id)->first();
        $branch_of_user = Branch::find($user->branch_id);

        $this->company_id = Company::find($branch_of_user->company_id)->id; 
        $this->name = $request->name;
        $this->address = $request->address;
        $this->phone = $request->phone;
        $this->color = $request->color;
        $this->save();

        return $this;
    }

    public function storeUpdated(UpdateBranchRequest $request){ 
        $this->name = $request->name;
        $this->address = $request->address;
        $this->phone = $request->phone;
        $this->color = $request->color;
        $this->save();

        return $this;
    }
}
