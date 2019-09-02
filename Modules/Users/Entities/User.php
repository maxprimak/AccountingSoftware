<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class User extends Model
{
    protected $fillable = ['login_id', 'person_id', 'branch_id', 'is_active'];

    public function store($login, $person, FormRequest $request){
            $this->login_id = $login->id;
            $this->person_id = $person->id;
            //$this->branch_id = $request->branch_id;
            $this->save();

            return $this;
    }

}
