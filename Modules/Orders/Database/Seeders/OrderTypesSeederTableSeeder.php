<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\OrderTypes;
use Illuminate\Http\Request;

class OrderTypesSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $request = new Request();
        $request->language_id = 1;
        $request->name = "Pay";
        $order_type = new OrderTypes();
        $order_type->store($request);
        $request->name = "Warranty";
        $order_type = new OrderTypes();
        $order_type->store($request);
        $request->name = "Rework";
        $order_type = new OrderTypes();
        $order_type->store($request);
    }
}
