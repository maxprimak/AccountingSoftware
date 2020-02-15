<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceHasDeviceLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_has_device_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('device_id');
            $table->unsignedInteger('device_location_id');
            $table->timestamps();
        });

        Schema::table('device_has_device_locations', function($table) {
          $table->foreign('device_id')->references('id')->on('devices');
          $table->foreign('device_location_id')->references('id')->on('device_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device_has_device_locations');
    }
}
