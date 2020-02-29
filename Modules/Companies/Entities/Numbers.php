<?php

namespace Modules\Companies\Entities;

use Illuminate\Database\Eloquent\Model;

class Numbers extends Model
{
    protected $fillable = [];

    public static function getNextSupplierOrderId()
    {
        $company = Company::getCompany();
        $company_number = self::where('company_id',$company->id)->first();
        if(is_null ($company_number)){
            $company_number = new Numbers();
            $company_number = $company_number->storeFirstNumbers();
        }

        $company_number = $company_number->incrementSupplierOrderId();

        return $company_number->supplier_order_number;
    }

    private function storeFirstNumbers() : Numbers
    {
        $company = Company::getCompany();
        $this->repair_order_number = 0;
        $this->supplier_order_number = 0;
        $this->company_id = $company->id;
        $this->save();
        return $this;
    }

    private function incrementSupplierOrderId(){
         $this->supplier_order_number = $this->supplier_order_number + 1;
         $this->save();

         return $this;
    }

}
