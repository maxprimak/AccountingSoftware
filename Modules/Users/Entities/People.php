<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class People extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    public function store(FormRequest $request){
            $this->name = $request->name;
            $this->phone = $request->phone;
            $this->address = $request->address;
            $this->save();

            return $this;
    }
}
