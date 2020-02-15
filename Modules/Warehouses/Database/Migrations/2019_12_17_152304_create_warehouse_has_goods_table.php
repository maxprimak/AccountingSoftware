<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseHasGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_has_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('good_id');
            $table->unsignedInteger('warehouse_id');
            $table->unsignedInteger('location_in_warehouse_id')->nullable();
            $table->integer('amount')->default(0);
            $table->string('vendor_code')->nullable();
            $table->timestamps();
        });

        Schema::table('warehouse_has_goods', function($table) {
          $table->foreign('good_id')->references('id')->on('goods');
          $table->foreign('warehouse_id')->references('id')->on('warehouses');
          $table->foreign('location_in_warehouse_id')->references('id')->on('location_in_warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_has_goods');
    }
}
