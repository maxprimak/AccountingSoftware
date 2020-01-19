<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairOrderHasDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_order_has_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('defect_description')->nullable();
            $table->unsignedInteger('repair_order_id');
            $table->unsignedInteger('device_id');
            $table->timestamps();
        });

        Schema::table('repair_order_has_devices', function($table) {
          $table->foreign('device_id')->references('id')->on('devices');
          $table->foreign('repair_order_id')->references('id')->on('repair_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_order_has_devices');
    }
}
