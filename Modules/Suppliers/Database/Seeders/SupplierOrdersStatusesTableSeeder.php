<?php

namespace Modules\Suppliers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Suppliers\Entities\SupplierOrdersStatuses;

class SupplierOrdersStatusesTableSeeder extends Seeder
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

        $pending = new SupplierOrdersStatuses();
        $request->name = "Pending";
        $request->hex_code = "#4168E1";
        $pending->store($request);


        $in_progress = new SupplierOrdersStatuses();
        $request->name = "In Progress";
        $request->hex_code = "#FFC106";
        $in_progress->store($request);

        $received = new SupplierOrdersStatuses();
        $request->name = "Received";
        $request->hex_code = "#4BAF50";
        $received->store($request);

        $partly_received = new SupplierOrdersStatuses();
        $request->name = "Partly Received";
        $request->hex_code = "#263DB5";
        $partly_received->store($request);

        $cancelled = new SupplierOrdersStatuses();
        $request->name = "Cancelled";
        $request->hex_code = "#D22346";
        $cancelled->store($request);

        
        // $this->call("OthersTableSeeder");
    }
}
