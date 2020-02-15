<?php

namespace Modules\Documents\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Branch;

class AddReceiptMainTextForEveryExistingBranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $branches = Branch::all();

        foreach($branches as $branch){
            $branch->saveStandardReceiptMainText();
        }

    }
}
