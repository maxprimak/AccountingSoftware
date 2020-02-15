<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceHasServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_has_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('device_id');
            $table->unsignedInteger('repair_order_id');
            $table->tinyInteger('is_completed');
            $table->timestamps();
        });

        Schema::table('device_has_services', function($table) {
          $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('device_has_services');
    }
}
