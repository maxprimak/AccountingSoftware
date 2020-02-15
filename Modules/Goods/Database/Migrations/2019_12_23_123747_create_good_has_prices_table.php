<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodHasPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_has_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('good_id');
            $table->unsignedInteger('supplier_id')->nullable();
            $table->double('retail_price')->nullable();
            $table->double('wholesale_price')->nullable();
            $table->unsignedInteger('branch_id');
            $table->timestamps();
        });

        Schema::table('good_has_prices', function($table) {
          $table->foreign('supplier_id')->references('id')->on('suppliers');
          $table->foreign('good_id')->references('id')->on('goods');
          $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_has_prices');
    }
}
