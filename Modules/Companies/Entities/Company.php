<?php

namespace Modules\Companies\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Http\Requests\StoreCompanyRequest;
use Modules\Companies\Http\Requests\UpdateCompanyRequest;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Companies\Entities\Branch;
use Modules\Warehouses\Entities\Warehouse;
class Company extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function getBranchesIdsOfCompany(){
      $branches_ids = Branch::where('company_id',$this->id)->pluck('id');
      return $branches_ids;
    }

    public function getWarehousesIdsOfCompany(){
      $branches_ids = $this->getBranchesIdsOfCompany();
      $warehouses_ids = Warehouse::whereIn('branch_id',$branches_ids)->pluck('id');
      return $warehouses_ids;
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
