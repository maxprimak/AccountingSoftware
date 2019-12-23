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
            $table->unsignedInteger('branch_has_good_id');
            $table->unsignedInteger('supplier_id')->nullable();
            $table->double('retail_price')->nullable();
            $table->double('wholesale_price')->nullable();
            $table->timestamps();
        });

        Schema::table('good_has_prices', function($table) {
          $table->foreign('branch_has_good_id')->references('id')->on('branch_has_goods');
          $table->foreign('supplier_id')->references('id')->on('suppliers');
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
