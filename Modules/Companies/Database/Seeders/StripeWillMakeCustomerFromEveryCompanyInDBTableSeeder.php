<?php

namespace Modules\Companies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Company;

class StripeWillMakeCustomerFromEveryCompanyInDBTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $companies = Company::all();

        foreach($companies as $company){
            $company->createAsStripeCustomer([
                'description' => $company->name 
            ]);

            $company->subscribeToFreePlan();
        }

    }
}
