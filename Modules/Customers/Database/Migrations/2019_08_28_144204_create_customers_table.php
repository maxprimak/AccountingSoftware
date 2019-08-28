<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('stars_number');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('company_id');
            $table->timestamps();
        });

        Schema::table('customers', function($table) {
          $table->foreign('person_id')->references('id')->on('people');
          $table->foreign('type_id')->references('id')->on('customer_types');
          $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
