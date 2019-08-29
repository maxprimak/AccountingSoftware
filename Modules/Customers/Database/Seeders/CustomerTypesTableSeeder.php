<?php

namespace Modules\Customers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Entities\CustomerType;


class CustomerTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $customer_type = new CustomerType;
        $customer_type->name = 'Person';
        $customer_type->save();

        $customer_type = new CustomerType;
        $customer_type->name = 'Company';
        $customer_type->save();
    }
}
