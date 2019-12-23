<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('submodel_id');
            $table->unsignedInteger('color_id');
            $table->string('serial_nr');
            $table->string('condition')->nullable();
            $table->timestamps();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('submodel_id')->references('id')->on('submodels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
