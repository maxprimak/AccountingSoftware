<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Companies\Entities\Branch;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['accept_date', 'price', 'branch_id', 'created_by'];

    public function store(FormRequest $request){

            if(isset($request->accept_date)){
                $this->accept_date = $request->accept_date;
            }else{
                $this->accept_date = date('Y-m-d');
            }
            $this->price = $request->price;
            $this->branch_id = $request->branch_id;
            $this->created_by = auth('api')->user()->id;

            $this->save();

            return $this;

    }

    public function storeUpdated(FormRequest $request){
        $this->price = $request->price;
        $this->update();
        return $this;

    }

    public function getBranch(): Branch{
            $branch = Branch::findOrFail($this->branch_id);
            return $branch;
    }

    public function showPriceAsString(){
        $company = auth('api')->user()->getCompany();
        return number_format($this->price, 2, '.', '') . " " . $company->getCurrency()->symbol;
    }

    //for seeder
    public static function makeOrder(){

    }
}
