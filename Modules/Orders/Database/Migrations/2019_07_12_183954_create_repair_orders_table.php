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
            $table->unsignedInteger('order_id');
            $table->string("order_nr");
            $table->unsignedInteger("customer_id");
            $table->string("defect_description");
            $table->string("comment");
            $table->unsignedInteger("status_id");
            $table->double("prepay_sum");
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('status_id')->references('id')->on('order_statuses');
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
