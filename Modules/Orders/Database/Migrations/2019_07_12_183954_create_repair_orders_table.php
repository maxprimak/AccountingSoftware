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
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->string("order_nr");
            $table->unsignedInteger("customer_id");
            $table->string("comment", 900)->nullable();
            $table->unsignedInteger("status_id");
            $table->double("prepay_sum")->nullable();
            $table->date("deadline")->nullable();
            $table->tinyInteger("is_completed");
            $table->unsignedInteger('payment_status_id');
            $table->unsignedInteger('warranty_id')->nullable()->unsigned();
            $table->unsignedInteger('discount_code_id')->nullable()->unsigned();
            $table->unsignedInteger('order_type_id');
            $table->timestamps();

            //Foreign
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('status_id')->references('id')->on('order_statuses');
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses');
            $table->foreign('warranty_id')->references('id')->on('warranties');
            $table->foreign('discount_code_id')->references('id')->on('discount_codes');
            $table->foreign('order_type_id')->references('id')->on('order_types');
            $table->softDeletes();
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
