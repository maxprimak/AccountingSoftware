<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairOrderHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_order_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('change_attributes');
            $table->unsignedInteger('repair_order_id');
            $table->timestamps();
        });

        Schema::table('repair_order_histories', function($table) {
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
        Schema::dropIfExists('repair_order_histories');
    }
}
