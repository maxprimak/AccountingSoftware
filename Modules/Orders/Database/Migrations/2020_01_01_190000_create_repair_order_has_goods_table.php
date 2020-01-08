<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairOrderHasGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_order_has_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('repair_order_id');
            $table->unsignedInteger('warehouse_has_good_id');
            $table->tinyInteger('is_used');
            $table->integer('amount');
            $table->unsignedInteger('device_id');
            $table->timestamps();
        });

        Schema::table('repair_order_has_goods', function($table) {
          $table->foreign('repair_order_id')->references('id')->on('repair_orders');
          $table->foreign('warehouse_has_good_id')->references('id')->on('warehouse_has_goods');
          $table->foreign('device_id')->references('id')->on('devices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_order_has_goods');
    }
}
