<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Entities\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Companies\Entities\Company;
use Modules\Companies\Entities\Branch;
use Modules\Orders\Entities\OrderStatus;


class RepairOrder extends Model
{
    protected $fillable = [];

    public function store(FormRequest $request, $order_id){

        $this->order_id = $order_id;
        $this->order_nr = $request->order_nr;
        
        $branch = Branch::find($request->branch_id);
        $company = Company::find($branch->company_id);

        $customer = new Customer();
        $customer->storeFromOrder($request->customer_name, $request->customer_phone, $company->id);

        $this->customer_id = $customer->id;
        $this->defect_description = $request->defect_description;
        $this->comment = $request->comment;
        $this->status_id = 1;
        $this->prepay_sum = $request->prepay_sum;

        $this->save();

        return $this;

    }

    public function storeUpdated(FormRequest $request, $id){

        $repair_order = RepairOrder::find($id);

        $repair_order->order_nr = $request->order_nr;
        
        $customer = Customer::find($repair_order->customer_id);
        $customer->updateFromOrder($request->customer_name, $request->customer_phone, $customer->id);

        $repair_order->defect_description = $request->defect_description;
        $repair_order->comment = $request->comment;

        $status = OrderStatus::where('name', $request->status)->firstOrFail();

        $repair_order->status_id = $status->id;
        $repair_order->prepay_sum = $request->prepay_sum;

        $repair_order->update();

        return $repair_order;

    }

}
