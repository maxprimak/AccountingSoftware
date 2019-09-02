<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class People extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    public function store(FormRequest $request){
            $this->name = $request->new_full_name;
            $this->phone = $request->new_phone;
            $this->address = $request->new_address;
            $this->save();

            return $this;
    }
}
