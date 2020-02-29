<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegularCustomersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //run only this migration : php artisan migrate --path=/Modules/Customers/Database/Migrations/2020_02_22_153324_regular_customers_migration.php  
        Schema::table('customers', function(Blueprint $table){
            $table->tinyInteger('is_regular')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
