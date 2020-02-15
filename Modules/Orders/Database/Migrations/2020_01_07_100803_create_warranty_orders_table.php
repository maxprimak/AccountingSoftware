<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarrantyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('repair_order_id');
            $table->unsignedInteger('order_type_id');
            $table->timestamps();
        });

        Schema::table('warranty_orders', function($table) {
          $table->foreign('repair_order_id')->references('id')->on('repair_orders');
          $table->foreign('order_type_id')->references('id')->on('order_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warranty_orders');
    }
}
