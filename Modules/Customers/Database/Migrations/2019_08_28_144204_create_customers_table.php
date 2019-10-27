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
            $table->unsignedInteger('person_id')->unique();
            $table->string('email')->nullable();
            $table->double('stars_number')->nullable();
            $table->unsignedInteger('type_id')->nullable();
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('created_by')->nullable();
            $table->timestamps();
        });

        Schema::table('customers', function($table) {
          $table->foreign('person_id')->references('id')->on('people');
          $table->foreign('type_id')->references('id')->on('customer_types');
          $table->foreign('company_id')->references('id')->on('companies');
          $table->foreign('created_by')->references('id')->on('users');
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
