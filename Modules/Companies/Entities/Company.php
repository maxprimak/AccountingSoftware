<?php

namespace Modules\Companies\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Http\Requests\StoreCompanyRequest;
use Modules\Companies\Http\Requests\UpdateCompanyRequest;
use Illuminate\Foundation\Http\FormRequest;

class Company extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function store(FormRequest $request){
        $this->currency_id = $request->currency_id;
        $this->name = $request->name;
        $this->address = $request->address;
        $this->phone = $request->phone;
        $this->save();

        return $this;
    }

    public function storeUpdated(FormRequest $request){
        $this->currency_id = $request->currency_id;
        $this->name = $request->name;
        $this->address = $request->address;
        $this->phone = $request->phone;
        $this->save();

        return $this;
    }
}
