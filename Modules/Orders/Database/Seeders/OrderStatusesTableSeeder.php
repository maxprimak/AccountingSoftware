<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusesTableSeeder extends Seeder
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
        $request->name = 'Accepted for repair';
        $request->hex_code = '#4169E1';
        $order_status = new OrderStatus();
        $order_status->store($request);

        $request->name = 'In progress';
        $request->hex_code = '#FFC106';
        $order_status = new OrderStatus();
        $order_status->store($request);

        $request->name = 'Order parts';
        $request->hex_code = '#52495A';
        $order_status = new OrderStatus();
        $order_status->store($request);

        $request->name = 'Waiting for parts';
        $request->hex_code = '#253DB5';
        $order_status = new OrderStatus();
        $order_status->store($request);

        $request->name = 'Repaired';
        $request->hex_code = '#653399';
        $order_status = new OrderStatus();
        $order_status->store($request);

        $request->name = 'Not repairable';
        $request->hex_code = '#D22246';
        $order_status = new OrderStatus();
        $order_status->store($request);

        $request->name = 'Waiting for customer';
        $request->hex_code = '#BBBBBB';
        $order_status = new OrderStatus();
        $order_status->store($request);

        $request->name = 'Returned to client';
        $request->hex_code = '#4BAF50';
        $order_status = new OrderStatus();
        $order_status->store($request);
    }
}
