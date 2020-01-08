<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\PaymentStatuses;
use Illuminate\Http\Request;

class PaymentStatusesTableSeeder extends Seeder
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
        $payment_status = new PaymentStatuses();
        $request->name = "Paid";
        $payment_status->store($request);

        $payment_status = new PaymentStatuses();
        $request->name = "Partly Paid";
        $payment_status->store($request);

        $payment_status = new PaymentStatuses();
        $request->name = "Not Paid";
        $payment_status->store($request);
    }
}
