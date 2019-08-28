<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->bigInteger('manager_id');
            $table->bigInteger('device_id');
            $table->date('deadline');
            $table->bigInteger('type_id');
            $table->double('prepay_sum', 8, 2);
            $table->timestamps();
            //TODO: foreign keys
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_orders');
    }
}
