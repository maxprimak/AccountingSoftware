<?php

use  Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReworkOrderHasWarrantyCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rework_order_has_warranty_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rework_order_id');
            $table->unsignedInteger('order_has_device_id');
            $table->timestamps();
        });

        Schema::table('rework_order_has_warranty_cases', function($table) {
            $table->foreign('rework_order_id')->references('id')->on('rework_orders');
            $table->foreign('order_has_device_id')->references('id')->on('repair_order_has_devices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rework_order_has_warranty_cases');
    }
}
